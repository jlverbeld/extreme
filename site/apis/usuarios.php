<?php 
    include '../../globalConfig.php';
    include '../../class/clsConnectDB.php';
    include '../../class/clsApis.php';

    //Apis de exportacion - listados de Usuarios

    $Apis = new Apis();
    $listUsers = $Apis->listadoUsuarios();
    echo  json_encode($listUsers, true );
?>