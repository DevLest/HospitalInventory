<?php
session_name('WardsSession'); // Use the same session name as login
session_start(); // Start session

// Database connection details
$host = 'localhost';
$user = 'root';
$password = '';
$dbname = 'database'; // Replace with your actual database name

// Create connection
$conn = new mysqli($host, $user, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the request is POST and for logout action
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);

    // Check if the action is logout
    if (isset($data['action']) && $data['action'] === 'logout') {
        // Set timezone and get the current time and date
        date_default_timezone_set('Asia/Manila'); 
        $time_out = date('H:i:s'); // Get current time
        $login_date = date('Y-m-d'); // Get current date

        // Check if user is logged in via session
        if (isset($_SESSION['username']) && isset($_SESSION['role'])) {
            $username = $_SESSION['username'];

            // Prepare the query to update `time_out` and `status` for this session's username
            $stmt = $conn->prepare("
                UPDATE login_history 
                SET time_out = ?, status = 'Inactive' 
                WHERE username = ? AND login_date = ? AND status = 'Active' 
                ORDER BY time_in DESC LIMIT 1
            ");
            $stmt->bind_param('sss', $time_out, $username, $login_date);

            // Execute the update query
            if ($stmt->execute()) {
                if ($stmt->affected_rows > 0) {
                    // Destroy session on successful update
                    session_destroy();
                    echo json_encode(['success' => true, 'message' => "User $username logged out successfully."]);
                } else {
                    echo json_encode(['success' => false, 'message' => 'No active login history found for this user.']);
                }
            } else {
                // If query fails
                echo json_encode(['success' => false, 'error' => 'Failed to update logout time: ' . $stmt->error]);
            }

            // Close the statement
            $stmt->close();
        } else {
            echo json_encode(['success' => false, 'message' => 'User not logged in.']);
        }
    } else {
        echo json_encode(['success' => false, 'error' => 'Invalid action received']);
    }
} else {
    echo json_encode(['success' => false, 'error' => 'Invalid request method']);
}

// Close the database connection
$conn->close();
?>
