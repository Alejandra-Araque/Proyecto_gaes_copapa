<div class="sidebar">
    <!-- Logo en la parte superior -->
    <div class="logo-container">
        <img class="logo img-fluid" src="img/copapa.png" alt="Logo COPAPA" style="max-width: 150px;">
    </div>

    <!-- Menú lateral con botones estilizados -->
    <nav class="menu">
        <ul class="menu-list p-0">
            <li><a href="includes/registrarCultivo.php" class="menu-item btn btn-block">Registrar Cultivo</a></li>
            <li><a href="includes/VerCultivo.php" class="menu-item btn btn-block">Ver Cultivo</a></li>
            <li><a href="includes/carrito_de_compras.php" class="menu-item btn btn-block">Carrito de compras</a></li>
            <li><a href="includes/estado_pedido.php" class="menu-item btn btn-block">Estado del Pedido</a></li>
            <li><a href="includes/about.php" class="menu-item btn btn-block">Sobre Nosotros</a></li>
            <li><a href="includes/contacto.php" class="menu-item btn btn-block">Contacto</a></li>
            <li><a href="cerrar_sesion.php" class="menu-item btn btn-block btn-danger">Cerrar Sesión</a></li>
        </ul>
    </nav>
</div>

<style>
    .sidebar {
        position: fixed; /* Fijar el menú en la parte izquierda */
        left: 0; /* Alinear al lado izquierdo */
        top: 0; /* Iniciar desde la parte superior */
        background-color: rgba(139, 69, 19, 0.7); /* Fondo del menú lateral */
        padding: 15px; /* Espacio interno del menú */
        min-height: 100vh; /* Altura mínima para ocupar toda la pantalla */
        z-index: 1000; /* Asegurarse de que esté por encima de otros elementos */
    }

    .logo-container {
        text-align: left; /* Alinear el logo a la izquierda */
        margin-bottom: 20px; /* Espacio inferior para el logo */
    }

    .menu-list {
        list-style: none; /* Eliminar estilo de lista */
        padding: 0; /* Eliminar padding */
    }

    .menu-item {
        display: block; /* Hacer los enlaces como bloques */
        margin: 10px 0; /* Espacio entre los botones */
        padding: 15px; /* Espaciado interno */
        border-radius: 8px; /* Bordes redondeados */
        text-align: left; /* Alinear texto a la izquierda */
        color: white; /* Color del texto */
        text-decoration: none; /* Eliminar subrayado */
        transition: background-color 0.3s; /* Transición para el efecto hover */
    }

    .menu-item:hover {
        background-color: rgba(0, 128, 0, 0.7); /* Color de fondo al pasar el mouse */
    }

    .btn-danger {
        background-color: rgba(255, 0, 0, 0.7); /* Color de fondo para cerrar sesión */
        border: none; /* Sin borde */
    }

    .btn-danger:hover {
        background-color: rgba(255, 0, 0, 0.9); /* Color de fondo al pasar el mouse para cerrar sesión */
    }
</style>



