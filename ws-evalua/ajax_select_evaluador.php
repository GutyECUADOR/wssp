<?php
include('../ws-admin/acceso_db_sbio.php');

$cod_empresa_GET = $_GET['cod_WF'];
$sup = "SUP";
$consulta_empleado = "SELECT * FROM dbo.Empleados with (nolock) WHERE CodDpto in ('EVA','SUP') ORDER BY Apellido";
$result_query = odbc_exec($conexion_sbio, $consulta_empleado);

echo '<select name="seleccion_evaluador" id="seleccion_evaluador" onchange = "loadmodal()" required>';




	while(odbc_fetch_row($result_query))
    {
		$cod_empresa = odbc_result($result_query,"Empresa_WF"); 	
        $cod_empleado = odbc_result($result_query,"Codigo");
		$cod_dpto = odbc_result($result_query,"CodDpto");		
        $apell = odbc_result($result_query,"Apellido"); 
        $nomb = odbc_result($result_query,"Nombre");    
        
        $apellutf= iconv("iso-8859-1", "UTF-8", $apell);
        $nombutf= iconv("iso-8859-1", "UTF-8", $nomb);
        
		if ($cod_empresa_GET == $cod_empresa)
		{
		echo "<option value='$cod_empleado'>$apellutf $nombutf $cod_dpto</option>";
		}
    }
	
echo '</select>';


