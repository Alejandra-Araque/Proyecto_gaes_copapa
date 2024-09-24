<?php
// Incluir archivo de conexión a la base de datos
include('../config/db.php');

try {
    // Preparar y ejecutar la consulta para obtener los pedidos
    $sql = "SELECT * FROM pedido";
    $resultado = $conexion->query($sql);

    // Verificar si se obtuvieron resultados
    if (!$resultado) {
        echo "<p>No se encontraron pedidos.</p>";
    }

} catch (mysqli_sql_exception $e) {
    // Manejar errores de conexión o consulta
    echo "<p style='color: red;'>Error al consultar los pedidos: " . htmlspecialchars($e->getMessage()) . "</p>";
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Estado del Pedido - COPAPA</title>

    <?php include('tailwind.php'); ?>

    <style>
        /* Fondo de pantalla personalizado */
        body {
            background-image: url('/Proyecto_gaes_copapa/Proyecto_gaes_copapa/img/estado_de_pedidos.png');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            height: 100vh; /* Altura de la pantalla completa */
            margin: 0;
        }
    </style>
</head>
<body class="flex items-center justify-center min-h-screen">
    <div class="bg-white bg-opacity-80 p-8 rounded-lg shadow-lg w-full max-w-5xl">
        <h1 class="text-3xl font-bold mb-6 text-center text-cafe">Estado de tus Pedidos</h1>

        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-gris rounded-lg shadow-md">
                <thead class="bg-cafe text-white">
                    <tr>
                        <th class="py-3 px-4 border border-gris">ID Pedido</th>
                        <th class="py-3 px-4 border border-gris">Producto</th>
                        <th class="py-3 px-4 border border-gris">Fecha de Pedido</th>
                        <th class="py-3 px-4 border border-gris">ID Cliente</th>
                        <th class="py-3 px-4 border border-gris">Dirección</th>
                        <th class="py-3 px-4 border border-gris">Cantidad</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Recorrer los resultados con mysqli_fetch_assoc
                    while ($fila = mysqli_fetch_assoc($resultado)) {
                        echo "<tr class='border border-gris'>";
                        echo "<td class='py-2 px-4'>" . htmlspecialchars($fila['Pedido_Id']) . "</td>";
                        echo "<td class='py-2 px-4'>" . htmlspecialchars($fila['producto']) . "</td>";
                        echo "<td class='py-2 px-4'>" . htmlspecialchars($fila['fecha']) . "</td>";
                        echo "<td class='py-2 px-4'>" . htmlspecialchars($fila['Cliente_Id']) . "</td>";
                        echo "<td class='py-2 px-4'>" . htmlspecialchars($fila['direccion_envio']) . "</td>";
                        echo "<td class='py-2 px-4'>" . htmlspecialchars($fila['cantidad']) . "</td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
