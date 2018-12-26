<html>
    <head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<link rel="stylesheet" href="../ws-admin/css/estilos_recupass.css">
        <link rel="stylesheet" href="../ws-admin/fonts/style.css">
	<link rel="shortcut icon" href="../ws-admin/img/favicon.ico">
	<link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>

	<title>Recuperacion de Password</title>
</head>
    
<body>
	<div class="contenedor-formulario">
		<div class="wrap">
    
                <form action="enviarmail.php" class="formulario" name="formulario_mail" method="POST">
                    <div id="bloque">
                        <img class="logo" src="../ws-admin/img/logo.png" alt="Logo">
                        
                        <div class="txtseccion">
                                    <label class="etique">RECOMENDACIONES</label>
                        </div>
                    </div>
                    
                    <div id="bloque">
                        <span class="icon-mail4 icon-large"></span>
                    </div>
                    
                    <div id="bloque">
                            <p class="text-justific">1. Revisa antes que tus datos de acceso USUARIO y CONTRASE&NtildeA se encuentren correctamente escritos y sin espacios. <br>
                               2. Ingresa el e-mail que has registrado en el sistema o al momento de realizar tus compras.  <br>
                               3. Si no encuentras el e-mail con la clave de acceso en tu bandeja de entrada, revisa tu bandeja de correo no deseado.
                            </p>
                    </div>
                    
                    <div id="bloque">  
                            <div class="input-group">
                            <label>Correo:</label><input type="email" id="iconemail" name="txt_usuariomail" maxlength="45" placeholder="ejemplo@dominio.com" required>
                            
                             </div>
                    </div>
                    
                    <div id="bloque">  
                            <input name="cmd_recuperar" type="submit" value="Recuperar Contraseña">
                            <input type="button" value="Cancelar" onClick="window.open('../ws-admin/','_self',false)" >
                    </div>    
                    <div class="footer">Todos los derechos reservados © 2016, Ver 2.0.0</div>
          </form>
        
        </div>
        </div>    
    </body>
</html>
