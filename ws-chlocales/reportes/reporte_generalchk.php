<?php
    require_once '../../libs/mpdf/mpdf.php';
    require_once '../../ws-admin/acceso_multi_db.php';
   
    $db_wssp = getDataBase('009'); //Codigo 009 Conexion con WSSP
    
    $sql_vales_perdida = "SELECT TOP 1 * FROM dbo.chlist_locales ORDER BY id DESC";
    
    $consulta_chk_report = odbc_exec($db_wssp, $sql_vales_perdida);

    $num_reporte = odbc_result($consulta_chk_report,"id");
    $cod_chequeo = odbc_result($consulta_chk_report,"codchequeo");
    $empresa_chk = odbc_result($consulta_chk_report,"empresa");
    $cod_local_chk = odbc_result($consulta_chk_report,"local");
    $cod_supervi_chk = odbc_result($consulta_chk_report,"supervisor");
    $fecha_chk = odbc_result($consulta_chk_report,"fecha");
    
        $chk_1 = odbc_result($consulta_chk_report,"chk_1");
        $chk_2 = odbc_result($consulta_chk_report,"chk_2");
        $chk_3 = odbc_result($consulta_chk_report,"chk_3");
        $chk_4 = odbc_result($consulta_chk_report,"chk_4");
        $chk_5 = odbc_result($consulta_chk_report,"chk_5");
        $chk_6 = odbc_result($consulta_chk_report,"chk_6");
        $chk_7 = odbc_result($consulta_chk_report,"chk_7");
        $chk_8 = odbc_result($consulta_chk_report,"chk_8");
        $chk_9 = odbc_result($consulta_chk_report,"chk_9");
        $chk_10 = odbc_result($consulta_chk_report,"chk_10");
        $chk_11 = odbc_result($consulta_chk_report,"chk_11");
        $chk_12 = odbc_result($consulta_chk_report,"chk_12");
        $chk_13 = odbc_result($consulta_chk_report,"chk_13");
        $chk_14 = odbc_result($consulta_chk_report,"chk_14");
        $chk_15 = odbc_result($consulta_chk_report,"chk_15");
        $chk_16 = odbc_result($consulta_chk_report,"chk_16");
        $chk_17 = odbc_result($consulta_chk_report,"chk_17");
        $chk_18 = odbc_result($consulta_chk_report,"chk_18");
        $chk_19 = odbc_result($consulta_chk_report,"chk_19");
        
        $obervacion = odbc_result($consulta_chk_report,"observacion");

// Metadados de PDF
    
    $name_doc = 'reporte'.$solicitante_pdf.'.pdf';
    $css = file_get_contents('style.css');
    $destino = 'I';
    
    
    
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
              <div><span>CÓDIGO </span> '.$cod_chequeo.'-'.$num_reporte.'</div>
              <div><span>EMPRESA: </span> '.$empresa_chk.' </div>
              <div><span>LOCAL: </span> '.$cod_local_chk.' </div>
              <div><span>SOLICITANTE: </span> '.$cod_supervi_chk.' </div>
              <div><span>FECHA:</span> '.$fecha_chk.'</div>
            </div>
      </div>    
    </header>
    <main>
        <div class="grupo-2">
        <table>
            <thead>
              <tr>
                  <th class="title-row" colspan="2">ITEMS</th>
              </tr>
              <tr>
                <th class="service" >ESTADO</th>
                <th class="desc">DESCRIPCION</th>
              </tr>
            </thead>
            <tbody>
            <tr>
                <td class="service">'.$chk_1.'</td>
                <td class="desc">1.- FALTAS Y ATRAZOS DEL PERSONAL.</td>
            </tr>
            <tr>
                <td class="service">'.$chk_2.'</td>
                <td class="desc">2.- LIMPIEZA GENERAL DEL LOCAL.</td>
            </tr>
            <tr>
                <td class="service">'.$chk_3.'</td>
                <td class="desc">3.- REGISTRO DE DATOS DE VENTAS EN FORMATO DE ANALISIS DIARIO</td>
            </tr>
            <tr>
                <td class="service">'.$chk_4.'</td>
                <td class="desc">4.- CONTROL DE MATERIAL POP HE INFORMATIVOS</td>
            </tr>
            <tr>
                <td class="service">'.$chk_5.'</td>
                <td class="desc">5.- CONTROL DE ASIGNACION Y DISTRIBUCION DE PERCHAS.</td>
            </tr>
            <tr>
                <td class="service">'.$chk_6.'</td>
                <td class="desc">6.- LIMPIEZA DE PERCHA DE LINEA DE CALZADO</td>
            </tr>
            <tr>
                <td class="service">'.$chk_7.'</td>
                <td class="desc">7.-  EXHIBICION DE ZAPATOS</td>
            </tr>
            <tr>
                <td class="service">'.$chk_8.'</td>
                <td class="desc">8.- LIMPIEZA DE PERCHAS DE MERCADERÍA EN GENERAL.</td>
            </tr>
            <tr>
                <td class="service">'.$chk_9.'</td>
                <td class="desc">9.-  EXHIBICION DE MERCADERIA EN GENERAL</td>
            </tr>
            <tr>
                <td class="service">'.$chk_10.'</td>
                <td class="desc">10.- LIMPIEZA DE PERCHAS DE ROPA</td>
            </tr>
            <tr>
                <td class="service">'.$chk_11.'</td>
                <td class="desc">11.-  EXHIBICION DE ROPA</td>
            </tr>
            <tr>
                <td class="service">'.$chk_12.'</td>
                <td class="desc">12.- CONTEO DIARIO DE ROPA</td>
            </tr>
            <tr>
                <td class="service">'.$chk_13.'</td>
                <td class="desc">13.- EXHIBICIÓN EN VITRINA (LAS TRES LINEAS)</td>
            </tr>
            <tr>
                <td class="service">'.$chk_14.'</td>
                <td class="desc">14.- BODEGA</td>
            </tr>
            <tr>
                <td class="service">'.$chk_15.'</td>
                <td class="desc">15.- RECOMENDACIÓN DEL PRODUCTO</td>
            </tr>
            <tr>
                <td class="service">'.$chk_16.'</td>
                <td class="desc">16.- MANTENIMIENTO DEL LOCAL</td>
            </tr>
            <tr>
                <td class="service">'.$chk_17.'</td>
                <td class="desc">17.- APAGADO DE LUCES Y EQUIPOS</td>
            </tr>
            <tr>
                <td class="service">'.$chk_18.'</td>
                <td class="desc">18.- BODEGA SALIDA</td>
            </tr>
            <tr>
                <td class="service">'.$chk_19.'</td>
                <td class="desc">19.- CAJA</td>
            </tr>
            
            <tr>
                <th class="service" colspan=2>OBSERVACION</th>
            </tr>
            <tr>
                <td class="service" colspan=2>'.$obervacion.'</td>
            </tr>
            
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
            
    
    $mpdf = new mPDF('c','A4');
    $mpdf->WriteHTML($css,1);
    $html = mb_convert_encoding($html, 'UTF-8', 'UTF-8');
    $mpdf->SetTitle("Reporte Generado");
    $mpdf->WriteHTML($html);
    $mpdf->Output($name_doc, $destino);
    

        
     
    