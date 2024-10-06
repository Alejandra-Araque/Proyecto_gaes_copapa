<?php
session_start();

// Verificar si se ha enviado el ID del producto a eliminar
if (isset($_GET['id'])) {
    $idProducto = $_GET['id'];

    // Verificar si el producto existe en el carrito
    if (isset($_SESSION['carrito'][$idProducto])) {
        // Eliminar el producto del carrito
        unset($_SESSION['carrito'][$idProducto]);
    }
}

// Redirigir de nuevo al carrito de compras después de eliminar el producto
header('Location: carrito_de_compras.php');
exit;
?>
