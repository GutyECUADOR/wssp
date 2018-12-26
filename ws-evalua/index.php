<?php

date_default_timezone_set('America/Bogota');
include('../ws-admin/acceso_db.php');
include('../ws-admin/acceso_db_sbio.php');
include('../ws-admin/funciones.php'); // Acceso a funciones utiles
?>
<html lang="es">
     <!--La alteración total o parcial de los datos provistos en el sistema son considerados como
    delitos contra la seguridad de los activos de los sistemas de información y comunicación, según lo estipulado en el artículo 232 del Código Orgánico Integral Penal, cuya sanción es la pena
    privativa de libertad de tres a cinco años. -->
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <link rel="stylesheet" href="../ws-admin/css/estilos_solicitud.css">
        <link rel="stylesheet" href="../ws-admin/css/bootstrap.css">
	<link rel="shortcut icon" href="../ws-admin/img/favicon.ico">
        <link href='../ws-admin/css/roboto.css' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="../ws-admin/css/tcal.css" />
        <script type="text/javascript" src="../ws-admin/js/tcal.js"></script> 
	<script src='https://www.google.com/recaptcha/api.js'></script>
        <script src="sweetalert-master/dist/sweetalert.min.js"></script>
        <link rel="stylesheet" type="text/css" href="sweetalert-master/dist/sweetalert.css">
        
         <script type="text/javascript">

            webshim.setOptions('forms-ext', {
                replaceUI: 'auto'
            });

            webshim.polyfill('forms forms-ext');


            $(function () {
                $('.check-validity').on('click', function () {
                    $(this).jProp('form').checkValidity();
                    return false;
                });
            });
            //]]> 

            function loadmodal() {
                
                        var campo1 = document.getElementById("seleccion_evaluador_txt").value;
                        if(campo1 != ""){
                          document.getElementById("select_local").removeAttribute('disabled');
                           $("#modalcodigo").modal();

                            //Obtener valor seleccionado y mostrarlo en el modal
                            var val_evalua = document.getElementById("seleccion_evaluador_txt").value;
                            $("#myModalLabel_usuario").text(val_evalua);
                          
                        }
                        else{
                          document.getElementById("select_local").setAttribute('disabled', 'disabled');
                            }
                          
                
                   
            }


                    function showselect(str){
                         var val_evalua = document.getElementById("seleccion_evaluador").value;
                         
                        $.ajax({
                           type : 'get',
                            url : 'ajax_select_empleado.php', 

                           data: {cod_WF: str, excluyente:val_evalua},
                          
                        success : function(r)
                            {
                              document.getElementById("ajax_result_cliente").innerHTML=r;
                              document.getElementById("txt_cargo").value="";
                            }
                            });
                    
                    }
                    
                    // Funciòn de Busqueda de cargo evaluado
                    
                    
                    function valida_cargo(){
                         var cod_empleado = document.getElementById("seleccion_empleado").value;
                         
                           $.ajax({
                                type : 'get',
                                 url : 'valida_cargo_json.php', 
                                 dataType: "json",

                                data: {cod_user: cod_empleado},

                             success : function(response)
                                 {
                                   if(response.length!==0){
                                        document.getElementById("txt_cargo").value = response[0]['Cargo'];
                                    }else{
                                        document.getElementById("txt_cargo").value = "-No especificado-";
                                    }
                                 }
                                 });
                    }
                    
                    
                     // Funcion de valdacion de codigo de seguridad
                    
                    function ajaxvalidacod(){
                   
                       var cod_usu_ing =document.getElementById("cajacod").value;
                       var cod_apell_ing =document.getElementById("seleccion_evaluador").value;
                       
                        $.ajax({
                           type : 'post',
                            url : 'valida_cod.php', 

                           data: {post_cod_usr: cod_usu_ing, post_apll_urs: cod_apell_ing},

                        success : function(r)
                            {
                              $('#mymodal').show();  // put your modal id 
                              $('.resultmodal').show().html(r);
                            
                                      var verificacion_cod = document.getElementById("cod_veri").value;
                                      if(verificacion_cod != "")
                                      {
                                        document.getElementById("aceptar_modal1").removeAttribute('disabled');
                                      } else{
                                        document.getElementById("aceptar_modal1").setAttribute('disabled', 'disabled');
                                      }
                            }
                            });
                   
                    };   
                    
                    
                    function ajaxvalidacod_json(){
                       var cod_usu_ing =document.getElementById("txt_cisolicitante").value;
                       
                        $.ajax({
                           type : 'get',
                            url : 'valida_cod_json.php', 
                            dataType: "json",

                           data: {dato_ci: cod_usu_ing},

                        success : function(response)
                            {
                                     if(response.length!==0){
                                        document.getElementById("seleccion_evaluador_txt").value = response[0]['Nombre']+response[0]['Apellido'];
                                        document.getElementById("seleccion_evaluador").value = response[0]['Codigo']; //Hidden field
                                    }else{
                                        document.getElementById("seleccion_evaluador_txt").value = "";
                                    
                                    }
                            }
                        });
                    }; 
                    

