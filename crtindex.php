<?php 

include 'globalConfig.php';
header("Content-type: application/json"); 
include 'class/clsConnectDB.php';
include 'class/clsLogin.php';

//Datos

if (isset($_POST['accion'])) {

    if ($_POST['accion'] == 'acceder') {
            $user 	= $_POST['usuario'];
            $password 	= $_POST['password'];
            
            $login = new Login();
            $consulta = $login->iniciarSesion($user, $password);
            print_r($consulta);
    }
    if ($_POST['accion'] == 'cerrarsesion'){
        session_destroy();
    }
}
