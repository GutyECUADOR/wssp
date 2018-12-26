<?php

$correoCliente = $_POST['correoCliente'];

// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require './src/Exception.php';
require './src/PHPMailer.php';
require './src/SMTP.php';

$mail = new PHPMailer(true);                              // Passing `true` enables exceptions
try {
    //Server settings
    $mail->SMTPDebug = false;                                 // Enable verbose debug output
    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host = 'mail.sudcompu.net';                          // Specify main and backup SMTP servers smtp-mail.outlook.com
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = 'soporteweb@sudcompu.net';                 // SMTP username guti06@hotmail.es
    $mail->Password = '641429soporte';                           // SMTP password
    $mail->SMTPSecure = false;                            // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 25;     
  
    //Recipients
    $mail->setFrom('soporteweb@sudcompu.net', 'Promociones KAO'); // guti06@hotmail.es
    $mail->addAddress($correoCliente, 'Cliente');     // Add a recipient gutiecuador@gmail.com
  
    //Content
    $mail->CharSet = "UTF-8";
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'Suscripcion de promociones KAO';
    $mail->Body    = file_get_contents('file.html');
    $mail->AltBody = 'Suscripcion de promociones KAO aceptada.';

    $mail->send();
        $arrayRespuesta = array("status" => 'OK', "mensaje" => 'Correo ha sido enviado'); // Objeto principal de resupuesta
        echo json_encode($arrayRespuesta);

    $pcID = 'WSSP'; // Obtiene el nombre del PC

        $log  = "User: ".$_SERVER['REMOTE_ADDR'].' - '.date("F j, Y, g:i a").PHP_EOL.
        "-------------------------".PHP_EOL;
        //Save string to log, use FILE_APPEND to append.

        file_put_contents('./logs/logOK-'.date("d-n-Y").'.txt', $log);

} catch (Exception $e) {
        $log  = "User: ".$_SERVER['REMOTE_ADDR'].' - '.date("F j, Y, g:i a").PHP_EOL.
        "PCid: ".$mail->ErrorInfo.PHP_EOL.
        "-------------------------".PHP_EOL;
        //Save string to log, use FILE_APPEND to append.
        file_put_contents('./logs/logError-'.date("d-n-Y").'.txt', $log);
        
        $arrayRespuesta = array("status" => 'fail', "mensaje" => 'No se pudo enviar el correo.'); // Objeto principal de resupuesta
        echo json_encode($arrayRespuesta);
    
}