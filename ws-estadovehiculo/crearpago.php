<?php
include_once ('../ws-admin/acceso_db.php');
include_once ('../ws-admin/seguridad.php');

if (!isset($_GET['codOrden'])) {
    header("Location:" . "../ws-estadovehiculo/admin.php");
}

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
    
    <link rel="stylesheet" href="assets/pnotify.custom.min.css">
	
	<title>Creacion de pago</title>
	
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
                              echo '</br> CI: '.$_SESSION['user_ruc'];
                              echo '</br> Acceso: '.$_SESSION['user_lv'];
                              echo '</br> Empresa: '.$_SESSION['empresa_autentificada'];
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
                        <?PHP 
                        include '../ws-admin/build_menuleft.php';
                        ?> 
                    </ul>
                    <div class="footer">Todos los derechos reservados © 2017 - <?php echo date("Y")?>, Ver 2.0.0</div>
                </nav>
                </div>
            </div>
            
        <div id="sidebar-central" class="contenedor-formulario">
            <div class="wrap">
                
                <div class="row">
                    <div class="col-md-12">
                        <div class="input-group">
                            <input type="text" class="form-control" id="inputRUC" placeholder="RUC del proveedor" required>
                        <span class="input-group-btn">
                            <button class="btn btn-default" type="button" data-toggle="modal" data-target="#modalBuscarCliente"><span class="glyphicon glyphicon-search"></span> Buscar</button>
                        </span>
                        </div>
                        <div class="input-group">
                        <span class="input-group-addon">Proveedor: </span>
                        <input id="inputNombre" type="text" class="form-control" readonly>
                        </div>
                    </div>
                </div>

                <!-- agregar productos-->
        
                <div class="row">
                    <div class="col-md-12">
                    <div class="panel panel-default">
                        <!-- Default panel contents -->
                    
                        <div class="panel-heading clearfix">
                        <h4 class="panel-title pull-left" style="padding-top: 7.5px;">Nuevo Item</h4>
                        <div class="btn-group pull-right">
                            <button type="button" class="btn btn-primary btn-sm" id="btnAgregarProdToList"><span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span> Agregar item</button>
                        </div>
                        </div>

                        <div class="panel-body">
                            <div id="">        
                            <table id="tablaAgregaNuevo" class="table table-bordered tableExtras">
                                <thead>
                                <tr>
                                    <th style="width: 5%; font-size: 12px;" class="text-center headerTablaProducto">Codigo</th>
                                    <th style="width: 10%; font-size: 12px;" class="text-center headerTablaProducto">Nombre del Articulo</th>
                                    <th style="width: 2%; font-size: 12px;"  class="text-center headerTablaProducto">Cantidad</th>
                                    <th style="width: 5%; font-size: 12px;" class="text-center headerTablaProducto">Precio</th>

                                    <th style="width: 5%; font-size: 12px;" class="text-center headerTablaProducto">Subtotal</th>
                                </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <div class="input-group">
                                            <input type="text" id="inputNuevoCodProducto" class="form-control text-center" placeholder="Cod Producto...">
                                            <span class="input-group-btn">
                                                <button class="btn btn-default" type="button" data-toggle="modal" data-target="#modalBuscarProducto"><span class="glyphicon glyphicon-search"></span> Buscar</button>
                                            </span>
                                            
                                            </div><!-- /input-group -->
                                        </td>
                                        <td>
                                            <input type="text" id="inputNuevoProductoNombre" class="form-control text-center" readonly>
                                        </td>
                                        <td><input type="number" id="inputNuevoProductoCantidad" class="form-control text-center" value="0"></td>
                                        <td>
                                            <input type="number" id="inputNuevoProductoPrecioUnitario" class="form-control text-center">
                                            
                                        </td>
                                        
                                        <td><input type="text"  id="inputNuevoProductoSubtotal" class="form-control text-center importe_linea" readonly></td>
                                      
                                        </td>
                                    </tr>

                                    
                                      
                                </tbody>
                            </table>

                            </div>
                        </div>

                    </div>
                    </div>
                </div> 

                <!-- items en lista-->

                <div class="row">
                    <div class="col-md-12">
                    <div class="panel panel-default">
                        <!-- Default panel contents -->
                    
                        <div class="panel-heading clearfix">
                        <h4 class="panel-title pull-left" style="padding-top: 7.5px;">Items en lista</h4>
                        <div class="btn-group pull-right">
                        </div>
                        </div>

                        <div class="panel-body">
                            <div id="responsibetable" style="height: auto; !important">        
                            <table id="tablaProductos" class="table table-bordered tableExtras">
                                <thead>
                                <tr>
                                    <th style="width: 10%; font-size: 12px;" class="text-center headerTablaProducto">Codigo</th>
                                    <th style="width: 20%; font-size: 12px;" class="text-center headerTablaProducto">Nombre del Articulo</th>
                                    <th style="width: 3%; font-size: 12px;"  class="text-center headerTablaProducto">Cantidad</th>
                                    <th style="width: 5%; font-size: 12px;" class="text-center headerTablaProducto">Precio</th>
                                    <th style="width: 10%; font-size: 12px;" class="text-center headerTablaProducto">Subtotal</th>
                                    <th style="width: 5%; font-size: 12px;" class="text-center headerTablaProducto">IVA</th>
                                    <th style="width: 5%; font-size: 12px;" class="text-center headerTablaProducto">Eliminar</th>
                                </tr>
                                </thead>
                                <tbody>
                                    <!--Resultados de busqueda aqui -->
                                </tbody>
                            </table>

                            </div>
                        </div>

                    </div>
                    </div>
                </div>

                <!-- fila de resumen de pago-->
                <div class="row">
                    <div class="col-md-12">
                    <div class="panel panel-default">
                        <!-- Default panel contents -->
                    
                        <div class="panel-heading clearfix">
                        <h4 class="panel-title pull-left" style="padding-top: 7.5px;">Resumen</h4>
                        </div>

                        <div class="panel-body">
                            <div id="responsibetable" style="height: auto; !important">        
                                <table class="table table-bordered tableExtras">
                                <thead>
                                    <th style="width: 5%; font-size: 12px;" class="text-center headerTablaProducto">Unidades</th>
                                    <th style="width: 10%; font-size: 12px;" class="text-center headerTablaProducto">IVA Bienes</th>
                                    <th style="width: 5%; font-size: 12px;" class="text-center headerTablaProducto">% ICE</th>
                                    <th style="width: 10%; font-size: 12px;" class="text-center headerTablaProducto">Base ICE</th>
                                    <th style="width: 20%; font-size: 12px;" class="text-center headerTablaProducto">Subtotal</th>
                                    <th style="width: 10%; font-size: 12px;" class="text-center headerTablaProducto">Descuento</th>
                                    <th style="width: 5%; font-size: 12px;" class="text-center headerTablaProducto">ICE</th>
                                    <th style="width: 10%; font-size: 12px;" class="text-center headerTablaProducto">Impuesto</th>
                                    <th style="width: 10%; font-size: 12px;" class="text-center headerTablaProducto">Gastos</th>
                                    <th style="width: 20%; font-size: 12px;" class="text-center headerTablaProducto">Total</th>
                                </thead>
                                <tbody>
                                <tr>
                                    <td><input type="text" class="form-control text-center" id="txt_unidadesProd"></td>
                                    <td><input type="text" class="form-control text-center" id="txt_ivaBienes" readonly></td>
                                    <td><select class="form-control input-sm centertext"></select></td>
                                    <td><input type="text" class="form-control text-center" readonly></td>
                                    <td><input type="text" class="form-control text-center" id="txt_subtotal" value="0" readonly></td>
                                    <td><input type="text" class="form-control text-center" id="txt_descuentoResumen" readonly></td>
                                    <td><input type="text" class="form-control text-center" readonly></td>
                                    <td><input type="text" class="form-control text-center" id="txt_impuesto" readonly></td>
                                    <td><input type="text" class="form-control text-center" id="txt_gastos" readonly></td>
                                    <td><input type="text" class="form-control text-center" id="txt_totalPagar" readonly></td>
                                    
                                </tr>
                            
                                </tbody>
                                </table>

                            </div>
                        </div>

                    </div>
                    </div>
                </div> 

                <div class="row">
                    <div class="col-md-12">
                        <div class="btn-group btn-group-justified" role="group" aria-label="...">
                        

                            <div class="btn-group" role="group">
                                <button type="button" class="btn btn-primary btn-lg" id="btnGuardar"><span class="glyphicon glyphicon-floppy-saved" aria-hidden="true"></span> Guardar</button>
                            </div>

                            <div class="btn-group" role="group">
                                <button type="button" class="btn btn-danger btn-lg" id="btnCancel"><span class="glyphicon glyphicon-floppy-remove" aria-hidden="true"></span> Cancelar</button>
                            </div>
                    
                        </div>
                    </div>
                </div>    

            </div>
          
                
	    </div>
        
      
        <!-- USO JQUERY, animacion de menu para responsive-->
        <script src="http://code.jquery.com/jquery-latest.js"></script>
        <script type="text/javascript" src="assets/pnotify.custom.min.js"></script>
        <script src="../ws-admin/js/bootstrap.js"></script>
        <script src="../ws-admin/js/menuresponsive.js"></script>
        <script src="assets/crearpago.js"></script>
        
        
</body>
</html>