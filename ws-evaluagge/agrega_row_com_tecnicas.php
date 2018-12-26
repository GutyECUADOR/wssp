<?php require_once 'funcions.php';?>

<div class="row row_ComTecnicas">  
        
        <div class="form-group col-lg-6">
            <label class="label">Competencia: <em class="em">*</em></label>
            <select name="seleccion_competenciaTecnica[]" id="seleccion_competenciaTecnica" class="form-control seleccion_competenciaTecnica" required>
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
            <select name="seleccion_valcompetenciaTecnica[]" id="seleccion_valcompetenciaTecnica" class="form-control seleccion_valcompetenciaTecnica" required>
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