<?php

require_once  './vendor/autoload.php';

class Evaluacion { 
    private $instanciaDB;
    public $wssp_db;
    public $sbio_db;
    public $empresa_db;
    public $defaulDataBase = "MODELOKIND_V7";
    
    function __construct() {
        
        $this->instanciaDB = new \models\conexion('KAO_wssp');
        $this->wssp_db = $this->instanciaDB->getInstanciaCNX();

        $this->instanciaDB = new \models\conexion('SBIOKAO');
        $this->sbio_db = $this->instanciaDB->getInstanciaCNX();

        $this->instanciaDB = new \models\conexion($this->defaulDataBase);
        $this->empresa_db = $this->instanciaDB->getInstanciaCNX();
        
    }
    
    public function getDBNameByCodigo($codigoDB){
        $query = "SELECT TOP 1 NameDatabase, Codigo FROM SBIOKAO.dbo.Empresas_WF WHERE Codigo = :codigo"; 
        $stmt = $this->sbio_db->prepare($query); 
        $stmt->bindParam(':codigo', $codigoDB); 
       
            if($stmt->execute()){
                $resulset = $stmt->fetch( \PDO::FETCH_ASSOC );
            }else{
                $resulset = false;
            }
        return $resulset;  
    }

    public function getNewCodigo($tipo='EVAN'){
        $query = "SELECT '$tipo'+RIGHT('000000'+ISNULL(CONVERT (Varchar , (SELECT COUNT(*)+1 FROM dbo.ev_anfitriones)),''),6) as codigo";
        $stmt = $this->wssp_db->prepare($query); 

        try{
            $stmt->execute();
            return $stmt->fetch( \PDO::FETCH_ASSOC );
        }catch(PDOException $exception){
            return array('status' => 'error', 'mensaje' => $exception->getMessage() );
        }
    }

    public function getEmpresas(){
        $query = "SELECT * FROM dbo.Empresas_WF with (nolock) WHERE Codigo IN ('001','002','006','008')";
        $stmt = $this->sbio_db->prepare($query); 

        try{
            $stmt->execute();
            return $stmt->fetchAll( \PDO::FETCH_ASSOC );
        }catch(PDOException $exception){
            return array('status' => 'error', 'mensaje' => $exception->getMessage() );
        }
    }

    public function getItems(){
        $query = "
            SELECT codItem, detalle FROM dbo.items_anfitriones WHERE estado='TRUE' ORDER BY ID
        ";
        $stmt = $this->wssp_db->prepare($query); 

        try{
            $stmt->execute();
            return $stmt->fetchAll( \PDO::FETCH_ASSOC );
        }catch(PDOException $exception){
            return array('status' => 'error', 'mensaje' => $exception->getMessage() );
        }
    }

    public function getEmpleadoByID($cedula){
        $query = "SELECT Codigo, Nombre, Apellido, Empresa_WF, Cedula FROM dbo.Empleados WHERE Cedula = '$cedula'";
        $stmt = $this->sbio_db->prepare($query); 

        try{
            $stmt->execute();
            return $stmt->fetch( \PDO::FETCH_ASSOC );
        }catch(PDOException $exception){
            return array('status' => 'error', 'mensaje' => $exception->getMessage() );
        }
    }

    public function getEmpleadosByDB($codigoDB){
        $query = "
            SELECT 
                Codigo,
                Cedula,
                Nombre,
                Apellido,
                Empresa_WF,
                CodDpto
            FROM 
                dbo.Empleados with (nolock) 
            WHERE TipoCargo != 4 
                AND Nombre != 'ADMIN' 
                AND Estatus='A' 
                AND CodDpto != 'EVA' 
                AND Empresa_WF = '$codigoDB'
            ORDER BY Apellido
        ";
        $stmt = $this->sbio_db->prepare($query); 

        try{
            $stmt->execute();
            return $stmt->fetchAll( \PDO::FETCH_ASSOC );
        }catch(PDOException $exception){
            return array('status' => 'error', 'mensaje' => $exception->getMessage() );
        }
    }

