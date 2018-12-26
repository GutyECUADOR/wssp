<?php
include('../ws-admin/acceso_db_sbio.php');

$cod_ingresado = $_GET['dato_ci'];

$consulta_user = "SELECT dbo.Empleados.Codigo as CodN, dbo.Empleados.Nombre as NombreN, Apellido, (dbo.Empresas_WF.Nombre) as EmpresaN, Cedula FROM dbo.Empleados INNER JOIN dbo.Empresas_WF on dbo.Empleados.Empresa_WF = dbo.Empresas_WF.Codigo WHERE Cedula='$cod_ingresado' ";

$result_query_user = odbc_exec($conexion_sbio, $consulta_user);

if (odbc_num_rows($result_query_user)>=1)
    {
    $cod_username = odbc_result($result_query_user,"CodN");
    $user_name= iconv("iso-8859-1", "UTF-8", odbc_result($result_query_user,"NombreN"));
    $user_apell = iconv("iso-8859-1", "UTF-8", odbc_result($result_query_user,"Apellido"));
    $user_empresa = iconv("iso-8859-1", "UTF-8", odbc_result($result_query_user,"EmpresaN"));
    $user_ci = iconv("iso-8859-1", "UTF-8", odbc_result($result_query_user,"Cedula"));

    $rawdata = array(["Codigo"=>$cod_username, "Nombre"=>$user_name, "Apellido"=>$user_apell, "EmpresaN"=>$user_empresa, "Cedula"=>$user_ci]);

    echo json_encode($rawdata);  
    }  else
    {
       $rawdata = ""; 
    echo json_encode($rawdata);  
    }