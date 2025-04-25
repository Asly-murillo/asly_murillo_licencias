<?php
session_start();
require_once('../include/conexion.php');
include '../include/validar_sesion.php';
include 'menu.html';

$conex = new database;
$con = $conex->conectar();

// Procesar formulario
if (isset($_POST['crear'])) {
    $nom_libro = $_POST['nom_libro'];
    $autor = $_POST['autor'];
    $categoria = $_POST['categoria'];
    $editorial = $_POST['editorial'];
    $fecha_publicacion = $_POST['fecha_publicacion'];
    $cantidad = $_POST['cantidad'];

    // Validación simple
    if ($nom_libro == "" || $autor == "" || $categoria == "" || $editorial == "" || $fecha_publicacion == "" || $cantidad == "") {
        echo '<script>alert("Todos los campos son obligatorios.");</script>';
    } else {
        $sql = "INSERT INTO libros (nom_libro, autor, categoria, editorial, fecha_publicacion, cantidad) 
                VALUES ('$nom_libro', '$autor', '$categoria', '$editorial', '$fecha_publicacion', '$cantidad')";
        $con->query($sql);

        echo '<script>alert("Libro agregado exitosamente.");</script>';
        echo '<script>window.location="ver_libros.php";</script>';
    }
}

// Cargar datos de autores, categorías y editoriales
$autores = $con->query("SELECT * FROM autor")->fetchAll(PDO::FETCH_ASSOC);
$categorias = $con->query("SELECT * FROM categoria")->fetchAll(PDO::FETCH_ASSOC);
$editoriales = $con->query("SELECT * FROM editorial")->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Agregar Libro</title>
    <link rel="stylesheet" href="../css/styles_admin.css">

    
</head>
<body>
    <h2>Agregar Nuevo Libro</h2>
    <form method="POST">
        <label>Nombre del libro:</label><br>
        <input type="text" name="nom_libro" required><br><br>

        <label>Autor:</label><br>
        <select name="autor" required>
            <option value="">Seleccione autor</option>
            <?php foreach ($autores as $a): ?>
                <option value="<?= $a['id_autor'] ?>"><?= $a['autor'] ?></option>
            <?php endforeach; ?>
        </select><br><br>

        <label>Categoría:</label><br>
        <select name="categoria" required>
            <option value="">Seleccione categoría</option>
            <?php foreach ($categorias as $c): ?>
                <option value="<?= $c['id_categoria'] ?>"><?= $c['categoria'] ?></option>
            <?php endforeach; ?>
        </select><br><br>

        <label>Editorial:</label><br>
        <select name="editorial" required>
            <option value="">Seleccione editorial</option>
            <?php foreach ($editoriales as $e): ?>
                <option value="<?= $e['id_editorial'] ?>"><?= $e['editorial'] ?></option>
            <?php endforeach; ?>
        </select><br><br>

        <label>Fecha de publicación:</label><br>
        <input type="date" name="fecha_publicacion" required><br><br>

        <label>Cantidad:</label><br>
        <input type="number" name="cantidad" min="1" required><br><br>

        <input type="submit" name="crear" value="Agregar libro">
    </form>
</body>
</html>
