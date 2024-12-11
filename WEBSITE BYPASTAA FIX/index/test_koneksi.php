<?php
include 'config.php';


$sql = "SHOW TABLES";
$result = $conn->query($sql);

if ($result) {
    echo "Connection successful! Tables in database: ";
    while ($row = $result->fetch_assoc()) {
        echo $row['Tables_in_websitejidan'] . " ";
    }
} else {
    echo "Query failed: " . $conn->error;
}

$conn->close();
?>