<?php

    echo ' 
        <div id="bloque" name="row_productos[]">
        <div class="input-group cod_p">
            <label class="label">Código: <em class="em">*</em></label>
            <input type="text" class="centrado rowproducto" onkeyup="ajaxvalidacod_producto(this);productoRepetido(this)" onblur="calcular_total();valor_porcentaje()" name="txt_cod_product[]" required>
        </div>
         <div class="input-group cod_detalle">
            <label class="label">Producto:</label>
            <input type="text" class="centrado row_deproducto" name="txt_detalle_product[]" readonly>
         </div>

         <div class="input-group cod_cantidad">
            <label class="label">Cantidad: <em class="em">*</em></label>
            <input type="number" class="centrado rowcantidad" name="txt_cant_product[]" onclick="extra_prod(this);calcular_total();valor_porcentaje()" onkeyup="extra_prod(this);calcular_total();valor_porcentaje()" required>
         </div>
         
        <div class="input-group cod_descuento">
            <label class="label">Descuento:</label>
            <input type="text" class="centrado" name="txt_descuento[]" value="0" readonly>
        </div>

         <div class="input-group cod_precio">
            <label class="label">Precio:</label>
            <input type="text" class="centrado importe_linea" name="txt_precio_product[]" value="0" onkeyup="calcular_total();valor_porcentaje()" onkeypress="return valida_numeros(event)" readonly>
            <input type="hidden" name="hidden_precio_product[]">
         </div>
         <div class="input-group icon_remove">
            <a id="removeprod_ico" class="pointerico_ico"><span class="glyphicon glyphicon-remove removeprod_ico" title="Eliminar Item" onclick="remove_extra_prod(this);valor_porcentaje()"></span></a>
        </div>

    </div>
        ';
