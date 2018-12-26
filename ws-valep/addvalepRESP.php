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
$fecha = date ("Y-n-d"); 

if (!empty($_POST['txt_cisolicitante'])&& !empty($_POST['txt_total'])) {
                   
                   $ci_solicitante_form = $_POST['txt_cisolicitante'];
                   $ci_supervisor_form = trim($_POST['select_dirigidoa']); 
                    // Obtencion del Còdigo mediante store procedure
                   echo $ci_supervisor_form;
                   
                   switch ($ci_supervisor_form){
                       
                        //Especifique que codigos de vales existen segun codigo de persona
                        case '012':
                            $cod_tipodoc='VPA';
                            $sp_cod=odbc_exec($conexion,"exec KAO_wssp.dbo.sp_generar_codigo '$cod_tipodoc'");
                            $new_cod_sp = odbc_result($sp_cod, 1);   
                        break;
                        case '015':
                            $cod_tipodoc='VPB';
                            $sp_cod=odbc_exec($conexion,"exec KAO_wssp.dbo.sp_generar_codigo '$cod_tipodoc'");
                            $new_cod_sp = odbc_result($sp_cod, 1);   
                        break;
                        default :
                            $cod_tipodoc='VPP';
                            $sp_cod=odbc_exec($conexion,"exec KAO_wssp.dbo.sp_generar_codigo '$cod_tipodoc'");
                            $new_cod_sp = odbc_result($sp_cod, 1);   
                        break;
                    }
             
                    echo "Cod.".$new_cod_sp;
                    
                    // Insert tabla vales_perdida
                    $cod_empresa = $_POST['cod_txt_empresa'];
                    $subtotal = $_POST['txt_subtotal']; 
                    $iva = $_POST['txt_iva']; 
                    $total = $_POST['txt_total']; 
                    
                        $insert_data_valesp = "INSERT INTO dbo.vales_perdida VALUES ('$new_cod_sp','$cod_tipodoc','$fecha','$ci_solicitante_form','$ci_supervisor_form','$cod_empresa','$subtotal','$iva','$total','')";
                        $query = odbc_prepare($conexion, $insert_data_valesp); 
                        odbc_execute($query);
                    
                    // Insert tabla detalle vales perdida
                    
                    $array_cod = $_POST['txt_cod_product'];
                    $array_detalle = $_POST['txt_detalle_product'];
                    $array_cant = $_POST['txt_cant_product'];
                    $array_precio = $_POST['txt_precio_product'];
                    echo "</br>Productos".count($array_cod);
                    for ($cont=0; $cont < sizeof($array_cod);$cont++) {
                        
                        //echo "</br>".$array_cod[$cont].$array_cant[$cont].$array_precio[$cont];
                        $insert_data_valesp = "INSERT INTO dbo.detalle_valep VALUES ('$new_cod_sp','$array_cod[$cont]','$array_detalle[$cont]','$array_cant[$cont]','$array_precio[$cont]')";
                        $query = odbc_prepare($conexion, $insert_data_valesp); 
                        odbc_execute($query);
                    }
                    
                    
                     // Insert tabla revargo vales perdida
                    $array_recargo_ci = $_POST['txt_ci_empleado'];
                    $array_recargo_porcent = $_POST['txt_porcent_emp'];
                    $array_recargo_valor = $_POST['txt_valor_emp'];
                    
                    echo "</br>Empleados".count($array_recargo_ci);
                    for ($i=0; $i < sizeof($array_recargo_ci);$i++) {
                        
                        //echo "</br>".$array_recargo_ci[$i].$array_recargo_porcent[$i].$array_recargo_valor[$i];
                        $insert_data_valesp = "INSERT INTO dbo.recargo_valep VALUES ('$new_cod_sp','$array_recargo_ci[$i]','$array_recargo_porcent[$i]','$array_recargo_valor[$i]')";
                        $query = odbc_prepare($conexion, $insert_data_valesp); 
                        odbc_execute($query);
                    }
                    
                    
                    echo "<script language = javascript>
                            swal({  title: 'Envio Correcto',
                                text: 'Correcto, desea imprimir el reporte?',  
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
                                      
                                     location = '../ws-valep/'; 
                                     window.open('reportes/reporte_valep_byid.php?valep_cod=$new_cod_sp');
                                    } 
                                    else 
                                    {
                                    location = '../ws-valep/'; 
                                    
                                    }
                                 
                                });
                        </script>";
                   
                      
    }else
    {
    echo "<script language = javascript>
            swal({  title: 'Solicitud Vacia',
            text: 'Uno o más campos necesarios no fueron ingresados, revise que exista un monto total válido!',  
            type: 'error',    
            showCancelButton: false,   
            closeOnConfirm: false,   
            confirmButtonText: 'Aceptar', 
            showLoaderOnConfirm: true, }, 
            function(){   
                setTimeout(function(){     
                    location = '../ws-valep/';  
                });
                 });
        </script>"; 
                               
    }

               