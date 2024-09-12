<?php
// Incluir el archivo de conexión principal
include('../config/db.php'); // Asegúrate de que la ruta sea correcta

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
    <?php include "../includes/tailwind.php" ?>
</head>
<body class="bg-beige">
    <header class="header-main">
        <h1 class="mt-8 text-center mb-5 text-gris font-bold text-3xl">Actualizar Cliente</h1>
    </header>
    <div class="w-full flex flex-col items-center py-10">
        <div class="w-8/12 md:w-2/4 lg:w-1/3 xl:w-1/4">
            <form method="POST" action="cliente_update.php">
                <div class="flex justify-between mb-2">
                    <label for="id">ID del Cliente:</label>
                    <input class="w-60 h-8 rounded border-2 border-cafe" type="number" id="id" name="id" required>
                </div>
                <div class="flex justify-between mb-2">
                    <label for="nombre">Nombre:</label>
                    <input class="w-60 h-8 rounded border-2 border-cafe" type="text" id="nombre" name="nombre" required>
                </div>
                <div class="flex justify-between mb-2">
                    <label for="email">Email:</label>
                    <input class="w-60 h-8 rounded border-2 border-cafe" type="email" id="email" name="email" required>
                </div>
                <div class="flex justify-between mb-2">
                    <label for="telefono">Teléfono:</label>
                    <input class="w-60 h-8 rounded border-2 border-cafe" type="text" id="telefono" name="telefono" required>
                </div>
                <button class="text-xl mx-auto block h-12 bg-cafe text-white w-40 my-4 rounded-md hover:bg-cafeClaro hover:border-2 hover:border-cafe" type="submit">Actualizar</button>
            </form>
        </div>
    </div>
</body>
</html>


