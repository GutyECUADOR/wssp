<?php
date_default_timezone_set('America/Lima');
session_start();

require_once  './vendor/autoload.php';

class ajax{
  private $ajax;
  private $empresaActiva;

    public function __construct() {
      $this->ajax = new EstadoVehiculo();
      if ($_SESSION) {
        $this->empresaActiva = $_SESSION['empresa_autentificada'];
      }else {
        $this->empresaActiva = '008';
      }
    }

    public function getEmpleadoByID($cedula){
      return $this->ajax->getEmpleadoByID($cedula);
    }

    public function getVehiculoByPlaca($placa, $empresa){
      return $this->ajax->getVehiculoByPlaca($placa, $empresa);
    }

    public function saveWinfenixCOM($solicitud, $codEmpresa = '008'){
      return $this->ajax->saveWinfenixCOM_CAB($solicitud, $codEmpresa);
    }

    public function saveSolicitud($solicitud){
      return $this->ajax->saveSolicitud($solicitud);
    }

    public function saveOrdenPedido($solicitud){
      return $this->ajax->saveOrdenPedido($solicitud);
    }

    public function saveNewProduct($producto){
      return $this->ajax->saveNewProduct($producto);
    }

    public function getAllVehiculos($busqueda){
      return $this->ajax->getAllVehiculos($busqueda, $this->empresaActiva);
    }

    public function aprobarOrden($codOrden){
      return $this->ajax->aprobarOrden($codOrden);
    }

    public function sendEmailWithOrden($mail, $IDDocument){
      return $this->ajax->sendEmail($mail, $IDDocument, true);
    }

    public function canDoPago($codOrden){
      return $this->ajax->canDoPago($codOrden);
    }

    public function getInfoProveedor($RUC){
      return $this->ajax->getInfoProveedor($RUC);
    }

    public function getInfoProducto($codigoProducto) {
      return $this->ajax->getInfoProducto($codigoProducto);
    }

    public function searchProducto($termino) {
      return $this->ajax->searchProducto($termino);
    }

    

