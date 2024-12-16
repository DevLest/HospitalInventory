<?php
session_name('ChiefAdminSession');
session_start();

// Check if the Chief Admin is logged in
if (!isset($_SESSION['chief_admin_id'])) {
    // Redirect to login if the Chief Admin is not logged in
    header("Location: login.php?error=Please log in first");
    exit();
}

// Now you can access the Chief Admin session data
echo "Welcome, " . $_SESSION['chief_admin_username'];

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dropdown Example</title>
    <link rel="stylesheet" href="admin.css">
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
                <a class="nav-link" href="NurseAdd.php" style="width: 100%;">◽ Add ER Patient</a>
                <a class="nav-link" href="Nurselist.php" style="width: 100%;">◽ ER Patient List</a>
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
        <h1 style="font-size: 100%; color: darkblue;">Hi,👤 <?php echo $_SESSION['chief_admin_username']; ?></h1>
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
            <a class="small text-white stretched-link" href="ListPatient.php">View Medicines</a>
            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
        </div>
    </div>
</div>


        <!-- Repeat for other three columns -->
        <div class="col-xl-3 col-md-6">
        <div class="card text-white mb-4" style="background-color: #DCC7AA; opacity: 0.9; box-shadow: 0 2px 5px rgba(0, 0, 0, 1.9);" >
            <div class="card-body" style="color: green; font-weight: bold; font-size: 22px;">𝖯𝗋𝗈𝖽𝗎𝖼𝗍𝗌</div>
        
        <?php
        $host = 'localhost';
        $username = 'root';
        $password = '';
        $database = 'database';

        $con = mysqli_connect($host, $username, $password, $database);

        if (!$con) {
            die('Unable to connect to the database. Check your connection parameters.');
        }

        $dash_category_query = "SELECT * from pharmacy_products";
        $dash_category_query_run = mysqli_query($con, $dash_category_query);

        if ($tblevents_total = mysqli_num_rows($dash_category_query_run)) {
            echo '<h4 class="mb-0" style="color: black; margin-left: 5%; font-size: 30px; z-index: 2; position: relative;">' . $tblevents_total . ' <i class="fas fa-box" style="color: black;"></i></h4>';

        } else {
            echo '<h4 class="mb-0" style="z-index: 2; position: relative;">No Data</h4>';
        }

        mysqli_close($con);
        ?>

        <div class="card-footer d-flex align-items-center justify-content-between" style="position: relative; z-index: 2;">
            <a class="small text-white stretched-link" href="ListPatient.php">View Patients</a>
            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
        </div>
    </div>
</div>

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

        <div class="card-footer d-flex align-items-center justify-content-between" style="position: relative; z-index: 2;">
            <a class="small text-white stretched-link" href="ListExpiredMedicines.php">View Expired Medicines</a>
            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
        </div>
    </div>
</div>
<div class="col-xl-3 col-md-6">
        <div class="card text-white mb-4" style="background-color: #DCC7AA; opacity: 0.9; box-shadow: 0 2px 5px rgba(0, 0, 0, 1.9);">
            <div class="card-body" style="color: green; font-weight: bold; font-size: 22px;">𝖯𝗁𝖺𝗋𝗆𝖺𝖼𝗒 𝖲𝗍𝖺𝖿𝖿</div>

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

    // Modify the query to select users with the role 'Pharmacy Cashier'
    $dash_category_query = "SELECT COUNT(*) AS total_staff FROM users WHERE role = 'Pharmacy Staff'";
    $dash_category_query_run = mysqli_query($con, $dash_category_query);

    if ($result = mysqli_fetch_assoc($dash_category_query_run)) {
        $total_staff = $result['total_staff'];
        echo '<h4 class="mb-0" style="color: black; margin-left: 5%; z-index: 2; font-size: 30px; position: relative;">' . $total_staff . ' <i class="fas fa-user" style="color: black;"></i></h4>';
    } else {
        echo '<h4 class="mb-0" style="z-index: 2; position: relative;">No Data</h4>';
    }

    // Close the connection
    mysqli_close($con);
    ?>
        <div class="card-footer d-flex align-items-center justify-content-between" style="position: relative; z-index: 2;">
            <a class="small text-white stretched-link" href="ListPatient.php">View Patients</a>
            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
        </div>
    </div>
