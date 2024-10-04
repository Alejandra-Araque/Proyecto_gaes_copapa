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
            background-image: url('/Proyecto_gaes_copapa/Proyecto_gaes_copapa/img/banner/8.png'); /* Asegúrate de reemplazar la ruta con la ubicación real de tu imagen */
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }
    </style>
    <script>
        function validarPassword() {
            const password = document.getElementById("password").value;
            const verificarPassword = document.getElementById("verificarPassword").value;
            const errorPassword = document.getElementById("errorPassword");

            if (password !== verificarPassword) {
                errorPassword.textContent = "Las contraseñas no coinciden.";
                errorPassword.style.display = "block";
                return false;
            } else {
                errorPassword.style.display = "none";
                return true;
            }
        }

        function mostrarModal(mensaje, tipo) {
            const modal = document.getElementById("modal");
            const modalMessage = document.getElementById("modal-message");

            if (modal && modalMessage) {
                modalMessage.textContent = mensaje;
                modal.className = 'alert ' + tipo;
                modal.style.display = 'block'; // Asegúrate de que el modal se muestre
            }
        }

        function redirigirLogin() {
            window.location.href = "login.php";
        }

        window.onload = function() {
            const registroError = "<?php echo htmlspecialchars($registro_error); ?>";
            const registroSuccess = "<?php echo htmlspecialchars($registro_success); ?>";

            if (registroError) {
                mostrarModal(registroError, 'alert-danger');
            } else if (registroSuccess) {
                mostrarModal(registroSuccess, 'alert-success');
            }
        }
    </script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <!-- Contenedor Principal -->
  <div class="w-full max-w-md bg-white rounded-lg shadow-md p-6">
    <div class="login-container">
    <img src="img/copapa.png" alt="Logo" class="logo">
        <h2 class="text-center mb-5 text-gray-700 font-bold text-3xl">Registro</h2>
        <form action="login_registro.php" method="post" onsubmit="return validarPassword()">
            <!-- Tipo Identificación -->
            <div class="mb-4">
                <label for="tipoidentificacion" class="block mb-1">Tipo de Identificación</label>
                <select class="w-full h-10 rounded border-2 border-gray-400" id="tipoidentificacion" name="tipoidentificacion" required>
                    <option value="">Seleccione</option>
                    <option value="CC">CC</option>
                    <option value="CE">CE</option>
                    <option value="TI">TI</option>
                </select>
            </div>

            <!-- Tipo Usuario -->
            <div class="mb-4">
                <label for="tipoUsuario" class="block mb-1">Tipo de Usuario</label>
                <select class="w-full h-10 rounded border-2 border-gray-400" id="tipoUsuario" name="tipoUsuario" required>
                    <option value="">Seleccione</option>
                    <option value="Cliente">Cliente</option>
                    <option value="Agricultor">Agricultor</option>
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
