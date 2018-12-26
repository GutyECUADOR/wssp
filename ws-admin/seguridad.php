<?php
session_start();

if (isset($_SESSION['autentificacion']))
    {
     if ($_SESSION['autentificacion']!=1)
        {
            $mensaje = "Acceso no autorizado, ingrese al sistema.";
            echo "<script>";
            echo "alert('$mensaje');";  
            echo "window.location = '../ws-admin/';";
            echo "</script>";  
        }
    }
    else{
        
            $mensaje = "Sesion no iniciada, ingrese al sistema.";
            echo "<script>";
            echo "alert('$mensaje');";  
            echo "window.location = '../ws-admin/';";
            echo "</script>";
   
}
   