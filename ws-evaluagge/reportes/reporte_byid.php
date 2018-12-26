<?php
    
    require_once '../../ws-admin/acceso_multi_db.php';
    require_once '../../libs/mpdf/mpdf.php';
    
    $db_wssp = getDataBase('009');
    
    $codigoEV = filter_input(INPUT_GET, 'codEV');
    
    $query = "SELECT EJI.*, (SBIO.Nombre + SBIO.Apellido) as SolicitanteN, SBIOEMPRESAS.Nombre as EmpresaN, (SBIOEMPLEADO.Nombre+SBIOEMPLEADO.Apellido) as EvaluadoN  FROM dbo.CAB_EJI as EJI INNER JOIN SBIOKAO.dbo.Empleados as SBIO ON EJI.solicitante = SBIO.Cedula INNER JOIN SBIOKAO.dbo.Empresas_WF as SBIOEMPRESAS ON SBIOEMPRESAS.Codigo = EJI.empresa INNER JOIN SBIOKAO.DBO.Empleados as SBIOEMPLEADO ON SBIOEMPLEADO.Codigo = EJI.empleado WHERE EJI.codigo = '$codigoEV'";
    $resultSet = odbc_exec($db_wssp, $query);

    $empresa = odbc_result($resultSet,"EmpresaN");
    $fecha = odbc_result($resultSet,"fecha");
    $solicitante = odbc_result($resultSet,"SolicitanteN");
    $evaluado = odbc_result($resultSet,"EvaluadoN");

    $obervacion = odbc_result($resultSet,"observacion");
    
    $cod_estado = odbc_result($resultSet,"estado");
    
    $query_resultados =  "SELECT * FROM dbo.resultados_EJI WHERE codEV = '$codigoEV'";
    $resultSet_resultados = odbc_exec($db_wssp, $query_resultados);
    
    $resultadoEVTOTAL = odbc_result($resultSet_resultados,"totalEV");
    if ($resultadoEVTOTAL <= 104 && $resultadoEVTOTAL >= 90.5){
        $valoracion_txt = 'EXCELENTE: DESEMPEÑO ALTO';
    }       
    elseif ($resultadoEVTOTAL <= 90.4 && $resultadoEVTOTAL >= 80.5){
        $valoracion_txt = 'MUY BUENO: DESEMPEÑO MEJOR A LO ESPERADO';
    }
    elseif ($resultadoEVTOTAL <= 80.4 && $resultadoEVTOTAL >= 70.5){   
        $valoracion_txt = 'SATISFACTORIO: DESEMPEÑO ESPERADO';
    }
    elseif ($resultadoEVTOTAL <= 70.4 && $resultadoEVTOTAL >= 60.5){   
        $valoracion_txt = 'REGULAR: DESEMPEÑO BAJO LO ESPERADO';
    }
    elseif ($resultadoEVTOTAL < 60.5){   
        $valoracion_txt = 'INSUFICIENTE: DESEMPEÑO MUY BAJO A LO ESPERADO';
    }
    else{
        $valoracion_txt = 'No determinado';
    }    
    
    
    
    
     $html = '
      
     <body>
    <header class="clearfix">
      <div id="logo">
        <img class="logo" src="logo.png">
      </div>
      <h1>Reporte de Evaluación de Jefe Inmediato</h1>
      <div id="contenedor_info">
            <div id="company" class="clearfix">
              <div>KAO Sport Center</div>
              <div>Av. de los Shyris y Naciones Unidas Edificio Nuñez Vela<br /> Quito, Ecuador</div>
              <div>(593-2)-2550005</div>
              <div><a href="mailto:info@kaosport.com">info@kaosport.com</a></div>
            </div>
            <div id="datos1">
              <div><span>CODIGO EV: </span> '.$codigoEV.' </div>
              <div><span>EMPRESA/LOCAL: </span> '.$empresa.' </div>
              <div><span>SUPERVISOR: </span> '.$solicitante.' </div>
              <div><span>EVALUADO: </span> '.$evaluado.' </div>
              <div><span>FECHA:</span> '.$fecha.'</div>
            </div>
      </div>    
    </header>
    <main>
        <div class="grupo-2">
        <table>
            <thead>
              <tr>
                  <th class="title-row" colspan="3">RESULTADOS</th>
              </tr>
              <tr>
                <th class="desc" >#</th>
                <th class="desc">INDICADOR</th>
                <th class="desc">PUNTAJE</th>
              </tr>
            </thead>
            <tbody>
                
                <tr>
                    <td class="service">1.</td>
                    <td class="service">Actividades Esenciales</td>
                    <td class="service">'.odbc_result($resultSet_resultados,"ActividadesEsenciales").'</td>
                </tr>
            
                <tr>
                    <td class="service">2.</td>
                    <td class="service">Conocimientos</td>
                    <td class="service">'.odbc_result($resultSet_resultados,"Conocimientos").'</td>
                </tr>
            
                <tr>
                    <td class="service">3.</td>
                    <td class="service">Competencias Técnicas del Puesto</td>
                    <td class="service">'.odbc_result($resultSet_resultados,"ComTecnicas").'</td>
                </tr>
            
                <tr>
                    <td class="service">4.</td>
                    <td class="service">Competencias Universales</td>
                    <td class="service">'.odbc_result($resultSet_resultados,"ComUniversales").'</td>
                </tr>
            
                <tr>
                    <td class="service">5.</td>
                    <td class="service">Trabajo en Equipo, Iniciativa y Liderazgo</td>
                    <td class="service">'.odbc_result($resultSet_resultados,"TIL").'</td>
                </tr>
            
                <tr>
                    <td class="service">6.</td>
                    <td class="service">Relaciones cliente interno</td>
                    <td class="service" id="backrojo">'.odbc_result($resultSet_resultados,"RelClienteInterno").'</td>
                </tr>
            
                <tr>
                    <td class="service"></td>
                    <td class="service">Factor de Evaluacion</td>
                    <td class="service">'.odbc_result($resultSet_resultados,"factor").'</td>
                </tr>
                
                <tr>
                    <td class="service"></td>
                    <td class="service">Puntaje de Evaluacion</td>
                    <td class="service">'.odbc_result($resultSet_resultados,"totalEV").'</td>
                </tr>

            </tbody>
        </table>
        </div>
        
        <div id="cont_firmas">
            <div id="firma1">Firma Autorizada</div>
        </div>
        
        <div>Valoración: '.$valoracion_txt.' </div>
        <div>Observaciones: '.$obervacion.' </div>
        
    </main>
    <div class="grupo-2">
    
    </div>
  </body>

    ';
            
  //Seteo de PDF
        $name_doc = 'reporte_local'.'.pdf';
        $css = file_get_contents('style.css');
        $destino = 'I';
    
    $mpdf = new mPDF('c','A4');
    $mpdf->WriteHTML($css,1);
    $html = mb_convert_encoding($html, 'UTF-8', 'UTF-8');
    $mpdf->WriteHTML($html);
    $mpdf->SetTitle("Reporte Generado");
    $mpdf->Output($name_doc, $destino);
    
