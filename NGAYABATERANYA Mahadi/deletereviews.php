<?php
if (isset($_GET["review_id"])) {
    $reviewID = $_GET["review_id"];
    include "databaseconnection.php";
    $sql = "DELETE FROM Reviews WHERE review_id = ?";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("i", $reviewID);
    if ($stmt->execute()) {
        echo "Record deleted successfully";
        header("location: reviews.php");
        exit;
    } else {
        echo "Error deleting record: " . $stmt->error;
    }
    $connection->close();
}
?>
