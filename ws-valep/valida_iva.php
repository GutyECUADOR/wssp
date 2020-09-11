<?php
include_once ('../ws-admin/acceso_multi_db.php');

$cod_ingresado = $_GET['activo'];
$empresa = $_GET['empresa'];
$conexion = getDataBase($empresa);

$sql = "SELECT * FROM dbo.INV_IVA WHERE CODIGO = '$cod_ingresado'";
$result_query = odbc_exec($conexion, $sql);

if (odbc_num_rows($result_query)>=1){
    $iva_val = odbc_result($result_query,"VALOR");
    echo $iva_val;
} else{    
    echo 12;  
}