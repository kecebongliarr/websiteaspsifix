<?php
session_start();


if (isset($_POST['productId']) && isset($_POST['quantity'])) {
    $productId = $_POST['productId'];
    $quantity = $_POST['quantity'];

    
    if ($quantity < 1) {
        $quantity = 1;
    }

    
    if (isset($_SESSION['cart'][$productId])) {
        $_SESSION['cart'][$productId]['quantity'] = $quantity;
    }

    
    $totalPrice = 0;
    foreach ($_SESSION['cart'] as $product) {
        $totalPrice += $product['price'] * $product['quantity'];
    }

    
    $productSubtotal = $_SESSION['cart'][$productId]['price'] * $quantity;
    $totalPriceFormatted = number_format($totalPrice, 0, ',', '.');
    $productSubtotalFormatted = number_format($productSubtotal, 0, ',', '.');

 
    echo json_encode([
        'totalPriceFormatted' => $totalPriceFormatted,
        'productSubtotalFormatted' => $productSubtotalFormatted
    ]);
}
?>
