<?php
session_start();

// Verificar si el carrito existe, en caso contrario no hacer nada
if (isset($_SESSION['carrito'])) {
    // Vaciar el carrito
    $_SESSION['carrito'] = [];
}

// Redirigir de vuelta al carrito de compras
header('Location: carrito_de_compras.php');
exit();
