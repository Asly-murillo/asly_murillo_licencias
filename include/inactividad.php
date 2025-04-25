<?php
    require_once ('../cone.php');
    $conex = new database;
    $con = $conex ->conectar();

    $inactivo = 600;
    

    //Comprobamos si esta definida la sesión 'tiempo'.
    if(isset($_SESSION['time']) ) {


        //Calculamos tiempo de vida inactivo.
        $tiem_session = time() - $_SESSION['time'];

            //Compraración para redirigir página, si la vida de sesión sea mayor a el tiempo insertado en inactivo.
            if($tiem_session > $inactivo)
            {

                //Removemos sesión.
                session_unset();
                //Destruimos sesión.
                session_destroy();              
                //Redirigimos pagina.

                echo '<script>alert("La sesión expiró")</script>';
                echo '<script>window.location.href = "../login.php";</script>';

                exit();
            }

    }
    $_SESSION['time'] = time();
?>