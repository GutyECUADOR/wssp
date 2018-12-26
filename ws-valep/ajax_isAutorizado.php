<?php
require_once '../../ws-admin/acceso_multi_db.php';

if (isset($_GET['ID_Vale']) && isset($_GET['ID_Empresa'])){
    
    $ID_Vale = $_GET['ID_Vale']; //Indica que codigo 
    $ID_empresa = $_GET['ID_Empresa']; // Indique codigo de empresa
    $db_empresa = getDataBase('009'); //Conexion a ODBC por ID
    $db_empresaWINF = getDataBase($ID_empresa); //Conexion a ODBC por ID

    $query = "SELECT cod_valep, tipo_doc, estado, empresa FROM dbo.vales_perdida WHERE empresa = '$ID_empresa' AND cod_valep='$ID_Vale' AND estado='1'"; //Query
    $resultset = odbc_exec($db_empresa, $query); //Ejecucion

    if (odbc_num_rows($resultset)>=1){ // Constatacion de resultados
        $vale= iconv("iso-8859-1", "UTF-8", odbc_result($resultset,"cod_valep")); //Recuperacion de data
        $empresaCOD= iconv("iso-8859-1", "UTF-8", odbc_result($resultset,"empresa")); //Recuperacion de data
        
        // Consulta si es SERV-075
        $querySERV = "SELECT * FROM dbo.VEN_MOV WITH(NOLOCK) WHERE ID = '$ID_Vale' AND CODIGO ='SERV-075' "; //Query
        $resultsetSERV = odbc_exec($db_empresaWINF, $querySERV); //Ejecucion

        if (odbc_num_rows($resultsetSERV)>=1){ // Comprobar si existe resultados
            $rawdata = array(["status"=>'OK', "mensaje"=>'El vale esta autorizado, tipo SERV-075 no requiere transferencia.', "IDvale"=>$vale, "empresa"=>$empresaCOD]); //Creacion de objeto
        }else{
            //Buscar en INV_CAB si existe el ID del vale
            $queryWINF = "SELECT NUMREL FROM dbo.INV_CAB WHERE NUMREL !=  '' AND NUMREL = '$ID_Vale'"; //Query
            $resultsetWINF = odbc_exec($db_empresaWINF, $queryWINF); //Ejecucion
            if (odbc_num_rows($resultsetWINF)>=1) {
                $rawdata = array(["status"=>'OK', "mensaje"=>'El vale esta autorizado y transferido.', "IDvale"=>$vale, "empresa"=>$empresaCOD]); //Creacion de objeto
            }else{
                $rawdata = array(["status"=>'FAIL', "mensaje"=>'El vale esta autorizado, pero pendiente de transferencia; Solicite a su supervisor la transferencia para poder imprimir.', "IDvale"=>$vale, "empresa"=>$empresaCOD]); //Creacion de objeto
            }
        }

        //Codificacion de objeto y resultado
        if($dataArray = json_encode($rawdata)){ 
            echo $dataArray;

        }else{
            $rawdata = array(["status"=>'FAIL', "mensaje"=>'No se pudo obtener informacion del estado del vale, informe a sistemas.', "IDvale"=>$vale]); //Creacion de objeto
            echo $dataArray;
        }
        
    } else{
        $rawdata = array(["status"=>'FAIL', "mensaje"=>'El vale no se encuentra aprobado, solicite aprobacion a administracion.']); //Creacion de objeto
            
        echo json_encode($rawdata);  
    }

}else {
    echo 'Peticion invalida, parámetro requerido';
}