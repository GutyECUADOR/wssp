<?php require_once 'funcions.php';?>

<div class="row row_relClienteInterno">  
        
        <div class="form-group col-lg-4">
                <label class="label">Departamento que realiza la queja <em class="em">*</em></label>
                <select name="select_descrelClienteInteno[]" id="select_descrelClienteInteno" class="form-control seleccion_competenciaUniversal" required>
                <option value='' selected disabled>Seleccione por favor</option>
                    <!-- Seleccion desde listado de DB--> 
                    <?php getDepartamentos();?>
                </select>
                
        </div>
        
        <div class="form-group col-lg-3">
                <label class="label">Fecha de queja <em class="em">*</em></label>
                <input type="text" id="txt_fecharelClienteInteno" name="txt_fecharelClienteInteno[]"  class="form-control centertext pickyDate"  placeholder="Fecha de Queja">  
        </div>
        
        <div class="form-group col-lg-3">
            <label class="label">Aplica Descuento<em class="em">*</em></label>
            <select name="seleccion_valrelClienteInterno[]" id="seleccion_valrelClienteInterno" class="form-control seleccion_valrelClienteInterno">
                <option value=''> No aplica</option>
                <option value='1'>Aplica</option>
            </select>
        </div>
        
        <div class="form-group col-lg-2">
                <label class="label">Puntos <em class="em">*</em></label>
                <input type="number" name="txt_reduccionPtsClienteInterno[]" min="0" class="form-control txt_reduccionPtsClienteInterno centertext ">  
        </div>
        
        <div class="form-group col-lg-12">
            <label class="label">Observacion </label>
            <input type="text" id="txt_observacionrelClienteInterno[]" name="txt_observacionrelClienteInterno[]" maxlength="100" class="form-control centertext">
        </div>
        
        <div class="form-group col-lg-12 col-md-12 col-sm-12 centertext">
            <button type="button" class="btn btn-danger"> <span class="glyphicon glyphicon-remove btn_remove_queja" onclick="remove_extra_queja(this)"></span></button>
        </div>
        
    </div>
    