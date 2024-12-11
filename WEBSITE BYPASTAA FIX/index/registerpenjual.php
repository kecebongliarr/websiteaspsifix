<?php
include('config.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = pg_escape_string($conn, $_POST['username']);
    $password = $_POST['password'];

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);


    $sql = "INSERT INTO penjual (username, password) VALUES ('$username', '$hashed_password')";
    
    if (pg_query($conn, $sql)) {
        echo "New record created successfully";

        header("Location: loginpenjual.php");
        exit();
    } else {
        echo "Error: " . pg_last_error($conn);
    }

    pg_close($conn);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/login.css">
    <title>Register Penjual - By.pastaa</title>
</head>
<body>
    <div class="header spacersection">
        <div class="container">
            <div class="nav d-flex ai-center jc-spacebetween">
                <div class="nav-brand">
                    <h1><a href="index.php">By.pastaa</a></h1>
                </div>
            </div>
        </div>
    </div>

    <div class="login spacersection">
        <div class="container">
            <div class="d-flex f-wrap jc-spacebetween ai-center">
                <div class="login-desc">
                    <h2 class="bigtitle">Register Penjual</h2>
                    <p>Buat username dan password</p>
                </div>
                <div class="login-form">
                <form action="registerpenjual.php" method="POST" enctype="multipart/form-data">
                    <label for="username">Username</label>
                        <input type="text" id="username" name="username" placeholder="Masukkan username" required>
                        <div class="spacercontent"></div>
                        <label for="password">Password</label>
                        <input type="password" id="password" name="password" placeholder="Masukkan password" required>
                        <div class="spacercontent"></div>
                        <button type="submit" class="bigbtn">Register</button>
                    </form>
                    <div class="spacercontent"></div>
                    <p class="register-link">
                        Sudah memiliki akun penjual? 
                        <a href="loginpenjual.php" class="bigbtn">Login</a>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <div class="footer spacersection">
        <div class="container">
            <p>&copy; 2024 kejar jam tayang. All rights reserved.</p>
        </div>
    </div>
</body>
</html>