<?php include('tailwind.php'); ?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contacto - COPAPA</title>
    <style>
        body {
            background-image: url('https://www.minagricultura.gov.co/noticias/PublishingImages/agro-tecnologia-980.jpg'); 
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            height: 100vh; /* Altura de la pantalla completa */
            margin: 0;
        }

        .bg-custom {
            background-color: rgba(139, 69, 19, 0.5); /* Color café transparente */
        }

        h1 {
            color: black; /* Título en negro */
        }

        .label {
            color: white; /* Color blanco para los títulos de los campos */
        }
    </style>
</head>
<body class="flex items-center justify-center h-full">
    <div class="bg-custom bg-opacity-80 p-8 rounded-lg shadow-lg w-full max-w-lg">
        <h1 class="text-3xl font-bold mb-6 text-center">Contáctanos</h1>
        
        <img src="https://github.com/Alejandra-Araque/Proyecto_gaes_copapa/blob/main/img/copapa.png?raw=true" alt="Logo de COPAPA" class="mx-auto mb-4" style="width: 150px; height: auto;"> <!-- Reemplaza con la URL correcta de tu logo -->

        <form method="POST" action="enviar_contacto.php" class="space-y-4" onsubmit="return enviarMensaje();">
            <div>
                <label for="nombre" class="block text-lg font-medium label">Nombre:</label>
                <input type="text" id="nombre" name="nombre" required class="mt-1 block w-full px-4 py-2 border border-gris rounded-md shadow-sm focus:outline-none focus:ring focus:ring-verdeClaro focus:border-verde">
            </div>

            <div>
                <label for="email" class="block text-lg font-medium label">Correo Electrónico:</label>
                <input type="email" id="email" name="email" required class="mt-1 block w-full px-4 py-2 border border-gris rounded-md shadow-sm focus:outline-none focus:ring focus:ring-verdeClaro focus:border-verde">
            </div>

            <div>
                <label for="mensaje" class="block text-lg font-medium label">Mensaje:</label>
                <textarea id="mensaje" name="mensaje" required rows="4" class="mt-1 block w-full px-4 py-2 border border-gris rounded-md shadow-sm focus:outline-none focus:ring focus:ring-verdeClaro focus:border-verde"></textarea>
            </div>

            <div class="text-center">
                <button type="submit" class="w-full py-2 px-4 bg-verde text-white font-semibold rounded-md shadow-sm hover:bg-verdeClaro focus:outline-none focus:ring-2 focus:ring-verdeClaro focus:ring-opacity-75">Enviar Mensaje</button>
            </div>
        </form>
    </div>

    <script>
        function enviarMensaje() {
            // Simula el envío del mensaje y muestra una alerta
            alert("¡Mensaje enviado! Nos pondremos en contacto contigo pronto.");
            // Se puede redirigir a otra página si se desea
            // window.location.href = 'pagina_de_confirmacion.php';
            return false; // Evita el envío del formulario para propósitos de demostración
        }
    </script>
</body>
</html>

