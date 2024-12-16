
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appointments List for <?php echo htmlspecialchars($specialty); ?></title>
    <link rel="stylesheet" href="outpatient.css">
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome for icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
</head>

<style>
    body {
        background-color: #f4f6f6;
    }
        /* Create the flashing red circle */
    .flashing-signal {
        width: 15px;
        height: 15px;
        border-radius: 50%;
        background-color: red;
        animation: flash 1s infinite;
        box-shadow: 0 0 5px rgba(255, 0, 0, 0.8);
    }

    /* Define the keyframes for the flashing animation */
    @keyframes flash {
        0% { opacity: 1; }
        50% { opacity: 0.5; }
        100% { opacity: 1; }
    }
        .notif-modal {
    display: none; /* Hidden by default */
    position: fixed;
    z-index: 1000; /* Sit on top */
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    overflow: auto; /* Enable scroll if needed */
    background-color: rgba(0,0,0,0.4); /* Black background with opacity */
}

/* Modal Content */
.notif-modal-content {
    background-color: #fefefe;
    margin: 15% auto; /* 15% from the top and centered */
    padding: 20px;
    border: 1px solid #888;
    width: 80%; /* Could be more or less, depending on screen size */
    max-width: 600px;
    border-radius: 10px;
    position: relative;
}

/* Close Button */
.notif-modal-close {
    color: #aaa;
    float: right;
    font-size: 28px;
    font-weight: bold;
}

.notif-modal-close:hover,
.notif-modal-close:focus {
    color: black;
    text-decoration: none;
    cursor: pointer;
}

/* Table Styling */
#history-table {
    width: 100%;
    border-collapse: collapse;
}

#history-table th, #history-table td {
    border: 1px solid #ddd;
    padding: 8px;
}

#history-table th {
    background-color: #34495e;
    color: white;
    text-align: center;
}

#history-table td {
    text-align: center;
}
/* Modal Styling */
.modal {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.7);
    z-index: 9999;
    animation: fadeIn 0.3s ease;
    align-items: center;
    justify-content: center;
}

/* Modal content */
.modal-content {
    background-color: #fff;
    padding: 30px;
    width: 400px;
    border-radius: 8px;
    text-align: center;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    animation: slideIn 0.3s ease;
}

/* Title of the Modal */
.modal-content h3 {
    font-size: 24px;
    margin-bottom: 20px;
    color: #333;
}

/* Close button */
.close-btn {
    position: absolute;
    top: 10px;
    right: 10px;
    font-size: 20px;
    color: #999;
    cursor: pointer;
    transition: color 0.2s ease;
}

.close-btn:hover {
    color: #333;
}

/* Form elements */
select, button {
    width: 100%;
    padding: 10px;
    margin: 10px 0;
    border: 1px solid #ccc;
    border-radius: 5px;
    font-size: 16px;
}

