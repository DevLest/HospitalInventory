<?php
require_once('../connection/dbconfig.php'); 


// Fetch data from the 'patient' table
$query = "SELECT MONTH(date) AS month, COUNT(*) AS count FROM patient GROUP BY MONTH(date)";
$result = mysqli_query($conn, $query);

$data = [];
while ($row = mysqli_fetch_assoc($result)) {
    $data[$row['month']] = $row['count'];
}

mysqli_close($conn);

// Convert data to array with 0 values for missing months
$chartData = [];
for ($i = 1; $i <= 12; $i++) {
    $chartData[] = isset($data[$i]) ? $data[$i] : 0;
}

// Return data as JSON
echo json_encode($chartData);
?>