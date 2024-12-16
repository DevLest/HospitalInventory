<?php
$db = mysqli_connect('localhost', 'root', '') or
        die ('Unable to connect. Check your connection parameters.');
        mysqli_select_db($db, 'data') or die(mysqli_error($db));

$query = "SELECT * FROM patient";
$results = mysqli_query($db, $query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Dashboard - SB Admin</title>
    <!-- Include FullCalendar CSS and JavaScript -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/5.10.0/main.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/5.10.0/main.min.js"></script>
    <!-- Include Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <style>
        /* Add CSS style for alternating row colors */
        tr:nth-child(even) {
            background-color: #D6EEEE;
        }
        .button-container form {
            display: inline-block;
            margin-right: 10px; /* Adjust as needed for spacing */
        }
        body {
            background-color: #E5E7E9;
        }
        td {
            text-align: center; /* Center the content inside table cells */
        }
        th{
            background-color: #D6EEEE;
        }
        #datatablesSimple thead tr {
        background-color: #3498DB; /* Set your desired background color */
        color: white;
    }
    </style>
</head>
    <body class="sb-nav-fixed" style="background-color: #E5E8E8;">
            <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark" >
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="AdminDashboard.php"> 🏥 HMCO</a>
            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
            <!-- Navbar Search-->
            <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
                <div class="input-group">
                </div>
            </form>
            <!-- Navbar-->
            <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="#!">Settings</a></li>
                        <li><a class="dropdown-item" href="#!">Activity Log</a></li>
                        <li><hr class="dropdown-divider" /></li>
                        <li><a class="dropdown-item" href="#!">Logout</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">Core</div>
                            <a class="nav-link" href="index.html">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Dashboard
                            </a>
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main><br>
                    <div class="container-fluid px-lg-4">
                    <div class="row align-items-center">
    <div class="col-lg-12">
        <div class="d-flex align-items-center">
            <div class="img-container me-4">
                <img src="assets/img/Hinigaran.png" alt="A sample image" class="img-fluid" style="margin-left: 30px; max-width: 100px;">
            </div>
            <div>
                <h1 class="mt-4" style="font-size: 20px;">Hinigaran Medical Clinic Outpatient Management</h1>
                <h1 class="mt-4" style="font-size: 20px;"></h1>
            </div>
        </div>
    </div>
