<?php
session_name('WardsSession'); // Use the same session name as when the user logged in
session_start(); // Start session

// Check if user is logged in
if (!isset($_SESSION['username'])) {
    header('Location: login.php?error=Please log in first');
    exit();
}

// Page content for logged-in users
?>
<?php
require_once('../connection/dbconfig.php'); 


// Query to fetch all dates from your table
$query = "SELECT date FROM patient";
$result = mysqli_query($conn, $query);

// Initialize an array to store the count of patients for each month
$monthlyCounts = array_fill(1, 12, 0);

// Fetch data and update monthly counts
while ($row = mysqli_fetch_assoc($result)) {
    $date = $row['date'];
    $month = date('n', strtotime($date)); // Extract month (1-12)
    $monthlyCounts[$month]++;
}

// Close the database connection

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
<?php
require_once('../connection/dbconfig.php'); 


// Fetch low stock items from pharmacy_medicines_products
$lowStockMedicinesQuery = "SELECT medicine_product, remain_quantity, expiry 
                           FROM pharmacy_medicines_products 
                           WHERE CAST(remain_quantity AS UNSIGNED) < 10";  // Adjust threshold as per your needs
$lowStockMedicinesResult = $conn->query($lowStockMedicinesQuery);

// Fetch low stock items from pharmacy_products
$lowStockProductsQuery = "SELECT product, remaining_quantity 
                          FROM pharmacy_products 
                          WHERE remaining_quantity < 20";  // Adjust threshold as per your needs
$lowStockProductsResult = $conn->query($lowStockProductsQuery);

// Fetch expiring medicines from pharmacy_medicines_products
$expiringMedicinesQuery = "SELECT medicine_product, expiry 
                           FROM pharmacy_medicines_products 
                           WHERE YEAR(expiry) = YEAR(CURDATE())";  // Fetch expiring this year
