<?php
date_default_timezone_set('America/Bogota');

/** Actual month first day **/
  function porcentaje_de($int_valor, $int_porcent) {
      $porcent = round(($int_valor * 100)/$int_porcent,2); 
      return $porcent;
  }

function getDateNow() { 
      return date('Y-m-d');
  }
   
function check_in_range($start_date, $end_date, $evaluame) {
    $start_ts = strtotime($start_date);
    $end_ts = strtotime($end_date);
    $user_ts = strtotime($evaluame);
    return (($user_ts >= $start_ts) && ($user_ts <= $end_ts));
    }
    
function ultimo_dia_vales(){
    $year = date('Y');
    $month = date('m');
    $day = 12;
    return date('Y-m-d', mktime(0,0,0, $month, $day, $year));
}  
  
function getDiaText($fechaActual){
    $dias = array('Lunes','Martes','Miercoles','Jueves','Viernes','Sabado','Domingo');
    $fechaDia = $dias[date('N', strtotime($fechaActual))-1];
    return $fechaDia;
}  
  
  
function last_month_day() { 
      $month = date('m');
      $year = date('Y');
      $day = date("d", mktime(0,0,0, $month+1, 0, $year));
 
      return date('Y-m-d', mktime(0,0,0, $month, $day, $year));
}


  /** Actual month first day **/
function first_month_day() {
      $month = date('m');
      $year = date('Y');
      return date('Y-m-d', mktime(0,0,0, $month, 1, $year));
}

/* Funcion determina el dia maximo que esta disponible el modulo de wssp-evaluaeg*/ 

function ultimo_dia_EJI(){
    $year = date('Y');
    $month = date('m');
    $day =9;
    return date('Y-m-d', mktime(0,0,0, $month, $day, $year));
}  

/* Primer dia del mes anterior*/

function first_month_day_anterior() {
    $month = date('m');
    $year = date('Y');
    return date('Y-m-d', mktime(0,0,0, $month-1, 1, $year));
}

function first_month_day_codROLWinfenix() {
    $month = date('m');
    $year = date('Y');
    return date('Y.m.d', mktime(0,0,0, $month-1, 1, $year));
}

/* Ultimo dia del mes anterior*/
 
function last_month_day_anterior() { 
  
    return date('Y-m-d', strtotime('last day of previous month'));
}

function ini_anterior_week(){
    $year = date('Y');
    $month = date('m')-1;
    $day = 23;
    return date('Y-m-d', mktime(0,0,0, $month, $day, $year));
}

function fin_anterior_week(){
     $month = date('m')-1;
      $year = date('Y');
      $day = date("d", mktime(0,0,0, $month+1, 0, $year));
 
      return date('Y-m-d', mktime(0,0,0, $month, $day, $year));
}
  
  
  
function ini_second_week(){
    $year = date('Y');
    $month = date('m');
    $day = 9;
    return date('Y-m-d', mktime(0,0,0, $month, $day, $year));
}

function ini_third_week(){
    $year = date('Y');
    $month = date('m');
    $day = 16;
    return date('Y-m-d', mktime(0,0,0, $month, $day, $year));
}

function ini_fourth_week(){
    $year = date('Y');
    $month = date('m');
    $day = 23;
    return date('Y-m-d', mktime(0,0,0, $month, $day, $year));
}


  
function end_first_week(){
    $year = date('Y');
    $month = date('m');
    $day = 8;
    return date('Y-m-d', mktime(0,0,0, $month, $day, $year));
}

function end_second_week(){
    $year = date('Y');
    $month = date('m');
    $day = 15;
    return date('Y-m-d', mktime(0,0,0, $month, $day, $year));
}

function end_third_week(){
    $year = date('Y');
    $month = date('m');
    $day = 22;
    return date('Y-m-d', mktime(0,0,0, $month, $day, $year));
}
