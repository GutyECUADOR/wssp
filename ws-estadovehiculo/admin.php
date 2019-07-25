<?php
include_once ('../ws-admin/acceso_db.php');
include_once ('../ws-admin/seguridad.php');

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
	<title>Lista de Vehiculos</title>
	
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
                                <?PHP 
                                    include '../ws-admin/build_menutop.php';
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
                              echo '</br> CI: '.$_SESSION['user_ruc'];
                              echo '</br> Acceso: '.$_SESSION['user_lv'];
                              echo '</br> Empresa: '.$_SESSION['empresa_autentificada'];
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
                        include '../ws-admin/build_menuleft.php';
                        ?> 
                    </ul>
                    <div class="footer">Todos los derechos reservados © 2017 - <?php echo date("Y")?>, Ver 2.0.0</div>
                </nav>
                </div>
            </div>
            
        <div id="sidebar-central" class="contenedor-formulario">
            <div class="wrap">
                <div class="row">
                  <div class="col-sm-12">
                    <div class="input-group">
                        <input type="text" class="form-control" id="txt_busqueda" placeholder="Placas del Vehiculo" required="">
                      <span class="input-group-btn">
                          <button class="btn btn-default" type="button" id="btn_busqueda"><span class="glyphicon glyphicon-search"></span> Buscar</button>
                          <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Opciones <span class="caret"></span></button>
                            <ul class="dropdown-menu dropdown-menu-right">
                                <li><a href="../ws-evalua/" target="_blank"><span class="glyphicon glyphicon-file"></span> Nuevo Est. Vehiculo</a></li>
                                <li><a href="../ws-evalua/" target="_blank"><span class="glyphicon glyphicon-file"></span> Nuevo Orden Pedido</a></li>
                            </ul>
                      </span>
                    </div><!-- /input-group -->
                  </div><!-- /.col-lg-6 -->
                </div><!-- /.row -->
            </div>

            <br>
                
                <div class="wrap">
                    <div class="txtseccion">
                        <label class="etique"> RESULTADOS DE BÚSQUEDA</label>
                    </div>
                    
                    <div id="responsibetable">
                        <!-- Resultados AJAX-->
                        <div class="resultados">
                            <table class="table table-condensed table-striped table-hover">
                                <thead>
                                    <tr>
                                    <th class="text-left">Placas</th>
                                    <th class="text-left">Vehiculo</th>
                                    <th class="text-left">Asignado a</th>
                                    <th class="text-left">Fecha Asignacion</th>
                                    <th class="text-left">Kilometraje</th>
                                    
                                    </tr>
                                </thead>
                                <tbody id='tbodyresults'>
                                </tbody>
                            </table>

                        </div>
                        
                    </div>    
                   
                </div>
	    </div>
       
        <!-- USO JQUERY, animacion de menu para responsive-->
        <script src="http://code.jquery.com/jquery-latest.js"></script>
        <script src="../ws-admin/js/bootstrap.js"></script>
        <script src="../ws-admin/js/menuresponsive.js"></script>
        <script src="admin.js"></script>
        
        
</body>
</html>