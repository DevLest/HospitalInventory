<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dropdown Example</title>
    <link rel="stylesheet" href="outpatient.css">
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
    display: flex;
    flex-wrap: wrap;
    gap: 20px;
    background-color: #ffffff;
    border-radius: 10px;
    box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
    padding: 30px;
    margin: auto;
    margin-top: 20px;
}

.button-card {
    position: relative;
    width: 500px;
    height: 200px;
    overflow: hidden;
    border-radius: 10px;
}

.background-image {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.3s ease;
}

.button-card:hover .background-image {
    transform: scale(1.1); /* Zoom-in effect on hover */
}

.overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    color: white;
    text-align: center;
    transition: background-color 0.3s ease;
}

.button-card:hover .overlay {
    background-color: rgba(255, 87, 34, 0.7);
}

.find-doctor-btn {
    margin-top: 10px;
    padding: 8px 16px;
    background-color: white;
    color: #FF5722; /* Button color */
    border: none;
    border-radius: 5px;
    font-weight: bold;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.find-doctor-btn:hover {
    background-color: #FF7043; /* Slightly darker color on hover */
    color: white;
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
        <a class="nav-link" href="PatientDashboard.php">
            <div class="sb-nav-link-content">
                <div class="sb-nav-link-icon"><i class="fas fa-home"></i></div>
                <span>𝖣𝖺𝗌𝗁𝖻𝗈𝖺𝗋𝖽</span>
            </div>
        </a>

        <a class="nav-link" href="OutpatientAdd.php">
            <div class="sb-nav-link-content">
                <div class="sb-nav-link-icon"><i class="fas fa-user"></i></div>
                <span>𝖠𝖽𝖽 𝖯𝖺𝗍𝗂𝖾𝗇t</span>
            </div>
        </a>
        <a class="nav-link" href="OutpatientList.php">
            <div class="sb-nav-link-content">
                <div class="sb-nav-link-icon"><i class="fas fa-receipt"></i></div>
                <span>𝖫𝗂𝗌𝗍 𝗈𝖿 𝖯𝖺𝗍𝗂𝖾𝗇𝗍𝗌</span>
            </div>
        </a>
        <a class="nav-link" href="Appointments.php">
            <div class="sb-nav-link-content">
                <div class="sb-nav-link-icon"><i class="fas fa-file-alt report-icon" title="Generate Report"></i></div>
                <span>Appointments</span>
            </div>
        </a>
    </div>
    <!-- Main Content -->
    <div id="mainContent" class="main-content">
       <div class="header-container">
    <h3>𝖠𝗉𝗉𝗈𝗂𝗇𝗍𝗆𝖾𝗇𝗍𝗌</h3>
<div class="haha">
    <p style="text-align: center;">
        <a href="InventoryDashboard1.php" style="text-decoration: none; color: inherit;">
            <i class="fas fa-home" style="color: #34495e;"></i> Home
        </a>
        <span style="margin: 0 10px;">›</span>
        𝖠𝗉𝗉𝗈𝗂𝗇𝗍𝗆𝖾𝗇𝗍𝗌
    </p>
</div>


</div>
<div class="first1" style="opacity: 0.9; border-top: 2px solid #b2babb; margin-top: -20px;"></div>
</div>


  <!-- Main Content -->
    <div id="mainContent" class="main-content" style="margin-top: -80px;">
        <h1 style="text-align: center; ">𝖬𝖤𝖣𝖨𝖢𝖠𝖫 𝖲𝖯𝖤𝖢𝖨𝖠𝖫𝖳𝖨𝖤𝖲</h1>
        <div class="form-container">
            <div class="button-card">
                <img src="img/radio.jpg" alt="Background" class="background-image">
                <div class="overlay">
                    <h3>Radiology</h3>
                    <a href="Cardiology.php">
                        <button class="find-doctor-btn">Find Doctor</button>
                    </a>

                </div>
            </div>
            <div class="button-card">
                <img src="img/gas.jpg" alt="Background" class="background-image">
                <div class="overlay">
                    <h3>Gastroenterology</h3>
                    <a href="Gastroenterology.php">
                        <button class="find-doctor-btn">Find Doctor</button>
                    </a>
                </div>
            </div>
            <div class="button-card">
                <img src="img/card.jpg" alt="Background" class="background-image">
                <div class="overlay">
                    <h3>Cardiology</h3>
                    <a href="Radiology.php">
                        <button class="find-doctor-btn">Find Doctor</button>
                    </a>
                </div>
            </div>
            <div class="button-card">
                <img src="img/ped.jpg" alt="Background" class="background-image">
                <div class="overlay">
                    <h3>Pediatricians</h3>
                    <a href="Pediatricians.php">
                        <button class="find-doctor-btn">Find Doctor</button>
                    </a>
                </div>
            </div>
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
