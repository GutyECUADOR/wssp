<?php
include('../ws-admin/acceso_db.php');
?>

<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <link rel="stylesheet" href="../ws-admin/css/estilos_solicitud.css">
        <link rel="stylesheet" href="../ws-admin/css/bootstrap.css">
	<link rel="shortcut icon" href="../ws-admin/img/favicon.ico">
	<link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="../ws-admin/css/tcal.css" />
        <script type="text/javascript" src="../ws-admin/js/tcal.js"></script> 
	<script src='https://www.google.com/recaptcha/api.js'></script>
        
         <!-- CDN Para calendar en firefox -->
         
         <link rel="stylesheet" href="https://afarkas.github.io/webshim/js-webshim/minified/shims/styles/shim-ext.css">
         <link rel="stylesheet" href="https://afarkas.github.io/webshim/js-webshim/minified/shims/styles/forms-picker.css">
         <script type="text/javascript" src="https://afarkas.github.io/webshim/js-webshim/minified/polyfiller.js"></script>
         
         <script type="text/javascript">//<![CDATA[

webshim.setOptions('forms-ext', {
    replaceUI: 'auto'
});

//set language/UI dateformat || or use lang attribute on html element
//webshims.activeLang('hu'); // hu == hungary

webshim.polyfill('forms forms-ext');


$(function () {
    $('.check-validity').on('click', function () {
        $(this).jProp('form').checkValidity();
        return false;
    });
});
//]]> 

</script>
        
	<title>Solicitud de Trabajo</title>
	
