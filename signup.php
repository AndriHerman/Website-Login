<?php
require 'functions.php';

if (isset($_POST["register"])) {
    if (registrasi($_POST) > 0) {
        echo "<script>
            alert('User Baru Berhasil Ditambahkan!');
            </script>";
    } else {
        echo mysqli_error($conn);
    }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SignUp|Andrian Suherman</title>
</head>

<body>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f3f3f3;
            margin: 0;
        }

        .container {
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            font-size: 24px;
            font-weight: bold;
            color: #333;
            text-align: center;
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .form-group input {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
            outline: none;
        }

        button[type="submit"] {
            display: block;
            width: 100%;
            padding: 10px;
            background-color: #27ae60;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
            transition: background-color 0.3s ease;
        }

        button[type="submit"]:hover {
            background-color: #219652;
        }

        .footer {
            text-align: center;
            margin-top: 20px;
            color: #777;
        }

        .footer a {
            color: #333;
            font-weight: bold;
            text-decoration: none;
        }

        .footer a:hover {
            text-decoration: underline;
        }

        .footer:last-child {
            margin-top: 40px;
        }
    </style>
    <div class="container">
        <h1>Sign Up Page</h1>
        <form action="" method="post">
            <ul>
                <div class="form-group">
                    <label for="username">Username : </label>
                    <input type="text" name="username" id="username">
                </div>
                <div class="form-group">
                    <label for="password">Password : </label>
                    <input type="password" name="password" id="password">
                </div>
                <div class="form-group">
                    <label for="password2">Konfirmasi Password : </label>
                    <input type="password" name="password2" id="password2">
                </div>
                <div class="form-group">
                    <button type="submit" name="register">sign-up</button>
                </div>
            </ul>
        </form>
        <div class="footer">
            Have an account? <a href="login.php">Log In</a>
        </div>
        <br>
        <br>
        <div class="footer">
            Created by Andrian Suherman
        </div>
    </div>
</body>

</html>