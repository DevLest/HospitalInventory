<?php
session_name('PharmacyCashierSession'); // Use the same session name as when the user logged in
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


// Check if form is submitted to update quantity
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update_quantity'])) {
    $product_name = $conn->real_escape_string($_POST['product_name']);
    $quantity = intval($_POST['quantity']);

    // Update the quantity in the database
    $update_sql = "UPDATE pharmacy_medicines_products 
                   SET remain_quantity = remain_quantity - ? 
                   WHERE medicine_product = ?";
    $stmt = $conn->prepare($update_sql);
    $stmt->bind_param("is", $quantity, $product_name);
    $stmt->execute();
    $stmt->close();
}

// Fetch data from the table
$product_name = isset($_GET['product_name']) ? $_GET['product_name'] : '';
$product_name = $conn->real_escape_string($product_name);

$sql = "SELECT medicine_product, generic_name, category, remain_quantity, expiry, selling_price 
        FROM pharmacy_medicines_products 
        WHERE medicine_product LIKE '%$product_name%' 
        ORDER BY medicine_product ASC";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tables with Search Form</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="style.css">
   <style>
    /* Modal container */
    #discount-modal {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5); /* Semi-transparent background */
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 1000; /* Make sure the modal is on top */
    }

    /* Modal content */
    #discount-modal > div {
        background: white;
        color: black;
        padding: 20px;
        border-radius: 8px;
        max-width: 400px;
        width: 100%;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); /* Add a subtle shadow */
    }

    /* Modal header */
    #discount-modal h3 {
        margin-top: 0;
        font-size: 1.5em;
        color: #333;
    }

    /* Form labels */
    #discount-modal label {
        display: block;
        margin-bottom: 5px;
        font-weight: bold;
    }

    /* Form inputs */
    #discount-modal input[type="number"], 
    #discount-modal select {
        width: calc(100% - 22px); /* Adjust width to match container */
        padding: 8px;
        border: 1px solid #ccc;
        border-radius: 4px;
        margin-bottom: 10px;
    }

    /* Button styles */
    #discount-modal button {
        background-color: #007bff;
        color: white;
        border: none;
        border-radius: 4px;
        padding: 10px 15px;
        cursor: pointer;
        font-size: 1em;
        margin-right: 10px;
    }

    #discount-modal button:hover {
        background-color: #0056b3;
    }

    #discount-modal button:last-child {
        background-color: #6c757d;
    }

    #discount-modal button:last-child:hover {
        background-color: #5a6268;
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
/* Modal overlay */
.modal {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.5); /* Semi-transparent background */
    display: flex;
    align-items: center;
    justify-content: center;
    z-index: 1000; /* Ensure the modal is above other content */
    display: none; /* Hide modal by default */
}

/* Modal content */
.modal-content {
    background: white;
    color: black;
    padding: 20px;
    border-radius: 8px;
    width: 100%;
    max-width: 500px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); /* Subtle shadow */
}

/* Modal header */
.modal-content h3 {
    margin-top: 0;
    font-size: 1.5em;
    color: #333;
}

/* Form labels */
.modal-content label {
    display: block;
    margin-bottom: 5px;
    font-weight: bold;
}

/* Form inputs */
.modal-content input[type="text"], 
.modal-content input[type="number"], 
.modal-content textarea {
    width: calc(100% - 20px); /* Full width minus padding */
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 4px;
    margin-bottom: 15px;
    box-sizing: border-box; /* Include padding in width */
}

/* Textarea styling */
.modal-content textarea {
    resize: vertical; /* Allow vertical resizing */
}

/* Button container */
.modal-buttons {
    display: flex;
    justify-content: flex-end; /* Align buttons to the right */
}

/* Button styles */
.modal-buttons button {
    background-color: #007bff;
    color: white;
    border: none;
    border-radius: 4px;
    padding: 10px 15px;
    cursor: pointer;
    font-size: 1em;
    margin-left: 10px;
}

.modal-buttons button.btn-close {
    background-color: #6c757d;
}

