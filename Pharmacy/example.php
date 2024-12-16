<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dropdown Example</title>
    <link rel="stylesheet" href="inventory.css">
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome for icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
</head>
     <style>
         body {
            background-color: #f4f6f6;
        }
        .box {
            border: 1px solid #ddd;
            padding: 20px;
            background-color: #f9f9f9;
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 20px;
            flex: 1 1 100%; /* Adjusts based on container width */
        }
        .box img {
            width: 80px; /* Set to a more responsive size */
            height: 80px;
            display: block;
            margin-bottom: 10px;
        }
        .box-content {
            display: flex;
            flex-direction: column;
            justify-content: center;
            text-align: center;
        }
        .text-below-image {
            font-size: 1rem;
            font-weight: bold;
        }
        .text-right {
            font-size: 0.9rem;
            color: #555;
        }
        .welcome-date-container {
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap; /* Ensure it adjusts on smaller screens */
            width: 100%;
            margin-bottom: 20px;
            padding: 0 2%;
        }
        .welcome {
            background-color: white; 
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3); 
            border-radius: 5px; 
            padding: 20px; /* Increased padding */
            font-size: 1.5rem;
            font-weight: normal; 
            margin-bottom: 10px; 
            flex-basis: 45%; 
            color: #555;
            height: 100%; /* Set a fixed height if desired */
        }
        .date-time {
            display: flex;
            flex-direction: column; /* Stack date and time vertically */
            align-items: center; /* Center align items */
            justify-content: center; /* Center vertically */
            text-align: center; /* Center text */
            background-color: black; 
            box-shadow: 0 4px 8px rgba(93, 173, 226, 1.8); /* Light blue shadow */
            border-radius: 5px; 
            padding: 20px; /* Increased padding */
            flex-basis: 45%; 
            color: #fff; /* Change to white for contrast */
            height: 100%; /* Set a fixed height if desired */
        }

        .time {
            display: block;
            margin-top: 5px;
            font-weight: bold;
        }

        /* Flexbox grid for box layout */
        .box-container {
            display: flex;
            flex-wrap: wrap;
            gap: 20px; /* Space between boxes */
            justify-content: space-between; /* Distribute boxes across the container */
        }
        .box {
            flex: 1 1 calc(25% - 20px); /* Four boxes in a row, accounting for gap */
            min-width: 250px; /* Minimum box size to prevent them from shrinking too much */
        }
        
        /* Make sure the content is responsive on smaller screens */
        @media (max-width: 768px) {
            .box {
                flex: 1 1 calc(50% - 20px); /* Two boxes per row on smaller screens */
            }
            .welcome, .date-time {
                flex-basis: 100%; /* Stack the welcome and date sections on smaller screens */
            }
        }

        @media (max-width: 480px) {
            .box {
                flex: 1 1 100%; /* One box per row on very small screens */
            }
        }

        .user-role {
            font-size: 1rem; /* Font size for the user role text */
            color: #555; /* Color for the user role text */
            margin-top: 5px; /* Spacing above the user role text */
        }
        .profile-header {
            border-bottom: 2px solid darkblue; /* Adjust the color and thickness as needed */
            padding-bottom: 5px; /* Space between the text and the line */
        }
        .card-background {
            background-image: url('path/to/your/image.jpg');
            background-size: cover; /* Adjusts the image to cover the entire div */
            background-position: center; /* Centers the image */
            opacity: 0.9; /* Optional: Adjust opacity */
        }

    </style>
