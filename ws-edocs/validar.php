<?php
    include ('acceso_db.php');
    if (isset($_POST["usuario"]) && isset($_POST["pass"]))
    {
         session_start();
        $_SESSION['user']=$_REQUEST['usuario'];
        $USR = $_POST["usuario"];
        $PAS = $_POST["pass"];
      
        $consulta = mysql_query("select * from tbl_cliente where ruc='".$USR."' and password='".$PAS."'"); //Modificar busqueda en tabla
            
            
            
            
            if ($acceso = mysql_fetch_array($consulta))
            {
                header("Location: formularioCON.php");
                
            }
            else
            {
           
               $mensaje = "Error en acceso, usuario y/o password erroneos o no registrados en sistema";
		echo "<script>";
		echo "alert('$mensaje');";  
		echo "window.location = 'index.html';";
		echo "</script>";  
            }
                     
    }       
      
?>

<html>
    <head>
     
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
     
     
    </body>
</html>

