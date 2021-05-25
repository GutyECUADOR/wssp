    <?php include '../ws-admin/topnavBar.php'?>

        <div id="app" class="container-fluid">
		    <div class="wrap">
                    <div class="text-center">
                            <h5>{{ title }}</h5>
                            <h6>rev13.09.17</h6>
                    </div>

                    <div class="text-center">
                        <img class="logo" src="../ws-admin/img/logo.png" alt="Logo" style="width:200px">
                    </div>
            
                    <form v-on:submit.prevent="saveDocumento" autocomplete="off">
                        
                    
                                <div class="text-center">
                                    <label> Los campos con (*) son obligatorios y deben contener información verídica. Recuerde al finalizar validar campos de seguridad.</label>
                                </div>
                            
                            
                                <div class="txtseccion">
                                    <label class="etique"> INFORMACIÓN DEL SOLICITANTE</label>
                                </div>
                                
                                <div class="col">
                                    <div class="form-group">
                                        <label>Indique empresa:</label>
                                        <select class="form-control input-sm" v-model="documento.empresa" @change="getTiposDoc(); getBodegas()" required>
                                            <option value="">Seleccione por favor</option>
                                            <option v-for="item in empresas" :value="item.NameDatabase">
                                            {{item.Nombre}}
                                            </option>
                                        </select>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label>Indique el tipo de documento:</label>
                                        <select class="form-control input-sm"   required>
                                            <option value=''>Seleccione por favor</option>
                                            <option v-for="item in tiposDoc" :value="item.CODIGO">
                                                {{item.NOMBRE}}
                                            </option>
                                        </select>
                                    </div>
                                </div>        
                                        
                                <div class="row">  
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>CI del Solicitante:</label>
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
                                            <label>Bodega (Local):</label>
                                            <select class="form-control input-sm"  required>
                                                <option value=''>Seleccione por favor</option>
                                                <option v-for="item in bodegas" :value="item.CODIGO">
                                                    {{item.NOMBRE}}
                                                </option>
                                            </select>    
                                            
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
                                        <div class="table-responsive">        
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
                                        <label>Indique numero de cuotas: <em class="em">*</em></label>
                                        <input type="number" name="select_numcuotas" class="form-control input-sm text-center" id="select_numcuotas" min="1" value="3" readonly required>
                                    </div>
                                    <div class="form-group">
                                        <label>Indique Fecha de Inicio de Pagos: <em class="em">*</em></label>
                                        <input type="text" id="date_pagosini" name="date_pagosini" class="form-control input-sm text-center" placeholder="Fecha Inicio Pagos" value="<?php echo date('Y-m-10')?>" readonly required>
                                    </div>
                                </div>


                                <!-- Tabla de Empleados -->
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="table-responsive">        
                                            <table class="table table-bordered table-condensed">
                                                <thead>
                                                    <tr>
                                                        <th class="text-center" style="width: 10%;" >Cédula</th>
                                                        <th class="text-center" style="width: 20%; min-width: 200px;">Nombre del Empleado</th>
                                                        <th class="text-center" style="width: 3%">%</th>
                                                        <th class="text-center" style="width: 5%; min-width: 100px;">Valor</th>
                                                        <th class="text-center" style="width: 5%">Eliminar</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr name="row_empleados[]">
                                                        <td>
                                                        <input type="text" class="form-control input-sm text-center rowempleado" onkeyup="ajaxvalidaemp(this);valor_porcentaje();empleadoRepetido(this)" name="txt_ci_empleado[]" id="txt_ci_empleado[]" required>
                                                        </td>
                                                        <td>
                                                            <input type="text" class="form-control input-sm text-center row_deusuario" name="txt_nombre_emp[]" readonly>
                                                            <input type="hidden" name="txt_hiddenwinf_emp[]">
                                                        </td>
                                                        <td>
                                                            <input type="text" class="form-control input-sm text-center valporcent" name="txt_porcent_emp[]" onkeyup="valor_porcentaje_manual()" onchange="valida_porcentaje_manual();" value="0" required>
                                                        </td>
                                                        <td>
                                                            <input type="text" class="form-control input-sm text-center importe_linea_emp" name="txt_valor_emp[]" value="0" readonly>
                                                            <input type="hidden" name="hidden_valor_emp[]">
                                                        </td>
                                                        <td>
                                                            <button type="button" onclick="remove_emp(this)" class="btn btn-danger btn-sm btn-block"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></button>

                                                        </td>
                                                        
                                                    </tr>
                                                        <!-- Contenedor de Controles ajax-->
                                                    <div class="result_emp_add"> 
                                                    </div>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
            
            
                                    <!--SECCION DETALLE-->                     
                                <div class="txtseccion">
                                    <label class="etique"> COMENTARIO / OBSERVACION</label>
                                </div>
                                    
                                    <div class="col">
                                        <textarea class="form-control cajaarea" name="txt_comentario" rows="3" cols="100%" maxlength="180"></textarea>
                                        
                                    </div> 
                                
                                <button type="submit" class="btn btn-primary btn-block" name="guardar"  id="btn-submit">Solicitar</button>
                
                    </form>
             
                    <div class="footer">Todos los derechos reservados © 2017, Ver 2.0.0</div>
            </div>
            
            <!-- Floating Button-->
            <div class="fixed-action-btn">
                <a class="btn-floating btn-large red">
                <i class="large material-icons">mode_edit</i>
                </a>
                <ul>
                <li><a class="btn-floating green" id="btn_add_producto" onclick="add_row()" title="Agregar Producto"><i class="material-icons">playlist_add</i></a></li>
                <li><a class="btn-floating blue" onclick="add_row_emp()" title="Agregar Empleado"><i class="material-icons">perm_identity</i></a></li>
                
                </ul>
            </div>
            
	    </div>
    

	<!-- USO JQUERY, animacion de menu para responsive-->
        
    <script type="text/javascript" src="sweetalert-master/dist/sweetalert.min.js"></script>
    <script type="text/javascript" src="../ws-admin/js/jquery-latest.js"></script>
    <script type="text/javascript" src="../ws-admin/js/materialize.js"></script>
    <script type="text/javascript" src="../libs/bootstrap-datepicker-1.6.4/js/bootstrap-datepicker.js"></script>
    <script type="text/javascript" src="../libs/bootstrap-datepicker-1.6.4/locales/bootstrap-datepicker.es.min.js"></script>
    <script type="text/javascript" src="../libs/vue.js"></script>
    <script type="text/javascript" src="../ws-admin/js/myJS.js"></script>  <!-- JS datepicker Boostrap3-->
    <script type="text/javascript" src="../ws-admin/js/bootstrap.js"></script>
    <script type="text/javascript" src="valesPerdida.js?<?php echo date('Ymdhiiss')?>"></script>
   
