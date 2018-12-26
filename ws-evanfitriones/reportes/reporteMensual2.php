<?php
    require_once '../../ws-admin/acceso_multi_db.php';
    require_once '../../libs/mpdf/mpdf.php';
   
    $empresa_search = $_GET['empresa_search'];
    $fecha_ini = $_GET['dateini'];
    $fecha_fin = $_GET['datefin'];
    
    $dias = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");
    $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
 
    $fecha_actual= $dias[date('w')]." ".date('d')." de ".$meses[date('n')-1]. " del ".date('Y') ;

// Metadados de PDF
    
    $name_doc = 'reporte'.$empresa_search.'.pdf';
    $css = file_get_contents('style.css');
    $destino = 'I';
    
    $html = '
      
     <body>
    <header class="clearfix">
      <div id="logo">
        <img class="logo" src="logo.png">
        
      </div>
      <h1>EVALUACION DE PERSONAL ANFITRIONES</h1>
      <div id="contenedor_info">
            <div id="company" class="clearfix">
              <div>KAO Sport Center</div>
              <div>Av. de los Shyris y Naciones Unidas Edificio Nuñez Vela<br /> Quito, Ecuador</div>
              <div>(593-2)-2550005</div>
              <div><a href="mailto:info@kaosport.com">info@kaosport.com</a></div>
            </div>
            <div id="datos1">
              <div><span>EMPRESA: </span> '.$empresa_search.' </div>
              <div><span>FECHA DEL REPORTE:</span> '.  $fecha_actual .'</div>
            </div>
      </div>    
    </header>
    <main>
        <div class="grupo-2">
        <table>
            <thead>
            <tr>
                <th class="title-row" >ID</th>
                <th class="title-row">SUPERVISOR</th>
                <th class="title-row">EMPLEADO</th>
                <th class="title-row">FECHA REPORTADA</th>
                <th class="title-row">PUNTAJE</th>
                <th class="title-row">A RECIBIR</th>
            </tr> 
            </thead>
            <tbody>
                ';

            $db_empresa = getDataBase('009'); //Obtenemos conexion con base de datos segun codigo de la DB
            $query = "select top 100 (B.Nombre + B.Apellido)as empleadoN, (c.Nombre + c.Apellido)as supervisorN, d.Nombre as empresaN, A.* from dbo.ev_anfitriones as A INNER JOIN SBIOKAO.DBO.Empleados AS B ON B.Codigo = A.empleado INNER JOIN SBIOKAO.dbo.Empleados as C on C.Cedula = A.supervisor INNER JOIN SBIOKAO.dbo.Empresas_WF as D ON D.Codigo = A.empresa WHERE empresa = '$empresa_search' ORDER BY id ASC";
            $result_consulta_chlocales = odbc_exec($db_empresa, $query);
           
            while(odbc_fetch_row($result_consulta_chlocales))
            {
                //RECUPERAR DATOS
                $cod_reporte = odbc_result($result_consulta_chlocales,"id");
                //$empresa = odbc_result($result_consulta_chlocales,"NombreEmpresaN");
                $empresacodDB = odbc_result($result_consulta_chlocales,"empresaN");
                //Recodificacion de ISO-8859 a UTF
                $supervisor_pdf = iconv("iso-8859-1", "UTF-8", odbc_result($result_consulta_chlocales,"supervisorN"));
                $empleado_pdf = iconv("iso-8859-1", "UTF-8", odbc_result($result_consulta_chlocales,"empleadoN"));
                $fechaPDF = odbc_result($result_consulta_chlocales,"fecha");
                $puntaje = odbc_result($result_consulta_chlocales,"sumatoria");
                
                if($puntaje>25){
                    $extra = 30;
                }elseif($puntaje<=25){
                    $extra = 20;
                }else{
                    $extra = 0;
                }

              $html .= '
              <tr>
                <td class="service">'.$cod_reporte.'</td>
                <td class="service">'.$supervisor_pdf.'</td>
                <td class="service">'.$empleado_pdf.'</td>
                <td class="service">'.$fechaPDF.'</td>
                <td class="service">'.$puntaje.' / 28</td>
                <td class="service">$ '.$extra.'</td>
             
              </tr>';
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
            
    
    $mpdf = new mPDF('c','A4');
    $mpdf->WriteHTML($css,1);
    $html = mb_convert_encoding($html, 'UTF-8', 'UTF-8');
    $mpdf->SetTitle("Reporte Generado");
    $mpdf->WriteHTML($html);
    $mpdf->Output($name_doc, $destino);
    

        
     
    