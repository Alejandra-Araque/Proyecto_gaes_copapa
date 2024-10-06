<?php
session_start(); // Iniciar sesión para manejar el carrito

// Conectar a la base de datos
include('../config/db.php');

// Eliminar un registro
if (isset($_GET['eliminar'])) {
    $id = $_GET['eliminar'];

    $query = "DELETE FROM cultivo WHERE Cultivo_Id = ?";
    $stmt = $conexion->prepare($query);
    $stmt->bind_param('i', $id);

    if ($stmt->execute()) {
        echo "<script>
            Swal.fire({
                title: '¡Éxito!',
                text: 'Registro eliminado correctamente',
                icon: 'success',
                confirmButtonText: 'Ok'
            }).then(() => {
                window.location.href = 'verCultivo.php';
            });
        </script>";
    } else {
        echo "<script>
            Swal.fire({
                title: 'Error',
                text: 'Error al eliminar el registro',
                icon: 'error',
                confirmButtonText: 'Ok'
            });
        </script>";
    }

    $stmt->close();
}

// Consultar los registros de la tabla cultivo
$query = "SELECT * FROM cultivo";
$resultado = $conexion->query($query);

// Agregar producto al carrito
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['cultivo_id'])) {
    $cultivo_id = $_POST['cultivo_id'];
    $cantidad = intval($_POST['cantidad']); // Validar que sea un número entero

    if ($cantidad <= 0) {
        echo "<script>
            Swal.fire({
                title: 'Error',
                text: 'Cantidad inválida',
                icon: 'error',
                confirmButtonText: 'Ok'
            });
        </script>";
    } else {
        // Buscar el producto en la base de datos
        $producto_query = "SELECT * FROM cultivo WHERE Cultivo_Id = ?";
        $stmt = $conexion->prepare($producto_query);
        $stmt->bind_param('i', $cultivo_id);
        $stmt->execute();
        $producto_result = $stmt->get_result();
        $producto = $producto_result->fetch_assoc();

        // Verificar si el carrito ya está creado
        if (!isset($_SESSION['carrito'])) {
            $_SESSION['carrito'] = [];
        }

        // Verificar si el producto ya está en el carrito
        if (isset($_SESSION['carrito'][$cultivo_id])) {
            // Si ya está, incrementar la cantidad
            $_SESSION['carrito'][$cultivo_id]['cantidad'] += $cantidad;
        } else {
            // Si no está, agregarlo al carrito
            $_SESSION['carrito'][$cultivo_id] = [
                'nombre' => $producto['nombreProducto'],
                'precio' => $producto['precioXBulto'],
                'cantidad' => $cantidad
            ];
        }

        // Redireccionar automáticamente sin esperar al Swal.fire
        header('Location: carrito_de_compras.php');
        exit(); // Asegurarse de que el script no continúe ejecutándose
    }
}
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
            background-image: url('https://solofruver.com/wp-content/uploads/cultivo_de_papa.jpg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }

        .table-container {
            width: 100%;
            max-width: 100rem;
        }

        .min-w-full {
            background-color: transparent;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .min-w-full th,
        .min-w-full td {
            color: #333;
            font-size: 16px;
            padding: 12px;
            background-color: rgba(255, 255, 255, 0.7);
            font-weight: bold;
            text-transform: uppercase;
        }

        .min-w-full th {
            background-color: rgba(200, 200, 200, 0.9);
        }

        .min-w-full tr:hover {
            background-color: rgba(200, 200, 200, 0.5);
        }

        .action-button {
            padding: 4px 8px;
            font-size: 14px;
            margin: 0 2px;
            border: 1px solid;
            border-radius: 5px;
        }

        .btn-eliminar {
            background-color: rgba(255, 0, 0, 0.3);
            border-color: rgba(255, 0, 0, 0.6);
            color: white;
        }

        .btn-eliminar:hover {
            background-color: rgba(255, 0, 0, 0.5);
        }

        .btn-carrito {
            background-color: rgba(128, 0, 128, 0.3);
            border-color: rgba(128, 0, 128, 0.6);
            color: white;
        }

        .btn-carrito:hover {
            background-color: rgba(128, 0, 128, 0.5);
        }

        .btn-agregar-producto {
            background-color: rgba(0, 128, 0, 0.3);
            border-color: rgba(0, 128, 0, 0.6);
            color: white;
        }

        .btn-agregar-producto:hover {
            background-color: rgba(0, 128, 0, 0.5);
        }
    </style>
</head>
<body class="bg-gray-100">

    <div class="table-container mx-auto mt-10">
        <h2 class="text-center mb-6 text-white font-bold text-4xl">Listado de Cultivos</h2>

        <table class="min-w-full">
            <thead>
                <tr class="bg-gray-200">
                    <th>ID</th>
                    <th>Agricultor ID</th>
                    <th>Tipo Producto</th>
                    <th>Nombre Producto</th>
                    <th>Fecha Siembra</th>
                    <th>Fecha Cosecha</th>
                    <th>Superficie Cultivo</th>
                    <th>Ubicación</th>
                    <th>Cantidad Bultos</th>
                    <th>Arrobas/Bulto</th>
                    <th>Precio/Bulto</th>
                    <th>Imagen</th>
                    <th>Vigente</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php while($row = $resultado->fetch_assoc()): ?>
                <tr class="hover:bg-gray-100">
                    <td><?php echo $row['Cultivo_Id']; ?></td>
                    <td><?php echo $row['Agricultor_Id']; ?></td>
                    <td><?php echo $row['tipoProducto']; ?></td>
                    <td><?php echo $row['nombreProducto']; ?></td>
                    <td><?php echo $row['FechaSiembra_cul']; ?></td>
                    <td><?php echo $row['FechaCosecha_cul']; ?></td>
                    <td><?php echo $row['SuperficieCultivo']; ?></td>
                    <td><?php echo $row['localizacion']; ?></td>
                    <td><?php echo $row['cantidadBultos']; ?></td>
                    <td><?php echo $row['arrobasXBulto']; ?></td>
                    <td><?php echo number_format($row['precioXBulto'], 0, ',', '.'); ?> COP</td>
                    <td>
                    <?php if (!empty($row['imagen'])): ?>
                     <!-- Aquí ajusta la ruta donde almacenas las imágenes -->
                     <img src="uploads/images/<?php echo $row['imagen']; ?>" alt="Imagen del Producto" width="50" class="rounded">
                    <?php else: ?>
                      No Imagen
                    <?php endif; ?>
                    </td>
                    <td><?php echo $row['Vigente']; ?></td>
                    <td class="flex justify-around">
                        <button class="action-button btn-eliminar" onclick="eliminarCultivo(<?php echo $row['Cultivo_Id']; ?>)">Eliminar</button>
                        
                        <!-- Formulario para agregar al carrito -->
                        <form action="verCultivo.php" method="post" class="inline-flex space-x-1">
                            <input type="hidden" name="cultivo_id" value="<?php echo $row['Cultivo_Id']; ?>">
                            <input type="number" name="cantidad" min="1" value="1" class="w-16 border border-gray-300 rounded">
                            <button type="submit" class="action-button btn-carrito">Agregar al Carrito</button>
                        </form>
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
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: '¡Sí, eliminar!'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = 'verCultivo.php?eliminar=' + id;
                }
            });
        }
    </script>
</body>
</html>
