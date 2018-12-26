<?php
session_start();
$contador =0;
include('acceso_db.php');

$tdocument = $_POST["chk_radio"]; //Tipo de Documento a buscar
$rucBUSQUEDA = $_SESSION['user_ruc'];   //RUC que se va a buscar, segun usuario

        if($_POST['formenviado']=='desdecliente') 
        {
            $_SESSION['RUCACTIVO']=$_POST["txt_RUCCLIENTE"];
        }

        if(empty($_POST['chk_radio'])) 
        {
            $chk_radio=0;
        }
 $iconoPDF = "<span class='icon-file-pdf icon-large'></spam>"; //LINK AL ICONO DE LOS PDF
 $iconoXML = "<span class='icon-download3 icon-large'></spam>";//


 
switch ($tdocument) //FILTRO SEGUN TIPO DE DOCUMENTO
{
    case 0:
        $sql = ("SELECT fecha, tbl_transaccion.ruc, nombre, valor, SUBSTRING(archivopdf, 35, 15) as DOC, tipo, archivopdf, archivoXML FROM tbl_transaccion, tbl_cliente where tbl_transaccion.ruc = tbl_cliente.ruc and tbl_cliente.nombre like '".$rucBUSQUEDA."%' "
            . "UNION ALL SELECT fecha, tbl_transaccion.ruc, tbl_cliente.nombre, valor, SUBSTRING(archivopdf, 35, 15) as DOC, tipo, archivopdf, archivoXML FROM tbl_transaccion, tbl_cliente WHERE tbl_transaccion.ruc = tbl_cliente.ruc and tbl_transaccion.ruc like '".$rucBUSQUEDA."%' ORDER BY fecha DESC");
        $resultado = mysql_query($sql); 
        $contador = mysql_num_rows($resultado); //Total de resultados
        
        
        $tdocumenttxt = "Todos los Documentos";
        break;
        
    case 1:
       $sql = ("SELECT fecha, tbl_transaccion.ruc, nombre, valor,SUBSTRING(archivopdf, 35, 15) as DOC, tipo, archivopdf, archivoXML FROM tbl_transaccion, tbl_cliente where tbl_transaccion.ruc = tbl_cliente.ruc and tbl_cliente.nombre like '".$rucBUSQUEDA."%' "
            . "UNION ALL SELECT fecha, tbl_transaccion.ruc, tbl_cliente.nombre, valor,SUBSTRING(archivopdf, 35, 15) as DOC, tipo, archivopdf, archivoXML FROM tbl_transaccion, tbl_cliente WHERE tbl_transaccion.ruc = tbl_cliente.ruc and tbl_transaccion.ruc like '".$rucBUSQUEDA."%' AND tipo='FV'");
       $resultado = mysql_query($sql);
       $contador = mysql_num_rows($resultado);
       $tdocumenttxt = "FACTURAS"; 
       break;
        
    case 2:
         $sql = ("SELECT fecha, tbl_transaccion.ruc, nombre, valor,SUBSTRING(archivopdf, 35, 15) as DOC, tipo, archivopdf, archivoXML FROM tbl_transaccion, tbl_cliente where tbl_transaccion.ruc = tbl_cliente.ruc and tbl_cliente.nombre like '".$rucBUSQUEDA."%' "
            . "UNION ALL SELECT fecha, tbl_transaccion.ruc, tbl_cliente.nombre, valor,SUBSTRING(archivopdf, 35, 15) as DOC, tipo, archivopdf, archivoXML FROM tbl_transaccion, tbl_cliente WHERE tbl_transaccion.ruc = tbl_cliente.ruc and tbl_transaccion.ruc like '".$rucBUSQUEDA."%' AND tipo='NC'");
        $resultado = mysql_query($sql);
        $contador = mysql_num_rows($resultado);
        $tdocumenttxt = "NOTAS DE CRÉDITO";
        break;
    
    case 3:
       $sql = ("SELECT fecha, tbl_transaccion.ruc, nombre, valor,SUBSTRING(archivopdf, 35, 15) as DOC, tipo, archivopdf, archivoXML FROM tbl_transaccion, tbl_cliente where tbl_transaccion.ruc = tbl_cliente.ruc and tbl_cliente.nombre like '".$rucBUSQUEDA."%' "
            . "UNION ALL SELECT fecha, tbl_transaccion.ruc, tbl_cliente.nombre, valor,SUBSTRING(archivopdf, 35, 15) as DOC, tipo, archivopdf, archivoXML FROM tbl_transaccion, tbl_cliente WHERE tbl_transaccion.ruc = tbl_cliente.ruc and tbl_transaccion.ruc like '".$rucBUSQUEDA."%' AND tipo='RT'");
        $resultado = mysql_query($sql);
        $contador = mysql_num_rows($resultado);
        $tdocumenttxt = "RETENCIONES";
        break;
    
    case 4:
       $sql = ("SELECT fecha, tbl_transaccion.ruc, nombre, valor,SUBSTRING(archivopdf, 35, 15) as DOC, tipo, archivopdf, archivoXML FROM tbl_transaccion, tbl_cliente where tbl_transaccion.ruc = tbl_cliente.ruc and tbl_cliente.nombre like '".$rucBUSQUEDA."%' "
            . "UNION ALL SELECT fecha, tbl_transaccion.ruc, tbl_cliente.nombre, valor,SUBSTRING(archivopdf, 35, 15) as DOC, tipo, archivopdf, archivoXML FROM tbl_transaccion, tbl_cliente WHERE tbl_transaccion.ruc = tbl_cliente.ruc and tbl_transaccion.ruc like '".$rucBUSQUEDA."%' AND tipo='GR'");
        $resultado = mysql_query($sql);
        $contador = mysql_num_rows($resultado);
        $tdocumenttxt = "Guias de Remisión";
        break;
    
    default:
       echo "No se ha seleccionado ningun filtro";
}


  
                       