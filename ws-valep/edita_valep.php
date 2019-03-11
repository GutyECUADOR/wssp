<?php

session_start();
include('../ws-admin/acceso_db.php');
include('../ws-admin/acceso_db_sbio.php');
require_once '../ws-admin/acceso_multi_db.php';

    $db_wssp = getDataBase('009');

    if (!isset($_SESSION['empresa_autentificada'])) {
        $mensaje = "Acceso no autorizado, puede que la sesion haya expirado.";
        echo "<script>";
        echo "alert('$mensaje');";  
        echo "window.location = '../ws-admin/';"; /*REDIRECCIONAMIENTO*/ 
        echo "</script>";  
    }else{

   

    $id_valep = $_GET['valep_cod'];
    $id_empresa_edidvale = $_SESSION['empresa_autentificada'];
    
    //Consulta de la DB wssp segun ID de vale y empresa de sesion iniciada
    $sql_vales_perdida = "SELECT * FROM dbo.vales_perdida as VALEP with (nolock) WHERE VALEP.cod_valep = '$id_valep' and empresa='$id_empresa_edidvale'";
    $consulta_vales_perdida = odbc_exec($db_wssp, $sql_vales_perdida);
    
    $cod_empresa_edita =  trim(odbc_result($consulta_vales_perdida,"empresa"));
    $ci_edita_valep =  trim(odbc_result($consulta_vales_perdida,"ci_solicitante"));
    $cod_reporte =  trim(odbc_result($consulta_vales_perdida,"cod_valep"));
    $empresa_pdf = trim(odbc_result($consulta_vales_perdida,"bodega"));
    $comentario_editavalep = odbc_result($consulta_vales_perdida,"comentario");
    
    //Campos hidden
    $numpagos = trim(odbc_result($consulta_vales_perdida,"numpagos"));
    $fechaPagos = trim(odbc_result($consulta_vales_perdida,"fechaPagos"));
    $fechavalep = trim(odbc_result($consulta_vales_perdida,"fecha"));
    
    //Recuparamos instancia segun base de datos que indica el vale
    $db_empresa = getDataBase($cod_empresa_edita); //Obtenemos conexion con base de datos segun codigo de la DB
    
    //Recodificacion de ISO-8859 a UTF
    $solicitante_pdf =  trim(iconv("iso-8859-1", "UTF-8", odbc_result($consulta_vales_perdida,"ci_solicitante")));
    
    $subtotal = round(odbc_result($consulta_vales_perdida,"subtotal"),2);
    $iva = round(odbc_result($consulta_vales_perdida,"iva"),2);
    $total = round(odbc_result($consulta_vales_perdida,"total"),2);

    //Consulta necesaria para crear vales en hidden
    $consulta_ven_cab = "SELECT * FROM VEN_CAB with (nolock) where ID = '$id_valep'";
    $result_query_cab = odbc_exec($db_empresa, $consulta_ven_cab);
    
    $serie_with0 = trim(odbc_result($result_query_cab,"NUMERO"));

    }
?>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <link rel="stylesheet" href="../ws-admin/css/estilos_solicitud.css">
        <!--Import Google Icon Font-->
        <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <!--Import materialize.css-->
        <link type="text/css" rel="stylesheet" href="../ws-admin/css/materialize.css"  media="screen,projection"/>
        <link rel="stylesheet" href="../ws-admin/css/bootstrap.css">
	<link rel="shortcut icon" href="../ws-admin/img/favicon.ico">
        <link href='../ws-admin/css/roboto.css' rel='stylesheet' type='text/css'>
        <script src="sweetalert-master/dist/sweetalert.min.js"></script>
        <link rel="stylesheet" type="text/css" href="sweetalert-master/dist/sweetalert.css">
        <script src="../ws-admin/js/jquery-latest.js"></script>
        
        <!-- Librerias datepicker Boostrap3-->
        <link href="../libs/bootstrap-datepicker-1.6.4/css/bootstrap-datepicker3.css" rel="stylesheet">
        <script src="../libs/bootstrap-datepicker-1.6.4/js/bootstrap-datepicker.js"></script>
        <script src="../libs/bootstrap-datepicker-1.6.4/locales/bootstrap-datepicker.es.min.js"></script>
        <script type="text/javascript" src="../ws-admin/js/myJS.js"></script>  <!-- JS datepicker Boostrap3-->
        
        <script type="text/javascript" src="functions.js"></script>
        
	<title>Edición: Solicitud de vales por perdida</title>
	
