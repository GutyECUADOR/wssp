<?php
include('../ws-admin/acceso_multi_db.php');

$cod_ingresado = $_GET['dato_ci']; //Indica que usuario se buscara en la DB
$select_codWF = $_GET['cod_DataBase']; //Indica en que DB se realizara la busqueda

$conexion_ok = getDataBase($select_codWF);
//$consulta_user = "SELECT  CODIGO as CodCliente, RUC as Cedula, NOMBRE as NombreN  FROM dbo.COB_CLIENTES as A WHERE A.RUC='$cod_ingresado' AND CLASE='I' AND A.RUC  IN  (SELECT cedula  FROM dbo.ROL_EMPLEADOS WHERE Estatus = 'A')";
$consulta_user = "SELECT  A.CODIGO as CodCliente, RUC as Cedula, A.NOMBRE as NombreN FROM dbo.COB_CLIENTES as A INNER JOIN SBIOKAO.dbo.Empleados AS SBIO ON SBIO.Cedula COLLATE Modern_Spanish_CI_AS = a.RUC COLLATE Modern_Spanish_CI_AS WHERE A.RUC='$cod_ingresado' AND CLASE='I' AND A.RUC  IN  (SELECT cedula  FROM dbo.ROL_EMPLEADOS WHERE Estatus = 'A') AND SBIO.CodDpto IN ('EVA','ASI')";

$result_query_user = odbc_exec($conexion_ok, $consulta_user);

if (odbc_num_rows($result_query_user)>=1)
    {
    $cod_cli= trim(iconv("iso-8859-1", "UTF-8", odbc_result($result_query_user,"CodCliente")));
    $user_name= trim(iconv("iso-8859-1", "UTF-8", odbc_result($result_query_user,"NombreN")));
    $user_ci = trim(iconv("iso-8859-1", "UTF-8", odbc_result($result_query_user,"Cedula")));

    $rawdata = array(["Cod_Cliente"=>$cod_cli, "Nombre"=>$user_name, "Cedula"=>$user_ci]);

    echo json_encode($rawdata);  
    }  else
    {
       $rawdata = ""; 
    echo json_encode($rawdata);  
    }