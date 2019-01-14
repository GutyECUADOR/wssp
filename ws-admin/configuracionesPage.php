<?php
include_once ('acceso_db.php');
include_once ('seguridad.php');

if(file_exists('../ws-admin/configuraciones.xml') && $configXML = simplexml_load_file('../ws-admin/configuraciones.xml')){
    $ultimoDiaValep = $configXML->ultimoDiaActivoVales;
    $ultimoDiaEvaluaEGG = $configXML->ultimoDiaEvaluaEGG;
    $finMantenimiento = $configXML->finMantenimiento;
    $modulos = $configXML->modulo;
}else{
    die ('Error no se pudo cargar el archivo de configuraciones XML, informe a sistemas.');
}

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
	<title>Configuraciones Generales</title>
	
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
                        include 'build_menuleft.php';
                        ?> 
                    </ul>
                    <div class="footer">Todos los derechos reservados © 2017 - <?php echo date("Y")?>, Ver 2.0.0</div>
                </nav>
                </div>
            </div>
            
        <div id="sidebar-central" class="contenedor-formulario">

        <ul class="nav nav-tabs">
            <li class="active"><a data-toggle="tab" href="#general">General</a></li>
            <li><a data-toggle="tab" href="#permisos">Permisos</a></li>
           
        </ul>

        <div class="tab-content">
           

            <!-- TAB general-->          
            <div id="general" class="tab-pane fade in active">
                <br>
                <div class="panel panel-default">
                    <!-- Default panel contents -->
                    <div class="panel-heading fonts14">Configuraciones Generales</div>
                    <div class="panel-body">
                        <div class="alert alert-danger">
                            <strong>Atención!</strong> Modifique estos valores segun el formato que se indica; colocar en formato distinto, podría ocasionar que el módulo quede inaccesible  .
                        </div>
                    </div>

                        <!-- List group -->
                        <ul class="list-group">
                            <li class="list-group-item fonts14">
                                <form class="form-horizontal" role="form">
                                <div class="form-group nomargin">
                                    <label for="inputType" class="col-md-7 control-label centertext">Modo Mantenimiento</label>
                                    <div class="col-md-3">
                                    <div class="input-group">
                                        <select class="form-control" id='enMantenimiento_input'>
                                            <option>true</option>
                                            <option selected>false</option>
                                        </select>
                                        <span class="input-group-addon" data-toggle="tooltip" title="Por defecto establezca en Desactivado (false) para permitir acceso a los modulos."><span class="glyphicon glyphicon-question-sign" aria-hidden="true"></span></span>
                                    </div>
                                        
                                    </div>
                                    <div class="col-md-2">
                                        <button type="button" class="btn btn-primary btn-block btn_actualizar" id='enMantenimiento'>Actualizar</button>
                                    </div>
                                </div>
                                </form>
                            </li> 

                            <li class="list-group-item fonts14">
                                <form class="form-horizontal" role="form">
                                <div class="form-group nomargin">
                                    <label for="inputType" class="col-md-7 control-label centertext">Fecha fin de mentanimiento (Solo informativo)</label>
                                    <div class="col-md-3">
                                    <div class="input-group">
                                        <input type="text" class="form-control text-center" id='finMantenimiento_input' placeholder="Dia del mes de 01 al 25" aria-describedby="basic-addon2" value="<?php echo $finMantenimiento?>">
                                        <span class="input-group-addon" data-toggle="tooltip" title="Texto independiente, mensaje aparecera en caso de modo mantenimiento en true"><span class="glyphicon glyphicon-question-sign" aria-hidden="true"></span></span>
                                    </div>
                                        
                                    </div>
                                    <div class="col-md-2">
                                        <button type="button" class="btn btn-primary btn-block btn_actualizar" id='finMantenimiento'>Actualizar</button>
                                    </div>
                                </div>
                                </form>
                            </li> 

                            <li class="list-group-item fonts14">
                                <form class="form-horizontal" role="form">
                                <div class="form-group nomargin">
                                    <label for="inputType" class="col-md-7 control-label centertext">Día máximo del mes para envío de vales por pérdida</label>
                                    <div class="col-md-3">
                                    <div class="input-group">
                                        <input type="text" class="form-control text-center" id='ultimoDiaActivoVales_input' placeholder="Dia del mes de 01 al 25" aria-describedby="basic-addon2" value="<?php echo $ultimoDiaValep?>">
                                        <span class="input-group-addon" data-toggle="tooltip" title="Ingrese valor en formado de dia DD ejemplo: 01 (con 0 delante) para dígitos menores a 10"><span class="glyphicon glyphicon-question-sign" aria-hidden="true"></span></span>
                                    </div>
                                        
                                    </div>
                                    <div class="col-md-2">
                                        <button type="button" class="btn btn-primary btn-block btn_actualizar" id='ultimoDiaActivoVales'>Actualizar</button>
                                    </div>
                                </div>
                                </form>
                            </li>  
                            <li class="list-group-item fonts14">
                                <form class="form-horizontal" role="form">
                                <div class="form-group nomargin">
                                    <label for="inputType" class="col-md-7 control-label centertext">Día máximo del mes para envío evaluación de jefes</label>
                                    <div class="col-md-3">
                                    <div class="input-group">
                                        <input type="text" class="form-control text-center" id='ultimoDiaEvaluaEGG_input' placeholder="Dia del mes de 01 al 25" aria-describedby="basic-addon2" value="<?php echo $ultimoDiaEvaluaEGG?>">
                                        <span class="input-group-addon" data-toggle="tooltip" title="Ingrese valor en formado de dia DD ejemplo: 01 (con 0 delante)"><span class="glyphicon glyphicon-question-sign" aria-hidden="true"></span></span>
                                    </div>
                                        
                                    </div>
                                    <div class="col-md-2">
                                        <button type="button" class="btn btn-primary btn-block btn_actualizar" id="ultimoDiaEvaluaEGG">Actualizar</button>
                                    </div>
                                </div>
                                </form>
                            </li>   
                        </ul>
                </div>    
            </div>
            <!-- FIN TAB general--> 

            <!-- TAB permisos-->  

            <div id="permisos" class="tab-pane fade">
                <br>

                
                <div class="panel panel-default col-md-5">
                    <!-- Default panel contents -->
                    <div class="panel-heading fonts14">Tipo de Usuario</div>
                    <div class="panel-body">
                       
                            <select class="form-control centertext" name="select_tipoUser" id="select_tipoUser">
                                <option value="">--- TIPO DE USUARIO ---</option>
                                <option value="ADM">Administradores</option>
                                <option value="SSP">Super Supervisor</option>
                                <option value="SUP">Supervisores</option>
                                <option value="ASI">Asistentes</option>
                                <option value="VAL">Autorizacion de Vales</option>
                                <option value="EVA">Evaluadores</option>
                            </select> 
                          
                    </div>
                </div>    

                <div class="col-md-1"></div> 

                <div class="panel panel-default col-md-6">
                    <!-- Default panel contents -->
                    <div class="panel-heading fonts14">Módulos</div>
                    <div class="panel-body resultModulos">
                       <?php
                        
                       ?>
                       
                    </div>
                    
                </div>    
            </div>

             <!-- Permisos TAB permisos-->  
           
        </div>

       
        <!-- USO JQUERY, animacion de menu para responsive-->

        <script src="js/jquery-latest.js"></script>
        <script src="js/bootstrap.js"></script>
        <script src="js/menuresponsive.js"></script>
        <script src="js/funciones.js"></script>
        
</body>
</html>