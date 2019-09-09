<?php
?>

<!-- Modal/Código de Seguridad-->
            <div class="modal fade" id="modalSeguridad" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static" data-keyboard="false" >
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel">Código de Seguridad para:</h5>
                    <h6 class="modal-title" id="myModalLabel_usuario">...</h6>
                    
                  </div>
                  <div class="modal-body">
                    
                    <div class="alert alert-info alert-dismissable">
                      <p id="modalresponse"> Asegúrese de ingresar su còdigo de seguridad de forma correcta o el registro no se llevarà a cabo.</p>
                    </div>
                    <div class="resultmodal" style="display:none;"></div>

                        <input type="password" class="form-control" id="cajacod" name="txt_codseguridadchk" maxlength="45" placeholder="Código de Seguridad" requiered>
                          
                  </div>
                  <div class="modal-footer">
                      <button type="button" class="btn btn-danger btn-sm" onclick="window.location.reload(true);">Reingresar CI</button>
                      <button type="button" class="btn btn-success btn-sm" id="btn_validarpass">Validar Código</button>
                      
                </div>
              </div>
            </div>  
            </div>