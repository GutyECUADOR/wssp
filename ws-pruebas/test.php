<?php
date_default_timezone_set('America/Bogota');
include('../ws-admin/funciones.php'); // Acceso a funciones utiles

$fechaActual = getDateNow();
$fechainicio = first_month_day_anterior();
$fechafinal = last_month_day_anterior();

$codigoROL = first_month_day_codROLWinfenix();

echo $fechaActual . "</br>";
echo $fechainicio . "</br>";
echo $fechafinal . "</br>";

echo $codigoROL . "</br>";