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
            WHERE vales.empresa ='$cod_empresagrid' AND VEN_CAB.ID IN (SELECT IDDoc FROM dbo.ORG_DOCUMENTOS WHERE Aprobado=1)
            ORDER BY vales.fecha DESC
        ";
        $result_consulta_valep = odbc_exec($db_empresa, $consulta_valep);
        $count_result = odbc_num_rows($result_consulta_valep);
            if ($count_result>=1){
            
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
                <td tdcabecera title='Estado'>Estado</td>
                <td tdcabecera title='Total'>Total</td>
                <td tdcabecera>Acciones</td>
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
                    echo"<td>".substr($fechaPDF, 0, -12)."</td>";
                    echo"<td>".$estado_txt."</td>";
                    echo"<td>".$total."</td>";
                    echo"<td class='celdagrid'><a href='#' target='_self'><span class='glyphicon glyphicon-eye-open codvalep valepGeneraAprobado' id='$cod_reporte' value='$cod_reporte' title='Ver reporte'></span></a></td>";
                    echo"</td>";
                    echo "</tr>";
            }
       
        echo "</table>";
        }