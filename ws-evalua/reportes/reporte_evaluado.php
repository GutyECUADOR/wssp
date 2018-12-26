<?php
    
    require_once '../../ws-admin/acceso_db.php';
    require_once '../../ws-admin/acceso_db_sbio.php';
    require_once '../../libs/mpdf/mpdf.php';
    session_start();
    
    $consulta_evaluacion = "SELECT TOP 1 *, (formacion_1+formacion_2+formacion_3+formacion_4)as total_formacion, (organizacion_1+organizacion_2+organizacion_3+organizacion_4) as total_organizacion, (relainter_1+relainter_2+relainter_3+relainter_4) as total_relainter, (compempresa1_1+compempresa1_2+compempresa1_3+compempresa1_4) as total_comempresa1, (compempresa2_1+compempresa2_2+compempresa2_3+compempresa2_4) as total_comempresa2, (compempresa3_1+compempresa3_2+compempresa3_3+compempresa3_4) as total_comempresa3, (compempresa4_1+compempresa4_2+compempresa4_3+compempresa4_4) as total_comempresa4, (autoevalua_1+autoevalua_2+autoevalua_3+autoevalua_4+autoevalua_5) as total_autoevalua, (formacion_1+formacion_2+formacion_3+formacion_4+organizacion_1+organizacion_2+organizacion_3+organizacion_4+relainter_1+relainter_2+relainter_3+relainter_4+compempresa1_1+compempresa1_2+compempresa1_3+compempresa1_4+compempresa2_1+compempresa2_2+compempresa2_3+compempresa2_4+compempresa3_1+compempresa3_2+compempresa3_3+compempresa3_4+compempresa4_1+compempresa4_2+compempresa4_3+compempresa4_4+autoevalua_1+autoevalua_2+autoevalua_3+autoevalua_4+autoevalua_5) as total_general FROM dbo.Evaluaciones ORDER BY cod_evaluacion DESC";
    $result_query = odbc_exec($conexion, $consulta_evaluacion);

   
    $local_pdf = $_SESSION['session_local'];
    $semana_pdf = $_SESSION['session_semana']; 
    $evaluador_pdf = $_SESSION['session_evaluador']; 
    $empleado_pdf = $_SESSION['session_empleado'] ;
    
    //RECUPERAR EL NOMBRE DEL EVALUADOR y EVALUADO
    $consulta_evaluador = "SELECT * FROM Empleados WHERE Codigo ='$evaluador_pdf'";
    $result_query_evaluador = odbc_exec($conexion_sbio, $consulta_evaluador);
    $evaluador_name = odbc_result($result_query_evaluador,"Nombre");
    $evaluador_Apell = odbc_result($result_query_evaluador,"Apellido");
    
    $consulta_evaluado = "SELECT * FROM Empleados WHERE Codigo ='$empleado_pdf'";
    $result_query_evaluado = odbc_exec($conexion_sbio, $consulta_evaluado);
    $evaluado_name = odbc_result($result_query_evaluado,"Nombre");
    $evaluado_apell = odbc_result($result_query_evaluado,"Apellido");
    
    $cargo_emp = odbc_result($result_query,"cargo");
    
    $evaluador_name_UTF= iconv("iso-8859-1", "UTF-8", $evaluador_name);
    $evaluador_Apell_UTF= iconv("iso-8859-1", "UTF-8", $evaluador_Apell);
    
    $evaluado_name_UTF= iconv("iso-8859-1", "UTF-8", $evaluado_name);
    $evaluado_apell_UTF= iconv("iso-8859-1", "UTF-8", $evaluado_apell);
    //
    
    $cod_ev = odbc_result($result_query,"Cod_Evaluacion");
    $formacion_1 = odbc_result($result_query,"formacion_1");
    $formacion_2 = odbc_result($result_query,"formacion_2");
    $formacion_3 = odbc_result($result_query,"formacion_3");
    $formacion_4 = odbc_result($result_query,"formacion_4");
    $organizacion_1 = odbc_result($result_query,"organizacion_1"); 
    $organizacion_2 = odbc_result($result_query,"organizacion_2");
    $organizacion_3 = odbc_result($result_query,"organizacion_3"); 
    $organizacion_4 = odbc_result($result_query,"organizacion_4"); 
    $relainter_1 = odbc_result($result_query,"relainter_1"); 
    $relainter_2 = odbc_result($result_query,"relainter_2");
    $relainter_3 = odbc_result($result_query,"relainter_3");
    $relainter_4 = odbc_result($result_query,"relainter_4");
    $compempresa1_1 = odbc_result($result_query,"compempresa1_1");
    $compempresa1_2 = odbc_result($result_query,"compempresa1_2");
    $compempresa1_3 = odbc_result($result_query,"compempresa1_3"); 
    $compempresa1_4 = odbc_result($result_query,"compempresa1_4");
    $compempresa2_1 = odbc_result($result_query,"compempresa2_1"); 
    $compempresa2_2 = odbc_result($result_query,"compempresa2_2"); 
    $compempresa2_3 = odbc_result($result_query,"compempresa2_3");
    $compempresa2_4 = odbc_result($result_query,"compempresa2_4");
    $compempresa3_1 = odbc_result($result_query,"compempresa3_1");
    $compempresa3_2 = odbc_result($result_query,"compempresa3_2");
    $compempresa3_3 = odbc_result($result_query,"compempresa3_3"); 
    $compempresa3_4 = odbc_result($result_query,"compempresa3_4");
    $compempresa4_1 = odbc_result($result_query,"compempresa4_1"); 
    $compempresa4_2 = odbc_result($result_query,"compempresa4_2");
    $compempresa4_3 = odbc_result($result_query,"compempresa4_3");
    $compempresa4_4 = odbc_result($result_query,"compempresa4_4");
    $autoevalua_1 = odbc_result($result_query,"autoevalua_1"); 
    $autoevalua_2 = odbc_result($result_query,"autoevalua_2"); 
    $autoevalua_3 = odbc_result($result_query,"autoevalua_3");
    $autoevalua_4 = odbc_result($result_query,"autoevalua_4"); 
    $autoevalua_5 = odbc_result($result_query,"autoevalua_5");
    
    $total_general_db = odbc_result($result_query,"total_general");
    $acc_correctiva = odbc_result($result_query,"ac_correctiva");
    
     if ($total_general_db <= 165 && $total_general_db >=140)
                {   $valoracion_txt = "Felicitaciones";    
                }else if ($total_general_db <= 139 && $total_general_db >=120){
                    $valoracion_txt = "Puede mejorar"; 
                }else if ($total_general_db <= 119 && $total_general_db >=100){
                    $valoracion_txt = "En capacitación";
                }else if ($total_general_db <= 99 && $total_general_db >=50){
                    $valoracion_txt = "Cumple parcialmente"; 
                }else if ($total_general_db <= 49){
                    $valoracion_txt = "No cumple"; 
                }else{
                    $valoracion_txt = "Sin valoración disponible"; 
                }
    
    
    
    $fecha = date ("Y-n-d");
    $doc_sinespacios = str_replace(" ", "", $empleado_pdf); //Quitar espacios en blanco
    $name_doc = 'reporte'.$doc_sinespacios.'.pdf';
    $css = file_get_contents('style.css');
    $destino = 'I';
    
    
    
    $html = '
      
    <body>
    <header class="clearfix">
      <div id="logo">
        <div id="cod"><h4>Cod. EV-'.$cod_ev.'</h4></div>  
        <img src="logo.png">
      </div>
      <h1>REPORTE DE EVALUACIÓN</h1>
      <div id="contenedor_info">
            <div id="company" class="clearfix">
              <div>KAO Sport Center</div>
              <div>Av. de los Shyris y Naciones Unidas Edificio Nuñez Vela<br /> Quito, Ecuador</div>
              <div>(593-2)-2550005</div>
              <div><a href="mailto:info@kaosport.com">info@kaosport.com</a></div>
            </div>
            <div id="datos1">
              <div><span>EMPRESA: </span> '.$local_pdf.'</div>
              <div><span>SEMANA: </span> '.$semana_pdf.' </div>
              <div><span>EVALUADOR:</span> '.$evaluador_Apell_UTF . $evaluador_name_UTF.' </div>
              <div><span>EVALUADO:</span> '.$evaluado_apell_UTF . $evaluado_name_UTF.' </div>
              <div><span>CARGO:</span> '.$cargo_emp.' </div>
              <div><span>FECHA:</span> '.$fecha.'</div>
            </div>
      </div>    
    </header>
    <main>
        <div class="grupo-2">
        <table>
            <thead>
              <tr>
                  <th class="title-row" colspan="3">FORMACIÓN</th>
               
              </tr>
              <tr>
                <th class="service">Item</th>
                <th class="desc">DESCRIPCIÓN</th>
                <th>PUNTAJE</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td class="service">1</td>
                <td class="desc">Demuestra tener los conocimientos requeridos para el cargo.</td>
                <td class="ptn">'.$formacion_1.'</td>
              </tr>
              <tr>
                <td class="service">2</td>
                <td class="desc">Sigue las políticas y procedimientos establecidos por la Empresa.</td>
                <td class="ptn">'.$formacion_2.'</td>
              </tr>
              <tr>
                <td class="service">3</td>
                <td class="desc">Manifiesta suficiencia para poderse desempeñar.</td>
                <td class="ptn">'.$formacion_3.'</td>
              </tr>
              <tr>
                <td class="service">4</td>
                <td class="desc">Se adapta al cargo y sitio de trabajo</td>
                <td class="ptn">'.$formacion_4.'</td>
              </tr>
            </tbody>
        </table>
        </div>
        
        <div class="grupo-2">
        <table>
            <thead>
              <tr>
                  <th class="title-row" colspan="3">ORGANIZACIÓN</th>
              </tr>  
              <tr>
                <th class="service">Item</th>
                <th class="desc">DESCRIPCIÓN</th>
                <th>PUNTAJE</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td class="service">1</td>
                <td class="desc">Es ordenado en la manera de realizar su trabajo, despachando diaria y oportunamente los asuntos a su cargo.</td>
                <td class="ptn">'.$organizacion_1.'</td>
              </tr>
              <tr>
                <td class="service">2</td>
                <td class="desc">Ordena su trabajo para facilitar las actividades a su cargo.</td>
                <td class="ptn">'.$organizacion_2.'</td>
              </tr>
              <tr>
                <td class="service">3</td>
                <td class="desc">No ocasiona pérdidas de tiempo en el manejo de los procesos o recursos.</td>
                <td class="ptn">'.$organizacion_3.'</td>
              </tr>
              <tr>
                <td class="service">4</td>
                <td class="desc">Utiliza efectivamente los recursos que tiene a su disposición.</td>
                <td class="ptn">'.$organizacion_4.'</td>
              </tr>
            </tbody>
        </table>
        </div>
        
       
        <div class="grupo-2">
        <table>
            <thead>
              <tr>
                  <th class="title-row" colspan="3">RELACIONES INTERPERSONALES</th>
               
              </tr>
              <tr>
                <th class="service">Item</th>
                <th class="desc">DESCRIPCIÓN</th>
                <th>PUNTAJE</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td class="service">1</td>
                <td class="desc">Las relaciones con sus jefes o compañeros son cordiales y respetuosas.</td>
                <td class="ptn">'.$relainter_1.'</td>
              </tr>
              <tr>
                <td class="service">2</td>
                <td class="desc">Mantiene una actitud de servicio frente a sus clientes o solicitudes de sus compañeros.</td>
                <td class="ptn">'.$relainter_2.'</td>
              </tr>
              <tr>
                <td class="service">3</td>
                <td class="desc">Tiene la capacidad de escuchar y entender las inquietudes de sus compañeros.</td>
                <td class="ptn">'.$relainter_3.'</td>
              </tr>
              <tr>
                <td class="service">4</td>
                <td class="desc">Es tolerante en el sitio de trabajo con sus compañeros. </td>
                <td class="ptn">'.$relainter_4.'</td>
              </tr>
            </tbody>
        </table>
        </div>
        
        <div class="grupo-2">
        <table>
            <thead>
              <tr>
                  <th class="title-row" colspan="3">COMPROMISO CON LA EMPRESA -1 </th>
               
              </tr>
              <tr>
                <th class="service">Item</th>
                <th class="desc">DESCRIPCIÓN</th>
                <th>PUNTAJE</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td class="service">1</td>
                <td class="desc">Manifiesta interés por las actividades planificadas por la Empresa.</td>
                <td class="ptn">'.$compempresa1_1.'</td>
              </tr>
              <tr>
                <td class="service">2</td>
                <td class="desc">Se observa compromiso y sentido de pertenencia hacia la Empresa.</td>
                <td class="ptn">'.$compempresa1_2.'</td>
              </tr>
              <tr>
                <td class="service">3</td>
                <td class="desc">Evidencia entusiasmo y disposición hacia el trabajo.</td>
                <td class="ptn">'.$compempresa1_3.'</td>
              </tr>
              <tr>
                <td class="service">4</td>
                <td class="desc">Muestra interés, compromiso por los objetivos trazados por la empresa.</td>
                <td class="ptn">'.$compempresa1_4.'</td>
              </tr>
            </tbody>
        </table>
        </div>
        
        <div class="grupo-2">
        <table>
            <thead>
              <tr>
                  <th class="title-row" colspan="3">COMPROMISO CON LA EMPRESA -2</th>
               
              </tr>
              <tr>
                <th class="service">Item</th>
                <th class="desc">DESCRIPCIÓN</th>
                <th>PUNTAJE</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td class="service">1</td>
                <td class="desc">Cumple con su trabajo a tiempo por encima de los obstáculos.</td>
                <td class="ptn">'.$compempresa2_1.'</td>
              </tr>
              <tr>
                <td class="service">2</td>
                <td class="desc">Comparte información y recursos para mejorar la eficiencia de los procesos.</td>
                <td class="ptn">'.$compempresa2_2.'</td>
              </tr>
              <tr>
                <td class="service">3</td>
                <td class="desc">Muestra interés para solucionar los errores cometidos por él (ella) o sus compañeros.</td>
                <td class="ptn">'.$compempresa2_3.'</td>
              </tr>
              <tr>
                <td class="service">4</td>
                <td class="desc">Evalúa sus errores y presenta mejoras.</td>
                <td class="ptn">'.$compempresa2_4.'</td>
              </tr>
            </tbody>
        </table>
        </div>
        
        <div class="grupo-2">
        <table>
            <thead>
              <tr>
                  <th class="title-row" colspan="3">COMPROMISO CON LA EMPRESA -3</th>
              </tr>
              <tr>
                <th class="service">Item</th>
                <th class="desc">DESCRIPCIÓN</th>
                <th>PUNTAJE</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td class="service">1</td>
                <td class="desc">Fomenta entre sus compañeros la búsqueda de acuerdos de mutuo beneficio.</td>
                <td class="ptn">'.$compempresa3_1.'</td>
              </tr>
              <tr>
                <td class="service">2</td>
                <td class="desc">Respeta las ventas o trabajo de sus compañeros. </td>
                <td class="ptn">'.$compempresa3_2.'</td>
              </tr>
              <tr>
                <td class="service">3</td>
                <td class="desc">Transmite respeto en el trato con los demás aceptando y valorando las diferencias individuales.</td>
                <td class="ptn">'.$compempresa3_3.'</td>
              </tr>
              <tr>
                <td class="service">4</td>
                <td class="desc">Se relaciona de manera cercana, cordial con sus compañeros, mostrando motivación y empatía para el trabajo en equipo.</td>
                <td class="ptn">'.$compempresa3_4.'</td>
              </tr>
            </tbody>
        </table>
        </div>
        
        <div class="grupo-2">
        <table>
            <thead>
              <tr>
                  <th class="title-row" colspan="3">COMPROMISO CON LA EMPRESA -4</th>
              </tr>
              <tr>
                <th class="service">Item</th>
                <th class="desc">DESCRIPCIÓN</th>
                <th>PUNTAJE</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td class="service">1</td>
                <td class="desc">Llega con puntualidad a su lugar de trabajo.</td>
                <td class="ptn">'.$compempresa4_1.'</td>
              </tr>
              <tr>
                <td class="service">2</td>
                <td class="desc">Informa y justifica cuando por alguna circunstancia no pudo asistir al lugar de trabajo.</td>
                <td class="ptn">'.$compempresa4_2.'</td>
              </tr>
              <tr>
                <td class="service">3</td>
                <td class="desc">Respeta y usa correctamente los bienes de la Empresa, el uniforme, la credencial y su presentación personal es adecuada.</td>
                <td class="ptn">'.$compempresa4_3.'</td>
              </tr>
              <tr>
                <td class="service">4</td>
                <td class="desc">Llega en buen estado de ánimo y de salud al trabajo. (si ha llegado en estado etílico especifique)</td>
                <td class="ptn">'.$compempresa4_4.'</td>
              </tr>
            </tbody>
        </table>
        </div>
        
        <div class="grupo-2">
        <table>
            <thead>
              <tr>
                  <th class="title-row" colspan="3">EVALUACIÓN</th>
              </tr>
              <tr>
                <th class="service">Item</th>
                <th class="desc">DESCRIPCIÓN</th>
                <th>PUNTAJE</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td class="service">1</td>
                <td class="desc">Local limpio y ordenado.</td>
                <td class="ptn">'.$autoevalua_1.'</td>
              </tr>
              <tr>
                <td class="service">2</td>
                <td class="desc">Mercadería ubicada en el lugar que corresponde.</td>
                <td class="ptn">'.$autoevalua_2.'</td>
              </tr>
              <tr>
                <td class="service">3</td>
                <td class="desc">Todo el personal está capacitado.</td>
                <td class="ptn">'.$autoevalua_3.'</td>
              </tr>
              <tr>
                <td class="service">4</td>
                <td class="desc">Todo el personal cuenta con el uniforme y se encuentra identificado.</td>
                <td class="ptn">'.$autoevalua_4.'</td>
              </tr>
              <tr>
                <td class="service">5</td>
                <td class="desc">Felicitaciones.</td>
                <td class="ptn">'.$autoevalua_5.'</td>
              </tr>
            </tbody>
        </table>
        </div>
    </main>

     <div class="grupo-2">
        <table>
            <thead>
              <tr>
                  <th class="title-row" colspan="2">RESULTADOS DE EVALUACIÓN</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td class="desc">Puntaje Obtenido</td>
                <td class="ptn">'.$total_general_db.' / 165</td>
              </tr>
              <tr>
                <td class="desc">Valoración</td>
                <td class="ptn">'.$valoracion_txt.'</td>
              </tr>
              
            </tbody>
            
            <tbody>
             <tr>
                  <th class="title-row" colspan="2">ACCIÓN CORRECTIVA</th>
              </tr>
              <tr>
                <td class="desc" colspan="2"> '.$acc_correctiva.'</td>
              </tr>
             
            </tbody>
            
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
    
  