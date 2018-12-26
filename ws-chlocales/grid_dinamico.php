<?php
require_once '../ws-admin/acceso_multi_db.php';
   
$db_empresa = getDataBase('009'); //009 WSSP DB


        $consulta_detalleschecks = "SELECT codItem, detalle FROM dbo.detalle_chlist ORDER BY id ASC";
        $result_detalleschecks = odbc_exec($db_empresa, $consulta_detalleschecks);
        $count_result = odbc_num_rows($result_detalleschecks);
        if ($count_result>=1){
            
            while(odbc_fetch_row($result_detalleschecks))
            {
                
                //RECUPERAR DATOS
                $cod_item = odbc_result($result_detalleschecks,"codItem");
                //Recodificacion de ISO-8859 a UTF
                $detalle_item = iconv("iso-8859-1", "UTF-8", odbc_result($result_detalleschecks,"detalle"));
               
                echo   '<div class="form-group">
                        <textarea class="form-control" name="txtarea_detalles[]" rows="1" id="'.$cod_item.'" maxlength="200">'.$detalle_item.'</textarea>
                        </div>';
                   
                }
       
            
        }