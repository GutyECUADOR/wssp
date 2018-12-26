<?php
include_once ('../ws-admin/acceso_multi_db.php');

$conexion_vales = getDataBase(008);
$documento_id = $_POST['doc_id'];

    $consulta_ven_mov = "SELECT * FROM VEN_MOV with (nolock) where ID = '$documento_id'";
    $result_query = odbc_exec($conexion_vales, $consulta_ven_mov);
    $count_result = odbc_num_rows($result_query);

    while(odbc_fetch_row($result_query))
        {
         //RECUPERAR DATOS
        $cod_producto = odbc_result($result_query,"CODIGO"); //Char(20)
        $detall_producto = "Sin detalle";
        $cantidad_producto = round(odbc_result($result_query,"CANTIDAD"),0); //float
        $descuporcent_producto = round(odbc_result($result_query, "DESCU"), 2);
        $precio_producto = round(odbc_result($result_query,"PRECIO"),2); //numeric (18,6)
        $total_producto = round(odbc_result($result_query,"PRECIOTOT"),2); ////money
        
        
        $consulta_sql = "SELECT Codigo, Nombre, PrecA FROM dbo.INV_ARTICULOS WHERE Codigo='$cod_producto'";
        $result_query_sql = odbc_exec($conexion_vales, $consulta_sql);
        $product_nombre = iconv("iso-8859-1", "UTF-8", odbc_result($result_query_sql,"Nombre"));
        
        echo ' 
            <div id="bloque" name="row_productos[]">
            <div class="input-group cod_p">
                <label class="label">Código: <em class="em">*</em></label>
                <input type="text" value="'.rtrim($cod_producto," ").'" class="centrado rowproducto" name="txt_cod_product[]" readonly>
            </div>
             <div class="input-group cod_detalle">
                <label class="label">Producto:</label>
                <input type="text" value="'.trim($product_nombre," ").'" class="centrado" name="txt_detalle_product[]" readonly>
             </div>

             <div class="input-group cod_cantidad">
                <label class="label">Cantidad: <em class="em">*</em></label>
                <input type="number" value="'.$cantidad_producto.'" class="centrado rowcantidad" name="txt_cant_product[]" readonly>
             </div>
             
            <div class="input-group cod_descuento">
                <label class="label">% Descuento:</label>
                <input type="text" value="'.$descuporcent_producto.'" class="centrado" name="txt_descuento[]" value="0" readonly>
            </div>


             <div class="input-group cod_precio">
                <label class="label">Precio:</label>
                <input type="text" value="'.$total_producto.'" class="centrado importe_linea" name="txt_precio_product[]" readonly>
                <input type="hidden" value="'.$precio_producto.'" name="hidden_precio_product[]">
             </div>
             
        </div>
            ';
        }