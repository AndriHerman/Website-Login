<?php
session_start();
if (isset($_SESSION["login"])) {
    header("Location: index.php");
    exit;
}
require 'functions.php';

// cek tombol
if (isset($_POST["submit"])) {

    // cek username & Pass
    $username = $_POST["username"];
    $password = $_POST["password"];

    $result = mysqli_query($conn, "SELECT * FROM users WHERE 
        username ='$username'");

    // cek username
    if (mysqli_num_rows($result) == 1) {
        // cek password
        $row = mysqli_fetch_assoc($result);
        if (password_verify($password, $row["password"])) {

            // set session
            $_SESSION["login"] = true;

            header("Location: index.php");
            exit;
        }
    }
    $error = true;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="container">
        <form class="login-form" method="post" action="">
            <h1>Login</h1>
            <?php if (isset($error)) : ?>
                <p class="error">Username / Password Salah!</p>
            <?php endif; ?>
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" name="username" id="username" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" name="password" id="password" required>
            </div>
            <button type="submit" name="submit">LOGIN</button>
        </form>
        <div class="footer">
            Don't have an account? <a href="signup.php">Sign Up</a>
        </div>
    </div>
</body>

</html>


