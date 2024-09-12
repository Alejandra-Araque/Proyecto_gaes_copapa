<?php
// Iniciar sesión
session_start();

// Incluir archivo de conexión a la base de datos
include ('config/db.php');

// Variables para errores y mensajes
$login_error = '';
$registro_error = '';
$registro_success = '';

// Proceso de inicio de sesión
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])) {
    $usuario = $_POST['usuario'];
    $password = $_POST['password'];

    // Verificar credenciales
    $query = "SELECT * FROM usuarios WHERE usuario = '$usuario'";
    $result = $conexion->query($query);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
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

// Proceso de registro
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['registro'])) {
    $usuario = $_POST['usuario'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $email = $_POST['email'];

    // Verificar si el usuario ya existe
    $query = "SELECT * FROM usuarios WHERE usuario = '$usuario'";
    $result = $conexion->query($query);

    if ($result->num_rows > 0) {
        $registro_error = 'El nombre de usuario ya está en uso. Elige otro.';
    } else {
        // Insertar nuevo usuario en la base de datos
        $query = "INSERT INTO usuarios (usuario, password, email) VALUES ('$usuario', '$password', '$email')";
        if ($conexion->query($query)) {
            $registro_success = 'Registro exitoso. ¡Ahora puedes iniciar sesión!';
        } else {
            $registro_error = 'Hubo un problema al registrarte. Inténtalo más tarde.';
        }
    }
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login y Registro | COPAPA</title>
    <?php include "includes/tailwind.php"; ?>
</head>
<body class="bg-beige">
    <!-- Contenedor Principal -->
    <div class="w-full flex flex-col items-center py-10">
        <div class="w-8/12 md:w-2/4 lg:w-1/3 xl:w-1/4">
            <h2 class="text-center mb-5 text-gris font-bold text-3xl">Iniciar Sesión</h2>
            <?php if ($login_error): ?>
                <div class="alert alert-danger"><?php echo $login_error; ?></div>
            <?php endif; ?>
            <form action="login_registro.php" method="post">
                <div class="flex justify-between mb-2">
                    <label for="usuario">Usuario</label>
                    <input class="w-60 h-8 rounded border-2 border-cafe" type="text" id="usuario" name="usuario" required>
                </div>
                <div class="flex justify-between mb-2">
                    <label for="password">Contraseña</label>
                    <input class="w-60 h-8 rounded border-2 border-cafe" type="password" id="password" name="password" required>
                </div>
                <button class="text-xl mx-auto block h-12 bg-cafe text-white w-40 my-4 rounded-md hover:bg-cafeClaro hover:border-2 hover:border-cafe" type="submit" name="login">Iniciar Sesión</button>
            </form>
        </div>

        <hr>

        <div class="w-8/12 md:w-2/4 lg:w-1/3 xl:w-1/4">
            <h2 class="text-center mb-5 text-gris font-bold text-3xl">Registro</h2>
            <?php if ($registro_error): ?>
                <div class="alert alert-danger"><?php echo $registro_error; ?></div>
            <?php endif; ?>
            <?php if ($registro_success): ?>
                <div class="alert alert-success"><?php echo $registro_success; ?></div>
            <?php endif; ?>
            <form action="login_registro.php" method="post">
                <div class="flex justify-between mb-2">
                    <label for="usuario">Usuario</label>
                    <input class="w-60 h-8 rounded border-2 border-cafe" type="text" id="usuario" name="usuario" required>
                </div>
                <div class="flex justify-between mb-2">
                    <label for="email">Email</label>
                    <input class="w-60 h-8 rounded border-2 border-cafe" type="email" id="email" name="email" required>
                </div>
                <div class="flex justify-between mb-2">
                    <label for="password">Contraseña</label>
                    <input class="w-60 h-8 rounded border-2 border-cafe" type="password" id="password" name="password" required>
                </div>
                <button class="text-xl mx-auto block h-12 bg-cafe text-white w-40 my-4 rounded-md hover:bg-cafeClaro hover:border-2 hover:border-cafe" type="submit" name="registro">Registrarse</button>
            </form>
        </div>
    </div>

    <!-- Incluye el footer -->
    <?php include 'includes/footer.php'; ?>

    <script src="js/jquery-3.4.1.min.js"></script>
</body>
</html>
