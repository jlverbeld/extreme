<?php
	include '../../globalConfig.php';
	header("Content-type: application/json"); 
	include '../../class/clsConnectDB.php';
	include '../../class/clsDashboard.php';

	//Datos

	if (isset($_POST['accion'])) {

		if ($_POST['accion'] == 'guardarCliente') {
			
			$nombre 	= $_POST['nombre'];
			$apellido 	= $_POST['apellido'];
			$email		= $_POST['email'];
			$telefono  	= $_POST['telefono'];
			$comentario = $_POST['comentario'];
			$usuario = $_POST['usuario'];
			$password = $_POST['password'];

			$Dashboard = new Dashboard();
			$guardado = $Dashboard->guardarClientes(
				$nombre,$apellido,$email,$telefono,$comentario,$usuario,$password);
			
			if($guardado){
				echo 'Usuario Registrado Correctamente!';
				return;
			}
		}

		if($_POST['accion'] == 'eliminarCliente'){

			
			$idCliente 	= $_POST['idCliente'];

			$Dashboard = new Dashboard();
			$eliminado = $Dashboard->eliminarClientes($idCliente);
			if($eliminado){
				echo 'Usuario Eliminado Correctamente';
				return;
			}
		}

		if($_POST['accion'] == 'editarCliente'){
			
			$idCliente 	= $_POST['idCliente'];
			$nombre 	= $_POST['nombre'];
			$apellido 	= $_POST['apellido'];
			$email		= $_POST['email'];
			$telefono  	= $_POST['telefono'];
			$comentario = $_POST['comentario'];
			$usuario = $_POST['usuario'];
			$password = $_POST['password'];

			$Dashboard = new Dashboard();
			$editado = $Dashboard->editarCliente(
				$nombre,$apellido,$email,$telefono,$comentario,$idCliente,$usuario,$password
			);
			
			if($editado){
				echo 'Usuario Editado Correctamente!';
				return;
			}
		}

		if($_POST['accion'] == 'consultarCliente'){

			$idCliente 	= $_POST['idCliente'];
			
			$Dashboard = new Dashboard();
			$datosCliente = $Dashboard->consultarCliente($idCliente);
			
			echo json_encode($datosCliente);
			return;
			
		}

		if($_POST['accion'] == 'cargarIdUsuarioPQR'){
			$idUsuario = $_POST['idUsuario'];

			$Dashboard = new Dashboard();
			$datosUsuario = $Dashboard->consultarCliente($idUsuario);
			echo json_encode($datosUsuario);
			return;
			
		}
		
		if($_POST['accion'] == 'guardarPQR'){
			$idUsuario = $_POST['idUsuario'];
			$tipo_pqr = $_POST['tipo_pqr'];
			$asunto_pqr = $_POST['asunto_pqr'];

			$Dashboard = new Dashboard();
			$datosPQR = $Dashboard->guardarPQR($idUsuario,$tipo_pqr, $asunto_pqr);
			echo json_encode($datosPQR);
			return;
			
		}

		if($_POST['accion'] == 'cargarPQR'){

			$idPQR = $_POST['idPQR'];
		
			$Dashboard = new Dashboard();
			$datosPQR = $Dashboard->cargarPQR($idPQR);
			echo json_encode($datosPQR);
			return;
		}

		if($_POST['accion'] == 'modificarPQR'){
			$idUsuario = $_POST['idUsuario'];
			$tipo_pqr = $_POST['tipo_pqr'];
			$asunto_pqr = $_POST['asunto_pqr'];
			$estado_pqr = $_POST['estado_pqr'];
			$idPQR = $_POST['idPQR'];


			$Dashboard = new Dashboard();
			$datosPQR = $Dashboard->modificarPQR($estado_pqr, $idPQR);
			echo json_encode($datosPQR);
			return;
		}

		if($_POST['accion'] == 'eliminarPQR'){
			$idPQR = $_POST['idPQR'];

			$Dashboard = new Dashboard();
			$datosPQR = $Dashboard->eliminarPQR($idPQR);
			echo $datosPQR;
			return;
		}

		
	}


?>