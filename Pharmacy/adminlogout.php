<?php
session_start();

require_once('../connection/dbconfig.php'); 

// Check if a POST request is made
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);

    // Check if the action is logout
    if (isset($data['action']) && $data['action'] === 'logout') {
        // Set timezone and get the current time and date
        date_default_timezone_set('Asia/Manila'); 
        $time_out = date('H:i:s'); // Get current time
        $login_date = date('Y-m-d'); // Get current date

        // Check if the user is logged in with a session
        if (isset($_SESSION['username']) && isset($_SESSION['role'])) {
            $username = $_SESSION['username'];
            $role = $_SESSION['role'];

            // Debug: Check session values
            error_log('Session username: ' . $username);
            error_log('Session role: ' . $role);

            // Prepare the query to check if there is an active login
            $checkQuery = "SELECT * FROM login_history WHERE username = ? AND login_date = ? AND status = 'Active' ORDER BY time_in DESC LIMIT 1";
            $stmtCheck = $conn->prepare($checkQuery);
            $stmtCheck->bind_param('ss', $username, $login_date);
            $stmtCheck->execute();
            $resultCheck = $stmtCheck->get_result();

            if ($resultCheck->num_rows > 0) {
                // If active login is found, proceed to update time_out and status
                $updateQuery = "UPDATE login_history SET time_out = ?, status = 'Inactive' WHERE username = ? AND login_date = ? AND status = 'Active' ORDER BY time_in DESC LIMIT 1";
                $stmtUpdate = $conn->prepare($updateQuery);
                $stmtUpdate->bind_param('sss', $time_out, $username, $login_date);

                // Execute the update query
                if ($stmtUpdate->execute()) {
                    if ($stmtUpdate->affected_rows > 0) {
                        // If rows were updated, destroy the session and log out the user
                        session_destroy();
                        echo json_encode(['success' => true, 'message' => "$role logged out successfully."]);
                    } else {
                        // If no rows were affected, this could mean no matching record was found
                        echo json_encode(['success' => false, 'message' => 'No active login history found for this user.']);
                    }
                } else {
                    // If there was an error executing the query
                    echo json_encode(['success' => false, 'error' => 'Failed to update logout time: ' . $stmtUpdate->error]);
                }

                // Close the statement
                $stmtUpdate->close();
            } else {
                echo json_encode(['success' => false, 'message' => 'No active session or login found for the user.']);
            }

            // Close the check statement
            $stmtCheck->close();
        } else {
            // If no session is found, destroy the session anyway
            session_destroy();
            echo json_encode(['success' => true, 'message' => 'Logged out successfully, but no active session found.']);
        }
    } else {
        echo json_encode(['success' => false, 'error' => 'Invalid action received']);
    }
} else {
    echo json_encode(['success' => false, 'error' => 'Invalid request method']);
}

// Close database connection
$conn->close();
?>