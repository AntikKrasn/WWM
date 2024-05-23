<?php
require_once('db.php');
error_reporting(0);
session_start(); 
ob_start(); 

if(isset($_POST['event']) && isset($_POST['date']) && !empty($_POST['event']) && !empty($_POST['date'])) {
    if(isset($_SESSION['login'])) {
        $login = $_SESSION['login'];

        $event = $_POST['event'];
        $date = $_POST['date']; 

        $sql_insert_event = "INSERT INTO `calendar` (event, date, login) VALUES (?, ?, ?)";
        $stmt_insert_event = $conn->prepare($sql_insert_event);
        $stmt_insert_event->bind_param("sss", $event, $date, $login);

        if ($stmt_insert_event->execute()) {
            echo true;
        } else {
            echo "Ошибка при добавлении задачи: " . $conn->error;
        }

        $stmt_insert_event->close();
    } else {
        echo "Ошибка: Пользователь не авторизован";
    }
} else {
    echo "Ошибка: Задача не была отправлена";
}
?>
