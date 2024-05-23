<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once('db.php'); // Подключаем файл с настройками для соединения с базой данных
session_start(); // Начинаем сессию

// Проверяем, существуют ли данные в $_POST['note_id'] и $_POST['notes'] и очищаем их от потенциально опасных символов
if (isset($_POST['note_id']) && isset($_POST['notes'])) {
    // Получаем задачу из POST-запроса
    $notes = $_POST['notes'];

    // Удаляем отступы с помощью trim()
    $notes = str_replace("\n", ' ', $notes);
    $notes = str_replace("\r", ' ', $notes);

    $note_id = mysqli_real_escape_string($conn, $_POST['note_id']); // Очищаем данные от потенциально опасных символов
    $notes = mysqli_real_escape_string($conn, $notes); // Очищаем данные от потенциально опасных символов
    $login = $_SESSION['login']; // Получаем логин пользователя из сессии

    // Подготовка и выполнение SQL-запроса для обновления заметки в таблице notes
    $sql = "UPDATE notes SET note = ? WHERE id_note = ? AND login = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sis", $notes, $note_id, $login);

    if ($stmt->execute()) {
        echo "success"; // Возвращаем какой-то код успеха, чтобы клиент мог его обработать
    } else {
        echo "error: " . $conn->error; // Возвращаем код ошибки, чтобы клиент мог его обработать
    }

    $stmt->close();
} else {
    echo "Данные 'note_id' или 'notes' не были переданы";
}

$conn->close();
?>