$expiringMedicinesResult = $conn->query($expiringMedicinesQuery);
?>
<!-- Bootstrap Modal for Low Stock and Expiring Medicines -->
<div class="modal fade" id="lowStockModal" tabindex="-1" role="dialog" aria-labelledby="lowStockModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header" style="background-color: #f4f6f6;">
        <div class="modal-title" id="lowStockModalLabel" style="font-weight: bold; font-size: 20px;">𝖫𝗈𝗐 𝖲𝗍𝗈𝖼𝗄 𝖺𝗇𝖽 𝖤𝗑𝗉𝗂𝗋𝗂𝗇𝗀 𝖬𝖾𝖽𝗂𝖼𝗂𝗇𝖾</div>
        <div class="flashing-signal" style="margin-left: 15px; margin-top: 9px;"></div>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <!-- Low Stock Medicines Table -->
        <h6>Low Stock Medicines</h6>
        <table class="table table-striped">
          <thead>
            <tr>
              <th>Medicine Name</th>
              <th>Remaining Quantity</th>
              <th>Expiry Date</th>
            </tr>
          </thead>
          <tbody>
            <?php
            if ($lowStockMedicinesResult->num_rows > 0) {
                while ($row = $lowStockMedicinesResult->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>{$row['medicine_product']}</td>";
                    echo "<td>{$row['remain_quantity']}</td>";
                    echo "<td>{$row['expiry']}</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='3' class='text-center'>No low stock medicines found.</td></tr>";
            }
            ?>
          </tbody>
        </table>

        <!-- Low Stock Products Table -->
        <h6>Low Stock Products</h6>
        <table class="table table-striped">
          <thead>
            <tr>
              <th>Product Name</th>
              <th>Remaining Quantity</th>
            </tr>
          </thead>
          <tbody>
            <?php
            if ($lowStockProductsResult->num_rows > 0) {
                while ($row = $lowStockProductsResult->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>{$row['product']}</td>";
                    echo "<td>{$row['remaining_quantity']}</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='2' class='text-center'>No low stock products found.</td></tr>";
            }
            ?>
          </tbody>
        </table>

        <!-- Expiring Medicines Table -->
        <h6>Expiring Medicines (This Year)</h6>
        <table class="table table-striped">
          <thead>
            <tr>
              <th>Medicine Name</th>
              <th>Expiry Date</th>
            </tr>
          </thead>
          <tbody>
            <?php
            if ($expiringMedicinesResult->num_rows > 0) {
                while ($row = $expiringMedicinesResult->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>{$row['medicine_product']}</td>";
                    echo "<td>{$row['expiry']}</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='2' class='text-center'>No expiring medicines found for this year.</td></tr>";
            }
            ?>
          </tbody>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

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
            require_once('../connection/dbconfig.php'); 


            $dash_category_query = "SELECT * from patient";
            $dash_category_query_run = mysqli_query($conn, $dash_category_query);

            if ($tblevents_total = mysqli_num_rows($dash_category_query_run)) {
                echo '<h4 class="mb-0" style="color: black; margin-left: 5%; font-size: 35px;">  ' . $tblevents_total . '  <i class="fas fa-user-injured patient-icon" style="color: black; "></i> </h4>';
            } else {
                echo '<h4 class="mb-0"> No Data </h4>';
            }

            ?>

        
    </div>
</div>


        <!-- Repeat for other three columns -->
        <div class="col-xl-3 col-md-6">
        <div class="card text-white mb-4" style="background-color: #DCC7AA; opacity: 0.9; box-shadow: 0 2px 5px rgba(0, 0, 0, 1.9);" >
            <div class="card-body" style="color: green; font-weight: bold; font-size: 22px;">𝖶𝖺𝗋𝖽𝗌</div>
        
        <?php
            require_once('../connection/dbconfig.php'); 



            $dash_category_query = "SELECT * from admissionpatient";
            $dash_category_query_run = mysqli_query($conn, $dash_category_query);

            if ($tblevents_total = mysqli_num_rows($dash_category_query_run)) {
                echo ' <h4 class="mb-0" style="color: black; margin-left: 5%; font-size: 35px;">  ' . $tblevents_total . '  <i class="fas fa-user-nurse nurse-icon" style="color: black; "></i> </h4>';
            } else {
                echo '<h4 class="mb-0"> No Data </h4>';
            }

            ?>

    </div>
</div>

      <div class="col-xl-3 col-md-6">
        <div class="card text-white mb-4" style="background-color: #DCC7AA; opacity: 0.9; box-shadow: 0 2px 5px rgba(0, 0, 0, 1.9);">
            <div class="card-body" style="color: green; font-weight: bold; font-size: 22px;">𝖠𝖼𝗍𝗂𝗏𝖾 𝖯𝖺𝗍𝗂𝖾𝗇𝗍'𝗌 𝖠𝖽𝗆𝗂𝗍𝗍𝖾𝖽</div>

                                    <?php
           require_once('../connection/dbconfig.php'); 


            $dash_category_query = "SELECT * from admissionpatient";
            $dash_category_query_run = mysqli_query($conn, $dash_category_query);

            if ($tblevents_total = mysqli_num_rows($dash_category_query_run)) {
                echo ' <h4 class="mb-0" style="color: black; margin-left: 5%; font-size: 35px;">  ' . $tblevents_total . '  <i class="fas fa-user" style="color: black; "></i> </h4>';
            } else {
                echo '<h4 class="mb-0"> No Data </h4>';
            }

            ?>

    </div>
</div>

       <div class="col-xl-3 col-md-6">
        <div class="card text-white mb-4" style="background-color: #DCC7AA; opacity: 0.9; box-shadow: 0 2px 5px rgba(0, 0, 0, 1.9);">
            <div class="card-body" style="color: green; font-weight: bold; font-size: 22px;">𝖠𝗉𝗉𝗈𝗂𝗇𝗍𝗆𝖾𝗇𝗍𝗌</div>

        <?php
require_once('../connection/dbconfig.php'); 

// Get today's date in the format 'YYYY-MM-DD'
$today = date('Y-m-d');

// Query to sum the total for today's receipts
$dash_category_query = "SELECT SUM(total) AS today_total FROM receipts WHERE DATE(created_at) = '$today'";
$dash_category_query_run = mysqli_query($conn, $dash_category_query);

// Fetch the result for receipts total
$row = mysqli_fetch_assoc($dash_category_query_run);
$today_total = $row['today_total'] ?? 0; // Default to 0 if no records found

// Query to count the total number of appointments in the appointments table
$appointment_query = "SELECT COUNT(*) AS total_appointments FROM appointments";
$appointment_query_run = mysqli_query($conn, $appointment_query);

// Fetch the result for appointments total
$appointment_row = mysqli_fetch_assoc($appointment_query_run);
$total_appointments = $appointment_row['total_appointments'] ?? 0; // Default to 0 if no records found



echo '<h4 class="mb-0" style="color: black; margin-left: 5%; z-index: 2; font-size: 25px; position: relative; font-size: 35px;">';
echo '' . $total_appointments . ' <i class="fas fa-calendar-check" style="color: black;"></i>';
echo '</h4>';

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
                <canvas id="myChart" width="297" height="200"></canvas>
            </div>
        </div>
    </div>

    <!-- Table Section -->
    <div class="col-xl-6">
<?php
    require_once('../connection/dbconfig.php'); 


    // Pagination setup
    $limit = 11; // Number of records per page
    if (isset($_GET['page']) && is_numeric($_GET['page'])) {
        $page = $_GET['page'];
    } else {
        $page = 1; // Default to page 1
    }
    $offset = ($page - 1) * $limit; // Offset calculation for the SQL query

    // Query to fetch appointments with the doctor name, limited to 11 records per page
    $query = "SELECT a.appointment_id, d.name AS doctor_name, 
                     a.first_name, a.last_name, a.appointment_date, a.status
              FROM appointments a
              JOIN doctors d ON a.doctor_id = d.doctor_id
              LIMIT $limit OFFSET $offset"; // Limit the number of results

    $result = mysqli_query($conn, $query);

    // Query to get the total number of records for pagination
    $count_query = "SELECT COUNT(*) AS total FROM appointments";
    $count_result = mysqli_query($conn, $count_query);
    $count_row = mysqli_fetch_assoc($count_result);
    $total_records = $count_row['total'];
    $total_pages = ceil($total_records / $limit); // Calculate total pages

    if ($result) {
        // Display the table with a label above it
        echo '<div class="card" style="height: 100%;">';
        echo '<div class="card-body">';
        
        // Adding a label on top of the table
        echo '<h4 class="card-title" style="color: green;">𝖠𝗉𝗉𝗈𝗂𝗇𝗍𝗆𝖾𝗇𝗍 𝖣𝖾𝗍𝖺𝗂𝗅𝗌</h4>';  // This is the label on top of the table

        echo '<table class="table table-bordered table-striped" style="color: black;">';
        echo '<thead>';
        echo '<tr>';
        echo '<th style="color: black;">Doctor</th>';
        echo '<th style="color: black;">First Name</th>';
        echo '<th style="color: black;">Last Name</th>';
        echo '<th style="color: black;">Appointment Date</th>';
        echo '<th style="color: black;">Status</th>';
        echo '</tr>';
        echo '</thead>';
        echo '<tbody>';

        // Loop through the rows and display data
        while ($row = mysqli_fetch_assoc($result)) {
            // Check the status and set background color for 'Pending'
            $status_class = ($row['status'] == 'Pending') ? 'style="background-color: yellow;"' : '';  // Yellow background for 'Pending'

            echo '<tr>';
            echo '<td>' . $row['doctor_name'] . '</td>';  // Display doctor's name
            echo '<td>' . $row['first_name'] . '</td>';
            echo '<td>' . $row['last_name'] . '</td>';
            echo '<td>' . $row['appointment_date'] . '</td>';
            echo '<td ' . $status_class . '>' . $row['status'] . '</td>'; // Apply yellow background to status if "Pending"
            echo '</tr>';
        }

        echo '</tbody>';
        echo '</table>';

        // Pagination controls inside the card view
        echo '<div class="card-footer">';
        echo '<div class="pagination" style="text-align: center;">';
        
        // Previous Button
        if ($page > 1) {
            echo '<a href="?page=' . ($page - 1) . '" class="btn btn-primary">Previous</a>';
        }

        // Page Number Info
        echo '<span> Page ' . $page . ' of ' . $total_pages . ' </span>';

        // Next Button
        if ($page < $total_pages) {
            echo '<a href="?page=' . ($page + 1) . '" class="btn btn-primary">Next</a>';
        }

        echo '</div>';
        echo '</div>';  // End card-footer
        echo '</div>';  // End card-body
        echo '</div>';  // End card
    } else {
        echo 'Error fetching appointments: ' . mysqli_error($conn);
    }

    // Close database connection
?>


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
                fetch('wardslogout.php', {
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

