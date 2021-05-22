    <?php include '../ws-admin/topnavBar.php'?>

        <div class="contenedor-formulario">
		<div class="wrap">
                            <div class="text-center">
                                    <h5>SOLICITUD DE VALES POR PÉRDIDA</h5>
                                    <h6>rev13.09.17</h6>
                            </div>

                            <div class="text-center">
	           		        	<img class="logo" src="../ws-admin/img/logo.png" alt="Logo" style="width:200px">
                    		</div>
                    
                    <form action="addvalep.php" autocomplete="off" name="formulario_registro" method="POST" onsubmit= "return validar_formulario()">
               			
                    
                                <div class="text-center">
                                    <label> Los campos con (*) son obligatorios y deben contener información verídica. Recuerde al finalizar validar campos de seguridad.</label>
                                </div>
                            
                           
                                <div class="txtseccion">
                                    <label class="etique"> INFORMACIÓN DEL SOLICITANTE</label>
                                </div>
                                
                                <div class="col">
                                    <div class="form-group">
                                        <label>Indique empresa: <em class="em">*</em></label>
                                        <select class="form-control input-sm" name="select_empresaa" id="select_empresaa" onchange="showselectBodegas(this.value);showselectSupervisores(this.value)" required>
                                            <option value=''>---SELECCIONE POR FAVOR---</option>
                                            <?PHP
                                            
                                            $consulta_empresa = "SELECT * FROM dbo.Empresas_WF with (nolock) WHERE Codigo IN ('001','002','004','006','011','008') ORDER BY Codigo";

                                            $result_query_empresa = odbc_exec($conexion_sbio, $consulta_empresa);

                                            while(odbc_fetch_row($result_query_empresa))
                                            {
                                                $cod_emp = odbc_result($result_query_empresa,"Codigo"); 
                                                $detalle_emp = odbc_result($result_query_empresa,"Nombre"); 

                                                echo "<option value='$cod_emp'>$detalle_emp</option>";
                                            }
                                            
                                            ?>
                                            
                                        </select>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label>Indique el tipo de documento: <em class="em">*</em></label>
                                        <select class="form-control input-sm" name="select_dirigidoa" id="select_dirigidoa" required>
                                            <option value=''>---SELECCIONE POR FAVOR---</option>
                                        </select>
                                    </div>
                                </div>        
                                        
                                <div class="row">  
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>CI del Solicitante: <em class="em">*</em></label>
                                            <input type="text" class="form-control input-sm"  id="txt_cisolicitante" name="txt_cisolicitante" onkeyup="ajaxvalidacod();getDescuento()" maxlength="13" required>
                                        </div> 
                                    </div>
                                    
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Solicitante:</label>
                                            <input type="text" class="form-control input-sm"  id="txt_solicitante_name" name="txt_solicitante_name" readonly>
                                        </div>
                                    </div>
                                        
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Empresa/Bodega:</label>
                                            <select class="form-control input-sm" id="cod_txt_empresa" name="cod_txt_empresa" required>
                                                <option value=''>---SELECCIONE POR FAVOR---</option>
                                            </select>    
                                            <input type="hidden"  id="cod_txt_cliente" name="cod_txt_cliente">
                                        </div>
                                    </div>
                                    
                                </div>    
            
                          
                                <div class="col">
                                    <div class="alert alert-info alert-dismissable text-center">
                                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                                        <h5>Agrege Productos</h5><p class="text-center"> Haga clic sobre el botón agregar productos de la parte derecha, para ingresar uno nuevo.</p>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="responsibetable">        
                                            <table class="table table-bordered table-condensed">
                                                <thead>
                                                    <tr>
                                                        <th class="text-center" style="width: 10%;" >Codigo</th>
                                                        <th class="text-center" style="width: 20%; min-width: 200px;">Nombre del Articulo</th>
                                                        <th class="text-center" style="width: 3%">Cantidad</th>
                                                        <th class="text-center" style="width: 5%; min-width: 100px;">Costo</th>
                                                        <th class="text-center" style="width: 5%; min-width: 80px;">Descuento</th>
                                                        <th class="text-center" style="width: 5%">Eliminar</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="tablaProductosEgreso">
                                                    <tr name="row_productos[]">
                                                        <td>
                                                            <input type="text" class="form-control input-sm text-center rowproducto" onkeyup="ajaxvalidacod_producto(this);productoRepetido(this)" onblur="calcular_total();valor_porcentaje()" name="txt_cod_product[]" required>
                                                        </td>
                                                        <td>
                                                            <input type="text" class="form-control input-sm text-center row_deproducto" name="txt_detalle_product[]" readonly>
                                                        </td>
                                                        <td>
                                                            <input type="number" class="form-control input-sm text-center rowcantidad" name="txt_cant_product[]" onclick="extra_prod(this);calcular_total();valor_porcentaje()" onkeyup="extra_prod(this);calcular_total();valor_porcentaje()" min="0" required>
                                                        </td>
                                                        <td>
                                                            <input type="text" class="form-control input-sm text-center importe_linea" name="txt_precio_product[]" value="0" onkeyup="calcular_total();valor_porcentaje()" onkeypress="return valida_numeros(event)" readonly>
                                                            <input type="hidden" name="hidden_precio_product[]">
                                                        </td>
                                                        <td>
                                                            <input type="text" class="form-control input-sm text-center" name="txt_descuento[]" value="0" min="0" max="100"  readonly>
                                                        </td>
                                                        <td>
                                                            <button type="button" onclick="remove_extra_prod(this);valor_porcentaje()" class="btn btn-danger btn-sm btn-block"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></button>
                                                        </td>
                                                    </tr>
                                                        <!-- Contenedor de Controles ajax-->
                                                    <div class="result_add"> 
                                                    </div>
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <td colspan="4" class="text-center" style="vertical-align: middle;"><b>Subtotal</b>
                                                        </td>
                                                        <td colspan="2">
                                                            <input type="text" class="form-control input-sm text-center subtotales" id="txt_subtotal" name="txt_subtotal" readonly required="true">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="4" class="text-center" style="vertical-align: middle;"><b>IVA</b>
                                                        </td>
                                                        <td colspan="2">
                                                            <input type="text" class="form-control input-sm text-center subtotales" id="txt_iva" name="txt_iva" readonly required="true">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="4" class="text-center" style="vertical-align: middle;"><b>Total</b>
                                                        </td>
                                                        <td colspan="2">
                                                            <input type="text" class="form-control input-sm text-center subtotales" id="txt_total"  name="txt_total" readonly required="true">
                                                        </td>
                                                    </tr>

                                                </tfoot>
                                            </table>
                                        </div>
                                    </div>
                                </div>
            
                                <!--SECCION RECARGO-->                       
                                <div class="txtseccion">
                                    <label class="etique">RECARGO</label>
                                </div>
                                
                                <div class="col">
                                    <div class="alert alert-info alert-dismissable text-center">
                                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                                        <h5>Agrege empleados a recargar monto</h5><p class="text-center"> Haga clic sobre el botón agregar empleado de la parte derecha, para ingresar uno nuevo.</p>
                                    </div>
                                </div>
            
                                <div class="col">
                                    <div class="form-group">
                                        <label for="nombre">Indique numero de cuotas: <em class="em">*</em></label>
                                        <input type="number" name="select_numcuotas" class="form-control input-sm" id="select_numcuotas" min="1" value="3" readonly required>
                                    </div>
                                    <div class="form-group">
                                        <label for="nombre">Indique Fecha de Inicio de Pagos: <em class="em">*</em></label>
                                        <input type="text" id="date_pagosini" name="date_pagosini" class="form-control input-sm" placeholder="Fecha Inicio Pagos" value="<?php echo date('Y-m-10')?>" readonly required>
                                    </div>
                                </div>
            
            
                                <div class="col" name="row_empleados[]">
                                    <div class="form-group recargo_ci">
                                        <label>Cédula: <em class="em">*</em></label>
                                        <input type="text" class="form-control input-sm text-center rowempleado" onkeyup="ajaxvalidaemp(this);valor_porcentaje();empleadoRepetido(this)" name="txt_ci_empleado[]" id="txt_ci_empleado[]" required>
                                    </div>
                                     <div class="form-group recargo_empleado">
                                        <label>Empleado:</label>
                                        <input type="text" class="form-control input-sm text-center row_deusuario" name="txt_nombre_emp[]" readonly>
                                        <input type="hidden" name="txt_hiddenwinf_emp[]">
                                     </div>

                                     <div class="form-group recargo_porcent">
                                        <label>%: <em class="em">*</em></label>
                                        <input type="text" class="form-control input-sm text-center valporcent" name="txt_porcent_emp[]" onkeyup="valor_porcentaje_manual()" onchange="valida_porcentaje_manual();" value="0" required>
                                     </div>
                                     <div class="form-group recargo_valor">
                                        <label>Valor:</label>
                                        <input type="text" class="form-control input-sm text-center importe_linea_emp" name="txt_valor_emp[]" value="0" readonly>
                                        <input type="hidden" name="hidden_valor_emp[]">
                                     </div>
                                     <div class="form-group icon_remove">
                                        <a id="removeprod_ico_emp" class="pointerico_ico"><span class="glyphicon glyphicon-remove removeprod_ico_emp" title="Eliminar Item" onclick="remove_emp(this)"></span></a>
                                    </div>
                                </div>
            
                                <!-- Contenedor de Controles ajax-->
                                <div class="result_emp_add"></div>
                               
                              
                                 <!--SECCION DETALLE-->                     
                                <div class="txtseccion">
                                    <label class="etique"> COMENTARIO / OBSERVACION</label>
                                </div>
                                 
                                 <div class="col">
                                     <textarea class="form-control cajaarea" name="txt_comentario" rows="3" cols="100%" maxlength="180"></textarea>
                                     
                                 </div> 
                                 
                                 
		                <div>
                        <input class="btn btn-primary btn-block"name="guardar" type="submit" id="btn-submit" value="Solicitar">
				</div>
				
			<div class="footer">Todos los derechos reservados © 2017, Ver 2.0.0</div>
                    </form>
                </div>
            
            
	</div>
    
    
        <!-- Modal Informe Antiguo-->
            <div class="modal fade" id="modal_buscar_informe_ant" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel">Recuperación de datos</h5>
                  </div>
                  <div class="modal-body">
                    
                    <div class="alert alert-info alert-dismissable">
                      <button type="button" class="close" data-dismiss="alert">&times;</button>
                      <p><strong> ATENCIÓN </strong></p>
                      <p><h5> Recupere la información de un vale a la vez</h5></p>
                    </div>
                    <div class="resultmodal" style="display:none;"></div>

                     <form method="GET" target="_blank" class="form-inline">
                            <div class="row">
                              <select class="form-control text-center" name="seleccion_empresa_valep" id="seleccion_empresa_valep" required>
                                   <option value=''>---SELECCIONE EMPRESA---</option>
                                    <?PHP 
                                    $consulta_emp = "SELECT * FROM dbo.Empresas_WF with (nolock) ORDER BY Codigo";
                                   
                                    $result_query_emp = odbc_exec($conexion_sbio, $consulta_emp);

                                    while(odbc_fetch_row($result_query_emp))
                                    {
                                    $cod_emp = odbc_result($result_query_emp,"Codigo"); 
                                    $detalle_emp = odbc_result($result_query_emp,"Nombre"); 
                                  
                                    echo "<option value='$cod_emp'>$detalle_emp</option>";
                                    }
                                    ?>
                                   
                                   <option value='008'> EMPRESA MODELO </option>
                                   
                               </select>
                            </div>
                            <div class="rowspace form-group">
                                <input type="date" id="dateini_modal" class="form-control centertext pickyDate"  placeholder="Fecha Inicial" required><span class="form-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                            </div>
                         
                            <div class="rowspace form-group">
                                <input type="date" id="datefin_modal" class="form-control centertext pickyDate" placeholder="Fecha Final" required><span class="form-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                            </div>
                            
                            <div class="row">
                                
                            </div>
                        <!-- Resultados AJAX-->
                        <div class="resultmodal_valep" style="display:none;">
                            <p>Resultados</p>
                        </div>
                  
                         <div class="row rowspace">
                            <button type="button" class="btn btn-primary" id="btn_search_valep" onclick="ajaxbusqueda_valepANT()"> <span class="glyphicon glyphicon-search"></span> Buscar</button>
                           
                        </div>
                        </form> 
                    
                         
                  </div>
                  <div class="modal-footer">
                  <button type="submit" class="btn btn-default btn-sm" data-dismiss="modal"><span class="glyphicon"></span> Aceptar </button>
                   
                </div>
              </div>
            </div>  
            </div>
    
    
        <!-- Floating Button Google-->
        <div class="fixed-action-btn">
            <a class="btn-floating btn-large red">
              <i class="large material-icons">mode_edit</i>
            </a>
            <ul>
              <li><a class="btn-floating green" id="btn_add_producto" onclick="add_row()" title="Agregar Producto"><i class="material-icons">playlist_add</i></a></li>
              <li><a class="btn-floating blue" onclick="add_row_emp()" title="Agregar Empleado"><i class="material-icons">perm_identity</i></a></li>
              
            </ul>
          </div>
          
	<!-- USO JQUERY, animacion de menu para responsive-->
        
        <script type="text/javascript" src="../ws-admin/js/materialize.js"></script>
        <script src="../ws-admin/js/bootstrap.js"></script>
        <script type="text/javascript" src="functions.js"></script>
