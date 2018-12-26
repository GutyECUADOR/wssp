<?php
    
    require_once '../../ws-admin/acceso_db.php';
    require_once '../../ws-admin/acceso_db_sbio.php';
    require_once '../../libs/mpdf/mpdf.php';
    
    $id_evaluado = $_GET['seleccion_empleado_modal_obs'];
   
    $consulta_evaluacion_obs = "SELECT cod_evaluacion, fecha, Empresas_WF.Nombre as localN, (Empleados1.Apellido + Empleados1.Nombre)as evaluadorN, (Empleados2.Apellido + Empleados2.Nombre)as empleadoN, ac_correctiva FROM dbo.Evaluaciones INNER JOIN SBIOKAO.dbo.Empresas_WF on Empresas_WF.Codigo = Evaluaciones.local INNER JOIN SBIOKAO.dbo.Empleados as Empleados1 on Empleados1.Codigo = Evaluaciones.evaluador INNER JOIN SBIOKAO.dbo.Empleados as Empleados2 on Empleados2.Codigo = Evaluaciones.empleado WHERE dbo.Evaluaciones.empleado='$id_evaluado' ORDER BY cod_evaluacion DESC";
    
    $result_query_obs = odbc_exec($conexion, $consulta_evaluacion_obs);

    $local_pdf = odbc_result($result_query_obs,"localN");
    $empleado_pdf = odbc_result($result_query_obs,"empleadoN");
    
    //Recodificacion de ISO-8859 a UTF
   
    $empleado_pdf_UTF = iconv("iso-8859-1", "UTF-8", $empleado_pdf);
    
    $fecha = date ("Y-n-j");
    $doc_sinespacios = str_replace(" ", "", $empleado_pdf); //Quitar espacios en blanco
    $name_doc = 'reporte'.$doc_sinespacios.'.pdf';
    $css = file_get_contents('style.css');
    $destino = 'I';
    
    
    
    $html = '
      
    <body>
    <header class="clearfix">
      <div id="logo">
        <img src="logo.png">
      </div>
      <h1>REPORTE DE OBSERVACIONES</h1>
      <div id="contenedor_info">
            <div id="company" class="clearfix">
              <div>KAO Sport Center</div>
              <div>Av. de los Shyris y Naciones Unidas Edificio Nuñez Vela<br /> Quito, Ecuador</div>
              <div>(593-2)-2550005</div>
              <div><a href="mailto:info@kaosport.com">info@kaosport.com</a></div>
            </div>
            <div id="datos1">
              <div><span>EMPRESA: </span> '.$local_pdf.'</div>
              <div><span>FECHA:</span> '.$fecha.'</div>
              <div><span>EMPLEADO:</span> '.$empleado_pdf_UTF.' </div>
              
            </div>
      </div>    
    </header>
    <main>
        <div class="grupo-2">
        <table>
            <thead>
              <tr>
                  <th class="title-row" colspan="4">RESUMEN DE OBSERVACIONES </th>
               
              </tr>
              <tr>
                <th class="service">Cod. </th>
                <th class="desc">FECHA</th>
                <th class="service">EVALUADOR </th>
                <th>OBSERVACION</th>
              </tr>
             </thead>';
    
                        $cod_row = odbc_result($result_query_obs,"cod_evaluacion");
                        $fecha_row = odbc_result($result_query_obs,"fecha");  
                         $evaluador_row = iconv("iso-8859-1", "UTF-8",odbc_result($result_query_obs,"evaluadorN") );
                        $observacion_row = odbc_result($result_query_obs,"ac_correctiva");  
                        
                          $html .= '
                           <tr>
                            <td align="CENTER">'.$cod_row.'</td>
                            <td align="CENTER">'.$fecha_row.'</td>
                            <td align="CENTER">'.$evaluador_row.'</td>
                            <td align="CENTER">'.$observacion_row.'</td>
                          </tr>';
                   
                        while (odbc_fetch_row($result_query_obs)) {
                        
                        $cod_row = odbc_result($result_query_obs,"cod_evaluacion");
                        $fecha_row = odbc_result($result_query_obs,"fecha");  
                        $evaluador_row = iconv("iso-8859-1", "UTF-8",odbc_result($result_query_obs,"evaluadorN") );  
                        $observacion_row = odbc_result($result_query_obs,"ac_correctiva");  
                        
                         //Recodificacion de ISO-8859 a UTF
                      
                        
                          $html .= '
                           <tr>
                            <td align="CENTER">'.$cod_row.'</td>
                            <td align="CENTER">'.$fecha_row.'</td>
                            <td align="CENTER">'.$evaluador_row.'</td>
                            <td align="CENTER">'.$observacion_row.'</td>
                          </tr>';
                     
                        }
                    
                       
            $html .= ' 
           



            <tbody>
             
            </tbody>
        </table>
        </div>
        
        
        </table>
        </div>
        
        <div id="cont_firmas">
            <div id="firma1">Firma de Evaluador</div>
            <div id="firma2">Firma de Evaluado</div>
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
    

        
  