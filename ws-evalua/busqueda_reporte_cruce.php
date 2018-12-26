<?php

include_once ('../ws-admin/acceso_db.php');
include_once ('../ws-admin/acceso_db_sbio.php');

$user_select = $_POST['post_username'];

            echo "</br>"; 
            echo "<div class='txtseccion'>";
            echo "<label class='etique'> Evaluaciones Encontradas</label>";
            echo "</div>";
            
            echo "<select class='form-control centertext' name='seleccion_cruce1' id='seleccion_cruce1' required>
                          <option value=''>---SELECCIONE CRUCE 1---</option>";
                           
                            $consulta_empleado1 = "SELECT * FROM dbo.Evaluaciones with (nolock) where empleado = '$user_select'";
                            $result_query1 = odbc_exec($conexion, $consulta_empleado1);
            
                            while(odbc_fetch_row($result_query1))
                            {
                            $cod_ev = odbc_result($result_query1,"cod_evaluacion"); 
                            $fecha_ev = odbc_result($result_query1,"fecha"); 
                            $evaluador_ev = odbc_result($result_query1,"evaluador");
                            
                            $search_ev = "SELECT Nombre, Apellido FROM dbo.Empleados with (nolock) where Codigo ='$evaluador_ev'";
                            $result_search_ev = odbc_exec($conexion_sbio, $search_ev);
                            
                            $apell_utf1= iconv("iso-8859-1", "UTF-8", odbc_result($result_search_ev,"Nombre"));
                            $nomb_utf1= iconv("iso-8859-1", "UTF-8", odbc_result($result_search_ev,"Apellido"));
                            
                            
                            echo "<option value='$cod_ev'>Fecha: $fecha_ev - $apell_utf1  $nomb_utf1</option>";
                            }
                          
            echo  "</select>";
            
            echo "<select class='form-control centertext' name='seleccion_cruce2' id='seleccion_cruce2' required>
                          <option value=''>---SELECCIONE CRUCE 2---</option>";
                           
                            $consulta_empleado = "SELECT * FROM dbo.Evaluaciones where empleado = '$user_select'";
                            $result_query = odbc_exec($conexion, $consulta_empleado);
            
                            while(odbc_fetch_row($result_query))
                            {
                            $cod_ev = odbc_result($result_query,"cod_evaluacion"); 
                            $fecha_ev = odbc_result($result_query,"fecha"); 
                            $evaluador_ev = odbc_result($result_query,"evaluador");
                            
                            $search_ev = "SELECT Nombre, Apellido FROM dbo.Empleados where Codigo ='$evaluador_ev'";
                            $result_search_ev = odbc_exec($conexion_sbio, $search_ev);
                            
                            $apell_utf1= iconv("iso-8859-1", "UTF-8", odbc_result($result_search_ev,"Nombre"));
                            $nomb_utf1= iconv("iso-8859-1", "UTF-8", odbc_result($result_search_ev,"Apellido"));
                            
                            
                            echo "<option value='$cod_ev'>Fecha: $fecha_ev - $apell_utf1 $nomb_utf1</option>";
                            }
                          
            echo  "</select>";