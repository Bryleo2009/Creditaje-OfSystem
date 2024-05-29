<?php
session_start(); // Iniciar la sesión si aún no se ha iniciado

// Eliminar todas las variables de sesión
$_SESSION = array();

// Si se desea eliminar la sesión por completo, también se puede borrar la cookie de sesión.
// Nota: Esto destruirá la sesión y no solo los datos de sesión.
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// Finalizar la sesión
session_destroy();

// Redirigir a la página de inicio de sesión o a cualquier otra página después de cerrar sesión
header("Location: ../admin-back"); // Reemplaza "login.php" con la ruta de tu página de inicio de sesión
exit;
?>
