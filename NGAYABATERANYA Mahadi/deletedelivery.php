<?php
if (isset($_GET["delivery_id"])) {
    $deliveryID = $_GET["delivery_id"];
    include "databaseconnection.php";
    $sql = "DELETE FROM Delivery WHERE delivery_id = ?";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("i", $deliveryID);
    if ($stmt->execute()) {
        echo "Record deleted successfully";
        header("location: viewdelivery.php");
        exit;
    } else {
        echo "Error deleting record: " . $stmt->error;
    }
    $connection->close();
}
?>
