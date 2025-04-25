<?php
    session_start();
    require_once ('../include/conexion.php');
    include '../include/validar_sesion.php';
    $conex = new database;
    $con = $conex->conectar();

    if (isset($_GET['documento'])) {
        $documento = $_GET['documento'];

        $sql = "DELETE FROM usuarios WHERE documento = '$documento'";

        if ($con->exec($sql)) {
            echo '<script>alert("Usuario eliminado exitosamente"); window.location="ver_usu.php";</script>';
        } else {
            echo '<script>alert("Hubo un error al eliminar el usuario"); window.location="ver_usu.php";</script>';
        }
    } else {
    
        echo '<script>alert("Usuario no especificado"); window.location="ver_usu.php";</script>';
    }
?>
