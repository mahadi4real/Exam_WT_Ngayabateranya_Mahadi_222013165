
  

<?php
if (isset($_GET["payment_id"])) {
   $payment_id = $_GET["payment_id"];
   include "databaseconnection.php";
   $sql = "DELETE FROM payment_methods WHERE payment_id = $payment_id";
   if ($connection->query($sql)) {
       echo "Record deleted successfully";
       header("location:payment_methods.php");
       exit;
   } else {
       echo "Error deleting record: " . $connection->error;
   }
   $connection->close();
}
?>




