<?php
include "databaseconnection.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $recipe_id = $_POST['recipe_id'];
    $title = $_POST['title'];
    $description = $_POST['description'];

    $sql = "INSERT INTO Recipes (recipe_id, title, description) VALUES ('$recipe_id', '$title', '$description')";
    $result = $connection->query($sql);

    if ($result) {
        echo "Inserted Successfully";
        header("location: viewrecipes.php");
        exit();
    } else {
        echo "Insertion failed: " . $connection->error;
    }
}

?>
