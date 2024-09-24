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
        }

        .seccion {
            margin-bottom: 2rem;
        }

        .valores-lista li {
            margin-bottom: 0.5rem;
        }
    </style>
</head>
<body class="flex items-center justify-center">

    <div class="bg-white bg-opacity-80 p-8 rounded-lg shadow-lg w-full max-w-4xl">
        <!-- Título principal -->
        <h1 class="text-4xl font-bold mb-6 text-center text-cafe">Sobre Nosotros</h1>
        
        <!-- Misión -->
        <div class="seccion">
            <h2 class="text-2xl font-semibold mb-3 text-cafe">Nuestra Misión</h2>
            <p class="text-lg text-gris">
                En <strong>COPAPA</strong>, nuestra misión es conectar a los agricultores con los consumidores, promoviendo el comercio justo y eliminando intermediarios. Queremos empoderar a los agricultores, asegurar que reciban un precio justo por su trabajo, y ofrecer a los consumidores productos frescos de alta calidad a precios accesibles.
            </p>
        </div>
        
        <!-- Visión -->
        <div class="seccion">
            <h2 class="text-2xl font-semibold mb-3 text-cafe">Nuestra Visión</h2>
            <p class="text-lg text-gris">
                Nuestra visión es convertirnos en la plataforma líder de comercialización agrícola en Colombia, mejorando la sostenibilidad y las condiciones de vida de las comunidades rurales, y fomentando un mercado transparente y accesible para todos.
            </p>
        </div>
        
        <!-- Valores -->
        <div class="seccion">
            <h2 class="text-2xl font-semibold mb-3 text-cafe">Nuestros Valores</h2>
            <ul class="list-disc pl-5 valores-lista text-lg text-gris">
                <li><strong>Comercio Justo</strong>: Aseguramos que los agricultores reciban un precio justo por sus productos, eliminando los márgenes abusivos de los intermediarios.</li>
                <li><strong>Sostenibilidad</strong>: Promovemos prácticas agrícolas responsables que respetan el medio ambiente y mejoran la calidad de vida de las comunidades rurales.</li>
                <li><strong>Transparencia</strong>: Fomentamos la transparencia en las transacciones y relaciones entre agricultores y consumidores, brindando información clara y accesible.</li>
            </ul>
        </div>

        <!-- Imagen representativa -->
        <div class="seccion text-center">
            <img src="https://tuagro.com/wp-content/uploads/2022/02/Papac.jpg" alt="Agricultores de COPAPA" class="w-full max-w-lg mx-auto rounded-lg shadow-lg">
            <p class="text-sm text-gris mt-2">Agricultores locales que forman parte de la red COPAPA</p>
        </div>

        <!-- Botón de más información -->
        <div class="text-center mt-6">
            <a href="informacion_adicional.html" class="text-white bg-cafe hover:bg-cafe-darker px-6 py-3 rounded-md font-semibold">Más información</a>
        </div>
    </div>

</body>
</html>
