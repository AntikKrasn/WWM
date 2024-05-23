<?php
ob_start(); 

require_once('db.php');
 
$familia = $_POST['familia'];
$name = $_POST['name'];
$number = $_POST['number'];
$login = $_POST['login'];
$pass= $_POST['pass'];
$email = $_POST['email'];

$sql = "INSERT INTO `registr` (familia, name, number, login, pass, email) VALUES ('$familia', '$name', '$number', '$login', '$pass', '$email')";

if ($conn->query($sql) === TRUE) {
    header("Location:..\Avtorization\avtorization.php");
    exit(); 
} else {
    echo "Ошибка: " . $conn->error;
}
ob_end_flush(); 
?>