    public function validacod_seguridad($cedula, $codigo){
        $query = "SELECT Codigo,Cedula, Nombre, Apellido, Empresa_WF, CodDpto FROM dbo.Empleados with (nolock) WHERE Cedula='$cedula' AND Clave = '$codigo' AND CodDpto IN ('EVA','SUP','ASI','SSP')";
        $stmt = $this->sbio_db->prepare($query); 

        try{
            $stmt->execute();
            return $stmt->fetch( \PDO::FETCH_ASSOC );
        }catch(PDOException $exception){
            return array('status' => 'error', 'mensaje' => $exception->getMessage() );
        }
    }

    public function valida_cargoEmpleado($codigo, $empresa='008'){
        $dataBaseName = $this->getDBNameByCodigo($empresa)['NameDatabase'];
        $this->instanciaDB->setDbname($dataBaseName);
        $this->empresa_db = $this->instanciaDB->getInstanciaCNX();

        $query = "
        SELECT 
            SBIO.Codigo as codEmpleado,
            ROL.codigo as cedulaEmpleado, 
            ROL.cargo as codigoCargo, 
            Cargos.Nombre as descripcionCargo 
            FROM 
                dbo.ROL_EMPLEADOS as ROL 
            INNER JOIN SBIOKAO.dbo.Empleados as SBIO on SBIO.Cedula = ROL.codigo COLLATE Modern_Spanish_CI_AS
            INNER JOIN dbo.ROL_Cargos as Cargos ON ROL.cargo = Cargos.Codigo
    WHERE 
        SBIO.Codigo = '$codigo'
        ";
        $stmt = $this->empresa_db->prepare($query); 

        try{
            $stmt->execute();
            return $stmt->fetch( \PDO::FETCH_ASSOC );
        }catch(PDOException $exception){
            return array('status' => 'error', 'mensaje' => $exception->getMessage() );
        }
    }

    public function saveSolicitud($solicitud){
        $newCod = $this->getNewCodigo()["codigo"];
        $query = "
            INSERT INTO dbo.ev_anfitriones 
                (tipoDOC, empresa, supervisor, empleado, fecha, sumatoria, meta, observacion, estado)
            VALUES 
                ('$newCod', '$solicitud->empresa', '$solicitud->supervisor', '$solicitud->empleado', '$solicitud->fecha', '$solicitud->sumatoria', '$solicitud->porcentajeMeta', '$solicitud->observacion', '0');
        ";

        try{
            $stmt = $this->wssp_db->prepare($query); 
            $resultado = $stmt->execute();
            if ($resultado) {
                $movimientos = $this->saveSolicitudMOV($solicitud->items, $newCod);
            }
           
            return array('error' => false , 'insertCorrect' => $resultado, 'newCod' => $newCod);
            
        }catch(PDOException $exception){
            return array('error' => TRUE, 'status' => 'error', 'message' => $exception->getMessage() );
        }

    }
  
    public function saveSolicitudMOV($arrayItems, $codigoCAB){
        $cont = 0;
        foreach ($arrayItems as $item) {
            $query = "
            INSERT INTO 
                dbo.MOV_ev_anfitriones 
            VALUES ('$codigoCAB','$item->codigo','$item->valor')
            ";
           
            $stmt = $this->wssp_db->prepare($query); 
            $stmt->execute();
            $cont++;
        }

        if ($cont>=1){
            return array('error' => FALSE, 'itemsregistrados' => $cont );
           
        }
    }