</head>
<body>

    <!-- Top Navigation -->
    <div class="top-nav">
        <h2>My Website</h2>
    </div>

    <!-- Button to toggle side navigation -->
    <button class="toggle-btn" onclick="toggleNav()">☰</button>
    <div id="mySidenav" class="side-nav"><br>
        <a class="nav-link" href="InventoryDashboard.php">
            <div class="sb-nav-link-content">
                <div class="sb-nav-link-icon"><i class="fas fa-home"></i></div>
                <span>Dashboard</span>
            </div>
        </a>

        <!-- Medicines Section -->
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseMedicines" aria-expanded="false" aria-controls="collapseMedicines">
            <div class="sb-nav-link-content">
                <div class="sb-nav-link-icon"><i class="fas fa-handshake"></i></div>
                <span>Medicines</span>
                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-right"></i></div>
            </div>
        </a>
        <div class="collapse" id="collapseMedicines">
            <nav class="sb-sidenav-menu-nested nav">
                <a class="nav-link" href="AddMed_Product.php">Add Medicines</a>
                <a class="nav-link" href="Med_List.php">Medicines List</a>
            </nav>
        </div>

        <!-- Products Section -->
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseProducts" aria-expanded="false" aria-controls="collapseProducts">
            <div class="sb-nav-link-content">
                <div class="sb-nav-link-icon"><i class="fas fa-box"></i></div>
                <span>Products</span>
                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-right"></i></div>
            </div>
        </a>
        <div class="collapse" id="collapseProducts">
            <nav class="sb-sidenav-menu-nested nav">
                <a class="nav-link" href="AddProduct.php">Add Products</a>
                <a class="nav-link" href="Product_List.php">Products List</a>
            </nav>
        </div>
    </div>
    
  <div id="mainContent" class="main-content">
    <!-- Welcome and Date Section -->
    <div class="welcome-date-container">
        <div class="welcome">
            <div class="profile-header">
    <p style="font-size: 80%; color: darkblue; margin: 0;">Profile</p>
</div>

            <div></div>
            <h1 style="font-size: 100%;">Welcome JP</h1>
            <div class="user-role">You are logged in as ADMIN</div>
        </div>

        <div class="date-time">
            <span id="currentDate" style="font-size: 140%;"></span>
            <span class="time" id="currentTime" style="font-size: 150%;"></span>
        </div>
    </div>

    <!-- Box Section with Bootstrap's grid system -->
 <div class="container">
    <div class="row"> <!-- Use row class to create a horizontal group of columns -->
       <div class="col-xl-3 col-md-6">
        <div class="card text-white mb-4" style="position: relative; overflow: hidden;">
        <!-- Blurred background -->
        <div class="background-image" style="background-image: url('img/med.jpg'); background-size: cover; background-position: center; filter: blur(3px); position: absolute; top: 0; left: 0; right: 0; bottom: 0; z-index: 1;"></div>
        
        <div class="card-body" style="color: green; font-weight: bold; font-size: 22px; position: relative; z-index: 2;">𝖬𝖾𝖽𝗂𝖼𝗂𝗇𝖾𝗌</div>
        
        <?php
        $host = 'localhost';
        $username = 'root';
        $password = '';
        $database = 'database';

        $con = mysqli_connect($host, $username, $password, $database);

        if (!$con) {
            die('Unable to connect to the database. Check your connection parameters.');
        }

        $dash_category_query = "SELECT * from pharmacy_medicines_products";
        $dash_category_query_run = mysqli_query($con, $dash_category_query);

        if ($tblevents_total = mysqli_num_rows($dash_category_query_run)) {
            echo '<h4 class="mb-0" style="color: black; margin-left: 5%; z-index: 2; position: relative;">' . $tblevents_total . '  <i class="fas fa-user-injured patient-icon" style="color: black;"></i></h4>';
        } else {
            echo '<h4 class="mb-0" style="z-index: 2; position: relative;">No Data</h4>';
        }

        mysqli_close($con);
        ?>
        
        <div class="card-footer d-flex align-items-center justify-content-between" style="position: relative; z-index: 2;">
            <a class="small text-white stretched-link" href="ListPatient.php">View Patients</a>
            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
        </div>
    </div>
</div>


        <!-- Repeat for other three columns -->
        <div class="col-xl-3 col-md-6">
    <div class="card text-white mb-4" style="position: relative; overflow: hidden;">
        <!-- Blurred background -->
        <div class="background-image" style="background-image: url('img/prods.jpg'); background-size: cover; background-position: center; filter: blur(3px); position: absolute; top: 0; left: 0; right: 0; bottom: 0; z-index: 1;"></div>

        <div class="card-body" style="color: green; font-weight: bold; font-size: 22px; position: relative; z-index: 2;">𝖯𝗋𝗈𝖽𝗎𝖼𝗍𝗌</div>
        
        <?php
        $host = 'localhost';
        $username = 'root';
        $password = '';
        $database = 'database';

        $con = mysqli_connect($host, $username, $password, $database);

        if (!$con) {
            die('Unable to connect to the database. Check your connection parameters.');
        }

        $dash_category_query = "SELECT * from pharmacy_products";
        $dash_category_query_run = mysqli_query($con, $dash_category_query);

        if ($tblevents_total = mysqli_num_rows($dash_category_query_run)) {
            echo '<h4 class="mb-0" style="color: black; margin-left: 5%; z-index: 2; position: relative;">' . $tblevents_total . ' <i class="fas fa-user-injured patient-icon" style="color: black;"></i></h4>';
        } else {
            echo '<h4 class="mb-0" style="z-index: 2; position: relative;">No Data</h4>';
        }

        mysqli_close($con);
        ?>

        <div class="card-footer d-flex align-items-center justify-content-between" style="position: relative; z-index: 2;">
            <a class="small text-white stretched-link" href="ListPatient.php">View Patients</a>
            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
        </div>
    </div>
