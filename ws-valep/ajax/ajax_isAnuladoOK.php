<?php
require_once '../../ws-admin/acceso_multi_db.php';

if (isset($_GET['ID_Vale']) && isset($_GET['ID_Empresa'])){
    
    $ID_Vale = $_GET['ID_Vale']; //Indica que codigo 
    $ID_empresa = $_GET['ID_Empresa']; // Indique codigo de empresa
    $db_empresa = getDataBase('009'); //Conexion a ODBC por ID (009 - WSSP)
    $db_empresaWINF = getDataBase($ID_empresa); //Conexion a ODBC por ID

    //UPDATE anulado en WSSP
    $query = "UPDATE dbo.vales_perdida SET estado = 2 WHERE cod_valep = '$ID_Vale' AND empresa = '$ID_empresa'"; //Query
    
    //UPDATE anulado en WINFENIX
    $queryWINF1 = "UPDATE dbo.VEN_CAB SET anulado = '1' WHERE ID = '$ID_Vale'";
    
    //UPDATE anulado en WINFENIX
    $queryWINF2 = "UPDATE dbo.ORG_DOCUMENTOS  SET Anulado = '1', Aprobado = '0', Negado = '1' WHERE IDDoc = '$ID_Vale'";
     
    if (odbc_exec($db_empresa, $query) && odbc_exec($db_empresaWINF, $queryWINF1) && odbc_exec($db_empresaWINF, $queryWINF2) ){ // Constatacion de resultados
        
        $rawdata = array(["status"=>'OK', "mensaje"=>'Vale anuado en todas las tablas correctamente.', "IDvale"=>$ID_Vale, "empresa"=>$ID_empresa]); //Creacion de objeto
        echo json_encode($rawdata);  
    } else{
        $rawdata = array(["status"=>'FAIL', "mensaje"=>'No se anulo correctamente, informe a sistemas.']); //Creacion de objeto
            
        echo json_encode($rawdata);  
    }

}else {
    echo 'Peticion invalida, parámetro requerido';
}