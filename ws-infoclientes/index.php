<?php
include('../ws-admin/funciones.php'); // Acceso a funciones utiles
include('../config/global.php');
include('funcions.php');

?>
<html lang="es">
<head>
    <title><?php echo APP_NAME ?></title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        
    <link rel="stylesheet" type="text/css" href="../libs/sweetalert2-master/dist/sweetalert2.min.css">
    
    <link rel="shortcut icon" href="../ws-admin/img/favicon.ico">
    <link rel="stylesheet" href="../ws-admin/css/bootstrap.css">
    <link rel="stylesheet" href="mystyles.css">
</head>

<body>
    
    <?php include '../ws-admin/topnavBar.php'?> 
   
    <div class="contenedor-formulario">
            
        <div class="container wrap">

            <form class="formulario" id="formularioMain" name="formulario_registro" method="POST">
                <div class="row txtcentro">
                    <div class="col s12">
                        <h5 class="red-text ">FORMULARIO INFOCLIENTES</h5>
                        <h6 class="red-text ">FORMULARIO PARA EL REGISTRO DE INFORMACION COMPLEMENTARIA DE CLIENTES</h6>
                        <h6>rev10.07.18</h6>
                    </div>
                </div>
                
                <div class="row center-align">
                    <div class="col s12 text-center">
                        <img class="logo" src="../ws-admin/img/logo.png" alt="Logo">
                        </div>
                    <div class="col s12 txtcentro">
                            <label> Los campos con (*) son obligatorios.</label>
                    </div>    
                </div>
                    
                <!--SECCION INFO PERSONAL-->                
                <div class="row txtseccion">
                    <label class="etique">  ACTUALIZACION DE INFORMACIÓN</label>
                </div>

                <ul class="nav nav-tabs">
                    <li class="active"><a data-toggle="tab" href="#tab1">Información Principal</a></li>
                    <li><a data-toggle="tab" href="#tab2">Información Extra</a></li>
                </ul>

                <div class="tab-content">
                    <div id="tab1" class="tab-pane fade in active">
                        <br>
                        <div class="row">

                            <div class="form-group col-lg-12">
                                <label>Seleccion de Empresa <em class="em">*</em></label>
                                <select class="form-control" id="select_empresaa" name="select_empresaa" required>
                                    <option value="">Seleccione por favor</option>
                                    <?php getSelectEmpresasWF();?>
                                </select>
                            </div>
                    
                        </div>  

                        <!-- SECCION DATOS DEL CLIENTE-->
                        <div class="row">

                            <div class="form-group col-lg-12">
                                <label>Cédula / RUC del cliente: <em class="em">*</em></label>
                                <input type="text" class="form-control" id="txt_ruc" name="txt_ruc" placeholder="17XXXXXXXXXX" maxlength="13" required>
                                <small class="form-text text-muted ">Ingrese cedula o ruc del cliente. (13 caracteres) </small>
                            </div> 

                            <div class="form-group col-lg-12">
                                <label>Nombres & Apellidos del cliente: <em class="em">*</em></label>
                                <input type="text" class="form-control text-uppercase" id="txt_nombre" name="txt_nombre" placeholder="Nombres & Apellidos" maxlength="50" required readonly>
                                <small class="form-text text-muted ">Ingrese nombres completos del cliente. (50 caracteres)</small>
                            </div> 

                            <div class="form-group col-lg-12">
                                <label>Direccion del cliente: <em class="em">*</em></label>
                                <input type="text" class="form-control" id="txt_direccion" name="txt_direccion" placeholder="Av. NNUU y etc." maxlength="50" required readonly>
                                <small class="form-text text-muted ">Ingrese detalles del domicilio. (50 caracteres)</small>
                            </div> 

                            <div class="form-group col-lg-12">
                                <label>Teléfono del cliente: <em class="em">*</em></label>
                                <input type="text" class="form-control" id="txt_telefono" name="txt_telefono" placeholder="ejem. 022252505" maxlength="10" required readonly>
                                <small class="form-text text-muted ">Ingrese detalles del domicilio. (50 caracteres)</small>
                            </div> 

                            <div class="form-group col-lg-12">
                                <label>Correo del cliente: <em class="em">*</em></label>
                                <input type="text" class="form-control" id="txt_correoCliente" name="txt_correoCliente" required readonly>
                                <small class="form-text text-muted ">Ingrese el correo del cliente. (50 caracteres)</small>
                            </div> 

                            <div class="form-group col-lg-12 text-center">
                                <button type="button" id="boton_edit" class="btn btn-success" disabled><span class="glyphicon glyphicon-pencil"></span> Editar Información Principal</button>
                            </div>
                        </div>  

                        
                </div>

                <div id="tab2" class="tab-pane fade">
                    <h3></h3>
                    
                    <div class="row">

                        <div class="form-group col-lg-12">
                        <label for="select_deportes">Seleccione deportes de su preferencia</label>
                            <select class="form-control selectpicker" id="select_deportes" name="select_deportes" title="Seleccione varios deportes" data-size="10" multiple>
                                <optgroup label="Más Populares">
                                    <option value="FUB">Futbol</option>
                                    <option value="BAS">Baloncesto</option>
                                    <option value="VOL">Voleibol</option>
                                    <option value="TEN">Tenis</option>
                                    <option value="NAT">Natacion</option>
                                    <option value="CIC">Ciclismo</option>
                                    <option value="BBO">Béisbol</option>
                                    
                                </optgroup>
                                <optgroup label="Deportes Extremos">
                                    <option value="MAR">Marcha</option>
                                    <option value="FIS">Fisicoculturismo</option>
                                    <option value="BMO">Bicicleta de montaña</option>
                                    <option value="AMA">Artes Marciales /Lucha/ Box</option>
                                    <option value="HYR">Hockey / Rugby</option>
                                    <option value="OTR">Otros</option>
                                </optgroup>
                            </select>

                        </div> 


                    </div>


                </div>
                    
                </div>

                <div class="txtseccion">
                        <label class="etique"> OBSERVACIONES</label>
                    </div>
                    
                    <div class="col-lg-12">
                            <div class="input-group">
                            <span class="input-group-addon">
                                <input type="checkbox" id="recibirInfoMail">
                            </span>
                            <input type="text" class="form-control" readonly value="Desea recibir información acerca de promociones y descuentos especiales.">
                            </div>
                        </div>

                        <div class="form-group col-lg-12" id="divEmail">
                            <label>Correo del cliente: <em class="em">*</em></label>
                            <input type="email" class="form-control text-lowercase" id="txt_correo" name="txt_correo" placeholder="ejemplo@hotmail.com" maxlength="50" required>
                            <small class="form-text text-muted ">Ingrese correo. (50 caracteres)</small>
                        </div> 
                    
                    <div class="form-group">
                        <label for="txt_observacion" class="active">Observacion:</label>
                        <textarea class="form-control" rows="2" id="txt_observacion" name="txt_observacion" placeholder="(200 caracteres)" maxlength="180"></textarea>
                    </div>

                    <div>
                        <input name="guardar" type="submit" id="btn-submit" value="Registrar" >
                    </div>

                <div class="footer">Todos los derechos reservados © 2017 - <?php echo date('Y')?>, Ver 2.0.0</div>
            
            </form>
            </div> <!--Fin Wrap Content-->
        
        </div> <!--Fin Contenedor Formulario-->
    </div>    
	<!-- USO JQUERY, animacion de menu para responsive-->
    
    <script src="../ws-admin/js/jquery-latest.js"></script>
    <script src="../ws-admin/js/bootstrap.js"></script>
    <script src="../libs/sweetalert2-master/dist/sweetalert2.min.js"></script>
    <script type="text/javascript" src="functions.js"></script>

    
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/css/bootstrap-select.min.css">

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/js/bootstrap-select.min.js"></script>
   
</body>
</html>