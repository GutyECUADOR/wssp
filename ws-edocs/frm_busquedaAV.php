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
                               
                                    }
                                ?>                 
         
                            
                                   </li>
                                   <li><a href="logout.php"><span class="icon-mail"></span>Cerrar Sesión</a></li>
			</ul>
		</nav>
	</header>
        
        
        
</div>
   </center>    
       
       
       
        <table class="CSSTableGenerator">
<tr>
                <td width="100%">
                Identificado como :                       
                <label>  <?php echo $_SESSION['rSOCIALVAR']?></label>
                </td>
                
            </tr>
        </table>
           
        <table class="CSSTableGenerator" width="545" height="250" border="1">
            <tr>
                    <td>     
                        <form action="frm_resultadosAV.php" method="get" name="frm_principal">
                      <h3>Este proceso puede tardar unos minutos en completar, espere.</h3><br>
                      <input type="radio" name="chk_radio" id="1" value="1" checked="checked"><br>
                      Facturas <br>
                      <input type="radio" name="chk_radio" id="2" value="2"><br>
                      Notas de Crédito <br>
                      <input type="radio" name="chk_radio" id="3" value="3"><br>
                      Retenciones <br>
                      <input type="radio" name="chk_radio" id="4" value="4"><br>
                      Guias de Remisión <br>
                      <input type="radio" name="chk_radio" id="0" value="0" checked><br>
                      Todo                     
                    <p>
  <input type="submit" value="Consultar" style="width:50%;height:40px">
                  </form>
           
                </td>
	    </tr>
		  
    </table>    
         
        
     <script src="http://code.jquery.com/jquery-latest.js"></script> 
     <script src="menu.js"></script>         
        
    </body>
</html>

