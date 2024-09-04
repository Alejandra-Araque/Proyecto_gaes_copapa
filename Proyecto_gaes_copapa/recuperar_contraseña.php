<?php
// Iniciar sesión
session_start();

// Incluir archivo de conexión a la base de datos
include 'conexion.php';

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
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style_index.css">
    <link rel="stylesheet" href="css/responsive.css">
</head>
<body>

    <!-- Contenedor Principal -->
    <div class="contenido">
        <div class="formularios">
            <h2>Recuperar Contraseña</h2>
            <?php if ($msg): ?>
                <div class="alert alert-info"><?php echo $msg; ?></div>
            <?php endif; ?>
            <form action="recuperar_contraseña.php" method="post">
                <div class="contenedor-inputs">
                    <label for="email">Correo Electrónico</label>
                    <input type="email" id="email" name="email" required>
                </div>
                <button type="submit">Enviar Enlace de Recuperación</button>
            </form>
            <p><a href="login.php">Volver al inicio de sesión</a>.</p>
        </div>
    </div>

    <!-- Incluye el footer -->
    <?php include 'includes/footer.php'; ?>

    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery-3.4.1.min.js"></script>
</body>
</html>
