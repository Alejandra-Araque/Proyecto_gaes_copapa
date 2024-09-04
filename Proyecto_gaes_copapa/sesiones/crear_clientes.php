<?php
// Incluir el archivo de conexión principal
include('conexion.php');

// Procesar el formulario al enviar
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $conn->real_escape_string($_POST['nombre']);
    $email = $conn->real_escape_string($_POST['email']);
    $telefono = $conn->real_escape_string($_POST['telefono']);

    $sql = "INSERT INTO clientes (nombre, email, telefono) VALUES ('$nombre', '$email', '$telefono')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Nuevo cliente creado exitosamente');</script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Nuevo Cliente - COPAPA</title>
    <style>
        :root{
            --beige: #EAE7DD;
            --cafe: #99775C;
            --cafe-claro: #ac8a6f;
            --gris: #5B5B5B;
        }
        *,
        *::before,
        *::after {
          box-sizing: border-box;
        }
        body{
            background-color: var(--beige);
        }
        .formularios{
            margin: auto;
            width: 45%;
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        .contenedor-inputs{
            display: flex;
            justify-content: space-between;
            align-items: center;
            width: 100%;
            padding: 0.4rem 2rem;
        }
        input{
            width: 50%;
            height: 1.7rem;
            border: 2px solid var(--cafe);
            border-radius: 5px;
        }
        h2{
            font-size: 3rem;
            text-align: center;
        }
        button{
            margin: 1rem 0;
            width: 12rem;
            height: 2.2rem;
            background-color: var(--cafe);
            color: #ffffff;
            font-size: 1.1rem;
            border: none;
            border-radius: 3px;
        }
        button:hover{
            cursor: pointer;
            background-color: var(--cafe-claro);
            border: 2px solid var(--cafe);
        }
    </style>
</head>
<body>
    <div class="formularios">
        <h2>Crear Nuevo Cliente</h2>
        <form method="POST" action="panel_crear_clientes.php">
            <div class="contenedor-inputs">
                <label for="nombre">Nombre:</label>
                <input type="text" id="nombre" name="nombre" required>
            </div>
            <div class="contenedor-inputs">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="contenedor-inputs">
                <label for="telefono">Teléfono:</label>
                <input type="text" id="telefono" name="telefono" required>
            </div>
            <button type="submit">Crear Cliente</button>
        </form>
    </div>
</body>
</html>
