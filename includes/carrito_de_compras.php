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
            height: 100vh;
            margin: 0;
        }
        .container {
            max-width: 1200px;
            margin: auto;
            padding: 20px;
        }
        .card {
            background: rgba(255, 255, 255, 0.7);
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            padding: 30px;
            margin-bottom: 20px;
        }
        h1, h2 {
            color: #800080; /* Títulos en color morado */
            font-weight: bold; /* Títulos en negrita */
            text-transform: uppercase; /* Títulos en mayúsculas */
        }
        .boton-pago {
            background: rgba(128, 0, 128, 0.6); /* Color morado transparente */
        }
        .boton-pago:hover {
            background: rgba(128, 0, 128, 0.8); /* Más oscuro al pasar el mouse */
        }
    </style>
</head>
<body>

    <div class="container">
        <div class="card">
            <h1 class="text-3xl font-bold text-center mb-6">Carrito de Compras</h1>

            <?php if (empty($_SESSION['carrito'])): ?>
                <p class="text-center text-gray-700">Tu carrito de compras está vacío.</p>
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
                <!-- Botón para vaciar el carrito -->
                <form method="POST" action="vaciar_carrito.php" class="mb-6">
                    <button type="submit" class="w-full px-4 py-2 bg-red-500 text-white font-semibold rounded-md shadow-sm hover:bg-red-600 focus:outline-none">Vaciar Carrito</button>
                </form>
            <?php endif; ?>

            <h2 class="text-xl font-semibold mb-4">Detalles de Envío</h2>
            <form method="POST" action="procesar_pago.php" class="space-y-4">
                <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
                
                <div>
                    <label for="nombre" class="block text-lg font-medium">Nombre Completo</label>
                    <input type="text" id="nombre" name="nombre" required class="mt-1 block w-full px-4 py-2 border rounded-md shadow-sm focus:outline-none focus:ring focus:ring-verdeClaro focus:border-verde">
                </div>

                <div>
                    <label for="direccion" class="block text-lg font-medium">Dirección de Envío</label>
                    <input type="text" id="direccion" name="direccion" required class="mt-1 block w-full px-4 py-2 border rounded-md shadow-sm focus:outline-none focus:ring focus:ring-verdeClaro focus:border-verde">
                </div>

                <div>
                    <label for="telefono" class="block text-lg font-medium">Teléfono</label>
                    <input type="text" id="telefono" name="telefono" required class="mt-1 block w-full px-4 py-2 border rounded-md shadow-sm focus:outline-none focus:ring focus:ring-verdeClaro focus:border-verde">
                </div>

                <div>
                    <label for="email" class="block text-lg font-medium">Correo Electrónico</label>
                    <input type="email" id="email" name="email" required class="mt-1 block w-full px-4 py-2 border rounded-md shadow-sm focus:outline-none focus:ring focus:ring-verdeClaro focus:border-verde">
                </div>

                <div class="text-center">
                    <button type="submit" class="w-full py-2 px-4 boton-pago text-white font-semibold rounded-md shadow-sm hover:bg-verdeClaro focus:outline-none focus:ring-2 focus:ring-verdeClaro focus:ring-opacity-75">Proceder al Pago</button>
                </div>
            </form>
        </div>

        <div class="card">
            <h2 class="text-2xl font-semibold mb-4">Pasarela de Pagos</h2>
            <p class="text-gray-700">A continuación, se detallan los métodos de pago que aceptamos:</p>
            <ul class="list-disc ml-5 mb-4">
                <li class="flex items-center mb-2">
                    <img src="https://img.freepik.com/vector-gratis/diseno-tarjeta-credito-realista_23-2149126093.jpg?size=338&ext=jpg&ga=GA1.1.2008272138.1727222400&semt=ais_hybrid" alt="Tarjetas de crédito" class="w-12 h-12 mr-2">
                    Tarjetas de crédito y débito
                </li>
                <li class="flex items-center mb-2">
                    <img src="https://www.wradio.com.co/resizer/v2/XZTKOW6VWJFI3HBSJ64KJ6ICZE.png?auth=54a5e51923d6dd96dba05d159daad5ac4bce95239dfe8929f7b535894a6575e2&width=650&height=488&quality=70&smart=true" alt="Transferencias bancarias" class="w-12 h-12 mr-2">
                    Transferencias bancarias
                </li>
                <li class="flex items-center mb-2">
                    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSUcIOlxALj5-lAvhXjJ-n4Iidz-VLs5pALdg&s" alt="Pago en efectivo" class="w-12 h-12 mr-2">
                    Pago en efectivo (contra entrega)
                </li>
            </ul>
        </div>
    </div>
</body>
</html>



