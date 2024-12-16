<?php
session_name('ERNurseSession'); // Use the same session name as when the user logged in
session_start(); // Start session

// Check if user is logged in
if (!isset($_SESSION['username'])) {
    header('Location: login.php?error=Please log in first');
    exit();
}

// Page content for logged-in users
?>
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
$query = "SELECT created_at FROM er_patient";
$result = mysqli_query($con, $query);

// Initialize an array to store the count of patients for each month
$monthlyCounts = array_fill(1, 12, 0);

// Fetch data and update monthly counts
while ($row = mysqli_fetch_assoc($result)) {
    $created_at = $row['created_at'];
    $month = date('n', strtotime($created_at)); // Extract month (1-12)
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
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appointments List for <?php echo htmlspecialchars($specialty); ?></title>
    <link rel="stylesheet" href="outpatient.css">
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome for icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

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

<!-- Fixed Top Navigation -->
<div class="top-nav">

    <!-- Left-aligned logo and title -->
    <div class="icon-container">
        <img src="img/Hinigaran.png" alt="Logo">
        <h1>𝙷𝚒𝚗𝚒𝚐𝚊𝚛𝚊𝚗 𝙼𝚎𝚍𝚒𝚌𝚊𝚕 𝙲𝚕𝚒𝚗𝚒𝚌 𝙷𝚘𝚜𝚙𝚒𝚝𝚊𝚕</h1>
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
        <a class="nav-link" href="Erdashboard.php">
            <div class="sb-nav-link-content">
                <div class="sb-nav-link-icon"><i class="fas fa-home"></i></div>
                <span>𝖣𝖺𝗌𝗁𝖻𝗈𝖺𝗋𝖽</span>
            </div>
        </a>

        <a class="nav-link" href="NurseAdd.php">
            <div class="sb-nav-link-content">
                <div class="sb-nav-link-icon"><i class="fas fa-user"></i></div>
                <span>𝖠𝖽𝖽 𝖯𝖺𝗍𝗂𝖾𝗇t</span>
            </div>
        </a>
        <a class="nav-link" href="Nurselist.php">
            <div class="sb-nav-link-content">
                <div class="sb-nav-link-icon"><i class="fas fa-receipt"></i></div>
                <span>𝖫𝗂𝗌𝗍 𝗈𝖿 𝖯𝖺𝗍𝗂𝖾𝗇𝗍𝗌</span>
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


    <!-- Box Section with Bootstrap's grid system -->
    <div class="row"> <!-- Use row class to create a horizontal group of columns -->
       <div class="col-xl-3 col-md-6">
        <div class="card text-white mb-4" style="background-color: #DCC7AA; opacity: 0.9; box-shadow: 0 2px 5px rgba(0, 0, 0, 1.9);" >
            <div class="card-body" style="color: green; font-weight: bold; font-size: 22px;">𝖮𝗎𝗍𝖯𝖺𝗍𝗂𝖾𝗇𝗍𝗌</div>
        
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
                echo '<h4 class="mb-0" style="color: black; margin-left: 5%; font-size: 35px;">  ' . $tblevents_total . '  <i class="fas fa-user-injured patient-icon" style="color: black; "></i> </h4>';
            } else {
                echo '<h4 class="mb-0"> No Data </h4>';
            }

            mysqli_close($con);
            ?>

        
    </div>
</div>


        <!-- Repeat for other three columns -->
        <div class="col-xl-3 col-md-6">
        <div class="card text-white mb-4" style="background-color: #DCC7AA; opacity: 0.9; box-shadow: 0 2px 5px rgba(0, 0, 0, 1.9);" >
            <div class="card-body" style="color: green; font-weight: bold; font-size: 22px;">ER Nurse</div>
        
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
                echo ' <h4 class="mb-0" style="color: black; margin-left: 5%; font-size: 35px;">  ' . $tblevents_total . '  <i class="fas fa-user-nurse nurse-icon" style="color: black; "></i> </h4>';
            } else {
                echo '<h4 class="mb-0"> No Data </h4>';
            }

            mysqli_close($con);
            ?>

    </div>
