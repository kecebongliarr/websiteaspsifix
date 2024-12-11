<?php
include 'config.php';

if (isset($_POST['order_id'])) {
    $orderId = $_POST['order_id'];

    $sql = "DELETE FROM orders WHERE no = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $orderId); // "i" utk integer

    if ($stmt->execute()) {
        echo 'success';
    } else {
        echo 'failed';
    }

    $stmt->close(); 
} else {
    echo 'failed';
}
?>
