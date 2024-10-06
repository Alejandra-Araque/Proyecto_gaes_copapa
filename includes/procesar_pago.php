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

    // Aquí puedes agregar la lógica para procesar el pago
    // Por ejemplo, llamar a una API de pago o guardar la información en la base de datos

    // Simulación de procesamiento exitoso
    $totalCarrito = 0;
    if (!empty($_SESSION['carrito_de_compras'])) {
        foreach ($_SESSION['carrito_de_compras'] as $item) {
            $totalCarrito += $item['precio'] * $item['cantidad'];
        }
        // Aquí podrías limpiar el carrito después del pago
        $_SESSION['carrito'] = [];

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
        }
        .container {
            max-width: 800px;
            margin: auto;
            padding: 20px;
            background: rgba(255, 255, 255, 0.7); /* Fondo más transparente */
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }
        h1, h2 {
            color: #800080; /* Títulos en color morado */
            font-weight: bold;
            text-transform: uppercase;
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
            background: rgba(255, 255, 255, 0.9);
        }
    </style>
</head>
<body>

    <div class="container">
        <h1>Procesar Pago</h1>

        <div class="resultado">
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

        <div class="text-center mt-6">
            <a href="index.php" class="py-2 px-4 bg-verde text-white font-semibold rounded-md shadow-sm hover:bg-verdeClaro focus:outline-none focus:ring-2 focus:ring-verdeClaro focus:ring-opacity-75">Volver a la Tienda</a>
        </div>
    </div>

</body>
</html>
