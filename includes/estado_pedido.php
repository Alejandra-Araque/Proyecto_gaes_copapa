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
        /* Fondo de pantalla personalizado con scroll */
        body {
            background-image: url('https://tradepallet.com/wp-content/uploads/2022/11/como-vender-m%C3%A1s-fruta-y-verduras.jpg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            height: 100%;
            margin: 0;
            overflow: auto;
        }

        .header-main {
            text-align: center;
            margin-bottom: 20px;
        }

        h1 {
            color: white; /* Título en blanco */
            font-size: 150px; /* Ajusta el tamaño del título aquí */
            font-weight: bold; /* Asegúrate de que esté en negrita */
            text-transform: uppercase; /* Texto en mayúsculas */
            margin-bottom: 20px; /* Espacio entre el título y el logo */
        }
 

        .logo {
            margin-top: 10px;
            width: 150px; /* Tamaño más grande del logo */
            display: block;
            margin-left: auto;
            margin-right: auto; /* Centramos el logo */
        }

        .table-container {
            background-color: rgba(139, 69, 19, 0.5); /* Fondo café transparente al 50% */
            padding: 20px;
            border-radius: 12px;
        }

        table {
            width: 100%;
            color: white;
            border-collapse: collapse;
        }

        th, td {
            padding: 10px;
            text-align: center;
            border: 1px solid white;
        }

        th {
            background-color: rgba(139, 69, 19, 0.8);
        }

        td {
            background-color: rgba(139, 69, 19, 0.5);
        }

        /* Botón circular para el estado del pedido */
        .estado-pedido {
            width: 20px;
            height: 20px;
            border-radius: 50%;
            display: inline-block;
        }

        .estado-activo {
            background-color: green;
        }

        .estado-transito {
            background-color: green;
        }

        .estado-empacando {
            background-color: yellow;
        }

        .estado-cancelado {
            background-color: red;
        }
    </style>
</head>
<body class="flex items-center justify-center min-h-screen">
    <!-- Contenedor principal -->
    <div class="w-full max-w-5xl">
        <div class="header-main">
            <h1>Estado de tus Pedidos</h1>
            <img src="https://github.com/Alejandra-Araque/Proyecto_gaes_copapa/blob/main/img/copapa.png?raw=true" alt="Logo COPAPA" class="logo">
        </div>

        <div class="table-container">
            <div class="overflow-x-auto">
                <table class="min-w-full">
                    <thead>
                        <tr>
                            <th>ID Pedido</th>
                            <th>Producto</th>
                            <th>Fecha de Pedido</th>
                            <th>ID Cliente</th>
                            <th>Dirección</th>
                            <th>Cantidad</th>
                            <th>Estado</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Recorrer los resultados con mysqli_fetch_assoc
                        while ($fila = mysqli_fetch_assoc($resultado)) {
                            $estados = ['En tránsito', 'Empacando', 'Activo', 'Cancelado'];
                            $estado_aleatorio = $estados[array_rand($estados)];

                            $estado_clase = '';
                            switch ($estado_aleatorio) {
                                case 'En tránsito':
                                    $estado_clase = 'estado-transito';
                                    break;
                                case 'Empacando':
                                    $estado_clase = 'estado-empacando';
                                    break;
                                case 'Activo':
                                    $estado_clase = 'estado-activo';
                                    break;
                                case 'Cancelado':
                                    $estado_clase = 'estado-cancelado';
                                    break;
                            }

                            echo "<tr>";
                            echo "<td>" . htmlspecialchars($fila['Pedido_Id']) . "</td>";
                            echo "<td>" . htmlspecialchars($fila['producto']) . "</td>";
                            echo "<td>" . htmlspecialchars($fila['fecha']) . "</td>";
                            echo "<td>" . htmlspecialchars($fila['Cliente_Id']) . "</td>";
                            echo "<td>" . htmlspecialchars($fila['direccion_envio']) . "</td>";
                            echo "<td>" . htmlspecialchars($fila['cantidad']) . "</td>";
                            echo "<td><span class='estado-pedido " . $estado_clase . "'></span> " . $estado_aleatorio . "</td>";
                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>



