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
    <script>
        // Eliminar todas las credenciales del almacenamiento interno
        localStorage.clear();
        sessionStorage.clear();

        // Eliminar cookies específicas
        document.cookie.split(";").forEach(function(c) {
            document.cookie = c.trim().split("=")[0] + '=;expires=' + new Date(0).toUTCString() + ';path=/';
        });

        // Eliminar IndexedDB (opcional si tu aplicación usa IndexedDB)
        if (window.indexedDB && indexedDB.deleteDatabase) {
            indexedDB.databases().then(dbs => {
                dbs.forEach(db => {
                    indexedDB.deleteDatabase(db.name);
                });
            });
        }

        // Eliminar Service Workers (si tu aplicación los utiliza)
        if ('serviceWorker' in navigator) {
            navigator.serviceWorker.getRegistrations().then(function(registrations) {
                for(let registration of registrations) {
                    registration.unregister();
                }
            });
        }

        // Forzar recargar la página sin cache (hard reload)
        window.onload = function() {
            setTimeout(function() {
                window.location.href = 'login.php'; // Redirige después de limpiar el almacenamiento
            }, 2000); // Espera 2 segundos para mostrar el mensaje
        };
    </script>
</head>
<body class="bg-beige">
    <div class="flex flex-col items-center">
        <h1 class="text-gris font-bold text-3xl mt-8">Has cerrado sesión</h1>
        <p class="text-xl mt-2">Tu sesión se ha cerrado correctamente. Gracias por visitarnos.</p>
        <a class="hover:text-cafe hover:font-bold text-xl" href="login.php">Ir al inicio de sesión</a>
    </div>
</body>
</html>
