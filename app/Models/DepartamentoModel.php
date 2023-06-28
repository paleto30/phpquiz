<?php

namespace App\Models;

use Config\Database\Conexion;
use Exception;

class  DepartamentoModel
{   

    public function __construct(private $nombreDep, private $idPais, private $idDep = null)
    {
        $this->nombreDep = $nombreDep;
        $this->idPais = $idPais;
        $this->idDep = $idDep;
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
            'id' => $this->idDep,
            'idPais' => $this->idPais,
            'nombreDep' => $this->nombreDep,
        ];
    }
  
    
    /**
     *          funcion get para todos los registros 
    */
    public static function get()
    {
        try {
            $db = new Conexion;
            $query = "select * from departamento";
            $stament = $db->connect()->prepare($query);
            $stament->execute();
            $departamento = $stament->fetchAll(\PDO::FETCH_ASSOC);
            $db->closed();
            return $departamento;
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
            $query = "select * from departamento where idDep= ?";
            $stament = $db->connect()->prepare($query);
            $stament->execute([$id]);
            $result = $stament->fetch(\PDO::FETCH_ASSOC);            
            $departamento = new self($result['nombreDep'],$result['idPais'],$result['idDep']);
            $db->closed();
            if ($departamento->idPais !== null) {
                return $departamento;
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
            $query = "insert into departamento (nombreDep, idPais) values ( ?, ? )";
            $stament = $db->connect()->prepare($query);
            $ok = $stament->execute([$this->nombreDep, $this->idPais]);
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
            $query = "update departamento set nombreDep = ?, idPais = ?  where idDep = ?";
            $stament = $db->connect()->prepare($query);
            $ok = $stament->execute([$this->nombreDep, $this->idPais, $this->idDep]);
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
            $query = "delete from departamento where idDep = ?";
            $stament = $db->connect()->prepare($query);
            $ok = $stament->execute([$this->idPais]);
            $db->closed();
            return $ok;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

}

?>