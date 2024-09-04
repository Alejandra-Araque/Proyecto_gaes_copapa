<?php
// header.php
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/styles.css">
    <title>COPAPA</title>
</head>
<body>
    <header class="header-main">
        <div class="header-container">
            <div class="header-logo">
                <a href="index.php">
                    <img src="images/logo.png" alt="Logo COPAPA">
                </a>
            </div>
            <nav class="header-nav">
                <ul>
                    <li><a href="index.php">Inicio</a></li>
                    <li><a href="about.php">Sobre Nosotros</a></li>
                    <li><a href="services.php">Servicios</a></li>
                    <li><a href="contact.php">Contacto</a></li>
                    <li><a href="login.php">Iniciar Sesión</a></li>
                </ul>
            </nav>
            <div class="header-login">
                <?php
                session_start();
                if (isset($_SESSION['usuario'])) {
                    echo '<a href="logout.php">Cerrar Sesión</a>';
                } else {
                    echo '<a href="login.php">Iniciar Sesión</a>';
                }
                ?>
            </div>
        </div>
    </header>
</body>
</html>
