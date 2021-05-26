<?php

include('../ws-admin/acceso_db.php');
include('../ws-admin/acceso_db_sbio.php');
include('../ws-admin/acceso_multi_db.php');
include('../ws-admin/funciones.php');


if(file_exists('../ws-admin/configuraciones.xml') && $configXML = simplexml_load_file('../ws-admin/configuraciones.xml')){
    $ultimoDiaValep = (string) $configXML->ultimoDiaActivoVales;

}else{
    die ('Error no se pudo cargar el archivo de configuraciones XML, informe a sistemas.');
} 

$fechaActual = getDateNow();
$fechainicio = first_month_day();
$fechafinal = ultimo_dia_vales($ultimoDiaValep);
    
    $nombreDia = getDiaText($fechaActual);
    $diasHabiles = array('Lunes','Martes','Miercoles','Jueves','Viernes','Sabado','Domingo');
    
?>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <link rel="stylesheet" href="../ws-admin/css/estilos_solicitud.css">
    <link href="../ws-admin/icons/iconfont/material-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="../ws-admin/css/bootstrap.min.css">
    <link rel="stylesheet" href="../ws-admin/css/font-awesome.min.css">
    <link rel="shortcut icon" href="../ws-admin/img/favicon.ico">
    <link href='../ws-admin/css/roboto.css' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" type="text/css" href="sweetalert-master/dist/sweetalert.css">
    <link href="../libs/bootstrap-datepicker-1.6.4/css/bootstrap-datepicker3.css" rel="stylesheet">
       
    
	<title>Solicitud de vales por perdida</title>
	
</head>
<body oncontextmenu="return true">
	<?php 
        if( check_in_range($fechainicio, $fechafinal, $fechaActual) && in_array($nombreDia, $diasHabiles)){
        
            include_once './contentvale.php';
        }else{
            include_once './contentValeError.php';
        }

    ?>
    
</body>
</html>