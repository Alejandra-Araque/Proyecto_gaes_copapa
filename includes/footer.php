<footer class="footer">
    <div class="footer-container">
        <div class="footer-logo">
            <!-- <img class="logo" src="/copapa/img/copapa.png" alt="Logo COPAPA"> -->
        </div>
        <!-- <div class="footer-nav">
            <ul class="nav-links">
                <li><a class="nav-link" href="privacy.php">Política de Privacidad</a></li>
            </ul>
        </div> -->
        <div class="footer-social">
            <a class="social-icon" href="#" target="_blank">
                <img src="/Proyecto_gaes_copapa/Proyecto_gaes_copapa/img/facebook.png" alt="Facebook">
            </a>
            <a class="social-icon" href="#" target="_blank">
                <img src="/Proyecto_gaes_copapa/Proyecto_gaes_copapa/img/x.png" alt="Twitter">
            </a>
            <a class="social-icon" href="#" target="_blank">
                <img src="/Proyecto_gaes_copapa/Proyecto_gaes_copapa/img/instagram.png" alt="Instagram">
            </a>
        </div>
        <a class="nav-link" href="privacy.php">Política de Privacidad</a>
        <p class="footer-text">&copy; <?php echo date("Y"); ?> COPAPA. Todos los derechos reservados.</p>
    </div>
		<script
			src="https://kit.fontawesome.com/81581fb069.js"
			crossorigin="anonymous"

		></script>
</footer>

<style>
    .footer {
        position: relative;
        padding: 20px 0;
        text-align: center;
        color: #fff; /* Texto en color blanco para mayor legibilidad */
        background-color: rgba(0, 0, 0, 0.6); /* Fondo semitransparente si quieres mejor contraste */
        width: calc(100% - 250px); /* Restar el ancho del menú lateral */
    margin-left: 250px; /* Mover el footer a la derecha del menú */
    }

    .footer::before {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-size: cover;
        background-position: center;
        z-index: -1; /* Se asegura de que la imagen esté detrás del contenido */
    }

    .footer-container {
        max-width: 1200px;
        margin: 0 auto;
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .footer-social {
        margin-bottom: 15px;
    }

    .social-icon img {
        height: auto; /* Se mantiene el tamaño original de los íconos */
        margin: 0 10px;
    }

    .nav-link {
        color: #fff; /* Blanco para que sea legible sobre la imagen de fondo */
        text-decoration: none;
        margin-top: 10px;
    }

    .nav-link:hover {
        color: #f0e6d6; /* Color beige claro al pasar el cursor */
    }

    .footer-text {
        margin-top: 10px;
        font-size: 14px;
        color: #fff; /* Asegura que el texto sea visible sobre la imagen */
    }
</style>