</script>
        
	<title>Formulario de Evaluación</title>
	
</head>
<body>

    <?php include '../ws-admin/topnavBar.php'?>

	<div class="contenedor-formulario">
		<div class="wrap">
                <div class="txtcentro">
                <h5>FORMULARIO DE EVALUACION EN LOCALES</h5>
                <h6>rev05.06.17</h6>
        </div>
                    
                    <form action="addevalua2.php " autocomplete="off"  class="formulario" name="formulario_registro" method="POST">
               			<div class="centrado">
	           		   	<img class="logo" src="../ws-admin/img/logo.png" alt="Logo">
                    		</div>
                    
                                <div class="txtcentro">
                                    <label> Los campos con (*) son obligatorios y deben contener información verídica. Recuerde al finalizar validar captcha o será marcado como spam</label>
                                </div>
                            
                                
            <!--SECCION INFO PERSONAL-->                
                                <div class="txtseccion">
                                    <label class="etique"> INFORMACIÓN DE EVALUADOR</label>
                                </div>
                                <div  id="bloque">   
                                <div class="input-group bloquede3-1">
                                    <label class="label">Cédula: <em class="em">*</em></label>
                                    <input type="text" id="txt_cisolicitante" name="txt_cisolicitante" onkeyup="ajaxvalidacod_json()" onchange="loadmodal()" maxlength="10" placeholder="Número de Cedula" required>
                                </div> 
                                    
                                <div class="input-group bloquede3-2">
                                    <label class="label">Evaluador:</label>
                                    <input type="text" name="seleccion_evaluador_txt" id="seleccion_evaluador_txt"disabled required>
                                    <input type="hidden" name="seleccion_evaluador" id="seleccion_evaluador">
                                </div>
                                    
                                <div class="input-group bloquede3-3">
                                    <label class="label">Semana: <em class="em">*</em></label>
                                    <select name="seleccion_semana" id="seleccion_semana" required>
                                      <option value=''>---SELECCIONE POR FAVOR---</option>
                                      <option value="<?php echo ini_anterior_week(); ?> - <?php echo fin_anterior_week(); ?>"><?php echo ini_anterior_week(); ?> - <?php echo fin_anterior_week(); ?></option>
                                      <option value="<?php echo first_month_day(); ?> - <?php echo end_first_week(); ?>"><?php echo first_month_day(); ?> - <?php echo end_first_week(); ?></option>
                                      <option value="<?php echo ini_second_week(); ?> - <?php echo end_first_week(); ?>"><?php echo ini_second_week(); ?> - <?php echo end_second_week(); ?></option>
                                      <option value="<?php echo ini_third_week(); ?> - <?php echo end_first_week(); ?>"><?php echo ini_third_week(); ?> - <?php echo end_third_week(); ?></option>
                                      <option value="<?php echo ini_fourth_week(); ?> - <?php echo end_first_week(); ?>"><?php echo ini_fourth_week(); ?> - <?php echo last_month_day(); ?></option>
                                    </select>
                                              
                                </div>
                                 
                                 
                                </div>    
            
                                <div  id="bloque">
                                    
                                        <div class="input-group bloquede3-1">
                                            
                                            <label class="label">Empresa: <em class="em">*</em></label>
                                            <select name="select_local" id="select_local" onchange="showselect(this.value)" required disabled>
                                            <option value=''>---SELECCIONE POR FAVOR---</option>
                                            <?PHP 
                                            $consulta_local = "SELECT * FROM Empresas_WF ORDER BY Codigo";
                                            $result_query = odbc_exec($conexion_sbio, $consulta_local);

                                            while(odbc_fetch_row($result_query))
                                            {
                                            $codigowf = odbc_result($result_query,"Codigo"); 
                                            $empresawf = odbc_result($result_query,"Nombre"); 

                                            echo "<option value='$codigowf'>$empresawf</option>";

                                            }
                                            ?>  
                                            </select>
                                            
                                        </div>

                                        <div class="input-group bloquede3-2">
                                                <label class="label" >Empleado: <em class="em">*</em></label>
		                                    <div id="ajax_result_cliente">
                                                        <select name="seleccion_empleado" id="seleccion_empleado" onchange="valida_cargo()" required>
		                                      <option value=''>---SELECCIONE POR FAVOR---</option>
		                                    </select>
                                                    </div>
                                        </div>
                                    
                                        <div class="input-group bloquede3-3">
                                            <label class="label">Cargo:</label>
                                            <input type="text" name="txt_cargo" id="txt_cargo" readonly>
                                       </div>
                                      
                                </div>
            
                          
  <!--SECCION ITEMS FORMACIÓN-->               
                                
                                <div class="txtseccion">
                                    <label class="etique"> FORMACIÓN</label>
                                    
                                </div>
        
                                <div  id="bloque">
                                        <div class="input-group" id="item_evaluacion">
                                        <label class="label">1.- Demuestra tener los conocimientos requeridos para el cargo. </label>
                                        </div>

                                        <div class="input-group" id="valor_evaluacion">
                                            <select name="seleccion_item1-1" required>
                                            <option value=''>-- Valor --</option>
                                            <option value="5">5</option>
                                            <option value="4">4</option>
                                            <option value="3">3</option>
                                            <option value="2">2</option>
                                            <option value="1">1</option>
                                            </select>
                                        </div>
                                      
                                </div>
        
                                <div  id="bloque">
                                        <div class="input-group" id="item_evaluacion">
                                        <label class="label">2.- Sigue las políticas y procedimientos establecidos por la Empresa. </label>
                                        </div>

                                        <div class="input-group" id="valor_evaluacion">
                                            <select name="seleccion_item1-2" required>
                                            <option value=''>-- Valor --</option>
                                            <option value="5">5</option>
                                            <option value="4">4</option>
                                            <option value="3">3</option>
                                            <option value="2">2</option>
                                            <option value="1">1</option>
                                            </select>
                                        </div>
                                      
                                </div>
        
        			            <div  id="bloque">
                                        <div class="input-group" id="item_evaluacion">
                                        <label class="label">3.- Manifiesta suficiencia para poderse desempeñar. </label>
                                        </div>

                                        <div class="input-group" id="valor_evaluacion">
                                            <select name="seleccion_item1-3" required>
                                            <option value=''>-- Valor --</option>
                                            <option value="5">5</option>
                                            <option value="4">4</option>
                                            <option value="3">3</option>
                                            <option value="2">2</option>
                                            <option value="1">1</option>
                                            </select>
                                        </div>
                                      
                                </div>
        
       				            <div  id="bloque">
                                        <div class="input-group" id="item_evaluacion">
                                        <label class="label">4.- Se adapta al cargo y sitio de trabajo. </label>
                                        </div>

                                        <div class="input-group" id="valor_evaluacion">
                                            <select name="seleccion_item1-4" required>
                                            <option value=''>-- Valor --</option>
                                            <option value="5">5</option>
                                            <option value="4">4</option>
                                            <option value="3">3</option>
                                            <option value="2">2</option>
                                            <option value="1">1</option>
                                            </select>
                                        </div>
                                      
                                </div>

                                <div  id="bloque">
                                        <div class="input-group" id="item_evaluacion">
                                        <label class="label">5.- Tiene conocimiento de las 10 Reglas de Atención al Cliente.</label>
                                        </div>

                                        <div class="input-group" id="valor_evaluacion">
                                            <select name="seleccion_item1-5">
                                            <option value=''>-- Valor --</option>
                                            <option value="10">10</option>
                                            <option value="9">9</option>
                                            <option value="8">8</option>
                                            <option value="7">7</option>
                                            <option value="6">6</option>
                                            <option value="5">5</option>
                                            <option value="4">4</option>
                                            <option value="3">3</option>
                                            <option value="2">2</option>
                                            <option value="1">1</option>
                                            </select>
                                        </div>
                                      
                                </div>
        
