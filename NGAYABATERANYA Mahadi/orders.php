
 <?php
include "databaseconnection.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $order_id = $_POST['order_id'];
    $user_id = $_POST['user_id'];
    $total_amount = $_POST['total_amount'];

    $sql = "INSERT INTO Orders (order_id, user_id, total_amount) VALUES ('$order_id', '$user_id', '$total_amount')";
    $result = $connection->query($sql);

    if ($result) {
        echo "Inserted Successfully. Order ID: $order_id";
        header("location: vieworders.php");
        exit();
    } else {
        echo "Inserted fail";
    }
}
?>


