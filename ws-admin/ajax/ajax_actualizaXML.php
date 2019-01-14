<?php
$archivoXMLConfig = '../configuraciones.xml';
if (isset($_GET['nodo']) && isset($_GET['valor']) && file_exists($archivoXMLConfig)){

    $nodo = $_GET['nodo'];
    $valorNodo = $_GET['valor'];

    $configXML = simplexml_load_file($archivoXMLConfig);
    // update
    $configXML->$nodo = $valorNodo;
   
    // save the updated document
        $configXML->asXML($archivoXMLConfig);
        $rawdata = array(["status"=>'OK', "mensaje"=>'XML Actualizado']); //Creacion de objeto
        $dataArray = json_encode($rawdata);
        echo $dataArray;
      
        
}else {
    echo 'Peticion invalida, parámetro requerido o XML no encontrado';
}