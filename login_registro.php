<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Iniciar sesión
session_start();

// Incluir archivo de conexión a la base de datos
include('config/db.php');

// Variables para errores y mensajes
$login_error = '';
$registro_error = '';
$registro_success = '';

// Proceso de registro
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['registro'])) {
    $tipoidentificacion = $_POST['tipoidentificacion'];
    $numidentificacion = $_POST['numidentificacion'];
    $nombres = $_POST['nombres'];
    $apellidos = $_POST['apellidos'];
    $correo = $_POST['correo'];
    $numeroCelular = $_POST['numeroCelular'];
    $direccion = $_POST['direccion'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $tipoUsuario = $_POST['tipoUsuario'];

    // Verificar si el número de identificación ya existe
    $query = "SELECT * FROM usuarios WHERE numidentificacion = ?";
    $stmt = $conexion->prepare($query);
    $stmt->bind_param('s', $numidentificacion); // 's' indica que es una cadena
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $registro_error = 'El número de identificación ya está registrado.';
    } else {
        // Insertar nuevo usuario en la base de datos
        $query = "INSERT INTO usuarios (tipoidentificacion, numidentificacion, nombres, apellidos, correo, numeroCelular, direccion, password, tipoUsuario, fecharegistro) 
                  VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())";
        $stmt = $conexion->prepare($query);
        $stmt->bind_param('sssssssss', $tipoidentificacion, $numidentificacion, $nombres, $apellidos, $correo, $numeroCelular, $direccion, $password, $tipoUsuario);

        if ($stmt->execute()) {
            $registro_success = 'Registro exitoso. ¡Ahora puedes iniciar sesión!';
        } else {
            $registro_error = 'Hubo un problema al registrarte. Inténtalo más tarde.';
        }
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login y Registro | COPAPA</title>
    <?php include "includes/tailwind.php"; ?>
    <style>
        .alert {
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 15px;
        }
        .alert-danger {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
        .alert-success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
        #modal {
            display: none;
        }
        #modal.show {
            display: block;
        }
        body {
            background-image: url('https://serfi.pe/wp-content/uploads/2022/06/controlar-la-racha-en-tu-cultivo-de-papa.jpg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }

        /* Estilos para el formulario */
        .form-container {
            background-color: rgba(139, 69, 19, 0.5); /* Fondo café transparente */
            color: #fff; /* Texto blanco para contraste */
            padding: 20px;
            border-radius: 10px;
        }

        /* Asegura que el texto dentro de los campos sea negro */
        input, select {
            color: #000; /* Cambiado a negro */
            background-color: rgba(255, 255, 255, 0.5); /* Fondo blanco semitransparente */
        }

        label, h2 {
            font-weight: bold; /* Texto en negrita */
        }

        button {
            background-color: #1e90ff;
            color: white;
        }

        button:hover {
            background-color: #1c86ee;
        }

        img.logo {
            display: block;
            margin: 0 auto 15px;
            width: 100px; /* Ajusta el tamaño según tu logo */
        }
    </style>
    <script>
        // El resto de tu script...
    </script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <!-- Contenedor Principal -->
    <div class="w-full max-w-md form-container shadow-md">
        <h2 class="text-center mb-5 text-black font-bold text-3xl">Registro</h2>
        <img src="https://github.com/Alejandra-Araque/Proyecto_gaes_copapa/blob/main/img/copapa.png?raw=true" alt="Logo" class="logo"> <!-- Reemplaza con la ruta de tu logo -->
        <form action="login_registro.php" method="post" onsubmit="return validarPassword()">
            <!-- Tipo Identificación -->
            <div class="mb-4">
                <label for="tipoidentificacion" class="block mb-1">Tipo de Identificación</label>
                <select class="w-full h-10 rounded border-2 border-gray-400" id="tipoidentificacion" name="tipoidentificacion" required>
                    <option value="" style="color: black;">Seleccione</option>
                    <option value="CC" style="color: black;">CC</option>
                    <option value="CE" style="color: black;">CE</option>
                    <option value="TI" style="color: black;">TI</option>
                </select>
            </div>

            <!-- Tipo Usuario -->
            <div class="mb-4">
                <label for="tipoUsuario" class="block mb-1">Tipo de Usuario</label>
                <select class="w-full h-10 rounded border-2 border-gray-400" id="tipoUsuario" name="tipoUsuario" required>
                    <option value="" style="color: black;">Seleccione</option>
                    <option value="Cliente" style="color: black;">Cliente</option>
                    <option value="Agricultor" style="color: black;">Agricultor</option>
                </select>
            </div>

            <!-- Número de Identificación -->
            <div class="mb-4">
                <label for="numidentificacion" class="block mb-1">Número de Identificación</label>
                <input class="w-full h-10 rounded border-2 border-gray-400" type="text" id="numidentificacion" name="numidentificacion" required>
            </div>

            <!-- Nombres -->
            <div class="mb-4">
                <label for="nombres" class="block mb-1">Nombres</label>
                <input class="w-full h-10 rounded border-2 border-gray-400" type="text" id="nombres" name="nombres" required>
            </div>

            <!-- Apellidos -->
            <div class="mb-4">
                <label for="apellidos" class="block mb-1">Apellidos</label>
                <input class="w-full h-10 rounded border-2 border-gray-400" type="text" id="apellidos" name="apellidos" required>
            </div>

            <!-- Correo -->
            <div class="mb-4">
                <label for="correo" class="block mb-1">Correo</label>
                <input class="w-full h-10 rounded border-2 border-gray-400" type="email" id="correo" name="correo" required>
            </div>

            <!-- Número Celular -->
            <div class="mb-4">
                <label for="numeroCelular" class="block mb-1">Número de Celular</label>
                <input class="w-full h-10 rounded border-2 border-gray-400" type="text" id="numeroCelular" name="numeroCelular" required>
            </div>

            <!-- Dirección -->
            <div class="mb-4">
                <label for="direccion" class="block mb-1">Dirección</label>
                <input class="w-full h-10 rounded border-2 border-gray-400" type="text" id="direccion" name="direccion" required>
            </div>

            <!-- Contraseña -->
            <div class="mb-4">
                <label for="password" class="block mb-1">Contraseña</label>
                <input class="w-full h-10 rounded border-2 border-gray-400" type="password" id="password" name="password" required>
            </div>

            <!-- Verificar Contraseña -->
            <div class="mb-4">
                <label for="verificarPassword" class="block mb-1">Verificar Contraseña</label>
                <input class="w-full h-10 rounded border-2 border-gray-400" type="password" id="verificarPassword" name="verificarPassword" required>
                <div id="errorPassword" class="text-red-600 mt-1" style="display:none;"></div>
            </div>

            <button type="submit" name="registro" class="w-full h-10 bg-blue-500 text-white rounded hover:bg-blue-600">Registrarse</button>
        </form>
        <p class="text-center mt-4">¿Ya tienes una cuenta? <a href="login.php" class="text-blue-500">Inicia sesión aquí</a></p>
    </div>

    <!-- Modal de Mensaje -->
    <div id="modal" class="fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-50">
        <div class="bg-white rounded-lg p-5 shadow-lg w-80">
            <div id="modal-message" class="alert"></div>
            <button class="mt-4 w-full h-10 bg-blue-500 text-white rounded hover:bg-blue-600" onclick="document.getElementById('modal').style.display='none'; redirigirLogin();">Aceptar</button>
        </div>
    </div>
</body>
</html>




