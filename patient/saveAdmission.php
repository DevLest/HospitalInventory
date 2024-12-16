<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $admission_id = $_POST['admission_id'];
    $patient_id = $_POST['patient_id'];
    $status = $_POST['status'];
    // ... other form data

    require_once('../connection/dbconfig.php'); 


    $sql = "UPDATE admissionpatient SET status = ? WHERE admission_id = ?";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("si", $status, $admission_id);

    if ($stmt->execute() === TRUE) {
        echo "Record updated successfully";
    } else {
        echo "Error updating record: " . $stmt->error;
    }

    $stmt->close();
    $connection->close();
}
?>
