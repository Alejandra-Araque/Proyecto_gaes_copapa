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
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.1.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles.css">
    <style>
        body {
            background-color: #f8f9fa; /* Color de fondo claro */
            background-image: url('https://img.freepik.com/foto-gratis/mujer-sosteniendo-cesta-llena-primer-plano-verduras_23-2148580024.jpg?t=st=1728487614~exp=1728491214~hmac=79fdea800710270bb80c97284bc947743adc3609a7d888422b855d377f4b0ca1&w=826'); /* Imagen de fondo */
            background-size: cover; /* Cubrir toda la pantalla con la imagen */
            background-position: center; /* Centrar la imagen de fondo */
        }

        .header-main {
            text-align: center;
            color: #fff; /* Color del texto */
            padding: 40px 0;
            margin-bottom: 20px; /* Espacio inferior */
        }

        h1 {
            font-size: 48px; /* Tamaño del texto del título */
            font-weight: bold; /* Negrita */
            color: black;
        }

        p {
            font-size: 20px; /* Tamaño del texto del párrafo */
        }

        /* Estilos para centrar el logo y las imágenes debajo */
        .logo-container {
            text-align: center;
            margin-bottom: 20px; /* Espacio inferior para el logo */
        }

        /* Estilos para las imágenes debajo del logo */
        .image-gallery {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            gap: 10px; /* Espacio entre imágenes */
        }

        .image-gallery img {
            max-width: 200px; /* Tamaño pequeño para las imágenes */
            border-radius: 8px; /* Bordes redondeados */
        }


        .sidebar .nav-link {
            color: white; /* Color del texto en el menú */
            font-weight: bold;
        }

        .product-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            margin: 20px;
        }

        .product-card {
            background-color: rgba(139, 69, 19, 0.6); /* Fondo transparente café */
            border: none; /* Sin borde */
            border-radius: 8px; /* Bordes redondeados */
            margin: 10px; /* Espaciado entre tarjetas */
            padding: 15px; /* Espaciado interno */
            width: 300px; /* Ancho fijo para las tarjetas */
            text-align: center; /* Centrar texto */
            color: #fff; /* Color del texto */
            transition: transform 0.3s; /* Transición para el efecto hover */
        }

        .product-card:hover {
            transform: scale(1.05); /* Efecto de escalado al pasar el mouse */
        }

        .product-image {
            width: 100%; /* Imagen ocupa el 100% de la tarjeta */
            height: auto; /* Altura automática para mantener proporciones */
            border-radius: 8px; /* Bordes redondeados en las imágenes */
        }

        .product-title {
            color: black; /* Cambiar el color del título de productos disponibles */
            text-align: center; /* Centrar el título */
            margin-bottom: 20px; /* Espacio inferior para separar del logo */
            font-size: 30px; /* Tamaño del título */
            font-weight: bold; /* Negrita */
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Menú lateral -->
            <nav class="col-md-2 d-none d-md-block sidebar">
                <div class="position-sticky">
                    <!-- Menú aquí -->
                    <?php include('includes/menu.php'); ?>
                </div>
            </nav>

            <!-- Sección de productos disponibles hoy -->
            <h2 class="product-title">BIENVENIDO A COPAPA</h2>

            <!-- Imágenes centradas debajo del logo -->
            <div class="image-gallery">
                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQ2dz6tF8Ym2PC2_HwUwWDgdetDgtqEPMJKZw&s" alt="Imagen 1">
                <img src="https://img.freepik.com/fotos-premium/grupo-agricultores-cosechando-cultivos-campo_116547-81653.jpg" alt="Imagen 2">
                <img src="https://i0.wp.com/goula.lat/wp-content/uploads/2023/06/agricultores.jpg?fit=1000%2C667&ssl=1" alt="Imagen 3">
                <img src="https://extra.com.co/wp-content/uploads/2023/08/96295245_recogedoresdefrutasbajacaliforniareuters.jpg" alt="Imagen 4">
                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTNHuWqBqS2zTsJ4h9e1UJj78L7zNkoC7NJ1w&s" alt="Imagen 5">
            </div>

            <!-- Título de productos disponibles hoy -->
            <header class="header-main">
                <h1>PRODUCTOS DISPONIBLES HOY</h1>
                <p>"Compra directa del agricultor: fresco, justo y sostenible"</p>
            </header>

            <div class="product-container">
                <div class="product-card">
                    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQ99z2nZRXSRmBi7txZeuU6Cc0U7z9RGN7npw&s" alt="Producto 1" class="product-image" loading="lazy">
                    <h3>PAPA PASTUSA</h3>
                    <p>Contiene mayor cantidad de antioxidantes (compuestos asociados con una mejor salud).No te intoxicas ya que están libres de productos químicos que pueden perjudicar tu salud y la de tu familia.</p>
                    <p><strong>Precio: $2.500 Kg</strong></p>
                </div>
                <div class="product-card">
                    <img src="https://www2.agrositio.com.ar/imagenes_contenidos/v_232413_70949520.jpg" alt="Producto 2" class="product-image" loading="lazy">
                    <h3>ARVEJA AMARILLA</h3>
                    <p>Proporciona energía que hace permanecer más tiempo la glucosa en la sangre. Tiene un gran poder antioxidante, protegiendo la retina y enfermedades vinculadas a la vista.</p>
                    <p><strong>Precio: $7.000 Lb</strong></p>
                </div>
                <div class="product-card">
                    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSx6qEIkaqMzhvC3f4BCUMFCf_QpVZRFUQLVw&s" alt="Producto 3" class="product-image" loading="lazy">
                    <h3>PAPA SABANERA</h3>
                    <p>En comparación con otras raíces y tubérculos, tiene un contenido importante de proteínas de alto valor biológico y, al combinarse con leguminosas (frijoles, lentejas, habas, alubias), se incrementa aún más su valor proteínico.</p>
                    <p><strong>Precio: $5.500 Kg</strong></p>
                </div>
            </div> <!-- Fin del contenedor de productos -->
        </div> <!-- Fin del contenido principal -->
    </div> <!-- Fin del contenedor principal -->

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.1/js/bootstrap.bundle.min.js"></script>
    <?php include('includes/footer.php'); ?>
    
</body>
</html>