</div>

       <div class="col-xl-3 col-md-6">
    <div class="card text-white mb-4" style="position: relative; overflow: hidden;">
        <!-- Blurred background -->
        <div class="background-image" style="background-image: url('img/user.jpg'); background-size: cover; background-position: center; filter: blur(4px); position: absolute; top: 0; left: 0; right: 0; bottom: 0; z-index: 1; opacity: 0.9;"></div>

        <div class="card-body" style="color: green; font-weight: bold; font-size: 22px; position: relative; z-index: 2; ">𝖴𝗌𝖾𝗋𝗌</div>

        <?php
        $host = 'localhost';
        $username = 'root';
        $password = '';
        $database = 'database';

        $con = mysqli_connect($host, $username, $password, $database);

        if (!$con) {
            die('Unable to connect to the database. Check your connection parameters.');
        }

        $dash_category_query = "SELECT * from receipts";
        $dash_category_query_run = mysqli_query($con, $dash_category_query);

        if ($tblevents_total = mysqli_num_rows($dash_category_query_run)) {
            echo '<h4 class="mb-0" style="color: black; margin-left: 5%; z-index: 2; position: relative;">  ' . $tblevents_total . '  <i class="fas fa-user-injured patient-icon" style="color: black;"></i> </h4>';
        } else {
            echo '<h4 class="mb-0" style="z-index: 2; position: relative;"> No Data </h4>';
        }

        mysqli_close($con);
        ?>
        <div class="card-footer d-flex align-items-center justify-content-between" style="position: relative; z-index: 2;">
            <a class="small text-white stretched-link" href="ListPatient.php">View Patients</a>
            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
        </div>
    </div>
</div>

       <div class="col-xl-3 col-md-6">
    <div class="card text-white mb-4" style="position: relative; overflow: hidden;">
        <!-- Blurred background -->
        <div class="background-image" style="background-image: url('img/sale.jpg'); background-size: cover; background-position: center; filter: blur(5px); position: absolute; top: 0; left: 0; right: 0; bottom: 0; z-index: 1; opacity: 0.9;"></div>

        <div class="card-body" style="color: green; font-weight: bold; font-size: 22px; position: relative; z-index: 2;">𝖳𝗈𝖽𝖺𝗒'𝗌 𝖲𝖺𝗅𝖾</div>

        <?php
        $host = 'localhost';
        $username = 'root';
        $password = '';
        $database = 'database';

        $con = mysqli_connect($host, $username, $password, $database);

        if (!$con) {
            die('Unable to connect to the database. Check your connection parameters.');
        }

        // Get today's date in the format 'YYYY-MM-DD'
        $today = date('Y-m-d');

        // Query to sum the total for today's receipts
        $dash_category_query = "SELECT SUM(total) AS today_total FROM receipts WHERE DATE(created_at) = '$today'";
        $dash_category_query_run = mysqli_query($con, $dash_category_query);

        // Fetch the result
        $row = mysqli_fetch_assoc($dash_category_query_run);
        $today_total = $row['today_total'] ?? 0; // Default to 0 if no records found

        // Display the total amount for today
        echo '<h4 class="mb-0" style="color: black; margin-left: 5%; z-index: 2; position: relative;"> ' . number_format($today_total, 2) . ' <i class="fas fa-user-injured patient-icon" style="color: black;"></i></h4>';

        mysqli_close($con);
        ?>

        <div class="card-footer d-flex align-items-center justify-content-between" style="position: relative; z-index: 2;">
            <a class="small text-white stretched-link" href="ListPatient.php">View Patients</a>
            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
        </div>
    </div>
