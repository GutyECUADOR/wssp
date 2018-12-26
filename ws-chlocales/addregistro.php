<html>
<head><title></title>
        <script src="sweet/dist/sweetalert2.js"></script>
        <link rel="stylesheet" type="text/css" href="sweet/dist/sweetalert2.css">
</head>
<body></body>
</html>

<?php
include_once ('../ws-admin/acceso_db.php');
include_once ('../ws-admin/acceso_multi_db.php');

 
if (!empty($_POST['select_empresaa'])&& !empty($_POST['txt_cisolicitante'])) {
                   
                   $id_empresa_checks = trim($_POST['select_empresaa']);
                   $id_local_checks = trim($_POST['cod_txt_empresa']);
                   $ci_supervisor_checks = trim($_POST['txt_cisolicitante']); 
                   $fecha = trim($_POST['date_chk']); 
                   $tipo = 'CHLOCAL';
                   
                   // Comprobar variables llegadas desde formulario
                   if (isset($_POST['chk1_1'])){
                       $chk1_1 = TRUE;}else{
                       $chk1_1 = FALSE;
                    }
                    
                    if (isset($_POST['chk1_2'])){
                       $chk1_2 = TRUE;}else{
                       $chk1_2 = FALSE;
                    }
                  
                    if (isset($_POST['chk1_3'])){
                       $chk1_3 = TRUE;}else{
                       $chk1_3 = FALSE;
                    }
                    
                    // Seccion 2
                    if (isset($_POST['chk2_1'])){
                       $chk2_1 = TRUE;}else{
                       $chk2_1 = FALSE;
                    }
                    
                    // Sección 3
                    if (isset($_POST['chk3_1'])){
                       $chk3_1 = TRUE;}else{
                       $chk3_1 = FALSE;
                    }
                    
                    if (isset($_POST['chk3_2'])){
                       $chk3_2 = TRUE;}else{
                       $chk3_2 = FALSE;
                    }
                    
                    // Seccion 4
                    if (isset($_POST['chk4_1'])){
                       $chk4_1 = TRUE;}else{
                       $chk4_1 = FALSE;
                    }
                    
                    if (isset($_POST['chk4_2'])){
                       $chk4_2 = TRUE;}else{
                       $chk4_2 = FALSE;
                    }
                    
                    // Secciòn 5 
                    
                    if (isset($_POST['chk5_1'])){
                       $chk5_1 = TRUE;}else{
                       $chk5_1 = FALSE;
                    }
                    if (isset($_POST['chk5_2'])){
                       $chk5_2 = TRUE;}else{
                       $chk5_2 = FALSE;
                    }
                    if (isset($_POST['chk5_3'])){
                       $chk5_3 = TRUE;}else{
                       $chk5_3 = FALSE;
                    }
                    if (isset($_POST['chk5_4'])){
                       $chk5_4 = TRUE;}else{
                       $chk5_4 = FALSE;
                    }
                    
                    // Seccion 6
                    if (isset($_POST['chk6_1'])){
                       $chk6_1 = TRUE;}else{
                       $chk6_1 = FALSE;
                    }
                    if (isset($_POST['chk6_2'])){
                       $chk6_2 = TRUE;}else{
                       $chk6_2 = FALSE;
                    }
                    if (isset($_POST['chk6_3'])){
                       $chk6_3 = 1;}else{
                       $chk6_3 = FALSE;
                    }
                    
                    // Seccion 7
                    if (isset($_POST['chk7_1'])){
                       $chk7_1 = TRUE;}else{
                       $chk7_1 = FALSE;
                    }
                    if (isset($_POST['chk7_2'])){
                       $chk7_2 = TRUE;}else{
                       $chk7_2 = FALSE;
                    }
                    if (isset($_POST['chk7_3'])){
                       $chk7_3 = TRUE;}else{
                       $chk7_3 = FALSE;
                    }
                    if (isset($_POST['chk7_4'])){
                       $chk7_4 = TRUE;}else{
                       $chk7_4 = FALSE;
                    }
                    if (isset($_POST['chk7_5'])){
                       $chk7_5 = TRUE;}else{
                       $chk7_5 = FALSE;
                    }
                    if (isset($_POST['chk7_6'])){
                       $chk7_6 = TRUE;}else{
                       $chk7_6 = FALSE;
                    }
                    if (isset($_POST['chk7_7'])){
                       $chk7_7 = TRUE;}else{
                       $chk7_7 = FALSE;
                    }
                    if (isset($_POST['chk7_8'])){
                       $chk7_8 = TRUE;}else{
                       $chk7_8 = FALSE;
                    }
                    
                    // Seccion 8
                    if (isset($_POST['chk8_1'])){
                       $chk8_1 = TRUE;}else{
                       $chk8_1 = FALSE;
                    }
                    if (isset($_POST['chk8_2'])){
                       $chk8_2 = TRUE;}else{
                       $chk8_2 = FALSE;
                    }
                    if (isset($_POST['chk8_3'])){
                       $chk8_3 = TRUE;}else{
                       $chk8_3 = FALSE;
                    }
                    if (isset($_POST['chk8_4'])){
                       $chk8_4 = TRUE;}else{
                       $chk8_4 = FALSE;
                    }
                    
                    // Seccion 9
                    
                    if (isset($_POST['chk9_1'])){
                       $chk9_1 = TRUE;}else{
                       $chk9_1 = FALSE;
                    }
                    if (isset($_POST['chk9_2'])){
                       $chk9_2 = TRUE;}else{
                       $chk9_2 = FALSE;
                    }
                    if (isset($_POST['chk9_3'])){
                       $chk9_3 = TRUE;}else{
                       $chk9_3 = FALSE;
                    }
                    if (isset($_POST['chk9_4'])){
                       $chk9_4 = TRUE;}else{
                       $chk9_4 = FALSE;
                    }
                    if (isset($_POST['chk9_5'])){
                       $chk9_5 = TRUE;}else{
                       $chk9_5 = FALSE;
                    }
                    if (isset($_POST['chk9_6'])){
                       $chk9_6 = TRUE;}else{
                       $chk9_6 = FALSE;
                    }
                    if (isset($_POST['chk9_7'])){
                       $chk9_7 = TRUE;}else{
                       $chk9_7 = FALSE;
                    }
                    if (isset($_POST['chk9_8'])){
                       $chk9_8 = TRUE;}else{
                       $chk9_8 = FALSE;
                    }
                    if (isset($_POST['chk9_9'])){
                       $chk9_9 = TRUE;}else{
                       $chk9_9 = FALSE;
                    }
                    
                    // Seccion 10
                    if (isset($_POST['chk10_1'])){
                       $chk10_1 = TRUE;}else{
                       $chk10_1 = FALSE;
                    }
                    if (isset($_POST['chk10_2'])){
                       $chk10_2 = TRUE;}else{
                       $chk10_2 = FALSE;
                    }
                    if (isset($_POST['chk10_3'])){
                       $chk10_3 = TRUE;}else{
                       $chk10_3 = FALSE;
                    }
                    
                    // Seccion 11
                    if (isset($_POST['chk11_1'])){
                       $chk11_1 = TRUE;}else{
                       $chk11_1 = FALSE;
                    }
                    if (isset($_POST['chk11_2'])){
                       $chk11_2 = TRUE;}else{
                       $chk11_2 = FALSE;
                    }
                    if (isset($_POST['chk11_3'])){
                       $chk11_3 = TRUE;}else{
                       $chk11_3 = FALSE;
                    }
                    if (isset($_POST['chk11_4'])){
                       $chk11_4 = TRUE;}else{
                       $chk11_4 = FALSE;
                    }
                    if (isset($_POST['chk11_5'])){
                       $chk11_5 = TRUE;}else{
                       $chk11_5 = FALSE;
                    }
                    if (isset($_POST['chk11_6'])){
                       $chk11_6 = TRUE;}else{
                       $chk11_6 = FALSE;
                    }
                    if (isset($_POST['chk11_7'])){
                       $chk11_7 = TRUE;}else{
                       $chk11_7 = FALSE;
                    }
                    if (isset($_POST['chk11_8'])){
                       $chk11_8 = TRUE;}else{
                       $chk11_8 = FALSE;
                    }
                   
                    // Seccion 12 
                    if (isset($_POST['chk12_1'])){
                       $chk12_1 = TRUE;}else{
                       $chk12_1 = 0;
                    }
                    
                    // Seccion 13
                    if (isset($_POST['chk13_1'])){
                       $chk13_1 = TRUE;}else{
                       $chk13_1 = 0;
                    }
                    if (isset($_POST['chk13_2'])){
                       $chk13_2 = TRUE;}else{
                       $chk13_2 = 0;
                    }
                    if (isset($_POST['chk13_3'])){
                       $chk13_3 = TRUE;}else{
                       $chk13_3 = 0;
                    }
                    if (isset($_POST['chk13_4'])){
                       $chk13_4 = TRUE;}else{
                       $chk13_4 = 0;
                    }
                    if (isset($_POST['chk13_5'])){
                       $chk13_5 = TRUE;}else{
                       $chk13_5 = 0;
                    }    
                   
                    // Seccion 14
                    if (isset($_POST['chk14_1'])){
                       $chk14_1 = TRUE;}else{
                       $chk14_1 = 0;
                    }
                    if (isset($_POST['chk14_2'])){
                       $chk14_2 = TRUE;}else{
                       $chk14_2 = 0;
                    }
                    if (isset($_POST['chk14_3'])){
                       $chk14_3 = TRUE;}else{
                       $chk14_3 = 0;
                    }
                    if (isset($_POST['chk14_4'])){
                       $chk14_4 = TRUE;}else{
                       $chk14_4 = 0;
                    }
                    if (isset($_POST['chk14_5'])){
                       $chk14_5 = TRUE;}else{
                       $chk14_5 = 0;
                    }    
                    
                    // Seccion 15
                    
                    if (isset($_POST['chk15_1'])){
                       $chk15_1 = TRUE;}else{
                       $chk15_1 = 0;
                    }    
                    
                    // Seccion 16
                    if (isset($_POST['chk16_1'])){
                       $chk16_1 = TRUE;}else{
                       $chk16_1 = 0;
                    }
                    if (isset($_POST['chk16_2'])){
                       $chk16_2 = TRUE;}else{
                       $chk16_2 = 0;
                    }
                    if (isset($_POST['chk16_3'])){
                       $chk16_3 = TRUE;}else{
                       $chk16_3 = 0;
                    }
                    
                    // Seccion 17
                    if (isset($_POST['chk17_1'])){
                       $chk17_1 = TRUE;}else{
                       $chk17_1 = 0;
                    }
                    if (isset($_POST['chk17_2'])){
                       $chk17_2 = TRUE;}else{
                       $chk17_2 = 0;
                    }
                    if (isset($_POST['chk17_3'])){
                       $chk17_3 = TRUE;}else{
                       $chk17_3 = 0;
                    }
                    if (isset($_POST['chk17_4'])){
                       $chk17_4 = TRUE;}else{
                       $chk17_4 = 0;
                    }
                    if (isset($_POST['chk17_5'])){
                       $chk17_5 = TRUE;}else{
                       $chk17_5 = 0;
                    } 
                    if (isset($_POST['chk17_6'])){
                       $chk17_6 = TRUE;}else{
                       $chk17_6 = 0;
                    } 
                    
                    // Seccion 18
                    if (isset($_POST['chk18_1'])){
                       $chk18_1 = TRUE;}else{
                       $chk18_1 = 0;
                    }
                    if (isset($_POST['chk18_2'])){
                       $chk18_2 = TRUE;}else{
                       $chk18_2 = 0;
                    }
                    if (isset($_POST['chk18_3'])){
                       $chk18_3 = TRUE;}else{
                       $chk18_3 = 0;
                    }
                    if (isset($_POST['chk18_4'])){
                       $chk18_4 = TRUE;}else{
                       $chk18_4 = 0;
                    }
                    if (isset($_POST['chk18_5'])){
                       $chk18_5 = TRUE;}else{
                       $chk18_5 = 0;
                    } 
                    if (isset($_POST['chk18_6'])){
                       $chk18_6 = TRUE;}else{
                       $chk18_6 = 0;
                    } 
                     if (isset($_POST['chk18_7'])){
                       $chk18_7 = TRUE;}else{
                       $chk18_7 = 0;
                    } 
                    
                    // Seccion 19
                    if (isset($_POST['chk19_1'])){
                       $chk19_1 = TRUE;}else{
                       $chk19_1 = 0;
                    }
                    if (isset($_POST['chk19_2'])){
                       $chk19_2 = TRUE;}else{
                       $chk19_2 = 0;
                    }
                    if (isset($_POST['chk19_3'])){
                       $chk19_3 = TRUE;}else{
                       $chk19_3 = 0;
                    }
                    if (isset($_POST['chk19_4'])){
                       $chk19_4 = TRUE;}else{
                       $chk19_4 = 0;
                    }
                    if (isset($_POST['chk19_5'])){
                       $chk19_5 = TRUE;}else{
                       $chk19_5 = 0;
                    } 
                    if (isset($_POST['chk19_6'])){
                       $chk19_6 = TRUE;}else{
                       $chk19_6 = 0;
                    } 
                     if (isset($_POST['chk19_7'])){
                       $chk19_7 = TRUE;}else{
                       $chk19_7 = 0;
                    } 
                    
                    
                  
                   $txt_observaciones = $_POST['txt_observacion'];
                    
                   echo "Registro en DB:" . $id_empresa_checks."<br>";
                   $db_empresa = getDataBase('009'); //Obtenemos conexion con base de datos segun codigo de la DB
                   
                   $insert_data = "INSERT INTO dbo.chlist_locales (codchequeo, empresa, local, supervisor, fecha, chk_1_1, chk_1_2, chk_1_3, chk_2_1, chk_3_1, chk_3_2, chk_4_1, chk_4_2,chk_5_1, chk_5_2, chk_5_3, chk_5_4, chk_6_1, chk_6_2, chk_6_3, chk_7_1, chk_7_2, chk_7_3, chk_7_4, chk_7_5, chk_7_6, chk_7_7, chk_7_8, chk_8_1, chk_8_2, chk_8_3, chk_8_4, chk_9_1, chk_9_2, chk_9_3, chk_9_4, chk_9_5, chk_9_6, chk_9_7, chk_9_8, chk_9_9, chk_10_1, chk_10_2, chk_10_3, chk_11_1, chk_11_2, chk_11_3, chk_11_4, chk_11_5, chk_11_6, chk_11_7, chk_11_8, chk_12_1, chk_13_1, chk_13_2, chk_13_3, chk_13_4, chk_13_5, chk_14_1, chk_14_2, chk_14_3, chk_14_4, chk_14_5, chk_15_1, chk_16_1,  chk_16_2,  chk_16_3, chk_17_1, chk_17_2, chk_17_3, chk_17_4, chk_17_5, chk_17_6, chk_18_1, chk_18_2, chk_18_3, chk_18_4, chk_18_5, chk_18_6, chk_18_7, chk_19_1, chk_19_2, chk_19_3, chk_19_4, chk_19_5, chk_19_6, chk_19_7, observacion) VALUES"
                       . " ('$tipo', '$id_empresa_checks' , '$id_local_checks' , '$ci_supervisor_checks', '$fecha', '$chk1_1', '$chk1_2', '$chk1_3', '$chk2_1', '$chk3_1', '$chk3_2', '$chk4_1', '$chk4_2', '$chk5_1', '$chk5_2', '$chk5_3', '$chk5_4','$chk6_1', '$chk6_2', '$chk6_3','$chk7_1', '$chk7_2', '$chk7_3', '$chk7_4', '$chk7_5', '$chk7_6', '$chk7_7', '$chk7_8', '$chk8_1', '$chk8_2', '$chk8_3', '$chk8_4', '$chk9_1', '$chk9_2', '$chk9_3', '$chk9_4', '$chk9_5', '$chk9_6', '$chk9_7', '$chk9_8', '$chk9_9', '$chk10_1', '$chk10_2', '$chk10_3', '$chk11_1', '$chk11_2', '$chk11_3', '$chk11_4', '$chk11_5', '$chk11_6', '$chk11_7', '$chk11_8', '$chk12_1', '$chk13_1', '$chk13_2', '$chk13_3', '$chk13_4', '$chk13_5', '$chk14_1', '$chk14_2', '$chk14_3', '$chk14_4', '$chk14_5', '$chk15_1', '$chk16_1', '$chk16_2', '$chk16_3', '$chk17_1',  '$chk17_2', '$chk17_3', '$chk17_4', '$chk17_5', '$chk17_6', '$chk18_1', '$chk18_2', '$chk18_3', '$chk18_4', '$chk18_5', '$chk18_6', '$chk18_7', '$chk19_1', '$chk19_2', '$chk19_3', '$chk19_4', '$chk19_5', '$chk19_6', '$chk19_7', '$txt_observaciones')";

                    $query = odbc_prepare($db_empresa, $insert_data); 
                    if (odbc_execute($query)){
                        echo "<script>
                            swal({
                                title: 'Registro correcto',
                                text: 'Imprimir reporte?',
                                type: 'question',
                                showCancelButton: true,
                                confirmButtonColor: '#3085d6',
                                cancelButtonColor: '#d33',
                                confirmButtonText: 'Si, generar!',
                                cancelButtonText: 'No gracias',
                              }).then(function () {
                                    swal(
                                      'Correcto!',
                                      'Generando Archivo.',
                                      'success'
                                    )
                                    location = '../ws-chlocales/'; 
                                    window.open('reportes/reporte_diario.php');
                                    
                                  }, function (dismiss) {
                                    // dismiss can be 'cancel', 'overlay',
                                    // 'close', and 'timer'
                                    if (dismiss === 'cancel') {
                                       location = '../ws-chlocales/'; 
                                    }
                                  })

                        </script>";
                    }  else {
                        
                         echo "<script>
                            swal({
                            type: 'error',
                            title: 'No se ha realizado el registro, informe del error al departamento de sistemas',
                            showConfirmButton: false,
                            timer: 6000
                          }).then(
                            function () {},
                            // handling the promise rejection
                            function (dismiss) {
                              if (dismiss === 'timer') {
                                location = '../ws-chlocales/'; 
                              }
                            }
                          )
                         </script>";
                    }
                    
                    
} else{
   
    echo "<script>
            swal({
            type: 'error',
            title: 'Campos obligatorios no encontrados',
            showConfirmButton: false,
            timer: 6000
          }).then(
            function () {},
            // handling the promise rejection
            function (dismiss) {
              if (dismiss === 'timer') {
                location = '../ws-chlocales/'; 
              }
            }
          )
         </script>";
                               
    
 
}                 