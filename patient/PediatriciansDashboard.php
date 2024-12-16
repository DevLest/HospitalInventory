<?php
session_name('PediatriciansSession');  // Ensure session name matches the one set during login
session_start();  // Start session
require_once('../connection/dbconfig.php'); 

// Check if the user is logged in and is a Pediatricians doctor
if (!isset($_SESSION['doctor_id']) || $_SESSION['specialties'] != 'Pediatricians') {
    // Redirect to login if the user is not a Pediatricians doctor or not logged in
    header("Location: login.php?error=Access denied. Please log in as a Pediatricians doctor.");
    exit();
}

// Your Pediatricians-specific content goes here
echo "Welcome, Dr. " . $_SESSION['name'] . " (Pediatricians Specialist)";
?>
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
        <a class="nav-link" href="PediatriciansDashboard.php">
            <div class="sb-nav-link-content">
                <div class="sb-nav-link-icon"><i class="fas fa-home"></i></div>
                <span>𝖣𝖺𝗌𝗁𝖻𝗈𝖺𝗋𝖽</span>
            </div>
        </a>
        <a class="nav-link" href="PediatriciansList.php">
            <div class="sb-nav-link-content">
                <div class="sb-nav-link-icon"><i class="fas fa-user"></i></div>
                <span>𝖯𝖺𝗍𝗂𝖾𝗇𝗍 𝖫𝗂𝗌𝗍</span>
            </div>
        </a>
        <a class="nav-link" href="PediatriciansSchedule.php">
            <div class="sb-nav-link-content">
                <div class="sb-nav-link-icon"><i class="fas fa-user"></i></div>
                <span>Schedule</span>
            </div>
        </a>
    </div>
    <!-- Main Content -->
    <div id="mainContent" class="main-content">
       <div class="header-container">
    <h3>𝖣𝖺𝗌𝗁𝖻𝗈𝖺𝗋𝖽</h3>
    <h1 style="font-size: 100%; color: black; margin-right: 1%">Doctor Name: <span class="red-text"><?php echo $_SESSION['name']; ?></span> , '<?php echo $_SESSION['specialties']; ?>' Expert</h1>
<div class="haha">
    <p style="text-align: center;">
        <a href="InventoryDashboard1.php" style="text-decoration: none; color: inherit;">
            <i class="fas fa-home" style="color: #34495e;"></i> Home
        </a>
        <span style="margin: 0 10px;">›</span>
        𝖣𝖺𝗌𝗁𝖻𝗈𝖺𝗋𝖽
    </p>
</div>
</div>
<div class="first1" style="opacity: 0.9; border-top: 2px solid #b2babb; margin-top: -20px;"></div><br>

    
    <!-- Box Section with Bootstrap's grid system -->
    <div class="row"> <!-- Use row class to create a horizontal group of columns -->
       <div class="col-xl-3 col-md-6">
        <div class="card text-white mb-4" style="background-color: #DCC7AA; opacity: 0.9; box-shadow: 0 2px 5px rgba(0, 0, 0, 1.9);" >
            <div class="card-body" style="color: green; font-weight: bold; font-size: 22px;">Appointment Today</div>
             <?php
                require_once('../connection/dbconfig.php'); 

                // Define the specialty you want to filter by (e.g., Pediatricians)
                $specialty = 'Pediatricians';  // Example specialty

                // Query to fetch all appointments for doctors with the "Pediatricians" specialty
                $dash_category_query = "
                    SELECT a.*, d.doctor_id, d.name AS doctor_name 
                    FROM appointments a
                    JOIN doctors d ON a.doctor_id = d.doctor_id
                    WHERE d.specialties = '$specialty'
                ";

                $dash_category_query_run = mysqli_query($conn, $dash_category_query);

                if ($appointments_total = mysqli_num_rows($dash_category_query_run)) {
                    echo '<h4 class="mb-0" style="color: black; margin-left: 5%; z-index: 2; font-size: 25px; position: relative;">' . $appointments_total . ' <i class="fas fa-calendar-day" style="color: black;"></i></h4>';
                    
                   
                } else {
                    echo '<h4 class="mb-0" style="z-index: 2; position: relative;">No Data for Pediatricians</h4>';
                }

                ?>

    </div>
