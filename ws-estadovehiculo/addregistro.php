<html>
<head><title></title>
	<script src="sweet/sweetalert.min.js"></script> 
 	<script src="sweet/dist/sweetalert.min.js"></script>
        <link rel="stylesheet" type="text/css" href="sweet/dist/sweetalert.css">
</head>
<body></body>
</html>

<?php
include_once ('../ws-admin/acceso_db.php');
include_once ('../ws-admin/acceso_multi_db.php');
 
if (!empty($_POST['txt_CIRUC'])&& !empty($_POST['select_Empresa'])) {
           
    $tipo = 'EVANF'; //Se registrara documento del tipo
    $ci_supervisor = trim($_POST['txt_CIRUC']); 
    $fecha = trim($_POST['txt_fechaRegistro']); 
    $id_empresa = trim($_POST['select_Empresa']);
    $id_empleado = trim($_POST['select_Empleado']);

    $selectasis1 = $_POST['selectAsis1'];
    $selectPerm1 = $_POST['selectPerm1'];
    $selectRetra1 = $_POST['selectRetra1'];
    $selectActit1 = $_POST['selectActit1'];
    $selectPredi1 = $_POST['selectPredi1'];
    $selectCompr1 = $_POST['selectCompr1'];
    $selectRespon1 = $_POST['selectRespon1'];
    
    // Campos extras 01/05/2018
  
    $con_funcionesSegu = $_POST['con_funcionesSegu'];
    $real_muestroAlarmas = $_POST['real_muestroAlarmas'];
    $man_ordenPuestoTrab = $_POST['man_ordenPuestoTrab'];
    $registroBorrones = $_POST['registroBorrones'];
    $herr_buenEstado = $_POST['herr_buenEstado'];
    $uniformeLimpio = $_POST['uniformeLimpio'];
    $calzadoLimpio = $_POST['calzadoLimpio'];
    
    
    $txt_observacion = $_POST['txt_observacion'];
    
    $sumaTotal = $selectasis1+ $selectPerm1+ $selectRetra1+ $selectActit1+ $selectPredi1+ $selectCompr1+ $selectRespon1 +$con_funcionesSegu +$real_muestroAlarmas +$man_ordenPuestoTrab +$registroBorrones +$herr_buenEstado +$uniformeLimpio +$calzadoLimpio; 
    
    $db_empresa = getDataBase('009'); //Obtenemos conexion con base de datos segun codigo de la DB
    $insert_data = "INSERT INTO dbo.ev_anfitriones (tipoDoc, empresa, supervisor, empleado, fecha, estado, selectAsis1, selectPerm1, selectRetra1, selectActit1, selectPredi1, selectCompr1, selectRespon1, confuncionesSegu, real_muestroAlarmas, man_ordenPuestoTrab, registroBorrones, herr_buenEstado, uniformeLimpio, calzadoLimpio, sumatoria, observacion) VALUES"
            . " ('$tipo', '$id_empresa' , '$ci_supervisor' , '$id_empleado','$fecha', '0' ,'$selectasis1','$selectPerm1','$selectRetra1','$selectActit1','$selectPredi1','$selectCompr1','$selectRespon1', '$con_funcionesSegu', '$real_muestroAlarmas', '$man_ordenPuestoTrab', '$registroBorrones', '$herr_buenEstado', '$uniformeLimpio', '$calzadoLimpio', '$sumaTotal', '$txt_observacion')";
      
                    $query = odbc_prepare($db_empresa, $insert_data);
                    if (odbc_execute($query)){
                        echo "<script language = javascript>
                            swal({  title: 'Envio Correcto',
                                text: 'Registro correcto, desea imprimir el reporte?',  
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
                                      
                                      location = '../ws-evanfitriones/';   
                                     window.open('reportes/ultimoReporte.php');
                                    } 
                                    else 
                                    {
                                     location = '../ws-evanfitriones/';   
                                    
                                    }
                                 
                                });
                        </script>";
                    }  else {
                        echo odbc_errormsg();
                        echo "<script language = javascript>
                            swal({  title: 'Error en el registro',
                            text: 'Se ha producido un error en conexion con la base de datos!',  
                            type: 'error',    
                            showCancelButton: false,   
                            closeOnConfirm: false,   
                            confirmButtonText: 'Aceptar', 
                            showLoaderOnConfirm: true, }, 
                            function(){   
                                setTimeout(function(){     
                                    location = '../ws-evanfitriones/';  
                                });
                                 });
                        </script>"; 
                        
                    }
                    
                    
} else{
   
    echo "<script language = javascript>
            swal({  title: 'Solicitud Vacia',
            text: 'Uno o más campos necesarios no fueron ingresados!',  
            type: 'error',    
            showCancelButton: false,   
            closeOnConfirm: false,   
            confirmButtonText: 'Aceptar', 
            showLoaderOnConfirm: true, }, 
            function(){   
                setTimeout(function(){     
                    location = '../ws-evanfitriones/';  
                });
                 });
        </script>"; 
                               
    
 
}                 