</div>
          <div class="col-xl-3 col-md-6">
    <div class="card text-white mb-4" style="background-color: #DCC7AA; opacity: 0.9; box-shadow: 0 2px 5px rgba(0, 0, 0, 1.9);" >
        <div class="card-body" style="color: green; font-weight: bold; font-size: 22px;">𝖯𝗁𝖺𝗋𝗆𝖺𝖼𝗒 𝖢𝖺𝗌𝗁𝗂𝖾𝗋</div>
    
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

    // Modify the query to select users with the role 'Pharmacy Cashier'
    $dash_category_query = "SELECT COUNT(*) AS total_cashiers FROM users WHERE role = 'Pharmacy Cashier'";
    $dash_category_query_run = mysqli_query($con, $dash_category_query);

    if ($result = mysqli_fetch_assoc($dash_category_query_run)) {
        $total_cashiers = $result['total_cashiers'];
        echo '<h4 class="mb-0" style="color: black; margin-left: 5%; z-index: 2; font-size: 30px; position: relative;">' . $total_cashiers . ' <i class="fas fa-cash-register" style="color: black;"></i></h4>';
    } else {
        echo '<h4 class="mb-0" style="z-index: 2; position: relative;">No Data</h4>';
    }

    // Close the connection
    mysqli_close($con);
    ?>

    <div class="card-footer d-flex align-items-center justify-content-between" style="position: relative; z-index: 2;">
        <a class="small text-white stretched-link" href="ListPatient.php">View Patients</a>
        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
    </div>
    </div>
</div>
          <div class="col-xl-3 col-md-6">
    <div class="card text-white mb-4" style="background-color: #DCC7AA; opacity: 0.9; box-shadow: 0 2px 5px rgba(0, 0, 0, 1.9);" >
        <div class="card-body" style="color: green; font-weight: bold; font-size: 22px;">𝖯𝗁𝖺𝗋𝗆𝖺𝖼𝗒 Admin</div>
    
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

    // Modify the query to select users with the role 'Pharmacy Cashier'
    $dash_category_query = "SELECT COUNT(*) AS total_cashiers FROM users WHERE role = 'Pharmacy Admin'";
    $dash_category_query_run = mysqli_query($con, $dash_category_query);

    if ($result = mysqli_fetch_assoc($dash_category_query_run)) {
        $total_cashiers = $result['total_cashiers'];
        echo '<h4 class="mb-0" style="color: black; margin-left: 5%; z-index: 2; font-size: 30px; position: relative;">' . $total_cashiers . ' <i class="fas fa-user" style="color: black;"></i></h4>';
    } else {
        echo '<h4 class="mb-0" style="z-index: 2; position: relative;">No Data</h4>';
    }

    // Close the connection
    mysqli_close($con);
    ?>

    <div class="card-footer d-flex align-items-center justify-content-between" style="position: relative; z-index: 2;">
        <a class="small text-white stretched-link" href="ListPatient.php">View Patients</a>
        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
    </div>
    </div>
