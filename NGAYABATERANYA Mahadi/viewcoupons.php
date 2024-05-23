<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>RECIPE INGREDIENT DELIVERY SERVICES</title>
    <!-- here we use bootstrap in order to make a good appearance of this table-->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<center>
    <div class="container">
        <h2 style="text-align: center; font-family: century; font-weight: bold; color: green;">RECIPE INGREDIENT DELIVERY SERVICES</h2>
        <h4 style="text-align: center; font-family: century; font-weight: bold; color:blue;">THIS TABLE SHOWS COUPONS IN THIS SYSTEM</h4>
        <a href="coupons.html" class="btn btn-primary" style="margin-top: 0px;">COUPONS</a>
        <a href="home.html" class="btn btn-secondary" style="margin-left: 20px;">Back Home</a>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Coupon ID</th>
                    <th>Code</th>
                    <th>Discount</th>
                    <th colspan="2">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                // Call the file that contains database connection
                include "databaseconnection.php";
                $sql = "SELECT * FROM Coupons";
                $result = $connection->query($sql);
                if (!$result) {
                    echo "Invalid query!!" . $connection->error;
                }
                while ($row = $result->fetch_assoc()) {
                    echo "
                    <tr>
                        <td>{$row['coupon_id']}</td>
                        <td>{$row['code']}</td> 
                        <td>{$row['discount']}</td>
                        <td>
                            <a href='updatecoupons.php?coupon_id={$row['coupon_id']}' class='btn btn-primary btn-sm'>Update</a></td>
                            <td>
                            <a href='deletecoupons.php?coupon_id={$row['coupon_id']}' class='btn btn-danger btn-sm'>Delete</a>
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
