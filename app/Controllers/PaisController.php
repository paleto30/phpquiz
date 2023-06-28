<?php

namespace App\Controllers;

use App\Models\PaisModel;

class PaisController
{


    /*
        funcion para obtener la lista de paises
    */

    public function getAllPaises()
    {
        try {
            $paises = PaisModel::get();
            echo json_encode([
                'message'=> 'consultado correctamente',
                'data' => $paises
            ]);
        } catch (\Throwable $th) {
           echo json_encode(['error'=> $th->getMessage()]);
        }
    }


    /*
         funcion para insertar registros
    */

    public function insertPais()
    {
        try {
            
            $datos = json_decode(file_get_contents('php://input'),true);
            $attribute = ['nombrePais'];
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

            $pais = new PaisModel(...$datos);
            if ($pais->save()) {
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
    public function updatePais($id)
    {
        try {
            $datos = json_decode(file_get_contents('php://input'),true);

            $pais = PaisModel::Find($id);

            if (isset($pais)) {
                $pais->nombrePais = $datos['nombrePais'];
               
                if ($pais->update()) {
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
    public function deletePais($id)
    {
        try {
            $pais = PaisModel::Find($id);   
            if ($pais) {
                
                if($pais->delete()){
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