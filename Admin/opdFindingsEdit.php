                                         <!-- PATIENT unique ID (FK)-->
<?php
// Database connection
$db = mysqli_connect('localhost', 'root', '') or die ('Unable to connect. Check your connection parameters.');
mysqli_select_db($db, 'database') or die(mysqli_error($db));

// Check if patient_id is set in the URL
if(isset($_GET['patient_id'])) {
    // Retrieve the patient's ID from the URL parameter
    $patient_id = $_GET['patient_id'];
    
    // Fetch the patient's details
    $query = "SELECT * FROM patient WHERE id = $patient_id";
    $result = mysqli_query($db, $query);
    
    // Check if a patient with the given ID exists
    if(mysqli_num_rows($result) > 0) {
        $patient = mysqli_fetch_assoc($result); 

        // Close the database connection
        mysqli_close($db);
    } else {
        echo "Patient not found!";
        exit; // Stop execution if patient not found
    }
} else {
    echo "Patient ID not provided!";
    exit; // Stop execution if patient_id not set in the URL
}
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


<article style="box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.5); height: 67%; width: 67%;">
    <div class="hello" style="background-color: #D5D8DC; height: 50px;">
        <h1 style="font-size: 25px; text-align: left; color: green; margin-bottom: 40px; padding: 10px;">
            <span style="margin-right: 280px;">ᴏᴘᴅ ꜰɪɴᴅɪɴɢꜱ</span>
                <a href="PatientView.php?id=<?php echo $patient['id']; ?>">
                    <i style="color: black;" class="fas fa-arrow-left"></i>
                </a>
        </h1>
    </div>
   
    <div class="card mb-4" id="formContainer">
        <div class="card-body">
              
                       <div style="display: grid; grid-template-columns: repeat(2, 1fr);">

<?php
$db = mysqli_connect('localhost', 'root', '', 'database') or die ('Unable to connect. Check your connection parameters.');

if(isset($_GET['patient_id'])) {
    $patient_id = $_GET['patient_id'];
    
    $query_patient = "SELECT * FROM patient WHERE id = $patient_id";
    $result_patient = mysqli_query($db, $query_patient);
    
    if(mysqli_num_rows($result_patient) > 0) {
        $patient = mysqli_fetch_assoc($result_patient);

        $query_vital_signs = "SELECT * FROM vital_signs WHERE patient_id = $patient_id";
        $result_vital_signs = mysqli_query($db, $query_vital_signs);

        if(mysqli_num_rows($result_vital_signs) > 0) {
            $vital_signs = mysqli_fetch_assoc($result_vital_signs);
        } else {
            echo "No vital signs recorded for this patient.";
        }
    } else {
        echo "Patient not found.";
    }
} else {
    echo "Patient ID not provided.";
}

mysqli_close($db);
?>



<form method="post" action="opdSubmitSave.php?patient_id=<?php echo $patient_id; ?>">
   <div style="display: grid; grid-template-columns: auto 1fr; gap: 10px; align-items: center;">
</div>
<br>

        <h1 style="font-size: 20px; margin-left: 0px;">VITAL SIGNS</h1>
    <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 10px; align-items: center;">
        <div>
            <h1 style="font-size: 15px; margin-top: 20px; color: gray;">RESPIRATORY RATE:</h1>
            <input type="text" name="respiratory_rate" value="<?php echo !empty($vital_signs['respiratory_rate']) ? $vital_signs['respiratory_rate'] : 'N/A'; ?>" style="width: 90%;">
        </div>
        <div>
            <h1 style="font-size: 15px; margin-top: 20px;  color: gray;">BLOOD PRESSURE:</h1>
            <input type="text" name="blood_pressure" value="<?php echo !empty($vital_signs['blood_pressure']) ? $vital_signs['blood_pressure'] : 'N/A'; ?>" style="width: 90%;">
        </div>
        <div>
            <h1 style="font-size: 15px; margin-top: 20px; color: gray;">CAPILLARY REFIL:</h1>
            <input type="text" name="capillary_refill" value="<?php echo !empty($vital_signs['capillary_refill']) ? $vital_signs['capillary_refill'] : 'N/A'; ?>" style="width: 90%;">
        </div>
    </div>
    <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 10px; align-items: center;">
        <div>
            <h1 style="font-size: 15px; margin-top: 20px; color: gray;">TEMPERATURE:</h1>
            <input type="text" name="temperature" value="<?php echo !empty($vital_signs['temperature']) ? $vital_signs['temperature'] : 'N/A'; ?>" style="width: 90%;">
        </div>
        <div>
            <h1 style="font-size: 15px; margin-top: 20px;  color: gray;">WEIGHT:</h1>
            <input type="text" name="weight" value="<?php echo !empty($vital_signs['weight']) ? $vital_signs['weight'] : 'N/A'; ?>" style="width: 90%;">
        </div>
        <div>
            <h1 style="font-size: 15px; margin-top: 20px; color: gray;">PULSE RATE:</h1>
            <input type="text" name="pulse_rate" value="<?php echo !empty($vital_signs['pulse_rate']) ? $vital_signs['pulse_rate'] : 'N/A'; ?>" style="width: 90%;">
        </div>
    </div><br>
    <div style="display: grid; grid-template-columns: auto 1fr; gap: 10px; align-items: center;">
        <div>
            <h1 style="font-size: 15px; margin-top: 15px; margin-left: 150px; color: gray;">PHYSICAL EXAMINATION:</h1>
            <input type="text" name="physical_examination" value="<?php echo !empty($vital_signs['physical_examination']) ? $vital_signs['physical_examination'] : 'N/A'; ?>" style="width: 105%; margin-left: 150px;">
        </div>
    </div>
    <div style="display: grid; grid-template-columns: auto 1fr; gap: 10px; align-items: center;">
        <div>
            <h1 style="font-size: 15px; margin-top: 15px; margin-left: 150px; color: gray;">DIAGNOSIS:</h1>
            <input type="text" name="diagnosis" value="<?php echo !empty($vital_signs['diagnosis']) ? $vital_signs['diagnosis'] : 'N/A'; ?>" style="width: 105%; margin-left: 150px;">
        </div>
    </div>
    <div style="display: grid; grid-template-columns: auto 1fr; gap: 10px; align-items: center;">
        <div>
            <h1 style="font-size: 15px; margin-top: 15px; margin-left: 150px; color: gray;">MEDICATION / TREATMENT:</h1>
            <input type="text" name="medication_treatment" value="<?php echo !empty($vital_signs['medication_treatment']) ? $vital_signs['medication_treatment'] : 'N/A'; ?>" style="width: 105%; margin-left: 150px;">
        </div>
    </div>
    <div style="display: grid; grid-template-columns: auto 1fr; gap: 10px; align-items: center;">
    <div>
        <h1 style="font-size: 15px; margin-top: 15px; margin-left: 150px; color: gray;">ATTENDING PHYSICIAN:</h1>
        <select name="attending_physician" id="attending_physician_input" style="width: calc(100% - 150px); margin-left: 150px; padding: 10px; border: 1px solid #ccc; border-radius: 5px;">
            <option value="" disabled selected>Select Physician</option>
            <option value="johnpaul">John Paul</option>
            <option value="rebecca">Rebecca</option>
        </select>
    </div>
</div>

<br><br>

    <!-- Add other pairs of h1 and input fields similarly -->

    <button type="submit">Submit</button>
</form>




</div>

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
