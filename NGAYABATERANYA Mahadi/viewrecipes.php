<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Recipes Management Platform</title>
    <!-- Here we use Bootstrap to make a good appearance of this table -->
    <link href="https://stackpath.bootstrapcdn.com/http://localhost/NGAYABATERANYA%20mahadi/ingredients.htmlbootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<center>
    <div class="container">
        <h2 style="text-align: center; font-family: century; font-weight: bold; color: green;">Recipes Management Platform</h2>
        <h4 style="text-align: center; font-family: century; font-weight: bold; color: blue;">THIS TABLE SHOWS RECIPES IN THIS SYSTEM </h4>
        <a href="recipes.html" class="btn btn-primary" style="margin-top: 0px;">Add Recipe</a>
        <a href="home.html" class="btn btn-secondary" style="margin-left: 20px;">Back Home</a>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Recipe ID</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th colspan="2">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                // Call the file that contains database connection
                include "databaseconnection.php";
                $sql = "SELECT * FROM recipes";
                $result = $connection->query($sql);
                if (!$result) {
                    echo "Invalid query!!" . $connection->error;
                }
                while ($row = $result->fetch_assoc()) {
                    echo "
                    <tr>
                        <td>{$row['recipe_id']}</td>
                        <td>{$row['title']}</td> 
                        <td>{$row['description']}</td>
                        <td>
                            <a href='updaterecipes.php?recipe_id={$row['recipe_id']}' class='btn btn-primary btn-sm'>Update</a>
                        </td>
                        <td>
                            <a href='deleterecipes.php?recipe_id={$row['recipe_id']}' class='btn btn-danger btn-sm'>Delete</a>
                        </td>
                    </tr>
                    ";
                }
                ?>
            </tbody>
        </table>
    </div>
    </center>
</body>
</html>
