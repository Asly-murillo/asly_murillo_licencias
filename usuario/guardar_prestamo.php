<?php
session_start();
$conexion = mysqli_connect('localhost', 'root', '', 'biblioteca');

$doc_usuario = $_SESSION['documento'];
$id_libro = $_POST['id_libro'];
$fe_prestamo = $_POST['fe_prestamo'];

$fecha = new DateTime($fe_prestamo);
$fecha->modify('+10 days');
$fe_devolucion = $fecha->format('Y-m-d');
$id_estado = 1;

$sql = "INSERT INTO prestamos (doc_usuario, fe_prestamo, fe_devolucion, estado)
        VALUES ('$doc_usuario', '$fe_prestamo', '$fe_devolucion', '$id_estado')";
mysqli_query($conexion, $sql);

$id_prestamo = mysqli_insert_id($conexion);

$sql2 = "INSERT INTO detalle_prestamo_libro (id_prestamo, id_libro)
         VALUES ('$id_prestamo', '$id_libro')";
mysqli_query($conexion, $sql2);
?>
