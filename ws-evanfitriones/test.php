<?php
require_once  './vendor/autoload.php';

$estadoVehiculo = new Evaluacion();

$result = $estadoVehiculo->getNewCodigo()["codigo"];
var_dump($result);


?>