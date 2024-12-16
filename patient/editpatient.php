<?php
// Database connection (adjust to your database details)
$servername = "localhost";
$username = "root";  // Your database username
$password = "";      // Your database password
$dbname = "database"; // Your database name

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the form data
    $id = $_POST['id'];
    $hospitalnum = $_POST['hospitalnum'];
    $lastname = $_POST['lastname'];
    $firstname = $_POST['firstname'];
    $middlename = $_POST['middlename'];
    $ext_name = $_POST['ext_name'];
    $address = $_POST['address'];
    $age = $_POST['age'];
    $birthday = $_POST['birthday'];
    $birthplace = $_POST['birthplace'];
    $civilstatus = $_POST['civilstatus'];
    $gender = $_POST['gender'];
    $mobile = $_POST['mobile'];
    $religion = $_POST['religion'];
    $occupation = $_POST['occupation'];
    $date = $_POST['date'];

    // SQL Update query
    $sql = "UPDATE patient SET 
                hospitalnum = ?, 
                lastname = ?, 
                firstname = ?, 
                middlename = ?, 
                ext_name = ?, 
                address = ?, 
                age = ?, 
                birthday = ?, 
                birthplace = ?, 
                civilstatus = ?, 
                gender = ?, 
                mobile = ?, 
                religion = ?, 
                occupation = ?, 
                date = ? 
            WHERE id = ?";

    // Prepare and execute the query
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("sssssssssssssssi", 
            $hospitalnum, $lastname, $firstname, $middlename, $ext_name, 
            $address, $age, $birthday, $birthplace, $civilstatus, 
            $gender, $mobile, $religion, $occupation, $date, $id);
        
        if ($stmt->execute()) {
            // Redirect back to the dashboard after the update
            header('Location: OutpatientList.php');  // Adjust to your dashboard page
            exit();
        } else {
            echo "Error: " . $stmt->error;
        }
        
        $stmt->close();
    } else {
        echo "Error: " . $conn->error;
    }
}
$conn->close();
?>
