<?php

$host = "localhost";
$user = "root";
$password = "Sistemas";
$baseDatos = "escuela";

$conexion = new mysqli(
    $host,
    $user,
    $password,
    $baseDatos
);

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

echo "Conexión exitosa a la base de datos.";

?>