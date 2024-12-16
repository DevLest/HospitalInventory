<?php
session_name('PharmacyAdminSession'); // Use the session name defined for admin
session_start(); // Start the session



// Check if user is logged in
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'Pharmacy Admin') {
    header('Location: login.php?error=Access denied: Admins only');
    exit();
}

// If the user is an admin, proceed to display the dashboard content
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dropdown Example</title>
    <link rel="stylesheet" href="Admin.css">
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
</style>

<body>
<?php
// Database connection
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'database';

$con = mysqli_connect($host, $username, $password, $database);

if (!$con) {
    die('Unable to connect to the database. Check your connection parameters.');
}

// Query to fetch low stock items from both tables
$low_stock_query = "
    SELECT medicine_product AS product, remain_quantity 
    FROM pharmacy_medicines_products 
    WHERE remain_quantity < 15
    UNION ALL
    SELECT product, remaining_quantity 
    FROM pharmacy_products 
    WHERE remaining_quantity < 15
";

$low_stock_query_run = mysqli_query($con, $low_stock_query);

// Initialize an array to store low stock data and count items
$low_stock_data = [];
$total_low_stock_items = 0;

while ($row = mysqli_fetch_assoc($low_stock_query_run)) {
    $low_stock_data[] = $row; // Add each low stock item to the array
    $total_low_stock_items++;  // Count total number of low stock items
}

// Pass low stock count to JavaScript for the badge
echo '<script>var lowStockCount = ' . json_encode($total_low_stock_items) . ';</script>';

mysqli_close($con);
?>


