<?php
include_once ('../ws-admin/acceso_db.php');
include_once ('../ws-admin/seguridad.php');
session_start();
?>

<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<link rel="stylesheet" href="../ws-admin/css/estilos_main.css">
        <link rel="stylesheet" href="../ws-admin/css/bootstrap.css">
        <link rel="stylesheet" href="../ws-admin/fonts/style.css">
	<link rel="shortcut icon" href="../ws-admin/img/favicon.ico">
	<link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="../ws-admin/css/tcal.css" />
        <script type="text/javascript" src="../ws-admin/js/tcal.js"></script> 
	<script src='https://www.google.com/recaptcha/api.js'></script>
	<title>Config. Solicitud Trabajo</title>
	
</head>

<body>
    
        <header>
                <div class="wrapper">
                        <nav class="navizq">
                            <a href="#" class="btn_menu"><span class="icon-indent-decrease icon-large linksnav"></span></a>
                        </nav>
                        <div class="logocontainer">
                            <a href="#" target="_top"><img class="logo" src="../ws-admin/img/logo.png" alt="Logo Sistema"></a>
                        </div>
			<nav>
                            <?PHP $consulta_headermenu = mysql_query("SELECT * FROM tbl_confheadermenu ORDER BY menu_id ASC");
                                while ($row = mysql_fetch_array($consulta_headermenu)) 
                                {echo '<a href="'.$row['url_menu'].'"><span class="'.$row['clases_menu'].'"><span class="'.$row['clases_textmenu'].'">'.$row['nombre_menu'].'</span></span></a>';
                                }
                            ?>
                        </nav>
		</div>
	</header>
        
            <div class="sidebar-left">
                <!-- Bloque perfil de usuario-->
                <div class="container-menu">
                <h5 class="tituloh5">Perfil de Usuario</h5>    
                    <div>
                        <img class="imagenusuario" src="<?PHP 
                            if ($_SESSION['user_pic']!='')
                            {echo $_SESSION['user_pic'];
                            }else
                            {echo '../ws-cargaimagen/fotos/photo-nouser.jpg';}    
                                 
                        ?>" alt="USR">
                    </div>
                
                    <div class="infousuario">
                        <span class="textperfilusuario">
                        <?PHP echo 'Bienvenido, '.$_SESSION['user_autentificado'];
                              echo '</br>'.$_SESSION['user_ruc'];
                        ?>
                              
                        </span>
                    </div>
                
                <div class="footer"></div>
                
                </div>
                <!-- Bloque Menus-->
                <div class="container-menu">  
                <nav>
                <h5 class="tituloh5">Menú Principal</h5>
          
                <ul>
                  <?PHP $consulta_leftmenu = mysql_query("SELECT * FROM tbl_confmenuleft ORDER BY menu_id ASC");
                        while ($row = mysql_fetch_array($consulta_leftmenu)) 
                        {echo '<li><a href="'.$row['url_menu'].'"><span class="'.$row['clases_menu'].'"><span class="'.$row['clases_textmenu'].'">'.$row['nombre_menu'].'</span></span></a></li>';
                        }
                  ?>
                  </ul>
                    <div class="footer">Todos los derechos reservados © 2016, Ver 2.0.0</div>
                </nav>
                </div>
            </div>
            
        <div id="sidebar-central" class="contenedor-formulario">
		<div class="wrap">
                    <div id="bloque">
                        <div class="txtseccion">
                                    <label class="etique"> E-MAIL DE ENTREGA</label>
                        </div> 
                        
                        <div id="bloque">
                            <div class="input-group">
                                <form action="updatecorreo.php" class="formulario" method="POST">
                            
                                <div class="txtcentro">
                                    <label> Especifique correo al que llegerán copias electronicas de postulantes registrados.</label>
                                </div>
                                   
                                <input class="box1" type="email" id="iconemail" name="txt_usuariomail" maxlength="45" placeholder="ejemplo@dominio.com" value="
                                       <?PHP $consulta_correo = mysql_query("SELECT * FROM tbl_generalconfigs WHERE nombre_var = 'correo_curriculos'");
                                        $row = mysql_fetch_array($consulta_correo);
                                        echo "$row[valor]";
                                        ?>
                                " required>
                            
                                <input class="botonazul" type="submit" value="Actualizar Correo">
                            </form>
                            </div>
                            
                        </div>
                    </div>
                    
                    <div id="bloque">
                        <form action="updatechecks.php" class="formulario" method="POST">
                        <div class="txtseccion">
                            <label class="etique"> PUESTOS DE TRABAJO</label>
                        </div>
                        <div class="txtcentro">
                            <label> Especifique las opciones que estarán disponibles para los postulantes (ON/OFF)</label>
                        </div>    
                            
                        <?php include ('grid_dinamico.php'); ?>
                           
                            <input class="botonazul" type="button" value="Agregar Nuevo" data-toggle="modal" data-target="#modaladdcargo">
                            <input class="botonazul" type="submit" value="Actualizar Estados">
                        </form>
                        
                    </div>   
                </div>
	
            <!-- Modal/Agregar Cargo-->
            <div class="modal fade" id="modaladdcargo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h5 class="modal-title" id="myModalLabel">AGREGAR CARGO</h5>
                  </div>
                  <div class="modal-body">
                      <form action="addcargo.php" class="formulario" method="POST">
                            <input class="box1" type="text" name="txt_addnewcargo" maxlength="45" placeholder="Nuevo Cargo" requiered="requiered">
                          
                  </div>
                  <div class="modal-footer">
                            <button type="submit" class="btn btn-default btn-sm"><span class="glyphicon glyphicon-plus"></span> Agregar </button>
                            <input type="button" class="btn btn-default btn-sm" value="Cancelar" data-dismiss="modal">
                        </form>
                </div>
              </div>
            </div>      
            
            
                
            
        </div>
     
        <!-- USO JQUERY, animacion de menu para responsive-->
        <script src="http://code.jquery.com/jquery-latest.js"></script>
        <script src="../ws-admin/js/bootstrap.js"></script>
        <script src="../ws-admin/js/menuresponsive.js"></script>
</body>
</html>