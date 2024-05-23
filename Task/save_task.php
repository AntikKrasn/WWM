<?php
require_once('db.php');
error_reporting(0);
session_start(); 
ob_start(); 

if(isset($_POST['task']) && !empty($_POST['task'])) {
    if(isset($_SESSION['login'])) {
        $login = $_SESSION['login'];
        $task = $_POST['task'];
        $sql_insert_task = "INSERT INTO `task` (task, login) VALUES (?, ?)";
        $stmt_insert_task = $conn->prepare($sql_insert_task);
        $stmt_insert_task->bind_param("ss", $task, $login);

        if ($stmt_insert_task->execute()) {
            echo true;
        } else {
            echo "Ошибка при добавлении задачи: " . $conn->error;
        }

        $stmt_insert_task->close();
    } else {
        echo "Ошибка: Пользователь не авторизован";
    }
} else {
    echo "Ошибка: Задача не была отправлена";
}
?>
