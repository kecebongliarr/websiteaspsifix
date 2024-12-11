<?php
include 'config.php';

// tarek smua order sis
$sql = "SELECT * FROM orders ORDER BY no DESC";
$result = $conn->query($sql);


$orders = [];
if ($result) {
    while ($row = $result->fetch_assoc()) {
        $orders[] = $row;
    }
} else {
    $orders = []; 
}


echo json_encode($orders);
?>
