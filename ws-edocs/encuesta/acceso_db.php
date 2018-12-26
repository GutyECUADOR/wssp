<?php
$conexion = mysql_connect("localhost","kaosport","ksc2015$")or die ("Problemas en la conexion de servidor");
$db = mysql_select_db("kaosport_kindred",$conexion)or die ("Problemas al conectar con la base de datos");

?>