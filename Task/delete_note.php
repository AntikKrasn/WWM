<?php
require_once('db.php');
error_reporting(0);
session_start(); 

if(isset($_POST['id_note']) && !empty($_POST['id_note'])) {
    if(isset($_SESSION['login'])) {
        $login = $_SESSION['login'];
        $noteId = $_POST['id_note'];

        $sql_delete_notes = "DELETE FROM `notes` WHERE id_note = ? AND login = ?";
        $stmt_delete_notes = $conn->prepare($sql_delete_notes);
        $stmt_delete_notes->bind_param("is", $noteId, $login);

        if ($stmt_delete_notes->execute()) {
            echo true;
        } else {
            echo "Ошибка при удалении задачи: " . $stmt_delete_notes->error;
        }

        $stmt_delete_notes->close();
    } else {
        echo "Ошибка: Пользователь не авторизован";
    }
} else {
    echo "Ошибка: Идентификатор задачи не был отправлен";
}
?>
