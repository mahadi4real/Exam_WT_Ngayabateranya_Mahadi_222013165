<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Orders</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<center>
    <div class="container">
        <h2 style="text-align: center; font-family: century; font-weight: bold; color: green;">Orders</h2>
        <h4 style="text-align: center; font-family: century; font-weight: bold; color: blue;">THIS TABLE SHOWS ORDERS IN THIS SYSTEM </h4>
        <a href="orders.html" class="btn btn-primary" style="margin-top: 0px;">Orders</a>
        <a href="home.html" class="btn btn-secondary" style="margin-left: 20px;">Back Home</a>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>User ID</th>
                    <th>Total Amount</th>
                    <th colspan="2">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                // Call the file that contains database connection
                include "databaseconnection.php";
                $sql = "SELECT * FROM Orders";
                $result = $connection->query($sql);
                if (!$result) {
                    echo "Invalid query!!" . $connection->error;
                }
                while ($row = $result->fetch_assoc()) {
                    echo "
                    <tr>
                        <td>{$row['order_id']}</td>
                        <td>{$row['user_id']}</td> 
                        <td>{$row['total_amount']}</td>
                        <td>
                            <a href='updateorders.php?order_id={$row['order_id']}' class='btn btn-primary btn-sm'>Update</a>
                        </td>
                        <td>
                            <a href='deleteorders.php?order_id={$row['order_id']}' class='btn btn-danger btn-sm'>Delete</a>
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
