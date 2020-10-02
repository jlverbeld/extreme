<?php 
    include '../../globalConfig.php';
    include '../../class/clsConnectDB.php';
    include '../../class/clsApis.php';

    //Apis de exportacion - Listados de citaciones PQR

    $Apis = new Apis();
    $listPQR = $Apis->listadoPQR();
    echo json_encode($listPQR, true );
?>