<?php
include('../ws-admin/funciones.php'); // Acceso a funciones utiles
require_once '../ws-admin/acceso_multi_db.php';
   
//$cedula = $_POST['cedula'];
$empresa = $_POST['empresa'];
$bodega = $_POST['bodega'];
$fechaActual = getDateNow();

        $db_empresa = getDataBase('009'); //Obtenemos conexion con base de datos segun codigo de la DB
        $consulta_chlocales = "select A.id, A.supervisor, A.empresa, A.local, B.Apellido+ B.Nombre as supervisorN, A.fecha, A.estado, A.revisadopor from dbo.chlist_locales as A INNER JOIN SBIOKAO.dbo.Empleados as B ON A.supervisor = B.Cedula WHERE empresa ='$empresa' AND  local='$bodega' AND estado is NULL AND fecha = '$fechaActual' ";
        $result_consulta_chlocales = odbc_exec($db_empresa, $consulta_chlocales);
        $count_result = odbc_num_rows($result_consulta_chlocales);
            if ($count_result>=1){
            echo '
            <div class="alert alert-success alert-dismissable">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <p> '.$count_result.' resultado(s). encontrado(s)</p>
            </div> ';
            
           
            echo " <table class='table table-striped center-align' id='tblGrid'>";   
            echo " <thead id='tblHead'>";
            echo " <tr>
                    <th class='text-center'>ID</th>
                    <th class='text-center'>Empresa</th>
                    <th class='text-center'>Bodega</th>
                    <th class='text-center'>Jefes/Asistentes</th>
                    <th class='text-center'>Estado</th>
                    <th class='text-center'>Revisado por</th>
                    <th class='text-center'>Fecha Realizada</th>
                    <th class='text-center'>Aciones</th>
                  </tr>
                ";  
            echo "</thead>";
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
                        $estado_txt = "<td class='text-center' style='color:red'>Pendiente de revisión</td>";
                        break;
                    }
                
                $cont++;
                
                // Despliege de resultados
                
                echo"<tr>";
                    echo"<td class='text-center'>".$cod_reporte."</td>";
                    echo"<td class='text-center'>".$empresa."</td>";
                    echo"<input type='hidden' id='db$cod_reporte' value='$empresacodDB'>";
                    echo"<td class='text-center'>".$local."</td>";
                    echo"<td class='text-center'>".$supervisor_pdf."</td>";
                    echo $estado_txt;
                    echo"<td class='text-center'>".$revisadopor."</td>";
                    echo"<td class='text-center'>".$fechaPDF."</td>";
                    echo"<td><button type='button' class='btn btn-primary' id='$cod_reporte' onclick='fn_editChListDiario(this)'> <span class='glyphicon glyphicon-pencil'></span> Editar</button>";    
                    echo"</td>";
                echo "</tr>";
                }
       
        echo "</table>";
        }else{
             echo '
            <div class="alert alert-danger alert-dismissable">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <p> No hubieron resultados. Revise paràmetros de busqueda, posiblemente el documento ya ha sido revisado por un supervisor</p>
            </div> ';
        }


       