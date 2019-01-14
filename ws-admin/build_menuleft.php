<?php

if(file_exists('../ws-admin/configuraciones.xml') && $configXML = simplexml_load_file('../ws-admin/configuraciones.xml')){
    
   
}else{
    die ('Error no se pudo cargar el archivo de configuraciones XML, informe a sistemas.');
}



include('acceso_db.php');
$tacceso = $_SESSION['user_lv']; //Tipo acceso segun usuario 

switch ($tacceso) {
    case 99: //Administradores
        $modulos = $configXML->permisosUsuarios->ADM;
        $arrayIndices = array();

        foreach ($modulos[0] as $modulo) {
            if((string) $modulo['isActivo']=='true'){
                $idDB =  (string) $modulo['idDB'];
                if ($idDB != 0 && $idDB != ''){
                    array_push($arrayIndices, $idDB);
                }
            }
        }  

        $consulta_leftmenu = "SELECT * FROM confmenuleft with (nolock) WHERE menu_id IN (".implode(',',$arrayIndices).") ORDER BY menu_id ASC";
        $result_query_leftmenu = odbc_exec($conexion, $consulta_leftmenu);

        while (odbc_fetch_row($result_query_leftmenu)) {
            $url = iconv("iso-8859-1", "UTF-8", odbc_result($result_query_leftmenu, "url_menu"));
            $text_menu = iconv("iso-8859-1", "UTF-8", odbc_result($result_query_leftmenu, "nombre_menu"));
            $clases = iconv("iso-8859-1", "UTF-8", odbc_result($result_query_leftmenu, "clases_menu"));
            $clases_text = iconv("iso-8859-1", "UTF-8", odbc_result($result_query_leftmenu, "clases_textmenu"));

            echo '<li><a href="' . $url . '"><span class="' . $clases . '"><span class="' . $clases_text . '">' . $text_menu . '</span></span></a></li>';
        }
        break;

    case 1: //Supervisores

        $modulos = $configXML->permisosUsuarios->SUP;
        $arrayIndices = array();

        foreach ($modulos[0] as $modulo) {
            if((string) $modulo['isActivo']=='true'){
                $idDB =  (string) $modulo['idDB'];
                if ($idDB != 0 && $idDB != ''){
                    array_push($arrayIndices, $idDB);
                }
            }
        }  

        $consulta_leftmenu = "SELECT * FROM confmenuleft with (nolock) WHERE menu_id IN (".implode(',',$arrayIndices).")  ORDER BY menu_id ASC";
        $result_query_leftmenu = odbc_exec($conexion, $consulta_leftmenu);

        while (odbc_fetch_row($result_query_leftmenu)) {
            $url = iconv("iso-8859-1", "UTF-8", odbc_result($result_query_leftmenu, "url_menu"));
            $text_menu = iconv("iso-8859-1", "UTF-8", odbc_result($result_query_leftmenu, "nombre_menu"));
            $clases = iconv("iso-8859-1", "UTF-8", odbc_result($result_query_leftmenu, "clases_menu"));
            $clases_text = iconv("iso-8859-1", "UTF-8", odbc_result($result_query_leftmenu, "clases_textmenu"));

            echo '<li><a href="' . $url . '"><span class="' . $clases . '"><span class="' . $clases_text . '">' . $text_menu . '</span></span></a></li>';
        }
        break;
        
    case 5: //Super Supervisores

        $modulos = $configXML->permisosUsuarios->SSP;
        $arrayIndices = array();

        foreach ($modulos[0] as $modulo) {
            if((string) $modulo['isActivo']=='true'){
                $idDB =  (string) $modulo['idDB'];
                if ($idDB != 0 && $idDB != ''){
                    array_push($arrayIndices, $idDB);
                }
            }
        }  

        $consulta_leftmenu = "SELECT * FROM confmenuleft with (nolock) WHERE menu_id IN (".implode(',',$arrayIndices).")  ORDER BY menu_id ASC";
        $result_query_leftmenu = odbc_exec($conexion, $consulta_leftmenu);

        while (odbc_fetch_row($result_query_leftmenu)) {
            $url = iconv("iso-8859-1", "UTF-8", odbc_result($result_query_leftmenu, "url_menu"));
            $text_menu = iconv("iso-8859-1", "UTF-8", odbc_result($result_query_leftmenu, "nombre_menu"));
            $clases = iconv("iso-8859-1", "UTF-8", odbc_result($result_query_leftmenu, "clases_menu"));
            $clases_text = iconv("iso-8859-1", "UTF-8", odbc_result($result_query_leftmenu, "clases_textmenu"));

            echo '<li><a href="' . $url . '"><span class="' . $clases . '"><span class="' . $clases_text . '">' . $text_menu . '</span></span></a></li>';
        }
        break;    
        
        
    case 6: //VELES POR PERDIDA UNICO USUARIO TIPO VAL (SRA. ELIZABETH)

        $modulos = $configXML->permisosUsuarios->VAL;
        $arrayIndices = array();

        foreach ($modulos[0] as $modulo) {
            if((string) $modulo['isActivo']=='true'){
                $idDB =  (string) $modulo['idDB'];
                if ($idDB != 0 && $idDB != ''){
                    array_push($arrayIndices, $idDB);
                }
            }
        }  

        $consulta_leftmenu = "SELECT * FROM confmenuleft with (nolock) WHERE menu_id IN (".implode(',',$arrayIndices).") ORDER BY menu_id ASC";
        $result_query_leftmenu = odbc_exec($conexion, $consulta_leftmenu);

        while (odbc_fetch_row($result_query_leftmenu)) {
            $url = iconv("iso-8859-1", "UTF-8", odbc_result($result_query_leftmenu, "url_menu"));
            $text_menu = iconv("iso-8859-1", "UTF-8", odbc_result($result_query_leftmenu, "nombre_menu"));
            $clases = iconv("iso-8859-1", "UTF-8", odbc_result($result_query_leftmenu, "clases_menu"));
            $clases_text = iconv("iso-8859-1", "UTF-8", odbc_result($result_query_leftmenu, "clases_textmenu"));

            echo '<li><a href="' . $url . '"><span class="' . $clases . '"><span class="' . $clases_text . '">' . $text_menu . '</span></span></a></li>';
        }
        break;    
        
     case 7: // EVALUADORES TIPO DE USUARIO EVA 

        $modulos = $configXML->permisosUsuarios->EVA;
        $arrayIndices = array();

        foreach ($modulos[0] as $modulo) {
            if((string) $modulo['isActivo']=='true'){
                $idDB =  (string) $modulo['idDB'];
                if ($idDB != 0 && $idDB != ''){
                    array_push($arrayIndices, $idDB);
                }
            }
        }  

        $consulta_leftmenu = "SELECT * FROM confmenuleft with (nolock) WHERE menu_id IN (".implode(',',$arrayIndices).") ORDER BY menu_id ASC";
        $result_query_leftmenu = odbc_exec($conexion, $consulta_leftmenu);

        while (odbc_fetch_row($result_query_leftmenu)) {
            $url = iconv("iso-8859-1", "UTF-8", odbc_result($result_query_leftmenu, "url_menu"));
            $text_menu = iconv("iso-8859-1", "UTF-8", odbc_result($result_query_leftmenu, "nombre_menu"));
            $clases = iconv("iso-8859-1", "UTF-8", odbc_result($result_query_leftmenu, "clases_menu"));
            $clases_text = iconv("iso-8859-1", "UTF-8", odbc_result($result_query_leftmenu, "clases_textmenu"));

            echo '<li><a href="' . $url . '"><span class="' . $clases . '"><span class="' . $clases_text . '">' . $text_menu . '</span></span></a></li>';
        }
        break;        
        
    case 2: //Asistentes 

        $modulos = $configXML->permisosUsuarios->ASI;
        $arrayIndices = array();

        foreach ($modulos[0] as $modulo) {
            if((string) $modulo['isActivo']=='true'){
                $idDB =  (string) $modulo['idDB'];
                if ($idDB != 0 && $idDB != ''){
                    array_push($arrayIndices, $idDB);
                }
            }
        }  

        $consulta_leftmenu = "SELECT * FROM confmenuleft with (nolock) WHERE menu_id IN (".implode(',',$arrayIndices).") ORDER BY menu_id ASC";
        $result_query_leftmenu = odbc_exec($conexion, $consulta_leftmenu);

        while (odbc_fetch_row($result_query_leftmenu)) {
            $url = iconv("iso-8859-1", "UTF-8", odbc_result($result_query_leftmenu, "url_menu"));
            $text_menu = iconv("iso-8859-1", "UTF-8", odbc_result($result_query_leftmenu, "nombre_menu"));
            $clases = iconv("iso-8859-1", "UTF-8", odbc_result($result_query_leftmenu, "clases_menu"));
            $clases_text = iconv("iso-8859-1", "UTF-8", odbc_result($result_query_leftmenu, "clases_textmenu"));

            echo '<li><a href="' . $url . '"><span class="' . $clases . '"><span class="' . $clases_text . '">' . $text_menu . '</span></span></a></li>';
        }
    break;    
        

    default :
        $consulta_leftmenu = "SELECT * FROM confmenuleft with (nolock) WHERE (nv_acceso='0') ORDER BY menu_id ASC";
        $result_query_leftmenu = odbc_exec($conexion, $consulta_leftmenu);

        while (odbc_fetch_row($result_query_leftmenu)) {
            $url = iconv("iso-8859-1", "UTF-8", odbc_result($result_query_leftmenu, "url_menu"));
            $text_menu = iconv("iso-8859-1", "UTF-8", odbc_result($result_query_leftmenu, "nombre_menu"));
            $clases = iconv("iso-8859-1", "UTF-8", odbc_result($result_query_leftmenu, "clases_menu"));
            $clases_text = iconv("iso-8859-1", "UTF-8", odbc_result($result_query_leftmenu, "clases_textmenu"));

            echo '<li><a href="' . $url . '"><span class="' . $clases . '"><span class="' . $clases_text . '">' . $text_menu . '</span></span></a></li>';
        }
        break;
}    