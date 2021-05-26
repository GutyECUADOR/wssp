    <?php include '../ws-admin/topnavBar.php'?>

        <div id="app" class="container">
		    <div class="wrap" style="max-width: 1000px;">
                <div class="row">
                    <div class="text-center">
                            <h3>{{ title }}</h3>
                            <h5>rev25.05.2021</h5>
                    </div>

                    <div class="text-center">
                        <img class="logo" src="../ws-admin/img/logo.png" alt="Logo" style="width:200px; margin-bottom: 20px;">
                    </div>
            
                </div>

                    
                    <form v-on:submit.prevent="saveDocumento" autocomplete="off">
                        
                        <div class="row">
                           <div class="col-md-12">
                                <div class="text-center">
                                    <label> Todos los campos son obligatorios. Recuerde verificar la información antes de registrar la solicitud.</label>
                                </div>

                                <div class="bs-callout bs-callout-primary">
                                    <h4>Información del Solicitante</h4>
                                    Ingrese su numero de cédula, indique a quien va dirigida la solicitud y el local.
                                </div>
                           </div>
                            
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Indique empresa:</label>
                                    <select class="form-control input-sm" v-model="documento.empresa" @change="getTiposDoc(); getBodegas()" required>
                                        <option value="">Seleccione por favor</option>
                                        <option v-for="item in empresas" :value="item.NameDatabase.trim()">
                                        {{item.Nombre}}
                                        </option>
                                    </select>
                                </div>
                                
                                <div class="form-group">
                                    <label>Indique el tipo de documento:</label>
                                    <select class="form-control input-sm"   required>
                                        <option value=''>Seleccione por favor</option>
                                        <option v-for="item in tiposDoc" :value="item.CODIGO.trim()">
                                            {{item.NOMBRE}}
                                        </option>
                                    </select>
                                </div>
                            </div>   
                        </div>
                                        
                                        
                        <div class="row">  
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Cédula del Solicitante:</label>
                                    <input type="text" class="form-control input-sm" v-model="documento.busqueda_solicitante" @keyup="getEmpleado()" required>
                                </div> 
                            </div>
                            
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Solicitante:</label>
                                    <input type="text" class="form-control input-sm" :value="documento.solicitante?.NOMBRE ? documento.solicitante.NOMBRE : 'Sin identificar'" readonly>
                                </div>
                            </div>
                                
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Bodega (Local):</label>
                                    <select class="form-control input-sm"  required>
                                        <option value=''>Seleccione por favor</option>
                                        <option v-for="item in bodegas" :value="item.CODIGO.trim()">
                                            {{item.NOMBRE}}
                                        </option>
                                    </select>    
                                    
                                </div>
                            </div>
                            
                        </div>    

                        <div class="bs-callout bs-callout-primary">
                            <h4>Productos Reportados</h4>
                        </div>
            

                        <!-- Lista de Productos Reportados -->
                        <div class="row">
                            <div class="col-md-12">
                                <div class="panel panel-default">
                                    <div class="panel-heading font-weight-bold clearfix">
                                        <i class="fa fa-list" aria-hidden="true"></i> Items reportados
                                        <div class="btn-group pull-right">
                                            <button type="button" @click="addNewProducto" class="btn btn-primary btn-sm"><i class="fa fa-plus" aria-hidden="true"></i> Agregar nuevo producto</button>
                                        </div>
                                    </div>
                                    <div class="panel-body">
                                        <div class="table-responsive">        
                                            <table class="table table-bordered table-hover table-condensed">
                                                <thead>
                                                    <tr>
                                                        <th class="text-center" style="width: 10%;" >Codigo</th>
                                                        <th class="text-center" style="width: 20%; min-width: 200px;">Nombre del Articulo</th>
                                                        <th class="text-center" style="width: 3%">Cantidad</th>
                                                        <th class="text-center" style="width: 5%; min-width: 100px;">Costo</th>
                                                        <th class="text-center" style="width: 5%; min-width: 80px;">Descuento</th>
                                                        <th class="text-center" style="width: 10%; min-width: 90px;">Subtotal</th>
                                                        <th class="text-center" style="width: 5%">Eliminar</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="tablaProductosEgreso">
                                                    <tr v-for="producto in documento.productos.items">
                                                        <td>
                                                            <div class="input-group input-group-sm">
                                                                <input type="text" class="form-control text-center" v-model="producto.codigo" @keyup="getProduco(producto)" placeholder="Código de producto">
                                                                <span class="input-group-btn">
                                                                    <button class="btn btn-default" type="button" data-toggle="modal" data-target="#modalBuscarProducto">
                                                                        <span class="glyphicon glyphicon-search" aria-hidden="true"></span>
                                                                    </button>
                                                                </span>
                                                            </div>
                                                        </td>
                                                        <td><input type="text" class="form-control text-center input-sm"  v-model="producto.nombre" readonly></td>
                                                        <td><input type="number" class="form-control text-center input-sm" @change="producto.setCantidad($event.target.value)" :value="producto.cantidad" step=".01" min="0"></td>
                                                        <td><input type="text" class="form-control text-center input-sm" v-model="producto.precio"></td>
                                                        <td><input type="number" class="form-control text-center input-sm" @change="producto.setDesuento($event.target.value)" :value="producto.descuento" step=".01" min="0"></td>
                                                        
                                                        
                                                        <td><input type="text" class="form-control text-center input-sm" v-model="producto.getSubtotal()" readonly></td>
                                                        <td><button type="button" @click="removeItem(producto)" class="btn btn-danger btn-sm btn-block"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></button>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <td colspan="2" class="text-center" style="vertical-align: middle;"><b>Total</b></td>
                                                        <td><input type="text" class="form-control text-center" readonly></td>
                                                        <td><input type="text" class="form-control text-center" readonly></td>
                                                        <td><input type="text" class="form-control text-center" readonly></td>
                                                        <td colspan="2">
                                                            <input type="text" class="form-control text-center" readonly></td>
                                                        </td>
                                                    </tr>

                                                </tfoot>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                                
                                                 
                        <div class="bs-callout bs-callout-primary">
                            <h4>Recargo a Empleados</h4>
                        </div>
                                
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Número de cuotas: <em class="em">*</em></label>
                                    <input type="number" name="select_numcuotas" class="form-control input-sm text-center" id="select_numcuotas" min="1" value="3" readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Fecha de Inicio de Pagos: <em class="em">*</em></label>
                                    <input type="text" id="date_pagosini" name="date_pagosini" class="form-control input-sm text-center" placeholder="Fecha Inicio Pagos" value="<?php echo date('Y-m-10')?>" readonly>
                                </div>
                            </div>
                        </div>
                             
                        <!-- Lista de Personal Reportado -->
                        <div class="row">
                            <div class="col-md-12">
                                <div class="panel panel-default">
                                    <div class="panel-heading font-weight-bold clearfix">
                                        <i class="fa fa-users" aria-hidden="true"></i> Personal Reportado
                                        <div class="btn-group pull-right">
                                            <button type="button" @click="addNewProducto()" class="btn btn-primary btn-sm"><i class="fa fa-plus" aria-hidden="true"></i> Agregar nuevo empleado</button>
                                        </div>
                                    </div>
                                    <div class="panel-body">
                                        <div class="responsibetable">        
                                            <table class="table table-bordered tableExtras">
                                                <thead>
                                                    <tr>
                                                        <th style="width: 10%;" class="text-center headerTablaProducto">Codigo</th>
                                                        <th style="width: 20%; min-width: 200px;" class="text-center headerTablaProducto">Nombre del Articulo</th>
                                                        <th style="width: 5%; min-width: 90px;" class="text-center headerTablaProducto">Stock</th>
                                                        <th style="width: 3%" class="text-center headerTablaProducto">Cantidad</th>
                                                        <th style="width: 5%; min-width: 80px;" class="text-center headerTablaProducto">Unidad</th>
                                                        <th style="width: 5%; min-width: 100px;" class="text-center headerTablaProducto">Costo</th>
                                                        <th style="width: 10%; min-width: 90px;" class="text-center headerTablaProducto">Subtotal</th>
                                                        <th style="width: 5%" class="text-center headerTablaProducto">Eliminar</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="tablaProductosEgreso">
                                                    <tr v-for="producto in documento.personalReportado">
                                                        <td><input type="text" class="form-control text-center input-sm" v-model="producto.codigo" disabled></td>
                                                        <td><input type="text" class="form-control text-center input-sm"  v-model="producto.nombre" readonly></td>
                                                        <td><input type="text" class="form-control text-center input-sm" v-model="producto.stock" disabled></td>
                                                        <td><input type="number" class="form-control text-center input-sm" @change="producto.setCantidad($event.target.value)" :value="producto.cantidad" step=".0001" min="0" oninput="validity.valid||(value=1);"></td>
                                                        <td>
                                                            <select v-model="producto.unidad" @change="getCostoProducto(producto)" class="form-control input-sm">
                                                                <option v-for="unidad in producto.unidades_medida" :value="unidad.Unidad.trim()">
                                                                {{unidad.Unidad}}
                                                                </option>
                                                            </select>
                                                        </td>
                                                        <td>
                                                            <input type="text" class="form-control text-center input-sm" v-model="producto.precio">
                                                        </td>
                                                        
                                                        <td><input type="text" class="form-control text-center input-sm" v-model="producto.getSubtotal()" readonly></td>
                                                        <td><button type="button" @click="removeEgresoItem(producto.codigo)" class="btn btn-danger btn-sm btn-block"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></button>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <td colspan="3" class="text-center" style="vertical-align: middle;"><b>Total</b></td>
                                                        <td><input type="text" class="form-control text-center" readonly></td>
                                                        <td><input type="text" class="form-control text-center" readonly></td>
                                                        <td><input type="text" class="form-control text-center" readonly></td>
                                                        <td colspan="2">
                                                            <input type="text" class="form-control text-center" readonly></td>
                                                        </td>
                                                    </tr>

                                                </tfoot>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
            
                                     
                        <div class="bs-callout bs-callout-primary">
                            <h4>Comentarios & Observaciones</h4>
                        </div>
                                    
                        <div class="col">
                            <textarea class="form-control cajaarea" name="txt_comentario" rows="3" cols="100%" maxlength="180"></textarea>
                            
                        </div> 
                    
                        <button type="submit" class="btn btn-primary btn-block" name="guardar"  id="btn-submit">Solicitar</button>
                
                    </form>
             
                    <div class="footer">Todos los derechos reservados © <?php echo date('Y');?>, Ver 2.0.0</div>
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
   
