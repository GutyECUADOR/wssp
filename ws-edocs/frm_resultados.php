<?php
include_once ('../ws-admin/acceso_db.php');
include_once ('../ws-admin/seguridad.php');
include('consultaSQL.php');
session_start();
?>

<html>
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
	<title>Resultados E-Docs</title>
	
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
                    <div class="bloque">
                        <div class="txtseccion">
                                    <label class="etique"> RESULTADOS DE CONSULTA </label>
                        </div> 
                                     <label class="textheadertable">  <?php echo $_SESSION['user_autentificado'];?></label><br>
                                     <label class="textheadertable"> Resultados para:</label><br>
                                     <label class="textheadertable">  <?php echo $_SESSION['user_ruc']?></label><br>
                                     <label class="textheadertable">  <?php echo $tdocumenttxt?> </label>
                                     <h5>Resultados: <?php echo $contador?></h5>
                    </div>
                    <div id="responsibetable">
                    <table class="tablaedocs">
                            <tr class="trcabecera">
                                <td class="tdcabecera">#</td>    
                                <td class="tdcabecera">Fecha</td>
                                <td class="tdcabecera">RUC/CI</td>
                                <td class="tdcabecera">Nombres</td>
                                <td class="tdcabecera">Importe Total</td>
                                <td class="tdcabecera">#Documento</td>
                                <td class="tdcabecera">Tipo Documento</td>
                                <td class="tdcabecera">PDF</td>
                                <td class="tdcabecera">XML</td>
                            </tr>
                            
                                        <?php 

                                    $cont = 1;
                                    
                                    //mantener el feach_array aqui para evitar bubles
                                    while($dato = mysql_fetch_array($resultado)) //Resultado viene de consultaSQL.
                                        {
                                            echo '<tr class="tdcontenido">'; 
                                            echo '<td class="tdcontenido">'.$cont++.'</td>';
                                            echo '<td class="tdcontenido">'.$dato['fecha'].'</td>';
                                            echo '<td class="tdcontenido">'.$dato['ruc'].'</td>';
                                            echo '<td class="tdcontenido">'.$dato['nombre'].'</td>';
                                            echo '<td class="tdcontenido">'.$dato['valor'].'</td>';
                                            echo '<td class="tdcontenido">'.$dato['DOC'].'</td>';

                                            if ($dato['tipo']=='FV')
                                                {
                                                $tdocument = "Factura";
                                                }
                                                elseif ($dato['tipo']=='NC') 
                                                {
                                                $tdocument = "Nota de Crédito";    
                                                }
                                                elseif ($dato['tipo']=='RT') 
                                                {
                                                $tdocument = "Retenciones";    
                                                }
                                                elseif ($dato['tipo']=='GR') 
                                                {
                                                $tdocument = "Guía de Remisión";    
                                                }
                                                else
                                                {
                                                $tdocument = "SIN IDENTIFICAR";    
                                                }   

                                            echo '<td class="tdcontenido">'.$tdocument.'</td>';
                                            echo '<td class="tdcontenido"><a href='."/ws-facturacion/docwf/".$dato['archivopdf'].' target="_blank" onclick="return muestravalor(this); muestravalor(this)");">'.$iconoPDF.'</a></td>';
                                            echo '<td class="tdcontenido"><a href='."/ws-facturacion/docwf/".$dato['archivoXML'].' download="ReporteXML.xml" target="_blank" onclick="muestravalor(this)");>'.$iconoXML.'</a>



                                            </td>';  

                                            echo "</tr>";

                                                }

                                    ?>
                            
                    </table>    
                    </div>
                    
                    <input type="button" class="botonazul" value="Nueva Consulta" onClick="window.open('edocs_admin.php','_self',false)">
                                     
                </div>
            </div>
        <script src="validarURL.js"></script> <!-- Validación si existe URL para documeno -->
     
      <!-- USO JQUERY, animacion de menu para responsive-->
        <script src="http://code.jquery.com/jquery-latest.js"></script>
        <script src="../ws-admin/js/bootstrap.js"></script>
        <script src="../ws-admin/js/menuresponsive.js"></script> 
    </body>
</html>
