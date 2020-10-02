<?php
	session_start();
	$_SERVER['RUTA'] = "http://localhost/extreme/";
	if(!$_SESSION['idUsuario']){
		header('Location: '.$_SERVER['RUTA']);
	}
	set_time_limit(200);
	ini_set('max_execution_time', 200);
	date_default_timezone_set('America/Bogota');
?>