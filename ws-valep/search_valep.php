<?php
session_start();
require_once '../ws-admin/acceso_multi_db.php';
   
$cod_empresagrid = $_SESSION['empresa_autentificada'];
$db_empresa = getDataBase($_SESSION['empresa_autentificada']); //Obtenemos conexion con base de datos segun codigo de la DB

$tipo_document = $_POST['tipo_doc'];
$fecha_iniValep = $_POST['post_dateini'];
$fecha_finValep = $_POST['post_datefin'];

$trimDATE1 = str_replace("-", "", $fecha_iniValep);
$trimDATE2 = str_replace("-", "", $fecha_finValep);

switch ($tipo_document) {
    case '':
        echo '
            <div class="alert alert-danger alert-dismissable">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <p> No hubieron resultados. Seleccione un tipo de documento</p>
            <input type="hidden" name="cod_veri" id="cod_veri" value="">
            </div> ';

        break;
    
    //Case vales pendientes
    case 'PND':
        $consulta_valep = "SELECT A.ID, A.TIPO, C.empresa, B.NOMBRE, A.FECHA, C.fechaPagos, C.total FROM dbo.VEN_CAB as A INNER JOIN dbo.COB_CLIENTES as B on A.CLIENTE = B.CODIGO INNER JOIN KAO_wssp.dbo.vales_perdida as C on C.cod_valep COLLATE Modern_Spanish_CI_AS = A.ID COLLATE Modern_Spanish_CI_AS WHERE c.estado = 0 AND c.empresa ='$cod_empresagrid'  AND A.TIPO IN ('SPA','SPB','SPC','SPD','SPE','SPF') AND ID IN (SELECT IDDoc FROM dbo.ORG_DOCUMENTOS WHERE Aprobado=1)ORDER BY A.TIPO, A.ID";
        $result_consulta_valep = odbc_exec($db_empresa, $consulta_valep);
        $count_result = odbc_num_rows($result_consulta_valep);
            if ($count_result>=1){
            echo '
            <div class="alert alert-success alert-dismissable">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <p> '.$count_result.' vale(s) pendiente(s).</p>
            </div> ';
            
            $color_row=array('#DDDDDD', '#CBCBCB');
            $ind_color=0;
      
        
            echo " <table class='tablaedocs'>";    
            echo " <tr class='trcabecera'>
                    <td tdcabecera title='Código'>Código</td>
                    <td tdcabecera title='Tipo Documento'>Tipo Documento</td>
                    <td tdcabecera title='Empresa'>Empresa</td>
                    <td tdcabecera title='Solicitante'>Solicitante</td>
                    <td tdcabecera title='Fecha'>Fecha Solicitada</td>
                    <td tdcabecera title='Fecha'>Fecha Ini Pagos</td>
                    <td tdcabecera title='Estado'>Estado</td>
                    <td tdcabecera title='Total'>Total</td>
                    <td tdcabecera title='Acciones' colspan='2'>Acciones</td>
                    <td tdcabecera title='Reporte'>#</td>
                  </tr>
                ";  
            //Construcción Filas
          
            $cont=0;
            while(odbc_fetch_row($result_consulta_valep))
            {
                
                //RECUPERAR DATOS
                $cod_reporte = odbc_result($result_consulta_valep,"ID");
                $tipo_doc = odbc_result($result_consulta_valep,"TIPO");
                
                //Recodificacion de ISO-8859 a UTF
                $supervisor_pdf = iconv("iso-8859-1", "UTF-8", odbc_result($result_consulta_valep,"NOMBRE"));
                
                $fechaPDF = odbc_result($result_consulta_valep,"FECHA");
                $fechaINIPAGOS = odbc_result($result_consulta_valep,"fechaPagos");
                $cod_empresaValep = odbc_result($result_consulta_valep,"empresa");
                $estadoVALE = "";
                $total = odbc_result($result_consulta_valep,"total");
                
                $cont++;
                $ind_color++;
                $ind_color %= 2;
                
                 switch ($estadoVALE) 
                    {
                    case 1:
                        $estado_txt = 'Aprobado';
                            break;

                    case 2:
                        $estado_txt = 'Anulado / Negado';
                            break;    

                    default:
                        $estado_txt = 'Pendiente';
                        break;
                    }
    
                    switch ($cod_empresaValep) 
                    {
                    case '001':
                        $empresaTxT = 'Importaciones KAO';
                            break;

                    case '002':
                        $empresaTxT = 'KINDRED';
                            break;  
                        
                    case '003':
                        $empresaTxT = 'KINDSMAN';
                            break;  
                    
                    case '004':
                        $empresaTxT = 'FRANKIN ALVAREZ';
                            break;    
                     
                    case '005':
                        $empresaTxT = 'LYNN LEE';
                            break;    
                        
                    case '006':
                    $empresaTxT = 'COMERCIALIZADORA K';
                        break;    

                    case '007':
                    $empresaTxT = 'VERONICA CARRASCO';
                        break;    
                        
                    case '008':
                        $empresaTxT = 'MODELO';
                            break;    
                        
                    default:
                        $empresaTxT = 'No definida';
                        break;
                    }
                
                // Despliege de resultados
                
                $dateINIPagosSpan = date("Ymd", strtotime($fechaINIPAGOS));
                $dateaddINIPagosSpan = date_create($dateINIPagosSpan);
                $dateadd8mas = date_format(date_add($dateaddINIPagosSpan, date_interval_create_from_date_string('15 days')), 'Y-m-d'); // Agregara X dias y devuelve formado Y-m-d
                         
                if (date('Y-m-d') > $fechaINIPAGOS) {
                    $estado_txt = 'Fuera de rango de aprobacion, Fecha Maxima: '. $dateadd8mas;
                }

                    echo"<tr class='celdagrid' bgcolor=${color_row[$ind_color]}>";
                    echo"<td>".$cod_reporte."</td>";
                    echo"<td>".$tipo_doc."</td>";
                    echo"<td>".$empresaTxT."</td>";
                    echo"<td>".$supervisor_pdf."</td>";
                    echo"<td>".$fechaPDF."</td>";
                    echo"<td>".$fechaINIPAGOS."</td>";
                    echo"<td class='textorojo'>".$estado_txt."</td>";
                    echo"<td>".$total."</td>";
                    echo"<td><button type='button' class='btn btn-primary btn-xs btnEditaValep' id='$cod_reporte'> <span class='glyphicon glyphicon-pencil'></span> Editar</button>";    
                    echo"<td><button type='button' class='btn btn-danger btn-xs btnAnulaValep' id='$cod_reporte'> <span class='glyphicon glyphicon-thumbs-down'></span> Negar</button>";    
                   
                    echo"<td class='celdagrid'><a href='#' target='_self'><span class='glyphicon glyphicon-eye-open codvalep' id='$cod_reporte' value='$cod_reporte' title='Ver reporte' onclick='fn_genreport_valep(this)'></span></a></td>";    
                    echo"</td>";
                echo "</tr>";
                }
       
        echo "</table>";
        }
        
        break;
    
    case 'ANUL':
        $consulta_valep = "SELECT ANULADO, * FROM dbo.VEN_CAB WHERE ANULADO='1' and TIPO IN ('SPA','SPB','SPC','SPD','SPE','SPF')";
        $result_consulta_valep = odbc_exec($db_empresa, $consulta_valep);
        $count_result = odbc_num_rows($result_consulta_valep);
            if ($count_result>=1){
            echo '
            <div class="alert alert-success alert-dismissable">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <p> '.$count_result.' resultado(s) encontrado(s).</p>
            </div> ';
            
            $color_row=array('#DDDDDD', '#CBCBCB');
            $ind_color=0;
      
        
            echo " <table class='tablaedocs'>";    
            echo " <tr class='trcabecera'>
                    <td tdcabecera title='Código'>ID</td>
                    <td tdcabecera title='Tipo Documento'>Fecha</td>
                    <td tdcabecera title='Solicitante'>Subtotal</td>
                    <td tdcabecera title='Fecha'>Fecha Impuesto</td>
                    <td tdcabecera title='Total'>Total</td>
                    <td tdcabecera title='Estado'>Anulado por</td>
                    <td tdcabecera title='Estado'>Estado</td>
                    
                  </tr>
                ";  
            //Construcción Filas
          
            $cont=0;
            while(odbc_fetch_row($result_consulta_valep))
            {
                
                //RECUPERAR DATOS
                $cod_reporte = odbc_result($result_consulta_valep,"ID");
                $tipo_doc = odbc_result($result_consulta_valep,"FECHA");
                
                //Recodificacion de ISO-8859 a UTF
                $supervisor_pdf = iconv("iso-8859-1", "UTF-8", odbc_result($result_consulta_valep,"SUBTOTAL"));
                
                $fechaPDF = odbc_result($result_consulta_valep,"IMPUESTO");
                $total = odbc_result($result_consulta_valep,"TOTAL");
                $anuladopor = odbc_result($result_consulta_valep,"ANULADOPOR");
                
                $cont++;
                $ind_color++;
                $ind_color %= 2;
                
               
                $estado_txt = 'Anulado / Negado';
                          
                // Despliege de resultados
                
                    echo"<tr class='celdagrid' bgcolor=${color_row[$ind_color]}>";
                    echo"<td>".$cod_reporte."</td>";
                    echo"<td>".$tipo_doc."</td>";
                    echo"<td>".$supervisor_pdf."</td>";
                    echo"<td>".$fechaPDF."</td>";
                    echo"<td>".$total."</td>";
                     echo"<td>".$anuladopor."</td>";
                    echo"<td class='textorojo'>".$estado_txt."</td>";
                    echo"</td>";
                echo "</tr>";
                }
       
        echo "</table>";
        }
        
        break;
    
    case 'SPA':
        $consulta_valep = "SELECT A.ID, A.TIPO, Bodegas.NOMBRE as BodegaName, B.NOMBRE, A.FECHA, A.total, C.empresa as empresaVALE , C.estado FROM dbo.VEN_CAB as A INNER JOIN dbo.COB_CLIENTES as B on A.CLIENTE = B.CODIGO INNER JOIN KAO_wssp.dbo.vales_perdida as C on C.cod_valep COLLATE Modern_Spanish_CI_AS = A.ID COLLATE Modern_Spanish_CI_AS INNER JOIN dbo.INV_BODEGAS as Bodegas on c.BODEGA COLLATE Modern_Spanish_CI_AS = Bodegas.CODIGO COLLATE Modern_Spanish_CI_AS WHERE A.FECHA BETWEEN '$trimDATE1' AND '$trimDATE2' AND c.estado = 1 AND c.empresa='$cod_empresagrid' AND A.TIPO = '$tipo_document' and a.ANULADO='0' ORDER BY A.TIPO, A.ID";
        $result_consulta_valep = odbc_exec($db_empresa, $consulta_valep);
        $count_result = odbc_num_rows($result_consulta_valep);
            if ($count_result>=1){
            echo '
            <div class="alert alert-success alert-dismissable">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <p> '.$count_result.' resultado(s) encontrado(s).</p>
            </div> ';
            
            $color_row=array('#DDDDDD', '#CBCBCB');
            $ind_color=0;
      
        
            echo " <table class='tablaedocs'>";    
            echo " <tr class='trcabecera'>
                    <td tdcabecera title='Código'>Código</td>
                    <td tdcabecera title='Tipo Documento'>Tipo Documento</td>
                    <td tdcabecera title='Local'>Local</td>
                    <td tdcabecera title='Solicitante'>Solicitante</td>
                    <td tdcabecera title='Fecha'>Fecha Solicitada</td>
                    <td tdcabecera title='Estado'>Estado</td>
                    <td tdcabecera title='Total'>Total</td>
                    <td tdcabecera title='Acciones'>Acciones</td>
                    <td tdcabecera title='Reporte'>#</td>
                  </tr>
                ";  
            //Construcción Filas
          
            $cont=0;
            while(odbc_fetch_row($result_consulta_valep))
            {
                
                //RECUPERAR DATOS
                $cod_reporte = odbc_result($result_consulta_valep,"ID");
                $tipo_doc = odbc_result($result_consulta_valep,"TIPO");
                $localTxT = iconv("iso-8859-1", "UTF-8",odbc_result($result_consulta_valep,"BodegaName"));
                
                //Recodificacion de ISO-8859 a UTF
                $supervisor_pdf = iconv("iso-8859-1", "UTF-8", odbc_result($result_consulta_valep,"NOMBRE"));
                
                $fechaPDF = odbc_result($result_consulta_valep,"FECHA");
                $estadoVALE = odbc_result($result_consulta_valep,"estado");
                $total = odbc_result($result_consulta_valep,"total");
                
                $cont++;
                $ind_color++;
                $ind_color %= 2;
                
                switch ($estadoVALE) 
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
                // Despliege de resultados
                
                    echo"<tr class='celdagrid' bgcolor=${color_row[$ind_color]}>";
                    echo"<td>".$cod_reporte."</td>";
                    echo"<td>".$tipo_doc."</td>";
                    echo"<td>".$localTxT."</td>";
                    echo"<td>".$supervisor_pdf."</td>";
                    echo"<td>".$fechaPDF."</td>";
                    echo"<td>".$estado_txt."</td>";
                    echo"<td>".$total."</td>";
                    echo"<td>";    
                    //echo"<button type='button' class='btn btn-warning btn-xs' id='$cod_reporte' value='$cod_reporte' onclick='fn_anula_report(this)'> <span class='glyphicon glyphicon-remove'></span> Anular</button>";    
                    echo"<td class='celdagrid'><a href='#' target='_self'><span class='glyphicon glyphicon-eye-open codvalep' id='$cod_reporte' value='$cod_reporte' title='Ver reporte' onclick='fn_genreport_valep(this)'></span></a></td>";    
                    echo"</td>";
                echo "</tr>";
                }
       
        echo "</table>";
        }  else {
             echo '
            <div class="alert alert-danger alert-dismissable col-mid-6">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <p> No hubieron resultados, revise el rango de fechas.</p>
             <input type="hidden" name="cod_veri" id="cod_veri" value="">
            </div> ';
        }
        
        
        break;
    
    case 'SPB':
        $consulta_valep = "SELECT A.ID, A.TIPO, Bodegas.NOMBRE as BodegaName, B.NOMBRE, A.FECHA, A.total, C.estado FROM dbo.VEN_CAB as A INNER JOIN dbo.COB_CLIENTES as B on A.CLIENTE = B.CODIGO INNER JOIN KAO_wssp.dbo.vales_perdida as C on C.cod_valep COLLATE Modern_Spanish_CI_AS = A.ID COLLATE Modern_Spanish_CI_AS INNER JOIN dbo.INV_BODEGAS as Bodegas on c.BODEGA COLLATE Modern_Spanish_CI_AS = Bodegas.CODIGO COLLATE Modern_Spanish_CI_AS WHERE A.FECHA BETWEEN '$trimDATE1' AND '$trimDATE2' AND c.estado = 1 AND c.empresa='$cod_empresagrid' AND A.TIPO = '$tipo_document' and a.ANULADO='0' ORDER BY A.TIPO, A.ID";
        $result_consulta_valep = odbc_exec($db_empresa, $consulta_valep);
        $count_result = odbc_num_rows($result_consulta_valep);
            if ($count_result>=1){
            echo '
            <div class="alert alert-success alert-dismissable">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <p> '.$count_result.' resultado(s) encontrado(s).</p>
            </div> ';
            
            $color_row=array('#DDDDDD', '#CBCBCB');
            $ind_color=0;
      
        
            echo " <table class='tablaedocs'>";    
            echo " <tr class='trcabecera'>
                    <td tdcabecera title='Código'>Código</td>
                    <td tdcabecera title='Tipo Documento'>Tipo Documento</td>
                    <td tdcabecera title='Local'>Local</td>
                    <td tdcabecera title='Solicitante'>Solicitante</td>
                    <td tdcabecera title='Fecha'>Fecha</td>
                    <td tdcabecera title='Estado'>Estado</td>
                    <td tdcabecera title='Total'>Total</td>
                    <td tdcabecera title='Acciones'>Acciones</td>
                    <td tdcabecera title='Reporte'>#</td>
                  </tr>
                ";  
            //Construcción Filas
          
            $cont=0;
            while(odbc_fetch_row($result_consulta_valep))
            {
                
                //RECUPERAR DATOS
                $cod_reporte = odbc_result($result_consulta_valep,"ID");
                $tipo_doc = odbc_result($result_consulta_valep,"TIPO");
                $localTxT = iconv("iso-8859-1", "UTF-8",odbc_result($result_consulta_valep,"BodegaName"));
                
                //Recodificacion de ISO-8859 a UTF
                $supervisor_pdf = iconv("iso-8859-1", "UTF-8", odbc_result($result_consulta_valep,"NOMBRE"));
                
                $fechaPDF = odbc_result($result_consulta_valep,"FECHA");
                $estadoVALE = odbc_result($result_consulta_valep,"estado");
                $total = odbc_result($result_consulta_valep,"total");
                
                $cont++;
                $ind_color++;
                $ind_color %= 2;
                
                switch ($estadoVALE) 
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
                // Despliege de resultados
                
                    echo"<tr class='celdagrid' bgcolor=${color_row[$ind_color]}>";
                    echo"<td>".$cod_reporte."</td>";
                    echo"<td>".$tipo_doc."</td>";
                    echo"<td>".$localTxT."</td>";
                    echo"<td>".$supervisor_pdf."</td>";
                    echo"<td>".$fechaPDF."</td>";
                    echo"<td>".$estado_txt."</td>";
                    echo"<td>".$total."</td>";
                    echo"<td>";    
                    //echo"<button type='button' class='btn btn-warning btn-xs' id='$cod_reporte' value='$cod_reporte' onclick='fn_anula_report(this)'> <span class='glyphicon glyphicon-remove'></span> Anular</button>";    
                    echo"<td class='celdagrid'><a href='#' target='_self'><span class='glyphicon glyphicon-eye-open codvalep' id='$cod_reporte' value='$cod_reporte' title='Ver reporte' onclick='fn_genreport_valep(this)'></span></a></td>";    
                    echo"</td>";
                echo "</tr>";
                }
       
        echo "</table>";
        }else {
             echo '
            <div class="alert alert-danger alert-dismissable col-mid-6">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <p> No hubieron resultados, revise el rango de fechas.</p>
             <input type="hidden" name="cod_veri" id="cod_veri" value="">
            </div> ';
        }
        
        
        break;
        
    
    case 'SPC':
        $consulta_valep = "SELECT A.ID, A.TIPO, Bodegas.NOMBRE as BodegaName, B.NOMBRE, A.FECHA, A.total, C.estado FROM dbo.VEN_CAB as A INNER JOIN dbo.COB_CLIENTES as B on A.CLIENTE = B.CODIGO INNER JOIN KAO_wssp.dbo.vales_perdida as C on C.cod_valep COLLATE Modern_Spanish_CI_AS = A.ID COLLATE Modern_Spanish_CI_AS INNER JOIN dbo.INV_BODEGAS as Bodegas on c.BODEGA COLLATE Modern_Spanish_CI_AS = Bodegas.CODIGO COLLATE Modern_Spanish_CI_AS WHERE A.FECHA BETWEEN '$trimDATE1' AND '$trimDATE2' AND c.estado = 1 AND c.empresa='$cod_empresagrid' AND A.TIPO = '$tipo_document' and a.ANULADO='0' ORDER BY A.TIPO, A.ID";
        $result_consulta_valep = odbc_exec($db_empresa, $consulta_valep);
        $count_result = odbc_num_rows($result_consulta_valep);
            if ($count_result>=1){
            echo '
            <div class="alert alert-success alert-dismissable">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <p> '.$count_result.' resultado(s) encontrado(s).</p>
            </div> ';
            
            $color_row=array('#DDDDDD', '#CBCBCB');
            $ind_color=0;
      
        
            echo " <table class='tablaedocs'>";    
            echo " <tr class='trcabecera'>
                    <td tdcabecera title='Código'>Código</td>
                    <td tdcabecera title='Tipo Documento'>Tipo Documento</td>
                    <td tdcabecera title='Local'>Local</td>
                    <td tdcabecera title='Solicitante'>Solicitante</td>
                    <td tdcabecera title='Fecha'>Fecha</td>
                    <td tdcabecera title='Estado'>Estado</td>
                    <td tdcabecera title='Total'>Total</td>
                    <td tdcabecera title='Acciones'>Acciones</td>
                    <td tdcabecera title='Reporte'>#</td>
                  </tr>
                ";  
            //Construcción Filas
          
            $cont=0;
            while(odbc_fetch_row($result_consulta_valep))
            {
                
                //RECUPERAR DATOS
                $cod_reporte = odbc_result($result_consulta_valep,"ID");
                $tipo_doc = odbc_result($result_consulta_valep,"TIPO");
                $localTxT = iconv("iso-8859-1", "UTF-8",odbc_result($result_consulta_valep,"BodegaName"));
                
                //Recodificacion de ISO-8859 a UTF
                $supervisor_pdf = iconv("iso-8859-1", "UTF-8", odbc_result($result_consulta_valep,"NOMBRE"));
                
                $fechaPDF = odbc_result($result_consulta_valep,"FECHA");
                $estadoVALE = odbc_result($result_consulta_valep,"estado");
                $total = odbc_result($result_consulta_valep,"total");
                
                $cont++;
                $ind_color++;
                $ind_color %= 2;
                
                switch ($estadoVALE) 
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
                // Despliege de resultados
                
                    echo"<tr class='celdagrid' bgcolor=${color_row[$ind_color]}>";
                    echo"<td>".$cod_reporte."</td>";
                    echo"<td>".$tipo_doc."</td>";
                    echo"<td>".$localTxT."</td>";
                    echo"<td>".$supervisor_pdf."</td>";
                    echo"<td>".$fechaPDF."</td>";
                    echo"<td>".$estado_txt."</td>";
                    echo"<td>".$total."</td>";
                    echo"<td>";    
                    //echo"<button type='button' class='btn btn-warning btn-xs' id='$cod_reporte' value='$cod_reporte' onclick='fn_anula_report(this)'> <span class='glyphicon glyphicon-remove'></span> Anular</button>";    
                    echo"<td class='celdagrid'><a href='#' target='_self'><span class='glyphicon glyphicon-eye-open codvalep' id='$cod_reporte' value='$cod_reporte' title='Ver reporte' onclick='fn_genreport_valep(this)'></span></a></td>";    
                    echo"</td>";
                echo "</tr>";
                }
       
        echo "</table>";
        }else {
             echo '
            <div class="alert alert-danger alert-dismissable col-mid-6">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <p> No hubieron resultados, revise el rango de fechas.</p>
             <input type="hidden" name="cod_veri" id="cod_veri" value="">
            </div> ';
        }
        
        
    break;    
    

    case 'SPD':
        $consulta_valep = "SELECT A.ID, A.TIPO, Bodegas.NOMBRE as BodegaName, B.NOMBRE, A.FECHA, A.total, C.estado FROM dbo.VEN_CAB as A INNER JOIN dbo.COB_CLIENTES as B on A.CLIENTE = B.CODIGO INNER JOIN KAO_wssp.dbo.vales_perdida as C on C.cod_valep COLLATE Modern_Spanish_CI_AS = A.ID COLLATE Modern_Spanish_CI_AS INNER JOIN dbo.INV_BODEGAS as Bodegas on c.BODEGA COLLATE Modern_Spanish_CI_AS = Bodegas.CODIGO COLLATE Modern_Spanish_CI_AS WHERE A.FECHA BETWEEN '$trimDATE1' AND '$trimDATE2' AND c.estado = 1 AND c.empresa='$cod_empresagrid' AND A.TIPO = '$tipo_document' and a.ANULADO='0' ORDER BY A.TIPO, A.ID";
        $result_consulta_valep = odbc_exec($db_empresa, $consulta_valep);
        $count_result = odbc_num_rows($result_consulta_valep);
            if ($count_result>=1){
            echo '
            <div class="alert alert-success alert-dismissable">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <p> '.$count_result.' resultado(s) encontrado(s).</p>
            </div> ';
            
            $color_row=array('#DDDDDD', '#CBCBCB');
            $ind_color=0;
      
        
            echo " <table class='tablaedocs'>";    
            echo " <tr class='trcabecera'>
                    <td tdcabecera title='Código'>Código</td>
                    <td tdcabecera title='Tipo Documento'>Tipo Documento</td>
                    <td tdcabecera title='Local'>Local</td>
                    <td tdcabecera title='Solicitante'>Solicitante</td>
                    <td tdcabecera title='Fecha'>Fecha</td>
                    <td tdcabecera title='Estado'>Estado</td>
                    <td tdcabecera title='Total'>Total</td>
                    <td tdcabecera title='Acciones'>Acciones</td>
                    <td tdcabecera title='Reporte'>#</td>
                  </tr>
                ";  
            //Construcción Filas
          
            $cont=0;
            while(odbc_fetch_row($result_consulta_valep))
            {
                
                //RECUPERAR DATOS
                $cod_reporte = odbc_result($result_consulta_valep,"ID");
                $tipo_doc = odbc_result($result_consulta_valep,"TIPO");
                $localTxT = iconv("iso-8859-1", "UTF-8",odbc_result($result_consulta_valep,"BodegaName"));
                
                //Recodificacion de ISO-8859 a UTF
                $supervisor_pdf = iconv("iso-8859-1", "UTF-8", odbc_result($result_consulta_valep,"NOMBRE"));
                
                $fechaPDF = odbc_result($result_consulta_valep,"FECHA");
                $estadoVALE = odbc_result($result_consulta_valep,"estado");
                $total = odbc_result($result_consulta_valep,"total");
                
                $cont++;
                $ind_color++;
                $ind_color %= 2;
                
                switch ($estadoVALE) 
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
                // Despliege de resultados
                
                    echo"<tr class='celdagrid' bgcolor=${color_row[$ind_color]}>";
                    echo"<td>".$cod_reporte."</td>";
                    echo"<td>".$tipo_doc."</td>";
                    echo"<td>".$localTxT."</td>";
                    echo"<td>".$supervisor_pdf."</td>";
                    echo"<td>".$fechaPDF."</td>";
                    echo"<td>".$estado_txt."</td>";
                    echo"<td>".$total."</td>";
                    echo"<td>";    
                    //echo"<button type='button' class='btn btn-warning btn-xs' id='$cod_reporte' value='$cod_reporte' onclick='fn_anula_report(this)'> <span class='glyphicon glyphicon-remove'></span> Anular</button>";    
                    echo"<td class='celdagrid'><a href='#' target='_self'><span class='glyphicon glyphicon-eye-open codvalep' id='$cod_reporte' value='$cod_reporte' title='Ver reporte' onclick='fn_genreport_valep(this)'></span></a></td>";    
                    echo"</td>";
                echo "</tr>";
                }
       
        echo "</table>";
        }else {
             echo '
            <div class="alert alert-danger alert-dismissable col-mid-6">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <p> No hubieron resultados, revise el rango de fechas.</p>
             <input type="hidden" name="cod_veri" id="cod_veri" value="">
            </div> ';
        }
        
        
    break;    
    

    case 'SPE':
        $consulta_valep = "SELECT A.ID, A.TIPO, Bodegas.NOMBRE as BodegaName, B.NOMBRE, A.FECHA, A.total, C.estado FROM dbo.VEN_CAB as A INNER JOIN dbo.COB_CLIENTES as B on A.CLIENTE = B.CODIGO INNER JOIN KAO_wssp.dbo.vales_perdida as C on C.cod_valep COLLATE Modern_Spanish_CI_AS = A.ID COLLATE Modern_Spanish_CI_AS INNER JOIN dbo.INV_BODEGAS as Bodegas on c.BODEGA COLLATE Modern_Spanish_CI_AS = Bodegas.CODIGO COLLATE Modern_Spanish_CI_AS WHERE A.FECHA BETWEEN '$trimDATE1' AND '$trimDATE2' AND c.estado = 1 AND c.empresa='$cod_empresagrid' AND A.TIPO = '$tipo_document' and a.ANULADO='0' ORDER BY A.TIPO, A.ID";
        $result_consulta_valep = odbc_exec($db_empresa, $consulta_valep);
        $count_result = odbc_num_rows($result_consulta_valep);
        if ($count_result>=1){
        echo '
        <div class="alert alert-success alert-dismissable">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <p> '.$count_result.' resultado(s) encontrado(s).</p>
        </div> ';
        
        $color_row=array('#DDDDDD', '#CBCBCB');
        $ind_color=0;
  
    
        echo " <table class='tablaedocs'>";    
        echo " <tr class='trcabecera'>
                <td tdcabecera title='Código'>Código</td>
                <td tdcabecera title='Tipo Documento'>Tipo Documento</td>
                <td tdcabecera title='Local'>Local</td>
                <td tdcabecera title='Solicitante'>Solicitante</td>
                <td tdcabecera title='Fecha'>Fecha</td>
                <td tdcabecera title='Estado'>Estado</td>
                <td tdcabecera title='Total'>Total</td>
                <td tdcabecera title='Acciones'>Acciones</td>
                <td tdcabecera title='Reporte'>#</td>
              </tr>
            ";  
        //Construcción Filas
      
        $cont=0;
        while(odbc_fetch_row($result_consulta_valep))
        {
            
            //RECUPERAR DATOS
            $cod_reporte = odbc_result($result_consulta_valep,"ID");
            $tipo_doc = odbc_result($result_consulta_valep,"TIPO");
            $localTxT = iconv("iso-8859-1", "UTF-8",odbc_result($result_consulta_valep,"BodegaName"));
            
            //Recodificacion de ISO-8859 a UTF
            $supervisor_pdf = iconv("iso-8859-1", "UTF-8", odbc_result($result_consulta_valep,"NOMBRE"));
            
            $fechaPDF = odbc_result($result_consulta_valep,"FECHA");
            $estadoVALE = odbc_result($result_consulta_valep,"estado");
            $total = odbc_result($result_consulta_valep,"total");
            
            $cont++;
            $ind_color++;
            $ind_color %= 2;
            
            switch ($estadoVALE) 
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
            // Despliege de resultados
            
                echo"<tr class='celdagrid' bgcolor=${color_row[$ind_color]}>";
                echo"<td>".$cod_reporte."</td>";
                echo"<td>".$tipo_doc."</td>";
                echo"<td>".$localTxT."</td>";
                echo"<td>".$supervisor_pdf."</td>";
                echo"<td>".$fechaPDF."</td>";
                echo"<td>".$estado_txt."</td>";
                echo"<td>".$total."</td>";
                echo"<td>";    
                //echo"<button type='button' class='btn btn-warning btn-xs' id='$cod_reporte' value='$cod_reporte' onclick='fn_anula_report(this)'> <span class='glyphicon glyphicon-remove'></span> Anular</button>";    
                echo"<td class='celdagrid'><a href='#' target='_self'><span class='glyphicon glyphicon-eye-open codvalep' id='$cod_reporte' value='$cod_reporte' title='Ver reporte' onclick='fn_genreport_valep(this)'></span></a></td>";    
                echo"</td>";
            echo "</tr>";
            }
   
        echo "</table>";
        }else {
            echo '
            <div class="alert alert-danger alert-dismissable col-mid-6">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <p> No hubieron resultados, revise el rango de fechas.</p>
            <input type="hidden" name="cod_veri" id="cod_veri" value="">
            </div> ';
        }
    
    
    break;


    case 'SPF':
        $consulta_valep = "SELECT A.ID, A.TIPO, Bodegas.NOMBRE as BodegaName, B.NOMBRE, A.FECHA, A.total, C.estado FROM dbo.VEN_CAB as A INNER JOIN dbo.COB_CLIENTES as B on A.CLIENTE = B.CODIGO INNER JOIN KAO_wssp.dbo.vales_perdida as C on C.cod_valep COLLATE Modern_Spanish_CI_AS = A.ID COLLATE Modern_Spanish_CI_AS INNER JOIN dbo.INV_BODEGAS as Bodegas on c.BODEGA COLLATE Modern_Spanish_CI_AS = Bodegas.CODIGO COLLATE Modern_Spanish_CI_AS WHERE A.FECHA BETWEEN '$trimDATE1' AND '$trimDATE2' AND c.estado = 1 AND c.empresa='$cod_empresagrid' AND A.TIPO = '$tipo_document' and a.ANULADO='0' ORDER BY A.TIPO, A.ID";
        $result_consulta_valep = odbc_exec($db_empresa, $consulta_valep);
        $count_result = odbc_num_rows($result_consulta_valep);
            if ($count_result>=1){
            echo '
            <div class="alert alert-success alert-dismissable">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <p> '.$count_result.' resultado(s) encontrado(s).</p>
            </div> ';
            
            $color_row=array('#DDDDDD', '#CBCBCB');
            $ind_color=0;
      
        
            echo " <table class='tablaedocs'>";    
            echo " <tr class='trcabecera'>
                    <td tdcabecera title='Código'>Código</td>
                    <td tdcabecera title='Tipo Documento'>Tipo Documento</td>
                    <td tdcabecera title='Local'>Local</td>
                    <td tdcabecera title='Solicitante'>Solicitante</td>
                    <td tdcabecera title='Fecha'>Fecha</td>
                    <td tdcabecera title='Estado'>Estado</td>
                    <td tdcabecera title='Total'>Total</td>
                    <td tdcabecera title='Acciones'>Acciones</td>
                    <td tdcabecera title='Reporte'>#</td>
                  </tr>
                ";  
            //Construcción Filas
          
            $cont=0;
            while(odbc_fetch_row($result_consulta_valep))
            {
                
                //RECUPERAR DATOS
                $cod_reporte = odbc_result($result_consulta_valep,"ID");
                $tipo_doc = odbc_result($result_consulta_valep,"TIPO");
                $localTxT = iconv("iso-8859-1", "UTF-8",odbc_result($result_consulta_valep,"BodegaName"));
                
                //Recodificacion de ISO-8859 a UTF
                $supervisor_pdf = iconv("iso-8859-1", "UTF-8", odbc_result($result_consulta_valep,"NOMBRE"));
                
                $fechaPDF = odbc_result($result_consulta_valep,"FECHA");
                $estadoVALE = odbc_result($result_consulta_valep,"estado");
                $total = odbc_result($result_consulta_valep,"total");
                
                $cont++;
                $ind_color++;
                $ind_color %= 2;
                
                switch ($estadoVALE) 
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
                // Despliege de resultados
                
                    echo"<tr class='celdagrid' bgcolor=${color_row[$ind_color]}>";
                    echo"<td>".$cod_reporte."</td>";
                    echo"<td>".$tipo_doc."</td>";
                    echo"<td>".$localTxT."</td>";
                    echo"<td>".$supervisor_pdf."</td>";
                    echo"<td>".$fechaPDF."</td>";
                    echo"<td>".$estado_txt."</td>";
                    echo"<td>".$total."</td>";
                    echo"<td>";    
                    //echo"<button type='button' class='btn btn-warning btn-xs' id='$cod_reporte' value='$cod_reporte' onclick='fn_anula_report(this)'> <span class='glyphicon glyphicon-remove'></span> Anular</button>";    
                    echo"<td class='celdagrid'><a href='#' target='_self'><span class='glyphicon glyphicon-eye-open codvalep' id='$cod_reporte' value='$cod_reporte' title='Ver reporte' onclick='fn_genreport_valep(this)'></span></a></td>";    
                    echo"</td>";
                echo "</tr>";
                }
       
        echo "</table>";
        }else {
             echo '
            <div class="alert alert-danger alert-dismissable col-mid-6">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <p> No hubieron resultados, revise el rango de fechas.</p>
             <input type="hidden" name="cod_veri" id="cod_veri" value="">
            </div> ';
        }
        
        
    break;
    
    //Opcion por defecto
    default:
         echo '
            <div class="alert alert-danger alert-dismissable col-mid-6">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <p> No hubieron resultados.</p>
             <input type="hidden" name="cod_veri" id="cod_veri" value="">
            </div> ';
            
    break;
}