<!--SECCION ITEMS  ORGANIZACIÓN -->               
                                
                                <div class="txtseccion">
                                    <label class="etique"> ORGANIZACIÓN </label>
                                    
                                </div>
        
                                <div  id="bloque">
                                        <div class="input-group" id="item_evaluacion">
                                        <label class="label">1.- Es ordenado en la manera de realizar su trabajo,  
                                        despachando diaria y oportunamente los asuntos a su cargo. </label>
                                        </div>

                                        <div class="input-group" id="valor_evaluacion">
                                            <select name="seleccion_item2-1" required>
                                            <option value=''>-- Valor --</option>
                                            <option value="5">5</option>
                                            <option value="4">4</option>
                                            <option value="3">3</option>
                                            <option value="2">2</option>
                                            <option value="1">1</option>
                                            </select>
                                        </div>
                                      
                                </div>
        
                                <div  id="bloque">
                                        <div class="input-group" id="item_evaluacion">
                                        <label class="label">2.- Ordena su trabajo para facilitar las actividades a su cargo. </label>
                                        </div>

                                        <div class="input-group" id="valor_evaluacion">
                                            <select name="seleccion_item2-2" required>
                                            <option value=''>-- Valor --</option>
                                            <option value="5">5</option>
                                            <option value="4">4</option>
                                            <option value="3">3</option>
                                            <option value="2">2</option>
                                            <option value="1">1</option>
                                            </select>
                                        </div>
                                      
                                </div>
        
        			<div  id="bloque">
                                        <div class="input-group" id="item_evaluacion">
                                        <label class="label">3.- No ocasiona pérdidas de tiempo  en el manejo de los procesos o recursos. </label>
                                        </div>

                                        <div class="input-group" id="valor_evaluacion">
                                            <select name="seleccion_item2-3" required>
                                            <option value=''>-- Valor --</option>
                                            <option value="5">5</option>
                                            <option value="4">4</option>
                                            <option value="3">3</option>
                                            <option value="2">2</option>
                                            <option value="1">1</option>
                                            </select>
                                        </div>
                                      
                                </div>
        
       				 <div  id="bloque">
                                        <div class="input-group" id="item_evaluacion">
                                        <label class="label">4.- Utiliza efectivamente los recursos que tiene a su disposición. </label>
                                        </div>

                                        <div class="input-group" id="valor_evaluacion">
                                            <select name="seleccion_item2-4" required>
                                            <option value=''>-- Valor --</option>
                                            <option value="5">5</option>
                                            <option value="4">4</option>
                                            <option value="3">3</option>
                                            <option value="2">2</option>
                                            <option value="1">1</option>
                                            </select>
                                        </div>
                                      
                                </div>        
        
        
 <!--SECCION ITEMS  R. INTERPERSONALES -->               
                                
                                <div class="txtseccion">
                                    <label class="etique"> RELACIONES INTERPERSONALES </label>
                                    
                                </div>
        
                                <div  id="bloque">
                                        <div class="input-group" id="item_evaluacion">
                                        <label class="label">1.- Las relaciones con sus jefes o compañeros son  cordiales y respetuosas. </label>
                                        </div>

                                        <div class="input-group" id="valor_evaluacion">
                                            <select name="seleccion_item3-1" required>
                                            <option value=''>-- Valor --</option>
                                            <option value="5">5</option>
                                            <option value="4">4</option>
                                            <option value="3">3</option>
                                            <option value="2">2</option>
                                            <option value="1">1</option>
                                            </select>
                                        </div>
                                      
                                </div>
        
                                <div  id="bloque">
                                        <div class="input-group" id="item_evaluacion">
                                        <label class="label">2.- Mantiene una actitud de servicio frente  a sus clientes o solicitudes de sus compañeros. </label>
                                        </div>

                                        <div class="input-group" id="valor_evaluacion">
                                            <select name="seleccion_item3-2" required>
                                            <option value=''>-- Valor --</option>
                                            <option value="5">5</option>
                                            <option value="4">4</option>
                                            <option value="3">3</option>
                                            <option value="2">2</option>
                                            <option value="1">1</option>
                                            </select>
                                        </div>
                                      
                                </div>
        
        			<div  id="bloque">
                                        <div class="input-group" id="item_evaluacion">
                                        <label class="label">3.- Tiene la capacidad de escuchar y entender las  inquietudes de sus compañeros. </label>
                                        </div>

                                        <div class="input-group" id="valor_evaluacion">
                                            <select name="seleccion_item3-3" required>
                                            <option value=''>-- Valor --</option>
                                            <option value="5">5</option>
                                            <option value="4">4</option>
                                            <option value="3">3</option>
                                            <option value="2">2</option>
                                            <option value="1">1</option>
                                            </select>
                                        </div>
                                      
                                </div>
        
       				 <div  id="bloque">
                                        <div class="input-group" id="item_evaluacion">
                                        <label class="label">4.- Es tolerante en el sitio de trabajo con sus compañeros. </label>
                                        </div>

                                        <div class="input-group" id="valor_evaluacion">
                                            <select name="seleccion_item3-4" required>
                                            <option value=''>-- Valor --</option>
                                            <option value="5">5</option>
                                            <option value="4">4</option>
                                            <option value="3">3</option>
                                            <option value="2">2</option>
                                            <option value="1">1</option>
                                            </select>
                                        </div>
                                      
                                </div>               
   

