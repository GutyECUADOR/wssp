 <!-- Modal/Busqueda de Chelist realizados el dia actual-->
            <div class="modal fade" id="modalBusquedaChlist" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static" data-keyboard="false" >
              <div class="modal-dialog modal-lg">
                <div class="modal-content">
                  <div class="modal-header">
                      <h5 class="modal-title" id="myModalLabel">ChechList Realizados el dia <?php echo getDateNow()?></h5>
                   
                  </div>
                    <div class="modal-body">
                    
                        <div class="alert alert-warning alert-dismissable">
                          <button type="button" class="close" data-dismiss="alert">&times;</button>
                          <h5>¡ATENCIÓN!</h5><h5> Los checklist listados pertenecen a todas las bodegas de KAO, edite unicamente el de su bodega .</h5>
                        </div>
                        
                        
                        <div class="row">
                            <!--
                            <div class="form-group col-lg-4">
                                <label for="txt_CIRUC">Cédula/RUC</label>
                                <input type="text" class="form-control" id="txt_CIRUC" name="txt_CIRUC" placeholder="Ingrese CI o RUC (13 caracteres)" required>
                                <small id="txt_CIRUC" class="form-text text-muted">Ingrese cedula o RUC de cliente, empleado autorizado a realizar el registro.</small>
                            </div> 
                            -->
                            <div class="form-group col-lg-6">
                                <label for="select_Empresa">Seleccion de Empresa</label>
                                <select class="form-control" id="select_empresaModal" name="select_empresaModal" onchange="showSelectBodegasByElement(this.value,'select_bodegaModal')" required>
                                    <option value="">Seleccione por favor</option>
                                    <?php getEmpresasWF();?>
                                </select>
                            </div>

                            <div class="form-group col-lg-6">
                                <label for="select_Empresa">Seleccion de Bodega</label>
                                <select class="form-control" id="select_bodegaModal" name="select_bodegaModal" required>
                                    <option value="">Seleccione por favor</option>
                                </select>
                            </div>
                        
                        </div> <!-- FIN DEL ROW -->
                        
                        <div class="txtseccion">
                        <label class="etique"> RESULTADOS </label>
                        </div>
                        
                        <div class="resultmodal_chlocales table-responsive">
                                
                        </div>
                        
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" onclick="searchChklistDia()">Buscar</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    </div>
              </div>
            </div>  
            </div>
    