<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require_once  './vendor/autoload.php';

class EstadoVehiculo { 
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
    
    function test() { 
        echo 'test';
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

    public function getNewCodigo($tipo='EST'){
        $query = "SELECT '$tipo'+RIGHT('000000'+ISNULL(CONVERT (Varchar , (SELECT COUNT(*)+1 FROM dbo.CAB_estado_vehiculo)),''),6) as codigo";
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

    public function getItems($tipo){
        $query = "SELECT * FROM dbo.ITEMS_estado_vehiculos WHERE activo='1' and tipo='$tipo'";
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

    public function getVehiculoByPlaca($placa, $empresa='008'){
        $dataBaseName = $this->getDBNameByCodigo($empresa)['NameDatabase'];
        $this->instanciaDB->setDbname($dataBaseName);
        $this->empresa_db = $this->instanciaDB->getInstanciaCNX();
      
        $query = "SELECT * FROM dbo.ACT_ARTICULOS WHERE Codigo='$placa'";
        $stmt = $this->empresa_db->prepare($query); 
        try{
            $stmt->execute();
            return $stmt->fetch( \PDO::FETCH_ASSOC );
        }catch(PDOException $exception){
            return array('status' => 'error', 'mensaje' => $exception->getMessage() );
        }
    }

    public function saveSolicitud($solicitud){
        $newCod = $this->getNewCodigo('EST')["codigo"];
        $query = "
            INSERT INTO 
                dbo.CAB_estado_vehiculo 
            VALUES ('$newCod','$solicitud->empresa','$solicitud->vehiculo','$solicitud->kilometraje','','$solicitud->empleado','$solicitud->fecha','$solicitud->observacion',0)
        ";

        try{
            $stmt = $this->wssp_db->prepare($query); 
            $stmt->execute();
            return $this->saveSolicitudMOV($solicitud->items, $newCod);
            
        }catch(PDOException $exception){
            return array('error' => TRUE, 'status' => 'error', 'mensaje' => $exception->getMessage() );
        }

    }

    public function saveOrdenPedido($solicitud){
        $newCod = $this->getNewCodigo('ODP')["codigo"];
        $query = "
            INSERT INTO 
                dbo.CAB_estado_vehiculo 
            VALUES ('$newCod','$solicitud->empresa','$solicitud->vehiculo','$solicitud->kilometraje','','$solicitud->empleado','$solicitud->fecha','$solicitud->observacion',0)
        ";

        try{
            $stmt = $this->wssp_db->prepare($query); 
            $stmt->execute();
            return $this->saveSolicitudMOV($solicitud->items, $newCod);
            
        }catch(PDOException $exception){
            return array('error' => TRUE, 'status' => 'error', 'mensaje' => $exception->getMessage() );
        }

        
    }

    public function saveSolicitudMOV($arrayItems, $codigoCAB){
        $cont = 0;
        foreach ($arrayItems as $item) {
            $query = "
            INSERT INTO 
                dbo.MOV_estado_vehiculo 
            VALUES ('$codigoCAB','$item->codigo','$item->valor')
            ";
           
            $stmt = $this->wssp_db->prepare($query); 
            $stmt->execute();
            $cont++;
        }

        if ($cont>=1){
            return array('error' => FALSE, 'message' => 'Registro correcto', 'nuevoregistro' => $codigoCAB, 'itemsregistrados' => $cont );
           
        }
    }

    public function getAllVehiculos ($busqueda='', $empresa='008'){
        $query = "
        SELECT TOP 100
            vehiculo.Nombre as nombreVehiculo,
            vehiculo.Marca as marcaVehiculo,
            vehiculo.feccompra as fechaCompraVehiculo,
            SBIO.Apellido + SBIO.Nombre as nombreAsignadoA,
            wssp.*
        FROM
            ACT_ARTICULOS as vehiculo
        INNER JOIN KAO_wssp.dbo.CAB_estado_vehiculo as wssp on vehiculo.Codigo = wssp.placa COLLATE Modern_Spanish_CI_AS
        INNER JOIN SBIOKAO.dbo.Empleados as SBIO on SBIO.Cedula = wssp.asignadoA
        WHERE wssp.placa LIKE '".$busqueda."%' and wssp.empresa='$empresa'
        ORDER BY fecha DESC
        
        ";

        try{
            $stmt = $this->empresa_db->prepare($query); 
            $stmt->execute();
            return $stmt->fetchAll( \PDO::FETCH_ASSOC );
        }catch(PDOException $exception){
            return array('status' => 'error', 'mensaje' => $exception->getMessage() );
        }
    }

    public function get_CAB_estado_vehiculo ($codigo, $empresa='008'){

        $dataBaseName = $this->getDBNameByCodigo($empresa)['NameDatabase'];
        $this->instanciaDB->setDbname($dataBaseName);
        $this->empresa_db = $this->instanciaDB->getInstanciaCNX();

        $query = "
            
            SELECT 
                CAB.id,
                CAB.codigo,
                Activos.Codigo as placa,
                Activos.Nombre as detalleVehiculo,
                CAB.empresa as empresaCod,
                EMPRESA.Nombre as empresaName,
                CAB.kilometraje,
                CAB.aprobadoPor,
                CAB.asignadoA,
                SBIO.Nombre + SBIO.Apellido as nombreAsignado,
                CAB.fecha,
                CAB.observacion,
                CAB.estado
            FROM 
                dbo.ACT_ARTICULOS as Activos
                INNER JOIN KAO_wssp.dbo.CAB_estado_vehiculo as CAB on CAB.placa = Activos.Codigo COLLATE Modern_Spanish_CI_AS
                INNER JOIN SBIOKAO.dbo.Empleados as SBIO on SBIO.Cedula = CAB.asignadoA
                INNER JOIN SBIOKAO.dbo.Empresas_WF as EMPRESA on EMPRESA.Codigo = CAB.empresa
            WHERE 
                CAB.codigo ='$codigo'
        
        ";

        try{
            $stmt = $this->empresa_db->prepare($query); 
            $stmt->execute();
            return $stmt->fetch( \PDO::FETCH_ASSOC );
        }catch(PDOException $exception){
            return array('status' => 'error', 'mensaje' => $exception->getMessage() );
        }
    }

    public function get_MOV_estado_vehiculo ($codigo){

        $query = "
        SELECT
            MOV.id,
            MOV.codigo as codOrden,
            MOV.item as codItem,
            ITEMS.descripcion as descripcionItem,
            MOV.valor
        FROM 
            dbo.MOV_estado_vehiculo as MOV
            INNER JOIN dbo.ITEMS_estado_vehiculos AS ITEMS ON ITEMS.codigo = MOV.item
        WHERE MOV.codigo = '$codigo'
        
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
        $CAB_estado_vehiculo = $this->get_CAB_estado_vehiculo($codigo);
        $MOV_estado_vehiculo = $this->get_MOV_estado_vehiculo($codigo);
        $tipoDOC = substr($codigo, 0,3);
        $codEstado = $CAB_estado_vehiculo['estado'];

        function titulo ($tipoDOC){
            if ($tipoDOC == 'ODP') {
                return 'ORDEN DE PEDIDO';
            }else{
                return 'INFORME DE ESTADO DEL VEHICULO';
            }
        }

        function valoracion($tipoDOC, $valor){
            switch ($tipoDOC) {
                case 'ODP':
                    if ($valor == 1) {
                       return 'Realizar';
                    }else{
                        return 'Pendiente';
                    }
                    break;
                
                case 'EST':
                    if ($valor == 5) {
                       return 'Excelente';
                    }elseif ($valor == 4){
                        return 'Muy Bueno';
                    }elseif ($valor == 3){
                        return 'Bueno';
                    }elseif ($valor == 2){
                        return 'Regular';
                    }else{
                        return 'No dispone';
                    }
                    
                    break;
                

                default:
                    return 'Sin definir';
                    
                   
                    break;
            }
        }

        function estadoDocument($codEstado){
            if ($codEstado == 0) {
                return 'Pendiente aprobacion';
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
                         <h3>'. titulo($tipoDOC) .'</h3>
                         <h4>'.$empresaData["NomCia"].'</h4>
                         <h4>Direccion: '.$empresaData["DirCia"].'</h4>
                         <h4>Telefono: '.$empresaData["TelCia"].'</h4>
                         <h4>RUC: '.$empresaData["RucCia"].'</h4>
                        
                </div>
               
         
            </div>
         
             <div id="infoCliente" class="rounded">
                 <div class="cabecera"><b>Fecha:</b> '. $CAB_estado_vehiculo["fecha"].'</div>
                 <div class="cabecera"><b>Vehiculo:</b> '. $CAB_estado_vehiculo["detalleVehiculo"] .'( '. $CAB_estado_vehiculo["placa"].')</div>
                 <div class="cabecera"><b>Encargado:</b> '. $CAB_estado_vehiculo["nombreAsignado"] .'( '. $CAB_estado_vehiculo["asignadoA"].')</div>
                 <div class="cabecera"><b>Empresa:</b> '. $CAB_estado_vehiculo["empresaName"] .'( '. $CAB_estado_vehiculo["empresaCod"].')</div>
                 
             </div>
         
             <table class="items" width="100%" style="font-size: 9pt; border-collapse: collapse; " cellpadding="8">
                 <thead>
                     <tr>
                        <td width="5%">#</td>
                        <td width="15%">Item</td>
                        <td width="50%">Descripcion</td>
                        <td width="20%">Valoracion</td>
                         
                     </tr>
                 </thead>
             <tbody>
         
             <!-- ITEMS HERE -->
             ';
                 $cont = 1;
                 foreach($MOV_estado_vehiculo as $row){
                    
                     $html .= '
         
                     <tr>
                         <td align="center">'.$cont.'</td>
                         <td>'.$row["codOrden"].'-'.$row["codItem"].'</td>
                         <td>'.$row["descripcionItem"].'</td>
                         <td>'.valoracion($tipoDOC, $row["valor"]).'</td>
                        
                         
                     </tr>';
                     $cont++;
                     }
         
             $html .= ' 
             
         
             <!-- END ITEMS HERE -->
                 
             </tbody>
             </table>
 
             <div style="width: 100%;">
                 <p id="observacion">Observacion:'. $CAB_estado_vehiculo["observacion"] .'</p> 
            
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

    public function aprobarOrden($codOrden) {
        $query = "UPDATE dbo.CAB_estado_vehiculo SET estado = '1' WHERE codigo='$codOrden'";
        $stmt = $this->wssp_db->prepare($query); 
        try{
            $stmt->execute();
            return $stmt->rowCount();
        }catch(PDOException $exception){
            return array('status' => 'error', 'mensaje' => $exception->getMessage() );
        }
    }

    public function canDoPago($codOrden) {
        $query = "SELECT * FROM dbo.";
        $stmt = $this->wssp_db->prepare($query); 
        try{
            $stmt->execute();
            $exist = $stmt->rowCount();
            if ($exist == 0) {
                return TRUE;
            }else{
                return FALSE;
            }
        }catch(PDOException $exception){
            return array('status' => 'error', 'mensaje' => $exception->getMessage() );
        }
    }

    public function sendEmail($email, $codDocument, $addcotizacionPDF=false){
       
        $correoCliente = $email;

        //Correo de sender
        
        $smtpserver = DEFAULT_SMTP;
        $userEmail = DEFAULT_SENDER_EMAIL;
        $pwdEmail = DEFAULT_EMAILPASS; 

        $mail = new PHPMailer(true);  // Passing `true` enables exceptions
        try {
            //Server settings
            $mail->SMTPDebug = false;                                 // Enable verbose debug output 0->off 2->debug
            $mail->isSMTP();                                      // Set mailer to use SMTP
            $mail->Host = $smtpserver;  // Specify main and backup SMTP servers
            $mail->SMTPAuth = true;                               // Enable SMTP authentication
            $mail->Username = $userEmail;                 // SMTP username
            $mail->Password = $pwdEmail;                           // SMTP password
            $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
            $mail->Port = 587;                                    // TCP port to connect to

            //Recipients
            $mail->setFrom($userEmail);
            $mail->addAddress($correoCliente, 'Cliente KAO');     // Add a recipient
            
            //Content
            $mail->CharSet = "UTF-8";
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = 'KAO Sport - Orden de Pedido - ' . $codDocument;
            $mail->Body    = 'Se adjunta orden de pedido';
        
            // Adjuntos
            if ($addcotizacionPDF) {
                $mail->addStringAttachment($this->generaReporte($codDocument), 'orden_'.$codDocument.'.pdf');
            }
            
            $mail->send();
            $detalleMail = 'Correo ha sido enviado a : '. $correoCliente;
           
                $pcID = php_uname('n'); // Obtiene el nombre del PC

                $log  = "User: ".' - '.date("F j, Y, g:i a").PHP_EOL.
                "PCid: ".$pcID.PHP_EOL.
                "Detail: ".$detalleMail.PHP_EOL.
                "-------------------------".PHP_EOL;
                //Save string to log, use FILE_APPEND to append.

                file_put_contents('./logs/logMailOK.txt', $log, FILE_APPEND );
            
            return array('status' => 'ok', 'mensaje' => $detalleMail ); 

        } catch (Exception $e) {

                $pcID = php_uname('n'); // Obtiene el nombre del PC
                $log  = "User: ".' - '.date("F j, Y, g:i a").PHP_EOL.
                "PCid: ".$pcID.PHP_EOL.
                "Detail: ".$mail->ErrorInfo .' No se pudo enviar correo a: ' . $correoCliente . PHP_EOL.
                "-------------------------".PHP_EOL;
                //Save string to log, use FILE_APPEND to append.
                file_put_contents('./logs/logMailError.txt', $log, FILE_APPEND);
                $detalleMail = 'Error al enviar el correo. Mailer Error: '. $mail->ErrorInfo;
                return array('status' => 'false', 'mensaje' => $detalleMail ); 
            
        }

    }

    public function getInfoCliente($RUC) {

        //Query de consulta con parametros para bindear si es necesario.
        $query = " 
            
        SELECT 
            CLIENTE.CODIGO, 
            RTRIM(CLIENTE.NOMBRE) as NOMBRE, 
            RTRIM(CLIENTE.EMPRESA) as EMPRESA, 
            RTRIM(CLIENTE.RUC) as RUC, 
            RTRIM(CLIENTE.EMAIL) as EMAIL, 
            RTRIM(CLIENTE.FECHAALTA) as FECHAALTA, 
            RTRIM(CLIENTE.DIRECCION1) as DIRECCION, 
            RTRIM(CLIENTE.TELEFONO1) as TELEFONO, 
            RTRIM(VENDEDOR.CODIGO) as VENDEDOR,
            RTRIM(VENDEDOR.NOMBRE) as VENDEDORNAME,
            RTRIM(CLIENTE.LIMITECRED) as LIMITECRED, 
            RTRIM(CLIENTE.FPAGO) as FPAGO, 
            RTRIM(CLIENTE.DIASPAGO) as DIASPAGO, 
            RTRIM(CLIENTE.TIPOPRECIO) as TIPOPRECIO 
        FROM 
            dbo.COB_CLIENTES as CLIENTE INNER JOIN
            dbo.COB_VENDEDORES as VENDEDOR ON VENDEDOR.CODIGO = CLIENTE.VENDEDOR
        WHERE 
            RUC='$RUC'";  // Final del Query SQL 

       

        $stmt = $this->empresa_db->prepare($query); 
        try{
            if($stmt->execute()){
                return $resulset = $stmt->fetch( \PDO::FETCH_ASSOC );
                
            }else{
                return $resulset = false;
            }
            
        }catch(PDOException $exception){
            return array('status' => 'error', 'mensaje' => $exception->getMessage() );
        }
   
    }

    public function getInfoProducto($codigoProducto) {

        //Query de consulta con parametros para bindear si es necesario.
        $query = " 
            SELECT * FROM dbo.ITEMS_pagos_vehiculo WHERE codigoItem = '$codigoProducto'
        ";  // Final del Query SQL 

        
        $stmt = $this->wssp_db->prepare($query); 
        try{
                if($stmt->execute()){
                    return $resulset = $stmt->fetch( \PDO::FETCH_ASSOC );
                    
                }else{
                    return $resulset = false;
                }

        }catch(PDOException $exception){
            return array('status' => 'error', 'mensaje' => $exception->getMessage() );
        }
   
    }

} 