<?php
include('config.php');

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $username = $conn->real_escape_string($_POST['username']);
    $password = $_POST['password'];

    
    $sql = "SELECT * FROM penjual WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);  // "s" itu string
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        if ($password === $user['password']) {
            $_SESSION['loggedin'] = true;
            $_SESSION['username'] = $username;

            header("Location: penjual.php");
            exit();
        } else {
            $error_message = "Invalid password.";
        }
    } else {
        $error_message = "Username not found.";
    }

    $stmt->close();  // tutup prepared statement
}

$conn->close();  // dc database connection
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/login.css">
    <title>Login Penjual - By.pastaa</title>
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
                    <h2 class="bigtitle">Login Penjual</h2>
                    <p>Masukkan username dan password untuk mengakses halaman pesanan.</p>
                </div>
                <div class="login-form">
                    <?php if (isset($error_message)): ?>
                        <p style="color: red;"><?php echo $error_message; ?></p>
                    <?php endif; ?>

                    <form action="loginpenjual.php" method="POST">
                        <label for="username">Username</label>
                        <input type="text" id="username" name="username" placeholder="Masukkan username" required>
                        <div class="spacercontent"></div>
                        <label for="password">Password</label>
                        <input type="password" id="password" name="password" placeholder="Masukkan password" required>
                        <div class="spacercontent"></div>
                        <button type="submit" class="bigbtn">Login</button>
                    </form>
                    <div class="spacercontent"></div>
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
