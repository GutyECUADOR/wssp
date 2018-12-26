<!DOCTYPE html>
<?php @session_start();
                include('acceso_db.php');
                $perfil = mysql_query("select * from tbl_cliente where ruc='".$_SESSION['user']."'") or die(mysql_error());
               if(mysql_num_rows($perfil)) 
                   { // Comprobacion del registro con usuario ingresado
                        $row = mysql_fetch_array($perfil);
                        $_SESSION['rSOCIALVAR'] = $row["nombre"];
                        $_SESSION['RUCACTIVO']=$_SESSION['user'];
                   }   
              
?>
<html>
    <head>
        <title>Formulario de Consulta</title>
        <link rel="shortcut icon" href="favicon.ico">
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="tableCSS.css" media="screen" />
        <link rel="stylesheet" type="text/css" href="estilos.css" media="screen" />
        <link rel="stylesheet" type="text/css" href="styleicons.css" media="screen" />
        <link rel="stylesheet" type="text/css" href="tcal.css" />
        <script type="text/javascript" src="tcal.js"></script> 
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    
    </head>
    <body>
        <header>
		<div class="menu_bar">
			<a href="#" class="bt-menu"><img class="ico" src="glyphicons-114-justify.png">Menú</a>
		</div>
		<nav>
			<ul>
				<li><a href="formularioCON.php"><span class="icon-home3"></span>Inicio</a></li>
				<li><a href="frm_busquedaAV.php"><span class="icon-suitcase"></span>Búsqueda Avanzada</a></li>
                                 <li>
                              <?php
                               @session_start();
                               include('acceso_db.php'); 
                               if($_SESSION['rSOCIALVAR']!='ADMINISTRADOR') 
                                   {
                                 echo " <li><a href='cambiar_contrasena.php'>Cambiar contraseña</a>";
                                 echo "</li>";
                                    }
                                ?>                 
          
                             <?php
                               @session_start();
                               include('acceso_db.php'); 
                               if($_SESSION['rSOCIALVAR']=='ADMINISTRADOR') 
                                   {
                               
                                 echo "<li><a href='formularioCONCLIENTE.php'><span class='icon-home3'>Clientes</span></a>";
                                 echo "</li>";
                               
                                 echo "<li><a href=''><span class='icon-home3'>Informe Encuesta</span></a>";
                                 echo "</li>";
                                    }
                                ?>                 
         
                            
                                   </li>
                                   <li><a href="logout.php"><span class="icon-mail"></span>Cerrar Sesión</a></li>
			</ul>
		</nav>
	</header>
        
        <table class="CSSTableGenerator">
