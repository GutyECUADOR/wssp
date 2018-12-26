<div class="tab-pane fade" id="tab4"> <!-- Tab Competencias Universales-->
    <div class="row">  
        <div class="form-group col-lg-6">
            <label class="label">Numero de Competencias Universales: </label>
            <input type="text" id="txt_numUniversales" name="txt_numUniversales" class="form-control centertext" value="1" required readonly>
        </div>

         <div class="form-group col-lg-6">
            <label class="label">Factor (%):</label>
            <input type="number" id="txt_factorUniversales" name="txt_factorUniversales" class="form-control centertext factor" value="15" readonly>
        </div> 
    </div> 

    <div class="row row_Universales">  
        
        <div class="form-group col-lg-6">
            <label class="label">Competencia: <em class="em">*</em></label>
            <select name="seleccion_competenciaUniversal[]" id="seleccion_competenciaUniversal" class="form-control seleccion_competenciaUniversal">
                <option value='' selected disabled>Seleccione por favor</option>
                <!-- Seleccione competencia desde listado de DB--> 
                <?php getCompetenciasUniversales();?>
            </select>
        </div>
        
        <div class="form-group col-lg-2">
            <label class="label">Relevancia: <em class="em">*</em></label>
            <select name="seleccion_relevanciacompetenciaUniversal[]" id="seleccion_relevanciacompetenciaUniversal" class="form-control seleccion_relevanciacompetenciaUniversal" required>
                <option value='0' selected disabled>Seleccione por favor</option>
                <option value='3'>Alta</option>
                <option value='2'>Media</option>
                <option value='1'>Baja</option>
            </select>
        </div>
        
        <div class="form-group col-lg-4">
            <label class="label">Frecuencia de Aplicación: <em class="em">*</em></label>
            <select name="seleccion_valcompetenciaUniversal[]" id="seleccion_valcompetenciaUniversal" class="form-control seleccion_valcompetenciaUniversal">
                <option value='0' selected disabled>Seleccione por favor</option>
                <option value='5'>Altamente Desarrolla</option>
                <option value='4'>Desarrolla</option>
                <option value='3'>Medianamente Desarrolla</option>
                <option value='2'>Poco Desarrolla</option>
                <option value='1'>No Desarrolla</option>
            </select>
        </div>
        
        <div class="form-group col-lg-12">
            <label class="label">Comportamiento Observable </label>
            <input type="text" id="txt_observacionUniversales[]" name="txt_observacionUniversales[]" class="form-control centertext" value="(Sin descripcion del indicador)" readonly>
        </div>
        
        <div class="form-group col-lg-12 centertext">
            <button type="button" class="btn btn-danger btn_remove_com_universal" onclick="remove_extra_universal(this)"> <span class="glyphicon glyphicon-remove"></span></button>
        </div>
        
    </div>
    
    <!-- Contenedor de Controles ajax-->

    <div class="result_add_ComUniversales"></div> 
    
    
    <div class="row">  
            <div class="form-group col-lg-12">
                <label class="label">Puntaje de Competencias Universales: <em class="em">*</em></label>
                <input type="text" id="total_competenciasUniversales" name="total_competenciasUniversales" class="form-control centertext" value="0" readonly>
            </div>
    </div> 
    
</div>   <!--Fin Tab4-->