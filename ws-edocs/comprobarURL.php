<?php
function URLcomp()
{
     $nombre_fichero = 'docwf/ride/RIDE_1805201501179219085100120100050000027061234567817.pdf';
        if (file_exists($nombre_fichero)) {
            echo '<script language="javascript">';
            echo 'alert("El fichero: '.$nombre_fichero.' existe")';
            echo '</script>';
        } else {
            echo '<script language="javascript">';
            echo 'alert("El fichero '.$nombre_fichero.' se encuentra en proceso de autorizacion del SRI")';
            echo '</script>';
        }  
}
       