<?php
session_start();
date_default_timezone_set('America/Bogota');
include('../ws-admin/funciones.php'); // Acceso a funciones utiles
include('../config/global.php');
include('funcions.php');


if(file_exists('../ws-admin/configuraciones.xml') && $configXML = simplexml_load_file('../ws-admin/configuraciones.xml')){
    $ultimoDiaEJI = (string) $configXML->ultimoDiaEvaluaEGG;

}else{
    die ('Error no se pudo cargar el archivo de configuraciones XML, informe a sistemas.');
} 



$fechaActual = getDateNow();
$fechainicio = first_month_day();
$fechafinal = ultimo_dia_EJI($ultimoDiaEJI);


insertRegistro();


?>
<html lang="es">
    <!--La alteración total o parcial de los datos provistos en el sistema son considerados como
    delitos contra la seguridad de los activos de los sistemas de información y comunicación, según lo estipulado en el artículo 232 del Código Orgánico Integral Penal, cuya sanción es la pena
    privativa de libertad de tres a cinco años. -->
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        
        <!--Import Google Icon Font-->
        <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <!--Import materialize.css-->
        
        <link type="text/css" rel="stylesheet" href="../ws-admin/css/materialize.css"  media="screen,projection"/>
        
        <link rel="stylesheet" href="../ws-admin/css/bootstrap.css">
        <link rel="stylesheet" href="mystyles.css">
	<link rel="shortcut icon" href="../ws-admin/img/favicon.ico">
        
       
        <script src="../ws-admin/js/jquery-latest.js"></script>
        
        <!-- Librerias datepicker Boostrap3-->
        <link href="../libs/bootstrap-datepicker-1.6.4/css/bootstrap-datepicker3.css" rel="stylesheet">
        <script src="../libs/bootstrap-datepicker-1.6.4/js/bootstrap-datepicker.js"></script>
        <script src="../libs/bootstrap-datepicker-1.6.4/locales/bootstrap-datepicker.es.min.js"></script>
        <script type="text/javascript" src="../ws-admin/js/myJS.js"></script>  <!-- JS datepicker Boostrap3-->
        
       
        
	<title><?php echo APP_NAME?></title>
	
</head>
<body oncontextmenu="return true">
  
   
    
    <?php 
        if(check_in_range($fechainicio, $fechafinal, $fechaActual) ){
            include_once './contentEJI.php';
        }else{
            include_once './contentEJIError.php';
        }

        ?>


    
        
</body>
</html>