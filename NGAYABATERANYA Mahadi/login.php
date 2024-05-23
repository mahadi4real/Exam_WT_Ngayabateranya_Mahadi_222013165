<?php
session_start();
include "databaseconnection.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];
    

    $stmt = $connection->prepare("SELECT * FROM user WHERE email = ? AND password = ?");
    $stmt->bind_param("ss", $email, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $user_id = $row['id'];
        
        $_SESSION['user_id'] = $user_id;
        $_SESSION['email'] = $email;
        
        header("Location: home.html"); 
        exit();
    } else {
        echo "Invalid Email or Password";
        exit();
    }
    
    $stmt->close();
}

$connection->close();
?>

