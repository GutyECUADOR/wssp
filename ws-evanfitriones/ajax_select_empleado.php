<?php
include('../ws-admin/acceso_db_sbio.php');

$select_codWF = $_GET['cod_WF'];
$var_excluyente = $_GET['excluyente'];

$consulta_empleado = "SELECT * FROM dbo.Empleados with (nolock) WHERE TipoCargo != 4 and Nombre != 'ADMIN' and Estatus='A' and CodDpto<>'EVA' ORDER BY Apellido";
$result_query = odbc_exec($conexion_sbio, $consulta_empleado);
echo '<select class="form-control" id="select_Empleado" name="select_Empleado" onchange="valida_cargo()" required>';
        echo "<option value=''>---SELECCIONE POR FAVOR---</option>";
	while(odbc_fetch_row($result_query))
    {
	$cod_empresa = odbc_result($result_query,"Empresa_WF"); //SELECCION SOLO DE LOS EMPLEADOS DE LA EMPRESA 
        $cod_empleado = odbc_result($result_query,"Codigo"); 
        $apell = odbc_result($result_query,"Apellido"); 
        $nomb = odbc_result($result_query,"Nombre");    
        
        $apellutf= iconv("iso-8859-1", "UTF-8", $apell);
        $nombutf= iconv("iso-8859-1", "UTF-8", $nomb);
        
		if (($cod_empresa == $select_codWF) && ($var_excluyente!=$cod_empleado))
		{
		echo "<option value='$cod_empleado'>$apellutf $nombutf</option>";
		}
    }
	
echo '</select>';


