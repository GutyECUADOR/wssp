<?php
include_once ('acceso_db.php');
include_once ('seguridad.php');

?>

<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<link rel="stylesheet" href="css/estilos_main.css">
        <link rel="stylesheet" href="css/bootstrap.css">
        <link rel="stylesheet" href="fonts/style.css">
	<link rel="shortcut icon" href="img/favicon.ico">
	<link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="css/tcal.css" />
        <script type="text/javascript" src="js/tcal.js"></script> 
	<script src='https://www.google.com/recaptcha/api.js'></script>
	
        <!-- USO JQUERY, animacion de menu para responsive-->
        <script src="../ws-admin/js/jquery-latest.js"></script>
        <script src="../ws-admin/js/bootstrap.js"></script>
        <script src="../ws-admin/js/menuresponsive.js"></script>
        
        <title>Ajustes de Usuario</title>
	
</head>
<body>
        <header>
                <div class="wrapper">
                        <nav class="navizq">
                            <a href="#" class="btn_menu"><span class="icon-indent-decrease icon-large linksnav"></span></a>
                        </nav>
                        <div class="logocontainer">
                            <a href="#" target="_top"><img class="logo" src="img/logo.png" alt="Logo Sistema"></a>
                        </div>
			<nav>
                                <?PHP 
                                    include 'build_menutop.php';
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
                              echo '</br>CI: '.$_SESSION['user_ruc'];
                              echo '</br> Acceso: '.$_SESSION['user_lv'];
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
                        <?PHP 
                        include 'build_menuleft.php';
                        ?> 
                    </ul>
                    <div class="footer">Todos los derechos reservados © 2017, Ver 2.0.0</div>
                </nav>
                </div>
            </div>
    
            <div id="sidebar-central" class="contenedor-formulario">
		<div class="wrap">
                    <div class="txtseccion">
                        <label class="etique">Configuraciones Generales</label>
                    </div>
                    
                    <div class="row">
                        <table class="table">
                            <tr>
                                <th><p><small>Contraseña utilizada para la validación de evaluacion a empleados</small></p></th>
                                <th><button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modalcontraseña"><span class="glyphicon glyphicon-pencil"></span> Cambiar Contraseña </button>                            </th> 
                            </tr>
                            
                        </table>
                        
                        
                    </div>
                </div>
                </br>
               
            </div>
     
            <!-- Modal Cambiar Contraseña -->
            
            <div class="modal fade" id="modalcontraseña" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  </div>
                  <div class="modal-body">
                      <form action="../ws-admin/ajax_update_pass.php" class="formulario" method="POST">
                          <h5>Antigua Contraseña</h5>
                            <input class="cajacod" type="text" name="txt_oldpass" maxlength="20" requiered>
                          <h5>Nueva Contraseña</h5>
                            <input class="cajacod" type="text" name="txt_newpass1" maxlength="20" requiered>
                          <h5>Repita nueva Contraseña</h5>
                            <input class="cajacod" type="text" name="txt_newpass2" maxlength="20" requiered>
                            
                  </div>
                  <div class="modal-footer">
                            <button type="submit" class="btn btn-info btn-sm"> Actualizar </button>
                            <input type="button" class="btn btn-default btn-sm" value="Cancelar" data-dismiss="modal">
                        </form>
                </div>
              </div>
            </div>      
            
    
</body>
</html>