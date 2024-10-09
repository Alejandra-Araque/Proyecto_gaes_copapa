<?php
session_start(); // Iniciar sesión para manejar el carrito

// Conectar a la base de datos
include('../config/db.php');

// Eliminar un registro
if (isset($_GET['eliminar'])) {
    $id = $_GET['eliminar'];

    // Usamos prepared statements para evitar inyecciones SQL
    $query = "DELETE FROM cultivo WHERE Cultivo_Id = ?";
    $stmt = $conexion->prepare($query);

    if ($stmt) {
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
    } else {
        echo "<script>
            Swal.fire({
                title: 'Error',
                text: 'Error en la consulta SQL',
                icon: 'error',
                confirmButtonText: 'Ok'
            });
        </script>";
    }
}

// Consultar los registros de la tabla cultivo
$query = "SELECT * FROM cultivo";
$resultado = $conexion->query($query);

// Agregar producto al carrito
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['cultivo_id'])) {
    $cultivo_id = intval($_POST['cultivo_id']); // Validar que sea un entero
    $cantidad = intval($_POST['cantidad']); // Validar la cantidad

    // Validamos que la cantidad sea mayor a 0
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

        if ($stmt) {
            $stmt->bind_param('i', $cultivo_id);
            $stmt->execute();
            $producto_result = $stmt->get_result();
            $producto = $producto_result->fetch_assoc();

            // Verificar que el producto exista en la base de datos
            if ($producto) {
                // Inicializamos el carrito si no existe
                if (!isset($_SESSION['carrito'])) {
                    $_SESSION['carrito'] = [];
                }

                // Verificamos si el producto ya está en el carrito
                if (isset($_SESSION['carrito'][$cultivo_id])) {
                    // Si ya está, incrementamos la cantidad
                    $_SESSION['carrito'][$cultivo_id]['cantidad'] += $cantidad;
                } else {
                    // Si no está, lo agregamos
                    $_SESSION['carrito'][$cultivo_id] = [
                        'nombre' => $producto['nombreProducto'],
                        'precio' => $producto['precioXBulto'],
                        'cantidad' => $cantidad
                    ];
                }

                // Redireccionar al carrito automáticamente
                header('Location: carrito_de_compras.php');
                exit(); // Aseguramos de que no siga ejecutando el script
            } else {
                echo "<script>
                    Swal.fire({
                        title: 'Error',
                        text: 'Producto no encontrado',
                        icon: 'error',
                        confirmButtonText: 'Ok'
                    });
                </script>";
            }

            $stmt->close();
        } else {
            echo "<script>
                Swal.fire({
                    title: 'Error',
                    text: 'Error en la consulta SQL',
                    icon: 'error',
                    confirmButtonText: 'Ok'
                });
            </script>";
        }
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
            background-attachment: fixed; /* Efecto de deslizamiento para la imagen de fondo */
        }

        /* Estilos para el cuadro principal */
        .table-container {
            width: 100%;
            max-width: 100rem;
        }

        .min-w-full {
            background-color: rgba(139, 69, 19, 0.5); /* Fondo café transparente */
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .min-w-full th,
        .min-w-full td {
            color: white; /* Letra en blanco */
            font-size: 16px;
            padding: 12px;
            font-weight: bold; /* Estilo de letra en negrita */
            text-transform: uppercase;
        }

        .min-w-full th {
            background-color: rgba(200, 200, 200, 0.9);
        }

        .min-w-full tr:hover {
            background-color: rgba(200, 200, 200, 0.5);
        }

        /* Estilos para los botones */
        .action-button {
            padding: 4px 8px;
            font-size: 14px;
            margin: 0 2px;
            border: 1px solid;
            border-radius: 5px;
            transition: background-color 0.3s ease; /* Transición para el hover */
        }

        .btn-eliminar {
            background-color: rgba(255, 0, 0, 0.3);
            border-color: rgba(255, 0, 0, 0.6);
            color: white;
        }

        .btn-eliminar:hover {
            background-color: rgba(0, 128, 0, 0.5); /* Verde al señalarlo */
        }

        .btn-carrito {
            background-color: rgba(128, 0, 128, 0.3);
            border-color: rgba(128, 0, 128, 0.6);
            color: white;
        }

        .btn-carrito:hover {
            background-color: rgba(0, 128, 0, 0.5); /* Verde al señalarlo */
        }

        .btn-agregar-producto {
            background-color: rgba(0, 128, 0, 0.3);
            border-color: rgba(0, 128, 0, 0.6);
            color: white;
        }

        .btn-agregar-producto:hover {
            background-color: rgba(0, 128, 0, 0.5); /* Verde al señalarlo */
        }

        /* Espacio para el logo y estilos para el título */
        .logo {
            display: block;
            margin: 0 auto;
            width: 100px; /* Ajusta el tamaño del logo */
            height: auto;
        }

        .title {
            color: black; /* Título en color negro */
            font-weight: bold;
        }

        /* Estilos para el input de cantidad */
        .input-cantidad {
            color: black; /* Texto en negro */
            font-weight: bold; /* Texto en negrita */
            background-color: rgba(255, 255, 255, 0.9); /* Fondo blanco semitransparente */
            border: 1px solid rgba(0, 0, 0, 0.2); /* Borde gris claro */
            border-radius: 5px; /* Bordes redondeados */
            padding: 4px 8px;
            width: 60px;
        }

        .input-cantidad::placeholder {
            color: rgba(0, 0, 0, 0.6); /* Color del texto placeholder en gris */
        }

        /* Estilo para las imágenes del producto */
        .product-image {
            width: 100px;
            height: auto;
            border-radius: 10px;
            border: 2px solid white;
        }
    </style>
</head>
<body class="bg-gray-100">

    <div class="table-container mx-auto mt-10">
        <h2 class="text-center mb-10 title text-4xl">Listado de Cultivos</h2>
        <img src="https://github.com/Alejandra-Araque/Proyecto_gaes_copapa/blob/main/img/copapa.png?raw=true" alt="Logo de COPAPA" class="logo">

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
             <img src="<?php echo $row['imagen']; ?>" alt="Imagen del Producto" class="product-image">
         <?php else: ?>
             No Imagen
         <?php endif; ?>
        </td>
        <td><?php echo $row['Vigente']; ?></td>
        <td class="flex justify-around">
            <button class="action-button btn-eliminar" onclick="eliminarCultivo(<?php echo $row['Cultivo_Id']; ?>)">Eliminar</button>
            
            <!-- Botón de Editar -->
            <a href="../includes/editarCultivo.php?id=<?php echo $row['Cultivo_Id']; ?>" class="action-button btn-agregar-producto">Editar</a>

            <!-- Formulario para agregar al carrito -->
            <form action="verCultivo.php" method="post" class="inline-flex space-x-1">
                <input type="hidden" name="cultivo_id" value="<?php echo $row['Cultivo_Id']; ?>">
                <input type="number" name="cantidad" min="1" value="1" class="input-cantidad">
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

