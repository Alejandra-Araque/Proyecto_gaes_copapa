<?php
require '../config/db.php';

// Consulta SQL corregida para obtener los datos correctamente
$sql = "SELECT f.ID_Factura, f.Fecha_Factura, c.ID_Cliente, f.ID_Campesino, f.Valor_Compra, f.Descuento_Compra, f.Iva_Compra, f.Tipopago_compra
        FROM factura f
        JOIN cliente c ON f.ID_Cliente = c.ID_Cliente
        JOIN campesino ca ON f.ID_Campesino = ca.ID_Campesino"; // Ajusta según tus tablas reales
        
$stmt = $pdo->query($sql);
$resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo "<h1>Lista de Facturas</h1>";
echo "<a href='../vistas/crear_factura.php'>Crear Nueva Factura</a><br><br>"; // Enlace para crear una nueva factura
echo "<table border='1'>
        <tr>
            <th>ID Factura</th>
            <th>Fecha</th>
            <th>Cliente</th>
            <th>Campesino</th>
            <th>Valor Total</th>
            <th>Iva Compra</th>
            <th>Descuentos</th>
            <th>Tipo Pago</th>
            <th>Acciones</th>
        </tr>";

// Iterar sobre el resultado y mostrar las filas en la tabla
foreach ($resultado as $fila) {
    $idFac = htmlspecialchars($fila['ID_Factura']); 
    $nomCli = htmlspecialchars($fila['ID_Cliente']);
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
            <td>" . $valorTotal . "€</td>
            <td>" . $ivaCompra . "€</td>
            <td>" . $descuCompra . "€</td>
            <td>" . $tipoPago . "</td>
            <td>
                <a href='../vistas/factura_update.php?id=" . $idFac . "'>Editar</a> |
                <a href='../sesiones/factura_eliminar.php?Id_fac=" . $idFac . "' onclick=\"return confirm('¿Estás seguro?')\">Eliminar</a>
            </td>
          </tr>";
}
echo "</table>";
?>
