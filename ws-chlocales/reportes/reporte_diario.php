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
    $obervacion = odbc_result($consulta_chk_report,"observacion");
    
    $cod_estado = odbc_result($consulta_chk_report,"estado");
        
   
    switch ($cod_estado) 
    {
    case 1:
        $estado_txt = 'Revisado/Aprobado';
            break;
        
    case 2:
        $estado_txt = 'Anulado';
            break;    

    default:
        $estado_txt = 'Pendiente de revisión';
        break;
    }
    
// Metadados de PDF
    
    $name_doc = 'reporte'.$solicitante_pdf.'.pdf';
    $css = file_get_contents('style.css');
    $destino = 'I';
    
    
    
    $html = '
      
     <body>
    <header class="clearfix">
      <div id="logo">
        <div id="cod"><h4>ESTADO: '.$estado_txt.'</h4></div> 
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
            <tbody>
            <tr>
                <th class="title-row" >JEFE DE LOCAL</th>
                <th class="title-row">DESCRIPCION</th>
            </tr>

            <tr>
                <th class="title-row" colspan="2">1.- FALTAS Y ATRAZOS DEL PERSONAL</th>
            </tr>
                <tr>
                    <td class="service">'.odbc_result($consulta_chk_report,"chk_1_1").'</td>
                    <td class="desc">1.1 Control del ingreso del personal en tarjetas (atrazos)</td>
                </tr>
                <tr>
                    <td class="service">'.odbc_result($consulta_chk_report,"chk_1_2").'</td>
                    <td class="desc">1.2 Cruce de informaciòn con Anfitrion.(transcurso de día)</td>
                </tr>
                <tr>
                    <td class="service">'.odbc_result($consulta_chk_report,"chk_1_3").'</td>
                    <td class="desc">1.3 Registro de información para oficina. (normal y/o con novedad)</td>
                </tr>
            <tr>
                <th class="title-row" colspan="2">2.- LIMPIEZA GENERAL DEL LOCAL</th>
            </tr>
                <tr>
                    <td class="service">'.odbc_result($consulta_chk_report,"chk_2_1").'</td>
                    <td class="desc">2.1 Limpieza de pisos, muebles, cajones, espejos y vidrios. (tres veces al día)</td>
                </tr>
            <tr>
                <th class="title-row" colspan="2">3.- REGISTRO DE DATOS DE VENTAS EN FORMATO DE ANALISIS DIARIO</th>
            </tr>
                <tr>
                    <td class="service">'.odbc_result($consulta_chk_report,"chk_3_1").'</td>
                    <td class="desc">3.1 Organizaciòn del horario del personal para registro de ventas del dìa anterior.</td>
                </tr>
                <tr>
                    <td class="service">'.odbc_result($consulta_chk_report,"chk_3_2").'</td>
                    <td class="desc">3.2 Control del registro de ventas del personal.</td>
                </tr>
            <tr>
                <th class="title-row" colspan="2">4.- CONTROL DE MATERIAL POP HE INFORMATIVOS</th>
            </tr>
                <tr>
                    <td class="service">'.odbc_result($consulta_chk_report,"chk_4_1").'</td>
                    <td class="desc">4.1 Revision de habladores y anuncios promocionales</td>
                </tr>
                <tr>
                    <td class="service">'.odbc_result($consulta_chk_report,"chk_4_2").'</td>
                    <td class="desc">4.2 Revisión de señales informativas en perfecto estado</td>
                </tr>
            <tr>
                <th class="title-row" colspan="2">5.- CONTROL DE ASIGNACION Y DISTRIBUCION DE PERCHAS.</th>
            </tr>
                <tr>
                    <td class="service">'.odbc_result($consulta_chk_report,"chk_5_1").'</td>
                    <td class="desc">5.1 Asignación de perchas por día libre del personal.</td>
                </tr>
                <tr>
                    <td class="service">'.odbc_result($consulta_chk_report,"chk_5_2").'</td>
                    <td class="desc">5.2 Asignación de perchas por vacaciones del personal.</td>
                </tr>
                <tr>
                    <td class="service">'.odbc_result($consulta_chk_report,"chk_5_3").'</td>
                    <td class="desc">5.3 Asignación de perchas por maternidad.</td>
                </tr>
                <tr>
                    <td class="service">'.odbc_result($consulta_chk_report,"chk_5_4").'</td>
                    <td class="desc">5.4 Asignación de perchas por ausencias no planificadas. (faltas,etc)</td>
                </tr>
            <tr>
                <th class="title-row" colspan="2">6.- LIMPIEZA DE PERCHA DE LINEA DE CALZADO</th>
            </tr>
                <tr>
                    <td class="service">'.odbc_result($consulta_chk_report,"chk_6_1").'</td>
                    <td class="desc">6.1 Control de limpieza de pared</td>
                </tr>
                <tr>
                    <td class="service">'.odbc_result($consulta_chk_report,"chk_6_2").'</td>
                    <td class="desc">6.2 Control de limpieza de tablillas</td>
                </tr>
                <tr>
                    <td class="service">'.odbc_result($consulta_chk_report,"chk_6_3").'</td>
                    <td class="desc">6.3 Control de limpieza de muebles</td>
                </tr>
            <tr>
                <th class="title-row" colspan="2">7.-  EXHIBICION DE ZAPATOS</th>
            </tr>
                <tr>
                    <td class="service">'.odbc_result($consulta_chk_report,"chk_7_1").'</td>
                    <td class="desc">7.1 Control de exhibición de zapatos en su respectiva tablilla</td>
                </tr>
                <tr>
                    <td class="service">'.odbc_result($consulta_chk_report,"chk_7_2").'</td>
                    <td class="desc">7.2 Revisión y control de zapatos sin exhibir (tiempo y frecuencia cada hora)</td>
                </tr>
                <tr>
                    <td class="service">'.odbc_result($consulta_chk_report,"chk_7_3").'</td>
                    <td class="desc">7.3 Codificación ( con código de barra, en buen estado, legible y ubicación adecuada.)</td>
                </tr>
                <tr>
                    <td class="service">'.odbc_result($consulta_chk_report,"chk_7_4").'</td>
                    <td class="desc">7.4 Revisión y control de zapatos en promoción (Descuentos respectivos).</td>
                </tr>
                <tr>
                    <td class="service">'.odbc_result($consulta_chk_report,"chk_7_5").'</td>
                    <td class="desc">7.5 Zapato en buen estado, cordones cruzados y talla mas pequeñas</td>
                </tr>
                <tr>
                    <td class="service">'.odbc_result($consulta_chk_report,"chk_7_6").'</td>
                    <td class="desc">7.6 Linea organizada armonicamente: por marcas, deporte, género, 
                    colecciones, categorías y color. ( Sin monotonía) (cada hora)</td>
                    </tr>
                <tr>
                    <td class="service">'.odbc_result($consulta_chk_report,"chk_7_7").'</td>
                    <td class="desc">7.7 Simetría, equilibrio y distribución de espacios.</td>
                </tr>
                <tr>
                    <td class="service">'.odbc_result($consulta_chk_report,"chk_7_8").'</td>
                    <td class="desc">7.8 Control de material POP de la línea de CALZADO.</td>
                </tr>
            <tr>
                <th class="title-row" colspan="2">8.- LIMPIEZA DE PERCHAS DE MERCADERÍA EN GENERAL.</th>
            </tr>
                <tr>
                    <td class="service">'.odbc_result($consulta_chk_report,"chk_8_1").'</td>
                    <td class="desc">8.1 Control de limpieza de pared</td>
                </tr>
                <tr>
                    <td class="service">'.odbc_result($consulta_chk_report,"chk_8_2").'</td>
                    <td class="desc">8.2 Control de limpieza del producto,  (dos veces al día)</td>
                </tr>
                <tr>
                    <td class="service">'.odbc_result($consulta_chk_report,"chk_8_3").'</td>
                    <td class="desc">8.3 Control de limpieza de clavos, brazos, rejillas, tablillas y exhibidores.</td>
                </tr>
                <tr>
                    <td class="service">'.odbc_result($consulta_chk_report,"chk_8_4").'</td>
                    <td class="desc">8.4 Control de limpieza de gondolas, equipos, bicicletas, bases de tableros 2v</td>
                </tr>
            <tr>
                <th class="title-row" colspan="2">9.-  EXHIBICION DE MERCADERIA EN GENERAL</th>
            </tr>
                <tr>
                    <td class="service">'.odbc_result($consulta_chk_report,"chk_9_1").'</td>
                    <td class="desc">9.1 Control de exhibición de productos con su respectivo exhibidor clavos del mismo tamaño.</td>
                </tr>
                <tr>
                    <td class="service">'.odbc_result($consulta_chk_report,"chk_9_2").'</td>
                    <td class="desc">9.2 Revisión y control de mercadería sin exhibir (ganchos llenos) cada hora.</td>
                </tr>
                <tr>
                    <td class="service">'.odbc_result($consulta_chk_report,"chk_9_3").'</td>
                    <td class="desc">9.3 Codificación ( con código de barra, en buen estado, legible y ubicación adecuada.)</td>
                </tr>
                <tr>
                    <td class="service">'.odbc_result($consulta_chk_report,"chk_9_4").'</td>
                    <td class="desc">9.4 Revisión y control de mercadería en promoción (Descuentos respectivos).</td>
                </tr>
                <tr>
                    <td class="service">'.odbc_result($consulta_chk_report,"chk_9_5").'</td>
                    <td class="desc">9.5 Mercadería en buen estado.</td>
                </tr>
                <tr>
                    <td class="service">'.odbc_result($consulta_chk_report,"chk_9_6").'</td>
                    <td class="desc">9.6 Linea organizada armónicamente: por marcas, categorías, precio y unificación del producto (ejemplo: solo balones y por marca)</td>
                </tr>
                <tr>
                    <td class="service">'.odbc_result($consulta_chk_report,"chk_9_7").'</td>
                    <td class="desc">9.7 Simetría, equilibrio y distribución de espacios.</td>
                </tr>
                <tr>
                    <td class="service">'.odbc_result($consulta_chk_report,"chk_9_8").'</td>
                    <td class="desc">9.8 Control de tarjetas de información en equipos y bicicletas.</td>
                </tr>
                <tr>
                    <td class="service">'.odbc_result($consulta_chk_report,"chk_9_9").'</td>
                    <td class="desc">9.9 Control de los cubos (precios) de Victorinox y Maglite</td>
                </tr>
            <tr>
                <th class="title-row" colspan="2">10.- LIMPIEZA DE PERCHAS DE ROPA</th>
            </tr>
                <tr>
                    <td class="service">'.odbc_result($consulta_chk_report,"chk_10_1").'</td>
                    <td class="desc">10.1 Control de limpieza de pared</td>
                </tr>
                <tr>
                    <td class="service">'.odbc_result($consulta_chk_report,"chk_10_2").'</td>
                    <td class="desc">10.2 Control de limpieza de brazos, cascadas, exhibidores, armadores.</td>
                </tr>
                <tr>
                    <td class="service">'.odbc_result($consulta_chk_report,"chk_10_3").'</td>
                    <td class="desc">10.3 Control de limpieza de árboles, maniquiés, mesas y muebles.</td>
                </tr>
            <tr>
                <th class="title-row" colspan="2">11.-  EXHIBICION DE ROPA</th>
            </tr>
                <tr>
                    <td class="service">'.odbc_result($consulta_chk_report,"chk_11_1").'</td>
                    <td class="desc">11.1 Control de exhibición de ropa en su respectivo armador.</td>
                </tr>
                <tr>
                    <td class="service">'.odbc_result($consulta_chk_report,"chk_11_2").'</td>
                    <td class="desc">11.2 Revisión y control de ropa sin exhibir, (brazos y exhibidores llenos ) cada hora</td>
                </tr>
                <tr>
                    <td class="service">'.odbc_result($consulta_chk_report,"chk_11_3").'</td>
                    <td class="desc">11.3 Codificación ( con código de barra, en buen estado,  legible</td>
                </tr>
                <tr>
                    <td class="service">'.odbc_result($consulta_chk_report,"chk_11_4").'</td>
                    <td class="desc">11.4 Revisión y control de ropa en promoción </td>
                </tr>
                <tr>
                    <td class="service">'.odbc_result($consulta_chk_report,"chk_11_5").'</td>
                    <td class="desc">11.5 Ropa en buen estado y limpia.</td>
                </tr>
                <tr>
                    <td class="service">'.odbc_result($consulta_chk_report,"chk_11_6").'</td>
                    <td class="desc">11.6 Linea organizada por marcas, deporte, género, colecciones</td>
                </tr>
                <tr>
                    <td class="service">'.odbc_result($consulta_chk_report,"chk_11_7").'</td>
                    <td class="desc">11.7 Simetría, equilibrio y distribución de espacios.</td>
                </tr>
                <tr>
                    <td class="service">'.odbc_result($consulta_chk_report,"chk_11_8").'</td>
                    <td class="desc">11.8 Control de material POP de la línea de ropa.</td>
                </tr>
            <tr>
                <th class="title-row" colspan="2">12.- CONTEO DIARIO DE ROPA</th>
            </tr>
                <tr>
                    <td class="service">'.odbc_result($consulta_chk_report,"chk_12_1").'</td>
                    <td class="desc">12.1 Conteo físico de prendas por marca y de árboles</td>
                </tr>
            <tr>
                <th class="title-row" colspan="2">13.- EXHIBICIÓN EN VITRINA (LAS TRES LINEAS)</th>
            </tr>
                <tr>
                    <td class="service">'.odbc_result($consulta_chk_report,"chk_13_1").'</td>
                    <td class="desc">13.1 Limpieza de pisos, maniquies y pared</td>
                </tr>
                <tr>
                    <td class="service">'.odbc_result($consulta_chk_report,"chk_13_2").'</td>
                    <td class="desc">13.2 Ubicación de maniquies</td>
                </tr>
                <tr>
                    <td class="service">'.odbc_result($consulta_chk_report,"chk_13_3").'</td>
                    <td class="desc">13.3 Exhibición del producto en vitrina (ambientes)</td>
                </tr>
                <tr>
                    <td class="service">'.odbc_result($consulta_chk_report,"chk_13_4").'</td>
                    <td class="desc">13.4 Control de cumplimiento de publicidad y material POP.</td>
                </tr>
                 <tr>
                    <td class="service">'.odbc_result($consulta_chk_report,"chk_13_5").'</td>
                    <td class="desc">13.5 Control de exhibición ylimpieza de vitrinas internas (pequeñas)</td>
                </tr>
            <tr>
                <th class="title-row" colspan="2">14.- BODEGA</th>
            </tr>
                <tr>
                <td class="service">'.odbc_result($consulta_chk_report,"chk_14_1").'</td>
                <td class="desc">14.1 Control de limpieza de los baños</td>
                </tr>
                <tr>
                    <td class="service">'.odbc_result($consulta_chk_report,"chk_14_2").'</td>
                    <td class="desc">14.2 Control de limpieza del comedor</td>
                </tr>
                <tr>
                    <td class="service">'.odbc_result($consulta_chk_report,"chk_14_3").'</td>
                    <td class="desc">14.3 Correcta ubicación del producto (las tres lineas)</td>
                </tr>
                <tr>
                    <td class="service">'.odbc_result($consulta_chk_report,"chk_14_4").'</td>
                    <td class="desc">14.4 Orden y arreglo de perchas de bodega. (secuencia cód. y tallas)</td>
                </tr>
                <tr>
                    <td class="service">'.odbc_result($consulta_chk_report,"chk_14_5").'</td>
                    <td class="desc">14.5 Orden y arreglo de cajones de bodega. (secuencia cód. y tallas)</td>
                </tr>
            <tr>
                <th class="title-row" colspan="2">15.- RECOMENDACIÓN DEL PRODUCTO</th>
            </tr>
                <tr>
                   <td class="service">'.odbc_result($consulta_chk_report,"chk_15_1").'</td>
                   <td class="desc">15.1.- Distribución del producto al personal</td>
                </tr>
            <tr>
                <th class="title-row" colspan="2">16.- MANTENIMIENTO DEL LOCAL</th>
            </tr>
                <tr>
                    <td class="service">'.odbc_result($consulta_chk_report,"chk_16_1").'</td>
                    <td class="desc">16.1.- Focos y lamparas en buen estado</td>
                </tr>
                <tr>
                    <td class="service">'.odbc_result($consulta_chk_report,"chk_16_2").'</td>
                    <td class="desc">16.2.- Extructuras, pintura, filtraciones</td>
                </tr>
                <tr>
                    <td class="service">'.odbc_result($consulta_chk_report,"chk_16_3").'</td>
                    <td class="desc">16.3.- Slatwall en buen estado.</td>
                </tr>
            <tr>
                <th class="title-row" colspan="2">17.- APAGADO DE LUCES Y EQUIPOS</th>
            </tr>
                <tr>
                    <td class="service">'.odbc_result($consulta_chk_report,"chk_17_1").'</td>
                    <td class="desc">17.1.- Apagado de luces y rotulos</td>
                </tr>
                <tr>
                    <td class="service">'.odbc_result($consulta_chk_report,"chk_17_2").'</td>
                    <td class="desc">17.2.- Apagado de luces local y bodegas</td>
                </tr>
                <tr>
                    <td class="service">'.odbc_result($consulta_chk_report,"chk_17_3").'</td>
                    <td class="desc">17.3.- Apagado de luces de vitrinas</td>
                </tr>
                <tr>
                    <td class="service">'.odbc_result($consulta_chk_report,"chk_17_4").'</td>
                    <td class="desc">17.4.- Apagado de equipos de computación</td>
                </tr>
                <tr>
                    <td class="service">'.odbc_result($consulta_chk_report,"chk_17_5").'</td>
                    <td class="desc">17.5.- Micro ondas desconectado</td>
                </tr>
                <tr>
                    <td class="service">'.odbc_result($consulta_chk_report,"chk_17_6").'</td>
                    <td class="desc">17.6.- Apagado de Motorola</td>
                </tr>
            <tr>
                <th class="title-row" colspan="2">18.- BODEGA SALIDA</th>
            </tr>
                <tr>
                    <td class="service">'.odbc_result($consulta_chk_report,"chk_18_1").'</td>
                    <td class="desc">18.1.- Material de exhibición en su lugar (ganchos, armadores, tablillas, etc.)</td>
                </tr>
                <tr>
                    <td class="service">'.odbc_result($consulta_chk_report,"chk_18_2").'</td>
                    <td class="desc">18.2.- Limpiones, trapeadores en su lugar y limpios</td>
                </tr>
                <tr>
                    <td class="service">'.odbc_result($consulta_chk_report,"chk_18_3").'</td>
                    <td class="desc">18.3.- Material POP ordenado (tablillas de descuento, tablilla azul, habladores)</td>
                </tr>
                <tr>
                    <td class="service">'.odbc_result($consulta_chk_report,"chk_18_4").'</td>
                    <td class="desc">18.4.- Alarmas y pines en su lugar, ordenados no regados en el piso ni bodega</td>
                </tr>
                <tr>
                    <td class="service">'.odbc_result($consulta_chk_report,"chk_18_5").'</td>
                    <td class="desc">18.5.- Baños,  comedor, labavos limpios</td>
                </tr>
                <tr>
                    <td class="service">'.odbc_result($consulta_chk_report,"chk_18_6").'</td>
                    <td class="desc">18.6.- Vajillas limpias y ordenadas</td>
                </tr>
                <tr>
                    <td class="service">'.odbc_result($consulta_chk_report,"chk_18_6").'</td>
                    <td class="desc">18.7.- Mercadería en el lugar correspondiente (ordenado)</td>
                </tr>
            <tr>
                <th class="title-row" colspan="2">19.- CAJA</th>
            </tr>
                <tr>
                     <td class="service">'.odbc_result($consulta_chk_report,"chk_19_1").'</td>
                     <td class="desc">19.1.- Orden y limpieza de caja.</td>
                 </tr>
                 <tr>
                     <td class="service">'.odbc_result($consulta_chk_report,"chk_19_2").'</td>
                     <td class="desc">19.2.- Archivo de documentración.</td>
                 </tr>
                 <tr>
                     <td class="service">'.odbc_result($consulta_chk_report,"chk_19_3").'</td>
                     <td class="desc">19.3.- Regreso del producto a la bodega.</td>
                 </tr>
                 <tr>
                     <td class="service">'.odbc_result($consulta_chk_report,"chk_19_4").'</td>
                     <td class="desc">19.4.- Control de costureros (completos y en orden).</td>
                 </tr>
                 <tr>
                     <td class="service">'.odbc_result($consulta_chk_report,"chk_19_5").'</td>
                     <td class="desc">19.5.- Suministros de oficina (completos y ordenados ).</td>
                 </tr>
                 <tr>
                     <td class="service">'.odbc_result($consulta_chk_report,"chk_19_6").'</td>
                     <td class="desc">19.6.- Control de utilización de papel continuo y digital (evitar desperdicio).</td>
                 </tr>
                 <tr>
                     <td class="service">'.odbc_result($consulta_chk_report,"chk_19_7").'</td>
                     <td class="desc">19.7.- Botiquin completo y ordenado.</td>
                </tr>
                <tr>
                <th class="title-row" ></th>
                <th class="title-row">PUNTAJE</th>
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
    

        
     
    