<!-- Fixed Top Navigation -->
<div class="top-nav">

    <!-- Left-aligned logo and title -->
    <div class="icon-container">
        <img src="img/Hinigaran.png" alt="Logo">
        <h1>𝙷𝚒𝚗𝚒𝚐𝚊𝚛𝚊𝚗 𝙼𝚎𝚍𝚒𝚌𝚊𝚕 𝙲𝚕𝚒𝚗𝚒𝚌 𝙷𝚘𝚜𝚙𝚒𝚝𝚊𝚕</h1>
    </div>

    <!-- Right-aligned notification and user icons -->
    <div class="icon-group">
        <!-- Notification Icon with Count -->
        <div class="notification-icon" onclick="showNotifications()">
            <a href="#" id="notif-link" onclick="openNotifModal(event)">
                <i class="fas fa-bell" style="color: black;"></i>
                <span class="badge" id="notif-badge" style="font-size: 60%;">0</span> <!-- Notification count -->
            </a>
        </div>

        <!-- Modal for Notifications -->
        <div id="notif-modal" class="notif-modal">
            <div class="notif-modal-content">
                <span class="notif-modal-close" onclick="closeNotifModal()">&times;</span>
                <h2>𝖫𝗈𝗐 𝖲𝗍𝗈𝖼𝗄</h2>
                <table id="notif-table">
                    <thead>
                        <tr>
                            <th style="background-color: #34495e;">Medicine / Product Name</th>
                            <th style="background-color: #34495e;">Quantity</th>
                        </tr>
                    </thead>
                    <tbody id="notif-content">
                    <?php
                    // Loop through low stock data and display in the modal
                    if (!empty($low_stock_data)) {
                        foreach ($low_stock_data as $item) {
                            echo "<tr>";
                            echo "<td>" . $item['product'] . "</td>";
                            echo "<td>" . $item['remain_quantity'] . "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='2' class='text-center'>No Low Stock</td></tr>";
                    }
                    ?>
                </tbody>
                </table>
            </div>
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
        <a class="nav-link" href="InventoryDashboard1.php">
            <div class="sb-nav-link-content">
                <div class="sb-nav-link-icon"><i class="fas fa-home"></i></div>
                <span>𝖣𝖺𝗌𝗁𝖻𝗈𝖺𝗋𝖽</span>
            </div>
        </a>

        <!-- Medicines Section -->
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseMedicines" aria-expanded="false" aria-controls="collapseMedicines">
            <div class="sb-nav-link-content">
                <div class="sb-nav-link-icon"><i class="fas fa-handshake"></i></div>
                <span>𝖬𝖺𝗇𝖺𝗀𝖾 𝖬𝖾𝖽𝗂𝖼𝗂𝗇𝖾𝗌</span>
                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-right"></i></div>
            </div>
        </a>
        <div class="collapse" id="collapseMedicines">
            <nav class="sb-sidenav-menu-nested nav">
                <a class="nav-link" href="AddMed_Product.php" style="width: 100%;">◽ Add Medicines</a>
                <a class="nav-link" href="Med_List.php" style="width: 100%;">◽ Medicines List</a>
            </nav>
        </div>

        <!-- Products Section -->
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseProducts" aria-expanded="false" aria-controls="collapseProducts">
            <div class="sb-nav-link-content">
                <div class="sb-nav-link-icon"><i class="fas fa-box"></i></div>
                <span>𝖬𝖺𝗇𝖺𝗀𝖾 𝖯𝗋𝗈𝖽𝗎𝖼𝗍</span>
                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-right"></i></div>
            </div>
        </a>
        <div class="collapse" id="collapseProducts">
            <nav class="sb-sidenav-menu-nested nav">
                <a class="nav-link" href="AddProduct.php" style="width: 100%;">◽ Add Products</a>
                <a class="nav-link" href="Product_List.php" style="width: 100%;">◽ Products List</a>
            </nav>
        </div>
        <a class="nav-link" href="PharmacyUser.php">
            <div class="sb-nav-link-content">
                <div class="sb-nav-link-icon"><i class="fas fa-user"></i></div>
                <span>𝖬𝖺𝗇𝖺𝗀𝖾 𝖴𝗌𝖾𝗋𝗌</span>
            </div>
        </a>
        <a class="nav-link" href="PharmacyReceipts.php">
            <div class="sb-nav-link-content">
                <div class="sb-nav-link-icon"><i class="fas fa-receipt"></i></div>
                <span>𝖱𝖾𝖼𝖾𝗂𝗉𝗍𝗌</span>
            </div>
        </a>
        <a class="nav-link" href="PharmacyReports.php">
            <div class="sb-nav-link-content">
                <div class="sb-nav-link-icon"><i class="fas fa-file-alt report-icon" title="Generate Report"></i></div>
                <span>𝖱𝖾𝗉𝗈𝗋𝗍𝗌</span>
            </div>
        </a>
    </div>
    <!-- Main Content -->
    <div id="mainContent" class="main-content">
       <div class="header-container">
    <h3>𝖣𝖺𝗌𝗁𝖻𝗈𝖺𝗋𝖽</h3>
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

   <div class="welcome-date-container">
       
       <div class="welcome">
        <div class="profile-header">
            <p style="font-size: 80%; color: darkblue; margin: 0;">Profile</p>
        </div>
        <h1 style="font-size: 100%; color: darkblue;">Hi,👤 <?php echo $_SESSION['username']; ?></h1>
        <div class="user-role">
            You are logged in as: <span class="red-text" style="font-weight: bold;"><?php echo $_SESSION['role']; ?></span>
        </div>

    </div>

        <div class="date-time">
            <span id="currentDate" style="font-size: 140%;"></span>
            <span class="time" id="currentTime" style="font-size: 150%;"></span>
        </div>
    </div>

    <!-- Box Section with Bootstrap's grid system -->
    <div class="row"> <!-- Use row class to create a horizontal group of columns -->
       <div class="col-xl-3 col-md-6">
    <div class="card text-white mb-4" style="background-color: #DCC7AA; opacity: 0.9; box-shadow: 0 2px 5px rgba(0, 0, 0, 1.9);" >
        <div class="card-body" style="color: green; font-weight: bold; font-size: 22px;">𝖬𝖾𝖽𝗂𝖼𝗂𝗇𝖾𝗌</div>
        
        <?php
        $host = 'localhost';
        $username = 'root';
        $password = '';
        $database = 'database';

        $con = mysqli_connect($host, $username, $password, $database);

        if (!$con) {
            die('Unable to connect to the database. Check your connection parameters.');
        }

        $dash_category_query = "SELECT * from pharmacy_medicines_products";
        $dash_category_query_run = mysqli_query($con, $dash_category_query);

        if ($tblevents_total = mysqli_num_rows($dash_category_query_run)) {
            echo '<h4 class="mb-0" style="color: black; margin-left: 5%; font-size: 30px; z-index: 2; position: relative;">' . $tblevents_total . '  <i class="fas fa-capsules" style="color: black;"></i></h4>';
        } else {
            echo '<h4 class="mb-0" style="z-index: 2; position: relative;">No Data</h4>';
        }

        mysqli_close($con);
        ?>
        
        <div class="card-footer d-flex align-items-center justify-content-between" style="position: relative; z-index: 2;">
            <a href="#" class="small text-white" data-toggle="modal" data-target="#medicinesModal">View Medicines</a>
            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
        </div>
    </div>
</div>

<!-- Medicines List Modal -->
<div class="modal fade" id="medicinesModal" tabindex="-1" role="dialog" aria-labelledby="medicinesModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #DCC7AA; color: green;">
                <h5 class="modal-title" id="medicinesModalLabel">Medicines List</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Search Bar -->
                <div class="mb-3">
                    <input type="text" id="searchInput" class="form-control" placeholder="Search Medicines...">
                </div>
                
                <!-- Medicines Table -->
<table class="table table-bordered" id="medicinesTable">
    <thead>
        <tr>
            <th>Image</th>
            <th>Medicine Name</th>
            <th>Generic Name</th>
            <th>Category</th>
        </tr>
    </thead>
    <tbody>
        <?php
        // Pagination setup
        $limit = 5;  // Items per page
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $offset = ($page - 1) * $limit;

        // Reconnect to the database to fetch medicines list with pagination
        $con = mysqli_connect($host, $username, $password, $database);
        if (!$con) {
            die('Unable to connect to the database. Check your connection parameters.');
        }

        // Query to fetch medicine products with pagination
        $medicines_query = "SELECT * FROM pharmacy_medicines_products LIMIT $limit OFFSET $offset";
        $medicines_result = mysqli_query($con, $medicines_query);

        // Fetch total number of records for pagination
        $total_query = "SELECT COUNT(*) AS total FROM pharmacy_medicines_products";
        $total_result = mysqli_query($con, $total_query);
        $total_row = mysqli_fetch_assoc($total_result);
        $total_records = $total_row['total'];
        $total_pages = ceil($total_records / $limit);

        if (mysqli_num_rows($medicines_result) > 0) {
            while ($medicine = mysqli_fetch_assoc($medicines_result)) {
                // Display image with proper class and styling
                echo "<tr>
                        <td><img src='" . $medicine['image'] . "' alt='Product Image' class='img-fluid' style='max-width: 100px;'></td>
                        <td>" . $medicine['medicine_product'] . "</td>
                        <td>" . $medicine['generic_name'] . "</td>
                        <td>" . $medicine['category'] . "</td>
                      </tr>";
            }
        } else {
            echo "<tr><td colspan='4'>No medicines found</td></tr>";
        }

        mysqli_close($con);
        ?>
    </tbody>
</table>


               <!-- Pagination Controls -->
<div class="d-flex justify-content-start">
    <div class="d-flex align-items-center">
        <!-- Previous Button -->
        <?php if ($page > 1): ?>
            <a href="?page=<?= $page - 1 ?>" class="btn btn-secondary btn-sm">Previous</a>
        <?php else: ?>
            <button class="btn btn-secondary btn-sm" disabled>Previous</button>
        <?php endif; ?>

        <!-- Page Info -->
        <span class="ml-3">Page <?= $page ?> of <?= $total_pages ?></span>

        <!-- Next Button -->
        <?php if ($page < $total_pages): ?>
            <a href="?page=<?= $page + 1 ?>" class="btn btn-secondary btn-sm ml-3">Next</a>
        <?php else: ?>
            <button class="btn btn-secondary btn-sm ml-3" disabled>Next</button>
        <?php endif; ?>
    </div>
</div>

            </div>
        </div>
    </div>
</div>

<!-- JavaScript for search functionality -->
<script>
    document.getElementById('searchInput').addEventListener('input', function() {
        let filter = this.value.toUpperCase();
        let rows = document.querySelectorAll('#medicinesTable tbody tr');
        
        rows.forEach(function(row) {
            let cells = row.querySelectorAll('td');
            let match = false;
            cells.forEach(function(cell) {
                if (cell.textContent.toUpperCase().includes(filter)) {
                    match = true;
                }
            });
            row.style.display = match ? '' : 'none';
        });
    });
</script>




        <!-- Repeat for other three columns -->
        <div class="col-xl-3 col-md-6">
    <div class="card text-white mb-4" style="background-color: #F7882F; opacity: 0.9; box-shadow: 0 2px 5px rgba(0, 0, 0, 1.9);">
        <div class="card-body" style="color: green; font-weight: bold; font-size: 22px;">𝖯𝗋𝗈𝖽𝗎𝖼𝗍𝗌</div>
        
        <?php
        // Database connection parameters
        $host = 'localhost';
        $username = 'root';
        $password = '';
        $database = 'database';

        // Connect to the database
        $con = mysqli_connect($host, $username, $password, $database);

        if (!$con) {
            die('Unable to connect to the database. Check your connection parameters.');
        }

        // Query to count total number of products
        $dash_category_query = "SELECT * from pharmacy_products";
        $dash_category_query_run = mysqli_query($con, $dash_category_query);

        if ($tblevents_total = mysqli_num_rows($dash_category_query_run)) {
            echo '<h4 class="mb-0" style="color: black; margin-left: 5%; font-size: 30px; z-index: 2; position: relative;">' . $tblevents_total . ' <i class="fas fa-box" style="color: black;"></i></h4>';
        } else {
            echo '<h4 class="mb-0" style="z-index: 2; position: relative;">No Data</h4>';
        }

        // Close the database connection
        mysqli_close($con);
        ?>
        
        <div class="card-footer d-flex align-items-center justify-content-between" style="position: relative; z-index: 2;">
            <a href="#" class="small text-white" data-toggle="modal" data-target="#productsModal">View Products</a>
            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
        </div>
    </div>
</div>

<!-- Products List Modal -->
<div class="modal fade" id="productsModal" tabindex="-1" role="dialog" aria-labelledby="productsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #F7882F; color: green;">
                <h5 class="modal-title" id="productsModalLabel">Products List</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Search Bar -->
                <div class="mb-3">
                    <input type="text" id="searchInput1" class="form-control" placeholder="Search Products...">
                </div>
                
                <!-- Products Table -->
                <table class="table table-bordered" id="productsTable">
                    <thead>
                        <tr>
                            <th>Image</th>
                            <th>Product Name</th>
                            <th>Category</th>
                            <th>Price</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Pagination setup
                        $limit = 5;  // Items per page
                        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
                        $offset = ($page - 1) * $limit;

                        // Reconnect to the database to fetch products list with pagination
                        $con = mysqli_connect($host, $username, $password, $database);
                        if (!$con) {
                            die('Unable to connect to the database. Check your connection parameters.');
                        }

                        // Query to fetch product records with pagination
                        $products_query = "SELECT * FROM pharmacy_products LIMIT $limit OFFSET $offset";
                        $products_result = mysqli_query($con, $products_query);

                        // Fetch total number of records for pagination
                        $total_query = "SELECT COUNT(*) AS total FROM pharmacy_products";
                        $total_result = mysqli_query($con, $total_query);
                        $total_row = mysqli_fetch_assoc($total_result);
                        $total_records = $total_row['total'];
                        $total_pages = ceil($total_records / $limit);

                        if (mysqli_num_rows($products_result) > 0) {
                            while ($product = mysqli_fetch_assoc($products_result)) {
                                // Display product image with proper class and styling
                                echo "<tr>
                                        <td><img src='" . $product['image'] . "' alt='Product Image' class='img-fluid' style='max-width: 100px;'></td>
                                        <td>" . $product['product'] . "</td>
                                        <td>" . $product['category'] . "</td>
                                        <td>" . $product['selling_price'] . "</td>
                                      </tr>";
                            }
                        } else {
                            echo "<tr><td colspan='4'>No products found</td></tr>";
                        }

                        // Close the database connection
                        mysqli_close($con);
                        ?>
                    </tbody>
                </table>

                <!-- Pagination Controls -->
                <div class="d-flex justify-content-start">
                    <div class="d-flex align-items-center">
                        <!-- Previous Button -->
                        <?php if ($page > 1): ?>
                            <a href="?page=<?= $page - 1 ?>" class="btn btn-secondary btn-sm">Previous</a>
                        <?php else: ?>
                            <button class="btn btn-secondary btn-sm" disabled>Previous</button>
                        <?php endif; ?>

                        <!-- Page Info -->
                        <span class="ml-3">Page <?= $page ?> of <?= $total_pages ?></span>

                        <!-- Next Button -->
                        <?php if ($page < $total_pages): ?>
                            <a href="?page=<?= $page + 1 ?>" class="btn btn-secondary btn-sm ml-3">Next</a>
                        <?php else: ?>
                            <button class="btn btn-secondary btn-sm ml-3" disabled>Next</button>
                        <?php endif; ?>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<!-- JavaScript for search functionality -->
<script>
    document.getElementById('searchInput1').addEventListener('input', function() {
        let filter = this.value.toUpperCase();
        let rows = document.querySelectorAll('#productsTable tbody tr');
        
        rows.forEach(function(row) {
            let cells = row.querySelectorAll('td');
            let match = false;
            cells.forEach(function(cell) {
                // Check if any cell in the row contains the search term
                if (cell.textContent.toUpperCase().includes(filter)) {
                    match = true;
                }
            });
            // Show or hide the row based on whether there's a match
            row.style.display = match ? '' : 'none';
        });
    });
</script>



      <div class="col-xl-3 col-md-6">
    <div class="card text-white mb-4" style="background-color: #DCC7AA; opacity: 0.9; box-shadow: 0 2px 5px rgba(0, 0, 0, 1.9);">
        <div class="card-body" style="color: green; font-weight: bold; font-size: 22px;">𝖯𝗁𝖺𝗋𝗆𝖺𝖼𝗒 𝖲𝗍𝖺𝖿𝖿</div>

        <?php
        // Database connection parameters
        $host = 'localhost';
        $username = 'root';
        $password = '';
        $database = 'database';

        // Connect to the database
        $con = mysqli_connect($host, $username, $password, $database);

        if (!$con) {
            die('Unable to connect to the database. Check your connection parameters.');
        }

        // Query to count total pharmacy staff (filter only 'Pharmacy Staff' role)
        $dash_category_query = "SELECT * FROM users WHERE role = 'Pharmacy Staff'";
        $dash_category_query_run = mysqli_query($con, $dash_category_query);

        if ($tblevents_total = mysqli_num_rows($dash_category_query_run)) {
            // Displaying the number of staff
            echo '<h4 class="mb-0" style="color: black; margin-left: 5%; z-index: 2; font-size: 30px; position: relative;">' . $tblevents_total . ' <i class="fas fa-user-nurse" style="color: black;"></i></h4>';
        } else {
            // Displaying a default icon even if no staff found
            echo '<h4 class="mb-0" style="color: black; margin-left: 5%; font-size: 30px; z-index: 2; position: relative;">' . $tblevents_total . ' <i class="fas fa-user" style="color: black;"></i></h4>';
        }

        // Close the database connection
        mysqli_close($con);
        ?>

        <div class="card-footer d-flex align-items-center justify-content-between" style="position: relative; z-index: 2;">
            <a href="#" class="small text-white" data-toggle="modal" data-target="#staffModal">View Staff</a>
            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
        </div>
    </div>
</div>

<!-- Staff List Modal -->
<div class="modal fade" id="staffModal" tabindex="-1" role="dialog" aria-labelledby="staffModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #DCC7AA; color: green;">
                <h5 class="modal-title" id="staffModalLabel">Pharmacy Staff List</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Search Bar -->
                <div class="mb-3">
                    <input type="text" id="searchInput2" class="form-control" placeholder="Search Staff...">
                </div>

                <!-- Staff Table -->
                <table class="table table-bordered" id="staffTable">
                    <thead>
                        <tr>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Role</th>
                            <th>email</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Reconnect to the database to fetch staff list
                        $con = mysqli_connect($host, $username, $password, $database);
                        if (!$con) {
                            die('Unable to connect to the database. Check your connection parameters.');
                        }

                        // Pagination setup
                        $limit = 5;  // Number of records per page
                        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
                        $offset = ($page - 1) * $limit;

                        // Query to fetch staff records with pagination (only 'Pharmacy Staff' role)
                        $staff_query = "SELECT * FROM users WHERE role = 'Pharmacy Staff' LIMIT $limit OFFSET $offset";
                        $staff_result = mysqli_query($con, $staff_query);

                        if (mysqli_num_rows($staff_result) > 0) {
                            while ($staff = mysqli_fetch_assoc($staff_result)) {
                                echo "<tr>
                                        <td><img src='" . $staff['profile_image'] . "' alt='Staff Image' class='img-fluid' style='max-width: 100px;'></td>
                                        <td>" . $staff['username'] . "</td>
                                        <td>" . $staff['role'] . "</td>
                                        <td>" . $staff['email'] . "</td>
                                      </tr>";
                            }
                        } else {
                            echo "<tr><td colspan='4'>No staff members found</td></tr>";
                        }

                        // Get the total number of staff to calculate the number of pages
                        $total_staff_query = "SELECT COUNT(*) as total_staff FROM users WHERE role = 'Pharmacy Staff'";
                        $total_staff_result = mysqli_query($con, $total_staff_query);
                        $total_staff = mysqli_fetch_assoc($total_staff_result)['total_staff'];
                        $total_pages = ceil($total_staff / $limit);

                        // Close the database connection
                        mysqli_close($con);
                        ?>
                    </tbody>
                </table>

                <!-- Pagination Controls -->
                <nav aria-label="Staff Pagination">
                    <ul class="pagination justify-content-center">
                        <li class="page-item <?= $page <= 1 ? 'disabled' : ''; ?>">
                            <a class="page-link" href="?page=<?= $page - 1; ?>" tabindex="-1">Previous</a>
                        </li>
                        <li class="page-item disabled">
                            <span class="page-link">Page <?= $page; ?> of <?= $total_pages; ?></span>
                        </li>
                        <li class="page-item <?= $page >= $total_pages ? 'disabled' : ''; ?>">
                            <a class="page-link" href="?page=<?= $page + 1; ?>">Next</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</div>

<!-- JavaScript for search functionality -->
<script>
    document.getElementById('searchInput2').addEventListener('input', function() {
        let filter = this.value.toUpperCase();
        let rows = document.querySelectorAll('#staffTable tbody tr');
        
        rows.forEach(function(row) {
            let cells = row.querySelectorAll('td');
            let match = false;
            cells.forEach(function(cell) {
                if (cell.textContent.toUpperCase().includes(filter)) {
                    match = true;
                }
            });
            row.style.display = match ? '' : 'none';
        });
    });
</script>


<!-- JavaScript for search functionality -->
<script>
    document.getElementById('searchInput2').addEventListener('input', function() {
        let filter = this.value.toUpperCase();
        let rows = document.querySelectorAll('#staffTable tbody tr');
        
        rows.forEach(function(row) {
            let cells = row.querySelectorAll('td');
            let match = false;
            cells.forEach(function(cell) {
                if (cell.textContent.toUpperCase().includes(filter)) {
                    match = true;
                }
            });
            row.style.display = match ? '' : 'none';
        });
    });
</script>


       <div class="col-xl-3 col-md-6">
        <div class="card text-white mb-4" style="background-color: #F7882F; opacity: 0.9; box-shadow: 0 2px 5px rgba(0, 0, 0, 1.9);">
            <div class="card-body" style="color: green; font-weight: bold; font-size: 22px;">𝖳𝗈𝖽𝖺𝗒'𝗌 𝖲𝖺𝗅𝖾</div>

        <?php
        $host = 'localhost';
        $username = 'root';
        $password = '';
        $database = 'database';

        $con = mysqli_connect($host, $username, $password, $database);

        if (!$con) {
            die('Unable to connect to the database. Check your connection parameters.');
        }

        // Get today's date in the format 'YYYY-MM-DD'
        $today = date('Y-m-d');

        // Query to sum the total for today's receipts
        $dash_category_query = "SELECT SUM(total) AS today_total FROM receipts WHERE DATE(created_at) = '$today'";
        $dash_category_query_run = mysqli_query($con, $dash_category_query);

        // Fetch the result
        $row = mysqli_fetch_assoc($dash_category_query_run);
        $today_total = $row['today_total'] ?? 0; // Default to 0 if no records found

        // Display the total amount for today
       echo '<h4 class="mb-0" style="color: black; margin-left: 5%; z-index: 2; font-size: 30px; position: relative;"> ₱' . number_format($today_total, 2) . ' <i class="fas fa-shopping-cart" style="color: black;"></i></h4>';


        mysqli_close($con);
        ?>

        <div style=" text-decoration: ; margin-bottom: 15%;"></div>
    </div>
</div>

  <!-- Repeat for other three columns -->
       <div class="col-xl-3 col-md-6">
    <div class="card text-white mb-4" style="background-color: #F7882F; opacity: 0.9; box-shadow: 0 2px 5px rgba(0, 0, 0, 1.9);">
        <div class="card-body" style="color: green; font-weight: bold; font-size: 22px;">𝖯𝗁𝖺𝗋𝗆𝖺𝖼𝗒 𝖢𝖺𝗌𝗁𝗂𝖾𝗋</div>

        <?php
        // Database connection parameters
        $host = 'localhost';
        $username = 'root';
        $password = '';
        $database = 'database';

        // Connect to the database
        $con = mysqli_connect($host, $username, $password, $database);

        if (!$con) {
            die('Unable to connect to the database. Check your connection parameters.');
        }

        // Query to count total pharmacy cashiers (filter only 'Pharmacy Cashier' role)
        $dash_category_query = "SELECT * FROM users WHERE role = 'Pharmacy Cashier'";
        $dash_category_query_run = mysqli_query($con, $dash_category_query);

        if ($tblevents_total = mysqli_num_rows($dash_category_query_run)) {
            // Displaying the number of cashiers
            echo '<h4 class="mb-0" style="color: black; margin-left: 5%; z-index: 2; font-size: 30px; position: relative;">' . $tblevents_total . ' <i class="fas fa-cash-register" style="color: black;"></i></h4>';
        } else {
            // Displaying a default icon even if no cashiers found
            echo '<h4 class="mb-0" style="color: black; margin-left: 5%; font-size: 30px; z-index: 2; position: relative;">' . $tblevents_total . ' <i class="fas fa-user" style="color: black;"></i></h4>';
        }

        // Close the database connection
        mysqli_close($con);
        ?>

        <div class="card-footer d-flex align-items-center justify-content-between" style="position: relative; z-index: 2;">
            <a href="#" class="small text-white" data-toggle="modal" data-target="#cashierModal">View Cashiers</a>
            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
        </div>
    </div>
</div>

<!-- Cashier List Modal -->
<div class="modal fade" id="cashierModal" tabindex="-1" role="dialog" aria-labelledby="cashierModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #DCC7AA; color: green;">
                <h5 class="modal-title" id="cashierModalLabel">Pharmacy Cashier List</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Search Bar -->
                <div class="mb-3">
                    <input type="text" id="searchInput3" class="form-control" placeholder="Search Cashier...">
                </div>

                <!-- Cashier Table -->
                <table class="table table-bordered" id="cashierTable">
                    <thead>
                        <tr>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Role</th>
                            <th>Email</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Reconnect to the database to fetch cashier list
                        $con = mysqli_connect($host, $username, $password, $database);
                        if (!$con) {
                            die('Unable to connect to the database. Check your connection parameters.');
                        }

                        // Pagination setup
                        $limit = 5;  // Number of records per page
                        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
                        $offset = ($page - 1) * $limit;

                        // Query to fetch cashier records with pagination (only 'Pharmacy Cashier' role)
                        $cashier_query = "SELECT * FROM users WHERE role = 'Pharmacy Cashier' LIMIT $limit OFFSET $offset";
                        $cashier_result = mysqli_query($con, $cashier_query);

                        if (mysqli_num_rows($cashier_result) > 0) {
                            while ($cashier = mysqli_fetch_assoc($cashier_result)) {
                                echo "<tr>
                                        <td><img src='" . $cashier['profile_image'] . "' alt='Cashier Image' class='img-fluid' style='max-width: 100px;'></td>
                                        <td>" . $cashier['username'] . "</td>
                                        <td>" . $cashier['role'] . "</td>
                                        <td>" . $cashier['email'] . "</td>
                                      </tr>";
                            }
                        } else {
                            echo "<tr><td colspan='4'>No cashiers found</td></tr>";
                        }

                        // Get the total number of cashiers to calculate the number of pages
                        $total_cashiers_query = "SELECT COUNT(*) as total_cashiers FROM users WHERE role = 'Pharmacy Cashier'";
                        $total_cashiers_result = mysqli_query($con, $total_cashiers_query);
                        $total_cashiers = mysqli_fetch_assoc($total_cashiers_result)['total_cashiers'];
                        $total_pages = ceil($total_cashiers / $limit);

                        // Close the database connection
                        mysqli_close($con);
                        ?>
                    </tbody>
                </table>

                <!-- Pagination Controls -->
                <nav aria-label="Cashier Pagination">
                    <ul class="pagination justify-content-center">
                        <li class="page-item <?= $page <= 1 ? 'disabled' : ''; ?>">
                            <a class="page-link" href="?page=<?= $page - 1; ?>" tabindex="-1">Previous</a>
                        </li>
                        <li class="page-item disabled">
                            <span class="page-link">Page <?= $page; ?> of <?= $total_pages; ?></span>
                        </li>
                        <li class="page-item <?= $page >= $total_pages ? 'disabled' : ''; ?>">
                            <a class="page-link" href="?page=<?= $page + 1; ?>">Next</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</div>

<!-- JavaScript for search functionality -->
<script>
    document.getElementById('searchInput3').addEventListener('input', function() {
        let filter = this.value.toUpperCase();
        let rows = document.querySelectorAll('#cashierTable tbody tr');
        
        rows.forEach(function(row) {
            let cells = row.querySelectorAll('td');
            let match = false;
            cells.forEach(function(cell) {
                if (cell.textContent.toUpperCase().includes(filter)) {
                    match = true;
                }
            });
            row.style.display = match ? '' : 'none';
        });
    });
</script>

    <div class="col-xl-3 col-md-6">
    <div class="card text-white mb-4" style="background-color: #DCC7AA; opacity: 0.9; box-shadow: 0 2px 5px rgba(0, 0, 0, 1.9);">
       <div class="card-body" style="color: green; font-weight: bold; font-size: 22px; display: flex; justify-content: space-between; align-items: center;">
    <div>𝖤𝗑𝗉𝗂𝗋𝖾𝖽 𝖬𝖾𝖽𝗂𝖼𝗂𝗇𝖾𝗌</div>
    <div class="flashing-signal"></div>
</div>

    <?php
    // Database connection parameters
    $host = 'localhost';
    $username = 'root';
    $password = '';
    $database = 'database';

    // Create connection
    $con = mysqli_connect($host, $username, $password, $database);

    // Check connection
    if (!$con) {
        die('Unable to connect to the database. Check your connection parameters.');
    }

    // Get the current year
    $current_year = date('Y-m-d');

    // Query to fetch medicines expired this year and before
    $expired_medicines_query = "SELECT COUNT(*) AS expired_count FROM pharmacy_medicines_products WHERE expiry <= '$current_year'";
    $expired_medicines_query_run = mysqli_query($con, $expired_medicines_query);
    $expired_count = mysqli_fetch_assoc($expired_medicines_query_run)['expired_count'];

    // Display the total number of expired medicines
    if ($expired_count) {
        echo '<h4 class="mb-0" style="color: black; margin-left: 5%; z-index: 2; font-size: 30px; position: relative;">' . $expired_count . ' <i class="fas fa-exclamation-circle" style="color: black;"></i></h4>';
    } else {
        echo '<h4 class="mb-0" style="z-index: 2; position: relative;">No Expired Medicines</h4>';
    }

    // Close the connection
    mysqli_close($con);
    ?>

        <div style=" text-decoration: ; margin-bottom: 15%;"></div>
    </div>
</div>
    

<div class="col-xl-3 col-md-6">
    <div class="card text-white mb-4" style="background-color: #F7882F; opacity: 0.9; box-shadow: 0 2px 5px rgba(0, 0, 0, 1.9);">
        <div class="card-body" style="color: green; font-weight: bold; font-size: 22px;">𝖱𝖾𝖼𝖾𝗂𝗉𝗍𝗌</div>
        
        <?php
        $host = 'localhost';
        $username = 'root';
        $password = '';
        $database = 'database';

        $con = mysqli_connect($host, $username, $password, $database);

        if (!$con) {
            die('Unable to connect to the database. Check your connection parameters.');
        }

        $dash_receipt_query = "SELECT * from receipts"; // Change this to the appropriate table for receipts
        $dash_receipt_query_run = mysqli_query($con, $dash_receipt_query);

        if ($tblevents_total = mysqli_num_rows($dash_receipt_query_run)) {
            echo '<h4 class="mb-0" style="color: black; margin-left: 5%; font-size: 30px; z-index: 2; position: relative;">' . $tblevents_total . '  <i class="fas fa-receipt" style="color: black;"></i></h4>';
        } else {
            echo '<h4 class="mb-0" style="z-index: 2; position: relative;">No Receipts</h4>';
        }

        mysqli_close($con);
        ?>
        
        <div class="card-footer d-flex align-items-center justify-content-between" style="position: relative; z-index: 2;">
            <a href="#" class="small text-white" data-toggle="modal" data-target="#receiptsModal">View Receipts</a>
            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
        </div>
    </div>
</div>

<!-- Receipts List Modal -->
<div class="modal fade" id="receiptsModal" tabindex="-1" role="dialog" aria-labelledby="receiptsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #DCC7AA; color: green;">
                <h5 class="modal-title" id="receiptsModalLabel">Receipts List</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Search Bar -->
                <div class="mb-3">
                    <input type="text" id="searchInput5" class="form-control" placeholder="Search by POS Number...">
                </div>
                
                <!-- Receipts Table -->
                <table class="table table-bordered" id="receiptsTable">
                    <thead>
                        <tr>
                            <th>POS Number</th>
                            <th>Total</th>
                            <th>Paid Amount</th>
                            <th>Change Amount</th>
                            <th>Discount Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Pagination setup
                        $limit = 5;  // Items per page
                        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
                        $offset = ($page - 1) * $limit;

                        // Reconnect to the database to fetch receipts list with pagination
                        $con = mysqli_connect($host, $username, $password, $database);
                        if (!$con) {
                            die('Unable to connect to the database. Check your connection parameters.');
                        }

                        // Query to fetch receipt data with pagination
                        $receipts_query = "SELECT * FROM receipts LIMIT $limit OFFSET $offset"; // Modify to match your table name and fields
                        $receipts_result = mysqli_query($con, $receipts_query);

                        // Fetch total number of records for pagination
                        $total_query = "SELECT COUNT(*) AS total FROM receipts";
                        $total_result = mysqli_query($con, $total_query);
                        $total_row = mysqli_fetch_assoc($total_result);
                        $total_records = $total_row['total'];
                        $total_pages = ceil($total_records / $limit);

                        if (mysqli_num_rows($receipts_result) > 0) {
                            while ($receipt = mysqli_fetch_assoc($receipts_result)) {
                                echo "<tr>
                                        <td>" . $receipt['pos_number'] . "</td>
                                        <td>" . $receipt['total'] . "</td>
                                        <td>" . $receipt['paid_amount'] . "</td>
                                        <td>" . $receipt['change_amount'] . "</td>
                                        <td>" . $receipt['discount_amount'] . "</td>
                                      </tr>";
                            }
                        } else {
                            echo "<tr><td colspan='5'>No receipts found</td></tr>";
                        }

                        mysqli_close($con);
                        ?>
                    </tbody>
                </table>

                <!-- Pagination Controls -->
                <div class="d-flex justify-content-start">
                    <div class="d-flex align-items-center">
                        <!-- Previous Button -->
                        <?php if ($page > 1): ?>
                            <a href="?page=<?= $page - 1 ?>" class="btn btn-secondary btn-sm">Previous</a>
                        <?php else: ?>
                            <button class="btn btn-secondary btn-sm" disabled>Previous</button>
                        <?php endif; ?>

                        <!-- Page Info -->
                        <span class="ml-3">Page <?= $page ?> of <?= $total_pages ?></span>

                        <!-- Next Button -->
                        <?php if ($page < $total_pages): ?>
                            <a href="?page=<?= $page + 1 ?>" class="btn btn-secondary btn-sm ml-3">Next</a>
                        <?php else: ?>
                            <button class="btn btn-secondary btn-sm ml-3" disabled>Next</button>
                        <?php endif; ?>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<!-- JavaScript for search functionality -->
<script>
    document.getElementById('searchInput5').addEventListener('input', function() {
        let filter = this.value.toUpperCase();
        let rows = document.querySelectorAll('#receiptsTable tbody tr');
        
        rows.forEach(function(row) {
            let posNumberCell = row.querySelector('td:first-child'); // Get POS Number cell
            let match = false;
            if (posNumberCell && posNumberCell.textContent.toUpperCase().includes(filter)) {
                match = true;
            }
            row.style.display = match ? '' : 'none';
        });
    });
</script>


 
</div>

<div class="first1" style="opacity: 0.9; border-top: 2px solid #b2babb;"></div>
    <?php
// Database connection parameters
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'database';

// Establish the connection
$con = mysqli_connect($host, $username, $password, $database);

// Check the connection
if (!$con) {
    die('Unable to connect to the database. Check your connection parameters.');
}

// Initialize arrays to store low stock items
$low_stock_medicines = [];
$low_stock_products = [];

// Query to get low stock items from pharmacy_medicines_products where remain_quantity <= 15
$low_stock_query_medicines = "SELECT medicine_product AS product, remain_quantity AS quantity FROM pharmacy_medicines_products WHERE CAST(remain_quantity AS UNSIGNED) <= 15";
$low_stock_query_run_medicines = mysqli_query($con, $low_stock_query_medicines);

// Fetch low stock items from pharmacy_medicines_products
while ($row = mysqli_fetch_assoc($low_stock_query_run_medicines)) {
    $low_stock_medicines[] = [
        'product' => $row['product'],
        'quantity' => $row['quantity']
    ];
}

// Query to get low stock items from pharmacy_products where remaining_quantity <= 15
$low_stock_query_products = "SELECT product, remaining_quantity AS quantity FROM pharmacy_products WHERE remaining_quantity <= 15";
$low_stock_query_run_products = mysqli_query($con, $low_stock_query_products);

// Fetch low stock items from pharmacy_products
while ($row = mysqli_fetch_assoc($low_stock_query_run_products)) {
    $low_stock_products[] = [
        'product' => $row['product'],
        'quantity' => $row['quantity']
    ];
}

// Close the database connection after all queries
mysqli_close($con);
?>

<div class="container mt-5" style="border-top: blue;">
    <div class="row">
        <!-- Medicines Low Stock Table -->
        <div class="col-md-6">
            <div class="card" style="border-top-left-radius: 20px; border-top-right-radius: 20px;">
                <h3 class="text-center" style="background-color: #f2f2f2; padding: 10px; border-top-left-radius: 15px; border-top-right-radius: 15px; background-color: #34495e; color: white;">𝖬𝖾𝖽𝗂𝖼𝗂𝗇𝖾𝗌 𝖫𝗈𝗐 𝖲𝗍𝗈𝖼𝗄</h3>
                <div class="card-body">
                    <input type="text" id="searchMedicines" class="form-control mb-3" placeholder="Search Medicines">
                    <div class="table-container">
                        <table class="table table-bordered" id="medicinesTable">
                            <thead>
                                <tr>
                                    <th style="background-color: #A1D6E2; width: 40%; color:black;">Medicine Product</th>
                                    <th style="background-color: #A1D6E2; color:black;">Quantity</th>
                                    <th style="background-color: #A1D6E2; color:black;">Status</th>
                                </tr>
                            </thead>
                            <tbody id="medicinesTableBody">
                                <?php
                                $row_count = 0;
                                if (count($low_stock_medicines) > 0) {
                                    foreach ($low_stock_medicines as $item) {
                                        $status = '';
                                        if ($item['quantity'] <= 10) {
                                            $status = '<span class="out-of-stock">Out of Stock</span>';
                                        } elseif ($item['quantity'] <= 15 && $item['quantity'] >= 11) {
                                            $status = '<span class="low-stock">Low Stock</span>';
                                        }
                                        echo '<tr><td>' . $item['product'] . '</td><td>' . $item['quantity'] . '</td><td>' . $status . '</td></tr>';
                                        $row_count++;
                                    }
                                }
                                
                                // Fill empty rows if there are fewer than 6 rows
                                if ($row_count < 6) {
                                    for ($i = $row_count; $i < 6; $i++) {
                                        echo '<tr><td colspan="3" class="text-center">Empty</td></tr>';
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                    <nav>
                        <ul class="pagination justify-content-center" id="medicinesPagination">
                            <li class="page-item" id="medicinesPrev"><a class="page-link" href="#">Previous</a></li>
                            <li class="page-item disabled"><a class="page-link" id="medicinesPageInfo"></a></li>
                            <li class="page-item" id="medicinesNext"><a class="page-link" href="#">Next</a></li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>

        <!-- Products Low Stock Table -->
        <div class="col-md-6">
            <div class="card" style="border-top-left-radius: 20px; border-top-right-radius: 20px;">
                <h3 class="text-center" style="background-color: #f2f2f2; padding: 10px; border-top-left-radius: 15px; border-top-right-radius: 15px; background-color: #34495e; color: white;">𝖯𝗋𝗈𝖽𝗎𝖼𝗍𝗌 𝖫𝗈𝗐 𝖲𝗍𝗈𝖼𝗄</h3>
                <div class="card-body">
                    <input type="text" id="searchProducts" class="form-control mb-3" placeholder="Search Products">
                    <div class="table-container">
                        <table class="table table-bordered" id="productsTable">
                            <thead>
                                <tr>
                                    <th style="background-color: #A1D6E2; #A1D6E2; width: 40%; color:black;">Product</th>
                                    <th style="background-color: #A1D6E2; color:black;">Quantity</th>
                                    <th style="background-color: #A1D6E2; color:black;">Status</th>
                                </tr>
                            </thead>
                            <tbody id="productsTableBody">
                                <?php
                                $row_count = 0;
                                if (count($low_stock_products) > 0) {
                                    foreach ($low_stock_products as $item) {
                                        $status = '';
                                        if ($item['quantity'] <= 10) {
                                            $status = '<span class="out-of-stock">Out of Stock</span>';
                                        } elseif ($item['quantity'] <= 15 && $item['quantity'] >= 11) {
                                            $status = '<span class="low-stock">Low Stock</span>';
                                        }
                                        echo '<tr><td>' . $item['product'] . '</td><td>' . $item['quantity'] . '</td><td>' . $status . '</td></tr>';
                                        $row_count++;
                                    }
                                }
                                
                                // Fill empty rows if there are fewer than 6 rows
                                if ($row_count < 6) {
                                    for ($i = $row_count; $i < 6; $i++) {
                                        echo '<tr><td colspan="3" class="text-center">Empty</td></tr>';
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                    <nav>
                        <ul class="pagination justify-content-center" id="productsPagination">
                            <li class="page-item" id="productsPrev"><a class="page-link" href="#">Previous</a></li>
                            <li class="page-item disabled"><a class="page-link" id="productsPageInfo"></a></li>
                            <li class="page-item" id="productsNext"><a class="page-link" href="#">Next</a></li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
// PHP code to fetch monthly sales data
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'database';

$con = mysqli_connect($host, $username, $password, $database);

if (!$con) {
    die('Unable to connect to the database. Check your connection parameters.');
}

// Query to get total sales grouped by month
$sales_query = "SELECT SUM(total) AS monthly_total, MONTH(created_at) AS month FROM receipts WHERE YEAR(created_at) = YEAR(CURDATE()) GROUP BY MONTH(created_at)";
$sales_query_run = mysqli_query($con, $sales_query);

// Initialize an array to store monthly sales
$sales_data = array_fill(0, 12, 0); // Default 12 months with 0 sales

while ($row = mysqli_fetch_assoc($sales_query_run)) {
    $month = (int)$row['month'];
    $sales_data[$month - 1] = $row['monthly_total'];
}

// Query to fetch expired medicines from the current year
$expiry_query = "SELECT medicine_product, expiry FROM pharmacy_medicines_products WHERE YEAR(expiry) = YEAR(CURDATE()) AND expiry < CURDATE()";
$expiry_query_run = mysqli_query($con, $expiry_query);

// Initialize an array to store expired medicines
$expired_medicines = [];
while ($row = mysqli_fetch_assoc($expiry_query_run)) {
    $expired_medicines[] = $row;
}

// Pass the sales data as a JSON array to JavaScript
echo '<script>var monthlySales = ' . json_encode($sales_data) . ';</script>';

mysqli_close($con);
?>
<div class="container mt-5">
    <div class="row">
        <!-- Monthly Sales Performance Chart -->
        <div class="col-md-6">
            <div class="card" style="border-top-left-radius: 20px; border-top-right-radius: 20px;">
                 <h2 class="text-center" style="background-color: #34495e; color: white; padding: 10px; border-top-left-radius: 15px; border-top-right-radius: 15px;">𝖬𝗈𝗇𝗍𝗁𝗅𝗒 𝖲𝖺𝗅𝖾𝗌 𝖯𝖾𝗋𝖿𝗈𝗋𝗆𝖺𝗇𝖼𝖾</h2>
                <div class="card-body">
                    <canvas id="salesChart" width="30" height="29"></canvas>
                </div>
            </div>
        </div>

        <!-- Expiry Medicines Table -->
        <div class="col-md-6">
            <div class="card" style="border-top-left-radius: 20px; border-top-right-radius: 20px;">
                <h3 class="text-center" style="background-color: #34495e; color: white; padding: 10px; border-top-left-radius: 15px; border-top-right-radius: 15px;">𝖤𝗑𝗉𝗂𝗋𝗂𝗇𝗀 𝖬𝖾𝖽𝗂𝖼𝗂𝗇𝖾𝗌</h3>
                <div class="card-body">
                    <input type="text" id="searchExpired" class="form-control mb-3" placeholder="Search Expired Medicines">
                    <div class="table-container">
                        <table class="table table-bordered">
                            <thead style="background-color: #00A5E0; color: white;">
                                <tr>
                                    <th style="background-color: #A1D6E2; #A1D6E2; width: 40%; color: black;">Medicine Product</th>
                                    <th style="background-color: #A1D6E2; #A1D6E2; color: black;">Expiry Date</th>
                                    <th style="background-color: #A1D6E2; #A1D6E2; color:black;">Status</th>
                                </tr>
                            </thead>
                            <tbody id="expiryTableBody">
                                <?php if (count($expired_medicines) > 0): ?>
                                    <?php foreach ($expired_medicines as $item): ?>
                                        <tr>
                                            <td><?php echo $item['medicine_product']; ?></td>
                                            <td><?php echo date('Y-m-d', strtotime($item['expiry'])); ?></td>
                                            <td><span class="expired">Expired</span></td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="3" class="text-center">No Expired Medicines</td>
                                    </tr>
                                <?php endif; ?>
                                <!-- Ensure the table has exactly 6 rows -->
                                <?php for ($i = count($expired_medicines); $i < 6; $i++): ?>
                                    <tr>
                                        <td colspan="3" class="text-center">Empty</td>
                                    </tr>
                                <?php endfor; ?>
                            </tbody>
                        </table>
                    </div>
                    <nav>
                        <ul class="pagination justify-content-center" id="expiryPagination">
                            <li class="page-item" id="expiryPrev"><a class="page-link" href="#">Previous</a></li>
                            <li class="page-item disabled"><a class="page-link" id="expiryPageInfo"></a></li>
                            <li class="page-item" id="expiryNext"><a class="page-link" href="#">Next</a></li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
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
        // Function to display current date and time
        function updateDateTime() {
            const date = new Date();
            const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
            const formattedDate = date.toLocaleDateString('en-US', options);
            const formattedTime = date.toLocaleTimeString('en-US', { hour: '2-digit', minute: '2-digit' });

            document.getElementById('currentDate').innerText = formattedDate;
            document.getElementById('currentTime').innerText = formattedTime;
        }

        // Call the updateDateTime function every second
        setInterval(updateDateTime, 1000);
        // Initial call to set date and time immediately on page load
        updateDateTime();
    </script>
      <script>
        // Labels for the months
        var months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];

        // Use Chart.js to create the line chart
        var ctx = document.getElementById('salesChart').getContext('2d');
        var salesChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: months,  // X-axis labels (Months)
                datasets: [{
                    label: 'Monthly Sales Overview',
                    data: monthlySales,  // Y-axis data (Sales totals)
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',  // Line fill color
                    borderColor: 'rgba(75, 192, 192, 1)',        // Line border color
                    borderWidth: 2
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
        <script>
    document.addEventListener("DOMContentLoaded", function() {
    const searchInput = document.getElementById('searchExpired');
    const tableBody = document.getElementById('expiryTableBody');
    const paginationInfo = document.getElementById('expiryPageInfo');
    const rows = tableBody.getElementsByTagName('tr');
    const rowsPerPage = 6; // Fixed to 6 rows
    let currentPage = 1;

    function displayRows(page) {
        const start = (page - 1) * rowsPerPage;
        const end = start + rowsPerPage;
        let displayedRows = 0;

        for (let i = 0; i < rows.length; i++) {
            if (i >= start && i < end) {
                rows[i].style.display = "";
                displayedRows++;
            } else {
                rows[i].style.display = "none";
            }
        }

        paginationInfo.innerText = `Page ${page} of ${Math.ceil(rows.length / rowsPerPage)}`;
        document.getElementById('expiryPrev').classList.toggle('disabled', page === 1);
        document.getElementById('expiryNext').classList.toggle('disabled', displayedRows < rowsPerPage);
    }

    document.getElementById('expiryPrev').onclick = function() {
        if (currentPage > 1) {
            currentPage--;
            displayRows(currentPage);
        }
    };

    document.getElementById('expiryNext').onclick = function() {
        if (currentPage < Math.ceil(rows.length / rowsPerPage)) {
            currentPage++;
            displayRows(currentPage);
        }
    };

    searchInput.addEventListener('input', function() {
        const searchTerm = searchInput.value.toLowerCase();
        const filteredRows = Array.from(rows).filter(row => {
            const productCell = row.cells[0];
            return productCell && productCell.textContent.toLowerCase().includes(searchTerm);
        });

        // Clear the table body and append filtered rows
        tableBody.innerHTML = '';
        filteredRows.forEach(row => tableBody.appendChild(row));

        // Reset pagination
        currentPage = 1;
        displayRows(currentPage);
    });

    // Initial display
    displayRows(currentPage);
});
            // low stock and search bar
            document.addEventListener("DOMContentLoaded", function () {
    const rowsPerPage = 5;

    // Medicines Table
    const medicinesTableBody = document.getElementById("medicinesTableBody");
    const medicinesRows = medicinesTableBody.getElementsByTagName("tr");
    const medicinesPagination = {
        prev: document.getElementById("medicinesPrev"),
        next: document.getElementById("medicinesNext"),
        pageInfo: document.getElementById("medicinesPageInfo")
    };
    const searchMedicinesInput = document.getElementById("searchMedicines");

    paginateTable(medicinesRows, medicinesPagination, rowsPerPage);

    // Products Table
    const productsTableBody = document.getElementById("productsTableBody");
    const productsRows = productsTableBody.getElementsByTagName("tr");
    const productsPagination = {
        prev: document.getElementById("productsPrev"),
        next: document.getElementById("productsNext"),
        pageInfo: document.getElementById("productsPageInfo")
    };
    const searchProductsInput = document.getElementById("searchProducts");

    paginateTable(productsRows, productsPagination, rowsPerPage);

    // Search functionality for Medicines
    searchMedicinesInput.addEventListener("keyup", function () {
        filterTable(medicinesRows, searchMedicinesInput.value.toLowerCase());
        paginateTable(medicinesRows, medicinesPagination, rowsPerPage);
    });

    // Search functionality for Products
    searchProductsInput.addEventListener("keyup", function () {
        filterTable(productsRows, searchProductsInput.value.toLowerCase());
        paginateTable(productsRows, productsPagination, rowsPerPage);
    });
});

// Function to paginate the table with Previous, Page, Next buttons
function paginateTable(rows, pagination, rowsPerPage) {
    let totalRows = rows.length;
    let totalPages = Math.ceil(totalRows / rowsPerPage);
    let currentPage = 1;

    function showPage(page) {
        const start = (page - 1) * rowsPerPage;
        const end = page * rowsPerPage;

        // Show only the rows for the current page
        for (let i = 0; i < totalRows; i++) {
            rows[i].style.display = i >= start && i < end ? "" : "none";
        }

        // Update pagination info
        pagination.pageInfo.textContent = `Page ${currentPage} of ${totalPages}`;

        // Disable/Enable Previous button
        pagination.prev.classList.toggle("disabled", currentPage === 1);
        // Disable/Enable Next button
        pagination.next.classList.toggle("disabled", currentPage === totalPages);
    }

    // Click event for Previous button
    pagination.prev.addEventListener("click", function (e) {
        e.preventDefault();
        if (currentPage > 1) {
            currentPage--;
            showPage(currentPage);
        }
    });

    // Click event for Next button
    pagination.next.addEventListener("click", function (e) {
        e.preventDefault();
        if (currentPage < totalPages) {
            currentPage++;
            showPage(currentPage);
        }
    });

    // Initial page display
    showPage(currentPage);
}

// Function to filter table rows
function filterTable(rows, query) {
    for (let i = 0; i < rows.length; i++) {
        const productName = rows[i].getElementsByTagName("td")[0].textContent.toLowerCase();
        rows[i].style.display = productName.includes(query) ? "" : "none";
    }
}

        // Labels for the months
        var months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];

        // Use Chart.js to create the line chart
        var ctx = document.getElementById('salesChart').getContext('2d');
        var salesChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: months,  // X-axis labels (Months)
                datasets: [{
                    label: 'Monthly Sales Overview',
                    data: monthlySales,  // Y-axis data (Sales totals)
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',  // Line fill color
                    borderColor: 'rgba(75, 192, 192, 1)',        // Line border color
                    borderWidth: 2
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>

    <script>
$(document).ready(function() {
    // Check if the user is PharmacyAdmin, then trigger the modal
    <?php if ($_SESSION['role'] === 'Pharmacy Admin') { ?>
        $('#lowStockModal').modal('show');
    <?php } ?>
});
// Function to show/hide notifications
function showNotifications() {
    const notificationDropdown = document.getElementById('notificationDropdown');
    notificationDropdown.style.display = notificationDropdown.style.display === 'none' ? 'block' : 'none';
}

// Simulate fetching notifications from the server (You can replace this with an actual AJAX call)
function fetchNotifications() {
    // Simulated notification data
    const notifications = [
        { message: 'Low stock for product XYZ', timestamp: '2024-10-17 10:00 AM' },
        { message: 'Medicine ABC is expiring soon', timestamp: '2024-10-17 09:00 AM' },
        { message: 'New order placed', timestamp: '2024-10-16 08:00 PM' }
    ];

    // Set the notification count
    const notificationCount = notifications.length;
    document.getElementById('notificationCount').innerText = notificationCount;

    // Append notifications to the list
    const notificationList = document.getElementById('notificationList');
    notificationList.innerHTML = ''; // Clear previous notifications
    notifications.forEach((notification) => {
        const li = document.createElement('li');
        li.innerHTML = `<strong>${notification.message}</strong><br><small>${notification.timestamp}</small>`;
        notificationList.appendChild(li);
    });
}

// Fetch notifications on page load (or when needed)
window.onload = fetchNotifications;

</script>
<script>
// Function to update notification badge count
document.addEventListener('DOMContentLoaded', function () {
    // Update the notification badge with the count from PHP
    var badgeElement = document.getElementById('notif-badge');
    badgeElement.textContent = lowStockCount > 0 ? lowStockCount : '0'; // Display count or '0' if no low stock
});

// Function to open the notification modal
function openNotifModal(event) {
    event.preventDefault();
    document.getElementById('notif-modal').style.display = 'block';
}

// Function to close the notification modal
function closeNotifModal() {
    document.getElementById('notif-modal').style.display = 'none';
}

// Close modal when clicking outside the modal content
window.onclick = function(event) {
    if (event.target == document.getElementById('notif-modal')) {
        document.getElementById('notif-modal').style.display = 'none';
    }
}
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
