<?php
include_once ('../ws-admin/acceso_multi_db.php');

$select_codWF = $_GET['cod_WF'];

$conexion_vales = getDataBase($select_codWF); 

$consulta_bodega = "SELECT CODIGO, NOMBRE FROM dbo.INV_BODEGAS as A INNER JOIN KAO_wssp.dbo.chlist_locales as B on A.CODIGO COLLATE Modern_Spanish_CI_AS = B.local COLLATE Modern_Spanish_CI_AS WHERE empresa='$select_codWF' GROUP BY A.CODIGO, A.NOMBRE";
$result_query = odbc_exec($conexion_vales, $consulta_bodega);

    if ($result_query){
        echo '<select type="text" id="cod_txt_empresa" name="cod_txt_empresa" required>';
        echo "<option value=''>---SELECCIONE POR FAVOR---</option>";
        while(odbc_fetch_row($result_query))
            {
                $codigo = odbc_result($result_query,"CODIGO"); //SELECCION SOLO DE LOS EMPLEADOS DE LA EMPRESA 
                $descipcion = odbc_result($result_query,"NOMBRE");  
               
                echo "<option value='$codigo'>$descipcion - $codigo</option>";

            }

        echo '</select>';
    }else
    {
         echo '<select type="text" id="cod_txt_empresa" name="cod_txt_empresa" required>';
         echo "<option value=''>---SELECCIONE POR FAVOR---</option>";
         echo '</select>';
    }




