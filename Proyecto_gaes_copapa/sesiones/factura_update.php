<?php
require ('config/db.php'); // Asegúrate de que la ruta sea correcta

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener y sanitizar los datos del formulario
    $idFactura = intval($_POST['id_factura']);
    $idCliente = intval($_POST['id_cliente']);
    $idCampesino = intval($_POST['id_campesino']);
    $fechaFactura = $_POST['fecha_factura'];
    $valorCompra = floatval($_POST['valor_compra']);
    $descuentoCompra = floatval($_POST['descuento_compra']);
    $ivaCompra = floatval($_POST['iva_compra']);
    $tipoPago = htmlspecialchars($_POST['tipo_pago']);

    // Preparar la consulta SQL para actualizar la factura
    $sql = "UPDATE factura SET ID_Cliente=?, ID_Campesino=?, Fecha_Factura=?, Valor_Compra=?, Descuento_Compra=?, Iva_Compra=?, Tipopago_compra=?
            WHERE ID_Factura=?";

    // Preparar la declaración
    if ($stmt = $pdo->prepare($sql)) {
        $stmt->bindParam(1, $idCliente, PDO::PARAM_INT);
        $stmt->bindParam(2, $idCampesino, PDO::PARAM_INT);
        $stmt->bindParam(3, $fechaFactura, PDO::PARAM_STR);
        $stmt->bindParam(4, $valorCompra, PDO::PARAM_STR);
        $stmt->bindParam(5, $descuentoCompra, PDO::PARAM_STR);
        $stmt->bindParam(6, $ivaCompra, PDO::PARAM_STR);
        $stmt->bindParam(7, $tipoPago, PDO::PARAM_STR);
        $stmt->bindParam(8, $idFactura, PDO::PARAM_INT);

        // Ejecutar la consulta
        if ($stmt->execute()) {
            echo "<p style='color: green;'>Factura actualizada correctamente.</p>";
        } else {
            echo "<p style='color: red;'>Error actualizando factura: " . $pdo->errorInfo()[2] . "</p>";
        }

        // Cerrar la declaración
        $stmt->closeCursor();
    } else {
        echo "<p style='color: red;'>Error preparando la consulta: " . $pdo->errorInfo()[2] . "</p>";
    }
}

// Obtener datos de la factura a editar
$idFactura = intval($_GET['id']);
$sql = "SELECT * FROM factura WHERE ID_Factura=?";
if ($stmt = $pdo->prepare($sql)) {
    $stmt->bindParam(1, $idFactura, PDO::PARAM_INT);
    $stmt->execute();
    $factura = $stmt->fetch(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
}

// Obtener clientes y campesinos para los desplegables
$clientes = $pdo->query("SELECT ID_Cliente, Nombre FROM cliente")->fetchAll(PDO::FETCH_ASSOC);
$campesinos = $pdo->query("SELECT ID_Campesino, Nombre FROM campesino")->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualizar Factura</title>
    <link rel="stylesheet" href="../css/styles.css"> <!-- Asegúrate de que la ruta sea correcta -->
</head>
<body>
    <header class="header-main">
        <h1>Actualizar Factura</h1>
    </header>
    <div class="contenido">
        <div class="formularios">
            <form method="POST" action="factura_update.php">
                <input type="hidden" name="id_factura" value="<?php echo htmlspecialchars($factura['ID_Factura']); ?>">
                
                <div class="contenedor-inputs">
                    <label for="id_cliente">Cliente:</label>
                    <select id="id_cliente" name="id_cliente" required>
                        <option value="">Seleccione un cliente</option>
                        <?php foreach ($clientes as $cliente): ?>
                            <option value="<?php echo htmlspecialchars($cliente['ID_Cliente']); ?>" <?php if ($cliente['ID_Cliente'] == $factura['ID_Cliente']) echo 'selected'; ?>>
                                <?php echo htmlspecialchars($cliente['Nombre']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                
                <div class="contenedor-inputs">
                    <label for="id_campesino">Campesino:</label>
                    <select id="id_campesino" name="id_campesino" required>
                        <option value="">Seleccione un campesino</option>
                        <?php foreach ($campesinos as $campesino): ?>
                            <option value="<?php echo htmlspecialchars($campesino['ID_Campesino']); ?>" <?php if ($campesino['ID_Campesino'] == $factura['ID_Campesino']) echo 'selected'; ?>>
                                <?php echo htmlspecialchars($campesino['Nombre']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                
                <div class="contenedor-inputs">
                    <label for="fecha_factura">Fecha de la Factura:</label>
                    <input type="date" id="fecha_factura" name="fecha_factura" value="<?php echo htmlspecialchars($factura['Fecha_Factura']); ?>" required>
                </div>
                
                <div class="contenedor-inputs">
                    <label for="valor_compra">Valor Compra:</label>
                    <input type="number" step="0.01" id="valor_compra" name="valor_compra" value="<?php echo htmlspecialchars($factura['Valor_Compra']); ?>" required>
                </div>
                
                <div class="contenedor-inputs">
                    <label for="descuento_compra">Descuento Compra:</label>
                    <input type="number" step="0.01" id="descuento_compra" name="descuento_compra" value="<?php echo htmlspecialchars($factura['Descuento_Compra']); ?>" required>
                </div>
                
                <div class="contenedor-inputs">
                    <label for="iva_compra">IVA Compra:</label>
                    <input type="number" step="0.01" id="iva_compra" name="iva_compra" value="<?php echo htmlspecialchars($factura['Iva_Compra']); ?>" required>
                </div>
                
                <div class="contenedor-inputs">
                    <label for="tipo_pago">Tipo de Pago:</label>
                    <input type="text" id="tipo_pago" name="tipo_pago" value="<?php echo htmlspecialchars($factura['Tipopago_compra']); ?>" required>
                </div>
                
                <button type="submit">Actualizar Factura</button>
            </form>
        </div>
    </div>
    <footer class="footer-main">
        <p>&copy; 2024 COPAPA. Todos los derechos reservados.</p>
    </footer>
</body>
</html>

