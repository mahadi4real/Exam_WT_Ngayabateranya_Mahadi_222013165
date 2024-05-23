<?php 
include "databaseconnection.php";

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (!isset($_GET["coupon_id"])) {
        header("location: viewcoupons.php");
        exit;
    }

    $coupon_id = $_GET["coupon_id"];

    $sql = "SELECT * FROM Coupons WHERE coupon_id = ?";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("i", $coupon_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $code = $row["code"];
        $discount = $row["discount"];
    } else {
        header("location: viewcoupons.php");
        exit;
    }
} elseif ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $coupon_id = $_POST["coupon_id"];
    $code = $_POST["code"];
    $discount = $_POST["discount"];

    if (empty($coupon_id) || empty($code) || empty($discount)) {
        echo "All fields are required!";
    } else {
        $sql = "UPDATE Coupons SET code=?, discount=? WHERE coupon_id=?";
        $stmt = $connection->prepare($sql);
        $stmt->bind_param("sdi", $code, $discount, $coupon_id);
        
        if ($stmt->execute()) {
            echo "Information updated successfully";
            header("location: viewcoupons.php");
            exit;
        } else {
            echo "Error updating record: " . $connection->error;
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>RECIPE INGREDIENT DELIVERY SERVICES</title>
    <script>
        function confirmUpdate(){
            return confirm('Do you want to update this record');
        }
    </script>
    <style>
        h2 {
            font-family: Castellar;
            color: darkblue;
        }
        label {
            font-family: Elephant;
            font-size: 20px;
        }
        .sb {
            font-family: Georgia;
            padding: 10px;
            border-color: blue;
            background-color: skyblue;
            width: 200px;
            margin-top: 5px;
            border-radius: 12px;
            font-weight: bold;
            color: blue;
        }
        .input {
            width: 350px;
            height: 35px;
            border-radius: 12px;
            border-color: green;
        }
    </style>
</head>
<body>
    <center>
        <h2>RECIPE INGREDIENT DELIVERY SERVICES</h2>
        <h3 style="color:green;">UPDATE COUPONS HERE</h3>
        <section class="forms">
            <form method="POST" onsubmit="return confirmUpdate();">
                <label>Coupon ID</label><br>
                <input type="text" name="coupon_id" readonly value="<?php echo $coupon_id; ?>"><br>
                <label>Code</label><br>
                <input type="text" name="code" value="<?php echo $code; ?>"><br> 
                <label>Discount</label><br>
                <input type="text" name="discount" value="<?php echo $discount; ?>"><br> 
                <input type="submit" name="submit" value="Update" class="sb">
            </form>
        </section>
    </center>
   
</body>
</html>
