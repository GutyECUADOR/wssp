<?php require_once 'funcions.php';?>

<div class="row row_Universales">  
        
        <div class="form-group col-lg-6">
            <label class="label">Competencia: <em class="em">*</em></label>
            <select name="seleccion_competenciaUniversal[]" id="seleccion_competenciaUniversal" class="form-control seleccion_competenciaUniversal" required>
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
            <select name="seleccion_valcompetenciaUniversal[]" id="seleccion_valcompetenciaUniversal" class="form-control seleccion_valcompetenciaUniversal" required>
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