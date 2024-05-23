<?php
include "databaseconnection.php";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $UserID = $_POST['UserID'];
    $Address = $_POST['Address'];
    
    $sql = "INSERT INTO Addresses (user_id, address) VALUES ('$UserID', '$Address')";
    $result = $connection->query($sql);
    
    if ($result) {
        $address_id = $connection->insert_id;  // Get the auto-incremented address_id
        echo "Inserted Successfully with address_id: $address_id";
        header("location:viewaddresses.php");
        exit();
    } else {
        echo "Insertion failed";
    }
}
?>
