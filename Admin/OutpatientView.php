                                         <!-- PATIENT unique ID (FK)-->
<?php
// Database connection
$db = mysqli_connect('localhost', 'root', '') or die ('Unable to connect. Check your connection parameters.');
mysqli_select_db($db, 'database') or die(mysqli_error($db));

// Retrieve the patient's ID from the URL parameter
$patient_id = $_GET['id'];

// Fetch the patient's details
$query = "SELECT * FROM patient WHERE id = $patient_id";
$result = mysqli_query($db, $query);
$patient = mysqli_fetch_assoc($result);

// Close the database connection
mysqli_close($db);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dropdown Example</title>
    <link rel="stylesheet" href="patient.css">
  <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="css/styles.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-lZ3tHVqOMt3D+5Yh79+j4Kd/2ot2Z1AbMe9JHK1LTe8chH4cQbmHXU63zBqKtvQet1QIYb8b4cLDcXqJ4saDEA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
   
</head>

<style>
    body {
        background-color: #f4f6f6;
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
        <a href="#logout">● Log Out</a>
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
    <!-- Main Content -->
    <div id="mainContent" class="main-content">
       <div class="header-container">
    <h3>𝖯𝖺𝗍𝗂𝖾𝗇𝗍 𝖱𝖾𝖼𝗈𝗋𝖽𝗌</h3>
<div class="haha">
    <p style="text-align: center;">
        <a href="InventoryDashboard1.php" style="text-decoration: none; color: inherit;">
            <i class="fas fa-home" style="color: #34495e;"></i> Home
        </a>
        <span style="margin: 0 10px;">›</span>
        𝖯𝖺𝗍𝗂𝖾𝗇𝗍 𝖱𝖾𝖼𝗈𝗋𝖽𝗌
    </p>
</div>


</div>
<div class="first1" style="opacity: 0.9; border-top: 2px solid #b2babb; margin-top: -20px;"></div>
</div><br>


<div id="mainContent" class="main-content" style="margin-top: -110px;">
<div id="layoutSidenav_content" style="margin-right: 20px;">
            <div class="container-fluid mt-3">
                <div class="container-fluid">
                                    <div class="row">
                    <div class="col-sm-3 col-md-6 text-black" style=" width: 790px; height: 80px; margin-left: 20px; background-color: white; box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.5); border-radius: 10px;">
                        <h1 style="font-size: 23px; margin-top: 25px; color: green; display: inline-block;">ᴘᴀᴛɪᴇɴᴛ ɴᴀᴍᴇ:</h1>
                        <h2 style=" display: inline-block; font-size: 23px; margin-top: 25px; margin-left: 5px;"> <?php echo $patient['lastname'] . ', ' . $patient['firstname'] . ' ' . $patient['middlename']; ?></h2>
                    </div>
                    <div class="col-sm-9 col-md-6 text-black" style="margin-left: 20px; width: 350px; height: 80px; background-color: white; box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.5); border-radius: 10px;">
                        <h1 style="font-size: 23px; margin-top: 25px; color: green; display: inline-block;">ʜᴏꜱᴘɪᴛᴀʟ ɴᴜᴍʙᴇʀ:</h1><h2 style=" display: inline-block; font-size: 23px; margin-top: 25px; margin-left: 10px;"> <?php echo $patient['hospitalnum']; ?></h2>
                    </div>
                </div>
                </div><br>
            <div>
                <section style="display: flex; justify-content: space-between; padding: 0 20px;">
    <article style="box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.5); flex: 1; margin-right: 20px; width: 700px;">
        <div class="hello" style="background-color: #D5D8DC; height: 50px; width: 100%;">
            <h1 style="font-size: 25px; text-align: left; color: green; margin-bottom: 40px; padding: 10px;">
                <span style="margin-right: 180px;">ᴅᴇᴛᴀɪʟꜱ</span> <!-- Wrap "Details" text in a span -->
                
            </h1>
        </div>  

                        <h1 style="font-size: 20px; margin-top: 25px; color: gray; display: inline-block;">ᴀᴅᴅʀᴇꜱꜱ: </h1>
                        <h2 style=" display: inline-block; font-size: 15px;  "> <?php echo $patient['address']; ?></h2><br>
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
                        <h2 style="display: inline-block; font-size: 15px; "><?php echo $patient['date']; ?></h2><br>



                      </article>

<?php
// Connect to the database
$db = mysqli_connect('localhost', 'root', '') or die ('Unable to connect. Check your connection parameters.');
mysqli_select_db($db, 'database') or die(mysqli_error($db));

// Initialize a variable to hold the success message
$success_message1 = '';

// Process the form submission for saving vital signs
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['save1'])) {
    // Get the selected patient_id from the form
    $patient_id = isset($_POST["patient_id"]) ? $_POST["patient_id"] : '';

    // Retrieve form data for vital signs
    $history_of_patient_illness = isset($_POST["history_of_patient_illness"]) ? $_POST["history_of_patient_illness"] : '';
    $attending_physician = isset($_POST["attending_physician"]) ? $_POST["attending_physician"] : '';
    $respiratory_rate = isset($_POST["respiratory_rate"]) ? $_POST["respiratory_rate"] : '';
    $blood_pressure = isset($_POST["blood_pressure"]) ? $_POST["blood_pressure"] : '';
    $capillary_refill = isset($_POST["capillary_refill"]) ? $_POST["capillary_refill"] : '';
    $temperature = isset($_POST["temperature"]) ? $_POST["temperature"] : '';
    $weight = isset($_POST["weight"]) ? $_POST["weight"] : '';
    $pulse_rate = isset($_POST["pulse_rate"]) ? $_POST["pulse_rate"] : '';

    // Insert data into vital_signs table
    $query = "INSERT INTO vital_signs 
            (patient_id, history_of_patient_illness, attending_physician, respiratory_rate, blood_pressure, capillary_refill, temperature, weight, pulse_rate)
            VALUES ('$patient_id', '$history_of_patient_illness', '$attending_physician', '$respiratory_rate', '$blood_pressure', '$capillary_refill', '$temperature', '$weight', '$pulse_rate')";

    if(mysqli_query($db, $query)) {
        // Data inserted successfully, set the success message
        $success_message1 = "Vital signs data inserted successfully!";
    } else {
        // Error occurred while inserting data
        echo "Error: " . $query . "<br>" . mysqli_error($db);
    }
}

