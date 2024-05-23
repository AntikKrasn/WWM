<?php
require_once('db.php');
error_reporting(0);
session_start(); 

if(isset($_POST['id_calendar']) && !empty($_POST['id_calendar'])) {
    if(isset($_SESSION['login'])) {
        $login = $_SESSION['login'];

        $eventId = $_POST['id_calendar'];
        
        $sql_delete_event = "DELETE FROM `calendar` WHERE id_calendar = ? AND login = ?";
        $stmt_delete_event = $conn->prepare($sql_delete_event);
        $stmt_delete_event->bind_param("is", $eventId, $login);

        if ($stmt_delete_event->execute()) {
            echo true;
        } else {
            echo "Ошибка при удалении задачи: " . $conn->error;
        }

        $stmt_delete_event->close();
    } else {
        echo "Ошибка: Пользователь не авторизован";
    }
} else {
    echo "Ошибка: Идентификатор задачи не был отправлен";
}
?>
