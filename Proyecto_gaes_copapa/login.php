<?php
// Iniciar sesión
session_start();

// Verificar si el usuario ya ha iniciado sesión
if (isset($_SESSION['usuario'])) {
    header('Location: index.php');
    exit();
}

// Incluir archivo de conexión a la base de datos
include ('config/db.php');

// Variable para almacenar mensajes de error
$login_error = '';

// Proceso de inicio de sesión
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $usuario = $_POST['usuario'];
    $password = $_POST['password'];

    // Verificar las credenciales en la base de datos
    $query = "SELECT * FROM usuarios WHERE usuario = '$usuario'";
    $result = $conexion->query($query);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        // Verificar la contraseña
        if (password_verify($password, $row['password'])) {
            // Iniciar sesión
            $_SESSION['usuario'] = $usuario;
            header('Location: index.php');
            exit();
        } else {
            $login_error = 'Contraseña incorrecta. Inténtalo de nuevo.';
        }
    } else {
        $login_error = 'El usuario no existe. Verifica tus datos.';
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión | COPAPA</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style_index.css">
    <link rel="stylesheet" href="css/responsive.css">
</head>
<body>

    <!-- Contenedor Principal -->
    <div class="contenido">
        <div class="formularios">
            <h2>Iniciar Sesión</h2>
            <?php if ($login_error): ?>
                <div class="alert alert-danger"><?php echo $login_error; ?></div>
            <?php endif; ?>
            <form action="login.php" method="post">
                <div class="contenedor-inputs">
                    <label for="usuario">Usuario</label>
                    <input type="text" id="usuario" name="usuario" required>
                </div>
                <div class="contenedor-inputs">
                    <label for="password">Contraseña</label>
                    <input type="password" id="password" name="password" required>
                </div>
                <button type="submit">Iniciar Sesión</button>
            </form>
            <p>¿No tienes una cuenta? <a href="login_registro.php">Regístrate aquí</a>.</p>
        </div>
    </div>

    <!-- Incluye el footer -->
    <?php include 'includes/footer.php'; ?>

    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery-3.4.1.min.js"></script>
</body>
</html>
