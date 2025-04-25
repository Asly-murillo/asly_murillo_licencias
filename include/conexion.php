<?php

##$server = "127.0.0.1";
#$username = "root";
#$password = "";
#$database="ejer";


#$sql= mysqli_connect(hostname:$server, username:$username, password:$password, database:$database);

#if (!$sql){ 
   #echo "no hubo conexion con la base de datos";
#}
#else{
   #echo "tenemos conexion";
#}

class Database
{
    private $hostname = "localhost";
    private $database = "biblioteca";
    private $username = "root";
    private $password = "";
    private $charset = "utf8";

    public function conectar(): PDO
    {
        try {
            $conexion = "mysql:host=" . $this->hostname . ";dbname=" . $this->database . ";charset=" . $this->charset;
            $options = [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_EMULATE_PREPARES => false
            ];
            $pdo = new PDO($conexion, $this->username, $this->password, $options);
            return $pdo;
        } catch (Exception $e) {
            echo 'Error de conexión: ' . $e->getMessage();
            exit;
        }
    }
}
?>

