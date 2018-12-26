<?php
include('../ws-admin/funciones.php'); // Acceso a funciones utiles
include('../config/global.php');
include('funcions.php');
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
        <div class="container wrap">
            <div class="row">
                <div class="col-sm-12">
                    <div class="txtcentro">
                            <h5>FORMULARIO DE PERSONAL ANFITRIONES</h5>
                            <h6>rev13.09.17</h6>
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-sm-12 text-center">
                    <img class="logo" src="../ws-admin/img/logo.png" alt="Logo">
                </div>
            </div>
            
            <div class="row">
                
                <div class="txtseccion">
                        <label class="etique"> INFORMACIÓN PRINCIPAL</label>
                </div>
                
                <form action="addregistro.php" method="POST">
                    <div class="row">
                        <div class="form-group col-lg-4">
                        <label for="txt_CIRUC">Cédula/RUC</label>
                        <input type="text" class="form-control" id="txt_CIRUC" name="txt_CIRUC" maxlength="13" placeholder="Ingrese CI o RUC (13 caracteres)" onkeyup="ajaxvalidacod_json()" onchange="loadmodal()" required>
                        <small id="txt_CIRUC" class="form-text text-muted">Ingrese cedula o RUC de cliente, empleado autorizado a realizar el registro.</small>
                        </div> 
                        
                        <div class="form-group col-lg-4">
                          <label for="txt_empleadoIdentificado">Supervisor</label>
                          <input type="text" class="form-control" id="txt_empleadoIdentificado" placeholder="(Empleado)" disabled>
                          <small id="txt_empleadoIdentificado" class="form-text text-muted">Empleado identificado con el CI /RUC Ingresado.</small>
                        </div>
       
                        <div class="form-group col-lg-4">
                          <label for="txt_fechaRegistro">Fecha de Registro</label>
                          <input type="text" id="txt_fechaRegistro" name="txt_fechaRegistro" class="form-control centertext"  placeholder="Fecha de reporte" value="<?php echo date('Y-m-d')?>" readonly required>
                          <small id="txt_fechaRegistro" class="form-text text-muted">Fecha con la que se registrará el actual formulario.</small>
                        </div>
                        
                    </div> <!-- FIN DEL ROW -->
                    
                    <div class="row">
                        <div class="form-group col-lg-3">
                            <label for="select_Empresa">Seleccion de Empresa</label>
                            <select class="form-control" id="select_Empresa" name="select_Empresa" onchange="showselectEmpleados(this.value)" required>
                                <option value="">Seleccione por favor</option>
                                <?php getSelectEmpresasWF();?>
                            </select>
                         </div>
                        
                        <div class="form-group col-lg-4">
                            <label for="select_Empleado">Seleccion de Empleado</label>
                            <div id="ajax_result">
                                <select class="form-control" id="select_Empleado" onchange="valida_cargo()" required>
                                    <option value="">Seleccione por favor</option>
                                </select>
                            </div>    
                         </div>
                        
                        <div class="form-group col-lg-5">
                          <label for="txt_cargo">Cargo</label>
                          <input type="text" class="form-control" id="txt_cargo" placeholder="(Cargo)" disabled>
                          <small id="txt_cargo" class="form-text text-muted">Cargo se mostrara segun informacion de la base de datos.</small>
                        </div>
                        
                    </div> <!-- FIN DEL ROW -->
                    
                    <div class="txtseccion">
                        <label class="etique"> INFORMACIÓN DE REGISTRO</label>
                    </div>
                   
                    <div class="row">
                        <div class="form-inline col-lg-6 right-align">
                            <?php createSelectWithID('selectAsis1')?>
                        </div>
                    
                        <div class="form-inline col-lg-6 right-align">
                            <?php createSelectWithID('selectPerm1')?>
                        </div>
                        
                        <div class="form-inline col-lg-6 right-align">
                            <?php createSelectWithID('selectRetra1')?>
                        </div>
                        
                        <div class="form-inline col-lg-6 right-align">
                            <?php createSelectWithID('selectActit1')?>
                        </div>
                        
                        <div class="form-inline col-lg-6 right-align">
                            <?php createSelectWithID('selectPredi1')?>
                        </div>
                        
                        <div class="form-inline col-lg-6 right-align">
                            <?php createSelectWithID('selectCompr1')?>
                        </div>
                        
                        <div class="form-inline col-lg-12 right-align">
                            <?php createSelectWithID('selectRespon1')?>
                        </div>
                        
                        <div class="form-inline col-lg-6 right-align">
                            <?php createSelectWithID('con_funcionesSegu')?>
                        </div>
                        
                        <div class="form-inline col-lg-6 right-align">
                            <?php createSelectWithID('real_muestroAlarmas')?>
                        </div>
                        
                        <div class="form-inline col-lg-6 right-align">
                            <?php createSelectWithID('man_ordenPuestoTrab')?>
                        </div>
                        
                        <div class="form-inline col-lg-6 right-align">
                            <?php createSelectWithID('registroBorrones')?>
                        </div>
                        
                        <div class="form-inline col-lg-6 right-align">
                            <?php createSelectWithID('herr_buenEstado')?>
                        </div>
                        
                        <div class="form-inline col-lg-6 right-align">
                            <?php createSelectWithID('uniformeLimpio')?>
                        </div>
                        
                        <div class="form-inline col-lg-6 right-align">
                            <?php createSelectWithID('calzadoLimpio')?>
                        </div>
                        
                     
                    </div>
                    
                    <div class="txtseccion">
                        <label class="etique"> ACCIONES</label>
                    </div>
                    
                    <div class="form-group">
                        <label for="txt_observacion">Observacion:</label>
                        <textarea class="form-control" rows="2" id="txt_observacion" name="txt_observacion" maxlength="150" placeholder="(200 caracteres)"></textarea>
                    </div>
                    
                    <div class="form-group center">
                        <button type="submit" class="btn btn-primary btn-md">Registrar</button>
                    </div>    
                        
                </form>
            </div>
            <div class="footer">Todos los derechos reservados © 2017 - <?php echo date('Y')?>, <?php echo 'Ver ' .APP_VERSION?></div>  
      
        
            <?php require_once 'seguridadModal.php';?>
            
        
    </div>
    
      
	<!-- USO JQUERY, animacion de menu para responsive-->
        
        <script type="text/javascript" src="functions.js"></script>
        <script type="text/javascript" src="../ws-admin/js/materialize.js"></script>
        <script src="../ws-admin/js/bootstrap.js"></script>
        
        
</body>
</html>