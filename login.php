<?php
// Start session based on role or specialty (after successful login)
function startRoleBasedSession($roleOrSpecialty) {
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
        case 'Er Nurse':
            session_name('ERNurseSession');
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
        case 'Chief Admin':
            session_name('ChiefAdminSession');  // Start session for Chief Admin
            break;
        default:
            session_name('DefaultSession');
            break;
    }
    session_start(); // Start session with the defined session name
}

require_once('connection/dbconfig.php'); 


// Function to sanitize input
function sanitize_input($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}

// Handle the login process
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = sanitize_input($_POST['uname']);
    $password = sanitize_input($_POST['password']);

    // Check if the user exists in the users table for pharmacy roles
    $query = "SELECT * FROM users WHERE username='$username'";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        // Verify the password
        if (password_verify($password, $user['password'])) {
            // Start session with role-based session name
            startRoleBasedSession($user['role']);
            
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['role'] = $user['role'];

            // Check if the user role is eligible for login history
            if (in_array($user['role'], ['Pharmacy Staff', 'Pharmacy Cashier', 'Wards', 'Er Nurse'])) {
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
                        case 'Er Nurse':
                            header("Location: patient/ERdashboard.php");
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
                // Start session with specialty-based session name
                startRoleBasedSession($doctor['specialties']);

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
            // If user is not found in users or doctors table, check in chief_admins table for Chief Admin login
            $chiefAdminQuery = "SELECT * FROM chief_admins WHERE username='$username'";
            $chiefAdminResult = $conn->query($chiefAdminQuery);

            if ($chiefAdminResult->num_rows > 0) {
                $chiefAdmin = $chiefAdminResult->fetch_assoc();

                // Verify the password for chief admin
                if (password_verify($password, $chiefAdmin['password'])) {
                    // Start session for Chief Admin
                    startRoleBasedSession('Chief Admin');

                    $_SESSION['chief_admin_id'] = $chiefAdmin['id'];
                    $_SESSION['chief_admin_username'] = $chiefAdmin['username'];
                    $_SESSION['role'] = 'Chief Admin';

                    // Redirect to Chief Admin dashboard
                    header("Location: Admin/ChiefAdmin.php");
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
}

$conn->close();
?>
