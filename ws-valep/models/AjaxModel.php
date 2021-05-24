<?php
  
class AjaxModel extends Conexion  {
    
    public function __construct() {
        parent::__construct();
    }

    public function getEmpresas() {
        $query = " 
            SELECT * FROM SBIOKAO.dbo.Empresas_WF with (nolock) WHERE Codigo IN ('001','002','004','006','011','008') ORDER BY Codigo
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

   
}



   
    
