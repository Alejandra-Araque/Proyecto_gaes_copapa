<?php
// Iniciar la sesión si no está iniciada
session_start();

// Verificar si se ha iniciado sesión
if (isset($_SESSION['user_id'])) {
    // Destruir todas las variables de sesión
    $_SESSION = array();

    // Si se utiliza una cookie de sesión, eliminarla
    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000,
            $params["path"], $params["domain"],
            $params["secure"], $params["httponly"]
        );
    }

    // Finalmente, destruir la sesión
    session_destroy();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>COPAPA - Cerrar Sesión</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
    <div class="contenedor">
        <h1>Has cerrado sesión</h1>
        <p>Tu sesión se ha cerrado correctamente. Gracias por visitarnos.</p>
        <a href="../index.php" class="btn">Volver al inicio</a>
    </div>
</body>
</html>
