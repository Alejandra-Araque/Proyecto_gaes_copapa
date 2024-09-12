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
    <?php include "includes/tailwind.php"; ?>
</head>
<body class="bg-beige">
    <div class="flex flex-col items-center">
        <h1 class="text-gris font-bold text-3xl mt-8">Has cerrado sesión</h1>
        <p class="text-xl mt-2">Tu sesión se ha cerrado correctamente. Gracias por visitarnos.</p>
        <a class="hover:text-cafe hover:font-bold text-xl" href="../index.php" >Volver al inicio</a>
    </div>
</body>
</html>