</div>

        <div class="col-xl-3 col-md-6">
    <div class="card text-white mb-4" style="position: relative; overflow: hidden;">
        <!-- Blurred background -->
        <div class="background-image" style="background-image: url('img/expired1.jpg'); background-size: cover; background-position: center; filter: blur(4px); position: absolute; top: 0; left: 0; right: 0; bottom: 0; z-index: 1; opacity: 0.9;"></div>

        <div class="card-body" style="color: green; font-weight: bold; font-size: 22px; position: relative; z-index: 2;">𝖤𝗑𝗉𝗂𝗋𝖾𝖽 𝖬𝖾𝖽𝗂𝖼𝗂𝗇𝖾𝗌</div>

        
        <?php
            $host = 'localhost';
            $username = 'root';
            $password = '';
            $database = 'database';

            $con = mysqli_connect($host, $username, $password, $database);

            if (!$con) {
                die('Unable to connect to the database. Check your connection parameters.');
            }

            // Get the current year
            $currentYear = date('Y');

            // Query to select expired medicines from this year
            $expired_medicines_query = "SELECT * FROM pharmacy_medicines_products WHERE YEAR(expiry) = '$currentYear' AND expiry < CURDATE()";
            $expired_medicines_query_run = mysqli_query($con, $expired_medicines_query);

            // Check if there are any expired medicines
            if (mysqli_num_rows($expired_medicines_query_run) > 0) {
                echo '<h4 class="mb-0" style="color: black; margin-left: 5%; z-index: 2; position: relative;">Expired Medicines This Year:</h4>';
                
                // Loop through each expired medicine and display its details
                while ($medicine = mysqli_fetch_assoc($expired_medicines_query_run)) {
                    echo '<div style="color: black; z-index: 2; position: relative;">';
                    echo 'Medicine Product: ' . htmlspecialchars($medicine['medicine_product']) . '<br>';
                    echo 'Generic Name: ' . htmlspecialchars($medicine['generic_name']) . '<br>';
                    echo 'Category: ' . htmlspecialchars($medicine['category']) . '<br>';
                    echo 'Expiry Date: ' . htmlspecialchars($medicine['expiry']) . '<br>';
                    echo '<hr>';
                    echo '</div>';
                }
            } else {
                echo '<h4 class="mb-0" style="color: black; margin-left: 3%; z-index: 2; position: relative;">No Expired Medicines</h4>';
            }

            mysqli_close($con);
        ?>

        <div class="card-footer d-flex align-items-center justify-content-between" style="position: relative; z-index: 2;">
            <a class="small text-white stretched-link" href="ListPatient.php">View Patients</a>
            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
        </div>
    </div>
</div>

        <div class="col-xl-3 col-md-6">
    <div class="card text-white mb-4" style="position: relative; overflow: hidden;">
        <!-- Blurred background -->
        <div class="background-image" style="background-image: url('img/low1.png'); background-size: cover; background-position: center; filter: blur(5px); position: absolute; top: 0; left: 0; right: 0; bottom: 0; z-index: 1;"></div>

        <div class="card-body" style="color: green; font-weight: bold; font-size: 22px; position: relative; z-index: 2;">𝖫𝗈𝗐 𝖲𝗍𝗈𝖼𝗄𝗌</div>
        
        <?php
            $host = 'localhost';
            $username = 'root';
            $password = '';
            $database = 'database';

            $con = mysqli_connect($host, $username, $password, $database);

            if (!$con) {
                die('Unable to connect to the database. Check your connection parameters.');
            }

            // Query to count low stock items from pharmacy_medicines_products
            $low_stock_medicines_query = "SELECT COUNT(*) AS low_stock_count FROM pharmacy_medicines_products WHERE CAST(registered_quantity AS UNSIGNED) < 15";
            $low_stock_medicines_query_run = mysqli_query($con, $low_stock_medicines_query);
            $low_stock_medicines_count = mysqli_fetch_assoc($low_stock_medicines_query_run)['low_stock_count'];

            // Query to count low stock items from pharmacy_products
            $low_stock_products_query = "SELECT COUNT(*) AS low_stock_count FROM pharmacy_products WHERE remaining_quantity < 15";
            $low_stock_products_query_run = mysqli_query($con, $low_stock_products_query);
            $low_stock_products_count = mysqli_fetch_assoc($low_stock_products_query_run)['low_stock_count'];

            // Calculate total low stock count
            $total_low_stock = $low_stock_medicines_count + $low_stock_products_count;

            // Display the total low stock count
            echo '<h4 class="mb-0" style="color: black; margin-left: 5%; z-index: 2; position: relative;"> ' . $total_low_stock . '</h4>';

            mysqli_close($con);
        ?>

        <div class="card-footer d-flex align-items-center justify-content-between" style="position: relative; z-index: 2;">
            <a class="small text-white stretched-link" href="ListPatient.php">View Patients</a>
            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
        </div>
    </div>
