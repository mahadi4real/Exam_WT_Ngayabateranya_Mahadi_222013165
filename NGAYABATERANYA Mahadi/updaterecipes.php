<?php 
include "databaseconnection.php";

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (!isset($_GET["recipe_id"])) {
        header("location: viewrecipes.php");
        exit;
    }

    $recipe_id = $_GET["recipe_id"];

    $sql = "SELECT * FROM recipes WHERE recipe_id = $recipe_id";
    $result = $connection->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $title = $row["title"];
        $description = $row["description"];
    } else {
        header("location:viewrecipes.php");
        exit;
    }
} elseif ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $recipe_id = $_POST["recipe_id"];
    $title = $_POST["title"];
    $description = $_POST["description"];

    if (empty($recipe_id) || empty($title) || empty($description)) {
        echo "All fields are required!";
    } else {
        $sql = "UPDATE recipes SET title='$title', description='$description' WHERE recipe_id='$recipe_id'";
    
        if ($connection->query($sql) === TRUE) {
            echo "Information updated successfully";
            header("location:viewrecipes.php");
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
    <title>Recipes Management Platform</title>
    <script>
        function confirmUpdate(){
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
        <h2>Recipes Management Platform</h2>
        <h3 style="color:green;">Update Recipe Here</h3>
        <section class="forms">
            <form method="POST" onsubmit="return confirmUpdate();">
                <label>Recipe ID</label><br>
                <input type="text" name="recipe_id" readonly value="<?php echo $recipe_id; ?>"><br>
                <label>Title</label><br>
                <input type="text" name="title" value="<?php echo $title; ?>"><br> 
                <label>Description</label><br>
                <textarea name="description" class="input"><?php echo $description; ?></textarea><br>  
                <input type="submit" name="submit" value="Update" class="sb">
            </form>
        </section>
    </center>
   
</body>
</html>
