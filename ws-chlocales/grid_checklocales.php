<?php
require_once '../ws-admin/acceso_multi_db.php';
   
        $db_empresa = getDataBase('009'); //Obtenemos conexion con base de datos segun codigo de la DB
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
            ORDER BY id desc
       
        ";
        if (!$result_consulta_chlocales = odbc_exec($db_empresa, $consulta_chlocales)){
            echo "ODBC error: ", odbc_errormsg();
        }
        
        
        $count_result = odbc_num_rows($result_consulta_chlocales);
            if ($count_result>=1){
            
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
                $revisadopor = odbc_result($result_consulta_chlocales,"revisadorName");
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
                    if ($cod_estado != 1){
                        echo"<td><button type='button' class='btn btn-primary btn-xs' id='$cod_reporte' onclick='fn_edit_chlocal(this)'> <span class='glyphicon glyphicon-pencil'></span> Editar</button>";    
                    }else{
                        echo"<td></td>";    
                    }
                    echo"<td class='celdagrid'><a href='#' target='_self'><span class='glyphicon glyphicon-eye-open codvalep' id='$cod_reporte' value='$cod_reporte' title='Ver reporte' onclick='fn_genreport_chlocal(this)'></span></a></td>";    
                    echo"</td>";
                echo "</tr>";
                }
       
        echo "</table>";
        }