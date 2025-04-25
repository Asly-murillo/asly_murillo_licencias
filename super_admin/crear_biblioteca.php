<?php
session_start();
require_once('../include/conexion.php');
include '../include/validar_sesion.php';
include 'menu.html';

$conex = new database;
$con = $conex->conectar();

if (isset($_POST['registrar'])) {
    $nit = $_POST['nit_biblioteca'];
    $nombre = $_POST['nom_biblioteca'];

    $verificar = $con->prepare("SELECT * FROM bibliotecas WHERE nit_biblioteca = ?");
    $verificar->execute([$nit]);

    if ($verificar->rowCount() > 0) {
        echo '<script>alert("Ya existe una biblioteca con ese NIT")</script>';
        echo '<script>window.location="crear_biblioteca.php"</script>';
        exit;
    }

    $insertar = $con->prepare("INSERT INTO bibliotecas (nit_biblioteca, nom_biblioteca) VALUES (?, ?)");
    $insertar->execute([$nit, $nombre]);

    echo '<script>alert("Biblioteca creada correctamente")</script>';
    echo '<script>window.location="ver_bibliotecas.php"</script>';

    }
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registrar Biblioteca</title>
    <link rel="stylesheet" href="../css/styles_admin.css">

</head>
<body>
    <h2>Registrar Nueva Biblioteca</h2>
    <form method="post">
        <table border="1">
            <tr>
                <td>NIT de la Biblioteca</td>
                <td><input type="text" name="nit_biblioteca" required></td>
            </tr>
            <tr>
                <td>Nombre de la Biblioteca</td>
                <td><input type="text" name="nom_biblioteca" required></td>
            </tr>
            <tr>
                <td colspan="2"><input type="submit" name="registrar" value="Registrar"></td>
            </tr>
        </table>
    </form>
</body>
</html>
