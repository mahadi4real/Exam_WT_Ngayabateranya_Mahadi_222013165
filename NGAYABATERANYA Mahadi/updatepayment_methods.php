<?php 
include "databaseconnection.php";

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (!isset($_GET["payment_id"])) {
        header("Location: viewpayment_methods.php");
        exit;
    }

    $paymentID = $_GET["payment_id"];

    // Prepared statement to prevent SQL injection
    $sql = "SELECT * FROM Payment_Methods WHERE payment_id = ?";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("i", $paymentID);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $methodName = $row["method_name"];
        $details = $row["details"];
    } else {
        header("Location: viewpayment_methods.php");
        exit;
    }
} elseif ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $paymentID = $_POST["payment_id"];
    $methodName = $_POST["method_name"];
    $details = $_POST["details"];

    if (empty($paymentID) || empty($methodName) || empty($details)) {
        echo "All fields are required!";
    } else {
        // Prepared statement to prevent SQL injection
        $sql = "UPDATE Payment_Methods SET method_name = ?, details = ? WHERE payment_id = ?";
        $stmt = $connection->prepare($sql);
        $stmt->bind_param("ssi", $methodName, $details, $paymentID);

        if ($stmt->execute() === TRUE) {
            echo "Information updated successfully";
            header("Location: viewpayment_methods.php");
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
        <h2>RECIPE INGREDIENT DELIVERY SERVICES</h2>
        <h3 style="color:green;">UPDATE PAYMENT METHOD HERE</h3>
        <section class="forms">
            <form method="POST" onsubmit="return confirmUpdate();">
                <label>Payment ID</label><br>
                <input type="text" name="payment_id" readonly value="<?php echo $paymentID; ?>"><br>
                <label>Method Name</label><br>
                <input type="text" name="method_name" value="<?php echo $methodName; ?>"><br> 
                <label>Details</label><br>
                <input type="text" name="details" value="<?php echo $details; ?>"><br> 
                <input type="submit" name="submit" value="Update" class="sb">
            </form>
        </section>
    </center>
    
</body>
</html>
