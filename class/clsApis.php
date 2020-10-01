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
    }

?>