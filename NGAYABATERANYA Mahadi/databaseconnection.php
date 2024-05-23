<?php  
$servername="localhost";
$username="root";
$password="";
$databasename="recipe_ingredient_delivery";
$connection=new mysqli($servername,$username,$password,$databasename);
if ($connection->connect_error) {
    die("connection failed.".$connection->connect_error);
}
?>