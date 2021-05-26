<?php 

date_default_timezone_set('America/Lima');
header('Content-Type: application/json');


require_once "../models/Conexion.php";
require_once "../models/AjaxModel.php";
require_once "../controllers/AjaxController.php";

  try{
    $ajaxController = new AjaxController();

    if (isset($_GET["action"])) {
      $HTTPaction = $_GET["action"];
    }else{
      throw new Exception("Solicitud sin action");
    }
    
    switch ($HTTPaction) {

      case 'initform':
        $response = $ajaxController->initForm();
        $rawdata = array('status' => 'success', 'message' => 'Peticion Realizada', 'data' => $response);
        echo json_encode($rawdata);
      break;

      case 'getTiposDoc':
        if (isset($_GET["empresa"])) {
          $empresa = $_GET["empresa"];
          $response = $ajaxController->getTiposDoc($empresa);
          $rawdata = array('status' => 'success', 'message' => 'Peticion Realizada', 'data' => $response);
          echo json_encode($rawdata);
        }else{
          throw new Exception("Sin datos de empresa.");
        }
       
      break;

      case 'getBodegas':
        if (isset($_GET["empresa"])) {
          $empresa = $_GET["empresa"];
          $response = $ajaxController->getBodegas($empresa);
          $rawdata = array('status' => 'success', 'message' => 'Peticion Realizada', 'data' => $response);
          echo json_encode($rawdata);
        }else{
          throw new Exception("Sin datos de empresa.");
        }
      break; 

      case 'getEmpleado':
        if (isset($_GET["busqueda"])) {
          $busqueda = json_decode($_GET['busqueda']);
          $response = $ajaxController->getEmpleado($busqueda);
          $rawdata = array('status' => 'success', 'message' => 'Peticion Realizada', 'data' => $response);
          echo json_encode($rawdata);
        }else{
          throw new Exception("Sin datos de busqueda.");
        }
      break;

      case 'getProducto':
        if (isset($_GET["busqueda"])) {
          $busqueda = json_decode($_GET['busqueda']);
          $response = $ajaxController->getProducto($busqueda);
          $rawdata = array('status' => 'success', 'message' => 'Peticion Realizada', 'data' => $response);
          echo json_encode($rawdata);
        }else{
          throw new Exception("Sin datos de busqueda.");
        }
      break;


      default:
          $rawdata = array('status' => 'error', 'message' =>'El API no ha podido responder la solicitud, revise el tipo de action');
          echo json_encode($rawdata);
      break;
    }
    
  } catch (Exception $ex) {
    http_response_code(400);
    $rawdata = array();
    $rawdata['status'] = "error";
    $rawdata['message'] = $ex->getMessage();
    echo json_encode($rawdata);
  }