<!--SECCION ITEMS  COMPROMISO CON LA EMPRESA - 1 -->               
                                
                                <div class="txtseccion">
                                    <label class="etique"> COMPROMISO CON LA EMPRESA -1 </label>
                                    
                                </div>
        
                                <div  id="bloque">
                                        <div class="input-group" id="item_evaluacion">
                                        <label class="label">1.- Manifiesta interés por las actividades planificadas por la Empresa. </label>
                                        </div>

                                        <div class="input-group" id="valor_evaluacion">
                                            <select name="seleccion_item4-1" required>
                                            <option value=''>-- Valor --</option>
                                            <option value="5">5</option>
                                            <option value="4">4</option>
                                            <option value="3">3</option>
                                            <option value="2">2</option>
                                            <option value="1">1</option>
                                            </select>
                                        </div>
                                      
                                </div>
        
                                <div  id="bloque">
                                        <div class="input-group" id="item_evaluacion">
                                        <label class="label">2.- Se observa compromiso y sentido de pertenencia hacia la Empresa. </label>
                                        </div>

                                        <div class="input-group" id="valor_evaluacion">
                                            <select name="seleccion_item4-2" required>
                                            <option value=''>-- Valor --</option>
                                            <option value="5">5</option>
                                            <option value="4">4</option>
                                            <option value="3">3</option>
                                            <option value="2">2</option>
                                            <option value="1">1</option>
                                            </select>
                                        </div>
                                      
                                </div>
        
        			<div  id="bloque">
                                        <div class="input-group" id="item_evaluacion">
                                        <label class="label">3.- Evidencia entusiasmo y disposición hacia el trabajo. </label>
                                        </div>

                                        <div class="input-group" id="valor_evaluacion">
                                            <select name="seleccion_item4-3" required>
                                            <option value=''>-- Valor --</option>
                                            <option value="5">5</option>
                                            <option value="4">4</option>
                                            <option value="3">3</option>
                                            <option value="2">2</option>
                                            <option value="1">1</option>
                                            </select>
                                        </div>
                                      
                                </div>
        
       				 <div  id="bloque">
                                        <div class="input-group" id="item_evaluacion">
                                        <label class="label">4.- Muestra interés, compromiso por los objetivos trazados por la empresa.  </label>
                                        </div>

                                        <div class="input-group" id="valor_evaluacion">
                                            <select name="seleccion_item4-4" required>
                                            <option value=''>-- Valor --</option>
                                            <option value="5">5</option>
                                            <option value="4">4</option>
                                            <option value="3">3</option>
                                            <option value="2">2</option>
                                            <option value="1">1</option>
                                            </select>
                                        </div>
                                      
                                </div>     

