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
                            <a class="nav-link" href="dashboard.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Dashboard
                            </a>
                            
                            <div class="sb-sidenav-menu-heading">Addons</div>
                            <a class="nav-link" href="Addpatient.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                                Add Patients
                            </a>
                            <a class="nav-link" href="ListPatient.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                                List of Patients
                            </a>
                            <a class="nav-link" href="wards.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-user-nurse"></i></div>
                            Wards logs
                        </a>

                        </div>
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
 <div class="row d-flex justify-content-center">
    <div class="col-xl-3 col-md-6">
        <div class="card text-white mb-4" style="background-color: #D5D8DC; opacity: 0.9;">
            <div class="card-body" style="color: green; font-weight: bold; font-size: 22px;">ᴏᴜᴛᴘᴀᴛɪᴇɴᴛꜱ</div>
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
                echo '<h4 class="mb-0" style="color: black; margin-left: 5%;">  ' . $tblevents_total . '  <i class="fas fa-user-injured patient-icon" style="color: black; "></i> </h4>';
            } else {
                echo '<h4 class="mb-0"> No Data </h4>';
            }

            mysqli_close($con);
            ?>

            <div class="card-footer d-flex align-items-center justify-content-between">
                <a class="small text-white stretched-link" href="ListPatient.php">View Patients</a>
                <div class="small text-white"><i class="fas fa-angle-right"></i></div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6">
        <div class="card text-white mb-4" style="background-color: #D5D8DC; opacity: 0.9;">
            <div class="card-body" style="color: green; font-weight: bold; font-size: 22px;">ᴡᴀʀᴅꜱ</div>
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
                echo ' <h4 class="mb-0" style="color: black; margin-left: 5%;">  ' . $tblevents_total . '  <i class="fas fa-user-nurse nurse-icon" style="color: black; "></i> </h4>';
            } else {
                echo '<h4 class="mb-0"> No Data </h4>';
            }

            mysqli_close($con);
            ?>

            <div class="card-footer d-flex align-items-center justify-content-between">
                <a class="small text-white stretched-link" href="wards.php">View Details</a>
                <div class="small text-white"><i class="fas fa-angle-right"></i></div>
            </div>
        </div>
    </div>
     <div class="col-xl-3 col-md-6">
        <div class="card text-white mb-4" style="background-color: #D5D8DC; opacity: 0.9;">
            <div class="card-body" style="color: green; font-weight: bold; font-size: 22px;">ᴀᴄᴛɪᴠᴇ ᴘᴀᴛɪᴇɴᴛꜱ ᴀᴅᴍɪᴛᴛᴇᴅ</div>
            <?php
                                        $host = 'localhost';
                                        $username = 'root';
                                        $password = '';
                                        $database = 'database';

                                        $con = mysqli_connect($host, $username, $password, $database);

                                        if (!$con) {
                                            die('Unable to connect to the database. Check your connection parameters.');
                                        }

                                        // Modify the SQL query to count rows with status 'IN-PATIENT'
                                        $dash_category_query = "SELECT COUNT(*) AS count FROM admissionpatient WHERE status = 'IN-PATIENT'";
                                        $dash_category_query_run = mysqli_query($con, $dash_category_query);

                                        if ($row = mysqli_fetch_assoc($dash_category_query_run)) {
                                            $in_patient_count = $row['count'];
                                            echo ' <h4 class="mb-0" style="color: black; margin-left: 5%;">  ' . $in_patient_count . '  <i class="fas fa-user-plus nurse-icon" style="color: black; "></i> </h4>';
                                        } else {
                                            echo '<h4 class="mb-0">No Data</h4>';
                                        }

                                        mysqli_close($con);
                                        ?>

            <div class="card-footer d-flex align-items-center justify-content-between">
                <a class="small text-white stretched-link" href="#">View Details</a>
                <div class="small text-white"><i class="fas fa-angle-right"></i></div>
            </div>
        </div>
    </div>
    <div class="col-xl-6">
        <div class="card">
            <div class="card-body">
                <canvas id="myChart" width="600" height="400"></canvas>
            </div>
        </div>
    </div>
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
                    beginAtZero: true
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


                        
                </main><br>
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
