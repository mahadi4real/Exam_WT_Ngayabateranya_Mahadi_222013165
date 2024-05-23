<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>RECIPE INGREDIENT DELIVERY SERVICES</title>
    <!-- Using Bootstrap for better appearance -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<center>
    <div class="container">
        <h2 style="text-align: center; font-family: century; font-weight: bold; color: green;">RECIPE INGREDIENT DELIVERY SERVICES</h2>
        <h4 style="text-align: center; font-family: century; font-weight: bold; color:blue;">THIS TABLE SHOWS DELIVERY DETAILS</h4>
        <a href="delivery.html" class="btn btn-primary" style="margin-top: 0px;">FEEDBACK</a>
        <a href="home.html" class="btn btn-secondary" style="margin-left: 20px;">Back Home</a>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Delivery ID</th>
                    <th>Order ID</th>
                    <th>Status</th>
                    <th colspan="2">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                // Include the file containing database connection
                include "databaseconnection.php";
                $sql = "SELECT * FROM delivery";
                $result = $connection->query($sql);
                if (!$result) {
                    echo "Invalid query!!" . $connection->error;
                }
                while ($row = $result->fetch_assoc()) {
                    echo "
                    <tr>
                        <td>{$row['delivery_id']}</td>
                        <td>{$row['order_id']}</td> 
                        <td>{$row['status']}</td>
                        <td>
                            <a href='updatedelivery.php?delivery_id={$row['delivery_id']}' class='btn btn-primary btn-sm'>Update</a></td>
                            <td>
                            <a href='deletedelivery.php?delivery_id={$row['delivery_id']}' class='btn btn-danger btn-sm'>Delete</a>
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
