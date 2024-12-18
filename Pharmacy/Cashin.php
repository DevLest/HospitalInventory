<?php
session_name('PharmacyCashierSession');
session_start(); 

// Check if user is logged in
if (!isset($_SESSION['username'])) {
    header('Location: login.php?error=Please log in first');
    exit();
}

require_once('../connection/dbconfig.php'); 


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $one = intval($_POST['one']);
    $five = intval($_POST['five']);
    $ten = intval($_POST['ten']);
    $twenty = intval($_POST['twenty']);
    $fifty = intval($_POST['fifty']);
    $hundred = intval($_POST['hundred']);
    $five_hundred = intval($_POST['fiveHundred']);
    $thousand = intval($_POST['thousand']);
    
    // Calculate total cash-in
    $total_cash_in = ($one * 1) + ($five * 5) + ($ten * 10) + ($twenty * 20) + 
                     ($fifty * 50) + ($hundred * 100) + ($five_hundred * 500) + ($thousand * 1000);

    // Get the current user's ID from the users table
    $username = $_SESSION['username'];
    $userQuery = "SELECT id FROM users WHERE username='$username'";
    $userResult = $conn->query($userQuery);
    if ($userResult->num_rows > 0) {
        $user = $userResult->fetch_assoc();
        $user_id = $user['id'];

        // Insert cash-in data into the cash_in table
        $insertQuery = "INSERT INTO pharmacy_cashier_cash_in (user_id, one, five, ten, twenty, fifty, hundred, five_hundred, thousand, total_cash_in)
                        VALUES ($user_id, $one, $five, $ten, $twenty, $fifty, $hundred, $five_hundred, $thousand, $total_cash_in)";
        
        if ($conn->query($insertQuery) === TRUE) {
            echo "Cash-in recorded successfully!";
            // Redirect to POS system after cash-in
            header("Location: PharmacyPOS.php");
            exit();
        } else {
            echo "Error: " . $conn->error;
        }
    } else {
        echo "Error: User not found!";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cashier Cash-In Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .cash-in-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 400px;
        }
        h2 {
            text-align: center;
            color: #333;
        }
        .cash-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 15px;
        }
        label {
            font-size: 16px;
            color: #555;
        }
        input[type="number"] {
            width: 80px;
            padding: 5px;
            font-size: 16px;
            text-align: right;
        }
        .total-row {
            margin-top: 20px;
            display: flex;
            justify-content: space-between;
            font-weight: bold;
            font-size: 18px;
        }
        button {
            width: 100%;
            padding: 10px;
            background-color: #28a745;
            color: white;
            border: none;
            font-size: 18px;
            cursor: pointer;
            border-radius: 5px;
            margin-top: 20px;
        }
        button:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>

    <div class="cash-in-container">
        <h2>Cashier Cash-In</h2>
        <form id="cashInForm" method="POST" action="Cashin.php">
            <div class="cash-row">
                <label for="one">1 x </label>
                <input type="number" id="one" name="one" min="0" value="0">
            </div>
            <div class="cash-row">
                <label for="five">5 x </label>
                <input type="number" id="five" name="five" min="0" value="0">
            </div>
            <div class="cash-row">
                <label for="ten">10 x </label>
                <input type="number" id="ten" name="ten" min="0" value="0">
            </div>
            <div class="cash-row">
                <label for="twenty">20 x </label>
                <input type="number" id="twenty" name="twenty" min="0" value="0">
            </div>
            <div class="cash-row">
                <label for="fifty">50 x </label>
                <input type="number" id="fifty" name="fifty" min="0" value="0">
            </div>
            <div class="cash-row">
                <label for="hundred">100 x </label>
                <input type="number" id="hundred" name="hundred" min="0" value="0">
            </div>
            <div class="cash-row">
                <label for="fiveHundred">500 x </label>
                <input type="number" id="fiveHundred" name="fiveHundred" min="0" value="0">
            </div>
            <div class="cash-row">
                <label for="thousand">1000 x </label>
                <input type="number" id="thousand" name="thousand" min="0" value="0">
            </div>

            <div class="total-row">
                <label>Total Cash-In:</label>
                <span id="totalCashIn">0</span>
            </div>

            <button type="submit">Enter</button>
</form>
    </div>

    <script>
        function calculateTotal() {
            const one = parseInt(document.getElementById('one').value) * 1;
            const five = parseInt(document.getElementById('five').value) * 5;
            const ten = parseInt(document.getElementById('ten').value) * 10;
            const twenty = parseInt(document.getElementById('twenty').value) * 20;
            const fifty = parseInt(document.getElementById('fifty').value) * 50;
            const hundred = parseInt(document.getElementById('hundred').value) * 100;
            const fiveHundred = parseInt(document.getElementById('fiveHundred').value) * 500;
            const thousand = parseInt(document.getElementById('thousand').value) * 1000;

            const total = one + five + ten + twenty + fifty + hundred + fiveHundred + thousand;

            document.getElementById('totalCashIn').innerText = total;
        }

        // Automatically recalculate total whenever inputs change
        document.querySelectorAll('input[type="number"]').forEach(input => {
            input.addEventListener('input', calculateTotal);
        });
    </script>

</body>
</html>
