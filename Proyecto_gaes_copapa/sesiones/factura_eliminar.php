<?php
// Incluir el archivo de conexión principal
include('conexion.php');

// Verificar si se ha enviado una solicitud POST para eliminar una factura
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener el ID de la factura desde el formulario y sanitizarlo
    $idFactura = intval($_POST['id_factura']);

    // Preparar la consulta SQL para eliminar la factura
    $sql = "DELETE FROM factura WHERE ID_Factura = ?";

    // Preparar la declaración
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("i", $idFactura);

        // Ejecutar la consulta
        if ($stmt->execute()) {
            $mensaje = "<p style='color: green;'>Factura eliminada correctamente.</p>";
        } else {
            $mensaje = "<p style='color: red;'>Error eliminando la factura: " . $conn->error . "</p>";
        }

        // Cerrar la declaración
        $stmt->close();
    } else {
        $mensaje = "<p style='color: red;'>Error preparando la consulta: " . $conn->error . "</p>";
    }

    // Cerrar la conexión
    $conn->close();
}

// Obtener todas las facturas para mostrarlas en un desplegable
$facturas = $conn->query("SELECT ID_Factura, Fecha_Factura FROM factura")->fetch_all(MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eliminar Factura</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="contenedor-principal">
        <h2>Eliminar Factura</h2>

        <?php if (isset($mensaje)) echo $mensaje; ?>

        <form method="POST" action="factura_eliminar.php">
            <div class="contenedor-inputs">
                <label for="id_factura">Seleccionar Factura:</label>
                <select id="id_factura" name="id_factura" required>
                    <option value="">Seleccione una factura</option>
                    <?php foreach ($facturas as $factura): ?>
                        <option value="<?php echo $factura['ID_Factura']; ?>">
                            <?php echo "Factura #" . $factura['ID_Factura'] . " - " . $factura['Fecha_Factura']; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <button type="submit">Eliminar Factura</button>
        </form>
    </div>
</body>
</html>
