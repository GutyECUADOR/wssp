<?php

include('acceso_db.php');
$tacceso = $_SESSION['user_lv']; //Tipo acceso segun usuario 

switch ($tacceso) {
    case 99: //Administradores
        $consulta_leftmenu = "SELECT * FROM confmenuleft with (nolock) ORDER BY menu_id ASC";
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
        $consulta_leftmenu = "SELECT * FROM confmenuleft with (nolock) WHERE menu_id IN(1,3,4,5,6,10)ORDER BY menu_id ASC";
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
        $consulta_leftmenu = "SELECT * FROM confmenuleft with (nolock) WHERE menu_id IN(1,3,4,5,6,10)ORDER BY menu_id ASC";
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
        $consulta_leftmenu = "SELECT * FROM confmenuleft with (nolock) WHERE menu_id IN(2,6,10)ORDER BY menu_id ASC";
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
        $consulta_leftmenu = "SELECT * FROM confmenuleft with (nolock) WHERE menu_id IN(1,4,5,6,10)ORDER BY menu_id ASC";
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
        $consulta_leftmenu = "SELECT * FROM confmenuleft with (nolock) WHERE menu_id IN(1,3,5,10)ORDER BY menu_id ASC";
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