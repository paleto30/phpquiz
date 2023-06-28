<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json"); 

require_once './vendor/autoload.php'; // autoload
require_once './routes/api.php'; // archivo de donde vienen todas las rutas

?>