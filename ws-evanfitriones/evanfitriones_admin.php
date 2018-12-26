<?php
include_once ('../ws-admin/acceso_db.php');
include_once ('../ws-admin/seguridad.php');
include('../config/global.php');
include_once ('../ws-admin/funciones.php'); // Acceso a funciones utiles
include_once('funcions.php');
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
        
        <script src="sweet/dist/sweetalert.min.js"></script>
        <link rel="stylesheet" type="text/css" href="sweet/dist/sweetalert.css">
       
        <!-- Librerias datepicker Boostrap3-->
        <link href="../libs/bootstrap-datepicker-1.6.4/css/bootstrap-datepicker3.css" rel="stylesheet">
        <script src="../libs/bootstrap-datepicker-1.6.4/js/bootstrap-datepicker.js"></script>
        <script src="../libs/bootstrap-datepicker-1.6.4/locales/bootstrap-datepicker.es.min.js"></script>
        <script type="text/javascript" src="../ws-admin/js/myJS.js"></script>
       
        <title><?php echo APP_NAME. " Administración"?></title>
</head>

<body>
    
        
        <?PHP 
            include '../ws-admin/modules/build_menutop.php';
        ?>
                        
        <?PHP 
            include '../ws-admin/modules/sidebar.php';
        ?>
            
            
        <div id="sidebar-central" class="contenedor-formulario">
                
                <div class="wrap">
                
                    <!-- Inicio panel de navegacion y busqueda -->
                <div class="row center-block">
                    <div class="col-sm-5">
                            <div class="input-group  center-block">
                                <input type="text" id="dateini_modal" name="dateini_modal" class="form-control centertext pickyDate"  placeholder="Fecha Inicial">
                                <input type="text" id="datefin_modal" name="datefin_modal" class="form-control centertext pickyDate" placeholder="Fecha Final">
                            </div>
                    </div>
                    <div class="col-sm-5">
                        <div class="input-group center-block">
                                <select class="form-control centertext" name="seleccion_empresa" id="seleccion_empresa" required>
                                    <option value="">--- SELECCIONE EMPRESA ---</option>
                                    <?php getSelectEmpresasWF(); ?>
                                </select> 
                               
                                
                        </div><!-- /input-group -->
                    </div><!-- /.col-lg-6 -->
                  
                    <div class="col-sm-2">
                       
                        <button type="button" id="btn_busqueda_chlocales" onclick="search()" class="btn btn-primary btn-block rowspace"><span class="glyphicon glyphicon-search"></span> Buscar </button>
                       
                    </div>
                  
                  
                </div><!-- /.row -->
                
                </div><br>
            
                <div class="wrap">
                    <div class="txtseccion">
                        <label class="etique"> RESULTADOS DE BUSQUEDA</label>
                    </div>
                    
                    <div id="responsibetable">
                        <!-- Resultados AJAX-->
                        <div class="result_search">
                            <?php include_once './grid_dinamico.php';?>
                        </div>
                        
                    </div>    
                    <button type="button" class="btn btn-primary btn-sm rowspace" onclick="fn_genreport()" ><span class="glyphicon glyphicon-paste"></span> Exportar a PDF  </button>
                    <button type="button" class="btn btn-success btn-sm rowspace" onclick="fn_genreport_Excel()" ><span class="glyphicon glyphicon-paste"></span> Exportar a Excel (.XLS)  </button>
                
                </div>
                <br>
                
                  
               
                
        </div>
     
    <!-- USO JQUERY, animacion de menu para responsive-->
        <script type="text/javascript" src="functions.js"></script>
        
</body>
</html>