<?php
require('EstadoVehiculo.php');

$estadoVehiculo = new EstadoVehiculo();
$result = $estadoVehiculo->getNewCodigo()["codigo"];
var_dump($result);

?>