<?php
  session_start();
  unset($_SESSION["documento"]);
  unset($_SESSION["id_rol"]);
  unset($_SESSION["id_type"]);
  unset($_SESSION["id_estado"]);

  session_destroy();
  session_write_close();

  header("Location: ../login.php")


?>