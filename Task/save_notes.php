<?php
require_once('db.php');
error_reporting(0);
session_start(); // начинаем сессию
ob_start(); // Начинаем буферизацию вывода

// Проверяем, была ли отправлена задача через AJAX
if(isset($_POST['noteText']) && !empty($_POST['noteText'])) {
    // Проверяем, авторизован ли пользователь
    if(isset($_SESSION['login'])) {
        // Получаем логин пользователя из сессии
        $login = $_SESSION['login'];

        // Получаем задачу из POST-запроса
        $notes = $_POST['noteText'];

        // Удаляем отступы с помощью trim()
        $notes = trim($notes);
        
        // Подготовленный запрос для добавления задачи в таблицу `notes`
        $sql_insert_notes = "INSERT INTO `notes` (note, login) VALUES (?, ?)";
        $stmt_insert_notes = $conn->prepare($sql_insert_notes);
        $stmt_insert_notes->bind_param("ss", $notes, $login);

        // Выполнение подготовленного запроса
        if ($stmt_insert_notes->execute()) {
            echo true;
        } else {
            echo "Ошибка при добавлении задачи: " . $stmt_insert_notes->error;
        }

        // Закрытие подготовленного запроса
        $stmt_insert_notes->close();
    } else {
        // Если пользователь не авторизован, выводим сообщение об ошибрке
        echo "Ошибка: Пользователь не авторизован";
    }
} else {
    // Если задача не была отправлена или пустая, выводим сообщение об ошибке
    echo "Ошибка: Задача не была отправлена";
}
?>