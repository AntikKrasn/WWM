<?php
require_once('db.php');
error_reporting(0);
session_start(); // начинаем сессию

// Проверяем, был ли отправлен идентификатор задачи
if(isset($_POST['id_note']) && !empty($_POST['id_note'])) {
    // Проверяем, авторизован ли пользователь
    if(isset($_SESSION['login'])) {
        // Получаем логин пользователя из сессии
        $login = $_SESSION['login'];

        // Получаем идентификатор задачи из POST-запроса
        $noteId = $_POST['id_note'];

        // Подготовленный запрос для удаления задачи из таблицы 
        $sql_delete_notes = "DELETE FROM `notes` WHERE id_note = ? AND login = ?";
        $stmt_delete_notes = $conn->prepare($sql_delete_notes);
        $stmt_delete_notes->bind_param("is", $noteId, $login);

        // Выполнение подготовленного запроса
        if ($stmt_delete_notes->execute()) {
            echo true;
        } else {
            echo "Ошибка при удалении задачи: " . $stmt_delete_notes->error;
        }

        // Закрытие подготовленного запроса
        $stmt_delete_notes->close();
    } else {
        // Если пользователь не авторизован, выводим сообщение об ошибке
        echo "Ошибка: Пользователь не авторизован";
    }
} else {
    // Если идентификатор задачи не был отправлен, выводим сообщение об ошибке
    echo "Ошибка: Идентификатор задачи не был отправлен";
}
?>