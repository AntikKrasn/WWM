<?php
require_once('db.php');
error_reporting(0);
session_start(); // начинаем сессию

// Проверяем, был ли отправлен идентификатор задачи
if(isset($_POST['id_calendar']) && !empty($_POST['id_calendar'])) {
    // Проверяем, авторизован ли пользователь
    if(isset($_SESSION['login'])) {
        // Получаем логин пользователя из сессии
        $login = $_SESSION['login'];

        // Получаем идентификатор задачи из POST-запроса
        $eventId = $_POST['id_calendar'];

        // Подготовленный запрос для удаления задачи из таблицы `event`
        $sql_delete_event = "DELETE FROM `calendar` WHERE id_calendar = ? AND login = ?";
        $stmt_delete_event = $conn->prepare($sql_delete_event);
        $stmt_delete_event->bind_param("is", $eventId, $login);

        // Выполнение подготовленного запроса
        if ($stmt_delete_event->execute()) {
            echo true;
        } else {
            echo "Ошибка при удалении задачи: " . $conn->error;
        }

        // Закрытие подготовленного запроса
        $stmt_delete_event->close();
    } else {
        // Если пользователь не авторизован, выводим сообщение об ошибке
        echo "Ошибка: Пользователь не авторизован";
    }
} else {
    // Если идентификатор задачи не был отправлен, выводим сообщение об ошибке
    echo "Ошибка: Идентификатор задачи не был отправлен";
}
?>