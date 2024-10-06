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

    // Preparar la consulta para prevenir inyecciones SQL usando mysqli
    $stmt = $conexion->prepare("SELECT * FROM usuarios WHERE numidentificacion = ?");
    $stmt->bind_param('s', $usuario); // 's' indica que es una cadena
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
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

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión | COPAPA</title>
    <?php include "includes/tailwind.php"; ?>
    <style>
         <style>
    /* Imagen de fondo completa */
        body {
            background-image: url('/copapa/Proyecto_gaes_copapa/Proyecto_gaes_copapa/img/banner/9.png'); /* Cambia esta ruta por la de tu imagen */
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }
        /* Estilo para el logo */
        .logo {
            width: 90px; /* Ajusta el ancho según tus necesidades */
            height: auto; /* Mantiene la proporción del logo */
            margin: 1em auto 2em;
            transition: transform 0.3s; /* Efecto de transición al pasar el ratón */
            text-align: center; 
            position: relative;

        }
        
        /* Estilos para el contenedor del formulario */
        .form-container {
            background-color: rgba(255, 255, 255, 0.7); /* Fondo semitransparente */
            color: #333; /* Texto oscuro para mejor contraste */
        }

        input {
            color: #333; /* Texto dentro de los campos */
        }

        button {
            background-color: #8B4513; /* Café oscuro para el botón */
            color: white;
        }

        button:hover {
            background-color: #A0522D; /* Café claro al pasar el mouse */
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
                    <input class="w-full h-10 rounded border-2 border-gray-400 p-2" type="text" id="usuario" name="usuario" required>
                </div>
                <div class="mb-4">
                    <label for="password" class="block mb-1">Contraseña</label>
                    <input class="w-full h-10 rounded border-2 border-gray-400 p-2" type="password" id="password" name="password" required>
                </div>
                <button class="w-full h-12 rounded-md hover:bg-cafeClaro transition duration-300" type="submit">Iniciar Sesión</button>
            </form>
            <p class="text-center mt-4">¿No tienes una cuenta? <a class="text-cafe font-bold" href="login_registro.php">Regístrate aquí</a>.</p>
        </div>
    </div>

    <script src="js/bootstrap.js"></script>
</body>
</html>
