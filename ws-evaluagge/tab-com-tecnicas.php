<div class="tab-pane fade" id="tab3"> <!-- Tab Competencias Técnicas del Puesto-->
    <div class="row">  
        <div class="form-group col-lg-6">
            <label class="label">Numero de Competencias Ténicas: </label>
            <input type="text" id="txt_numComTecnicas" name="txt_numComTecnicas" class="form-control centertext" value="1" required readonly>
        </div>

         <div class="form-group col-lg-6">
            <label class="label">Factor (%):</label>
            <input type="number" id="txt_factorComTecnicas" name="txt_factorComTecnicas" class="form-control centertext factor" value="15" readonly>
        </div> 
    </div> 

    <div class="row row_ComTecnicas">  
        
        <div class="form-group col-lg-6">
            <label class="label">Competencia: <em class="em">*</em></label>
            <select name="seleccion_competenciaTecnica[]" id="seleccion_competenciaTecnica" class="form-control seleccion_competenciaTecnica">
                <option value='' selected disabled>Seleccione por favor</option>
                <!-- Seleccione competencia desde listado de DB--> 
                <?php getCompetenciasTecnicas();?>
            </select>
        </div>
        
        <div class="form-group col-lg-2">
            <label class="label">Relevancia: <em class="em">*</em></label>
            <select name="seleccion_relevanciacompetenciaTecnica[]" id="seleccion_relevanciacompetenciaTecnica" class="form-control seleccion_relevanciacompetenciaTecnica" required>
                <option value='0' selected disabled>Seleccione por favor</option>
                <option value='3'>Alta</option>
                <option value='2'>Media</option>
                <option value='1'>Baja</option>
            </select>
        </div>
        
        <div class="form-group col-lg-4">
            <label class="label">Nivel que desarrolla: <em class="em">*</em></label>
            <select name="seleccion_valcompetenciaTecnica[]" id="seleccion_valcompetenciaTecnica" class="form-control seleccion_valcompetenciaTecnica">
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
            <input type="text" id="txt_observacionComTecnicas[]" name="txt_observacionComTecnicas[]" class="form-control centertext" value="(Sin descripcion del indicador)" readonly>
        </div>
        
        <div class="form-group col-lg-12 centertext">
            <button type="button" class="btn btn-danger btn_remove_com_tecnica" onclick="remove_extra_ComTecnica(this)"><span class="glyphicon glyphicon-remove"></span></button>
        </div>
        
    </div>
    
    <!-- Contenedor de Controles ajax-->

    <div class="result_add_ComTecnicas"></div> 
    
    <div class="row">  
            <div class="form-group col-lg-12">
                <label class="label">Puntaje de Competencias Técnicas del Puesto: <em class="em">*</em></label>
                <input type="text" id="total_com_tenicas" name="total_com_tenicas" class="form-control centertext" value="0" readonly>
            </div>
    </div> 
    
</div>   <!--Fin Tab2-->