<!--SECCION ITEMS  COMPROMISO CON LA EMPRESA - 2 -->               
                                
                                <div class="txtseccion">
                                    <label class="etique"> COMPROMISO CON LA EMPRESA - 2 </label>
                                    
                                </div>
        
                                <div  id="bloque">
                                        <div class="input-group" id="item_evaluacion">
                                        <label class="label">1.- Cumple con su trabajo a tiempo por encima de los obstáculos. </label>
                                        </div>

                                        <div class="input-group" id="valor_evaluacion">
                                            <select name="seleccion_item5-1" required>
                                            <option value=''>-- Valor --</option>
                                            <option value="5">5</option>
                                            <option value="4">4</option>
                                            <option value="3">3</option>
                                            <option value="2">2</option>
                                            <option value="1">1</option>
                                            </select>
                                        </div>
                                      
                                </div>
        
                                <div  id="bloque">
                                        <div class="input-group" id="item_evaluacion">
                                        <label class="label">2.- Comparte información y recursos para mejorar  la eficiencia de los procesos. </label>
                                        </div>

                                        <div class="input-group" id="valor_evaluacion">
                                            <select name="seleccion_item5-2" required>
                                            <option value=''>-- Valor --</option>
                                            <option value="5">5</option>
                                            <option value="4">4</option>
                                            <option value="3">3</option>
                                            <option value="2">2</option>
                                            <option value="1">1</option>
                                            </select>
                                        </div>
                                      
                                </div>
        
        			<div  id="bloque">
                                        <div class="input-group" id="item_evaluacion">
                                        <label class="label">3.- Muestra interés para solucionar los errores cometidos  por él (ella) o sus compañeros. </label>
                                        </div>

                                        <div class="input-group" id="valor_evaluacion">
                                            <select name="seleccion_item5-3" required>
                                            <option value=''>-- Valor --</option>
                                            <option value="5">5</option>
                                            <option value="4">4</option>
                                            <option value="3">3</option>
                                            <option value="2">2</option>
                                            <option value="1">1</option>
                                            </select>
                                        </div>
                                      
                                </div>
        
       				 <div  id="bloque">
                                        <div class="input-group" id="item_evaluacion">
                                        <label class="label">4.- Evalúa sus errores y presenta mejoras. </label>
                                        </div>

                                        <div class="input-group" id="valor_evaluacion">
                                            <select name="seleccion_item5-4" required>
                                            <option value=''>-- Valor --</option>
                                            <option value="5">5</option>
                                            <option value="4">4</option>
                                            <option value="3">3</option>
                                            <option value="2">2</option>
                                            <option value="1">1</option>
                                            </select>
                                        </div>
                                      
                                </div> 

