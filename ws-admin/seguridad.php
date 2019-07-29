<?php
session_start();

if (!isset($_SESSION['autentificacion'])) {
    $mensaje = "Sesion no iniciada, ingrese al sistema.";
    echo "<script>";
    echo "alert('$mensaje');";  
    echo "window.location = '../ws-admin/'";
    echo "</script>";
   
}
   