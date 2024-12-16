<?php
// Start the session to store user data
session_start();

// Database connection
$host = "localhost";
$db_user = "root";  // your database username
$db_password = "";  // your database password
$db_name = "database";  // your database name

$conn = new mysqli($host, $db_user, $db_password, $db_name);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Login function
function login($username, $password) {
    global $conn;

    // Sanitize user inputs to avoid SQL injection
    $username = $conn->real_escape_string($username);
    $password = trim($password); // Remove any extra spaces from the input

    // Query to fetch the user data
    $sql = "SELECT * FROM chief_admins WHERE username = '$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Fetch the user data
        $user = $result->fetch_assoc();

        // Debugging: Print the stored password and input password
        // echo "User input password: $password<br>";
        // echo "Stored password: {$user['password']}<br>";

        // Check if the password matches (with password_verify if using hashed passwords)
        if (password_verify($password, $user['password'])) {
            // Check if the role is Chief Admin
            if ($user['role'] == 'Chief Admin') {
                // Store user info in session
                $_SESSION['logged_in'] = true;
                $_SESSION['username'] = $user['username'];
                $_SESSION['role'] = $user['role'];

                // Redirect to the Chief Admin dashboard
                header("Location: Admin/ChiefAdmin.php");
                exit();
            } else {
                echo "Access denied: You must be a Chief Admin.";
            }
        } else {
            echo "Incorrect password.";
        }
    } else {
        echo "No user found with that username.";
    }
}

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    login($username, $password);
}
?>

<!-- HTML login form -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Chief Admin</title>
</head>
<body>
    <h2>Login as Chief Admin</h2>

    <form method="POST" action="">
        <label for="username">Username:</label>
        <input type="text" name="username" id="username" required><br>

        <label for="password">Password:</label>
        <input type="password" name="password" id="password" required><br>

        <button type="submit">Login</button>
    </form>
</body>
</html>


<?php
// Start session based on role or specialty (after successful login)
function startRoleBasedSession($roleOrSpecialty) {
    // Skip 'Chief Admin' and do nothing for their session
    if ($roleOrSpecialty === 'Chief Admin') {
        return;  // Do nothing for Chief Admin
    }

    // Start session for other roles
    switch ($roleOrSpecialty) {
        case 'Pharmacy Admin':
            session_name('PharmacyAdminSession');
            break;
        case 'Pharmacy Staff':
            session_name('PharmacyStaffSession');
            break;
        case 'Pharmacy Cashier':
            session_name('PharmacyCashierSession');
            break;
        case 'Wards':
            session_name('WardsSession');
            break;
        case 'ER Nurse':
            session_name('NurseSession');
            break;
        case 'Cardiology':
            session_name('CardiologySession');  // Start session for Cardiology specialty
            break;
        case 'Radiology':
            session_name('RadiologySession');  // Start session for Radiology specialty
            break;
        case 'Gastroenterology':
            session_name('GastroenterologySession');  // Start session for Gastroenterology specialty
            break;
        case 'Pediatricians':
            session_name('PediatriciansSession');  // Start session for Pediatricians specialty
            break;
        default:
            session_name('DefaultSession');
            break;
    }
    session_start(); // Start session with the defined session name
}

// Database connection
$host = 'localhost';
$user = 'root';
$password = '';
$dbname = 'database'; // Replace with your actual database name

$conn = new mysqli($host, $user, $password, $dbname);

if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}

// Function to sanitize input
function sanitize_input($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}

// Login function
function login($username, $password) {
    global $conn;

    // Sanitize user inputs to avoid SQL injection
    $username = $conn->real_escape_string($username);
    $password = trim($password); // Remove any extra spaces from the input

    // Query to fetch the user data
    $sql = "SELECT * FROM chief_admins WHERE username = '$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Fetch the user data
        $user = $result->fetch_assoc();

        // Verify the password
        if (password_verify($password, $user['password'])) {
            // Skip session creation for Chief Admin
            if ($user['role'] !== 'Chief Admin') {
                // Start session with role-based session name for other users
                startRoleBasedSession($user['role']);
            }
            
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['role'] = $user['role'];

            // Redirect based on role
            if ($user['role'] === 'Chief Admin') {
                // Redirect to Chief Admin dashboard
                header("Location: /dashboard.php");  // Change this path to your Chief Admin dashboard path
                exit();
            }

            // Check if the user role is eligible for login history
            if (in_array($user['role'], ['Pharmacy Staff', 'Pharmacy Cashier', 'Wards', 'ER Nurse'])) {
                // Set timezone and log login history
                date_default_timezone_set('Asia/Manila');
                $timeIn = date("H:i:s");
                $loginDate = date("Y-m-d");

                $insertHistoryQuery = "INSERT INTO login_history (username, role, shift, time_in, login_date, status)
                                       VALUES ('$username', '{$user['role']}', '{$user['shift']}', '$timeIn', '$loginDate', 'Active')";

                if ($conn->query($insertHistoryQuery) === TRUE) {
                    // Redirect based on role
                    switch ($user['role']) {
                        case 'Pharmacy Staff':
                            header("Location: Pharmacy/InventoryStaff.php");
                            break;
                        case 'Pharmacy Cashier':
                            header("Location: Pharmacy/Cashin.php");
                            break;
                        case 'Wards':
                            header("Location: patient/PatientDashboard.php");
                            break;
                        case 'ER Nurse':
                            header("Location: Pharmacy/Cashin.php");
                            break;
                    }
                    exit();
                } else {
                    header("Location: login.php?error=Failed to log login history: " . $conn->error);
                    exit();
                }
            } else {
                // Redirect for Pharmacy Admin
                header("Location: Pharmacy/InventoryDashboard.php");
                exit();
            }
        } else {
            header("Location: login.php?error=Incorrect password");
            exit();
        }
    } else {
        // If user is not found in users table, check in doctors table based on specialties
        $doctorQuery = "SELECT doctor_id, name, password, specialties FROM doctors WHERE username='$username'";
        $doctorResult = $conn->query($doctorQuery);

        if ($doctorResult->num_rows > 0) {
            $doctor = $doctorResult->fetch_assoc();

            // Verify the password for doctor
            if (password_verify($password, $doctor['password'])) {
                // Skip session creation for Chief Admin
                if ($doctor['specialties'] !== 'Chief Admin') {
                    // Start session with specialty-based session name for other doctors
                    startRoleBasedSession($doctor['specialties']);
                }

                $_SESSION['doctor_id'] = $doctor['doctor_id'];
                $_SESSION['name'] = $doctor['name'];
                $_SESSION['specialties'] = $doctor['specialties'];

                // Redirect based on specialties
                switch ($doctor['specialties']) {
                    case 'Cardiology':
                        header("Location: patient/DoctorsDashboard.php");  // Redirect to cardiology.php
                        break;
                    case 'Radiology':
                        header("Location: patient/RadiologyDashboard.php");
                        break;
                    case 'Pediatricians':
                        header("Location: patient/PediatriciansDashboard.php");
                        break;
                    case 'Gastroenterology':
                        header("Location: patient/GastroenterologyDashboard.php");
                        break;
                    default:
                        header("Location: general_dashboard.php");
                        break;
                }
                exit();
            } else {
                header("Location: login.php?error=Incorrect password");
                exit();
            }
        } else {
            header("Location: login.php?error=User not found");
            exit();
        }
    }
}

// Handle the login process when the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = sanitize_input($_POST['uname']);
    $password = sanitize_input($_POST['password']);

    login($username, $password);
}

$conn->close();
?>
