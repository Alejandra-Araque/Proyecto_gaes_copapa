<?php include('tailwind.php'); ?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contacto - COPAPA</title>
    <style>
        body {
            background-image: url('https://github.com/Alejandra-Araque/Proyecto_gaes_copapa/blob/main/Proyecto_gaes_copapa/img/contacto.png'); 
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            height: 100vh; /* Altura de la pantalla completa */
            margin: 0;
        }
    </style>
</head>
<body class="flex items-center justify-center h-full">
    <div class="bg-white bg-opacity-80 p-8 rounded-lg shadow-lg w-full max-w-lg">
        <h1 class="text-3xl font-bold mb-6 text-center text-cafe">Contáctanos</h1>
        <form method="POST" action="enviar_contacto.php" class="space-y-4">
            <div>
                <label for="nombre" class="block text-lg font-medium text-gris">Nombre:</label>
                <input type="text" id="nombre" name="nombre" required class="mt-1 block w-full px-4 py-2 border border-gris rounded-md shadow-sm focus:outline-none focus:ring focus:ring-verdeClaro focus:border-verde">
            </div>

            <div>
                <label for="email" class="block text-lg font-medium text-gris">Correo Electrónico:</label>
                <input type="email" id="email" name="email" required class="mt-1 block w-full px-4 py-2 border border-gris rounded-md shadow-sm focus:outline-none focus:ring focus:ring-verdeClaro focus:border-verde">
            </div>

            <div>
                <label for="mensaje" class="block text-lg font-medium text-gris">Mensaje:</label>
                <textarea id="mensaje" name="mensaje" required rows="4" class="mt-1 block w-full px-4 py-2 border border-gris rounded-md shadow-sm focus:outline-none focus:ring focus:ring-verdeClaro focus:border-verde"></textarea>
            </div>

            <div class="text-center">
                <button type="submit" class="w-full py-2 px-4 bg-verde text-white font-semibold rounded-md shadow-sm hover:bg-verdeClaro focus:outline-none focus:ring-2 focus:ring-verdeClaro focus:ring-opacity-75">Enviar Mensaje</button>
            </div>
        </form>
    </div>
</body>
</html>
