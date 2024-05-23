<?php
require_once('db.php');
error_reporting(0);
session_start(); 

if(isset($_POST['id_task']) && !empty($_POST['id_task'])) {
    if(isset($_SESSION['login'])) {
        $login = $_SESSION['login'];

        $taskId = $_POST['id_task'];

        $sql_delete_task = "DELETE FROM `task` WHERE id_task = ? AND login = ?";
        $stmt_delete_task = $conn->prepare($sql_delete_task);
        $stmt_delete_task->bind_param("is", $taskId, $login);

        if ($stmt_delete_task->execute()) {
            echo true;
        } else {
            echo "Ошибка при удалении задачи: " . $conn->error;
        }

        $stmt_delete_task->close();
    } else {
        echo "Ошибка: Пользователь не авторизован";
    }
} else {
    echo "Ошибка: Идентификатор задачи не был отправлен";
}
?>
