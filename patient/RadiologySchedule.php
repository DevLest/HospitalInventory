<?php
// Check if a session is already active
if (session_status() === PHP_SESSION_NONE) {
    session_name('RadiologySession'); // Set the session name only if no session exists
    session_start(); // Start the session only if not already active
}

// Validate session variables for authorized access
if (!isset($_SESSION['doctor_id']) || $_SESSION['specialties'] !== 'Radiology') {
    // Redirect unauthorized users to the login page
    header("Location: login.php?error=Access denied. Please log in as a Radiology doctor.");
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appointments List for <?php echo htmlspecialchars($specialty); ?></title>
    <link rel="stylesheet" href="outpatient.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/5.11.3/main.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/5.11.3/main.min.js"></script>

    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome for icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">


<style>
    body {
        background-color: #f4f6f6;
    }
    #calendar-container {
            max-width: 900px;
            margin: 40px auto;
            padding: 10px;
        }
        .fc-daygrid-day { cursor: pointer; }
</style>
<body>

<!-- Fixed Top Navigation -->
<div class="top-nav">

    <!-- Left-aligned logo and title -->
    <div class="icon-container">
        <img src="img/Hinigaran.png" alt="Logo">
        <h1>𝙷𝚒𝚗𝚒𝚐𝚊𝚛𝚊𝚗 𝙼𝚎𝚍𝚒𝚌𝚊𝚕 𝙲𝚕𝚒𝚗𝚒𝚌 𝙷𝚘𝚜𝚙𝚒𝚝𝚊𝚕</h1>
    </div>

        <!-- User Icon -->
        <div class="user-icon" onclick="toggleUserMenu(event)">
            <i class="fas fa-user"></i> <!-- Font Awesome user icon -->
        </div>
    </div>

    <!-- User Dropdown Menu -->
    <div class="user-menu" id="user-menu">
        <a href="#settings">⚙️ Settings</a>
        <a id="logoutButton" onclick="logout()">⤷ Log Out</a>
    </div>
</div>

    <!-- Side Navigation -->
     <div id="mySidenav" class="side-nav">
        <div class="logo-container">
           <img src="img/hini.png" alt="Logo" style="width: 40%;">
            <h2>𝐇 𝐌 𝐂 𝐇</h2>
        </div>
        <a class="nav-link" href="RadiologyDashboard.php">
            <div class="sb-nav-link-content">
                <div class="sb-nav-link-icon"><i class="fas fa-home"></i></div>
                <span>𝖣𝖺𝗌𝗁𝖻𝗈𝖺𝗋𝖽</span>
            </div>
        </a>
        <a class="nav-link" href="RadiologyList.php">
            <div class="sb-nav-link-content">
                <div class="sb-nav-link-icon"><i class="fas fa-user"></i></div>
                <span>𝖯𝖺𝗍𝗂𝖾𝗇𝗍 𝖫𝗂𝗌𝗍</span>
            </div>
        </a>
         <a class="nav-link" href="RadiologySchedule.php">
            <div class="sb-nav-link-content">
                <div class="sb-nav-link-icon"><i class="fas fa-user"></i></div>
                <span>Schedule</span>
            </div>
        </a>
    </div>
    <!-- Main Content -->
    <div id="mainContent" class="main-content">
       <div class="header-container">
    <h3>𝖲𝖼𝗁𝖾𝖽𝗎𝗅𝖾</h3>
<div class="haha">
    <p style="text-align: center;">
        <a href="InventoryDashboard1.php" style="text-decoration: none; color: inherit;">
            <i class="fas fa-home" style="color: #34495e;"></i> Home
        </a>
        <span style="margin: 0 10px;">›</span>
        𝖲𝖼𝗁𝖾𝖽𝗎𝗅𝖾
    </p>
</div>
</div>
<div class="first1" style="opacity: 0.9; border-top: 2px solid #b2babb; margin-top: -20px;"></div><br>
<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "database"; // Change this to your database name

$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the user is logged in and is a Radiology doctor
if (!isset($_SESSION['doctor_id']) || $_SESSION['specialties'] != 'Radiology') {
    header("Location: login.php?error=Access denied. Please log in as a Radiology doctor.");
    exit();
}

$loggedInDoctorId = $_SESSION['doctor_id'];

// Get the current month and year or the passed month and year (for navigation)
$month = isset($_GET['month']) ? $_GET['month'] : date('m');
$year = isset($_GET['year']) ? $_GET['year'] : date('Y');

// Get the first and last day of the month
$firstDayOfMonth = mktime(0, 0, 0, $month, 1, $year);
$daysInMonth = date('t', $firstDayOfMonth);

// Get some information about the month
$monthName = date('F', $firstDayOfMonth);
$dayOfWeek = date('w', $firstDayOfMonth); // 0 (for Sunday) through 6 (for Saturday)

// Start the HTML table for the calendar
echo "<div style='text-align: center; margin-bottom: 20px;'>";
echo "<div class='d-flex justify-content-center align-items-center' style='gap: 10px;'>";
echo "<button onclick='window.location.href=\"?month=" . ($month - 1) . "&year=$year\"' class='btn btn-primary' style='width: 10%;'>Previous</button>";
echo "<button onclick='window.location.href=\"?month=" . ($month + 1) . "&year=$year\"' class='btn btn-primary' style='width: 10%;'>Next</button>";
echo "</div>";

echo "</div>";

