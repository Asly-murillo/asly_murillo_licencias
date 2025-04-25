<?php
session_start();
require_once('../include/conexion.php');
include '../include/validar_sesion.php';

$conex = new database;
$con = $conex->conectar();

if (isset($_GET['nit_biblioteca'])) {
    $nit = $_GET['nit_biblioteca'];

   
    $eliminar = $con->prepare("DELETE FROM bibliotecas WHERE nit_biblioteca = ?");
    $eliminar->execute([$nit]);

    echo '<script>alert("Biblioteca eliminada correctamente")</script>';
    echo '<script>window.location="bibliotecas.php"</script>';
    exit;
} else {
    echo '<script>alert("NIT de biblioteca no proporcionado")</script>';
    echo '<script>window.location="bibliotecas.php"</script>';
}
?>
