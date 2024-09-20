<?php
    $servidor="localhost";
    $usuario="root";
    $clave="root";
    $base="nuevacopapa";
    $conexion = new mysqli($servidor,$usuario,$clave,$base) or die ("error al conectar"
            . "la base de datos".mysqli_connect_error());
    mysqli_set_charset($conexion,"utf8");
?>