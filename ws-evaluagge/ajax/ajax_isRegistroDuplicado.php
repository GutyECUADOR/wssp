<?php
require_once '../../ws-admin/acceso_multi_db.php';
require_once ('../../ws-admin/funciones.php'); // Acceso a funciones utiles

if (isset($_GET['txt_CIRUC']) && isset($_GET['select_empresaa']) && isset($_GET['seleccion_empleado'])){
    
    $solicitante = $_GET['txt_CIRUC'];
    $empleadoEV = $_GET['seleccion_empleado'];

    $desde = first_month_day();
    $hasta = ultimo_dia_EJI();

    $db_empresa = getDataBase('009'); //Conexion a ODBC por ID (009 - WSSP)
    
    //UPDATE anulado en WSSP
    $query = "SELECT * FROM CAB_EJI WHERE solicitante='$solicitante' AND empleado='$empleadoEV' AND estado='0' AND fecha BETWEEN '$desde' AND '$hasta'"; //Query
   
    if ($resultSet = odbc_exec($db_empresa, $query)){ // Constatacion de resultados
        
        if(odbc_num_rows($resultSet)>=1){
            $rawdata = array(["status"=>'FAIL', "mensaje"=>'Ya existe una evaluacion activa al empleado, para el periodo actual, si necesita reevaluar, solicite primero la anulacion de la evaluacion actual.']); //Creacion de objeto
            echo json_encode($rawdata);  
        }elseif(odbc_num_rows($resultSet)==0){
            $rawdata = array(["status"=>'TRUE', "mensaje"=>'Correcto: No existen solicitudes activas para el empleado actual.']); //Creacion de objeto
            echo json_encode($rawdata); 
        }else{
            $rawdata = array(["status"=>'FAIL', "mensaje"=>'No se ha podido determinar si existe una evaluacion activa, reporte a sistemas.']); //Creacion de objeto
            echo json_encode($rawdata);  
        }
       
    } else{
        $rawdata = array(["status"=>'FAIL', "mensaje"=>'No se ha podido consultar si existe una evaluacion activa, reporte a sistemas.']); //Creacion de objeto
   
        echo json_encode($rawdata);  
    }

}else {
    echo 'Peticion invalida, parámetro requerido';
}