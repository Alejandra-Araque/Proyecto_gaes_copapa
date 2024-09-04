<?php
// Configuración de la base de datos
$host = "localhost";       // Dirección del servidor de base de datos
$dbname = "copapa";        // Nombre de la base de datos
$username = "root";        // Nombre de usuario de la base de datos
$password = "";            // Contraseña del usuario de la base de datos (cambiar según sea necesario)

try {
    // Crear una nueva instancia de PDO para la conexión
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    
    // Establecer el modo de error PDO a excepción para manejar errores de forma más segura
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Conexión exitosa (opcional, solo para fines de depuración)
    // echo "Conexión exitosa a la base de datos.";
} catch (PDOException $e) {
    // Registro del error en un archivo de registro en lugar de mostrarlo al usuario
    error_log("Error al conectar a la base de datos: " . $e->getMessage());
    
    // Mostrar un mensaje de error genérico al usuario
    echo "Error al conectar a la base de datos. Por favor, inténtalo más tarde.";
}

// Opcional: Cerrar la conexión (PHP lo hace automáticamente al finalizar el script)
// $pdo = null;
?>
