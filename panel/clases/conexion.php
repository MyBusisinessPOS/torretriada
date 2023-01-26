<?php
class conexion{
	var $host;
	var $user;
	var $password;
	var $bd;
	var $conexion;
	var $temporal;

	function __construct(){
		$this -> host 		= 'localhost';
		$this -> user 		= 'root';
		$this -> bd 		= 'proyecto';
		$this -> password 	='';
	}

	function conectar(){
		$this -> conexion = mysqli_connect($this -> host, $this -> user, $this -> password);
		mysqli_select_db($this -> conexion, $this -> bd);
	}

	function desconectar(){
		mysqli_close($this -> conexion);
	}

	function ejecutar_sentencia($consulta){
		$this -> conectar();
		$resultados = mysqli_query($this -> conexion, $consulta);
		if(!$resultados){
      		echo 'mysqli Error: ' .$consulta. mysqli_error($this -> conexion);
			//return 'error';
      	exit;
    	}
		if(preg_match('/insert/i', $consulta)){
			$resultados = mysqli_insert_id($this -> conexion);
			return $resultados;
			$this -> desconectar();
		}else{
			$this -> temporal = $resultados;
			$this -> desconectar();
		}
	}

	function fetchRow(){
		$_response = mysqli_fetch_array($this -> temporal);
		return $_response;
	}

	function fetchObject(){
		$_response = mysqli_fetch_object($this -> temporal);
		return $_response;
	}

	function numRows(){
		$_response = mysqli_num_rows($this -> temporal);
		return $_response;
	}
}
?>