</div>
        <div class="col-xl-3 col-md-6">
        <div class="card text-white mb-4" style="background-color: #DCC7AA; opacity: 0.9; box-shadow: 0 2px 5px rgba(0, 0, 0, 1.9);" >
            <div class="card-body" style="color: green; font-weight: bold; font-size: 22px;">Doctors</div>
        
        <?php
        $host = 'localhost';
        $username = 'root';
        $password = '';
        $database = 'database';

        $con = mysqli_connect($host, $username, $password, $database);

        if (!$con) {
            die('Unable to connect to the database. Check your connection parameters.');
        }

        $dash_category_query = "SELECT * from doctors";
        $dash_category_query_run = mysqli_query($con, $dash_category_query);

        if ($tblevents_total = mysqli_num_rows($dash_category_query_run)) {
            echo '<h4 class="mb-0" style="color: black; margin-left: 5%; z-index: 2; font-size: 30px; position: relative;">' . $tblevents_total . ' <i class="fas fa-user" style="color: black;"></i></h4>';
        } else {
            echo '<h4 class="mb-0" style="z-index: 2; position: relative;">No Data</h4>';
        }

        mysqli_close($con);
        ?>

        <div class="card-footer d-flex align-items-center justify-content-between" style="position: relative; z-index: 2;">
            <a class="small text-white stretched-link" href="ListPatient.php">View Patients</a>
            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
        </div>
    </div>
</div>
        <div class="col-xl-3 col-md-6">
        <div class="card text-white mb-4" style="background-color: #DCC7AA; opacity: 0.9; box-shadow: 0 2px 5px rgba(0, 0, 0, 1.9);" >
            <div class="card-body" style="color: green; font-weight: bold; font-size: 22px;">Wards</div>
        
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

    // Modify the query to select users with the role 'Pharmacy Cashier'
    $dash_category_query = "SELECT COUNT(*) AS total_wards FROM users WHERE role = 'Wards'";
    $dash_category_query_run = mysqli_query($con, $dash_category_query);

    if ($result = mysqli_fetch_assoc($dash_category_query_run)) {
        $total_wards = $result['total_wards'];
        echo '<h4 class="mb-0" style="color: black; margin-left: 5%; z-index: 2; font-size: 30px; position: relative;">' . $total_wards . ' <i class="fas fa-user" style="color: black;"></i></h4>';
    } else {
        echo '<h4 class="mb-0" style="z-index: 2; position: relative;">No Data</h4>';
    }

    // Close the connection
    mysqli_close($con);
    ?>

        <div class="card-footer d-flex align-items-center justify-content-between" style="position: relative; z-index: 2;">
            <a class="small text-white stretched-link" href="ListPatient.php">View Patients</a>
            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
        </div>
    </div>
</div>

         <div class="col-xl-3 col-md-6">
    <div class="card text-white mb-4" style="background-color: #DCC7AA; opacity: 0.9; box-shadow: 0 2px 5px rgba(0, 0, 0, 1.9);" >
        <div class="card-body" style="color: green; font-weight: bold; font-size: 22px;">
            𝖱𝖾𝖼𝖾𝗂𝗉𝗍𝗌
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

    // Query to count the total number of receipts
    $receipts_query = "SELECT COUNT(*) AS total_receipts FROM receipts";
    $receipts_query_run = mysqli_query($con, $receipts_query);
    $receipts_count = mysqli_fetch_assoc($receipts_query_run)['total_receipts'];

    // Display the total number of receipts
    if ($receipts_count) {
        echo '<h4 class="mb-0" style="color: black; margin-left: 5%; z-index: 2; font-size: 30px; position: relative;">' . $receipts_count . ' <i class="fas fa-receipt" style="color: black;"></i></h4>';
    } else {
        echo '<h4 class="mb-0" style="z-index: 2; position: relative;">No Data</h4>';
    }

    // Close the connection
    mysqli_close($con);
    ?>

        <div class="card-footer d-flex align-items-center justify-content-between" style="position: relative; z-index: 2;">
            <a class="small text-white stretched-link" href="ListReceipts.php">View Receipts</a>
            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
        </div>
    </div>
