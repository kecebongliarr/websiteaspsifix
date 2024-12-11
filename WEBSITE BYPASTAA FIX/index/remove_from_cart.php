<?php
session_start();

if (isset($_GET['productId'])) {
    $productId = $_GET['productId'];

    if (isset($_SESSION['cart'][$productId])) {
        unset($_SESSION['cart'][$productId]);
    }
}

header('Location: keranjang.php');
exit;
?>