.modal-buttons button:hover {
    background-color: #0056b3;
}

.modal-buttons button.btn-close:hover {
    background-color: #5a6268;
}
.red-text {
            color: red;
        }
</style>

</head>
<body>

<!-- Navigation Bar -->
<nav>
    <img src="img/hini.png" alt="Logo" class="nav-logo" style="width: 4%; margin-left: 1%;">
    <div class="nav-left" style="margin-right: 41.5%;">HMDH Pharmacy System</div>
    <div class="nav-right">
        <a href="#" id="notif-link" onclick="openNotifModal(event)">
            <i class="fas fa-bell" style="color: yellow;"></i>
            <span id="notif-badge" class="notif-badge">0</span>
        </a>
        <a href="PharmacyPOS.php">🏚️ Home</a>
        <a href="PharmacyProducts.php">🛒 Products</a>
        <a href="PharmacySalesReport.php">📉 Sales Report</a>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <a id="logoutBtn">🔴 Logout</a>
    </div>
</nav>

<!-- Modal for Notifications -->
<div id="notif-modal" class="notif-modal">
    <div class="notif-modal-content">
        <span class="notif-modal-close" onclick="closeNotifModal()">&times;</span>
        <h2>Low Stock</h2>
        <table id="notif-table">
            <thead>
                <tr>
                    <th>Product Name</th>
                    <th>Quantity</th>
                </tr>
            </thead>
            <tbody id="notif-content">
                <!-- Notifications will be dynamically added here -->
            </tbody>
        </table>
    </div>
</div>


    <!-- Medicine Code -->
    <div class="left-column" style="margin-top: 2%;">
        <section id="datetime" style="display: flex; align-items: center; margin-bottom: 1%;">
    <div style="flex: 1;">
        <div class="fas fa-calendar-alt" id="current-date" style="font-weight: bold;"></div><br>
        <div id="current-time" style="font-weight: bold; background-color: black; width: 20%; text-align: center; color: white; border-radius: 3px;"></div>
    </div>
     <h1 style="font-size: 100%; color: black; margin-right: 1%">Cashier Name: <span class="red-text"><?php echo $_SESSION['username']; ?></span> ,Hi Have a Nice Day.</h1>
</section>

        <!-- Outer div class with black border for table 2 -->
        <div class="outer-container" style="height: 45%;">
            <div class="headings-container">
                <form method="GET" action="">
            <table class="search-form">
                <tr>
                    <td>
                        Enter Medicine Name:<br>
                        <input type="text" name="product_name" placeholder="Product Name" value="<?php echo htmlspecialchars(isset($_GET['product_name']) ? $_GET['product_name'] : ''); ?>">
                        <br><br>
                        <input type="submit" value="Search">
                    </td>
                </tr>
            </table>
        </form>
                <table style="background-color: #97BC62;">
                    <tr>
                        <th style="width: 35%; font-style: oblique;">Product/Medicine Name</th>
                        <th style="width: 22.5%; font-style: oblique;">Generic Name</th>
                        <th style="width: 11.4%; font-style: oblique;">Quantity</th>
                        <th style="width: 17.4%; font-style: oblique;">Date Expire</th>
                        <th style=" font-style: oblique;">Price</th>
                    </tr>
                </table>
            </div>
            <div class="scrollable-table-container">
                <div class="scrollable-table">
                     <table style="width: 100%; table-layout: fixed;">
            <tbody id="product-table">
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $remain_quantity = (int)$row["remain_quantity"];
                        echo "<tr>";
                        echo "<td style='width: 30%;' onclick='showCalculator(event, this, " . $row["selling_price"] . ")'>" . $row["medicine_product"] . "</td>";
                        echo "<td style='width: 19%;'>" . $row["generic_name"] . "</td>";
                        echo "<td style='width: 10%;' data-quantity='" . $remain_quantity . "' onclick='showCalculator(event, this, " . $row["selling_price"] . ")'>" . $remain_quantity . "</td>";
                        echo "<td style='width: 15%;'>" . $row["expiry"] . "</td>";
                        echo "<td style='width: 11.5%;'>₱ " . $row["selling_price"] . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='6'>No data available</td></tr>";
                }
                ?>
            </tbody>
        </table>
                </div>
            </div>
        </div>


           <!-- Product Code -->
