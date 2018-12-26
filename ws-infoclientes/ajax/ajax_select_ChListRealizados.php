<?php
require_once '../ws-admin/acceso_multi_db.php';

        $CI_sueprvisor = $_GET['cod_WF'];
        $db_empresa = getDataBase('009'); 
        $query = "SELECT TOP 1  * FROM dbo.chlist_locales WHERE supervisor = '$CI_sueprvisor' ORDER BY id DESC";
        $resultset = odbc_exec($db_empresa, $query);
        $count_result = odbc_num_rows($resultset);
        if ($count_result>=1){
            echo "<option value=''>---SELECCIONE POR FAVOR---</option>";
            while(odbc_fetch_row($resultset))
            {
                $id_chlocal = trim(odbc_result($resultset,"id"));
                $cod_empresa = trim(odbc_result($resultset,"empresa"));
                $cod_local = trim(odbc_result($resultset,"local"));
                $cod_supervisor = trim(odbc_result($resultset,"supervisor"));
                $fecha = trim(odbc_result($resultset,"fecha"));
               
                echo "<option value='$id_chlocal'>Fecha: $fecha, Empresa: $cod_empresa, Local: $cod_local, Realizado por: $cod_supervisor  </option>";
                   
            }
                }else
            {
                 echo '<select type="text" id="cod_txt_empresa" name="cod_txt_empresa" required>';
                 echo "<option value=''>---SELECCIONE POR FAVOR---</option>";
                 echo '</select>';
            }




