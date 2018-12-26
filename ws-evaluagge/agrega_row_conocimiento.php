<?php require_once 'funcions.php';?>

<div class="row row_conocimiento">  
        <div class="form-group col-lg-8 col-md-6 col-sm-12">
            <label class="label">Conocimientos: <em class="em">*</em></label>
            <input type="text" id="txt_conocimiento" name="txt_conocimiento[]" class="form-control centertext">
       
            
        </div>
        <div class="form-group col-lg-3 col-md-6 col-sm-12">
            <label class="label">Valor de Conocimientos: <em class="em">*</em></label>
            <select class="form-control seleccion_valConocimiento" name="seleccion_valConocimiento[]" id="seleccion_valConocimiento" required>
                <option value='' selected disabled> Selecione por favor </option>
                <?php getOptionEscala5()?>
            </select>
        </div>
        <div class="form-group col-lg-1 col-md-12 col-sm-12">
            <label class="label">Borrar</label>
            <button type="button" class="btn btn-danger btn-block btn_remove_conocimiento" onclick="remove_extra_conocimiento(this)"> <span class="glyphicon glyphicon-remove"></span></button>
        </div>
    </div>