<?php
error_reporting(0);
ini_set('display_errors', 1);

// Начинаем сессию, если она еще не начата
if (!isset($_SESSION)) {
    session_start();
}

// Уничтожаем все данные сессии
$_SESSION = array();

// Если требуется уничтожить сессию полностью, необходимо также удалить куки сессии.
// Это гарантирует, что текущий идентификатор сессии будет недействителен.
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// Уничтожаем сессию
session_destroy();

// Перенаправляем пользователя на страницу авторизации
echo "<script>window.location.replace('../Avtorization/avtorization.php');</script>";
exit; // Важно завершить выполнение скрипта после перенаправления

// Добавляем закрытие соединения с базой данных
$conn->close();  // Предполагается, что объект соединения называется $conn, и его метод close() используется для закрытия соединения
?>