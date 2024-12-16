<?php
require_once('../connection/dbconfig.php'); 


// Pagination variables
$results_per_page = 11; // number of rows per page
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1; // get the current page number, default to 1
$start_from = ($page - 1) * $results_per_page;

// Adjusted query to include LIMIT for pagination
$search = isset($_GET['search']) ? $_GET['search'] : ''; // get search term if provided
$search_query = $search ? " WHERE patient_name LIKE '%$search%'" : ''; // Only search in 'patient_name'
$query = "SELECT * FROM er_patient $search_query LIMIT $start_from, $results_per_page";
$results = mysqli_query($conn, $query);

// Check if query executed successfully
if (!$results) {
    die("Query failed: " . mysqli_error($conn));
}

// Calculate total pages
$total_query = "SELECT COUNT(*) AS total FROM er_patient $search_query";
$total_result = mysqli_query($conn, $total_query);
$total_row = mysqli_fetch_assoc($total_result);
$total_pages = ceil($total_row['total'] / $results_per_page);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dropdown Example</title>
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
     tr:nth-child(even) {
        background-color: #D6EEEE;
    }
    .button-container form {
        display: inline-block;
        margin-right: 10px;
    }
    body {
        background-color: #E5E7E9;
    }
    td {
        text-align: center;
    }

    /* Search form styling */
    .search-form {
        float: right;
        margin-bottom: 10px;
    }
    .search-form input[type="text"] {
        width: 200px;
        border-radius: 20px;
        padding: 5px 15px;
        border: 1px solid #ced4da;
        font-size: 14px;
    }
    .search-form button {
        background-color: #3498db;
        color: white;
        border: none;
        border-radius: 20px;
        padding: 5px 15px;
        cursor: pointer;
    }
    .search-form button:hover {
        background-color: #2980b9;
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

    <!-- Right-aligned notification and user icons -->
    <div class="icon-group">
        <div class="user-icon" onclick="toggleUserMenu(event)">
            <i class="fas fa-user"></i> <!-- Font Awesome user icon -->
        </div>
    </div>
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
<a class="nav-link" href="Erdashboard.php">
            <div class="sb-nav-link-content">
                <div class="sb-nav-link-icon"><i class="fas fa-home"></i></div>
                <span>𝖣𝖺𝗌𝗁𝖻𝗈𝖺𝗋𝖽</span>
            </div>
        </a>

        <a class="nav-link" href="NurseAdd.php">
            <div class="sb-nav-link-content">
                <div class="sb-nav-link-icon"><i class="fas fa-user"></i></div>
                <span>𝖠𝖽𝖽 𝖯𝖺𝗍𝗂𝖾𝗇t</span>
            </div>
        </a>
        <a class="nav-link" href="Nurselist.php">
            <div class="sb-nav-link-content">
                <div class="sb-nav-link-icon"><i class="fas fa-receipt"></i></div>
                <span>𝖫𝗂𝗌𝗍 𝗈𝖿 𝖯𝖺𝗍𝗂𝖾𝗇𝗍𝗌</span>
            </div>
        </a>
    </div>
    <!-- Main Content -->
    <div id="mainContent" class="main-content">
       <div class="header-container">
    <h3>𝖫𝗂𝗌𝗍 𝗈𝖿 𝖯𝖺𝗍𝗂𝖾𝗇𝗍𝗌</h3>
<div class="haha">
    <p style="text-align: center;">
        <a href="InventoryDashboard1.php" style="text-decoration: none; color: inherit;">
            <i class="fas fa-home" style="color: #34495e;"></i> Home
        </a>
        <span style="margin: 0 10px;">›</span>
        𝖫𝗂𝗌𝗍 𝗈𝖿 𝖯𝖺𝗍𝗂𝖾𝗇𝗍𝗌
    </p>
</div>


</div>
<div class="first1" style="opacity: 0.9; border-top: 2px solid #b2babb; margin-top: -20px;"></div>
</div>


<div id="mainContent" class="main-content" style="margin-top: -80px;">
    <div id="layoutSidenav_content">
        <main>
            <div class="card mb-4">
                <div class="card-header" style="height: 20%;">
                    <i class="fas fa-table me-1" style="font-size: 25px; color:#1abc9c;"> 𝖯𝖺𝗍𝗂𝖾𝗇𝗍𝗌 𝖱𝖾𝖼𝗈𝗋𝖽 𝖳𝖺𝖻𝗅𝖾</i>
                    <form class="search-form" action="" method="get">
                        <input type="text" name="search" placeholder="Search Patients..." value="<?php echo htmlspecialchars($search); ?>" aria-label="Search">
                        <button type="submit"><i class="fas fa-search"></i></button>
                    </form>
                </div>
                <div class="card-body">
                    <table id="datatablesSimple">
                        <thead>
                            <tr>
        <th>ER Patient No.</th>
        <th>Patient Name</th>
        <th>Age</th>
        <th>Gender</th>
        <th>Contact No.</th>
        <th>Address</th>
        <th>Admission Date</th>
        <th>Condition Summary</th>
        <th>Attending Nurse</th>
        <th>Actions</th>
    </tr>
</thead>
<tbody>
    <?php while ($row = mysqli_fetch_array($results)) { ?>
        <tr>
            <td>#<?php echo $row['id']; ?></td> <!-- ER Patient No. -->
            <td><?php echo $row['patient_name']; ?></td> <!-- Patient Name -->
            <td><?php echo $row['age']; ?></td> <!-- Age -->
            <td><?php echo $row['gender']; ?></td> <!-- Gender -->
            <td><?php echo $row['contact_number']; ?></td> <!-- Contact No. -->
            <td><?php echo $row['address']; ?></td> <!-- Address -->
            <td><?php echo $row['admission_date']; ?></td> <!-- Admission Date -->
            <td><?php echo $row['condition_summary']; ?></td> <!-- Condition Summary -->
            <td><?php echo $row['attending_doctor']; ?></td> <!-- Attending Doctor -->
            <td>
                <!-- Buttons Side by Side -->
                <div class="d-flex justify-content-start">
                    <!-- Edit Button (Triggers Modal) -->
                    <button type="button" class="btn btn-primary btn-sm me-2" data-bs-toggle="modal" data-bs-target="#editModal<?php echo $row['id']; ?>">
                        Edit
                    </button>

                    <!-- View Button -->
                    <form method="get" action="NurseView.php"> <!-- Updated to ERPatientView.php -->
                        <input type="hidden" name="id" value="<?php echo $row['id']; ?>"> <!-- ER Patient ID -->
                        <button type="submit" class="btn btn-info btn-sm" style="margin-left: 3px;">View</button>
                    </form>
                </div>
            </td>

                                </tr>

                            <!-- Edit Modal -->
<div class="modal fade" id="editModal<?php echo $row['id']; ?>" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit ER Patient Information</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Edit Form -->
                <form method="POST" action="NurseSave.php">
                    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="patient_name" class="form-label">Patient Name</label>
                            <input type="text" name="patient_name" class="form-control" value="<?php echo $row['patient_name']; ?>" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="age" class="form-label">Age</label>
                            <input type="number" name="age" class="form-control" value="<?php echo $row['age']; ?>" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="gender" class="form-label">Gender</label>
                            <select name="gender" class="form-select" required>
                                <option value="Male" <?php echo ($row['gender'] == 'Male') ? 'selected' : ''; ?>>Male</option>
                                <option value="Female" <?php echo ($row['gender'] == 'Female') ? 'selected' : ''; ?>>Female</option>
                                <option value="Other" <?php echo ($row['gender'] == 'Other') ? 'selected' : ''; ?>>Other</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="contact_number" class="form-label">Contact Number</label>
                            <input type="text" name="contact_number" class="form-control" value="<?php echo $row['contact_number']; ?>">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="address" class="form-label">Address</label>
                            <input type="text" name="address" class="form-control" value="<?php echo $row['address']; ?>">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="admission_date" class="form-label">Admission Date</label>
                            <input type="datetime-local" name="admission_date" class="form-control" value="<?php echo date('Y-m-d\TH:i', strtotime($row['admission_date'])); ?>" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="condition_summary" class="form-label">Condition Summary</label>
                            <textarea name="condition_summary" class="form-control"><?php echo $row['condition_summary']; ?></textarea>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="attending_doctor" class="form-label">Attending Nurse</label>
                            <input type="text" name="attending_doctor" class="form-control" value="<?php echo $row['attending_doctor']; ?>">
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


                            <?php } ?>
                        </tbody>
                    </table>
                </div>

                <!-- Pagination Controls -->
                <div class="pagination-controls" style="margin-left: 20px;">
                    <?php if ($page > 1): ?>
                        <a href="?page=<?php echo $page - 1; ?>&search=<?php echo urlencode($search); ?>" class="btn btn-outline-primary">Previous</a>
                    <?php endif; ?>

                    <span>Page <?php echo $page; ?> of <?php echo $total_pages; ?></span>

                    <?php if ($page < $total_pages): ?>
                        <a href="?page=<?php echo $page + 1; ?>&search=<?php echo urlencode($search); ?>" class="btn btn-outline-primary">Next</a>
                    <?php endif; ?>
                </div>
                <br>
            </div>
        </main>
    </div>
</div>

<!-- Scripts -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<!-- Your existing JavaScript functions -->
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
                fetch('wardslogout.php', {
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
