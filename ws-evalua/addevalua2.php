<html>
<head><title></title>
	<script src="sweet/sweetalert.min.js"></script> 
 	<script src="sweetalert-master/dist/sweetalert.min.js"></script>
        <link rel="stylesheet" type="text/css" href="sweetalert-master/dist/sweetalert.css">
</head>
<body></body>
</html>

<?php
include_once ('../ws-admin/acceso_db.php');
include_once ('../ws-admin/acceso_db_sbio.php');
session_start();

if (!empty($_POST['txt_codseguridad'])) {
    $cod_seguridad1 = $_POST['txt_codseguridad'];
    $evaluadorapp = $_POST['seleccion_evaluador'];
    echo $evaluadorapp;
    
    //Verificacion de Key corresponde a usuario
    $consulta_keyuser = "SELECT * FROM dbo.Empleados with (nolock) WHERE Clave = '$cod_seguridad1' AND Codigo='$evaluadorapp'";
    $result_query_keyuser = odbc_exec($conexion_sbio, $consulta_keyuser);
    $items = 0;
    if(odbc_fetch_array($result_query_keyuser))
       {
           $items=1;                          
       } 
      
      echo "<br>total No. de rows: $items";
    
   
                if ($items >= 1){
                    
                    $_SESSION['session_local'] = $local = $_POST['select_local'];
                    $_SESSION['session_semana'] = $semana = $_POST['seleccion_semana'];
                    $_SESSION['session_evaluador'] = $evaluador = $_POST['seleccion_evaluador'];
                    $_SESSION['session_empleado'] = $empleado = $_POST['seleccion_empleado'];
                    $cargo_emp = $_POST['txt_cargo'];
                    $fecha = date ("Y-n-d"); 
                    $formacion_1 = $_POST['seleccion_item1-1'];
                    $formacion_2 = $_POST['seleccion_item1-2']; 
                    $formacion_3 = $_POST['seleccion_item1-3']; 
                    $formacion_4 = $_POST['seleccion_item1-4']; 
                    $formacion_5 = $_POST['seleccion_item1-5']; 
                    $organizacion_1 = $_POST['seleccion_item2-1']; 
                    $organizacion_2 = $_POST['seleccion_item2-2']; 
                    $organizacion_3 = $_POST['seleccion_item2-3']; 
                    $organizacion_4 = $_POST['seleccion_item2-4']; 
                    $relainter_1 = $_POST['seleccion_item3-1']; 
                    $relainter_2 = $_POST['seleccion_item3-2']; 
                    $relainter_3 = $_POST['seleccion_item3-3']; 
                    $relainter_4 = $_POST['seleccion_item3-4']; 
                    $compempresa1_1 = $_POST['seleccion_item4-1']; 
                    $compempresa1_2 = $_POST['seleccion_item4-2']; 
                    $compempresa1_3 = $_POST['seleccion_item4-3']; 
                    $compempresa1_4 = $_POST['seleccion_item4-4']; 
                    
                    $compempresa2_1 = $_POST['seleccion_item5-1']; 
                    $compempresa2_2 = $_POST['seleccion_item5-2']; 
                    $compempresa2_3 = $_POST['seleccion_item5-3']; 
                    $compempresa2_4 = $_POST['seleccion_item5-4']; 
                    $compempresa3_1 = $_POST['seleccion_item6-1']; 
                    $compempresa3_2 = $_POST['seleccion_item6-2']; 
                    $compempresa3_3 = $_POST['seleccion_item6-3']; 
                    $compempresa3_4 = $_POST['seleccion_item6-4']; 
                    $compempresa4_1 = $_POST['seleccion_item7-1']; 
                    $compempresa4_2 = $_POST['seleccion_item7-2']; 
                    $compempresa4_3 = $_POST['seleccion_item7-3']; 
                    $compempresa4_4 = $_POST['seleccion_item7-4']; 
                    $autoevalua_1 = $_POST['seleccion_item8-1']; 
                    $autoevalua_2 = $_POST['seleccion_item8-2']; 
                    $autoevalua_3 = $_POST['seleccion_item8-3']; 
                    $autoevalua_4 = $_POST['seleccion_item8-4']; 
                    $autoevalua_5 = $_POST['seleccion_item8-5']; 
                    $coach = $_POST['indice_coach']; 
                    $coach_float = floatval($coach);
                    $accion_correct = $_POST['txt_correcion']; 
                    
                    $insert_data = "INSERT INTO dbo.Evaluaciones (local, cod_comb, tipo,  fecha,  semana, evaluador, empleado, cargo, formacion_1, formacion_2, formacion_3, formacion_4, formacion_5, organizacion_1, organizacion_2, organizacion_3, organizacion_4, relainter_1, relainter_2, relainter_3, relainter_4, compempresa1_1, compempresa1_2, compempresa1_3, compempresa1_4, compempresa2_1, compempresa2_2, compempresa2_3, compempresa2_4, compempresa3_1, compempresa3_2, compempresa3_3, compempresa3_4, compempresa4_1, compempresa4_2, compempresa4_3, compempresa4_4, autoevalua_1, autoevalua_2, autoevalua_3, autoevalua_4, autoevalua_5, coach_val, ac_correctiva) VALUES"
                                                      . " ('$local', ' ' , 'EV' , '$fecha' , '$semana' , '$evaluador', '$empleado', '$cargo_emp', '$formacion_1', '$formacion_2', '$formacion_3', '$formacion_4', '$formacion_5', '$organizacion_1', '$organizacion_2', '$organizacion_3', '$organizacion_4', '$relainter_1', '$relainter_2', '$relainter_3', '$relainter_4', '$compempresa1_1', '$compempresa1_2', '$compempresa1_3', '$compempresa1_4', '$compempresa2_1', '$compempresa2_2', '$compempresa2_3', '$compempresa2_4', '$compempresa3_1', '$compempresa3_2', '$compempresa3_3', '$compempresa3_4', '$compempresa4_1', '$compempresa4_2', '$compempresa4_3', '$compempresa4_4', '$autoevalua_1','$autoevalua_2','$autoevalua_3','$autoevalua_4','$autoevalua_5','$coach_float','$accion_correct')";

                    $query = odbc_prepare($conexion, $insert_data); 
                    odbc_execute($query);
                    
                    echo "<script language = javascript>
                            swal({  title: 'Envio Correcto',
                                text: 'Correcto, desea imprimir el reporte de evaluaciòn?',  
                                type: 'success',    
                                showCancelButton: true,   
                                closeOnConfirm: false, 
                                cancelButtonText: 'No, gracias', 
                                confirmButtonText: 'Si, Imprimir', 
                                showLoaderOnConfirm: true, }, 
                                function(isConfirm)
                                {
                                    if (isConfirm) 
                                    {
                                    
                                    swal({
                                        title: 'Generando PDF!',
                                        type: 'success', 
                                        timer: 2000,
                                        showConfirmButton: false
                                        
                                      });
                                      
                                     location = '../ws-evalua/'; 
                                     window.open('reportes/reporte_evaluado.php');
                                    } 
                                    else 
                                    {
                                    location = '../ws-evalua/'; 
                                    
                                    }
                                 
                                });
                        </script>";
                    
                    
                } else
                {
                    echo "<script language = javascript>
                            swal({  title: 'Error al enviar',
                            text: 'El código de verificacion es incorrecto!',  
                            type: 'error',    
                            showCancelButton: false,   
                            closeOnConfirm: false,   
                            confirmButtonText: 'Aceptar', 
                            showLoaderOnConfirm: true, }, 
                            function(){   
                                setTimeout(function(){     
                                    location = '../ws-evalua/';  
                                });
                                 });
                        </script>";
                }
                
                
                      
    }else
    {
    echo "<script language = javascript>
            swal({  title: 'Error al enviar',
            text: 'El código de verificacion está vacio!',  
            type: 'error',    
            showCancelButton: false,   
            closeOnConfirm: false,   
            confirmButtonText: 'Aceptar', 
            showLoaderOnConfirm: true, }, 
            function(){   
                setTimeout(function(){     
                    location = '../ws-evalua/';  
                });
                 });
        </script>"; 
                               
    }

               
                 
              