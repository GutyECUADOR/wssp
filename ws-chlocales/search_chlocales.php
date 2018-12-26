<?php
require_once '../ws-admin/acceso_multi_db.php';
   
$empresa_search = $_POST['empresa_search'];
$local_search = $_POST['local_search'];
$fecha_iniCHK = $_POST['post_dateini'];
$fecha_finCHK = $_POST['post_datefin'];



if($empresa_search == '0400882940' || $empresa_search == '1711743227'){ // Busqueda para Gustavo Imbaquingo
     $db_empresa = getDataBase('009'); //Obtenemos conexion con base de datos segun codigo de la DB
        $consulta_chlocales = "select A.id, A.empresa, E.Nombre as NombreEmpresaN, A.local, D.NOMBRE as bodegaN, B.Apellido+ B.Nombre as supervisorN, A.fecha, A.estado, (C.Nombre + C.Apellido) as revisadopor from dbo.chlist_locales as A INNER JOIN SBIOKAO.dbo.Empleados as B ON A.supervisor = B.Cedula INNER JOIN SBIOKAO.dbo.Empleados as C ON C.Cedula=revisadopor INNER JOIN dbo.INV_BODEGAS as D ON A.local COLLATE Modern_Spanish_CI_AS = D.CODIGO COLLATE Modern_Spanish_CI_AS INNER JOIN SBIOKAO.dbo.Empresas_WF as E ON E.Codigo = A.empresa WHERE revisadopor='$empresa_search'  AND fecha BETWEEN '$fecha_iniCHK' AND '$fecha_finCHK' ORDER BY id DESC";
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
                $empresa = odbc_result($result_consulta_chlocales,"NombreEmpresaN");
                $empresacodDB = odbc_result($result_consulta_chlocales,"empresa");
                //Recodificacion de ISO-8859 a UTF
                $supervisor_pdf = iconv("iso-8859-1", "UTF-8", odbc_result($result_consulta_chlocales,"supervisorN"));
                $fechaPDF = odbc_result($result_consulta_chlocales,"fecha");
                $local = odbc_result($result_consulta_chlocales,"bodegaN");
                $revisadopor = odbc_result($result_consulta_chlocales,"revisadopor");
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
        $db_empresa = getDataBase('009'); //Obtenemos conexion con base de datos segun codigo de la DB
        $consulta_chlocales = "select A.id, A.empresa, A.local, B.Apellido+ B.Nombre as supervisorN, A.fecha, A.estado, A.revisadopor from dbo.chlist_locales as A INNER JOIN SBIOKAO.dbo.Empleados as B ON A.supervisor = B.Cedula WHERE empresa='$empresa_search' and local='$local_search'  AND fecha BETWEEN '$fecha_iniCHK' AND '$fecha_finCHK' ORDER BY id DESC";
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
                $empresa = odbc_result($result_consulta_chlocales,"empresa");
                $empresacodDB = odbc_result($result_consulta_chlocales,"empresa");
                //Recodificacion de ISO-8859 a UTF
                $supervisor_pdf = iconv("iso-8859-1", "UTF-8", odbc_result($result_consulta_chlocales,"supervisorN"));
                $fechaPDF = odbc_result($result_consulta_chlocales,"fecha");
                $local = odbc_result($result_consulta_chlocales,"local");
                $revisadopor = odbc_result($result_consulta_chlocales,"revisadopor");
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

       