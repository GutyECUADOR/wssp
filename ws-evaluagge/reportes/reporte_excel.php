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
            ->setCellValue('A1', 'Cod. Empleado')
            ->setCellValue('B1', 'Evaluador')
            ->setCellValue('C1', 'Empleado')
            ->setCellValue('D1', '')
            ->setCellValue('E1', 'Fecha Ingreso')
            ->setCellValue('F1', 'Empresa')
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

$numero=1; // Identifica la fila que sera llenada
       //Consulta general para obtener empleados que tienen regisrtos en el rango de fechas
        $consulta_general = "SELECT CAB_EJI.*, (RTRIM(sbio.Nombre) + ' '+ RTRIM(sbio.Apellido)) as EvaluadorN, (RTRIM(SBIO_Empleado.Nombre) + ' '+ RTRIM(SBIO_Empleado.Apellido))  as EvaluadoN, SBIO_Empleado.Cedula as CIEmpleado, CONVERT(date, SBIO_Empleado.Fecha_Ing) as FechaIngreso ,WP_Empresas.Nombre as EmpresaN FROM dbo.CAB_EJI with (nolock) INNER JOIN SBIOKAO.dbo.Empleados as SBIO ON CAB_EJI.solicitante = SBIO.Cedula INNER JOIN SBIOKAO.dbo.Empleados as SBIO_Empleado ON CAB_EJI.empleado = SBIO_Empleado.Codigo INNER JOIN SBIOKAO.dbo.Empresas_WF as WP_Empresas on WP_Empresas.Codigo = CAB_EJI.empresa  WHERE CAB_EJI.empresa='$empresa_select' AND CAB_EJI.fecha BETWEEN '$dateini_modal' AND '$datefin_modal' AND CAB_EJI.estado = '0' ORDER BY EvaluadoN";

        $result_query = odbc_exec($conexion, $consulta_general);

        while(odbc_fetch_row($result_query))
            {
            $numero++;
            $nombreEvaluador = iconv("iso-8859-1", "UTF-8", odbc_result($result_query,"EvaluadorN")); 
            //Campo importante determina siguiente consulta
            $codigoEvaluado = odbc_result($result_query,"empleado"); //Codigo de 3 digitos
            $codigoEvaluacion = odbc_result($result_query,"codigo"); //EJI0000XX
            $cedulaEvaluado = odbc_result($result_query,"CIEmpleado");
            $nombreEvaluado = iconv("iso-8859-1", "UTF-8", odbc_result($result_query,"EvaluadoN"));
           
            $fechaIngreso = odbc_result($result_query,"FechaIngreso");
            $empresaN = trim(odbc_result($result_query,"EmpresaN"));
            $empresaCod = trim(odbc_result($result_query,"empresa")); // ID de conexion a DB
        
            $objPHPExcel->setActiveSheetIndex(0)
            //Completamos celda A+# de fila con CI del empleado
            ->setCellValue('A'.$numero, $cedulaEvaluado);
            
            $codigoROL = first_month_day_codROLWinfenix(); //2018.03.03 ejemplo
            $fechainicioROL = first_month_day_anterior();
            $fechafinalROL = last_month_day_anterior();

            $db_empresa = getDataBase($empresaCod);

                    //2da consulta segun codigo de empleado, buscar evaluaciones en rango indicado
                    $consulta_evaluas = "SELECT SBIO.Codigo as CODEmpleado, (SBIO.Nombre + SBIO.Apellido) as EvaluadoN, CONVERT(date, SBIO.Fecha_Ing) as FechaIngreso , WP_Empresas.Nombre as EmpresaN ,CAB_EJI.codigo as CODEvaluacion , CAB_EJI.fecha as FechaEvaluacion , DETALLE_ev.ActividadesEsenciales, DETALLE_ev.Conocimientos, DETALLE_ev.ComTecnicas, DETALLE_ev.ComUniversales, DETALLE_ev.TIL, DETALLE_ev.RelClienteInterno,  DETALLE_ev.factor, CAB_EJI.observacion, DETALLE_ev.totalEV ,HISTORICO.Codigo AS CIEmpleado ,HISTORICO.Monto as Sueldo, HISTORICO2.Monto as HorasExtras FROM dbo.ROL_HISTORICO as HISTORICO INNER JOIN dbo.ROL_HISTORICO AS HISTORICO2 ON HISTORICO.Codigo=HISTORICO2.Codigo INNER JOIN SBIOKAO.dbo.Empleados AS SBIO on SBIO.Cedula COLLATE Modern_Spanish_CI_AS= HISTORICO.Codigo COLLATE Modern_Spanish_CI_AS  INNER JOIN KAO_wssp.dbo.CAB_EJI as CAB_EJI on CAB_EJI.empleado = SBIO.Codigo INNER JOIN KAO_wssp.dbo.resultados_EJI as DETALLE_ev on CAB_EJI.codigo = DETALLE_ev.codEV INNER JOIN SBIOKAO.dbo.Empresas_WF as WP_Empresas on WP_Empresas.Codigo = CAB_EJI.empresa WHERE HISTORICO.Codigo = '$cedulaEvaluado' AND HISTORICO.CodFor = 'A01' AND HISTORICO2.CodFor = 'A10' AND HISTORICO.Rol = '$codigoROL' AND HISTORICO2.Rol = '$codigoROL' AND CAB_EJI.Desde = '$fechainicioROL' AND CAB_EJI.Hasta = '$fechafinalROL' AND CAB_EJI.estado = '0'";
                    $result_query_evaluas = odbc_exec($db_empresa, $consulta_evaluas);
            
                    while(odbc_fetch_row($result_query_evaluas))
                        {
                        $cod_evaluas = odbc_result($result_query_evaluas,"CODEvaluacion");
                        $fecha_evaluas = odbc_result($result_query_evaluas,"FechaEvaluacion");

                        $actEsenciales = odbc_result($result_query_evaluas,"ActividadesEsenciales");
                        $conocimientos = odbc_result($result_query_evaluas,"Conocimientos");
                        $comTecnicas = odbc_result($result_query_evaluas,"ComTecnicas");
                        $comUniversales = odbc_result($result_query_evaluas,"ComUniversales");
                        $TIL = odbc_result($result_query_evaluas,"TIL");
                        $relClienteInterno = odbc_result($result_query_evaluas,"RelClienteInterno");

                        $puntaje_evaluas = round(odbc_result($result_query_evaluas,"totalEV"));
                        $factor_evaluas = odbc_result($result_query_evaluas,"factor");

                        $sueldo = odbc_result($result_query_evaluas,"Sueldo");
                        $horasExtras = odbc_result($result_query_evaluas,"horasExtras");

                        $observacion = odbc_result($result_query_evaluas,"observacion");
            
                        $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue('B'.$numero, $nombreEvaluador) 
                        ->setCellValue('C'.$numero, $nombreEvaluado)        
                        
                        ->setCellValue('E'.$numero, $fechaIngreso)
                        ->setCellValue('F'.$numero, $empresaN)        
                        ->setCellValue('G'.$numero, $cod_evaluas)
                        ->setCellValue('H'.$numero, $fecha_evaluas)
                        ->setCellValue('I'.$numero, $actEsenciales)
                        ->setCellValue('J'.$numero, $conocimientos)
                        ->setCellValue('K'.$numero, $comTecnicas)
                        ->setCellValue('L'.$numero, $comUniversales)
                        ->setCellValue('M'.$numero, $TIL)
                        ->setCellValue('N'.$numero, $relClienteInterno)
                        ->setCellValue('O'.$numero, $puntaje_evaluas)
                        ->setCellValue('P'.$numero, $sueldo)
                        ->setCellValue('Q'.$numero, $horasExtras)
                        ->setCellValue('R'.$numero, $observacion)
                        ;
                        $numero++;
                        }
            
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
