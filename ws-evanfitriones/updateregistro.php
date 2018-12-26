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
session_start();

   
 
if (!empty($_POST['id_chklist'])) {
                //Registro que será actualizado
                $id_updatecheck = $_POST['id_chklist'];
                // CI que indica revisado por
                $ci_activo=$_SESSION['user_ruc'];
    
                   $chk_1=FALSE;
                   $chk_2=FALSE;
                   $chk_3=FALSE;
                   $chk_4=FALSE;
                   $chk_5=FALSE;
                   $chk_6=FALSE;
                   $chk_7=FALSE;
                   $chk_8=FALSE;
                   $chk_9=FALSE;
                   $chk_10=FALSE;
                   $chk_11=FALSE;
                   $chk_12=FALSE;
                   $chk_13=FALSE;
                   $chk_14=FALSE;
                   $chk_15=FALSE;
                   $chk_16=FALSE;
                   $chk_17=FALSE;
                   $chk_18=FALSE;
                   $chk_19=FALSE;
                   
                  
                   if (isset($_POST['chk_grupo_1'])){
                       $chk_1 = TRUE;
                   }
                   
                   $obsSupervchk_1 = $_POST['obs_SupervChk_grupo_1'];
                  
                   if (isset($_POST['chk_grupo_2'])){
                       $chk_2 = TRUE;
                   }
                   
                   $obsSupervchk_2 = $_POST['obs_SupervChk_grupo_2'];
                   
                   if (isset($_POST['chk_grupo_3'])){
                       $chk_3 = TRUE;
                   }
                   
                   $obsSupervchk_3 = $_POST['obs_SupervChk_grupo_3'];
                   
                   if (isset($_POST['chk_grupo_4'])){
                       $chk_4 = TRUE;
                   }
                   
                   $obsSupervchk_4 = $_POST['obs_SupervChk_grupo_4'];
                   
                   if (isset($_POST['chk_grupo_5'])){
                       $chk_5 = TRUE;
                   }
                   
                   $obsSupervchk_5 = $_POST['obs_SupervChk_grupo_5'];
                   
                   if (isset($_POST['chk_grupo_6'])){
                       $chk_6 = TRUE;
                   }
                   
                   $obsSupervchk_6 = $_POST['obs_SupervChk_grupo_6'];
                   
                   if (isset($_POST['chk_grupo_7'])){
                       $chk_7 = TRUE;
                   }
                   
                   $obsSupervchk_7 = $_POST['obs_SupervChk_grupo_7'];
                   
                   if (isset($_POST['chk_grupo_8'])){
                       $chk_8 = TRUE;
                   }
                   
                   $obsSupervchk_8 = $_POST['obs_SupervChk_grupo_8'];
                   
                   if (isset($_POST['chk_grupo_9'])){
                       $chk_9 = TRUE;
                   }
                   
                   $obsSupervchk_9 = $_POST['obs_SupervChk_grupo_9'];
                   
                   if (isset($_POST['chk_grupo_10'])){
                       $chk_10 = TRUE;
                   }
                   
                   $obsSupervchk_10 = $_POST['obs_SupervChk_grupo_10'];
                   
                   if (isset($_POST['chk_grupo_11'])){
                       $chk_11 = TRUE;
                   }
                   
                   $obsSupervchk_11 = $_POST['obs_SupervChk_grupo_11'];
                   
                   if (isset($_POST['chk_grupo_12'])){
                       $chk_12 = TRUE;
                   }
                   
                   $obsSupervchk_12 = $_POST['obs_SupervChk_grupo_12'];
                   
                   if (isset($_POST['chk_grupo_13'])){
                       $chk_13 = TRUE;
                   }
                   
                   $obsSupervchk_13 = $_POST['obs_SupervChk_grupo_13'];
                   
                   if (isset($_POST['chk_grupo_14'])){
                       $chk_14 = TRUE;
                   }
                   
                   $obsSupervchk_14 = $_POST['obs_SupervChk_grupo_14'];
                   
                   if (isset($_POST['chk_grupo_15'])){
                       $chk_15 = TRUE;
                   }
                   
                   $obsSupervchk_15 = $_POST['obs_SupervChk_grupo_15'];
                   
                   if (isset($_POST['chk_grupo_16'])){
                       $chk_16 = TRUE;
                   }
                   
                   $obsSupervchk_16 = $_POST['obs_SupervChk_grupo_16'];
                   
                   if (isset($_POST['chk_grupo_17'])){
                       $chk_17 = TRUE;
                   }
                   
                   $obsSupervchk_17 = $_POST['obs_SupervChk_grupo_17'];
                   
                   if (isset($_POST['chk_grupo_18'])){
                       $chk_18 = TRUE;
                   }
                   
                   $obsSupervchk_18 = $_POST['obs_SupervChk_grupo_18'];
                   
                   if (isset($_POST['chk_grupo_19'])){
                       $chk_19 = TRUE;
                   }
                   
                   $obsSupervchk_19 = $_POST['obs_SupervChk_grupo_19'];
                   
                   $txt_observaciones = $_POST['txt_observacion'];
                    
                   echo "Registro actualizado:" . $id_updatecheck."<br>";
                   $db_empresa = getDataBase('009'); //Obtenemos conexion con base de datos segun codigo de la DB
                   
                    $update_data = "UPDATE dbo.chlist_locales SET "
                            . "estado = 1, "
                            . "revisadopor = $ci_activo, "
                            . "chkSup_1 = '$chk_1', "
                            . "chkSup_2 = '$chk_2', "
                            . "chkSup_3 = '$chk_3', "
                            . "chkSup_4 = '$chk_4', "
                            . "chkSup_5 = '$chk_5', "
                            . "chkSup_6 = '$chk_6', "
                            . "chkSup_7 = '$chk_7', "
                            . "chkSup_8 = '$chk_8', "
                            . "chkSup_9 = '$chk_9', "
                            . "chkSup_10 = '$chk_10', "
                            . "chkSup_11 = '$chk_11', "
                            . "chkSup_12 = '$chk_12', "
                            . "chkSup_13 = '$chk_13', "
                            . "chkSup_14 = '$chk_14', "
                            . "chkSup_15 = '$chk_15', "
                            . "chkSup_16 = '$chk_16', "
                            . "chkSup_17 = '$chk_17', "
                            . "chkSup_18 = '$chk_18', "
                            . "chkSup_19 = '$chk_19', "
                            . "obsSupervchk_1 = '$obsSupervchk_1', "
                            . "obsSupervchk_2 = '$obsSupervchk_2', "
                            . "obsSupervchk_3 = '$obsSupervchk_3', "
                            . "obsSupervchk_4 = '$obsSupervchk_4', "
                            . "obsSupervchk_5 = '$obsSupervchk_5', "
                            . "obsSupervchk_6 = '$obsSupervchk_6', "
                            . "obsSupervchk_7 = '$obsSupervchk_7', "
                            . "obsSupervchk_8 = '$obsSupervchk_8', "
                            . "obsSupervchk_9 = '$obsSupervchk_9', "
                            . "obsSupervchk_10 = '$obsSupervchk_10', "
                            . "obsSupervchk_11 = '$obsSupervchk_11', "
                            . "obsSupervchk_12 = '$obsSupervchk_12', "
                            . "obsSupervchk_13 = '$obsSupervchk_13', "
                            . "obsSupervchk_14 = '$obsSupervchk_14', "
                            . "obsSupervchk_15 = '$obsSupervchk_15', "
                            . "obsSupervchk_16 = '$obsSupervchk_16', "
                            . "obsSupervchk_17 = '$obsSupervchk_17', "
                            . "obsSupervchk_18 = '$obsSupervchk_18', "
                            . "obsSupervchk_19 = '$obsSupervchk_19', "
                            . "observacion = '$txt_observaciones' "
                            . "WHERE id='$id_updatecheck'";

                    
                    $query = odbc_prepare($db_empresa, $update_data); 
                    
                    
                    if (odbc_execute($query)){
                        echo "<script language = javascript>
                            swal({  title: 'Envio Correcto',
                                text: 'Correcto, desea imprimir el reporte actualizado?',  
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
                                      
                                     window.close(); 
                                     window.open('reportes/reporte_diario_byid.php?id_chlocal=$id_updatecheck');
                                    } 
                                    else 
                                    {
                                    window.close(); 
                                    
                                    }
                                 
                                });
                        </script>";
                    } else{
                        echo "<script language = javascript>
                        swal({  title: 'Error al actualizar',
                        text: 'No se ha podido actualizar el reporte!',  
                        type: 'error',    
                        showCancelButton: false,   
                        closeOnConfirm: false,   
                        confirmButtonText: 'Aceptar', 
                        showLoaderOnConfirm: true, }, 
                        function(){   
                            setTimeout(function(){     
                                location = '../ws-chlocales/';  
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
                    location = '../ws-chlocales/';  
                });
                 });
        </script>"; 
                               
    
 
}                 