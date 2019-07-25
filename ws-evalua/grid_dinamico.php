<?php
include('../ws-admin/acceso_db.php');
include('../ws-admin/acceso_db_sbio.php');

        $color_row=array('#DDDDDD', '#CBCBCB');
        $ind_color=0;
      
        
        echo " <table class='tablaedocs'>";    
            echo " <tr class='trcabecera'>
             <td tdcabecera title='Código'>Cod</td>
             <td tdcabecera title='Fecha'>Fecha</td>
             <td tdcabecera title='Evaluador'>Evaluado</td>
             <td tdcabecera title='Formación'>F</td>
             <td tdcabecera title='Organizacion'>O</td>
             <td tdcabecera title='Relaciones Interpersonales'>R. I.</td>
             <td tdcabecera title='Compromiso con la empresa 1'>C.E1.</td>
             <td tdcabecera title='Compromiso con la empresa 2'>C.E2.</td>
             <td tdcabecera title='Compromiso con la empresa 3'>C.E3.</td>
             <td tdcabecera title='Compromiso con la empresa 4'>C.E4.</td>
             <td tdcabecera title='Autoevaluación'>A.</td>
             <td tdcabecera title='Puntaje General'>Total /165</td>
             <td tdcabecera>Criterio</td>
             <td tdcabecera title='Desplegar Gráfica'>#</td>
                  </tr>
                ";  
            //Construcción Filas
          
            $consulta_eva = "
                SELECT TOP (100) 
                    cod_evaluacion, 
                    fecha, semana, 
                    (Empleados.Apellido+Empleados.Nombre)as Usuario,
                    (formacion_1+formacion_2+formacion_3+formacion_4+formacion_5)as total_formacion, 
                    (organizacion_1+organizacion_2+organizacion_3+organizacion_4) as total_organizacion, 
                    (relainter_1+relainter_2+relainter_3+relainter_4) as total_relainter, 
                    (compempresa1_1+compempresa1_2+compempresa1_3+compempresa1_4) as total_comempresa1, 
                    (compempresa2_1+compempresa2_2+compempresa2_3+compempresa2_4) as total_comempresa2, 
                    (compempresa3_1+compempresa3_2+compempresa3_3+compempresa3_4) as total_comempresa3, 
                    (compempresa4_1+compempresa4_2+compempresa4_3+compempresa4_4) as total_comempresa4, 
                    (autoevalua_1+autoevalua_2+autoevalua_3+autoevalua_4+autoevalua_5) as total_autoevalua, 
                    (formacion_1+formacion_2+formacion_3+formacion_4+formacion_5+organizacion_1+organizacion_2+organizacion_3+organizacion_4+relainter_1+relainter_2+relainter_3+relainter_4+compempresa1_1+compempresa1_2+compempresa1_3+compempresa1_4+compempresa2_1+compempresa2_2+compempresa2_3+compempresa2_4+compempresa3_1+compempresa3_2+compempresa3_3+compempresa3_4+compempresa4_1+compempresa4_2+compempresa4_3+compempresa4_4+autoevalua_1+autoevalua_2+autoevalua_3+autoevalua_4+autoevalua_5) as total_general 
                    FROM 
                    KAO_wssp.dbo.Evaluaciones with (nolock) 
                    INNER JOIN SBIOKAO.dbo.Empleados on KAO_wssp.dbo.Evaluaciones.empleado = SBIOKAO.dbo.Empleados.Codigo 
                    INNER JOIN Empresas_WF on Empresas_WF.Codigo = Evaluaciones.local 

                ORDER BY cod_evaluacion DESC
                
                ";
            $result_query = odbc_exec($conexion_sbio, $consulta_eva);
            $cont=0;
            while(odbc_fetch_row($result_query))
            {
                $cod_ev = odbc_result($result_query,"cod_evaluacion"); 
                $db_fecha = odbc_result($result_query,"fecha"); 
                $db_empleado = iconv("iso-8859-1", "UTF-8",odbc_result($result_query,"Usuario"));
                
                //RECUPERAR EL NOMBRE DEL EVALUADOR y EVALUADO
   
                
                $db_total_formacion = odbc_result($result_query,"total_formacion"); 
                $db_total_organizacion = odbc_result($result_query,"total_organizacion"); 
                $db_total_relainter = odbc_result($result_query,"total_relainter"); 
                $db_total_comempresa1 = odbc_result($result_query,"total_comempresa1");
                $db_total_comempresa2 = odbc_result($result_query,"total_comempresa2");
                $db_total_comempresa3 = odbc_result($result_query,"total_comempresa3");
                $db_total_comempresa4 = odbc_result($result_query,"total_comempresa4");
                $db_total_autoevalua = odbc_result($result_query,"total_autoevalua");
                $db_total_general = odbc_result($result_query,"total_general");
                
                $cont++;
                $ind_color++;
                $ind_color %= 2;
                
                if ($db_total_general <= 165 && $db_total_general >=140 || $db_total_general > 165)
                {   $valoracion_txt = "Felicitaciones";    
                    $color = "textoverdeclaro";
                }else if ($db_total_general <= 139 && $db_total_general >=120){
                    $valoracion_txt = "Puede mejorar"; 
                    $color = "textoverde";
                }else if ($db_total_general <= 119 && $db_total_general >=100){
                    $valoracion_txt = "En capacitación";
                    $color = "textoamarillo";
                }else if ($db_total_general <= 99 && $db_total_general >=50){
                    $valoracion_txt = "Cumple parcialmente"; 
                    $color = "textorojo";
                }else if ($db_total_formacion <= 49){
                    $valoracion_txt = "No cumple"; 
                    $color = "textorojo";
                }else{
                    $valoracion_txt = "-"; 
                    $color = "textorojo";
                }
                    
                 
                // Despliege de resultados
                
                    echo"<tr class='celdagrid' bgcolor=${color_row[$ind_color]}>";
                    echo"<td>".$cod_ev."</td>";
                    echo"<td>".$db_fecha."</td>";
                    echo"<td>".$db_empleado."</td>";
                    echo"<td>".$db_total_formacion."</td>";
                    echo"<td>".$db_total_organizacion."</td>";
                    echo"<td>".$db_total_relainter."</td>";
                    echo"<td>".$db_total_comempresa1."</td>";
                    echo"<td>".$db_total_comempresa2."</td>";
                    echo"<td>".$db_total_comempresa3."</td>";
                    echo"<td>".$db_total_comempresa4."</td>";
                    echo"<td>".$db_total_autoevalua."</td>";
                    echo"<td>".$db_total_general."</td>";
                    echo"<td class=".$color.">".$valoracion_txt."</td>";
                    echo"<td class='celdagrid'><a href='#' target='_self'><span class='glyphicon glyphicon-eye-open codcurri' id='$cod_ev' title='Ver reporte' onclick='fn_genreport_row(this)'></span></a></td>";
                    
                    echo"</td>";
                echo "</tr>";
                }
       
        echo "</table>";
        
       