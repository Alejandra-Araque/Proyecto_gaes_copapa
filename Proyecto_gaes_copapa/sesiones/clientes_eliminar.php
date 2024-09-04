<?php
// Incluir el archivo de conexión principal
include('conexion.php'); 

// Verificar si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener y sanitizar el ID del cliente
    $cliente_id = intval($_POST['id']);

    // Preparar la consulta SQL para eliminar el cliente
    $sql = "DELETE FROM clientes WHERE id = ?";

    // Preparar la declaración
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("i", $cliente_id);

        // Ejecutar la consulta
        if ($stmt->execute()) {
            echo "<p style='color: green;'>Cliente eliminado correctamente.</p>";
        } else {
            echo "<p style='color: red;'>Error eliminando cliente: " . $conn->error . "</p>";
        }

        // Cerrar la declaración
        $stmt->close();
    } else {
        echo "<p style='color: red;'>Error preparando la consulta: " . $conn->error . "</p>";
    }

    // Cerrar la conexión
    $conn->close();
}

// Obtener la lista de clientes para mostrar en el formulario
$clientes = $conn->query("SELECT id, nombre FROM clientes")->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eliminar Cliente</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="formularios">
        <h2>Eliminar Cliente</h2>
        <form method="POST" action="clientes_eliminar.php">
            <div class="contenedor-inputs">
                <label for="id">Cliente:</label>
                <select id="id" name="id" required>
                    <option value="">Seleccione un cliente</option>
                    <?php foreach ($clientes as $cliente): ?>
                        <option value="<?php echo $cliente['id']; ?>"><?php echo htmlspecialchars($cliente['nombre']); ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <button type="submit">Eliminar Cliente</button>
        </form>
    </div>
</body>
</html>
