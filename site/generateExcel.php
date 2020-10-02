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


foreach ($listPQRs as $p){
    //print_r($p);
    $sheet->setCellValue('A1', $p['id']); 
    //Damos formato o estilo a nuestra celda 
    $sheet->getStyle('A1')->getFont()->setName('Tahoma')->setBold(true)->setSize(8); 
    $sheet->getStyle('A1')->getBorders()->applyFromArray(array('allBorders' => 'thin')); 
    $sheet->getStyle('A1')->getAlignment()->setVertical('center')->setHorizontal('center'); 
   
    $sheet->setCellValue('B1', $p['id_usuario']); 
    //usamos los mismos estilos de A1 
    $sheet->getStyle('B1')->getFont()->setName('Tahoma')->setBold(true)->setSize(8); 
    $sheet->getStyle('B1')->getBorders()->applyFromArray(array('allBorders' => 'thin')); 
    $sheet->getStyle('B1')->getAlignment()->setVertical('center')->setHorizontal('center'); 

}

//exportamos nuestro documento 
$writer = new PHPExcel_Writer_Excel2007($excel); 
//$writer->save('excel.xlsx'); 