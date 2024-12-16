<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dropdown Example</title>
    <link rel="stylesheet" href="Med.css">
     <link rel="stylesheet" href="Receipt.css">
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome for icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
</head>

<style>
    body {
        background-color: #f4f6f6;
    }
    /* Add to your CSS */
td img {
    width: 50px;
    height: 50px;
    object-fit: cover;
}
    /* Remove underline and set text color to black for the user link */
.user-link {
    text-decoration: none;  /* Removes the underline */
    color: black;           /* Sets the color to black */
}

/* Optionally, you can change the color when the link is hovered over */
.user-link:hover {
    color: black;           /* Ensures the color remains black when hovered */
    text-decoration: none;  /* Keeps the link underline removed on hover */
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
         <a class="nav-link" href="ChiefAdmin.php">
            <div class="sb-nav-link-content">
                <div class="sb-nav-link-icon"><i class="fas fa-home"></i></div>
                <span>𝖣𝖺𝗌𝗁𝖻𝗈𝖺𝗋𝖽</span>
            </div>
        </a>

        <!-- Medicines Section -->
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseMedicines" aria-expanded="false" aria-controls="collapseMedicines">
            <div class="sb-nav-link-content">
                <div class="sb-nav-link-icon"><i class="fas fa-handshake"></i></div>
                <span> 𝖬𝖾𝖽𝗂𝖼𝗂𝗇𝖾𝗌</span>
                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-right"></i></div>
            </div>
        </a>
        <div class="collapse" id="collapseMedicines">
            <nav class="sb-sidenav-menu-nested nav">
                <a class="nav-link" href="PharmacyMedicine.php" style="width: 100%;">◽ Add Medicines</a>
                <a class="nav-link" href="PharmacyMedicineList.php" style="width: 100%;">◽ Medicines List</a>
            </nav>
        </div>

        <!-- Products Section -->
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseProducts" aria-expanded="false" aria-controls="collapseProducts">
            <div class="sb-nav-link-content">
                <div class="sb-nav-link-icon"><i class="fas fa-box"></i></div>
                <span> 𝖯𝗋𝗈𝖽𝗎𝖼𝗍</span>
                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-right"></i></div>
            </div>
        </a>
        <div class="collapse" id="collapseProducts">
            <nav class="sb-sidenav-menu-nested nav">
                <a class="nav-link" href="PharmacyProduct.php" style="width: 100%;">◽ Add Products</a>
                <a class="nav-link" href="PharmacyProductList.php" style="width: 100%;">◽ Products List</a>
            </nav>
        </div>
        <!-- Patients Section -->
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePatients" aria-expanded="false" aria-controls="collapsePatients">
            <div class="sb-nav-link-content">
                <div class="sb-nav-link-icon"><i class="fas fa-box"></i></div>
                <span>Patients</span>
                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-right"></i></div>
            </div>
        </a>
        <div class="collapse" id="collapsePatients">
            <nav class="sb-sidenav-menu-nested nav">
                <a class="nav-link" href="PatientAdd.php" style="width: 100%;">◽ Add Patient</a>
                <a class="nav-link" href="PatientList.php" style="width: 100%;">◽ Patient List</a>
            </nav>
        </div>
        <a class="nav-link" href="ManageUser.php">
            <div class="sb-nav-link-content">
                <div class="sb-nav-link-icon"><i class="fas fa-user"></i></div>
                <span>𝖬𝖺𝗇𝖺𝗀𝖾 𝖴𝗌𝖾𝗋𝗌</span>
            </div>
        </a>
        <a class="nav-link" href="Receipt.php">
            <div class="sb-nav-link-content">
                <div class="sb-nav-link-icon"><i class="fas fa-receipt"></i></div>
                <span>𝖱𝖾𝖼𝖾𝗂𝗉𝗍𝗌</span>
            </div>
        </a>
        <a class="nav-link" href="Reports.php">
            <div class="sb-nav-link-content">
                <div class="sb-nav-link-icon"><i class="fas fa-file-alt report-icon" title="Generate Report"></i></div>
                <span>𝖱𝖾𝗉𝗈𝗋𝗍𝗌</span>
            </div>
        </a>
    </div>

 <?php
require_once('../connection/dbconfig.php'); 


// Fetch user data
$query = "SELECT * FROM users"; // Modify as needed for your specific needs
$result = $conn->query($query);
?>   
   <div id="mainContent" class="main-content">
       <div class="header-container">
    <h3>𝖬𝖺𝗇𝖺𝗀𝖾 𝖴𝗌𝖾𝗋</h3>
<div class="haha">
    <p style="text-align: center;">
        <a href="InventoryDashboard1.php" style="text-decoration: none; color: inherit;">
            <i class="fas fa-home" style="color: #34495e;"></i> Home
        </a>
        <span style="margin: 0 10px;">›</span>
        𝖬𝖺𝗇𝖺𝗀𝖾 𝖴𝗌𝖾𝗋
    </p>
</div>
</div>
        <div class="first1" style="opacity: 0.9; border-top: 2px solid #b2babb; margin-top: -20px;"></div>

<!-- Table of Users -->
<?php
require_once('../connection/dbconfig.php'); 


// Set pagination and search parameters
$itemsPerPage = 6;
$currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($currentPage - 1) * $itemsPerPage;
$searchQuery = isset($_GET['search']) ? $_GET['search'] : '';

// SQL query to fetch user data with search functionality
$sql = "SELECT * FROM users WHERE username LIKE ? LIMIT ?, ?";
$stmt = $conn->prepare($sql);
$searchTerm = "%" . $searchQuery . "%";
$stmt->bind_param("sii", $searchTerm, $offset, $itemsPerPage);
$stmt->execute();
$userResults = $stmt->get_result();

// Total user count for pagination
$totalCountQuery = "SELECT COUNT(*) as total FROM users WHERE username LIKE ?";
$totalCountStmt = $conn->prepare($totalCountQuery);
$totalCountStmt->bind_param("s", $searchTerm);
$totalCountStmt->execute();
$totalCountResult = $totalCountStmt->get_result();
$totalUsers = $totalCountResult->fetch_assoc()['total'];
$totalPages = ceil($totalUsers / $itemsPerPage);
?><br>
        <!-- Buttons -->
            <button class="btn btn-primary" data-toggle="modal" data-target="#addUserModal">
                <i class="fas fa-plus"></i> Add User
            </button>
            <button class="btn btn-primary" data-toggle="modal" data-target="#addDoctorModal">
                <i class="fas fa-plus"></i> Add Doctor
            </button>
            <button class="btn btn-primary" data-toggle="modal" data-target="#addChiefAdminModal">
                <i class="fas fa-plus"></i> Add Chief Admin
            </button>


<!-- Add Doctor Modal -->
<div class="modal fade" id="addDoctorModal" tabindex="-1" role="dialog" aria-labelledby="addDoctorModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header" style="background-color: #34495e; color: white;">
                <h5 class="modal-title" id="addDoctorModalLabel">Add Doctor</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            
            <!-- Modal Body -->
            <div class="modal-body">
                <form method="POST" action="add_doctor.php" enctype="multipart/form-data">
                    <div class="row">
                        <!-- Left Column -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name"><strong>Doctor's Name:</strong></label>
                                <input type="text" class="form-control" name="name" id="name" placeholder="Enter full name" required>
                            </div>
                            <div class="form-group">
                                <label for="email"><strong>Email:</strong></label>
                                <input type="email" class="form-control" name="email" id="email" placeholder="Enter email address" required>
                            </div>
                            <div class="form-group">
                                <label for="clinic_address"><strong>Clinic Address:</strong></label>
                                <textarea class="form-control" name="clinic_address" id="clinic_address" rows="3" placeholder="Enter clinic address" required></textarea>
                            </div>
                            <div class="form-group">
                                <label for="contact_number"><strong>Contact Number:</strong></label>
                                <input type="text" class="form-control" name="contact_number" id="contact_number" placeholder="Enter contact number" required>
                            </div>
                        </div>
                        
                        <!-- Right Column -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="specialties"><strong>Specialties:</strong></label>
                                <input type="text" class="form-control" name="specialties" id="specialties" placeholder="e.g., Cardiology, Pediatrics" required>
                            </div>
                            <div class="form-group">
                                <label for="username"><strong>Username:</strong></label>
                                <input type="text" class="form-control" name="username" id="username" placeholder="Enter username" required>
                            </div>
                            <div class="form-group">
                                <label for="password"><strong>Password:</strong></label>
                                <input type="password" class="form-control" name="password" id="password" placeholder="Enter password" required>
                            </div>
                            <div class="form-group">
                                <label for="license"><strong>License:</strong></label>
                                <input type="text" class="form-control" name="license" id="license" placeholder="Enter license number" required>
                            </div>
                        </div>
                    </div>

                    <!-- Image Upload -->
                    <div class="form-group">
                        <label for="image"><strong>Upload Image:</strong></label>
                        <input type="file" class="form-control-file" name="image" id="image" accept="image/*">
                    </div>

                    <!-- Submit Button -->
                    <div class="text-center mt-3">
                        <button type="submit" class="btn btn-success btn-lg">
                            <i class="fas fa-user-md"></i> Add Doctor
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>





<div class="card mt-4">
    <div class="card-header d-flex justify-content-between align-items-center" style="background-color: #34495e;">
        <h5 class="mb-0" style="color: white;"><i class="fas fa-user" style="color: white;"></i> User Information</h5>
        <form method="GET" action="" class="form-inline d-flex" style="margin-right: 60%;">
            <input type="text" name="search" class="form-control mr-2" placeholder="Search by username" value="<?php echo htmlspecialchars($searchQuery); ?>">
            <button type="submit" class="btn btn-primary">Search</button>
        </form>
    </div>

    <div class="card-body">
        <table class="table table-bordered">
            <thead class="thead-light">
                <tr>
                    <th>#</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Shift</th>
                    <th>Role</th>
                    <th>Registered On</th>
                    <th>Actions</th>
                </tr>
            </thead>
                <tbody>
               <?php
    if ($userResults->num_rows > 0) {
        $index = $offset + 1; // For pagination numbering
        while ($user = $userResults->fetch_assoc()) {
            // Open the table row
            echo "<tr>";
            echo "<td>{$index}</td>";
            
            // The username will trigger the modal when clicked
            echo "<td><a class='user-link' data-toggle='modal' data-target='#userModal' 
                        data-username='{$user['username']}' 
                        data-email='{$user['email']}' 
                        data-shift='{$user['shift']}' 
                        data-role='{$user['role']}' 
                        data-created-at='{$user['created_at']}' 
                        data-image='{$user['profile_image']}'>
                        {$user['username']}</a></td>";

            // The rest of the table columns are unchanged
            echo "<td>{$user['email']}</td>";
            echo "<td>{$user['shift']}</td>";
            echo "<td>{$user['role']}</td>";
            echo "<td>{$user['created_at']}</td>";

            // Edit and Delete buttons (with modal triggers)
            echo "<td>
                    <button class='btn btn-warning btn-sm' data-toggle='modal' data-target='#editModal{$user['id']}'>Edit</button>
                    <button class='btn btn-danger btn-sm' data-toggle='modal' data-target='#deleteModal{$user['id']}'>Delete</button>
                  </td>";
            echo "</tr>";

            // Modal for editing
echo "<div class='modal fade' id='editModal{$user['id']}' tabindex='-1' role='dialog' aria-labelledby='editModalLabel' aria-hidden='true'>
        <div class='modal-dialog' role='document'>
            <div class='modal-content'>
                <div class='modal-header'>
                    <h5 class='modal-title' id='editModalLabel'>Edit User</h5>
                    <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                        <span aria-hidden='true'>&times;</span>
                    </button>
                </div>
                <div class='modal-body'>
                    <form action='useredit.php' method='POST' enctype='multipart/form-data'>
                        <input type='hidden' name='user_id' value='{$user['id']}'>
                        
                        <div class='form-group'>
                            <label for='username'>Username</label>
                            <input type='text' name='username' value='{$user['username']}' class='form-control' required>
                        </div>

                        <div class='form-group'>
                            <label for='email'>Email</label>
                            <input type='email' name='email' value='{$user['email']}' class='form-control' required>
                        </div>

                        <div class='form-group'>
                            <label for='shift'>Shift</label>
                            <select name='shift' class='form-control' required>
                                <option value='Day : 6:00 am - 12:00 pm' " . ($user['shift'] == 'Day : 6:00 am - 12:00 pm' ? 'selected' : '') . ">Day : 6:00 am - 12:00 pm</option>
                                <option value='Day: 12:00 pm - 6:00 pm' " . ($user['shift'] == 'Day: 12:00 pm - 6:00 pm' ? 'selected' : '') . ">Day: 12:00 pm - 6:00 pm</option>
                                <option value='Night: 6:00 pm - 12:00 am' " . ($user['shift'] == 'Night: 6:00 pm - 12:00 am' ? 'selected' : '') . ">Night: 6:00 pm - 12:00 am</option>
                                <option value='Night: 12:00 am - 6:00 am' " . ($user['shift'] == 'Night: 12:00 am - 6:00 am' ? 'selected' : '') . ">Night: 12:00 am - 6:00 am</option>
                            </select>
                        </div>
                        <button type='submit' class='btn btn-primary'>Save Changes</button>
                    </form>
                </div>
            </div>
        </div>
      </div>";

            // Modal for deleting
            echo "<div class='modal fade' id='deleteModal{$user['id']}' tabindex='-1' role='dialog' aria-labelledby='deleteModalLabel' aria-hidden='true'>
                    <div class='modal-dialog' role='document'>
                        <div class='modal-content'>
                            <div class='modal-header'>
                                <h5 class='modal-title' id='deleteModalLabel'>Delete User</h5>
                                <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                                    <span aria-hidden='true'>&times;</span>
                                </button>
                            </div>
                            <div class='modal-body'>
                                <p>Are you sure you want to delete this user?</p>
                                <form action='userdelete.php' method='POST'>
                                    <input type='hidden' name='user_id' value='{$user['id']}'>
                                    <button type='submit' class='btn btn-danger'>Delete</button>
                                    <button type='button' class='btn btn-secondary' data-dismiss='modal'>Cancel</button>
                                </form>
                            </div>
                        </div>
                    </div>
                  </div>";

            $index++;
        }
    } else {
        echo "<tr><td colspan='7' class='text-center'>No users found.</td></tr>";
    }
    ?>

    </tbody>
        </table>

        <!-- Pagination controls -->
        <nav aria-label="Page navigation">
            <ul class="pagination justify-content-center">
                <li class="page-item <?php if ($currentPage <= 1) echo 'disabled'; ?>">
                    <a class="page-link" href="?page=<?php echo $currentPage - 1; ?>&search=<?php echo urlencode($searchQuery); ?>" aria-label="Previous">Previous</a>
                </li>
                <li class="page-item disabled">
                    <span class="page-link">Page <?php echo $currentPage; ?> of <?php echo $totalPages; ?></span>
                </li>
                <li class="page-item <?php if ($currentPage >= $totalPages) echo 'disabled'; ?>">
                    <a class="page-link" href="?page=<?php echo $currentPage + 1; ?>&search=<?php echo urlencode($searchQuery); ?>" aria-label="Next">Next</a>
                </li>
            </ul>
        </nav>
    </div>
</div><br>
<div class="first1" style="opacity: 0.9; border-top: 2px solid #b2babb;"></div>


<?php
require_once('../connection/dbconfig.php'); 

// Fetch search term and pagination parameters
$search = isset($_GET['search']) ? mysqli_real_escape_string($conn, $_GET['search']) : '';
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$perPage = 10; // Number of records per page
$offset = ($page - 1) * $perPage;

// Fetch total count for pagination
$totalQuery = "SELECT COUNT(*) as total FROM doctors WHERE name LIKE '%$search%'";
$totalResult = mysqli_query($conn, $totalQuery);
$totalRow = mysqli_fetch_assoc($totalResult);
$total = $totalRow['total'];
$totalPages = ceil($total / $perPage);

// Fetch filtered doctors for the current page
$query = "SELECT * FROM doctors WHERE name LIKE '%$search%' LIMIT $offset, $perPage";
$result = mysqli_query($conn, $query);
?>
 <div class="container mt-5">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center" style="background-color: #34495e;">
            <h5 class="mb-0" style="color: white;"><i class="fas fa-user-md" style="color: white;"></i> List of Doctors</h5>
            <form class="d-flex" action="" method="GET">
                <input style="margin-right: 20px; "  type="text" name="search" class="form-control me-2" placeholder="Search by name" value="<?php echo htmlspecialchars($search); ?>">
                <button type="submit" class="btn btn-primary">Search</button>
            </form>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead class="thead-light">
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>License</th>
                        <th>Clinic Address</th>
                        <th>Contact Number</th>
                        <th>Specialties</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (mysqli_num_rows($result) > 0) {
                        $index = $offset + 1;
                        while ($doctor = mysqli_fetch_assoc($result)) {
                            // Get the image path (assuming the 'image' column stores just the file name)
                            $imagePath = !empty($doctor['image']) ? 'uploads/' . $doctor['image'] : 'uploads/default.jpg'; // default image if no image

                            echo "<tr>";
                            echo "<td>Dr. {$doctor['name']}</td>";
                            echo "<td>{$doctor['email']}</td>";
                            echo "<td>{$doctor['license']}</td>";
                            echo "<td>{$doctor['clinic_address']}</td>";
                            echo "<td>{$doctor['contact_number']}</td>";
                            echo "<td>{$doctor['specialties']}</td>";
                            echo "</tr>";
                            $index++;
                        }
                    } else {
                        echo "<tr><td colspan='7' class='text-center'>No doctors found.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
                <!-- Pagination -->
                <div class="d-flex justify-content-start align-items-center">
                    <nav>
                        <ul class="pagination">
                            <li class="page-item <?php if ($page <= 1) echo 'disabled'; ?>">
                                <a class="page-link" href="?search=<?php echo $search; ?>&page=<?php echo $page - 1; ?>">Previous</a>
                            </li>
                            <li class="page-item disabled">
                                <span class="page-link">Page <?php echo $page; ?> of <?php echo $totalPages; ?></span>
                            </li>
                            <li class="page-item <?php if ($page >= $totalPages) echo 'disabled'; ?>">
                                <a class="page-link" href="?search=<?php echo $search; ?>&page=<?php echo $page + 1; ?>">Next</a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div><br>

    
<div class="modal fade" id="addChiefAdminModal" tabindex="-1" role="dialog" aria-labelledby="addChiefAdminModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addChiefAdminModalLabel">Add Chief Admin</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Add Chief Admin Form -->
                <form id="addChiefAdminForm" method="POST" action="add_chief_admin.php">
                    <div class="form-group">
                        <label for="chiefAdminName">Name</label>
                        <input type="text" class="form-control" id="chiefAdminName" name="name" placeholder="Enter name" required>
                    </div>
                    <div class="form-group">
                        <label for="chiefAdminUsername">Username</label>
                        <input type="text" class="form-control" id="chiefAdminUsername" name="username" placeholder="Enter username" required>
                    </div>
                    <div class="form-group">
                        <label for="chiefAdminPassword">Password</label>
                        <input type="password" class="form-control" id="chiefAdminPassword" name="password" placeholder="Enter password" required>
                    </div>
                    <div class="form-group">
                        <label for="chiefAdminEmail">Email</label>
                        <input type="email" class="form-control" id="chiefAdminEmail" name="email" placeholder="Enter email" required>
                    </div>
                    <div class="form-group">
                        <label for="chiefAdminLicense">Chief License</label>
                        <input type="text" class="form-control" id="chiefAdminLicense" name="chief_license" placeholder="Enter license" required>
                    </div>
                    <div class="form-group">
                        <label for="chiefAdminContactNumber">Contact Number</label>
                        <input type="text" class="form-control" id="chiefAdminContactNumber" name="contact_number" placeholder="Enter contact number" required>
                    </div>
                    <div class="form-group">
                        <label for="chiefAdminAddress">Address</label>
                        <textarea class="form-control" id="chiefAdminAddress" name="address" placeholder="Enter address" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary mt-3">Add Chief Admin</button>
                </form>
            </div>
        </div>
    </div>
</div>


<div class="first1" style="opacity: 0.9; border-top: 2px solid #b2babb;"></div>

<!-- User Modal -->
<div class="modal fade" id="userModal" tabindex="-1" role="dialog" aria-labelledby="userModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document" style="width: 30%;">
        <div class="modal-content" style="border: 2px solid #808b96;">
            <div class="modal-header">
                <h5 class="modal-title" id="userModalLabel">User Information</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-center">
                <img id="userImage" src="" alt="User Image" class="img-fluid rounded-circle border-black mb-3" style="width: 20%; height: 20%; border-color: black;">
                <h6 id="modalUsername" class="font-weight-bold mb-2"></h6>

                <!-- Role and Shift below Username -->
                <div class="mt-2 mb-3">
                    <span class="badge badge-secondary" id="modalShift" style="margin-right:270px;"></span>
                    <span class="badge badge-primary" id="modalRole" style="margin-right: 30px;"></span>
                </div>

                <p id="modalEmail" class="text-muted"></p>
                <p class="mt-3"><strong id="modalCreatedAt"></strong></p>
            </div>
        </div>
    </div>
</div>

    </div>

    <!-- Add User Modal -->
<div class="modal fade" id="addUserModal" tabindex="-1" role="dialog" aria-labelledby="addUserModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addUserModalLabel">Add User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="AddUser.php" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" class="form-control" id="username" name="username" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email Address</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="shift">Shift</label>
                        <select class="form-control" id="shift" name="shift">
                            <option value="Day : 7:00 am - 5:00 pm">Day : 7:00 am - 5:00 pm</option>
                            <option value="Day : 7:00 pm - 5:00 am">Day : 7:00 pm - 5:00 am</option>
                            <option value="Day : 6:00 am - 12:00 pm">Day : 6:00 am - 12:00 pm</option>
                            <option value="Day: 12:00 pm - 6:00 pm">Day: 12:00 pm - 6:00 pm</option>
                            <option value="Night: 6:00 pm - 12:00 am">Night: 6:00 pm - 12:00 am</option>
                            <option value="Night: 12:00 am - 6:00 am">Night: 12:00 am - 6:00 am</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="role">Role</label>
                        <select class="form-control" id="role" name="role" required>
                            <option value="Pharmacy Staff">Pharmacy Staff</option>
                            <option value="Pharmacy Cashier">Pharmacy Cashier</option>
                            <option value="Pharmacy Admin">Pharmacy Admin</option>
                            <option value="Wards">Wards</option>
                            <option value="Er Nurse">Er Nurse</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="userImage">Upload Image</label>
                        <input type="file" class="form-control-file" id="userImage" name="userImage" accept="image/*" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save User</button>
                </div>
            </form>
        </div>
    </div>

</div>


    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
     <script>
        function logout() {
            if (confirm("Are you sure you want to log out?")) {
                fetch('logout.php', {
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
       // Show the logout modal
            function showLogoutModal() {
                document.getElementById('logoutModal').style.display = 'block';
            }

            // Close the modal
            function closeModal() {
                document.getElementById('logoutModal').style.display = 'none';
            }

            // Confirm and trigger logout
            function confirmLogout() {
                window.location.href = 'logout.php'; // Redirect to logout.php to handle the logout process
            }

    </script>
    <!-- JavaScript to handle the modal data population -->
<script>
    $('#userModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget); // Button that triggered the modal
    var username = button.data('username');
    var email = button.data('email');
    var shift = button.data('shift');
    var role = button.data('role');
    var createdAt = button.data('created-at');
    var image = button.data('image');

    // Update the modal's content
    var modal = $(this);
    modal.find('#modalUsername').text(username);
    modal.find('#modalEmail').text(email);
    modal.find('#modalShift').text("Shift: " + shift);
    modal.find('#modalRole').text("Role: " + role);
    modal.find('#modalCreatedAt').text("Registered On: " + createdAt);
    modal.find('#userImage').attr('src', image);
});

</script>
<script>
        function logout() {
            if (confirm("Are you sure you want to log out?")) {
                fetch('adminlogout.php', {
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