</div>

             <div class="col-xl-3 col-md-6">
        <div class="card text-white mb-4" style="background-color: #DCC7AA; opacity: 0.9; box-shadow: 0 2px 5px rgba(0, 0, 0, 1.9);" >
            <div class="card-body" style="color: green; font-weight: bold; font-size: 22px;">Patients</div>
        
        <?php
        $host = 'localhost';
        $username = 'root';
        $password = '';
        $database = 'database';

        $con = mysqli_connect($host, $username, $password, $database);

        if (!$con) {
            die('Unable to connect to the database. Check your connection parameters.');
        }

        $dash_category_query = "SELECT * from patient";
        $dash_category_query_run = mysqli_query($con, $dash_category_query);

        if ($tblevents_total = mysqli_num_rows($dash_category_query_run)) {
            echo '<h4 class="mb-0" style="color: black; margin-left: 5%; z-index: 2; font-size: 30px; position: relative;">' . $tblevents_total . ' <i class="fas fa-user" style="color: black;"></i></h4>';
        } else {
            echo '<h4 class="mb-0" style="z-index: 2; position: relative;">No Data</h4>';
        }

        mysqli_close($con);
        ?>

        <div class="card-footer d-flex align-items-center justify-content-between" style="position: relative; z-index: 2;">
            <a class="small text-white stretched-link" href="ListPatient.php">View Patients</a>
            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
        </div>
    </div>
</div>
        <div class="col-xl-3 col-md-6">
        <div class="card text-white mb-4" style="background-color: #DCC7AA; opacity: 0.9; box-shadow: 0 2px 5px rgba(0, 0, 0, 1.9);" >
            <div class="card-body" style="color: green; font-weight: bold; font-size: 22px;">Admitted Patients</div>
        
        <?php
        $host = 'localhost';
        $username = 'root';
        $password = '';
        $database = 'database';

        $con = mysqli_connect($host, $username, $password, $database);

        if (!$con) {
            die('Unable to connect to the database. Check your connection parameters.');
        }

        $dash_category_query = "SELECT * from admissionpatient";
        $dash_category_query_run = mysqli_query($con, $dash_category_query);

        if ($tblevents_total = mysqli_num_rows($dash_category_query_run)) {
            echo '<h4 class="mb-0" style="color: black; margin-left: 5%; z-index: 2; font-size: 30px; position: relative;">' . $tblevents_total . ' <i class="fas fa-user" style="color: black;"></i></h4>';
        } else {
            echo '<h4 class="mb-0" style="z-index: 2; position: relative;">No Data</h4>';
        }

        mysqli_close($con);
        ?>

        <div class="card-footer d-flex align-items-center justify-content-between" style="position: relative; z-index: 2;">
            <a class="small text-white stretched-link" href="ListPatient.php">View Patients</a>
            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
        </div>
    </div>
</div>
                <div class="col-xl-3 col-md-6">
        <div class="card text-white mb-4" style="background-color: #DCC7AA; opacity: 0.9; box-shadow: 0 2px 5px rgba(0, 0, 0, 1.9);" >
            <div class="card-body" style="color: green; font-weight: bold; font-size: 22px;">ER Nurse</div>
        
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

    // Modify the query to select users with the role 'Pharmacy Cashier'
    $dash_category_query = "SELECT COUNT(*) AS total_nurse FROM users WHERE role = 'Er Nurse'";
    $dash_category_query_run = mysqli_query($con, $dash_category_query);

    if ($result = mysqli_fetch_assoc($dash_category_query_run)) {
        $total_nurse = $result['total_nurse'];
        echo '<h4 class="mb-0" style="color: black; margin-left: 5%; z-index: 2; font-size: 30px; position: relative;">' . $total_nurse . ' <i class="fas fa-user-nurse" style="color: black;"></i></h4>';
    } else {
        echo '<h4 class="mb-0" style="z-index: 2; position: relative;">No Data</h4>';
    }

    // Close the connection
    mysqli_close($con);
    ?>
        <div class="card-footer d-flex align-items-center justify-content-between" style="position: relative; z-index: 2;">
            <a class="small text-white stretched-link" href="ListPatient.php">View Patients</a>
            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
        </div>
    </div>