    public function getAllEvaluaciones ($fechaINI, $fechaFIN, $empresa='008'){
       
        $query = "
        SELECT TOP 100
            evaluacion.id,
            evaluacion.tipoDoc as codEvaluacion,
            evaluacion.empresa,
            empresa.Nombre as nombreEmpresa,
            evaluacion.supervisor,
            supervisor.Apellido + supervisor.Nombre as nombreSupervisor,
            evaluacion.empleado,
            empleado.Apellido + empleado.Nombre as nombreEmpleado,
            evaluacion.fecha,
            evaluacion.sumatoria,
            evaluacion.observacion,
            evaluacion.meta,
            evaluacion.estado
            FROM dbo.ev_anfitriones as evaluacion
            LEFT JOIN SBIOKAO.DBO.Empleados AS empleado ON empleado.Codigo = evaluacion.empleado 
            LEFT JOIN SBIOKAO.dbo.Empleados AS supervisor ON supervisor.Cedula = evaluacion.supervisor
            INNER JOIN SBIOKAO.dbo.Empresas_WF as empresa ON empresa.Codigo = evaluacion.empresa
            WHERE
				evaluacion.fecha BETWEEN '$fechaINI' AND '$fechaFIN'
				AND evaluacion.empresa = '$empresa'
        ORDER BY id DESC

        
        ";

        try{
            $stmt = $this->wssp_db->prepare($query); 
            $stmt->execute();
            return $stmt->fetchAll( \PDO::FETCH_ASSOC );
        }catch(PDOException $exception){
            return array('status' => 'error', 'mensaje' => $exception->getMessage() );
        }
    }

    public function getEvaluacionByID ($ID=''){
       
        $query = "
        SELECT TOP 1
            evaluacion.id,
            evaluacion.tipoDoc as codEvaluacion,
            evaluacion.empresa,
            empresa.Nombre as nombreEmpresa,
            evaluacion.supervisor,
            supervisor.Apellido + supervisor.Nombre as nombreSupervisor,
            evaluacion.empleado,
            empleado.Apellido + empleado.Nombre as nombreEmpleado,
            evaluacion.fecha,
            evaluacion.sumatoria,
            evaluacion.observacion,
            evaluacion.meta,
            evaluacion.estado
            FROM dbo.ev_anfitriones as evaluacion
            LEFT JOIN SBIOKAO.DBO.Empleados AS empleado ON empleado.Codigo = evaluacion.empleado 
            LEFT JOIN SBIOKAO.dbo.Empleados AS supervisor ON supervisor.Cedula = evaluacion.supervisor
            INNER JOIN SBIOKAO.dbo.Empresas_WF as empresa ON empresa.Codigo = evaluacion.empresa
            WHERE evaluacion.id = '$ID'
        ORDER BY id DESC

        
        ";

        try{
            $stmt = $this->wssp_db->prepare($query); 
            $stmt->execute();
            return $stmt->fetch( \PDO::FETCH_ASSOC );
        }catch(PDOException $exception){
            return array('status' => 'error', 'mensaje' => $exception->getMessage() );
        }
    }

    public function getEvaluacion_MOV ($codEvaluacion=''){
       
        $query = "
            SELECT
                    detalle.*,
                    item.detalle
                    FROM dbo.MOV_ev_anfitriones as detalle
                    INNER JOIN dbo.items_anfitriones as item ON item.codItem = detalle.item
                WHERE evaluacion = '$codEvaluacion' 
        ";

        try{
            $stmt = $this->wssp_db->prepare($query); 
            $stmt->execute();
            return $stmt->fetchAll( \PDO::FETCH_ASSOC );
        }catch(PDOException $exception){
            return array('status' => 'error', 'mensaje' => $exception->getMessage() );
        }
    }

