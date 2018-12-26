<div class="tab-pane fade" id="tab2"> <!-- Tab conocimientos-->
    <div class="row">  
         <div class="form-group col-lg-6">
            <label class="label">Numero de Conocimientos: </label>
            <input type="text" id="txt_numConocimientos" name="txt_numConocimientos" class="form-control centertext" value="1" required readonly>
        </div>

         <div class="form-group col-lg-6">
            <label class="label">Factor (%):</label>
            <input type="number" id="txt_factorConocimientos" name="txt_factorConocimientos" class="form-control centertext factor"  value="15" readonly>
        </div> 
    </div> 

    <div class="row row_conocimiento">  
        <div class="form-group col-lg-8 col-md-6 col-sm-12">
            <label class="label">Conocimientos: <em class="em">*</em></label>
            <input type="text" id="txt_conocimiento" name="txt_conocimiento[]" class="form-control centertext">
            
        </div>
        <div class="form-group col-lg-3 col-md-6 col-sm-12">
            <label class="label">Valor de Conocimientos: <em class="em">*</em></label>
            <select class="form-control seleccion_valConocimiento" name="seleccion_valConocimiento[]" id="seleccion_valConocimiento" required>
                <option value='0' selected disabled> Selecione por favor </option>
                <?php getOptionEscala5()?>
            </select>
        </div>
        <div class="form-group col-lg-1 col-md-12 col-sm-12">
            <label class="label">Borrar</label>
            <button type="button" class="btn btn-danger btn-block btn_remove_conocimiento" onclick="remove_extra_conocimiento(this)"> <span class="glyphicon glyphicon-remove"></span></button>
        </div>
    </div>
    
    <!-- Contenedor de Controles ajax-->

    <div class="result_add_conocimiento"></div> 

    
    <div class="row">  
        <div class="form-group col-lg-12 col-md-12 col-sm-12">
            <label class="label">Puntaje de Conocimientos: <em class="em">*</em></label>
            <input type="text" id="total_conocimientos" name="total_conocimientos" class="form-control centertext" value="0" readonly>
        </div>
    </div> 
    
</div>   <!--Fin Tab2-->