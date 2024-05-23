<?php
ob_start(); // начинаем буферизацию вывода

require_once('db.php');
 
$familia = $_POST['familia'];
$name = $_POST['name'];
$number = $_POST['number'];
$login = $_POST['login'];
$pass= $_POST['pass'];
$email = $_POST['email'];

$sql = "INSERT INTO `registr` (familia, name, number, login, pass, email) VALUES ('$familia', '$name', '$number', '$login', '$pass', '$email')";

// Выполняем запрос к базе данных
if ($conn->query($sql) === TRUE) {
    // Если запрос выполнен успешно, выполняем перенаправление
    header("Location:..\Avtorization\avtorization.php");
    exit(); // Важно вызвать exit() после перенаправления, чтобы прекратить дальнейшее выполнение скрипта
} else {
    // Если запрос не выполнен успешно, можно выполнить другие действия или вывести сообщение об ошибке
    echo "Ошибка: " . $conn->error;
}

ob_end_flush(); // отправляем буферизированный вывод на экран
?>