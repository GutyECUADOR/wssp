<?php
include('../ws-admin/acceso_db_sbio.php');
session_start();

$user_activo = $_SESSION['user_ruc'];
$old_pass = $_POST['txt_oldpass'];
$newpass1 = $_POST['txt_newpass1'];
$newpass2 = $_POST['txt_newpass2'];

$consulta_existe = "SELECT * FROM Empleados with (nolock) WHERE Cedula = '$user_activo' AND Clave = '$old_pass'";
$result_query_existe = odbc_exec($conexion_sbio, $consulta_existe);

if (odbc_fetch_row($result_query_existe)){
    
    $consulta_update = "UPDATE dbo.Empleados SET Clave='$newpass1' WHERE Cedula = '$user_activo'";
    odbc_exec($conexion_sbio, $consulta_update);
          
    
    $mensaje = "Contraseña Actualizada. Por favor reingrese al sistema";
            echo "<script>";
            echo "alert('$mensaje');";  
            echo "window.location = '../ws-admin/';";
            echo "</script>";  
    
    session_destroy();
    
}
    else
    {
        
    $mensaje = "No se actualizo la contraseña, reintente.";
            echo "<script>";
            echo "alert('$mensaje');";  
            echo "window.location = '../ws-admin/frm_main.php';";
            echo "</script>";  
    }
        