// Fetch vital signs data for display
$query = "SELECT * FROM vital_signs WHERE patient_id = '$patient_id'";
$results = mysqli_query($db, $query);
?>

<article style="box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.5); height: 67%; width: 67%;">
    <div class="hello" style="background-color: #D5D8DC; height: 50px;">
        <h1 style="font-size: 25px; text-align: left; color: green; margin-bottom: 40px; padding: 10px;">
            <span style="margin-right: 280px;">ᴏᴘᴅ ꜰɪɴᴅɪɴɢꜱ</span>
            <a id="modalToggle2" href="#" style="text-decoration: none;">
                <i style="color: black;" class="fas fa-plus"></i>
            </a>
        </h1>
    </div>
   
    <div class="card mb-4" id="formContainer">
        <div class="card-body">
             <?php if (!empty($success_message1)) { ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?php echo $success_message1; ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php } ?>
            <table id="datatablesSimple">
                <thead>
                    <tr>
                        <th style="text-align: center;">History of Present Illness</th>
                        <th style="text-align: center;">Date Consulted</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Display vital signs data -->
                    <?php while ($row = mysqli_fetch_array($results)) { ?>
                        <tr>
                           <td><a href="opdEdit.php?patient_id=<?php echo $patient['id']; ?>&vital_signs_id=<?php echo $row['id']; ?>" style="text-decoration: none; font-weight: bold;"><?php echo $row['history_of_patient_illness']; ?></a></td>

                            <td><?php echo date('Y-m-d'); ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

<script>
    document.getElementById("modalToggle2").addEventListener("click", function(event) {
        event.preventDefault(); // Prevent the default behavior of the anchor element
        // Remove the table and replace it with the form
        var formContainer = document.getElementById("formContainer");
        formContainer.innerHTML = `
            <div class="card mb-4">
                <div class="card-body">
                    <form method="post">
                        <h1 style="font-size: 20px; margin-left: 380px;">VITAL SIGNS</h1>
                        <input type="hidden" name="patient_id" value="<?php echo $patient_id; ?>">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="history_of_patient_illness" class="form-label" style="margin-top: 25px;">HISTORY OF PATIENT ILLNESS</label>
                                    <input type="text" class="form-control" id="history_of_patient_illness" name="history_of_patient_illness">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-4 mb-3">
                                        <label for="respiratory_rate" class="form-label">Respiratory Rate</label>
                                        <input type="text" class="form-control" id="respiratory_rate" name="respiratory_rate">
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label for="blood_pressure" class="form-label">Blood Pressure</label>
                                        <input type="text" class="form-control" id="blood_pressure" name="blood_pressure">
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label for="capillary_refill" class="form-label" style="margin-left: 5px;">Capillary Refill</label>
                                        <input type="text" class="form-control" id="capillary_refill" name="capillary_refill">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="attending_physician" class="form-label">ATTENDING PHYSICIAN</label>
                                    <select class="form-select" id="attending_physician" name="attending_physician" style="width: 356px;">
                                        <option value="" disabled selected>Select Physician</option>
                                        <option value="johnpaul">John Paul</option>
                                        <option value="rebecca">Rebecca</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-4 mb-3">
                                        <label for="temperature" class="form-label">Temperature</label>
                                        <input type="text" class="form-control" id="temperature" name="temperature">
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label for="weight" class="form-label">Weight</label>
                                        <input type="text" class="form-control" id="weight" name="weight">
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label for="pulse_rate" class="form-label" style="margin-left: 5px;">Pulse Rate</label>
                                        <input type="text" class="form-control" id="pulse_rate" name="pulse_rate">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button id="backToTable" style="margin-right: 20px; color:" class="btn btn-primary">Back</button>
                            <button type="submit" class="btn btn-primary" name="save1">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        `;
    });

    document.getElementById("formContainer").addEventListener("click", function(e) {
        if (e.target && e.target.id == "closeForm") {
            // Restore the table when the close button is clicked
            var formContainer = document.getElementById("formContainer");
            formContainer.innerHTML = `
                <div class="card mb-4">
                    <div class="card-body">
                        <table id="datatablesSimple">
                            <!-- Table content -->
                        </table>
                    </div>
                </div>
            `;
        }
    });
</script>
<?php
$db = mysqli_connect('localhost', 'root', '') or die('Unable to connect. Check your connection parameters.');
mysqli_select_db($db, 'database') or die(mysqli_error($db));

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['save'])) {
    // Get the selected patient_id from the form
    $patient_id = isset($_POST["patient_id"]) ? $_POST["patient_id"] : '';

    // Fetch patient information based on the selected patient_id
    $patient_query = mysqli_query($db, "SELECT * FROM patient WHERE id = '$patient_id'");
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

        // Query to insert data into admissionpatient table
        $query = "INSERT INTO admissionpatient
            (admission_id, patient_id, admittedby, parent_name, ward, attending_physician, chargeaccountto, relationtoparent, address, mobilenumber, totalpayment, status)
            VALUES (NULL, '$patient_id', '$admittedby', '$parent_name', '$ward', '$attending_physician', '$chargeaccountto', '$relationtoparent', '$address', '$mobilenumber', '$totalpayment', 'IN PATIENT')";
        mysqli_query($db, $query) or die('Error in updating record in Database: ' . mysqli_error($db));
    }
}
?>


