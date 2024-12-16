<?php
require_once('../connection/dbconfig.php'); 

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
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>


       <style>
                .form-container {
                    border: 2px solid #566573;
                    padding: 20px;
                    border-radius: 5px;
                    max-width: 95%; /* Adjust as needed */
                    margin: 0 auto;
                    border-radius: 10px;
                }
                .form-row {
                    display: flex;
                    flex-direction: row;
                    align-items: center;
                    margin-bottom: 10px;
                }
                .form-row label {
                    width: 150px;
                    margin-right: 10px;
                }
                .form-row input[type="text"],
                .form-row input[type="number"],
                .form-row input[type="date"],
                .form-row select {
                    flex: 1;
                    width: auto;
                }

                body{
                    background-color: #E5E7E9;
                }
                .form-row {
                display: flex;
                flex-wrap: wrap;
            }

            .form-item {
                flex: 1;
                margin-right: 10px; /* Adjust spacing between items */
                margin-bottom: 10px; /* Adjust spacing between rows */

            }

            .form-item label {
                display: block;
                margin-bottom: 5px;
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
</div><br><br>


<div class="form-container">
    <form  method="post" action="Addpatient1.php">
     <div class="form-row">
            <div class="col-md-4 mb-3">
                <h2>Outpatient Information Form</h2>
            </div>
            <div class="col-md-4 mb-3">
                <label for="hospitalnum" class="form-label" style="font-weight: bold; margin-left: 30%;">Hospital Number:</label>
                <input type="text" class="form-control" id="hospitalnum" name="hospitalnum" style="width: 50%; margin-left: 30%;" placeholder="Hospital number">
            </div>
            <div class="col-md-4 mb-3">
                <label for="date" class="form-label" style="font-weight: bold; margin-left: 30%;">Date:</label>
                <input type="date" class="form-control" id="date" name="date"  style="width: 50%; margin-left: 30%;" required>
            </div>
        </div>
        <div class="form-row">
            <div class="col-md-4 mb-3">
                <label for="lastname" class="form-label" style="font-weight: bold;">Last Name:</label>
                <input type="text" class="form-control" id="lastname" name="lastname" style="width: 90%;" placeholder="Lastname" required>
            </div>
            <div class="col-md-4 mb-3">
                <label for="firstname" class="form-label" style="font-weight: bold;">First Name:</label>
                <input type="text" class="form-control" id="firstname" name="firstname" style="width: 90%;" placeholder="Firstname" required>
            </div>
            <div class="col-md-4 mb-3">
                <label for="middlename" class="form-label" style="font-weight: bold;">Middle Name:</label>
                <input type="text" class="form-control" id="middlename" name="middlename" style="width: 90%;" placeholder="Middlename">
            </div>
        </div>

        <div class="form-row">
            <div class="col-md-12 mb-3">
                <label for="address" class="form-label" style="font-weight: bold;">Address:</label>
                <input type="text" class="form-control" id="address" name="address" style="width: 97%;" placeholder="Enter your Address" required>
            </div>
        </div>

        <div class="form-row">
            <div class="col-md-3 mb-3">
                <label for="age" class="form-label" style="font-weight: bold;">Age:</label>
                <input type="number" class="form-control" id="age" name="age" style="width: 90%;" placeholder="Age" required>
            </div>
            <div class="col-md-3 mb-3">
                <label for="birthday" class="form-label" style="font-weight: bold;">Birthday:</label>
                <input type="date" class="form-control" id="birthday" name="birthday" style="width: 90%;" required>
            </div>
            <div class="col-md-3 mb-3">
                <label for="birthplace" class="form-label" style="font-weight: bold;">Birthplace:</label>
                <input type="text" class="form-control" id="birthplace" name="birthplace" style="width: 90%;" placeholder="Birthplace" required>
            </div>
            <div class="col-md-3 mb-3">
                <label for="civilstatus" class="form-label" style="font-weight: bold;">Civil Status:</label>
                <input type="text" class="form-control" id="civilstatus" name="civilstatus" style="width: 90%;" placeholder="Civil status" required>
            </div>
        </div>
        <div class="form-row">
            <div class="col-md-3 mb-3">
                <label for="gender" class="form-label" style="font-weight: bold;">Gender:</label>
                <select id="gender" class="form-select" name="gender" style="width: 90%;" required>
                    <option value="">Select Gender</option>
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                    <option value="other">Other</option>
                </select>
            </div>
            <div class="col-md-3 mb-3">
                <label for="mobile" class="form-label" style="font-weight: bold;">Mobile Number:</label>
                <input type="tel" class="form-control" id="mobile" name="mobile" style="width: 90%;" placeholder="Mobile number" required>
            </div>
            <div class="col-md-3 mb-3">
                <label for="religion" class="form-label" style="font-weight: bold;">Religion:</label>
                <input type="text" class="form-control" id="religion" name="religion" style="width: 90%;" placeholder="Religion" required>
            </div>
            <div class="col-md-3 mb-3">
                <label for="occupation" class="form-label" style="font-weight: bold;">Occupation:</label>
                <input type="text" class="form-control" id="occupation" name="occupation" style="width: 90%;" placeholder="Occupation" required>
            </div>
        </div>
        <div class="modal-footer">
            <input type="submit" class="btn btn-primary" style="margin-left: 40%;" value="Add Record">
        </div>
    </form>
</div>


                     
                    </div><br><br>
                       
                            
                        
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
