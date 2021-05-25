<?php
  
class AjaxModel extends Conexion  {
    
    public function __construct() {
        parent::__construct();
    }

    public function getEmpresas() {
        $query = " 
            SELECT * 
            FROM 
                SBIOKAO.dbo.Empresas_WF with (nolock) 
            WHERE 
                Codigo IN ('001','002','004','006','011','008') 
            ORDER BY Codigo
        "; 

        try{
            $stmt = $this->instancia->prepare($query); 
                if($stmt->execute()){
                    $resulset = $stmt->fetchAll( \PDO::FETCH_ASSOC );
                }else{
                    $resulset = false;
                }
            return $resulset;  

        }catch(PDOException $exception){
            return array('status' => 'error', 'message' => $exception->getMessage() );
        }
   
    }


    public function getTiposDoc() {
        $query = " 
            SELECT 
                CODIGO, 
                NOMBRE 
            FROM 
                dbo.VEN_TIPOS with (nolock)
            WHERE Codigo IN ('SPA','SPB','SPC','SPD','SPE','SPF') ORDER BY CODIGO
        "; 

        try{
            $stmt = $this->instancia->prepare($query); 
                if($stmt->execute()){
                    $resulset = $stmt->fetchAll( \PDO::FETCH_ASSOC );
                }else{
                    $resulset = false;
                }
            return $resulset;  

        }catch(PDOException $exception){
            return array('status' => 'error', 'message' => $exception->getMessage() );
        }
   
    }

    public function getBodegas() {
        $query = " 
            SELECT CODIGO, NOMBRE FROM dbo.INV_BODEGAS ORDER BY NOMBRE
        "; 

        try{
            $stmt = $this->instancia->prepare($query); 
                if($stmt->execute()){
                    $resulset = $stmt->fetchAll( \PDO::FETCH_ASSOC );
                }else{
                    $resulset = false;
                }
            return $resulset;  

        }catch(PDOException $exception){
            return array('status' => 'error', 'message' => $exception->getMessage() );
        }
   
    }

    public function getEmpleado_ValesPerdida($busqueda){
        $query = " 
        SELECT  
            A.CODIGO, 
            RUC, 
            A.NOMBRE
        FROM dbo.COB_CLIENTES as A INNER JOIN SBIOKAO.dbo.Empleados AS SBIO ON SBIO.Cedula COLLATE Modern_Spanish_CI_AS = a.RUC COLLATE Modern_Spanish_CI_AS 
        WHERE 
            A.RUC= :cedula 
            AND CLASE='I' 
            AND A.RUC  IN (SELECT cedula  FROM dbo.ROL_EMPLEADOS WHERE Estatus = 'A') 
            AND SBIO.CodDpto IN ('EVA','ASI','TEC')
        
    "; 

    try{
        $stmt = $this->instancia->prepare($query); 
        $stmt->bindValue(':cedula', $busqueda->cedula); 
            if($stmt->execute()){
                $resulset = (object) $stmt->fetch( \PDO::FETCH_ASSOC );
            }else{
                $resulset = false;
            }
        return $resulset;  

    }catch(PDOException $exception){
        return array('status' => 'error', 'message' => $exception->getMessage() );
    }
    }

   
}



   
    
