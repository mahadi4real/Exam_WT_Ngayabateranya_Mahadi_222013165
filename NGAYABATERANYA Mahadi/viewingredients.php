<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>RECIPE INGREDIENT DELIVERY SERVICES</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<center>
    <div class="container">
        <h2 style="text-align: center; font-family: century; font-weight: bold; color: green;">RECIPE INGREDIENT DELIVERY SERVICES</h2>
        <h4 style="text-align: center; font-family: century; font-weight: bold; color: blue;">THIS TABLE SHOWS INGREDIENTS IN THIS SYSTEM </h4>
        <a href="ingredients.html" class="btn btn-primary" style="margin-top: 0px;">Ingredients</a>
        <a href="home.html" class="btn btn-secondary" style="margin-left: 20px;">Back Home</a>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Ingredient ID</th>
                    <th>Name</th>
                    <th>Quantity</th>
                    <th colspan="2">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                // Include database connection file
                include "databaseconnection.php";
                $sql = "SELECT * FROM ingredients";
                $result = $connection->query($sql);
                if (!$result) {
                    echo "Invalid query!!" . $connection->error;
                }
                while ($row = $result->fetch_assoc()) {
                    echo "
                    <tr>
                        <td>{$row['ingredient_id']}</td>
                        <td>{$row['name']}</td> 
                        <td>{$row['quantity']}</td>
                        <td>
                            <a href='updateingredients.php?ingredient_id={$row['ingredient_id']}' class='btn btn-primary btn-sm'>Update</a>
                        </td>
                        <td>
                            <a href='deleteingredients.php?ingredient_id={$row['ingredient_id']}' class='btn btn-danger btn-sm'>Delete</a>
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
