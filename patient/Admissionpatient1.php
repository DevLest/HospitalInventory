<?php
require_once('../connection/dbconfig.php'); 


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the selected patient_id from the form
    $patient_id = isset($_POST["patient_id"]) ? $_POST["patient_id"] : '';

    // Fetch patient information based on the selected patient_id
    $patient_query = mysqli_query($conn, "SELECT * FROM patients WHERE id = '$patient_id'");
    $patient_row = mysqli_fetch_assoc($patient_query);

    if ($patient_row) {
        // Retrieve other form data
        $admittedby = isset($_POST["admittedby"]) ? $_POST["admittedby"] : '';
        $parent_name = isset($_POST["parent_name"]) ? $_POST["parent_name"] : '';
        $ward = isset($_POST["ward"]) ? $_POST["ward"] : '';
        $attending_physician = isset($_POST["attending_physician"]) ? $_POST["attending_physician"] : '';
        $chargeaccountto = isset($_POST["chargeaccountto"]) ? $_POST["chargeaccountto"] : '';
        $relationtoparent = isset($_POST["relationtoparent"]) ? $_POST["relationtoparent"] : '';
        $address = isset($_POST["address"]) ? $_POST["address"] : '';
        $mobilenumber = isset($_POST["mobilenumber"]) ? $_POST["mobilenumber"] : '';
        $totalpayment = isset($_POST["totalpayment"]) ? $_POST["totalpayment"] : '';

        // Query to insert data into patientadmission table
        $query = "INSERT INTO patientadmission
            (admission_id, patient_id, admittedby, parent_name, ward, attending_physician, chargeaccountto, relationtoparent, address, mobilenumber, totalpayment)
            VALUES (NULL, '$patient_id', '$admittedby', '$parent_name', '$ward', '$attending_physician', '$chargeaccountto', '$relationtoparent', '$address', '$mobilenumber', '$totalpayment')";
        mysqli_query($db, $query) or die('Error in updating record in Database: ' . mysqli_error($conn));
    }
}
?>



<?php
require_once('../connection/dbconfig.php'); 

// Retrieve the patient's ID from the URL parameter
$patient_id = $_GET['id'];

// Fetch the patient's details
$query = "SELECT * FROM patients WHERE id = $patient_id";
$result = mysqli_query($conn, $query);
$patient = mysqli_fetch_assoc($result);

