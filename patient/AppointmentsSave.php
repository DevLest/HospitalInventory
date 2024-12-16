<?php
require_once('../connection/dbconfig.php'); 


// Function to save the appointment
function saveAppointment($conn) {
    // Check if the form was submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Collect and sanitize input data
        $doctor_id = intval($_POST['doctor_id']);
        $first_name = mysqli_real_escape_string($conn, $_POST['first_name']);
        $middle_initial = mysqli_real_escape_string($conn, $_POST['middle_initial'] ?? '');
        $last_name = mysqli_real_escape_string($conn, $_POST['last_name']);
        $first_visit = $_POST['first_visit'] == 'yes' ? 1 : 0;
        $appointment_date = mysqli_real_escape_string($conn, $_POST['appointment_date']);
        $reason_for_visit = mysqli_real_escape_string($conn, $_POST['reason_for_visit']);
        
        // Check the number of appointments already scheduled for the doctor on the same date
        $check_query = "SELECT COUNT(*) AS appointment_count FROM appointments WHERE doctor_id = '$doctor_id' AND appointment_date = '$appointment_date'";
        $result = mysqli_query($conn, $check_query);
        $row = mysqli_fetch_assoc($result);
        
        if ($row['appointment_count'] >= 5) {
            echo "<p style='color: red;'>The doctor already has 5 appointments scheduled on this date. Please choose another time.</p>";
        } else {
            // Set status to 'Pending' by default
            $status = 'Pending';

            // Insert appointment into database
            $query = "INSERT INTO appointments (doctor_id, first_name, middle_initial, last_name, first_visit, appointment_date, reason_for_visit, status)
                      VALUES ('$doctor_id', '$first_name', '$middle_initial', '$last_name','$first_visit', '$appointment_date', '$reason_for_visit', '$status')";

            if (mysqli_query($conn, $query)) {
                // Redirect to dashboard after successful submission
                header('Location: PatientDashboard.php');  // Replace 'dashboard.php' with the actual URL of your dashboard page
                exit();  // Ensure the script stops here and does not execute further
            } else {
                echo "<p style='color: red;'>Error: " . mysqli_error($conn) . "</p>";
            }
        }
    }
}

// Call the function if form is submitted
saveAppointment($conn);

// Close database connection
mysqli_close($conn);
?>
