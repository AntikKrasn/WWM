<?php
error_reporting(0);
session_start();
require_once('db.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $note = htmlspecialchars($_POST['note']); // Получаем текст из поля textarea и очищаем его от специальных символов
    $login = $_SESSION['login'];

    $sql_check = "SELECT * FROM diary WHERE login = ?";
    $stmt_check = $conn->prepare($sql_check);
    $stmt_check->bind_param("s", $login);
    $stmt_check->execute();
    $result_check = $stmt_check->get_result();
    
    if ($result_check->num_rows > 0) {
        if (!empty($note)) {
            $sql = "UPDATE diary SET diary_text = ? WHERE login = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ss", $note, $login);
        } else {
            $sql = "DELETE FROM diary WHERE login = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("s", $login);
        }
    } else { 
        $sql = "INSERT INTO diary (login, diary_text) VALUES (?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $login, $note);
    }

    if ($stmt->execute()) {
        echo "Данные успешно " . ($result_check->num_rows > 0 ? "обновлены" : "вставлены") . "!";
    } else {
        echo "Ошибка при " . ($result_check->num_rows > 0 ? "обновлении" : "вставке") . " данных: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "Ошибка: Неверный метод запроса.";
}
?>
