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
        <link rel="stylesheet" href="../ws-admin/css/bootstrap.css">
        <link rel="stylesheet" href="../ws-admin/fonts/style.css">
	<link rel="shortcut icon" href="../ws-admin/img/favicon.ico">
	<link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="../ws-admin/css/tcal.css" />
        <script type="text/javascript" src="../ws-admin/js/tcal.js"></script> 
	<script src='https://www.google.com/recaptcha/api.js'></script>
	<title>Config. E-Docs</title>
	
       
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
                              echo '</br>'.$_SESSION['user_ruc'];?>
                        </span>
                    </div>
                <div class="footer"></div></div>
                
                <!-- Bloque Menus-->
                <div class="container-menu">  
                <nav>
                <h5 class="tituloh5">Menú Principal</h5>
                <ul><?PHP 
                    include('../ws-admin/build_menuleft.php');?>
                </ul>
                <div class="footer">Todos los derechos reservados © 2016, Ver 2.0.0</div>
                </nav>
                </div>
            </div>
         <!-- CONTENIDO PRINCIPAL DE LA PÁGINA -->   
        <div id="sidebar-central" class="contenedor-formulario">
		<div class="wrap">
                    <div id="bloque">
                        <div class="txtseccion">
                                    <label class="etique"> DOCUMENTOS ELECTRONICOS </label>
                        </div> 
                        
                        <div id="bloque">
                            <div class="input-group">
                                <form action="frm_resultados.php" class="formulario" method="POST">
                            
                                <div class="txtcentro">
                                    <label> Especifique el tipo de documento que desea buscar.</label>
                                </div>
                                    
                                   <div>
                                    <label class="checkbox-inline text-radios">
                                    <input type="radio" name="chk_radio" id="1" value="1" checked="checked"></br>
                                    Facturas
                                    </label>
                                    <label class="checkbox-inline text-radios">
                                    <input type="radio" name="chk_radio" id="2" value="2"></br>
                                    Notas de Crédito
                                    </label>
                                    <label class="checkbox-inline text-radios">
                                    <input type="radio" name="chk_radio" id="3" value="3"></br>
                                    Retenciones
                                    </label>
                                    <label class="checkbox-inline text-radios">
                                    <input type="radio" name="chk_radio" id="4" value="4"></br>
                                    Guias de Remisión
                                    </label>
                                    <label class="checkbox-inline text-radios">
                                    <input type="radio" name="chk_radio" id="0" value="0" checked></br>
                                    Todo
                                    </label>
                                    <input type="hidden" name="formenviado" value="desdeadmin">
                                    <input type="submit" class="botonazul" name="consultadocs" value="Consultar">
                                   </div>
                            </form>
                            </div>
                            
                        </div>
                    </div>
                    
                </div>
	
               
            
        </div>
     
        <!-- USO JQUERY, animacion de menu para responsive-->
        <script src="http://code.jquery.com/jquery-latest.js"></script>
        <script src="../ws-admin/js/bootstrap.js"></script>
        <script src="../ws-admin/js/menuresponsive.js"></script>
</body>
</html>