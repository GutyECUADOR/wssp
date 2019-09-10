<?php
date_default_timezone_set('America/Lima');
session_start();

require_once  './vendor/autoload.php';

class ajax{
  private $ajax;
  private $empresaActiva;

    public function __construct() {
      $this->ajax = new Evaluacion();
      if ($_SESSION) {
        $this->empresaActiva = $_SESSION['empresa_autentificada'];
      }else {
        $this->empresaActiva = '008';
      }
    }

    public function getEmpleadoByID($cedula){
      return $this->ajax->getEmpleadoByID($cedula);
    }

    public function getEmpleadosByDB($codigoDB){
      return $this->ajax->getEmpleadosByDB($codigoDB);
    }

    public function validacod_seguridad($cedula, $codigo){
      return $this->ajax->validacod_seguridad($cedula, $codigo);
    }

    public function valida_cargoEmpleado($codigo, $empresa){
      return $this->ajax->valida_cargoEmpleado($codigo, $empresa);
    }

    public function saveSolicitud($solicitud){
      return $this->ajax->saveSolicitud($solicitud);
    }

    public function getAllEvaluaciones($fechaINI, $fechaFIN, $empresa){
      return $this->ajax->getAllEvaluaciones($fechaINI, $fechaFIN, $empresa);
    }

}

  try{
    $ajax = new ajax();
    $HTTPaction = $_GET["action"];

    switch ($HTTPaction) {
        case 'getEmpleadoByID':
          $cedula = $_GET["cedula"];
          $respuesta = $ajax->getEmpleadoByID($cedula);
          $rawdata = array('error' => FALSE, 'message' => 'Consulta realizada correctamente', 'data' => $respuesta);
          echo json_encode($rawdata);
        break;

        case 'getEmpleadosByDB':
          $codigoDB = $_GET["codigoDB"];
          $respuesta = $ajax->getEmpleadosByDB($codigoDB);
          $rawdata = array('error' => FALSE, 'message' => 'Consulta realizada correctamente', 'data' => $respuesta);
          echo json_encode($rawdata);
        break;

        case 'validacod_seguridad':
          $cedula = $_GET["cedula"];
          $codigo = $_GET["codigo"];
          $respuesta = $ajax->validacod_seguridad($cedula, $codigo);
          $rawdata = array('error' => FALSE, 'message' => 'Consulta realizada correctamente', 'data' => $respuesta);
          echo json_encode($rawdata);
        break;

        case 'valida_cargoEmpleado':
          $codigo = $_GET["codigo"];
          $empresa = $_GET["empresa"];
          $respuesta = $ajax->valida_cargoEmpleado($codigo, $empresa);
          $rawdata = array('error' => FALSE, 'message' => 'Consulta realizada correctamente', 'data' => $respuesta);
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

        case 'getAllEvaluaciones':
          $fechaINI = $_GET["fechaINI"];
          $fechaFIN = $_GET["fechaFIN"];
          $empresa = $_GET["empresa"];
          $respuesta = $ajax->getAllEvaluaciones($fechaINI, $fechaFIN, $empresa);
          $rawdata = array('error' => FALSE, 'message' => 'respuesta correcta', 'data' => $respuesta);
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


