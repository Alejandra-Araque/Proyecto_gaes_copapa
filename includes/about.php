<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sobre Nosotros - COPAPA</title>

    <?php include('tailwind.php'); ?>
    
    <style>
        body {
            background-image: url('https://cipotato.org/wp-content/uploads/2022/04/Blog-featured-image-nuevas-variedes-de-papa.png');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            height: 100vh;
            margin: 0;
            display: flex; /* Flex para centrar el contenido */
            align-items: center; /* Centrar verticalmente */
            justify-content: center; /* Centrar horizontalmente */
            flex-direction: column; /* Coloca el contenido en columna */
        }

        .bg-custom {
            background-color: rgba(139, 69, 19, 0.7); /* Color café transparente */
            max-height: 90vh; /* Ajusta la altura máxima */
            overflow: auto; /* Permite el desplazamiento si el contenido excede la altura */
            padding: 2rem; /* Espaciado interno */
            border-radius: 8px; /* Bordes redondeados */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); /* Sombra para un efecto visual */
        }

        .seccion {
            margin-bottom: 2rem;
        }

        .valores-lista li {
            margin-bottom: 0.5rem;
            color: white;
        }

        h1 {
            font-size: 48px; /* Ajusta el tamaño del título */
            font-weight: bold; /* En negrita */
            color: white; /* Color blanco */
            text-align: center; /* Centra el texto */
            margin-bottom: 20px; /* Espacio debajo del título */
        }

        .logo {
            width: 100px; /* Ajusta el tamaño del logo */
            height: auto; /* Mantiene la proporción */
            margin: 0 auto; /* Centra el logo */
            display: block; /* Asegura que el logo sea un bloque para centrarlo */
        }

        p {
            color: white; /* Texto en blanco */
        }
    </style>
</head>
<body>

    <div class="bg-custom w-full max-w-4xl">
        <!-- Título principal -->
        <h1>SOBRE NOSOTROS</h1>
        
        <!-- Logo -->
        <img src="https://github.com/Alejandra-Araque/Proyecto_gaes_copapa/blob/main/img/copapa.png?raw=true" alt="Logo de COPAPA" class="logo"> <!-- Reemplaza con la URL correcta de tu logo -->
        
        <!-- Misión -->
        <div class="seccion">
            <h2 class="text-2xl font-semibold mb-3">Nuestra Misión</h2>
            <p class="text-lg">
                En <strong>COPAPA</strong>, nuestra misión es conectar a los agricultores con los consumidores, promoviendo el comercio justo y eliminando intermediarios. Queremos empoderar a los agricultores, asegurar que reciban un precio justo por su trabajo, y ofrecer a los consumidores productos frescos de alta calidad a precios accesibles.
            </p>
        </div>
        
        <!-- Visión -->
        <div class="seccion">
            <h2 class="text-2xl font-semibold mb-3">Nuestra Visión</h2>
            <p class="text-lg">
                Nuestra visión es convertirnos en la plataforma líder de comercialización agrícola en Colombia, mejorando la sostenibilidad y las condiciones de vida de las comunidades rurales, y fomentando un mercado transparente y accesible para todos.
            </p>
        </div>
        
        <!-- Valores -->
        <div class="seccion">
            <h2 class="text-2xl font-semibold mb-3">Nuestros Valores</h2>
            <ul class="list-disc pl-5 valores-lista text-lg">
                <li><strong>Comercio Justo</strong>: Aseguramos que los agricultores reciban un precio justo por sus productos, eliminando los márgenes abusivos de los intermediarios.</li>
                <li><strong>Sostenibilidad</strong>: Promovemos prácticas agrícolas responsables que respetan el medio ambiente y mejoran la calidad de vida de las comunidades rurales.</li>
                <li><strong>Transparencia</strong>: Fomentamos la transparencia en las transacciones y relaciones entre agricultores y consumidores, brindando información clara y accesible.</li>
            </ul>
        </div>

        <!-- Imagen representativa -->
        <div class="seccion text-center">
            <img src="https://tuagro.com/wp-content/uploads/2022/02/Papac.jpg" alt="Agricultores de COPAPA" class="w-full max-w-lg mx-auto rounded-lg shadow-lg">
            <p class="text-sm mt-2">Agricultores locales que forman parte de la red COPAPA</p>
        </div>
    </div>

</body>
</html>