    public function getProveedoresWinfenix($busqueda, $tipo){
      return $this->ajax->getProveedoresWinfenix($busqueda, $tipo);
    }

}

  try{
    $ajax = new ajax();
    $HTTPaction = $_GET["action"];

    switch ($HTTPaction) {
          case 'getEmpleadoByID':
          $cedula = $_GET["cedula"];
          $respuesta = $ajax->getEmpleadoByID($cedula);
          $rawdata = array('error' => FALSE, 'message' => 'respuesta correcta', 'data' => $respuesta);
          echo json_encode($rawdata);
        break;

        case 'getVehiculoByPlaca':
          $placa = $_GET["placa"];
          $empresa = $_GET["empresa"];
          $respuesta = $ajax->getVehiculoByPlaca($placa, $empresa);
          $rawdata = array('error' => FALSE, 'message' => 'respuesta correcta', 'data' => $respuesta);
          echo json_encode($rawdata);
        break;

        case 'getAllVehiculos':
          $busqueda = $_GET["busqueda"];
          $respuesta = $ajax->getAllVehiculos($busqueda);
          $rawdata = array('error' => FALSE, 'message' => 'respuesta correcta', 'data' => $respuesta);
          echo json_encode($rawdata);
        break;

        case 'saveWinfenixCOM':
          if (isset($_POST['solicitud']) && isset($_POST['empresa'])) {
            $formDataObject = json_decode($_POST['solicitud']);
            $empresa = $_POST['empresa'];
            $respuesta = $ajax->saveWinfenixCOM($formDataObject, $empresa);
            echo json_encode($respuesta);
            }
          break;

        case 'saveSolicitud':
          if (isset($_POST['solicitud'])) {
            $formDataObject = json_decode($_POST['solicitud']);
            $respuesta = $ajax->saveSolicitud($formDataObject);
            $rawdata = $respuesta;
            echo json_encode($rawdata);
            }
          break;

        case 'saveOrdenPedido':
          if (isset($_POST['solicitud'])) {
            $formDataObject = json_decode($_POST['solicitud']);
            $respuesta = $ajax->saveOrdenPedido($formDataObject);
            $rawdata = $respuesta;
            echo json_encode($rawdata);
            }
          break;

        case 'saveNewProduct':
          if (isset($_POST['producto'])) {
            $formDataObject = json_decode($_POST['producto']);
            $rawdata = $ajax->saveNewProduct($formDataObject);
            echo json_encode($rawdata);
            }
          break;

        case 'aprobarOrden':
          if (isset($_GET['codOrden'])) {
            $codOrden = $_GET['codOrden'];
            $respuesta = $ajax->aprobarOrden($codOrden);
            $rawdata = array('error' => FALSE, 'message' => 'Aprobacion realizada', 'data' => $respuesta);
            echo json_encode($rawdata);
            }
          break;
        
        case 'sendOrden':

          if (isset($_GET['IDDocument']) && isset($_GET['email']) ) {
            $IDDocument = $_GET['IDDocument'];
            $email = $_GET['email'];
            $respuesta = $ajax->sendEmailWithOrden($email, $IDDocument);
            $rawdata = array('status' => 'OK', 'mensaje' => 'respuesta correcta', 'data' => $respuesta);
          }else{
            $rawdata = array('status' => 'ERROR', 'mensaje' => 'No se ha indicado parámetros.' );
          }

          echo json_encode($rawdata);

          break; 
        
        case 'canDoPago':
          if (isset($_GET['codOrden'])) {
            $codOrden = $_GET['codOrden'];
            if ($ajax->canDoPago($codOrden)) {
              $rawdata = array('error' => FALSE, 'isAvailable' => TRUE, 'message' => 'Validacion correcta.');
            }else{
              $rawdata = array('error' => FALSE, 'isAvailable' => FALSE, 'message' => 'Validacion incorrecta.');
            }
            
            echo json_encode($rawdata);
            }
          break;

          /* Obtiene array de informacion del cliente*/ 
        case 'getInfoProveedor':
          if (isset($_GET['RUC'])) {
            $RUC = $_GET['RUC'];
            $respuesta = $ajax->getInfoProveedor($RUC);
            $rawdata = array('status' => 'OK', 'mensaje' => 'respuesta correcta', 'data' => $respuesta);
          }else{
            $rawdata = array('status' => 'ERROR', 'mensaje' => 'No se ha indicado parámetros.');
          }
          
          echo json_encode($rawdata);

        break;

        /* Obtiene array de informacion del producto*/ 
        case 'getInfoProducto':

          if (isset($_GET['codigo'])) {
            $codigoProducto = $_GET['codigo'];
            $respuesta = $ajax->getInfoProducto($codigoProducto);
            $rawdata = array('status' => 'OK', 'mensaje' => 'respuesta correcta', 'data' => $respuesta);
          }else{
            $rawdata = array('status' => 'ERROR', 'mensaje' => 'No se ha indicado parámetros.');
          }
          
        
          echo json_encode($rawdata);

        break;

        /* Obtiene array de informacion del producto*/ 
        case 'searchProducto':

          if (isset($_GET['termino'])) {
            $termino = $_GET['termino'];
            $respuesta = $ajax->searchProducto($termino);
            $rawdata = array('status' => 'OK', 'mensaje' => 'respuesta correcta', 'data' => $respuesta);
          }else{
            $rawdata = array('status' => 'ERROR', 'mensaje' => 'No se ha indicado parámetros.');
          }
          
        
          echo json_encode($rawdata);

        break;

        /* Obtiene array de proveedores segun SP de winfenix*/ 
        case 'getProveedoresWinfenix':

          if (isset($_GET['busqueda']) && isset($_GET['busqueda'])) {
            $busqueda = $_GET['busqueda'];
            $tipo = $_GET['tipo'];
            $respuesta = $ajax->getProveedoresWinfenix($busqueda, $tipo);
            $rawdata = array('status' => 'OK', 'mensaje' => 'respuesta correcta', 'data' => $respuesta);
          }else{
            $rawdata = array('status' => 'ERROR', 'mensaje' => 'No se ha indicado parámetros.');
          }
          
        
          echo json_encode($rawdata);

        break;

          
        default:
            $rawdata = array('error' => TRUE, 'message' =>'el API no ha podido responder la solicitud, revise el tipo de action');
            echo json_encode($rawdata);
            break;
    }
    
  } catch (Exception $ex) {
    //Return error message
    $rawdata = array();
    $rawdata['error'] = TRUE;
    $rawdata['status'] = "ERROR";
    $rawdata['mensaje'] = $ex->getMessage();
    echo json_encode($rawdata);
  }


