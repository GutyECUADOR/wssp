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

    public function getNewCodigo($tipo='EVANFI'){
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
        $query = "SELECT Codigo,Cedula, Nombre, Apellido, Empresa_WF, CodDpto FROM dbo.Empleados with (nolock) WHERE Cedula='$cedula' AND Clave = '$codigo' AND CodDpto IN ('EVA','SUP','ASI')";
        $stmt = $this->sbio_db->prepare($query); 

        try{
            $stmt->execute();
            return $stmt->fetch( \PDO::FETCH_ASSOC );
        }catch(PDOException $exception){
            return array('status' => 'error', 'mensaje' => $exception->getMessage() );
        }
    }

    public function valida_cargoEmpleado($cedula, $empresa='008'){
        $dataBaseName = $this->getDBNameByCodigo($empresa)['NameDatabase'];
        $this->instanciaDB->setDbname($dataBaseName);
        $this->empresa_db = $this->instanciaDB->getInstanciaCNX();

        $query = "
            SELECT 
                ROL.codigo as cedulaEmpleado, 
                ROL.cargo as codigoCargo, 
                Cargos.Nombre as descripcionCargo 
                FROM 
                    dbo.ROL_EMPLEADOS as ROL 
                INNER JOIN dbo.ROL_Cargos as Cargos ON ROL.cargo = Cargos.Codigo  
            WHERE ROL.codigo = '$cedula'
        ";
        $stmt = $this->empresa_db->prepare($query); 

        try{
            $stmt->execute();
            return $stmt->fetch( \PDO::FETCH_ASSOC );
        }catch(PDOException $exception){
            return array('status' => 'error', 'mensaje' => $exception->getMessage() );
        }
    }

  


} 