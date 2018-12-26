<?php
include_once ('../ws-admin/acceso_multi_db.php');

$select_codWF = $_GET['cod_WF'];
$var_excluyente = "";//$_GET['excluyente'];

$conexionEmpresa = getDataBase($select_codWF); //Cod 008 Empresa MODELO

$consulta_supervisores = "SELECT CODIGO, NOMBRE FROM dbo.VEN_TIPOS with (nolock)WHERE Codigo IN ('SPA','SPB','SPC','SPD','SPE','SPF') ORDER BY CODIGO ";
$result_query = odbc_exec($conexionEmpresa, $consulta_supervisores);


    if ($result_query){
        echo '<select name="select_dirigidoa" id="select_dirigidoa" required>';
        echo "<option value=''>---SELECCIONE POR FAVOR---</option>";
        while(odbc_fetch_row($result_query))
            {
                $cod_empleado = odbc_result($result_query,"CODIGO"); 
                $nomb = odbc_result($result_query,"NOMBRE");  
                $nombutf= iconv("iso-8859-1", "UTF-8", $nomb);

                echo "<option value='$cod_empleado'> $cod_empleado - $nombutf</option>";

            }

        echo '</select>';
    }else
    {
         echo '<select type="text" id="cod_txt_empresa" name="cod_txt_empresa" required>';
         echo "<option value=''>---SELECCIONE POR FAVOR---</option>";
         echo '</select>';
    }




