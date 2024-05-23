<?php
if (isset($_GET["ingredient_id"])) {
   $ingredient_id = $_GET["ingredient_id"];
   include "databaseconnection.php";
   $sql = "DELETE FROM Ingredients WHERE ingredient_id = $ingredient_id";
   if ($connection->query($sql)) {
       echo "Record deleted successfully";
       header("location:ingredients.php");
       exit;
   } else {
       echo "Error deleting record: " . $connection->error;
   }
   $connection->close();
}
?>
