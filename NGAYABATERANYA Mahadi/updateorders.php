<?php 
include "databaseconnection.php";

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (!isset($_GET["order_id"])) {
        header("Location: vieworders.php");
        exit;
    }

    $orderID = $_GET["order_id"];

    $sql = "SELECT * FROM Orders WHERE order_id = ?";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("i", $orderID);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $userID = $row["user_id"];
        $totalAmount = $row["total_amount"];
    } else {
        header("Location: vieworders.php");
        exit;
    }
} elseif ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $orderID = $_POST["orderID"];
    $userID = $_POST["userID"];
    $totalAmount = $_POST["totalAmount"];

    if (empty($orderID) || empty($userID) || empty($totalAmount)) {
        echo "All fields are required!";
    } else {
        $sql = "UPDATE Orders SET user_id = ?, total_amount = ? WHERE order_id = ?";
        $stmt = $connection->prepare($sql);
        $stmt->bind_param("idi", $userID, $totalAmount, $orderID);

        if ($stmt->execute()) {
            echo "Information updated successfully";
            header("Location: vieworders.php");
            exit;
        } else {
            echo "Error updating record: " . $stmt->error;
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Orders</title>
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
        <h2>Orders</h2>
        <h3 style="color: green;">UPDATE ORDER HERE</h3>
        <section class="forms">
            <form method="POST" onsubmit="return confirmUpdate();">
                <label>Order ID</label><br>
                <input type="text" name="orderID" readonly value="<?php echo $orderID; ?>"><br>
                <label>User ID</label><br>
                <input type="text" name="userID" value="<?php echo $userID; ?>"><br> 
                <label>Total Amount</label><br>
                <input type="text" name="totalAmount" value="<?php echo $totalAmount; ?>"><br> 
                <input type="submit" name="submit" value="Update" class="sb">
            </form>
        </section>
    </center>
   
</body>
</html>
