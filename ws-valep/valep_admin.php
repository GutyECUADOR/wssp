<?php
include_once ('../ws-admin/acceso_db.php');
include_once ('../ws-admin/seguridad.php');
include_once ('../ws-admin/funciones.php'); // Acceso a funciones utiles
include_once ('./functions.php'); // Acceso a funciones utiles
?>

<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<link rel="shortcut icon" href="../ws-admin/img/favicon.ico">
        <link href='../ws-admin/css/roboto.css' rel='stylesheet' type='text/css'>
        
        <link rel="stylesheet" href="../ws-admin/css/estilos_main.css">
        <link rel="stylesheet" href="../ws-admin/css/bootstrap.css">
        <link rel="stylesheet" href="../ws-admin/fonts/style.css">
	
       <!-- USO JQUERY, animacion de menu para responsive-->
        <script src="../ws-admin/js/jquery-latest.js"></script>
        <script src="../ws-admin/js/bootstrap.js"></script>
        <script src="../ws-admin/js/menuresponsive.js"></script>
       
        <!-- Librerias datepicker Boostrap3-->
        <link href="../libs/bootstrap-datepicker-1.6.4/css/bootstrap-datepicker3.css" rel="stylesheet">
        <script src="../libs/bootstrap-datepicker-1.6.4/js/bootstrap-datepicker.js"></script>
        <script src="../libs/bootstrap-datepicker-1.6.4/locales/bootstrap-datepicker.es.min.js"></script>
        <script type="text/javascript" src="../ws-admin/js/myJS.js"></script>
        
        <script type="text/javascript">

            $( document ).ready(function() {
                 //Boton de generacion de informe    
                $(".result_search_valeps").on('click','.btnAnulaValep', function(event) {
                    
                    let ID_Vale = event.target.id;
                    let ID_Empresa = document.getElementById("hidden_empresa_autentificada").value;

                    alert("Anulando: " + ID_Vale + " Empresa:" + ID_Empresa);
                    
                    if (confirm("Confirma anular este vale?")) { 
                        $.ajax({
                            url : 'ajax/ajax_isAnuladoOK.php', 
                            method : 'GET',
                            data: {ID_Vale: ID_Vale, ID_Empresa: ID_Empresa}, 
                                        
                            success: function (result) {
                        
                            let API = JSON.parse(result);
                            console.log(API);
                                if (API[0].status === 'OK'){
                                    alert(API[0].mensaje);
                                    location.reload();
                                }else if (API[0].status === 'FAIL'){
                                    alert(API[0].mensaje);
                                } else{
                                    alert("No se puedo obtener estado el vale, informe a sistemas.");
                                }
                            }
                        }); // Fin de ajax;
                    } // Fin de confirm
                       
                    
                }); 

                    //Boton de generacion de informe    
                    $(".result_search_valeps").on('click','.btnEditaValep', function(event) {
                    
                    let ID_Vale = event.target.id;
                    let ID_Empresa = document.getElementById("hidden_empresa_autentificada").value;

                    alert("Editando: " + ID_Vale + " Empresa:" + ID_Empresa);
                    
                    $.ajax({
                        url : 'ajax/ajax_isInDateAprobar.php', 
                        method : 'GET',
                        data: {ID_Vale: ID_Vale, ID_Empresa: ID_Empresa}, 
                                    
                    success: function (result) {
                        
                        let API = JSON.parse(result);
                        console.log(API);
                            if (API[0].status === 'OK'){
                                alert(API[0].mensaje);
                                window.open('edita_valep.php?valep_cod='+API[0].IDvale);
                            }else if (API[0].status === 'FAIL'){
                                alert(API[0].mensaje);
                            } else{
                                alert("No se puedo obtener estado el vale, informe a sistemas.");
                            }
                            
                        }
                    });
                    
                });      



            }); // Fin event ready
        

       
                
           
        

            
        $(function ajaxbusqueda_valepANT(){
            $('#btn_search_valep').click(function(){
                var id_search =document.getElementById("txt_search_modal").value;
                var user_dateini =document.getElementById("dateini_modal").value;
                var user_datefin =document.getElementById("datefin_modal").value;
             
                $.ajax({
                   type : 'post',
                    url : 'busqueda_reporteANT.php', 
                   data: {post_id: id_search, post_dateini: user_dateini , post_datefin: user_datefin},

                success : function(r)
                    {
                      $('#mymodal').show();  // modal id 
                      $('.resultmodal_valep').show().html(r);
                    }
             });
            });
        });
            
            
            
        $(function search_valesp(){
            $('#btn_busqueda_valesp').click(function(){
              var tipo_doc = document.getElementById("seleccion_tipodoc").value;
              var post_dateini = document.getElementById("dateini_modal").value;
              var post_datefin = document.getElementById("datefin_modal").value;
              //alert("Busqueda: "+ data_id);
               $.ajax({
                  url : 'search_valep.php', 
                  method : 'POST',
                  data: {tipo_doc: tipo_doc, post_dateini: post_dateini , post_datefin: post_datefin}, 
                            
               success: function (result) {
                   $('.result_search_valeps').show().html(result);
                   }
               });
           });
        });
        
    
        //Generacion de reportes segun row clickeado
       function fn_genreport_valep(this_elemento){
            var data_id = this_elemento.id;
            var sesion_emp = document.getElementById("hidden_empresa_autentificada").value;
            alert("Generando reporte con ID:" + data_id);
            window.open('reportes/reporte_valep_byid.php?valep_cod='+data_id+'&empresa_cod='+sesion_emp);
            
        };
        
        
        function fn_genreport_valepANT(this_elemento){
            var data_id = this_elemento.id;
            alert("Generando reporte con ID:" + data_id);
            window.open('reportes/reporte_valep_byid_ANT.php?valep_cod='+data_id);
            
        };
        
        //Edicion de Vale
       function fn_edit_valep(this_elemento){
            var data_id = this_elemento.id;
            alert("Editando vale con ID: " + data_id);
            window.open('edita_valep.php?valep_cod='+data_id);
            
        };
        
      
        </script>
        
        <title>Registro de vales por pérdida</title>
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
                            <?PHP 
                                    include '../ws-admin/build_menutop.php';
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
                              echo '</br>CI: '.$_SESSION['user_ruc'];
                              echo '</br> Acceso: '.$_SESSION['user_lv'];
                              echo '</br> Empresa'.$_SESSION['empresa_autentificada'];
                        ?>
                            <input type="hidden" id="hidden_empresa_autentificada" value="<?php echo $_SESSION['empresa_autentificada']?>">      
                        </span>
                    </div>
                
                <div class="footer"></div>
                
                </div>
                <!-- Bloque Menus-->
                <div class="container-menu">  
                <nav id="valesperdida">
                <h5 class="tituloh5">Menú Principal</h5>
                <ul class="menu">
                        <?PHP 
                        include '../ws-admin/build_menuleft.php';
                        ?> 
                    </ul>
                    <div class="footer">Todos los derechos reservados © 2017, Ver 2.0.0</div>
                </nav>
                </div>
            </div>
            
        <div id="sidebar-central" class="contenedor-formulario">
                <div class="wrap">
                
                    <!-- Inicio panel de navegacion y busqueda -->
                <div class="row">
                  <div class="col-sm-12">
                      <div class="col-sm-6">
                          <div class="input-group">
                               <input type="text" id="dateini_modal" class="form-control centertext pickyDate"  placeholder="Fecha Inicial"><span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                               <input type="text" id="datefin_modal" class="form-control centertext pickyDate" placeholder="Fecha Final"><span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                          </div>
                      </div>
                      <div class="col-sm-6">
                        <div class="input-group">
                            <select class="form-control centertext" name="seleccion_tipodoc" id="seleccion_tipodoc" required>
                                <option value="">--- TIPO DE DOCUMENTO ---</option>
                                <?php getTiposDocByDB($_SESSION['empresa_autentificada'])?>
                            </select> 
                           
                          <span class="input-group-btn">
                              <button class="btn btn-default" type="button" id="btn_busqueda_valesp" onclick="search_valesp()"><span class="glyphicon glyphicon-search"></span> Buscar</button>
                              <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Opciones <span class="caret"></span></button>
                                
                                <ul class="dropdown-menu dropdown-menu-right">
                                  <li><a href="../ws-valep/" target="_blank"><span class="glyphicon glyphicon-file"></span> Nueva Solicitud</a></li>
                                </ul>
                          </span>
                        </div><!-- /input-group -->
                      </div>
                  </div><!-- /.col-lg-6 -->
                </div><!-- /.row -->
                
                </div>
                </br>
                
                <div class="wrap">
                    <div class="txtseccion">
                        <label class="etique"> RESULTADOS DE BÚSQUEDA</label>
                    </div>
                    
                    <div id="responsibetable">
                        <!-- Resultados AJAX-->
                        <div class="result_search_valeps">
                            <?php include_once 'grid_dinamico.php';?>
                        </div>
                        
                    </div>    
                   
                </div>
        </div>
     
        <!-- Modal Informe Antiguo-->
            <div class="modal fade modal_left20" id="modal_gen_informe" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel">Generar Informe</h5>
                  </div>
                  <div class="modal-body">
                    
                    <div class="alert alert-info alert-dismissable">
                      <button type="button" class="close" data-dismiss="alert">&times;</button>
                      <p> Puede ingresar tanto el código del reporte a regenerar o CI .</p>
                    </div>
                    <div class="resultmodal" style="display:none;"></div>

                     <form action="reportes/reporte_evaluado_byid.php" method="GET" target="_blank" class="form-inline">
                            <div class="row">
                              <input type="text" id="txt_search_modal" class="form-control centertext" placeholder="ID de documento o Código de Cliente (0000XXXX)" aria-describedby="basic-addon1">
                            
                            </div>
                            <div class="rowspace input-group">
                                <input type="text" id="dateini_modal" class="form-control centertext pickyDate"  placeholder="Fecha Inicial"><span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                            </div>
                         
                            <div class="rowspace input-group">
                                <input type="text" id="datefin_modal" class="form-control centertext pickyDate" placeholder="Fecha Final"><span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                            </div>
                            
                            <div class="row">
                                
                            </div>
                        <!-- Resultados AJAX-->
                        <div class="resultmodal_valep" style="display:none;">
                            <p>Resultados</p>
                        </div>
                  
                         <div class="row rowspace">
                            <button type="button" class="btn btn-primary" id="btn_search_valep" onclick="ajaxbusqueda_valepANT()"> <span class="glyphicon glyphicon-search"></span> Buscar</button>
                           
                        </div>
                        </form> 
                    
                         
                  </div>
                  <div class="modal-footer">
                  <button type="submit" class="btn btn-default btn-sm" data-dismiss="modal"><span class="glyphicon"></span> Aceptar </button>
                   
                </div>
              </div>
            </div>  
            </div>
    
</body>
</html>