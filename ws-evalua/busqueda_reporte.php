<?php
include_once ('../ws-admin/acceso_db.php');

$user_select = $_POST['post_username'];
$dateini_select = $_POST['post_dateini'];
$datefin_select = $_POST['post_datefin'];
 
            echo "</br>"; 
            echo "<div class='txtseccion'>";
            echo "<label class='etique'> Resultados</label>";
            echo "</div>";
            
            echo "<select class='form-control centertext' name='seleccion_empleado_resultados' id='seleccion_empleado_resultados' required>
                          <option value=''>---SELECCIONE REPORTE---</option>";
                          
                            $consulta_empleado = "SELECT * FROM Evaluaciones with (nolock) where empleado = '$user_select' AND fecha BETWEEN '$dateini_select' AND '$datefin_select'";
                            $result_query = odbc_exec($conexion, $consulta_empleado);
            
                            
                            
                            while(odbc_fetch_row($result_query))
                            {
                            $cod_ev = odbc_result($result_query,"cod_evaluacion"); 
                            $db_semana = odbc_result($result_query,"semana"); 
                            echo "<option value='$cod_ev'>Código: $cod_ev - Fecha: $db_semana</option>";
                            }
                          
            echo  "</select>";