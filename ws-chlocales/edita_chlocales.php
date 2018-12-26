<?php
include('../ws-admin/acceso_multi_db.php');
include('../ws-admin/funciones.php'); // Acceso a funciones utiles
include('funcions.php');

    
    $id_chlocal = $_GET['id_chlocal'];
    $id_database = $_GET['id_db'];
    $db_empresa = getDataBase($id_database); //Obtenemos conexion con base de datos segun codigo de la DB
    
    $sql_vales_perdida = "SELECT A.NOMBRE as nombreBodegaN, C.Nombre as nombreEmpresaN, (D.Nombre+d.Apellido) as supervisorN, B.* FROM dbo.INV_BODEGAS as A INNER JOIN KAO_wssp.dbo.chlist_locales as B ON A.CODIGO COLLATE Modern_Spanish_CI_AS  = B.local COLLATE Modern_Spanish_CI_AS INNER JOIN SBIOKAO.dbo.Empresas_WF as C on B.Empresa = C.Codigo INNER JOIN SBIOKAO.dbo.Empleados as D on B.supervisor = D.Cedula WHERE id=$id_chlocal";
    $consulta_chlocal = odbc_exec($db_empresa, $sql_vales_perdida);

    $id_chklocal_edit =  trim(odbc_result($consulta_chlocal,"id"));
    $cod_chklocal_edit =  trim(odbc_result($consulta_chlocal,"codchequeo"));
    $empresa_chklocal_edit =  trim(odbc_result($consulta_chlocal,"nombreEmpresaN"));
    $superv_chklocal_edit =  trim(odbc_result($consulta_chlocal,"supervisorN"));
    $local_chklocal_edit =  trim(odbc_result($consulta_chlocal,"nombreBodegaN"));
    $fecha_chklocal_edit =  trim(odbc_result($consulta_chlocal,"fecha"));
    $obsSupervchk_check_1_edit =  trim(odbc_result($consulta_chlocal,"obsSupervchk_1"));
     $obsSupervchk_check_2_edit =  trim(odbc_result($consulta_chlocal,"obsSupervchk_2"));
    $obsSupervchk_check_3_edit =  trim(odbc_result($consulta_chlocal,"obsSupervchk_3"));
    $obsSupervchk_check_4_edit =  trim(odbc_result($consulta_chlocal,"obsSupervchk_4"));
    $obsSupervchk_check_5_edit =  trim(odbc_result($consulta_chlocal,"obsSupervchk_5"));
    $obsSupervchk_check_6_edit =  trim(odbc_result($consulta_chlocal,"obsSupervchk_6"));
    $obsSupervchk_check_7_edit =  trim(odbc_result($consulta_chlocal,"obsSupervchk_7"));
    $obsSupervchk_check_8_edit =  trim(odbc_result($consulta_chlocal,"obsSupervchk_8"));
    $obsSupervchk_check_9_edit =  trim(odbc_result($consulta_chlocal,"obsSupervchk_9"));
    $obsSupervchk_check_10_edit =  trim(odbc_result($consulta_chlocal,"obsSupervchk_10"));
    $obsSupervchk_check_11_edit =  trim(odbc_result($consulta_chlocal,"obsSupervchk_11"));
    $obsSupervchk_check_12_edit =  trim(odbc_result($consulta_chlocal,"obsSupervchk_12"));
    $obsSupervchk_check_13_edit =  trim(odbc_result($consulta_chlocal,"obsSupervchk_13"));
    $obsSupervchk_check_14_edit =  trim(odbc_result($consulta_chlocal,"obsSupervchk_14"));
    $obsSupervchk_check_15_edit =  trim(odbc_result($consulta_chlocal,"obsSupervchk_15"));
    $obsSupervchk_check_16_edit =  trim(odbc_result($consulta_chlocal,"obsSupervchk_16"));
    $obsSupervchk_check_17_edit =  trim(odbc_result($consulta_chlocal,"obsSupervchk_17"));
    $obsSupervchk_check_18_edit =  trim(odbc_result($consulta_chlocal,"obsSupervchk_18"));
    $obsSupervchk_check_19_edit =  trim(odbc_result($consulta_chlocal,"obsSupervchk_19"));
    $obsgeneral_edit =  trim(odbc_result($consulta_chlocal,"observacion"));
