<?php
session_start();
require_once ('../include/conexion.php');
include '../include/validar_sesion.php';
include 'encabezado.php';

$conex = new database;
$con = $conex ->conectar();

   $documento=$_SESSION['documento'];
   $sql = $con->prepare("SELECT prestamos.fe_prestamo,prestamos.fe_devolucion,usuarios.nombre,libros.nom_libro, estado.estado
        FROM prestamos JOIN usuarios ON prestamos.doc_usuario = usuarios.documento
        JOIN detalle_prestamo_libro ON prestamos.id_prestamo = detalle_prestamo_libro.id_prestamo
        JOIN libros ON detalle_prestamo_libro.id_libro = libros.id_libro
        JOIN estado ON prestamos.estado = estado.id_estado WHERE usuarios.documento = $documento ORDER BY prestamos.fe_prestamo DESC;");
   $sql->execute();
   $historial=$sql->fetch();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Historial de prestamos</title>
    <link rel="stylesheet" href="../css/styles_admin.css">

</head>
<body>
    <ul>
        <li><a href="index.php" class="current">Volver </a></li>
    </ul> 
  <table border="2">
    <tr>
      <td>Fecha de préstamo</td>
      <td>Libro</td>
      <td>Fecha para devolución</td>
      <td>Estado</td>
    </tr>

    <?php
    
    $sql1 = $con->prepare("SELECT prestamos.fe_prestamo, prestamos.fe_devolucion, libros.nom_libro, estado_libro.estado_libro
    FROM prestamos
    JOIN detalle_prestamo_libro ON prestamos.id_prestamo = detalle_prestamo_libro.id_prestamo
    JOIN libros ON detalle_prestamo_libro.id_libro = libros.id_libro
    JOIN estado_libro ON prestamos.estado = estado_libro.id_estado_libro
    WHERE prestamos.doc_usuario = $documento");

    $sql1->execute();

      $registros = $sql1->fetchAll(PDO::FETCH_ASSOC);

      foreach ($registros as $registro) {
    ?>

    <tr>
        <td><input type="text" readonly value="<?php echo $registro['fe_prestamo']; ?>"></td>
        <td><input type="text" readonly value="<?php echo $registro['nom_libro']; ?>"></td>
        <td><input type="text" readonly value="<?php echo $registro['fe_devolucion']; ?>"></td>
        <td><input type="text" readonly value="<?php echo $registro['estado_libro']; ?>"></td>
    </tr>

    <?php
      }
    ?>
  </table>
</body>