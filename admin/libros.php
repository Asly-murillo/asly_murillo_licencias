<?php
session_start();
require_once('../include/conexion.php');
include '../include/validar_sesion.php';
include 'menu.html';

$conex = new database;
$con = $conex->conectar();

$sql = "SELECT libros.id_libro, libros.nom_libro, 
               autor.autor, 
               categoria.categoria, 
               editorial.editorial
        FROM libros
        JOIN autor ON libros.autor = autor.id_autor
        JOIN categoria ON libros.categoria = categoria.id_categoria
        JOIN editorial ON libros.editorial = editorial.id_editorial";

$resultado = $con->query($sql);
$libros = $resultado->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Listado de Libros</title>
    <link rel="stylesheet" href="../css/styles_admin.css">

</head>
<body>
    <h2>Listado de Libros</h2>
    <a href="crear_libro.php">Agregar Nuevo Libro</a><br><br>
    <table border="2">
        <tr>
            <th>Id</th>
            <th>Nombre</th>
            <th>Autor</th>
            <th>Categoría</th>
            <th>Editorial</th>
        </tr>

        <?php foreach ($libros as $libro) { ?>
            <tr>
                <td><?php echo $libro['id_libro']; ?></td>
                <td><?php echo $libro['nom_libro']; ?></td>
                <td><?php echo $libro['autor']; ?></td>
                <td><?php echo $libro['categoria']; ?></td>
                <td><?php echo $libro['editorial']; ?></td>
            </tr>
        <?php } ?>
    </table>
</body>
</html>
