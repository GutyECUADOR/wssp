<?php
require_once '../../ws-admin/acceso_multi_db.php';

if (isset($_GET['ID_Vale']) && isset($_GET['ID_Empresa'])){
    
    $ID_Vale = $_GET['ID_Vale']; //Indica que codigo 
    $ID_empresa = $_GET['ID_Empresa']; // Indique codigo de empresa
    $db_empresa = getDataBase('009'); //Conexion a ODBC por ID (009 - WSSP)
    $db_empresaWINF = getDataBase($ID_empresa); //Conexion a ODBC por ID

    $query = "SELECT A.ID, A.TIPO, C.empresa, B.NOMBRE, A.FECHA, C.fechaPagos, C.total FROM dbo.VEN_CAB as A INNER JOIN dbo.COB_CLIENTES as B on A.CLIENTE = B.CODIGO INNER JOIN KAO_wssp.dbo.vales_perdida as C on C.cod_valep COLLATE Modern_Spanish_CI_AS = A.ID COLLATE Modern_Spanish_CI_AS WHERE c.estado = 0 AND c.empresa ='$ID_empresa' AND ID='$ID_Vale' AND A.TIPO IN ('SPA','SPB','SPC','SPD','SPE','SPF') AND ID IN (SELECT IDDoc FROM dbo.ORG_DOCUMENTOS WHERE Aprobado=1)ORDER BY A.TIPO, A.ID";
      
    if ($resultSet = odbc_exec($db_empresaWINF, $query) ){ // Constatacion de resultados
        
        $fechaINIPAGOS = odbc_result($resultSet,"fechaPagos");

        $dateINIPagosSpan = date("Ymd", strtotime($fechaINIPAGOS));
        $dateaddINIPagosSpan = date_create($dateINIPagosSpan);
        $dateadd8mas = date_format(date_add($dateaddINIPagosSpan, date_interval_create_from_date_string('15 days')), 'Y-m-d'); // Agregara X dias y devuelve formado Y-m-d
                 
        if (date('Y-m-d') > $dateadd8mas) {
            $rawdata = array(["status"=>'FAIL', "mensaje"=>'El vale se encuentra fuera de la fecha maxima de aprobacion', "IDvale"=>$ID_Vale, "empresa"=>$ID_empresa, "fechaPagos"=>$fechaINIPAGOS]); //Creacion de objeto
        }else{
            $rawdata = array(["status"=>'OK', "mensaje"=>'Vale dentro de fechas de aprobacion.', "IDvale"=>$ID_Vale, "empresa"=>$ID_empresa, "fechaPagos"=>$fechaINIPAGOS]); //Creacion de objeto
        }

        echo json_encode($rawdata);  
    } else{
        $rawdata = array(["status"=>'FAIL', "mensaje"=>'No se pudo obtener informacion de estado, informe a sistemas.']); //Creacion de objeto
            
        echo json_encode($rawdata);  
    }

}else {
    echo 'Peticion invalida, parámetro requerido';
}