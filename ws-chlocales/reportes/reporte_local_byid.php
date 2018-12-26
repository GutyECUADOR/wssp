<?php
    
    require_once '../../ws-admin/acceso_multi_db.php';
    require_once '../../libs/mpdf/mpdf.php';
    
    $conexion_ok = getDataBase('009');
    
    
    $dateini_modal= filter_input(INPUT_GET,'dateini_modal');
    $datefin_modal=  filter_input(INPUT_GET, 'datefin_modal');
    $empresa_select = trim(filter_input(INPUT_GET,'seleccion_empresa')); 
    $local_select = trim(filter_input(INPUT_GET,'seleccion_local'));
    
        
     $html = '
      
     <body>
    <header class="clearfix">
      <div id="logo">
        <img class="logo" src="logo.png">
      </div>
      <h1>CheckList Diario - Locales</h1>
      <div id="contenedor_info">
            <div id="company" class="clearfix">
              <div>KAO Sport Center</div>
              <div>Av. de los Shyris y Naciones Unidas Edificio Nuñez Vela<br /> Quito, Ecuador</div>
              <div>(593-2)-2550005</div>
              <div><a href="mailto:info@kaosport.com">info@kaosport.com</a></div>
            </div>
            <div id="datos1">
              <div><span>EMPRESA: </span> '.$empresa_select.' </div>
              <div><span>LOCAL: </span> '.$local_select.' </div>
              <div><span>SUPERVISOR: </span> '.$superv_chk.' </div>
              <div><span>REPORT DEL:</span> '.$dateini_modal.' al '.$datefin_modal.'</div>
            </div>
      </div>    
    </header>
    <main>
        <div class="grupo-2">
        <table>
            <thead>
              <tr>
                  <th class="title-row" colspan="4">Detalle</th>
              </tr>
              <tr>
                <th class="desc" >#</th>
                <th class="desc">Fecha</th>
                <th class="desc">Novedades</th>
                <th class="desc">Observaciones</th>
              </tr>
            </thead>
            <tbody>
                ';
            
            $consulta_general = "select * from dbo.chlist_locales WHERE fecha BETWEEN '$dateini_modal' AND '$datefin_modal' AND empresa = '$empresa_select' AND local = '$local_select'";
            $result_query = odbc_exec($conexion_ok, $consulta_general);
            $cont_chk=1;
            
           
            
            while (odbc_fetch_row($result_query)) {
                
            
            $fecha_chk = odbc_result($consulta_detalle_valep,"fecha"); 
            $novedades_chk = "";
            $observaciones_chk = iconv("iso-8859-1", "UTF-8",odbc_result($consulta_detalle_valep,"observacion")); 

              $html .= '
              <tr>
                <td class="desc">'.$cont_chk.'</td>
                <td class="desc">'.$fecha_chk.'</td>
                <td class="desc">'.$novedades_chk.'</td>
                <td class="desc">'.$cantidad_prod.'</td>
              </tr>';
              $cont_chk++;
            }
    
            $html .= '     
            
            </tbody>
        </table>
        </div>
        
        <div id="cont_firmas">
            <div id="firma1">Firma Autorizada</div>
        </div>

        
        
    </main>
    <div class="grupo-2">
    
    </div>
  </body>

    ';
            
  //Seteo de PDF
        $doc_sinespacios = str_replace(" ", "", $empleado_pdf); //Quitar espacios en blanco
        $name_doc = 'reporte_local'.$doc_sinespacios.'.pdf';
        $css = file_get_contents('style.css');
        $destino = 'I';
    
    $mpdf = new mPDF('c','A4');
    $mpdf->WriteHTML($css,1);
    $html = mb_convert_encoding($html, 'UTF-8', 'UTF-8');
    $mpdf->WriteHTML($html);
    $mpdf->SetTitle("Reporte Generado");
    $mpdf->Output($name_doc, $destino);
    
