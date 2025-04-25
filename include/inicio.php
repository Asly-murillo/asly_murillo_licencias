<?php
    session_start();
    require_once ('conexion.php');
    $conex = new database;
    $con = $conex ->conectar();
    


    if($_POST['enviar']){
        
        $documento = $_POST['documento'];
        $id_type = $_POST['id_type'];
           
        if ($documento =='' || $_POST['passw']== ''|| $id_type == ''){
            echo '<script>alert("datos vacios")</script>';
            echo '<script>window.location="../login.php"</script>';
        }
        
        else{
            $pass_denc = htmlentities(addslashes($_POST['passw']));
        
            $sql = $con->prepare("SELECT * FROM usuarios WHERE documento = '$documento'");
            $sql->execute();
            $fila=$sql ->fetch();
    
            if ($fila['id_estado']==1 )
            {
                $_SESSION ['documento'] =$fila['documento'];
                $_SESSION ['id_type'] =$fila['id_rol'];
                $_SESSION ['id_estado'] =$fila['id_estado'];
        
                echo $_SESSION['documento'], $_SESSION['id_type'], $_SESSION['id_estado'];
                
                if($_SESSION['id_type']==2){
                    header("Location:../usuario/index.php");
                    exit();
                }
        
                if($_SESSION['id_type']==1){
                    header("Location:../admin/ver_usu.php");
                    exit();
                }
        
                if($_SESSION['id_type']==3){
                    header("Location:../super_admin/ver_usu.php");
                    exit();
                }
            }
            
            else{
                echo '<script>alert("credenciales no coinciden")</script>';
                echo '<script>window.location="../login_error.php"</script>';
            }
            
        
            
        }
            
        
    }
   
?>
