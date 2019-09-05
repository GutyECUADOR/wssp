<?php
require_once '../ws-admin/acceso_multi_db.php';

    function getSelectEmpresasWF(){
        $db_empresa = getDataBase('010'); //Conexion con SBIO para nombres de empresas
        $consulta_empresa = "SELECT * FROM dbo.Empresas_WF with (nolock) ORDER BY Codigo";

        $result_query_empresa = odbc_exec($db_empresa, $consulta_empresa);

        while(odbc_fetch_row($result_query_empresa))
        {
        $cod_emp = odbc_result($result_query_empresa,"Codigo"); 
        $detalle_emp = odbc_result($result_query_empresa,"Nombre"); 

        echo "<option value='$cod_emp'>$detalle_emp</option>";
        }
    }

    function getChlocalesBySupervisor($CI_sueprvisor){
        $db_empresa = getDataBase('009'); //Conexion con SBIO para nombres de empresas
        $query = "SELECT * FROM dbo.chlist_locales WHERE supervisor = '$CI_sueprvisor'";
        $resultset = odbc_exec($db_empresa, $query);
        $count_result = odbc_num_rows($resultset);
        if ($count_result>=1){
            
            while(odbc_fetch_row($resultset))
            {
                $id_chlocal = trim(odbc_result($resultset,"id"));
                $cod_empresa = trim(odbc_result($resultset,"empresa"));
                $cod_local = trim(odbc_result($resultset,"local"));
                $cod_supervisor = trim(odbc_result($resultset,"supervisor"));
                $fecha = trim(odbc_result($resultset,"fecha"));
               
                echo "<option value='$id_chlocal'>Fecha: $fecha, Empresa: $cod_empresa, Local: $cod_local, Realizado por: $cod_supervisor  </option>";
                   
            }
        }   
    }

    function getDetallesChk($cod_itemINPUT){
        $db_empresa = getDataBase('009'); //009 WSSP DB
        $consulta_detalleschecks = "SELECT codItem, detalle FROM dbo.detalle_chlist WHERE codItem = '$cod_itemINPUT' and estado='TRUE' ORDER BY codItem ASC";
        $result_detalleschecks = odbc_exec($db_empresa, $consulta_detalleschecks);
        $count_result = odbc_num_rows($result_detalleschecks);
        if ($count_result>=1){
            
            while(odbc_fetch_row($result_detalleschecks))
            {
                //RECUPERAR DATOS
                $cod_item = trim(odbc_result($result_detalleschecks,"codItem"));
                //Recodificacion de ISO-8859 a UTF
                $detalle_item = iconv("iso-8859-1", "UTF-8", odbc_result($result_detalleschecks,"detalle"));
                echo '<p>';
                echo '<input type = "checkbox" class = "filled-in" name= "'.$cod_item.'" id ="'.$cod_item.'" value="1" onclick = ""/>';
                echo '<label for = "'.$cod_item.'">'.$detalle_item.'</label>'; 
                echo '</p>';
                }
        }
    }
    
    
     function renderItems(){
        $db_empresa = getDataBase('009'); //009 WSSP DB
        $query = "SELECT codItem, detalle FROM dbo.detalle_anfitriones WHERE estado='TRUE' ORDER BY ID";
        $resultset = odbc_exec($db_empresa, $query);
        $count_result = odbc_num_rows($resultset);
        if ($count_result>=1){
            
            while(odbc_fetch_row($resultset))
            {
                $cod_item = trim(iconv("iso-8859-1", "UTF-8", odbc_result($resultset,"codItem"))); 
                $detalle_item = trim(iconv("iso-8859-1", "UTF-8", odbc_result($resultset,"detalle")));

                echo '<div class="form-group col-lg-12 form-inline right-align">';
                echo '<label for = "'.$cod_item.'">'.$detalle_item.'</label>'; 
                echo '<div class="form-group">
                                <select class="form-control input-sm centertext totalEV" id="'.$cod_item.'" name="'.$cod_item.'">
                                    <option value=""> Seleccione por favor</option>
                                    <option value="4">Muy Bueno</option>
                                    <option value="3">Bueno</option>
                                    <option value="2">Regular</option>
                                    <option value="1">Malo</option>
                                </select>
                     </div>

                    ';
                echo '</div>';
                }
        }
    }
    
    
    
    
     function getSupervisorChk($cod_itemINPUT,$valorchk,$valortxt){
            echo '<div class="row">
             <div class = "col-lg-12">
                   <input type = "checkbox" class = "filled-in" name = "chk_'.$cod_itemINPUT.'" id = "chk_'.$cod_itemINPUT.'" '.isChecked($valorchk).' "/>
                   <label for = "chk_'.$cod_itemINPUT.'">Aprobado por supervisor</label>
            </div>
            <div class = "col-lg-12">
                <textarea class = "cajaarea" name = "obs_SupervChk_'.$cod_itemINPUT.'" id = "obs_SupervChk'.$cod_itemINPUT.'" rows = "3" cols = "100%" maxlength = "100" placeholder = "Observaciones Supervisor">'.$valortxt.'</textarea>
            </div>
            </div>';
}
    
    
    
    function getDetallesWithData($cod_item, $valorchk){
        $db_empresa = getDataBase('009'); //009 WSSP DB
        $consulta_detalleschecks = "SELECT codItem, detalle FROM dbo.detalle_chlist WHERE codItem = '$cod_item' and estado='TRUE' ORDER BY codItem ASC";
        $result_detalleschecks = odbc_exec($db_empresa, $consulta_detalleschecks);
        $count_result = odbc_num_rows($result_detalleschecks);
        if ($count_result>=1){
            
            while(odbc_fetch_row($result_detalleschecks))
            {
                //RECUPERAR DATOS
                $cod_item = trim(odbc_result($result_detalleschecks,"codItem"));
                //Recodificacion de ISO-8859 a UTF
                $detalle_item = iconv("iso-8859-1", "UTF-8", odbc_result($result_detalleschecks,"detalle"));
                echo '<p>';
                echo '<input type = "checkbox" class = "filled-in" name= "'.$cod_item.'" id ="'.$cod_item.'" '.isChecked($valorchk).' onclick = "" disabled/>';
                echo '<label for = "'.$cod_item.'">'.$detalle_item.'</label>'; 
                echo '</p>';
                }
        }
    }

    
    function getChkLocalesSelect(){
        $db_empresa = getDataBase('009'); //Conexion con SBIO para nombres de empresas
        $consulta_getlocales = "SELECT A.empresa, b.NameDatabase, b.Nombre FROM dbo.chlist_locales as A INNER JOIN SBIOKAO.dbo.Empresas_WF as B on A.empresa = B.Codigo GROUP BY A.empresa, B.NameDatabase, b.Nombre ORDER BY empresa ASC";
        $result_getlocales = odbc_exec($db_empresa, $consulta_getlocales);
        $count_result = odbc_num_rows($result_getlocales);
        if ($count_result>=1){
            
            while(odbc_fetch_row($result_getlocales))
            {
                $cod_empresa = trim(odbc_result($result_getlocales,"empresa"));
                $name_empresa = trim(iconv("iso-8859-1", "UTF-8", odbc_result($result_getlocales,"Nombre")));
               
                echo "<option value='$cod_empresa'>$name_empresa</option>";
               
                   
            }
       
            
        }
    }
    
    
    function getEmpresasLocalesSelect(){
        $db_empresa = getDataBase('009'); //Conexion con SBIO para nombres de empresas
        $consulta_getlocales = "SELECT A.empresa, b.NameDatabase, b.Nombre FROM dbo.chlist_locales as A INNER JOIN SBIOKAO.dbo.Empresas_WF as B on A.empresa = B.Codigo GROUP BY A.empresa, B.NameDatabase, b.Nombre ORDER BY empresa ASC";
        $result_getlocales = odbc_exec($db_empresa, $consulta_getlocales);
        $count_result = odbc_num_rows($result_getlocales);
        if ($count_result>=1){
            
             echo "<option value='1711743227'> 1711743227  - Revisados por LUIS CELI</option>";
             echo "<option value='0400882940'> 0400882940  - Revisados por GUSTAVO IMBAQUINGO</option>";
            while(odbc_fetch_row($result_getlocales))
            {
                $cod_empresa = trim(odbc_result($result_getlocales,"empresa"));
                $name_empresa = trim(iconv("iso-8859-1", "UTF-8", odbc_result($result_getlocales,"Nombre")));
                
                echo "<option value='$cod_empresa'>$cod_empresa - $name_empresa</option>";
               
                   
            }
       
            
        }
    }
    
    function getLocalesNames($database,$nombreDB) {
        $db_empresa = getDataBase('009'); //009 WSSP DB
        $consulta_optlocales = "SELECT A.local, B.NOMBRE FROM dbo.chlist_locales AS A INNER JOIN $nombreDB.dbo.INV_BODEGAS as B on A.local COLLATE Modern_Spanish_CI_AS = B.CODIGO COLLATE Modern_Spanish_CI_AS WHERE empresa = '$database' GROUP BY A.local, B.NOMBRE ORDER BY local ASC";
        $result_optlocales = odbc_exec($db_empresa, $consulta_optlocales);
        while(odbc_fetch_row($result_optlocales))
        {
            $cod_localopt = iconv("iso-8859-1", "UTF-8", odbc_result($result_optlocales, "local"));
            $localopt = iconv("iso-8859-1", "UTF-8", odbc_result($result_optlocales, "NOMBRE"));
            echo "<option value='$cod_localopt'>$localopt</option>";
        }
}


    

    function isChecked($checkbox){
        if ($checkbox == "" or $checkbox=="no" or is_null($checkbox)){
            return "";
        }else if ($checkbox=="1" or $checkbox=="true") {
            return "checked";
        }
        
    }