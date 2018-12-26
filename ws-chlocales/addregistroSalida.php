<html>
<head><title></title>
	<script src="sweet/sweetalert.min.js"></script> 
 	<script src="sweet/dist/sweetalert.min.js"></script>
        <link rel="stylesheet" type="text/css" href="sweet/dist/sweetalert.css">
</head>
<body></body>
</html>

<?php
include_once ('../ws-admin/acceso_multi_db.php');

if (!empty($_POST['seleccion_chlentrada'])) {
                
                    $id_Actualizar = $_POST['seleccion_chlentrada'];
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
                    
             
                   echo "Registro actualizado:" . $id_Actualizar."<br>";
                   $db_empresa = getDataBase('009'); //Obtenemos conexion con base de datos segun codigo de la DB
                   
                   $insert_data = "UPDATE dbo.chlist_locales SET chk_17_1=$chk17_1, chk_17_2=$chk17_2, chk_17_3=$chk17_3, chk_17_4=$chk17_4, chk_17_5=$chk17_5, chk_17_6=$chk17_6, chk_18_1=$chk18_1, chk_18_2=$chk18_2, chk_18_3=$chk18_3, chk_18_4=$chk18_4, chk_18_5=$chk18_5, chk_18_6=$chk18_6, chk_18_7=$chk18_7, chk_19_1=$chk19_1, chk_19_2=$chk19_2, chk_19_3=$chk19_3, chk_19_4=$chk19_4, chk_19_5=$chk19_5, chk_19_6=$chk19_6, chk_19_7=$chk19_7 WHERE id=$id_Actualizar";
                    $query = odbc_prepare($db_empresa, $insert_data); 
             
                    if (odbc_execute($query)){
                        echo "<script language = javascript>
                                swal({  title: 'Registro Exitoso',
                            text: 'Se han agregado los datos del checklist de salida.',  
                            type: 'success',    
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
                        
                    }  else {
                        
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