<!--SECCION ITEMS  COMPROMISO CON LA EMPRESA - 3 -->               
                                
                                <div class="txtseccion">
                                    <label class="etique"> COMPROMISO CON LA EMPRESA - 3 </label>
                                    
                                </div>
        
                                <div  id="bloque">
                                        <div class="input-group" id="item_evaluacion">
                                        <label class="label">1.- Fomenta entre sus compañeros la búsqueda de acuerdos de mutuo beneficio. </label>
                                        </div>

                                        <div class="input-group" id="valor_evaluacion">
                                            <select name="seleccion_item6-1" required>
                                            <option value=''>-- Valor --</option>
                                            <option value="5">5</option>
                                            <option value="4">4</option>
                                            <option value="3">3</option>
                                            <option value="2">2</option>
                                            <option value="1">1</option>
                                            </select>
                                        </div>
                                      
                                </div>
        
                                <div  id="bloque">
                                        <div class="input-group" id="item_evaluacion">
                                        <label class="label">2.- Respeta las ventas o trabajo de sus compañeros. </label>
                                        </div>

                                        <div class="input-group" id="valor_evaluacion">
                                            <select name="seleccion_item6-2" required>
                                            <option value=''>-- Valor --</option>
                                            <option value="5">5</option>
                                            <option value="4">4</option>
                                            <option value="3">3</option>
                                            <option value="2">2</option>
                                            <option value="1">1</option>
                                            </select>
                                        </div>
                                      
                                </div>
        
        			<div  id="bloque">
                                        <div class="input-group" id="item_evaluacion">
                                        <label class="label">3.- Transmite respeto en el trato con los demás aceptando y valorando las diferencias individuales. </label>
                                        </div>

                                        <div class="input-group" id="valor_evaluacion">
                                            <select name="seleccion_item6-3" required>
                                            <option value=''>-- Valor --</option>
                                            <option value="5">5</option>
                                            <option value="4">4</option>
                                            <option value="3">3</option>
                                            <option value="2">2</option>
                                            <option value="1">1</option>
                                            </select>
                                        </div>
                                      
                                </div>
        
       				 <div  id="bloque">
                                        <div class="input-group" id="item_evaluacion">
                                        <label class="label">4.- Se relaciona de manera cercana, cordial con sus compañeros, 
                                         mostrando motivación y empatía para el trabajo en equipo. </label>
                                        </div>

                                        <div class="input-group" id="valor_evaluacion">
                                            <select name="seleccion_item6-4" required>
                                            <option value=''>-- Valor --</option>
                                            <option value="5">5</option>
                                            <option value="4">4</option>
                                            <option value="3">3</option>
                                            <option value="2">2</option>
                                            <option value="1">1</option>
                                            </select>
                                        </div>
                                      
                                </div> 

