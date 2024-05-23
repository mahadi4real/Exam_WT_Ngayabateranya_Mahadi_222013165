<?php
if (isset($_GET["order_id"])) {
    $order_id = $_GET["order_id"];
    include "databaseconnection.php";

    // Prepared statement to prevent SQL injection
    $sql = "DELETE FROM Orders WHERE order_id = ?";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("i", $order_id);

    if ($stmt->execute()) {
        echo "Record deleted successfully";
        // Redirect to orders.php after successful deletion
        header("Location: orders.php");
        exit;
    } else {
        echo "Error deleting record: " . $stmt->error;
    }

    // Close the statement and connection
    $stmt->close();
    $connection->close();
}
?>

