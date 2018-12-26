<?php
include('../ws-admin/acceso_db_sbio.php');

$cod_ingresado = $_GET['post_cod_usr'];
$cod_empleado = $_GET['ci_usu'];

if (empty($cod_ingresado)){
        echo '
            <div class="alert alert-danger alert-dismissable">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <p> Codigo en blanco, ingrese su clave.</p>
            <input type="hidden" name="cod_veri" id="cod_veri" value="">
            </div> ';
     
}else{
    
    $consulta_pass = "SELECT * FROM dbo.Empleados with (nolock) WHERE Cedula='$cod_empleado' AND Clave = '$cod_ingresado'";
        $result_query_pass = odbc_exec($conexion_sbio, $consulta_pass);
        $rows = odbc_num_rows($result_query_pass);
        if ($rows>=1){
            $rawdata = array(["estatus"=>true,"mensaje"=>"Codigo de segudidad aceptado"]);
            echo json_encode($rawdata); 
         
            /*
            echo '
            <div class="alert alert-success alert-dismissable">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <p> Su código de seguridad fue aceptado.</p>
            <input type="hidden" name="cod_veri" id="cod_veri" value="1">
            </div> ';*/
        }
            else
            {
            $rawdata = array(["estatus"=>false,"mensaje"=>"Codigo de seguridad no valido"]);
            echo json_encode($rawdata); 

                /*
            echo '
             ';*/
            }
            
}


