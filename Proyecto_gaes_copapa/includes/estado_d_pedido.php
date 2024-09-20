<?php
// Incluir archivo de conexión a la base de datos
include('conexion.php');

// Consulta para obtener los pedidos
$sql = "SELECT * FROM pedidos";
$resultado = mysqli_query($conexion, $sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Estado del Pedido - COPAPA</title>
</head>
<body>
    <h1>Estado de tus Pedidos</h1>

    <table border="1">
        <thead>
            <tr>
                <th>ID Pedido</th>
                <th>Producto</th>
                <th>Cantidad</th>
                <th>Dirección de Envío</th>
                <th>Estado</th>
            </tr>
        </thead>
        <tbody>
            <?php
            while ($fila = mysqli_fetch_assoc($resultado)) {
                echo "<tr>";
                echo "<td>" . $fila['id'] . "</td>";
                echo "<td>" . $fila['producto'] . "</td>";
                echo "<td>" . $fila['cantidad'] . "</td>";
                echo "<td>" . $fila['direccion_envio'] . "</td>";
                echo "<td>" . $fila['estado'] . "</td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
</body>
</html>
