<?php
error_reporting(0);
ini_set('display_errors', 1);
if (!isset($_SESSION)) {
    session_start();
}
$_SESSION = array();
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}
session_destroy();

echo "<script>window.location.replace('../Avtorization/avtorization.php');</script>";
exit; 

$conn->close(); 
?>
