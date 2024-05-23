<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>RECIPE INGREDIENT DELIVERY SERVICES</title>
    <!-- here we use bootstrap inorder to make good appearance of this table-->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<center>
    <div class="container">
        <h2 style="text-align: center; font-family: century; font-weight: bold; color: green;">RECIPE INGREDIENT DELIVERY SERVICES</h2>
        <h4 style="text-align: center; font-family: century; font-weight: bold; color:blue;">THIS TABLE SHOWS PAYMENT METHODS IN THIS PLATFORM </h4>
        <a href="payment_methods.html" class="btn btn-primary" style="margin-top: 0px;">payment methods</a>
        <a href="home.html" class="btn btn-secondary" style="margin-left: 20px;">Back Home</a>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Payment ID</th>
                    <th>Method Name</th>
                    <th>Details</th>
                    <th colspan="2">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                // Call the file that contains database connection
                include "databaseconnection.php";
                $sql = "SELECT * FROM Payment_Methods";
                $result = $connection->query($sql);
                if (!$result) {
                    echo "Invalid query!!" . $connection->error;
                }
                while ($row = $result->fetch_assoc()) {
                    echo "
                    <tr>
                        <td>{$row['payment_id']}</td>
                        <td>{$row['method_name']}</td> 
                        <td>{$row['details']}</td>
                        <td>
                            <a href='updatepayment_methods.php?PaymentID={$row['payment_id']}' class='btn btn-primary btn-sm'>Update</a></td>
                            <td>
                            <a href='deletepayment_methods.php?PaymentID={$row['payment_id']}' class='btn btn-danger btn-sm'>Delete</a>
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
