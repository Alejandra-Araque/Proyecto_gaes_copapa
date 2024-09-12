<?php
// Iniciar sesión
session_start();

// Incluir archivo de conexión a la base de datos
include 'config/db.php';

// Variable para almacenar mensajes de error o éxito
$msg = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];

    // Verificar si el correo electrónico está registrado
    $query = "SELECT * FROM usuarios WHERE email = '$email'";
    $result = $conexion->query($query);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $token = bin2hex(random_bytes(50)); // Generar un token seguro

        // Guardar el token en la base de datos
        $query = "UPDATE usuarios SET token = '$token' WHERE email = '$email'";
        if ($conexion->query($query)) {
            // Enviar correo de recuperación
            $reset_link = "http://tu-dominio.com/reset_password.php?token=$token";
            $subject = "Recuperación de contraseña - COPAPA";
            $message = "Haz clic en el siguiente enlace para restablecer tu contraseña: $reset_link";
            $headers = "From: no-reply@tu-dominio.com";

            if (mail($email, $subject, $message, $headers)) {
                $msg = "Un enlace de recuperación ha sido enviado a tu correo electrónico.";
            } else {
                $msg = "Hubo un error al enviar el correo. Por favor, inténtalo de nuevo.";
            }
        } else {
            $msg = "Hubo un error al procesar tu solicitud. Por favor, inténtalo de nuevo.";
        }
    } else {
        $msg = "No se encontró una cuenta con ese correo electrónico.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperar Contraseña | COPAPA</title>
    <?php include "includes/tailwind.php"; ?>
</head>
<body class="bg-beige">

    <!-- Contenedor Principal -->
    <div class="w-full flex flex-col items-center py-10">
        <div class="w-8/12 md:w-2/4 lg:w-1/3 xl:w-1/4">
            <h2 class="text-center mb-5 text-gris font-bold text-3xl">Recuperar Contraseña</h2>
            <?php if ($msg): ?>
                <div class="alert alert-info"><?php echo $msg; ?></div>
            <?php endif; ?>
            <form action="recuperar_contraseña.php" method="post">
                <div class="flex justify-between mb-2">
                    <label for="email">Correo Electrónico</label>
                    <input class="w-60 h-8 rounded border-2 border-cafe" type="email" id="email" name="email" required>
                </div>
                <button class="text-xl mx-auto block h-16 bg-cafe text-white w-60 my-4 rounded-md hover:bg-cafeClaro hover:border-2 hover:border-cafe" type="submit">Enviar Enlace de Recuperación</button>
            </form>
            <p class="text-center"><a class="hover:text-cafe hover:font-bold" href="login.php">Volver al inicio de sesión</a>.</p>
        </div>
    </div>

    <!-- Incluye el footer -->
    <?php include 'includes/footer.php'; ?>
</body>
</html>
