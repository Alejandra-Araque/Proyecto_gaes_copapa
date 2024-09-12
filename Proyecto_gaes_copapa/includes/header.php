<header class="flex flex-col items-center">
    <div class="flex flex-col items-center my-4 lg:flex-row">
        <a href="/Proyecto_gaes_copapa/Proyecto_gaes_copapa/publico/index.php">
            <img src="/Proyecto_gaes_copapa/Proyecto_gaes_copapa/img/copapa.png" alt="Logo COPAPA">
        </a>
        <nav class="header-nav">
            <ul class="flex flex-col items-center gap-1 lg:flex-row lg:gap-4">
                <li><a class="hover:text-cafe hover:font-bold" href="index.php">Inicio</a></li>
                <li><a class="hover:text-cafe hover:font-bold" href="about.php">Sobre Nosotros</a></li>
                <li><a class="hover:text-cafe hover:font-bold" href="services.php">Servicios</a></li>
                <li><a class="hover:text-cafe hover:font-bold" href="contact.php">Contacto</a></li>
                <li><a class="hover:text-cafe hover:font-bold" href="login.php">Iniciar Sesión</a></li>
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