</div>

      <div class="col-xl-3 col-md-6">
        <div class="card text-white mb-4" style="background-color: #DCC7AA; opacity: 0.9; box-shadow: 0 2px 5px rgba(0, 0, 0, 1.9);">
            <div class="card-body" style="color: green; font-weight: bold; font-size: 22px;">𝖠𝖼𝗍𝗂𝗏𝖾 𝖯𝖺𝗍𝗂𝖾𝗇𝗍'𝗌 𝖠𝖽𝗆𝗂𝗍𝗍𝖾𝖽</div>

                                    <?php
            $host = 'localhost';
            $username = 'root';
            $password = '';
            $database = 'database';

            $con = mysqli_connect($host, $username, $password, $database);

            if (!$con) {
                die('Unable to connect to the database. Check your connection parameters.');
            }


            $dash_category_query = "SELECT * from admission_refer";
            $dash_category_query_run = mysqli_query($con, $dash_category_query);

            if ($tblevents_total = mysqli_num_rows($dash_category_query_run)) {
                echo ' <h4 class="mb-0" style="color: black; margin-left: 5%; font-size: 35px;">  ' . $tblevents_total . '  <i class="fas fa-user" style="color: black; "></i> </h4>';
            } else {
                echo '<h4 class="mb-0"> No Data </h4>';
            }

            mysqli_close($con);
            ?>

    </div>
</div>

       

</div>
<div class="first1" style="opacity: 0.9; border-top: 2px solid #b2babb;"></div><br>

  <div class="row">
    <!-- Chart Section -->
    <div class="col-xl-6">
        <div class="card">
            <div class="card-body">
                <canvas id="myChart" width="297" height="250"></canvas>
            </div>
        </div>
    </div>

    <!-- Table Section -->


    <?php
// Database connection settings
$servername = "localhost";
$username = "root"; // Replace with your database username
$password = ""; // Replace with your database password
$dbname = "database"; // Replace with your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the count of 'Admitted' and 'Referred' statuses from the admission_refer table
$admittedQuery = "SELECT COUNT(*) AS total_admitted FROM admission_refer WHERE status = 'Admitted'";
$admittedResult = $conn->query($admittedQuery);
$admittedRow = $admittedResult->fetch_assoc();
$totalAdmitted = $admittedRow['total_admitted'];

$referredQuery = "SELECT COUNT(*) AS total_referred FROM admission_refer WHERE status = 'Referred'";
$referredResult = $conn->query($referredQuery);
$referredRow = $referredResult->fetch_assoc();
$totalReferred = $referredRow['total_referred'];

// Close connection
$conn->close();
?>
    <div class="col-xl-6">
        <!-- Pie Graph Section -->
             <div class="chart-container">
         <div class="container mt-6">
        <div class="card">
            <div class="card-header text-center">
                <h2>Admission Status: Admitted / Referred</h2>
            </div>
            <div class="card-body">
                <div style="width: 70%; margin: auto;">
                    <canvas id="myPieChart" width="300" height="300"></canvas>
                </div>
            </div>
        </div>
    </div>
    </div><br>


   <script>
        // PHP variables to JavaScript
        const totalAdmitted = <?php echo $totalAdmitted; ?>;
        const totalReferred = <?php echo $totalReferred; ?>;

        // Get the context of the canvas
        var ctx = document.getElementById('myPieChart').getContext('2d');

        // Create the pie chart
        var myPieChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: ['Admitted', 'Referred'],
                datasets: [{
                    data: [totalAdmitted, totalReferred],
                    backgroundColor: ['#66b3ff', '#ff9999'],  // Pie chart slice colors
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    tooltip: {
                        callbacks: {
                            label: function(tooltipItem) {
                                let label = tooltipItem.label;
                                let value = tooltipItem.raw;
                                let total = tooltipItem.dataset.data.reduce((a, b) => a + b, 0);
                                let percentage = ((value / total) * 100).toFixed(1);
                                return `${label}: ${value} (${percentage}%)`;
                            }
                        }
                    }
                }
            }
        });
    </script>

    </div><br>
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


    </div>
</div>
</div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">    <!--new -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
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
        function logout() {
            if (confirm("Are you sure you want to log out?")) {
                fetch('erlogout.php', {
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

