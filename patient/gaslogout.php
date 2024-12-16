<?php
session_start();

// Database connection
$host = 'localhost';
$user = 'root';
$password = '';
$dbname = 'database'; // Replace with your actual database name

$conn = new mysqli($host, $user, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if a POST request is made
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);

    // Check if the action is logout
    if (isset($data['action']) && $data['action'] === 'logout') {
        // Check if the user is logged in with a session
        if (isset($_SESSION['name']) && isset($_SESSION['specialties'])) {
            $name = $_SESSION['name'];
            $specialties = $_SESSION['specialties'];

            // Debug: Check session values
            error_log('Session name: ' . $name);
            error_log('Session specialties: ' . $specialties);

            // Destroy the session and log out the user
            session_destroy();
            echo json_encode(['success' => true, 'message' => "$specialties logged out successfully."]);
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

// Close database connection
$conn->close();
?>
