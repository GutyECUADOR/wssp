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
} 