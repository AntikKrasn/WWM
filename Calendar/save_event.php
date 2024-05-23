<?php
require_once('db.php');
error_reporting(0);
session_start(); // начинаем сессию
ob_start(); // Начинаем буферизацию вывода

// Проверяем, была ли отправлена задача через AJAX
if(isset($_POST['event']) && isset($_POST['date']) && !empty($_POST['event']) && !empty($_POST['date'])) {
    // Проверяем, авторизован ли пользователь
    if(isset($_SESSION['login'])) {
        // Получаем логин пользователя из сессии
        $login = $_SESSION['login'];

        // Получаем задачу из POST-запроса
        $event = $_POST['event'];
        $date = $_POST['date']; 

        // Подготовленный запрос для добавления задачи в таблицу `event`
        $sql_insert_event = "INSERT INTO `calendar` (event, date, login) VALUES (?, ?, ?)";
        $stmt_insert_event = $conn->prepare($sql_insert_event);
        $stmt_insert_event->bind_param("sss", $event, $date, $login);

        // Выполнение подготовленного запроса
        if ($stmt_insert_event->execute()) {
            echo true;
        } else {
            echo "Ошибка при добавлении задачи: " . $conn->error;
        }

        // Закрытие подготовленного запроса
        $stmt_insert_event->close();
    } else {
        // Если пользователь не авторизован, выводим сообщение об ошибке
        echo "Ошибка: Пользователь не авторизован";
    }
} else {
    // Если задача не бы бы была отправлена или пустая, выводим сообщение об ошибке
    echo "Ошибка: Задача не была отправлена";
}
?>