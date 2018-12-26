<?php
session_start();
$cont = null;  
$tdocument = $_GET["chk_radio"]; //Tipo de Documento a buscar
   
        if(empty($_GET['chk_radio'])) 
        {
            $chk_radio=0;
        }
               
   $icono = "<img src =pdfico.png>"; //LINK AL ICONO DE LOS PDF
   $iconoXML = "<img src =xmlico.png>";//

   
   if ($_GET["formenviado"]=="desdecliente") //Determinamos si es una busqueda desde la seccion cleintes del admin
        {
             $_SESSION['RUCACTIVO']=$_GET['txt_RUCCLIENTE'];
        }
        
switch ($tdocument) //FILTRO SEGUN TIPO DE DOCUMENTO
{
    case 0:
         //BUSQUEDA DE TODOS LOS DOCUMENTOS
        include ('facturas.php');
        include ('notascredito.php');
        include ('retenciones.php');
        include ('guiaremicion.php');
        $tdocumenttxt = "Todos los Documentos";
        break;
        
    case 1:
        //BUSQUEDA DE FACTURAS
       include ('facturas.php');
       $tdocumenttxt = "FACTURAS"; 
        break;
        
    case 2:
         //BUSQUEDA DE NOTAS DE CRÉDITO
        include ('notascredito.php');
        $tdocumenttxt = "NOTAS DE CRÉDITO";
        
        break;
    
    case 3:
         //BUSQUEDA DE NOTAS DE CRÉDITO
        include ('retenciones.php');
        
        $tdocumenttxt = "RETENCIONES";
        
        break;
    
    case 4:
         //BUSQUEDA DE NOTAS DE CRÉDITO
        include ('guiaremicion.php');
        
        $tdocumenttxt = "Guias de Remisión";
        
        break;
    
    default:
       echo "No se ha seleccionado ningun filtro";
}