    public function generaReporte($codigo, $outputMode = 'S', $empresa='008'){

        $empresaData = $this->getInfoEmpresa($empresa);
        $evaluacion_CAB = $this->getEvaluacionByID($codigo);
        $evaluacion_MOV = $this->getEvaluacion_MOV($evaluacion_CAB['codEvaluacion']); 
      
        function estadoDocument($codEstado){
            if ($codEstado == 0) {
                return 'Pendiente revision';
            }elseif ($codEstado == 1) {
                return 'Aprobado';
            }else{
                return 'Por definir';
            }
        }
        
         $html = '
             
            <div style="width: 100%;">
         
                <div id="logosection">
                    <img id="logo" src="./assets/logo_dark.png" alt="Logo">
                </div>

                 
                <div id="informacion">
                         <h3>Evaluacion de Anfitriones</h3>
                         <h4>'.$empresaData["NomCia"].'</h4>
                         <h4>Direccion: '.$empresaData["DirCia"].'</h4>
                         <h4>Telefono: '.$empresaData["TelCia"].'</h4>
                         <h4>RUC: '.$empresaData["RucCia"].'</h4>
                        
                </div>
               
         
            </div>
         
             <div id="infoCliente" class="rounded">

             
                <div class="cabecera"><b>Codigo Evaluacion:</b> '.$evaluacion_CAB["codEvaluacion"].' </div>
                <div class="cabecera"><b>Fecha de Evaluacion:</b> '.$evaluacion_CAB["fecha"].' </div>
                <div class="cabecera"><b>Supervisor evaluador:</b> '.$evaluacion_CAB["nombreSupervisor"].'</div>
                <div class="cabecera"><b>Empleado evaluado:</b> '.$evaluacion_CAB["nombreEmpleado"].'</div>
                <div class="cabecera"><b>Puntaje:</b> '.$evaluacion_CAB["sumatoria"].'</div>
                <div class="cabecera"><b>% meta:</b> '.$evaluacion_CAB["meta"].'</div>
                
             </div>
             <span>Items evaluador</span>
         
            <table class="items" width="100%" style="font-size: 9pt; border-collapse: collapse; " cellpadding="8">
                 <thead>
                     <tr>
                        <td width="5%">#</td>
                        <td width="15%">Cod Item</td>
                        <td width="50%">Descripcion</td>
                        <td width="20%">Valoracion</td>
                         
                     </tr>
                 </thead>
             <tbody>
         
             <!-- ITEMS HERE -->
             ';
                 $cont = 1;
                 foreach($evaluacion_MOV as $row){
                    
                     $html .= '
         
                     <tr>
                         <td align="center">'.$cont.'</td>
                         <td>'.$row["item"].'</td>
                         <td>'.$row["detalle"].'</td>
                         <td>'.$row["valor"].'</td>
                        
                         
                     </tr>';
                     $cont++;
                     }
         
                   

             $html .= ' 
             
         
             <!-- END ITEMS HERE -->
                 
             </tbody>
             </table>';

             $html .= ' 
            
 
             <div style="width: 100%;">
                 <p id="observacion">Observacion: '.$evaluacion_CAB["observacion"].'</p> 
            
             </div>
         
             
         ';
 
         //==============================================================
         //==============================================================
         //==============================================================
 
         $mpdf = new \Mpdf\Mpdf();
 
         // LOAD a stylesheet
         $stylesheet = file_get_contents('./assets/reportesStyles.css');
         
         $mpdf->WriteHTML($stylesheet,1);	// The parameter 1 tells that this is css/style only and no body/html/text
 
         $html = mb_convert_encoding($html, 'UTF-8', 'UTF-8');
         $mpdf->SetTitle("Reporte Generado");
         $mpdf->SetHTMLHeader('
           <div id="cod">
                <h5 class="myheader">'.$CAB_estado_vehiculo["codigo"].'</h5>  
                <h5 class="myheader">Página: {PAGENO} de {nbpg}</h5>  
                <h5 class="myheader">'. estadoDocument($codEstado) .'</h5>  
           </div> ');
         $mpdf->WriteHTML($html);
         
         return $mpdf->Output('doc.pdf', $outputMode);
 
         //==============================================================
         //==============================================================
         //==============================================================
 
    }

    public function getInfoEmpresa($empresa='008'){
    
        $query = "SELECT NomCia, Oficina, Ejercicio, DirCia, TelCia, RucCia, Ciudad  FROM dbo.DatosEmpresa";
        $stmt = $this->empresa_db->prepare($query); 
        try{
            $stmt->execute();
            return $stmt->fetch( \PDO::FETCH_ASSOC );
        }catch(PDOException $exception){
            return array('status' => 'error', 'mensaje' => $exception->getMessage() );
        }
    }

} 