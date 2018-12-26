<html>
<head><title></title>
	<script src="sweet/sweetalert.min.js"></script> 
 	<script src="sweetalert-master/dist/sweetalert.min.js"></script>
        <link rel="stylesheet" type="text/css" href="sweet/dist/sweetalert.css">
</head>
<body></body>
</html>

<?php
include_once ('../ws-admin/acceso_db.php');
include_once ('../ws-admin/acceso_multi_db.php');

 
if (!empty($_POST['select_empresaa'])&& !empty($_POST['txt_cisolicitante'])) {
                   
                  
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
                        
                    
                    
                    
} else{
   
    echo "<script language = javascript>
            swal({  title: 'Solicitud Erronea',
            text: 'No se puedo realizar el registro',  
            type: 'error',    
            showCancelButton: false,   
            closeOnConfirm: false,   
            confirmButtonText: 'Aceptar', 
            showLoaderOnConfirm: true, }, 
            function(){   
                setTimeout(function(){     
                    location = '../';  
                });
                 });
        </script>"; 
                               
    
 
}                 