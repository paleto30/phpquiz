<?php

namespace App\Models;

use Config\Database\Conexion;
use Exception;

class  RegionModel
{   

    public function __construct(private $nombreReg, private $idDep, private $idReg = null)
    {
        $this->nombreReg = $nombreReg;
        $this->idDep = $idDep;
        $this->idReg = $idReg;
    }

    public function __set($name, $value)
    {
        if (property_exists($this, $name)) {
                $this->$name = $value;
        }else{
            throw new Exception("Propiedad invalida: " . $name);
        }
    }

    public function __get($name)
    {
        if (property_exists($this, $name)) {
            return $this->$name;
        }else{
            throw new Exception("Propiedad invalida: " . $name);
        }
    }


    public function toString()
    {
        return [
            'id' => $this->idReg,
            'idDep' => $this->idDep,
            'nombreReg' => $this->nombreReg,
        ];
    }
  
    
    /**
     *          funcion get para todos los registros 
    */
    public static function get()
    {
        try {
            $db = new Conexion;
            $query = "select * from region";
            $stament = $db->connect()->prepare($query);
            $stament->execute();
            $region = $stament->fetchAll(\PDO::FETCH_ASSOC);
            $db->closed();
            return $region;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }


    /* 
            funcion para buscar un registro por id
    */
    public static function Find($id)
    {
        try {  
            $db = new Conexion;
            $query = "select * from region where idReg= ?";
            $stament = $db->connect()->prepare($query);
            $stament->execute([$id]);
            $result = $stament->fetch(\PDO::FETCH_ASSOC);            
            $region = new self($result['nombreReg'],$result['idDep'],$result['idReg']);
            $db->closed();
            if ($region->idDep !== null) {
                return $region;
            }
            return null;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /* 
            funcion para insertar un registro 
    */
    public function save()
    {
        try {
            $db = new Conexion;
            $query = "insert into region (nombreReg, idDep) values ( ?, ? )";
            $stament = $db->connect()->prepare($query);
            $ok = $stament->execute([$this->nombreReg, $this->idDep]);
            $db->closed();
            return $ok;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }


    /* 
            funcion para actualizar un registro 
    */
    public  function update()
    {
        try {
            $db = new Conexion;
            $query = "update region set nombreReg = ?, idDep = ?  where idReg = ?";
            $stament = $db->connect()->prepare($query);
            $ok = $stament->execute([$this->nombreReg, $this->idDep, $this->idReg]);
            $db->closed();
            return $ok;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /*
            funcion para actualizar un registro 
    */
    public function delete()
    {
        try {
            $db = new Conexion;
            $query = "delete from region where idReg = ?";
            $stament = $db->connect()->prepare($query);
            $ok = $stament->execute([$this->idReg]);
            $db->closed();
            return $ok;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

}

?>