<?php
require_once('../connection/dbconfig.php'); 


// Fetch search query
$search_product_name = isset($_GET['product_name1']) ? $_GET['product_name1'] : '';

// Prepare the SQL query
$sql = "SELECT * FROM pharmacy_products WHERE product LIKE ?";
$stmt = $conn->prepare($sql);

// Bind parameters
$search_param = "%" . $search_product_name . "%";
$stmt->bind_param("s", $search_param);

// Execute the query
$stmt->execute();
$result = $stmt->get_result();
?>
<div class="outer-container" style="height: 45%;">
        <div class="headings-container">
            <form method="GET" action="">
                <table class="search-form">
                    <tr>
                        <td>
                            Enter Product Name:<br>
                            <input type="text" name="product_name1" placeholder="Product Name" value="<?php echo isset($_GET['product_name1']) ? htmlspecialchars($_GET['product_name1']) : ''; ?>">
                            <br><br>
                            <input type="submit" value="Search">
                        </td>
                    </tr>
                </table>
            </form>
            <table style="background-color: #97BC62; width: 100%;">
                <tr>
                    <th style="width: 36.9%; font-style: oblique;">Product Name</th>
                    <th style="width: 22.3%; font-style: oblique;">Category</th>
                    <th style="width: 16.5%; font-style: oblique;">Brand</th>
                    <th style="width: 10.9%; font-style: oblique;">Quantity</th>
                    <th style="font-style: oblique;">Price</th>
                </tr>
            </table>
        </div>
        <div class="scrollable-table-container">
            <div class="scrollable-table">
                <table style="width: 100%; table-layout: fixed; height: 50%;">
                    <tbody id="product-table">
                         <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $remaining_quantity = (int)$row["remaining_quantity"];
                        echo "<tr>";
                        echo "<td style='width: 32.5%;' onclick='showCalculator(event, this, " . $row["selling_price"] . ")'>" . $row["product"] . "</td>";
                        echo "<td style='width: 19.5%;'>" . $row["category"] . "</td>";
                        echo "<td style='width: 14.5%;'>" . $row["brand"] . "</td>";
                        echo "<td style='width: 10%;' data-quantity='" . $remaining_quantity . "' onclick='showCalculator(event, this, " . $row["selling_price"] . ")'>" . $remaining_quantity . "</td>";
                        echo "<td style='width: 11.5%;'>₱ " . $row["selling_price"] . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='6'>No data available</td></tr>";
                }
                ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div><br>

    </div>
    <!-- Modal Background -->
<div id="history-modal" class="notif-modal">
    <div class="notif-modal-content">
        <span class="notif-modal-close" onclick="closeHistoryModal()">&times;</span>
        <h2>Receipt History</h2>
        <table id="history-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>POS Number</th>
                    <th>Total</th>
                    <th>Date</th>
                    <th>Paid Amount</th>
                    <th>Change Amount</th>
                    <th>Discount Amount</th>
                </tr>
            </thead>
            <tbody id="history-tbody">
                <?php include 'history_receipts.php'; ?>
            </tbody>
        </table>
    </div>
</div>

   <!-- Discount Modal -->
<div id="discount-modal" style="display: none;">
    <div style="background: white; color: black; padding: 20px; border-radius: 5px; max-width: 400px; margin: auto; margin-top: 20%;">
        <h3>Apply Discount</h3>
        <label for="discount-type">Discount Type:</label>
        <select id="discount-type">
            <option value="peso">Peso</option>
            <option value="percent">Percentage</option>
            <option value="pwd-senior">PWD/Senior Citizen (80%)</option> <!-- Add this option -->
        </select>
        <br><br>
        <label for="discount-value">Discount Value:</label>
        <input type="number" id="discount-value" step="0.01" style="margin-left: 10px;">
        <br><br>
        <button onclick="applyDiscount()">OK</button>
        <button onclick="closeDiscountModal()">Cancel</button>
    </div>
