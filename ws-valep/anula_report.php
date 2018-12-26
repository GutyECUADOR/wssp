<?php
include_once ('../ws-admin/acceso_multi_db.php');
$conexion_vales = getDataBase(008); //Cod 008 Empresa MODELO

$documento_id = $_POST['doc_id'];

    $consulta_ven_mov = "UPDATE KAO_wssp.dbo.vales_perdida SET estado = 2 WHERE cod_valep = '$documento_id'";
    $result_query = odbc_exec($conexion_vales, $consulta_ven_mov);
   
    
       