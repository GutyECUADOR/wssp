<?php
include('../ws-admin/acceso_db.php');

$consulta_correo = mysql_query("SELECT * FROM tbl_generalconfigs WHERE nombre_var = 'correo_curriculos'");
$row = mysql_fetch_array($consulta_correo);

$maildestinatario = $row[valor];
$mailenDB = $maildestinatario;

$contador = mysql_num_rows($consulta_correo);
echo "<br>Total de emails: ". $contador;

if ($contador >=1)
    {

        // Varios destinatarios
        $para  = $maildestinatario . ','; // atención a la coma
        // título
        $título = 'Nuevo Postulante Registrado';

        // mensaje
        $mensaje = '
            
   <html>
        <head>
          <meta charset="UTF-8">
          <title>Nuevo Curriculo</title>
        </head>
        
        <style>
		.textotitulos{font-family:Arial, Helvetica, sans-serif; font-size:11px; font-weight:bold}
		.textoinfo{font-family:Arial, Helvetica, sans-serif; font-size:10px; font-weight:normal; color:#666}
		.textoseccion{font-family:Arial, Helvetica, sans-serif; font-size:11px; font-weight:bold; color:#C03; text-align:center}
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
    <td colspan="3" class="textotitulos"><span class="textotitulos1">Puesto al que aplica:
        <span class="textoinfo">'.$seleccion_puesto.'</span>
    </span></td>
  </tr>
  <tr>
    <td colspan="3" class="textotitulos">Nombres y Apellidos: <span class="textoinfo">'.$Nombre.'</span></td>
    </tr>
  <tr>
    <td class="textotitulos">CI: </br> <span class="textoinfo">'.$CI.'</span></td>
    <td width="26%" class="textotitulos">Fecha de Nacimiento: </br><span class="textoinfo"> '.$fechaNA.'</span></td>
    <td width="42%" class="textotitulos">Lugar de Nacimiento: </br><span class="textoinfo"> '.$lugarNA.'</span></td> 
  </tr>
  <tr>
    <td class="textotitulos">Estado Civil: </br> <span class="textoinfo">'.$estadocivil.'</span></td>
    <td colspan="2" class="textotitulos">Sector: </br><span class="textoinfo"> '.$sector.'</span></td>
    </tr>
     <tr>
    <td colspan="3" class="textotitulos"></span>Direccion Domiciliaria: </br><span class="textoinfo"> '.$direcciondom.'</span></td>
    </tr>
    <tr>
    <td class="textotitulos"><span class="textotitulos">Teléfono: </br> <span class="textoinfo">'.$telefono.'</span></span></td>
    <td class="textotitulos">Celular: </br> <span class="textoinfo">'.$celular.'</span></td>
    <td class="textotitulos">E-mail: </br> <span class="textoinfo">'.$mail1.'</span></td>
  </tr>
    
  <tr>
     <td colspan="3" class="textoseccion">--ESTUDIOS Y CURSOS--</td>
   </tr>
  <tr>
    <td colspan="3"><span class="textotitulos">Estudios Primarios:</br>
        <span class="textoinfo">'.$estudiospri.'</span></span></td>
    </tr>
  <tr>
    <td colspan="3"><span class="textotitulos">Estudios Secundarios: </br>
        <span class="textoinfo">'.$estudiossec.'</span></span></td>
    </tr>
  <tr>
    <td colspan="3"><span class="textotitulos">Estudios Universitarios: </br>
      <span class="textoinfo">'.$estudiosuni.'</span></span></td>
  </tr>
  <tr>
    <td colspan="3"><span class="textotitulos">Idioma Extranjero:: </br>
        <span class="textoinfo">'.$estudioidioma.'</span></span></td>
    </tr>
  <tr>
    <td colspan="3"><span class="textotitulos">Nombre del Curso 1:
      <span class="textoinfo">'.$nombrecurso1.'</span></span></td>
    </tr>
  <tr>
    <td class="textotitulos">Dictado por: </br> <span class="textoinfo">'.$dictadocurso1.'</span></td>
    <td class="textotitulos">Duración (Horas): </br> <span class="textoinfo">'.$duracioncurso1.'</span></td>
    <td class="textotitulos">Fecha: </br> <span class="textoinfo">'.$fechacurso1.'</span></td>
  </tr>
  <tr>
    <td colspan="3"><span class="textotitulos">Nombre del Curso 2:
      <span class="textoinfo">'.$nombrecurso2.'</span></span></td>
    </tr>
  <tr>
    <td class="textotitulos">Dictado por: </br> <span class="textoinfo">'.$dictadocurso2.'</span></td>
    <td class="textotitulos">Duración (Horas): </br> <span class="textoinfo">'.$duracioncurso2.'</span></td>
    <td class="textotitulos">Fecha: </br> <span class="textoinfo">'.$fechacurso2.'</span></td>
  </tr>
   <tr>
     <td colspan="3" class="textoseccion">-- EXPERIENCIA LABORAL --</td>
   </tr>
   <tr>
    <td colspan="3"><span class="textotitulos">Nombre de la Institución o Empresa 1:
      <span class="textoinfo">'.$nombretrab1.'</span></span></td>
    </tr>
  <tr>
    <td class="textotitulos">Fecha de Ingreso : </br> <span class="textoinfo">'.$fechatrabing1.'</span></td>
    <td class="textotitulos">Fecha de Salida : </br> <span class="textoinfo">'.$fechatrabout1.'</span></td>
    <td class="textotitulos">Cargo Desempeñado: </br> <span class="textoinfo">'.$cargotrab1.'</span></td>
  </tr>
        <td colspan="3"><span class="textotitulos">Funciones asignadas en Trabajo 1:
      <span class="textoinfo">'.$funtrab1.'</span></span></td>
    </tr>
  <tr>
    <td class="textotitulos">Jefe Inmediato: </br> <span class="textoinfo">'.$jefetrab1.'</span></td>
    <td class="textotitulos">Telf. Convencional: </br> <span class="textoinfo">'.$telfjefe1.'</span></td>
    <td class="textotitulos">Motivo de Salida: </br> <span class="textoinfo">'.$motivosalidatrab1.'</span></td>
  </tr>
  <tr>
      <td colspan="3"><span class="textotitulos">Nombre de la Institución o Empresa 2:
      <span class="textoinfo">'.$nombretrab2.'</span></span></td>
  </tr>
  
  <tr>
    <td class="textotitulos">Fecha de Ingreso : </br> <span class="textoinfo">'.$fechatrabing2.'</span></td>
    <td class="textotitulos">Fecha de Salida : </br> <span class="textoinfo">'.$fechatrabout2.'</span></td>
    <td class="textotitulos">Cargo Desempeñado: </br> <span class="textoinfo">'.$cargotrab2.'</span></td>
  </tr>
      <td colspan="3"><span class="textotitulos">Funciones asignadas en Trabajo 2:
      <span class="textoinfo">'.$funtrab2.'</span></span></td>
    </tr>
  <tr>
    <td class="textotitulos">Jefe Inmediato : </br> <span class="textoinfo">'.$jefetrab2.'</span></td>
    <td class="textotitulos">Telf. Convencional: : </br> <span class="textoinfo">'.$telfjefe2.'</span></td>
    <td class="textotitulos">Motivo de Salida:: </br> <span class="textoinfo">'.$motivosalidatrab2.'</span></td>
  </tr>
  
  <tr>
    <td colspan="3"><span class="textotitulos">Nombre de la Institución o Empresa 3:
      <span class="textoinfo">'.$nombretrab3.'</span></span></td>
    </tr>
  <tr>
    <td class="textotitulos">Fecha de Ingreso : </br> <span class="textoinfo">'.$fechatrabing3.'</span></td>
    <td class="textotitulos">Fecha de Salida : </br> <span class="textoinfo">'.$fechatrabout3.'</span></td>
    <td class="textotitulos">Cargo Desempeñado: </br> <span class="textoinfo">'.$cargotrab3.'</span></td>
  </tr>
        <td colspan="3"><span class="textotitulos">Funciones asignadas en Trabajo 3:
      <span class="textoinfo">'.$funtrab3.'</span></span></td>
    </tr>
  <tr>
    <td class="textotitulos">Jefe Inmediato: </br> <span class="textoinfo">'.$jefetrab3.'</span></td>
    <td class="textotitulos">Telf. Convencional: </br> <span class="textoinfo">'.$telfjefe3.'</span></td>
    <td class="textotitulos">Motivo de Salida: </br> <span class="textoinfo">'.$motivosalidatrab3.'</span></td>
  </tr>
  
  <tr>
    <td colspan="3"><span class="textotitulos">Nombre de la Institución o Empresa 4:
      <span class="textoinfo">'.$nombretrab4.'</span></span></td>
    </tr>
  <tr>
    <td class="textotitulos">Fecha de Ingreso : </br> <span class="textoinfo">'.$fechatrabing4.'</span></td>
    <td class="textotitulos">Fecha de Salida : </br> <span class="textoinfo">'.$fechatrabout4.'</span></td>
    <td class="textotitulos">Cargo Desempeñado: </br> <span class="textoinfo">'.$cargotrab4.'</span></td>
  </tr>
        <td colspan="3"><span class="textotitulos">Funciones asignadas en Trabajo 4:
      <span class="textoinfo">'.$funtrab4.'</span></span></td>
    </tr>
  <tr>
    <td class="textotitulos">Jefe Inmediato: </br> <span class="textoinfo">'.$jefetrab4.'</span></td>
    <td class="textotitulos">Telf. Convencional: </br> <span class="textoinfo">'.$telfjefe4.'</span></td>
    <td class="textotitulos">Motivo de Salida: </br> <span class="textoinfo">'.$motivosalidatrab4.'</span></td>
  </tr>
  
  <tr>
    <td colspan="3"><span class="textotitulos">Nombre de la Institución o Empresa 5:
      <span class="textoinfo">'.$nombretrab5.'</span></span></td>
    </tr>
  <tr>
    <td class="textotitulos">Fecha de Ingreso : </br> <span class="textoinfo">'.$fechatrabing5.'</span></td>
    <td class="textotitulos">Fecha de Salida : </br> <span class="textoinfo">'.$fechatrabout5.'</span></td>
    <td class="textotitulos">Cargo Desempeñado: </br> <span class="textoinfo">'.$cargotrab5.'</span></td>
  </tr>
        <td colspan="3"><span class="textotitulos">Funciones asignadas en Trabajo 5:
      <span class="textoinfo">'.$funtrab5.'</span></span></td>
    </tr>
  <tr>
    <td class="textotitulos">Jefe Inmediato: </br> <span class="textoinfo">'.$jefetrab5.'</span></td>
    <td class="textotitulos">Telf. Convencional: </br> <span class="textoinfo">'.$telfjefe5.'</span></td>
    <td class="textotitulos">Motivo de Salida: </br> <span class="textoinfo">'.$motivosalidatrab5.'</span></td>
  </tr>
  
  <tr>
    <td colspan="3"><span class="textotitulos">Nombre de la Institución o Empresa 6:
      <span class="textoinfo">'.$nombretrab6.'</span></span></td>
    </tr>
  <tr>
    <td class="textotitulos">Fecha de Ingreso : </br> <span class="textoinfo">'.$fechatrabing6.'</span></td>
    <td class="textotitulos">Fecha de Salida : </br> <span class="textoinfo">'.$fechatrabout6.'</span></td>
    <td class="textotitulos">Cargo Desempeñado: </br> <span class="textoinfo">'.$cargotrab6.'</span></td>
  </tr>
        <td colspan="3"><span class="textotitulos">Funciones asignadas en Trabajo 6:
      <span class="textoinfo">'.$funtrab6.'</span></span></td>
    </tr>
  <tr>
    <td class="textotitulos">Jefe Inmediato: </br> <span class="textoinfo">'.$jefetrab6.'</span></td>
    <td class="textotitulos">Telf. Convencional: </br> <span class="textoinfo">'.$telfjefe6.'</span></td>
    <td class="textotitulos">Motivo de Salida: </br> <span class="textoinfo">'.$motivosalidatrab6.'</span></td>
  </tr>
  
  
  
  
  <tr>
     <td colspan="3" class="textoseccion">-- REFERENCIAS 	 Y PERSONALES --</td>
   </tr>
   
  <tr>
    <td colspan="3"><span class="textotitulos">Nombre completo de la referencia 1: 
      <span class="textoinfo">'.$nombreref1.'</span></span></td>
  </tr>
  <tr>
    <td colspan="2"><span class="textotitulos">Empresa donde labora:
      <span class="textoinfo">'.$empresaref1.'</span></span></td>
    <td></td>
  </tr>
  <tr>
    <td class="textotitulos"><span class="textotitulos">Cargo: </br>
      <span class="textoinfo">'.$cargoref1.'</span></span></td>
    <td class="textotitulos">Telf. Convencional: </br> <span class="textoinfo">'.$telfref1.'</span></td>
    <td class="textotitulos">Telf. Celular: </br> <span class="textoinfo">'.$celref1.'</span></td>
  </tr>
  
  <tr>
    <td colspan="3"><span class="textotitulos">Nombre completo de la referencia 2: 
      <span class="textoinfo">'.$nombreref2.'</span></span></td>
  </tr>
  <tr>
    <td colspan="2"><span class="textotitulos">Empresa donde labora:
      <span class="textoinfo">'.$empresaref2.'</span></span></td>
    <td></td>
  </tr>
  <tr>
    <td class="textotitulos"><span class="textotitulos">Cargo: </br>
      <span class="textoinfo">'.$cargoref2.'</span></span></td>
    <td class="textotitulos">Telf. Convencional : </br> <span class="textoinfo">'.$telfref2.'</span></td>
    <td class="textotitulos">Telf. Celular: </br> <span class="textoinfo">'.$celref2.'</span></td>
  </tr>
  
  <tr>
    <td colspan="3"><span class="textotitulos">Nombre completo de la referencia 3: 
      <span class="textoinfo">'.$nombreref3.'</span></span></td>
  </tr>
  <tr>
    <td colspan="2"><span class="textotitulos">Empresa donde labora:
      <span class="textoinfo">'.$empresaref3.'</span></span></td>
    <td></td>
  </tr>
  <tr>
    <td class="textotitulos"><span class="textotitulos">Cargo: </br>
      <span class="textoinfo">'.$cargoref3.'</span></span></td>
    <td class="textotitulos">Telf. Convencional: : </br> <span class="textoinfo">'.$telfref3.'</span></td>
    <td class="textotitulos">Telf. Celular: </br> <span class="textoinfo">'.$celref3.'</span></td>
  </tr>
  
  <tr>
    <td colspan="3">&nbsp;</td>
  </tr>
</table>
</td>
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
        $cabeceras .= 'From: Administrador <talentohumano@kaosportcenter.com>' . "\r\n";

        // Enviarlo
        mail($para, $título, $mensaje, $cabeceras);


                        $mensajeconf = "Se ha enviado una copia del curiculo al administrador, Gracias.";
                        echo "<script>";
                        echo "alert('$mensajeconf');";  
                        echo "window.location = '../ws-solitrabajo/';";
                        echo "</script>"; 
    }
    else
    {
       
                        $mensajeconf = "Error, no se ha podido enviar el curriculo al administrador.";
                        echo "<script>";
                        echo "alert('$mensajeconf');";  
                        echo "window.location = '../ws-solitrabajo/';";
                        echo "</script>"; 
                        
        
    }    

