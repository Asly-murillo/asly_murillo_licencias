<?php
    session_start();
    include '../include/validar_sesion.php';
    include 'encabezado.php';
    $conex = new database;
    $con = $conex ->conectar();
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>index</title>
    <link rel="stylesheet" href="../css/styles_admin.css">

</head>
<body>
    <ul>
        <li><a href="prestamo.php" class="current">Solicitar libro </a></li>
        <li><a href="historial_prestamos.php">Historial de libros prestados</a></li>
    </ul>
</body>
</html>

   