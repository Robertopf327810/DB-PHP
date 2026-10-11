<?php
session_start();
include_once "conexion.php";

if (!isset($_SESSION["usuario_id"])) {
    header("Location: login.php");
    exit;
}
$usuarioId = $_SESSION["usuario_id"];

// Obtener datos del alumno
$sql = "SELECT id, nombre, email, created_at
        FROM usuarios
        WHERE id = ?";
$stmt = $conexion->prepare($sql);
$stmt->bind_param("i", $usuarioId);
$stmt->execute();
$resultado = $stmt->get_result();
$usuario = $resultado->fetch_assoc();

// Obtener calificaciones
$sql = "SELECT materias.nombre AS materia, calificaciones.calificacion
        FROM calificaciones
        INNER JOIN materias ON materias.id = calificaciones.materia_id
        WHERE calificaciones.usuario_id = ?";
$stmt = $conexion->prepare($sql);
$stmt->bind_param("i", $usuarioId);
$stmt->execute();
$calificaciones = $stmt->get_result();

include_once "header.php";
?>

<h1>
    Bienvenido, <?php echo htmlspecialchars($usuario["nombre"]); ?>
</h1>

<h2>Mis Datos</h2>
<p><strong>ID:</strong> <?php echo $usuario["id"]; ?></p>
<p><strong>Email:</strong> <?php echo htmlspecialchars($usuario["email"]); ?></p>
<p><strong>Fecha de registro:</strong> <?php echo $usuario["created_at"]; ?></p>

<hr>

<h2>Mis Materias</h2>
<table>
    <tr>
        <th>Materia</th>
        <th>Calificación</th>
    </tr>
    <?php if ($calificaciones && $calificaciones->num_rows > 0): ?>
        <?php while ($fila = $calificaciones->fetch_assoc()): ?>
            <tr>
                <td><?php echo htmlspecialchars($fila["materia"]); ?></td>
                <td><?php echo htmlspecialchars($fila["calificacion"]); ?></td>
            </tr>
        <?php endwhile; ?>
    <?php else: ?>
        <tr>
            <td colspan="2" style="text-align: center; color: #64748b;">No tienes calificaciones registradas.</td>
        </tr>
    <?php endif; ?>
</table>

<?php include_once "footer.php"; ?>