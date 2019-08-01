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

    public function saveSolicitud($solicitud){
      return $this->ajax->saveSolicitud($solicitud);
    }

    public function saveOrdenPedido($solicitud){
      return $this->ajax->saveOrdenPedido($solicitud);
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


