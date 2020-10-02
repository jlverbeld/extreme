<?php
	/**
	* 
	*/
	class Apis
	{
		private $operacion = "";
		private $db;
		function __construct() {
			$this->db = new ConnectDB();
        }
		
		/* 
		* API - Exportacion de listado de usuarios
		*/
        function listadoUsuarios(){
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
		*API - Exportacion de listado de PQRs
		*/
		function listadoPQR(){
			//SQL
			$query = "SELECT * FROM pqr";
			$rst = $this->db->enviarQuery($query,'R');
			
			if(@$rst[0]['id'] != ""){
				return $rst;
			}else{
				return array("ErrorStatus"=>true);
			}
		}
    }

?>