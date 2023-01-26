<?php
class conexion
{
var $host;
var $user;
var $password;
var $bd;
var $conexion;

	function conexion()
	{
		$this->host='localhost';
		$this->user='root';
		$this->password='';
		$this->bd='proyecto';
	}

	function conectar()
	{
		$this->conexion= mysqli_connect($this->host, $this->user, $this->password);
		mysqli_select_db($this->conexion, $this->bd);
	}

	function desconectar()
	{
		mysqli_close($this->conexion);
	}

	function ejecutar_sentencia($consulta)
	{

		$this->conectar();
		$resultados=mysqli_query($this->conexion,$consulta);
		if(!$resultados){
      		echo 'mysqli Error: ' . mysqli_error($this->conexion);
			//return 'error';
      	exit;
    	}
		if(preg_match('/insert/i',$consulta))
		{
			$resultados=mysqli_insert_id($this->conexion);
		}
		$this->desconectar();
		return $resultados;
	}

}
?>
