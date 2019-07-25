<?php
require_once ('../ws-admin/acceso_multi_db.php');

class EstadoVehiculo { 
    public $wssp_db;
    public $sbio_db;
    public $empresa_db;

    function __construct() {
        $this->wssp_db = getDataBase('009');
        $this->sbio_db = getDataBase('010');
    }
    
    function test() { 
        echo 'test';
    }

    public function getNewCodigo(){
        $query = "SELECT 'EST'+RIGHT('000000'+ISNULL(CONVERT (Varchar , (SELECT COUNT(*)+1 FROM dbo.CAB_estado_vehiculo)),''),6) as codigo";
        $result = odbc_exec($this->wssp_db, $query); 
        return odbc_fetch_array($result);
    }

    public function getEmpresas(){
        $query = "SELECT * FROM dbo.Empresas_WF with (nolock) WHERE Codigo IN ('001','002','006','008')";
        $result = odbc_exec($this->sbio_db, $query); 
        return $result;
    }

    public function getItems(){
        $query = "SELECT * FROM dbo.ITEMS_estado_vehiculos WHERE activo='1'";
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
        $newCod = $this->getNewCodigo()["codigo"];
        $query = "
            INSERT INTO 
                dbo.CAB_estado_vehiculo 
            VALUES ('$newCod','$solicitud->vehiculo','$solicitud->kilometraje','$solicitud->empleado','$solicitud->empleado','$solicitud->fecha','$solicitud->observacion',0)
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
        WHERE wssp.placa LIKE '".$busqueda."%'
        ORDER BY fecha DESC
        
        ";
        $result = odbc_exec($this->empresa_db, $query); 
        $resultArray= [];
        while($row = odbc_fetch_array($result)) {
            array_push($resultArray, $row);
        }
        return $resultArray;
    }
} 