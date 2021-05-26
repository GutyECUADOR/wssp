<?php
   
class AjaxController  {

    public $defaulDataBase;
    public $ajaxModel;

    public function __construct() {
        $this->ajaxModel = new AjaxModel();
    }
  
    /* Retorna la respuesta del modelo ajax*/
    public function initForm(){
        $empresas = $this->ajaxModel->getEmpresas();
        return array('empresas' => $empresas);
    }

    public function getTiposDoc($database){
        $this->ajaxModel->setDbname($database);
        $this->ajaxModel->conectarDB();

        return $this->ajaxModel->getTiposDoc();
    }

    public function getBodegas($database){
        $this->ajaxModel->setDbname($database);
        $this->ajaxModel->conectarDB();

        return $this->ajaxModel->getBodegas();
    }

    public function getEmpleado($busqueda){
        $this->ajaxModel->setDbname($busqueda->empresa);
        $this->ajaxModel->conectarDB();

        return $this->ajaxModel->getEmpleado_ValesPerdida($busqueda);
    }

    public function getProducto($busqueda){
        $this->ajaxModel->setDbname($busqueda->empresa);
        $this->ajaxModel->conectarDB();

        return $this->ajaxModel->getProducto_ValesPerdida($busqueda);
    }

    


}