</div>  
                 <div class="col-xl-3 col-md-6">
        <div class="card text-white mb-4" style="background-color: #DCC7AA; opacity: 0.9; box-shadow: 0 2px 5px rgba(0, 0, 0, 1.9);" >
            <div class="card-body" style="color: green; font-weight: bold; font-size: 22px;">ER Patient</div>
        
        <?php
        $host = 'localhost';
        $username = 'root';
        $password = '';
        $database = 'database';

        $con = mysqli_connect($host, $username, $password, $database);

        if (!$con) {
            die('Unable to connect to the database. Check your connection parameters.');
        }

        $dash_category_query = "SELECT * from er_patient";
        $dash_category_query_run = mysqli_query($con, $dash_category_query);

        if ($tblevents_total = mysqli_num_rows($dash_category_query_run)) {
            echo '<h4 class="mb-0" style="color: black; margin-left: 5%; z-index: 2; font-size: 30px; position: relative;">' . $tblevents_total . ' <i class="fas fa-user" style="color: black;"></i></h4>';
        } else {
            echo '<h4 class="mb-0" style="z-index: 2; position: relative;">No Data</h4>';
        }

        mysqli_close($con);
        ?>

        <div class="card-footer d-flex align-items-center justify-content-between" style="position: relative; z-index: 2;">
            <a class="small text-white stretched-link" href="ListPatient.php">View Patients</a>
            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
        </div>
    </div>
</div>  
       
        
        

</div>

<div class="first1" style="opacity: 0.9; border-top: 4px solid #e74c3c;"></div><br>
    <div class="row"> <!-- Use row class to create a horizontal group of columns -->
        <div class="col-xl-3 col-md-6">
        <div class="card text-white mb-4" style="background-color: #fad7a0; opacity: 0.9; box-shadow: 0 2px 5px rgba(0, 0, 0, 1.9);">
            <div class="card-body" style="color: green; font-weight: bold; font-size: 22px;">𝖳𝗈𝖽𝖺𝗒'𝗌 𝖲𝖺𝗅𝖾</div>

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
            
            // Query to sum today's total sales
            $today_query = "SELECT SUM(total) as total_sales FROM receipts WHERE DATE(created_at) = CURDATE()";
            $today_result = mysqli_query($con, $today_query);
            $today_sales = mysqli_fetch_assoc($today_result)['total_sales'] ?? 0;
            
            echo '<h4 class="mb-0" style="color: black; margin-left: 5%; font-size: 30px;"> ₱ ' . number_format($today_sales, 2) . ' </h4>';
            ?>

        <div style="margin-bottom: 12.5%;">
        </div>
    </div>
</div>
             <div class="col-xl-3 col-md-6">
    <div class="card text-white mb-4" style="background-color: #fad7a0; opacity: 0.9; box-shadow: 0 2px 5px rgba(0, 0, 0, 1.9);">
        <div class="card-body" style="color: green; font-weight: bold; font-size: 22px;">Weekly Income</div>
        
        <?php
        $host = 'localhost';
        $username = 'root';
        $password = '';
        $database = 'database';

        $con = mysqli_connect($host, $username, $password, $database);

        if (!$con) {
            die('Unable to connect to the database. Check your connection parameters.');
        }

        // Query to calculate weekly income (last 7 days)
        $weekly_income_query = "
            SELECT SUM(total) AS weekly_income 
            FROM receipts 
            WHERE created_at >= DATE_SUB(CURRENT_DATE, INTERVAL 7 DAY)
        ";
        $result = mysqli_query($con, $weekly_income_query);

        if ($row = mysqli_fetch_assoc($result)) {
            $weekly_income = $row['weekly_income'] ? $row['weekly_income'] : 0;
            echo '<h4 class="mb-0" style="color: black; margin-left: 5%; z-index: 2; font-size: 30px; position: relative;">₱' . number_format($weekly_income, 2) . '</h4>';
        } else {
            echo '<h4 class="mb-0" style="z-index: 2; position: relative;">No Data</h4>';
        }

        mysqli_close($con);
        ?>

        <div style="margin-bottom: 12.5%;">
        </div>
    </div>
