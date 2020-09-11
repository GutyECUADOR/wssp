<?php
include_once ('../ws-admin/acceso_multi_db.php');

$cod_ingresado = $_GET['cod_usu_ing'];
$empresa = $_GET['empresa'];
$conexion = getDataBase($empresa);

$sql = "SELECT * FROM dbo.COB_CLIENTES WHERE RUC = '$cod_ingresado'";

$result_query = odbc_exec($conexion, $sql);

if (odbc_num_rows($result_query)>=1){
    $descuento_val= odbc_result($result_query,"PORTARJETAEFE");
    echo $descuento_val;
} else {    
    echo 0;  
}
    
    