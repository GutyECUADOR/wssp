<?php
include_once ('../ws-admin/acceso_multi_db.php');
$conexion_vales = getDataBase(008); //Cod 008 Empresa MODELO

$cod_ingresado = $_GET['cod_usu_ing'];

$consulta_IVA = "SELECT * FROM dbo.COB_CLIENTES WHERE RUC = '$cod_ingresado'";

$result_query = odbc_exec($conexion_vales, $consulta_IVA);

if (odbc_num_rows($result_query)>=1)
    {
    $descuento_val= odbc_result($result_query,"PORTARJETAEFE");
    echo $descuento_val;

    }  else
    {    
    echo 0;  
    }
    
    