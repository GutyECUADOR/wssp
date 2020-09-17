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
include_once ('../ws-admin/acceso_multi_db.php');
        
if (!empty($_POST['txt_cisolicitante']) && !empty($_POST['txt_total']) ) {
                   
                   $cod_valep_edit = $_POST['cod_valep_edit']; //Indica que vale sera actualizado
                   $db_empresa = getDataBase($_POST['select_empresaa']);  // Indica que DB de winfenix sera actualizada
                   $cod_empresaValep_act = trim($_POST['select_empresaa']);
                   
                   echo "Actualizando vale:" .$cod_valep_edit. " en base de datos: " .$cod_empresaValep_act."<br>"; //Recuperamos codigo del vale 
                   
                   $query_datosEmpresa = "SELECT NomCia, Oficina, Ejercicio FROM dbo.DatosEmpresa";
                   $result_datosEmpresa = odbc_exec($db_empresa, $query_datosEmpresa);
                   
                   $oficinaEmpresa =  trim(odbc_result($result_datosEmpresa,"Oficina"));
                   $ejercicioEmpresa =  trim(odbc_result($result_datosEmpresa,"Ejercicio"));
                   

                   //Cambiamos estado del vale a 1 (Autorizado)
                   $consulta_ven_mov = "UPDATE KAO_wssp.dbo.vales_perdida SET estado = 1 WHERE cod_valep = '$cod_valep_edit' AND empresa = '$cod_empresaValep_act' ";
                   odbc_exec($conexion, $consulta_ven_mov);
                   
                   /*Actualizamos datos WSSP de vales_perdida*/
                    $subtotal_edita = $_POST['txt_subtotal']; 
                    $iva_edita = $_POST['txt_iva']; 
                    $total_edita = $_POST['txt_total']; 
                    
                    $actualiza_vales_perdida = "UPDATE dbo.vales_perdida SET subtotal = '$subtotal_edita', iva= '$iva_edita', total = '$total_edita' WHERE cod_valep = '$cod_valep_edit' AND empresa = '$cod_empresaValep_act'";
                    odbc_exec($conexion, $actualiza_vales_perdida); 
              
                    /*Actualizacion VEN_CAB*/
                        
                    $actualiza_data_ven_cab = "UPDATE dbo.VEN_CAB SET SUBTOTAL = '$subtotal_edita', IMPUESTO='$iva_edita', TOTAL = '$total_edita' WHERE ID = '$cod_valep_edit'";
                    $query_update_ven_cab = odbc_prepare($db_empresa, $actualiza_data_ven_cab); 
                    odbc_execute($query_update_ven_cab);
                    
                    
                   /** Actualizar tabla VEN_MOV WinFenix y VALEP_detalle **/
                    
                    $array_productos = array_map('strtoupper',$_POST['txt_cod_product']);
                    $array_preciosunitarios = $_POST['hidden_precio_product'];
                    $array_porcentajes = $_POST['txt_descuento'];
                    $array_valores = $_POST['txt_precio_product'];
                   
                    echo "</br>Productos: ".count($array_productos);
                     for ($i=0; $i < sizeof($array_productos);$i++) {
                        //Actualiza los valores y porcentajes del vale
                        $actualiza_data_valesp = "UPDATE dbo.detalle_valep SET valor='$array_valores[$i]' WHERE cod_detalle_valep = '$cod_valep_edit' and cod_producto = '$array_productos[$i]' AND empresa = '$cod_empresaValep_act'";
                        odbc_exec($conexion, $actualiza_data_valesp); 
                        
                        
                        /*Actualizacion VEN_MOV*/
                        
                        $actualiza_data_ven_mov = "UPDATE dbo.VEN_MOV SET PRECIO = '$array_valores[$i]', DESCU='$array_porcentajes[$i]', PRECIOTOT='$array_valores[$i]' WHERE ID='$cod_valep_edit' and CODIGO='$array_productos[$i]'";
                        $query_update_ven_mov = odbc_prepare($db_empresa, $actualiza_data_ven_mov); 
                        odbc_execute($query_update_ven_mov);
                        
                    }
                    
                    
                    /** Actualizar tabla revargo_vales_perdida WSSP **/
                    $array_recargo_codWinF = $_POST['txt_hiddenwinf_emp']; 
                    $array_recargo_ci = $_POST['txt_ci_empleado'];
                    $array_recargo_porcent = $_POST['txt_porcent_emp'];
                    $array_recargo_valor = $_POST['txt_valor_emp'];
                    
                    echo "</br>Empleados: ".count($array_recargo_ci);
                    for ($i=0; $i < sizeof($array_recargo_ci);$i++) {
                        //echo "</br>".$array_recargo_ci[$i].$array_recargo_porcent[$i].$array_recargo_valor[$i];
                        //Actualiza si existe la cedula en el vale, inserta si no
                        $insert_data_valesp = "UPDATE dbo.recargo_valep SET porcentaje = '$array_recargo_porcent[$i]', valor = '$array_recargo_valor[$i]' WHERE cod_recargo_valep = '$cod_valep_edit' AND ci_empleado_rec = '$array_recargo_ci[$i]' AND empresa = '$cod_empresaValep_act'  IF @@ROWCOUNT = 0 INSERT INTO dbo.recargo_valep VALUES ('$cod_valep_edit','$cod_empresaValep_act','$array_recargo_ci[$i]','$array_recargo_codWinF[$i]','$array_recargo_porcent[$i]','$array_recargo_valor[$i]')";
                        
                        $query = odbc_prepare($conexion, $insert_data_valesp); 
                        
                        if (odbc_execute($query)){
                        echo "Actualizacion correcta de registro: ".$array_recargo_ci[$i];
                        }else{
                         echo "ODBC error: ", odbc_errormsg();
                    }
                    
                        
                    }
                    
                    
                    /** Ejecucion de SP de creacion de vales ROL_CAB WINFENIX**/
                    
                    $ci_solicitante_edita = $_POST['txt_cisolicitante'];
                    $serie_with0_edita = $_POST['serie_with0_edita'];
                    $fecha_soli_edita = $_POST['fecha_soli_edita'];
                    $fechaINIPagos_edita = $_POST['fechaINIPagos_edita'];
                    
                    
                    
                     
                    
                    
                    $fecha_now_SQL_SPAM = date("Ymd", strtotime($fecha_soli_edita)); //Evita error por - en formato de fechas 
                    $fecha_pagos_SPAM = date("Ymd", strtotime($fechaINIPagos_edita));
                    
                    $array_valoresxempleado = $_POST['txt_valor_emp'];  // Contiene los valores descritos en formulario de actualizacion
                    
                    echo "</br>Vales agregados a ROL_CAB: ".count($array_recargo_codWinF);
                    
                    for ($i=0; $i < sizeof($array_recargo_codWinF);$i++) {
                        
                        if ($array_valoresxempleado[$i] >= 10){
                            $numcuotas_edita = $_POST['numcuotas_edita']; // Contiene numero de cuotas especificadas para el vale
                        }else{
                            $numcuotas_edita = 1;
                        }
                        
                        
                        $empleado_rol = $array_recargo_codWinF[$i]; //Obtenemos CI de array
                        $valor_rol = $array_recargo_valor [$i] / $numcuotas_edita; //Calculo del valor a pagar por el empleado para num de cuotas del vale
                         //Obtenemos el entero de la tabla CONTADORES WinFenix
                         
                        $NextID_SP = odbc_exec($db_empresa, "exec Sp_Contador 'ROL','99','$ejercicioEmpresa','SPE',''");
                        $int_spvale = odbc_result($NextID_SP, 1); 

                        $sp_cod = odbc_exec($db_empresa, "select RIGHT('00000000' + Ltrim(Rtrim($int_spvale)),8) as newcod");
                        $cod_sp_with0vale = odbc_result($sp_cod, 1);  //Recuperamos nuevo codigo con formato 0000000X
                        
                       
                        
                        // Insert en base de datos
                        odbc_exec($db_empresa,"exec dbo.SP_ROLGRACAB 'I','ADMIN','TS # WSSPAdmin','99','$ejercicioEmpresa','SPE','$cod_sp_with0vale','$fecha_now_SQL_SPAM','$empleado_rol','WSSP - $cod_valep_edit','','$array_valoresxempleado[$i]','0.00','$numcuotas_edita','12','$fecha_pagos_SPAM','',''");
                        
                        $dateaddSTAMPTIME = date("Ymd", strtotime($fechaINIPagos_edita));
                        $dateadd = date_create($dateaddSTAMPTIME); // Cambio a DateObject para agregar dias
      

                        for ($j=1; $j <= $numcuotas_edita;$j++) {
                            
                            //Creacion secuencial formato XX
                            $sprep_cod = odbc_exec($db_empresa, "select RIGHT('00' + Ltrim(Rtrim($j)),2) as newcod");
                            $cod_sprep_with0vale = odbc_result($sprep_cod, 1); 
                            
                            if ($j==1) {
                                $dateadd30mas = $dateaddSTAMPTIME;
                            }else{
                                $dateadd30mas = date_format(date_add($dateadd, date_interval_create_from_date_string('30 days')), 'Ymd'); // Agregara X dias y devuelve formado Y-m-d
                                
                            }

                            //Tabla ROL_MOV
                            odbc_exec($db_empresa,"exec dbo.SP_ROLGRAMOV 'I','99','$ejercicioEmpresa','SPE','$cod_sp_with0vale','$cod_sprep_with0vale','$dateadd30mas','$valor_rol','0.00','$valor_rol'");
                            // Tabla CXC
                            odbc_exec($db_empresa,"exec dbo.SP_ROLGRACXC 'I','ADMINWSSP','TS # AdminWSSP','99','$ejercicioEmpresa','SPE','$cod_sp_with0vale','$cod_sprep_with0vale','$fecha_now_SQL_SPAM','$dateadd30mas','$empleado_rol','VALES POR WSSP','D','$valor_rol','0.00'");
                             
                           

                         }
                        
                    }
                    
                    
                    
                    echo "<script language = javascript>
                            swal({  title: 'Solicitud Actualizada',
                            text: 'Su solicitud ha sido actualizada, y se han generado cobros automáticos en el rol de los empleados, revise la información del mismo desde la administración, seccion vales aprobados!',  
                            type: 'success',    
                            showCancelButton: false,   
                            closeOnConfirm: false,   
                            confirmButtonText: 'Aceptar', 
                            showLoaderOnConfirm: true, }, 
                            function(){   
                                setTimeout(function(){     
                                    location = '../ws-valep/';
                                    window.close();  
                                });
                                 });
                        </script>";
                    
} else{
   
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