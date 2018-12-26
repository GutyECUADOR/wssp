<?php
include('acceso_db.php');
//TABULACIONES

$result_preguntaA=mysql_query("select preguntaA,count(*) as resultadoA from tbl_regencuesta WHERE fecha Between '$fecha_INI' and '$fecha_FIN' and local='$local_FILTRO' group by preguntaA");

$orden_preguntaA = mysql_query("select preguntaA,count(*) as resultadoA from tbl_regencuesta group by preguntaA");
$orden_preguntaB = mysql_query("select preguntaB,count(*) as resultadoB from tbl_regencuesta group by preguntaB");
$orden_preguntaC = mysql_query("select preguntaC,count(*) as resultadoC from tbl_regencuesta group by preguntaC");
$orden_preguntaD = mysql_query("select preguntaD,count(*) as resultadoD from tbl_regencuesta group by preguntaD");
$orden_preguntaE = mysql_query("select preguntaE,count(*) as resultadoE from tbl_regencuesta group by preguntaE");
$orden_preguntaF = mysql_query("select preguntaF,count(*) as resultadoF from tbl_regencuesta group by preguntaF");
$orden_preguntaG = mysql_query("select preguntaG,count(*) as resultadoG from tbl_regencuesta group by preguntaG");
$orden_preguntaH = mysql_query("select preguntaH,count(*) as resultadoH from tbl_regencuesta group by preguntaH");
$orden_preguntaI = mysql_query("select preguntaI,count(*) as resultadoI from tbl_regencuesta group by preguntaI");

