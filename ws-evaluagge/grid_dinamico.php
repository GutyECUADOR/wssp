<?php
require_once '../ws-admin/acceso_multi_db.php';
   
$db_empresa = getDataBase('009'); //009 WSSP DB

        $query = "
        SELECT TOP 100 
            EJI.*, 
            SBIO.Nombre + SBIO.Apellido as SolicitanteN, 
            SBIOEMPRESAS.Nombre as EmpresaN, 
            SBIOEMPLEADO.Nombre+SBIOEMPLEADO.Apellido as EvaluadoN  
            FROM dbo.CAB_EJI as EJI 
                INNER JOIN SBIOKAO.dbo.Empleados as SBIO ON EJI.solicitante = SBIO.Cedula 
                INNER JOIN SBIOKAO.dbo.Empresas_WF as SBIOEMPRESAS ON SBIOEMPRESAS.Codigo = EJI.empresa 
                INNER JOIN SBIOKAO.DBO.Empleados as SBIOEMPLEADO ON SBIOEMPLEADO.Codigo = EJI.empleado 
            WHERE EJI.estado = '0' 
            ORDER BY id DESC
        
        ";
        $resultset = odbc_exec($db_empresa, $query);
        $count_result = odbc_num_rows($resultset);
        if ($count_result>=1){
            
            $color_row=array('#DDDDDD', '#CBCBCB');
            $ind_color=0;
            
            echo " <table class='tablaedocs'>";    
            echo " <tr class='trcabecera'>
                    <td tdcabecera title='Código'>ID</td>
                    <td tdcabecera title='Empresa'>Empresa</td>
                    <td tdcabecera title='Evaluador'>Evaluador</td>
                    <td tdcabecera title='Evaluado'>Evaluado</td>
                    <td tdcabecera title='Fecha'>Fecha</td>
                    <td tdcabecera title='Acciones'>Acciones</td>
                    <td tdcabecera title='Informe'>Informe</td>
                  </tr>
                ";  
            //Construcción Filas
          
            $cont=0;
            while(odbc_fetch_row($resultset))
            {
                //RECUPERAR DATOS
                $cod_reporte = odbc_result($resultset,"codigo");
                $empresacodDB = odbc_result($resultset,"EmpresaN");
               
                //Recodificacion de ISO-8859 a UTF
                $evaluador = iconv("iso-8859-1", "UTF-8",odbc_result($resultset,"Solicitanten"));
                $evaluado = iconv("iso-8859-1", "UTF-8",odbc_result($resultset,"EvaluadoN"));
               

                $fechaPDF = odbc_result($resultset,"fecha");
             
              
                $cont++;
                $ind_color++;
                $ind_color %= 2;
                
                // Despliege de resultados
                
                    echo"<tr class='celdagrid' bgcolor=${color_row[$ind_color]}>";
                    echo"<td>".$cod_reporte."</td>";
                    echo"<td>".$empresacodDB."</td>";
                    echo"<td>".$evaluador."</td>";
                    echo"<td>".$evaluado."</td>";
                    echo"<td>".$fechaPDF."</td>";
                    echo"<td><button type='button' class='btn btn-danger btn-xs btnAnulaEJI' id='$cod_reporte'> <span class='glyphicon glyphicon-thumbs-down'></span> Anular</button>";    
                   
                    echo"<td class='celdagrid'><a href='#' target='_self'><span class='glyphicon glyphicon-eye-open codejiitem' id='$cod_reporte' value='$cod_reporte' title='Ver reporte'></span></a></td>";    
                    echo"</td>";
                    echo "</tr>";
                }
       
        echo "</table>";
       
            
        }