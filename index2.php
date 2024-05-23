<?php
error_reporting(0);
session_start(); 
ob_start(); 

if(isset($_SESSION['login'], $_SESSION['name'], $_SESSION['number'], $_SESSION['email'])) {
    $login = $_SESSION['login'];
    $name = $_SESSION['name'];
    $number = $_SESSION['number'];
    $email = $_SESSION['email'];
    echo "<script>window.location.replace('../User/profile.php');</script>";
    exit; 
} else {
    echo "<script>window.location.replace('Avtorization/avtorization.php');</script>";
    exit; 
}
?>