</head>
<body oncontextmenu="return true">
	<div class="contenedor-formulario">
		<div class="wrap">
                            <div class="txtcentro">
                                    <h5>VALE POR PÉRDIDA</h5>
                                    <h6>COD. <?php echo $cod_reporte ?></h6>
                            </div>
                    
                    <form action="actualiza_valep.php" class="formulario" name="formulario_registro" method="POST" onsubmit= "return validar_formulario_valesArobados()">
                        <input type="hidden"  id="cod_valep_edit" name="cod_valep_edit" value="<?php echo $cod_reporte ?>">
                                <div class="centrado">
	           		   	<img class="logo" src="../ws-admin/img/logo.png" alt="Logo">
                    		</div>
                    
                                <div class="txtcentro">
                                    <label> Unicamente los campos de porcentaje son editables, tenga en cuenta la siguiente nota del solicitante:</label><br>
                                    <label class="blink_me"> <?php echo $comentario_editavalep?>.</label>
                                </div>
                            
                                
            <!--SECCION INFO PERSONAL-->                
                                <div class="txtseccion">
                                    <label class="etique"> INFORMACIÓN DEL SOLICITANTE</label>
                                </div>
                                <div  id="bloque">   
                                <div class="input-group anchototal">
                                    <label class="label">Empresa: <em class="em">*</em></label>
                                    <input type="text" id="select_empresaa" name="select_empresaa" value="<?php echo $cod_empresa_edita?>" readonly required>
                                </div>
                                </div>
            
                                <div  id="bloque">   
                                <div class="input-group bloquede3-1">
                                    <label class="label">CI del Solicitante: <em class="em">*</em></label>
                                    <input type="text" id="txt_cisolicitante" name="txt_cisolicitante" onkeyup="ajaxvalidacod()" value="<?php echo $ci_edita_valep?>" maxlength="10" readonly required>
                                </div> 
                                
                                <div class="input-group bloquede3-2">
                                    <label class="label">Solicitante:</label>
                                    <input type="text" id="txt_solicitante_name" name="txt_solicitante_name" value="<?php echo $solicitante_pdf?>" readonly>
                                </div>
                                
                                    
                                <div class="input-group bloquede3-3">
                                    <label class="label">Empresa/Bodega:</label>
                                    <input type="text" id="txt_empresa" name="txt_empresa" value="<?php echo $empresa_pdf?>" readonly >
                                    <input type="hidden"  id="cod_txt_empresa" name="cod_txt_empresa">
                                    <input type="hidden"  id="cod_txt_cliente" name="cod_txt_cliente">
                                    
                                    <input type="hidden"  id="serie_with0_edita" name="serie_with0_edita" value="<?php echo $serie_with0?>">
                                    <input type="hidden"  id="fecha_soli_edita" name="fecha_soli_edita" value="<?php echo $fechavalep?>">
                                    <input type="hidden"  id="fechaINIPagos_edita" name="fechaINIPagos_edita" value="<?php echo $fechaPagos?>">
                                    <input type="hidden"  id="numcuotas_edita" name="numcuotas_edita" value="<?php echo $numpagos?>">
                                </div>  
                                    
                                </div>    
            
            <!--SECCION DETALLE-->                     
                                <div class="txtseccion">
                                    <label class="etique"> DETALLE</label>
                                </div>
            
                                <div id="bloque">
                                </div>
            
                                <!-- Contenedor de Controles ajax-->
                                <?php
                                        $consulta_ven_mov = "SELECT * FROM VEN_MOV with (nolock) where ID = '$id_valep'";
                                        $result_query = odbc_exec($db_empresa, $consulta_ven_mov);
                                        $count_result = odbc_num_rows($result_query);

                                        while (odbc_fetch_row($result_query)) {
                                            //RECUPERAR DATOS
                                            $cod_producto = odbc_result($result_query, "CODIGO"); //Char(20)
                                            $detall_producto = "Sin detalle";
                                            $cantidad_producto = round(odbc_result($result_query, "CANTIDAD"), 0); //float
                                            $descuporcent_producto = round(odbc_result($result_query, "DESCU"), 2); //numeric (18,6)
                                            $precio_producto = round(odbc_result($result_query, "PRECIO"), 2); //numeric (18,6)
                                            $total_producto = round(odbc_result($result_query, "PRECIOTOT"), 2); ////money


                                            $consulta_sql = "SELECT Codigo, Nombre, PrecA FROM dbo.INV_ARTICULOS WHERE Codigo='$cod_producto'";
                                            $result_query_sql = odbc_exec($db_empresa, $consulta_sql);
                                            $product_nombre = iconv("iso-8859-1", "UTF-8", odbc_result($result_query_sql, "Nombre"));

                                            echo ' 
                                                    <div id="bloque" name="row_productos[]">
                                                    <div class="input-group cod_p">
                                                        <label class="label">Código: <em class="em">*</em></label>
                                                        <input type="text" value="' . rtrim($cod_producto, " ") . '" class="centrado rowproducto" name="txt_cod_product[]" readonly>
                                                    </div>
                                                     <div class="input-group cod_detalle">
                                                        <label class="label">Producto:</label>
                                                        <input type="text" value="' . trim($product_nombre, " ") . '" class="centrado" name="txt_detalle_product[]" readonly>
                                                     </div>

                                                     <div class="input-group cod_cantidad">
                                                        <label class="label">Cantidad: <em class="em">*</em></label>
                                                        <input type="number" value="' . $cantidad_producto . '" class="centrado rowcantidad" name="txt_cant_product[]" readonly>
                                                     </div>
                                                     
                                                    <div class="input-group cod_descuento">
                                                        <label class="label">% Descuento:</label>
                                                        <input type="number" value="'.$descuporcent_producto.'" class="centrado rowdescuento" name="txt_descuento[]" onkeyup="ajaxEditaDescuento(this);calcular_total();valor_porcentaje()" onclick="ajaxEditaDescuento(this);calcular_total();valor_porcentaje()" onblur="calcular_total();valor_porcentaje()" value="0">
                                                    </div>

                                                     <div class="input-group cod_precio">
                                                        <label class="label">Precio:</label>
                                                        <input type="text" value="' . $total_producto . '" class="centrado importe_linea" name="txt_precio_product[]" readonly>
                                                        <input type="hidden" value="' . $precio_producto . '" name="hidden_precio_product[]">
                                                     </div>

                                                </div>
                                                    ';
                                        }
                                        ?>
                               
                               
                               
                                <div id="bloque" class="derechasub">
                                <div class="input-group inputnoinline">
                                    <label class="label">Subtotal:</label>
                                    <input type="text" class="centrado subtotales" id="txt_subtotal" name="txt_subtotal" value="<?php echo $subtotal?>" readonly required="true">
                                </div>
                                <div class="input-group inputnoinline">   
                                    <label class="label">IVA:</label>
                                    <input type="text" class="centrado subtotales" id="txt_iva" name="txt_iva" value="<?php echo $iva?>" readonly required="true">
                                </div>
                                <div class="input-group inputnoinline">     
                                    <label class="label">Total:</label>
                                    <input type="text" class="centrado subtotales" id="txt_total"  value="<?php echo $total?>" name="txt_total" readonly required="true">
                                </div> 
                                </div>
                                
            <!--SECCION RECARGO-->                       
                                <div class="txtseccion">
                                    <label class="etique">RECARGO</label>
                                </div>
                               
                                <div id="bloque" name="row_empleados[]">
                                    <?php
                                        $sql_recargo_valep = "SELECT A.NOMBRE as empleadoN, B.empresa ,B.ci_empleado_rec, B.cod_winf_rec, B.porcentaje, B.valor FROM COB_CLIENTES as A with (nolock) INNER JOIN KAO_wssp.dbo.recargo_valep as B on A.RUC COLLATE Modern_Spanish_CI_AS = B.ci_empleado_rec COLLATE Modern_Spanish_CI_AS WHERE cod_recargo_valep = '$id_valep' and B.empresa='$cod_empresa_edita'";
                                        $consulta_recargo_valep = odbc_exec($db_empresa, $sql_recargo_valep);

                                        while (odbc_fetch_row($consulta_recargo_valep)) {

                                        $ci_empleado_valep = trim(odbc_result($consulta_recargo_valep,"ci_empleado_rec"));
                                        $cod_empleado_winFenix = trim(odbc_result($consulta_recargo_valep,"cod_winf_rec"));
                                        $nombre_emp_valep = trim(iconv("iso-8859-1", "UTF-8",odbc_result($consulta_recargo_valep,"empleadoN")));  
                                        $porcentaje_emp = trim(odbc_result($consulta_recargo_valep,"porcentaje")); 
                                        $valor_emp = trim(odbc_result($consulta_recargo_valep,"valor")); 
                                        
                                        echo ' 
                                            <div id="bloque" name="row_empleados[]">
                                            <div class="input-group recargo_ci">
                                                <label class="label">Cédula: <em class="em">*</em></label>
                                                <input type="text" class="centrado rowempleado" onkeyup="ajaxvalidaemp(this);valor_porcentaje()" value="'.$ci_empleado_valep.'" name="txt_ci_empleado[]" id="txt_ci_empleado[]" readonly required>
                                            </div>
                                             <div class="input-group recargo_empleado">
                                                <label class="label">Empleado:</label>
                                                <input type="text" class="centrado row_deusuario" value="'.$nombre_emp_valep.'" name="txt_nombre_emp[]" readonly>
                                                <input type="hidden" name="txt_hiddenwinf_emp[]" value="'.$cod_empleado_winFenix.'">
                                             </div>

                                             <div class="input-group recargo_porcent">
                                                <label class="label">%: <em class="em">*</em></label>
                                                <input type="text" class="centrado valporcent" value="'.$porcentaje_emp.'" name="txt_porcent_emp[]" onkeyup="valor_porcentaje_manual()" onchange="valida_porcentaje_manual();" value="0" min="0" max="100" required>
                                             </div>
                                             <div class="input-group recargo_valor">
                                                <label class="label">Valor:</label>
                                                <input type="text" class="centrado importe_linea_emp" value="'.$valor_emp.'" name="txt_valor_emp[]" value="0" readonly>
                                                <input type="hidden" name="hidden_valor_emp[]">
                                             </div>
                                             </div>';
                                        }
                                    ?>
                                </div>
            
                                <!-- Contenedor de Controles ajax-->
                                <div class="result_emp_add"></div>
                               
                                <!--SECCION DETALLE-->                     
                                <div class="txtseccion">
                                    <label class="etique"> COMENTARIO / OBSERVACION</label>
                                </div>
                                 
                                 <div id="bloque" class="input-group">
                                     <textarea class="cajaarea blink_me" name="txt_comentario" rows="3" cols="100%" maxlength="180" readonly><?php echo $comentario_editavalep?></textarea>
                                     
                                 </div>         

		                <div>
                                    <input name="guardar" type="submit" id="btn-submit" value="Actualizar y Aprobar Vale">
				</div>
				
                                <div class="footer">Todos los derechos reservados © 2016 - <?php echo date('Y');?>, Ver 2.0.0</div>
                    </form>
                </div>
	</div>
    
         <!-- Floating Button Google-->
        <div class="fixed-action-btn">
            <a class="btn-floating btn-large red">
              <i class="large material-icons">mode_edit</i>
            </a>
            <ul>
              <li><a class="btn-floating blue" onclick="add_row_emp_EDITA()" title="Agregar Empleado"><i class="material-icons">perm_identity</i></a></li>
             </ul>
          </div>
	<!-- USO JQUERY, animacion de menu para responsive-->
        
        <script type="text/javascript" src="../ws-admin/js/materialize.js"></script>
        <script src="../ws-admin/js/bootstrap.js"></script>
      
</body>
</html>