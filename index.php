
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        body {
            background-image: url('css/bc.jpg'); /* Background image */
            background-size: cover;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            flex-direction: column;
        }
        form {
            width: 500px;
            border: 2px solid #ccc;
            padding: 30px;
            background: #fff;
            border-radius: 15px;
        }
        h2 {
            text-align: center;
            margin-bottom: 40px;
        }
        input, select {
            display: block;
            border: 2px solid #ccc;
            width: 95%;
            padding: 10px;
            margin: 10px auto;
            border-radius: 5px;
        }
        button {
            float: right;
            background: #555;
            padding: 10px 15px;
            color: #fff;
            border-radius: 5px;
            border: none;
        }
        button:hover {
            opacity: .7;
        }
        .error {
           background: #F2DEDE;
           color: #A94442;
           padding: 10px;
           width: 95%;
           border-radius: 5px;
           margin: 20px auto;
        }
    </style>
</head>
<body>
<form action="login.php" method="post">
    <h2>LOGIN</h2>
    <?php if (isset($_GET['error'])) { ?>
        <p class="error"><?php echo $_GET['error']; ?></p>
    <?php } ?>
    
    <label>User Name</label>
    <input type="text" name="uname" placeholder="User Name" required><br>

    <label>Password</label>
    <input type="password" name="password" placeholder="Password" required><br>

    <button type="submit">Login</button>
</form>

</body>
</html>
