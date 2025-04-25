<?php
session_start();
require_once('../include/conexion.php');
include '../include/validar_sesion.php';
include 'menu.html';

$conex = new database;
$con = $conex->conectar();

if (isset($_POST['actualizar']) && isset($_POST['estado']) && isset($_POST['id_prestamo'])) {
    $nuevo_estado = $_POST['estado'];
    $id_prestamo = $_POST['id_prestamo'];

    $sql_update = "UPDATE prestamos SET estado = '$nuevo_estado' WHERE id_prestamo = '$id_prestamo'";
    $con->query($sql_update);
    echo '<script>alert("Estado actualizado correctamente.");</script>';
}

$sql1 = $con->prepare("
    SELECT prestamos.id_prestamo, prestamos.fe_prestamo, prestamos.fe_devolucion, usuarios.nombre, usuarios.documento,
           libros.nom_libro, estado_libro.id_estado_libro, estado_libro.estado_libro
    FROM prestamos
    JOIN usuarios ON prestamos.doc_usuario = usuarios.documento
    JOIN detalle_prestamo_libro ON prestamos.id_prestamo = detalle_prestamo_libro.id_prestamo
    JOIN libros ON detalle_prestamo_libro.id_libro = libros.id_libro
    JOIN estado_libro ON prestamos.estado = estado_libro.id_estado_libro
    ORDER BY prestamos.fe_prestamo DESC
");

$sql1->execute();
$registros = $sql1->fetchAll(PDO::FETCH_ASSOC);

$estados = $con->query("SELECT * FROM estado_libro")->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Historial de préstamos</title>
  <link rel="stylesheet" href="../css/styles_admin.css">

</head>
<body>

  <h2>Historial de préstamos</h2>
  <table border="2">
    <tr>
      <th>Documento</th>
      <th>Nombre</th>
      <th>Fecha de préstamo</th>
      <th>Libro</th>
      <th>Fecha de devolución</th>
      <th>Estado</th>
      <th>Actualizar</th>
    </tr>

    <?php foreach ($registros as $registro) { ?>
      <tr>
        <td><?php echo $registro['documento']; ?></td>
        <td><?php echo $registro['nombre']; ?></td>
        <td><?php echo $registro['fe_prestamo']; ?></td>
        <td><?php echo $registro['nom_libro']; ?></td>
        <td><?php echo $registro['fe_devolucion']; ?></td>
        <td>
          <form method="POST" style="display:flex;">
            <input type="hidden" name="id_prestamo" value="<?php echo $registro['id_prestamo']; ?>">
            <select name="estado">
              <?php foreach ($estados as $estado) { ?>
                <option value="<?php echo $estado['id_estado_libro']; ?>"
                  <?php if ($estado['id_estado_libro'] == $registro['id_estado_libro']) echo "selected"; ?>>
                  <?php echo $estado['estado_libro']; ?>
                </option>
              <?php } ?>
            </select>
        </td>
        <td>
            <button type="submit" name="actualizar">Guardar</button>
          </form>
        </td>
      </tr>
    <?php } ?>
  </table>

</body>
</html>