</div><br>
<div class="first1" style="opacity: 0.9; border-top: 2px solid black;"><br>
    <div>
                                            <h1 style="margin-left: 3%;"><i class="fas fa-home fa-1x"></i> Dashboard</h1><br>
                                        </div>
                        <div class="row">
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-white text-black mb-4" style="height: 80%;">
                                    <div class="card-body d-flex align-items-center">
                                        <i class="fas fa-user-md fa-4x" style="color: #3498DB;"></i>
                                        <div style="margin-left: 10px;">
                                            <?php
                                            $host = 'localhost';
                                            $username = 'root';
                                            $password = '';
                                            $database = 'data';

                                            $con = mysqli_connect($host, $username, $password, $database);

                                            if (!$con) {
                                                die('Unable to connect to the database. Check your connection parameters.');
                                            }

                                            $dash_category_query = "SELECT * FROM pharmacydoctors";
                                            $dash_category_query_run = mysqli_query($con, $dash_category_query);

                                            if ($tblevents_total = mysqli_num_rows($dash_category_query_run)) {
                                                echo '<h4 class="mb-0" style="color: #34495E; font-size: 40px;">' . $tblevents_total . ' </h4>';
                                            } else {
                                                echo '<h4 class="mb-0">No Data</h4>';
                                            }

                                            mysqli_close($con);
                                            ?>
                                            <span style="font-size: 1.0rem; font-weight: bold; color: #7F8C8D;">Doctors</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-white text-black mb-4" style="height: 80%;">
                                    <div class="card-body d-flex align-items-center">
                                        <i class="fas fa-user-injured fa-4x" style="color: #3498DB;"></i>
                                        <div style="margin-left: 10px;">
                                            <?php
                                            $host = 'localhost';
                                            $username = 'root';
                                            $password = '';
                                            $database = 'data';

                                            $con = mysqli_connect($host, $username, $password, $database);

                                            if (!$con) {
                                                die('Unable to connect to the database. Check your connection parameters.');
                                            }

                                            $dash_category_query = "SELECT * FROM patient";
                                            $dash_category_query_run = mysqli_query($con, $dash_category_query);

                                            if ($tblevents_total = mysqli_num_rows($dash_category_query_run)) {
                                                echo '<h4 class="mb-0" style="color: #34495E; font-size: 40px;">' . $tblevents_total . ' </h4>';
                                            } else {
                                                echo '<h4 class="mb-0">No Data</h4>';
                                            }

                                            mysqli_close($con);
                                            ?>
                                            <span style="font-size: 1.0rem; font-weight: bold; color: #7F8C8D;">Patients</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-white text-black mb-4" style="height: 80%;">
                                    <div class="card-body d-flex align-items-center">
                                         <i class="fas fa-user-nurse fa-4x" style="color: #3498DB;"></i>
                                        <div style="margin-left: 10px;">
                                            <?php
                                            $host = 'localhost';
                                            $username = 'root';
                                            $password = '';
                                            $database = 'data';

                                            $con = mysqli_connect($host, $username, $password, $database);

                                            if (!$con) {
                                                die('Unable to connect to the database. Check your connection parameters.');
                                            }

                                            $dash_category_query = "SELECT * FROM patient";
                                            $dash_category_query_run = mysqli_query($con, $dash_category_query);

                                            if ($tblevents_total = mysqli_num_rows($dash_category_query_run)) {
                                                echo '<h4 class="mb-0" style="color: #34495E; font-size: 40px;">' . $tblevents_total . ' </h4>';
                                            } else {
                                                echo '<h4 class="mb-0">No Data</h4>';
                                            }

                                            mysqli_close($con);
                                            ?>
                                            <span style="font-size: 1.0rem; font-weight: bold; color: #7F8C8D;">Pharmacy Staff</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-white text-black mb-4" style="height: 80%;">
                                    <div class="card-body d-flex align-items-center">
                                        <i class="fas fa-cash-register fa-4x" style="color: #3498DB;"></i>
                                        <div style="margin-left: 10px;">
                                            <?php
                                            $host = 'localhost';
                                            $username = 'root';
                                            $password = '';
                                            $database = 'data';

                                            $con = mysqli_connect($host, $username, $password, $database);

                                            if (!$con) {
                                                die('Unable to connect to the database. Check your connection parameters.');
                                            }

                                            $dash_category_query = "SELECT * FROM patient";
                                            $dash_category_query_run = mysqli_query($con, $dash_category_query);

                                            if ($tblevents_total = mysqli_num_rows($dash_category_query_run)) {
                                                echo '<h4 class="mb-0" style="color: #34495E; font-size: 40px;">' . $tblevents_total . ' </h4>';
                                            } else {
                                                echo '<h4 class="mb-0">No Data</h4>';
                                            }

                                            mysqli_close($con);
                                            ?>
                                            <span style="font-size: 1.0rem; font-weight: bold; color: #7F8C8D;">Pharmacy Cashier</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-white text-black mb-4" style="height: 80%;">
                                    <div class="card-body d-flex align-items-center">
                                        <i class="fas fa-procedures fa-4x" style="color: #3498DB;"></i>
                                        <div style="margin-left: 10px;">
                                            <?php
                                            $host = 'localhost';
                                            $username = 'root';
                                            $password = '';
                                            $database = 'data';

                                            $con = mysqli_connect($host, $username, $password, $database);

                                            if (!$con) {
                                                die('Unable to connect to the database. Check your connection parameters.');
                                            }

                                            $dash_category_query = "SELECT * FROM patient";
                                            $dash_category_query_run = mysqli_query($con, $dash_category_query);

                                            if ($tblevents_total = mysqli_num_rows($dash_category_query_run)) {
                                                echo '<h4 class="mb-0" style="color: #34495E; font-size: 40px;">' . $tblevents_total . ' </h4>';
                                            } else {
                                                echo '<h4 class="mb-0">No Data</h4>';
                                            }

                                            mysqli_close($con);
                                            ?>
                                            <span style="font-size: 1.0rem; font-weight: bold; color: #7F8C8D;">Wards</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                                <div class="col-xl-3 col-md-6">
                                <div class="card bg-white text-black mb-4" style="height: 80%;">
                                    <div class="card-body d-flex align-items-center">
                                        <i class="fas fa-user-nurse fa-4x" style="color: #3498DB;"></i>
                                        <div style="margin-left: 10px;">
                                            <?php
                                            $host = 'localhost';
                                            $username = 'root';
                                            $password = '';
                                            $database = 'data';

                                            $con = mysqli_connect($host, $username, $password, $database);

                                            if (!$con) {
                                                die('Unable to connect to the database. Check your connection parameters.');
                                            }

                                            $dash_category_query = "SELECT * FROM patient";
                                            $dash_category_query_run = mysqli_query($con, $dash_category_query);

                                            if ($tblevents_total = mysqli_num_rows($dash_category_query_run)) {
                                                echo '<h4 class="mb-0" style="color: #34495E; font-size: 40px;">' . $tblevents_total . ' </h4>';
                                            } else {
                                                echo '<h4 class="mb-0">No Data</h4>';
                                            }

                                            mysqli_close($con);
                                            ?>
                                            <span style="font-size: 1.0rem; font-weight: bold; color: #7F8C8D;">ER Nurse</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-white text-black mb-4" style="height: 80%;">
                                    <div class="card-body d-flex align-items-center">
                                        <i class="fas fa-user-plus fa-3x" style="color: #3498DB;"></i>
                                        <div style="margin-left: 10px;">
                                          <?php
                                        $host = 'localhost';
                                        $username = 'root';
                                        $password = '';
                                        $database = 'data';

                                        $con = mysqli_connect($host, $username, $password, $database);

                                        if (!$con) {
                                            die('Unable to connect to the database. Check your connection parameters.');
                                        }

                                        // Modify the SQL query to count rows with status 'IN-PATIENT'
                                        $dash_category_query = "SELECT COUNT(*) AS count FROM admissionpatient WHERE status = 'IN-PATIENT'";
                                        $dash_category_query_run = mysqli_query($con, $dash_category_query);

                                        if ($row = mysqli_fetch_assoc($dash_category_query_run)) {
                                            $in_patient_count = $row['count'];
                                            echo '<h4 class="mb-0" style="color: #34495E; font-size: 40px;">' . $in_patient_count . ' </h4>';
                                        } else {
                                            echo '<h4 class="mb-0">No Data</h4>';
                                        }

                                        mysqli_close($con);
                                        ?>


                                            <span style="font-size: 1.0rem; font-weight: bold; color: #7F8C8D;"> Active Admitted Patient</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-white text-black mb-4" style="height: 80%;">
                                    <div class="card-body d-flex align-items-center">
                                        <i class="fas fa-file-invoice fa-4x" style="color: #3498DB;"></i>
                                        <div style="margin-left: 10px;">
                                          <?php
                                            $host = 'localhost';
                                            $username = 'root';
                                            $password = '';
                                            $database = 'data';

                                            $con = mysqli_connect($host, $username, $password, $database);

                                            if (!$con) {
                                                die('Unable to connect to the database. Check your connection parameters.');
                                            }

                                            $dash_category_query = "SELECT * FROM pharmacy_invoice";
                                            $dash_category_query_run = mysqli_query($con, $dash_category_query);

                                            if ($tblevents_total = mysqli_num_rows($dash_category_query_run)) {
                                                echo '<h4 class="mb-0" style="color: #34495E; font-size: 40px;">' . $tblevents_total . ' </h4>';
                                            } else {
                                                echo '<h4 class="mb-0">No Data</h4>';
                                            }

                                            mysqli_close($con);
                                            ?>
                                            <span style="font-size: 1.0rem; font-weight: bold; color: #7F8C8D;"> Invoice</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-white text-black mb-4" style="height: 80%;">
                                    <div class="card-body d-flex align-items-center">
                                        <i class="fas fa-truck fa-4x" style="color: #3498DB;"></i>
                                        <div style="margin-left: 10px;">
                                          <?php
                                            $host = 'localhost';
                                            $username = 'root';
                                            $password = '';
                                            $database = 'data';

                                            $con = mysqli_connect($host, $username, $password, $database);

                                            if (!$con) {
                                                die('Unable to connect to the database. Check your connection parameters.');
                                            }

                                            $dash_category_query = "SELECT * FROM pharmacy_suppliers";
                                            $dash_category_query_run = mysqli_query($con, $dash_category_query);

                                            if ($tblevents_total = mysqli_num_rows($dash_category_query_run)) {
                                                echo '<h4 class="mb-0" style="color: #34495E; font-size: 40px;">' . $tblevents_total . ' </h4>';
                                            } else {
                                                echo '<h4 class="mb-0">No Data</h4>';
                                            }

                                            mysqli_close($con);
                                            ?>
                                            <span style="font-size: 1.0rem; font-weight: bold; color: #7F8C8D;"> Supplier</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                           <div class="col-xl-3 col-md-6">
                            <div class="card bg-white text-black mb-4" style="height: 80%;">
                                <div class="card-body d-flex align-items-center">
                                    <i class="fas fa-file-invoice-dollar billing-icon fa-4x" style="color: red;"></i>
                                    <div style="margin-left: 10px;">
                                        <?php
                                        // Database connection
                                        $db = mysqli_connect('localhost', 'root', '', 'data') or die('Unable to connect. Check your connection parameters.');

                                        // Query to calculate total purchase amount
                                        $query_purchase = "SELECT SUM(grand_total) AS total_purchase FROM pharmacy_purchase_details";
                                        $result_purchase = mysqli_query($db, $query_purchase);
                                        $row_purchase = mysqli_fetch_assoc($result_purchase);
                                        $total_purchase = $row_purchase['total_purchase'];
                                        ?>

                                        
                                        <p style="margin: 0; color: #34495E; font-size: 20px; font-weight: bold;"><?php echo '₱' . number_format($total_purchase, 2); ?></p>
                                        <span style="font-size: 1.0rem; font-weight: bold; color: #7F8C8D;">Total Purchase</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        </div>
                        <div class="container mt-5">
