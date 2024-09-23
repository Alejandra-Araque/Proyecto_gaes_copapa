<?php
// Iniciar sesión
session_start();

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['usuario'])) {
    header('Location: login.php'); // Redirigir al usuario al formulario de inicio de sesión si no está autenticado
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Inicio | COPAPA</title>
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="../css/style_index.css">
    <link rel="stylesheet" href="../css/responsive.css">
    <link rel="stylesheet" href="css/menu.css">
    <link rel="stylesheet" href="css/footer.css">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.min.js"></script>

</head>
<body>
    <div class="main-container">
        <!-- Menú lateral con logo incluido -->
        <?php include('includes/menu.php'); ?>
 <!-- Contenido principal -->
         <div class="content" id="page-content-wrapper">
            <!-- Encabezado principal -->
            <header class="header-main">
        <!-- Contenido principal -->
         <div class="content" id="page-content-wrapper">
            <!-- Encabezado principal -->
            <header class="header-main">
                <div class="container">
                    <h1  style="margin-top: -20px;">Bienvenido a COPAPA</h1>
                    <p>Está enfocado en la venta y compra de papa en el territorio colombiano, con el fin de apoyar la agronomía que hoy como siempre ha sido el pilar de nuestra sociedad. .</p>
                <style>
        h1 {
            text-align: center;
            color: #333; /* Cambia el color del texto si lo deseas */
            font-size: 36px; /* Tamaño del texto */
        }
    </style>
                </div>
                
            </header>
   <div class="slider">
               <style>
        body {
            background-image: url('/copapa/Proyecto_gaes_copapa/Proyecto_gaes_copapa/img/banner/9.png'); /* Cambia esta ruta por la de tu imagen */
            background-size: cover;
            background-position: center;
        }
    </style>

        </div> <!-- Fin del contenido principal -->
    </div> <!-- Fin del contenedor principal -->



    </div> <!-- Fin del contenedor principal -->

    <!-- Pie de página -->
    <?php include 'includes/footer.php'; ?>

    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery-3.4.1.min.js"></script>
</body>
</html>