</div>
    
  <!-- Right Column -->
<div class="column right-column" style="margin-top: 2%;">
    <div class="right-table-container1"><br>
        <div class="right-table-header1">
           <div style="font-weight: bold;">Today's Sales: ₱
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

// Get today's date
$today = date('Y-m-d');

// SQL query to sum today's sales total
$sql = "SELECT 
            SUM(receipt_items.total) AS today_sales_total
        FROM 
            receipts
        LEFT JOIN 
            receipt_items 
        ON 
            receipts.id = receipt_items.receipt_id
        WHERE 
            DATE(receipts.created_at) = '$today'"; // Filter today's receipts

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    // Check if the total is null and display the formatted amount
    $today_sales_total = $row['today_sales_total'] ? $row['today_sales_total'] : 0; 
    echo " " . number_format($today_sales_total, 2); // Format the total with currency
} else {
    echo "₱ 0.00"; // In case there are no results
}

?>
</div>
<br>
        <div class="right-table-header" style="height: 66px;">
            <div style="text-align: center;">
                Hinigaran Medical Clinic Hospital ＰＯＳ
            <table style="background-color: #97BC62;">
        <tr>
            <th style="width: 35%; font-weight: bold;">Product Name</th>
            <th style="width: 30%; font-weight: bold;">Quantity</th>
            <th style="font-weight: bold;">Price</th>
        </tr>
    </table>
</div>
        </div>

<div class="right-table-row" id="right-table-content" style="background-color: #34495e; color: white; padding: 5px; display: flex; flex-direction: column; width: 550px; height: 590px; max-height: 590px; overflow-y: auto; font-family: monospace;">
    <div id="receipt-items" style="flex: 1;">
        <!-- Items will be added here -->
    </div>
    <div style="padding-top: 10px;">
        <div style="display: flex; justify-content: space-between;">
            <strong>Total:</strong>
            <span id="overall-total">₱0.00</span>
        </div>
        <div style="padding-top: 10px;">
            <label for="discount">Discount:</label>
            <span id="discount">₱0.00</span>
        </div>
        <div style="padding-top: 10px;">
            <label for="paid-amount">Paid Amount:</label>
            <input type="number" id="paid-amount" step="0.01" style="margin-left: 10px;">
        </div>
        <div style="padding-top: 10px;">
            <label for="change-amount">Change:</label>
            <span id="change-amount">₱0.00</span>
        </div>
    </div>
    <!-- Print Button -->
    <button onclick="printReceipt()">Print Receipt</button>
</div><br>
    
             <!-- New Bottom Div -->
     <div class="bottom-box" style="height: 20%;">
            <div class="content-box">
                <div class="button-group">
                    <button style="width: 40%;" onclick="showDiscountModal()">Discount</button>
                    <button style="width: 40%; margin-left: 97px;" onclick="showHistoryModal()">History</button>
                </div>
            </div>
        </div>


    </div>

</div>
</div>
    


    <!-- Calculator Popup -->
    <div id="calculator-popup" class="calculator-popup">
        <div id="calculator-display" class="calculator-display"></div>
        <div id="calculator-sum" class="calculator-sum" style="background-color: #e59866;">Total: ₱0.00</div><br>
        <table style="height: 230px;">
            <tr>
                <td><button onclick="inputDigit(1)">1</button></td>
                <td><button onclick="inputDigit(2)">2</button></td>
                <td><button onclick="inputDigit(3)">3</button></td>
            </tr>
            <tr>
                <td><button onclick="inputDigit(4)">4</button></td>
                <td><button onclick="inputDigit(5)">5</button></td>
                <td><button onclick="inputDigit(6)">6</button></td>
            </tr>
            <tr>
                <td><button onclick="inputDigit(7)">7</button></td>
                <td><button onclick="inputDigit(8)">8</button></td>
                <td><button onclick="inputDigit(9)">9</button></td>
            </tr>
            <tr>
                <td colspan="2"><button onclick="clearInput()">C</button></td>
                <td><button onclick="inputDigit(0)">0</button></td>
            </tr>
           <td colspan="3" style="text-align: center;">
                <button onclick="updateSum()" style="height: 50px;">Enter</button><br><br>
            </td>
        </table>
    </div>

    <script>
