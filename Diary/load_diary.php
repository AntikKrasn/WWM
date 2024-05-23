<?php
error_reporting(0);
session_start();
require_once('db.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Проверяем, что данные были отправлены методом POST
    $note = htmlspecialchars($_POST['note']); // Получаем текст из поля textarea и очищаем его от специальных символов

    // Получаем логин из сессии
    $login = $_SESSION['login'];

    // Проверяем, существует ли уже запись для данного пользователя
    $sql_check = "SELECT * FROM diary WHERE login = ?";
    $stmt_check = $conn->prepare($sql_check);
    $stmt_check->bind_param("s", $login);
    $stmt_check->execute();
    $result_check = $stmt_check->get_result();
    

    // Если запись уже существует, обновляем ее
    if ($result_check->num_rows > 0) {
        if (!empty($note)) {
            // Если поле не пустое, обновляем запись
            $sql = "UPDATE diary SET diary_text = ? WHERE login = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ss", $note, $login);
        } else {
            // Если поле пустое, удаляем запись
            $sql = "DELETE FROM diary WHERE login = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("s", $login);
        }
    } else { // Иначе вставляем новую запись
        $sql = "INSERT INTO diary (login, diary_text) VALUES (?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $login, $note);
    }

    // Выполняем запрос
    if ($stmt->execute()) {
        echo "Данные успешно " . ($result_check->num_rows > 0 ? "обновлены" : "вставлены") . "!";
    } else {
        echo "Ошибка при " . ($result_check->num_rows > 0 ? "обновлении" : "вставке") . " данных: " . $stmt->error;
    }

    $stmt->close();
} else {
    // Если запрос не был выполнен методом POST, возвращаем ошибку
    echo "Ошибка: Неверный метод запроса.";
}
?>