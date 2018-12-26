<?php
include_once ('../ws-admin/acceso_multi_db.php');

$select_codWF = $_GET['cod_WF'];

$conexion_vales = getDataBase($select_codWF); 

$consulta_bodega = "SELECT CODIGO, NOMBRE FROM dbo.INV_BODEGAS as A INNER JOIN KAO_wssp.dbo.chlist_locales as B on A.CODIGO COLLATE Modern_Spanish_CI_AS = B.local COLLATE Modern_Spanish_CI_AS WHERE empresa='$select_codWF' GROUP BY A.CODIGO, A.NOMBRE";
$result_query = odbc_exec($conexion_vales, $consulta_bodega);

    if ($result_query){
        echo '<select class="form-control centertext" name="seleccion_empresa_chlocales" id="seleccion_tipodoc" onchange="showselectLocalesNoModal()" required>';
        echo "<option value=''>---SELECCIONE POR FAVOR---</option>";
        while(odbc_fetch_row($result_query))
            {
                $codigo = odbc_result($result_query,"CODIGO"); //SELECCION SOLO DE LOS EMPLEADOS DE LA EMPRESA 
                $descipcion = iconv("iso-8859-1", "UTF-8",odbc_result($result_query,"NOMBRE"));  
               
                echo "<option value='$codigo'>$codigo - $descipcion</option>";

            }

        echo '</select>';
    }else
    {
         echo '<select class="form-control centertext" name="seleccion_empresa_chlocales" id="seleccion_tipodoc" onchange="showselectLocalesNoModal()" required>';
         echo "<option value=''>---SELECCIONE POR FAVOR---</option>";
         echo '</select>';
    }




