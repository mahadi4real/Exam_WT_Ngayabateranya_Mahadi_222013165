<?php 
include "databaseconnection.php";

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (!isset($_GET["review_id"])) {
        header("Location: viewreviews.php");
        exit;
    }

    $reviewID = $_GET["review_id"];

    // Prepared statement to prevent SQL injection
    $sql = "SELECT * FROM Reviews WHERE review_id = ?";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("i", $reviewID);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $userID = $row["user_id"];
        $content = $row["content"];
    } else {
        header("Location: viewreviews.php");
        exit;
    }
} elseif ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $reviewID = $_POST["review_id"];
    $userID = $_POST["user_id"];
    $content = $_POST["content"];

    if (empty($reviewID) || empty($userID) || empty($content)) {
        echo "All fields are required!";
    } else {
        // Prepared statement to prevent SQL injection
        $sql = "UPDATE Reviews SET user_id = ?, content = ? WHERE review_id = ?";
        $stmt = $connection->prepare($sql);
        $stmt->bind_param("isi", $userID, $content, $reviewID);

        if ($stmt->execute() === TRUE) {
            echo "Information updated successfully";
            header("Location: viewreviews.php");
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
        <h3 style="color:green;">UPDATE REVIEW HERE</h3>
        <section class="forms">
            <form method="POST" onsubmit="return confirmUpdate();">
                <label>Review ID</label><br>
                <input type="text" name="review_id" readonly value="<?php echo $reviewID; ?>"><br>
                <label>User ID</label><br>
                <input type="text" name="user_id" value="<?php echo $userID; ?>"><br> 
                <label>Content</label><br>
                <input type="text" name="content" value="<?php echo $content; ?>"><br> 
                <input type="submit" name="submit" value="Update" class="sb">
            </form>
        </section>
    </center>
    
</body>
</html>