echo "<table class='table table-bordered' style='width:100%; text-align:center;'>";
echo "<tr><th colspan='7'>$monthName $year</th></tr>";
echo "<tr><th>Sun</th><th>Mon</th><th>Tue</th><th>Wed</th><th>Thu</th><th>Fri</th><th>Sat</th></tr>";

// Start the first row
echo "<tr>";

// Add empty cells for days before the first day of the month
if ($dayOfWeek > 0) {
    for ($i = 0; $i < $dayOfWeek; $i++) {
        echo "<td></td>";
    }
}

// Fill in the days of the month
$currentDay = 1;
while ($currentDay <= $daysInMonth) {
    $currentDate = $year . '-' . $month . '-' . str_pad($currentDay, 2, '0', STR_PAD_LEFT);

    // Fetch the availability for the current date from the database
    $sql = "SELECT availability, available_time FROM calendar_availability WHERE date = '$currentDate' AND doctor_id = '$loggedInDoctorId'";
    $result = $conn->query($sql);
    $availability = "N/A"; // Default to N/A
    $availableTime = ""; // Default to no time
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $availability = $row['availability'];
        $availableTime = $row['available_time'];
    }

    // Print the day with a highlight if it's today
    $style = ($currentDay == date('j') && $month == date('m') && $year == date('Y')) ? "background-color: yellow;" : "";
    echo "<td style='$style' class='calendar-day' data-date='$currentDate' onclick='showModal(this)'>$currentDay<br><small>$availability";
    if ($availability == "Available") {
        echo "<br><small>$availableTime</small>";
    }
    echo "</small></td>";

    // Move to the next day
    $currentDay++;
    $dayOfWeek++;

    // If the week is complete, start a new row
    if ($dayOfWeek > 6) {
        echo "</tr><tr>";
        $dayOfWeek = 0;
    }
}

// Fill in the remaining cells of the last week
if ($dayOfWeek > 0) {
    for ($i = $dayOfWeek; $i < 7; $i++) {
        echo "<td></td>";
    }
}

// Close the last row and table
echo "</tr>";
echo "</table>";

$conn->close();
?>

<!-- Modal for setting availability -->
<div class="modal" id="availabilityModal" tabindex="-1" role="dialog" aria-labelledby="availabilityModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="availabilityModalLabel">Set Availability</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="availabilityForm">
            <div class="form-group">
                <label for="availability">Availability:</label>
                <select class="form-control" id="availability" name="availability">
                    <option value="Available">Available</option>
                    <option value="N/A">Not Available</option>
                </select>
            </div>
            <div class="form-group">
                <label for="available_time">Available Time (e.g., 10:00 AM - 4:00 PM):</label>
                <input type="text" class="form-control" id="available_time" name="available_time" placeholder="Enter time range">
            </div>
            <input type="hidden" id="date" name="date">
            <button type="submit" class="btn btn-primary">Save Availability</button>
        </form>
      </div>
    </div>
  </div>
</div>

<script>
function showModal(cell) {
    var date = cell.getAttribute('data-date');
    document.getElementById('date').value = date;
    $('#availabilityModal').modal('show');
}

document.getElementById('availabilityForm').addEventListener('submit', function (e) {
    e.preventDefault();

    var date = document.getElementById('date').value;
    var availability = document.getElementById('availability').value;
    var availableTime = document.getElementById('available_time').value;

    var xhr = new XMLHttpRequest();
    xhr.open("POST", "UpdateAvailabilitySched.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            alert("Availability updated successfully!");
            location.reload();  // Reload to reflect the changes
        }
    };
    xhr.send("date=" + date + "&availability=" + availability + "&available_time=" + availableTime + "&doctor_id=<?php echo $loggedInDoctorId; ?>");
});
</script>

<!-- Include Bootstrap & jQuery for Modal functionality -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>



    
    </div>
</div>
</div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">    <!--new -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        function toggleNav() {
            var sideNav = document.getElementById("mySidenav");
            var mainContent = document.getElementById("mainContent");

            if (sideNav.classList.contains('side-nav-hidden')) {
                sideNav.classList.remove('side-nav-hidden');
                mainContent.classList.remove('main-content-expanded');
            } else {
                sideNav.classList.add('side-nav-hidden');
                mainContent.classList.add('main-content-expanded');
            }
        }
        function toggleUserMenu(event) {
            const userMenu = document.getElementById('user-menu');
            // Prevent the click event from bubbling to the window
            event.stopPropagation(); 
            
            // Toggle the display of the user menu
            userMenu.style.display = userMenu.style.display === 'block' ? 'none' : 'block';
        }

        function showNotifications() {
            // Function to show notifications (implement as needed)
            alert("Notifications clicked!");
        }

        // Hide the user menu if clicking outside of it
        window.onclick = function(event) {
            const userMenu = document.getElementById('user-menu');
            if (!event.target.matches('.user-icon') && !event.target.matches('#user-menu')) {
                if (userMenu.style.display === 'block') {
                    userMenu.style.display = 'none';
                }
            }
        }

    </script>
     <script>
        function logout() {
            if (confirm("Are you sure you want to log out?")) {
                fetch('gaslogout.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({ action: 'logout' })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        window.location.href = '/OUTPATIENT/index.php'; // Redirect to login page
                    } else {
                        alert(data.error); // Show error message
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                });
            }
        }
    </script>
</body>
</html>
