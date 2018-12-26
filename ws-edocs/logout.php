<?php

 
    include('acceso_db.php'); // incluimos los datos de acceso a la BD
    // comprobamos que se haya iniciado la sesion
    if(isset($_SESSION['user'])) {
        session_destroy();
        header("Location: index.html");
    }
    else
        {
               
		header("Location: index.html");  
    }
?>