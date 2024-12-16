<?php
// File path for backup
$backupDir = 'C:/invoices/';
$backupFile = $backupDir . 'backup_' . date('Y-m-d_H-i-s') . '.csv';

require_once('../connection/dbconfig.php'); 


// Fetch data
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
        INNER JOIN 
            receipt_items 
        ON 
            receipts.id = receipt_items.receipt_id
        ORDER BY receipts.created_at DESC";

$result = $conn->query($sql);

// Open file for writing
$fp = fopen($backupFile, 'w');

// Write CSV headers
fputcsv($fp, ['POS Number', 'Date / Time', 'Medicine Product', 'Quantity', 'Price', 'Paid Amount', 'Discount', 'Change', 'Receipt Total']);

// Write data to CSV
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $receiptDateTime = date('Y-m-d H:i:s', strtotime($row['created_at']));
        $line = [
            $row['pos_number'],
            $receiptDateTime,
            $row['medicine_product'],
            $row['quantity'],
            $row['price'],
            $row['paid_amount'],
            $row['discount_amount'],
            $row['change_amount'],
            $row['item_total']
        ];
        fputcsv($fp, $line);
    }
}

// Close the file and connection
fclose($fp);
$conn->close();

// Success message
echo "Backup successful!";
?>
