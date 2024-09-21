<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Conectar a la base de datos
include '../config/db.php'; // Asegúrate de que el archivo de conexión esté correcto

// Eliminar un registro
if (isset($_GET['eliminar'])) {
    $id = $_GET['eliminar'];

    $query = "DELETE FROM cultivo WHERE Cultivo_Id = ?";
    $stmt = $conexion->prepare($query);
    $stmt->bind_param('i', $id);
    
    if ($stmt->execute()) {
        echo "<script>
            alert('Registro eliminado correctamente');
            window.location.href = 'verCultivo.php'; // Redirigir a la misma página para ver los cambios
        </script>";
    } else {
        echo "<script>alert('Error al eliminar el registro');</script>";
    }

    $stmt->close();
}

// Consultar los registros de la tabla cultivo
$query = "SELECT * FROM cultivo";
$resultado = $conexion->query($query);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ver Cultivos | COPAPA</title>
    <?php include "../includes/tailwind.php"; ?>
    
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        body {
            background-image: url('/Proyecto_gaes_copapa/Proyecto_gaes_copapa/img/banner/9.png');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }
        .table-container {
            width: 100%;
            max-width: 100rem; /* Ajusta el tamaño máximo aquí */
        }
    </style>
</head>
<body class="bg-gray-100">

        <div class="w-full max-w-full bg-white rounded-lg shadow-md p-6 mx-auto mt-10">
        <h2 class="text-center mb-6 text-gray-800 font-bold text-4xl">Listado de Cultivos</h2>

        <!-- <table class="w-full text-left border border-gray-300 table-auto"> -->
        <table class="min-w-full bg-white border border-gray-300 rounded-lg overflow-hidden shadow-lg max-w-full">
            <thead>
                <tr class="bg-gray-200">
                    <th class="px-4 py-2 border-b border-gray-300">ID</th>
                    <th class="px-4 py-2 border-b border-gray-300">Agricultor ID</th>
                    <th class="px-4 py-2 border-b border-gray-300">Tipo Producto</th>
                    <th class="px-4 py-2 border-b border-gray-300">Nombre Producto</th>
                    <th class="px-4 py-2 border-b border-gray-300">Fecha Siembra</th>
                    <th class="px-4 py-2 border-b border-gray-300">Fecha Cosecha</th>
                    <th class="px-4 py-2 border-b border-gray-300">Superficie Cultivo</th>
                    <th class="px-4 py-2 border-b border-gray-300">Ubicación</th>
                    <th class="px-4 py-2 border-b border-gray-300">Cantidad Bultos</th>
                    <th class="px-4 py-2 border-b border-gray-300">Arrobas/Bulto</th>
                    <th class="px-4 py-2 border-b border-gray-300">Precio/Bulto</th>
                    <th class="px-4 py-2 border-b border-gray-300">Imagen</th>
                    <th class="px-4 py-2 border-b border-gray-300">Vigente</th>
                    <th class="px-4 py-2 border-b border-gray-300">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php while($row = $resultado->fetch_assoc()): ?>
                <tr class="hover:bg-gray-100">
                    <td class="px-4 py-2 border-b border-gray-300"><?php echo $row['Cultivo_Id']; ?></td>
                    <td class="px-4 py-2 border-b border-gray-300"><?php echo $row['Agricultor_Id']; ?></td>
                    <td class="px-4 py-2 border-b border-gray-300"><?php echo $row['tipoProducto']; ?></td>
                    <td class="px-4 py-2 border-b border-gray-300"><?php echo $row['nombreProducto']; ?></td>
                    <td class="px-4 py-2 border-b border-gray-300"><?php echo $row['FechaSiembra_cul']; ?></td>
                    <td class="px-4 py-2 border-b border-gray-300"><?php echo $row['FechaCosecha_cul']; ?></td>
                    <td class="px-4 py-2 border-b border-gray-300"><?php echo $row['SuperficieCultivo']; ?></td>
                    <td class="px-4 py-2 border-b border-gray-300"><?php echo $row['localizacion']; ?></td>
                    <td class="px-4 py-2 border-b border-gray-300"><?php echo $row['cantidadBultos']; ?></td>
                    <td class="px-4 py-2 border-b border-gray-300"><?php echo $row['arrobasXBulto']; ?></td>
                    <td class="px-4 py-2 border-b border-gray-300"><?php echo $row['precioXBulto']; ?></td>
                    <td class="px-4 py-2 border-b border-gray-300">
                        <?php if ($row['imagen']): ?>
                        <img src="<?php echo $row['imagen']; ?>" alt="Imagen" width="50" class="rounded">
                        <?php else: ?>
                        No Imagen
                        <?php endif; ?>
                    </td>
                    <td class="px-4 py-2 border-b border-gray-300"><?php echo $row['Vigente']; ?></td>
                    <td class="px-4 py-2 border-b border-gray-300">
                        <a href="editarCultivo.php?id=<?php echo $row['Cultivo_Id']; ?>" class="bg-blue-500 text-white px-4 py-1 rounded hover:bg-blue-600 transition">Editar</a>
                        <button class="bg-red-500 text-white px-4 py-1 rounded hover:bg-red-600 transition" onclick="eliminarCultivo(<?php echo $row['Cultivo_Id']; ?>)">Eliminar</button>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>

    <script>
        function eliminarCultivo(id) {
            Swal.fire({
                title: '¿Estás seguro?',
                text: "¡No podrás revertir esto!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Sí, eliminarlo'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = `verCultivo.php?eliminar=${id}`;
                }
            });
        }
    </script>
</body>
</html>

<?php
// Cerrar la conexión
$conexion->close();
?>
