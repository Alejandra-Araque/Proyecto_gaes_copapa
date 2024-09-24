<?php
// Incluir archivo de conexión a la base de datos
include('../config/db.php');

session_start();
// Procesar el formulario al enviar
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener los datos del formulario y sanitizar
    $fecha = date('d-m-Y');
    $id_usuario = $_SESSION['usuario'];
    $producto = htmlspecialchars($_POST['producto']);
    $cantidad = intval($_POST['cantidad']);
    $direccion_envio = htmlspecialchars($_POST['direccion_envio']);

    try {
        // Preparar la consulta SQL para insertar el nuevo pedido
        $sql = "INSERT INTO pedido (producto, cantidad, direccion_envio, Cliente_Id, fecha) VALUES (?, ?, ?, ?, ?)";

        // Preparar la sentencia
        if ($stmt = $conexion->prepare($sql)) {
            // Vincular los parámetros
            $stmt->bind_param("sisis", $producto, $cantidad, $direccion_envio, $id_usuario, $fecha);

            // Ejecutar la consulta
            if ($stmt->execute()) {
                echo "<p style='color: green;'>Pedido creado correctamente.</p>";
            } else {
                echo "<p style='color: red;'>Error al crear el pedido.</p>";
            }

            // Cerrar la sentencia
            $stmt->close();
        } else {
            echo "<p style='color: red;'>Error en la preparación de la consulta.</p>";
        }
    } catch (Exception $e) {
        echo "<p style='color: red;'>Error: " . htmlspecialchars($e->getMessage()) . "</p>";
    }

    // Cerrar la conexión
    $conexion->close();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Pedido - COPAPA</title>

    <?php include('tailwind.php'); ?>

    <style>
        body {
            background-image: url('/Proyecto_gaes_copapa/Proyecto_gaes_copapa/img/crear_pedido.png');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            height: 100vh;
            margin: 0;
        }
    </style>
</head>
<body class="flex items-center justify-center">

    <div class="bg-white bg-opacity-80 p-8 rounded-lg shadow-lg w-full max-w-md">
        <h1 class="text-2xl font-bold mb-6 text-center text-cafe">Crear Pedido</h1>

        <!-- Formulario para crear pedido -->
        <form method="POST" class="space-y-4">
            <div>
                <label for="producto" class="block text-lg font-medium text-gris">Producto</label>
                <input type="text" id="producto" name="producto" required class="mt-1 block w-full px-4 py-2 border border-gris rounded-md shadow-sm focus:outline-none focus:ring focus:ring-verdeClaro focus:border-verde">
            </div>

            <div>
                <label for="cantidad" class="block text-lg font-medium text-gris">Cantidad</label>
                <input type="number" id="cantidad" name="cantidad" required class="mt-1 block w-full px-4 py-2 border border-gris rounded-md shadow-sm focus:outline-none focus:ring focus:ring-verdeClaro focus:border-verde">
            </div>

            <div>
                <label for="direccion_envio" class="block text-lg font-medium text-gris">Dirección de Envío</label>
                <input type="text" id="direccion_envio" name="direccion_envio" required class="mt-1 block w-full px-4 py-2 border border-gris rounded-md shadow-sm focus:outline-none focus:ring focus:ring-verdeClaro focus:border-verde">
            </div>

            <div>
                <input type="hidden" name="tipoDeUsuario" value="">
            </div>

            <div class="text-center">
                <button type="submit" class="w-full py-2 px-4 bg-verde text-white font-semibold rounded-md shadow-sm hover:bg-verdeClaro focus:outline-none focus:ring-2 focus:ring-verdeClaro focus:ring-opacity-75">Crear Pedido</button>
            </div>
        </form>
    </div>

</body>
</html>