</head>
<body>
	<div class="contenedor-formulario">
		<div class="wrap">
                            <div class="txtcentro">
                                    <h4>SOLICITUD DE EMPLEO</h4>
                            </div>
                    
                    
			<form action="agregardatos.php" class="formulario" name="formulario_registro" method="POST">
               			<div class="centrado">
	           		   	<img class="logo" src="../ws-admin/img/logo.png" alt="Logo">
                    		</div>
                    
                                <div class="txtcentro">
                                    <label> Los campos con (*) son obligatorios y deben contener información verídica. Recuerde al finalizar validar captcha o será marcado como spam</label>
                                </div>
                            
                                
            <!--SECCION INFO PERSONAL-->                
                                <div class="txtseccion">
                                    <label class="etique"> INFORMACIÓN PERSONAL</label>
                                </div>
            
                                <div id="bloque">
                                 <label class="label" for="nombre">Indique puesto al que aplica: <em class="em">*</em></label>
                                 
                                 <select name="seleccion_puesto" id="seleccion_puesto" required>
                                 <?php
                                    $sql = ("SELECT * FROM tbl_optcurriculums WHERE estado_opt = 'on' ORDER BY option_curriculo ASC");
                                    mysql_query("SET NAMES 'utf8'"); /*ACEPTAR CARACTERES UTF-8*/
                                    $resultado = mysql_query($sql);
                                    echo "<option value=''>---SELECCIONE POR FAVOR---</option>";
                                    while($fila=mysql_fetch_array($resultado)){
                                        echo "<option value='".$fila['option_curriculo']."'>".$fila['option_curriculo']."</option>";
                                    }
                                 ?>
                                 </select>
                                     
                                
                                </div>  
            
                                <div  id="bloque">
                                        <div class="input-group" id="nombresyapellidos">
                                                <label class="label" >Apellidos y Nombres: <em class="em">*</em></label>
                                                <input type="text" name="nombre" maxlength="50" required >
                                              
                                        </div>

                                        <div class="input-group" id="cidentidad">
                                                <label class="label" >Cédula de identidad: <em class="em">*</em></label>
                                                <input type="text" name="ci" maxlength="10" required >  
                                        </div>
                                    
                                        <div class="input-group" id="fechanacimiento">
                                                <label class="label" >Fecha de Nacimiento: <em class="em">*</em></label>
                                                <input type="date" data-date='{"startView": 2}' placeholder="YYYY-MM-DD" name="fechaNA" required/>
                                        </div>
                                    
                                    
                                        <div class="input-group" id="lugarnacimiento">
                                                <label class="label" >Lugar de Nacimiento:</label>
                                                <input  type="text" name="lugarNA" maxlength="35">  
                                        </div>
                                    
                                </div>
            
                                <div  id="bloque">     
                                    <div class="input-group" id="estadocivil">
                                        <label class="label" >Estado Civil:</label>
                                        <select name="seleccion_estado_civil" id="seleccion_estado_civil">
                                            <option value="">-- Seleccionar --</option>
                                            <option value="Soltero/ra">Soltero/ra</option>
                                            <option value="Casado/da">Casado/da</option>
                                            <option value="UnionLibre">Union Libre</option>
                                        </select>
                                    </div>  

                                    <div class="input-group" id="direcciondomicilio">
                                       <label class="label" >Direccion Domiciliaria:</label>
                                       <input type="text"  name="direcciondom" maxlength="100">	
                                    </div>
                                
                                    <div class="input-group" id="sector">
                                       <label class="label" >Sector:</label>
                                       <input type="text"  name="sector" maxlength="30">	
                                    </div>
                                    
                                </div>    
                               
                            
                                <div id="bloque">
                                        <div class="input-group" id="telefonoconv">
                                            <label class="label" >Teléfono convencional: <em class="em">*</em></label>
                                            <input type="text"  name="telefono" maxlength="12" required>
                                           
                                         </div>

                                        <div class="input-group" id="celular">
                                            <label class="label" >Teléfono celular:</label>
                                            <input type="text" name="celular" maxlength="12">
                                            
                                        </div>
                                    
                                    <div class="input-group" id="correoelectronico">
                                                <label class="label" >Correo electrónico:</label>
                                                <input type="email" name="mail1" maxlength="35">
                                                
                                        </div>

                                         <div class="input-group" id="correoelectronicoalt">
                                              <label class="label" >Correo electrónico alternativo:</label>
                                              <input type="email"  name="mail2" maxlength="35"> 
                                        </div>
                                </div> 
            
              <!--SECCION ESTUDIOS-->               
                                <div class="txtseccion">
                                    <label class="etique"> ESTUDIOS</label>
                                </div>
                            
                                <div class="input-group anchototal">
                                        <label class="label">Estudios Primarios:</label>
					<input type="text" name="estudiospri" maxlength="112">
				</div>
             
                                <div class="input-group anchototal">
                                        <label class="label" >Estudios Secundarios:</label>
					<input type="text" name="estudiossec" maxlength="112">
				</div>  
             
                                <div class="input-group anchototal">
                                        <label class="label" >Estudios Universitarios:</label>
					<input type="text" name="estudiosuni" maxlength="112">
				</div>
                                    
                                <div class="input-group anchototal">
					<label class="label">Idioma Extranjero: (Nivel de Dominio Hablado y Escrito)</label>
                                        <input type="text" name="estudioidioma" maxlength="112">
				</div>
            <!--SECCION TALLERES, CURSOS Y SEMINARIOS-->               
                                <div class="txtseccion">
                                    <label class="etique"> TALLERES, CURSOS Y SEMINARIOS</label>
                                </div> 
                                <div class="txtcentro">
                                    <label> Detalle aquí  todos los cursos, talleres o seminarios que haya realizado, 
                                        especifique si participó como asistente o si fue encargado de dictarlo, indique los más importantes.</label>
                                </div> 
            
                                <div class="input-group nombredelcurso">
                                    <label class="label">Nombre del Curso 1:</label>
                                    <input type="text" name="nombrecurso1" maxlength="112">
				</div>
            
                                <div id="bloque">
                                        <div class="input-group dictadopor">
                                             <label class="label">Dictado por:</label>
                                             <input type="text" name="dictadocurso1" maxlength="45">
                                               
                                        </div>

                                        <div class="input-group duracionhoras">
                                             <label class="label">Duración (Horas):</label>
                                             <input type="text" name="duracioncurso1" maxlength="5">
                                               
                                        </div>

                                        <div class="input-group fechacurso">
                                             <label class="label">Fecha:</label>
                                             <input type="date" data-date='{"startView": 2}' placeholder="YYYY-MM-DD" name="fechacurso1"/>
                                        </div>    
                                </div>
                                
                                <div class="input-group nombredelcurso">
                                            <label class="label">Nombre del Curso 2:</label>
                                            <input type="text"  name="nombrecurso2" maxlength="112">
					
				</div>
            
                                <div id="bloque">
                                        <div class="input-group dictadopor">
                                            <label class="label">Dictado por:</label>
                                            <input type="text"  name="dictadocurso2" maxlength="45">
                                            
                                        </div>

                                        <div class="input-group duracionhoras">
                                            <label class="label">Duración (Horas):</label>
                                            <input type="text" name="duracioncurso2" maxlength="5">
                                                
                                        </div>

                                        <div class="input-group fechacurso">
                                            <label class="label">Fecha:</label>
                                            <input type="date" data-date='{"startView": 2}' placeholder="YYYY-MM-DD" name="fechacurso2"/>
                                            
                                        </div>    
                                </div>
            
            
            <!--SECCION EXPERIENCIA LABORAL-->               
                                <div class="txtseccion">
                                    <label class="etique">EXPERIENCIA LABORAL</label>
                                </div> 
                                <div class="txtcentro">
                                    <label> Se organiza a partir del último empleo que tuvo o tiene y por la fecha de finalización de labores,  
                                        incluye los trabajos que ha desempeñado en la Universidad o antes de la misma, indique los más destacados.</label>
                                </div> 
                                
                                <div class="txtcentro">
                                    <label> --- Trabajo 1 --- </label>
                                </div> 
            
                                <div class="input-group nombreempresa">
                                    <label class="label" >Nombre de la Institución o Empresa 1:</label>
                                    <input type="text" name="nombretrab1" maxlength="115">
					
                                </div>
            
                                <div id="bloque">
                                        <div class="input-group fechatrain">
                                            <label class="label">Fecha de Ingreso :</label>
                                            <input type="date" data-date='{"startView": 2}' placeholder="YYYY-MM-DD" name="fechatrabing1"/>
                                        </div>

                                        <div class="input-group fechatraout">
                                            <label class="label">Fecha de Salida :</label>
                                            <input type="date" data-date='{"startView": 2}' placeholder="YYYY-MM-DD" name="fechatrabout1"/>
                                        </div>

                                        <div class="input-group cargotrabajo">
                                            <label class="label">Cargo Desempeñado:</label>
                                            <input type="text" name="cargotrab1" maxlength="45">
                                        </div>  
                                </div>
            
                                <div class="input-group funcionestrabajo">
                                        <label class="label">Funciones asignadas en Trabajo :</label>
					<input type="text" name="funtrab1" maxlength="115">
					
                                </div>
            
                                <div id="bloque">
                                        <div class="input-group jefeintrabajo">
                                            <label class="label">Jefe Inmediato :</label>
                                            <input type="text" name="jefetrab1" maxlength="45">
                                        </div>

                                        <div class="input-group telfjefeconv">
                                            <label class="label">Teléfono Convencional:</label>
                                            <input type="text" name="telfjefe1" maxlength="12">
                                        </div>

                                        <div class="input-group motivosalidatrab">
                                            <label class="label">Motivo de Salida:</label>
                                            <input type="text"  name="motivosalidatrab1" maxlength="45">
                                        </div>  
                                </div>
                        <!--TRABAJO 2-->  
                        
                                <div class="txtcentro">
                                    <label> --- Trabajo 2 --- </label>
                                </div> 
                        
                                <div class="input-group nombreempresa">
                                        <label class="label">Nombre de la Institución o Empresa 2:</label>
					<input type="text"  name="nombretrab2" maxlength="115">
					
                                </div>
                        
                                <div id="bloque">
                                        <div class="input-group fechatrain">
                                                <label class="label">Fecha de Ingreso :</label>
                                                <input type="date" data-date='{"startView": 2}' placeholder="YYYY-MM-DD" name="fechatrabing2"/>
                                        </div>

                                        <div class="input-group fechatraout">
                                                <label class="label" >Fecha de Salida :</label>
                                                <input type="date" data-date='{"startView": 2}' placeholder="YYYY-MM-DD" name="fechatrabout2"/>
                                        </div>

                                        <div class="input-group cargotrabajo">
                                                <label class="label">Cargo Desempeñado:</label>
                                                <input type="text" name="cargotrab2" maxlength="45">
                                        </div>  
                                </div>
            
                                <div class="input-group funcionestrabajo">
                                        <label class="label">Funciones asignadas en Trabajo :</label>
					<input type="text"  name="funtrab2" maxlength="115">
                                </div>
            
                                <div id="bloque">
                                        <div class="input-group jefeintrabajo">
                                            <label class="label">Jefe Inmediato :</label>
                                            <input type="text" name="jefetrab2" maxlength="45">
                                                
                                        </div>

                                        <div class="input-group telfjefeconv">
                                            <label class="label">Teléfono Convencional:</label>
                                            <input type="text" name="telfjefe2" maxlength="12" maxlength="12">
                                        </div>

                                        <div class="input-group motivosalidatrab">
                                            <label class="label">Motivo de Salida:</label>
                                            <input type="text" name="motivosalidatrab2" maxlength="45">
                                        </div>  
                                </div>
            
                         <!--TRABAJO 3-->  
                        
                                <div class="txtcentro">
                                    <label> --- Trabajo 3 --- </label>
                                </div> 
                        
                                <div class="input-group nombreempresa">
                                        <label class="label">Nombre de la Institución o Empresa 3:</label>
					<input type="text"  name="nombretrab3" maxlength="115">
					
                                </div>
                        
                                <div id="bloque">
                                        <div class="input-group fechatrain">
                                                <label class="label">Fecha de Ingreso :</label>
                                                <input type="date" data-date='{"startView": 2}' placeholder="YYYY-MM-DD" name="fechatrabing3"/>
                                        </div>

                                        <div class="input-group fechatraout">
                                                <label class="label" >Fecha de Salida :</label>
                                                <input type="date" data-date='{"startView": 2}' placeholder="YYYY-MM-DD" name="fechatrabout3"/>
                                        </div>

                                        <div class="input-group cargotrabajo">
                                                <label class="label">Cargo Desempeñado:</label>
                                                <input type="text" name="cargotrab3" maxlength="45">
                                        </div>  
                                </div>
            
                                <div class="input-group funcionestrabajo">
                                        <label class="label">Funciones asignadas en Trabajo :</label>
					<input type="text"  name="funtrab3" maxlength="115">
                                </div>
            
                                <div id="bloque">
                                        <div class="input-group jefeintrabajo">
                                            <label class="label">Jefe Inmediato :</label>
                                            <input type="text" name="jefetrab3" maxlength="45">
                                                
                                        </div>

                                        <div class="input-group telfjefeconv">
                                            <label class="label">Teléfono Convencional:</label>
                                            <input type="text" name="telfjefe3" maxlength="12" maxlength="12">
                                        </div>

                                        <div class="input-group motivosalidatrab">
                                            <label class="label">Motivo de Salida:</label>
                                            <input type="text" name="motivosalidatrab3" maxlength="45">
                                        </div>  
                                </div>
        <!--SECCION COLLAPSE TRABAJOS-->                
                                <div class="bloquederecha">
                                <a id="trabextra" data-toggle="collapse" data-target="#trabajosextra">Agregar trabajos Extra</a>
                                </div>
                                
                                <div id="trabajosextra" class="collapse">
                                
                                        <!--TRABAJO 4-->  
                                        <div class="txtcentro">
                                            <label> --- Trabajo 4 --- </label>
                                        </div> 

                                        <div class="input-group nombreempresa">
                                            <label class="label" >Nombre de la Institución o Empresa 4:</label>
                                            <input type="text" name="nombretrab4" maxlength="115">

                                        </div>

                                        <div id="bloque">
                                                <div class="input-group fechatrain">
                                                    <label class="label">Fecha de Ingreso :</label>
                                                    <input type="date" data-date='{"startView": 2}' placeholder="YYYY-MM-DD" name="fechatrabing4"/>
                                                </div>

                                                <div class="input-group fechatraout">
                                                    <label class="label">Fecha de Salida :</label>
                                                    <input type="date" data-date='{"startView": 2}' placeholder="YYYY-MM-DD" name="fechatrabout4"/>
                                                </div>

                                                <div class="input-group cargotrabajo">
                                                    <label class="label">Cargo Desempeñado:</label>
                                                    <input type="text" name="cargotrab4" maxlength="45">
                                                </div>  
                                        </div>

                                        <div class="input-group funcionestrabajo">
                                                <label class="label">Funciones asignadas en Trabajo :</label>
                                                <input type="text" name="funtrab4" maxlength="115">

                                        </div>

                                        <div id="bloque">
                                                <div class="input-group jefeintrabajo">
                                                    <label class="label">Jefe Inmediato :</label>
                                                    <input type="text" name="jefetrab4" maxlength="45">
                                                </div>

                                                <div class="input-group telfjefeconv">
                                                    <label class="label">Teléfono Convencional:</label>
                                                    <input type="text" name="telfjefe4" maxlength="12">
                                                </div>

                                                <div class="input-group motivosalidatrab">
                                                    <label class="label">Motivo de Salida:</label>
                                                    <input type="text"  name="motivosalidatrab4" maxlength="45">
                                                </div>  
                                        </div>
                                    
                                    
                                    
                                        <!--TRABAJO 5-->  
                                        <div class="txtcentro">
                                            <label> --- Trabajo 5 --- </label>
                                        </div> 

                                        <div class="input-group nombreempresa">
                                            <label class="label" >Nombre de la Institución o Empresa 5:</label>
                                            <input type="text" name="nombretrab5" maxlength="115">

                                        </div>

                                        <div id="bloque">
                                                <div class="input-group fechatrain">
                                                    <label class="label">Fecha de Ingreso :</label>
                                                    <input type="date" data-date='{"startView": 2}' placeholder="YYYY-MM-DD" name="fechatrabing5"/>
                                                </div>

                                                <div class="input-group fechatraout">
                                                    <label class="label">Fecha de Salida :</label>
                                                    <input type="date" data-date='{"startView": 2}' placeholder="YYYY-MM-DD" name="fechatrabout5"/>
                                                </div>

                                                <div class="input-group cargotrabajo">
                                                    <label class="label">Cargo Desempeñado:</label>
                                                    <input type="text" name="cargotrab5" maxlength="45">
                                                </div>  
                                        </div>

                                        <div class="input-group funcionestrabajo">
                                                <label class="label">Funciones asignadas en Trabajo :</label>
                                                <input type="text" name="funtrab5" maxlength="115">

                                        </div>

                                        <div id="bloque">
                                                <div class="input-group jefeintrabajo">
                                                    <label class="label">Jefe Inmediato :</label>
                                                    <input type="text" name="jefetrab5" maxlength="45">
                                                </div>

                                                <div class="input-group telfjefeconv">
                                                    <label class="label">Teléfono Convencional:</label>
                                                    <input type="text" name="telfjefe5" maxlength="12">
                                                </div>

                                                <div class="input-group motivosalidatrab">
                                                    <label class="label">Motivo de Salida:</label>
                                                    <input type="text"  name="motivosalidatrab5" maxlength="45">
                                                </div>  
                                        </div>
                                    
                                        <!--TRABAJO 6-->  
                                        <div class="txtcentro">
                                            <label> --- Trabajo 6 --- </label>
                                        </div> 

                                        <div class="input-group nombreempresa">
                                            <label class="label" >Nombre de la Institución o Empresa 6:</label>
                                            <input type="text" name="nombretrab6" maxlength="115">

                                        </div>

                                        <div id="bloque">
                                                <div class="input-group fechatrain">
                                                    <label class="label">Fecha de Ingreso :</label>
                                                    <input type="date" data-date='{"startView": 2}' placeholder="YYYY-MM-DD" name="fechatrabing6"/>
                                                </div>

                                                <div class="input-group fechatraout">
                                                    <label class="label">Fecha de Salida :</label>
                                                    <input type="date" data-date='{"startView": 2}' placeholder="YYYY-MM-DD" name="fechatrabout6"/>
                                                </div>

                                                <div class="input-group cargotrabajo">
                                                    <label class="label">Cargo Desempeñado:</label>
                                                    <input type="text" name="cargotrab6" maxlength="45">
                                                </div>  
                                        </div>

                                        <div class="input-group funcionestrabajo">
                                                <label class="label">Funciones asignadas en Trabajo :</label>
                                                <input type="text" name="funtrab6" maxlength="115">

                                        </div>

                                        <div id="bloque">
                                                <div class="input-group jefeintrabajo">
                                                    <label class="label">Jefe Inmediato :</label>
                                                    <input type="text" name="jefetrab6" maxlength="45">
                                                </div>

                                                <div class="input-group telfjefeconv">
                                                    <label class="label">Teléfono Convencional:</label>
                                                    <input type="text" name="telfjefe6" maxlength="12">
                                                </div>

                                                <div class="input-group motivosalidatrab">
                                                    <label class="label">Motivo de Salida:</label>
                                                    <input type="text"  name="motivosalidatrab6" maxlength="45">
                                                </div>  
                                        </div>
                                        
                                        
                                </div>  <!--cierre div collapse--> 
                  
        <!--SECCION REFERENCIAS-->               
                                <div class="txtseccion">
                                    <label class="etique">REFERENCIAS FAMILIARES Y PERSONALES</label>
                                </div> 
        
                                <div class="txtcentro">
                                    <label> --- Referencia 1 --- </label>
                                </div> 
        
                                <div  id="bloque">
                                        <div class="input-group nombrereferenciaper">
                                            <label class="label">Nombre completo de la referencia 1: </label>
                                            <input type="text" name="nombreref1" maxlength="40">
                                        </div>

                                        <div class="input-group empresalaboraref">
                                                <label class="label">Empresa donde labora: </label>
                                                <input type="text" name="empresaref1" maxlength="80" >
                                                
                                        </div>
                                </div>
        
                                <div id="bloque">
                                        <div class="input-group cargoref">
                                                <label class="label">Cargo :</label>
                                                <input type="text" name="cargoref1" maxlength="60">
                                        </div>

                                        <div class="input-group telfconref">
                                                 <label class="label">Teléfono Convencional:</label>
                                                <input type="text" name="telfref1" maxlength="12">
                                        </div>

                                        <div class="input-group telfcelref">
                                                <label class="label" >Teléfono Celular:</label>
                                                <input type="text" name="celref1" maxlength="12">
                                        </div>  
                                </div>
        
                         <!--REFERENCIA 2-->  
                        
                                <div class="txtcentro">
                                    <label> --- Referencia 2 --- </label>
                                </div> 
        
                                <div  id="bloque">
                                        <div class="input-group nombrereferenciaper">
                                                <label class="label">Nombre completo de la referencia 2: </label>
                                                <input type="text" name="nombreref2" maxlength="40">
                                        </div>

                                        <div class="input-group empresalaboraref">
                                                <label class="label" >Empresa donde labora: </label>
                                                <input type="text" name="empresaref2" maxlength="80"> 
                                        </div>
                                </div>
        
                                <div id="bloque">
                                        <div class="input-group cargoref">
                                                <label class="label">Cargo :</label>
                                                <input type="text"  name="cargoref2" maxlength="60">
                                        </div>

                                        <div class="input-group telfconref">
                                                <label class="label" >Teléfono Convencional:</label>
                                                <input type="text" name="telfref2" maxlength="12">    
                                        </div>

                                        <div class="input-group telfcelref">
                                                <label class="label">Teléfono Celular:</label>
                                                <input type="text" name="celref2" maxlength="12">
                                        </div>  
                                </div>
        
                            <!--REFERENCIA 3-->  
                        
                                <div class="txtcentro">
                                    <label> --- Referencia 3 --- </label>
                                </div> 
        
                                <div  id="bloque">
                                        <div class="input-group nombrereferenciaper">
                                                <label class="label">Nombre completo de la referencia 3: </label>
                                                <input type="text" name="nombreref3" maxlength="40">
                                        </div>

                                        <div class="input-group empresalaboraref">
                                                <label class="label">Empresa donde labora: </label>
                                                <input type="text" name="empresaref3" maxlength="80">
                                        </div>
                                </div>
        
                                <div id="bloque">
                                        <div class="input-group cargoref">
                                                <label class="label">Cargo :</label>
                                                <input type="text" name="cargoref3" maxlength="60">
                                        </div>

                                        <div class="input-group telfconref">
                                                <label class="label">Teléfono Convencional:</label>
                                                <input type="text" name="telfref3" maxlength="12"> 
                                        </div>

                                        <div class="input-group telfcelref">
                                                <label class="label">Teléfono Celular:</label>
                                                <input type="text" name="celref3" maxlength="12">
                                                
                                        </div>  
                                </div>
        
        <!--SECCION CARGO ASPIRAR-->               
                        
        
                  		
	<!--SECCION reCAPTCHA-->               
                                <div class="txtseccion">
                                    <label class="etique"> SEGURIDAD</label>
                                </div>
                                
				<center>
                   		 <?PHP 
                                            $consulta_datakey = mysql_query("SELECT * FROM tbl_seguridades WHERE nombre_seguridad ='recaptcha sitekey'");
                                            $row = mysql_fetch_array($consulta_datakey);  
                                            echo '<div class="g-recaptcha" data-sitekey="'.$row['key'].'">';
                                            echo '</div>';
                                        ?>      
                   		
				</center><br>
		                
		                <div>
					<input name="guardar" type="submit" id="btn-submit" value="Postular">
				</div>
				
			</form>
			
			<div class="footer">Todos los derechos reservados © 2016, Ver 2.0.0</div>
		</div>
		
	</div>

	<!-- USO JQUERY, animacion de menu para responsive-->
        <script src="http://code.jquery.com/jquery-latest.js"></script>
        <script src="../ws-admin/js/bootstrap.js"></script>
      
</body>
</html>