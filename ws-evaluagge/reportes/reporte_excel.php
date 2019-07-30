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
require_once '../../ws-admin/acceso_multi_db.php';
require_once '../../libs/PHPExcel-1.8/PHPExcel.php';

require_once ('../../ws-admin/funciones.php'); // Acceso a funciones utiles
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
$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setAutoSize(TRUE);
$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setAutoSize(TRUE);
$objPHPExcel->getActiveSheet()->getColumnDimension('K')->setAutoSize(TRUE);
$objPHPExcel->getActiveSheet()->getColumnDimension('L')->setAutoSize(TRUE);
$objPHPExcel->getActiveSheet()->getColumnDimension('M')->setAutoSize(TRUE);
$objPHPExcel->getActiveSheet()->getColumnDimension('N')->setAutoSize(TRUE);
$objPHPExcel->getActiveSheet()->getColumnDimension('O')->setAutoSize(TRUE);
$objPHPExcel->getActiveSheet()->getColumnDimension('P')->setAutoSize(TRUE);
$objPHPExcel->getActiveSheet()->getColumnDimension('Q')->setAutoSize(TRUE);
$objPHPExcel->getActiveSheet()->getColumnDimension('R')->setAutoSize(TRUE);

// Añadir titulos de las columnas 
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1', '#')
            ->setCellValue('B1', 'CI. Empleado')
            ->setCellValue('C1', 'Evaluador')
            ->setCellValue('D1', 'Empleado')
            ->setCellValue('E1', 'Fecha Ingreso')
            ->setCellValue('G1', '# Evaluacion')
            ->setCellValue('H1', 'Fecha Evaluacion')
            ->setCellValue('I1', 'Act. Esenciales')
            ->setCellValue('J1', 'Conocimientos')
            ->setCellValue('K1', 'Comp. Tecnicas')
            ->setCellValue('L1', 'Comp. Universales')
            ->setCellValue('M1', 'TIL')
            ->setCellValue('N1', 'Rel. cliente interno')
            ->setCellValue('O1', 'Total')
            ->setCellValue('P1', 'Sueldo/Salario')
            ->setCellValue('Q1', 'H. Extras')
            ->setCellValue('R1', 'Observacion')
            ;

        $numero=2; // Identifica la fila que sera llenada
        $codigoROL = first_month_day_codROLWinfenix(); //2018.03.03 ejemplo
        
        $query = "
        SELECT
            ROL_HISTORICO.Codigo as CedulaEmpleado,
            SBIO.Codigo as CodEmpleado,
            SBIO2.Nombre + SBIO2.Apellido as NombreEvaluador,
            SBIO.Nombre + SBIO.Apellido as NombreEmpleado,
            SBIO.Fecha_Ing as fechIngreso,
            ROL_HISTORICO.Rol as CodRol,
            ROL_HISTORICO.Detalle as TipoRol,
            ROL_HISTORICO.CodFor as CodTipoRol,
            ROL_HISTORICO.Monto as SueldoRol,
            HISTORICO2.CodFor as CodTipoRol,
            HISTORICO2.Detalle as TipoRol, 
            HISTORICO2.Monto as HorasExtras, 
            CAB_EJI.codigo as codEvaluacion,
            CAB_EJI.fecha as fechaEvaluacion,
            DETALLE_EJI.ActividadesEsenciales,
            DETALLE_EJI.Conocimientos,
            DETALLE_EJI.ComTecnicas,
            DETALLE_EJI.ComUniversales,
            DETALLE_EJI.TIL,
            DETALLE_EJI.RelClienteInterno,
            DETALLE_EJI.factor,
            DETALLE_EJI.totalEV,
            CAB_EJI.observacion as observacion,
            CAB_EJI.estado as estadoEvaluacion

        FROM dbo.ROL_HISTORICO
            INNER JOIN dbo.ROL_HISTORICO AS HISTORICO2 ON ROL_HISTORICO.Codigo = HISTORICO2.Codigo 
            INNER JOIN SBIOKAO.dbo.Empleados as SBIO on SBIO.Cedula = ROL_HISTORICO.Codigo COLLATE Modern_Spanish_CI_AS
            INNER JOIN KAO_wssp.dbo.CAB_EJI as CAB_EJI on CAB_EJI.empleado = SBIO.Codigo
            INNER JOIN KAO_wssp.dbo.resultados_EJI as DETALLE_EJI on CAB_EJI.codigo = DETALLE_EJI.codEV
            INNER JOIN SBIOKAO.dbo.Empleados as SBIO2 on SBIO2.Cedula = CAB_EJI.solicitante 
        WHERE 
            ROL_HISTORICO.Rol='2019.06.01' 
            AND HISTORICO2.Rol='2019.06.01'
            AND ROL_HISTORICO.CodFor = 'A01' 
            AND HISTORICO2.CodFor = 'A10' 
            AND CAB_EJI.fecha BETWEEN '$dateini_modal' AND '$datefin_modal'

        GROUP BY
            SBIO.Nombre,
            ROL_HISTORICO.Codigo,
            SBIO.Apellido,
            SBIO.Fecha_Ing,
            SBIO.Codigo,
            SBIO2.Nombre,
            SBIO2.Apellido,
            ROL_HISTORICO.Rol,
            ROL_HISTORICO.Detalle,
            ROL_HISTORICO.CodFor,
            ROL_HISTORICO.Monto,
            HISTORICO2.CodFor,
            HISTORICO2.Detalle,
            HISTORICO2.Monto ,
            CAB_EJI.codigo, 
            CAB_EJI.fecha,
            DETALLE_EJI.ActividadesEsenciales,
            DETALLE_EJI.Conocimientos,
            DETALLE_EJI.ComTecnicas,
            DETALLE_EJI.ComUniversales,
            DETALLE_EJI.TIL,
            DETALLE_EJI.RelClienteInterno,
            DETALLE_EJI.factor,
            DETALLE_EJI.totalEV,
            CAB_EJI.observacion,
            CAB_EJI.estado
        ORDER BY 
            SBIO.Nombre,
            codEvaluacion DESC
            

            

        ";

        $db_empresa = getDataBase($empresa_select);
        $result_query = odbc_exec($db_empresa, $query);
        $item=1;

        while(odbc_fetch_row($result_query)) {
           
            $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A'.$numero, $item)
            ->setCellValue('B'.$numero, odbc_result($result_query,"CedulaEmpleado"))
            ->setCellValue('C'.$numero, iconv("iso-8859-1", "UTF-8",odbc_result($result_query,"NombreEvaluador")))        
            ->setCellValue('D'.$numero, iconv("iso-8859-1", "UTF-8",odbc_result($result_query,"NombreEmpleado")))        
            ->setCellValue('E'.$numero, odbc_result($result_query,"fechIngreso"))
            ->setCellValue('G'.$numero, odbc_result($result_query,"codEvaluacion"))
            ->setCellValue('H'.$numero, odbc_result($result_query,"fechaEvaluacion"))
            ->setCellValue('I'.$numero, odbc_result($result_query,"ActividadesEsenciales"))
            ->setCellValue('J'.$numero, odbc_result($result_query,"Conocimientos"))
            ->setCellValue('K'.$numero, odbc_result($result_query,"ComTecnicas"))
            ->setCellValue('L'.$numero, odbc_result($result_query,"ComUniversales"))
            ->setCellValue('M'.$numero, odbc_result($result_query,"TIL"))
            ->setCellValue('N'.$numero, odbc_result($result_query,"RelClienteInterno"))
            ->setCellValue('O'.$numero, odbc_result($result_query,"totalEV"))
            ->setCellValue('P'.$numero, odbc_result($result_query,"SueldoRol"))
            ->setCellValue('Q'.$numero, odbc_result($result_query,"HorasExtras"))
            ->setCellValue('R'.$numero, odbc_result($result_query,"observacion"))
            ;
            $numero++;
            $item++;
        }
    
           

// Rename worksheet
$objPHPExcel->getActiveSheet()->setTitle('Hoja de Datos');


// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);


// Redirect output to a client’s web browser (Excel2007)
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="reporteEvaluacionesJefes.xlsx"');
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
