<?php
include_once ('../ws-admin/acceso_db.php');
            $num_check=0;
            $cont = 1;
            $sql = "SELECT * FROM tbl_optcurriculums ORDER BY option_curriculo ASC";
            mysql_query("SET NAMES 'utf8'"); /*ACEPTAR CARACTERES UTF-8*/
            $resultado = mysql_query($sql);
            
            if(is_array($_POST['cargo']))
                {
                while($fila=mysql_fetch_array($resultado))
                {
                    list($key,$nom_value_check)= each($_POST['cargo']);
                    
                    //Recuperar valores de los radio buttons
                    $estado_radio = 'estado_radio'.$cont;
                    $on_off = $_POST[$estado_radio];
                    echo $a;
                        
                            $sqlUP = mysql_query("UPDATE tbl_optcurriculums SET estado_opt = '$on_off' WHERE option_curriculo = '$nom_value_check'");
                            $cont++;
                }
                }
                else
                {
                    echo "Error";
                }
            
              
             /*  
             echo "<pre>";
                print_r($_POST);
                echo "</pre>";
                
                }*/

                        $mensajeconf = "Actualizacion Correcta.";
                        echo "<script>";
                        echo "alert('$mensajeconf');";  
                        echo "window.location = '../ws-solitrabajo/solitrabajo_admin.php';";
                        echo "</script>"; 
                        
                 
              