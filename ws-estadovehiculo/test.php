<?php
require_once  './vendor/autoload.php';

$estadoVehiculo = new EstadoVehiculo();

/* $result = $estadoVehiculo->getNewCodigo()["codigo"];
var_dump($result); */

$result2 = $estadoVehiculo->getEmpresas();
var_dump($result2);

$resultitems = $estadoVehiculo->getItems('EST');
var_dump($resultitems);


$result3 = $estadoVehiculo->getEmpleadoByID('1710567569');
var_dump($result3);

$result4 = $estadoVehiculo->getEmpleadoByID('1714020359');
var_dump($result4);


?>