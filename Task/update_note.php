<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once('db.php'); 
session_start(); 

if (isset($_POST['note_id']) && isset($_POST['notes'])) {
    $notes = $_POST['notes'];
    $notes = str_replace("\n", ' ', $notes);
    $notes = str_replace("\r", ' ', $notes);

    $note_id = mysqli_real_escape_string($conn, $_POST['note_id']); 
    $notes = mysqli_real_escape_string($conn, $notes); 
    $login = $_SESSION['login']; 

    $sql = "UPDATE notes SET note = ? WHERE id_note = ? AND login = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sis", $notes, $note_id, $login);

    if ($stmt->execute()) {
        echo "success";
    } else {
        echo "error: " . $conn->error; 
    }
    $stmt->close();
} else {
    echo "Данные 'note_id' или 'notes' не были переданы";
}

$conn->close();
?>
