<?php
// Incluir el archivo de conexión principal
require ('conexion.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener y sanitizar los datos del formulario
    $idCliente = intval($_POST['id_cliente']);
    $idCampesino = intval($_POST['id_campesino']);
    $fechaFactura = $_POST['fecha_factura'];
    $valorCompra = floatval($_POST['valor_compra']);
    $descuentoCompra = floatval($_POST['descuento_compra']);
    $ivaCompra = floatval($_POST['iva_compra']);
    $tipoPago = htmlspecialchars($_POST['tipo_pago']);

    // Preparar la consulta SQL
    $sql = "INSERT INTO factura (ID_Cliente, ID_Campesino, Fecha_Factura, Valor_Compra, Descuento_Compra, Iva_Compra, Tipopago_compra)
            VALUES (?, ?, ?, ?, ?, ?, ?)";

    // Preparar la declaración
    if ($stmt = $pdo->prepare($sql)) {
        $stmt->bind_param("iisssss", $idCliente, $idCampesino, $fechaFactura, $valorCompra, $descuentoCompra, $ivaCompra, $tipoPago);

        // Ejecutar la consulta
        if ($stmt->execute()) {
            echo "<p class='success-message'>Factura creada correctamente.</p>";
        } else {
            echo "<p class='error-message'>Error creando factura: " . $pdo->error . "</p>";
        }

        // Cerrar la declaración
        $stmt->close();
    } else {
        echo "<p class='error-message'>Error preparando la consulta: " . $pdo->error . "</p>";
    }
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
    <title>Crear Factura</title>
    <link rel="stylesheet" href="../css/styles.css"> <!-- Asegúrate de que la ruta sea correcta -->
</head>
<body>
    <header class="header-main">
        <h1>Crear Factura</h1>
    </header>
    <div class="contenido">
        <div class="formularios">
            <form method="POST" action="crear_factura.php">
                <div class="contenedor-inputs">
                    <label for="id_cliente">Cliente:</label>
                    <select id="id_cliente" name="id_cliente" required>
                        <option value="">Seleccione un cliente</option>
                        <?php foreach ($clientes as $cliente): ?>
                            <option value="<?php echo htmlspecialchars($cliente['ID_Cliente']); ?>"><?php echo htmlspecialchars($cliente['Nombre']); ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="contenedor-inputs">
                    <label for="id_campesino">Campesino:</label>
                    <select id="id_campesino" name="id_campesino" required>
                        <option value="">Seleccione un campesino</option>
                        <?php foreach ($campesinos as $campesino): ?>
                            <option value="<?php echo htmlspecialchars($campesino['ID_Campesino']); ?>"><?php echo htmlspecialchars($campesino['Nombre']); ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="contenedor-inputs">
                    <label for="fecha_factura">Fecha de la Factura:</label>
                    <input type="date" id="fecha_factura" name="fecha_factura" required>
                </div>
                <div class="contenedor-inputs">
                    <label for="valor_compra">Valor Compra:</label>
                    <input type="number" step="0.01" id="valor_compra" name="valor_compra" required>
                </div>
                <div class="contenedor-inputs">
                    <label for="descuento_compra">Descuento Compra:</label>
                    <input type="number" step="0.01" id="descuento_compra" name="descuento_compra" required>
                </div>
                <div class="contenedor-inputs">
                    <label for="iva_compra">IVA Compra:</label>
                    <input type="number" step="0.01" id="iva_compra" name="iva_compra" required>
                </div>
                <div class="contenedor-inputs">
                    <label for="tipo_pago">Tipo de Pago:</label>
                    <input type="text" id="tipo_pago" name="tipo_pago" required>
                </div>
                <button type="submit">Crear Factura</button>
            </form>
        </div>
    </div>
</body>
</html>
