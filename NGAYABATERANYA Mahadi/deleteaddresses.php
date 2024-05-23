<?php
if (isset($_GET["address_id"])) {
   $addressID = $_GET["address_id"];
   // Call the file that contains the database connection
   include "databaseconnection.php";
   
   $sql = "DELETE FROM Addresses WHERE address_id = ?";
   $stmt = $connection->prepare($sql);
   $stmt->bind_param("i", $addressID);
   
   if ($stmt->execute()) {
       echo "Record deleted successfully";
       header("location: viewaddresses.php");
       exit;
   } else {
       echo "Error deleting record: " . $stmt->error;
   }
   
   $stmt->close();
   $connection->close();
}
?>
