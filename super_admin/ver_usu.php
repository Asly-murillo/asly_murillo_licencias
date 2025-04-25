<?php
session_start();
require_once ('../include/conexion.php');
include '../include/validar_sesion.php';
include 'menu.html';

$conex = new database;
$con = $conex->conectar();
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <link rel="stylesheet" href="../css/styles_admin.css">
</head>
<body>    
  <a href="crear_usuario.php">Crear Nuevo Usuario</a>

  <table border="2">
    <tr>
      <td>Documento</td>
      <td>Tipo Documento</td>
      <td>Nombre</td>
      <td>Correo</td>
      <td>Teléfono</td>
      <td>Biblioteca</td>
      <td>Estado</td>
      <td>Actualizar</td>
      <td>Eliminar</td>
    </tr>

    <?php
    $sql = $con->prepare("
      SELECT usuarios.documento, tipo_documento.tipo_documento AS tipo_doc_nombre, usuarios.nombre, 
             usuarios.correo, usuarios.telefono, estado.estado, bibliotecas.nom_biblioteca
      FROM usuarios
      INNER JOIN tipo_documento ON usuarios.tipo_documento = tipo_documento.id_tipo
      INNER JOIN bibliotecas ON usuarios.nit_biblioteca = bibliotecas.nit_biblioteca
      INNER JOIN estado ON usuarios.id_estado = estado.id_estado
      WHERE usuarios.id_rol = 1
    ");
    $sql->execute();
    $usuarios = $sql->fetchAll(PDO::FETCH_ASSOC);

    foreach ($usuarios as $usuario) {
    ?>
      <tr>
        <td><input type="text" readonly value="<?php echo $usuario['documento']; ?>"></td>
        <td><input type="text" readonly value="<?php echo $usuario['tipo_doc_nombre']; ?>"></td>
        <td><input type="text" readonly value="<?php echo $usuario['nombre']; ?>"></td>
        <td><input type="text" readonly value="<?php echo $usuario['correo']; ?>"></td>
        <td><input type="text" readonly value="<?php echo $usuario['telefono']; ?>"></td>
        <td><input type="text" readonly value="<?php echo $usuario['nom_biblioteca']; ?>"></td>
        <td><input type="text" readonly value="<?php echo $usuario['estado']; ?>"></td>
        
        <td>
        <a href="" onclick="window.open('actualizar.php?documento=<?php echo $usuario['documento']; ?>', '', 'width=600,height=500,toolbar=NO'); return false;">
        <img src="../img/actualizar.png" width="35" height="35">
          </a>
        </td>
        <td>
          <a href="delete_user.php?documento=<?php echo $usuario['documento']; ?>" 
            onclick="return confirm('¿Desea eliminar el registro?')">
              <img src="../img/eliminar.png" width="35" height="35">
          </a>
       </td>

      </tr>
    <?php
    }
    ?>
  </table>
</body>
</html>
