<?php
include_once ('../ws-admin/acceso_multi_db.php');

$cod_ingresado = $_GET['cod_producto']; //Indica que producto se buscarà
$select_codWF = $_GET['cod_DataBase']; //Indica en que DB se realizara la busqueda
$conexion_vales_prod = getDataBase($select_codWF);

$consulta_sql = "SELECT Codigo, Nombre, PrecA FROM dbo.INV_ARTICULOS WHERE Codigo='$cod_ingresado'";
$result_query_sql = odbc_exec($conexion_vales_prod, $consulta_sql);

if (odbc_num_rows($result_query_sql)>=1)
    {
    $product_cod= iconv("iso-8859-1", "UTF-8", odbc_result($result_query_sql,"Codigo"));
    $product_nombre = trim(iconv("iso-8859-1", "UTF-8", odbc_result($result_query_sql,"Nombre")));
    $product_precio = iconv("iso-8859-1", "UTF-8", odbc_result($result_query_sql,"PrecA"));
    $rawdata = array(["codigo"=>$product_cod, "nombre"=>$product_nombre, "precio"=>$product_precio]);

    echo json_encode($rawdata);  
    }  else
    {
       $rawdata = ""; 
    echo json_encode($rawdata);  
    }