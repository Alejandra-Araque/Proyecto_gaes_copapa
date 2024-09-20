<?php
// Iniciar sesión
session_start();

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['usuario'])) {
    header('Location: login.php'); // Redirigir al usuario al formulario de inicio de sesión si no está autenticado
    exit();
}

// Incluir el menú lateral
includes('menu.php');
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Inicio | COPAPA</title>

    <!-- Incluir TailwindCSS desde tailwind.php -->
    <?php include('tailwind.php'); ?>
    
    <style>
        /* Fondo de pantalla */
        body {
            background-image: url('https://github.com/Alejandra-Araque/Proyecto_gaes_copapa/blob/main/Proyecto_gaes_copapa/img/1.png');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            height: 100vh;
            margin: 0;
        }
    </style>
</head>
<body class="flex flex-col min-h-screen">
    <div class="flex flex-grow">
        <!-- Menú lateral -->
        <?php include('includes/menu.php'); ?>

        <!-- Contenido principal -->
        <div class="flex-1 p-6">
            <!-- Encabezado principal -->
            <header class="bg-white bg-opacity-80 rounded-lg p-6 shadow-lg">
                <div class="text-center">
                    <h1 class="text-4xl font-bold text-cafe">Bienvenido a COPAPA</h1>
                    <p class="text-lg text-gris mt-4">La mejor plataforma para gestionar compras de productos agrícolas.</p>
                </div>
            </header>

            <!-- Imagen del banner -->
            <div class="mt-6">
                <img src="img/banner/4.png" alt="Imagen 4" class="rounded-lg shadow-lg mx-auto">
            </div>
        </div>
    </div>

    <!-- Pie de página -->
    <footer class="bg-cafe text-white text-center py-4 mt-4">
        <?php include 'includes/footer.php'; ?>
    </footer>
</body>
</html>
