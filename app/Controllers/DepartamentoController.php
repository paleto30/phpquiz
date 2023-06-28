<?php

namespace App\Controllers;

use App\Models\DepartamentoModel;

class DepartamentoController
{


    /*
        funcion para obtener la lista de paises
    */
    public function getAllDepart()
    {
        try {
            $depart = DepartamentoModel::get();
            echo json_encode([
                'message'=> 'consultado correctamente',
                'data' => $depart
            ]);
        } catch (\Throwable $th) {
           echo json_encode(['error'=> $th->getMessage()]);
        }
    }


    /*
         funcion para insertar registros
    */
    public function insertDepart()
    {
        try {
            
            $datos = json_decode(file_get_contents('php://input'),true);
            $attribute = ['nombreDep','idPais'];
            // verificamos que los atributos no sean vacios y que tengan el nombre corecto
            foreach ($attribute as $key) {
                if (!isset($datos[$key]) || empty(trim($datos[$key]))) {
                    http_response_code(400);
                    echo  json_encode([
                        'error-message' => "Atributos incorrecto o Valores vacios"
                    ]);
                    return;
                }
            }
            // verificamos que no hayan atributos que no corresponden al modelo
            $extraKey = array_diff(array_keys($datos), $attribute);
            if (!empty($extraKey)) {
                http_response_code(400);
                echo  json_encode([
                    'error-message' => "Atributos que no corresponden al modelo"
                ]);
                return;
            }

            $depart = new DepartamentoModel(...$datos);
            if ($depart->save()) {
                http_response_code(201);
                echo json_encode(['message'=> 'creado correctamente']);
                return;
            }
            http_response_code(400);
            echo json_encode([
                'error-message' => 'NO se a creado el registro'
            ]);
            return;
        } catch (\Throwable $th) {
             echo json_encode(['error'=> $th->getMessage()]);
        }
    }


     /*
            funcion para actualizar un registro 
    */
    public function updateDepart($id)
    {
        try {
            $datos = json_decode(file_get_contents('php://input'),true);

            $depart = DepartamentoModel::Find($id);

            if (isset($depart)) {
                $depart->nombreDep = $datos['nombreDep'];
                $depart->idPais = $datos['idPais'];  
    
                if ($depart->update()) {
                    http_response_code(200);
                    echo json_encode([
                        'message' => 'Actualizado correctamente'
                    ]);
                    return;
                }

                http_response_code(304);
                echo json_encode([
                    'message' => 'Actualizacion fallida'
                ]);
                return; 
            }

            http_response_code(404);
            echo json_encode([
                'message' => "El registro id:$id no existe"
            ]);               
            return;

        } catch (\Throwable $th) {
            echo json_encode(['error'=> $th->getMessage()]);
        }
    }




    /**
     *      funcion para eliminar un registro 
    */
    public function deleteDepart($id)
    {
        try {
            $depart = DepartamentoModel::Find($id);   
            if ($depart) {
                
                if($depart->delete()){
                    http_response_code(200);
                    echo json_encode(['message'=> 'eliminado correctamente']);
                    return;
                }
                http_response_code(400);    
                echo json_encode(['error-message' => '']);
                return;
            }

            http_response_code(404);
            echo json_encode(['message'=> 'El registro que intenta eliminar no existe']);
            return;
        } catch (\Throwable $th) {
            echo json_encode(['error'=> $th->getMessage()]);
        }
    }


}


?>