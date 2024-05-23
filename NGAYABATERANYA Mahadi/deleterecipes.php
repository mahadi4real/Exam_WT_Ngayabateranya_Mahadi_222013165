<?php
if (isset($_GET["recipe_id"])) {
    $recipe_id = $_GET["recipe_id"];
    include "databaseconnection.php";

    $sql = "DELETE FROM recipes WHERE recipe_id = $recipe_id";
    if ($connection->query($sql)) {
        echo "Record deleted successfully";
        header("location: viewrecipes.php");
        exit;
    } else {
        echo "Error deleting record: " . $connection->error;
    }
    $connection->close();
}
?>