?>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <link rel="stylesheet" href="../ws-admin/css/estilos_solicitud.css">
        <!--Import Google Icon Font-->
        <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <!--Import materialize.css-->
        <link type="text/css" rel="stylesheet" href="../ws-admin/css/materialize.css"  media="screen,projection"/>
        <link rel="stylesheet" href="../ws-admin/css/bootstrap.css">
	<link rel="shortcut icon" href="../ws-admin/img/favicon.ico">
        <link href='../ws-admin/css/roboto.css' rel='stylesheet' type='text/css'>
        <script src="sweet/dist/sweetalert.min.js"></script>
        <link rel="stylesheet" type="text/css" href="sweet/dist/sweetalert.css">
        <script src="../ws-admin/js/jquery-latest.js"></script>
        
        <!-- Librerias datepicker Boostrap3-->
        <link href="../libs/bootstrap-datepicker-1.6.4/css/bootstrap-datepicker3.css" rel="stylesheet">
        <script src="../libs/bootstrap-datepicker-1.6.4/js/bootstrap-datepicker.js"></script>
        <script src="../libs/bootstrap-datepicker-1.6.4/locales/bootstrap-datepicker.es.min.js"></script>
        <script type="text/javascript" src="../ws-admin/js/myJS.js"></script>  <!-- JS datepicker Boostrap3-->
        
       
        
	<title>Edición - CheckList Diario - Locales</title>
	
