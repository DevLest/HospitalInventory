<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dropdown Example</title>
    <link rel="stylesheet" href="Side.css">
    <link rel="stylesheet" href="Receipt.css">
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome for icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

</head>

<style>
    body {
        background-color: #f4f6f6;
    }
    /* Create the flashing red circle */
    .flashing-signal {
    animation: flashing 1s infinite; /* Adjust duration as needed */
        }

        @keyframes flashing {
            0% { opacity: 1; }
            50% { opacity: 0.5; }
            100% { opacity: 1; }
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
        <a class="nav-link" href="InventoryDashboard1.php">
            <div class="sb-nav-link-content">
                <div class="sb-nav-link-icon"><i class="fas fa-home"></i></div>
                <span>𝖣𝖺𝗌𝗁𝖻𝗈𝖺𝗋𝖽</span>
            </div>
        </a>

        <!-- Medicines Section -->
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseMedicines" aria-expanded="false" aria-controls="collapseMedicines">
            <div class="sb-nav-link-content">
                <div class="sb-nav-link-icon"><i class="fas fa-handshake"></i></div>
                <span>𝖬𝖺𝗇𝖺𝗀𝖾 𝖬𝖾𝖽𝗂𝖼𝗂𝗇𝖾𝗌</span>
                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-right"></i></div>
            </div>
        </a>
        <div class="collapse" id="collapseMedicines">
            <nav class="sb-sidenav-menu-nested nav">
                <a class="nav-link" href="AddMed_Product.php" style="width: 100%;">◽ Add Medicines</a>
                <a class="nav-link" href="Med_List.php" style="width: 100%;">◽ Medicines List</a>
            </nav>
        </div>

        <!-- Products Section -->
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseProducts" aria-expanded="false" aria-controls="collapseProducts">
            <div class="sb-nav-link-content">
                <div class="sb-nav-link-icon"><i class="fas fa-box"></i></div>
                <span>𝖬𝖺𝗇𝖺𝗀𝖾 𝖯𝗋𝗈𝖽𝗎𝖼𝗍</span>
                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-right"></i></div>
            </div>
        </a>
        <div class="collapse" id="collapseProducts">
            <nav class="sb-sidenav-menu-nested nav">
                <a class="nav-link" href="AddProduct.php" style="width: 100%;">◽ Add Products</a>
                <a class="nav-link" href="Product_List.php" style="width: 100%;">◽ Products List</a>
            </nav>
        </div>
        <a class="nav-link" href="PharmacyUser.php">
            <div class="sb-nav-link-content">
                <div class="sb-nav-link-icon"><i class="fas fa-user"></i></div>
                <span>𝖬𝖺𝗇𝖺𝗀𝖾 𝖴𝗌𝖾𝗋𝗌</span>
            </div>
        </a>
        <a class="nav-link" href="PharmacyReceipts.php">
            <div class="sb-nav-link-content">
                <div class="sb-nav-link-icon"><i class="fas fa-receipt"></i></div>
                <span>𝖱𝖾𝖼𝖾𝗂𝗉𝗍𝗌</span>
            </div>
        </a>
        <a class="nav-link" href="PharmacyReports.php">
            <div class="sb-nav-link-content">
                <div class="sb-nav-link-icon"><i class="fas fa-file-alt report-icon" title="Generate Report"></i></div>
                <span>𝖱𝖾𝗉𝗈𝗋𝗍𝗌</span>
            </div>
        </a>
    </div>
    <!-- Main Content -->
    <div id="mainContent" class="main-content">
       <div class="header-container">
    <h3>𝖱𝖾𝗉𝗈𝗋𝗍𝗌</h3>
<div class="haha">
    <p style="text-align: center;">
        <a href="InventoryDashboard1.php" style="text-decoration: none; color: inherit;">
            <i class="fas fa-home" style="color: #34495e;"></i> Home
        </a>
        <span style="margin: 0 10px;">›</span>
        𝖱𝖾𝗉𝗈𝗋𝗍𝗌
    </p>
</div>


</div>
<div class="first1" style="opacity: 0.9; border-top: 2px solid #b2babb; margin-top: -20px;"></div><br>

<div class="row"> 
    <!-- Today's Sales -->
    <div class="col-xl-3 col-md-6">
        <div class="card text-white mb-4" style="background-color: #DCC7AA; opacity: 0.9; box-shadow: 0 2px 5px rgba(0, 0, 0, 1.9);">
            <div class="card-body" style="color: green; font-weight: bold; font-size: 22px;">Today's Sales</div>
            
            <?php
            require_once('../connection/dbconfig.php'); 

            
            // Query to sum today's total sales
            $today_query = "SELECT SUM(total) as total_sales FROM receipts WHERE DATE(created_at) = CURDATE()";
            $today_result = mysqli_query($conn, $today_query);
            $today_sales = mysqli_fetch_assoc($today_result)['total_sales'] ?? 0;
            
            echo '<h4 class="mb-0" style="color: black; margin-left: 5%; font-size: 30px;"> ₱ ' . number_format($today_sales, 2) . ' </h4>';
            ?><br>
        </div>
    </div>
    
    <!-- Weekly Sales -->
    <div class="col-xl-3 col-md-6">
        <div class="card text-white mb-4" style="background-color: #DCC7AA; opacity: 0.9; box-shadow: 0 2px 5px rgba(0, 0, 0, 1.9);">
            <div class="card-body" style="color: green; font-weight: bold; font-size: 22px;">Weekly Sales</div>
            
            <?php
            // Query to sum weekly total sales
            $weekly_query = "SELECT SUM(total) as total_sales FROM receipts WHERE YEARWEEK(created_at, 1) = YEARWEEK(CURDATE(), 1)";
            $weekly_result = mysqli_query($conn, $weekly_query);
            $weekly_sales = mysqli_fetch_assoc($weekly_result)['total_sales'] ?? 0;
            
            echo '<h4 class="mb-0" style="color: black; margin-left: 5%; font-size: 30px;"> ₱ ' . number_format($weekly_sales, 2) . ' </h4>';
            ?><br>
        </div>
    </div>
    
    <!-- Monthly Sales -->
    <div class="col-xl-3 col-md-6">
        <div class="card text-white mb-4" style="background-color: #DCC7AA; opacity: 0.9; box-shadow: 0 2px 5px rgba(0, 0, 0, 1.9);">
            <div class="card-body" style="color: green; font-weight: bold; font-size: 22px;">Monthly Sales</div>
            
            <?php
            // Query to sum monthly total sales
            $monthly_query = "SELECT SUM(total) as total_sales FROM receipts WHERE MONTH(created_at) = MONTH(CURDATE()) AND YEAR(created_at) = YEAR(CURDATE())";
            $monthly_result = mysqli_query($conn, $monthly_query);
            $monthly_sales = mysqli_fetch_assoc($monthly_result)['total_sales'] ?? 0;
            
            echo '<h4 class="mb-0" style="color: black; margin-left: 5%; font-size: 30px;"> ₱ ' . number_format($monthly_sales, 2) . ' </h4>';
            ?><br>
        </div>
    </div>
    
    <!-- Yearly Sales -->
    <div class="col-xl-3 col-md-6">
        <div class="card text-white mb-4" style="background-color: #DCC7AA; opacity: 0.9; box-shadow: 0 2px 5px rgba(0, 0, 0, 1.9);">
            <div class="card-body" style="color: green; font-weight: bold; font-size: 22px;">Yearly Sales</div>
            
            <?php
            // Query to sum yearly total sales
            $yearly_query = "SELECT SUM(total) as total_sales FROM receipts WHERE YEAR(created_at) = YEAR(CURDATE())";
            $yearly_result = mysqli_query($conn, $yearly_query);
            $yearly_sales = mysqli_fetch_assoc($yearly_result)['total_sales'] ?? 0;
            
            echo '<h4 class="mb-0" style="color: black; margin-left: 5%; font-size: 30px;"> ₱ ' . number_format($yearly_sales, 2) . '</h4>';
            ?><br>
        </div>
    </div>
</div>



 <?php
require_once('../connection/dbconfig.php'); 


// Fetch user data
$query = "SELECT * FROM users"; // Modify as needed for your specific needs
$result = $conn->query($query);
?> 
<?php
// Pagination setup for login history
$historyLimit = 11; 
$historyPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$historyOffset = ($historyPage - 1) * $historyLimit;

$historySearchQuery = '';
if (isset($_POST['search'])) {
    $historyTerm = $conn->real_escape_string($_POST['search']);
    $historySearchQuery = "WHERE username LIKE '%$historyTerm%' AND role IN ('Pharmacy Admin', 'Pharmacy Cashier', 'Pharmacy Staff')";
}

// Count total login records
$totalHistoryQuery = "SELECT COUNT(*) as total FROM login_history $historySearchQuery";
$totalHistoryResult = $conn->query($totalHistoryQuery);
$totalHistoryRow = $totalHistoryResult->fetch_assoc();
$totalHistoryRecords = $totalHistoryRow['total'];
$totalHistoryPages = ceil($totalHistoryRecords / $historyLimit);

// Fetch login history with pagination and search
$loginHistoryQuery = "SELECT username, role, shift, time_in, time_out, login_date, status 
                      FROM login_history 
                      $historySearchQuery 
                      ORDER BY login_date DESC, time_in DESC 
                      LIMIT $historyLimit OFFSET $historyOffset";
$loginHistoryResult = $conn->query($loginHistoryQuery);
?>

<div class="card mt-4" style=" box-shadow: 0 2px 5px rgba(0, 0, 0, 0.9);">
    <div class="card-header" style="background-color: #34495e;">
        <h5 class="mb-0" style="color: white;"><i class="fas fa-user" style="color: white;"></i> 𝖯𝗁𝖺𝗋𝗆𝖺𝖼𝗒 𝖢𝖺𝗌𝗁𝗂𝖾𝗋 / 𝖲𝗍𝖺𝖿𝖿 ,<span style="margin-left: 20px;"> 𝖫𝗈𝗀𝗂𝗇/𝖫𝗈𝗀𝗈𝗎𝗍 𝖧𝗂𝗌𝗍𝗈𝗋𝗒</span></h5>
        <form method="POST" class="form-inline mt-2">
            <input type="text" name="search" class="form-control mr-2" placeholder="Search Username" value="<?php echo isset($historyTerm) ? $historyTerm : ''; ?>">
            <button type="submit" class="btn btn-primary">Search</button>
        </form>
    </div>
    <div class="card-body">
        <table class="table table-bordered">
            <thead class="thead-light">
                <tr>
                    <th>Username</th>
                    <th>Role</th>
                    <th>Shift</th>
                    <th>Date</th>
                    <th>Log In</th>
                    <th>Status</th>
                    <th>Log Out</th>
                </tr>
            </thead>
            <tbody>
    <?php
    if ($loginHistoryResult->num_rows > 0) {
        while ($row = $loginHistoryResult->fetch_assoc()) {
            echo "<tr>";
            echo "<td>{$row['username']}</td>";
            echo "<td>{$row['role']}</td>";
            echo "<td>{$row['shift']}</td>";
            echo "<td>{$row['login_date']}</td>";
            echo "<td><span style='font-weight: bold;'>" . date("g:i a", strtotime($row['time_in'])) . "</span></td>";
            // Status with icons (Active / Inactive)
           if ($row['status'] === 'Active') {
                    $statusIcon = '<i class="fas fa-circle flashing-signal" style="color: green;"></i> 𝘼𝙘𝙩𝙞𝙫𝙚'; // Green for Active
                } else {
                    $statusIcon = '<i class="fas fa-circle" style="color: red;"></i> 𝙉𝙤𝙩 𝘼𝙘𝙩𝙞𝙫𝙚'; // Red for Inactive
                }

            echo "<td>{$statusIcon}</td>";
             echo "<td><span style='font-weight: bold;'>" . (!empty($row['time_out']) ? date("g:i a", strtotime($row['time_out'])) : '▪▪▪▪') . "</td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='7' class='text-center'>No login history found.</td></tr>";
    }
    ?>
</tbody>

        </table>

        <!-- Pagination controls -->
        <nav aria-label="Page navigation">
            <ul class="pagination justify-content-center">
                <li class="page-item <?php if ($historyPage <= 1) echo 'disabled'; ?>">
                    <a class="page-link" href="?page=<?php echo $historyPage - 1; ?>">Previous</a>
                </li>
                <li class="page-item disabled">
                    <span class="page-link">Page <?php echo $historyPage; ?> of <?php echo $totalHistoryPages; ?></span>
                </li>
                <li class="page-item <?php if ($historyPage >= $totalHistoryPages) echo 'disabled'; ?>">
                    <a class="page-link" href="?page=<?php echo $historyPage + 1; ?>">Next</a>
                </li>
            </ul>
        </nav>
    </div>
</div>


<?php
require_once('../connection/dbconfig.php'); 


// Initialize search term
$historyTerm = isset($_POST['search']) ? $_POST['search'] : '';

// SQL query to fetch user login/logout history based on search term
$sql = "SELECT 
            u.username, 
            u.shift,
            DATE(r.created_at) AS transaction_date,
            SUM(c.total_cash_in) AS total_cash_in,
            SUM(r.total) AS sales_amount
        FROM 
            receipts r
        JOIN 
            users u ON r.user_id = u.id
        LEFT JOIN 
            pharmacy_cashier_cash_in c ON u.id = c.user_id
        WHERE 
            u.username LIKE ? 
        GROUP BY 
            u.id, DATE(r.created_at)
        ORDER BY 
            transaction_date DESC, u.username";

$stmt = $conn->prepare($sql);
$searchTermWithWildcards = "%" . $historyTerm . "%"; // For partial matches
$stmt->bind_param("s", $searchTermWithWildcards);
$stmt->execute();
$result = $stmt->get_result();
?>

<div class="card mt-4" style=" box-shadow: 0 2px 5px rgba(0, 0, 0, 0.9);">
    <div class="card-header" style="background-color:#34495e;">
        <h5 class="mb-0" style="color: white;">
            <i class="fas fa-user" style="color: white;"></i> 
            𝖯𝗁𝖺𝗋𝗆𝖺𝖼𝗒 𝖢𝖺𝗌𝗁𝗂𝖾𝗋, 𝖢𝖺𝗌𝗁-𝖨𝗇 / 𝖲𝖺𝗅𝖾𝗌 𝖠𝗆𝗈𝗎𝗇𝗍 𝖧𝗂𝗌𝗍𝗈𝗋𝗒
        </h5>
        <form method="POST" class="form-inline mt-2">
            <input type="text" name="search" class="form-control mr-2" placeholder="Search Username" value="<?php echo $historyTerm; ?>">
            <button type="submit" class="btn btn-primary">Search</button>
        </form>
    </div>
    <div class="card-body">
        <table class="table table-bordered">
            <thead class="thead-light">
                <tr>
                    <th>Username</th>
                    <th><i class="fas fa-money-bill-wave"></i> Total Cash In</th>
                    <th>Shift</th>
                    <th><i class="fas fa-chart-line"></i> Sales Amount</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Check if there are results and display them
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>{$row['username']}</td>
                                <td>₱ " . number_format($row['total_cash_in'], 2) . "</td>
                                <td>{$row['shift']}</td>
                                <td>₱ " . number_format($row['sales_amount'], 2) . "</td>
                                <td>" . date("Y-m-d", strtotime($row['transaction_date'])) . "</td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='5' class='text-center'>No records found</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>


<?php
$stmt->close();
$conn->close();
?>



    </div>

    <!-- Bootstrap JS and dependencies -->
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
    <script>
    $('#userModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); // Button that triggered the modal
        var username = button.data('username'); // Extract info from data-* attributes
        var email = button.data('email');
        var shift = button.data('shift');
        var role = button.data('role');
        var createdAt = button.data('created-at');
        var image = button.data('image');

        // Update the modal's content
        var modal = $(this);
        modal.find('#modalUsername').text(username);
        modal.find('#modalEmail').text(email);
        modal.find('#modalShift').text("Shift: " + shift);
        modal.find('#modalRole').text("Role: " + role);
        modal.find('#modalCreatedAt').text("Registered On: " + createdAt);
        modal.find('#userImage').attr('src', image);
    });
</script>
<script>
        function logout() {
            if (confirm("Are you sure you want to log out?")) {
                fetch('adminlogout.php', {
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
