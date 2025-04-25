<?php
  if (!isset($_SESSION['documento'])){
    unset($_SESSION["documento"]);
    unset($_SESSION["id_rol"]);
    unset($_SESSION["id_type"]);
    $_SESSION= array();

    session_destroy();
    session_write_close();
    echo '<script>alert("Ingrese credenciales de login")</script>';
    echo '<script>window.location="../login.php"</script>';
    exit();
  }


?>