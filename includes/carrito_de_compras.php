<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Si el carrito de compras no existe, inicialízalo
if (!isset($_SESSION['carrito'])) {
    $_SESSION['carrito'] = [];
}

// Función para calcular el total del carrito
function calcularTotal($carrito) {
    $total = 0;
    foreach ($carrito as $item) {
        $total += $item['precio'] * $item['cantidad'];
    }
    return $total;
}

// Formatear precio como pesos colombianos
function formatearPesos($valor) {
    return number_format($valor, 0, ',', '.') . ' COP'; // Usa '.' para separador de miles y sin decimales
}

// Calcular el total del carrito
$totalCarrito = calcularTotal($_SESSION['carrito']);

// Calcular IVA (19%)
$iva = 0.19;
$totalConIva = $totalCarrito + ($totalCarrito * $iva);

// Generar token CSRF si no existe
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrito de Compras - COPAPA</title>
    <?php include('../includes/tailwind.php'); ?>

    <style>
        body {
            background-image: url('https://www.cronicadelquindio.com/files/noticias/120161119052524.jpg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0;
            padding: 0;
            overflow-y: auto; /* Hacer scrollable en caso de que el contenido sea mayor que la pantalla */
        }
        .container {
            max-width: 1200px;
            width: 100%;
            margin: 20px auto;
            padding: 20px;
        }
        .card {
            background: rgba(139, 69, 19, 0.5); /* Fondo café transparente */
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            padding: 30px;
            margin-bottom: 20px;
            color: white; /* Texto blanco dentro del cuadro */
        }

        h1, h2 {
            color: #fff; /* Cambiar a blanco */
            font-weight: bold;
            text-transform: uppercase;
        }
        .formulario-envio {
            background: rgba(139, 69, 19, 0.7); /* Fondo café transparente con buen contraste */
            padding: 20px;
            border-radius: 10px;
        }
        label {
            color: white;
        }
        input {
            color: white;
            background-color: rgba(0, 0, 0, 0.5);
        }
        input::placeholder {
            color: rgba(255, 255, 255, 0.7);
        }
        .boton-pago {
            background: rgba(139, 69, 19, 0.6);
        }
        .boton-pago:hover {
            background: rgba(139, 69, 19, 0.8);
        }
        .texto-negrita {
            font-weight: bold;
        }
        .logo-vacio {
            display: flex;
            justify-content: center;
            align-items: center;
        }
    </style>
</head>
<body>

    <div class="container">
        <div class="card">
            <h1 class="text-3xl font-bold text-center mb-6">Carrito de Compras</h1>

            <?php if (empty($_SESSION['carrito'])): ?>
                <div class="logo-vacio">
                    <img src="https://github.com/Alejandra-Araque/Proyecto_gaes_copapa/blob/main/img/copapa.png?raw=true" alt="Logo COPAPA" class="w-48 h-auto">
                </div>
            <?php else: ?>
                <table class="min-w-full border border-gray-300 mb-4">
                    <thead>
                        <tr class="bg-gray-200">
                            <th class="px-4 py-2 border">Producto</th>
                            <th class="px-4 py-2 border">Cantidad</th>
                            <th class="px-4 py-2 border">Precio</th>
                            <th class="px-4 py-2 border">Subtotal</th>
                            <th class="px-4 py-2 border">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($_SESSION['carrito'] as $idProducto => $item): ?>
                            <tr>
                                <td class="px-4 py-2 border"><?php echo htmlspecialchars($item['nombre']); ?></td>
                                <td class="px-4 py-2 border"><?php echo htmlspecialchars($item['cantidad']); ?></td>
                                <td class="px-4 py-2 border"><?php echo formatearPesos($item['precio']); ?></td>
                                <td class="px-4 py-2 border"><?php echo formatearPesos($item['precio'] * $item['cantidad']); ?></td>
                                <td class="px-4 py-2 border">
                                    <a href="eliminar_del_carrito.php?id=<?php echo $idProducto; ?>" class="text-red-600 hover:text-red-800 font-bold">Eliminar</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <div class="text-right mb-4">
                    <strong>Total: <?php echo formatearPesos($totalCarrito); ?></strong>
                    <br>
                    <strong>Total con IVA (19%): <?php echo formatearPesos($totalConIva); ?></strong>
                </div>
                <form method="POST" action="vaciar_carrito.php" class="mb-6">
                    <button type="submit" class="w-full px-4 py-2 bg-red-500 text-white font-semibold rounded-md shadow-sm hover:bg-red-600 focus:outline-none">Vaciar Carrito</button>
                </form>
            <?php endif; ?>

            <h2 class="text-2xl font-semibold mb-4">Detalles de Envío</h2>
            <form method="POST" action="procesar_pago.php" class="space-y-4 formulario-envio">
                <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">

                <div>
                    <label for="nombre" class="block text-lg font-medium">Nombre Completo</label>
                    <input type="text" id="nombre" name="nombre" required placeholder="Ingresa tu nombre completo" class="mt-1 block w-full px-4 py-2 border rounded-md shadow-sm focus:outline-none">
                </div>

                <div>
                    <label for="direccion" class="block text-lg font-medium">Dirección de Envío</label>
                    <input type="text" id="direccion" name="direccion" required placeholder="Ingresa tu dirección" class="mt-1 block w-full px-4 py-2 border rounded-md shadow-sm focus:outline-none">
                </div>

                <div>
                    <label for="telefono" class="block text-lg font-medium">Teléfono</label>
                    <input type="text" id="telefono" name="telefono" required placeholder="Ingresa tu teléfono" class="mt-1 block w-full px-4 py-2 border rounded-md shadow-sm focus:outline-none">
                </div>

                <div>
                    <label for="email" class="block text-lg font-medium">Correo Electrónico</label>
                    <input type="email" id="email" name="email" required placeholder="Ingresa tu correo electrónico" class="mt-1 block w-full px-4 py-2 border rounded-md shadow-sm focus:outline-none">
                </div>

                <div class="text-center">
                    <button type="submit" class="w-full py-2 px-4 boton-pago text-white font-semibold rounded-md shadow-sm hover:bg-verdeClaro focus:outline-none">Proceder al Pago</button>
                </div>
            </form>
        </div>

        <div class="card">
            <h2 class="text-2xl font-semibold mb-4">Pasarela de Pagos</h2>
            <p class="texto-negrita">A continuación, se detallan los métodos de pago que aceptamos:</p>
            <ul class="list-disc ml-5 mb-4 texto-negrita">
                <li class="flex items-center mb-2">
                    <img src="https://img.freepik.com/vector-gratis/diseno-tarjeta-credito-realista_23-2149126093.jpg" alt="Tarjetas de crédito" class="w-12 h-12 mr-2">
                    Tarjetas de crédito y débito
                </li>
                <li class="flex items-center mb-2">
                    <img src="https://th.bing.com/th/id/OIP.7GJ3-7ADma2hVjKLbuvaZAHaEj" alt="Transferencias" class="w-12 h-12 mr-2">
                    Transferencias bancarias
                </li>
                <li class="flex items-center mb-2">
                    <img src="https://blog.remitly.com/wp-content/uploads/2021/12/Colombia-121421-3-scaled.jpg" alt="Efectivo" class="w-12 h-12 mr-2">
                    Pago en efectivo (contra entrega)
                </li>
            </ul>
        </div>
    </div>

</body>
</html>





