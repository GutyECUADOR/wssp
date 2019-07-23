<?php
require('EstadoVehiculo.php');

$estadoVehiculo = new EstadoVehiculo();
$result = $estadoVehiculo->getNewCodigo();
var_dump($result);

?>