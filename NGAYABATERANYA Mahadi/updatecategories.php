<?php 
include "databaseconnection.php";
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (!isset($_GET["category_id"])) {
        header("location: viewcategories.php");
        exit;
    }

    $CategoryID = $_GET["CategoryID"];

    $sql = "SELECT * FROM Categories WHERE category_id = ?";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("i", $CategoryID);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $Name = $row["name"];
        $Description = $row["description"];
    } else {
        header("location:viewcategories.php");
        exit;
    }
} elseif ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $categoryID = $_POST["category_id"];
    $name = $_POST["name"];
    $description = $_POST["description"];

    if (empty($category_id) || empty($Name) || empty($Description)) {
        echo "All fields are required!";
    } else {
        $sql = "UPDATE categories SET name=?, description=? WHERE category_id=?";
        $stmt = $connection->prepare($sql);
        $stmt->bind_param("ssi", $name, $description, $category_id);
        
        if ($stmt->execute()) {
            echo "Information updated successfully";
            header("location:viewcategories.php");
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
    <script >
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
        <h3 style="color:green;">UPDATE CATEGORIES HERE</h3>
        <section class="forms">
            <form method="POST" onsubmit="return confirmUpdate();">
                <label>category_id</label><br>
                <input type="text" name="category_id" readonly  value="<?php echo $category_id; ?>"><br>
                <label>Name</label><br>
                <input type="text" name="Name"  value="<?php echo $Name; ?>"><br> 
                <label>Description</label><br>
                <input type="text" name="Description" value="<?php echo $Description; ?>" ><br> 
                <input type="submit" name="submit" value="Update" class="sb">
            </form>
        </section>
    </center>
    
</body>
</html>
