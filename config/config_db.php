<?php
$array_db = array(
    'dsn'=>"",  //Unicamente necesario en conexiones ODBC
    'driver'=>"mysql",  //Driver de tipo de DB a conectar
    'host'=>"127.0.0.1",  //Local host o IP del servidor
    'port'=>"3306",  //Puerto predeterminado 80, 8080 o 3006
    'user'=>"root",     //Usuario con permisos a la DB
    'password'=>"", //Contraseña del usuario
    'dbName'=>"",   //Nombre de la base de datos
    'charset'=>"utf8"  //Codificación de la base de datos
    );

return $array_db;
