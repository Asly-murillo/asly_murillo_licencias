<?php
session_start();
require_once('../include/conexion.php');
include "menu.html";
$conex = new database;
$con = $conex->conectar();

$sql = "SELECT 
            licencias.id_licencia, 
            tipos_licencias.nom_licencia,
            tipos_licencias.valor,  
            licencias.fecha_adquisicion, 
            licencias.fecha_fin, 
            estado.estado 
        FROM licencias
        LEFT JOIN tipos_licencias ON licencias.id_licencia = tipos_licencias.id_licencia  
        LEFT JOIN estado ON licencias.id_estado = estado.id_estado";

$stmt = $con->query($sql);
$licencias = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/styles_admin.css">
    <title>Ver Licencias</title>
</head>
<body>
    <h1>Lista de Licencias</h1>

    <table>
        <thead>
            <tr>
                <th>ID Licencia</th>
                <th>Nombre de Licencia</th>
                <th>Valor</th>
                <th>Fecha de Adquisición</th>
                <th>Fecha de Fin</th>
                <th>Estado</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($licencias as $licencia): ?>
                <tr>
                    <td><?php echo htmlspecialchars($licencia['id_licencia']); ?></td>
                    <td><?php echo htmlspecialchars($licencia['nom_licencia']); ?></td>
                    <td><?php echo htmlspecialchars($licencia['valor']); ?></td>
                    <td><?php echo htmlspecialchars($licencia['fecha_adquisicion']); ?></td>
                    <td><?php echo htmlspecialchars($licencia['fecha_fin']); ?></td>
                    <td><?php echo htmlspecialchars($licencia['estado']); ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <br>
    <a href="crear_licencia.php">Crear Nueva Licencia</a>

</body>
</html>
