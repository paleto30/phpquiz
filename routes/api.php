<?php

namespace Routes;

use Dotenv\Dotenv;
use Bramus\Router\Router;


// Router
$router = new Router();
$dotenv = Dotenv::createImmutable('./config/env/');
$dotenv->load();


// rutas para paises
$router->mount('/api/pais',function() use($router){
    // get todos los registros
    $router->get('/','App\Controllers\PaisController@getAllPaises');    
    // ruta para agregar un pais
    $router->post('/','App\Controllers\PaisController@insertPais');
    // ruta para actualizar un pais
    $router->put('/{id}','App\Controllers\PaisController@updatePais');
    // ruta para borrar un pais
    $router->delete('/{id}','App\Controllers\PaisController@deletePais');
});



// rutas para departamento 
$router->mount('/api/departamento', function() use($router){
    // get todos los registros
    $router->get('/','App\Controllers\DepartamentoController@getAllDepart'); 
    // ruta para agregar 
    $router->post('/','App\Controllers\DepartamentoController@insertDepart');
    // ruta para actualizar 
    $router->put('/{id}','App\Controllers\DepartamentoController@updateDepart');
    // ruta para borrar un 
    $router->delete('/{id}','App\Controllers\DepartamentoController@deleteDepart');
});



// rutas para region 
$router->mount('/api/region', function() use($router){
    // get todos los registros
    $router->get('/','App\Controllers\RegionController@getAllRegion'); 
    // ruta para agregar 
    $router->post('/','App\Controllers\RegionController@insertRegion');
    // ruta para actualizar 
    $router->put('/{id}','App\Controllers\RegionController@updateRegion');
    // ruta para borrar un 
    $router->delete('/{id}','App\Controllers\RegionController@deleteRegion');
});


$router->run();
?>