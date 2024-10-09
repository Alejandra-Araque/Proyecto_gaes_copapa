<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Conectar a la base de datos
include '../config/db.php';

// Verificar si se ha pasado el ID
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Consultar la información del cultivo correspondiente
    $query = "SELECT * FROM cultivo WHERE Cultivo_Id = ?";
    $stmt = $conexion->prepare($query);
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $resultado = $stmt->get_result();
    $cultivo = $resultado->fetch_assoc();

    // Verificar si existe el cultivo
    if (!$cultivo) {
        echo "<script>alert('Cultivo no encontrado'); window.location.href = 'verCultivo.php';</script>";
        exit();
    }
} else {
    echo "<script>alert('ID de cultivo no proporcionado'); window.location.href = 'verCultivo.php';</script>";
    exit();
}

// Procesar el formulario si se envía
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $agricultorId = $_POST['Agricultor_Id'];
    $tipoProducto = $_POST['tipoProducto'];
    $nombreProducto = $_POST['nombreProducto'];
    $fechaSiembra = $_POST['FechaSiembra_cul'];
    $fechaCosecha = $_POST['FechaCosecha_cul'];
    $superficieCultivo = $_POST['SuperficieCultivo'];
    $ubicacion = $_POST['localizacion'];
    $cantidadBultos = $_POST['cantidadBultos'];
    $arrobasBulto = $_POST['arrobasXBulto'];
    $precioBulto = $_POST['precioXBulto'];
    $vigente = $_POST['Vigente'];

    // Consulta para actualizar el cultivo
    $updateQuery = "UPDATE cultivo SET 
        Agricultor_Id = ?, tipoProducto = ?, nombreProducto = ?, FechaSiembra_cul = ?, FechaCosecha_cul = ?, 
        SuperficieCultivo = ?, localizacion = ?, cantidadBultos = ?, arrobasXBulto = ?, precioXBulto = ?, Vigente = ?
        WHERE Cultivo_Id = ?";
    $stmt = $conexion->prepare($updateQuery);
    $stmt->bind_param('isssssissisi', $agricultorId, $tipoProducto, $nombreProducto, $fechaSiembra, $fechaCosecha, $superficieCultivo, $ubicacion, $cantidadBultos, $arrobasBulto, $precioBulto, $vigente, $id);

    if ($stmt->execute()) {
        echo "<script>
            alert('Cultivo actualizado correctamente');
            window.location.href = 'verCultivo.php';
        </script>";
    } else {
        echo "<script>alert('Error al actualizar el cultivo');</script>";
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Cultivo | COPAPA</title>
    <?php include "../includes/tailwind.php"; ?>
    <style>
        body {
            background-image: url('https://www.quimsaitw.com/wp-content/uploads/2023/08/mejorar-rendimiento-de-cultivos.jpeg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            min-height: 100vh; /* Añade esta línea */
        }
        .container {
            background-color: rgba(139, 69, 19, 0.5); /* Color café transparente */
            border-radius: 10px;
            padding: 20px;
        }
        #imagenPreview {
            width: 300px;
            height: 300px;
            object-fit: cover;
            display: none; /* Por defecto oculta la imagen */
        }
    </style>
</head>
<body class="bg-gray-100">

    <div class="w-full max-w-4xl container mx-auto mt-10">
        <h2 class="text-center mb-5 text-white font-bold text-3xl">Editar Cultivo</h2>
        <div class="flex justify-center mb-5">
            <img src="https://github.com/Alejandra-Araque/Proyecto_gaes_copapa/blob/main/img/copapa.png?raw=true" alt="Logo COPAPA" class="w-24"> <!-- Cambia la ruta a tu logo -->
        </div>

        <form action="editarCultivo.php?id=<?php echo $id; ?>" method="POST">
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label for="Agricultor_Id" class="block text-gray-700">Agricultor ID</label>
                    <input type="number" name="Agricultor_Id" value="<?php echo $cultivo['Agricultor_Id']; ?>" class="w-full px-4 py-2 border rounded-md" required>
                </div>
                <div>
                    <label for="tipoProducto" class="block text-gray-700">Tipo de Producto</label>
                    <input type="text" name="tipoProducto" value="<?php echo $cultivo['tipoProducto']; ?>" class="w-full px-4 py-2 border rounded-md" required>
                </div>
                <div>
                    <label for="nombreProducto" class="block text-gray-700">Nombre del Producto</label>
                    <input type="text" name="nombreProducto" value="<?php echo $cultivo['nombreProducto']; ?>" class="w-full px-4 py-2 border rounded-md" required>
                </div>
                <div>
                    <label for="FechaSiembra_cul" class="block text-gray-700">Fecha de Siembra</label>
                    <input type="date" name="FechaSiembra_cul" value="<?php echo $cultivo['FechaSiembra_cul']; ?>" class="w-full px-4 py-2 border rounded-md" required>
                </div>
                <div>
                    <label for="FechaCosecha_cul" class="block text-gray-700">Fecha de Cosecha</label>
                    <input type="date" name="FechaCosecha_cul" value="<?php echo $cultivo['FechaCosecha_cul']; ?>" class="w-full px-4 py-2 border rounded-md">
                </div>
                <div>
                    <label for="SuperficieCultivo" class="block text-gray-700">Superficie del Cultivo</label>
                    <input type="text" name="SuperficieCultivo" value="<?php echo $cultivo['SuperficieCultivo']; ?>" class="w-full px-4 py-2 border rounded-md" required>
                </div>
                <div>
                    <label for="localizacion" class="block text-gray-700">Ubicación</label>
                    <input type="text" name="localizacion" value="<?php echo $cultivo['localizacion']; ?>" class="w-full px-4 py-2 border rounded-md" required>
                </div>
                <div>
                    <label for="cantidadBultos" class="block text-gray-700">Cantidad de Bultos</label>
                    <input type="number" name="cantidadBultos" value="<?php echo $cultivo['cantidadBultos']; ?>" class="w-full px-4 py-2 border rounded-md" required>
                </div>
                <div>
                    <label for="arrobasXBulto" class="block text-gray-700">Arrobas por Bulto</label>
                    <input type="number" name="arrobasXBulto" value="<?php echo $cultivo['arrobasXBulto']; ?>" class="w-full px-4 py-2 border rounded-md" required>
                </div>
                <div>
                    <label for="precioXBulto" class="block text-gray-700">Precio por Bulto</label>
                    <input type="number" name="precioXBulto" value="<?php echo $cultivo['precioXBulto']; ?>" class="w-full px-4 py-2 border rounded-md" required>
                </div>
                <div>
                    <label for="Vigente" class="block text-gray-700">Vigente</label>
                    <select name="Vigente" class="w-full px-4 py-2 border rounded-md" required>
                        <option value="SI" <?php if ($cultivo['Vigente'] == 1) echo 'selected'; ?>>Sí</option>
                        <option value="NO" <?php if ($cultivo['Vigente'] == 0) echo 'selected'; ?>>No</option>
                    </select>
                </div>
            </div>

            <div class="mt-6 text-center">
                <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded">Actualizar Cultivo</button>
            </div>
        </form>
    </div>
    
</body>
</html>

<?php
// Cerrar la conexión
$conexion->close();
?>

