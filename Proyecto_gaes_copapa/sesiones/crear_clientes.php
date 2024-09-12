<?php
// Incluir el archivo de conexión principal
include('../config/db.php');

// Procesar el formulario al enviar
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $conn->real_escape_string($_POST['nombre']);
    $email = $conn->real_escape_string($_POST['email']);
    $telefono = $conn->real_escape_string($_POST['telefono']);

    $sql = "INSERT INTO clientes (nombre, email, telefono) VALUES ('$nombre', '$email', '$telefono')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Nuevo cliente creado exitosamente');</script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Nuevo Cliente - COPAPA</title>
    <?php include "../includes/tailwind.php"; ?>
</head>
<body class="bg-beige">
    <div class="w-full flex flex-col items-center py-10">
        <div class="w-8/12 md:w-2/4 lg:w-1/3 xl:w-1/4">        
            <h2 class="text-center mb-5 text-gris font-bold text-3xl">Crear Nuevo Cliente</h2>
            <form method="POST" action="panel_crear_clientes.php">
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
                <button class="text-xl mx-auto block h-12 bg-cafe text-white w-40 my-4 rounded-md hover:bg-cafeClaro hover:border-2 hover:border-cafe" type="submit">Crear Cliente</button>
            </form>
        </div>
    </div>
</body>
</html>
