<?php
session_start();
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $order_id = $_POST['order_id']; 
    
    $sql = "UPDATE orders SET status = 'processed' WHERE no = ?";
    
    
    if ($stmt = $conn->prepare($sql)) {
        
        $stmt->bind_param("i", $order_id);  // "i" = integer
        
       
        if ($stmt->execute()) {
            echo 'success';
        } else {
            echo 'error';
        }
        
        
        $stmt->close();
    } else {
        echo 'error';
    }
}
?>