<!--SECCION ITEMS  COMPROMISO CON LA EMPRESA - 4 -->               
                                
                                <div class="txtseccion">
                                    <label class="etique"> COMPROMISO CON LA EMPRESA - 4 </label>
                                    
                                </div>
        
                                <div  id="bloque">
                                        <div class="input-group" id="item_evaluacion">
                                        <label class="label">1.- Llega con puntualidad a su lugar de trabajo. </label>
                                        </div>

                                        <div class="input-group" id="valor_evaluacion">
                                            <select name="seleccion_item7-1" required>
                                            <option value=''>-- Valor --</option>
                                            <option value="5">5</option>
                                            <option value="4">4</option>
                                            <option value="3">3</option>
                                            <option value="2">2</option>
                                            <option value="1">1</option>
                                            </select>
                                        </div>
                                      
                                </div>
        
                                <div  id="bloque">
                                        <div class="input-group" id="item_evaluacion">
                                        <label class="label">2.- Informa y justifica cuando por alguna circunstancia no pudo asistir al lugar de trabajo. </label>
                                        </div>

                                        <div class="input-group" id="valor_evaluacion">
                                            <select name="seleccion_item7-2" required>
                                            <option value=''>-- Valor --</option>
                                            <option value="5">5</option>
                                            <option value="4">4</option>
                                            <option value="3">3</option>
                                            <option value="2">2</option>
                                            <option value="1">1</option>
                                            </select>
                                        </div>
                                      
                                </div>
        
        			<div  id="bloque">
                                        <div class="input-group" id="item_evaluacion">
                                        <label class="label">3.- Respeta y usa correctamente los bienes de la Empresa, el uniforme,
                                         la credencial y su presentación personal es adecuada. </label>
                                        </div>

                                        <div class="input-group" id="valor_evaluacion">
                                            <select name="seleccion_item7-3" required>
                                            <option value=''>-- Valor --</option>
                                            <option value="5">5</option>
                                            <option value="4">4</option>
                                            <option value="3">3</option>
                                            <option value="2">2</option>
                                            <option value="1">1</option>
                                            </select>
                                        </div>
                                      
                                </div>
        
       				 <div  id="bloque">
                                        <div class="input-group" id="item_evaluacion">
                                        <label class="label">4.- Llega en buen estado de ánimo y de salud al trabajo.
                                         (si ha llegado en estado etílico especifique)   </label>
                                        </div>

                                        <div class="input-group" id="valor_evaluacion">
                                            <select name="seleccion_item7-4" required>
                                            <option value=''>-- Valor --</option>
                                            <option value="5">5</option>
                                            <option value="4">4</option>
                                            <option value="3">3</option>
                                            <option value="2">2</option>
                                            <option value="1">1</option>
                                            </select>
                                        </div>
                                      
                                </div> 
                                
