<?php
session_start();

require_once  './vendor/autoload.php';

$estadoVehiculo = new EstadoVehiculo();
$arrayEmpresas = $estadoVehiculo->getEmpresas();
$arrayItems = $estadoVehiculo->getItems('EST');

?>
<html lang="es">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <link rel="shortcut icon" href="../ws-admin/img/favicon.ico">
        <!--Import Google Icon Font-->
        <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <!--Import materialize.css-->

        <link type="text/css" rel="stylesheet" href="../ws-admin/css/materialize.css"  media="screen,projection"/>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">

        <link rel="stylesheet" href="assets/pnotify.custom.min.css">

        <link rel="stylesheet" href="../ws-admin/css/bootstrap.css">
        <link rel="stylesheet" href="assets/mystyles.css">
	
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
                            <h5>FORMULARIO DE ESTADO DEL VEHICULO</h5>
                            <h6>rev24.07.19</h6>
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
                
                <form id="registerForm" method="POST">
                    <div class="row">
                        <div class="form-group col-lg-4">
                        <label for="txt_CIRUC">Cédula/RUC</label>
                        <input type="text" class="form-control" id="txt_CIRUC" name="txt_CIRUC" maxlength="13" placeholder="Ingrese CI o RUC (13 caracteres)" required>
                        <small class="form-text text-muted">Ingrese cedula o RUC del empleado al que se le asignará el vehiculo.</small>
                        </div> 
                        
                        <div class="form-group col-lg-4">
                          <label for="txt_empleadoIdentificado">Supervisor</label>
                          <input type="text" class="form-control" id="txt_empleadoIdentificado" placeholder="(Empleado)" readonly>
                          <small class="form-text text-muted">Empleado identificado con el CI /RUC Ingresado.</small>
                        </div>
       
                        <div class="form-group col-lg-4">
                          <label for="txt_fechaRegistro">Fecha de Registro</label>
                          <input type="text" id="txt_fechaRegistro" name="txt_fechaRegistro" class="form-control centertext"  placeholder="Fecha de reporte" value="<?php echo date('Y-m-d')?>" readonly required>
                          <small class="form-text text-muted">Fecha con la que se registrará el actual formulario.</small>
                        </div>
                        
                    </div> <!-- FIN DEL ROW -->

                    <div class="row">

                        <div class="form-group col-lg-3">
                        <label for="txt_placas">Seleccione empresa</label>
                        <select class="form-control" name="select_empresa" id="select_empresa" required>
                            <option value=''>---Seleccione Empresa---</option>
                            <?php 

                                foreach ($arrayEmpresas as $opcion) {
                                    echo' <option value="'.trim($opcion['Codigo']).'"> '.$opcion['Nombre'].' </option>';
                                }
                               
                            ?>

                        </select>
                        </div> 

                        <div class="form-group col-lg-3">
                        <label for="txt_placas">Placas del Vehiculo</label>
                        <input type="text" class="form-control" id="txt_placas" name="txt_placas" maxlength="13" placeholder="Ingrese la placa del Vehiculo"required>
                        <small class="form-text text-muted">Ingrese las placas del vehiculo.</small>
                        </div> 
                        
                        <div class="form-group col-lg-3">
                          <label for="txt_vehiculoIdentificado">Vehiculo</label>
                          <input type="text" class="form-control" id="txt_vehiculoIdentificado" placeholder="(Vehiculo)" readonly>
                          <small class="form-text text-muted">Vehiculo identificado.</small>
                        </div>

                        <div class="form-group col-lg-3">
                          <label for="txt_kilometraje">Kilometraje</label>
                          <input type="number" id="txt_kilometraje" name="txt_kilometraje" class="form-control centertext"  placeholder="Kilometraje" required>
                          <small class="form-text text-muted">Kilometraje actual del vehiculo.</small>
                        </div>
                        
                    </div> <!-- FIN DEL ROW -->
                    
                    <div class="txtseccion">
                        <label class="etique"> INFORMACIÓN DE REGISTRO</label>
                    </div>
                   
                    <div class="row">

                        <?php
                            foreach ($arrayItems as $opcion) {
                                $codigo = trim($opcion['codigo']); 
                                $descripcion = trim($opcion['descripcion']); 
                               
                        ?>
                        
                        <div class="form-group col-lg-4">
                            <label for="<?php echo $codigo?>"><?php echo $descripcion?></label>
                            <select class="form-control input-sm centertext itemVehiculo" id="<?php echo $codigo?>" name="<?php echo $codigo?>" required>
                                    <option value=""> Seleccione por favor</option>
                                    <option value="4">Muy Bueno</option>
                                    <option value="3">Bueno</option>
                                    <option value="2">Regular</option>
                                    <option value="0">No dispone</option>
                                </select>
                 
                        </div> 

                        <?php
                           
                            } 
                        ?>
                     
                    </div>
                    
                    <div class="txtseccion">
                        <label class="etique"> OBSERVACIONES </label>
                    </div>
                    
                    <div class="form-group">
                        <label for="txt_observacion">Observacion:</label>
                        <textarea class="form-control" rows="2" id="txt_observacion" name="txt_observacion" maxlength="150" placeholder="(200 caracteres)"></textarea>
                    </div>
                    
                    <div class="form-group center">
                       <!--  <button id="btn_test" type="button" class="btn btn-primary btn-md">Test</button> -->
                        <button type="submit" class="btn btn-primary btn-md">Registrar</button>
                    </div>    
                        
                </form>
            </div>
            <div class="footer">Todos los derechos reservados © 2017 - <?php echo date('Y')?>, <?php echo 'Ver ' .APP_VERSION?></div>  
      
    </div>
    
      
	<!-- USO JQUERY, animacion de menu para responsive-->
    <script src="../ws-admin/js/jquery-latest.js"></script>
    <script src="../ws-admin/js/bootstrap.js"></script>
     <!-- Toastr script -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script type="text/javascript" src="assets/pnotify.custom.min.js"></script>
    <script type="text/javascript" src="assets/app.js"></script>
        
</body>
</html>