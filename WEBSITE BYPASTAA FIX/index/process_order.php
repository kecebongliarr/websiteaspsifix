<?php
session_start();

if (!isset($_SESSION['customer']) || !isset($_SESSION['cart'])) {
    header('Location: keranjang.php');
    exit();
}

$customer = $_SESSION['customer'];
$cart = $_SESSION['cart'];
$totalPrice = 0;

foreach ($cart as $product) {
    $totalPrice += $product['price'] * $product['quantity'];
}

include 'config.php'; 


$sql = "INSERT INTO orders (nama_pembeli, alamat, nomor_telepon, total_harga) 
        VALUES (?, ?, ?, ?)";


if ($stmt = $conn->prepare($sql)) {

    $stmt->bind_param("sssd", $customer['name'], $customer['address'], $customer['phone'], $totalPrice);
    $stmt->execute();

    $orderId = $conn->insert_id; 

    
    foreach ($cart as $productId => $product) {
        $subtotal = $product['price'] * $product['quantity'];
        
        
        $sqlDetail = "INSERT INTO order_details (order_id, product_id, quantity, subtotal) 
                      VALUES (?, ?, ?, ?)";
        
        if ($stmtDetail = $conn->prepare($sqlDetail)) {
        
            $stmtDetail->bind_param("iiid", $orderId, $productId, $product['quantity'], $subtotal);
            $stmtDetail->execute();
        } else {
            echo "Error: " . $conn->error;
        }
    }

    unset($_SESSION['cart']); 

    header('Location: order_success.php');
    exit();
} else {
    echo "Error: " . $conn->error;
}
?>
