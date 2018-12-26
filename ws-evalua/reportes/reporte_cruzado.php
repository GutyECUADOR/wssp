<?php
    require_once '../../ws-admin/acceso_db.php';
    require_once '../../libs/mpdf/mpdf.php';
    
    include('../../ws-admin/funciones.php'); // Acceso a funciones utiles
   
    $id_cruce1 = $_GET['seleccion_cruce1'];
    $id_cruce2 = $_GET['seleccion_cruce2'];
   
    $consulta_cruce1 = "SELECT *, Empresas_WF.Nombre as localN, (Empleados1.Apellido)as evaluadorN, (Empleados2.Apellido + Empleados2.Nombre)as empleadoN, (formacion_1+formacion_2+formacion_3+formacion_4)as total_formacion, (organizacion_1+organizacion_2+organizacion_3+organizacion_4) as total_organizacion, (relainter_1+relainter_2+relainter_3+relainter_4) as total_relainter, (compempresa1_1+compempresa1_2+compempresa1_3+compempresa1_4) as total_comempresa1, (compempresa2_1+compempresa2_2+compempresa2_3+compempresa2_4) as total_comempresa2, (compempresa3_1+compempresa3_2+compempresa3_3+compempresa3_4) as total_comempresa3, (compempresa4_1+compempresa4_2+compempresa4_3+compempresa4_4) as total_comempresa4, (autoevalua_1+autoevalua_2+autoevalua_3+autoevalua_4+autoevalua_5) as total_autoevalua, (formacion_1+formacion_2+formacion_3+formacion_4+organizacion_1+organizacion_2+organizacion_3+organizacion_4+relainter_1+relainter_2+relainter_3+relainter_4+compempresa1_1+compempresa1_2+compempresa1_3+compempresa1_4+compempresa2_1+compempresa2_2+compempresa2_3+compempresa2_4+compempresa3_1+compempresa3_2+compempresa3_3+compempresa3_4+compempresa4_1+compempresa4_2+compempresa4_3+compempresa4_4+autoevalua_1+autoevalua_2+autoevalua_3+autoevalua_4+autoevalua_5) as total_general, coach_val as coach FROM KAO_wssp.dbo.Evaluaciones INNER JOIN SBIOKAO.DBO.Empresas_WF on Empresas_WF.Codigo = Evaluaciones.local INNER JOIN SBIOKAO.dbo.Empleados as Empleados1 on Empleados1.Codigo = Evaluaciones.evaluador INNER JOIN SBIOKAO.dbo.Empleados as Empleados2 on Empleados2.Codigo = Evaluaciones.empleado WHERE cod_evaluacion = '$id_cruce1' ORDER BY cod_evaluacion DESC";
    $result_query_cruce1 = odbc_exec($conexion, $consulta_cruce1);
   
    $local_pdf = odbc_result($result_query_cruce1,"localN");
    $empleado_pdf = odbc_result($result_query_cruce1,"empleadoN");
    $evaluador_1 = odbc_result($result_query_cruce1,"evaluadorN");

    $consulta_cruce2 = "SELECT *, Empresas_WF.Nombre as localN, (Empleados1.Apellido)as evaluadorN, (Empleados2.Apellido + Empleados2.Nombre)as empleadoN, (formacion_1+formacion_2+formacion_3+formacion_4)as total_formacion, (organizacion_1+organizacion_2+organizacion_3+organizacion_4) as total_organizacion, (relainter_1+relainter_2+relainter_3+relainter_4) as total_relainter, (compempresa1_1+compempresa1_2+compempresa1_3+compempresa1_4) as total_comempresa1, (compempresa2_1+compempresa2_2+compempresa2_3+compempresa2_4) as total_comempresa2, (compempresa3_1+compempresa3_2+compempresa3_3+compempresa3_4) as total_comempresa3, (compempresa4_1+compempresa4_2+compempresa4_3+compempresa4_4) as total_comempresa4, (autoevalua_1+autoevalua_2+autoevalua_3+autoevalua_4+autoevalua_5) as total_autoevalua, (formacion_1+formacion_2+formacion_3+formacion_4+organizacion_1+organizacion_2+organizacion_3+organizacion_4+relainter_1+relainter_2+relainter_3+relainter_4+compempresa1_1+compempresa1_2+compempresa1_3+compempresa1_4+compempresa2_1+compempresa2_2+compempresa2_3+compempresa2_4+compempresa3_1+compempresa3_2+compempresa3_3+compempresa3_4+compempresa4_1+compempresa4_2+compempresa4_3+compempresa4_4+autoevalua_1+autoevalua_2+autoevalua_3+autoevalua_4+autoevalua_5) as total_general, coach_val as coach FROM KAO_wssp.dbo.Evaluaciones INNER JOIN SBIOKAO.dbo.Empresas_WF on Empresas_WF.Codigo = Evaluaciones.local INNER JOIN SBIOKAO.dbo.Empleados as Empleados1 on Empleados1.Codigo = Evaluaciones.evaluador INNER JOIN SBIOKAO.dbo.Empleados as Empleados2 on Empleados2.Codigo = Evaluaciones.empleado WHERE cod_evaluacion = '$id_cruce2' ORDER BY cod_evaluacion DESC";
    $result_query_cruce2 = odbc_exec($conexion, $consulta_cruce2);
    
    $evaluador_2 = odbc_result($result_query_cruce2,"evaluadorN");
    
    //Recodificacion de ISO-8859 a UTF
    $evaluador1_pdf_UTF = iconv("iso-8859-1", "UTF-8", $evaluador_1);
    $evaluador2_pdf_UTF = iconv("iso-8859-1", "UTF-8", $evaluador_2);
    $empleado_pdf_UTF = iconv("iso-8859-1", "UTF-8", $empleado_pdf);
    
    
    $array_items = array('FORMACIÓN', 'ORGANIZACIÓN', 'RELACIONES INTERPERSONALES ', 'COMPROMISO CON LA EMPRESA -1', 'COMPROMISO CON LA EMPRESA -2', 'COMPROMISO CON LA EMPRESA -3', 'COMPROMISO CON LA EMPRESA -4', 'AUTOEVALUACIÓN','PUNTAJE TOTAL', 'COACH');
    
    //Seteo de PDF
    $fecha = date ("Y-n-d");
    $doc_sinespacios = str_replace(" ", "", $empleado_pdf); //Quitar espacios en blanco
    $name_doc = 'reporte_cruzado'.$doc_sinespacios.'.pdf';
    $css = file_get_contents('style.css');
    $destino = 'I';
    
    
    $html = '
      
    <body>
    <header class="clearfix">
      <div id="logo">
        <img src="logo.png">
      </div>
      <h1>REPORTE DE EVALUACIÓN COMBINADO</h1>
      <div id="contenedor_info">
            <div id="company" class="clearfix">
              <div>KAO Sport Center</div>
              <div>Av. de los Shyris y Naciones Unidas Edificio Nuñez Vela<br /> Quito, Ecuador</div>
              <div>(593-2)-2550005</div>
              <div><a href="mailto:info@kaosport.com">info@kaosport.com</a></div>
            </div>
            <div id="datos1">
              <div><span>EMPRESA: </span> '.$local_pdf.'</div>
              <div><span>EVALUADORES:</span> '.$evaluador1_pdf_UTF . ' - '. $evaluador2_pdf_UTF.' </div>
              <div><span>EVALUADO:</span> '.$empleado_pdf_UTF.' </div>
              <div><span>FECHA:</span> '.$fecha.'</div>
            </div>
      </div>    
    </header>
    <main>
    <div class="grupo-2">
        <table>
            <thead>
              <tr>
                  <th class="title-row" colspan="4">DESGLOSE</th>
               
              </tr>
              <tr>
                <th>SECCION</th>
                <th>'.$evaluador1_pdf_UTF.'</th>
                <th>'.$evaluador2_pdf_UTF.'</th>
                <th>PROMEDIO</th>
                
              </tr>
            </thead>';
                    $colum_db = 111; // Indicar fila desde la que se tomaran los datos
                    for ($i = 0; $i <= 9; $i++) {
                    
                        odbc_fetch_row($result_query_cruce1);
                        odbc_fetch_row($result_query_cruce2);
                        
                        $dato_db1 = odbc_result($result_query_cruce1,$colum_db);
                        $dato_db2 = odbc_result($result_query_cruce2,$colum_db);
                       
                       
                        
                        $html .= '
    
                           <tr>
                            <td align="CENTER">'.$array_items[$i].'</td>
                            <td align="CENTER">'.$dato_db1.'</td>
                            <td align="CENTER">'.$dato_db2.'</td>
                            <td align="CENTER">'.round(($dato_db1+$dato_db2)/2).'</td>
                          </tr>';
                        $colum_db ++;
                        }
                        
                        $total_general_db1 = odbc_result($result_query_cruce1,"total_general");
                        $total_general_db2 = odbc_result($result_query_cruce2,"total_general");
                        $total_general_db_cruce = round(($total_general_db1 + $total_general_db2)/2);
                        
                        if ($total_general_db_cruce <= 165 && $total_general_db_cruce >=140)
                        {   $valoracion_txt = "Felicitaciones";    
                        }else if ($total_general_db_cruce <= 139 && $total_general_db_cruce >=120){
                            $valoracion_txt = "Puede mejorar"; 
                        }else if ($total_general_db_cruce <= 119 && $total_general_db_cruce >=100){
                            $valoracion_txt = "En capacitación";
                        }else if ($total_general_db_cruce <= 99 && $total_general_db_cruce >=50){
                            $valoracion_txt = "Cumple parcialmente"; 
                        }else if ($total_general_db_cruce <= 49){
                            $valoracion_txt = "No cumple"; 
                        }else{
                            $valoracion_txt = "Sin valoración disponible"; 
                        }
                        
            $html .= ' 
            <thead>
              <tr>
                  <th class="title-row" colspan="4">EQUIVALENCIA</th>
              </tr>
            </thead> 
            
            <tr>
                 <td align="CENTER">EVALUACION = '.$total_general_db_cruce.'</td>
                 <td align="CENTER">'.$valoracion_txt.'</td>
                 <td align="CENTER">'. porcentaje_de($total_general_db_cruce,165). ' %</td>
            </tr>
            </tbody>
            </table>
            </div>


        </main>


            <div id="cont_firmas">
                <div id="firma1">Firma de Evaluador 1</div>
                <div id="firma2">Firma de Evaluador 2</div>
            </div>


        <footer>
          La información contenida en el presente documento es de uso exclusivo del empleado y/o empresa.
        </footer>
      </body>


        ';
            

    
    $mpdf = new mPDF('c','A4');
    $mpdf->WriteHTML($css,1);
    $html = mb_convert_encoding($html, 'UTF-8', 'UTF-8');
    $mpdf->WriteHTML($html);
    $mpdf->Output($name_doc, $destino);
    

 
 
    