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
    <?php include "includes/tailwind.php";?>
</head>
<body class="bg-beige">
    <!-- Contenedor Principal -->
    <div class="w-full flex justify-center py-10">
        <div class="w-8/12 md:w-2/4 lg:w-1/3 xl:w-1/4" >
            <h2 class="text-center mb-5 text-gris font-bold text-3xl">Iniciar Sesión</h2>
            <?php if ($login_error): ?>
                <div class="alert alert-danger"><?php echo $login_error; ?></div>
            <?php endif; ?>
            <form action="login.php" method="post">
                <div class="flex justify-between mb-2">
                    <label for="usuario">Usuario</label>
                    <input class="w-60 h-8 rounded border-2 border-cafe" type="text" id="usuario" name="usuario" required>
                </div>
                <div class="flex justify-between mb-2">
                    <label for="password">Contraseña</label>
                    <input class="w-60 h-8 rounded border-2 border-cafe" type="password" id="password" name="password" required>
                </div>
                <button class="text-xl mx-auto block h-12 bg-cafe text-white w-40 my-4 rounded-md hover:bg-cafeClaro hover:border-2 hover:border-cafe" type="submit">Iniciar Sesión</button>
            </form>
            <p class="text-center">¿No tienes una cuenta? <a class="text-cafe font-bold" href="login_registro.php">Regístrate aquí</a>.</p>
        </div>
    </div>

    <!-- Incluye el footer -->
    <?php include 'includes/footer.php'; ?>

    <script src="js/bootstrap.js"></script>
</body>
</html>
