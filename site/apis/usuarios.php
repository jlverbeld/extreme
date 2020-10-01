<?php 
    include '../../globalConfig.php';
    include '../../class/clsConnectDB.php';
    include '../../class/clsApis.php';

    $Apis = new Apis();
    $listClients = $Apis->listadoClientes();
    //print_r($listClients);

    echo  json_encode($listClients, true );
?>