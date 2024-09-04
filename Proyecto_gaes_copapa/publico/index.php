<?php include('includes/header.php'); ?>
<div class="container">
<h1>Bienvenido a COPAPA</h1>
</div>
<?php include('includes/footer.php'); ?>


<?php
// Iniciar sesión
session_start();

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['usuario'])) {
    header('Location: login.php'); // Redirigir al usuario al formulario de inicio de sesión si no está autenticado
    exit();
}

// Incluir archivos necesarios
include 'includes/header.php';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Inicio | COPAPA</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style_index.css">
    <link rel="stylesheet" href="css/responsive.css">
</head>
<body>
    <!-- Encabezado principal -->
    <header class="header-main">
        <div class="container">
            <h1>Bienvenido a COPAPA</h1>
            <p>La mejor plataforma para gestionar compras de productos agrícolas.</p>
        </div>
    </header>

    <!-- Sección de bienvenida -->
    <section class="welcome-section">
        <div class="container">
            <h2>¡Te damos la bienvenida!</h2>
            <p>En COPAPA, nuestra misión es facilitar la compra y venta de productos agrícolas con la mayor transparencia y eficiencia. Explora nuestros servicios y descubre cómo podemos ayudarte a mejorar tu negocio.</p>
        </div>
    </section>

    <!-- Sección de servicios -->
    <section class="services">
        <div class="container">
            <div class="service-card">
                <h3>Gestión de Compras</h3>
                <p>Administra todas tus compras de manera centralizada y eficiente.</p>
            </div>
            <div class="service-card">
                <h3>Registro de Proveedores</h3>
                <p>Registra y mantén actualizada la información de tus proveedores.</p>
            </div>
            <div class="service-card">
                <h3>Facturación Simplificada</h3>
                <p>Genera y gestiona facturas de manera rápida y sencilla.</p>
            </div>
        </div>
    </section>

    <!-- Sección de testimonios -->
    <section class="testimonials">
        <div class="container">
            <div class="testimonial-item">
                <p>"COPAPA ha transformado la forma en que gestionamos nuestras compras. Es fácil de usar y muy eficiente."</p>
                <strong>- Juan Pérez, Agricultor</strong>
            </div>
            <div class="testimonial-item">
                <p>"Gracias a COPAPA, hemos mejorado significativamente nuestras operaciones diarias. ¡Totalmente recomendado!"</p>
                <strong>- Ana Gómez, Proveedor</strong>
            </div>
        </div>
    </section>

    <!-- Llamada a la acción -->
    <section class="call-to-action">
        <div class="container">
            <h2>¿Listo para mejorar tu negocio?</h2>
            <a href="servicios.php" class="btn">Conoce nuestros servicios</a>
        </div>
    </section>

    <!-- Pie de página -->
    <?php include 'includes/footer.php'; ?>
    
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery-3.4.1.min.js"></script>
</body>
</html>



