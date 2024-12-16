
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Dashboard - SB Admin</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>

        <style>
            body{
                background-color: #E5E7E9;
            }


        </style>
    </head>
    <body class="sb-nav-fixed" >
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark" >
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="Addpatient.php"> 🏥 HMCO</a>
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
                            <a class="nav-link" href="PharmacyDashboard.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Dashboard
                            </a>
                            
                           <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts1" aria-expanded="false" aria-controls="collapseLayouts1">
                            <div class="sb-nav-link-icon"><i class="fas fa-handshake"></i></div>
                            Customers
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapseLayouts1" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="PharmacyAddCostu.php">Add Customers</a>
                                <a class="nav-link" href="PharmacyListCostu.php">Manage Customers</a>
                            </nav>
                        </div>

                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts2" aria-expanded="false" aria-controls="collapseLayouts2">
                            <div class="sb-nav-link-icon"><i class="fas fa-pills "></i></div>
                            Medicines
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapseLayouts2" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="PharmacyListMed.php">Manage Medicines</a>
                                <a class="nav-link" href="PharmacyListMedStock.php">Manage Medicines Stock</a>
                            </nav>
                        </div>
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts3" aria-expanded="false" aria-controls="collapseLayouts2">
                            <div class="sb-nav-link-icon"><i class="fas fa-balance-scale"></i></div>
                            Invoice
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapseLayouts3" aria-labelledby="headingThree" data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="PharmacyAddInvoice.php">Add Invoice</a>
                                <a class="nav-link" href="PharmacyInvoiceList.php">Manage Invoice</a>
                            </nav>
                        </div>
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts4" aria-expanded="false" aria-controls="collapseLayouts2">
                            <div class="sb-nav-link-icon"><i class="fas fa-truck"></i></div>
                            Supplier
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapseLayouts4" aria-labelledby="headingFour" data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="PharmacyAddSupplier.php">Add Supplier</a>
                                <a class="nav-link" href="SupplierList.php">Manage Supplier</a>
                            </nav>
                        </div>
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts5" aria-expanded="false" aria-controls="collapseLayouts2">
                            <div class="sb-nav-link-icon"><i class="fas fa-shopping-cart"></i></div>
                            Purchase
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapseLayouts5" aria-labelledby="headingFive" data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="PharmacyAddPurchase.php">Add Purchase</a>
                                <a class="nav-link" href="PharmacyPurchaseList.php">Manage Purchase</a>
                            </nav>
                        </div>
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts6" aria-expanded="false" aria-controls="collapseLayouts2">
                            <div class="sb-nav-link-icon"><i class="fas fa-chart-line"></i></div>
                            Report
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapseLayouts6" aria-labelledby="headingSix" data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="PharmacyAddSupplier.php">Add Report</a>
                                <a class="nav-link" href="SupplierList.php">Manage Report</a>
                            </nav>
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
        
        <div class="row d-flex justify-content-left">
            <div class="col-xl-3 col-md-6">
                    <div class="card text-black mb-4" style="background-color: #E5E7E9; width: 150%; border-left: white; border-top: white; border-right: white; border-bottom: white;">
                                      <div>
                                            <h1 style="margin-left: 3%; margin-top: 1%;"><i class="fas fa-home"></i> Dashboard</h1>
                                            <p style="font-weight: bold; margin-left: 18%;">Home</p>
                                        </div>
                                </div>
                            </div>
                            
                <div class="col-xl-3 col-md-6">
                    <div class="card text-white mb-4" style="background-color: #D5D8DC; opacity: 0.9; width: 150%; margin-left: 55%; height: 90%; border-top: 3px solid red; border-bottom: 3px solid red; border-left: 3px solid red; border-right: 3px solid red;">
                        <div class="card-body" style="color: black; font-weight: bold; font-size: 18px;">Todays Report</div>
                            <?php
                                // Database connection
                                $db = mysqli_connect('localhost', 'root', '', 'database') or die('Unable to connect. Check your connection parameters.');

                                // Query to calculate total sales amount
                                $query_sales = "SELECT SUM(total_amount) AS total_sales FROM pharmacy_invoice";
                                $result_sales = mysqli_query($db, $query_sales);
                                $row_sales = mysqli_fetch_assoc($result_sales);
                                $total_sales = $row_sales['total_sales'];

                                // Query to calculate total purchase amount
                                $query_purchase = "SELECT SUM(grand_total) AS total_purchase FROM pharmacy_purchase_details";
                                $result_purchase = mysqli_query($db, $query_purchase);
                                $row_purchase = mysqli_fetch_assoc($result_purchase);
                                $total_purchase = $row_purchase['total_purchase'];
                                ?>

                                <table class="table table-bordered" style="border: 1px solid black; width: 90%; margin-left: 5%;">
                                    <thead>
                                        <tr style="color: black;">
                                            <th scope="col" style="border-color: black; text-align: left;">Total Sales</th>
                                            <th scope="col" style="border-color: black; text-align: left;">Total Purchase</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td style="border-color: black; text-align: left;"><?php echo $total_sales; ?></td>
                                            <td style="border-color: black; text-align: left;"><?php echo $total_purchase; ?></td>
                                        </tr>
                                    </tbody>
                                </table>

                                </div>
                            </div>
                        </div>
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

                        <div class="row d-flex justify-content-center"><br>
                <div class="col-xl-3 col-md-6">
                    <div class="card text-white mb-4" style="background-color: #D5D8DC; opacity: 0.9;  border-top: 3px solid #5DADE2; border-bottom: 3px solid #5DADE2; border-left: 3px solid #5DADE2; border-right: 3px solid #5DADE2; ">
                        <div class="card-body" style="color: black; font-weight: bold; font-size: 18px;">Total Costumer</div>
                                        <?php
                                        $host           = 'localhost'; 
                                        $username       = 'root';
                                        $password       = '';
                                        $database       = 'database'; 

                                        $con = mysqli_connect($host, $username, $password, $database);

                                        if (!$con) {
                                            die('Unable to connect to the database. Check your connection parameters.');
                                        }


                                        $dash_category_query = "SELECT * from patient";
                                        $dash_category_query_run = mysqli_query($con, $dash_category_query);

                                        if ($tblevents_total = mysqli_num_rows($dash_category_query_run)) {
                                            echo '<h4 class="mb-0" style="color: black; margin-left: 5%;">  ' . $tblevents_total . '  <i class="fas fa-caret-up" style="color: darkyellow;" style="color: black; "></i> </h4>';
                                        } else {
                                            echo '<h4 class="mb-0"> No Data </h4>';
                                        }

                                        mysqli_close($con);
                                        ?>
                                        
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="PharmacyListCostu.php">View Patients</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                       
                           
                                 <div class="col-xl-3 col-md-6">
                    <div class="card text-white mb-4" style="background-color: #D5D8DC; opacity: 0.9; border-top: 3px solid #5DADE2; border-bottom: 3px solid #5DADE2; border-left: 3px solid #5DADE2; border-right: 3px solid #5DADE2;">
                        <div class="card-body" style="color: black; font-weight: bold; font-size: 18px;">Total Supplier</div>
                                    <?php
                                        $host           = 'localhost';
                                        $username       = 'root';
                                        $password       = '';
                                        $database       = 'database'; 

                                        $con = mysqli_connect($host, $username, $password, $database);

                                        if (!$con) {
                                            die('Unable to connect to the database. Check your connection parameters.');
                                        }


                                        $dash_category_query = "SELECT * from pharmacy_suppliers";
                                        $dash_category_query_run = mysqli_query($con, $dash_category_query);

                                        if ($tblevents_total = mysqli_num_rows($dash_category_query_run)) {
                                            echo ' <h4 class="mb-0" style="color: black; margin-left: 5%;">  ' . $tblevents_total . '   <i class="fas fa-caret-up" style="color: darkyellow;" style="color: black; "></i> </h4>';
                                        } else {
                                            echo '<h4 class="mb-0"> No Data </h4>';
                                        }

                                        mysqli_close($con);
                                        ?>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="SupplierList.php">View Details</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-3 col-md-6">
                    <div class="card text-white mb-4" style="background-color: #D5D8DC; opacity: 0.9; border-top: 3px solid #5DADE2; border-bottom: 3px solid #5DADE2; border-left: 3px solid #5DADE2; border-right: 3px solid #5DADE2;">
                        <div class="card-body" style="color: black; font-weight: bold; font-size: 18px;">Total Medicine</div>
                                    <?php
                                        $host           = 'localhost';
                                        $username       = 'root';
                                        $password       = '';
                                        $database       = 'database'; 

                                        $con = mysqli_connect($host, $username, $password, $database);

                                        if (!$con) {
                                            die('Unable to connect to the database. Check your connection parameters.');
                                        }


                                        $dash_category_query = "SELECT * from pharmacy_medicine_details";
                                        $dash_category_query_run = mysqli_query($con, $dash_category_query);

                                        if ($tblevents_total = mysqli_num_rows($dash_category_query_run)) {
                                            echo ' <h4 class="mb-0" style="color: black; margin-left: 5%;">  ' . $tblevents_total . '  <i class="fas fa-caret-up" style="color: darkyellow;" style="color: black; "></i> </h4>';
                                        } else {
                                            echo '<h4 class="mb-0"> No Data </h4>';
                                        }

                                        mysqli_close($con);
                                        ?>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="PharmacyListMed.php">View Details</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="second">
                        <div class="row d-flex justify-content-center">
                <div class="col-xl-3 col-md-6">
                    <div class="card text-white mb-4" style="background-color: #D5D8DC; opacity: 0.9; border-top: 3px solid #5DADE2; border-bottom: 3px solid #5DADE2; border-left: 3px solid #5DADE2; border-right: 3px solid #5DADE2;">
                        <div class="card-body" style="color: black; font-weight: bold; font-size: 18px;">Out of Stocks</div>
                                        <?php
                                        $host = 'localhost';
                                        $username = 'root';
                                        $password = '';
                                        $database = 'database';

                                        $con = mysqli_connect($host, $username, $password, $database);

                                        if (!$con) {
                                            die('Hindi makakonekta sa database. Paki-check ang iyong mga connection parameter.');
                                        }

                                        $dash_category_query = "SELECT COUNT(*) AS low_stabs FROM pharmacy_medicine_details WHERE packing < 5";
                                        $dash_category_query_run = mysqli_query($con, $dash_category_query);

                                        if ($row = mysqli_fetch_assoc($dash_category_query_run)) {
                                            $low_stabs = $row['low_stabs'];
                                            echo '<h4 class="mb-0" style="color: black; margin-left: 5%;">' . $low_stabs . ' <i class="fas fa-caret-up" style="color: darkyellow;" style="color: black; "></i></h4>';
                                        } else {
                                            echo '<h4 class="mb-0">Walang Data</h4>';
                                        }

                                        mysqli_close($con);
                                        ?>


                                        
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="PharmacyListMedStock.php">View Patients</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                       
                           
                                 <div class="col-xl-3 col-md-6">
                    <div class="card text-white mb-4" style="background-color: #D5D8DC; opacity: 0.9; border-top: 3px solid #5DADE2; border-bottom: 3px solid #5DADE2; border-left: 3px solid #5DADE2; border-right: 3px solid #5DADE2;">
                        <div class="card-body" style="color: black; font-weight: bold; font-size: 18px;">Expired</div>
                                   <?php
                                    $host = 'localhost';
                                    $username = 'root';
                                    $password = '';
                                    $database = 'database';

                                    $con = mysqli_connect($host, $username, $password, $database);

                                    if (!$con) {
                                        die('Unable to connect to the database. Please check your connection parameters.');
                                    }

                                    $expiry_count_query = "SELECT COUNT(*) AS expiry_count FROM pharmacy_medicine_details WHERE YEAR(expiry_date) <= 2023";
                                    $expiry_count_result = mysqli_query($con, $expiry_count_query);
                                    $row = mysqli_fetch_assoc($expiry_count_result);
                                    $expiry_count = $row['expiry_count'];

                                    echo '<h4 class="mb-0" style="color: black; margin-left: 5%;">' . $expiry_count . ' <i class="fas fa-caret-up" style="color: darkyellow;" style="color: black; "></i></h4>';

                                    mysqli_close($con);
                                    ?>


                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="PharmacyListMedStock.php">View Details</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-3 col-md-6">
                    <div class="card text-white mb-4" style="background-color: #D5D8DC; opacity: 0.9; border-top: 3px solid #5DADE2; border-bottom: 3px solid #5DADE2; border-left: 3px solid #5DADE2; border-right: 3px solid #5DADE2;">
                        <div class="card-body" style="color: black; font-weight: bold; font-size: 18px;">Total Invoice</div>
                                    <?php
                                        $host           = 'localhost';
                                        $username       = 'root';
                                        $password       = '';
                                        $database       = 'database'; 

                                        $con = mysqli_connect($host, $username, $password, $database);

                                        if (!$con) {
                                            die('Unable to connect to the database. Check your connection parameters.');
                                        }


                                        $dash_category_query = "SELECT * from pharmacy_invoice";
                                        $dash_category_query_run = mysqli_query($con, $dash_category_query);

                                        if ($tblevents_total = mysqli_num_rows($dash_category_query_run)) {
                                            echo ' <h4 class="mb-0" style="color: black; margin-left: 5%;">  ' . $tblevents_total . '   <i class="fas fa-caret-up" style="color: darkyellow;" style="color: black; "></i> </h4>';
                                        } else {
                                            echo '<h4 class="mb-0"> No Data </h4>';
                                        }

                                        mysqli_close($con);
                                        ?>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="#">View Details</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div><br>
                                                      <!-- ANOTHER CLASS -->
                           
                        <div class="first1" style="opacity: 0.9; border-top: 2px solid black;">
                        </div>
                </main><br><br>
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
