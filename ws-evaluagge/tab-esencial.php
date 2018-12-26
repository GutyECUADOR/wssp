        <div class="tab-pane fade in active" id="tab1">

            <div class="row">
                <div class="form-group col-lg-6">
                    <label class="label">Actividades: <em class="em">*</em></label>
                    <input type="text" id="txt_numActividadesEsenciales" name="txt_numActividadesEsenciales[]" class="form-control centertext" value="1" required readonly>
                </div>

                <div class="form-group col-lg-6">
                    <label class="label">Factor (%):</label>
                    <input type="number" id="txt_factorActividades" name="txt_factorActividades" class="form-control centertext factor"  value="30" readonly>
                 </div>
            </div>   

            <div class="row row_esencial">  
                <div class="form-group col-lg-12 col-md-6 col-sm-12">
                    <label class="label">Descripcion de Actividades: <em class="em">*</em></label>
                    <select class="form-control" name="txt_descActividades[]" >
                        <option value='' selected disabled>Seleccione por favor</option>
                        <?php getActividadesEsenciales();?>
                    </select>
                    
                </div>

                <div class="form-group col-lg-4 col-md-6 col-sm-12">
                    <label class="label">Indicador:</label>
                     <select class="form-control" name="seleccion_indicador[]" id="seleccion_indicador">
                        <option value='' selected disabled>Seleccione por favor</option>
                        <?php getOptionEscalaSimple();?>
                    </select>
                </div>

                <div class="form-group col-lg-2 col-md-6 col-sm-12">
                    <label class="label">Meta :</label>
                    <input type="number" name="txt_nummeta_esencial[]" class="form-control centertext txt_nummeta_esencial">
                </div> 
                 <div class="form-group col-lg-2 col-md-6 col-sm-12">
                    <label class="label">Cumplidos:</label>
                    <input type="number" name="txt_numcumplidos_esencial[]" class="form-control centertext txt_numcumplidos_esencial">
                </div> 
                <div class="form-group col-lg-2 col-md-6 col-sm-12">
                    <label class="label">% Cumplido</label>
                    <input type="number" name="txt_cumplido_esencial[]" class="form-control centertext porcentcumplido" readonly>
                </div> 
                 <div class="form-group col-lg-2 col-md-6 col-sm-12">
                    <label class="label">Nivel</label>
                    <input type="text" name="txt_nivel_esencial[]" class="form-control centertext" readonly>
                    <input type="hidden" class="itemfactor" name="txt_valorfac_esencial[]">
                </div>
                
                <div class="form-group col-lg-12 col-md-12 col-sm-12 centertext">
                    <button type="button" class="btn btn-danger btn_remove_esencial" onclick="remove_extra_esencial(this)"><span class="glyphicon glyphicon-remove"></span></button>
                </div>
            </div> 

            <!-- Contenedor de Controles ajax-->

            <div class="result_add_asencial"></div> 

            
            
            
            <div class="row">  
                
                <div class="form-group col-lg-8 col-md-12 col-sm-12">
                    <p class="font-weight-normal text-center h6">¿ A más del cumplimiento de la totalidad de metas y objetivos se sobrepasó y cumplió con objetivos y metas previstas para el siguiente período de evaluación ?</p>
                </div>
                
                <div class="form-group col-lg-4 col-md-6 col-sm-12">
                    <label class="label">Aplica aumento del 4%:</label>
                     <select class="form-control" name="seleccion_4porcentextra" id="seleccion_4porcentextra" required>
                        <option value='0' selected >No</option>
                        <option value='1' >Si</option>
                    </select>
                </div>
                
                <div class="form-group col-lg-12 col-md-12 col-sm-12">
                    <label class="label">Puntaje de Actividades Esenciales : <em class="em">*</em></label>
                    <input type="text" id="total_ActEsenciales" name="total_ActEsenciales" class="form-control centertext" value="0" readonly>
                </div>
            </div> 

        </div>  <!--Fin Tab1-->