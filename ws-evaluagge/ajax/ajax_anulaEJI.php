<?php
require_once '../../ws-admin/acceso_multi_db.php';

if (isset($_GET['ID_EJI']) && isset($_GET['ID_Empresa'])){
    
    $ID_EJI = $_GET['ID_EJI']; //Indica que codigo 
    $ID_empresa = $_GET['ID_Empresa']; // Indique codigo de empresa
    $db_empresa = getDataBase('009'); //Conexion a ODBC por ID (009 - WSSP)
    
    //UPDATE anulado en WSSP
    $query = "UPDATE dbo.CAB_EJI SET estado = 2 WHERE codigo = '$ID_EJI'"; //Query
   
    if (odbc_exec($db_empresa, $query)){ // Constatacion de resultados
        
        $rawdata = array(["status"=>'OK', "mensaje"=>'Evaluacion establecida como anulada correctamente.', "IDvale"=>$ID_EJI, "empresa"=>$ID_empresa]); //Creacion de objeto
        echo json_encode($rawdata);  
    } else{
        $rawdata = array(["status"=>'FAIL', "mensaje"=>'No se anulo correctamente, informe a sistemas.']); //Creacion de objeto
            
        echo json_encode($rawdata);  
    }

}else {
    echo 'Peticion invalida, parámetro requerido';
}