</div>
             <div class="col-xl-3 col-md-6">
    <div class="card text-white mb-4" style="background-color: #fad7a0; opacity: 0.9; box-shadow: 0 2px 5px rgba(0, 0, 0, 1.9);">
        <div class="card-body" style="color: green; font-weight: bold; font-size: 22px;">Monthly Income</div>
        
        <?php
        $host = 'localhost';
        $username = 'root';
        $password = '';
        $database = 'database';

        $con = mysqli_connect($host, $username, $password, $database);

        if (!$con) {
            die('Unable to connect to the database. Check your connection parameters.');
        }

        // Query to calculate monthly total
        $monthly_total_query = "
            SELECT SUM(total) AS monthly_total 
            FROM receipts 
            WHERE YEAR(created_at) = YEAR(CURRENT_DATE) 
              AND MONTH(created_at) = MONTH(CURRENT_DATE)
        ";
        $result = mysqli_query($con, $monthly_total_query);

        if ($row = mysqli_fetch_assoc($result)) {
            $monthly_total = $row['monthly_total'] ? $row['monthly_total'] : 0;
            echo '<h4 class="mb-0" style="color: black; margin-left: 5%; z-index: 2; font-size: 30px; position: relative;">₱' . number_format($monthly_total, 2) . '</h4>';
        } else {
            echo '<h4 class="mb-0" style="z-index: 2; position: relative;">No Data</h4>';
        }

        mysqli_close($con);
        ?>

        <div style="margin-bottom: 12.5%;">
        </div>
    </div>
</div>
          <div class="col-xl-3 col-md-6">
        <div class="card text-white mb-4" style="background-color: #fad7a0; opacity: 0.9; box-shadow: 0 2px 5px rgba(0, 0, 0, 1.9);" >
            <div class="card-body" style="color: green; font-weight: bold; font-size: 22px;">Yearly Sales</div>
        
        <?php
        $host = 'localhost';
        $username = 'root';
        $password = '';
        $database = 'database';

        $con = mysqli_connect($host, $username, $password, $database);

        if (!$con) {
            die('Unable to connect to the database. Check your connection parameters.');
        }

        // Query to calculate today's total
        $todays_total_query = "
            SELECT SUM(total) AS todays_total 
            FROM receipts 
            WHERE DATE(created_at) = CURDATE()
        ";
        $result = mysqli_query($con, $todays_total_query);

        if ($row = mysqli_fetch_assoc($result)) {
            $todays_total = $row['todays_total'] ? $row['todays_total'] : 0;
            echo '<h4 class="mb-0" style="color: black; margin-left: 5%; z-index: 2; font-size: 30px; position: relative;">₱' . number_format($todays_total, 2) . '</h4>';
        } else {
            echo '<h4 class="mb-0" style="z-index: 2; position: relative;">No Data</h4>';
        }

        mysqli_close($con);
        ?>

        <div style="margin-bottom: 12.5%;">
        </div>
    </div>
</div>
</div>
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

// Queries for sales totals
$sales_query = "SELECT 
    SUM(total) AS total, 
    CASE 
        WHEN DATE(created_at) = CURDATE() THEN 'Today'
        WHEN YEARWEEK(created_at, 1) = YEARWEEK(CURDATE(), 1) THEN 'Weekly'
        WHEN YEAR(created_at) = YEAR(CURDATE()) AND MONTH(created_at) = MONTH(CURDATE()) THEN 'Monthly'
        WHEN YEAR(created_at) = YEAR(CURDATE()) THEN 'Yearly'
    END AS period
FROM receipts
GROUP BY period";

$sales_totals = [
    'Today' => 0,
    'Weekly' => 0,
    'Monthly' => 0,
    'Yearly' => 0,
];

