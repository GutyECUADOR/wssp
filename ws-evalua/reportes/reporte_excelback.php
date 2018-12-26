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
require_once '../../ws-admin/acceso_db.php';
require_once '../../ws-admin/acceso_db_sbio.php';
require_once '../../libs/PHPExcel-1.8/PHPExcel.php';


// datos de busqueda

    $dateini_modal= filter_input(INPUT_GET,'dateini_excel');
    $datefin_modal=  filter_input(INPUT_GET, 'datefin_excel');
    $empresa_select = filter_input(INPUT_GET,'seleccion_empresa_excel'); 


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
                             ->setKeywords("reporte evaluaciones")
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
$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setAutoSize(TRUE);

// Add some titles
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1', 'Cod. Empleado')
            ->setCellValue('B1', 'Empleado')
            ->setCellValue('C1', 'Cargo')
            ->setCellValue('D1', 'Fecha Ingreso')
            ->setCellValue('E1', '# Evaluacion')
            ->setCellValue('F1', 'Fecha')
            ->setCellValue('G1', 'Puntaje')
            ->setCellValue('H1', 'Coach');

$numero=1; // Identifica la fila que sera llenada
        $consulta_general = "SELECT A.empleado as codigo, MAX(B.Cedula) as cedula, MAX(B.Apellido + B.Nombre) as empleado, MAX(A.cargo)as cargo, MAX(CONVERT(date, B.Fecha_Ing))as fechaIng FROM dbo.Evaluaciones as A with (nolock) INNER JOIN SBIOKAO.dbo.Empleados as B on A.empleado = B.Codigo  WHERE B.Empresa_WF = '$empresa_select' AND fecha BETWEEN '$dateini_modal' and '$datefin_modal' GROUP BY empleado ORDER BY empleado";
        $result_query = odbc_exec($conexion, $consulta_general);

        while(odbc_fetch_row($result_query))
            {
            $numero++;
            $cod_gen_emp = odbc_result($result_query,"codigo");
            $ci_gen_emp = odbc_result($result_query,"cedula");
            $empleado_gen = iconv("iso-8859-1", "UTF-8", odbc_result($result_query,"empleado"));
            $cargo_gen = odbc_result($result_query,"cargo");
            $fechaIng_gen = odbc_result($result_query,"fechaIng");
        
            $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A'.$numero, $ci_gen_emp)
            ->setCellValue('B'.$numero, $empleado_gen)
            ->setCellValue('C'.$numero, $cargo_gen)
            ->setCellValue('D'.$numero, $fechaIng_gen);
            
                    $consulta_evaluas = "SELECT cod_evaluacion, fecha,(formacion_1+formacion_2+formacion_3+formacion_4+organizacion_1+organizacion_2+organizacion_3+organizacion_4+relainter_1+relainter_2+relainter_3+relainter_4+compempresa1_1+compempresa1_2+compempresa1_3+compempresa1_4+compempresa2_1+compempresa2_2+compempresa2_3+compempresa2_4+compempresa3_1+compempresa3_2+compempresa3_3+compempresa3_4+compempresa4_1+compempresa4_2+compempresa4_3+compempresa4_4+autoevalua_1+autoevalua_2+autoevalua_3+autoevalua_4+autoevalua_5) as puntaje, coach_val FROM dbo.Evaluaciones as A with (nolock) INNER JOIN SBIOKAO.dbo.Empleados as B on A.empleado = B.Codigo  WHERE A.empleado = '$cod_gen_emp' and fecha BETWEEN '$dateini_modal' and '$datefin_modal' ORDER BY fecha";
                    $result_query_evaluas = odbc_exec($conexion, $consulta_evaluas);
            
                    while(odbc_fetch_row($result_query_evaluas))
                        {
                        $cod_evaluas = odbc_result($result_query_evaluas,"cod_evaluacion");
                        $fecha_evaluas = odbc_result($result_query_evaluas,"fecha");
                        $puntaje_evaluas = odbc_result($result_query_evaluas,"puntaje");
                        $coach_evaluas = odbc_result($result_query_evaluas,"coach_val");
            
                        $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue('E'.$numero, $cod_evaluas)
                        ->setCellValue('F'.$numero, $fecha_evaluas)
                        ->setCellValue('G'.$numero, $puntaje_evaluas)
                        ->setCellValue('H'.$numero, $coach_evaluas);
                        $numero++;
                        }
            
            }

// Rename worksheet
$objPHPExcel->getActiveSheet()->setTitle('Hoja de Datos');


// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);


// Redirect output to a client’s web browser (Excel2007)
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="reporteEvaluaciones.xlsx"');
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
