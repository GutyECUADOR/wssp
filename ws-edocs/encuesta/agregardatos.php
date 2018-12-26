<?php
include('acceso_db.php');
$local = $_POST['local'];
$date = $_POST['date'];
$edad = $_POST['edad'];
$preguntaA = $_POST['preguntaA'];
$preguntaB = $_POST['preguntaB'];
$preguntaC = $_POST['preguntaC'];
$preguntaD = $_POST['preguntaD'];
$preguntaE = $_POST['preguntaE'];
$preguntaF = $_POST['preguntaF'];
$preguntaG = $_POST['preguntaG'];
$preguntaH = $_POST['preguntaH'];
$preguntaI = $_POST['preguntaI'];
$comentarios = $_POST['comentarios'];

$sql = mysql_query("INSERT INTO tbl_regencuesta (numencuesta, local, fecha, edad, preguntaA, preguntaB, preguntaC, preguntaD, preguntaE, preguntaF, preguntaG, preguntaH, preguntaI, comentarios) "
        . "VALUES ('null', '$local', '$date', '$edad' , '$preguntaA' , '$preguntaB', '$preguntaC', '$preguntaD', '$preguntaE' , '$preguntaF' , '$preguntaG' , '$preguntaH' , '$preguntaI' , '$comentarios')");

header('refresh:2; url=http://kaosport.com/encuesta/frm_encuesta.php'); 

echo "Hemos recibido tus datos, gracias.";