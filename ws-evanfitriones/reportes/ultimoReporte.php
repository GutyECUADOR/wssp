<?php
    require_once '../../ws-admin/acceso_multi_db.php';
    require_once '../../libs/mpdf/mpdf.php';
    
    $dias = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");
    $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
 
    $fecha_actual= $dias[date('w')]." ".date('d')." de ".$meses[date('n')-1]. " del ".date('Y') ;

    $db_empresa = getDataBase('009'); //Obtenemos conexion con base de datos segun codigo de la DB
    $query = "select top 1 (B.Nombre + B.Apellido)as empleadoN, (c.Nombre + c.Apellido)as supervisorN, d.Nombre as empresaN, A.* from dbo.ev_anfitriones as A INNER JOIN SBIOKAO.DBO.Empleados AS B ON B.Codigo = A.empleado INNER JOIN SBIOKAO.dbo.Empleados as C on C.Cedula = A.supervisor INNER JOIN SBIOKAO.dbo.Empresas_WF as D ON D.Codigo = A.empresa ORDER BY id DESC";
    $rs = odbc_exec($db_empresa, $query);
    
    $num_reporte = odbc_result($rs,"id");
    $cod_chequeo = odbc_result($rs,"tipoDoc");
    $empresaN = odbc_result($rs,"empresa");
    $empleadoN = odbc_result($rs,"empleadoN");
    
    $selectAsis1 = odbc_result($rs,"selectAsis1");
    $selectPerm1 = odbc_result($rs,"selectPerm1");
    $selectRetra1 = odbc_result($rs,"selectRetra1");
    $selectActit1 = odbc_result($rs,"selectActit1");
    $selectPredi1 = odbc_result($rs,"selectPredi1");
    $selectCompr1 = odbc_result($rs,"selectCompr1");
    $selectRespon1 = odbc_result($rs,"selectRespon1");
    
    // Campos extras 01/05/2018
  
    $con_funcionesSegu =  odbc_result($rs,"confuncionesSegu");
    $real_muestroAlarmas = odbc_result($rs,"real_muestroAlarmas");
    $man_ordenPuestoTrab = odbc_result($rs,"man_ordenPuestoTrab");
    $registroBorrones = odbc_result($rs,"registroBorrones");
    $herr_buenEstado = odbc_result($rs,"herr_buenEstado");
    $uniformeLimpio = odbc_result($rs,"uniformeLimpio");
    $calzadoLimpio = odbc_result($rs,"calzadoLimpio");
    
    $puntaje = odbc_result($rs,"sumatoria");
    $observacion = odbc_result($rs,"observacion");
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
      <h1>PERSONAL ANFITRIONES - INDIVIDUAL</h1>
      <div id="contenedor_info">
            <div id="company" class="clearfix">
              <div>KAO Sport Center</div>
              <div>Av. de los Shyris y Naciones Unidas Edificio Nuñez Vela<br /> Quito, Ecuador</div>
              <div>(593-2)-2550005</div>
              <div><a href="mailto:info@kaosport.com">info@kaosport.com</a></div>
            </div>
            <div id="datos1">
              <div><span>EMPRESA: </span> '.$empresaN.' </div>
			  <div><span>FECHA DEL REPORTE:</span> '.  $fecha_actual .'</div>
			  <div><span>EMPLEADO EVALUADO: </span> '.$empleadoN.' </div>
            </div>
      </div>    
    </header>
    <main>
        <div class="grupo-2">
        <table>
            <thead>
            <tr>
                <th class="title-row" >#</th>
                <th class="title-row">Item</th>
                <th class="title-row">Puntaje</th>
            </tr> 
            </thead>
            <tbody>
                
            <tr>
                <td class="service">1</td>
                <td class="service">Asiste con puntualidad al lugar de trabajo, capacitaciones, reuniones.</td>
                <td class="service">'.$selectAsis1.'</td>
            </tr>
            
            <tr>
                <td class="service">2</td>
                <td class="service">No es recurrente en los permisos.</td>
                <td class="service">'.$selectPerm1.'</td>
            </tr>
            
            <tr>
                <td class="service">3</td>
                <td class="service">Se atrasa con frecuencia al lugar de trabajo, capacitaciones, reuniones.</td>
                <td class="service">'.$selectRetra1.'</td>
            </tr>
            
            <tr>
                <td class="service">4</td>
                <td class="service">Tiene buena actitud con los clientes y sus compañeros..</td>
                <td class="service">'.$selectActit1.'</td>
            </tr>
            
            <tr>
                <td class="service">5</td>
                <td class="service">Predisposición al cambio, nuevos metodos de trabajo.</td>
                <td class="service">'.$selectPredi1 .'</td>
            </tr>

            <tr>
                <td class="service">6</td>
                <td class="service">Desarrolla buenas relaciones con clientes y Jefes.</td>
                <td class="service">'.$selectCompr1 .'</td>
            </tr>
            
            <tr>
                <td class="service">7</td>
                <td class="service">Asume con responsabildad las tareas asignadas, es reponsables de las herramientas y equipos a su cargo.</td>
                <td class="service">'.$selectRespon1.'</td>
            </tr>
            

            <tr>
                <td class="service">8</td>
                <td class="service">Conoce sus funciones de Seguridad.</td>
                <td class="service">'.$con_funcionesSegu.'</td>
            </tr>
            
            <tr>
                <td class="service">9</td>
                <td class="service">.Realiza muestreo de alarmas</td>
                <td class="service">'.$real_muestroAlarmas.'</td>
            </tr>
            
            <tr>
                <td class="service">10</td>
                <td class="service">Mantiene en orden y limpieza su puesto de trabajo.</td>
                <td class="service">'.$man_ordenPuestoTrab.'</td>
            </tr>
            
            <tr>
                <td class="service">11</td>
                <td class="service">Presenta registros sin borrones y tachones.</td>
                <td class="service">'.$registroBorrones.'</td>
            </tr>
            
            <tr>
                <td class="service">12</td>
                <td class="service">Mantienen en orden y en buen estado sus herramientas.</td>
                <td class="service">'.$herr_buenEstado.'</td>
            </tr>
            
            <tr>
                <td class="service">13</td>
                <td class="service">Uniforme limpio.</td>
                <td class="service">'.$uniformeLimpio.'</td>
            </tr>
            
            <tr>
                <td class="service">14</td>
                <td class="service">Calzado limpio .</td>
                <td class="service">'.$calzadoLimpio.'</td>
            </tr>
            
            <tr>
                <td class="service"></td>
                <td class="service">Puntaje.</td>
                <td class="service">'.$puntaje.'</td>
            </tr>
                
              
            <tr>
                <td class="service">Observacion.</td>
                <td class="service">'.$observacion.'</td>
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
    

        
     
    