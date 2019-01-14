<?php
include_once ('acceso_db.php');
include_once ('./acceso_db_sbio.php');
?>

<html lang="es">
<head><meta http-equiv="Content-Type" content="text/html; charset=euc-jp">
	
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <link rel="stylesheet" href="css/estilos_login.css">
        <link rel="stylesheet" href="fonts/style.css">
        <link rel="stylesheet" href="../ws-admin/css/bootstrap.css">
        <link rel="shortcut icon" href="img/favicon.ico">
        <script src="../ws-admin/js/jquery-latest.js"></script>
        <link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
	<title>Ingreso a Sistema</title>
	
</head>
<body>

        <?php include '../ws-admin/topnavBar.php'?>

	<div class="contenedor-formulario">
		<div class="wrap">
			<form action="validaracceso.php"  autocomplete="off"  class="formulario" name="formulario_registro" method="POST">
               			<div>
	           		   	<img class="logo" src="img/logo.png" alt="Logo">
                    		</div>
                    
                                <div  id="bloque">
                                        <div class="input-group">
                                            <label class="label" for="nombre">Indique empresa:</label>
                                            <select name="select_empresa_login" id="select_empresa_login" required="true">
                                                <option value=''>---Seleccione Empresa---</option>
                                                    <?PHP 
                                                    $consulta_empresa = "SELECT * FROM dbo.Empresas_WF with (nolock) ORDER BY Codigo";

                                                    $result_query_empresa = odbc_exec($conexion_sbio, $consulta_empresa);

                                                    while(odbc_fetch_row($result_query_empresa))
                                                    {
                                                    $cod_emp = odbc_result($result_query_empresa,"Codigo"); 
                                                    $detalle_emp = odbc_result($result_query_empresa,"Nombre"); 

                                                    echo "<option value='$cod_emp'>$detalle_emp</option>";
                                                    }
                                                    ?>
                                             </select>
                                            
                                            <input type="text" name="usuario" id="inputuser" maxlength="30" placeholder="Usuario del Sistema o RUC" required >
                                            <input type="password" name="pass" id="inputpass" placeholder="Contraseña" maxlength="50" required >
                                            
                                           
                                            
                                        
                                        </div>
                                </div>
	<!--SECCION reCAPTCHA-->     
				<center>
                                          
        <!--FIN SECCION reCAPTCHA-->            
				</center>
		                
		                <div>
					<input name="guardar" type="submit" id="btn-submit" value="Ingresar">
				</div>
				
                                <div  id="bloque">
                                     
                                </div>    
        
			</form>
			<div class="footer">Todos los derechos reservados © 2017 - <?php echo date("Y")?>, Ver 2.0.0</div>
		</div>
		
	</div>

        
        <script type="text/javascript" src="../ws-admin/js/materialize.js"></script>
        <script src="../ws-admin/js/bootstrap.js"></script>
      
</body>
</html>