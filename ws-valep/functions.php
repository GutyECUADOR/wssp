<?php
require_once '../ws-admin/acceso_multi_db.php';

function getTiposDocByDB($idDB){
        $db_empresa = getDataBase($idDB); 
        $query = "SELECT CODIGO, NOMBRE FROM dbo.VEN_TIPOS with (nolock)WHERE Codigo IN ('SPA','SPB','SPC','SPD','SPE','SPF') ORDER BY CODIGO";
        $resultset = odbc_exec($db_empresa, $query);

        echo '<option value="PND"> Todos los vales pendientes</option>';
        
        while(odbc_fetch_row($resultset))
        {
            $cod_empleado = odbc_result($resultset,"CODIGO"); 
            $nomb = odbc_result($resultset,"NOMBRE");  
            $nombutf= iconv("iso-8859-1", "UTF-8", $nomb);

            echo "<option value='$cod_empleado'> $cod_empleado - $nombutf</option>";

        }
        echo '<option value="ANUL"> Todos los Vales Anulados/Negados</option>';
    }
