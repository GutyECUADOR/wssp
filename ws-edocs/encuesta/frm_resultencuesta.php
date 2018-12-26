<!DOCTYPE html>
<?php @session_start();
                include('acceso_db.php');
                $perfil = mysql_query("select * from tbl_cliente where ruc='".$_SESSION['user']."'") or die(mysql_error());
               if(mysql_num_rows($perfil)) 
                   { // Comprobacion del registro con usuario ingresado
                        $row = mysql_fetch_array($perfil);
                        $_SESSION['rSOCIALVAR'] = $row["nombre"];
                        $_SESSION['RUCACTIVO']=$_SESSION['user'];
                   }   
              
?>
<html>
    <head>
        <title>Formulario de Consulta</title>
        <link rel="shortcut icon" href="favicon.ico">
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="tableCSS.css" media="screen" />
        <link rel="stylesheet" type="text/css" href="estilos.css" media="screen" />
        <link rel="stylesheet" type="text/css" href="styleicons.css" media="screen" />
        <link rel="stylesheet" type="text/css" href="tcal.css" />
        <script type="text/javascript" src="tcal.js"></script> 
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    
    </head>
    <body>
        
        <header>
		<div class="menu_bar">
			<a href="#" class="bt-menu"><img class="ico" src="glyphicons-114-justify.png">Menú</a>
		</div>
 
		<nav>
			<ul>
				<li><a href="formularioCON.php"><span class="icon-home3"></span>Inicio</a></li>
				<li><a href="frm_busquedaAV.php"><span class="icon-suitcase"></span>Búsqueda Avanzada</a></li>
                                 <li>
        
                              <?php
                               @session_start();
                               include('acceso_db.php'); 
                               if($_SESSION['rSOCIALVAR']!='ADMINISTRADOR') 
                                   {
                                 echo " <li><a href='cambiar_contrasena.php'>Cambiar contraseña</a>";
                                 echo "</li>";
                                    }
                                ?>                 
          
                             <?php
                               @session_start();
                               include('acceso_db.php'); 
                               if($_SESSION['rSOCIALVAR']=='ADMINISTRADOR') 
                                   {
                               
                                 echo "<li><a href='formularioCONCLIENTE.php'><span class='icon-home3'>Clientes</span></a>";
                                 echo "</li>";
                               
                                 echo "<li><a href=''><span class='icon-home3'>Informe Encuesta</span></a>";
                                 echo "</li>";
                                    }
                                ?>                 
         
                            
                                   </li>
                                   <li><a href="logout.php"><span class="icon-mail"></span>Cerrar Sesión</a></li>
			</ul>
		</nav>
	</header>
        
        <table class="CSSTableGenerator">
<tr>
                <td width="100%">
                Identificado como :                       
                <label>  <?php echo $_SESSION['rSOCIALVAR']?></label>
                </td>
                
            </tr>
        </table>
           
       <table class="CSSTableGenerator" align="center">
		<tr>
                <td align="center" colspan="7">
                    
                    <form action="encuesta/frm_resultencuesta.php" method="get">
                        <h2>Informe de Encuestas</h2><br>
                         <label>  <?php echo $rowNOMBRE[0];?></label>
                    
                    Local:
                    <select name='local' style="width:50%">
                    <optgroup label="General">
                    <option value="General">Informe General</option>
                    </optgroup>    
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
                    </br> </br> 
                         
                         
                    Fecha Inicio:
                    <input type="text" name="dateinicio"  class="tcal" id="fecha" value="<?php echo date("d/m/Y"); ?>" size="10" style="width:15%"/>
                    Fecha Fin:
                    <input type="text" name="datefin"  class="tcal" id="fecha" value="<?php echo date("d/m/Y"); ?>" size="10" style="width:15%"/>
                    <br>
                    
                   <FIELDSET>
                    <LEGEND>Preguntas Disponibles</LEGEND>
                    </br>
                    <input name="CHK_PREG1" type="checkbox" onclick="marcar(this);"/> Habilitar/Deshabilitar todo.
                          <p align="justify"> 
                          <input name="CHK_PREG1" type="checkbox" /> 1. Le saludaron al entrar al local?
                          <br />
                          <input name="CHK_PREG2" type="checkbox" /> 2. La amabilidad y cordialidad de los asesores que le atendió fue?
                          <br />
                          <input name="CHK_PREG3" type="checkbox" /> 3. El asesoramiento de los productos y promociones que le dieron fue?
                          <br />
                          <input name="CHK_PREG4" type="checkbox" /> 4. Como fue la atención y eficiencia de la cajera?
                          <br />
                          <input name="CHK_PREG5" type="checkbox" /> 5. Se despidieron por su nombre y le agradecieron por su compra?
                          <br />
                          <input name="CHK_PREG6" type="checkbox" /> 6. La imagen personal del asesor le pareció?
                          <br />
                          <input name="CHK_PREG7" type="checkbox" /> 7. Cómo calificaría el orden y la limpieza en general?
                          <br />
                          <input name="CHK_PREG8" type="checkbox" /> 8. Con que frecuencia usted visita los locales de Kao Sport Center?
                          <br />
                          <input name="CHK_PREG9" type="checkbox" /> 9. El asesoramiento de los productos y promociones que le dieron fue?
                          <br />
                          <input name="CHK_PREG10" type="checkbox" /> 10. Conoce usted de la existencia de KAO en las redes sociales como Facebook y Twitter?
                          <br />
                          <input name="CHK_PREG10" type="checkbox" /> 11. Comentarios.
                          
                          </p>
                    
                    </br>
                  </FIELDSET>
                    
                   
                    
                    
                    <br><br><input type="submit" value="Generar Informe" style="width:25%;height:40px" >
                    <input type="button" value="Regresar" onClick="window.open('formularioCON.php','_self',false)" style="width:25%;height:40px" >
                     </form>
                    </td>
                    
                </tr>
                   
        </table>    
         
        
              
   <script src="http://code.jquery.com/jquery-latest.js"></script> 
   <script src="menu.js"></script>
    </body>
</html>
