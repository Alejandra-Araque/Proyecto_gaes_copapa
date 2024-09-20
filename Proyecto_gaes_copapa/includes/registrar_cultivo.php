<?php
// Incluir archivo de conexión a la base de datos
include('conexion.php');

// Procesar el formulario al enviar
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'];
    $tipo = $_POST['tipo'];
    $fecha_plantacion = $_POST['fecha_plantacion'];

    $sql = "INSERT INTO cultivos (nombre, tipo, fecha_plantacion) VALUES ('$nombre', '$tipo', '$fecha_plantacion')";

    if (mysqli_query($conexion, $sql)) {
        echo "Cultivo registrado correctamente.";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conexion);
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Cultivo - COPAPA</title>
</head>
<body>
    <h1>Registrar Nuevo Cultivo</h1>
    <form method="POST">
        <label for="nombre">Nombre del Cultivo:</label><br>
        <input type="text" id="nombre" name="nombre" required><br>

        <label for="tipo">Tipo de Papa:</label><br>
        <input type="text" id="tipo" name="tipo" required><br>

        <label for="fecha_plantacion">Fecha de Plantación:</label><br>
        <input type="date" id="fecha_plantacion" name="fecha_plantacion" required><br><br>

        <button type="submit">Registrar Cultivo</button>
    </form>
</body>
</html>
