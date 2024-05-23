<?php 
include "databaseconnection.php";

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (!isset($_GET["address_id"])) {
        header("location: viewaddresses.php");
        exit;
    }

    $addressID = $_GET["address_id"];

    $sql = "SELECT * FROM Addresses WHERE address_id = ?";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("i", $addressID);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $userID = $row["user_id"];
        $address = $row["address"];
    } else {
        header("location: viewaddresses.php");
        exit;
    }
} elseif ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $addressID = $_POST["address_id"];
    $userID = $_POST["user_id"];
    $address = $_POST["address"];

    if (empty($addressID) || empty($userID) || empty($address)) {
        echo "All fields are required!";
    } else {
        $sql = "UPDATE Addresses SET user_id = ?, address = ? WHERE address_id = ?";
        $stmt = $connection->prepare($sql);
        $stmt->bind_param("isi", $userID, $address, $addressID);

        if ($stmt->execute() === TRUE) {
            echo "Information updated successfully";
            header("location: viewaddresses.php");
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
        <h3 style="color:green;">UPDATE ADDRESS HERE</h3>
        <section class="forms">
            <form method="POST" onsubmit="return confirmUpdate();">
                <label>Address ID</label><br>
                <input type="text" name="address_id" readonly value="<?php echo $addressID; ?>"><br>
                <label>User ID</label><br>
                <input type="text" name="user_id" value="<?php echo $userID; ?>"><br> 
                <label>Address</label><br>
                <textarea name="address"><?php echo $address; ?></textarea><br>
                <input type="submit" name="submit" value="Update" class="sb">
            </form>
        </section>
    </center>
    <footer>
        <p style="color:blue; text-align: center; margin-top:40px;">
            
        </p>
    </footer>
</body>
</html>
