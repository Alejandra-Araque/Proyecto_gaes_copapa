<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Verificar si se han enviado los datos del formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = htmlspecialchars($_POST['nombre']);
    $direccion = htmlspecialchars($_POST['direccion']);
    $telefono = htmlspecialchars($_POST['telefono']);
    $email = htmlspecialchars($_POST['email']);

    // Simulación de procesamiento exitoso
    $totalCarrito = 0;
    if (!empty($_SESSION['carrito'])) {
        foreach ($_SESSION['carrito'] as $item) {
            $totalCarrito += $item['precio'] * $item['cantidad'];
        }
        // Aquí podrías limpiar el carrito después del pago
        $_SESSION['carrito'] = [];

        // Mensaje de éxito
        $mensaje = "Gracias, $nombre. Tu pedido ha sido realizado con éxito.";
    } else {
        $mensaje = "No hay productos en el carrito.";
        $totalCarrito = 0;
    }
} else {
    header("Location: procesar_pago.php"); // Redirigir si no se llega a esta página desde el formulario
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Procesar Pago - COPAPA</title>
    <?php include('../includes/tailwind.php'); ?>

    <style>
        body {
            background-image: url('https://www.cronicadelquindio.com/files/noticias/120161119052524.jpg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            height: 100vh;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .container {
            max-width: 800px;
            margin: auto;
            padding: 20px;
            background: rgba(139, 69, 19, 0.5); /* Fondo café transparente */
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            color: white; /* Color de texto blanco */
        }
        h1 {
            color: white; /* Título en color blanco */
            font-weight: bold;
            text-transform: uppercase; /* Texto en mayúsculas */
            text-align: center;
            font-size: 2.5rem; /* Tamaño del título más grande */
            margin-bottom: 10px; /* Espacio debajo del título */
        }
        h2 {
            color: white; /* Títulos en color blanco */
            font-weight: bold;
            text-transform: uppercase; /* Texto en mayúsculas */
            text-align: center;
        }
        .resultado {
            margin-top: 20px;
            font-size: 18px;
            text-align: center;
        }
        .detalles {
            margin-top: 20px;
            padding: 10px;
            border: 1px solid #800080;
            border-radius: 5px;
            background: rgba(139, 69, 19, 0.5); /* Fondo café transparente con opacidad de 0.5 */
        }
        .loader {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 200px;
        }
        .loader img {
            width: 100px;
        }
        .hidden {
            display: none;
        }
        .logo {
            display: block;
            margin: 20px auto; /* Centrar el logo */
            width: 150px; /* Ajustar el tamaño del logo */
        }
    </style>
</head>
<body>

    <div class="container">
        <h1>Procesar Pago</h1>
        <!-- Logo de COPAPA centrado -->
            <img src="https://github.com/Alejandra-Araque/Proyecto_gaes_copapa/blob/main/img/copapa.png?raw=true" alt="Logo de COPAPA" class="logo">
        <!-- Simulación de carga -->
        <div id="loader" class="loader">
            <img src="https://i.gifer.com/ZZ5H.gif" alt="Cargando...">
        </div>

        <!-- Contenido del resultado -->
        <div id="resultado" class="resultado hidden">
            <p><?php echo $mensaje; ?></p>
            <?php if ($totalCarrito > 0): ?>
                <h2>Detalles del Pedido</h2>
                <div class="detalles">
                    <p><strong>Nombre:</strong> <?php echo $nombre; ?></p>
                    <p><strong>Dirección:</strong> <?php echo $direccion; ?></p>
                    <p><strong>Teléfono:</strong> <?php echo $telefono; ?></p>
                    <p><strong>Email:</strong> <?php echo $email; ?></p>
                    <p><strong>Total a Pagar:</strong> <?php echo $totalCarrito; ?> $</p>
                </div>
            <?php endif; ?>
        </div>

        <!-- Botón para volver a la tienda -->
        <div id="botonTienda" class="text-center mt-6 hidden">
            <a href="verCultivo.php" class="py-2 px-4 bg-verde text-white font-semibold rounded-md shadow-sm hover:bg-verdeClaro focus:outline-none focus:ring-2 focus:ring-verdeClaro focus:ring-opacity-75">VOLVER A LA TIENDA</a>
        </div>
    </div>

    <script>
        // Simulación de procesamiento de pago
        window.onload = function() {
            // Mostrar la animación de carga
            setTimeout(function() {
                // Ocultar el loader y mostrar el resultado
                document.getElementById('loader').classList.add('hidden');
                document.getElementById('resultado').classList.remove('hidden');
                document.getElementById('botonTienda').classList.remove('hidden');
            }, 3000); // Simular 3 segundos de procesamiento
        }
    </script>

</body>
</html>