<?php
    $db = mysqli_connect('localhost', 'root', '') or die ('Unable to connect. Check your connection parameters.');
    mysqli_select_db($db, 'database') or die(mysqli_error($db));

    // Check if the form is submitted
    if(isset($_POST['save'])) {
        // Process your form data here
        // Assuming you have successfully inserted the data into the database
        $success_message = "Admission Form Succesfully Add!";
    }

    $query = "SELECT * FROM admissionpatient WHERE patient_id = '$patient_id'";
    $results = mysqli_query($db, $query);
    ?>
                          <div class="hello" style="background-color: #D5D8DC; height: 50px; ">
    <h1 style="font-size: 25px; text-align: left; color: green; margin-bottom: 40px; padding: 10px;">
        <span style="margin-right: 280px;">ᴀᴅᴍɪꜱꜱɪᴏɴ</span>
        <a id="modalToggle1" href="#" style="text-decoration: none;">
            <i style="color: black;" class="fas fa-plus"></i>
        </a>
    </h1>
</div>
<div class="card mb-4" id="formContainer1">
    <div class="card-body">
        <?php if (isset($success_message)) { ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?php echo $success_message; ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php } ?>
        <table id="additionalTable">
            <thead>
                <tr>
                    <th style="text-align: center; color: black;">Ward</th>
                    <th style="text-align: center; color: black;">Admission Date</th>
                    <th style="text-align: center; color: black;">Status</th>
                    <th style="text-align: center; color: black;">Discharge Date</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_array($results)) { ?>
                    <tr>
                        <td>
                            <a style="text-decoration: none; font-weight: bold; margin-left: 80px; color: #1ABC9C;">
                                <?php echo $row['ward']; ?>
                            </a>
                        </td>
                        <td><?php echo date('Y-m-d'); ?></td>
                        <td>
                            <button 
                                class="btn status-btn" 
                                style="background-color: <?php echo $row['status'] === 'IN PATIENT' ? '#28a745' : '#007bff'; ?>; color: white;" 
                                data-id="<?php echo $row['patient_id']; ?>"
                                data-status="<?php echo $row['status']; ?>">
                                <?php echo $row['status']; ?>
                            </button>
                        </td>
                        <td id="discharge-<?php echo $row['patient_id']; ?>">
                            <?php echo $row['discharge_date'] ?: ''; ?>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="dischargeModal" tabindex="-1" aria-labelledby="dischargeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="dischargeModalLabel">Discharge Patient</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="dischargeForm">
                    <input type="hidden" id="patientId" name="patient_id">
                    <div class="mb-3">
                        <label for="dischargeDate" class="form-label">Discharge Date</label>
                        <input type="date" class="form-control" id="dischargeDate" name="discharge_date" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Confirm Discharge</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        // Show modal when clicking on a status button
        document.querySelectorAll('.status-btn').forEach(button => {
            button.addEventListener('click', event => {
                event.preventDefault();
                const patientId = button.getAttribute('data-id');
                document.getElementById('patientId').value = patientId;
                new bootstrap.Modal(document.getElementById('dischargeModal')).show();
            });
        });

        // Handle the discharge form submission
        document.getElementById('dischargeForm').addEventListener('submit', event => {
            event.preventDefault();
            const formData = new FormData(event.target);

            fetch('update_discharge.php', {
                method: 'POST',
                body: formData,
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Update the Discharge Date column in the table
                    const patientId = formData.get('patient_id');
                    document.getElementById(`discharge-${patientId}`).textContent = formData.get('discharge_date');
                    // Hide the modal
                    bootstrap.Modal.getInstance(document.getElementById('dischargeModal')).hide();
                } else {
                    alert('Error: ' + data.message);
                }
            })
            .catch(error => console.error('Error:', error));
        });
    });
