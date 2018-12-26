<?php
include('../ws-admin/acceso_db.php');
$maildestinatario = $_POST['txt_usuariomail'];

$mailenDB = $maildestinatario;
$mailenDB;


$sql = ("SELECT ruc, correo, password FROM tbl_usuarios WHERE correo = '".$mailenDB."'");
$resultado = mysql_query($sql);
$dato = mysql_fetch_array($resultado);

$contador = mysql_num_rows($resultado);
echo "<br>Total de emails: ". $contador;

$variableRSOCIAL = "R. Social: ".$dato['nombre']."<br>";
$variableUSER = "Usuario: ".$dato['ruc']."<br>";
$variablePASS = "Pass: ".$dato['password'];

if ($contador >=1)
    {

        

        // Varios destinatarios
        $para  = $maildestinatario . ', '; // atención a la coma
        // título
        $título = 'Restablecimiento de Contraseña';

        // mensaje
        $mensaje = '  <html>
        <head>
          <meta charset="UTF-8">
          <title>NUEVO CURRICULO</title>
        </head>
        
        <style>
		.textotitulos{font-family:Arial, Helvetica, sans-serif; font-size:10px; font-weight:bold;}
		
		</style>
        <body><center>
          
          <img class="logo" src="http://sudcompu.info/ws-sistemaequinoxio/ws-admin/img/ImageProxyCabecera.jpg" alt="Logo">
          
          <table width="600" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td height="2" colspan="5" bgcolor="303766" valign="top">&nbsp;</td>
    </tr>
  <tr>
    <td width="10" bgcolor="303766">&nbsp;</td>
    <td width="5" height="115">&nbsp;</td>
    <td width="575">
     
      <table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="26%" class="textotitulos">Puesto al que aplica: </td>
    <td colspan="3">&nbsp;</td>
    </tr>
  <tr>
    <td class="textotitulos">Nombres y Apellidos: </br>'.$variableUSER.'</td>
    <td width="25%" class="textotitulos">CI: </br>'.$variablePASS.'</td>
    <td width="23%" class="textotitulos">Fecha de Nacimiento:</td>
    <td width="26%" class="textotitulos">Lugar de Nacimiento:</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
<p>'.$variableRSOCIAL.' </p></td>
    <td width="5">&nbsp;</td>
    <td width="10" bgcolor="303766">&nbsp;</td>
    </tr>
  <tr>
    <td colspan="5" bgcolor="303766">&nbsp;</td>
    </tr>
</table>
</br></br>
<table width="100%" border="1px" align="center" cellpadding="2" cellspacing="0">
  <tr>
    <td><font color="#EB3935" face="Arial, Helvetica, sans-serif" size="1" font-weight: bold;>Nota de descargo:</font>
    	<font color="#666666" face="Arial, Helvetica, sans-serif" size="1">La información contenida en este e-mail es confidencial y sólo puede ser utilizada 		por el individuo o la compaña a la cual está dirigido.Esta información no debe ser distribuida ni copiada total o parcialmente por ningún medio sin la 		autorización del administrador. La organización no asume responsabilidad sobre información, opiniones o criterios contenidos en este mail que no este relacionada con negocios oficiales de nuestra institución.</font>
    
    </td>
    </tr>
</table>
        </center>
        </body>
  </html>
        ';

        // Para enviar un correo HTML, debe establecerse la cabecera Content-type
        $cabeceras  = 'MIME-Version: 1.0' . "\r\n";
        $cabeceras .= 'Content-Type: text/html; charset=UTF-8' . "\r\n";
       
        // Cabeceras adicionales
        $cabeceras .= 'To:'. $maildestinatario . "\r\n";
        $cabeceras .= 'From: Administrador <soporteweb@sudcompu.net>' . "\r\n";

        // Enviarlo
        mail($para, $título, $mensaje, $cabeceras);


                        $mensajeconf = "Mensaje enviado correctamente.";
                        echo "<script>";
                        echo "alert('$mensajeconf');";  
                        echo "window.location = '../ws-recupass/';";
                        echo "</script>"; 
    }
    else
    {
       
                        $mensajeconf = "Error, no se ha podido enviar el mensaje, mail no encontrado";
                        echo "<script>";
                        echo "alert('$mensajeconf');";  
                        echo "window.location = '../ws-recupass/';";
                        echo "</script>"; 
                        
        
    }    

