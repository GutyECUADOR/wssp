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


      default:
          $rawdata = array('status' => 'error', 'message' =>'El API no ha podido responder la solicitud, revise el tipo de action');
          echo json_encode($rawdata);
      break;
    }
    
  } catch (Exception $ex) {
    //Return error message
    $rawdata = array();
    $rawdata['status'] = "error";
    $rawdata['message'] = $ex->getMessage();
    echo json_encode($rawdata);
  }


