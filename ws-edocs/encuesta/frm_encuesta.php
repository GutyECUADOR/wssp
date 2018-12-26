<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
	
    <link rel="stylesheet" type="text/css" href="tcal.css" />
    <script type="text/javascript" src="tcal.js"></script> 
    <link rel="stylesheet" type="text/css" href="tableCSS.css" media="screen" />
  
 
<title>Encuesta a clientes</title>
</head>

<body>
<table width="40%" border="1" align="center" class="CSSTableGenerator">
<tr><td>
        
<form action="agregardatos.php" method="post" name="frm_encuesta">
<h3 align="center">ENCUESTA DE SATISFACCIÓN AL CLIENTE</h3>
<div align="center">Estimado cliente,  estamos mejorando cada día y para nosotros su opinión es muy importante, por  tal motivo le solicitamos llenar la siguiente encuesta para así poder servirle  de mejor manera.</div>

<p align="center">
  <label for="list_local">Local:</label>
  <select name='local' style="width:30%;height:30px">

    <optgroup label="Quito">
    <option value="C.C.Bosque">C.C.Bosque</option>
    <option value="C.C.I">C.C.I</option>
    <option value="C.C.Quicentro Norte">C.C.Quicentro Norte</option>
    </optgroup>

    <optgroup label="Guayaquil">
    <option value="Matriz Guayaquil">Matriz</option>
     <option value="Policentro">Policentro</option>
    </optgroup>

</select> 
  
  Fecha:
  <input type="text" name="date"  class="tcal" id="fecha" value="<?php echo date("d/m/Y"); ?>" size="10" style="width:30%;height:30px"/>
  
</p>
<center>
<p> <h3>DATOS REQUERIDOS: </h3>
Edad: 
	<SELECT NAME="edad" style="width:30%;height:30px">
	   <OPTION VALUE="12 a 18">12 a 18 años</OPTION>
	   <OPTION VALUE="19 a 25">19 a 25 años</OPTION>
	   <OPTION VALUE="26 a 35">26 a 35 años</OPTION>
	   <OPTION VALUE="36 a 45">36 a 45 años</OPTION>
	   <OPTION VALUE="más de 45">más de 45 años</OPTION>
	</SELECT> 
</p>
</center>
</td>
<tr>
</table>

<table width="40%" border="1" class="CSSTableGenerator">
  <tr>
    <td colspan="2" align="center">ATENCIÓN AL CLIENTE E IMAGEN</td>
    </tr>
  <tr>
    <td width="60%">a. Le saludaron al entrar al local?</td>
    <td width="40%">
     <SELECT  NAME="preguntaA" style="width:90%;height:40px">
	   <OPTION VALUE="SI">SI</OPTION>
	   <OPTION VALUE="NO">NO</OPTION>
	
	</SELECT> 
    </td>
  </tr>
  <tr>
    <td><p>b. La amabilidad y cordialidad de los asesores que le  atendió fue?</p></td>
    <td>
     <SELECT NAME="preguntaB" style="width:90%;height:40px">
	   <OPTION VALUE="EXELENTE">EXELENTE</OPTION>
	   <OPTION VALUE="MUY BUENO">MUY BUENO</OPTION>
	   <OPTION VALUE="BUENO">BUENO</OPTION>
	   <OPTION VALUE="REGULAR">REGULAR</OPTION>
	</SELECT> 
  </td>
  </tr>
  <tr>
    <td><p>c. El asesoramiento de los productos y promociones que le  dieron fue?</p></td>
    <td>
      <SELECT NAME="preguntaC" style="width:90%;height:40px">
	   <OPTION VALUE="EXELENTE">EXELENTE</OPTION>
	   <OPTION VALUE="MUY BUENO">MUY BUENO</OPTION>
	   <OPTION VALUE="BUENO">BUENO</OPTION>
	   <OPTION VALUE="REGULAR">REGULAR</OPTION>
	</SELECT> 
    </td>
  </tr>
  <tr>
    <td><p>d. Como fue la atención y eficiencia de la cajera?</p></td>
    <td>
       <SELECT NAME="preguntaD" style="width:90%;height:40px">
	   <OPTION VALUE="EXELENTE">EXELENTE</OPTION>
	   <OPTION VALUE="MUY BUENO">MUY BUENO</OPTION>
	   <OPTION VALUE="BUENO">BUENO</OPTION>
	   <OPTION VALUE="REGULAR">REGULAR</OPTION>
	</SELECT> 
    </td>
  </tr>
  <tr>
    <td><p>e. Se despidieron por su nombre y le agradecieron por su  compra?</p></td>
    <td> 
        <SELECT  NAME="preguntaE" style="width:90%;height:40px">
	   <OPTION VALUE="SI">SI</OPTION>
	   <OPTION VALUE="NO">NO</OPTION>
	
	</SELECT> 
    </td>
  </tr>
  <tr>
    <td><p>f. La imagen personal del asesor le pareció?</p></td>
    <td>
       <SELECT NAME="preguntaF" style="width:90%;height:40px">
	   <OPTION VALUE="EXELENTE">EXELENTE</OPTION>
	   <OPTION VALUE="MUY BUENO">MUY BUENO</OPTION>
	   <OPTION VALUE="BUENO">BUENO</OPTION>
	   <OPTION VALUE="REGULAR">REGULAR</OPTION>
	</SELECT> 
    </td>
  </tr>
  <tr>
    <td><p>g. Cómo calificaría el orden y la limpieza en general?</p></td>
    <td>
       <SELECT NAME="preguntaG" style="width:90%;height:40px">
	   <OPTION VALUE="EXELENTE">EXELENTE</OPTION>
	   <OPTION VALUE="MUY BUENO">MUY BUENO</OPTION>
	   <OPTION VALUE="BUENO">BUENO</OPTION>
	   <OPTION VALUE="REGULAR">REGULAR</OPTION>
	</SELECT> 
    </td>
  </tr>
  <tr>
    <td><p>h. Con que frecuencia usted visita los locales de Kao Sport  Center?</p></td>
    <td>
       <SELECT NAME="preguntaH" style="width:90%;height:40px">
	   <OPTION VALUE="MUY SEGUIDO">MUY SEGUIDO</OPTION>
	   <OPTION VALUE="OCASIONALMENTE">OCASIONALMENTE</OPTION>
	   <OPTION VALUE="A VECES">A VECES</OPTION>
	   <OPTION VALUE="RARA VEZ">RARA VEZ</OPTION>
	</SELECT> 
    </td>
  </tr>
  <tr>
    <td><p>i. Conoce usted de la existencia de KAO en las redes  sociales como Facebook y Twitter?</p></td>
    <td>
    <SELECT  NAME="preguntaI" style="width:90%;height:40px">
	   <OPTION VALUE="SI">SI</OPTION>
	   <OPTION VALUE="NO">NO</OPTION>
	
	</SELECT> 
    </td>
  </tr>
  <tr>
    <td colspan="2" align="center">OBSERVACIONES Y COMENTARIOS</td>
    </tr>
  <tr>
      <td colspan="2"><input type="textarea" class="textarea" name="comentarios" id="comentarios" style="width: 100%; height: 102px;"></textarea></td>
  </tr>
  
<tr>
    <td colspan="2" align="center"><input type="submit" name='Enviar' value="Terminar encuesta" style="width:50%;height:40px"></td>
    </tr>

</form>

</table>

</body>
</html>
