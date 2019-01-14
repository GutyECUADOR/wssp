<?php
$archivoXMLConfig = '../configuraciones.xml';
if (isset($_GET['tipoUser']) && isset($_GET['nodo']) && isset($_GET['valor'] ) && file_exists($archivoXMLConfig)){

    $tipoUser = $_GET['tipoUser'];
    $nodo = $_GET['nodo'];
    $valorNodo = $_GET['valor'];

    $configXML = simplexml_load_file($archivoXMLConfig);
    // update
    $nodoOK = $configXML->permisosUsuarios->$tipoUser->$nodo->attributes()->isActivo = $valorNodo;
   
    // save the updated document
        $configXML->asXML($archivoXMLConfig);
        $rawdata = array(["status"=>'OK', "mensaje"=>'XML Actualizado']); //Creacion de objeto
        $dataArray = json_encode($rawdata);
        echo $dataArray;
      
        
}else {
    echo 'Peticion invalida, parámetro requerido o XML no encontrado';
}