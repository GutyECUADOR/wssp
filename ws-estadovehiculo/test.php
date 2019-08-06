<?php
require_once  './vendor/autoload.php';

$estadoVehiculo = new EstadoVehiculo();
$tipoDOC = 'ORD';

/* $result = $estadoVehiculo->getNewCodigo()["codigo"];
var_dump($result); */

/* $result2 = $estadoVehiculo->getEmpresas();
var_dump($result2); */

/* $resultitems = $estadoVehiculo->getItems('EST');
var_dump($resultitems); */


/* $result3 = $estadoVehiculo->getEmpleadoByID('1710567569');
var_dump($result3); */

/* $result4 = $estadoVehiculo->getEmpleadoByID('1714020359');
var_dump($result4); */

/* $result = $estadoVehiculo->get_CAB_estado_vehiculo('EST000001');
var_dump($result);
 */

$datosEmpresa = $estadoVehiculo->getDatosEmpresaFromWINFENIX('008');
var_dump($datosEmpresa);

$newCodigo = $estadoVehiculo->getDatosDocumentsWINFENIXByTypo($tipoDOC,'002');
var_dump($newCodigo);

$newCodigo = $estadoVehiculo->getNextNumDocWINFENIX($tipoDOC,'008');
var_dump($newCodigo);

$newCodigoWith0 = $estadoVehiculo->formatoNextNumDocWINFENIX($newCodigo, '008');
var_dump($newCodigoWith0);

$new_cod_VENCAB = $datosEmpresa['Oficina'].$datosEmpresa['Ejercicio'].$tipoDOC.$newCodigoWith0;
var_dump($new_cod_VENCAB);

?>