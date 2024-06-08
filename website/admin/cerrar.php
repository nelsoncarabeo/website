<?php
session_start();

// Destruir todas las variables de sesión
$_SESSION = array();

// Si se desea destruir la sesión completamente, también es útil limpiar la cookie de sesión.
// Esto la destruirá completamente, y no solo la borrará.
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// Finalmente, destruir la sesión.
session_destroy();

// Redirigir al usuario de vuelta al login usando la URL base
$url_base = "http://localhost/website/admin/";
header("Location: {$url_base}login.php");
exit;
?>