<div class="container mt-5">
    <div class="card">
        <div class="card-body">
            <div class="row align-items-stretch" >
                <h1 style="font-size: 150%;">𝗜𝗻𝗰𝗼𝗺𝗲 𝗦𝘂𝗿𝘃𝗲𝘆</h1>
                <div class="first1" style="opacity: 0.9; border-top: 2px solid black;"></div><br>
                <div class="col-md-3">
                    <div class="card h-100 d-flex flex-column">
                        <div class="card-body text-center d-flex flex-column justify-content-between">
                            <h5 class="card-title">
                                <?php
                                // Database connection parameters
                                $host = 'localhost';
                                $username = 'root';
                                $password = '';
                                $database = 'data';

                                // Connect to the database
                                $con = mysqli_connect($host, $username, $password, $database);

                                // Check if the connection was successful
                                if (!$con) {
                                    die('Unable to connect to the database. Check your connection parameters.');
                                }

                                // Query to select total_amount from the invoice table
                                $query = "SELECT total_amount FROM pharmacy_invoice";

                                // Execute the query
                                $result = mysqli_query($con, $query);

                                // Initialize total income variable
                                $totalIncome = 0;

                                // Check if there are any rows returned by the query
                                if (mysqli_num_rows($result) > 0) {
                                    // Loop through each row of the result set
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        // Add the total_amount to the total income
                                        $totalIncome += $row['total_amount'];
                                    }
                                }

                                // Close the database connection
                                mysqli_close($con);

                                // Echo the total income
                                echo '₱' . $totalIncome;
                                ?>
                            </h5>
                            <p class="card-text" style="color: green;">Today's Income</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card h-100 d-flex flex-column">
                        <div class="card-body text-center d-flex flex-column justify-content-between">
                            <h5 class="card-title">
                                <?php
                                // Database connection parameters
                                $host = 'localhost';
                                $username = 'root';
                                $password = '';
                                $database = 'data';

                                // Connect to the database
                                $con = mysqli_connect($host, $username, $password, $database);

                                // Check if the connection was successful
                                if (!$con) {
                                    die('Unable to connect to the database. Check your connection parameters.');
                                }

                                // Get the start and end dates of the current week
                                $startOfWeek = date('Y-m-d', strtotime('last Monday'));
                                $endOfWeek = date('Y-m-d', strtotime('next Sunday'));

                                // Query to select total_amount from the invoice table for the current week
                                $weeklyQuery = "SELECT SUM(total_amount) AS weekly_income FROM pharmacy_invoice WHERE date BETWEEN '$startOfWeek' AND '$endOfWeek'";

                                // Execute the query
                                $weeklyResult = mysqli_query($con, $weeklyQuery);

                                // Get the total income for the current week
                                $weeklyIncome = mysqli_fetch_assoc($weeklyResult)['weekly_income'];

                                // Close the database connection
                                mysqli_close($con);

                                // Echo the total income for the current week
                                echo '₱' . $weeklyIncome;
                                ?>
                            </h5>
                            <p class="card-text" style="color: green;">This Week's Income</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card h-100 d-flex flex-column">
                        <div class="card-body text-center d-flex flex-column justify-content-between">
                            <h5 class="card-title">
                                <?php
                                // Database connection parameters
                                $host = 'localhost';
                                $username = 'root';
                                $password = '';
                                $database = 'data';

                                // Connect to the database
                                $con = mysqli_connect($host, $username, $password, $database);

                                // Check if the connection was successful
                                if (!$con) {
                                    die('Unable to connect to the database. Check your connection parameters.');
                                }

                                // Get the start and end dates of the current month
                                $startOfMonth = date('Y-m-01');
                                $endOfMonth = date('Y-m-t');

                                // Query to select total_amount from the invoice table for the current month
                                $monthlyQuery = "SELECT SUM(total_amount) AS monthly_income FROM pharmacy_invoice WHERE date BETWEEN '$startOfMonth' AND '$endOfMonth'";

                                // Execute the query
                                $monthlyResult = mysqli_query($con, $monthlyQuery);

                                // Get the total income for the current month
                                $monthlyIncome = mysqli_fetch_assoc($monthlyResult)['monthly_income'];

                                // Close the database connection
                                mysqli_close($con);

                                // Echo the total income for the current month
                                echo '₱' . $monthlyIncome;
                                ?>
                            </h5>
                            <p class="card-text" style="color: green;">This Month's Income</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card h-100 d-flex flex-column">
                        <div class="card-body text-center d-flex flex-column justify-content-between">
                            <h5 class="card-title">
                                <?php
                                // Database connection parameters
                                $host = 'localhost';
                                $username = 'root';
                                $password = '';
                                $database = 'data';

                                // Connect to the database
                                $con = mysqli_connect($host, $username, $password, $database);

                                // Check if the connection was successful
                                if (!$con) {
                                    die('Unable to connect to the database. Check your connection parameters.');
                                }

                                // Get the start and end dates of the current year
                                $startOfYear = date('Y-01-01');
                                $endOfYear = date('Y-12-t');

                                // Query to select total_amount from the invoice table for the current year
                                $yearlyQuery = "SELECT SUM(total_amount) AS yearly_income FROM pharmacy_invoice WHERE date BETWEEN '$startOfYear' AND '$endOfYear'";

                                // Execute the query
                                $yearlyResult = mysqli_query($con, $yearlyQuery);

                                // Get the total income for the current year
                                $yearlyIncome = mysqli_fetch_assoc($yearlyResult)['yearly_income'];

                                // Close the database connection
                                mysqli_close($con);

                                // Echo the total income for the current year
                                echo '₱' . $yearlyIncome;
                                ?>
                                </h5>
                                <p class="card-text" style="color: green;">This Year's Income</p>
                                </div>
                            </div>
                        </div>
                            <div class="card-body">
                                <div class="first1" style="opacity: 0.9; border-top: 2px solid black;"></div><br>
                                <canvas id="incomeChart" width="1000" height="200"></canvas>
                            </div>
                     </div>
                  </div>
             </div>
       </div>
    <script>
        // PHP code to fetch income values
        <?php
        // Database connection parameters
        $host = 'localhost';
        $username = 'root';
        $password = '';
        $database = 'data';

        // Connect to the database
        $con = mysqli_connect($host, $username, $password, $database);

        // Check if the connection was successful
        if (!$con) {
            die('Unable to connect to the database. Check your connection parameters.');
        }

        // Query to select total_amount from the invoice table
        $query = "SELECT SUM(total_amount) AS total_income FROM pharmacy_invoice";

        // Execute the query
        $result = mysqli_query($con, $query);

        // Initialize total income variable
        $totalIncome = mysqli_fetch_assoc($result)['total_income'];

        // Close the database connection
        mysqli_close($con);
        ?>

        // JavaScript code to create the bar graph
        var ctx = document.getElementById('incomeChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ["Today's Income", "This Week's Income", "This Month's Income", "This Year's Income"],
                datasets: [{
                    label: 'Income',
                    data: [
                        <?php echo $totalIncome; ?>, // Today's Income
                        <?php echo $weeklyIncome; ?>, // This Week's Income
                        <?php echo $monthlyIncome; ?>, // This Month's Income
                        <?php echo $yearlyIncome; ?>, // This Year's Income
                    ],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                    ],
                    borderWidth: 1
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
   </div><br><br>
<div class="head2" style="opacity: 0.9; border-top: 2px solid black;">
   <div class="container mt-5">
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    Patient Chart
                </div>
                <div class="card-body">
                    <canvas id="myLineChart" width="400" height="345"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    Patient List
                </div>
<div class="card-body">
    <table id="datatablesSimple" class="table">
        <thead>
            <tr>
                <th>Patient No.</th>
                <th>Hospital No.</th>
                <th>LastName</th>
                <th>First Name</th>
                <th>Middle Name</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = mysqli_fetch_array($results)) { ?>
                <tr>
                    <td>#<?php echo $row['id']; ?></td>
                    <td><?php echo $row['hospitalnum']; ?></td>
                    <td><?php echo $row['lastname']; ?></td>
                    <td><?php echo $row['firstname']; ?></td>
                    <td><?php echo $row['middlename']; ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<script>
    $(document).ready(function() {
        $('#datatablesSimple').DataTable({
            "pageLength": 5 // Set the number of entries per page to 5
        });
    });
</script>

            </div>
        </div>
    </div>
</div>
</div>
    <script>
        // Fetch data from PHP script
        fetch('PatientLineChartProcess.php')
            .then(response => response.json())
            .then(data => {
                renderChart(data);
            })
            .catch(error => console.error('Error fetching data:', error));

        function renderChart(data) {
            var ctx = document.getElementById('myLineChart').getContext('2d');
            var myLineChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
                    datasets: [{
                        label: 'Patient Count',
                        data: data,
                        fill: false,
                        borderColor: 'rgb(75, 192, 192)',
                        tension: 0.1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                stepSize: 5,
                                precision: 0 // Show only integer values
                            }
                        }
                    }
                }
            });
        }
    </script>

<br>

                        <div class="row">
                            <div class="col-xl-6">
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <i class="fas fa-chart-area me-1"></i>
                                        Area Chart Example
                                    </div>
                                    <div class="card-body"><canvas id="myAreaChart" width="100%" height="40"></canvas></div>
                                </div>
                            </div>
                            <div class="col-xl-6">
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <i class="fas fa-chart-bar me-1"></i>
                                        Bar Chart Example
                                    </div>
                                    <div class="card-body"><canvas id="myBarChart" width="100%" height="40"></canvas></div>
                                </div>
                            </div>
                        </div>
                </main>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/chart-area-demo.js"></script>
        <script src="assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
        <script src="js/datatables-simple-demo.js"></script>
    </body>
</html>
