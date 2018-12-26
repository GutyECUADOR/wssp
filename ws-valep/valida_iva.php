<?php
include_once ('../ws-admin/acceso_multi_db.php');
$conexion_vales = getDataBase(008); //Cod 008 Empresa MODELO

$cod_ingresado = $_GET['activo'];

$consulta_IVA = "SELECT * FROM dbo.INV_IVA WHERE CODIGO = '$cod_ingresado'";
$result_query = odbc_exec($conexion_vales, $consulta_IVA);

if (odbc_num_rows($result_query)>=1)
    {
    $iva_val= odbc_result($result_query,"VALOR");
    echo $iva_val;
    }  else
    {    
    echo 12;  
    }