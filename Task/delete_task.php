<?php
require_once('db.php');
error_reporting(0);
session_start(); // начинаем сессию

// Проверяем, был ли отправлен идентификатор задачи
if(isset($_POST['id_task']) && !empty($_POST['id_task'])) {
    // Проверяем, авторизован ли пользователь
    if(isset($_SESSION['login'])) {
        // Получаем логин пользователя из сессии
        $login = $_SESSION['login'];

        // Получаем идентификатор задачи из POST-запроса
        $taskId = $_POST['id_task'];

        // Подготовленный запрос для удаления задачи из таблицы `task`
        $sql_delete_task = "DELETE FROM `task` WHERE id_task = ? AND login = ?";
        $stmt_delete_task = $conn->prepare($sql_delete_task);
        $stmt_delete_task->bind_param("is", $taskId, $login);

        // Выполнение подготовленного запроса
        if ($stmt_delete_task->execute()) {
            echo true;
        } else {
            echo "Ошибка при удалении задачи: " . $conn->error;
        }

        // Закрытие подготовленного запроса
        $stmt_delete_task->close();
    } else {
        // Если пользователь не авторизован, выводим сообщение об ошибке
        echo "Ошибка: Пользователь не авторизован";
    }
} else {
    // Если идентификатор задачи не был отправлен, выводим сообщение об ошибке
    echo "Ошибка: Идентификатор задачи не был отправлен";
}
?>