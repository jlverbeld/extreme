<?php
	/**
	* 
	*/
	class Dashboard
	{
		private $operacion = "";
		private $db;
		function __construct() {
			$this->db = new ConnectDB();
		}

		/* 
		Guardado de Usuario - insercion database
		 */
		function guardarClientes($firstname,$lastname,$email,$phone,$commentary,$usuario,$password){
			
			$password = sha1($password);
			//SQL
			$query = "INSERT INTO users (firstname,lastname,email,phone,commentary,rol,user,password) 
			VALUES (
				'".$firstname."',
				'".$lastname."',
				'".$email."',
				'".$phone."',
				'".$commentary."',
				'Usuario',
				'".$usuario."',
				'".$password."'
				);";
			$rst = $this->db->enviarQuery($query,'CUD');
			return $rst;
		}
		/* 
		Listado de usuarios Registrados
		 */
		function listadoClientes(){
			
			//SQL
			$query = "SELECT * FROM users ORDER BY rol,id DESC;";
			$rst = $this->db->enviarQuery($query,'R');
			
			if(@$rst[0]['id'] != ""){
				return $rst;
			}else{
				return array("ErrorStatus"=>true);
			}
		}

		/* 
			Eliminar usuarios Registrados 
		*/
		function eliminarClientes($idCliente){
				
			//SQL
			$query = "DELETE FROM users WHERE id = $idCliente;";
			$rst = $this->db->enviarQuery($query,'CUD');
			return $rst;
		}

		/* 
			Edicion de usuarios Segun ID
		*/
		function editarCliente(
			$firstname,$lastname,$email,$phone,$commentary,$idCliente,$usuario,$password){
			
			$password = sha1($password);
			//SQL
			$query = "UPDATE users SET 
				firstname = '".$firstname."',
				lastname = '".$lastname."',
				email = '".$email."',
				phone = '".$phone."',
				commentary = '".$commentary."' ,
				updated_at = NOW(),
				user = '".$usuario."'";
				if($password != ''){
					$query.= ", password = '".$password."'";
				}
				$query .="
				
				WHERE id = '".$idCliente."';";

			$rst = $this->db->enviarQuery($query,'CUD');
			return $rst;
		}

		/* 
		* Consultar datos del cliente segun ID
		*/
		function consultarCliente($idCliente){
			//SQL
			$query = "SELECT * FROM users WHERE id = $idCliente;";
			$rst = $this->db->enviarQuery($query,'R');
			
			$data = @$rst[0];
			if(@$rst[0]['id'] != ""){
				return $data;
			}else{
				return array("ErrorStatus"=>true);
			}
		}

		//------------------------

		/* 
		*GUARDAR PQR - registro de PQR
		*/
		function guardarPQR($idUsuario,$tipo_pqr,$asunto_pqr ){
			$fecha_creacion = date('Y-m-d h:i:s');
			
			//validacion vencimiento segun tipo de PQR
			if($tipo_pqr == 'Petición'){
				$limiteAtencion = 7;
			}else if($tipo_pqr == 'Queja'){
				$limiteAtencion = 3;
			}else if($tipo_pqr == 'Reclamo'){
				$limiteAtencion = 2;
			}
			$nuevafecha = strtotime ( '+'.$limiteAtencion.' day' , strtotime ( $fecha_creacion ) ) ;
			$fechaLimite = date ( 'Y-m-d h:i:s' , $nuevafecha );
		
			
			
			$query = "INSERT INTO pqr (id_usuario,tipo_pqr,asunto_pqr,estado,fecha_creacion,fecha_limite) 
			VALUES (
				'".$idUsuario."',
				'".$tipo_pqr."',
				'".$asunto_pqr."',
				'Nuevo',
				'".$fecha_creacion."',
				'".$fechaLimite."'
				);";


			$rst = $this->db->enviarQuery($query,'CUD');
			return $rst;
		}

		/* 
		*LISTA DE PQRs
		*/
		function listPQR(){
			
			//cambio de estado de PQR Vencidos
			$query2 = "SELECT *, p.id as pqrID FROM pqr p
			inner join users u on u.id = p.id_usuario
			WHERE 
			fecha_limite < NOW() and estado <> 'Vencida' or  
			fecha_limite < NOW() and estado <> 'Cerrado'
			";
			$rst2 = $this->db->enviarQuery($query2,'R');
			if(@$rst2[0]['id'] != ""){
				foreach($rst2 as $r2){
					
					$query2 = "UPDATE pqr SET 
					estado = 'Vencida'
					WHERE id = ".$r2['pqrID']."
					";

					//ENVIO DE CORREO 
					
					//Envio de correo
					$cabeceras = 'MIME-Version: 1.0' . "\r\n";
					$cabeceras .= 'Content-type: text/html; charset=utf-8' . "\r\n";
					$para = '"'.$r2['email'].'"' ;
					$titulo = 'AVISO! - '.$r2['tipo_pqr'].' VENCIDA ';
					$mensaje = '<html>'.
					'<head><title>PQR VENCIDA</title></head>'.
					'<body>'.
					
					'Por medio de la presete le informamos que su '.$r2['tipo_pqr'].'ha Vencido'.
					
					'</body>'.
					'</html>';
					//$enviado = mail($para, $titulo, $mensaje, $cabeceras);

					$this->db->enviarQuery($query2,'R');

				}
			}
			
			//SQL
			$query = "SELECT p.id,id_usuario, firstname, lastname, tipo_pqr, asunto_pqr, estado,fecha_creacion, fecha_limite FROM pqr p
			INNER JOIN users u ON u.`id` = p.`id_usuario`";
			$rst = $this->db->enviarQuery($query,'R');
			
			if(@$rst[0]['id'] != ""){
				return $rst;
			}else{
				return array("ErrorStatus"=>true);
			}
		}

		/* 
		*CARGA DE DATOS VIA ID - SEGUN PQR
		*/
		function cargarPQR($idPQR){
			$query = "SELECT *, p.id as pqrId, u.id as userId FROM pqr p
			INNER JOIN users u ON u.`id` = p.`id_usuario`
			 WHERE p.id = $idPQR";
			$rst = $this->db->enviarQuery($query,'R');
			
			if(@$rst[0]['id'] != ""){
				return $rst;
			}else{
				return array("ErrorStatus"=>true);
			}
		}

		/* 
		*MODIFICACION DE ESTADOS DE PQR
		*/
		function modificarPQR($estado_pqr,$idPQR){
			$query = "UPDATE pqr SET 
				estado = '".$estado_pqr."',
				updated_at = NOW()
				WHERE id = '".$idPQR."';";

			$rst = $this->db->enviarQuery($query,'CUD');
			return $rst;
		}

		/* 
		*ELIMINACION DE PQR
		*/
		function eliminarPQR($idPQR){
			$query = "DELETE FROM pqr WHERE id = $idPQR;";
			$rst = $this->db->enviarQuery($query,'CUD');
			return $rst;
		}





	}
?>