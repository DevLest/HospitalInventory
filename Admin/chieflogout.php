<?php
session_start();

require_once('../connection/dbconfig.php'); 


// Check if a POST request is made
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);

    // Check if the action is logout
    if (isset($data['action']) && $data['action'] === 'logout') {
        // Check if the user is logged in with a session
        if (isset($_SESSION['chief_admin_id']) && isset($_SESSION['role'])) {
            $chief_admin_id = $_SESSION['chief_admin_id'];
            $role = $_SESSION['role'];

            // Debug: Check session values
            error_log('Session chief_admin_id: ' . $chief_admin_id);
            error_log('Session role: ' . $role);

            // Destroy the session and log out the user
            session_destroy();
            echo json_encode(['success' => true, 'message' => "$role logged out successfully."]);
        } else {
            // If no session is found
            echo json_encode(['success' => true, 'message' => 'Logged out successfully, but no active session found.']);
        }
    } else {
        echo json_encode(['success' => false, 'error' => 'Invalid action received']);
    }
} else {
    echo json_encode(['success' => false, 'error' => 'Invalid request method']);
}

?>
