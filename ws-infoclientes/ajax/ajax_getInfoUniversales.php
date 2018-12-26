<?php

include_once ('../ws-admin/acceso_multi_db.php');

$codTenica = $_GET['codTenica'];
$nivel = $_GET['nivel'];

    $conexion = getDataBase('009'); //Cod 009 WSSP

    $query = "SELECT * FROM dbo.EJI_competencias_universales WHERE codItem='$codTenica' AND relevancia = '$nivel'";
    $resultset = odbc_exec($conexion, $query);

    if ($resultset){
        $detalle= trim(iconv("iso-8859-1", "UTF-8", odbc_result($resultset,"comportamientoObs")));   
        echo $detalle;
    }else
    {
         echo '(No se encontro descripción del indicador)';
    }
    





