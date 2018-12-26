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
        
       
        <table class="CSSTableGenerator">
<tr>
                <td width="100%">
                COMBIO DE CONTRASEÑA:                        
                <label>  <?php echo $_SESSION['rSOCIALVAR']?></label>
                </td>
                
            </tr>
        </table>
           
        <table class="CSSTableGenerator" width="545" height="250" border="1">
           
            
            <tr>
                    <td> 
                    
                    
                    
                     <?php
    @session_start();
    include('acceso_db.php'); //  datos de conexión a la BD
    if(isset($_SESSION['user'])) { // comprobamos que la sesión esté iniciada
        if(isset($_POST['enviar'])) {
            if($_POST['nuevaclave'] != $_POST['nuevaclave_conf']) {
                echo "Las contraseñas ingresadas no coinciden. <a href='javascript:history.back();'>Reintentar</a>";
            }else {
                $usuario_nombre = $_SESSION['rSOCIALVAR'];
                $nuevaclave = mysql_real_escape_string($_POST["nuevaclave"]);
                
                $sql = mysql_query("UPDATE tbl_cliente SET password='".$nuevaclave."' WHERE nombre='".$usuario_nombre."'");
                if($sql)
                    {
                   
                    $mensaje = "Contraseña actualizada correctamente, reingrese al sistema";
                    echo "<script>";
                    echo "alert('$mensaje');";  
                    echo "window.location = 'frm_acceso.html';";
                    echo "</script>";  

                    }
                        else 
                    {

                   $mensaje = "Error al intentar actualizar sus datos, reintente";
                    echo "<script>";
                    echo "alert('$mensaje');";  
                    echo "window.location = 'formularioCON.php';";
                    echo "</script>";  


                    }
            }
        }else {
?>
<form action="<?=$_SERVER['PHP_SELF']?>" method="post" class="tableCSS.css">
            <label>Nueva contrasena:</label><br><br>
            <input type="password" name="nuevaclave" maxlength="15" required/><br><br>
            <label>Confirmar:</label><br><br>
            <input type="password" name="nuevaclave_conf" maxlength="15" required/><br><br>
          
            <input type="submit" name="enviar" value="Actualizar" />
        </form>
<?php
        }
    }else {
        echo "Acceso denegado.";
    }
?> 
                    
              
		    </td>
	    </tr>
		  
    </table>    
         
        
       <script src="http://code.jquery.com/jquery-latest.js"></script> 
     <script src="menu.js"></script>            
                
        
    </body>
</html>    