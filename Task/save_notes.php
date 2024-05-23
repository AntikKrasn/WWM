<?php
require_once('db.php');
error_reporting(0);
session_start(); 
ob_start(); 

if(isset($_POST['noteText']) && !empty($_POST['noteText'])) {
    if(isset($_SESSION['login'])) {
        $login = $_SESSION['login'];
        $notes = $_POST['noteText'];
        $notes = trim($notes);
        $sql_insert_notes = "INSERT INTO `notes` (note, login) VALUES (?, ?)";
        $stmt_insert_notes = $conn->prepare($sql_insert_notes);
        $stmt_insert_notes->bind_param("ss", $notes, $login);

        if ($stmt_insert_notes->execute()) {
            echo true;
        } else {
            echo "Ошибка при добавлении задачи: " . $stmt_insert_notes->error;
        }
        $stmt_insert_notes->close();
    } else {
        echo "Ошибка: Пользователь не авторизован";
    }
} else {
    echo "Ошибка: Задача не была отправлена";
}
?>
