<?php
        echo "<script>";
        echo "var respuesta = confirm('Confirme el borrado.')";
        echo "if(respuesta){";
            $mensajeconf = "Funciona funcion.";
                        
                        echo "alert('$mensajeconf');";  
                        echo "window.location = '/ws-sistemaequinoxio/ws-solitrabajo/solitrabajo_admin.php';";
                        echo "</script>"; 
                        
        echo "}else{";
           $mensajeconf = "Cancelada.";
                        echo "<script>";
                        echo "alert('$mensajeconf');";  
                        echo "window.location = '/ws-sistemaequinoxio/ws-solitrabajo/solitrabajo_admin.php';";
                        
        echo "}";
        echo "</script>"; 
        