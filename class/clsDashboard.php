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
		Guardado de Clientes - insercion database
		 */
		function guardarClientes($firstname,$lastname,$email,$phone,$commentary){
			//Procedimiento Almacenado
			/* $query = "CALL sp_clients (
				'registrar',
				'$firstname',
				'$lastname',
				'$email',
				'$phone',
				'$commentary',
				''
				)"; */
			//SQL
			$query = "INSERT INTO users (firstname,lastname,email,phone,commentary) 
			VALUES ('".$firstname."','".$lastname."','".$email."','".$phone."','".$commentary."');";
			$rst = $this->db->enviarQuery($query,'CUD');
			return $rst;
		}
		/* 
		Listado de clientes Registrados
		 */
		function listadoClientes(){
			//Procedimiento Alamacenado
			/* $query = "CALL sp_clients ('consultar','','','','','','')"; */
			//SQL
			$query = "SELECT * FROM users ORDER BY id DESC;";
			$rst = $this->db->enviarQuery($query,'R');
			
			if(@$rst[0]['id'] != ""){
				return $rst;
			}else{
				return array("ErrorStatus"=>true);
			}
		}

		/* 
			Eliminar Clientes Registrados 
		*/
		function eliminarClientes($idCliente){
			//Procedimiento Almacenado
			/* $query = "CALL sp_clients (
				'eliminar',
				'',
				'',
				'',
				'',
				'',
				'$idCliente'
				)"; */
				
			//SQL
			$query = "DELETE FROM users WHERE id = $idCliente;";
			$rst = $this->db->enviarQuery($query,'CUD');
			return $rst;
		}

		/* 
			Edicion de cliente Segun ID
		*/
		function editarCliente($firstname,$lastname,$email,$phone,$commentary,$idCliente){
			//Procedimiento Almacenado
			/* $query = "CALL sp_clients (
				'modificar',
				'$firstname',
				'$lastname',
				'$email',
				'$phone',
				'$commentary',
				'$idCliente'
				)"; */
			//SQL
			$query = "UPDATE users SET 
				firstname = '".$firstname."',
				lastname = '".$lastname."',
				email = '".$email."',
				phone = '".$phone."',
				commentary = '".$commentary."' ,
				updated_at = NOW()
				WHERE id = '".$idCliente."';";

			$rst = $this->db->enviarQuery($query,'CUD');
			return $rst;
		}

		/* 
		* Consultar datos del cliente segun ID
		*/
		function consultarCliente($idCliente){
			//Procedimiento Almacenado
			/* $query = "CALL sp_clients ('consultarById','','','','','','$idCliente')"; */
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

	}
?>