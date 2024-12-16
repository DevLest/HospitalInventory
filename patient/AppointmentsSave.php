<?php
// Database connection
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'database'; // Replace with actual database name
$con = mysqli_connect($host, $username, $password, $database);

if (!$con) {
    die('Database connection failed: ' . mysqli_connect_error());
}

// Function to save the appointment
function saveAppointment($con) {
    // Check if the form was submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Collect and sanitize input data
        $doctor_id = intval($_POST['doctor_id']);
        $first_name = mysqli_real_escape_string($con, $_POST['first_name']);
        $middle_initial = mysqli_real_escape_string($con, $_POST['middle_initial'] ?? '');
        $last_name = mysqli_real_escape_string($con, $_POST['last_name']);
        $first_visit = $_POST['first_visit'] == 'yes' ? 1 : 0;
        $appointment_date = mysqli_real_escape_string($con, $_POST['appointment_date']);
        $reason_for_visit = mysqli_real_escape_string($con, $_POST['reason_for_visit']);
        
        // Check the number of appointments already scheduled for the doctor on the same date
        $check_query = "SELECT COUNT(*) AS appointment_count FROM appointments WHERE doctor_id = '$doctor_id' AND appointment_date = '$appointment_date'";
        $result = mysqli_query($con, $check_query);
        $row = mysqli_fetch_assoc($result);
        
        if ($row['appointment_count'] >= 5) {
            echo "<p style='color: red;'>The doctor already has 5 appointments scheduled on this date. Please choose another time.</p>";
        } else {
            // Set status to 'Pending' by default
            $status = 'Pending';

            // Insert appointment into database
            $query = "INSERT INTO appointments (doctor_id, first_name, middle_initial, last_name, first_visit, appointment_date, reason_for_visit, status)
                      VALUES ('$doctor_id', '$first_name', '$middle_initial', '$last_name','$first_visit', '$appointment_date', '$reason_for_visit', '$status')";

            if (mysqli_query($con, $query)) {
                // Redirect to dashboard after successful submission
                header('Location: PatientDashboard.php');  // Replace 'dashboard.php' with the actual URL of your dashboard page
                exit();  // Ensure the script stops here and does not execute further
            } else {
                echo "<p style='color: red;'>Error: " . mysqli_error($con) . "</p>";
            }
        }
    }
}

// Call the function if form is submitted
saveAppointment($con);

// Close database connection
mysqli_close($con);
?>
