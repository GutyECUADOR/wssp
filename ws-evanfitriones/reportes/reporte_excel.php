<?php

    
/**
 * PHPExcel
 *
 * Copyright (c) 2006 - 2015 PHPExcel
 *
 * This library is free software; you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation; either
 * version 2.1 of the License, or (at your option) any later version.
 *
 * This library is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU
 * Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public
 * License along with this library; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301  USA
 *
 * @category   PHPExcel
 * @package    PHPExcel
 * @copyright  Copyright (c) 2006 - 2015 PHPExcel (http://www.codeplex.com/PHPExcel)
 * @license    http://www.gnu.org/licenses/old-licenses/lgpl-2.1.txt	LGPL
 * @version    ##VERSION##, ##DATE##
 */

/** Error reporting */
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
date_default_timezone_set('Europe/London');

if (PHP_SAPI == 'cli'){
    die('Excel unicamente se puede generar desde un navegador web');
}

/** Include PHPExcel */
require_once '../../ws-admin/acceso_multi_db.php';
require_once '../../ws-admin/acceso_db_sbio.php';
require_once '../../libs/PHPExcel-1.8/PHPExcel.php';


// datos de busqueda
   
    $fecha_ini= filter_input(INPUT_GET,'dateini');
    $fecha_fin=  filter_input(INPUT_GET, 'datefin');
    $empresa_search = filter_input(INPUT_GET,'empresa_search'); 


// Create new PHPExcel object
$objPHPExcel = new PHPExcel();

// Seteo de estilos

 $styleArray = array(
        'alignment' => array(
            'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
        )
    );

   

// Set document properties
$objPHPExcel->getProperties()->setCreator("KAO")
                             ->setLastModifiedBy("KAO")
                             ->setTitle("Office Excel XLSX Reporte")
                             ->setSubject("Office Excel XLSX Reporte")
                             ->setDescription("Documento XLSX, generado utilizando librerias PHP.")
                             ->setKeywords("reporte evaluaciones anfitriones")
                             ->setCategory("reporte generado");
//Añadir estilos

$objPHPExcel->getDefaultStyle()->applyFromArray($styleArray);
$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize(TRUE);
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize(TRUE);
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setAutoSize(TRUE);
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setAutoSize(TRUE);
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setAutoSize(TRUE);
$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setAutoSize(TRUE);
$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setAutoSize(TRUE);

// Add some titles
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1', 'ID.')
            ->setCellValue('B1', 'EMPRESA')
            ->setCellValue('C1', 'SUPERVISOR')
            ->setCellValue('D1', 'EMPLEADO')
            ->setCellValue('E1', 'FECHA DE EV.')
            ->setCellValue('F1', 'PUNTAJE')
            ->setCellValue('G1', 'A RECIBIR');

$numero=1; // Identifica la fila que sera llenada
        $db_empresa = getDataBase('009'); //Obtenemos conexion con base de datos segun codigo de la DB (009 - ODBC_wssp)
        $consulta_general = "select (B.Nombre + B.Apellido)as empleadoN, (c.Nombre + c.Apellido)as supervisorN, d.Nombre as empresaN, A.* from dbo.ev_anfitriones as A INNER JOIN SBIOKAO.DBO.Empleados AS B ON B.Codigo = A.empleado INNER JOIN SBIOKAO.dbo.Empleados as C on C.Cedula = A.supervisor INNER JOIN SBIOKAO.dbo.Empresas_WF as D ON D.Codigo = A.empresa WHERE a.fecha BETWEEN '$fecha_ini' AND '$fecha_fin' AND empresa = '$empresa_search'  ORDER BY id ASC";

        $result_query = odbc_exec($db_empresa, $consulta_general);

        while(odbc_fetch_row($result_query))
            {
            $numero++;
            //RECUPERAR DATOS
                $cod_reporte = odbc_result($result_query,"id");
                //$empresa = odbc_result($result_consulta_chlocales,"NombreEmpresaN");
                $empresacodDB = trim(odbc_result($result_query,"empresaN"));
                //Recodificacion de ISO-8859 a UTF
                $supervisor_pdf = iconv("iso-8859-1", "UTF-8", odbc_result($result_query,"supervisorN"));
                $empleado_pdf = iconv("iso-8859-1", "UTF-8", odbc_result($result_query,"empleadoN"));
                $fechaPDF = odbc_result($result_query,"fecha");
                $puntaje = odbc_result($result_query,"sumatoria");
        
                $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('A'.$numero, $cod_reporte)
                ->setCellValue('B'.$numero, $empresacodDB) 
                ->setCellValue('C'.$numero, $supervisor_pdf)        
                ->setCellValue('D'.$numero, $empleado_pdf)
                ->setCellValue('E'.$numero, $fechaPDF)
                ->setCellValue('F'.$numero, $puntaje."/56");        

                
                        
            
            }

// Rename worksheet
$objPHPExcel->getActiveSheet()->setTitle('Hoja de Datos');


// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);


// Redirect output to a client’s web browser (Excel2007)
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="reporteAnfitriones.xlsx"');
header('Cache-Control: max-age=0');
// If you're serving to IE 9, then the following may be needed
header('Cache-Control: max-age=1');

// If you're serving to IE over SSL, then the following may be needed
header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
header ('Pragma: public'); // HTTP/1.0

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('php://output');
exit;
