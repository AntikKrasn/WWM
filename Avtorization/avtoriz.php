<?php
error_reporting(0);
session_start();
ob_start(); 
require_once('db.php');

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['login'], $_POST['pass'])) {
    $login = $_POST['login'];
    $pass = $_POST['pass'];

    $sql = "SELECT * FROM `registr` WHERE login = '$login' AND pass = '$pass'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $login = $row['login'];
        $name = $row['name'];
        $number = $row['number'];
        $email = $row['email'];

        $_SESSION['login'] = $login;
        $_SESSION['name'] = $name;
        $_SESSION['number'] = $number;
        $_SESSION['email'] = $email;
        
        header("Location:../User/profile.php");
        exit();
    } else {
        echo "<script>alert('Учетная запись не найдена. Пожалуйста, попробуйте ввести данные заново.')</script>";
        echo "<script>window.location = 'avtorization.php';</script>";
    }
}
?>