</head>
<body oncontextmenu="return true">
	<div class="contenedor-formulario">
		<div class="wrap">
                            <div class="txtcentro">
                                    <h5>EDICIÓN - CHECKLIST DE ACTIVIDADES DIARIAS EN LOCALES</h5>
                                    <h6>COD. <?php echo $cod_chklocal_edit ."-". $id_chklocal_edit ?></h6>
                            </div>
                    
                    <form action="updateregistro.php" class="formulario" name="formulario_registro" method="POST">
                         <input type="hidden" name="id_chklist" value="<?php echo $id_chklocal_edit ?>">
                        
               			<div class="centrado">
	           		   	<img class="logo" src="../ws-admin/img/logo.png" alt="Logo">
                    		</div>
                    
                                
            <!--SECCION INFO PERSONAL-->                
                                <div class="txtseccion">
                                    <label class="etique"> INFORMACIÓN DEL SUPERVISOR</label>
                                </div>
                                
                                <div class="input-group anchototal">
                                    <label class="label">Empresa: <em class="em">*</em></label>
                                    <input type="text" class="centrado" name="select_empresaa" id="select_empresaa" value="<?php echo $empresa_chklocal_edit ?>" readonly required>
                                </div> 
            
                                <div  id="bloque">  
                                    <label class="label">Supervisor: <em class="em">*</em></label>
                                    <div class="input-group anchototal">
                                        <input type="text" class="centrado" name="seleccion_supervisor" value="<?php echo $superv_chklocal_edit ?>" readonly required>
                                    </div>
                                </div>
            
                                <div  id="bloque">  
                                <div class="input-group bloquede2-1">
                                    <label class="label">Empresa/Bodega:<em class="em">*</em></label>
                                     <input type="text" class="centrado" id="cod_txt_empresa" name="cod_txt_empresa" value="<?php echo $local_chklocal_edit ?>" readonly required>
                                </div>  
                                <div class="input-group bloquede2-2">
                                    <label class="label">Fecha:</label>
                                    <input type="text" name="date_chk" id="date_chk" class="centertext"  placeholder="Fecha de revision" value="<?php echo $fecha_chklocal_edit?>" required readonly>
                                </div>      
                                    
                                    
                                </div>    
            
            <!--SECCION DETALLE-->                     
                                <div class="txtseccion">
                                    <label class="etique"> ITEMS</label>
                                </div>
            
                                <div id="bloque">
                                <div class="container-fluid">
                                <div class="row ">
                                <div class="col-lg-12">
                                    <label class="h6">1.- FALTAS Y ATRAZOS DEL PERSONAL.</label> 
                                        <div class="bs-callout bs-callout-primary">
                                                <?php getDetallesWithData('chk1_1',trim(odbc_result($consulta_chlocal,"chk_1_1")))?>
                                                <?php getDetallesWithData('chk1_2',trim(odbc_result($consulta_chlocal,"chk_1_2")))?>
                                                <?php getDetallesWithData('chk1_3',trim(odbc_result($consulta_chlocal,"chk_1_3")))?>
                                        </div>
                                        <div class="bs-callout bs-callout-warning">
                                                <?php getSupervisorChk('grupo_1', trim(odbc_result($consulta_chlocal,"chkSup_1")),trim(odbc_result($consulta_chlocal,"obsSupervchk_1")))?>
                                        </div>
                                </div>
                                </div>
                                
                                
                               
                                <div class="row ">
                                <div class="col-lg-12">
                                    <label class="h6">2.- LIMPIEZA GENERAL DEL LOCAL.</label> 
                                        <div class="bs-callout bs-callout-primary">
                                                <?php getDetallesWithData('chk2_1',trim(odbc_result($consulta_chlocal,"chk_2_1")))?>
                                        </div>
                                        <div class="bs-callout bs-callout-warning">
                                                <?php getSupervisorChk('grupo_2',trim(odbc_result($consulta_chlocal,"chkSup_2")),trim(odbc_result($consulta_chlocal,"obsSupervchk_2")))?>
                                        </div>
                                </div>
                                </div>
                                  
                                
                               
                                <div class="row ">
                                <div class="col-lg-12">
                                    <label class="h6">3.- REGISTRO DE DATOS DE VENTAS EN FORMATO DE ANALISIS DIARIO</label> 
                                        <div class="bs-callout bs-callout-primary">
                                                <?php getDetallesWithData('chk3_1',trim(odbc_result($consulta_chlocal,"chk_3_1")))?>
                                                <?php getDetallesWithData('chk3_2',trim(odbc_result($consulta_chlocal,"chk_3_2")))?>
                                        </div>
                                        <div class="bs-callout bs-callout-warning">
                                               <?php getSupervisorChk('grupo_3',trim(odbc_result($consulta_chlocal,"chkSup_3")),trim(odbc_result($consulta_chlocal,"obsSupervchk_3")))?>
                                        </div>
                                </div>        
                                </div>
                                
                                    
                               
                                <div class="row ">
                                <div class="col-lg-12">
                                    <label class="h6">4.- CONTROL DE MATERIAL POP HE INFORMATIVOS</label> 
                                        <div class="bs-callout bs-callout-primary">
                                                <?php getDetallesWithData('chk4_1',trim(odbc_result($consulta_chlocal,"chk_4_1")))?>
                                                <?php getDetallesWithData('chk4_2',trim(odbc_result($consulta_chlocal,"chk_4_2")))?>
                                        </div>
                                        <div class="bs-callout bs-callout-warning">
                                               <?php getSupervisorChk('grupo_4',trim(odbc_result($consulta_chlocal,"chkSup_4")),trim(odbc_result($consulta_chlocal,"obsSupervchk_4")))?>
                                        </div>
                                </div>
                                </div>
                                
            
            
                               
                                <div class="row ">
                                <div class="col-lg-12">
                                    <label class="h6">5.- CONTROL DE ASIGNACION Y DISTRIBUCION DE PERCHAS.</label> 
                                        <div class="bs-callout bs-callout-primary">
                                                <?php getDetallesWithData('chk5_1',trim(odbc_result($consulta_chlocal,"chk_5_1")))?>
                                                <?php getDetallesWithData('chk5_2',trim(odbc_result($consulta_chlocal,"chk_5_2")))?>
                                                <?php getDetallesWithData('chk5_3',trim(odbc_result($consulta_chlocal,"chk_5_3")))?>
                                                <?php getDetallesWithData('chk5_4',trim(odbc_result($consulta_chlocal,"chk_5_4")))?>
                                        </div>
                                        <div class="bs-callout bs-callout-warning">
                                               <?php getSupervisorChk('grupo_5',trim(odbc_result($consulta_chlocal,"chkSup_5")),trim(odbc_result($consulta_chlocal,"obsSupervchk_5")))?>
                                        </div>
                                </div>
                                </div>
                                
                                <div class="row ">
                                <div class="col-lg-12">
                                    <label class="h6">6.- LIMPIEZA DE PERCHA DE LINEA DE CALZADO.</label> 
                                        <div class="bs-callout bs-callout-primary">
                                                <?php getDetallesWithData('chk6_1',trim(odbc_result($consulta_chlocal,"chk_6_1")))?>
                                                <?php getDetallesWithData('chk6_2',trim(odbc_result($consulta_chlocal,"chk_6_2")))?>
                                                <?php getDetallesWithData('chk6_3',trim(odbc_result($consulta_chlocal,"chk_6_3")))?>
                                        </div>
                                        <div class="bs-callout bs-callout-warning">
                                               <?php getSupervisorChk('grupo_6',trim(odbc_result($consulta_chlocal,"chkSup_6")),trim(odbc_result($consulta_chlocal,"obsSupervchk_6")))?>
                                        </div>
                                </div>
                                </div>
                                
                                <div class="row ">
                                <div class="col-lg-12">
                                    <label class="h6">7.-  EXHIBICION DE ZAPATOS</label> 
                                        <div class="bs-callout bs-callout-primary">
                                                <?php getDetallesWithData('chk7_1',trim(odbc_result($consulta_chlocal,"chk_7_1")))?>
                                                <?php getDetallesWithData('chk7_2',trim(odbc_result($consulta_chlocal,"chk_7_2")))?>
                                                <?php getDetallesWithData('chk7_3',trim(odbc_result($consulta_chlocal,"chk_7_3")))?>
                                                <?php getDetallesWithData('chk7_4',trim(odbc_result($consulta_chlocal,"chk_7_4")))?>
                                                <?php getDetallesWithData('chk7_5',trim(odbc_result($consulta_chlocal,"chk_7_5")))?>
                                                <?php getDetallesWithData('chk7_6',trim(odbc_result($consulta_chlocal,"chk_7_6")))?>
                                                <?php getDetallesWithData('chk7_7',trim(odbc_result($consulta_chlocal,"chk_7_7")))?>
                                                <?php getDetallesWithData('chk7_8',trim(odbc_result($consulta_chlocal,"chk_7_8")))?>
                                        </div>
                                        <div class="bs-callout bs-callout-warning">
                                               <?php getSupervisorChk('grupo_7',trim(odbc_result($consulta_chlocal,"chkSup_7")),trim(odbc_result($consulta_chlocal,"obsSupervchk_7")))?>
                                        </div>
                                </div>
                                </div>
                                    
                                <div class="row ">
                                <div class="col-lg-12">
                                    <label class="h6">8.- LIMPIEZA DE PERCHAS DE MERCADERÍA EN GENERAL.</label> 
                                        <div class="bs-callout bs-callout-primary">
                                                <?php getDetallesWithData('chk8_1',trim(odbc_result($consulta_chlocal,"chk_8_1")))?>
                                                <?php getDetallesWithData('chk8_2',trim(odbc_result($consulta_chlocal,"chk_8_2")))?>
                                                <?php getDetallesWithData('chk8_3',trim(odbc_result($consulta_chlocal,"chk_8_3")))?>
                                                <?php getDetallesWithData('chk8_4',trim(odbc_result($consulta_chlocal,"chk_8_4")))?>
                                        </div>
                                        <div class="bs-callout bs-callout-warning">
                                               <?php getSupervisorChk('grupo_8',trim(odbc_result($consulta_chlocal,"chkSup_8")),trim(odbc_result($consulta_chlocal,"obsSupervchk_8")))?>
                                        </div>
                                </div>
                                </div>    
                                    
                                <div class="row ">
                                <div class="col-lg-12">
                                    <label class="h6">9.-  EXHIBICION DE MERCADERIA EN GENERAL</label> 
                                        <div class="bs-callout bs-callout-primary">
                                                <?php getDetallesWithData('chk9_1',trim(odbc_result($consulta_chlocal,"chk_9_1")))?>
                                                <?php getDetallesWithData('chk9_2',trim(odbc_result($consulta_chlocal,"chk_9_2")))?>
                                                <?php getDetallesWithData('chk9_3',trim(odbc_result($consulta_chlocal,"chk_9_3")))?>
                                                <?php getDetallesWithData('chk9_4',trim(odbc_result($consulta_chlocal,"chk_9_4")))?>
                                                <?php getDetallesWithData('chk9_5',trim(odbc_result($consulta_chlocal,"chk_9_5")))?>
                                                <?php getDetallesWithData('chk9_6',trim(odbc_result($consulta_chlocal,"chk_9_6")))?>
                                                <?php getDetallesWithData('chk9_7',trim(odbc_result($consulta_chlocal,"chk_9_7")))?>
                                                <?php getDetallesWithData('chk9_8',trim(odbc_result($consulta_chlocal,"chk_9_8")))?>
                                                <?php getDetallesWithData('chk9_9',trim(odbc_result($consulta_chlocal,"chk_9_9")))?>
                                                
                                        </div>
                                        <div class="bs-callout bs-callout-warning">
                                               <?php getSupervisorChk('grupo_9',trim(odbc_result($consulta_chlocal,"chkSup_9")),trim(odbc_result($consulta_chlocal,"obsSupervchk_9")))?>
                                        </div>
                                </div>
                                </div>   
                                    
                                <div class="row ">
                                <div class="col-lg-12">
                                    <label class="h6">10.- LIMPIEZA DE PERCHAS DE ROPA</label> 
                                        <div class="bs-callout bs-callout-primary">
                                                <?php getDetallesWithData('chk10_1',trim(odbc_result($consulta_chlocal,"chk_10_1")))?>
                                                <?php getDetallesWithData('chk10_2',trim(odbc_result($consulta_chlocal,"chk_10_2")))?>
                                                <?php getDetallesWithData('chk10_3',trim(odbc_result($consulta_chlocal,"chk_10_3")))?>
                                              
                                        </div>
                                        <div class="bs-callout bs-callout-warning">
                                               <?php getSupervisorChk('grupo_10',trim(odbc_result($consulta_chlocal,"chkSup_10")),trim(odbc_result($consulta_chlocal,"obsSupervchk_10")))?>
                                        </div>
                                </div>
                                </div>       
                                    
                                <div class="row ">
                                <div class="col-lg-12">
                                    <label class="h6">11.-  EXHIBICION DE ROPA</label> 
                                        <div class="bs-callout bs-callout-primary">
                                                <?php getDetallesWithData('chk11_1',trim(odbc_result($consulta_chlocal,"chk_11_1")))?>
                                                <?php getDetallesWithData('chk11_2',trim(odbc_result($consulta_chlocal,"chk_11_2")))?>
                                                <?php getDetallesWithData('chk11_3',trim(odbc_result($consulta_chlocal,"chk_11_3")))?>
                                                <?php getDetallesWithData('chk11_4',trim(odbc_result($consulta_chlocal,"chk_11_4")))?>
                                                <?php getDetallesWithData('chk11_5',trim(odbc_result($consulta_chlocal,"chk_11_5")))?>
                                                <?php getDetallesWithData('chk11_6',trim(odbc_result($consulta_chlocal,"chk_11_6")))?>
                                                <?php getDetallesWithData('chk11_7',trim(odbc_result($consulta_chlocal,"chk_11_7")))?>
                                               
                                        </div>
                                        <div class="bs-callout bs-callout-warning">
                                               <?php getSupervisorChk('grupo_11',trim(odbc_result($consulta_chlocal,"chkSup_11")),trim(odbc_result($consulta_chlocal,"obsSupervchk_11")))?>
                                        </div>
                                </div>
                                </div>   
                                    
                                <div class="row ">
                                <div class="col-lg-12">
                                    <label class="h6">12.- CONTEO DIARIO DE ROPA</label> 
                                        <div class="bs-callout bs-callout-primary">
                                                <?php getDetallesWithData('chk12_1',trim(odbc_result($consulta_chlocal,"chk_12_1")))?>
                                               
                                        </div>
                                        <div class="bs-callout bs-callout-warning">
                                               <?php getSupervisorChk('grupo_12',trim(odbc_result($consulta_chlocal,"chkSup_12")),trim(odbc_result($consulta_chlocal,"obsSupervchk_12")))?>
                                        </div>
                                </div>
                                </div>   
                                    
                                <div class="row ">
                                <div class="col-lg-12">
                                    <label class="h6">13.- EXHIBICIÓN EN VITRINA (LAS TRES LINEAS)</label> 
                                        <div class="bs-callout bs-callout-primary">
                                                <?php getDetallesWithData('chk13_1',trim(odbc_result($consulta_chlocal,"chk_13_1")))?>
                                                <?php getDetallesWithData('chk13_2',trim(odbc_result($consulta_chlocal,"chk_13_2")))?>
                                                <?php getDetallesWithData('chk13_3',trim(odbc_result($consulta_chlocal,"chk_13_3")))?>
                                                <?php getDetallesWithData('chk13_4',trim(odbc_result($consulta_chlocal,"chk_13_4")))?>
                                                <?php getDetallesWithData('chk13_5',trim(odbc_result($consulta_chlocal,"chk_13_5")))?>
                                               
                                        </div>
                                        <div class="bs-callout bs-callout-warning">
                                               <?php getSupervisorChk('grupo_13',trim(odbc_result($consulta_chlocal,"chkSup_13")),trim(odbc_result($consulta_chlocal,"obsSupervchk_13")))?>
                                        </div>
                                </div>
                                </div>  
                                
                                <div class="row ">
                                <div class="col-lg-12">
                                    <label class="h6">14.- BODEGA</label> 
                                        <div class="bs-callout bs-callout-primary">
                                                <?php getDetallesWithData('chk14_1',trim(odbc_result($consulta_chlocal,"chk_14_1")))?>
                                                <?php getDetallesWithData('chk14_2',trim(odbc_result($consulta_chlocal,"chk_14_2")))?>
                                                <?php getDetallesWithData('chk14_3',trim(odbc_result($consulta_chlocal,"chk_14_3")))?>
                                                <?php getDetallesWithData('chk14_4',trim(odbc_result($consulta_chlocal,"chk_14_4")))?>
                                                <?php getDetallesWithData('chk14_5',trim(odbc_result($consulta_chlocal,"chk_14_5")))?>
                                               
                                        </div>
                                        <div class="bs-callout bs-callout-warning">
                                               <?php getSupervisorChk('grupo_14',trim(odbc_result($consulta_chlocal,"chkSup_14")),trim(odbc_result($consulta_chlocal,"obsSupervchk_14")))?>
                                        </div>
                                </div>
                                </div>    
                                    
                                <div class="row ">
                                <div class="col-lg-12">
                                    <label class="h6">15.- RECOMENDACIÓN DEL PRODUCTO</label> 
                                        <div class="bs-callout bs-callout-primary">
                                                <?php getDetallesWithData('chk15_1',trim(odbc_result($consulta_chlocal,"chk_15_1")))?>
                                              
                                        </div>
                                        <div class="bs-callout bs-callout-warning">
                                               <?php getSupervisorChk('grupo_15',trim(odbc_result($consulta_chlocal,"chkSup_15")),trim(odbc_result($consulta_chlocal,"obsSupervchk_15")))?>
                                        </div>
                                </div>
                                </div>      
                                   
                                <div class="row ">
                                <div class="col-lg-12">
                                    <label class="h6">16.- MANTENIMIENTO DEL LOCAL</label> 
                                        <div class="bs-callout bs-callout-primary">
                                                <?php getDetallesWithData('chk16_1',trim(odbc_result($consulta_chlocal,"chk_16_1")))?>
                                                <?php getDetallesWithData('chk16_2',trim(odbc_result($consulta_chlocal,"chk_16_2")))?>
                                                <?php getDetallesWithData('chk16_3',trim(odbc_result($consulta_chlocal,"chk_16_3")))?>
                                                
                                        </div>
                                        <div class="bs-callout bs-callout-warning">
                                               <?php getSupervisorChk('grupo_16',trim(odbc_result($consulta_chlocal,"chkSup_16")),trim(odbc_result($consulta_chlocal,"obsSupervchk_16")))?>
                                        </div>
                                </div>
                                </div>      
                                    
                                <div class="row ">
                                <div class="col-lg-12">
                                    <label class="h6">17.- APAGADO DE LUCES Y EQUIPOS</label> 
                                        <div class="bs-callout bs-callout-primary">
                                                <?php getDetallesWithData('chk17_1',trim(odbc_result($consulta_chlocal,"chk_17_1")))?>
                                                <?php getDetallesWithData('chk17_2',trim(odbc_result($consulta_chlocal,"chk_17_2")))?>
                                                <?php getDetallesWithData('chk17_3',trim(odbc_result($consulta_chlocal,"chk_17_3")))?>
                                                <?php getDetallesWithData('chk17_4',trim(odbc_result($consulta_chlocal,"chk_17_4")))?>
                                                <?php getDetallesWithData('chk17_5',trim(odbc_result($consulta_chlocal,"chk_17_5")))?>
                                                <?php getDetallesWithData('chk17_6',trim(odbc_result($consulta_chlocal,"chk_17_6")))?>
                                               
                                        </div>
                                        <div class="bs-callout bs-callout-warning">
                                               <?php getSupervisorChk('grupo_17',trim(odbc_result($consulta_chlocal,"chkSup_17")),trim(odbc_result($consulta_chlocal,"obsSupervchk_17")))?>
                                        </div>
                                </div>
                                </div>  

                                <div class="row ">
                                <div class="col-lg-12">
                                    <label class="h6">18.- BODEGA SALIDA</label> 
                                        <div class="bs-callout bs-callout-primary">
                                                <?php getDetallesWithData('chk18_1',trim(odbc_result($consulta_chlocal,"chk_18_1")))?>
                                                <?php getDetallesWithData('chk18_2',trim(odbc_result($consulta_chlocal,"chk_18_2")))?>
                                                <?php getDetallesWithData('chk18_3',trim(odbc_result($consulta_chlocal,"chk_18_3")))?>
                                                <?php getDetallesWithData('chk18_4',trim(odbc_result($consulta_chlocal,"chk_18_4")))?>
                                                <?php getDetallesWithData('chk18_5',trim(odbc_result($consulta_chlocal,"chk_18_5")))?>
                                                <?php getDetallesWithData('chk18_6',trim(odbc_result($consulta_chlocal,"chk_18_6")))?>
                                                <?php getDetallesWithData('chk18_7',trim(odbc_result($consulta_chlocal,"chk_18_7")))?>
                                               
                                        </div>
                                        <div class="bs-callout bs-callout-warning">
                                               <?php getSupervisorChk('grupo_18',trim(odbc_result($consulta_chlocal,"chkSup_18")),trim(odbc_result($consulta_chlocal,"obsSupervchk_18")))?>
                                        </div>
                                </div>
                                </div>  
                                    
                                    
                                <div class="row ">
                                <div class="col-lg-12">
                                    <label class="h6">19.- CAJA</label> 
                                        <div class="bs-callout bs-callout-primary">
                                                <?php getDetallesWithData('chk19_1',trim(odbc_result($consulta_chlocal,"chk_19_1")))?>
                                                <?php getDetallesWithData('chk19_2',trim(odbc_result($consulta_chlocal,"chk_19_2")))?>
                                                <?php getDetallesWithData('chk19_3',trim(odbc_result($consulta_chlocal,"chk_19_3")))?>
                                                <?php getDetallesWithData('chk19_4',trim(odbc_result($consulta_chlocal,"chk_19_4")))?>
                                                <?php getDetallesWithData('chk19_5',trim(odbc_result($consulta_chlocal,"chk_19_5")))?>
                                                <?php getDetallesWithData('chk19_6',trim(odbc_result($consulta_chlocal,"chk_19_6")))?>
                                                <?php getDetallesWithData('chk19_7',trim(odbc_result($consulta_chlocal,"chk_19_7")))?>
                                               
                                        </div>
                                        <div class="bs-callout bs-callout-warning">
                                               <?php getSupervisorChk('grupo_19',trim(odbc_result($consulta_chlocal,"chkSup_19")),trim(odbc_result($consulta_chlocal,"obsSupervchk_19")))?>
                                        </div>
                                </div>
                                </div>      
                                
                            
                                <div class="txtseccion">
                                    <label class="etique"> OBSERVACIÓNES </label>
                                </div>
                                <div  id="bloque">
                                    <textarea class="cajaarea" name="txt_observacion" rows="3" cols="100%" maxlength="200"><?php echo $obsgeneral_edit;?></textarea>
                                </div>    
                                
		                <div>
                                    <input name="guardar" type="submit" id="btn-submit" value="Actualizar y aprobar">
				</div>
				</div>  
                            </div>
			<div class="footer">Todos los derechos reservados © 2017, Ver 2.0.0</div>
                    </form>
                </div>
            
            
	</div>
    
    
          
	<!-- USO JQUERY, animacion de menu para responsive-->
        
        <script type="text/javascript" src="../ws-admin/js/materialize.js"></script>
        <script src="../ws-admin/js/bootstrap.js"></script>
        <script type="text/javascript" src="functions.js"></script>
        
</body>
</html>