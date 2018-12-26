<?php require_once 'funcions.php'; ?>

<div class="row row_esencial">  
    <div class="form-group col-lg-12 col-md-6 col-sm-12">
        <label class="label">Descripcion de Actividades: <em class="em">*</em></label>
        <select class="form-control" name="txt_descActividades[]" required>
            <option value='' selected disabled>Seleccione por favor</option>
            <?php getActividadesEsenciales();?>
        </select>

    </div>

    <div class="form-group col-lg-4 col-md-6 col-sm-12">
        <label class="label">Indicador:</label>
         <select class="form-control" name="seleccion_indicador[]" id="seleccion_empleado">
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
        <input type="text" name="txt_nivel_esencial[]" class="form-control centertext" required readonly>
        <input type="hidden" class="itemfactor" name="txt_valorfac_esencial[]">
    </div>

    <div class="form-group col-lg-12 col-md-12 col-sm-12 centertext">
                    <button type="button" class="btn btn-danger btn_remove_esencial" onclick="remove_extra_esencial(this)"><span class="glyphicon glyphicon-remove"></span></button>
    </div>
</div> 