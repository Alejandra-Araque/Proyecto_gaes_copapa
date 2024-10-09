<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>COPAPA</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
    body {
        font-family: 'Arial', sans-serif;
        background-color: rgba(101, 67, 33, 0.3);
        /* Color café transparente */
    }

    /* Estilos para los botones café transparente */
    .btn-brown-transparent {
        background-color: rgba(101, 67, 33, 0.5);
        /* Color café transparente */
        color: white;
    }

    /* Estilos de las secciones en fila */
    .section-row {
        display: flex;
        justify-content: space-around;
        align-items: center;
        margin: 2rem 0;
        flex-wrap: nowrap;
        /* Asegura que los elementos estén en una fila */
    }

    .section-box {
        width: 18%;
        padding: 1rem;
        background-size: cover;
        background-position: center;
        height: 20vh;
        color: white;
        border-radius: 8px;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        text-align: center;
        font-size: 1.2rem;
    }

    .section-box h2 {
        font-size: 1.5rem;
        margin-bottom: 0.5rem;
    }

    /* Estilo del título de productos con fondo café */
    .productos-title {
        background-color: rgba(101, 67, 33, 0.7);
        color: white;
        text-align: center;
        padding: 1rem;
        margin: 2rem 0;
        font-size: 2rem;
        border-radius: 8px;
    }

    /* Ajustes de la lista de productos */
    .main-content {
        padding-top: 0;
    }

    .card-product {
        background-color: rgba(101, 67, 33, 0.5);
    }

    iframe {
        width: 100%;
        height: auto;
        border-radius: 8px;
    }
    </style>
</head>

