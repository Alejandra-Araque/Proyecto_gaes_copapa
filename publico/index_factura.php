<?php
require '../config/db.php';

// Consulta SQL corregida para obtener los datos correctamente
$sql = "SELECT f.ID_Factura, f.Fecha_Factura, c.Nombre_Cliente, f.ID_Campesino, f.Valor_Compra, f.Descuento_Compra, f.Iva_Compra, f.Tipopago_compra
        FROM factura f
        JOIN cliente c ON f.ID_Cliente = c.ID_Cliente
        JOIN campesino ca ON f.ID_Campesino = ca.ID_Campesino"; // Ajusta según tus tablas reales
        
$stmt = $pdo->query($sql);
$resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Facturas - COPAPA</title>
    <?php include('../includes/tailwind.php'); ?>

    <style>
        body {
            background-color: #f9fafb; /* Color de fondo suave */
            font-family: 'Arial', sans-serif;
        }
        .container {
            max-width: 900px;
            margin: 30px auto;
            padding: 20px;
            background: white;
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }
        h1 {
            color: #800080; /* Título en color morado */
            text-align: center;
            margin-bottom: 20px;
            font-size: 2rem;
            font-weight: bold;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 10px;
            text-align: left;
            border: 1px solid #ddd; /* Borde de las celdas */
        }
        th {
            background-color: #800080; /* Fondo de encabezado morado */
            color: white; /* Texto blanco */
        }
        tr:nth-child(even) {
            background-color: #f2f2f2; /* Filas alternas en gris claro */
        }
        tr:hover {
            background-color: #eaeaea; /* Efecto al pasar el mouse */
        }
        .acciones a {
            margin-right: 10px;
            text-decoration: none;
            color: #ffffff;
            background-color: #4CAF50; /* Botón verde */
            padding: 5px 10px;
            border-radius: 5px;
            transition: background-color 0.3s;
        }
        .acciones a:hover {
            background-color: #45a049; /* Verde más oscuro al pasar el mouse */
        }
        .crear-factura {
            display: inline-block;
            margin-bottom: 20px;
            padding: 10px 15px;
            background-color: #800080; /* Fondo morado */
            color: white; /* Texto blanco */
            border-radius: 5px;
            text-decoration: none;
        }
        .crear-factura:hover {
            background-color: #700070; /* Fondo más oscuro al pasar el mouse */
        }
    </style>
</head>
<body>

    <div class="container">
        <h1>Lista de Facturas</h1>
        <a href="../sesiones/crear_factura.php" class="crear-factura">Crear Nueva Factura</a>

        <table>
            <thead>
                <tr>
                    <th>ID Factura</th>
                    <th>Fecha</th>
                    <th>Cliente</th>
                    <th>Campesino</th>
                    <th>Valor Total (€)</th>
                    <th>Iva Compra (€)</th>
                    <th>Descuentos (€)</th>
                    <th>Tipo Pago</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Iterar sobre el resultado y mostrar las filas en la tabla
                foreach ($resultado as $fila) {
                    $idFac = htmlspecialchars($fila['ID_Factura']); 
                    $nomCli = htmlspecialchars($fila['Nombre_Cliente']);
                    $nomCam = htmlspecialchars($fila['ID_Campesino']);
                    $fecFac = htmlspecialchars($fila['Fecha_Factura']);
                    $valorTotal = htmlspecialchars($fila['Valor_Compra']);
                    $descuCompra = htmlspecialchars($fila['Descuento_Compra']);
                    $ivaCompra = htmlspecialchars($fila['Iva_Compra']);
                    $tipoPago = htmlspecialchars($fila['Tipopago_compra']);

                    echo "<tr>
                            <td>" . $idFac . "</td>
                            <td>" . $fecFac . "</td>
                            <td>" . $nomCli . "</td>
                            <td>" . $nomCam . "</td>
                            <td>" . $valorTotal . " €</td>
                            <td>" . $ivaCompra . " €</td>
                            <td>" . $descuCompra . " €</td>
                            <td>" . $tipoPago . "</td>
                            <td class='acciones'>
                                <a href='../sesiones/factura_update.php?id=" . $idFac . "'>Editar</a> |
                                <a href='../sesiones/factura_eliminar.php?Id_fac=" . $idFac . "' onclick=\"return confirm('¿Estás seguro?')\">Eliminar</a>
                            </td>
                          </tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

</body>
</html>

