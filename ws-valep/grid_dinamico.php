<?php
require_once '../ws-admin/acceso_multi_db.php';
 
$db_empresa = getDataBase($_SESSION['empresa_autentificada']); //Obtenemos conexion con base de datos segun codigo de la DB
$cod_empresagrid = $_SESSION['empresa_autentificada'];

      $consulta_valep = "
        SELECT TOP 100
            VEN_CAB.ID, 
            VEN_CAB.TIPO, 
            vales.empresa, 
            Bodegas.NOMBRE as BodegaName, 
            cliente.NOMBRE, VEN_CAB.FECHA, 
            vales.fechaPagos, 
            vales.total,
            vales.estado
        FROM dbo.VEN_CAB
            INNER JOIN dbo.COB_CLIENTES as cliente on VEN_CAB.CLIENTE = cliente.CODIGO 
            INNER JOIN KAO_wssp.dbo.vales_perdida as vales on vales.cod_valep COLLATE Modern_Spanish_CI_AS = VEN_CAB.ID COLLATE Modern_Spanish_CI_AS 
            INNER JOIN dbo.INV_BODEGAS as bodegas on vales.BODEGA COLLATE Modern_Spanish_CI_AS = bodegas.CODIGO COLLATE Modern_Spanish_CI_AS 
        WHERE vales.estado = 0 AND vales.empresa ='$cod_empresagrid'  AND VEN_CAB.ID IN (SELECT IDDoc FROM dbo.ORG_DOCUMENTOS WHERE Aprobado=1)
        ORDER BY vales.fecha DESC
      ";

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
                    <td tdcabecera title='Local'>Local</td>
                    <td tdcabecera title='Solicitante'>Solicitante</td>
                    <td tdcabecera title='Fecha'>Fecha Creacion (Local)</td>
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
                $localTxT = iconv("iso-8859-1", "UTF-8",odbc_result($result_consulta_valep,"BodegaName"));
                
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
                            $estado_txt = 'Anulado';
                                break;    

                        default:
                            $estado_txt = 'Pendiente';
                            break;
                    }

                $dateINIPagosSpan = date("Ymd", strtotime($fechaINIPAGOS));
                $dateaddINIPagosSpan = date_create($dateINIPagosSpan);
                $dateadd8mas = date_format(date_add($dateaddINIPagosSpan, date_interval_create_from_date_string('15 days')), 'Y-m-d'); // Agregara X dias y devuelve formado Y-m-d
                         
                if (date('Y-m-d') > $dateadd8mas) {
                    $estado_txt = 'Fuera de rango de aprobacion, Fecha Maxima: '. $dateadd8mas;
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
                
                    echo"<tr class='celdagrid' bgcolor=${color_row[$ind_color]}>";
                    echo"<td>".$cod_reporte."</td>";
                    echo"<td>".$tipo_doc."</td>";
                    echo"<td>".$empresaTxT."</td>";
                    echo"<td>".$localTxT."</td>";
                    echo"<td>".$supervisor_pdf."</td>";
                    echo"<td>".substr($fechaPDF, 0, 10)."</td>";
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