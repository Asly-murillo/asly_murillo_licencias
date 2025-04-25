<?php
session_start();
require_once ('../include/conexion.php');
include '../include/validar_sesion.php';

$conex = new database;
$con = $conex->conectar();
?>

<?php
$documento = $_GET['documento'];

$sql = $con->prepare("SELECT usuarios.*, tipo_documento.tipo_documento, tipo_documento.id_tipo,
                             estado.estado, estado.id_estado, bibliotecas.nom_biblioteca, bibliotecas.nit_biblioteca
                      FROM usuarios
                      INNER JOIN tipo_documento ON usuarios.tipo_documento = tipo_documento.id_tipo
                      INNER JOIN estado ON usuarios.id_estado = estado.id_estado
                      INNER JOIN bibliotecas ON usuarios.nit_biblioteca = bibliotecas.nit_biblioteca
                      WHERE usuarios.documento = '$documento'");
$sql->execute();
$fila = $sql->fetch(PDO::FETCH_ASSOC);
?>

<?php
if (isset($_POST['actualizar'])) {
    $doc = $_POST['documento'];
    $nombre = $_POST['nombre'];
    $correo = $_POST['correo'];
    $telefono = $_POST['telefono'];
    $tipo_doc = $_POST['tipo_documento'];
    $biblioteca = $_POST['biblioteca'];
    $estado = $_POST['id_estado'];

    $update = $con->prepare("UPDATE usuarios SET 
        nombre = '$nombre',
        correo = '$correo',
        telefono = '$telefono',
        tipo_documento = '$tipo_doc',
        nit_biblioteca = '$biblioteca',
        id_estado = '$estado'
        WHERE documento = '$doc'");
    
    $update->execute();
    echo '<script>alert("Actualización exitosa")</script>';
    echo '<script>window.location="ver_usu.php"</script>';
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Usuario</title>
    <link rel="stylesheet" href="../css/styles_admin.css">

</head>
<body>
<h2>Editar Usuario</h2>

<form method="post">
<table border="1">
    <tr>
        <td>Tipo de Documento</td>
        <td>
            <select name="tipo_documento">
                <option value="<?php echo $fila['id_tipo']; ?>">Actualmente: <?php echo $fila['tipo_documento']; ?></option>
                <?php
                $tipos = $con->prepare("SELECT * FROM tipo_documento");
                $tipos->execute();
                while ($row = $tipos->fetch(PDO::FETCH_ASSOC)) {
                    echo '<option value="' . $row['id_tipo'] . '">' . $row['tipo_documento'] . '</option>';
                }
                ?>
            </select>
        </td>
    </tr>
    <tr>
        <td>Documento</td>
        <td><input type="text" readonly name="documento" value="<?php echo $fila['documento']; ?>"></td>
    </tr>
    <tr>
        <td>Nombre</td>
        <td><input type="text" readonly name="nombre" value="<?php echo $fila['nombre']; ?>"></td>
    </tr>
    <tr>
        <td>Correo</td>
        <td><input type="email" name="correo" value="<?php echo $fila['correo']; ?>"></td>
    </tr>
    <tr>
        <td>Teléfono</td>
        <td><input type="text" name="telefono" value="<?php echo $fila['telefono']; ?>"></td>
    </tr>
    <tr>
        <td>Biblioteca</td>
        <td>
            <select name="biblioteca">
                <option value="<?php echo $fila['nit_biblioteca']; ?>">Actualmente: <?php echo $fila['nom_biblioteca']; ?></option>
                <?php
                $biblios = $con->prepare("SELECT * FROM bibliotecas");
                $biblios->execute();
                while ($biblio = $biblios->fetch(PDO::FETCH_ASSOC)) {
                    echo '<option value="' . $biblio['nit_biblioteca'] . '">' . $biblio['nom_biblioteca'] . '</option>';
                }
                ?>
            </select>
        </td>
    </tr>
    <tr>
        <td>Estado</td>
        <td>
            <select name="id_estado">
                <option value="<?php echo $fila['id_estado']; ?>">Actualmente: <?php echo $fila['estado']; ?></option>
                <?php
                $estados = $con->prepare("SELECT * FROM estado");
                $estados->execute();
                while ($est = $estados->fetch(PDO::FETCH_ASSOC)) {
                    echo '<option value="' . $est['id_estado'] . '">' . $est['estado'] . '</option>';
                }
                ?>
            </select>
        </td>
    </tr>
    <tr>
        <td colspan="2"><input type="submit" name="actualizar" value="Actualizar"></td>
    </tr>
</table>
</form>

</body>
</html>
