<?php
session_start();
include('../ws-admin/funciones.php'); // Acceso a funciones utiles
include('../config/global.php');
include('funcions.php');
?>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        
    <link type="text/css" rel="stylesheet" href="../ws-admin/css/materialize.css"  media="screen,projection"/>
    <link rel="stylesheet" href="../ws-admin/css/bootstrap.css">
    <link rel="stylesheet" href="assets/styles.css">
    <link rel="shortcut icon" href="../ws-admin/img/favicon.ico">
    <link href='../ws-admin/css/roboto.css' rel='stylesheet' type='text/css'>
    
      
        
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
                            <h6>rev04.09.2019</h6>
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
                
                <form id='registerForm' method="POST">
                    <div class="row">
                        <div class="form-group col-lg-4">
                        <label for="txt_CIRUC">Cédula/RUC</label>
                        <input type="text" class="form-control" id="txt_CIRUC" name="txt_CIRUC" maxlength="13" placeholder="Ingrese CI o RUC (13 caracteres)" required>
                        <small id="txt_CIRUC" class="form-text text-muted">Ingrese cedula o RUC de cliente, empleado autorizado a realizar el registro.</small>
                        </div> 
                        
                        <div class="form-group col-lg-5">
                          <label for="txt_empleadoIdentificado">Supervisor</label>
                          <input type="text" class="form-control" id="txt_empleadoIdentificado" placeholder="(Empleado)" readonly>
                          <small id="txt_empleadoIdentificado" class="form-text text-muted">Empleado identificado con el CI /RUC Ingresado.</small>
                        </div>
       
                        <div class="form-group col-lg-3">
                          <label for="txt_fechaRegistro">Fecha de Registro</label>
                          <input type="text" id="txt_fechaRegistro" name="txt_fechaRegistro" class="form-control centertext"  placeholder="Fecha de reporte" value="<?php echo date('Y-m-d')?>" readonly required>
                          <small id="txt_fechaRegistro" class="form-text text-muted">Fecha con la que se registrará el actual formulario.</small>
                        </div>
                        
                    </div> <!-- FIN DEL ROW -->
                    
                    <div class="row">
                        <div class="form-group col-lg-3">
                            <label for="select_Empresa">Seleccion de Empresa</label>
                            <select class="form-control" id="select_Empresa" name="select_Empresa" required>
                                <option value="">Seleccione por favor</option>
                                <?php getSelectEmpresasWF();?>
                            </select>
                         </div>
                        
                        <div class="form-group col-lg-5">
                            <label for="select_Empleado">Seleccion de Empleado</label>
                            <div id="ajax_result">
                                <select class="form-control" id="select_Empleado" required>
                                    <option value="">Seleccione por favor</option>
                                </select>
                            </div>    
                         </div>
                        
                        <div class="form-group col-lg-4">
                          <label for="txt_cargo">Cargo</label>
                          <input type="text" class="form-control" id="txt_cargo" placeholder="(Cargo)" readonly>
                          <small id="txt_cargo" class="form-text text-muted">Cargo que ocupa el empleado.</small>
                        </div>
                        
                    </div> <!-- FIN DEL ROW -->
                    
                    <div class="txtseccion">
                        <label class="etique"> INFORMACIÓN DE REGISTRO</label>
                    </div>
                   
                    <div class="row">
                        <?php renderItems()?>
                            
                        <div class="form-group col-lg-12 form-inline right-align">
                            <label for = "">% de cumplimiento de la meta</label>
                            <div class="form-group">
                                <select class="form-control input-sm centertext totalEV" id="'.$cod_item.'" name="'.$cod_item.'">
                                    <option value=""> Seleccione por favor</option>
                                    <option value="90-100">90-100 %</option>
                                    <option value="80-90">80-90 %</option>
                                    <option value="70-80">70-80 %</option>
                                    <option value="60-70">60-70 %</option>
                                    <option value="0">No aplica</option>
                                </select>
                            </div>

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
                        <button type="button" id='btn_test' class="btn btn-primary btn-md">Test</button>
                    </div>    
                        
                </form>
                <div class="footer">Todos los derechos reservados © 2017 - <?php echo date('Y')?>, <?php echo 'Ver ' .APP_VERSION?></div>  
      
            </div>
            
        
            <?php require_once 'seguridadModal.php';?>
            
        
    </div>
    
      
	<!-- JS libraries -->
        <script src="../ws-admin/js/jquery-latest.js"></script>
        <script src="../ws-admin/js/bootstrap.js"></script>
        <script type="text/javascript" src="assets/app.js"></script>
        
</body>
</html>