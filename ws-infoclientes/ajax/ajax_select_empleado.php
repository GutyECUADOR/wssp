<?php
include('../../ws-admin/acceso_db_sbio.php');

$select_codWF = $_GET['cod_WF'];
$var_excluyente = $_GET['excluyente'];
$arrayResultados = array(); // Array para los resultados
$consulta_empleado = "SELECT * FROM dbo.Empleados with (nolock) WHERE TipoCargo != 4 and Nombre != 'ADMIN' and Estatus='A' AND Empresa_WF='$select_codWF' ORDER BY Apellido";
$result_query = odbc_exec($conexion_sbio, $consulta_empleado);

while(odbc_fetch_row($result_query))
{
    $cod_empleado =  rtrim(iconv("iso-8859-1", "UTF-8",odbc_result($result_query,"Codigo"))); 
    $cedula =  rtrim(iconv("iso-8859-1", "UTF-8",odbc_result($result_query,"cedula"))); 
    $nombre = rtrim(iconv("iso-8859-1", "UTF-8",odbc_result($result_query,"Nombre"))); 
    $apellido = rtrim(iconv("iso-8859-1", "UTF-8",odbc_result($result_query,"Apellido"))); 
    $empresa = rtrim(iconv("iso-8859-1", "UTF-8",odbc_result($result_query,"Empresa_WF"))); 

    $arrayItem = array(
                    "codigo" => $cod_empleado, 
                    "cedula" => $cedula,
                    "nombre" => $nombre,
                    "apellido" => $apellido,
                    "codEmpresa" => $empresa
                    );
    
    array_push($arrayResultados, $arrayItem);
}

    if ($result_query){
        $arrayRespuesta = array("status" => 'OK', "resultados" => $arrayResultados); // Objeto principal de resupuesta
        echo json_encode($arrayRespuesta);
    }else{
        $arrayRespuesta = array("status" => 'FAIL', "mensajeError" => 'No existieron resultados o parametro requerido no indicado.',"resultados" => null); // Objeto principal de resupuesta
        echo json_encode($arrayRespuesta);
    }

    
