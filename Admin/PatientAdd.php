<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dropdown Example</title>
    <link rel="stylesheet" href="patient.css">
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome for icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
   
</head>

<style>
    body {
        background-color: #f4f6f6;
    }
        .form-container {
        background-color: #ffffff;
        border-radius: 10px;
        box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
        padding: 30px;
        max-width: 100%;
        margin: auto;
        margin-top: 20px;
    }
    .form-container h2 {
        font-size: 1.8em;
        font-weight: bold;
        color: #2c3e50;
        margin-bottom: 20px;
        text-align: center;
        border-bottom: 2px solid #b2babb;
        padding-bottom: 10px;
    }
    .form-label {
        font-weight: bold;
        color: #34495e;
    }
    .form-control {
        border-radius: 5px;
        border: 1px solid #b2babb;
        transition: border-color 0.3s ease;
    }
    .form-control:focus {
        border-color: #2980b9;
        box-shadow: 0px 0px 5px rgba(41, 128, 185, 0.3);
    }
    .form-row {
        display: flex;
        gap: 20px;
        margin-bottom: 15px;
    }
    .form-row .col-md-4,
    .form-row .col-md-3,
    .form-row .col-md-12 {
        flex: 1;
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
    <h3>𝖠𝖽𝖽 𝖯𝖺𝗍𝗂𝖾𝗇𝗍</h3>
<div class="haha">
    <p style="text-align: center;">
        <a href="InventoryDashboard1.php" style="text-decoration: none; color: inherit;">
            <i class="fas fa-home" style="color: #34495e;"></i> Home
        </a>
        <span style="margin: 0 10px;">›</span>
        𝖠𝖽𝖽 𝖯𝖺𝗍𝗂𝖾𝗇𝗍
    </p>
</div>


</div>
<div class="first1" style="opacity: 0.9; border-top: 2px solid #b2babb; margin-top: -20px;"></div>
</div>


  <!-- Main Content -->
    <div id="mainContent" class="main-content" style="margin-top: -80px;">
        <div class="form-container">
    <form  method="post" action="Addpatient1.php">
     <div class="form-row">
            <div class="col-md-4 mb-3">
                <h2 style="color: #1abc9c;">Outpatient Information Form</h2>
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
    </div>

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
</body>
</html>
