<?php
session_start();
require_once('../include/conexion.php');
include '../include/validar_sesion.php';

$conex = new database;
$con = $conex->conectar();

if (isset($_POST['crear'])) {
    $documento = $_POST['documento'];
    $nombre = $_POST['nombre'];
    $correo = $_POST['correo'];
    $telefono = $_POST['telefono'];
    $tipo_documento = $_POST['tipo_documento'];
    $id_estado = $_POST['id_estado'];
    $passw = $_POST['passw']; 

    $hashed_password = password_hash($passw, PASSWORD_DEFAULT);

    
    $sql = "SELECT * FROM usuarios WHERE documento = '$documento'";
    $result = $con->query($sql);
    
    if ($result->rowCount() > 0) {
        echo '<script>alert("El usuario con ese documento ya existe.")</script>';
    } 
    
    elseif ($documento == "" || $nombre == "" || $correo == "" || $telefono == "" || $tipo_documento == "" || $passw == "" || $id_estado == "") {
        echo '<script>alert("Existen datos vacíos")</script>';
        echo '<script>window.location="crear_usuario.php"</script>';
        exit();
    } else {
        $sql = "INSERT INTO usuarios (documento, nombre, correo, telefono, tipo_documento, id_estado, passw, id_rol)
                VALUES ('$documento', '$nombre', '$correo', '$telefono', '$tipo_documento', '$id_estado', '$hashed_password', 2)";
        $con->query($sql);
        
        echo '<script>alert("Usuario creado con éxito.")</script>';
        echo '<script>window.location="ver_usu.php"</script>';
    }
}
?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Nuevo Usuario</title>
    <link rel="stylesheet" href="../css/styles_admin.css">

</head>
<body>
    <form action="" method="post">
        <table border="2">
            <tr>
                <td>Tipo de Documento</td>
                <td>
                    <select name="tipo_documento" required>
                      <option value="">Seleccione el tipo de documento</option>
                        <?php
                        $sql = "SELECT * FROM tipo_documento";
                        $result = $con->query($sql);
                        while ($fila = $result->fetch(PDO::FETCH_ASSOC)) {
                            echo "<option value='" . $fila['id_tipo'] . "'>" . $fila['tipo_documento'] . "</option>";
                        }
                        ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Documento</td>
                <td><input type="text" name="documento" required></td>
            </tr>
            <tr>
                <td>Nombre</td>
                <td><input type="text" name="nombre" required></td>
            </tr>
            <tr>
                <td>Correo</td>
                <td><input type="email" name="correo" required></td>
            </tr>
            <tr>
                <td>Teléfono</td>
                <td><input type="text" name="telefono" required></td>
            </tr>
            
            <tr>
                <td>Estado</td>
                <td>
                    <select name="id_estado" required>
                        <option value="">Seleccione el estado</option>
                        <?php
                        $sql = "SELECT * FROM estado";
                        $result = $con->query($sql);
                        while ($fila = $result->fetch(PDO::FETCH_ASSOC)) {
                            echo "<option value='" . $fila['id_estado'] . "'>" . $fila['estado'] . "</option>";
                        }
                        ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Contraseña</td>
                <td><input type="password" name="passw" required></td>
            </tr>
            <tr>
                <td colspan="2" align="center">
                    <input type="submit" value="Crear Usuario" name="crear">
                </td>
            </tr>
        </table>
    </form>
</body>
</html>
