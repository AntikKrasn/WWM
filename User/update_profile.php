<?php
error_reporting(0);
ob_start(); 
session_start();
require_once('db.php');

if (!isset($_SESSION['login'])) {
    header("Location: ../Avtorization/avtorization.php");
    exit();
}

$login = $_SESSION['login'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $number = $_POST['number'];
    $email = $_POST['email'];

    $sql = "UPDATE `registr` SET number='$number', email='$email' WHERE login='$login'";

    if ($conn->query($sql) === TRUE) {
        $_SESSION['number'] = $number;
        $_SESSION['email'] = $email;
        echo "<script>window.location.replace('profile.php?name=$name&login=$login&number=$number&email=$email');</script>";
        exit();
    } else {
        echo "Ошибка при обновлении данных: " . $conn->error;
    }
}
ob_end_flush();
?>