<tr>
                <td width="100%">
                Identificado como :                       
                <label>  <?php echo $_SESSION['rSOCIALVAR']?></label>
                </td>
                
            </tr>
        </table>
           
       <table class="CSSTableGenerator" align="center">
		<tr>
                <td colspan="7">
                    
                    <form action="encuesta/frm_resultencuesta.php" method="get">
                        <h2>RESULTADO DE ITEMS</h2><br>
                
                <?php
                require('acceso_db.php');   
                $fecha_INI = $_GET["dateinicio"];
                $fecha_FIN = $_GET["datefin"];
                $local_FILTRO = $_GET["local"];     
                $arrayLOCALES = array("General", "C.C.Bosque", "C.C.I", "C.C.Quicentro Norte");
                echo "Del:$fecha_INI al $fecha_FIN</br></br>";
                
                if (isset($_GET['CHK_PREG1'])) //COMPROBAR SI EL CHK ESTA ACTIVO de PREGUNTA A
                 {
                            if ($local_FILTRO == 'General')
                                {
                                $result_preguntaA=mysql_query("select preguntaA,count(*) as resultadoA from tbl_regencuesta WHERE fecha Between '$fecha_INI' and '$fecha_FIN' group by preguntaA ORDER BY `resultadoA` DESC");
                                echo "<FIELDSET>";
                                echo "<LEGEND>a. Le saludaron al entrar al local? </LEGEND>";
                                while($row = mysql_fetch_array($result_preguntaA))
                                    {
                                        $column_preguntaA = $row["preguntaA"];
                                        $column_resultadoA = $row["resultadoA"];
                                        echo "<p>$column_preguntaA = $column_resultadoA"; 
                                    }
                                echo "</FIELDSET>"; 
                                
                                }ELSE
                                {
                                $result_preguntaA=mysql_query("select preguntaA,count(*) as resultadoA from tbl_regencuesta WHERE local='$local_FILTRO' and fecha Between '$fecha_INI' and '$fecha_FIN'group by preguntaA ORDER BY `resultadoA` DESC");
                                echo "<FIELDSET>";
                                echo "<LEGEND>a. Le saludaron al entrar al local? </LEGEND>";
                                    while($row = mysql_fetch_array($result_preguntaA))
                                        {
                                            $column_preguntaA = $row["preguntaA"];
                                            $column_resultadoA = $row["resultadoA"];
                                            echo "<p>$column_preguntaA = $column_resultadoA"; 
                                        }
                                echo "</FIELDSET>";  
                                }
                }  
                
                if (isset($_GET['CHK_PREG2'])) //COMPROBAR SI EL CHK ESTA ACTIVO de PREGUNTA B
                 {
                                if ($local_FILTRO == 'General')
                                {                        
                                $result_preguntaB=mysql_query("select preguntaB,count(*) as resultadoB from tbl_regencuesta WHERE fecha Between '$fecha_INI' and '$fecha_FIN' group by preguntaB ORDER BY `resultadoB` DESC");
                                echo "<FIELDSET>";
                                echo "<LEGEND>b. La amabilidad y cordialidad de los asesores que le atendió fue? </LEGEND>";
                                    while($row = mysql_fetch_array($result_preguntaB))
                                    {
                                        $column_preguntaB = $row["preguntaB"];
                                        $column_resultadoB = $row["resultadoB"];
                                        echo "<p>$column_preguntaB = $column_resultadoB"; 
                                    }
                                echo "</FIELDSET>";    
                                }ELSE
                                {
                                $result_preguntaB=mysql_query("select preguntaB,count(*) as resultadoB from tbl_regencuesta WHERE local='$local_FILTRO' and fecha Between '$fecha_INI' and '$fecha_FIN' group by preguntaB ORDER BY `resultadoB` DESC");
                                echo "<FIELDSET>";
                                echo "<LEGEND>b. La amabilidad y cordialidad de los asesores que le atendió fue? </LEGEND>";
                                    while($row = mysql_fetch_array($result_preguntaB))
                                    {
                                        $column_preguntaB = $row["preguntaB"];
                                        $column_resultadoB = $row["resultadoB"];
                                        echo "<p>$column_preguntaB = $column_resultadoB"; 
                                    }
                                echo "</FIELDSET>";      
                                }    
                         
                 }  
                
                if (isset($_GET['CHK_PREG3'])) //COMPROBAR SI EL CHK ESTA ACTIVO de PREGUNTA C
                 {
                                if ($local_FILTRO == 'General')
                                {                        
                                $result_preguntaC=mysql_query("select preguntaC,count(*) as resultadoC from tbl_regencuesta WHERE fecha Between '$fecha_INI' and '$fecha_FIN' group by preguntaC ORDER BY `resultadoC` DESC");
                                echo "<FIELDSET>";
                                echo "<LEGEND>c. El asesoramiento de los productos y promociones que le dieron fue? </LEGEND>";
                                    while($row = mysql_fetch_array($result_preguntaC))
                                    {
                                        $column_preguntaC = $row["preguntaC"];
                                        $column_resultadoC = $row["resultadoC"];
                                        echo "<p>$column_preguntaC = $column_resultadoC"; 
                                    }
                                echo "</FIELDSET>";    
                                }ELSE
                                {
                                $result_preguntaC=mysql_query("select preguntaC,count(*) as resultadoC from tbl_regencuesta WHERE local='$local_FILTRO' and fecha Between '$fecha_INI' and '$fecha_FIN' group by preguntaC ORDER BY `resultadoC` DESC");
                                echo "<FIELDSET>";
                                echo "<LEGEND>c. El asesoramiento de los productos y promociones que le dieron fue? </LEGEND>";
                                    while($row = mysql_fetch_array($result_preguntaC))
                                    {
                                        $column_preguntaC = $row["preguntaC"];
                                        $column_resultadoC = $row["resultadoC"];
                                        echo "<p>$column_preguntaC = $column_resultadoC"; 
                                    }
                                echo "</FIELDSET>";      
                                }      
                }  
                
                if (isset($_GET['CHK_PREG4'])) //COMPROBAR SI EL CHK ESTA ACTIVO de PREGUNTA D
                 {
                                if ($local_FILTRO == 'General')
                                {                        
                                $result_preguntaD=mysql_query("select preguntaD,count(*) as resultadoD from tbl_regencuesta WHERE fecha Between '$fecha_INI' and '$fecha_FIN' group by preguntaD ORDER BY `resultadoD` DESC");
                                echo "<FIELDSET>";
                                echo "<LEGEND>d. Como fue la atención y eficiencia de la cajera? </LEGEND>";
                                    while($row = mysql_fetch_array($result_preguntaD))
                                    {
                                        $column_preguntaD = $row["preguntaD"];
                                        $column_resultadoD = $row["resultadoD"];
                                        echo "<p>$column_preguntaD = $column_resultadoD"; 
                                    }
                                echo "</FIELDSET>";    
                                }ELSE
                                {
                                $result_preguntaD=mysql_query("select preguntaD,count(*) as resultadoD from tbl_regencuesta WHERE local='$local_FILTRO' and fecha Between '$fecha_INI' and '$fecha_FIN' group by preguntaD ORDER BY `resultadoD` DESC");
                                echo "<FIELDSET>";
                                echo "<LEGEND>d. Como fue la atención y eficiencia de la cajera? </LEGEND>";
                                    while($row = mysql_fetch_array($result_preguntaD))
                                    {
                                        $column_preguntaD = $row["preguntaD"];
                                        $column_resultadoD = $row["resultadoD"];
                                        echo "<p>$column_preguntaD = $column_resultadoD"; 
                                    }
                                echo "</FIELDSET>";      
                                }      
                    
                    
                }  
                
                if (isset($_GET['CHK_PREG5'])) //COMPROBAR SI EL CHK ESTA ACTIVO de PREGUNTA E
                 {
                       
                                if ($local_FILTRO == 'General')
                                {                        
                                $result_preguntaE=mysql_query("select preguntaE,count(*) as resultadoE from tbl_regencuesta WHERE fecha Between '$fecha_INI' and '$fecha_FIN' group by preguntaE ORDER BY `resultadoE` DESC");
                                echo "<FIELDSET>";
                                echo "<LEGEND>e. Se despidieron por su nombre y le agradecieron por su compra? </LEGEND>";
                                    while($row = mysql_fetch_array($result_preguntaE))
                                    {
                                        $column_preguntaE = $row["preguntaE"];
                                        $column_resultadoE = $row["resultadoE"];
                                        echo "<p>$column_preguntaE = $column_resultadoE"; 
                                    }
                                echo "</FIELDSET>";    
                                }ELSE
                                {
                                $result_preguntaE=mysql_query("select preguntaE,count(*) as resultadoE from tbl_regencuesta WHERE local='$local_FILTRO' and fecha Between '$fecha_INI' and '$fecha_FIN' group by preguntaE ORDER BY `resultadoE` DESC");
                                echo "<FIELDSET>";
                                echo "<LEGEND>e. Se despidieron por su nombre y le agradecieron por su compra? </LEGEND>";
                                    while($row = mysql_fetch_array($result_preguntaE))
                                    {
                                        $column_preguntaE = $row["preguntaE"];
                                        $column_resultadoE = $row["resultadoE"];
                                        echo "<p>$column_preguntaE = $column_resultadoE"; 
                                    }
                                echo "</FIELDSET>";      
                                }      
                    
                    
                    
                }  
                
                if (isset($_GET['CHK_PREG6'])) //COMPROBAR SI EL CHK ESTA ACTIVO de PREGUNTA F
                {
                                if ($local_FILTRO == 'General')
                                {                        
                                $result_preguntaF=mysql_query("select preguntaF,count(*) as resultadoF from tbl_regencuesta WHERE fecha Between '$fecha_INI' and '$fecha_FIN' group by preguntaF ORDER BY `resultadoF` DESC");
                                echo "<FIELDSET>";
                                echo "<LEGEND>f. La imagen personal del asesor le pareció?  </LEGEND>";
                                    while($row = mysql_fetch_array($result_preguntaF))
                                    {
                                        $column_preguntaF = $row["preguntaF"];
                                        $column_resultadoF = $row["resultadoF"];
                                        echo "<p>$column_preguntaF = $column_resultadoF"; 
                                    }
                                echo "</FIELDSET>";    
                                }ELSE
                                {
                                $result_preguntaF=mysql_query("select preguntaF,count(*) as resultadoF from tbl_regencuesta WHERE local='$local_FILTRO' and fecha Between '$fecha_INI' and '$fecha_FIN' group by preguntaF ORDER BY `resultadoF` DESC");
                                echo "<FIELDSET>";
                                echo "<LEGEND>f. La imagen personal del asesor le pareció? </LEGEND>";
                                    while($row = mysql_fetch_array($result_preguntaF))
                                    {
                                        $column_preguntaF = $row["preguntaF"];
                                        $column_resultadoF = $row["resultadoF"];
                                        echo "<p>$column_preguntaF = $column_resultadoF"; 
                                    }
                                echo "</FIELDSET>";      
                                }
                    
                    
                }  
                
                if (isset($_GET['CHK_PREG7'])) //COMPROBAR SI EL CHK ESTA ACTIVO de PREGUNTA G
                {
                                if ($local_FILTRO == 'General')
                                {                        
                                $result_preguntaG=mysql_query("select preguntaG,count(*) as resultadoG from tbl_regencuesta WHERE fecha Between '$fecha_INI' and '$fecha_FIN' group by preguntaG ORDER BY `resultadoG` DESC");
                                echo "<FIELDSET>";
                                echo "<LEGEND>g. Cómo calificaría el orden y la limpieza en general? </LEGEND>";
                                    while($row = mysql_fetch_array($result_preguntaG))
                                    {
                                        $column_preguntaG = $row["preguntaG"];
                                        $column_resultadoG = $row["resultadoG"];
                                        echo "<p>$column_preguntaG = $column_resultadoG"; 
                                    }
                                echo "</FIELDSET>";    
                                }ELSE
                                {
                                $result_preguntaG=mysql_query("select preguntaG,count(*) as resultadoG from tbl_regencuesta WHERE local='$local_FILTRO' and fecha Between '$fecha_INI' and '$fecha_FIN' group by preguntaG ORDER BY `resultadoG` DESC");
                                echo "<FIELDSET>";
                                echo "<LEGEND>g. Cómo calificaría el orden y la limpieza en general? </LEGEND>";
                                    while($row = mysql_fetch_array($result_preguntaG))
                                    {
                                        $column_preguntaG = $row["preguntaG"];
                                        $column_resultadoG = $row["resultadoG"];
                                        echo "<p>$column_preguntaG = $column_resultadoG"; 
                                    }
                                echo "</FIELDSET>";      
                                }
                    
                }     
                
                if (isset($_GET['CHK_PREG8'])) //COMPROBAR SI EL CHK ESTA ACTIVO de PREGUNTA H
                {
                                if ($local_FILTRO == 'General')
                                {                        
                                $result_preguntaH=mysql_query("select preguntaH,count(*) as resultadoH from tbl_regencuesta WHERE fecha Between '$fecha_INI' and '$fecha_FIN' group by preguntaH ORDER BY `resultadoH` DESC");
                                echo "<FIELDSET>";
                                echo "<LEGEND>h. Con que frecuencia usted visita los locales de Kao Sport Center? </LEGEND>";
                                    while($row = mysql_fetch_array($result_preguntaH))
                                    {
                                        $column_preguntaH = $row["preguntaH"];
                                        $column_resultadoH = $row["resultadoH"];
                                        echo "<p>$column_preguntaH = $column_resultadoH"; 
                                    }
                                echo "</FIELDSET>";    
                                }ELSE
                                {
                                $result_preguntaH=mysql_query("select preguntaH,count(*) as resultadoH from tbl_regencuesta WHERE local='$local_FILTRO' and fecha Between '$fecha_INI' and '$fecha_FIN' group by preguntaH ORDER BY `resultadoH` DESC");
                                echo "<FIELDSET>";
                                echo "<LEGEND>h. Con que frecuencia usted visita los locales de Kao Sport Center? </LEGEND>";
                                    while($row = mysql_fetch_array($result_preguntaH))
                                    {
                                        $column_preguntaH = $row["preguntaH"];
                                        $column_resultadoH = $row["resultadoH"];
                                        echo "<p>$column_preguntaH = $column_resultadoH"; 
                                    }
                                echo "</FIELDSET>";      
                                }
                    
                }      
                
                if (isset($_GET['CHK_PREG9'])) //COMPROBAR SI EL CHK ESTA ACTIVO de PREGUNTA I
                 {
                                if ($local_FILTRO == 'General')
                                {                        
                                $result_preguntaI=mysql_query("select preguntaI,count(*) as resultadoI from tbl_regencuesta WHERE fecha Between '$fecha_INI' and '$fecha_FIN' group by preguntaI ORDER BY `resultadoI` DESC");
                                echo "<FIELDSET>";
                                echo "<LEGEND>i. Conoce usted de la existencia de KAO en las redes sociales como Facebook y Twitter? </LEGEND>";
                                    while($row = mysql_fetch_array($result_preguntaI))
                                    {
                                        $column_preguntaI = $row["preguntaI"];
                                        $column_resultadoI = $row["resultadoI"];
                                        echo "<p>$column_preguntaI = $column_resultadoI"; 
                                    }
                                echo "</FIELDSET>";    
                                }ELSE
                                {
                                $result_preguntaI=mysql_query("select preguntaI,count(*) as resultadoI from tbl_regencuesta WHERE local='$local_FILTRO' and fecha Between '$fecha_INI' and '$fecha_FIN' group by preguntaI ORDER BY `resultadoI` DESC");
                                echo "<FIELDSET>";
                                echo "<LEGEND>i. Conoce usted de la existencia de KAO en las redes sociales como Facebook y Twitter? </LEGEND>";
                                    while($row = mysql_fetch_array($result_preguntaI))
                                    {
                                        $column_preguntaI = $row["preguntaI"];
                                        $column_resultadoI = $row["resultadoI"];
                                        echo "<p>$column_preguntaI = $column_resultadoI"; 
                                    }
                                echo "</FIELDSET>";      
                                }
                }       
                  
                 
                if (isset($_GET['CHK_PREG10'])) //COMPROBAR SI EL CHK ESTA ACTIVO de COMENTARIOS
                 {
                        if ($local_FILTRO == 'General')
                        {
                        $result_comentarios = mysql_query("select comentarios from tbl_regencuesta WHERE fecha Between '$fecha_INI' and '$fecha_FIN'");
                        echo "<FIELDSET>";
                        echo "<LEGEND>Comentarios</LEGEND>";
                        while($row = mysql_fetch_array($result_comentarios))
                        {
                            $column_coment = $row["comentarios"];
                            echo "<p>$column_coment"; 
                        }
                        echo "</FIELDSET>";
                        }ELSE
                        {
                         $result_comentarios = mysql_query("select comentarios from tbl_regencuesta WHERE local='$local_FILTRO' and fecha Between '$fecha_INI' and '$fecha_FIN'");
                        echo "<FIELDSET>";
                        echo "<LEGEND>Comentarios</LEGEND>";
                        while($row = mysql_fetch_array($result_comentarios))
                        {
                            $column_coment = $row["comentarios"];
                            echo "<p>$column_coment"; 
                        }
                        echo "</FIELDSET>";
                        }
                }    
                ?>
                   
                    </br>    
                    <input type="button" value="Regresar" onClick="window.open('frm_infoencuesta.php','_self',false)" style="width:25%;height:40px" >
                     </form>
                    </td>
                    
                </tr>
                   
        </table>    
         
        
              
   <script src="http://code.jquery.com/jquery-latest.js"></script> 
   <script src="menu.js"></script>
    </body>
</html>
