<?php
// Connect to the database
$db = mysqli_connect('localhost', 'root', '', 'database') or die('Unable to connect.');

// Check if the POST request contains the necessary data
if (isset($_POST['patient_id'], $_POST['discharge_date'])) {
    $patient_id = $_POST['patient_id'];
    $discharge_date = $_POST['discharge_date'];

    // Update the discharge date in the database
    $query = "UPDATE admissionpatient SET discharge_date = '$discharge_date', status = 'Discharged' WHERE patient_id = '$patient_id'";
    $result = mysqli_query($db, $query);

    // Respond with success or failure
    if ($result) {
        echo json_encode(['success' => true, 'message' => 'Patient discharged successfully.']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Database update failed.']);
    }
} else {
    // Missing data in the POST request
    echo json_encode(['success' => false, 'message' => 'Invalid request.']);
}
?>
