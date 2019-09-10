<?php
require_once ('../ws-admin/seguridad.php');

require_once  './vendor/autoload.php';
$estadoVehiculo = new Evaluacion();
$arrayEmpresas = $estadoVehiculo->getEmpresas();
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
        <link rel="stylesheet" type="text/css" href="../libs/sweetalert2-master/dist/sweetalert2.min.css">
        <link href="../libs/bootstrap-datepicker-1.6.4/css/bootstrap-datepicker3.css" rel="stylesheet">
        
       
        <title><?php echo APP_NAME. " Administración"?></title>
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
        
        <?PHP include '../ws-admin/modules/build_menutop.php';?>              
        <?PHP include '../ws-admin/modules/sidebar.php';?>
            
        <div id="sidebar-central" class="contenedor-formulario">
                
                <div class="wrap">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="input-group">
                                <div class="col-md-4" style="padding-right: 0px; padding-left: 0px;">
                                    <input type="text" id="fechaINI" name="fechaINI" class="form-control centertext pickyDate"  placeholder="Fecha Inicial" value='<?php echo date('Y-m-01')?>'>
                
                                </div>
                                <div class="col-md-4" style="padding-right: 0px; padding-left: 0px;">
                                    <input type="text" id="fechaFIN" name="fechaFIN" class="form-control centertext pickyDate" placeholder="Fecha Final" value='<?php echo date('Y-m-d')?>'>
                
                                </div>

                                <div class="col-md-4" style="padding-right: 0px; padding-left: 0px;">
                                
                                        <select class="form-control centertext" name="seleccion_empresa" id="seleccion_empresa" required>
                                            <option value="">--- SELECCIONE EMPRESA ---</option>
                                            <?php 
                                                foreach ($arrayEmpresas as $opcion) {
                                                    echo' <option value="'.trim($opcion['Codigo']).'"> '.$opcion['Nombre'].' </option>';
                                                }

                                                ?>
                                        </select> 
                                    
                                </div>


                                
                            <span class="input-group-btn">
                                <button class="btn btn-default" type="button" id="btn_busqueda"><span class="glyphicon glyphicon-search"></span> Buscar</button>
                                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Opciones <span class="caret"></span></button>
                                    <ul class="dropdown-menu dropdown-menu-right">
                                        <li><a href="#" onclick="fn_genreport()"><span class="glyphicon glyphicon-file"></span> Informe PDF</a></li>
                                        <li><a href="#" onclick="fn_genreport_Excel()"><span class="glyphicon glyphicon-file"></span> Informe Excel</a></li>
                                        <li><a href="../ws-evanfitriones/" target="_blank"><span class="glyphicon glyphicon-file"></span> Nueva Evaluacion</a></li>
                                        
                                    </ul>
                            </span>
                            </div>
                        </div>
                    </div>
                
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
                                    <th class="text-left">ID</th>
                                    <th class="text-left">Cod. EV</th>
                                    <th class="text-left">Evaluador</th>
                                    <th class="text-left">Evaluado</th>
                                    <th class="text-left">Fecha</th>
                                    <th class="text-left">Puntaje</th>
                                    <th class="text-left">% Meta</th>
                                    <th class="text-left"></th>
                                    
                                    </tr>
                                </thead>
                                <tbody id='tbodyresults'>
                                </tbody>
                            </table>

                        </div>
                        
                    </div>   

                    <button type="button" class="btn btn-primary btn-sm rowspace" onclick="fn_genreport()" ><span class="glyphicon glyphicon-paste"></span> Exportar a PDF  </button>
                    <button type="button" class="btn btn-success btn-sm rowspace" onclick="fn_genreport_Excel()" ><span class="glyphicon glyphicon-paste"></span> Exportar a Excel (.XLS)  </button>
                 
                   
                </div>
            
                  
               
                
        </div>
     
    <!-- JS Libs -->
    <script src="../ws-admin/js/jquery-latest.js"></script>
    <script src="../ws-admin/js/bootstrap.js"></script>
    <script src="../ws-admin/js/menuresponsive.js"></script> 
    <script src="../libs/sweetalert2-master/dist/sweetalert2.min.js"></script>
    <script src="../libs/bootstrap-datepicker-1.6.4/js/bootstrap-datepicker.js"></script>
    <script src="../libs/bootstrap-datepicker-1.6.4/locales/bootstrap-datepicker.es.min.js"></script>
    <script type="text/javascript" src="../ws-admin/js/myJS.js"></script>
    <script type="text/javascript" src="assets/functions.js"></script>
    <script type="text/javascript" src="assets/admin.js"></script>
        
</body>
</html>