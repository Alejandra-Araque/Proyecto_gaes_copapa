<?php
// Incluir archivo de conexión a la base de datos
include('config/db.php');

try {
    // Preparar y ejecutar la consulta para obtener los pedidos
    $sql = "SELECT * FROM pedidos";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();

    // Obtener los resultados
    $pedidos = $stmt->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
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


    <?php includes('tailwind.php'); ?>

    <style>
        /* Fondo de pantalla personalizado */
        body {
            background-image: url('https://github.com/Alejandra-Araque/Proyecto_gaes_copapa/blob/main/Proyecto_gaes_copapa/img/estado%20de%20pedidos.png');
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
                        <th class="py-3 px-4 border border-gris">Cantidad</th>
                        <th class="py-3 px-4 border border-gris">Dirección de Envío</th>
                        <th class="py-3 px-4 border border-gris">Estado</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Ejemplo de conexión y consulta a base de datos
                    // Asegúrate de incluir la conexión y manejar errores adecuadamente.
                    while ($fila = mysqli_fetch_assoc($resultado)) {
                        echo "<tr class='border border-gris'>";
                        echo "<td class='py-2 px-4'>" . htmlspecialchars($fila['id']) . "</td>";
                        echo "<td class='py-2 px-4'>" . htmlspecialchars($fila['producto']) . "</td>";
                        echo "<td class='py-2 px-4'>" . htmlspecialchars($fila['cantidad']) . "</td>";
                        echo "<td class='py-2 px-4'>" . htmlspecialchars($fila['direccion_envio']) . "</td>";
                        echo "<td class='py-2 px-4'>" . htmlspecialchars($fila['estado']) . "</td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
