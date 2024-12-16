<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Outpatient Management</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        h1, h2 {
            text-align: center;
            margin-top: 20px;
        }
        form {
            margin: 20px auto;
            width: 80%;
            max-width: 500px;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        label {
            display: block;
            margin-bottom: 5px;
        }
        input[type="text"],
        input[type="number"] {
            width: calc(100% - 12px);
            padding: 6px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        input[type="submit"] {
            width: 100%;
            padding: 10px;
            border: none;
            background-color: #007bff;
            color: #fff;
            cursor: pointer;
            border-radius: 4px;
            transition: background-color 0.3s ease;
        }
        input[type="submit"]:hover {
            background-color: #0056b3;
        }
        ul {
            list-style-type: none;
            padding: 0;
            margin: 20px auto;
            width: 80%;
            max-width: 500px;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        li {
            margin-bottom: 10px;
        }
        li:last-child {
            margin-bottom: 0;
        }
        a {
            text-decoration: none;
            color: #007bff;
            margin-left: 10px;
        }
    </style>
</head>
<body>
    <h1>Outpatient Management System</h1>
    
    <h2>Add New Outpatient Record:</h2>
    <form action="add_outpatient.php" method="post">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name">
        
        <label for="age">Age:</label>
        <input type="number" id="age" name="age">
        
        <label for="diagnosis">Diagnosis:</label>
        <input type="text" id="diagnosis" name="diagnosis">
        
        <input type="submit" value="Add Record">
    </form>
    
    <h2>All Outpatient Records:</h2>
    <ul>
        <?php
        $conn = mysqli_connect('localhost', 'username', 'password', 'outpatient_db');
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        $sql = "SELECT * FROM outpatient";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
                echo "<li>" . $row["name"] . " - Age: " . $row["age"] . ", Diagnosis: " . $row["diagnosis"] . "</li>";
            }
        } else {
            echo "<li>No records found</li>";
        }

        mysqli_close($conn);
        ?>
    </ul>
</body>
</html>
