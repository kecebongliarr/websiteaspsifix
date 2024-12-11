<?php
$servername = "localhost";
$username = "sxwvszbx_adminbypastaaest2020"; // dari MySQL username
$password = "=eS,U9xwIHZy"; // dari MySQL password
$dbname = "sxwvszbx_websiteapsi"; // dari database name

// buat connection
$conn = new mysqli($servername, $username, $password, $dbname);

// cek connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
