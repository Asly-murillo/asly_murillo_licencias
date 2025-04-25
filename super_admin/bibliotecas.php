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
  <link rel="stylesheet" href="../css/styles_admin.css">

</head>
<body>    
  <a href="crear_biblioteca.php">Crear Nueva Biblioteca</a>

  <table border="2">
    <tr>
      <td>NIT Biblioteca</td>
      <td>Nombre Biblioteca</td>
      <td>Eliminar</td>
    </tr>

    <?php
    $sql = $con->prepare("SELECT * FROM bibliotecas");
    $sql->execute();
    $bibliotecas = $sql->fetchAll(PDO::FETCH_ASSOC);

    foreach ($bibliotecas as $biblio) {
    ?>
      <tr>
        <td><input type="text" readonly value="<?php echo $biblio['nit_biblioteca']; ?>"></td>
        <td><input type="text" readonly value="<?php echo $biblio['nom_biblioteca']; ?>"></td>
        
        <td>
          <a href="eliminar_biblioteca.php?nit_biblioteca=<?php echo $biblio['nit_biblioteca']; ?>" 
            onclick="return confirm('¿Desea eliminar esta biblioteca?')">
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
