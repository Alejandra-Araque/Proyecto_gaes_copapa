<header class="bg-gray-100 shadow-md">
    <div class="container mx-auto flex flex-col items-center my-4 lg:flex-row">
        <a href="/Proyecto_gaes_copapa/publico/index.php" class="flex items-center">
            <img src="/Proyecto_gaes_copapa/img/copapa.png" alt="Logo COPAPA" class="h-16 w-auto"/>
        </a>
        <nav class="flex-grow">
            <ul class="flex flex-col items-center gap-2 lg:flex-row lg:gap-6">
                <li><a class="text-gray-700 hover:text-cafe hover:font-bold transition duration-200" href="/Proyecto_gaes_copapa/publico/index.php">Inicio</a></li>
                <li><a class="text-gray-700 hover:text-cafe hover:font-bold transition duration-200" href="/Proyecto_gaes_copapa/includes/about.php">Sobre Nosotros</a></li>
                <li><a class="text-gray-700 hover:text-cafe hover:font-bold transition duration-200" href="/Proyecto_gaes_copapa/publico/services.php">Servicios</a></li>
                <li><a class="text-gray-700 hover:text-cafe hover:font-bold transition duration-200" href="/Proyecto_gaes_copapa/includes/contacto.php">Contacto</a></li>
                <li><a class="text-gray-700 hover:text-cafe hover:font-bold transition duration-200" href="/Proyecto_gaes_copapa/login.php">Iniciar Sesión</a></li>
            </ul>
        </nav>
        <div class="mt-4 lg:mt-0 lg:ml-4">
            <?php
            session_start();
            if (isset($_SESSION['usuario'])) {
                echo '<a class="text-gray-700 hover:text-cafe hover:font-bold transition duration-200" href="/Proyecto_gaes_copapa/cerrar_sesion.php">Cerrar Sesión</a>';
            } else {
                echo '<a class="text-gray-700 hover:text-cafe hover:font-bold transition duration-200" href="/Proyecto_gaes_copapa/login.php">Iniciar Sesión</a>';
            }
            ?>
        </div>
    </div>
</header>


