<?php 
 include '../globalConfig.php';
 include '../class/clsConnectDB.php';
 include '../class/clsDashboard.php';
 $Dashboard = new Dashboard();
 $listClients = $Dashboard->listadoClientes();
 $listPQRs = $Dashboard->listPQR();
 
include '../class/PHPExcel/PHPExcel.php';

$excel = new PHPExcel(); 
//Usamos el worsheet por defecto 
$sheet = $excel->getActiveSheet(); 
//Agregamos un texto a la celda A1 

$sheet->setCellValue('A1', 'NOMBRE COMPLETO'); 
$sheet->getStyle('A1')->getFont()->setName('Tahoma')->setBold(true)->setSize(8); 
$sheet->getStyle('A1')->getBorders()->applyFromArray(array('allBorders' => 'thin')); 
$sheet->getStyle('A1')->getAlignment()->setVertical('center')->setHorizontal('center'); 

$sheet->setCellValue('B1', 'TIPO DE PQR'); 
$sheet->getStyle('B1')->getFont()->setName('Tahoma')->setBold(true)->setSize(8); 
$sheet->getStyle('B1')->getBorders()->applyFromArray(array('allBorders' => 'thin')); 
$sheet->getStyle('B1')->getAlignment()->setVertical('center')->setHorizontal('center'); 

$sheet->setCellValue('C1', 'ASUNTO'); 
$sheet->getStyle('C1')->getFont()->setName('Tahoma')->setBold(true)->setSize(8); 
$sheet->getStyle('C1')->getBorders()->applyFromArray(array('allBorders' => 'thin')); 
$sheet->getStyle('C1')->getAlignment()->setVertical('center')->setHorizontal('center'); 

$sheet->setCellValue('D1', 'ESTADO'); 
$sheet->getStyle('D1')->getFont()->setName('Tahoma')->setBold(true)->setSize(8); 
$sheet->getStyle('D1')->getBorders()->applyFromArray(array('allBorders' => 'thin')); 
$sheet->getStyle('D1')->getAlignment()->setVertical('center')->setHorizontal('center'); 

$sheet->setCellValue('E1', 'FECHA DE CREACION'); 
$sheet->getStyle('E1')->getFont()->setName('Tahoma')->setBold(true)->setSize(8); 
$sheet->getStyle('E1')->getBorders()->applyFromArray(array('allBorders' => 'thin')); 
$sheet->getStyle('E1')->getAlignment()->setVertical('center')->setHorizontal('center'); 

$sheet->setCellValue('F1', 'FECHA LIMITE'); 
$sheet->getStyle('F1')->getFont()->setName('Tahoma')->setBold(true)->setSize(8); 
$sheet->getStyle('F1')->getBorders()->applyFromArray(array('allBorders' => 'thin')); 
$sheet->getStyle('F1')->getAlignment()->setVertical('center')->setHorizontal('center'); 

$cont = 2;
foreach ($listPQRs as $p){
    
    $sheet->setCellValue('A'.$cont.'', $p['firstname'] .' '.$p['lastname']); 
    $sheet->setCellValue('B'.$cont.'', $p['tipo_pqr']); 
    $sheet->setCellValue('C'.$cont.'', $p['asunto_pqr']); 
    $sheet->setCellValue('D'.$cont.'', $p['estado']); 
    $sheet->setCellValue('E'.$cont.'', $p['fecha_creacion']); 
    $sheet->setCellValue('F'.$cont.'', $p['fecha_limite']); 

    $cont = $cont + 1;
}

//exportamos nuestro documento 
$writer = new PHPExcel_Writer_Excel2007($excel); 
$writer->save('excel.xlsx'); 
?>