</div>


        <!-- Repeat for other three columns -->
        <div class="col-xl-3 col-md-6">
        <div class="card text-white mb-4" style="background-color: #DCC7AA; opacity: 0.9; box-shadow: 0 2px 5px rgba(0, 0, 0, 1.9);" >
            <div class="card-body" style="color: green; font-weight: bold; font-size: 22px;">Appointment Pending</div>
        
        <?php
            require_once('../connection/dbconfig.php'); 


            // Define the specialty you want to filter by (e.g., Pediatricians)
            $specialty = 'Pediatricians';  // Example specialty

            // Query to fetch all pending appointments for doctors with the "Pediatricians" specialty
            $pending_appointments_query = "
                SELECT COUNT(a.appointment_id) AS pending_count 
                FROM appointments a
                JOIN doctors d ON a.doctor_id = d.doctor_id
                WHERE d.specialties = '$specialty' 
                AND a.status = 'Pending'
            ";

            $pending_appointments_query_run = mysqli_query($conn, $pending_appointments_query);

            if ($pending_appointments_query_run) {
                // Fetch the count of pending appointments
                $row = mysqli_fetch_assoc($pending_appointments_query_run);
                $pending_appointments_total = $row['pending_count'];  // Get the count of pending appointments

                if ($pending_appointments_total > 0) {
                    echo '<h4 class="mb-0" style="color: black; margin-left: 5%; z-index: 2; font-size: 25px; position: relative;">
                            ' . $pending_appointments_total . ' <i class="fas fa-calendar-hourglass" style="color: black;"></i>
                          </h4>';
                } else {
                    echo '<h4 class="mb-0" style="z-index: 2; position: relative; color: black; ">𝖭𝗈 𝖯𝖾𝗇𝖽𝗂𝗇𝗀 𝖠𝗉𝗉𝗈𝗂𝗇𝗍𝗆𝖾𝗇𝗍𝗌</h4>';
                }
            } 

            ?>

    </div>
</div>

      <div class="col-xl-3 col-md-6">
        <div class="card text-white mb-4" style="background-color: #DCC7AA; opacity: 0.9; box-shadow: 0 2px 5px rgba(0, 0, 0, 1.9);">
            <div class="card-body" style="color: green; font-weight: bold; font-size: 22px;">Appointment Complete</div>

       <?php
            require_once('../connection/dbconfig.php'); 


            // Define the specialty you want to filter by (e.g., Pediatricians)
            $specialty = 'Pediatricians';  // Example specialty

            // Query to fetch all approved appointments for doctors with the "Pediatricians" specialty
            $approved_appointments_query = "
                SELECT COUNT(a.appointment_id) AS approved_count 
                FROM appointments a
                JOIN doctors d ON a.doctor_id = d.doctor_id
                WHERE d.specialties = '$specialty' 
                AND a.status = 'Approved'
            ";

            $approved_appointments_query_run = mysqli_query($conn, $approved_appointments_query);

            if ($approved_appointments_query_run) {
                // Fetch the count of approved appointments
                $row = mysqli_fetch_assoc($approved_appointments_query_run);
                $approved_appointments_total = $row['approved_count'];  // Get the count of approved appointments

                if ($approved_appointments_total > 0) {
                    echo '<h4 class="mb-0" style="color: black; margin-left: 5%; z-index: 2; font-size: 25px; position: relative;">
                            ' . $approved_appointments_total . '  <i class="fas fa-calendar-check" style="color: black;"></i>
                          </h4>';
                } else {
                    echo '<h4 class="mb-0" style="z-index: 2; position: relative;">𝖭𝗈 𝖠𝗉𝗉𝗋𝗈𝗏𝖾𝖽 𝖠𝗉𝗉𝗈𝗂𝗇𝗍𝗆𝖾𝗇𝗍𝗌</h4>';
                }
            } else {
                echo '<h4 class="mb-0" style="z-index: 2; position: relative;">Error fetching data</h4>';
            }

            ?>


    </div>
</div>

       <div class="col-xl-3 col-md-6">
        <div class="card text-white mb-4" style="background-color: #DCC7AA; opacity: 0.9; box-shadow: 0 2px 5px rgba(0, 0, 0, 1.9);">
            <div class="card-body" style="color: green; font-weight: bold; font-size: 22px;">Total Appointments</div>

       <?php
            require_once('../connection/dbconfig.php'); 

            // Define the specialty you want to filter by (e.g., Pediatricians)
            $specialty = 'Pediatricians';  // Example specialty

            // Query to fetch the total number of appointments for doctors with the "Pediatricians" specialty
            $total_appointments_query = "
                SELECT COUNT(a.appointment_id) AS total_appointments 
                FROM appointments a
                JOIN doctors d ON a.doctor_id = d.doctor_id
                WHERE d.specialties = '$specialty'
            ";

            $total_appointments_query_run = mysqli_query($conn, $total_appointments_query);

            if ($total_appointments_query_run) {
                // Fetch the count of total appointments
                $row = mysqli_fetch_assoc($total_appointments_query_run);
                $total_appointments = $row['total_appointments'];  // Get the total number of appointments

                if ($total_appointments > 0) {
                    echo '<h4 class="mb-0" style="color: black; margin-left: 5%; z-index: 2; font-size: 25px; position: relative;">
                            ' . $total_appointments . ' <i class="fas fa-calendar-day" style="color: black;"></i>
                          </h4>';
                } else {
                    echo '<h4 class="mb-0" style="z-index: 2; position: relative;">𝖭𝗈 𝖠𝗉𝗉𝗈𝗂𝗇𝗍𝗆𝖾𝗇𝗍𝗌</h4>';
                }
            } else {
                echo '<h4 class="mb-0" style="z-index: 2; position: relative;">Error fetching data</h4>';
            }

            ?>

    </div>