// Close the database connection
mysqli_close($conn);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Patient Details - SB Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="css/styles.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-lZ3tHVqOMt3D+5Yh79+j4Kd/2ot2Z1AbMe9JHK1LTe8chH4cQbmHXU63zBqKtvQet1QIYb8b4cLDcXqJ4saDEA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <style>
        body{
                    background-color:#E5E7E9;
                }

        article {
          float: left;
          padding: 20px;
          width: 30%;
          background-color: #f1f1f1;
          height: 950px; /* only for demonstration, should be removed */

        }

        nav ul {
          list-style-type: none;
          padding: 0;
        }
        section::after {
          content: "";
          display: table;
          clear: both;


        }
         tr:nth-child(even) {
            background-color: #D6EEEE;
        }

        /* Responsive layout - makes the two columns/boxes stack on top of each other instead of next to each other, on small screens */
        @media (max-width: 600px) {
          nav, article {
            width: 100%;
            height: auto;

          }
           th {
        text-align: center;
    }
    </style>
</head>
<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <!-- Navbar Brand-->
        <a class="navbar-brand ps-3" href="Addpatient.php"> 🏥 HMCO</a>
        <!-- Sidebar Toggle-->
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
        <!-- Navbar Search-->
        <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
        </form>
        <!-- Navbar-->
        <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
            <li class="nav-item">
                <a class="nav-link" id="navbarDropdown" href="#" role="button" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
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
                        <a class="nav-link" href="Addpatient.php">
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
                    </div>
                </div>
            </nav>
        </div>
        <div id="layoutSidenav_content" style="margin-right: 20px;">
            <div class="container-fluid mt-3">
                <div class="container-fluid"><br>
                    <h1 style="text-align: center;">ᴘᴀᴛɪᴇɴᴛ ʀᴇᴄᴏʀᴅꜱ</h1><br><br>
                    <div class="row">
                    <div class="col-sm-3 col-md-6 text-black" style=" width: 800px; height: 80px; background-color: white; box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.5); border-radius: 10px;">
                        <h1 style="font-size: 23px; margin-top: 25px; color: green; display: inline-block;">ᴘᴀᴛɪᴇɴᴛ ɴᴀᴍᴇ:</h1>
                        <h2 style=" display: inline-block; font-size: 23px; margin-top: 25px; margin-left: 10px;"> <?php echo $patient['lastname'] . ', ' . $patient['firstname'] . ' ' . $patient['middlename']; ?></h2>
                    </div>
                    <div class="col-sm-9 col-md-6 text-black" style="margin-left: 20px; width: 400px; height: 80px; background-color: white; box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.5); border-radius: 10px;">
                        <h1 style="font-size: 23px; margin-top: 25px; color: green; display: inline-block;">ᴘᴀᴛɪᴇɴᴛ ɴᴜᴍʙᴇʀ:</h1><h2 style=" display: inline-block; font-size: 23px; margin-top: 25px; margin-left: 10px;">P-<?php echo $patient['id']; ?></h2>
                    </div>
                </div>
                </div><br>
            <div>
                <section style="display: flex; justify-content: space-between; padding: 0 20px;">
    <article style="box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.5); flex: 1; margin-right: 20px; width: 700px;">
        <div class="hello" style="background-color: #D5D8DC; height: 50px; width: 100%;">
            <h1 style="font-size: 25px; text-align: left; color: green; margin-bottom: 40px; padding: 10px;">
                <span style="margin-right: 180px;">ᴅᴇᴛᴀɪʟꜱ</span> <!-- Wrap "Details" text in a span -->
                <i style="color: black;" class="fas fa-edit"></i> <!-- Edit icon -->
            </h1>
        </div>  

                        <h1 style="font-size: 20px; margin-top: 25px; color: gray; display: inline-block;">ᴀᴅᴅʀᴇꜱꜱ: </h1>
                        <h2 style=" display: inline-block; font-size: 15px;  "> <?php echo $patient['address']; ?></h2>
                        <h1 style="font-size: 20px; margin-top: 20px; color: gray; display: inline-block;">ᴀɢᴇ:</h1><br>
                        <h2 style=" display: inline-block; font-size: 15px;  "> <?php echo $patient['age']; ?></h2><br>
                        <h1 style="font-size: 20px; margin-top: 20px; color: gray; display: inline-block;">ʙɪʀᴛʜᴅᴀʏ:</h1><br>
                        <h2 style=" display: inline-block; font-size: 15px;  "> <?php echo $patient['birthday']; ?></h2><br>
                        <h1 style="font-size: 20px; margin-top: 20px; color: gray; display: inline-block;">ʙɪʀᴛʜᴘʟᴀᴄᴇ:</h1><br>
                        <h2 style=" display: inline-block; font-size: 15px;  "> <?php echo $patient['birthplace']; ?></h2><br>
                        <h1 style="font-size: 20px; margin-top: 20px; color: gray; display: inline-block;">ᴄɪᴠɪʟ ꜱᴛᴀᴛᴜꜱ:</h1><br>
                        <h2 style=" display: inline-block; font-size: 15px;  "> <?php echo $patient['civilstatus']; ?></h2><br>
                        <h1 style="font-size: 20px; margin-top: 20px; color: gray; display: inline-block;">ɢᴇɴᴅᴇʀ:</h1><br>
                        <h2 style=" display: inline-block; font-size: 15px;  "> <?php echo $patient['gender']; ?></h2><br>
                        <h1 style="font-size: 20px; margin-top: 20px; color: gray; display: inline-block;">ʀᴇʟɪɢɪᴏɴ:</h1><br>
                        <h2 style=" display: inline-block; font-size: 15px;  "> <?php echo $patient['religion']; ?></h2><br>
                        <h1 style="font-size: 20px; margin-top: 20px; color: gray; display: inline-block;">ᴄᴏɴᴛᴀᴄᴛ ɴᴜᴍʙᴇʀ:</h1><br>
                        <h2 style=" display: inline-block; font-size: 15px;  "> <?php echo $patient['mobile']; ?></h2><br>
                        <h1 style="font-size: 20px; margin-top: 20px; color: gray; display: inline-block;">ᴏᴄᴄᴜᴘᴀᴛɪᴏɴ:</h1><br>
                        <h2 style=" display: inline-block; font-size: 15px;  "> <?php echo $patient['occupation']; ?></h2><br>
                        <h1 style="font-size: 20px; margin-top: 20px; color: gray; display: inline-block;">ᴅᴀᴛᴇ ᴀᴅᴅᴇᴅ:</h1><br>
                        <h2 style="display: inline-block; font-size: 15px; "><?php echo date('Y-m-d'); ?></h2><br>



                      </article>

<?php
require_once('../connection/dbconfig.php'); 


$query = "SELECT * FROM patients";
$results = mysqli_query($conn, $query);
?>
                  <article style="box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.5); height: 67%; width: 67%;">
                    <div class="hello" style="background-color: #D5D8DC; height: 50px;">
                        <h1 style="font-size: 25px; text-align: left; color: green; margin-bottom: 40px; padding: 10px;">
                            <span style="margin-right: 280px;">ᴏᴘᴅ ꜰɪɴᴅɪɴɢꜱ</span>
                            <a id="modalToggle2" href="Admissionpatient.php?id=<?php echo $patient['id']; ?>" style="text-decoration: none;">
                    <i style="color: black;" class="fas fa-plus"></i>
                </a>

                        </h1>
                    </div>
                    <div class="card mb-4" id="formContainer">
                    <div class="card mb-4">
                        <div class="card-body">
                            <table id="datatablesSimple">
                                <thead>
                                    <tr>
                                        <th style="text-align: center;">History of Present Illness</th>
                                        <th style="text-align: center;">Date Consulted</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th style="text-align: center;">History of Present Illness</th>
                                        <th style="text-align: center;">Date Consulted</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    <?php $counter = 1; ?>
                                    <?php while ($row = mysqli_fetch_array($results)) { ?>
                                        <tr>
                                            <td><?php echo $row['firstname']; ?></td>
                                            <td><?php echo $row['middlename']; ?></td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                    <script>
                    document.getElementById("modalToggle1").addEventListener("click", function() {
                        // Remove the table and replace it with the form
                        var formContainer = document.getElementById("formContainer");
                        formContainer.innerHTML = `
                            <div class="card-body">
                                <form>
                                    <!-- Add your form fields here -->
                                    <div class="modal-body">
                                     <form>
                                    <div class="mb-3">
                                        <label for="admittedBy" class="form-label">Admitted By</label>
                                        <input type="text" class="form-control" id="admittedBy" style="width: 400px;">
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 mb-3"><br>
                                        <label for="parentsName" class="form-label">For Minor: Name of Parents</label>
                                        <input type="text" class="form-control" id="parentsName" style="width: 400px;">
                                        </div>
                                        <div class="col-md-6 mb-3"><br>
                                        <label for="parentsName" class="form-label"></label>
                                        <input type="text" class="form-control" id="parentsName" style="width: 200px;">
                                        </div>
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="selectWard" class="form-label">Select Ward</label>
                                            <select class="form-select" id="selectWard">
                                                <option value="" disabled selected>Select Ward</option>
                                                <option value="johnpaul">John Paul</option>
                                                <option value="rebecca">Rebecca</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="selectPhysician" class="form-label">Attending Physician</label>
                                            <select class="form-select" id="selectPhysician">
                                                <option value="" disabled selected>Select Physician</option>
                                                <option value="johnpaul">John Paul</option>
                                                <option value="rebecca">Rebecca</option>
                                            </select>
                                        </div>
                                    <div class="row">
                                        <div class="col-md-6 mb-3"><br>
                                        <label for="chargeAccountTo" class="form-label">Charge Account To</label>
                                        <input type="text" class="form-control" id="chargeAccountTo">
                                        </div>
                                        <div class="col-md-6 mb-3"><br>
                                            <label for="selectPhysician" class="form-label">Attending Physician</label>
                                        <label for="relation" class="form-label">Relation to Parent</label>
                                        <input type="text" class="form-control" id="relation">
                                        </div>
                                    <div class="mb-3">
                                        <label for="address" class="form-label">Address</label>
                                        <textarea class="form-control" id="address" rows="3"></textarea>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 mb-3"><br>
                                        <label for="mobileNumber" class="form-label">Mobile Number/Telephone Number</label>
                                        <input type="text" class="form-control" id="mobileNumber">
                                        </div>
                                        <div class="col-md-6 mb-3"><br>
                                        <label for="totalPayment" class="form-label">Total Payment Made for Admission</label>
                                        <input type="text" class="form-control" id="totalPayment">
                                        </div>
                                </form>
                                </div>
                                    <!-- Add more form fields as needed -->
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                                    </div>
                                </form>
                            </div>
                        `;
                    });
                </script>

    <?php
    require_once('../connection/dbconfig.php'); 


    // Check if the form is submitted
    if(isset($_POST['save'])) {
        // Process your form data here
        // Assuming you have successfully inserted the data into the database
        $success_message = "Admission Form Succesfully Add!";
    }

    $query = "SELECT * FROM patientadmission WHERE patient_id = '$patient_id'";
    $results = mysqli_query($conn, $query);
    ?>
                        <div class="hello" style="background-color: #D5D8DC; height: 50px; ">
                            <h1 style="font-size: 25px; text-align: left; color: green; margin-bottom: 40px; padding: 10px;">
                                <span style="margin-right: 280px;">ᴀᴅᴍɪꜱꜱɪᴏɴ</span>
                                <a id="modalToggle2" href="Admissionpatient.php?id=<?php echo $patient['id']; ?>" style="text-decoration: none;">
                                    <i style="color: black;" class="fas fa-plus"></i>
                                </a>
                            </h1>
                        </div>
                        <div class="card mb-4">
                            <div class="card-body">
                <?php if(isset($success_message)) { ?>
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <?php echo $success_message; ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                            <?php } ?>
                                <table id="additionalTable">
                                    <thead>
                                        <tr>
                                            <th style="text-align: center;">Ward Admitted</th>
                                            <th style="text-align: center;">Admission Date</th>
                                            <th style="text-align: center;">Discharge Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $counter = 1; ?>
                                        <?php while ($row = mysqli_fetch_array($results)) { ?>
                                            <tr>
                                                <td><?php echo $row['ward']; ?></td>
                                                <td><?php echo date('Y-m-d'); ?></td>
                                                <td></td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>


                        </article>


                        <style>
                            /* Define border styles for the table */
                            #additionalTable {
                                border-collapse: collapse;
                                width: 100%;
                            }

                            #additionalTable th,
                            #additionalTable td {
                                border: 1px solid #dddddd;
                                text-align: left;
                                padding: 8px;
                            }

                            #additionalTable th {
                                background-color: #f2f2f2;
                            }
                        </style>




                </section>
                </div>
                </div>

                    </div>

                    </div>
                </div>
            </div>
        </div><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
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
