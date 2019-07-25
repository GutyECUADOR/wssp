<?php
date_default_timezone_set('America/Lima');
session_start();

require('EstadoVehiculo.php');

class ajax{
  private $ajax;

    public function __construct() {
      $this->ajax = new EstadoVehiculo();
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

    public function getAllVehiculos($busqueda){
      return $this->ajax->getAllVehiculos($busqueda);
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


