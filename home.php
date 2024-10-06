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
    <style>
        body {
            background-image: url('https://media.istockphoto.com/id/546172924/es/foto/campo-verde-de-cultivos-de-papa-en-una-fila.jpg?s=612x612&w=0&k=20&c=SmbYk1iuvGK2MTVcvuRyNsTDe0ePL_iyQf7s1IRmhOE='); /* Cambia esta ruta por la de tu imagen */
            background-size: cover; /* Ajusta la imagen para cubrir todo el fondo */
            background-position: center; /* Centra la imagen */
            background-repeat: no-repeat; /* Evita que la imagen se repita */
        }
        .header-main {
            text-align: center;
            background-color: rgba(199, 210, 179, 0.8); /* Color de fondo semi-transparente para el encabezado */
            padding: 20px 0;
            border-radius: 8px; /* Bordes redondeados */
            margin: 20px 0; /* Espacio en la parte superior e inferior */
        }
        h1 {
            color: #6b4f4f; /* Color del texto del título */
            font-size: 48px; /* Tamaño del texto del título */
            font-weight: bold; /* Negrita */
        }
        p {
            color: #333; /* Color del texto del párrafo */
            font-size: 18px; /* Tamaño del texto del párrafo */
            max-width: 800px; /* Ancho máximo para el párrafo */
            margin: 0 auto; /* Centrar el párrafo */
        }
    </style>
</head>
<body>
    <div class="main-container">
        <!-- Menú lateral con logo incluido -->
        <?php include('includes/menu.php'); ?>
        
        <!-- Contenido principal -->
        <div class="content" id="page-content-wrapper">
            <header class="header-main">
                <div class="container">
                    <h1>Bienvenido a COPAPA</h1>
                    <p>"Compra directa del agricultor: fresco, justo y sostenible"</p>
                </div>
            </header>
            
            <div class="slider">
                <style>
                    * {
                        box-sizing: border-box;
                        margin: 0;
                        padding: 0;
                    }
                    .slider {
                        width: 100%;
                        max-width: 800px;
                        height: 400px;
                        position: relative;
                        overflow: hidden;
                        margin: 20px auto;
                    }
                    .slides {
                        display: flex;
                        width: 500%;
                        height: 100%;
                        animation: slideAnimation 15s infinite;
                    }
                    .slides img {
                        width: 100%;
                        height: 100%;
                    }
                    @keyframes slideAnimation {
                        0% { margin-left: 0; }
                        20% { margin-left: 0; }
                        25% { margin-left: -100%; }
                        45% { margin-left: -100%; }
                        50% { margin-left: -200%; }
                        70% { margin-left: -200%; }
                        75% { margin-left: -300%; }
                        95% { margin-left: -300%; }
                        100% { margin-left: 0; }
                    }
                </style>
                <div class="slides">
                    <img src="img/Agricultor.jpg" alt="Agricultor">
                    <img src="https://elproductor.com/wp-content/uploads/2023/03/cultivos-carchi-siembra-aproximadamente-hectareas_ecmima20121123_0115_4.jpg" alt="Cultivos">
                    <img src="img/Papa.jpg" alt="Cosecha">
                    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcS3b-H6Tt0f-5ZLGJhBkcu6DIFWdiOeDm0szw&s" alt="Pastusa">
                </div>
            </div> <!-- Fin del slider -->

        </div> <!-- Fin del contenido principal -->
    </div> <!-- Fin del contenedor principal -->

    <!-- Pie de página -->
    <?php include 'includes/footer.php'; ?>

    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery-3.4.1.min.js"></script>
</body>
</html>