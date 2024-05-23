<?php 
include "databaseconnection.php";

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (!isset($_GET["ingredient_id"])) {
        header("Location: viewingredients.php");
        exit;
    }

    $ingredient_id = $_GET["ingredient_id"];

    // Prepared statement to prevent SQL injection
    $sql = "SELECT * FROM ingredients WHERE ingredient_id = ?";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("i", $ingredient_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $name = $row["name"];
        $quantity = $row["quantity"];
    } else {
        header("Location: viewingredients.php");
        exit;
    }
} elseif ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $ingredient_id = $_POST["ingredient_id"];
    $name = $_POST["name"];
    $quantity = $_POST["quantity"];

    if (empty($ingredient_id) || empty($name) || empty($quantity)) {
        echo "All fields are required!";
    } else {
        // Prepared statement to prevent SQL injection
        $sql = "UPDATE ingredients SET name = ?, quantity = ? WHERE ingredient_id = ?";
        $stmt = $connection->prepare($sql);
        $stmt->bind_param("sdi", $name, $quantity, $ingredient_id);

        if ($stmt->execute() === TRUE) {
            echo "Information updated successfully";
            header("Location: viewingredients.php");
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
        <h3 style="color:green;">UPDATE INGREDIENT HERE</h3>
        <section class="forms">
            <form method="POST">
                <label>Ingredient ID</label><br>
                <input type="text" name="ingredient_id" readonly value="<?php echo $ingredient_id; ?>"><br>
                <label>Name</label><br>
                <input type="text" name="name" value="<?php echo $name; ?>"><br>
                <label>Quantity</label><br>
                <input type="text" name="quantity" value="<?php echo $quantity; ?>"><br>
                <input type="submit" name="submit" value="Update" class="sb">
            </form>
        </section>
    </center>
</body>
</html>
