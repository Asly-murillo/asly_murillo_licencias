<?php
session_start();
require_once('../include/conexion.php');
include "menu.html";
$conex = new database;
$con = $conex->conectar();

$sql2 = "SELECT nit_biblioteca, nom_biblioteca FROM bibliotecas";
$stmt_bibliotecas = $con->query($sql2);
$bibliotecas = $stmt_bibliotecas->fetchAll(PDO::FETCH_ASSOC);

$sql3 = "SELECT id_licencia, nom_licencia FROM tipos_licencias";
$stmt_tipo_licencias = $con->query($sql3);
$tipos_licencias = $stmt_tipo_licencias->fetchAll(PDO::FETCH_ASSOC);

if (isset($_POST['crear_licencia'])) {
    $nit_biblioteca = $_POST['nit_biblioteca'];  
    $id_licencia = $_POST['tipo_licencia']; 
    $fecha_adquisicion = $_POST['fecha_adquisicion'];

    $sql_valor_licencia = "SELECT valor FROM tipos_licencias WHERE id_licencia = '$id_licencia'";
    $stmt_valor = $con->query($sql_valor_licencia);
    $licencia = $stmt_valor->fetch(PDO::FETCH_ASSOC);
    $valor_licencia = $licencia['valor'];

    $fecha_fin = '';
    if ($valor_licencia == 3) { 
        $fecha_fin = date('Y-m-d', strtotime("+3 days", strtotime($fecha_adquisicion)));
    } elseif ($valor_licencia == 6) { 
        $fecha_fin = date('Y-m-d', strtotime("+6 months", strtotime($fecha_adquisicion)));
    } elseif ($valor_licencia == 12) { 
        $fecha_fin = date('Y-m-d', strtotime("+1 year", strtotime($fecha_adquisicion)));
    } elseif ($valor_licencia == 24) { 
        $fecha_fin = date('Y-m-d', strtotime("+2 years", strtotime($fecha_adquisicion)));
    }

    $id_estado = 1;  

    $sql_insert = "INSERT INTO licencias (id_licencia, id_tipo_licencia, nit_biblioteca, fecha_adquisicion, fecha_fin, id_estado) 
                   VALUES ('$id_licencia', '$id_licencia', '$nit_biblioteca', '$fecha_adquisicion', '$fecha_fin', '$id_estado')";
    
    $con->query($sql_insert);
    echo '<script>alert("Licencia creada exitosamente");</script>';
    echo '<script>window.location="licencias.php";</script>';
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/styles_admin.css">
    <title>Crear Licencia</title>
</head>
<body>
    <h1>Crear Nueva Licencia</h1>

    <form method="POST">
        <label for="nit_biblioteca">Biblioteca:</label>
        <select name="nit_biblioteca" id="nit_biblioteca">
            <?php foreach ($bibliotecas as $biblioteca): ?>
                <option value="<?php echo htmlspecialchars($biblioteca['nit_biblioteca']); ?>">
                    <?php echo htmlspecialchars($biblioteca['nom_biblioteca']); ?>
                </option>
            <?php endforeach; ?>
        </select>
        <br>

        <label for="tipo_licencia">Tipo de Licencia:</label>
        <select name="tipo_licencia" id="tipo_licencia">
            <?php foreach ($tipos_licencias as $tipo_licencia): ?>
                <option value="<?php echo htmlspecialchars($tipo_licencia['id_licencia']); ?>">
                    <?php echo htmlspecialchars($tipo_licencia['nom_licencia']); ?>
                </option>
            <?php endforeach; ?>
        </select>
        <br>

        <label for="fecha_adquisicion">Fecha de Adquisición:</label>
        <input type="date" name="fecha_adquisicion" required>
        <br>

        <input type="submit" name="crear_licencia" value="Crear Licencia">
    </form>

</body>
</html>
