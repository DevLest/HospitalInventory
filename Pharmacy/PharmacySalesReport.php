<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Navigation Bar Only</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="Product.css">
    <style>
        /* Keeping your existing CSS */
        .form-container {
            display: flex;
            justify-content: center;
            margin: 1px auto;
            padding: 20px;
            background-color: #f9f9f9;
            border: 1px solid #ccc;
            border-radius: 8px;
            max-width: 700px; /* Adjust width as needed */
        }

        .form-title {
            text-align: center;
            margin-bottom: 20px;
            width: 100%;
        }

        .form-container form {
            display: flex;
            flex-direction: column;
            width: 100%;
        }

        .form-row {
            display: flex;
            align-items: center;
            justify-content: center; /* Centers the content horizontally */
            gap: 20px; /* Space between elements */
        }

        .form-row label {
            margin-right: 10px; /* Space between label and input */
        }

        .form-row input[type="date"] {
            padding: 8px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        .form-row button {
            padding: 10px 20px;
            background-color: #3498db;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-left: auto; /* Pushes the button to the far right */
        }

        .form-row button:hover {
            background-color: darkgray;
        }
        .refund-modal {
        display: none;
        position: fixed;
        z-index: 1000;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.4);
    }
    
    .refund-modal-content {
        background-color: white;
        margin: 15% auto;
        padding: 20px;
        border: 1px solid #888;
        width: 80%;
        max-width: 500px;
        border-radius: 10px;
        position: relative;
    }
    
    .refund-modal-close {
        color: #aaa;
        float: right;
        font-size: 28px;
        font-weight: bold;
    }
    
    .refund-modal-close:hover,
    .refund-modal-close:focus {
        color: black;
        cursor: pointer;
    }
    </style>
</head>
<body>

<!-- Navigation Bar -->
<nav>
    <img src="img/hini.png" alt="Logo" class="nav-logo" style="width: 4%; margin-left: 1%;">
    <div class="nav-left" style="margin-right: 36.5%;">HMDH Pharmacy System</div>
    <div class="nav-right">
        <a href="PharmacyPOS.php">🏚️ Home</a>
        <a href="PharmacyProducts.php">🛒 Products</a>
        <a href="PharmacySalesReport.php">📉 Sales Report</a>
        <a href="#" onclick="backupData()">📂 Back Up</a>
        <a href="#">🔴 Logout</a>
    </div>
</nav>

<!-- Modal for Notifications -->
         </thead>
            <tbody id="notif-content">
                <!-- Notifications will be dynamically added here -->
            </tbody>
        </table>
    </div>
</div>
<!-- Date and Time Display -->
<section id="datetime"><br><br><br>
    <div class="fas fa-calendar-alt" id="current-date" style="font-weight: bold;"></div><br>
    <div id="current-time" style="font-weight: bold; background-color:black; width: 10%; text-align: center; color: white; border-radius: 3px;"></div>
</section>


<!-- Date Filter Form -->
<h2 class="form-title">Search Receipts by Date</h2>
<div class="form-container">
    <form method="POST" action="">
        <div class="form-row">
            <label for="from_date">From:</label>
            <input type="date" id="from_date" name="from_date" required>

            <label for="to_date">To:</label>
            <input type="date" id="to_date" name="to_date" required>

            <button type="submit">Search ⌕</button>
        </div>
    </form>
</div>

