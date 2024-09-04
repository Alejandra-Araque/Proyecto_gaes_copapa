<?php
// footer.php
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/styles.css">
    <title>Footer COPAPA</title>
</head>
<body>
    <footer class="footer-main">
        <div class="footer-content">
            <div class="footer-logo">
                <img src="images/logo-footer.png" alt="Logo COPAPA">
            </div>
            <div class="footer-info">
                <p>&copy; <?php echo date("Y"); ?> COPAPA. Todos los derechos reservados.</p>
                <ul class="footer-links">
                    <li><a href="index.php">Inicio</a></li>
                    <li><a href="about.php">Sobre Nosotros</a></li>
                    <li><a href="contact.php">Contacto</a></li>
                    <li><a href="privacy.php">Política de Privacidad</a></li>
                </ul>
            </div>
            <div class="footer-social">
                <a href="https://facebook.com/copapa" target="_blank"><img src="images/facebook-icon.png" alt="Facebook"></a>
                <a href="https://twitter.com/copapa" target="_blank"><img src="images/twitter-icon.png" alt="Twitter"></a>
                <a href="https://instagram.com/copapa" target="_blank"><img src="images/instagram-icon.png" alt="Instagram"></a>
            </div>
        </div>
    </footer>
</body>
</html>
