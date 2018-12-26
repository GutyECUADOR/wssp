<?php
include_once ('../../ws-admin/acceso_multi_db.php');


$codDB = $_POST['select_empresaa'];
$ruc = $_POST['txt_ruc'];
$nombre = $_POST['txt_nombre'];
$direccion = $_POST['txt_direccion'];
$telefono = $_POST['txt_telefono'];

$conexion_DB = getDataBase($codDB); //Obtenemos conexion con base de datos segun codigo de la DB
            
    $SQLquery = "UPDATE dbo.COB_CLIENTES SET NOMBRE = '$nombre' ,DIRECCION1 = '$direccion', TELEFONO1='$telefono' WHERE RUC = '$ruc'";
    $result_query = odbc_exec($conexion_DB, $SQLquery);

if (!odbc_error()){
    $arrayRespuesta = array("status" => 'OK', "mensaje" => 'Actualizacion correcta.'); // Objeto principal de resupuesta
    echo json_encode($arrayRespuesta);
}else{
    $arrayRespuesta = array("status" => 'fail', "mensajeError" => 'No se pudo actualizar el registro'); // Objeto principal de resupuesta
    echo json_encode($arrayRespuesta);
}   