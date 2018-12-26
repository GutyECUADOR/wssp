<?php
require('fpdf17/fpdf.php');
require('acceso_db.php');

$fecha_INI = $_GET["dateinicio"];
$fecha_FIN = $_GET["datefin"];
$local_FILTRO = $_GET["local"];



$result_preguntaA=mysql_query("select preguntaA,count(*) as resultadoA from tbl_regencuesta WHERE fecha Between '$fecha_INI' and '$fecha_FIN' and local='$local_FILTRO' group by preguntaA ORDER BY `resultadoA` DESC");
$result_preguntaB=mysql_query("select preguntaB,count(*) as resultadoB from tbl_regencuesta WHERE fecha Between '$fecha_INI' and '$fecha_FIN' and local='$local_FILTRO' group by preguntaB ORDER BY `resultadoB` DESC");
$result_preguntaC=mysql_query("select preguntaC,count(*) as resultadoC from tbl_regencuesta WHERE fecha Between '$fecha_INI' and '$fecha_FIN' and local='$local_FILTRO' group by preguntaC ORDER BY `resultadoC` DESC");
$result_preguntaD=mysql_query("select preguntaD,count(*) as resultadoD from tbl_regencuesta WHERE fecha Between '$fecha_INI' and '$fecha_FIN' and local='$local_FILTRO' group by preguntaD ORDER BY `resultadoD` DESC");
$result_preguntaE=mysql_query("select preguntaE,count(*) as resultadoE from tbl_regencuesta WHERE fecha Between '$fecha_INI' and '$fecha_FIN' and local='$local_FILTRO' group by preguntaE ORDER BY `resultadoE` DESC");
$result_preguntaF=mysql_query("select preguntaF,count(*) as resultadoF from tbl_regencuesta WHERE fecha Between '$fecha_INI' and '$fecha_FIN' and local='$local_FILTRO' group by preguntaF ORDER BY `resultadoF` DESC");
$result_preguntaG=mysql_query("select preguntaG,count(*) as resultadoG from tbl_regencuesta WHERE fecha Between '$fecha_INI' and '$fecha_FIN' and local='$local_FILTRO' group by preguntaG ORDER BY `resultadoG` DESC");
$result_preguntaH=mysql_query("select preguntaH,count(*) as resultadoH from tbl_regencuesta WHERE fecha Between '$fecha_INI' and '$fecha_FIN' and local='$local_FILTRO' group by preguntaH ORDER BY `resultadoH` DESC");
$result_preguntaI=mysql_query("select preguntaI,count(*) as resultadoI from tbl_regencuesta WHERE fecha Between '$fecha_INI' and '$fecha_FIN' and local='$local_FILTRO' group by preguntaI ORDER BY `resultadoI` DESC");
$result_comentarios=mysql_query("select comentarios from tbl_regencuesta WHERE fecha Between '$fecha_INI' and '$fecha_FIN' and local='$local_FILTRO'");

if ($local_FILTRO == 'General')
{
    $result_preguntaA = mysql_query("select preguntaA,count(*) as resultadoA from tbl_regencuesta WHERE local='C.C.Bosque'");
    $result_preguntaB = mysql_query("select preguntaB from tbl_regencuesta WHERE local='C.C.Bosque'");
    $result_preguntaC = mysql_query("select preguntaC from tbl_regencuesta WHERE local='C.C.Bosque'");
    $result_preguntaD = mysql_query("select preguntaD from tbl_regencuesta WHERE local='C.C.Bosque'");
    $result_preguntaE = mysql_query("select preguntaE from tbl_regencuesta WHERE local='C.C.Bosque'");
    $result_preguntaF = mysql_query("select preguntaF from tbl_regencuesta WHERE local='C.C.Bosque'");
    $result_preguntaG = mysql_query("select preguntaG from tbl_regencuesta WHERE local='C.C.Bosque'");
    $result_preguntaH = mysql_query("select preguntaH from tbl_regencuesta WHERE local='C.C.Bosque'");
    $result_preguntaI = mysql_query("select preguntaI from tbl_regencuesta WHERE local='C.C.Bosque'");
    $result_comentarios = mysql_query("select comentarios from tbl_regencuesta WHERE local='C.C.Bosque'");
}

class PDF extends FPDF
{
// Cabecera de página
function Header()
{
    
    global $title;

	// Arial bold 15
	$this->SetFont('Arial','B',15);
	// Calculamos ancho y posici�n del t�tulo.
	$w = $this->GetStringWidth($title)+2;
	$this->SetX((210-$w)/2);
	// Colores de los bordes, fondo y texto
	$this->SetDrawColor(0,80,180);
	$this->SetFillColor(0,80,180);
	$this->SetTextColor(244,244,244);
	// Ancho del borde (1 mm)
	$this->SetLineWidth(1);
	// T�tulo
	$this->Cell($w,9,$title,1,1,'C',true);
	// Salto de l�nea
	$this->Ln(10);
    
}

// Pie de página
function Footer()
{
    // Posición: a 1,5 cm del final
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial','I',8);
    // Número de página
    $this->Cell(0,10,'Pagina '.$this->PageNo().'/{nb}',0,0,'C');
}

function ChapterTitle($num, $label)
{
	// Arial 12
	$this->SetFont('Arial','',12);
	// Color de fondo
	$this->SetFillColor(200,220,255);
	// T�tulo
	$this->Cell(0,6,"Literal $num : $label",0,1,'L',true);
	// Salto de l�nea
	$this->Ln(4);
}

function PrintChapter($num, $title)
{
	
	$this->ChapterTitle($num,$title);
	
}

}

