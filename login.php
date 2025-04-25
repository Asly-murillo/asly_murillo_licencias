<?php

    require_once ('include/conexion.php');
    $conex = new Database;
    $con = $conex ->conectar();
    session_start();

?>
<?php
    if (isset ($_POST['enviar'])){
        $documento = $_POST['documento'];
        $passw = $_POST['passw'];
    
        echo $doc, "/n" , $passw; 
        

        $insert = $con->prepare( "INSERT INTO usuarios (documento, passw) 
        Values ('$documento','$passw')");
        
    } 
?>


<!DOCTYPE html>
<html lang="es">
   <head>
     <title>Login</title>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1">
     <link rel="stylesheet" href="css/styles.css">
    <link href="js/js.css">
   </head>

   <header>
       <div id="header-inner">
        <a href="" id="logo">
            <img src="img/logo.png" alt="Logo">
        </a>
       </div>
   </header>

  <body onload="formulario.id_type.focus()">
      <div class="form-inner">
           <form action="include/inicio.php" name="formulario" method="post" enctype="multipart/form-data">
               <ul>
                  <h1>Inicio de sesion</h1>
                  <li>
                     <label for="id_type">Tipo de documento:</label>
                     <select name="id_type" id="id_type">
                         <option value="">Seleccione el tipo de documento</option>
                          <?php
                             $sql = $con->prepare("SELECT * FROM tipo_documento");
                             $sql->execute();
                             while ($fila = $sql->fetch(PDO::FETCH_ASSOC)) {
                                 echo "<option value=\"" . $fila['id_tipo'] . "\">" . $fila['tipo_documento'] . "</option>";
                                }
                          ?>
                     </select>
                 </li>

                  <li>
                      <label for="documento">documento</label>
                      <input type="number" tapindex="2" name="documento" id="documento" placeholder="Ingrese su documento">
                  </li>
            
                  <li>
                     <label for="passw">Contraseña</label>
                     <input type="password" tapindex="3" name="passw" id="passw" value="" maxlength="15" minlength="8" placeholder="Ingrese su contraseña">
                  </li>
           
                  <li>
                     <input type="submit" name="enviar" id="enviar" value="iniciar">
                   </li>
               </ul>
           </form>
      </div>
  </body>
</html>
