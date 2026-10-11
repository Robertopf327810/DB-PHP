<?php
include_once "conexion.php";
$token = $_GET['token'] ?? '';

include_once "header.php";

$sql = "SELECT * FROM usuarios WHERE token = ?";
$stmt = $conexion->prepare($sql);
$stmt->bind_param("s", $token);
$stmt->execute();
$resultado = $stmt->get_result();

if ($resultado->num_rows === 1) {
    $usuario = $resultado->fetch_assoc();
    $sql = "UPDATE usuarios SET email_verificado = 1, token = NULL WHERE id = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("i", $usuario["id"]);
    $stmt->execute();

    echo "<h1>Email confirmado</h1>";
    echo "<p style='text-align:center;'>Tu cuenta ha sido activada correctamente.</p>";
    echo "<a href='login.php'>Iniciar sesión</a>";
} else {
    echo "<h1>Token inválido</h1>";
    echo "<p style='text-align:center;'>El enlace ya fue utilizado o no es válido.</p>";
    echo "<a href='registro.php'>Volver al registro</a>";
}

include_once "footer.php";
?>