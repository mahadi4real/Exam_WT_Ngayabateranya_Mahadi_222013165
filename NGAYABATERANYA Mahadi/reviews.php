<?php
include "databaseconnection.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $UserID = $_POST['UserID'];
    $Content = $_POST['Content'];

    $sql = "INSERT INTO Reviews (user_id, content) VALUES ('$UserID', '$Content')";
    $result = $connection->query($sql);

    if ($result) {
        // Fetch the last inserted review_id
        $review_id = $connection->insert_id;
        echo "Inserted Successfully. Review ID: $review_id";
        header("location:viewreviews.php");
        exit();
    } else {
        echo "Insertion failed";
    }
}
?>

