<?php
include_once ('../ws-admin/acceso_db.php');
include_once ('../ws-admin/seguridad.php');
include_once ('../ws-admin/funciones.php'); // Acceso a funciones utiles
include_once('funcions.php');
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
            
            $(function search_chlocales(){
                $('#btn_busqueda_chlocales').click(function(){
                var empresa_search = document.getElementById("seleccion_empresa_chlocales").value;
                var local_search = document.getElementById("seleccion_local_chlocales").value;
                
                var post_dateini = document.getElementById("dateini_modal").value;
                var post_datefin = document.getElementById("datefin_modal").value;
                $.ajax({
                    url : 'search_chlocales.php', 
                    method : 'POST',
                    data: {empresa_search: empresa_search, local_search:local_search, post_dateini: post_dateini , post_datefin: post_datefin}, 
                                
                success: function (result) {
                    $('.result_search_chlocales').show().html(result);
                    }
                });
            });
            });
                
            function showselectLocales(str){
                            var val_evalua = str.value;
                            
                            $.ajax({
                            type : 'get',
                                url : 'ajax_select_locales.php', 

                            data: {cod_WF: str, cod_db:val_evalua},
                            
                            success : function(r)
                                {
                                document.getElementById("seleccion_local").innerHTML=r;
                                }
                                });
            }    
            
            function showselectLocalesNoModal(){
                            var val_evalua = document.getElementById("seleccion_empresa_chlocales").value; //Obtenemos el value del select
                            
                            $.ajax({
                            type : 'get',
                                url : 'ajax_locales_search.php', 

                            data: {cod_WF:val_evalua},
                            
                            success : function(r)
                                {
                                document.getElementById("seleccion_local_chlocales").innerHTML=r;
                                }
                                });
            }    
                
                
            // Funcion de Menùs
            $('.nav-list').on('click', 'li', function() {
            $('.nav-list li.active').removeClass('active');
            $(this).addClass('active');
            });
            
            
            //Generacion de reportes segun row clickeado
            function fn_genreport_chlocal(this_elemento){
                    var data_id = this_elemento.id;
                    alert("Generando reporte con ID: CHLOCAL-" + data_id);
                    window.open('reportes/reporte_diario_byid.php?id_chlocal='+data_id);
                    
                };
                
            //Edicion de check list
            function fn_edit_chlocal(this_elemento){
                    var data_id = this_elemento.id;
                    var dataDB_id = document.getElementById("db"+data_id).value;
                    alert("Editando check list con ID: CHLOCAL-" + data_id);
                    window.open('edita_chlocales.php?id_chlocal='+data_id+'&id_db='+dataDB_id);
                    
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
                <nav id="chlocales">
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
                <div class="row center-block">
                    <div class="col-sm-5">
                            <div class="input-group  center-block">
                                <input type="text" id="dateini_modal" class="form-control centertext pickyDate"  placeholder="Fecha Inicial">
                                <input type="text" id="datefin_modal" class="form-control centertext pickyDate" placeholder="Fecha Final">
                            </div>
                    </div>
                    <div class="col-sm-5">
                        <div class="input-group center-block">
                                <select class="form-control centertext" name="seleccion_empresa_chlocales" id="seleccion_empresa_chlocales" onchange="showselectLocalesNoModal()" required>
                                    <option value="">--- SELECCIONE POR FAVOR ---</option>
                                    <?php getEmpresasLocalesSelect(); ?>
                                </select> 
                               
                                
                                <select class="form-control centertext" name="seleccion_local_chlocales" id="seleccion_local_chlocales" required>
                                    <option value="">--- SELECCIONE LOCAL ---</option>
                                    <?php ?>
                                </select> 
                        </div><!-- /input-group -->
                    </div><!-- /.col-lg-6 -->
                  
                    <div class="col-sm-2">
                       
                        <button type="button" id="btn_busqueda_chlocales" onclick="search_chlocales()" class="btn btn-primary btn-block rowspace"><span class="glyphicon glyphicon-search"></span> Buscar </button>
                       
                    </div>
                  
                  
                </div><!-- /.row -->
                
                </div><br>
            
                <div class="wrap">
                    <div class="txtseccion">
                        <label class="etique"> ULTIMOS CHECKS REALIZADOS</label>
                    </div>
                    
                    <div id="responsibetable">
                        <!-- Resultados AJAX-->
                        <div class="result_search_chlocales">
                            <?php include_once './grid_checklocales.php';?>
                        </div>
                        
                    </div>    
                   <button type="button" class="btn btn-primary btn-sm rowspace" data-toggle="modal" data-target="#Modal_GenInforme"><span class="glyphicon glyphicon-paste"></span> Generar Informe </button>
                </div>
                <br>
                
                  
               
                
        </div>
     
         <!-- Modal Generar informe -->
        <div class="modal fade modal_left20" id="Modal_GenInforme" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <div class="modal-dialog" role="document">
              
              <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h5 class="modal-title" id="myModalLabel">Generar Informe de Local</h5>
              </div>
                  
                   <div class="modal-body">
                        
                      
                        
                           <form action="reportes/reporte_local_byid.php" method="GET" target="_blank" class="form-inline">
                               <select class="form-control centertext" name="seleccion_empresa_modal" id="seleccion_empresa_modal" onchange="showselectLocales(this.value)" required>
                                   <option value=''>---SELECCIONE EMPRESA---</option>
                                    <?PHP 
                                    getChkLocalesSelect();
                                    ?>
                                   
                                   
                               </select>
                              
                               <select class="form-control centertext" name="seleccion_local" id="seleccion_local">
                                   <option value=''>---SELECCIONE LOCAL---</option>
                               </select>
                               
                            <div class="rowspace input-group">
                                <input id="dateini_modal" name="dateini_modal" class="form-control centertext pickyDate"  placeholder="Fecha Inicial" required><span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                            </div>
                         
                            <div class="rowspace input-group">
                                <input id="datefin_modal" name="datefin_modal" class="form-control centertext pickyDate" placeholder="Fecha Final" required><span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                            </div>
                            
                            
                        <!-- Resultados AJAX-->
                        <div class="resultmodal" style="display:none;">
                            <p>Resultados</p>
                        </div>
                  
                        <div class="row rowspace">
                            <div class="btn-group">
                                <button type="submit" class="btn btn-info" onclick="ajaxbusqueda()"><span class="glyphicon glyphicon-print"></span> Generar</button>
                            </div>
                        </div>
                        </form> 
                         
                        
                   </div>
                  
              
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
              </div>
              
            </div>
            
          </div>
        </div>
</body>
</html>