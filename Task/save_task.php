<?php
require_once('db.php');
error_reporting(0);
session_start(); // начинаем сессию
ob_start(); // Начинаем буферизацию вывода

// Проверяем, была ли отправлена задача через AJAX
if(isset($_POST['task']) && !empty($_POST['task'])) {
    // Проверяем, авторизован ли пользователь
    if(isset($_SESSION['login'])) {
        // Получаем логин пользователя из сессии
        $login = $_SESSION['login'];

        // Получаем задачу из POST-запроса
        $task = $_POST['task'];

        // Подготовленный запрос для добавления задачи в таблицу `task`
        $sql_insert_task = "INSERT INTO `task` (task, login) VALUES (?, ?)";
        $stmt_insert_task = $conn->prepare($sql_insert_task);
        $stmt_insert_task->bind_param("ss", $task, $login);

        // Выполнение подготовленного запроса
        if ($stmt_insert_task->execute()) {
            echo true;
        } else {
            echo "Ошибка при добавлении задачи: " . $conn->error;
        }

        // Закрытие подготовленного запроса
        $stmt_insert_task->close();
    } else {
        // Если пользователь не авторизован, выводим сообщение об ошибке
        echo "Ошибка: Пользователь не авторизован";
    }
} else {
    // Если задача не была отправлена или пустая, выводим сообщение об ошибке
    echo "Ошибка: Задача не была отправлена";
}
?>