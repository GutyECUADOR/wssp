<?php
session_start();
require_once '../ws-admin/acceso_multi_db.php';
   
$empresa_search = $_POST['empresa_search'];
$local_search = $_POST['local_search'];
$fecha_iniCHK = $_POST['post_dateini'];
$fecha_finCHK = $_POST['post_datefin'];

$dbcode = $_SESSION['empresa_autentificada'];


if($empresa_search == '0400882940' || $empresa_search == '1711743227'){ // Busqueda para Gustavo Imbaquingo
     $db_empresa = getDataBase($dbcode); //Obtenemos conexion con base de datos segun codigo de la DB
        $consulta_chlocales = "
            SELECT TOP 100
                checklist.id,
                checklist.empresa as codEmpresa,
                empresa.Nombre as nombreEmpresa,
                checklist.local as codLocal,
                bodega.NOMBRE as nombreLocal,
                checklist.supervisor as cedulaSupervisor,
                (SBIO.Nombre + SBIO.Apellido) as supervisorName,
                checklist.fecha,
                checklist.revisadopor as cedulaRevisado,
                (SBIO2.Nombre + SBIO2.Apellido) as revisadorName,
                checklist.estado
            FROM 
                dbo.chlist_locales as checklist
                INNER JOIN SBIOKAO.dbo.Empleados as SBIO ON SBIO.Cedula = checklist.supervisor
                LEFT JOIN SBIOKAO.dbo.Empleados as SBIO2 ON SBIO2.Cedula = checklist.revisadopor
                INNER JOIN dbo.INV_BODEGAS as bodega ON bodega.CODIGO = checklist.local
                INNER JOIN SBIOKAO.dbo.Empresas_WF as empresa ON empresa.Codigo = checklist.empresa 
            WHERE revisadopor='$empresa_search' AND fecha BETWEEN '$fecha_iniCHK' AND '$fecha_finCHK' 
            ORDER BY id desc
        ";
        $result_consulta_chlocales = odbc_exec($db_empresa, $consulta_chlocales);
        $count_result = odbc_num_rows($result_consulta_chlocales);
            if ($count_result>=1){
            echo '
            <div class="alert alert-success alert-dismissable">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <p> '.$count_result.' resultado(s). encontrado(s)</p>
            </div> ';
            
            $color_row=array('#DDDDDD', '#CBCBCB');
            $ind_color=0;
            
            echo " <table class='tablaedocs'>";    
            echo " <tr class='trcabecera'>
                    <td tdcabecera title='Código'>ID</td>
                    <td tdcabecera title='Empresa'>Empresa</td>
                    <td tdcabecera title='Local'>Local</td>
                    <td tdcabecera title='Supervisor'>Supervisor</td>
                    <td tdcabecera title='Estado'>Estado</td>
                    <td tdcabecera title='Revisado'>Revisado por</td>
                    <td tdcabecera title='Fecha'>Fecha Realizada</td>
                    <td tdcabecera title='Acciones'>Aciones</td>
                    <td tdcabecera title='Informe'>Informe</td>
                  </tr>
                ";  
            //Construcción Filas
          
            $cont=0;
            while(odbc_fetch_row($result_consulta_chlocales))
            {
                //RECUPERAR DATOS
                $cod_reporte = odbc_result($result_consulta_chlocales,"id");
                $empresa = odbc_result($result_consulta_chlocales,"nombreEmpresa");
                $empresacodDB = odbc_result($result_consulta_chlocales,"codEmpresa");
                //Recodificacion de ISO-8859 a UTF
                $supervisor_pdf = iconv("iso-8859-1", "UTF-8", odbc_result($result_consulta_chlocales,"supervisorName"));
                $fechaPDF = odbc_result($result_consulta_chlocales,"fecha");
                $local = odbc_result($result_consulta_chlocales,"nombreLocal");
                $revisadopor = odbc_result($result_consulta_chlocales,"cedulaRevisado") . '-' . odbc_result($result_consulta_chlocales,"revisadorName");
                $cod_estado = odbc_result($result_consulta_chlocales,"estado");
              
                switch ($cod_estado) 
                    {
                    case 1:
                        $estado_txt = '<td style="color:blue">Revisado/Aprobado</td>';
                            break;

                    case 2:
                        $estado_txt = 'Anulado';
                            break;    

                    default:
                        $estado_txt = '<td style="color:red">Pendiente de revisión</td>';
                        break;
                    }
                
                $cont++;
                $ind_color++;
                $ind_color %= 2;
                
                // Despliege de resultados
                
                    echo"<tr class='celdagrid' bgcolor=${color_row[$ind_color]}>";
                    echo"<td>".$cod_reporte."</td>";
                    echo"<input type='hidden' id='db$cod_reporte' value='$empresacodDB'>";
                    echo"<td>".$empresa."</td>";
                    echo"<td>".$local."</td>";
                    echo"<td>".$supervisor_pdf."</td>";
                    echo $estado_txt;
                    echo"<td>".$revisadopor."</td>";
                    echo"<td>".$fechaPDF."</td>";
                    echo"<td><button type='button' class='btn btn-primary btn-xs' id='$cod_reporte' onclick='fn_edit_chlocal(this)'> <span class='glyphicon glyphicon-pencil'></span> Editar</button>";    
                    echo"<td class='celdagrid'><a href='#' target='_self'><span class='glyphicon glyphicon-eye-open codvalep' id='$cod_reporte' value='$cod_reporte' title='Ver reporte' onclick='fn_genreport_chlocal(this)'></span></a></td>";    
                    echo"</td>";
                echo "</tr>";
                }
       
        echo "</table>";
        }else{
             echo '
            <div class="alert alert-danger alert-dismissable">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <p> No hubieron resultados. Revise paràmetros de busqueda, posiblemente no exitan los documentos en el rango de fechas indicado</p>
            </div> ';
        }
}  else {
        $db_empresa = getDataBase($dbcode); //Obtenemos conexion con base de datos segun codigo de la DB
        $consulta_chlocales = "
       
            SELECT TOP 100
                checklist.id,
                checklist.empresa as codEmpresa,
                empresa.Nombre as nombreEmpresa,
                checklist.local as codLocal,
                bodega.NOMBRE as nombreLocal,
                checklist.supervisor as cedulaSupervisor,
                (SBIO.Nombre + SBIO.Apellido) as supervisorName,
                checklist.fecha,
                checklist.revisadopor as cedulaRevisado,
                (SBIO2.Nombre + SBIO2.Apellido) as revisadorName,
                checklist.estado
            FROM 
                INV_BODEGAS as bodega
                INNER JOIN KAO_wssp.dbo.chlist_locales as checklist ON checklist.local collate Modern_Spanish_CI_AS = bodega.CODIGO
                INNER JOIN SBIOKAO.dbo.Empleados as SBIO ON SBIO.Cedula = checklist.supervisor
                LEFT JOIN SBIOKAO.dbo.Empleados as SBIO2 ON SBIO2.Cedula = checklist.revisadopor
                INNER JOIN SBIOKAO.dbo.Empresas_WF as empresa ON empresa.Codigo = checklist.empresa
            WHERE checklist.empresa = '$dbcode' AND checklist.local='$local_search' AND fecha BETWEEN '$fecha_iniCHK' AND '$fecha_finCHK' 
            ORDER BY id desc

            
        
        ";
        $result_consulta_chlocales = odbc_exec($db_empresa, $consulta_chlocales);
        $count_result = odbc_num_rows($result_consulta_chlocales);
            if ($count_result>=1){
            echo '
            <div class="alert alert-success alert-dismissable">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <p> '.$count_result.' resultado(s). encontrado(s)</p>
            </div> ';
            
            $color_row=array('#DDDDDD', '#CBCBCB');
            $ind_color=0;
            
            echo " <table class='tablaedocs'>";    
            echo " <tr class='trcabecera'>
                    <td tdcabecera title='Código'>ID</td>
                    <td tdcabecera title='Empresa'>Empresa</td>
                    <td tdcabecera title='Local'>Local</td>
                    <td tdcabecera title='Supervisor'>Supervisor</td>
                    <td tdcabecera title='Estado'>Estado</td>
                    <td tdcabecera title='Revisado por'>Revisado por</td>
                    <td tdcabecera title='Fecha'>Fecha Realizada</td>
                    <td tdcabecera title='Acciones'>Aciones</td>
                    <td tdcabecera title='Informe'>Informe</td>
                  </tr>
                ";  
            //Construcción Filas
          
            $cont=0;
            while(odbc_fetch_row($result_consulta_chlocales))
            {
                //RECUPERAR DATOS
                $cod_reporte = odbc_result($result_consulta_chlocales,"id");
                $empresa = odbc_result($result_consulta_chlocales,"nombreEmpresa");
                $empresacodDB = odbc_result($result_consulta_chlocales,"codEmpresa");
                //Recodificacion de ISO-8859 a UTF
                $supervisor_pdf = iconv("iso-8859-1", "UTF-8", odbc_result($result_consulta_chlocales,"supervisorName"));
                $fechaPDF = odbc_result($result_consulta_chlocales,"fecha");
                $local = odbc_result($result_consulta_chlocales,"nombreLocal");
                $revisadopor = odbc_result($result_consulta_chlocales,"cedulaRevisado") . '-' . odbc_result($result_consulta_chlocales,"revisadorName");
                $cod_estado = odbc_result($result_consulta_chlocales,"estado");

                
              
                switch ($cod_estado) 
                    {
                    case 1:
                        $estado_txt = '<td style="color:blue">Revisado/Aprobado</td>';
                            break;

                    case 2:
                        $estado_txt = 'Anulado';
                            break;    

                    default:
                        $estado_txt = '<td style="color:red">Pendiente de revisión</td>';
                        break;
                    }
                
                $cont++;
                $ind_color++;
                $ind_color %= 2;
                
                // Despliege de resultados
                
                    echo"<tr class='celdagrid' bgcolor=${color_row[$ind_color]}>";
                    echo"<td>".$cod_reporte."</td>";
                    echo"<td>".$empresa."</td>";
                    echo"<input type='hidden' id='db$cod_reporte' value='$empresacodDB'>";
                    echo"<td>".$local."</td>";
                    echo"<td>".$supervisor_pdf."</td>";
                    echo $estado_txt;
                    echo"<td>".$revisadopor."</td>";
                    echo"<td>".$fechaPDF."</td>";
                    echo"<td><button type='button' class='btn btn-primary btn-xs' id='$cod_reporte' onclick='fn_edit_chlocal(this)'> <span class='glyphicon glyphicon-pencil'></span> Editar</button>";    
                    echo"<td class='celdagrid'><a href='#' target='_self'><span class='glyphicon glyphicon-eye-open codvalep' id='$cod_reporte' value='$cod_reporte' title='Ver reporte' onclick='fn_genreport_chlocal(this)'></span></a></td>";    
                    echo"</td>";
                echo "</tr>";
                }
       
        echo "</table>";
        }else{
             echo '
            <div class="alert alert-danger alert-dismissable">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <p> No hubieron resultados. Revise paràmetros de busqueda, posiblemente no exitan los documentos en el rango de fechas indicado</p>
            </div> ';
        }
}

       