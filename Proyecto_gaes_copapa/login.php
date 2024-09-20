<?php
// Iniciar sesión
session_start();

// Verificar si el usuario ya ha iniciado sesión
if (isset($_SESSION['usuario'])) {
    header('Location: home.php');
    exit();
}

// Incluir archivo de conexión a la base de datos
include('config/db.php');

// Variable para almacenar mensajes de error
$login_error = '';

// Proceso de inicio de sesión
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $usuario = $_POST['usuario'];
    $password = $_POST['password'];

    // Preparar la consulta para prevenir inyecciones SQL usando PDO
    try {
        $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE numidentificacion = ?");
        $stmt->bindParam(1, $usuario, PDO::PARAM_STR);
        $stmt->execute();
        
        if ($stmt->rowCount() > 0) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            // Verificar la contraseña
            if (password_verify($password, $row['password'])) {
                // Iniciar sesión
                $_SESSION['usuario'] = $usuario;
                header('Location: home.php');
                exit();
            } else {
                $login_error = 'Usuario o contraseña incorrectos. Verifica tus datos.';
            }
        } else {
            $login_error = 'Usuario o contraseña incorrectos. Verifica tus datos.';
        }
    } catch (PDOException $e) {
        error_log("Error al consultar la base de datos: " . $e->getMessage());
        $login_error = 'Error al consultar la base de datos. Por favor, inténtalo más tarde.';
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión | COPAPA</title>
    <?php include "includes/tailwind.php"; ?>
    <link rel="stylesheet" href="css/footer.css">
    <style>
        body {
            background-image: url('/copapa/Proyecto_gaes_copapa/Proyecto_gaes_copapa/img/banner/9.png'); /* Cambia esta ruta por la de tu imagen */
            background-size: cover;
            background-position: center;
        }
    </style>
</head>
<body>
    <!-- Contenedor Principal -->
    <div class="flex items-center justify-center min-h-screen bg-black bg-opacity-50">
        <div class="bg-white rounded-lg shadow-lg p-8 md:w-96 w-11/12">
            <h2 class="text-center mb-5 text-gris font-bold text-3xl">Iniciar Sesión</h2>
            <?php if ($login_error): ?>
                <div class="bg-red-500 text-white p-3 rounded mb-4 text-center">
                    <?php echo htmlspecialchars($login_error); ?>
                </div>
            <?php endif; ?>
            <form action="login.php" method="post">
                <div class="mb-4">
                    <label for="usuario" class="block mb-1">N° Identificación</label>
                    <input class="w-full h-10 rounded border-2 border-cafe p-2" type="text" id="usuario" name="usuario" required>
                </div>
                <div class="mb-4">
                    <label for="password" class="block mb-1">Contraseña</label>
                    <input class="w-full h-10 rounded border-2 border-cafe p-2" type="password" id="password" name="password" required>
                </div>
                <button class="w-full h-12 bg-cafe text-white rounded-md hover:bg-cafeClaro transition duration-300" type="submit">Iniciar Sesión</button>
            </form>
            <p class="text-center mt-4">¿No tienes una cuenta? <a class="text-cafe font-bold" href="login_registro.php">Regístrate aquí</a>.</p>
        </div>
    </div>

    <!-- Incluye el footer -->
    <?php include 'includes/footer.php'; ?>

    <script src="js/bootstrap.js"></script>
</body>
</html>
