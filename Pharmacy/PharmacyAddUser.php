<?php
require_once('../connection/dbconfig.php'); 


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash the password
    $shift = $_POST['shift'];
    $role = $_POST['role'];

    // Handling image upload
    $targetDir = "uploads/"; // Directory where the images will be saved
    $imageName = basename($_FILES["userImage"]["name"]); // Original file name
    $imageFileType = strtolower(pathinfo($imageName, PATHINFO_EXTENSION));

    // Create a unique file name using a timestamp
    $uniqueFileName = pathinfo($imageName, PATHINFO_FILENAME) . "_" . time() . "." . $imageFileType;
    $targetFile = $targetDir . $uniqueFileName;

    // Check if 'uploads' directory exists, if not create it
    if (!is_dir($targetDir)) {
        mkdir($targetDir, 0755, true);  // Create directory with write permission
    }

    // Validate the uploaded image
    $check = getimagesize($_FILES["userImage"]["tmp_name"]);
    if ($check !== false) {
        // Move the uploaded file to the server
        if (move_uploaded_file($_FILES["userImage"]["tmp_name"], $targetFile)) {
            echo "The file " . htmlspecialchars($uniqueFileName) . " has been uploaded.";
        } else {
            echo "Sorry, there was an error uploading your file.";
            exit;
        }
    } else {
        echo "File is not an image.";
        exit;
    }

    // Insert the user details into the database
    $sql = "INSERT INTO users (username, email, password, shift, role, profile_image) 
            VALUES ('$username', '$email', '$password', '$shift', '$role', '$targetFile')";

    if ($conn->query($sql) === TRUE) {
        echo "New user added successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

}
?>
