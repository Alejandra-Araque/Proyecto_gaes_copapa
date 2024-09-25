<?php
// Incluir el archivo de conexión principal
include('../config/db.php');

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
    <?php include "../includes/tailwind.php" ?>
</head>
<body class="bg-beige">
    <div class="w-full flex flex-col items-center py-10">
        <div class="w-8/12 md:w-2/4 lg:w-1/3 xl:w-1/4">
            <h2 class="text-center mb-5 text-gris font-bold text-3xl">Eliminar Factura</h2>
            
            <?php if (isset($mensaje)) echo $mensaje; ?>
            
            <form method="POST" action="factura_eliminar.php">
                <div class="flex justify-between mb-2">
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
                    <button class="text-xl mx-auto block h-12 bg-cafe text-white w-40 my-4 rounded-md hover:bg-cafeClaro hover:border-2 hover:border-cafe" type="submit">Eliminar Factura</button>
                </form>
        </div>
    </div>
</body>
</html>
