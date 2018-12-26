<?php
include_once ('../ws-admin/acceso_db.php');
include_once ('../ws-admin/seguridad.php');
include_once ('../ws-admin/funciones.php'); // Acceso a funciones utiles
include_once ('funcions.php'); // Acceso a funciones del modulo
?>

<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<link rel="shortcut icon" href="../ws-admin/img/favicon.ico">
        <link href='../ws-admin/css/roboto.css' rel='stylesheet' type='text/css'>
        
        <link rel="stylesheet" href="../ws-admin/css/estilos_main.css">
        <link rel="stylesheet" href="../ws-admin/css/bootstrap.css">
        <link rel="stylesheet" href="../ws-admin/fonts/style.css">
	
       <!-- USO JQUERY, animacion de menu para responsive-->
        <script src="../ws-admin/js/jquery-latest.js"></script>
        <script src="../ws-admin/js/bootstrap.js"></script>
        <script src="../ws-admin/js/menuresponsive.js"></script>
       
        <!-- Librerias datepicker Boostrap3-->
        <link href="../libs/bootstrap-datepicker-1.6.4/css/bootstrap-datepicker3.css" rel="stylesheet">
        <script src="../libs/bootstrap-datepicker-1.6.4/js/bootstrap-datepicker.js"></script>
        <script src="../libs/bootstrap-datepicker-1.6.4/locales/bootstrap-datepicker.es.min.js"></script>
        <script type="text/javascript" src="../ws-admin/js/myJS.js"></script>
        
        <script type="text/javascript" src="functions_admin.js"></script>
        
        <title>Registro de vales por pérdida</title>
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
                              echo '</br>CI: '.$_SESSION['user_ruc'];
                              echo '</br> Acceso: '.$_SESSION['user_lv'];
                              echo '</br> Empresa'.$_SESSION['empresa_autentificada'];
                        ?>
                            <input type="hidden" id="hidden_empresa_autentificada" value="<?php echo $_SESSION['empresa_autentificada']?>">      
                        </span>
                    </div>
                
                <div class="footer"></div>
                
                </div>
                <!-- Bloque Menus-->
                <div class="container-menu">  
                <nav id="evaluaeji">
                <h5 class="tituloh5">Menú Principal</h5>
                <ul class="menu">
                        <?PHP 
                        include '../ws-admin/build_menuleft.php';
                        ?> 
                    </ul>
                    <div class="footer">Todos los derechos reservados © 2017, Ver 2.0.0</div>
                </nav>
                </div>
            </div>
            
        <div id="sidebar-central" class="contenedor-formulario">
                <div class="wrap">
                    <!-- Inicio panel de navegacion y busqueda -->
                    <div class="row">
                        <div class="col-md-12">
                        <div class="col-md-6">
                        <div class="input-group">
                           
                               <input type="text" id="dateini_modal" class="form-control centertext pickyDate"  placeholder="Fecha Inicial"><span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                               <input type="text" id="datefin_modal" class="form-control centertext pickyDate" placeholder="Fecha Final"><span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                        </div>
                    </div>  
                    <div class="col-md-6">  
                    <div class="input-group ">
                       <select class="form-control centertext" name="seleccion_tipodoc" id="seleccion_tipodoc" required>
                                <option value="">--- TODAS LAS EMPRESAS ---</option>
                            </select>  
                          <span class="input-group-btn">
                                <button class="btn btn-default" type="button" id="btn_busqueda_eji"><span class="glyphicon glyphicon-search"></span> Buscar</button>
                                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Opciones <span class="caret"></span></button>
                                
                                <ul class="dropdown-menu dropdown-menu-right">
                                    <li><a href="#" data-toggle="modal" data-target="#Modal_Excel_EJI"><span class="glyphicon glyphicon-file"></span> Exportar Excel (xls)</a></li>
                                    <li><a href="../ws-evaluagge/" target="_blank"><span class="glyphicon glyphicon-file"></span> Nueva Evaluación</a></li>
                                </ul>
                          </span>
                    </div><!-- /input-group -->
                    
                      
                  </div><!-- /.col-lg-6 -->
                </div><!-- /.row -->
                
                </div>
                </div>
                </br>
                

                <div class="wrap">
                    <div class="txtseccion">
                        <label class="etique"> RESULTADOS DE BÚSQUEDA</label>
                    </div>
                    
                    <div id="responsibetable">
                        <!-- Resultados AJAX-->
                        <div class="result_search_eji">
                            <?php include_once './grid_dinamico.php';?>
                        </div>
                        
                    </div>    
                   
                </div>
        </div>
     
      
        <?php require_once 'modalExcel.php';?>
    
</body>
</html>