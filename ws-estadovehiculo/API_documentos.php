<?php
date_default_timezone_set('America/Lima');
session_start();

require_once  './vendor/autoload.php';

class ajax{
  private $ajax;
   
    public function __construct() {
      $this->ajax = new EstadoVehiculo();
    }

    /*Métodos disponibles del API */

    public function generaReporte($IDDocument) {
      return $this->ajax->generaReporte($IDDocument, 'I');
    }
    
   
   
}

  /* Cuerpo del API */

  try{
    $ajax = new ajax(); //Instancia que controla las acciones
    $HTTPaction = $_GET["action"];

    switch ($HTTPaction) {

        case 'generaReporte':
          if (isset($_GET['IDDocument'])) {
            $IDDocument = $_GET['IDDocument'];
          
            $PDFDocument = $ajax->generaReporte($IDDocument);
            echo $PDFDocument;
            
          }else{
            $rawdata = array('status' => 'ERROR', 'mensaje' => 'No se ha indicado parámetros.');
            echo json_encode($rawdata);
          }
        
        break;

      
        /* Utiliza PHPMailer para el envio de correo, utiliza los correos del cliente indicados en la tabla*/ 
        case 'sendEmail':

          if (isset($_GET['IDDocument']) ) {
            $IDDocument = $_GET['IDDocument'];
            $respuesta = $ajax->sendEmail($IDDocument);
            $rawdata = array('status' => 'OK', 'mensaje' => 'respuesta correcta', 'data' => $respuesta);
          }else{
            $rawdata = array('status' => 'ERROR', 'mensaje' => 'No se ha indicado parámetros.' );
          }

          echo json_encode($rawdata);

        break; 


        case 'test':
            $rawdata = array('status' => 'OK', 'mensaje' => 'Respuesta correcta');
            echo json_encode($rawdata);

        break;

        default:
            $rawdata = array('status' => 'error', 'mensaje' =>'El API no ha podido responder la solicitud, revise el tipo de action');
            echo json_encode($rawdata);
        break;
    }
    
  } catch (Exception $ex) {
    //Return error message
    $rawdata = array('status' => 'error');
    $rawdata['error'] = TRUE;
    $rawdata['mensaje'] = $ex->getMessage();
    echo json_encode($rawdata);
  }