let currentInput = '';
let targetElement = null; // To store the clicked cell element
let targetQuantityCell = null; // To store the quantity cell
let targetPrice = 0; // To store the price of the clicked medicine

const calculatorPopup = document.getElementById('calculator-popup');
const calculatorDisplay = document.getElementById('calculator-display');
const calculatorSum = document.getElementById('calculator-sum');

// Show the calculator popup
function showCalculator(event, element, price) {
    targetElement = element; // Store the clicked cell element
    targetPrice = price; // Store the price
    targetQuantityCell = element.closest('tr').querySelector('td[data-quantity]'); // Find the quantity cell in the same row
    calculatorPopup.style.display = 'block'; // Show the calculator
    currentInput = ''; // Clear any previous input
    calculatorDisplay.textContent = currentInput; // Clear the display
}

// Handle digit input
function inputDigit(digit) {
    currentInput += digit;
    calculatorDisplay.textContent = currentInput;
}

// Clear the input
function clearInput() {
    currentInput = '';
    calculatorDisplay.textContent = currentInput;
}

// Update the quantity and calculate the total
function updateSum() {
    const quantity = parseFloat(currentInput);
    if (targetElement && !isNaN(quantity)) {
        // Update the quantity in the table
        const currentQuantity = parseFloat(targetQuantityCell.textContent) || 0;
        if (quantity <= currentQuantity) {
            // Update quantity without decimals
            targetQuantityCell.textContent = (currentQuantity - quantity).toFixed(0);
            const sum = quantity * targetPrice;
            calculatorSum.textContent = 'Total: ₱' + sum.toFixed(2);

            // Append the new entry to the receipt
            const receiptItems = document.getElementById('receipt-items');
            const newEntry = document.createElement('div');
            newEntry.className = 'receipt-item'; // Apply the new class
            newEntry.innerHTML = `
                <div>${targetElement.textContent}</div>
                <div>${quantity}</div>
                <div>₱${targetPrice.toFixed(2)}</div>
                <button onclick="removeItem(this, ${sum.toFixed(2)})">❌</button>
            `;
            receiptItems.appendChild(newEntry);

            // Update overall total
            const overallTotalElement = document.getElementById('overall-total');
            const currentTotal = parseFloat(overallTotalElement.textContent.replace('₱', '')) || 0;
            overallTotalElement.textContent = '₱' + (currentTotal + sum).toFixed(2);

        } else {
            alert('Quantity exceeds available stock.');
        }
    } else {
        alert('Invalid quantity.');
    }
    clearInput(); // Clear the display after calculating
}



// Function to remove an item from the receipt
function removeItem(button, itemTotal) {
    const overallTotalElement = document.getElementById('overall-total');
    const currentTotal = parseFloat(overallTotalElement.textContent.replace('₱', '')) || 0;

    // Subtract the item total from the overall total
    overallTotalElement.textContent = '₱' + (currentTotal - itemTotal).toFixed(2);

    // Remove the item from the receipt
    button.parentElement.remove();
}

// AJAX function to get the next POS number
function getNextPOSNumber(callback) {
    const xhr = new XMLHttpRequest();
    xhr.open("GET", "get_pos_number.php", true);
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            const posNumber = xhr.responseText.trim();
            callback(posNumber);
        }
    };
    xhr.send();
}