// Creación del objeto de la clase heredada
$pdf = new PDF();
$title = 'Informe de Satisfaccion a Cliente';
$pdf->AddPage();
$pdf->Image('logokao.png',10,8,33);
$pdf->cell(30,10,'Informe: '.$local_FILTRO = $_GET["local"].', del: '.$fecha_INI.' al: '.$fecha_FIN,0,1);
$pdf->SetTitle($title);
$pdf->AliasNbPages();
$pdf->SetFont('Times','',12);


if (isset($_GET['CHK_PREG1'])) //COMPROBAR SI EL CHK ESTA ACTIVO
  {
   //PREGUNTA 1
    $pdf->PrintChapter(1,'Le saludaron al entrar al local?');
        while($row = mysql_fetch_array($result_preguntaA))
        {
            $column_preguntaA = $row["preguntaA"];
            $column_resultadoA = $row["resultadoA"];
            $pdf->Cell(0,10,$pruebax.$column_preguntaA.' = '.$column_resultadoA.$i,0,1);
        }
  }
  
if (isset($_GET['CHK_PREG2'])) //COMPROBAR SI EL CHK ESTA ACTIVO
  {
//PREGUNTA 2
$pdf->PrintChapter(2,'La amabilidad y cordialidad de los asesores que le atendio fue?');
        while($row = mysql_fetch_array($result_preguntaB))
        {
            $column_preguntaB = $row["preguntaB"];
            $column_resultadoB = $row["resultadoB"];

            $pdf->Cell(0,10,$column_preguntaB.' = '.$column_resultadoB.$i,0,1);
        }
  }

if (isset($_GET['CHK_PREG3'])) //COMPROBAR SI EL CHK ESTA ACTIVO
  {  
        //PREGUNTA 3
        $pdf->PrintChapter(3,'El asesoramiento de los productos y promociones que le dieron fue?');
        while($row = mysql_fetch_array($result_preguntaC))
        {
            $column_preguntaC = $row["preguntaC"];
            $column_resultadoC = $row["resultadoC"];

            $pdf->Cell(0,10,$column_preguntaC.' = '.$column_resultadoC.$i,0,1);
        }
  }
  
if (isset($_GET['CHK_PREG4'])) //COMPROBAR SI EL CHK ESTA ACTIVO
  {  
        //PREGUNTA 4
        $pdf->PrintChapter(4,'Como fue la atencion y eficiencia de la cajera?');
        while($row = mysql_fetch_array($result_preguntaD))
        {
            $column_preguntaD = $row["preguntaD"];
            $column_resultadoD = $row["resultadoD"];

            $pdf->Cell(0,10,$column_preguntaD.' = '.$column_resultadoD.$i,0,1);
        }
  }

if (isset($_GET['CHK_PREG5'])) //COMPROBAR SI EL CHK ESTA ACTIVO
  {  
        //PREGUNTA 5
        $pdf->PrintChapter(5,'Se despidieron por su nombre y le agradecieron por su compra?');
        while($row = mysql_fetch_array($result_preguntaE))
        {
            $column_preguntaE = $row["preguntaE"];
            $column_resultadoE = $row["resultadoE"];

            $pdf->Cell(0,10,$column_preguntaE.' = '.$column_resultadoE.$i,0,1);
        }
   }
   
if (isset($_GET['CHK_PREG6'])) //COMPROBAR SI EL CHK ESTA ACTIVO
  {
        //PREGUNTA 6
        $pdf->PrintChapter(6,'La imagen personal del asesor le parecio?');
        while($row = mysql_fetch_array($result_preguntaF))
        {
            $column_preguntaF = $row["preguntaF"];
            $column_resultadoF = $row["resultadoF"];
            $pdf->Cell(0,10,$column_preguntaF.' = '.$column_resultadoF.$i,0,1);
        }
  }  
  
if (isset($_GET['CHK_PREG7'])) //COMPROBAR SI EL CHK ESTA ACTIVO
  {  
        //PREGUNTA 7
        $pdf->PrintChapter(7,'Como calificaria el orden y la limpieza en general?');
        while($row = mysql_fetch_array($result_preguntaG))
        {
            $column_preguntaG = $row["preguntaG"];
            $column_resultadoG = $row["resultadoG"];
            $pdf->Cell(0,10,$column_preguntaG.' = '.$column_resultadoG.$i,0,1);
        }
  }
  
if (isset($_GET['CHK_PREG8'])) //COMPROBAR SI EL CHK ESTA ACTIVO
  {  
        //PREGUNTA 8
        $pdf->PrintChapter(8,'Con que frecuencia usted visita los locales de Kao Sport Center?');
        while($row = mysql_fetch_array($result_preguntaH))
        {
            $column_preguntaH = $row["preguntaH"];
            $column_resultadoH = $row["resultadoH"];
            $pdf->Cell(0,10,$column_preguntaH.' = '.$column_resultadoH.$i,0,1);
        }
  }   
  
if (isset($_GET['CHK_PREG9'])) //COMPROBAR SI EL CHK ESTA ACTIVO
  {  
        $pdf->PrintChapter(9,'Conoce usted de la existencia de KAO en las redes sociales como Facebook y Twitter?');
        while($row = mysql_fetch_array($result_preguntaI))
        {
            $column_preguntaI = $row["preguntaI"];
            $column_resultadoI = $row["resultadoI"];
            $pdf->Cell(0,10,$column_preguntaI.' = '.$column_resultadoI.$i,0,1);
        }
  }

 if (isset($_GET['CHK_PREG10'])) //COMPROBAR SI EL CHK ESTA ACTIVO
  {
        $pdf->PrintChapter(10,'Comentarios');
        while($row = mysql_fetch_array($result_comentarios))
        {
            $column_coment = $row["comentarios"];
            $pdf->Cell(0,10,$column_coment.$i,0,1);
        }
  }

$pdf->Output();

