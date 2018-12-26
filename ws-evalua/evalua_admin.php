<?php
include_once ('../ws-admin/acceso_db.php');
include_once ('../ws-admin/acceso_db_sbio.php');
include_once ('../ws-admin/seguridad.php');
include_once ('../ws-admin/funciones.php'); // Acceso a funciones utiles
?>

<html lang="en">
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
        
       
        
        <title>Resultados de Evaluación</title>
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
                        ?>
                              
                        </span>
                    </div>
                
                <div class="footer"></div>
                
                </div>
                <!-- Bloque Menus-->
                <div class="container-menu">  
                <nav id="evaluaciones">
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
                <div class="row">
                  <div class="col-sm-12">
                    <div class="input-group">
                        <input type="text" class="form-control" id="txt_busqueda_ev" placeholder="Número de evaluacion, CI del evaluado o Apellido" required>
                      <span class="input-group-btn">
                          <button class="btn btn-default" type="button" id="btn_busqueda_ev" onclick="search_ev()"><span class="glyphicon glyphicon-search"></span> Buscar</button>
                          <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Opciones <span class="caret"></span></button>
                            <ul class="dropdown-menu dropdown-menu-right">
                              <li><a href="#" data-toggle="modal" data-target="#Modal_Excel"><span class="glyphicon glyphicon-file"></span> Exportar Excel (xls)</a></li>
                             <!-- <li><a href="#" data-toggle="modal" data-target="#Modal_Eliminar"><span class="glyphicon glyphicon-trash"></span> Eliminar Evaluación</a></li>-->
                              <li role="separator" class="divider"></li>
                              <li><a href="../ws-evalua/" target="_blank"><span class="glyphicon glyphicon-file"></span> Nueva Evaluación</a></li>
                            </ul>
                      </span>
                    </div><!-- /input-group -->
                  </div><!-- /.col-lg-6 -->
                </div><!-- /.row -->
            </div></br>
    
		<div class="wrap">
                    <div class="txtseccion">
                        <label class="etique"> Lista de Evaluaciones</label>
                    </div>
                    
                    <div id="responsibetable">
                        <div class="result_search_ev">
                            <?php include_once 'grid_dinamico.php';?>
                        </div>
                    </div>    
                    
                    <button type="button" class="btn btn-primary btn-sm rowspace" data-toggle="modal" data-target="#Modal_GenInforme"><span class="glyphicon glyphicon-paste"></span> Generar Informe PDF </button>
                </div>
                </br>
                
                
                <div class="wrap">
                    <div class="txtseccion">
                        <label class="etique"> Criterios de Evaluación</label>
                    </div>
                 
                    <table border=0 align='center' width='300px'  min-width='300px'> 
                     <tr class='celdagridtitulos'>
                     <td title='N'>Criterio</td>
                     <td title='Formación'>Rango</td>
                     </tr>
                     
                    <tr class='celdagrid' bgcolor=>
                    <td>Felicitaciones</td>
                    <td>140 - 165</td>
                    </td>
                    
                    <tr class='celdagrid' bgcolor=>
                    <td>Puede mejorar</td>
                    <td>120 - 139</td>
                    </td>
                    
                    <tr class='celdagrid' bgcolor=>
                    <td>En capacitación</td>
                    <td>100 - 119</td>
                    </td>
                    
                    <tr class='celdagrid' bgcolor=>
                    <td>Cumple parcialmente</td>
                    <td>50 - 99</td>
                    </td>
                    
                    <tr class='celdagrid' bgcolor=>
                    <td>No cumple</td>
                    <td> 50 o menos</td>
                    </td>
                    
                    </table>
                </div>
            
            
        </div>
     
    
        
        <!-- Modal Generar informe -->
        <div class="modal fade modal_left20" id="Modal_GenInforme" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <div class="modal-dialog" role="document">
              
              <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h5 class="modal-title" id="myModalLabel">Generar Informe</h5>
              </div>
                  
                   <div class="modal-body">
                        <div class="tabbable"> <!-- Only required for left/right tabs -->
                        <ul class="nav nav-tabs">
                        <li class="active"><a href="#tab1" data-toggle="tab">Informe Individual</a></li>
                        <li><a href="#tab2" data-toggle="tab">Informe Cruzado</a></li>
                        <li><a href="#tab3" data-toggle="tab">Informe Observaciones</a></li>
                        </ul>
                        <div class="tab-content">
                        <div class="tab-pane active" id="tab1">
                            
                           <form action="reportes/reporte_evaluado_byid.php" method="GET" target="_blank" class="form-inline">
                               <select class="form-control centertext" name="seleccion_empresa" id="seleccion_empresa" required="">
                                   <option value=''>---SELECCIONE EMPRESA---</option>
                                    <?PHP 
                                    $consulta_emp = "SELECT * FROM dbo.Empresas_WF with (nolock) ORDER BY Codigo";
                                   
                                    $result_query_emp = odbc_exec($conexion_sbio, $consulta_emp);

                                    while(odbc_fetch_row($result_query_emp))
                                    {
                                    $cod_emp = odbc_result($result_query_emp,"Codigo"); 
                                    $detalle_emp = odbc_result($result_query_emp,"Nombre"); 
                                  
                                    echo "<option value='$cod_emp'>$detalle_emp</option>";
                                    }
                                    ?>
                                   
                                   
                               </select>
                              
                            <div class="rowspace input-group">
                                <input type="date" id="dateini_modal" name="dateini_modal" class="form-control centertext pickyDate"  placeholder="Fecha Inicial"><span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                            </div>
                         
                            <div class="rowspace input-group">
                                <input type="date" id="datefin_modal" name="datefin_modal" class="form-control centertext pickyDate" placeholder="Fecha Final"><span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                            </div>
                            
                            <div class="row">
                                <select required class="form-control centertext" name="seleccion_empleado_modal" id="seleccion_empleado_modal" >
                                  <option value=''>---SELECCIONE EMPLEADO---</option>
                                  <option value='general'>INFORME GENERAL DE EVALUACIONES</option>
                                   <?PHP 
                                    $consulta_empleado_mod_emp = "SELECT * FROM dbo.Empleados with (nolock) WHERE TipoCargo != 4 ORDER BY Apellido";
                                   
                                    $result_query_mod_emp = odbc_exec($conexion_sbio, $consulta_empleado_mod_emp);

                                    while(odbc_fetch_row($result_query_mod_emp))
                                    {
                                    $cod_emp = odbc_result($result_query_mod_emp,"Codigo"); 
                                    $apell_mod_emp = odbc_result($result_query_mod_emp,"Apellido"); 
                                    $nomb_mod_emp = odbc_result($result_query_mod_emp,"Nombre"); 
                                    
                                    
                                    $apell_modutf= iconv("iso-8859-1", "UTF-8", $apell_mod_emp);
                                    $nomb_modutf= iconv("iso-8859-1", "UTF-8", $nomb_mod_emp);
                                    
                                    echo "<option value='$cod_emp'>$apell_modutf $nomb_modutf</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        <!-- Resultados AJAX-->
                        <div class="resultmodal" style="display:none;">
                            <p>Resultados</p>
                        </div>
                  
                         <div class="row rowspace">
                            <div class="btn-group">
                                <button type="button" class="btn btn-primary push" onclick="ajaxbusqueda()"> <span class="glyphicon glyphicon-search"></span> Buscar</button>
                                <button type="submit" class="btn btn-info" onclick=""><span class="glyphicon glyphicon-print"></span> Generar</button>
                            </div>
                        </div>
                        </form> 
                         
                        </div>
                            
                         <!-- FIN Sección - INICIO Segundo Label -->    
                            
                        <div class="tab-pane" id="tab2">
                              
                            <form action="reportes/reporte_cruzado.php" method="GET" target="_blank" class="form-inline">
                            <div class="row">
                            <div class="rowspace">
                                <select required class="form-control centertext" name="seleccion_empleado_modal_cruce" id="seleccion_empleado_modal_cruce" >
                                  <option value=''>---SELECCIONE EMPLEADO---</option>
                                   <?PHP 
                                    $consulta_empleado_mod2 = "SELECT * FROM dbo.Empleados with (nolock) WHERE TipoCargo != 4 ORDER BY Apellido";
                                   
                                    $result_query_mod2 = odbc_exec($conexion_sbio, $consulta_empleado_mod2);

                                    while(odbc_fetch_row($result_query_mod2))
                                    {
                                    $cod_emp2 = odbc_result($result_query_mod2,"Codigo");
                                    $apell_mod2 = odbc_result($result_query_mod2,"Apellido"); 
                                    $nomb_mod2 = odbc_result($result_query_mod2,"Nombre"); 
                                    
                                    $apell_mod2utf= iconv("iso-8859-1", "UTF-8", $apell_mod2);
                                    $nomb_mod2utf= iconv("iso-8859-1", "UTF-8", $nomb_mod2);
                                    
                                    echo "<option value='$cod_emp2'>$apell_mod2utf $nomb_mod2utf</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            </div>
                               
                             <!-- Resultados AJAX-->
                            <div class="resultmodalcruce" style="display:none;">
                                <p>Resultados</p>
                            </div>   
                               
                         <div class="btn-group">
                            <button type="button" class="btn btn-primary pushcruce" onclick="ajaxbusquedacruce()"> <span class="glyphicon glyphicon-search"></span> Buscar</button>
                            <button type="submit" class="btn btn-info" onclick=""><span class="glyphicon glyphicon-print"></span> Generar</button>
                        </div>
                        </form> 
                            
                            
                        </div>
                         
                         <!-- FIN Sección - INICIO Tercer Label -->    
                            
                        <div class="tab-pane" id="tab3">
                              
                            <form action="reportes/reporte_evaluado_obs.php" method="GET" target="_blank" class="form-inline">
                            <div class="row">
                            <div class="rowspace">
                                <select class="form-control centertext" name="seleccion_empleado_modal_obs" id="seleccion_empleado_modal_obs" required>
                                  <option value=''>---SELECCIONE OBSERVACIONES---</option>
                                   <?PHP 
                                    $consulta_empleado_obs = "SELECT * FROM dbo.Empleados with (nolock) WHERE TipoCargo != 4 ORDER BY Apellido";
                                   
                                    $result_query_obs = odbc_exec($conexion_sbio, $consulta_empleado_mod2);

                                    while(odbc_fetch_row($result_query_obs))
                                    {
                                        
                                    $cod_mod3 = odbc_result($result_query_obs,"Codigo");     
                                    $apell_mod3 = odbc_result($result_query_obs,"Apellido"); 
                                    $nomb_mod3 = odbc_result($result_query_obs,"Nombre"); 
                                    
                                    $apell_mod3utf= iconv("iso-8859-1", "UTF-8", $apell_mod3);
                                    $nomb_mod3utf= iconv("iso-8859-1", "UTF-8", $nomb_mod3);
                                    
                                    echo "<option value='$cod_mod3'>$apell_mod3utf $nomb_mod3utf</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            </div>
                               
                         <div class="row rowspace">
                            <button type="submit" class="btn btn-info"><span class="glyphicon glyphicon-print"></span> Generar</button>
                        </div>
                        </form> 
                            
                            
                        </div> 
                         
                        </div>
                        </div>
                   </div>
                  
              
              <div class="modal-footer">
                
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                
                
              </div>
              
            </div>
            
          </div>
        </div>
    
        <!-- Modal Informes Excel -->
        <div class="modal fade modal_left20" tabindex="-1" role="dialog" id="Modal_Excel">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title">Exportación a Excel (.xls)</h4>
            </div>
            <div class="modal-body">
                <form action="reportes/reporte_Excel.php" method="GET" class="form-inline">
                <div class="form-group">
                               <select class="form-control centertext" name="seleccion_empresa_excel" id="seleccion_empresa_excel" required="">
                                   <option value="">---SELECCIONE EMPRESA---</option>
                                    <?PHP 
                                    $consulta_emp_excel = "SELECT * FROM dbo.Empresas_WF with (nolock) ORDER BY Codigo";
                                   
                                    $result_query_emp_excel = odbc_exec($conexion_sbio, $consulta_emp);

                                    while(odbc_fetch_row($result_query_emp_excel))
                                    {
                                    $cod_emp = odbc_result($result_query_emp_excel,"Codigo"); 
                                    $detalle_emp = odbc_result($result_query_emp_excel,"Nombre"); 
                                  
                                    echo '<option value="'.$cod_emp.'">'.$detalle_emp.'</option>';
                                    }
                                    ?>
                                   
                               </select>
                              
                            <div class="rowspace input-group">
                                <input type="text" id="dateini_excel" name="dateini_excel" class="form-control centertext pickyDate"  placeholder="Fecha Inicial" required><span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                            </div>
                         
                            <div class="rowspace input-group">
                                <input type="text" id="datefin_excel" name="datefin_excel" class="form-control centertext pickyDate" placeholder="Fecha Final" required><span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                            </div>
                </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
              <button type="submit" class="btn btn-primary"  id="btn_export_excel"><span class="glyphicon glyphicon-export"></span> Exportar</button>
            </div>
            </form>    
          </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
      </div><!-- /.modal -->
        
        <!-- Modal Eliminar Informe -->
        <div class="modal fade modal_left20" tabindex="-1" role="dialog" id="Modal_Eliminar">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title">Eliminar Evaluación</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <div class="alert alert-danger alert-dismissable">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong><h5>ATENCIÓN!</h5></strong> La evaluación con el código ingresado será eliminada de la base de datos.
                    </div>
                     <div class="result_delete_ev" style="display:none;"></div>
                    
                    <input type="text" class="form-control text-center "id="txt_cod_ev" placeholder="Código de Evaluación"/>
                </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
              <button type="button" class="btn btn-danger" id="btn_delete_ev"><span class="glyphicon glyphicon-alert"></span> Eliminar</button>
            </div>
          </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
      </div><!-- /.modal -->

        <script type="text/javascript" src="../ws-admin/js/myJS.js"></script>
        <script type="text/javascript" src="functions.js"></script>
        
        
      
</body>
</html>