$sales_result = mysqli_query($con, $sales_query);
while ($row = mysqli_fetch_assoc($sales_result)) {
    $sales_totals[$row['period']] = $row['total'];
}

// Fetch monthly sales
$monthly_sales_query = "SELECT SUM(total) AS monthly_total, MONTH(created_at) AS month 
    FROM receipts 
    WHERE YEAR(created_at) = YEAR(CURDATE()) 
    GROUP BY MONTH(created_at)";
$monthly_sales_result = mysqli_query($con, $monthly_sales_query);

$monthly_sales = array_fill(0, 12, 0);
while ($row = mysqli_fetch_assoc($monthly_sales_result)) {
    $monthly_sales[(int)$row['month'] - 1] = $row['monthly_total'];
}

// Close the database connection
mysqli_close($con);

// Pass data to JavaScript
echo '<script>
    const salesTotals = ' . json_encode($sales_totals) . ';
    const monthlySales = ' . json_encode($monthly_sales) . ';
</script>';
?>
<div class="container mt-5">
    <div class="row">
        <!-- Monthly Sales Performance -->
        <div class="col-md-6">
            <div class="card">
                <h2 class="text-center" style="background-color: #34495e; color: white; padding: 10px;">
                    Sales Performance
                </h2>
                <div id="performance-container" style="width: 100%; height: 400px;">
                    <canvas id="monthlySalesChart"></canvas>
                </div>
            </div>
        </div>
            <!-- Sales Totals Pie Chart -->
            <div class="col-md-6">
                <div class="card">
                    <h2 class="text-center" style="background-color: #34495e; color: white; padding: 10px;">
                        Sales Distribution
                    </h2>
                    <div style="width: 80%; height: 400px; margin: 0 auto;">
                        <canvas id="salesTotalsChart"></canvas>
                    </div>
                </div>
            </div>
            </div>
            </div>

    <script>
        // Monthly Sales Chart
        const monthlyCtx = document.getElementById('monthlySalesChart').getContext('2d');
        new Chart(monthlyCtx, {
            type: 'bar',
            data: {
                labels: [
                    'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 
                    'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'
                ],
                datasets: [{
                    label: 'Monthly Sales ($)',
                    data: monthlySales,
                    backgroundColor: 'rgba(75, 192, 192, 0.6)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Total Sales ($)'
                        }
                    }
                }
            }
        });

        // Sales Totals Pie Chart
           const totalsCtx = document.getElementById('salesTotalsChart').getContext('2d');
    new Chart(totalsCtx, {
        type: 'pie',
        data: {
            labels: ['Today', 'Weekly', 'Monthly', 'Yearly'],
            datasets: [{
                label: 'Sales Distribution',
                data: [
                    salesTotals.Today,
                    salesTotals.Weekly,
                    salesTotals.Monthly,
                    salesTotals.Yearly
                ],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.6)', // Today
                    'rgba(54, 162, 235, 0.6)', // Weekly
                    'rgba(255, 206, 86, 0.6)', // Monthly
                    'rgba(153, 102, 255, 0.6)' // Yearly
                ],
                borderColor: 'rgba(255, 255, 255, 1)',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true
        }
    });
    </script><br>

