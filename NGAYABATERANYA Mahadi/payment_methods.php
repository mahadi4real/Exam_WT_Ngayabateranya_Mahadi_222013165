<?php
include "databaseconnection.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $payment_id = $_POST['payment_id'];
    $method_name = $_POST['method_name'];
    $details = $_POST['details'];

    $sql = "INSERT INTO Payment_Methods (payment_id, method_name, details) VALUES ('$payment_id', '$method_name', '$details')";
    $result = $connection->query($sql);

    if ($result) {
        echo "Inserted Successfully";
        header("location: viewpayment_methods.php");
        exit();
    } else {
        echo "Inserted fail";
    }
}
?>
