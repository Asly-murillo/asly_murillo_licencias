<?php
$conexion = mysqli_connect('localhost', 'root', '', 'biblioteca');

$id_libro = $_POST['libro'];

$sql = "SELECT imagen FROM libros WHERE id_libro = '$id_libro'";
$result = mysqli_query($conexion, $sql);

$cadena = "";

if ($ver = mysqli_fetch_assoc($result)) {
    $ruta = $ver['imagen'];
    $cadena .= '<img src="' . $ruta . '" alt="Imagen del libro" style="max-width: 100%; height: auto;">';

} else {
    $cadena = "No se encontro imagen.";
}

echo $cadena;
?>
