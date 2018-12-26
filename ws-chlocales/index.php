<?php


include('../config/global.php');
include('../ws-admin/acceso_multi_db.php');
include('../ws-admin/funciones.php'); // Acceso a funciones utiles
include('funcions.php');
$conexionEmpresa = getDataBase(008); // Empresa modelo es 008
?>
<html lang="es">
    <!--La alteración total o parcial de los datos provistos en el sistema son considerados como
    delitos contra la seguridad de los activos de los sistemas de información y comunicación, según lo estipulado en el artículo 232 del Código Orgánico Integral Penal, cuya sanción es la pena
    privativa de libertad de tres a cinco años. -->
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
        
       
        
	<title><?php echo APP_NAME?></title>
	
</head>
<body oncontextmenu="return true">

    <?php include '../ws-admin/topnavBar.php'?>

	<div class="contenedor-formulario">
            
                <div class="wrap">
                    <form action="addregistro.php" class="formulario" name="formulario_registro" method="POST">
                     
                            <div class="txtcentro">
                                    <h5>CHECKLIST DE ACTIVIDADES DIARIAS EN LOCALES</h5>
                                    <h6>rev05.06.17</h6>
                            </div>
                    
                            <div class="centrado">
	           		   	<img class="logo" src="../ws-admin/img/logo.png" alt="Logo">
                            </div>
                    
                            <div class="txtcentro">
                                    <label> Los campos con (*) son obligatorios.</label>
                            </div>
                            
                                
            <!--SECCION INFO PERSONAL-->                
                            <div class="txtseccion">
                                <label class="etique"> INFORMACIÓN DEL SUPERVISOR</label>
                            </div>
            
                                
                            <div id="bloque">
                                <div class="anchototal">
                                    <label class="label" for="nombre">Indique empresa: <em class="em">*</em></label>
                                    <select name="select_empresaa" id="select_empresaa" onchange="showselectBodegas(this.value)" required>
                                        <option value=''>---Seleccione Empresa---</option>
                                            <?PHP 
                                                getEmpresasWF();
                                            ?>
                                           <option value='008'> EMPRESA MODELO </option>
                                     </select>
                                </div>
                                    
                                <div class="input-group anchototal">
                                    <label class="label">Empresa/Bodega:<em class="em">*</em></label>
                                    <select type="text" id="cod_txt_empresa" name="cod_txt_empresa" required>
                                         <option value=''>---Seleccione Bodega---</option>
                                    </select>   
                                </div>
                                    
                            </div>        
                                 
                            <div id="bloque">  
                                <div class="input-group bloquede3-1">
                                    <label class="label">Cédula: <em class="em">*</em></label>
                                    <input type="text" id="txt_cisolicitante" name="txt_cisolicitante" onkeyup="ajaxvalidacod_json()" onchange="loadmodal()" maxlength="10" placeholder="Número de Cedula" required>
                                </div>
                                
                                <div class="input-group bloquede3-2">
                                    <label class="label">Supervisor:</label>
                                    <input type="text" name="seleccion_supervisor_txtchk" id="seleccion_supervisor_txtchk">
                                    <input type="hidden" name="seleccion_supervisor_chk" id="seleccion_supervisor_chk">
                                </div>
                                       
                                <div class="input-group bloquede3-3">
                                    <label class="label">Fecha:</label>
                                    <input type="text" name="date_chk" id="date_chk" class="centertext"  placeholder="Fecha de revision" value="<?php echo getDateNow()?>" required readonly>
                                </div> 
                            </div>    
            
            <!--SECCION DETALLE-->                     
                            <div class="txtseccion">
                                <label class="etique"> ITEMS</label>
                            </div>
            
                            <div class="tabbable"> <!-- Only required for left/right tabs -->
                                <ul class="nav nav-tabs">
                                    <li class="active"><a href="#tab1" data-toggle="tab"><h6>CheckList de Entrada</h6></a></li>
                                    <li><a href="#tab2" data-toggle="tab"><h6>CheckList de Salida</h6></a></li>
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane active" id="tab1">
                                        <br>    
                                        <div id="bloque">
                                            <div class="container-fluid">
                                                <div class="row">

                                                    <div class="col-lg-12">
                                                        <label class="h6">1.- FALTAS Y ATRAZOS DEL PERSONAL.</label> 
                                                            <div class="bs-callout bs-callout-primary">
                                                                    <?php getDetallesChk('chk1_1')?>
                                                                    <?php getDetallesChk('chk1_2')?>
                                                                    <?php getDetallesChk('chk1_3')?>
                                                            </div>
                                                    </div>

                                                    <div class="col-lg-12">
                                                        <label class="h6">2.- LIMPIEZA GENERAL DEL LOCAL.</label> 
                                                            <div class="bs-callout bs-callout-primary">
                                                                    <?php getDetallesChk('chk2_1')?>
                                                                    <?php getDetallesChk('chk2_2')?>
                                                            </div>
                                                    </div>    

                                                    <div class="col-lg-12">
                                                        <label class="h6" for="chk3">3.- REGISTRO DE DATOS DE VENTAS EN FORMATO DE ANALISIS DIARIO</label>
                                                            <div class="bs-callout bs-callout-primary">
                                                                <?php getDetallesChk('chk3_1')?>
                                                                <?php getDetallesChk('chk3_2')?>
                                                            </div>
                                                    </div>

                                                    <div class="col-lg-12">
                                                        <label class="h6" for="chk4">4.- CONTROL DE MATERIAL POP E INFORMATIVOS</label>
                                                            <div class="bs-callout bs-callout-primary">
                                                                <?php getDetallesChk('chk4_1')?>
                                                                <?php getDetallesChk('chk4_2')?>
                                                            </div>
                                                    </div>

                                                    <div class="col-lg-12">
                                                        <label class="h6" for="chk5">5.- CONTROL DE ASIGNACION Y DISTRIBUCION DE PERCHAS.</label>
                                                            <div class="bs-callout bs-callout-primary">
                                                                <?php getDetallesChk('chk5_1')?>
                                                                <?php getDetallesChk('chk5_2')?>
                                                                <?php getDetallesChk('chk5_3')?>
                                                                <?php getDetallesChk('chk5_4')?>

                                                            </div>
                                                    </div>

                                                    <div class="col-lg-12">
                                                        <label class="h6" for="chk6">6.- LIMPIEZA DE PERCHA DE LINEA DE CALZADO</label>
                                                            <div class="bs-callout bs-callout-primary">
                                                                <?php getDetallesChk('chk6_1')?>
                                                                <?php getDetallesChk('chk6_2')?>
                                                                <?php getDetallesChk('chk6_3')?>
                                                            </div>
                                                    </div>

                                                    <div class="col-lg-12">
                                                        <label class="h6" for="chk7">7.-  EXHIBICION DE ZAPATOS</label>
                                                            <div class="bs-callout bs-callout-primary">
                                                                <?php getDetallesChk('chk7_1')?>
                                                                <?php getDetallesChk('chk7_2')?>
                                                                <?php getDetallesChk('chk7_3')?>
                                                                <?php getDetallesChk('chk7_4')?>
                                                                <?php getDetallesChk('chk7_5')?>
                                                                <?php getDetallesChk('chk7_6')?>
                                                                <?php getDetallesChk('chk7_7')?>
                                                                <?php getDetallesChk('chk7_8')?>
                                                            </div>
                                                    </div>

                                                    <div class="col-lg-12">
                                                        <label class="h6" for="chk8">8.- LIMPIEZA DE PERCHAS DE MERCADERÍA EN GENERAL.</label>
                                                            <div class="bs-callout bs-callout-primary">
                                                                <?php getDetallesChk('chk8_1')?>
                                                                <?php getDetallesChk('chk8_2')?>
                                                                <?php getDetallesChk('chk8_3')?>
                                                                <?php getDetallesChk('chk8_4')?>
                                                            </div>
                                                    </div>

                                                    <div class="col-lg-12">
                                                        <label class="h6" for="chk9">9.-  EXHIBICION DE MERCADERIA EN GENERAL</label>
                                                            <div class="bs-callout bs-callout-primary">
                                                                <?php getDetallesChk('chk9_1')?>
                                                                <?php getDetallesChk('chk9_2')?>
                                                                <?php getDetallesChk('chk9_3')?>
                                                                <?php getDetallesChk('chk9_4')?>
                                                                <?php getDetallesChk('chk9_5')?>
                                                                <?php getDetallesChk('chk9_6')?>
                                                                <?php getDetallesChk('chk9_7')?>
                                                                <?php getDetallesChk('chk9_8')?>
                                                                <?php getDetallesChk('chk9_9')?>
                                                            </div>
                                                    </div>

                                                    <div class="col-lg-12">
                                                        <label class="h6" for="chk10">10.- LIMPIEZA DE PERCHAS DE ROPA</label>
                                                            <div class="bs-callout bs-callout-primary">
                                                                <?php getDetallesChk('chk10_1')?>
                                                                <?php getDetallesChk('chk10_2')?>
                                                                <?php getDetallesChk('chk10_3')?>
                                                            </div>
                                                    </div>

                                                    <div class="col-lg-12">
                                                        <label class="h6" for="chk11">11.-  EXHIBICION DE ROPA</label>
                                                            <div class="bs-callout bs-callout-primary">
                                                                <?php getDetallesChk('chk11_1')?>
                                                                <?php getDetallesChk('chk11_2')?>
                                                                <?php getDetallesChk('chk11_3')?>
                                                                <?php getDetallesChk('chk11_4')?>
                                                                <?php getDetallesChk('chk11_5')?>
                                                                <?php getDetallesChk('chk11_6')?>
                                                                <?php getDetallesChk('chk11_7')?>
                                                                <?php getDetallesChk('chk11_8')?>
                                                            </div>
                                                    </div>

                                                    <div class="col-lg-12">
                                                        <label class="h6" for="chk12">12.- CONTEO DIARIO DE ROPA</label>
                                                            <div class="bs-callout bs-callout-primary">
                                                                <?php getDetallesChk('chk12_1')?>
                                                            </div>
                                                    </div>

                                                    <div class="col-lg-12">
                                                        <label class="h6" for="chk13">13.- EXHIBICIÓN EN VITRINA (LAS TRES LINEAS)</label>
                                                            <div class="bs-callout bs-callout-primary">
                                                                <?php getDetallesChk('chk13_1')?>
                                                                <?php getDetallesChk('chk13_2')?>
                                                                <?php getDetallesChk('chk13_3')?>
                                                                <?php getDetallesChk('chk13_4')?>
                                                                <?php getDetallesChk('chk13_5')?>
                                                            </div>
                                                    </div>

                                                    <div class="col-lg-12">
                                                        <label class="h6" for="chk14">14.- BODEGA</label>
                                                            <div class="bs-callout bs-callout-primary">
                                                                <?php getDetallesChk('chk14_1')?>
                                                                <?php getDetallesChk('chk14_2')?>
                                                                <?php getDetallesChk('chk14_3')?>
                                                                <?php getDetallesChk('chk14_4')?>
                                                                <?php getDetallesChk('chk14_5')?>
                                                            </div>
                                                    </div>

                                                    <div class="col-lg-12">
                                                        <label class="h6" for="chk15">15.- RECOMENDACIÓN DEL PRODUCTO</label>
                                                            <div class="bs-callout bs-callout-primary">
                                                                <?php getDetallesChk('chk15_1')?>
                                                            </div>
                                                    </div>

                                                    <div class="col-lg-12">
                                                        <label class="h6">16.- MANTENIMIENTO DEL LOCAL</label>
                                                            <div class="bs-callout bs-callout-primary">
                                                                <?php getDetallesChk('chk16_1')?>
                                                                <?php getDetallesChk('chk16_2')?>
                                                                <?php getDetallesChk('chk16_3')?>
                                                            </div>
                                                    </div>
                                                </div><!-- fin row-->
                                            </div>  <!-- fin container-->

                                            <div class="txtseccion">
                                                <label class="etique"> OBSERVACIÓNES </label>
                                            </div>

                                            <div class="col-lg-12">
                                                <textarea class="cajaarea" name="txt_observacion" rows="3" cols="100%" maxlength="200"></textarea>
                                            </div>

                                        </div>        
                                    </div>
                                   
    
                                    <div class="tab-pane" id="tab2"> <!-- Seccion checlist de salida-->
                                        <br>    
                                            <div id="bloque">
                                                
                                                <div class="container-fluid">
                                                    <div class="row">
                                                        <div class="col-lg-12">
                                                            <label class="h6">17.- APAGADO DE LUCES Y EQUIPOS</label>
                                                                <div class="bs-callout bs-callout-primary">
                                                                    <?php getDetallesChk('chk17_1')?>
                                                                    <?php getDetallesChk('chk17_2')?>
                                                                    <?php getDetallesChk('chk17_3')?>
                                                                    <?php getDetallesChk('chk17_4')?>
                                                                    <?php getDetallesChk('chk17_5')?>
                                                                    <?php getDetallesChk('chk17_6')?>
                                                                </div>
                                                        </div>
                                                        
                                                        <div class="col-lg-12">
                                                            <label class="h6" for="chk18">18.- BODEGA SALIDA</label>
                                                                <div class="bs-callout bs-callout-primary">
                                                                    <?php getDetallesChk('chk18_1')?>
                                                                    <?php getDetallesChk('chk18_2')?>
                                                                    <?php getDetallesChk('chk18_3')?>
                                                                    <?php getDetallesChk('chk18_4')?>
                                                                    <?php getDetallesChk('chk18_5')?>
                                                                    <?php getDetallesChk('chk18_6')?>
                                                                    <?php getDetallesChk('chk18_7')?>
                                                                </div>
                                                        </div>
                                                        
                                                        <div class="col-lg-12">
                                                            <label class="h6" for="chk19">19.- CAJA</label>
                                                                <div class="bs-callout bs-callout-primary">
                                                                    <?php getDetallesChk('chk19_1')?>
                                                                    <?php getDetallesChk('chk19_2')?>
                                                                    <?php getDetallesChk('chk19_3')?>
                                                                    <?php getDetallesChk('chk19_4')?>
                                                                    <?php getDetallesChk('chk19_5')?>
                                                                    <?php getDetallesChk('chk19_6')?>
                                                                    <?php getDetallesChk('chk19_7')?>
                                                                </div>
                                                        </div>
                                                    </div> <!-- fin div row-->       
                                                </div> <!-- Fin container fluid--> 
                                            </div>

                                          
                                       
                                    </div> <!-- Fin de Tab-->
                                </div> <!-- tab-content --> 
                                    
                                <div>
                                    <input name="guardar" type="submit" id="btn-submit" value="Registrar CheckList">
                                </div>
                                <div class="footer">Todos los derechos reservados © 2017, Ver 2.0.0</div>
                            </div> <!-- Fin tabla de tabs-->
                    </form>
                    </div> <!--Fin Wrap Content-->
              
        </div> <!--Fin Contenedor Formulario-->
           
        <!-- Floating Button Google-->
        <div class="fixed-action-btn">
            <a class="btn-floating btn-large red">
              <i class="large material-icons">mode_edit</i>
            </a>
            <ul>
                <li><a class="btn-floating blue" title="Buscar" data-toggle="modal" data-target="#modalBusquedaChlist"><i class="material-icons">search</i></a></li>

                <li><a class="btn-floating grey" onclick="validaObsChecks()" title="Test Function"><i class="material-icons">new_releases</i></a></li>
            </ul>
          </div>
          
        <?php require_once './securityModal.php';?>
        <?php require_once './searchModal.php';?>
        
	<!-- USO JQUERY, animacion de menu para responsive-->
        
        <script type="text/javascript" src="functions.js"></script>
        <script type="text/javascript" src="../ws-admin/js/materialize.js"></script>
        <script src="../ws-admin/js/bootstrap.js"></script>
        
        
</body>
</html>