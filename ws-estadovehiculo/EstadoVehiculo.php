<?php
require_once ('../ws-admin/acceso_multi_db.php');

class EstadoVehiculo { 
    public $wssp_db;
    public $sbio_db;
    public $empresa_db;
    public $defaulDataBase = "008";

    function __construct() {
        $this->wssp_db = getDataBase('009');
        $this->sbio_db = getDataBase('010');
    }
    
    function test() { 
        echo 'test';
    }

    public function getNewCodigo($tipo='EST'){
        $query = "SELECT '$tipo'+RIGHT('000000'+ISNULL(CONVERT (Varchar , (SELECT COUNT(*)+1 FROM dbo.CAB_estado_vehiculo)),''),6) as codigo";
        $result = odbc_exec($this->wssp_db, $query); 
        return odbc_fetch_array($result);
    }

    public function getEmpresas(){
        $query = "SELECT * FROM dbo.Empresas_WF with (nolock) WHERE Codigo IN ('001','002','006','008')";
        $result = odbc_exec($this->sbio_db, $query); 
        return $result;
    }

    public function getItems($tipo){
        $query = "SELECT * FROM dbo.ITEMS_estado_vehiculos WHERE activo='1' and tipo='$tipo'";
        $result = odbc_exec($this->wssp_db, $query); 
        return $result;
    }

    public function getEmpleadoByID($cedula){
        $query = "SELECT Codigo, Nombre, Apellido, Empresa_WF, Cedula FROM SBIOKAO.dbo.Empleados WHERE Cedula = '$cedula'";
        $result = odbc_exec($this->sbio_db, $query); 
        return odbc_fetch_array($result);
    }

    public function getVehiculoByPlaca($placa, $empresa='008'){
        $this->empresa_db = getDataBase($empresa);
        $query = "SELECT * FROM dbo.ACT_ARTICULOS WHERE Codigo='$placa'";
        $result = odbc_exec($this->empresa_db, $query); 
        return odbc_fetch_array($result);
    }

    public function saveSolicitud($solicitud){
        $newCod = $this->getNewCodigo('EST')["codigo"];
        $query = "
            INSERT INTO 
                dbo.CAB_estado_vehiculo 
            VALUES ('$newCod','$solicitud->empresa','$solicitud->vehiculo','$solicitud->kilometraje','','$solicitud->empleado','$solicitud->fecha','$solicitud->observacion',0)
        ";
        $result = odbc_exec($this->wssp_db, $query); 

        if ($result){
            return $this->saveSolicitudMOV($solicitud->items, $newCod);

        }  else {
            return $rawdata = array('error' => TRUE, 'message' => odbc_errormsg());
           
        }
    }

    public function saveOrdenPedido($solicitud){
        $newCod = $this->getNewCodigo('ODP')["codigo"];
        $query = "
            INSERT INTO 
                dbo.CAB_estado_vehiculo 
            VALUES ('$newCod','$solicitud->empresa','$solicitud->vehiculo','$solicitud->kilometraje','','$solicitud->empleado','$solicitud->fecha','$solicitud->observacion',0)
        ";
        $result = odbc_exec($this->wssp_db, $query); 

        if ($result){
            return $this->saveSolicitudMOV($solicitud->items, $newCod);

        }  else {
            return $rawdata = array('error' => TRUE, 'message' => odbc_errormsg());
           
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
            $result = odbc_exec($this->wssp_db, $query); 
            $cont++;
        }

        if ($result){

            return $rawdata = array('error' => FALSE, 'message' => 'Registro correcto', 'nuevoregistro' => $codigoCAB, 'itemsregistrados' => $cont );
        }  else {
            return $rawdata = array('error' => TRUE, 'message' => odbc_errormsg());
           
        }
    }

    public function getAllVehiculos ($busqueda='', $empresa='008'){
        $this->empresa_db = getDataBase($empresa);
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
        $result = odbc_exec($this->empresa_db, $query); 
        $resultArray= [];
        while($row = odbc_fetch_array($result)) {
            array_push($resultArray, $row);
        }
        return $resultArray;
    }


    public function generaReporte($codigoPedido, $outputMode = 'S'){

        $empresaData = $this->getInfoEmpresa('008');
        
         $html = '
             
             <div style="width: 100%;">
         
                 <div style="float: right; width: 75%;">
                     <div id="informacion">
                         <h4>'.$empresaData["NomCia"].'</h4>
                         <h4>Direccion: '.$empresaData["DirCia"].'</h4>
                         <h4>Telefono: '.$empresaData["TelCia"].'</h4>
                         <h4>RUC: '.$empresaData["RucCia"].'</h4>
                        
                     </div>
                 </div>
         
                 <div id="logo" style="float: left; width: 20%;">
                     <img src="./assets/logo_dark.png" alt="Logo">
                 </div>
         
             </div>
         
             <div id="infoCliente" class="rounded">
                 <div class="cabecera"><b>Fecha:</b> '. date('Y-m-d').'</div>
               
             </div>
         
             <table class="items" width="100%" style="font-size: 9pt; border-collapse: collapse; " cellpadding="8">
                 <thead>
                     <tr>
                         <td width="20%">Item</td>
                         <td width="30%">Codigo</td>
                         <td width="50%">Descripcion</td>
                         
                     </tr>
                 </thead>
             <tbody>
         
             <!-- ITEMS HERE -->
             ';
                 $cont = 1;
                 $VEN_MOV = array();
                 foreach($VEN_MOV as $row){
                    
                     $html .= '
         
                     <tr>
                         <td align="center">'.$cont.'</td>
                         <td align="center">'.$row["CODIGO"].'</td>
                         <td align="center">'.$row["CANTIDAD"].'</td>
                         <td>'.$row["Nombre"].'</td>
                         <td>'.$row["tipoiva"].'</td>
                         <td>'.$row["PRECIO"].'</td>
                         <td>'.$row["DESCU"].'</td>
                         <td class="cost"> '.$row["DESCU"].' </td>
                         <td class="cost"> '.$row["PRECIOTOT"].'</td>
                     </tr>';
                     $cont++;
                     }
         
             $html .= ' 
             
         
             <!-- END ITEMS HERE -->
                 
             </tbody>
             </table>
 
             <div style="width: 100%;">
                 <p id="observacion">Observacion: </p> 
             </div>
         
             
         ';
 
         //==============================================================
         //==============================================================
         //==============================================================
 
         /* require_once '../../../vendor/autoload.php'; */
         $mpdf = new \Mpdf\Mpdf();
 
         // LOAD a stylesheet
         $stylesheet = file_get_contents('./assets/reportesStyles.css');
         
         $mpdf->WriteHTML($stylesheet,1);	// The parameter 1 tells that this is css/style only and no body/html/text
 
         $mpdf->WriteHTML($html);
         
         return $mpdf->Output('doc.pdf', $outputMode);
 
         //==============================================================
         //==============================================================
         //==============================================================
 
    }

    /* Retorna la respuesta del modelo ajax*/
    public function getInfoEmpresa($empresa='008'){
        $this->empresa_db = getDataBase($empresa);
        $query = "SELECT NomCia, Oficina, Ejercicio, DirCia, TelCia, RucCia, Ciudad  FROM dbo.DatosEmpresa";
        $result = odbc_exec($this->empresa_db, $query); 
        return odbc_fetch_array($result);
       
    }
} 