 <!-- Modal/Código de Seguridad-->
            <div class="modal fade" id="modalcodigo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static" data-keyboard="false" >
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel">Código de Seguridad para:</h5>
                    <h6 class="modal-title" id="myModalLabel_usuario">...</h6>
                    
                  </div>
                    <div class="modal-body">
                    
                        <div class="alert alert-info alert-dismissable">
                          <button type="button" class="close" data-dismiss="alert">&times;</button>
                          <h5>¡IMPORTANTE!</h5><p> Asegúrese de ingresar su còdigo de seguridad de forma correcta o el registro no se llevarà a cabo.</p>
                        </div>
                        <div class="resultmodal" style="display:none;"></div>

                        <input type="text" id="cajacod" name="txt_codseguridadchk" maxlength="45" placeholder="Código de Seguridad" requiered>
                          
                    </div>
                    <div class="modal-footer">
                            <button type="button" class="btn btn-default btn-sm" data-dismiss="modal" id="aceptar_modal1" disabled="disabled">Aceptar </button>
                            <button type="button" class="btn btn-warning btn-sm" id="btn_validarpass" onclick="window.location.reload(true);">Reingresar CI</button>
                            <button type="button" class="btn btn-info btn-sm" id="btn_validarpass" onclick="ajaxvalidacod_seguridad()">Validar Código</button>
                           
                    </div>
              </div>
            </div>  
            </div>
    