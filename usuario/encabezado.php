<?php
    session_start();
    require_once ('../include/conexion.php');
    include '../include/validar_sesion.php';
    $conex = new database;
    $con = $conex ->conectar();
    
?>
<?php
   $documento=$_SESSION['documento'];
   $sql = $con->prepare("SELECT * FROM usuarios WHERE documento = $documento");
   $sql->execute();
   $fila=$sql->fetch();

?>

<!DOCTYPE html>
<html lang="en">
<h1>bienvenido <?php echo $fila['nombre'] ;?></h1>
<link rel="stylesheet" href="../css/styles_admin.css">

<ul>
        <li><a href="../include/salir.php" class="current">Cerrar sesion </a></li>
    </ul> 
</html>