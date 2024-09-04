<?php
// Incluir el archivo de conexión principal
include('conexion.php'); // Asegúrate de que la ruta sea correcta

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener y sanitizar los datos del formulario
    $cliente_id = intval($_POST['id']);
    $nombre = htmlspecialchars($_POST['nombre']);
    $email = htmlspecialchars($_POST['email']);
    $telefono = htmlspecialchars($_POST['telefono']);

    // Preparar la consulta SQL
    $sql = "UPDATE clientes SET nombre=?, email=?, telefono=? WHERE id=?";

    // Preparar la declaración
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("sssi", $nombre, $email, $telefono, $cliente_id);

        // Ejecutar la consulta
        if ($stmt->execute()) {
            echo "<p style='color: green;'>Cliente actualizado correctamente.</p>";
        } else {
            echo "<p style='color: red;'>Error actualizando cliente: " . $conn->error . "</p>";
        }

        // Cerrar la declaración
        $stmt->close();
    } else {
        echo "<p style='color: red;'>Error preparando la consulta: " . $conn->error . "</p>";
    }

    // Cerrar la conexión
    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualizar Cliente</title>
    <link rel="stylesheet" href="styles.css"> <!-- Asegúrate de que la ruta sea correcta -->
</head>
<body>
    <header class="header-main">
        <h1>Actualizar Cliente</h1>
    </header>
    <div class="contenido">
        <div class="formularios">
            <form method="POST" action="cliente_update.php">
                <div class="contenedor-inputs">
                    <label for="id">ID del Cliente:</label>
                    <input type="number" id="id" name="id" required>
                </div>
                <div class="contenedor-inputs">
                    <label for="nombre">Nombre:</label>
                    <input type="text" id="nombre" name="nombre" required>
                </div>
                <div class="contenedor-inputs">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" required>
                </div>
                <div class="contenedor-inputs">
                    <label for="telefono">Teléfono:</label>
                    <input type="text" id="telefono" name="telefono" required>
                </div>
                <button type="submit">Actualizar</button>
            </form>
        </div>
    </div>
    <footer class="footer-main">
        <p>&copy; 2024 COPAPA. Todos los derechos reservados.</p>
    </footer>
</body>
</html>


