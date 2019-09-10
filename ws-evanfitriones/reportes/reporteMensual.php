<?php
    require_once '../../ws-admin/acceso_multi_db.php';
    require_once '../../libs/mpdf/mpdf.php';
   
    $empresa = $_GET['empresa_search'];
    $fechaINI = $_GET['dateini'];
    $fechaFIN = $_GET['datefin'];
    
    $name_doc = 'reporte'.$empresa_search.'.pdf';
    $css = file_get_contents('../assets/reportesStyles.css');
    $destino = 'I';
    
    $html = '
             
        <div style="width: 100%;">
    
            <div id="logosection">
                <img id="logo" src="../assets/logo_dark.png" alt="Logo">
            </div>

            
            <div id="informacion">
                    <h3>Evaluacion de Anfitriones</h3>
            </div>
          
    
        </div>
    
        <div id="infoCliente" class="rounded">
            <div class="cabecera"><b>Fecha de reporte:</b> '.date('Y-m-d').' </div>
            <div class="cabecera"><b>Desde: </b> '.$fecha_ini.'</div>
            <div class="cabecera"><b>Hasta:</b> '.$fecha_fin.'</div>
        </div>
        <span>Lista de Evaluaciones</span>
    
        <table class="items" width="100%" style="font-size: 9pt; border-collapse: collapse; " cellpadding="8">
            <thead>
                <tr>
                    <td width="10%">ID</td>
                    <td width="10%">Cod EV.</td>
                    <td width="20%">Evaluador</td>
                    <td width="20%">Evaluado</td>
                    <td width="10%">Fecha</td>
                    <td width="10%">Puntaje</td>
                    <td width="10%">Meta</td>
                    <td width="10%">A recibir</td>
                    
                </tr>
            </thead>
        <tbody>';
            
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
                  evaluacion.meta,
                  evaluacion.estado
                  FROM dbo.ev_anfitriones as evaluacion
                  LEFT JOIN SBIOKAO.DBO.Empleados AS empleado ON empleado.Codigo = evaluacion.empleado 
                  LEFT JOIN SBIOKAO.dbo.Empleados AS supervisor ON supervisor.Cedula = evaluacion.supervisor
                  INNER JOIN SBIOKAO.dbo.Empresas_WF as empresa ON empresa.Codigo = evaluacion.empresa
                  WHERE
                      evaluacion.fecha BETWEEN '$fechaINI' AND '$fechaFIN'
                      AND evaluacion.empresa = '$empresa'
              ORDER BY id DESC
           ";
            
            $result_query = odbc_exec($db_empresa, $query);
           
            while(odbc_fetch_row($result_query))
            {
                $id = odbc_result($result_query,"id");
                $cod_evaluacion = odbc_result($result_query,"codEvaluacion");
                $empresacodDB = trim(odbc_result($result_query,"nombreEmpresa"));
                $supervisor_pdf = iconv("iso-8859-1", "UTF-8", odbc_result($result_query,"nombreSupervisor"));
                $empleado_pdf = iconv("iso-8859-1", "UTF-8", odbc_result($result_query,"nombreEmpleado"));
                $fechaPDF = odbc_result($result_query,"fecha");
                $puntaje = odbc_result($result_query,"sumatoria");
                $meta = odbc_result($result_query,"meta");
                $observacion = odbc_result($result_query,"observacion");
                
                if($puntaje>25){
                    $extra = 30;
                }elseif($puntaje<=25){
                    $extra = 20;
                }else{
                    $extra = 0;
                }

              $html .= '
              <tr>
                <td>'.$id.'</td>
                <td>'.$cod_evaluacion.'</td>
                <td>'.$supervisor_pdf.'</td>
                <td>'.$empleado_pdf.'</td>
                <td>'.$fechaPDF.'</td>
                <td>'.$puntaje.'</td>
                <td>'.$meta.'</td>
                <td> $ '.$extra.'</td>
             
              </tr>';
            }

        $html .= ' 
        
    
        <!-- END ITEMS HERE -->
            
        </tbody>
        </table>';

        $html .= ' 
        
        
    ';  
    
    $mpdf = new mPDF('c','A4');
    $mpdf->WriteHTML($css,1);
    $html = mb_convert_encoding($html, 'UTF-8', 'UTF-8');
    $mpdf->SetTitle("Reporte Generado");
    $mpdf->WriteHTML($html);
    $mpdf->Output($name_doc, $destino);
    

        
     
    