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
    $target_dir = __DIR__ . "/uploads/";  // Use absolute path
    if (!file_exists($target_dir)) {
        mkdir($target_dir, 0777, true);  // Create directory if it doesn't exist
    }
    $target_file = $target_dir . basename($image);

    // Move uploaded file to the target directory
    if (move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
        // Insert doctor data into database with image path
        $relative_path = "uploads/" . basename($image); // Save relative path for database
        $query = "INSERT INTO doctors (name, email, clinic_address, contact_number, specialties, username, password, image,  license) 
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

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Doctor</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f4f6f9; }
        .container { width: 50%; margin: auto; padding: 20px; background-color: white; border-radius: 5px; box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1); }
        h2 { text-align: center; color: #333; }
        form { display: flex; flex-direction: column; }
        label { margin-top: 10px; font-weight: bold; }
        input, textarea, button { padding: 10px; margin-top: 5px; border-radius: 5px; border: 1px solid #ddd; }
        button { background-color: #1abc9c; color: white; border: none; cursor: pointer; }
        button:hover { background-color: #16a085; }
    </style>
</head>
<body>
    <div class="container">
        <h2>Add Doctor</h2>
        <form method="POST" action="" enctype="multipart/form-data">
            <label for="name">Doctor's Name:</label>
            <input type="text" name="name" id="name" required>

            <label for="email">Email:</label>
            <input type="email" name="email" id="email" required>

            <label for="clinic_address">Clinic Address:</label>
            <textarea name="clinic_address" id="clinic_address" rows="3" required></textarea>

            <label for="contact_number">Contact Number:</label>
            <input type="text" name="contact_number" id="contact_number" required>

            <label for="specialties">Specialties (e.g., Cardiology, Pediatrics):</label>
            <input type="text" name="specialties" id="specialties" required>

            <label for="username">Username:</label>
            <input type="text" name="username" id="username" required>

            <label for="password">Password:</label>
            <input type="password" name="password" id="password" required>

            <label for="license">License:</label>
            <input type="license" name="license" id="license" required>

            <label for="image">Upload Image:</label>
            <input type="file" name="image" id="image" accept="image/*">

            <button type="submit">Add Doctor</button>
        </form>
    </div>
</body>
</html>
