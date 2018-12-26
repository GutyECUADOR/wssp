
<header>
        <div class="wrapper">
                <nav class="navizq">
                    <a href="#" class="btn_menu"><span class="icon-indent-decrease icon-large linksnav"></span></a>
                </nav>
                <div class="logocontainer">
                    <a href="#" target="_top"><img class="logo" src="../ws-admin/img/logo.png" alt="Logo Sistema"></a>
                </div>
                <nav>
                    <?php
                  
                    $consulta_headermenu = "SELECT * FROM confheadermenu ORDER BY menu_id ASC";
                    $result_query_headermenu = odbc_exec($conexion, $consulta_headermenu);


                    while(odbc_fetch_row($result_query_headermenu))
                    {
                        $url = iconv("iso-8859-1", "UTF-8", odbc_result($result_query_headermenu,"url_menu"));
                        $text_menu = iconv("iso-8859-1", "UTF-8", odbc_result($result_query_headermenu,"nombre_menu"));
                        $clases = iconv("iso-8859-1", "UTF-8", odbc_result($result_query_headermenu,"clases_menu"));  
                        $clases_text = iconv("iso-8859-1", "UTF-8", odbc_result($result_query_headermenu,"clases_textmenu"));    

                        echo '<a href="'.$url.'"><span class="'.$clases.'"><span class="'.$clases_text.'">'.$text_menu.'</span></span></a>';
                    }?>
                </nav>
        </div>
</header>

