<?php
include "databaseconnection.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $coupon_id = $_POST['coupon_id'];
    $code = $_POST['code'];
    $discount = $_POST['discount'];

    $sql = "INSERT INTO Coupons (coupon_id, code, discount) VALUES ('$coupon_id', '$code', '$discount')";
    $result = $connection->query($sql);

    if ($result) {
        echo "Inserted Successfully";
        header("location: viewcoupons.php");
        exit();
    } else {
        echo "Inserted fail";
    }
}
?>