// Function to calculate the change
function calculateChange() {
    const overallTotalElement = document.getElementById('overall-total');
    const overallTotal = parseFloat(overallTotalElement.textContent.replace('₱', '')) || 0;
    const paidAmount = parseFloat(document.getElementById('paid-amount').value);

    if (paidAmount >= overallTotal) {
        const change = paidAmount - overallTotal;
        document.getElementById('change-amount').textContent = '₱' + change.toFixed(2);

        // Show the print button
        document.getElementById('change-section').style.display = 'block';
    } else {
        alert('Paid amount is less than the total!');
    }
}



function showHistoryModal() {
    document.getElementById('history-modal').style.display = 'block';
}

function closeHistoryModal() {
    document.getElementById('history-modal').style.display = 'none';
}


// Show the discount modal
function showDiscountModal() {
    document.getElementById('discount-modal').style.display = 'block';
}

function closeDiscountModal() {
    document.getElementById('discount-modal').style.display = 'none';
}

function applyDiscount() {
    const type = document.getElementById('discount-type').value;
    const value = parseFloat(document.getElementById('discount-value').value) || 0;
    const overallTotalElement = document.getElementById('overall-total');
    let total = parseFloat(overallTotalElement.textContent.replace('₱', ''));
    let discount = 0;

    // Check if the discount type is "PWD/Senior Citizen"
    if (type === 'pwd-senior') {
        discount = total * 0.80;  // Apply 80% discount
    } else if (type === 'percent') {
        discount = (total * value / 100);  // Percentage discount
    } else if (type === 'peso') {
        discount = value;  // Peso discount
    }

    const newTotal = total - discount;

    // Update the discount and total displayed on the page
    document.getElementById('discount').textContent = '₱' + discount.toFixed(2);
    overallTotalElement.textContent = '₱' + newTotal.toFixed(2);

    // Close the discount modal
    closeDiscountModal();
}
function printReceipt() {
    const receiptItems = document.getElementById('receipt-items');
    const receiptContent = receiptItems ? receiptItems.innerHTML : '';

    const now = new Date();
    const options = { timeZone: 'Asia/Manila', hour: '2-digit', minute: '2-digit', second: '2-digit', hour12: true };
    const time = new Intl.DateTimeFormat('en-GB', options).format(now);

    const dateOptions = { timeZone: 'Asia/Manila', year: 'numeric', month: 'long', day: 'numeric' };
    const date = new Intl.DateTimeFormat('en-GB', dateOptions).format(now);

    const paidAmount = parseFloat(document.getElementById('paid-amount').value || 0);
    const overallTotal = parseFloat(document.getElementById('overall-total').textContent.replace('₱', ''));
    const discount = parseFloat(document.getElementById('discount').textContent.replace('₱', '')) || 0;
    const changeAmount = paidAmount - overallTotal;

    document.getElementById('change-amount').textContent = '₱' + changeAmount.toFixed(2);

    getNextPOSNumber(function(posNumber) {
        const printWindow = window.open('', '', 'height=600,width=800');
        printWindow.document.write('<html><head><title>Print Receipt</title>');
        printWindow.document.write('<style>');
        printWindow.document.write('body { font-family: Arial, sans-serif; margin: 20px; color: #003366; }');
        printWindow.document.write('.receipt-content { font-family: "Courier New", monospace; white-space: pre; color: #003366; }');
        printWindow.document.write('.receipt-item { display: flex; justify-content: space-between; padding: 2px 0; color: #003366; }');
        printWindow.document.write('.receipt-item div { flex: 1; text-align: center; color: #003366; }');
        printWindow.document.write('.receipt-item div:first-child { text-align: left; }');
        printWindow.document.write('.receipt-item div:nth-child(2) { text-align: center; }');
        printWindow.document.write('.receipt-item div:last-child { text-align: right; }');
        printWindow.document.write('.receipt-header { font-family: "Courier New", monospace; margin-bottom: 10px; color: #003366; }');
        printWindow.document.write('.header-flex { display: flex; justify-content: space-between; }');
        printWindow.document.write('.header-left { flex: 1; }');
        printWindow.document.write('.header-right { text-align: right; flex-basis: 150px; }');
        printWindow.document.write('.receipt-footer { color: #003366; }');
        printWindow.document.write('</style>');
        printWindow.document.write('</head><body>');

        // Receipt Header
        printWindow.document.write('<div class="receipt-header">');
        printWindow.document.write('<div class="header-flex">');
        printWindow.document.write('<div class="header-left">');
        printWindow.document.write('<h1>Receipt</h1>');
        printWindow.document.write('<p><strong>Pharmacy Name:</strong> Hinigaran Medical Clinic Pharmacy</p>');
        printWindow.document.write('<p><strong>Address:</strong> Hinigiran, Negros Occidental</p>');
        printWindow.document.write('<p><strong>Customer:</strong> --------------------------------</p>');
        printWindow.document.write('<p><strong>Date:</strong> ' + date + '</p>');
        printWindow.document.write('<p><strong>Time:</strong> ' + time + '</p>');
        printWindow.document.write('</div>');
        printWindow.document.write('<div class="header-right">');
        printWindow.document.write('<p><strong>POS Number:</strong> ' + posNumber + '</p>');
        printWindow.document.write('</div>');
        printWindow.document.write('</div>');
        printWindow.document.write('</div>');

        // Receipt Content
        printWindow.document.write('<div class="receipt-content">');
        printWindow.document.write('Product Name                Quantity    Price\n');
        printWindow.document.write('--------------------------------------------------\n');

        const receiptItemsList = receiptItems.getElementsByClassName('receipt-item');
        let items = [];
        let totalAmount = 0;

        for (let item of receiptItemsList) {
            const productName = item.querySelector('div:nth-child(1)').textContent;
            const quantity = item.querySelector('div:nth-child(2)').textContent;
            const price = item.querySelector('div:nth-child(3)').textContent;
            printWindow.document.write(`${productName.padEnd(30)}${quantity.padEnd(10)}${price.padStart(10)}\n`);

            const priceValue = parseFloat(price.replace('₱', ''));
            const quantityValue = parseInt(quantity);
            const total = (priceValue * quantityValue).toFixed(2);
            totalAmount += parseFloat(total);

            items.push({
                medicine_product: productName,
                quantity: quantityValue,
                price: priceValue,
                total: total
            });
        }

        printWindow.document.write('--------------------------------------------------\n');
        printWindow.document.write('Total:                      ₱' + (totalAmount - discount).toFixed(2) + '\n');
        printWindow.document.write('Paid Amount:                ₱' + paidAmount.toFixed(2) + '\n');
        printWindow.document.write('Discount:                   ₱' + discount.toFixed(2) + '\n');
        printWindow.document.write('--------------------------------------------------\n');
        printWindow.document.write('Change:                     ₱' + changeAmount.toFixed(2) + '\n');
        printWindow.document.write('</div>');

        printWindow.document.write('<div class="receipt-footer"><p>Thank you for your purchase!</p></div>');
        printWindow.document.write('</body></html>');
        printWindow.document.close();
        printWindow.focus();
        printWindow.print();

        // Save the receipt and update quantities via AJAX
        const xhrSave = new XMLHttpRequest();
        xhrSave.open("POST", "save_receipt.php", true);
        xhrSave.setRequestHeader("Content-Type", "application/json");
        xhrSave.onreadystatechange = function() {
            if (xhrSave.readyState === 4) {
                if (xhrSave.status === 200) {
                    console.log("Receipt saved to database");

                    // Update the quantities in the database
                    const xhrUpdate = new XMLHttpRequest();
                    xhrUpdate.open("POST", "update_quantity.php", true);
                    xhrUpdate.setRequestHeader("Content-Type", "application/json");
                    xhrUpdate.onreadystatechange = function() {
                        if (xhrUpdate.readyState === 4) {
                            if (xhrUpdate.status === 200) {
                                console.log("Quantities updated in the database");

                                // Clear the receipt items and total after saving
                                document.getElementById('receipt-items').innerHTML = '';
                                document.getElementById('overall-total').textContent = '₱0.00';
                                document.getElementById('discount').textContent = '₱0.00';
                            } else {
                                console.error("Error updating quantities:", xhrUpdate.statusText);
                            }
                        }
                    };

                    // Send the data to update quantities
                    xhrUpdate.send(JSON.stringify(items));
                } else {
                    console.error("Error saving receipt:", xhrSave.statusText);
                }
            }
        };

        // Send the data to save receipt
        const data = {
            pos_number: posNumber,
            items: items,
            total: (totalAmount - discount).toFixed(2),
            paid_amount: paidAmount.toFixed(2),
            change_amount: changeAmount.toFixed(2),
            discount: discount.toFixed(2)
        };

        console.log("Sending data to save_receipt.php:", data); // Debugging line

        xhrSave.send(JSON.stringify(data));
    });
}