<body>
    <!-- Header -->
    <header class="bg-beige shadow">
        <div class="container mx-auto p-2 flex justify-between items-center">
            <a href="index.php">
                <img src="https://github.com/Alejandra-Araque/Proyecto_gaes_copapa/blob/main/img/copapa.png?raw=true"
                    alt="Logo COPAPA" class="h-24 md:h-28" />
            </a>
            <nav class="flex space-x-4">
                <a href="../login_registro.php" class="btn-brown-transparent py-2 px-4 rounded transition duration-300 text-lg">Regístrate</a>
                <a href="../login.php" class="btn-brown-transparent py-2 px-4 rounded transition duration-300 text-lg">Iniciar Sesión</a>
            </nav>
        </div>
    </header>

    <!-- Banner -->
    <section class="banner h-50 flex flex-col justify-center items-center"
        style="background-image: url('https://images.unsplash.com/photo-1719253293689-40e204db520d?q=80&w=1870&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D'); background-size: cover; background-position: center;">
        <div class="content-banner h-full flex flex-col justify-center items-center bg-black bg-opacity-50">
            <p class="text-white text-xl">COPAPA</p>
            <h2 class="text-white text-4xl font-bold">Excelente sabor y calidad</h2>
            <a href="productos.php" class="btn-brown-transparent py-2 px-4 rounded">Comprar ahora</a>
        </div>
    </section>

    <!-- Sección Sobre Nosotros, Servicios, Contacto, Videos en una fila centrada -->
    <section class="section-row container mx-auto">
        <!-- Cuadro Sobre Nosotros -->
        <div class="section-box"
            style="background-image: url('https://img.freepik.com/fotos-premium/agricultor-aplicando-tecnicas-agricultura-organica-campo-generado-ia_903942-16222.jpg?w=1380');">
            <h2>Sobre Nosotros</h2>
            <p>Nos dedicamos a ofrecer productos frescos y de la mejor calidad directamente desde el campo.</p>
            <a href="sobre_nosotros.php" class="btn-brown-transparent py-2 px-4 rounded mt-2">Conócenos más</a>
        </div>

        <!-- Cuadro Nuestros Servicios -->
        <div class="section-box"
            style="background-image: url('https://img.freepik.com/foto-gratis/personas-que-llevan-suministros-vecinos_23-2149139737.jpg?t=st=1728313170~exp=1728316770~hmac=39c0cc13e57c4c6a4839e44205d6b0c714a6ae889c9805045ebaa329438b9906&w=996');">
            <h2>Nuestros Servicios</h2>
            <ul>
                <li>Venta de productos frescos</li>
                <li>Entrega a domicilio</li>
                <li>Servicio al cliente</li>
                <li>Ofertas especiales</li>
            </ul>
            <a href="servicios.php" class="btn-brown-transparent py-2 px-4 rounded mt-2">Ver Servicios</a>
        </div>

        <!-- Cuadro Contacto -->
        <div class="section-box"
            style="background-image: url('https://www.minagricultura.gov.co/noticias/PublishingImages/agro-tecnologia-980.jpg');">
            <h2>Contacto</h2>
            <p>Correo: <a href="mailto:contacto@copapa.com" class="text-white-500">contacto@copapa.com</a></p>
            <p>Teléfono: +57 123 456 7890</p>
            <a href="contacto.php" class="btn-brown-transparent py-2 px-4 rounded mt-2">Contáctanos</a>
        </div>

        <!-- Cuadro Video 1: Cultivo -->
        <div class="section-box">
            <h2>Cómo Cultivar</h2>
            <p>Video 1: Guía práctica de cómo cultivar papa en casa.</p>
            <iframe src="https://www.youtube.com/embed/7BvTFWSZgTs" frameborder="0" allowfullscreen></iframe>
        </div>

        <!-- Cuadro Video 2: Cultivo -->
        <div class="section-box">
            <h2>Cómo Cultivar</h2>
            <p>Video 2: Consejos para un cultivo sostenible y eficiente.</p>
            <iframe src="https://www.youtube.com/embed/vWApHtc5aGY" frameborder="0" allowfullscreen></iframe>
        </div>
    </section>

    <!-- Título de productos -->
    <div class="productos-title">PRODUCTOS</div>

    <!-- Productos -->
    <main class="main-content p-4">
        <section class="container-products grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
            <!-- Producto 1 -->
            <div class="card-product bg-brown-500 bg-opacity-50 shadow-lg rounded-lg overflow-hidden">
                <img src="https://images.unsplash.com/photo-1445282768818-728615cc910a?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                    alt="Zanahoria" class="w-full h-50 object-cover" />
                <div class="content-card-product p-4">
                    <h3 class="text-xl font-bold">Zanahoria</h3>
                </div>
            </div>
            <!-- Producto 2 -->
            <div class="card-product bg-brown-500 bg-opacity-70 shadow-lg rounded-lg overflow-hidden">
                <img src="https://images.unsplash.com/photo-1598553921123-179ea4997fb6?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                    alt="Manzana Roja" class="w-full h-50 object-cover" />
                <div class="content-card-product p-4">
                    <h3 class="text-xl font-bold">Manzana Roja</h3>
                    <span class="add-cart text-blue-500">
                        <i class="fa-solid fa-basket-shopping"></i>
                    </span>
                </div>
            </div>
            <!-- Producto 3 -->
            <div class="card-product bg-brown-500 bg-opacity-70 shadow-lg rounded-lg overflow-hidden">
                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcROqiEQxwbLVuw8zXKgHvS-F9kiuxkkyvaE1w&s"
                    alt="Papa Perla Negra" class="w-full h-50 object-cover" />
                <div class="content-card-product p-4">
                    <h3 class="text-xl font-bold">Papa Perla Negra</h3>
                    <span class="add-cart text-blue-500">
                        <i class="fa-solid fa-basket-shopping"></i>
                    </span>
                </div>
            </div>
            <!-- Producto 4 -->
            <div class="card-product bg-brown-500 bg-opacity-70 shadow-lg rounded-lg overflow-hidden">
                <img src="https://plus.unsplash.com/premium_photo-1667047164703-15ffa198f8d4?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1pbi1zYW1lLXNlcmllc3wxfHx8ZW58MHx8fHx8"
                    alt="Mazorca" class="w-full h-50 object-cover" />
                <div class="content-card-product p-4">
                    <h3 class="text-xl font-bold">Mazorca</h3>
                    <span class="add-cart text-blue-500">
                        <i class="fa-solid fa-basket-shopping"></i>
                    </span>
                </div>
            </div>
            <!-- Producto 5: Arveja Verde -->
            <div class="card-product bg-brown-500 bg-opacity-70 shadow-lg rounded-lg overflow-hidden">
                <img src="https://images.unsplash.com/photo-1591279222235-27c75538636d?q=80&w=1974&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                    alt="Arveja Verde" class="w-full h-50 object-cover" />
                <div class="content-card-product p-4">
                    <h3 class="text-xl font-bold">Arveja Verde</h3>
                </div>
            </div>
            <!-- Producto 6: Regístrate -->
            <div class="card-product bg-white shadow-lg rounded-lg overflow-hidden flex items-center justify-center text-center"
                style="background-image: url('https://plus.unsplash.com/premium_photo-1722899516572-409bf979e5d6?q=80&w=1958&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D'); background-size: cover; background-position: center; height: 50vh;">
                <div class="p-4 bg-black bg-opacity-50 flex flex-col justify-center items-center h-full">
                    <h3 class="text-xl font-bold text-white">¡Regístrate, conoce todos nuestros productos y no te
                        pierdas de nuestras ofertas!</h3>
                    <a href="iniciar_sesion.php" class="btn-brown-transparent py-2 px-4 rounded mt-2">¡Únete!</a>
                </div>
            </div>
        </section>
    </main>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white p-4">
        <div class="container mx-auto text-center">
            <p>&copy; 2024 COPAPA. Todos los derechos reservados.</p>
        </div>
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</body>

</html>
