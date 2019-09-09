<?php
require_once  './vendor/autoload.php';

$estadoVehiculo = new Evaluacion();

/* $result = $estadoVehiculo->getNewCodigo()["codigo"];
var_dump($result); */

$evaluacion_CAB = $estadoVehiculo->getEvaluacionByID(940);
var_dump($evaluacion_CAB);

?>