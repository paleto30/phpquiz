<?php

namespace App\Models;

use Config\Database\Conexion;
use Exception;

class PaisModel 
{   

    public function __construct(private $nombrePais, private $idPais = null)
    {
        $this->nombrePais = $nombrePais;
        $this->idPais = $idPais;
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
            'id' => $this->idPais,
            'nombrePais' => $this->nombrePais,
        ];
    }
  
    
    /**
     *          funcion get para todos los registros 
    */
    public static function get()
    {
        try {
            $db = new Conexion;
            $query = "select * from pais";
            $stament = $db->connect()->prepare($query);
            $stament->execute();
            $paises = $stament->fetchAll(\PDO::FETCH_ASSOC);
            $db->closed();
            return $paises;
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
            $query = "select * from pais where idPais= ?";
            $stament = $db->connect()->prepare($query);
            $stament->execute([$id]);
            $result = $stament->fetch(\PDO::FETCH_ASSOC);            
            $pais = new self($result['nombrePais'],$result['idPais']);
            $db->closed();
            if ($pais->idPais !== null) {
                return $pais;
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
            $query = "insert into pais (nombrePais) values ( ? )";
            $stament = $db->connect()->prepare($query);
            $ok = $stament->execute([$this->nombrePais]);
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
            $query = "update pais set nombrePais = ?  where idPais = ?";
            $stament = $db->connect()->prepare($query);
            $ok = $stament->execute([$this->nombrePais, $this->idPais]);
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
            $query = "delete from pais where idPais= ?";
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