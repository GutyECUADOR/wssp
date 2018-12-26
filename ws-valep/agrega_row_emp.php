<?php

    echo ' 
        <div id="bloque" name="row_empleados[]">
        <div class="input-group recargo_ci">
            <label class="label">Cédula: <em class="em">*</em></label>
            <input type="text" class="centrado rowempleado" onkeyup="ajaxvalidaemp(this);valor_porcentaje();empleadoRepetido(this)" name="txt_ci_empleado[]" id="txt_ci_empleado[]" required>
        </div>
         <div class="input-group recargo_empleado">
            <label class="label">Empleado:</label>
            <input type="text" class="centrado row_deusuario" name="txt_nombre_emp[]" readonly>
             <input type="hidden" name="txt_hiddenwinf_emp[]">
         </div>

         <div class="input-group recargo_porcent">
            <label class="label">%: <em class="em">*</em></label>
            <input type="text" class="centrado valporcent" name="txt_porcent_emp[]" onkeyup="valor_porcentaje_manual()" onchange="valida_porcentaje_manual();" value="0" required>
         </div>
         <div class="input-group recargo_valor">
            <label class="label">Valor:</label>
            <input type="text" class="centrado importe_linea_emp" name="txt_valor_emp[]" value="0" readonly>
            <input type="hidden" name="hidden_valor_emp[]">
         </div>
         <div class="input-group icon_remove">
            <a id="removeprod_ico_emp" class="pointerico_ico"><span class="glyphicon glyphicon-remove removeprod_ico_emp" title="Eliminar Item" onclick="remove_emp(this)"></span></a>
        </div>
    </div>
        ';
