<?php
    session_start();
    require_once '../../libs/mpdf/mpdf.php';
    require_once '../../ws-admin/acceso_multi_db.php';
   
   
    $db_wssp = getDataBase('009'); //Codigo 009 Conexion con WSSP
    
    $id_valep = $_GET['valep_cod'];
    $id_empresa_report = $_GET['empresa_cod'];
    
    $db_empresa = getDataBase($_SESSION['empresa_autentificada']); //Codigo 008 db MODELO
    
    //ANTIGUA CONSULTA $sql_vales_perdida = "SELECT A.ID ,(B.Apellido + B.Nombre)as ci_solicitanteN, (C.Apellido + C.Nombre) as supervisorN, Empresas_WF.Nombre as empresaN, A.SUBTOTAL, A.IMPUESTO, A.TOTAL, VALEP.ESTADO FROM dbo.VEN_CAB as A, KAO_wssp.dbo.vales_perdida as VALEP with (nolock) INNER JOIN SBIOKAO.dbo.Empleados as B on B.Cedula = VALEP.ci_solicitante INNER JOIN SBIOKAO.dbo.Empleados as C on C.Codigo = VALEP.supervisor INNER JOIN SBIOKAO.dbo.Empresas_WF on SBIOKAO.dbo.Empresas_WF.Codigo = VALEP.empresa  WHERE ID = '$id_valep'";
    $sql_vales_perdida = "SELECT VALEP.*, A.NOMBRE as SolicitanteN, B.NOMBRE as BodegaN, C.Nombre as EmpresaN, D.NOMBRE as TipoDocN FROM KAO_wssp.dbo.vales_perdida as VALEP with (nolock) INNER JOIN COB_CLIENTES as A ON A.RUC COLLATE Modern_Spanish_CI_AS = VALEP.ci_solicitante COLLATE Modern_Spanish_CI_AS INNER JOIN dbo.INV_BODEGAS as B on B.CODIGO COLLATE Modern_Spanish_CI_AS = VALEP.bodega COLLATE Modern_Spanish_CI_AS INNER JOIN SBIOKAO.dbo.Empresas_WF as C on C.Codigo = VALEP.empresa INNER JOIN dbo.VEN_TIPOS as D on D.CODIGO COLLATE Modern_Spanish_CI_AS = VALEP.tipo_doc COLLATE Modern_Spanish_CI_AS WHERE VALEP.cod_valep ='$id_valep' and VALEP.empresa='$id_empresa_report'";
    
    $consulta_vales_perdida = odbc_exec($db_empresa, $sql_vales_perdida);

    $cod_reporte = odbc_result($consulta_vales_perdida,"cod_valep");
    //Recodificacion de ISO-8859 a UTF8
    $tipodocName = iconv("iso-8859-1", "UTF-8", odbc_result($consulta_vales_perdida,"TipoDocN"));
    $empresa_pdf = iconv("iso-8859-1", "UTF-8", odbc_result($consulta_vales_perdida,"empresa"));
    $empresa_pdf_name = iconv("iso-8859-1", "UTF-8", odbc_result($consulta_vales_perdida,"EmpresaN"));
    $bodega_pdf = iconv("iso-8859-1", "UTF-8", odbc_result($consulta_vales_perdida,"bodega"));
    $bodega_pdf_name = iconv("iso-8859-1", "UTF-8", odbc_result($consulta_vales_perdida,"BodegaN"));
    
    //Obtenemos instancia de la base de tatos que figura en la tabla
    
    $fecha_SolicitadaVALE = odbc_result($consulta_vales_perdida,"fecha");
    $solicitante_pdf = iconv("iso-8859-1", "UTF-8", odbc_result($consulta_vales_perdida,"ci_solicitante"));
    $solicitante_pdf_name = iconv("iso-8859-1", "UTF-8", odbc_result($consulta_vales_perdida,"SolicitanteN"));
    $subtotal = round(odbc_result($consulta_vales_perdida,"subtotal"),2);
    $iva = round(odbc_result($consulta_vales_perdida,"iva"),2);
    $total = round(odbc_result($consulta_vales_perdida,"total"),2);
    
    $cod_estado = odbc_result($consulta_vales_perdida,"estado");
    $comment_pdf = odbc_result($consulta_vales_perdida,"comentario");
    
    //Estado del Vale
    
    switch ($cod_estado) 
    {
    case 1:
        $estado_txt = 'Aprobado';
            break;
        
    case 2:
        $estado_txt = 'Anulado';
            break;    

    default:
        $estado_txt = 'Pendiente';
        break;
    }
    
  
    $rest = substr($cod_reporte, -11, 3);
    
    switch ($rest) 
    {
    case 'SPA':
        $sup_txt = 'TIPO SPA';
            break;
        
    case 'SPB':
        $sup_txt = 'TIPO SPB';
            break;    

    case 'SPC':
        $sup_txt = 'TIPO SPC';
            break;

    case 'SPD':
        $sup_txt = 'TIPO SPD';
            break; 

    case 'SPE':
      $sup_txt = 'TIPO SPE';
          break;         

    case 'SPF':
    $sup_txt = 'TIPO SPF';
        break;         
    
    default:
        $sup_txt = 'No definido';
        break;
    }
    
    
    // Metadados de PDF
    $fecha = date ("Y-n-j");
    $name_doc = 'reporte'.$doc_sinespacios.'.pdf';
    $css = file_get_contents('style.css');
    $destino = 'I';
    
    
    
    $html = '
      
    
     <body>
    <header class="clearfix">
      <div id="logo">
        <img src="logo.png" height="60" width="110">
      </div>
      <h1>SOLICITUD DE PÉRDIDA</h1>
      <div id="contenedor_info">
            <div id="company" class="clearfix">
              <div>KAO Sport Center</div>
              <div>Av. de los Shyris y Naciones Unidas Edificio Nuñez Vela<br /> Quito, Ecuador</div>
              <div>(593-2)-2550005</div>
              <div><a href="mailto:info@kaosport.com">info@kaosport.com</a></div>
            </div>
            <div id="datos1">
              <div><span>CÓDIGO </span> '.$cod_reporte.' ('.$sup_txt.') </div>
              <div><span>DIRIGIDO A: </span> '.strtoupper($tipodocName).' </div>
              <div><span>BODEGA/EMPRESA: </span> '.$empresa_pdf_name.'-'.$bodega_pdf_name.' </div>
              <div><span>SOLICITANTE: </span> '.$solicitante_pdf_name.'</div>
                <div><span>CEDULA: </span> '.$solicitante_pdf.'</div>
              <div><span>GENERADO EL:</span> '.$fecha_SolicitadaVALE.'</div>
            </div>
      </div>    
    </header>
    <main>
        <!-- SECCION ITEMS REPORTADOS-->
        <div class="grupo-2">
        <table>
            <thead>
              <tr>
                  <th class="title-row" colspan="6">ITEMS REPORTADOS</th>
              </tr>
              <tr>
                <th class="service">Cod</th>
                <th class="desc">DESCRIPCIÓN</th>
                <th>CANTIDAD</th>
                <th>% DESCUENTO</th>
                <th>V/UNITARIO</th>
                <th>V/TOTAL</th>
              </tr>
            </thead>
            <tbody>';
            
            $sql_detalle_valep = "SELECT VALEP.empresa, VALEP.cod_detalle_valep, A.CODIGO, A.CANTIDAD, a.PRECIOTOT, a.PRECIO, A.DESCU, B.Nombre as NOMBREART FROM dbo.VEN_MOV as A INNER JOIN dbo.INV_ARTICULOS as B on A.CODIGO = B.Codigo INNER JOIN KAO_wssp.dbo.detalle_valep as VALEP ON VALEP.cod_producto COLLATE Modern_Spanish_CI_AS = A.CODIGO collate Modern_Spanish_CI_AS where ID='$id_valep' AND cod_detalle_valep = '$id_valep' and VALEP.empresa='$empresa_pdf'";
            $consulta_detalle_valep = odbc_exec($db_empresa, $sql_detalle_valep);
    
            while (odbc_fetch_row($consulta_detalle_valep)) {
                        
            $cod_prod = odbc_result($consulta_detalle_valep,"CODIGO");
            $descripcion_prod = iconv("iso-8859-1", "UTF-8",odbc_result($consulta_detalle_valep,"NOMBREART"));  
            $cantidad_prod = odbc_result($consulta_detalle_valep,"CANTIDAD"); 
            $descuporcent_producto = round(odbc_result($consulta_detalle_valep, "DESCU"), 2); //numeric (18,6)
            $valor_prod = odbc_result($consulta_detalle_valep,"PRECIO"); 
            $valor_tot = odbc_result($consulta_detalle_valep,"PRECIOTOT");  

              $html .= '
              <tr>
                <td class="service">'.$cod_prod.'</td>
                <td class="desc">'.$descripcion_prod.'</td>
                <td class="ptn">'.$cantidad_prod.'</td>
                <td class="ptn">'.$descuporcent_producto.'</td>
                <td class="ptn">'.round($valor_prod,2).'</td>
                <td class="ptn">'.round($valor_tot,2).'</td>
              </tr>';

            }
    
    $html .= '     

            </tbody>
        </table>
        </div>
        
        <!-- SECCION PERSONAL RECARGO-->
      
        <div class="grupo-2">
        <table>
            <thead>
              <tr>
                  <th class="title-row" colspan="6">PERSONAL REPORTADO</th>
              </tr>
              <tr>
                <th class="service">CI</th>
                <th class="desc">EMPLEADO</th>
                <th>PORCENTAJE</th>
                <th>VALOR</th>
                <th>CUOTA x MES</th>
                <th>FIRMA</th>
              </tr>
            </thead>
            <tbody>';
              
            $sql_recargo_valep = "SELECT * FROM dbo.COB_CLIENTES as A with (nolock) INNER JOIN KAO_wssp.dbo.recargo_valep as VALEP on A.RUC COLLATE Modern_Spanish_CI_AS = VALEP.ci_empleado_rec COLLATE Modern_Spanish_CI_AS WHERE cod_recargo_valep = '$id_valep' and VALEP.empresa='$empresa_pdf'";
            $consulta_recargo_valep = odbc_exec($db_empresa, $sql_recargo_valep);
    
            while (odbc_fetch_row($consulta_recargo_valep)) {
                        
            $ci_empleado_valep = odbc_result($consulta_recargo_valep,"ci_empleado_rec");
            $nombre_emp_valep = iconv("iso-8859-1", "UTF-8",odbc_result($consulta_recargo_valep,"NOMBRE"));  
            $porcentaje_emp = odbc_result($consulta_recargo_valep,"porcentaje"); 
            $valor_emp = odbc_result($consulta_recargo_valep,"valor");  

            $cuota_emp = 0;
            $cant_coutas = 1;
            if ($valor_emp >= 10){
              $cuota_emp = round($valor_emp/3, 2);
              $cant_coutas = 3;
            }else{
              $cuota_emp =  $valor_emp;
              $cant_coutas = 1;
            }

              $html .= '
              <tr>
                <td class="service">'.$ci_empleado_valep.'</td>
                <td class="desc">'.$nombre_emp_valep.'</td>
                <td class="ptn">'.$porcentaje_emp.'</td>
                <td class="ptn bordebajo">$ '.$valor_emp.'</td>
                <td class="ptn bordebajo">$ '.$cuota_emp.' x '.$cant_coutas.'</td>
                <td class="ptn bordebajo"></td>
              </tr>';

            }

        $html .= '    
               
            </tbody>
        </table>
        </div>
        
         <!-- SECCION RESUMEN-->
        
        <div class="grupo-2">
        <table>
            <thead>
              <tr>
                  <th class="title-row" colspan="2">MONTO TOTAL</th>
              </tr>
              <tr>
               
                <th class="service">DESCRIPCIÓN</th>
                <th class="desc">VALOR</th>
              
              </tr>
            </thead>
            <tbody>
              <tr>
                <td class="service">SUBTOTAL</td>
                <td class="desc">'.$subtotal.'</td>
              </tr>
              <tr>
                <td class="service">IVA</td>
                <td class="desc">'.$iva.'</td>
              </tr>
              <tr>
                <td class="service">TOTAL</td>
                <td class="desc">'.$total.'</td>
              </tr>
              
               
            </tbody>
            
                

        </table>
        
        <div>
            <p>COMENTARIO / OBSERVACION: <span id="coments">'.$comment_pdf.'</span></p>
        </div>

        </div>
        
        <div id="cont_firmas">
       
              <div id="firmasola">Firma de Jefe de Almacen </div>
               
        </div>

    </main>
   
  </body>

    ';
            
    
    $mpdf = new mPDF('c','A4');
    $mpdf->WriteHTML($css,1);
    $html = mb_convert_encoding($html, 'UTF-8', 'UTF-8');
    $mpdf->SetTitle("Reporte Generado");
    $mpdf->SetHTMLHeader('
      <div id="cod">
        <h5 class="myheader">ESTADO: '.$estado_txt.'</h5>
        <h5 class="myheader">Documento: '.$cod_reporte.'</h5>
        <h5 class="myheader">Página: {PAGENO} de {nbpg}</h5>  
      </div> ');
      $mpdf->SetHTMLFooter('
      <div class="grupo-2">
       
        
      </div> ');  
  
    
    $mpdf->WriteHTML($html);
    $mpdf->Output($name_doc, $destino);
    

        
     
    