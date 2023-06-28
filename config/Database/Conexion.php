<?php

namespace Config\Database;

use PDO;

class Conexion 
{

    private $host;
    private $dbname;
    private $user;
    private $password;
    private $pdo;


    public function __construct()
    {
        $this->host = $_ENV['HOST'];
        $this->dbname = $_ENV['DATABASE'];
        $this->user = $_ENV['USERNAME'];
        $this->password = $_ENV['PASSWORD'];
        try {
            $dsn = "mysql:host=".$this->host.';dbname='.$this->dbname;
            $this->pdo = new PDO($dsn,$this->user,$this->password);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            $this->pdo->setAttribute(PDO::ATTR_PERSISTENT,false);
            $this->pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            $this->pdo->setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND, "SET NAMES utf8mb4");
            $this->pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, true);
        } catch (\PDOException $e) {
            die('error'.$e);
        }
    }

    /* 
            esta funcion me permite obtener
            una conexion a la base de datos
    */
    public function connect()
    {
        try {
            return $this->pdo;
        } catch (\PDOException $e) {
            return [
                'message'=> 'Error al retornar conexion',
                'error' => $e->getMessage()
            ];
        }
    }

    /* 
            esta funcion me permite cerrar la conexion
            se espera que se utilize depues de cada
            llamado a la base de datos
    */
    public function closed()
    {
        $this->pdo = null;
    }


} 





?>