</div>

</div>
<div class="first1" style="opacity: 0.9; border-top: 2px solid #b2babb;"></div><br>
<?php
require_once('../connection/dbconfig.php'); 



// Ensure the user is logged in and is a Pediatricians doctor
if (!isset($_SESSION['doctor_id']) || $_SESSION['specialties'] != 'Pediatricians') {
    header("Location: login.php?error=Access denied. Please log in as a Pediatricians doctor.");
    exit();
}

// Get the logged-in doctor's ID
$doctorId = $_SESSION['doctor_id'];

// SQL query to get appointments for the logged-in doctor
$query = "
    SELECT a.appointment_id, a.doctor_id, a.first_name, a.middle_initial, a.last_name, a.first_visit, 
           a.appointment_date, a.reason_for_visit, a.status,
           d.name AS doctor_name
    FROM appointments AS a
    JOIN doctors AS d ON a.doctor_id = d.doctor_id
    WHERE a.doctor_id = ?
";

$stmt = $conn->prepare($query);
$stmt->bind_param("i", $doctorId); // Use the logged-in doctor's ID
$stmt->execute();
$result = $stmt->get_result();
?>

<div class="card-wrapper">
    <div class="card" style="box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.8); border: 1px solid #808b96;">
        <div class="card-header" style="background-color: #DCC7AA;">
            <h2 style="color: green;">𝖠𝗉𝗉𝗈𝗂𝗇𝗍𝗆𝖾𝗇𝗍𝗌 𝖫𝗂𝗌𝗍</h2>
        </div>

        <div class="card-body">
            <table>
                <tr>
                    <th>Doctor Name</th>
                    <th>Patient Name</th>
                    <th>Appointment Date</th>
                    <th>Reason for Visit</th>
                    <th>Status</th>
                </tr>

                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $statusColor = '';
                        if ($row['status'] == 'Approved') {
                            $statusColor = 'green';
                        } elseif ($row['status'] == 'Decline') {
                            $statusColor = 'red';
                        } elseif ($row['status'] == 'Reschedule') {
                            $statusColor = 'blue';
                        }


                        echo "<tr>
                                <td>Dr. {$row['doctor_name']}</td>
                                <td>{$row['first_name']} {$row['last_name']}</td>
                                <td>{$row['appointment_date']}</td>
                                <td>{$row['reason_for_visit']}</td>
                                <td>
                                    <button onclick=\"showOptions({$row['appointment_id']})\" class='status-btn' style='background-color: {$statusColor}; color: white;'>{$row['status']}</button>
                                </td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='6'>No appointments found for Dr. {$_SESSION['name']}.</td></tr>";
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

        <!-- Options Modal -->
        <div id="optionsModal" class="modal">
            <div class="modal-content">
                <span class="close-btn" onclick="closeModal()">&times;</span>
                <h3>Update Appointment Status</h3>
                <form id="statusForm">
                    <input type="hidden" id="appointmentId" name="appointment_id">
                    <label for="statusSelect">Select Status:</label>
                    <select id="statusSelect" name="status" onchange="updateStatusButton()">
                        <option value="Approved">Approve</option>
                        <option value="Reschedule">Reschedule</option>
                        <option value="Decline">Decline</option>
                    </select>
                    <button type="button" onclick="updateStatus()" class="submit-btn">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>



<script>
// Show the modal
function showOptions(appointmentId) {
    document.getElementById("appointmentId").value = appointmentId;
    document.getElementById("optionsModal").style.display = "flex";
}

// Close the modal
function closeModal() {
    document.getElementById("optionsModal").style.display = "none";
}

// Update the status button color based on selection
function updateStatusButton() {
    const status = document.getElementById('statusSelect').value;
    const statusBtn = document.querySelector('.submit-btn');

    // Reset all button classes
    statusBtn.classList.remove('approved', 'reschedule', 'decline');

    // Add class based on selected status
    if (status === 'Approved') {
        statusBtn.classList.add('approved');
        statusBtn.textContent = 'Approve';
        statusBtn.style.backgroundColor = 'green';
    } else if (status === 'Reschedule') {
        statusBtn.classList.add('reschedule');
        statusBtn.textContent = 'Reschedule';
        statusBtn.style.backgroundColor = 'blue';
    } else if (status === 'Decline') {
        statusBtn.classList.add('decline');
        statusBtn.textContent = 'Decline';
        statusBtn.style.backgroundColor = 'red';
    }
}

// AJAX to update status in the database
function updateStatus() {
    const appointmentId = document.getElementById("appointmentId").value;
    const status = document.getElementById("statusSelect").value;

    const xhr = new XMLHttpRequest();
    xhr.open("POST", "StatusUpdate.php", true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            alert(xhr.responseText);
            location.reload(); // Reload page to reflect updated status
        }
    };
    xhr.send("appointment_id=" + appointmentId + "&status=" + status);

    // Hide modal after submission
    closeModal();
}
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