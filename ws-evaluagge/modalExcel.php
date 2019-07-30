<!-- Modal Informes Excel -->
<div class="modal fade modal_left20" tabindex="-1" role="dialog" id="Modal_Excel_EJI">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title">Exportación a Excel (.xls)</h4>
            </div>
            <div class="modal-body">
                <form action="reportes/reporte_Excel.php" method="GET" class="form-inline">
                <div class="form-group">
                               <select class="form-control centertext" name="seleccion_empresa_excel" id="seleccion_empresa_excel" required="">
                                   <option value="">---SELECCIONE EMPRESA---</option>
                                    <?PHP 
                                    getSelectEmpresasWF()
                                    ?>
                                   
                               </select>
                              
                            <div class="rowspace input-group">
                                <input type="text" id="dateini_excel" name="dateini_excel" class="form-control centertext pickyDate"  placeholder="Fecha Inicial" required><span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                            </div>
                         
                            <div class="rowspace input-group">
                                <input type="text" id="datefin_excel" name="datefin_excel" class="form-control centertext pickyDate" placeholder="Fecha Final" required><span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                            </div>
                </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
              <button type="button" class="btn btn-primary"  id="btn_export_excel"><span class="glyphicon glyphicon-export"></span> Exportar</button>
            </div>
            </form>    
          </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->