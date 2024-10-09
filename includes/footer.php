<?php 
include($_SERVER['DOCUMENT_ROOT'] . "/includes/footer.php");
?>

<!-- Footer -->
<!-- Footer -->
<footer class="footer">
    <div class="footer-container">
        <div class="footer-social">
            <a class="social-icon" href="#" target="_blank">
                <img src="https://img.freepik.com/psd-premium/icono-facebook-3d-iconos-redes-sociales-logotipos-estilo-moderno_535570-856.jpg" alt="Facebook" class="icon-size" />
            </a>
            <a class="social-icon" href="#" target="_blank">
                <img src="https://img.freepik.com/fotos-premium/vector-ilustracion-icono-twitter_895118-5895.jpg" alt="Twitter" class="icon-size" />
            </a>
            <a class="social-icon" href="#" target="_blank">
                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQkTHPEjT1SZ6C347YtE9HypRBvOakyfv-VEg&s" alt="Instagram" class="icon-size" />
            </a>
        </div>
        <a class="nav-link" href="privacy.php">Política de Privacidad</a>
        <p class="footer-text">&copy; <?php echo date("Y"); ?> COPAPA. Todos los derechos reservados.</p>
    </div>
</footer>


<style>
    .footer {
        position: fixed; /* El footer estará siempre en la parte inferior */
        bottom: 0; /* Alineado al final de la ventana */
        width: 100%; /* Ocupa todo el ancho de la página */
        background-color: brown; /* Color café */
        color: #fff; /* Texto en blanco */
        padding: 10px 0; /* Pequeño padding para ajustarlo */
        text-align: center;
        z-index: 1000; /* Asegura que el footer esté sobre otros elementos */
    }

    .footer-container {
        display: flex;
        justify-content: space-between; /* Distribuye el contenido equitativamente */
        align-items: center;
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 15px; /* Espacio a los lados */
    }

    .footer-social {
        display: flex;
        gap: 10px; /* Espacio entre iconos */
    }

    .icon-size {
        width: 20px; /* Tamaño pequeño para los iconos */
        height: 20px;
    }

    .nav-link {
        color: #f0e6d6; /* Beige claro */
        text-decoration: none;
        font-size: 14px;
    }

    .nav-link:hover {
        color: #fff; /* Efecto hover en blanco */
    }

    .footer-text {
        font-size: 12px;
        color: #f0e6d6; /* Color del copyright */
    }
</style>
<script src="https://kit.fontawesome.com/81581fb069.js" crossorigin="anonymous"></script>
</body>
</html>
