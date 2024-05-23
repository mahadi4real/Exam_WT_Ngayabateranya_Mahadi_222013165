<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>RECIPE INGREDIENT DELIVERY SERVICES</title>
    <!-- Bootstrap for styling the table -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<center>
    <div class="container">
        <h2 style="text-align: center; font-family: century; font-weight: bold; color: green;">
            RECIPE INGREDIENT DELIVERY SERVICES
        </h2>
        <h4 style="text-align: center; font-family: century; font-weight: bold; color:blue;">
            THIS TABLE SHOWS ADDRESSES IN THIS PLATFORM
        </h4>
        <a href="addresses.html" class="btn btn-primary" style="margin-top: 0px;">Addresses</a>
        <a href="home.html" class="btn btn-secondary" style="margin-left: 20px;">Back Home</a>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Address ID</th>
                    <th>User ID</th>
                    <th>Address</th>
                    <th colspan="2">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                // Include the database connection file
                include "databaseconnection.php";
                $sql = "SELECT * FROM Addresses";
                $result = $connection->query($sql);
                if (!$result) {
                    echo "Invalid query: " . $connection->error;
                }
                while ($row = $result->fetch_assoc()) {
                    echo "
                    <tr>
                        <td>{$row['address_id']}</td>
                        <td>{$row['user_id']}</td> 
                        <td>{$row['address']}</td>
                        <td>
                            <a href='updateaddresses.php?address_id={$row['address_id']}' class='btn btn-primary btn-sm'>Update</a></td>
                            <td>
                            <a href='deleteaddresses.php?address_id={$row['address_id']}' class='btn btn-danger btn-sm'>Delete</a>
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
