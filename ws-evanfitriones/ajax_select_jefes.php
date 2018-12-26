<?php
include_once ('../ws-admin/acceso_multi_db.php');

$select_codWF = $_GET['cod_WF'];

$conexion_vales = getDataBase($select_codWF); 

$consulta_bodega = "SELECT cedula, (nombre + apellido) as empleadoN FROM dbo.ROL_EMPLEADOS with (nolock) WHERE cargo = '03'";
$result_query = odbc_exec($conexion_vales, $consulta_bodega);

    if ($result_query){
        echo '<select type="text" id="cod_txt_empresa" name="cod_txt_empresa" required>';
        echo "<option value=''>---SELECCIONE POR FAVOR---</option>";
        while(odbc_fetch_row($result_query))
            {
                $cod_empleado = odbc_result($result_query,"cedula"); //SELECCION SOLO DE LOS EMPLEADOS DE LA EMPRESA 

                $nomb = odbc_result($result_query,"empleadoN");  
                $nombutf= iconv("iso-8859-1", "UTF-8", $nomb);

                echo "<option value='$cod_empleado'>$nombutf</option>";

            }

        echo '</select>';
    }else
    {
         echo '<select type="text" id="cod_txt_empresa" name="cod_txt_empresa" required>';
         echo "<option value=''>---SELECCIONE POR FAVOR---</option>";
         echo '</select>';
    }




