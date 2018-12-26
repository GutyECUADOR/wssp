<?php

$dateadd = date_create('2017-10-14'); // ingrese fecha actual 
$dateadd30mas = date_format(date_add($dateadd, date_interval_create_from_date_string('30 days')), 'Ymd'); // Agregara X dias y devuelve formado Y-m-d
echo "La nueva fecha es: " . $dateadd30mas;

/**
$sprep_cod = odbc_exec($db_empresa, "select RIGHT('00' + Ltrim(Rtrim($int_spvale)),2) as newcod");
$cod_sp_with0vale = odbc_result($sprep_cod, 1);  //Recuperamos nuevo codigo con formato 0000000X
 
 **/
 /*
$fecha = DateTime::createFromFormat('Y-m-d', '2017-06-14');
echo $fecha;
 
  */