<?php
error_reporting(0);
session_start(); // начинаем сессию
ob_start(); // начинаем буферизацию вывода

// Проверяем, установлены ли данные пользователя в сессии
if(isset($_SESSION['login'], $_SESSION['name'], $_SESSION['number'], $_SESSION['email'])) {
    // Если данные пользователя есть в сессии, присваиваем их переменным
    $login = $_SESSION['login'];
    $name = $_SESSION['name'];
    $number = $_SESSION['number'];
    $email = $_SESSION['email'];
    echo "<script>window.location.replace('../User/profile.php');</script>";
    exit; // Выход из скрипта, чтобы предотвратить вывод HTML-кода ниже
} else {
    echo "<script>window.location.replace('Avtorization/avtorization.php');</script>";
    exit; // Выход из скрипта
}
?>