<section id="receipt-section">
    <p style="text-align: center; background-color: lightblue; padding: 10px;">
        𝙄𝙣𝙛𝙤: Click the (📂 Back Up) Above and All the New POS are stored inside the directory "𝘾:/𝙞𝙣𝙫𝙤𝙞𝙘𝙚𝙨/ "
    </p>

    <table border="1" style="width:100%; border-collapse:collapse;">
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

            // Initialize the date filter variables
            $from_date = isset($_POST['from_date']) ? $_POST['from_date'] : '';
            $to_date = isset($_POST['to_date']) ? $_POST['to_date'] : '';

            // Initialize today's date
            $today = date('Y-m-d'); // This will set today's date in 'YYYY-MM-DD' format

            // SQL query to join receipts and receipt_items and filter by the selected date range
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
                        receipts.id = receipt_items.receipt_id";

            // Apply date range filter if both dates are set
            if (!empty($from_date) && !empty($to_date)) {
                $sql .= " WHERE DATE(receipts.created_at) BETWEEN '$from_date' AND '$to_date'";
            }

            $sql .= " ORDER BY receipts.created_at DESC"; // Order by date descending

            $result = $conn->query($sql);

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

                    // Check if the receipt is today
                    $isToday = ($receiptDate == $today) ? "<span style='color: green; font-weight: bold;'>( TODAY ) </span> " : "";

                    // Check if paid amount is 0
                    if ($row['paid_amount'] == 0) {
                        echo "<tr style='background-color: #f7c6c7;' class='refunded-row' data-reason='FREE PRODUCT APPROVED BY MUNICIPALITY' data-refunded-amount='0' data-refunded-at='" . $receiptDate . " " . $receiptTime . "'>
                                <td>" . $isToday . $pos_number . "</td>
                                <td>" . $receiptDate . " " . $receiptTime . "</td>
                                <td>" . $medicine_product . "</td>
                                <td>" . $quantity . "</td>
                                <td colspan='5' style='text-align: center; font-weight: bold; color: #d9534f;'>FREE PRODUCT APPROVED BY MUNICIPALITY OF HINIGARAN</td>
                              </tr>";
                    } else {
                        // Add to overall and today's totals
                        $overall_total += $row['item_total'];
                        if ($receiptDate == $today) {
                            $today_total += $row['item_total'];
                        }

                        // Normal row for non-zero paid amounts
                        echo "<tr>
                                <td>" . $isToday . $pos_number . "</td>
                                <td>" . $receiptDate . " " . $receiptTime . "</td>
                                <td>" . $medicine_product . "</td>
                                <td>" . $quantity . "</td>
                                <td>₱ " . number_format($row['price'], 2) . "</td>
                                <td>₱ " . number_format($row['paid_amount'], 2) . "</td>
                                <td>" . number_format($row['discount_amount'], 2) . "</td>
                                <td>₱ " . number_format($row['change_amount'], 2) . "</td>
                                <td>₱ " . number_format($row['item_total'], 2) . "</td>
                              </tr>";
                    }
                }

                // Display total for today's receipts
                echo "<tr style='background-color: #e5e7e9; font-weight: bold;'>
                        <td colspan='8' style='text-align: right;'>Total for Today's Receipts:</td>
                        <td style='color: #d9534f;'>₱ " . number_format($today_total, 2) . "</td>
                      </tr>";

                // Display overall total for all receipts
                echo "<tr style='background-color: #e5e7e9; font-weight: bold;'>
                        <td colspan='8' style='text-align: right;'>Overall Total for All Receipts:</td>
                        <td style='color: #d9534f;'>₱ " . number_format($overall_total, 2) . "</td>
                      </tr>";

            } else {
                echo "<tr><td colspan='9'>No receipts found for this date range.</td></tr>";
            }

            // Close the connection
            $conn->close();
            ?>
        </tbody>
    </table>
</section>



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

<script>
    
    // Function to show refund modal
    function openRefundModal(reason, refundedAmount, refundedAt) {
        document.getElementById('refund-reason').innerText = reason;
        document.getElementById('refund-amount').innerText = refundedAmount;
        document.getElementById('refund-datetime').innerText = refundedAt;
        document.getElementById('refund-modal').style.display = 'block';
    }

    // Function to close the modal
    function closeRefundModal() {
        document.getElementById('refund-modal').style.display = 'none';
    }

    // Attach click event to refunded rows
    document.querySelectorAll('.refunded-row').forEach(function(row) {
        row.addEventListener('click', function() {
            var reason = row.getAttribute('data-reason');
            var refundedAmount = row.getAttribute('data-refunded-amount');
            var refundedAt = row.getAttribute('data-refunded-at');
            openRefundModal(reason, refundedAmount, refundedAt);
        });
    });

    function backupData() {
        // Open a new window or tab to call the backup PHP script
        window.open('backup.php', '_blank');
        
        // Clear the table content (if you want to clear it immediately)
        document.querySelector('#receipt-section tbody').innerHTML = '';
    }

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
</body>
</html>
