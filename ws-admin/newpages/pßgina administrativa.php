<?php
include_once ('../ws-admin/acceso_db.php');
include_once ('../ws-admin/seguridad.php');
session_start();
?>

<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<link rel="stylesheet" href="../ws-admin/css/estilos_main.css">
        <link rel="stylesheet" href="../ws-admin/fonts/style.css">
	<link rel="shortcut icon" href="../ws-admin/img/favicon.ico">
	<link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="../ws-admin/css/tcal.css" />
        <script type="text/javascript" src="../ws-admin/js/tcal.js"></script> 
	<script src='https://www.google.com/recaptcha/api.js'></script>
	<title>Config. Solicitud Trabajo</title>
	
</head>
<body>
        <header>
                <div class="wrapper">
                        <nav class="navizq">
                            <a href="#" class="btn_menu"><span class="icon-indent-decrease icon-large linksnav"></span></a>
                        </nav>
                        <div class="logocontainer">
                            <a href="#" target="_top"><img class="logo" src="../ws-admin/img/logo.png" alt="Logo Sistema"></a>
                        </div>
			<nav>
                            <?PHP $consulta_headermenu = mysql_query("SELECT * FROM tbl_confheadermenu ORDER BY menu_id ASC");
                                while ($row = mysql_fetch_array($consulta_headermenu)) 
                                {echo '<a href="'.$row['url_menu'].'"><span class="'.$row['clases_menu'].'"><span class="'.$row['clases_textmenu'].'">'.$row['nombre_menu'].'</span></span></a>';
                                }
                            ?>
                        </nav>
		</div>
	</header>
        
            <div class="sidebar-left">
                <!-- Bloque perfil de usuario-->
                <div class="container-menu">
                <h5 class="tituloh5">Perfil de Usuario</h5>    
                    <div>
                        <img class="imagenusuario" src="<?PHP 
                            if ($_SESSION['user_pic']!='')
                            {echo $_SESSION['user_pic'];
                            }else
                            {echo '../ws-cargaimagen/fotos/photo-nouser.jpg';}    
                                 
                        ?>" alt="USR">
                    </div>
                
                    <div class="infousuario">
                        <span class="textperfilusuario">
                        <?PHP echo 'Bienvenido, '.$_SESSION['user_autentificado'];
                              echo '</br>'.$_SESSION['user_ruc'];
                        ?>
                              
                        </span>
                    </div>
                
                <div class="footer"></div>
                
                </div>
                <!-- Bloque Menus-->
                <div class="container-menu">  
                <nav>
                <h5 class="tituloh5">Menú Principal</h5>
          
                <ul>
                  <?PHP $consulta_leftmenu = mysql_query("SELECT * FROM tbl_confmenuleft ORDER BY menu_id ASC");
                        while ($row = mysql_fetch_array($consulta_leftmenu)) 
                        {echo '<li><a href="'.$row['url_menu'].'"><span class="'.$row['clases_menu'].'"><span class="'.$row['clases_textmenu'].'">'.$row['nombre_menu'].'</span></span></a></li>';
                        }
                  ?>
                  </ul>
                    <div class="footer">Todos los derechos reservados © 2016, Ver 2.0.0</div>
                </nav>
                </div>
            </div>
            
        <div id="sidebar-central" class="contenedor-formulario">
		
	</div>
       
        <!-- USO JQUERY, animacion de menu para responsive-->
        <script src="http://code.jquery.com/jquery-latest.js"></script>
        <script src="../ws-admin/js/menuresponsive.js"></script>
</body>
</html>