<div class="tab-pane fade" id="tab5"> <!-- Tab Trabajo en Equipo , Iniciativa Liderazgo-->
    <div class="row">  
        <div class="form-group col-lg-6">
            <label class="label">Numero de items: </label>
            <input type="text" id="txt_numTIL" name="txt_numTIL" class="form-control centertext" value="3" required readonly>
        </div>

         <div class="form-group col-lg-6">
            <label class="label">Factor (%):</label>
            <input type="number" id="txt_factorTIL" name="txt_factorTIL" class="form-control centertext factor" value="15" readonly>
        </div> 
    </div> 

    <div class="row row_TIL">  
        
        <div class="form-group col-lg-6">
            <label class="label">Descripción: <em class="em">*</em></label>
            <input type="text" name="descripcion_valTIL[]" class="form-control descripcion_valTIL centertext" value="Trabajo en Equipo" required readonly>
        </div>
        
        <div class="form-group col-lg-2">
            <label class="label">Relevancia: </label>
            <select name="seleccion_relevanciaTIL[]"  class="form-control seleccion_relevanciaTIL">
                <option value='0' selected disabled>Seleccione por favor</option>
                <option value='3'>Alta</option>
                <option value='2'>Media</option>
                <option value='1'>Baja</option>
            </select>
        </div>
        
        <div class="form-group col-lg-4">
            <label class="label">Frecuencia de Aplicación <em class="em">*</em></label>
            <select name="seleccion_valTIL[]"  class="form-control seleccion_valTIL itemTIL">
                <option value='' selected disabled>Seleccione por favor</option>
                <option value='5'>Siempre</option>
                <option value='4'>Frecuentemente</option>
                <option value='3'>Algunas veces</option>
                <option value='2'>Rara Vez</option>
                <option value='1'>Nunca</option>
            </select>
        </div>
        
        <div class="form-group col-lg-12">
            <label class="label">Comportamiento Observable </label>
            <input type="text" name="txt_observacionTIL[]" class="form-control centertext" value="(Sin descripcion del indicador)" readonly>
        </div>
        
    </div>
    
    <div class="row row_TIL">  
        
        <div class="form-group col-lg-6">
            <label class="label">Descripción: <em class="em">*</em></label>
            <input type="text" name="descripcion_valTIL[]" class="form-control descripcion_valTIL centertext" value="Iniciativa" required readonly>
        </div>
        
        <div class="form-group col-lg-2">
            <label class="label">Relevancia: </label>
            <select name="seleccion_relevanciaTIL[]" class="form-control seleccion_relevanciaTIL" >
                <option value='0' selected disabled>Seleccione por favor</option>
                <option value='3'>Alta</option>
                <option value='2'>Media</option>
                <option value='1'>Baja</option>
            </select>
        </div>
        
        <div class="form-group col-lg-4">
            <label class="label">Frecuencia de Aplicación <em class="em">*</em></label>
            <select name="seleccion_valTIL[]" class="form-control seleccion_valTIL itemTIL">
                <option value='' selected disabled>Seleccione por favor</option>
                <option value='5'>Siempre</option>
                <option value='4'>Frecuentemente</option>
                <option value='3'>Algunas veces</option>
                <option value='2'>Rara Vez</option>
                <option value='1'>Nunca</option>
            </select>
        </div>
        
        <div class="form-group col-lg-12">
            <label class="label">Comportamiento Observable </label>
            <input type="text" name="txt_observacionTIL[]" class="form-control centertext" value="(Sin descripcion del indicador)" readonly>
        </div>
        
    </div>

    <div class="row row_TIL">  
        
         <div class="form-group col-lg-8">
                    <p class="font-weight-normal text-center h6">¿ POSEE PERSONAL BAJO SU RESPONSABILIDAD DE GESTIÓN. ?</p>
                </div>
                
                <div class="form-group col-lg-4">
                     <select class="form-control" name="seleccion_tieneLiderazgo" id="seleccion_tieneLiderazgo" required>
                        <option value='0' selected >No</option>
                        <option value='1' >Si</option>
                    </select>
        </div>
        
        <div class="form-group col-lg-6">
            <label class="label">Descripción: <em class="em">*</em></label>
            <input type="text" name="descripcion_valTIL[]"  class="form-control descripcion_valTIL centertext" value="Liderazgo" readonly>
        </div>
        
        <div class="form-group col-lg-2">
            <label class="label">Relevancia:</label>
            <select name="seleccion_relevanciaTIL[]" class="form-control seleccion_relevanciaTIL">
                <option value='0' selected disabled>Seleccione por favor</option>
                <option value='3'>Alta</option>
                <option value='2'>Media</option>
                <option value='1'>Baja</option>
            </select>
        </div>
        
        <div class="form-group col-lg-4">
            <label class="label">Frecuencia de Aplicación <em class="em">*</em></label>
            <select name="seleccion_valTIL[]" id="seleccion_valTIL_liderazgo" class="form-control seleccion_valTIL itemTIL">
                <option value='' selected disabled>Seleccione por favor</option>
                <option value='5'>Siempre</option>
                <option value='4'>Frecuentemente</option>
                <option value='3'>Algunas veces</option>
                <option value='2'>Rara Vez</option>
                <option value='1'>Nunca</option>
            </select>
        </div>
        
        <div class="form-group col-lg-12">
            <label class="label">Comportamiento Observable </label>
            <input type="text" name="txt_observacionTIL[]" class="form-control centertext" value="(Sin descripcion del indicador)" readonly>
        </div>
        
    </div>
    
    <div class="row">  
        <div class="form-group col-lg-12">
            <label class="label">Puntaje de Trabajo, Iniciativa y Liderazgo: <em class="em">*</em></label>
            <input type="text" id="total_TIL" name="total_TIL" class="form-control centertext" value="0" readonly>
        </div>
    </div> 
</div>   <!--Fin Tab2-->