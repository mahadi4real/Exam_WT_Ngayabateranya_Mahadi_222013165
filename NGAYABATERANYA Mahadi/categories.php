<?php
include "databaseconnection.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $category_id = $_POST['category_id'];
    $name = $_POST['name'];
    $description = $_POST['description'];

    $sql = "INSERT INTO categories (category_id, name, description) VALUES ('$category_id', '$name', '$description')";
    $result = $connection->query($sql);

    if ($result) {
        echo "Inserted Successfully";
        header("location: viewcategories.php");
        exit();
    } else {
        echo "Inserted fail";
    }
}
?>
