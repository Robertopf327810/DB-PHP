<?php
include_once "conexion.php";

// Consulta con JOIN para traer el nombre del usuario y el nombre de la materia
$sql = "SELECT calificaciones.id, usuarios.nombre AS usuario, materias.nombre AS materia, calificaciones.calificacion
        FROM calificaciones
        INNER JOIN usuarios ON calificaciones.usuario_id = usuarios.id
        INNER JOIN materias ON calificaciones.materia_id = materias.id";

$resultado = $conexion->query($sql);

include_once "header.php";
?>

<h1>Lista de calificaciones</h1>

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Alumno</th>
            <th>Materia</th>
            <th>Calificación</th>
        </tr>
    </thead>
    <tbody>
        <?php if ($resultado && $resultado->num_rows > 0): ?>
            <?php while ($fila = $resultado->fetch_assoc()): ?>
                <tr>
                    <td><?php echo htmlspecialchars($fila['id']); ?></td>
                    <td><?php echo htmlspecialchars($fila['usuario']); ?></td>
                    <td><?php echo htmlspecialchars($fila['materia']); ?></td>
                    <td><?php echo htmlspecialchars($fila['calificacion']); ?></td>
                </tr>
            <?php endwhile; ?>
        <?php else: ?>
            <tr>
                <td colspan="4" style="text-align: center; color: #64748b;">No hay calificaciones registradas.</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>

<div style="text-align: center; margin-top: 15px;">
    <a href="dashboard.php">Volver al Dashboard</a>
</div>

<?php include_once "footer.php"; ?>