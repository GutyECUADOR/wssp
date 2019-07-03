<?php
    include_once ('acceso_db.php');
    include_once ('acceso_db_sbio.php');
   
                /*VALIDACIÓN DE ACCESO A SISTEMA CON RECAPTCHA ACEPTADA*/ 
                    if (isset($_POST["usuario"]) && isset($_POST["pass"]))
                    {
                        session_start();
                        $_SESSION['user']=filter_input(INPUT_POST, 'usuario');
                        $USR = trim(filter_input(INPUT_POST, 'usuario'));
                        $PAS = trim(filter_input(INPUT_POST, 'pass'));
                        $EMPRESA = trim(filter_input(INPUT_POST, 'select_empresa_login'));

                        $consulta = "select * from dbo.Empleados with (nolock) where Cedula='".$USR."' and Clave='".$PAS."' "; //Modificar busqueda en tabla
                        $result_query = odbc_exec($conexion_sbio, $consulta);
                        
                        $total_registros = odbc_num_rows($result_query); /*COMPROBAR SI EXISTIERON REGISTROS*/ 
                        $acceso = odbc_fetch_array($result_query);
                       
                        
                            if ($total_registros>=1)
                            {
                                $_SESSION['autentificacion']=1;  /*ACCESO A PAGINAS CON SEGUIRIDAD*/ 
                                $_SESSION['user_autentificado']= $acceso['Nombre']; /*NOMBRE DE USUARIO CON ACCESO*/
                                $_SESSION['empresa_autentificada']= $EMPRESA;
                                /*NIVEL DE ACCESO A MENUS */
                                switch (trim($acceso['CodDpto'])) {
                                    case 'ADM':
                                        $_SESSION['user_lv'] = 99;  

                                        break;

                                    case 'SUP':
                                        $_SESSION['user_lv'] = 1;  
                                        break;
                                    
                                     case 'ASI':
                                        $_SESSION['user_lv'] = 2;  
                                        break;
                                    
                                     case 'SSP':
                                        $_SESSION['user_lv'] = 5;  
                                        break;
                                    
                                    case 'VAL':
                                        $_SESSION['user_lv'] = 6;  
                                        break;
                                    
                                    case 'EVA':
                                        $_SESSION['user_lv'] = 7;  
                                        break;
                                    
                                    case 'TEC':
                                        $_SESSION['user_lv'] = 2;  
                                        break;
                                    
                                    default:
                                        $_SESSION['user_lv'] = 0;  
                                        break;
                                }
                               
                                $_SESSION['user_ruc'] = $acceso['Cedula'];  /*CORREO DEL USUARIO CON ACCESO*/
                                $_SESSION['user_pic'] = "";  /*FOTO 32X32 DEL USUARIO CON ACCESO */
                                
                                                                         /*../ws-cargaimagen/fotos/foto-16005055050.jpg*/
                                header("Location: frm_main.php");  /*REDIRECCIONAMIENTO*/ 
                            }
                            else
                            {
                               $mensaje = "Error en acceso, usuario y/o contrasena erroneos o no registrados en sistema";
                                echo "<script>";
                                echo "alert('$mensaje');";  
                                echo "window.location = '../ws-admin/';"; /*REDIRECCIONAMIENTO*/ 
                                echo "</script>";  
                            }

                    }   
                    else
                    {
                        echo "<script type=\"text/javascript\">alert(\"Error al validar datos de usuario, informe al administrador.\");</script>";
                        echo "<script>";
                        echo "window.location = '../ws-admin/';";  /*REDIRECCIONAMIENTO*/ 
                        echo "</script>";
                    }    
                    
