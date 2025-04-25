<?php
$conexion = mysqli_connect('localhost', 'root', '', 'biblioteca');

$autor = $_POST['autor'];

$sql = "SELECT id_libro, nom_libro FROM libros WHERE autor = '$autor'";
$result = mysqli_query($conexion, $sql);

$cadena = '<option value="">-- Seleccione el libro --</option>';

while ($ver = mysqli_fetch_assoc($result)) {
    $cadena .= '<option value="'.$ver['id_libro'].'">'.$ver['nom_libro'].'</option>';
}
echo $cadena;
?>
