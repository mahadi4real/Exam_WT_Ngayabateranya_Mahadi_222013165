<?php
include "databaseconnection.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $ingredient_id = $_POST['ingredient_id'];
    $name = $_POST['name'];
    $quantity = $_POST['quantity'];

    $sql = "INSERT INTO Ingredients (ingredient_id, name, quantity) VALUES ('$ingredient_id', '$name', '$quantity')";
    $result = $connection->query($sql);

    if ($result) {
        echo "<div class='alert alert-success' role='alert'>Inserted Successfully</div>";
        header("location: viewingredients.php");
        exit();
    } else {
        echo "<div class='alert alert-danger' role='alert'>Insertion failed: " . $connection->error . "</div>";
    }
}
?>