</script>

    <?php
    $db = mysqli_connect('localhost', 'root', '') or
            die ('Unable to connect. Check your connection parameters.');
            mysqli_select_db($db, 'database') or die(mysqli_error($db));

    $query = "SELECT * FROM admissionpatient";
    $results = mysqli_query($db, $query);
    ?>
                        <script>
                            document.getElementById("modalToggle1").addEventListener("click", function(event) {
                                event.preventDefault(); // Prevent the default behavior of the anchor element
                                // Remove the table and replace it with the form
                                var formContainer1 = document.getElementById("formContainer1");
                                formContainer1.innerHTML = `
                                    <div class="card mb-4">
                                        <div class="card-body">
                                            <form method="post">
                                                    <input type="hidden" name="patient_id" value="<?php echo $patient['id']; ?>">
                                                    <div class="mb-3">
                                                        <label for="admittedby" class="form-label">Admitted Name</label>
                                                        <input type="text" class="form-control" id="admittedby" name="admittedby" style="width: 400px;">
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6 mb-3">
                                                            <label for="parent_name" class="form-label">For Minor: Name of Parents</label>
                                                            <input type="text" class="form-control" id="parent_name" name="parent_name" style="width: 350px;">
                                                        </div>
                                                        <div class="col-md-6 mb-3">
                                                            <label for="ward" class="form-label">Select Ward</label>
                                                            <select class="form-select" id="ward" name="ward" style="width: 200px;">
                                                                <option value="" disabled selected>Select Ward</option>
                                                                <option value="johnpaul">John Paul</option>
                                                                <option value="rebecca">Rebecca</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6 mb-3">
                                                            <label for="attending_physician" class="form-label">Attending Physician</label>
                                                            <select class="form-select" id="attending_physician" name="attending_physician" style="width: 200px;">
                                                                <option value="" disabled selected>Select Physician</option>
                                                                <option value="johnpaul">John Paul</option>
                                                                <option value="rebecca">Rebecca</option>
                                                            </select>
                                                        </div>
                                                            <div class="col-md-6 mb-3">
                                                            <label for="mobilenumber" class="form-label">Mobile Number/Telephone Number</label>
                                                            <input type="text" class="form-control" id="mobilenumber" name="mobilenumber">
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6 mb-3">
                                                            <label for="relationtoparent" class="form-label">Relation to Parent</label>
                                                            <input type="text" class="form-control" id="relationtoparent" name="relationtoparent">
                                                        </div>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="address" class="form-label">Address</label>
                                                        <textarea class="form-control" id="address" name="address" rows="3"></textarea>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button id="backToTable" style="margin-right: 20px; color:" class="btn btn-primary">Back</button>
                                                        <button type="submit" class="btn btn-primary" name="save">Submit</button>
                                                    </div>
                                                </form>
                                        </div>
                                    </div>
                                `;
                            });

                             document.getElementById("formContainer1").addEventListener("click", function(e) {
                                if (e.target && e.target.id == "closeForm") {
                                    // Restore the table when the close button is clicked
                                    var formContainer1 = document.getElementById("formContainer1");
                                    formContainer1.innerHTML = `
                                        <div class="card mb-4">
                                            <div class="card-body">
                                                <table id="datatablesSimple">
                                                    <!-- Table content -->
                                                </table>
                                            </div>
                                        </div>
                                    `;
                                }
                            });
                        </script>

                                                    <!-- THIS WILL BE THE END OF ADMISSION -->

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
</body>
</html>
