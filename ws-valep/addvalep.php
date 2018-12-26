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
include_once ('../ws-admin/acceso_multi_db.php');
$fecha = date ("Y-n-d"); 

if (!empty($_POST['txt_cisolicitante'])&& !empty($_POST['txt_total'])) {
                   
                   $ci_solicitante_form = $_POST['txt_cisolicitante'];
                   $ci_supervisor_form = trim($_POST['select_dirigidoa']); 
                   $id_empresa = trim($_POST['select_empresaa']);
                    // Obtencion del Còdigo mediante store procedure
                   
                   echo "Empresa:" . $id_empresa."<br>";
                   echo "Cod Supervisor:" . $ci_supervisor_form ."<br>"; //Recuperamos codigo del usuario 
                   
                   $db_empresa = getDataBase($id_empresa); //Obtenemos conexion con base de datos segun codigo de la DB
                   
                   $query_datosEmpresa = "SELECT NomCia, Oficina, Ejercicio FROM dbo.DatosEmpresa";
                   $result_datosEmpresa = odbc_exec($db_empresa, $query_datosEmpresa);
                   
                   $oficinaEmpresa =  trim(odbc_result($result_datosEmpresa,"Oficina"));
                   $ejercicioEmpresa =  trim(odbc_result($result_datosEmpresa,"Ejercicio"));
                    echo "Oficina y ejercicio: ".$oficinaEmpresa.$ejercicioEmpresa;

                   switch ($ci_supervisor_form){ //Especifique que codigos de vales existen segun codigo de persona
                        
                        case 'SPA':  
                            $cod_tipodoc='SPA'; // Tipo de Documento
                            
                            //Obtenemos el entero de la tabla CONTADORES WinFenix
                            $NextID_SP = odbc_exec($db_empresa, "exec sp_contador 'VEN','$oficinaEmpresa','','$cod_tipodoc',''");
                            $int_sp = odbc_result($NextID_SP, 1); 
                            
                            $sp_cod = odbc_exec($db_empresa, "select RIGHT('00000000' + Ltrim(Rtrim($int_sp)),8) as newcod");
                            $cod_sp_with0 = odbc_result($sp_cod, 1);  //Recuperamos nuevo codigo con formato 0000000X
                            
                            $new_cod_sp = $oficinaEmpresa.$ejercicioEmpresa.$cod_tipodoc.$cod_sp_with0;
                            
                            echo "Nuevo documento: ".$new_cod_sp;
                            break;
                        
                        case 'SPB':  
                            $cod_tipodoc='SPB'; // Tipo de Documento
                            
                           //Obtenemos el entero de la tabla CONTADORES WinFenix
                            $NextID_SP = odbc_exec($db_empresa, "exec sp_contador 'VEN','$oficinaEmpresa','','$cod_tipodoc',''");
                            $int_sp = odbc_result($NextID_SP, 1); 
                            
                            $sp_cod = odbc_exec($db_empresa, "select RIGHT('00000000' + Ltrim(Rtrim($int_sp)),8) as newcod");
                            $cod_sp_with0 = odbc_result($sp_cod, 1);  //Recuperamos nuevo codigo con formato 0000000X
                            
                            $new_cod_sp = $oficinaEmpresa.$ejercicioEmpresa.$cod_tipodoc.$cod_sp_with0;
                            
                            echo "Nuevo documento: ".$new_cod_sp;
                            break;
                        
                        case 'SPC':  
                            $cod_tipodoc='SPC'; // Tipo de Documento
                            
                           //Obtenemos el entero de la tabla CONTADORES WinFenix
                            $NextID_SP = odbc_exec($db_empresa, "exec sp_contador 'VEN','$oficinaEmpresa','','$cod_tipodoc',''");
                            $int_sp = odbc_result($NextID_SP, 1); 
                            
                            $sp_cod = odbc_exec($db_empresa, "select RIGHT('00000000' + Ltrim(Rtrim($int_sp)),8) as newcod");
                            $cod_sp_with0 = odbc_result($sp_cod, 1);  //Recuperamos nuevo codigo con formato 0000000X
                            
                            $new_cod_sp = $oficinaEmpresa.$ejercicioEmpresa.$cod_tipodoc.$cod_sp_with0;
                            
                            echo "Nuevo documento: ".$new_cod_sp;
                            break;

                        case 'SPD':  
                            $cod_tipodoc='SPD'; // Tipo de Documento
                            
                           //Obtenemos el entero de la tabla CONTADORES WinFenix
                            $NextID_SP = odbc_exec($db_empresa, "exec sp_contador 'VEN','$oficinaEmpresa','','$cod_tipodoc',''");
                            $int_sp = odbc_result($NextID_SP, 1); 
                            
                            $sp_cod = odbc_exec($db_empresa, "select RIGHT('00000000' + Ltrim(Rtrim($int_sp)),8) as newcod");
                            $cod_sp_with0 = odbc_result($sp_cod, 1);  //Recuperamos nuevo codigo con formato 0000000X
                            
                            $new_cod_sp = $oficinaEmpresa.$ejercicioEmpresa.$cod_tipodoc.$cod_sp_with0;
                            
                            echo "Nuevo documento: ".$new_cod_sp;
                            break;   
                            
                        case 'SPE':  
                            $cod_tipodoc='SPE'; // Tipo de Documento
                            
                           //Obtenemos el entero de la tabla CONTADORES WinFenix
                            $NextID_SP = odbc_exec($db_empresa, "exec sp_contador 'VEN','$oficinaEmpresa','','$cod_tipodoc',''");
                            $int_sp = odbc_result($NextID_SP, 1); 
                            
                            $sp_cod = odbc_exec($db_empresa, "select RIGHT('00000000' + Ltrim(Rtrim($int_sp)),8) as newcod");
                            $cod_sp_with0 = odbc_result($sp_cod, 1);  //Recuperamos nuevo codigo con formato 0000000X
                            
                            $new_cod_sp = $oficinaEmpresa.$ejercicioEmpresa.$cod_tipodoc.$cod_sp_with0;
                            
                            echo "Nuevo documento: ".$new_cod_sp;
                            break;       

                        case 'SPF':  
                            $cod_tipodoc='SPF'; // Tipo de Documento
                            
                           //Obtenemos el entero de la tabla CONTADORES WinFenix
                            $NextID_SP = odbc_exec($db_empresa, "exec sp_contador 'VEN','$oficinaEmpresa','','$cod_tipodoc',''");
                            $int_sp = odbc_result($NextID_SP, 1); 
                            
                            $sp_cod = odbc_exec($db_empresa, "select RIGHT('00000000' + Ltrim(Rtrim($int_sp)),8) as newcod");
                            $cod_sp_with0 = odbc_result($sp_cod, 1);  //Recuperamos nuevo codigo con formato 0000000X
                            
                            $new_cod_sp = $oficinaEmpresa.$ejercicioEmpresa.$cod_tipodoc.$cod_sp_with0;
                            
                            echo "Nuevo documento: ".$new_cod_sp;
                            break;           
                     
                        default :
                            $cod_tipodoc='SPA'; // Tipo de Documento
                           //Obtenemos el entero de la tabla CONTADORES WinFenix
                            $NextID_SP = odbc_exec($db_empresa, "exec sp_contador 'VEN','$oficinaEmpresa','','$cod_tipodoc',''");
                            $int_sp = odbc_result($NextID_SP, 1); 
                            
                            $sp_cod = odbc_exec($db_empresa, "select RIGHT('00000000' + Ltrim(Rtrim($int_sp)),8) as newcod");
                            $cod_sp_with0 = odbc_result($sp_cod, 1);  //Recuperamos nuevo codigo con formato 0000000X
                            
                            $new_cod_sp = $oficinaEmpresa.$ejercicioEmpresa.$cod_tipodoc.$cod_sp_with0;
                            
                            echo "Nuevo documento: ".$new_cod_sp;
                            break;
                       
                    }

                    /** INSERT EN TABLA KAO_wssp - VALES_PERDIDA **/
                    
                    
                    $cod_empresaa = $_POST['select_empresaa'];
                    $cod_local = $_POST['cod_txt_empresa'];
                    $numcuotas = $_POST['select_numcuotas'];
                    $fechaINIPagos = $_POST['date_pagosini'];
                    $comentario_vale = $_POST['txt_comentario'];
                    $subtotal = $_POST['txt_subtotal']; 
                    $iva = $_POST['txt_iva']; 
                    $total = $_POST['txt_total']; 
                    
                    $insert_data_valesp_wssp = "INSERT INTO dbo.vales_perdida VALUES ('$new_cod_sp','$cod_tipodoc','$fecha','$ci_solicitante_form','$ci_supervisor_form','$cod_empresaa','$cod_local','$numcuotas','$fechaINIPagos','$subtotal','$iva','$total','0','$comentario_vale')";
                    $query = odbc_prepare($conexion, $insert_data_valesp_wssp); 
                    if (odbc_execute($query)){
                        echo "Nuevo documento registrado: ".$new_cod_sp;
                        }else{
                         echo "ODBC error: ", odbc_errormsg();
                    }
                    
                    /** INSERT EN TABLA WINFENIX - VEN_CAB **/
                    
                
                    $cod_cliente = $_POST['cod_txt_cliente'];  //Campo hidden de formulario
                    
                    $pcID = php_uname('n'); // Obtiene el nombre del PC
                    $bodega = $_POST['cod_txt_empresa']; // Tipo de documento
                    $fecha_now = date ("Y-n-d");  //Obtiene fecha actual formato aaaa-mm-dd
                    $fecha_now_SQL = date("Ymd", strtotime($fecha_now));  //Elimina del formato -, para evitar error
                    $observa_valep = 'Generado por WSSP';
                    $serie_valep='001005';
                    
                    if (odbc_exec($db_empresa,"exec dbo.SP_VENGRACAB 'I','ADMINWSSP','$pcID','$oficinaEmpresa','$ejercicioEmpresa','$cod_tipodoc','$cod_sp_with0','','$fecha_now_SQL','$cod_cliente','$bodega','DOL','1.00','0.00','$subtotal','0.00','0.00','0.00','0.00','0.00','$subtotal','0.00','$iva','0.00','$total','CON','0','1','0','S','0','1','0','0','','','999',' ',' ','$observa_valep','$serie_valep','$cod_sp_with0','','','','','0.00','0.00','0.00','','','','','','','                    ','','','0','P','','','','','','0','','','','','0','$iva','0.00','0.00','0.00','0','999999999 ','0','','','','','','EFE','','','','','$fecha_now_SQL','',''")){
                        echo "<br>Nuevo documento registrado en VEN_CAB: ".$new_cod_sp;
                        }else{
                         echo "<br>ODBC error al registrar en VEN_CAB: ", odbc_errormsg();
                    }
                    
                    
                    /** INSERT EN TABLA KAO_wssp - vales_perdida **/
                    
                    $array_cod = array_map('strtoupper',$_POST['txt_cod_product']);
                    $array_detalle = $_POST['txt_detalle_product'];
                    $array_cant = $_POST['txt_cant_product'];
                    $array_precio = $_POST['txt_precio_product'];
                    echo "</br>Productos: ".count($array_cod);
                    
                    for ($cont=0; $cont < sizeof($array_cod);$cont++) {
                        
                        //echo "</br>".$array_cod[$cont].$array_cant[$cont].$array_precio[$cont];
                        $insert_data_valesp = "INSERT INTO dbo.detalle_valep VALUES ('$new_cod_sp','$id_empresa','$array_cod[$cont]','$array_detalle[$cont]','$array_cant[$cont]','$array_precio[$cont]')";
                        $query = odbc_prepare($conexion, $insert_data_valesp); 
                        
                        if (odbc_execute($query)){
                        echo "<br>Nuevo producto registrado: ".$array_cod[$cont];
                        }else{
                         echo "ODBC error: ", odbc_errormsg();
                        }
                    }
                    
                    
                    /** INSERT EN TABLA WINFENIX - VEN_MOV **/
          
                    $array_cod = array_map('strtoupper',$_POST['txt_cod_product']);
                    $array_detalle = $_POST['txt_detalle_product'];
                    $array_cant = $_POST['txt_cant_product'];
                    $array_descuento = $_POST['txt_descuento'];
                    $array_precio = $_POST['txt_precio_product'];
                    
                    $cod_iva = 'T12';
                    $ivapor100 = '12.00';
                    $orden_p = '';
                   
                    for ($cont=0; $cont < sizeof($array_cod);$cont++) { // Agregamos un registro por cada articulo
                        
                         $prec_art = $array_precio[$cont]/$array_cant[$cont]; //Calculamos valor unitario
                         
                         if (odbc_exec($db_empresa,"exec dbo.SP_VENGRAMOV 'I','$oficinaEmpresa','$ejercicioEmpresa','$cod_tipodoc','$cod_sp_with0','$fecha_now_SQL','$cod_cliente','$bodega','S','0','0','$array_cod[$cont]','UND','$array_cant[$cont]','A','$prec_art','$array_descuento[$cont]','$ivapor100','$array_precio[$cont]','$fecha_now_SQL','','0.00','0.0000000','0','1.01.11','$orden_p','1','1','104','0.0000','0.0000','0','','0','$cod_iva'")){
                            echo "<br>Nuevo producto registrado en VEN_MOV: ".$array_cod[$cont];
                            }else{
                             echo "<br>ODBC error al registrar en VEN_MOV: ", odbc_errormsg();
                        }
                        
                    }
                   
                    /** Insert tabla revargo_vales_perdida WSSP **/
                     
                    $array_recargo_ci = $_POST['txt_ci_empleado'];
                    $array_winf_ci = $_POST['txt_hiddenwinf_emp'];
                    $array_recargo_porcent = $_POST['txt_porcent_emp'];
                    $array_recargo_valor = $_POST['txt_valor_emp'];
                    
                    echo "</br>Empleados: ".count($array_recargo_ci);
                    for ($i=0; $i < sizeof($array_recargo_ci);$i++) {
                        
                        //echo "</br>".$array_recargo_ci[$i].$array_recargo_porcent[$i].$array_recargo_valor[$i];
                        $insert_data_valesp = "INSERT INTO dbo.recargo_valep VALUES ('$new_cod_sp','$id_empresa','$array_recargo_ci[$i]','$array_winf_ci[$i]','$array_recargo_porcent[$i]','$array_recargo_valor[$i]')";
                        $query = odbc_prepare($conexion, $insert_data_valesp); 
                        if (odbc_execute($query)){
                        echo "Nuevo recargo registrado a: ".$array_recargo_ci[$i];
                        }else{
                         echo "ODBC error: ", odbc_errormsg();
                        }
                    }
                    
                    
                    echo "<script language = javascript>
                            swal({  title: 'Solicitud enviada',
                            text: 'Su solicitud ha sido enviada, revise la información del mismo ingresando a la administración!',  
                            type: 'success',    
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