<?php
include "databaseconnection.php";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$user_id= $_POST['user_id'];
	$name=$_POST['name'];
	$email=$_POST['email'];
	$password=$_POST['password'];
	$sql="INSERT INTO user (user_id,name,email,password) VALUES('$user_id','$name','$email','$password')";
		$result=$connection->query($sql);
	if ($result) {
		echo"Inserted Successfully";
		header('location:login.html');
		exit();
	}else{
		echo "Inserted fail";
	}

}

?>