</div>

       <div class="col-xl-3 col-md-6">
    <div class="card text-white mb-4" style="position: relative; overflow: hidden;">
        <!-- Blurred background -->
        <div class="background-image" style="background-image: url('img/cashier1.webph'); background-size: cover; background-position: center; filter: blur(3px); position: absolute; top: 0; left: 0; right: 0; bottom: 0; z-index: 1;"></div>

        <div class="card-body" style="color: green; font-weight: bold; font-size: 22px; position: relative; z-index: 2;">𝖢𝖺𝗌𝗁𝗂𝖾𝗋</div>


        <div class="card-footer d-flex align-items-center justify-content-between" style="position: relative; z-index: 2;">
            <a class="small text-white stretched-link" href="ListPatient.php">View Patients</a>
            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
        </div>
    </div>
</div>

    </div>
</div>
</div>
     <div class="container mt-5">
        <h2 class="text-center">Monthly Sales Overview</h2>
        <div class="card">
            <div class="card-body">
                <canvas id="salesChart" width="400" height="200"></canvas>
            </div>
        </div>
    </div>

    <?php
    // PHP code to fetch monthly sales data
    $host = 'localhost';
    $username = 'root';
    $password = '';
    $database = 'database';

    $con = mysqli_connect($host, $username, $password, $database);

    if (!$con) {
        die('Unable to connect to the database. Check your connection parameters.');
    }

    // Query to get total sales grouped by month
    $sales_query = "SELECT SUM(total) AS monthly_total, MONTH(created_at) AS month FROM receipts WHERE YEAR(created_at) = YEAR(CURDATE()) GROUP BY MONTH(created_at)";
    $sales_query_run = mysqli_query($con, $sales_query);

    // Initialize an array to store monthly sales
    $sales_data = array_fill(0, 12, 0); // Default 12 months with 0 sales

    while ($row = mysqli_fetch_assoc($sales_query_run)) {
        $month = (int)$row['month'];
        $sales_data[$month - 1] = $row['monthly_total'];
    }

    // Pass the sales data as a JSON array to JavaScript
    echo '<script>var monthlySales = ' . json_encode($sales_data) . ';</script>';

    mysqli_close($con);
    ?>

    <script>
        // Labels for the months
        var months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];

        // Use Chart.js to create the line chart
        var ctx = document.getElementById('salesChart').getContext('2d');
        var salesChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: months,  // X-axis labels (Months)
                datasets: [{
                    label: 'Monthly Sales Overview',
                    data: monthlySales,  // Y-axis data (Sales totals)
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',  // Line fill color
                    borderColor: 'rgba(75, 192, 192, 1)',        // Line border color
                    borderWidth: 2
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
    </script>



    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
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
    </script>
     <script>
        // Function to display current date and time
        function updateDateTime() {
            const date = new Date();
            const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
            const formattedDate = date.toLocaleDateString('en-US', options);
            const formattedTime = date.toLocaleTimeString('en-US', { hour: '2-digit', minute: '2-digit' });

            document.getElementById('currentDate').innerText = formattedDate;
            document.getElementById('currentTime').innerText = formattedTime;
        }

        // Call the updateDateTime function every second
        setInterval(updateDateTime, 1000);
        // Initial call to set date and time immediately on page load
        updateDateTime();
    </script>
      <script>
        // Labels for the months
        var months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];

        // Use Chart.js to create the line chart
        var ctx = document.getElementById('salesChart').getContext('2d');
        var salesChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: months,  // X-axis labels (Months)
                datasets: [{
                    label: 'Monthly Sales Overview',
                    data: monthlySales,  // Y-axis data (Sales totals)
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',  // Line fill color
                    borderColor: 'rgba(75, 192, 192, 1)',        // Line border color
                    borderWidth: 2
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
    </script>
</body>
</html>
