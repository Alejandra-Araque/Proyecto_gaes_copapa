<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (isset($_POST['guardar'])) {
    // Conexión a la base de datos
    include '../config/db.php'; // Asegúrate de que el archivo de conexión esté correcto

    // Obtener valores del formulario
    $Agricultor_Id = $_POST['numIdentificacion'];
    $tipoProducto = $_POST['tipoProducto'];
    $nombreProducto = $_POST['nombreProducto'];
    $FechaSiembra_cul = $_POST['fechaSiembra'];
    $FechaCosecha_cul = $_POST['fechaCosecha'];
    $SuperficieCultivo = $_POST['superficieCultivo'];
    $localizacion = $_POST['localizacion'];
    $cantidadBultos = $_POST['cantidadBultos'];
    $arrobasXBulto = $_POST['arrobasXBulto'];
    $precioXBulto = $_POST['precioXBulto'];
    $Vigente = $_POST['vigente'];

    // Ruta por defecto si no se sube ninguna imagen
    $rutaImagen = null;

    // Verificar si se ha subido una imagen
    if (!empty($_FILES['imagen']['tmp_name'])) {
        $nombreArchivo = basename($_FILES['imagen']['name']);
        $directorioDestino = "../imagenes_cultivos/"; // Carpeta donde se guardará la imagen
        $rutaImagen = $directorioDestino . $nombreArchivo;

        // Subir la imagen al servidor
        if (move_uploaded_file($_FILES['imagen']['tmp_name'], $rutaImagen)) {
            echo "Imagen subida correctamente.";
        } else {
            echo "Error al subir la imagen.";
        }
    }

    // Insertar datos en la tabla cultivo usando mysqli
    $query = "INSERT INTO cultivo (Agricultor_Id, tipoProducto, nombreProducto, FechaSiembra_cul, FechaCosecha_cul, SuperficieCultivo, localizacion, cantidadBultos, arrobasXBulto, precioXBulto, imagen, Vigente) 
              VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    // Preparar la consulta
    $stmt = $conexion->prepare($query);

    // Verificar si la consulta se preparó correctamente
    if ($stmt) {
        // Enlazar los parámetros a la consulta
        $stmt->bind_param('isssssissdss', $Agricultor_Id, $tipoProducto, $nombreProducto, $FechaSiembra_cul, $FechaCosecha_cul, $SuperficieCultivo, $localizacion, $cantidadBultos, $arrobasXBulto, $precioXBulto, $rutaImagen, $Vigente);

        // Ejecutar la consulta
        if ($stmt->execute()) {
            echo "Cultivo registrado exitosamente.";
        } else {
            echo "Error al registrar el cultivo.";
        }

        // Cerrar el statement
        $stmt->close();
    } else {
        echo "Error al preparar la consulta.";
    }

    // Cerrar la conexión a la base de datos
    $conexion->close();
}
?>



<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Cultivo | COPAPA</title>
    <!-- Verifica si el archivo existe en la carpeta correcta -->
    <?php include "../includes/tailwind.php"; ?>
    <style>
        body {
            background-image: url('/Proyecto_gaes_copapa/Proyecto_gaes_copapa/img/banner/9.png');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }
        #imagenPreview {
            width: 300px;
            height: 300px;
            object-fit: cover;
            display: none; /* Por defecto oculta la imagen */
        }
    </style>
    <script>
        function mostrarImagen(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const preview = document.getElementById('imagenPreview');
                    preview.src = e.target.result;
                    preview.style.display = 'block'; // Mostrar imagen una vez cargada
                };
                reader.readAsDataURL(file);
            }
        }
    </script>