<!-- AUTOEVALUACIÓN -->               
                                
                                <div class="txtseccion">
                                    <label class="etique"> AUTOEVALUACIÓN</label>
                                    
                                </div>
        
                                <div  id="bloque">
                                        <div class="input-group" id="item_evaluacion">
                                        <label class="label">1.- Local limpio y ordenado. </label>
                                        </div>

                                        <div class="input-group" id="valor_evaluacion">
                                            <select name="seleccion_item8-1" required>
                                            <option value=''>-- Valor --</option>
                                            <option value="5">5</option>
                                            <option value="4">4</option>
                                            <option value="3">3</option>
                                            <option value="2">2</option>
                                            <option value="1">1</option>
                                            </select>
                                        </div>
                                      
                                </div>
        
                                <div  id="bloque">
                                        <div class="input-group" id="item_evaluacion">
                                        <label class="label">2.- Mercadería ubicada en el lugar que corresponde. </label>
                                        </div>

                                        <div class="input-group" id="valor_evaluacion">
                                            <select name="seleccion_item8-2" required>
                                            <option value=''>-- Valor --</option>
                                            <option value="5">5</option>
                                            <option value="4">4</option>
                                            <option value="3">3</option>
                                            <option value="2">2</option>
                                            <option value="1">1</option>
                                            </select>
                                        </div>
                                      
                                </div>
        
        			<div  id="bloque">
                                        <div class="input-group" id="item_evaluacion">
                                        <label class="label">3.- Todo el personal está capacitado. </label>
                                        </div>

                                        <div class="input-group" id="valor_evaluacion">
                                            <select name="seleccion_item8-3" required>
                                            <option value=''>-- Valor --</option>
                                            <option value="5">5</option>
                                            <option value="4">4</option>
                                            <option value="3">3</option>
                                            <option value="2">2</option>
                                            <option value="1">1</option>
                                            </select>
                                        </div>
                                      
                                </div>
        
       				 <div  id="bloque">
                                        <div class="input-group" id="item_evaluacion">
                                        <label class="label">4.- Todo el personal cuenta con el uniforme y se encuentra identificado. </label>
                                        </div>

                                        <div class="input-group" id="valor_evaluacion">
                                            <select name="seleccion_item8-4" required>
                                            <option value=''>-- Valor --</option>
                                            <option value="5">5</option>
                                            <option value="4">4</option>
                                            <option value="3">3</option>
                                            <option value="2">2</option>
                                            <option value="1">1</option>
                                            </select>
                                        </div>
                                      
                                </div> 
                                
                                 <div  id="bloque">
                                        <div class="input-group" id="item_evaluacion">
                                        <label class="label">5.- Felicitaciones. </label>
                                        </div>

                                        <div class="input-group" id="valor_evaluacion">
                                            <select name="seleccion_item8-5" required>
                                            <option value=''>-- Valor --</option>
                                            <option value="5">5</option>
                                            <option value="4">4</option>
                                            <option value="3">3</option>
                                            <option value="2">2</option>
                                            <option value="1">1</option>
                                            </select>
                                        </div>
                                      
                                </div> 
  
                                <div class="txtseccion">
                                    <label class="etique"> COACH </label>
                                    
                                </div>
        
                                <div  id="bloque">
                                        <div class="input-group" id="item_evaluacion">
                                        <label class="label">1.- Ingrese el valor sin (%) y con coma (,) decimal. </label>
                                        </div>

                                        <div class="input-group">
                                            <input type="text" name="indice_coach" id="indice_coach" required>
                                        </div>
                                      
                                </div>

                                   
                                <div class="txtseccion">
                                    <label class="etique"> ACCIÓN CORRECTIVA </label>
                                    
                                </div>
        
                                <div  id="bloque">
                                      
                                    <textarea class="cajaarea" name="txt_correcion" rows="3" cols="100%" maxlength="200"></textarea>
                                       
                                </div>

		                <div>
                                    <input name="guardar" type="submit" id="btn-submit" value="Evaluar">
				</div>
				
			<div class="footer">Todos los derechos reservados © 2017, Ver 2.0.0</div>
		</div>
		
	</div>
    
        <!-- Modal/Código de Seguridad-->
            <div class="modal fade" id="modalcodigo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static" data-keyboard="false" >
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel">Código de Seguridad para:</h5>
                    <h6 class="modal-title" id="myModalLabel_usuario">...</h6>
                    
                  </div>
                  <div class="modal-body">
                    
                    <div class="alert alert-info alert-dismissable">
                      <button type="button" class="close" data-dismiss="alert">&times;</button>
                      <h5>¡IMPORTANTE!</h5><p> Asegúrese de ingresar su còdigo de seguridad de forma correcta o el registro no se llevarà a cabo.</p>
                    </div>
                    <div class="resultmodal" style="display:none;"></div>

                        <input type="text" id="cajacod" name="txt_codseguridad" maxlength="45" placeholder="Código de Seguridad" requiered>
                          
                  </div>
                  <div class="modal-footer">
                            <button type="button" class="btn btn-info btn-sm" id="btn_validarpass" onclick="ajaxvalidacod()">Validar Código</button>
                            <button type="submit" class="btn btn-default btn-sm" data-dismiss="modal" id="aceptar_modal1" disabled="disabled"><span class="glyphicon"></span> Aceptar </button>
                   
                </div>
              </div>
            </div>  
            </div>

        </form>
        
	<!-- USO JQUERY, animacion de menu para responsive-->
        <script src="../ws-admin/js/jquery-latest.js"></script>
        <script src="../ws-admin/js/bootstrap.js"></script>
      
</body>
</html>