<?php
error_reporting(0);
ob_start(); // начинаем буферизацию вывода
session_start();
require_once('db.php');

// Проверяем, авторизован ли пользователь
if (!isset($_SESSION['login'])) {
    // Если пользователь не авторизован, перенаправляем его на страницу авторизации
    header("Location: ../Avtorization/avtorization.php");
    exit();
}

// Получаем идентификатор пользователя из сессии
$login = $_SESSION['login'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $number = $_POST['number'];
    $email = $_POST['email'];

    // Готовим запрос к базе данных для обновления данных
    $sql = "UPDATE `registr` SET number='$number', email='$email' WHERE login='$login'";

    if ($conn->query($sql) === TRUE) {
        // Если запрос выполнен успешно, обновляем данные в сессии
        $_SESSION['number'] = $number;
        $_SESSION['email'] = $email;
        // Если запрос выполнен успешно, перенаправляем пользователя на страницу профиля с передачей данных
        echo "<script>window.location.replace('profile.php?name=$name&login=$login&number=$number&email=$email');</script>";
        exit();
    } else {
        echo "Ошибка при обновлении данных: " . $conn->error;
    }
}
ob_end_flush();
?>