</head>
<body class="bg-gray-100">

    <!-- Contenedor Principal -->
    <div class="w-full max-w-md bg-white rounded-lg shadow-md p-6 mx-auto mt-10">
        <h2 class="text-center mb-5 text-gray-700 font-bold text-3xl">Registro de Cultivo</h2>

        <form action="registrarCultivo.php" method="post" enctype="multipart/form-data">
            <!-- Número de Identificación Cultivador -->
            <div class="mb-4">
                <label for="numIdentificacion" class="block mb-1 font-semibold text-gray-600">Número de Identificación Cultivador</label>
                <input class="w-full h-10 rounded border-2 border-gray-400 px-3" type="text" id="numIdentificacion" name="numIdentificacion" required>
            </div>

            <!-- Tipo de Producto -->
            <div class="mb-4">
                <label for="tipoProducto" class="block mb-1 font-semibold text-gray-600">Tipo de Producto</label>
                <select class="w-full h-10 rounded border-2 border-gray-400 px-3" id="tipoProducto" name="tipoProducto" required>
                    <option value="">Seleccione</option>
                    <option value="Papa">Papa</option>
                    <option value="Arbeja">Arbeja</option>
                    <option value="Trigo">Trigo</option>
                    <option value="Maiz">Maíz</option>
                </select>
            </div>

            <!-- Nombre de Producto -->
            <div class="mb-4">
                <label for="nombreProducto" class="block mb-1 font-semibold text-gray-600">Nombre del Producto</label>
                <input class="w-full h-10 rounded border-2 border-gray-400 px-3" type="text" id="nombreProducto" name="nombreProducto" required>
            </div>

            <!-- Fecha de Siembra -->
            <div class="mb-4">
                <label for="fechaSiembra" class="block mb-1 font-semibold text-gray-600">Fecha de Siembra</label>
                <input class="w-full h-10 rounded border-2 border-gray-400 px-3" type="date" id="fechaSiembra" name="fechaSiembra" required>
            </div>

            <!-- Fecha de Cosecha -->
            <div class="mb-4">
                <label for="fechaCosecha" class="block mb-1 font-semibold text-gray-600">Fecha de Cosecha</label>
                <input class="w-full h-10 rounded border-2 border-gray-400 px-3" type="date" id="fechaCosecha" name="fechaCosecha" required>
            </div>

            <!-- Superficie Cultivo en Metros -->
            <div class="mb-4">
                <label for="superficieCultivo" class="block mb-1 font-semibold text-gray-600">Superficie Cultivo (m²)</label>
                <input class="w-full h-10 rounded border-2 border-gray-400 px-3" type="number" id="superficieCultivo" name="superficieCultivo" required>
            </div>

            <!-- Ubicación -->
            <div class="mb-4">
                <label for="localizacion" class="block mb-1 font-semibold text-gray-600">Ubicación</label>
                <input class="w-full h-10 rounded border-2 border-gray-400 px-3" type="text" id="localizacion" name="localizacion" required>
            </div>

            <!-- Cantidad en Bultos -->
            <div class="mb-4">
                <label for="cantidadBultos" class="block mb-1 font-semibold text-gray-600">Cantidad en Bultos</label>
                <input class="w-full h-10 rounded border-2 border-gray-400 px-3" type="number" id="cantidadBultos" name="cantidadBultos" required>
            </div>

            <!-- Cantidad de Arrobas -->
            <div class="mb-4">
                <label for="arrobasXBulto" class="block mb-1 font-semibold text-gray-600">Cantidad de Arrobas por Bulto</label>
                <input class="w-full h-10 rounded border-2 border-gray-400 px-3" type="number" id="arrobasXBulto" name="arrobasXBulto" required>
            </div>

            <!-- Precio por Bulto -->
            <div class="mb-4">
                <label for="precioXBulto" class="block mb-1 font-semibold text-gray-600">Precio por Bulto (COP)</label>
                <input class="w-full h-10 rounded border-2 border-gray-400 px-3" type="number" id="precioXBulto" name="precioXBulto" required>
            </div>

            <!-- Cargar Imagen -->
            <div class="mb-4">
                <label for="imagen" class="block mb-1 font-semibold text-gray-600">Cargar Imagen del Producto</label>
                <input class="w-full h-10 rounded border-2 border-gray-400 px-3" type="file" id="imagen" name="imagen" accept="image/*" onchange="mostrarImagen(event)">
                <img id="imagenPreview" src="#" alt="Vista previa de la imagen">
            </div>

            <!-- Vigente -->
            <div class="mb-4">
                <label for="vigente" class="block mb-1 font-semibold text-gray-600">¿El cultivo está vigente?</label>
                <select class="w-full h-10 rounded border-2 border-gray-400 px-3" id="vigente" name="vigente" required>
                    <option value="">Seleccione</option>
                    <option value="Si">Sí</option>
                    <option value="No">No</option>
                </select>
            </div>

            <!-- Botón Guardar -->
            <div class="text-center">
                <button class="w-full h-10 bg-green-500 text-white font-semibold rounded-lg" type="submit" name="guardar">Guardar</button>
            </div>
        </form>
    </div>

</body>
</html>