// Hide the calculator when clicking outside of it
document.addEventListener('click', function(event) {
    if (!calculatorPopup.contains(event.target) && !event.target.closest('td')) {
        calculatorPopup.style.display = 'none';
    }
}, true);

    </script>

<script>
   // Calendar and time
    function updateDateTime() {
        const now = new Date();
        const optionsDate = { year: 'numeric', month: 'long', day: 'numeric' };
        const optionsTime = { hour: '2-digit', minute: '2-digit', second: '2-digit' };

        document.getElementById('current-date').innerText = now.toLocaleDateString(undefined, optionsDate);
        document.getElementById('current-time').innerText = now.toLocaleTimeString(undefined, optionsTime);
    }

    // Update date and time every second
    setInterval(updateDateTime, 1000);

    // Initial call to display date and time immediately
    updateDateTime();
</script>

<script>
    let lowStockItems = []; // Store low stock items

    function checkLowStock() {
        const lowStockThreshold = 12; // Set the threshold for low stock
        lowStockItems = []; // Reset the low stock items

        // Get all quantity cells from the table
        const quantityCells = document.querySelectorAll('td[data-quantity]');

        // Loop through each cell to check the quantity
        quantityCells.forEach(cell => {
            const quantity = parseFloat(cell.textContent);
            if (quantity < lowStockThreshold) {
                lowStockItems.push({
                    name: cell.closest('tr').querySelector('td').textContent,
                    quantity: quantity
                });
                cell.style.backgroundColor = 'red'; // Highlight low stock cells
            }
        });

        // Update notification count
        const notifBadge = document.getElementById('notif-badge');
        notifBadge.textContent = lowStockItems.length;
    }

    function openNotifModal(event) {
        event.preventDefault();
        const notifModal = document.getElementById('notif-modal');
        const notifContent = document.getElementById('notif-content');

        if (lowStockItems.length > 0) {
            notifContent.innerHTML = lowStockItems.map(item => `
                <tr>
                    <td>${item.name}</td>
                    <td>${item.quantity}</td>
                </tr>
            `).join('');
        } else {
            notifContent.innerHTML = '<tr><td colspan="2">No low stock items</td></tr>';
        }

        notifModal.style.display = 'block';
    }

    function closeNotifModal() {
        document.getElementById('notif-modal').style.display = 'none';
    }

    // Call the function on page load
    document.addEventListener('DOMContentLoaded', () => {
        checkLowStock();
    });

    // Optional: Call the function periodically if your data updates dynamically
    // setInterval(checkLowStock, 60000); // Check every 60 seconds
</script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
<script>
$(document).ready(function() {
    $('#logoutBtn').click(function() {
        $.ajax({
            url: 'logout.php',
            type: 'POST',
            contentType: 'application/json',
            data: JSON.stringify({ action: 'logout' }),
            success: function(response) {
                var res = JSON.parse(response);
                if (res.success) {
                    alert(res.message);
                    window.location.href = '/OUTPATIENT/index.php';
                } else {
                    alert('Error: ' + res.error);
                }
            },
            error: function() {
                alert('Request failed.');
            }
        });
    });
});
</script>


</body>

</html>
