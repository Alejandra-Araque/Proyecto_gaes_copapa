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

    <?php includes('tailwind.php'); ?>
    
    <style>
        body {
            background-image: url('https://github.com/Alejandra-Araque/Proyecto_gaes_copapa/blob/main/Proyecto_gaes_copapa/img/registro%20cultivo.png'); 
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            height: 100vh;
            margin: 0;
        }
    </style>
</head>
<body class="flex items-center justify-center h-screen">

    <div class="bg-white bg-opacity-80 p-8 rounded-lg shadow-lg w-full max-w-md">
        <h1 class="text-2xl font-bold mb-6 text-center text-cafe">Registrar Nuevo Cultivo</h1>
        <form method="POST" class="space-y-4">
            <div>
                <label for="nombre" class="block text-lg font-medium text-gris">Nombre del Cultivo</label>
                <input type="text" id="nombre" name="nombre" required class="mt-1 block w-full px-4 py-2 border border-gris rounded-md shadow-sm focus:outline-none focus:ring focus:ring-verdeClaro focus:border-verde">
            </div>
            <div>
                <label for="tipo" class="block text-lg font-medium text-gris">Tipo de Papa</label>
                <input type="text" id="tipo" name="tipo" required class="mt-1 block w-full px-4 py-2 border border-gris rounded-md shadow-sm focus:outline-none focus:ring focus:ring-verdeClaro focus:border-verde">
            </div>
            <div>
                <label for="fecha_plantacion" class="block text-lg font-medium text-gris">Fecha de Plantación</label>
                <input type="date" id="fecha_plantacion" name="fecha_plantacion" required class="mt-1 block w-full px-4 py-2 border border-gris rounded-md shadow-sm focus:outline-none focus:ring focus:ring-verdeClaro focus:border-verde">
            </div>
            <div class="text-center">
                <button type="submit" class="w-full py-2 px-4 bg-verde text-white font-semibold rounded-md shadow-sm hover:bg-verdeClaro focus:outline-none focus:ring-2 focus:ring-verdeClaro focus:ring-opacity-75">Registrar Cultivo</button>
            </div>
        </form>
    </div>

</body>
</html>
