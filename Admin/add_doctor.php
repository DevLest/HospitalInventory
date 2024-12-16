<?php
require_once('../connection/dbconfig.php'); 


// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $clinic_address = $_POST['clinic_address'];
    $contact_number = $_POST['contact_number'];
    $specialties = $_POST['specialties'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $license = $_POST['license'];

    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Image upload process with path check
    $image = $_FILES['image']['name'];
    $target_dir = __DIR__ . "/uploads/"; // Use absolute path
    if (!file_exists($target_dir)) {
        mkdir($target_dir, 0777, true); // Create directory if it doesn't exist
    }
    $target_file = $target_dir . basename($image);

    // Move uploaded file to the target directory
    if (move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
        // Insert doctor data into database with image path
        $relative_path = "uploads/" . basename($image); // Save relative path for database
        $query = "INSERT INTO doctors (name, email, clinic_address, contact_number, specialties, username, password, image, license) 
                  VALUES ('$name', '$email', '$clinic_address', '$contact_number', '$specialties', '$username', '$hashed_password', '$relative_path', '$license')";

        if (mysqli_query($conn, $query)) {
            echo "<script>alert('Doctor successfully added!'); window.location.href = 'Addodoc.php';</script>";
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    } else {
        echo "<script>alert('Failed to upload image. Please try again.');</script>";
    }
}

mysqli_close($conn);
?>
