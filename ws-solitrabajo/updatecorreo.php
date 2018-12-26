<?php
include_once ('../ws-admin/acceso_db.php');
            
                $nuevocorreo = $_POST['txt_usuariomail'];
                $sqlUP = "UPDATE tbl_generalconfigs SET valor = '$nuevocorreo' WHERE nombre_var = 'correo_curriculos'";
                mysql_query($sqlUP);
                        $mensajeconf = "Correo actualizado.";
                        echo "<script>";
                        echo "alert('$mensajeconf');";  
                        echo "window.location = '../ws-solitrabajo/solitrabajo_admin.php';";
                        echo "</script>"; 
                        
                 
              