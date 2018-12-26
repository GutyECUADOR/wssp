<?php
include_once ('../ws-admin/acceso_db.php');

if (!empty($_POST['txt_addnewcargo'])) {
    $nuevocargo = $_POST['txt_addnewcargo'];
                mysql_query("SET NAMES 'utf8'"); /*ACEPTAR CARACTERES UTF-8*/
                $sql = mysql_query("INSERT INTO tbl_optcurriculums  VALUES ('$nuevocargo' , 'on')");
                        
                echo "<script>";
                echo "window.location = '/ws-sistemaequinoxio/ws-solitrabajo/solitrabajo_admin.php';";
                echo "</script>";                       
                }else
                {
                $mensajeconf = "No se ha encontrado registro que agregar.";
                echo "<script>";
                echo "alert('$mensajeconf');";  
                echo "window.location = '/ws-sistemaequinoxio/ws-solitrabajo/solitrabajo_admin.php';";
                echo "</script>"; 
                               
                }

               
                 
              