<div class="container mt-5">
    <div class="row">
        <!-- Left Column: Chart -->
        <div class="col-xl-6">
            <div class="card">
                <?php
                // Database connection parameters
                $host = 'localhost';
                $username = 'root';
                $password = '';
                $database = 'database';

                // Connect to the database
                $con = mysqli_connect($host, $username, $password, $database);

                // Check connection
                if (!$con) {
                    die('Unable to connect to the database. Check your connection parameters.');
                }

                // Query to fetch all dates from your table
                $query = "SELECT date FROM patient";
                $result = mysqli_query($con, $query);

                // Initialize an array to store the count of patients for each month
                $monthlyCounts = array_fill(1, 12, 0);

                // Fetch data and update monthly counts
                while ($row = mysqli_fetch_assoc($result)) {
                    $date = $row['date'];
                    $month = date('n', strtotime($date)); // Extract month (1-12)
                    $monthlyCounts[$month]++;
                }

                // Close the database connection
                mysqli_close($con);

                // Prepare data for the bar chart
                $months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
                $data = [];
                foreach ($monthlyCounts as $month => $count) {
                    $data[] = $count;
                }
                ?>              
                <h2 class="text-center" style="background-color: #34495e; color: white; padding: 10px;">
                    𝖠𝖽𝖽𝖾𝖽 𝖯𝖺𝗍𝗂𝖾𝗇𝗧 / 𝖮𝗎𝗍𝖯𝖺𝗍𝗂𝖾𝗇𝗍 𝖤𝖺𝖼𝗁 𝖬𝗈𝗇𝗧𝗁
                </h2>
                <div class="card-body">
                    <canvas id="myChart" width="297" height="220"></canvas>
                </div>
                <script>
                    var ctx = document.getElementById('myChart').getContext('2d');
                    var myChart = new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: <?= json_encode($months) ?>,
                            datasets: [{
                                label: 'OutPatients Added Each Month',
                                data: <?= json_encode($data) ?>,
                                backgroundColor: <?= json_encode(array_fill(0, 12, 'rgba(54, 162, 235, 0.6)')) ?>,
                                borderColor: <?= json_encode(array_fill(0, 12, 'rgba(54, 162, 235, 1)')) ?>,
                                borderWidth: 1
                            }]
                        },
                        options: {
                            scales: {
                                y: {
                                    beginAtZero: false, // Do not start at 0, start at 5
                                    min: 5,  // Set the minimum value of the Y-axis
                                    max: 100,  // Set the maximum value of the Y-axis
                                    ticks: {
                                        stepSize: 5,  // Set step size to 5
                                        callback: function(value) {
                                            return value; // Optional: customize the tick labels if necessary
                                        }
                                    }
                                }
                            }
                        }
                    });

                    // Highlight months with only one patient
                    var barColors = myChart.data.datasets[0].backgroundColor;
                    var barData = myChart.data.datasets[0].data;
                    for (var i = 0; i < barColors.length; i++) {
                        if (barData[i] === 1) {
                            barColors[i] = 'rgba(255, 99, 132, 0.6)'; // Change color for months with one patient
                        }
                    }
                    myChart.update();
                </script>
            </div>
        </div>

        <!-- Right Column: Doctors List -->
        <div class="col-xl-6">
            <div class="card">
                <?php
                // Database connection
                $conn = mysqli_connect("localhost", "root", "", "database");

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
                <div class="card-header d-flex justify-content-between align-items-center" style="background-color: #34495e;">
                    <h5 class="mb-0" style="color: white;"><i class="fas fa-user-md" style="color: white;"></i> List of Doctors</h5>
                    <form class="d-flex" action="" method="GET">
                        <input style="margin-right: 20px;" type="text" name="search"  class="form-control me-2" placeholder="Search by name" value="<?php echo htmlspecialchars($search); ?>">
                        <button type="submit" class="btn btn-primary">Search</button>
                    </form>
                </div>
                <div class="card-body">
                   <table class="table table-bordered">
                             <thead class="thead-light">
            <tr>
                <th>Name</th>
                <th>License</th>
                <th>Contact Number</th>
                <th>Specialties</th>
            </tr> 
        </thead>
        <tbody>
            <?php
            if (mysqli_num_rows($result) > 0) {
                while ($doctor = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>Dr. {$doctor['name']}</td>";
                    echo "<td>{$doctor['license']}</td>";
                    echo "<td>{$doctor['contact_number']}</td>";
                    echo "<td>{$doctor['specialties']}</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='5' class='text-center'>No doctors found.</td></tr>";
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
                fetch('chieflogout.php', {
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
