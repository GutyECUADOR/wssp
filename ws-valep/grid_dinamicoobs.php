<?php
require_once '../ws-admin/acceso_multi_db.php';
 
$db_empresa = getDataBase($_SESSION['empresa_autentificada']); //Obtenemos conexion con base de datos segun codigo de la DB

$cod_empresagrid = $_SESSION['empresa_autentificada'];

        //$consulta_valep = "SELECT A.ID, A.TIPO, B.NOMBRE, A.FECHA, A.total, C.estado FROM dbo.VEN_CAB as A INNER JOIN dbo.COB_CLIENTES as B on A.CLIENTE = B.CODIGO INNER JOIN KAO_wssp.dbo.vales_perdida as C on C.cod_valep COLLATE Modern_Spanish_CI_AS = A.ID COLLATE Modern_Spanish_CI_AS WHERE c.estado = 0 AND A.TIPO = 'SPB' or c.estado = 0 AND A.TIPO ='SPA' or c.estado = 0 AND A.TIPO ='SPC' AND ID IN (SELECT IDDoc FROM dbo.ORG_DOCUMENTOS WHERE Aprobado=1)ORDER BY A.TIPO, A.ID";
        
        //$consulta_valep = "SELECT A.ID, A.TIPO, C.empresa, B.NOMBRE, A.FECHA, C.total FROM dbo.VEN_CAB as A INNER JOIN dbo.COB_CLIENTES as B on A.CLIENTE = B.CODIGO INNER JOIN KAO_wssp.dbo.vales_perdida as C on C.cod_valep COLLATE Modern_Spanish_CI_AS = A.ID COLLATE Modern_Spanish_CI_AS WHERE c.estado = 0 AND c.empresa ='$cod_empresagrid' AND A.TIPO IN ('SPA','SPB','SPC') ORDER BY A.TIPO, A.ID";
        
        $consulta_valep = "SELECT A.ID, A.TIPO, C.empresa, Bodegas.NOMBRE as BodegaName, B.NOMBRE, A.FECHA, C.total FROM dbo.VEN_CAB as A INNER JOIN dbo.COB_CLIENTES as B on A.CLIENTE = B.CODIGO INNER JOIN KAO_wssp.dbo.vales_perdida as C on C.cod_valep COLLATE Modern_Spanish_CI_AS = A.ID COLLATE Modern_Spanish_CI_AS INNER JOIN dbo.INV_BODEGAS as Bodegas on c.BODEGA COLLATE Modern_Spanish_CI_AS = Bodegas.CODIGO COLLATE Modern_Spanish_CI_AS WHERE c.estado = 0 AND c.empresa ='$cod_empresagrid' AND A.TIPO IN ('SPA','SPB','SPC','SPD','SPE','SPF') ORDER BY A.TIPO, A.ID";
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
                    <td tdcabecera title='Fecha'>Fecha Solicitada</td>
                    <td tdcabecera title='Estado' colspan='2'>Estado</td>
                    <td tdcabecera title='Total'>Total</td>
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
                $cod_empresaValep = odbc_result($result_consulta_valep,"empresa");
                $localTxT = iconv("iso-8859-1", "UTF-8",odbc_result($result_consulta_valep,"BodegaName"));
                
                $fechaPDF = odbc_result($result_consulta_valep,"FECHA");
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

                    case 0:
                        $consulta_isInORG_DOCS = "SELECT * FROM dbo.ORG_DOCUMENTOS WHERE IDDoc='$cod_reporte' AND (Aprobado='1' OR Negado='1')";
                        $result_isInORG_DOCS = odbc_exec($db_empresa, $consulta_isInORG_DOCS);
                        $count_isInORG_DOCS = odbc_num_rows($result_isInORG_DOCS);
                        $notaNegado = "";
                        
                        if($count_isInORG_DOCS ==1){
                            if (odbc_result($result_isInORG_DOCS,"Aprobado")=='1') {
                                $estado_txt = 'Pendiente aprob. administracion';
                            }elseif (odbc_result($result_isInORG_DOCS,"Negado")=='1'){
                                $estado_txt = 'Vale negado por supervisor';
                                $notaNegado = odbc_result($result_isInORG_DOCS,"NegadoNota");
                            }else{
                                $estado_txt = 'Estado no definido';
                            }
                        }else {
                            $estado_txt = 'No revisado por supervisor';
                        }

                            

                            break;
                    default:
                         $estado_txt = 'Estado no definido';
                   
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
                
                    echo"<tr class='celdagrid' bgcolor=${color_row[$ind_color]}>";
                    echo"<td>".$cod_reporte."</td>";
                    echo"<td>".$tipo_doc."</td>";
                    echo"<td>".$empresaTxT."</td>";
                    echo"<td>".$localTxT."</td>";
                    echo"<td>".$supervisor_pdf."</td>";
                    echo"<td>".$fechaPDF."</td>";
                    echo"<td class='textorojo' data-toggle='tooltip' title='$notaNegado'>".$estado_txt."</td>";
                    echo"<td>".$total."</td>";
                    echo"<td class='celdagrid'><a href='#' target='_self'><span class='glyphicon glyphicon-eye-open codvalep valepGeneraAprobado' id='$cod_reporte' value='$cod_reporte' title='Ver reporte'></span></a></td>";    
                    echo"</td>";
                echo "</tr>";
                }
       
        echo "</table>";
        }