button {
    background-color: #f4d03f;
    color: #fff;
    border: none;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

button:hover {
    background-color: #f1c40f;
}

/* Fade-in Animation */
@keyframes fadeIn {
    from {
        opacity: 0;
    }
    to {
        opacity: 1;
    }
}

/* Slide-in Animation */
@keyframes slideIn {
    from {
        transform: translateY(-50px);
    }
    to {
        transform: translateY(0);
    }
}
/* Default status button styling */
.status-btn {
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    font-size: 16px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

/* Green for Approved */
.status-btn.approved {
    background-color: #28a745;
    color: white;
}

/* Blue for Reschedule */
.status-btn.reschedule {
    background-color: #007bff;
    color: white;
}

/* Red for Decline */
.status-btn.decline {
    background-color: #dc3545;
    color: white;
}

/* Button Hover Effects */
.status-btn:hover {
    opacity: 0.9;
}
.pagination {
    display: flex;
    justify-content: flex-start;
    align-items: center;
    margin-top: 20px;
}

.pagination-btn {
    padding: 8px 15px;
    background-color: #f1f1f1;
    border: 1px solid #ddd;
    border-radius: 4px;
    cursor: pointer;
    margin-right: 10px; /* Adds spacing between buttons */
}

.page-info {
    padding: 8px 15px;
}

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
        <a class="nav-link" href="DoctorsDashboard.php">
            <div class="sb-nav-link-content">
                <div class="sb-nav-link-icon"><i class="fas fa-home"></i></div>
                <span>𝖣𝖺𝗌𝗁𝖻𝗈𝖺𝗋𝖽</span>
            </div>
        </a>
        <a class="nav-link" href="PatientAppointmentlist.php">
            <div class="sb-nav-link-content">
                <div class="sb-nav-link-icon"><i class="fas fa-user"></i></div>
                <span>𝖯𝖺𝗍𝗂𝖾𝗇𝗍 𝖫𝗂𝗌𝗍</span>
            </div>
        </a>
         <a class="nav-link" href="AppointmentsSchedule.php">
            <div class="sb-nav-link-content">
                <div class="sb-nav-link-icon"><i class="fas fa-user"></i></div>
                <span>Schedule</span>
            </div>
        </a>
    </div>
    <!-- Main Content -->
    <div id="mainContent" class="main-content">
       <div class="header-container">
    <h3>𝖯𝖺𝗍𝗂𝖾𝗇𝗍  𝖫𝗂𝗌𝗍</h3>
<div class="haha">
    <p style="text-align: center;">
        <a href="InventoryDashboard1.php" style="text-decoration: none; color: inherit;">
            <i class="fas fa-home" style="color: #34495e;"></i> Home
        </a>
        <span style="margin: 0 10px;">›</span>
        𝖯𝖺𝗍𝗂𝖾𝗇𝗍  𝖫𝗂𝗌𝗍
    </p>
</div>
</div>
<div class="first1" style="opacity: 0.9; border-top: 2px solid #b2babb; margin-top: -20px;"></div><br>


    
<?php
require_once('../connection/dbconfig.php'); 


// Get specialty of the logged-in doctor (e.g., Cardiology)
$specialty = 'Cardiology'; // Change this to dynamically fetch from session if needed

// Initialize search term
$searchTerm = '';
if (isset($_POST['search'])) {
    $searchTerm = $_POST['search'];
}

// SQL query to join appointments with doctors based on specialty and filter by patient name
$query = "
    SELECT a.appointment_id, a.doctor_id, a.first_name, a.middle_initial, a.last_name, a.first_visit, a.appointment_date, a.reason_for_visit, a.status,
           d.name AS doctor_name
    FROM appointments AS a
    JOIN doctors AS d ON a.doctor_id = d.doctor_id
    WHERE d.specialties = ?
    AND (a.first_name LIKE ? OR a.last_name LIKE ?)
";

$stmt = $conn->prepare($query);
$searchParam = '%' . $searchTerm . '%';
$stmt->bind_param("sss", $specialty, $searchParam, $searchParam);
$stmt->execute();
$result = $stmt->get_result();
?>

<div class="card-wrapper">
    <div class="card" style="box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.8); border: 1px solid #808b96;">
        <div class="card-header" style="background-color: #DCC7AA;">
            <h2 style="color: green;">𝖯𝖺𝗍𝗂𝖾𝗇𝗍 𝖫𝗂𝗌𝗍 𝖿𝗈𝗋 <?php echo htmlspecialchars($specialty); ?></h2>
        </div>

        <!-- Search Form -->
        <div class="search-form" style="padding: 10px; background-color: #f7f7f7;">
    <form method="post" action="" style="display: flex; align-items: center;">
        <input type="text" name="search" placeholder="Search by Patient Name" value="<?php echo htmlspecialchars($searchTerm); ?>" style="padding: 5px; margin-right: 10px; width: 80%;">
        <button type="submit" style="padding: 5px 10px; background-color: green; color: white; border: none; width: 20%; margin-right: 50%;">Search ⌕</button>
    </form>
</div>


        <div class="card-body">
            <table style="width: 100%; border-collapse: collapse; border: 1px solid #DCC7AA;">
                <tr style="background-color: #f4f4f4;">
                    <th>Doctor Name</th>
                    <th>Patient Name</th>
                    <th>First Visit</th>
                    <th>Appointment Date</th>
                    <th>Reason for Visit</th>
                </tr>

               <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {


                        echo "<tr>
                                <td>Dr. {$row['doctor_name']}</td>
                                <td>{$row['first_name']} {$row['middle_initial']} {$row['last_name']}</td>
                                <td>" . ($row['first_visit'] == 1 ? 'Yes' : 'No') . "</td>
                                <td>{$row['appointment_date']}</td>
                                <td>{$row['reason_for_visit']}</td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='8'>No appointments found for {$specialty}.</td></tr>";
                }
                ?>
            </table>
            
            <!-- Pagination Section -->
            <div class="pagination">
                <span class="pagination-btn" id="prevBtn">Previous</span>
                <span class="page-info" id="pageInfo">Page 1 of 1</span>
                <span class="pagination-btn" id="nextBtn">Next</span>
            </div>
        </div>
    </div>
</div>



<script>
// Initializing the current page
let currentPage = 1;
const totalPages = 1; // Change this based on your data (total number of pages)

// Update page info
function updatePageInfo() {
    document.getElementById('pageInfo').innerText = `Page ${currentPage} of ${totalPages}`;
}

// Handle Previous Button Click
document.getElementById('prevBtn').addEventListener('click', function() {
    if (currentPage > 1) {
        currentPage--;
        updatePageInfo();
        loadPageData(currentPage); // Add your logic to fetch page data (AJAX or PHP)
    }
});

// Handle Next Button Click
document.getElementById('nextBtn').addEventListener('click', function() {
    if (currentPage < totalPages) {
        currentPage++;
        updatePageInfo();
        loadPageData(currentPage); // Add your logic to fetch page data (AJAX or PHP)
    }
});

// Simulated function to load page data
function loadPageData(page) {
    // Add your code here to load the data for the specified page
    console.log("Loading data for page " + page);
}

// Initial page load
updatePageInfo();

</script>

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

<?php
// Close the database connection
$stmt->close();
$conn->close();
?>