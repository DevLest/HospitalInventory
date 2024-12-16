<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dropdown Example</title>
    <link rel="stylesheet" href="Receipt.css">
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome for icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
</head>

<style>
    body {
        background-color: #f4f6f6;
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
    <h3>𝖱𝖾𝖼𝖾𝗂𝗉𝗍𝗌</h3>
<div class="haha">
    <p style="text-align: center;">
        <a href="InventoryDashboard1.php" style="text-decoration: none; color: inherit;">
            <i class="fas fa-home" style="color: #34495e;"></i> Home
        </a>
        <span style="margin: 0 10px;">›</span>
        𝖱𝖾𝖼𝖾𝗂𝗉𝗍𝗌
    </p>
</div>


</div>
<div class="first1" style="opacity: 0.9; border-top: 2px solid #b2babb; margin-top: -20px;"></div><br>

            <!-- Date Filter Form -->
<h2 class="form-title">𝖲𝖾𝖺𝗋𝖼𝗁 𝖱𝖾𝖼𝖾𝗂𝗉𝗍𝗌 𝖻𝗒 𝖣𝖺𝗍𝖾</h2>
<section id="receipt-section">
    <div class="card">
        <div class="card-header">
            <div class="form-container">
                <form method="POST" action="" style="width: 100%; display: flex; justify-content: space-between;">
                    <div class="form-row">
                        <label for="from_date">From:</label>
                        <input type="date" id="from_date" name="from_date" required>

                        <label for="to_date">To:</label>
                        <input type="date" id="to_date" name="to_date" required>

                        <div style="display: flex; align-items: center;">
                            <button type="submit" style="margin-right: 10px;">Search ⌕</button>
                            <!-- Print Button -->
                            <button type="button" class="btn btn-primary" onclick="printReceipt()">Print</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive" id="printableArea">
                <table border="1" class="table table-bordered" style="width:100%; border-collapse:collapse;">
                    <thead>
                        <tr>
                            <th>POS Number</th>
                            <th>Date / Time</th>
                            <th>Medicine Product</th>
                            <th>Quantity</th>
                            <th>Price</th>
                            <th>Paid Amount</th>
                            <th>Discount</th>
                            <th>Change</th>
                            <th>Receipt Total</th>
                        </tr>
                    </thead>
                    <tbody>
                       <?php
// Database connection details
$servername = "localhost"; 
$username = "root"; 
$password = "";
$dbname = "database"; 

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the posted date range values
$from_date = isset($_POST['from_date']) ? $_POST['from_date'] : '';
$to_date = isset($_POST['to_date']) ? $_POST['to_date'] : '';

// Pagination variables
$limit = 11; // Fixed number of rows
$page = isset($_GET['page']) ? $_GET['page'] : 1; // Current page
$offset = ($page - 1) * $limit; // Offset for SQL query

// SQL query to join receipts and receipt_items, with date range filtering, and pagination
$sql = "SELECT 
            receipts.pos_number,
            receipts.total AS receipt_total,
            receipts.created_at,
            receipts.paid_amount,
            receipts.change_amount,
            receipts.discount_amount,
            receipt_items.medicine_product,
            receipt_items.quantity,
            receipt_items.price,
            receipt_items.total AS item_total
        FROM 
            receipts
        LEFT JOIN 
            receipt_items 
        ON 
            receipts.id = receipt_items.receipt_id
        WHERE 
            (DATE(receipts.created_at) BETWEEN '$from_date' AND '$to_date' OR '$from_date' = '' OR '$to_date' = '')
        ORDER BY 
            receipts.created_at DESC
        LIMIT $limit OFFSET $offset"; // Pagination limit and offset

$result = $conn->query($sql);

// SQL query to count total number of rows for pagination
$count_sql = "SELECT COUNT(*) AS total_records FROM receipts WHERE (DATE(created_at) BETWEEN '$from_date' AND '$to_date' OR '$from_date' = '' OR '$to_date' = '')";
$count_result = $conn->query($count_sql);
$total_records = $count_result->fetch_assoc()['total_records'];
$total_pages = ceil($total_records / $limit); // Total pages

// Initialize totals
$overall_total = 0;
$today_total = 0;

if ($result->num_rows > 0) {
    // Output data for each row
    while ($row = $result->fetch_assoc()) {
        $receiptDate = date('Y-m-d', strtotime($row['created_at']));
        $receiptTime = date('h:i:s A', strtotime($row['created_at']));
        $pos_number = $row['pos_number'];
        $medicine_product = $row['medicine_product'];
        $quantity = $row['quantity'];

        // Add to overall total
        $overall_total += $row['item_total'];

        echo "<tr>
                <td>" . $row['pos_number'] . "</td>
                <td>" . $receiptDate . " " . $receiptTime . "</td>
                <td>" . $row['medicine_product'] . "</td>
                <td>" . $row['quantity'] . "</td>
                <td>₱ " . number_format($row['price'], 2) . "</td>
                <td>₱ " . number_format($row['paid_amount'], 2) . "</td>
                <td>" . number_format($row['discount_amount'], 2) . "</td>
                <td>₱ " . number_format($row['change_amount'], 2) . "</td>
                <td>₱ " . number_format($row['item_total'], 2) . "</td>
              </tr>";

        // Check for free product
        if ($row['paid_amount'] == 0) {
            echo "<tr style='background-color: #f7c6c7;'>
                    <td>" . $pos_number . "</td>
                    <td>" . $receiptDate . " " . $receiptTime . "</td>
                    <td>" . $medicine_product . "</td>
                    <td>" . $quantity . "</td>
                    <td colspan='5' style='text-align: center; font-weight: bold; color: #d9534f;'>
                        FREE PRODUCT APPROVED BY MUNICIPALITY OF HINIGARAN
                    </td>
                  </tr>";
        }
    }

    // Display overall total for all receipts
    echo "<tr style='background-color: #e5e7e9; font-weight: bold;' id='overall-total'>
            <td colspan='8' style='text-align: right;'>Overall Total for All Receipts:</td>
            <td style='color: #d9534f;'>₱ " . number_format($overall_total, 2) . "</td>
          </tr>";
} else {
    echo "<tr><td colspan='9'>No receipts found for the selected date range</td></tr>";
}

// Close the connection
$conn->close();
?>

                    </tbody>
                </table>
            </div>

            <!-- Pagination controls -->
            <div class="pagination">
                <?php if ($page > 1): ?>
                    <a href="?page=<?php echo $page - 1; ?>">Previous</a>
                <?php endif; ?>

                <span>Page <?php echo $page; ?> of <?php echo $total_pages; ?></span>

                <?php if ($page < $total_pages): ?>
                    <a href="?page=<?php echo $page + 1; ?>">Next</a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<script>
    function printReceipt() {
        // Get the printable area (table and totals)
        var printableContent = document.getElementById("printableArea").innerHTML;

        // Get overall total
        var overallTotal = document.getElementById("overall-total") ? document.getElementById("overall-total").innerHTML : '';

        // Create a new window for printing
        var printWindow = window.open('', '', 'height=600,width=800');
        printWindow.document.write('<html><head><title>Receipt Print</title></head><body>');
        printWindow.document.write('<h3>Receipt Details</h3>');
        printWindow.document.write('<div>' + printableContent + '</div>'); // Add table content
        printWindow.document.write('</body></html>');
        printWindow.document.close();
        printWindow.print();
    }
</script>

<!-- Refund Modal -->
<div id="refund-modal" class="refund-modal" style="display: none;">
    <div class="refund-modal-content">
        <span class="refund-modal-close" onclick="closeRefundModal()">&times;</span>
        <h2>Refund Details</h2>
        <p><strong>Refund Reason:</strong> <span id="refund-reason"></span></p>
        <p><strong>Refund Amount:</strong> ₱<span id="refund-amount"></span></p>
        <p><strong>Refund Date/Time:</strong> <span id="refund-datetime"></span></p>
    </div>
</div>

<!-- Bootstrap JS and dependencies -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">    <!--new -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

</body>
</html>
