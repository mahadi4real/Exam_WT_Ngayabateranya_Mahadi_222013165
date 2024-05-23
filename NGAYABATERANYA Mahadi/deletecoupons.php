
  

  <?php
if (isset($_GET["coupon_id"])) {
   $coupon_id = $_GET["coupon_id"];
   include "databaseconnection.php";
   $sql = "DELETE FROM coupons WHERE coupon_id = $coupon_id";
   if ($connection->query($sql)) {
       echo "Record deleted successfully";
       header("location:coupons.php");
       exit;
   } else {
       echo "Error deleting record: " . $connection->error;
   }
   $connection->close();
}
?>
