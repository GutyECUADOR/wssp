<?php
require_once '../ws-admin/acceso_multi_db.php';
   
$db_empresa = getDataBase('009'); //Obtenemos conexion con base de datos segun codigo de la DB
        $query = "
        SELECT TOP 100
            evaluacion.id,
            evaluacion.tipoDoc as codEvaluacion,
            evaluacion.empresa,
            empresa.Nombre as nombreEmpresa,
            evaluacion.supervisor,
            supervisor.Apellido + supervisor.Nombre as nombreSupervisor,
            evaluacion.empleado,
            empleado.Apellido + empleado.Nombre as nombreEmpleado,
            evaluacion.fecha,
            evaluacion.sumatoria,
            evaluacion.observacion,
            evaluacion.estado
            FROM dbo.ev_anfitriones as evaluacion
            LEFT JOIN SBIOKAO.DBO.Empleados AS empleado ON empleado.Cedula = evaluacion.empleado 
            LEFT JOIN SBIOKAO.dbo.Empleados AS supervisor ON supervisor.Cedula = evaluacion.supervisor
            INNER JOIN SBIOKAO.dbo.Empresas_WF as empresa ON empresa.Codigo = evaluacion.empresa
        ORDER BY id DESC
        ";
        $result_consulta_chlocales = odbc_exec($db_empresa, $query);
        $count_result = odbc_num_rows($result_consulta_chlocales);
            if ($count_result>=1){
            
            $color_row=array('#DDDDDD', '#CBCBCB');
            $ind_color=0;
            
            echo " <table class='tablaedocs'>";    
            echo " <tr class='trcabecera'>
                    <td tdcabecera title='ID'>ID</td>
                    <td tdcabecera title='Código'>Cod Eva.</td>
                    <td tdcabecera title='Empresa'>Empresa</td>
                    <td tdcabecera title='Supervisor'>Supervisor</td>
                    <td tdcabecera title='Empleado'>Empleado</td>
                    <td tdcabecera title='Fecha'>Fecha Realizada</td>
                    <td tdcabecera title='Puntaje'>Puntaje</td>
                    <td tdcabecera title='A Recibir'>A Recibir</td>
                    <td tdcabecera title='Informe'>Informe</td>
                  </tr>
                ";  
           
            $cont=0;
            while(odbc_fetch_row($result_consulta_chlocales))
            {
                $cod_reporte = odbc_result($result_consulta_chlocales,"id");
                $cod_evaluacion = odbc_result($result_consulta_chlocales,"codEvaluacion");
                $empresacodDB = odbc_result($result_consulta_chlocales,"nombreEmpresa");
                $supervisor_pdf = iconv("iso-8859-1", "UTF-8", odbc_result($result_consulta_chlocales,"nombreSupervisor"));
                $empleado_pdf = iconv("iso-8859-1", "UTF-8", odbc_result($result_consulta_chlocales,"nombreEmpleado"));
                $fechaPDF = odbc_result($result_consulta_chlocales,"fecha");
                $puntaje = odbc_result($result_consulta_chlocales,"sumatoria");
               
                if($puntaje>25){
                    $extra = 30;
                }elseif($puntaje<=25){
                    $extra = 20;
                }else{
                    $extra = 0;
                }
                
                $cont++;
                $ind_color++;
                $ind_color %= 2;
                
                // Despliege de resultados
                
                    echo"<tr class='celdagrid' bgcolor=${color_row[$ind_color]}>";
                    echo"<td>".$cod_reporte."</td>";
                    echo"<td>".$cod_evaluacion."</td>";
                    echo"<td>".$empresacodDB."</td>";
                    echo"<td>".$supervisor_pdf."</td>";
                    echo"<td>".$empleado_pdf."</td>";
                    echo"<td>".$fechaPDF."</td>";
                    echo"<td>".$puntaje."</td>";
                    echo"<td> $".$extra."</td>";
                    echo"<td class='celdagrid'><a href='#' target='_self'><span class='glyphicon glyphicon-eye-open codvalep' id='$cod_reporte' value='$cod_reporte' title='Ver reporte' onclick='fn_reporteIndividual(this)'></span></a></td>";    
                    echo"</td>";
                echo "</tr>";
                }
       
        echo "</table>";
        }