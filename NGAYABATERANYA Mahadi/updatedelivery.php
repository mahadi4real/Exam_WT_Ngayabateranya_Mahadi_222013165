<?php 
include "databaseconnection.php";

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (!isset($_GET["delivery_id"])) {
        header("Location: viewdelivery.php");
        exit;
    }

    $DeliveryID = $_GET["delivery_id"];

    // Prepared statement to prevent SQL injection
    $sql = "SELECT * FROM Delivery WHERE delivery_id = ?";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("i", $DeliveryID);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $OrderID = $row["order_id"];
        $Status = $row["status"];
    } else {
        header("Location: viewdelivery.php");
        exit;
    }
} elseif ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $DeliveryID = $_POST["DeliveryID"];
    $OrderID = $_POST["OrderID"];
    $Status = $_POST["Status"];

    if (empty($DeliveryID) || empty($OrderID) || empty($Status)) {
        echo "All fields are required!";
    } else {
        // Prepared statement to prevent SQL injection
        $sql = "UPDATE Delivery SET order_id = ?, status = ? WHERE delivery_id = ?";
        $stmt = $connection->prepare($sql);
        $stmt->bind_param("isi", $OrderID, $Status, $DeliveryID);

        if ($stmt->execute() === TRUE) {
            echo "Information updated successfully";
            header("Location: viewdelivery.php");
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
    <title>Delivery</title>
    <script>
        function confirmUpdate() {
            return confirm('Do you want to update this record?');
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
        <h2>Delivery</h2>
        <h3 style="color: green;">UPDATE DELIVERY STATUS HERE</h3>
        <section class="forms">
            <form method="POST" onsubmit="return confirmUpdate();">
                <label>Delivery ID</label><br>
                <input type="text" name="DeliveryID" readonly value="<?php echo $DeliveryID; ?>"><br>
                <label>Order ID</label><br>
                <input type="text" name="OrderID" value="<?php echo $OrderID; ?>"><br>
                <label>Status</label><br>
                <input type="text" name="Status" value="<?php echo $Status; ?>"><br>
                <input type="submit" name="submit" value="Update" class="sb">
            </form>
        </section>
    </center>
   
</body>
</html>
