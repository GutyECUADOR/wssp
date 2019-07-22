<?php
require_once ('../ws-admin/acceso_multi_db.php');

class EstadoVehiculo { 
    public $wssp_db;
    public $sbio_db;
    public $db_empresa;

    function __construct() {
        $this->wssp_db = getDataBase('009');
        $this->sbio_db = getDataBase('010');
    }
    
    function test() { 
        echo 'test';
    } 

    public function getEmpresas(){
        $query = "SELECT * FROM dbo.Empresas_WF with (nolock) ORDER BY Codigo";
        $result = odbc_exec($this->sbio_db, $query); 
        return $result;
    }

    public function getItems(){
        $query = "SELECT * FROM dbo.ITEMS_estado_vehiculos WHERE activo='1'";
        $result = odbc_exec($this->wssp_db, $query); 
        return $result;
    }

    public function getEmpleadoByID($cedula){
        $query = "SELECT * FROM SBIOKAO.dbo.Empleados WHERE Cedula = '$cedula'";
        $result = odbc_exec($this->sbio_db, $query); 
        return odbc_fetch_array($result);
    }
} 