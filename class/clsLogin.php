<?php
	/**
	* 
	*/
	class Login
	{
		private $operacion = "";
		private $db;
		function __construct() {
			$this->db = new ConnectDB();
		}
		
		/* 
		*VALIDACION DE DATO PARA INICIO DE SESION
		*/
		function iniciarSesion($usuario, $contraseña){
            $contraseña = sha1($contraseña);
            $query = "SELECT * FROM users WHERE user ='".$usuario."'  AND password = '".$contraseña."' ";
            $rst = $this->db->enviarQuery($query,'CUD');            
            
            if($rst == 1){
                $rst2 = $this->db->enviarQuery($query,'R');   
               
                $r= $rst2[0];
                
                $_SESSION["idUsuario"]=$r['id'];
                $_SESSION["nombre"]=$r['firstname'];
                $_SESSION["usuario"]=$r['user'];
                $_SESSION["rol"]=$r['rol'];
            }
			return $rst;
		}
}