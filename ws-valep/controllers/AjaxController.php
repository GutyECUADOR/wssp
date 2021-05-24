<?php
   
class AjaxController  {

    public $defaulDataBase;
    public $ajaxModel;

    public function __construct() {
        $this->ajaxModel = new AjaxModel();
    }
  
    /* Retorna la respuesta del modelo ajax*/
    public function initForm($database='MODELOKIND_V7'){
        $this->ajaxModel->setDbname($database);
        $this->ajaxModel->conectarDB();

        $empresas = $this->ajaxModel->getEmpresas();
        return array('empresas' => $empresas);
    }

    


}
