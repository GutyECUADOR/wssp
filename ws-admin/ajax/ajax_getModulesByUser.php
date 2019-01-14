<?php
$tipoUser = $_GET['tipoUser'];

if(file_exists('../../ws-admin/configuraciones.xml') && $configXML = simplexml_load_file('../../ws-admin/configuraciones.xml')){
    $modulos = $configXML->permisosUsuarios->$tipoUser;
}else{
    die ('Error no se pudo cargar el archivo de configuraciones XML, informe a sistemas.');
}

if ($tipoUser != '' && $modulos != '' ){

    foreach ($modulos[0] as $modulo) {
        $ischecked =  $modulo['isActivo'];
        if($ischecked==true){
            $ischeckedValue = 'checked';
        }else{
            $ischeckedValue = '';
        }
           
        echo'
         <div class="form-check form-check-inline">
         <input class="form-check-input checkmodulo" type="checkbox" '.$ischeckedValue.' id="'.$modulo['name'].'" value="'.$modulo.'">
         <label class="form-check-label fonts14" for="'.$modulo.'">'.$modulo.'</label>
         </div>
         ';
    }
    
}



