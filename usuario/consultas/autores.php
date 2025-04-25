<?php
$conexion = mysqli_connect('localhost', 'root', '', 'biblioteca');

$categoria = $_POST['categoria'];

$sql = "SELECT id_autor, autor FROM autor WHERE id_categoria = '$categoria'";
$result = mysqli_query($conexion, $sql);

$cadena = '<option value="">-- Seleccione el autor --</option>';

while ($ver = mysqli_fetch_assoc($result)) {
    $cadena .= '<option value="'.$ver['id_autor'].'">'.$ver['autor'].'</option>';
}
echo $cadena;
?>
