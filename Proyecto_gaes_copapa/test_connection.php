<?php
// Incluir el archivo de configuración de la base de datos
include('config/db.php'); // Ajusta la ruta según sea necesario

try {
    // Realizar una consulta a la base de datos para verificar la conexión
    $stmt = $pdo->query("SELECT * FROM usuarios"); // Ajusta la consulta si es necesario
    $usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Mostrar los resultados
    if (count($usuarios) > 0) {
        echo "Conexión exitosa. La tabla 'usuarios' contiene los siguientes registros:<br>";
        foreach ($usuarios as $usuario) {
            echo " - Email: " . htmlspecialchars($usuario['email']) . "<br>";
        }
    } else {
        echo "La tabla 'usuarios' está vacía.";
    }
} catch (PDOException $e) {
    // Mostrar mensaje de error si la consulta falla
    echo "Error: " . htmlspecialchars($e->getMessage());
}
?>
