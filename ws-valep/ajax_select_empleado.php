<?php
include_once ('../ws-admin/acceso_multi_db.php');

$select_codWF = $_GET['cod_WF'];
$var_excluyente = //$_GET['excluyente'];

$conexion_vales = getDataBase($select_codWF); //Cod 008 Empresa MODELO

$consulta_bodega = "SELECT CODIGO, NOMBRE FROM dbo.INV_BODEGAS";
$result_query = odbc_exec($conexion_vales, $consulta_bodega);

    if ($result_query){
        echo '<select type="text" id="cod_txt_empresa" name="cod_txt_empresa" required>';
        echo "<option value=''>---SELECCIONE POR FAVOR---</option>";
        while(odbc_fetch_row($result_query))
            {
                $cod_empresa = odbc_result($result_query,"CODIGO"); //SELECCION SOLO DE LOS EMPLEADOS DE LA EMPRESA 

                $nomb = odbc_result($result_query,"NOMBRE");  
                $nombutf= iconv("iso-8859-1", "UTF-8", $nomb);

                echo "<option value='$cod_empresa'>$nombutf</option>";

            }

        echo '</select>';
    }else
    {
         echo '<select type="text" id="cod_txt_empresa" name="cod_txt_empresa" required>';
         echo "<option value=''>---SELECCIONE POR FAVOR---</option>";
         echo '</select>';
    }




