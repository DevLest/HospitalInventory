<?php
require_once('../connection/dbconfig.php'); 

// Check if patient_id is set in the URL
if(isset($_GET['patient_id'])) {
    $patient_id = $_GET['patient_id'];

    // Fetch the form data
    $respiratory_rate = $_POST['respiratory_rate'];
    $blood_pressure = $_POST['blood_pressure'];
    $capillary_refill = $_POST['capillary_refill'];
    $temperature = $_POST['temperature'];
    $weight = $_POST['weight'];
    $pulse_rate = $_POST['pulse_rate'];
    $physical_examination = $_POST['physical_examination'];
    $diagnosis = $_POST['diagnosis'];
    $medication_treatment = $_POST['medication_treatment'];
    $attending_physician = $_POST['attending_physician'];

    // Update the vital_signs table
    $query = "UPDATE vital_signs SET 
                respiratory_rate = '$respiratory_rate',
                blood_pressure = '$blood_pressure',
                capillary_refill = '$capillary_refill',
                temperature = '$temperature',
                weight = '$weight',
                pulse_rate = '$pulse_rate',
                physical_examination = '$physical_examination',
                diagnosis = '$diagnosis',
                medication_treatment = '$medication_treatment',
                attending_physician = '$attending_physician'
              WHERE patient_id = $patient_id";

    // Execute the query
    $result = mysqli_query($conn, $query);

    // Check if the query was successful
    if($result) {
        echo "<script>alert('Form data submitted successfully.');</script>";
        // Redirect to a confirmation page or any other page as needed
        header("Location: OutpatientView.php?id=" . urlencode($patient_id));
exit;

        exit();
    } else {
        echo "Error updating record in Database: " . mysqli_error($conn);
    }
} else {
    echo "Patient ID not provided!";
}
?>
