<?php
include_once ('../../ws-admin/acceso_multi_db.php');

$select_codWF = $_GET['cod_WF'];
$ruc = $_GET['ruc'];

if (isset($select_codWF) && isset($ruc)) {
    $conexion_DB = getDataBase($select_codWF); 
    $arrayResultados = array(); // Array para los resultados
    $SQLquery = "SELECT TOP 1 * FROM dbo.COB_CLIENTES WHERE RUC = '$ruc'";
    $result_query = odbc_exec($conexion_DB, $SQLquery);

    while(odbc_fetch_row($result_query))
    {
        $cod_empleado =  rtrim(iconv("iso-8859-1", "UTF-8",odbc_result($result_query,"CODIGO"))); 
        $cedula =  rtrim(iconv("iso-8859-1", "UTF-8",odbc_result($result_query,"RUC"))); 
        $nombre = rtrim(iconv("iso-8859-1", "UTF-8",odbc_result($result_query,"NOMBRE"))); 
        $direccion = rtrim(iconv("iso-8859-1", "UTF-8",odbc_result($result_query,"DIRECCION1"))); 
        $telefono = rtrim(iconv("iso-8859-1", "UTF-8",odbc_result($result_query,"TELEFONO1")));
        $mail = rtrim(iconv("iso-8859-1", "UTF-8",odbc_result($result_query,"EMAIL"))); 
       
        $arrayItem = array(
                        "codigo" => $cod_empleado, 
                        "cedula" => $cedula,
                        "nombre" => $nombre,
                        "direccion" => $direccion,
                        "telefono" => $telefono,
                        "mail" => $mail
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

        

}else{
    $arrayRespuesta = array("status" => 'FAIL', "mensajeError" => 'No existieron resultados o parametro requerido no indicado.',"resultados" => null); // Objeto principal de resupuesta
    echo json_encode($arrayRespuesta);
}

