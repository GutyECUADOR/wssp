<?php
require_once('../ws-admin/acceso_db.php');
 /*VERIFICACIÓN RECAPTCHA*/ 
if(isset($_POST['g-recaptcha-response'])){
          $captcha=$_POST['g-recaptcha-response'];
        }
        if(!$captcha){
          header('refresh:1; url=/ws-sistemaequinoxio/ws-solitrabajo/'); 
          echo "<script type=\"text/javascript\">alert(\"No se ha validado recaptcha, petición negada, Reintente por favor.\");</script>"; 
          exit;
        }
	$secretKey = "6LcQfxwTAAAAAIxayBeGn8XHqdqyUUExVbAiGdsC";
	$ip = $_SERVER['REMOTE_ADDR'];
        $response=file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=".$secretKey."&response=".$captcha."&remoteip=".$ip);
	$responseKeys = json_decode($response,true);
        
        if(intval($responseKeys["success"]) !== 1) {
          header('refresh:2; url=/ws-sistemaequinoxio/ws-solitrabajo'); 
          echo "<script type=\"text/javascript\">alert(\"Se ha detectado la acción como spam.\");</script>";
        } else {
            
            /*AGREGADO DE DATOS, CON VALIDACIONES ACEPTADAS*/
            $cod_curriculo = "";
            $seleccion_puesto = $_POST['seleccion_puesto'];
            $Nombre = $_POST['nombre'];
            $CI = $_POST['ci'];
            $fechaNA = $_POST['fechaNA'];
            $lugarNA = $_POST['lugarNA'];
            $estadocivil = $_POST['seleccion_estado_civil'];
            $direcciondom = $_POST['direcciondom'];
            $sector = $_POST['sector'];
            $telefono = $_POST['telefono'];
            $celular = $_POST['celular'];
            $mail1 = $_POST['mail1'];
            $mail2 = $_POST['mail2'];
            
            $estudiospri = $_POST['estudiospri'];
            $estudiossec = $_POST['estudiossec'];
            $estudiosuni = $_POST['estudiosuni'];
            $estudioidioma = $_POST['estudioidioma'];
            
             /*seccion cursos*/
            
            $nombrecurso1 = $_POST['nombrecurso1'];
            $dictadocurso1 = $_POST['dictadocurso1'];
            $duracioncurso1 = $_POST['duracioncurso1'];
            $fechacurso1 = $_POST['fechacurso1'];
            $nombrecurso2 = $_POST['nombrecurso2'];
            $dictadocurso2 = $_POST['dictadocurso2'];
            $duracioncurso2 = $_POST['duracioncurso2'];
            $fechacurso2 = $_POST['fechacurso2'];
            
            /*seccion trabajos anteriores*/
            
            $nombretrab1 = $_POST['nombretrab1'];
            $fechatrabing1 = $_POST['fechatrabing1'];
            $fechatrabout1 = $_POST['fechatrabout1'];
            $cargotrab1 = $_POST['cargotrab1'];
            $funtrab1 = $_POST['funtrab1'];
            $jefetrab1 = $_POST['jefetrab1'];
            $telfjefe1 = $_POST['telfjefe1'];
            $motivosalidatrab1 = $_POST['motivosalidatrab1'];
            
            $nombretrab2 = $_POST['nombretrab2'];
            $fechatrabing2 = $_POST['fechatrabing2'];
            $fechatrabout2 = $_POST['fechatrabout2'];
            $cargotrab2 = $_POST['cargotrab2'];
            $funtrab2 = $_POST['funtrab2'];
            $jefetrab2 = $_POST['jefetrab2'];
            $telfjefe2 = $_POST['telfjefe2'];
            $motivosalidatrab2 = $_POST['motivosalidatrab2'];
            
            $nombretrab3 = $_POST['nombretrab3'];
            $fechatrabing3 = $_POST['fechatrabing3'];
            $fechatrabout3 = $_POST['fechatrabout3'];
            $cargotrab3 = $_POST['cargotrab3'];
            $funtrab3 = $_POST['funtrab3'];
            $jefetrab3 = $_POST['jefetrab3'];
            $telfjefe3 = $_POST['telfjefe3'];
            $motivosalidatrab3 = $_POST['motivosalidatrab3'];
            
            $nombretrab4 = $_POST['nombretrab4'];
            $fechatrabing4 = $_POST['fechatrabing4'];
            $fechatrabout4 = $_POST['fechatrabout4'];
            $cargotrab4 = $_POST['cargotrab4'];
            $funtrab4 = $_POST['funtrab4'];
            $jefetrab4 = $_POST['jefetrab4'];
            $telfjefe4 = $_POST['telfjefe4'];
            $motivosalidatrab4 = $_POST['motivosalidatrab4'];
            
            $nombretrab5 = $_POST['nombretrab5'];
            $fechatrabing5 = $_POST['fechatrabing5'];
            $fechatrabout5 = $_POST['fechatrabout5'];
            $cargotrab5 = $_POST['cargotrab5'];
            $funtrab5 = $_POST['funtrab5'];
            $jefetrab5 = $_POST['jefetrab5'];
            $telfjefe5 = $_POST['telfjefe5'];
            $motivosalidatrab5 = $_POST['motivosalidatrab5'];
            
            $nombretrab6 = $_POST['nombretrab6'];
            $fechatrabing6 = $_POST['fechatrabing6'];
            $fechatrabout6 = $_POST['fechatrabout6'];
            $cargotrab6 = $_POST['cargotrab6'];
            $funtrab6 = $_POST['funtrab6'];
            $jefetrab6 = $_POST['jefetrab6'];
            $telfjefe6 = $_POST['telfjefe6'];
            $motivosalidatrab6 = $_POST['motivosalidatrab6'];
            
            /*seccion referencias personales*/
            
            $nombreref1 = $_POST['nombreref1'];
            $empresaref1 = $_POST['empresaref1'];
            $cargoref1 = $_POST['cargoref1'];
            $telfref1 = $_POST['telfref1'];
            $celref1 = $_POST['celref1'];
            
            $nombreref2 = $_POST['nombreref2'];
            $empresaref2 = $_POST['empresaref2'];
            $cargoref2 = $_POST['cargoref2'];
            $telfref2 = $_POST['telfref2'];
            $celref2 = $_POST['celref2'];
            
            $nombreref3 = $_POST['nombreref3'];
            $empresaref3 = $_POST['empresaref3'];
            $cargoref3 = $_POST['cargoref3'];
            $telfref3 = $_POST['telfref3'];
            $celref3 = $_POST['celref3'];
            
            mysql_query("SET NAMES 'utf8'"); /*ACEPTAR CARACTERES UTF-8*/
            $sql = mysql_query("INSERT INTO tbl_curriculums  VALUES ('$cod_curriculo' , '$seleccion_puesto', '$Nombre' , '$CI' , '$fechaNA' , '$lugarNA' , '$estadocivil' ,'$direcciondom' ,'$sector' ,'$telefono' ,'$celular' ,'$mail1' ,'$mail2' ,'$estudiospri' ,'$estudiossec' ,'$estudiosuni' ,'$estudioidioma' ,'$nombrecurso1' ,'$dictadocurso1' ,'$duracioncurso1' ,'$fechacurso1' ,'$nombrecurso2' ,'$dictadocurso2' ,'$duracioncurso2' ,'$fechacurso2' , '$nombretrab1' , '$fechatrabing1' , '$fechatrabout1' , '$cargotrab1' , '$funtrab1' , '$jefetrab1' , '$telfjefe1' , '$motivosalidatrab1' , '$nombretrab2' , '$fechatrabing2' , '$fechatrabout2' , '$cargotrab2' , '$funtrab2' , '$jefetrab2' , '$telfjefe2' , '$motivosalidatrab2' , '$nombretrab3' , '$fechatrabing3' , '$fechatrabout3' , '$cargotrab3' , '$funtrab3' , '$jefetrab3' , '$telfjefe3' , '$motivosalidatrab3' ,'$nombreref1' ,'$empresaref1' ,'$cargoref1' ,'$telfref1' ,'$celref1' ,'$nombreref2' ,'$empresaref2' ,'$cargoref2' ,'$telfref2' ,'$celref2' ,'$nombreref3' ,'$empresaref3' ,'$cargoref3' ,'$telfref3' ,'$celref3')");

            header('refresh:2; url=../ws-solitrabajo'); 
            echo "<script type=\"text/javascript\">alert(\"Curriculum Aceptado, Gracias.\");</script>";  
            include('../ws-solitrabajo/enviarcurriculo.php');
            
        }

