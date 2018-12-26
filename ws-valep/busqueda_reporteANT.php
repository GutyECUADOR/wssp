<?php
include_once ('../ws-admin/acceso_multi_db.php');

$emp_vales_select = filter_input(INPUT_POST,'post_id');
$dateini_valesANT = filter_input(INPUT_POST,'post_dateini');
$datefin_valesANT = filter_input(INPUT_POST,'post_datefin');
 
        //Seleccionamos base de datos segun codigo de la misma
        $conexion_valep = getDataBase($emp_vales_select);
        //var_dump($dateini_valesANT);
        //var_dump($datefin_valesANT);
        
        //Evita error de cursor por no tener formato de fecha valida
        if ($dateini_valesANT==""){
            $dateini_valesANT = date('Y-m-d');
        }
        
        if ($datefin_valesANT==""){
            $datefin_valesANT = date('Y-m-d');
        }
        
        if (!is_bool($conexion_valep)){
            
            $consulta_docs = "SELECT * FROM dbo.VEN_CAB  where TIPO in ('SVE','SPA','SPB') AND FECHA BETWEEN {d '$dateini_valesANT'} and {d '$datefin_valesANT'} ORDER BY ID";
            
            $result_query = odbc_exec($conexion_valep, $consulta_docs);
            $count_result = odbc_num_rows($result_query); //Cuenta resultados optenidos, return FALSE si existe error
          
            echo "</br>"; 
            echo "<div class='txtseccion'>";
            echo "<label class='etique'> Resultados</label>";
            echo "</div>";

            if ($count_result>=1){
            echo '
            <div class="alert alert-success alert-dismissable">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <p class="centrado"> '.$count_result.' resultado(s) encontrado(s).</p>
            </div>';
            
            
            $color_row=array('#DDDDDD', '#CBCBCB');
            $ind_color=0;
      
        
            echo " <table class='tablaedocs_modal'>";    
            echo " <tr class='trcabecera'>
                    <td class='tdcabecera centrado' title='Código'>Código</td>
                    <td class='tdcabecera centrado' title='Tipo Documento'>Solicitante</td>
                    <td class='tdcabecera centrado' title='Tipo Documento'>Fecha</td>
                    <td class='tdcabecera centrado' title='Total'>Total</td>
                    <td class='tdcabecera centrado' title='Desplegar Gráfica'>#</td>
                  </tr>
                ";  
            //Construcción Filas
          
            $cont=0;
            while(odbc_fetch_row($result_query))
            {
                
                //RECUPERAR DATOS
                $cod_reporte = odbc_result($result_query,"ID");
                $nombre_doc = odbc_result($result_query,"CREADOPOR");
                $fecha_valep = odbc_result($result_query,"FECHA");
                $empresa_pdf = odbc_result($result_query,"BODEGA");
                $total = odbc_result($result_query,"TOTAL");
                
                $cont++;
                $ind_color++;
                $ind_color %= 2;
                
                // Despliege de resultados
                
                    echo"<tr class='celdagrid centrado' bgcolor=${color_row[$ind_color]}>";
                    echo"<td class='celdagrid centrado'>".$cod_reporte."</td>";
                    echo"<td class='celdagrid centrado'>".$nombre_doc."</td>";
                    echo"<td class='celdagrid centrado'>".$fecha_valep."</td>";
                    echo"<td class='celdagrid centrado'>".round($total,2)."</td>";
                    echo"<td class='celdagrid centrado'><a target='_self'><span class='glyphicon glyphicon glyphicon glyphicon-download-alt codvalep' id='$cod_reporte' value='$cod_reporte' title='Recuperar datos' onclick='fn_genreport_valepANT(this)'></span></a></td>";    
                    echo"</td>";
                echo "</tr>";
                }
       
        echo "</table><div class='row'/> ";
        
        
         }
            else
            {
            echo '
            <div class="alert alert-danger alert-dismissable col-mid-6">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <p class="centrado"> No hubieron resultados.</p>
             <input type="hidden" name="cod_veri" id="cod_veri" value="">
            </div> ';
            
            }
            
            
            
            }//Comprobacion booleana