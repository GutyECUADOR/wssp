<?php include '../ws-admin/topnavBar.php'?>

<div class="contenedor-formulario">
            
                <div class="container wrap">
                    
                    <form class="formulario" id="formularioMain" name="formulario_registro" method="POST" novalidate>
                        <div class="row text-center">
                            <div class="col s12">
                                <h5 class="red-text ">FORMULARIO GGECU</h5>
                                <h6 class="red-text ">FORMULARIO PARA LA EVALUACIÓN DEL DESEMPEÑO POR COMPETENCIAS PARA USO DEL JEFE INMEDIATO</h6>
                                <h6>rev 10.04.18</h6>
                            </div>
                        </div>
                        
                        <div class="row center-align">
                            <div class="col s12">
                                <img class="logo" src="../ws-admin/img/logo.png" alt="Logo">
                             </div>
                            <div class="col s12">
                                 <label class="txtcentro"> Los campos con (*) son obligatorios.</label>
                            </div>    
                        </div>
                            
                        <div class="alert alert-info alert-dismissable centrado">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            <h5>USTED ESTA REALIZANDO LA EVALUACION CORRESPONDIENTE AL PERIODO: </h5>
                            <h5><?php echo "desde " .first_month_day_anterior(). " hasta  ". last_month_day_anterior()?></h5>
                        </div> 
                    
                        <!--SECCION INFO PERSONAL-->                
                        <div class="row txtseccion">
                            <label class="etique"> INFORMACIÓN DEL SUPERVISOR</label>
                        </div>
            
                        <div class="row">
                            <div class="form-group col-lg-4">
                            <label for="txt_CIRUC">Cédula/RUC <em class="em">*</em></label>
                            <input type="number" class="form-control" id="txt_CIRUC" name="txt_CIRUC" placeholder="Ingrese CI o RUC (13 caracteres)" required>
                            <small id="txt_CIRUC" class="form-text text-muted">Ingrese cedula o RUC de cliente, empleado autorizado a realizar el registro.</small>
                            </div> 

                            <div class="form-group col-lg-5">
                              <label for="txt_empleadoIdentificado">Supervisor <em class="em">*</em></label>
                              <input type="text" class="form-control" id="txt_empleadoIdentificado" placeholder="(Empleado)" disabled>
                              <small id="txt_empleadoIdentificado" class="form-text text-muted">Empleado identificado con el CI /RUC Ingresado.</small>
                            </div>

                            <div class="form-group col-lg-3">
                              <label for="txt_fechaRegistro">Fecha de Registro <em class="em">*</em></label>
                              <input type="text" id="txt_fechaRegistro" name="txt_fechaRegistro" class="form-control centertext"  placeholder="Fecha de reporte" value="<?php echo date('Y-m-d')?>" readonly required>
                              <small id="txt_fechaRegistro" class="form-text text-muted">Fecha con la que se registrará el actual formulario.</small>
                            </div>

                        </div> <!-- FIN DEL ROW -->
            
                        <div class="row">
                            
                            <div class="form-group col-lg-4">
                                <label for="select_empresaa">Seleccion de Empresa <em class="em">*</em></label>
                                <select class="form-control" id="select_empresaa" name="select_empresaa" required>
                                    <option value="">Seleccione por favor</option>
                                    <?php getSelectEmpresasWF();?>
                                </select>
                            </div>
                            
                            <div class="form-group col-lg-4 ajax_result_cliente" id="ajax_result_cliente">
                                <label for="select_empresaa">Seleccion de Empleado <em class="em">*</em></label>
                                <select class="form-control seleccion_empleado" id="seleccion_empleado" name="seleccion_empleado" required>
                                    <option value="">Seleccione por favor</option>
                                    
                                </select>
                            </div>
                             
                            <div class="form-group col-lg-4">
                                <label class="label">Cargo:</label>
                                <input type="text" name="txt_cargo" id="txt_cargo" class="form-control centertext" placeholder="(Cargo)" readonly>   
                            </div>
                            
                            
                        </div>        
                          
                        <div class="row txtseccion">
                            <label class="etique"> INDICADORES </label>
                        </div>
            
                        <div class="tabbable"> <!-- Only required for left/right tabs -->
                                <ul class="nav nav-tabs">
                                    <li class="active"><a href="#tab1" data-toggle="tab"><h6>Actividades Esenciales</h6></a></li>
                                    <li><a href="#tab2" data-toggle="tab"><h6>Conocimientos</h6></a></li>
                                    <li><a href="#tab3" data-toggle="tab"><h6>Competencias Técnicas del Puesto</h6></a></li>
                                    <li><a href="#tab4" data-toggle="tab"><h6>Competencias Universales</h6></a></li>
                                    <li><a href="#tab5" data-toggle="tab"><h6>Trabajo en Equipo, Iniciativa y Liderazgo</h6></a></li>
                                    <li><a href="#tab6" data-toggle="tab"><h6>Relaciones cliente interno</h6></a></li>
                                </ul>
                                <div class="tab-content">
                                     <br>
                                    <?php require_once 'tab-esencial.php';?>
                                    
                                    <?php require_once 'tab-conocimientos.php';?>
                                     
                                    <?php require_once 'tab-com-tecnicas.php';?>
                                    
                                    <?php require_once 'tab-com-universales.php';?>
                                     
                                    <?php require_once 'tab-trabajo-iniciativa-liderazgo.php';?> 
                                     
                                    <?php require_once 'tab-relacionClienteInterno.php';?> 
                                    
                                </div> <!-- tab-content --> 
                                   
                                <div class="row txtseccion">
                                    <label class="etique"> RESULTADOS DE EVALUACION </label>
                                </div>   
                                    
                                <div class="row">
                                    <table class="table table-striped table-hover">
                                    <thead>
                                      <tr>
                                        <th>#</th>
                                        <th>Factores de Evaluación</th>
                                        <th>Calificación Alcanzada</th> 
                                      </tr>
                                    </thead>
                                    <tbody>
                                      <tr>
                                        <th scope="row">1</th>
                                        <td>Indicadores de Gestión del puesto</td>
                                        <td id="resultado1" class="resultado_seccion" style="text-align: center"></td>
                                      </tr>
                                      <tr>
                                        <th scope="row">2</th>
                                        <td>Conocimientos</td>
                                         <td id="resultado2" class="resultado_seccion" style="text-align: center"></td>
                                      </tr>
                                      <tr>
                                        <th scope="row">3</th>
                                        <td>Competencias técnicas del puesto</td>
                                         <td id="resultado3" class="resultado_seccion" style="text-align: center"></td>
                                      </tr>
                                      <tr>
                                        <th scope="row">4</th>
                                        <td>Competencias Universales</td>
                                         <td id="resultado4" class="resultado_seccion" style="text-align: center"></td>
                                      </tr>
                                      <tr>
                                        <th scope="row">5</th>
                                        <td>Trabajo en equipo, Iniciativa y Liderazgo</td>
                                         <td id="resultado5" class="resultado_seccion" style="text-align: center"></td>
                                      </tr>
                                      <tr>
                                        <th scope="row">6</th>
                                        <td>Relación cliente Interno (Reduccion de Puntos)</td>
                                         <td id="resultado6" class="resultado_seccion_inv" style="text-align: center">(-)</td>
                                      </tr>
                                      
                                      <tr>
                                        <th scope="row"></th>
                                        <td><b>FACTOR DE EVALUACION </b></td>
                                         <td id="totalFactorGeneral" style="text-align: center"></td>
                                            <input type="hidden" id="totalFactorGeneraltxt" name="totalFactorGeneraltxt" value="0">
                                      </tr>
                                      
                                      <tr>
                                        <th scope="row"></th>
                                        <td><b>TOTAL DE EVALUACION </b></td>
                                         <td id="resultadoTotalGneneral" style="text-align: center"></td>
                                            <input type="hidden" id="totalresultGeneraltxt" name="totalresultGeneraltxt" value="0">
                                      </tr>


                                    </tbody>
                                  </table>    
                                </div>  
                                   
                                <div class="txtseccion">
                                    <label class="etique"> OBSERVACIONES</label>
                                </div>
                                
                                <div class="form-group">
                                    <label for="txt_observacion" class="active">Observacion:</label>
                                    <textarea class="form-control" rows="2" id="txt_observacion" name="txt_observacion" placeholder="(200 caracteres)" maxlength="180"></textarea>
                                </div>
                                
                                <div>
                                    <input name="guardar" type="submit" id="btn-submit" value="Registrar" onclick="calculaTotalGeneral()">
                                </div>
                                <div class="footer">Todos los derechos reservados © 2017 - <?php echo date('Y')?>, Ver 2.0.0</div>
                            </div> <!-- Fin tabla de tabs-->
                    
                            
                    
                    </form>
                    </div> <!--Fin Wrap Content-->
              
        </div> <!--Fin Contenedor Formulario-->
        
       <?php require_once 'modalSeguridad.php';?>
      
                
              
        <!-- Floating Button Google-->
        <div class="fixed-action-btn">
            <a class="btn-floating btn-large red">
              <i class="large material-icons">mode_edit</i>
            </a>
            <ul>
                <li data-toggle="tooltip" data-placement="top" title="Nueva actividad esencial"><a class="btn-floating green" id="btn_add_row_esencial"><i class="material-icons">playlist_add</i></a></li>
                <li data-toggle="tooltip" data-placement="top" title="Nuevo conocimiento"><a class="btn-floating blue" id="btn_add_row_conocimiento"><i class="material-icons">playlist_add</i></a></li>
                <li data-toggle="tooltip" data-placement="top" title="Nuevo Competencia Técnica"><a class="btn-floating gray" id="btn_add_row_comtecnica"><i class="material-icons">playlist_add</i></a></li>
                <li data-toggle="tooltip" data-placement="top" title="Nuevo Competencia Universal"><a class="btn-floating orange" id="btn_add_row_comuniversal"><i class="material-icons">playlist_add</i></a></li>
                <li data-toggle="tooltip" data-placement="top" title="Nueva Queja"><a class="btn-floating red" id="btn_add_row_queja"><i class="material-icons">playlist_add</i></a></li>
            
                
            </ul>
          </div>
          
	<!-- USO JQUERY, animacion de menu para responsive-->
        
        <script type="text/javascript" src="functions.js"></script>
        <script type="text/javascript" src="../ws-admin/js/materialize.js"></script>
        <script src="../ws-admin/js/bootstrap.js"></script>
        