<?php
include "databaseconnection.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $order_id = $_POST['order_id'];
    $status = $_POST['status'];

    $sql = "INSERT INTO Delivery (delivery_id, order_id, status) VALUES (NULL, '$order_id', '$status')";
    $result = $connection->query($sql);

    if ($result) {
        echo "Inserted Successfully";
        header("location: viewdelivery.php");
        exit();
    } else {
        echo "Insertion failed";
    }
}
?>
