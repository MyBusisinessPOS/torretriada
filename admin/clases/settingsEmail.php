<?php
include_once('conexion.php');

/**
 * @author Luis J. Caamal.
 * @copyright 2015 Luis J. Caamal.
 */
class settingsEmail
{
	/**
	 * Indentificador de la clase y BD
	 * @var Integer
	 */
	var $idsettingsEmail;

	/**
	 * Nombre del host: "smtp1.example.com:25; smtp2.example.com"
	 * @var String
	 */
	var $host;

	/**
	 * Puerto de entrada del email: 25, 452.
	 * @var Int
	 */
	var $port;

	/**
	 * Nombre de usuario del servicio de correo.
	 * @var String
	 */
	var $username;

	/**
	 * Contraseña del servicio de correo.
	 * @var String
	 */
	var $password;

	/**
	 * Correo de donde pertenece la empresa: noreply@empresa.com
	 * @var String
	 */
	var $noReply;

	/**
	 * Nombre de la empresa: Empresa MX.
	 * @var String
	 */
	var $fromname;

	/**
	 * Correo para enviar copia de los emails: copia@empresa.com
	 * @var String
	 */
	var $addCC;

	/**
	 * Metodo Constructor de la clase settingsEmail.
	 * @param  integer $idsettingsEmail
	 * @param  string  $host
	 * @param  Int     $port
	 * @param  string  $username
	 * @param  string  $password
	 * @param  string  $noReply
	 * @param  string  $fromname
	 * @param  string  $addCC
	 * @return Void
	 */
	function settingsEmail($idsettingsEmail = 1, $host = '', $port = 0, $username = '', $password = '', $noReply = '', $fromname = '', $addCC = ''){
		$this -> idsettingsEmail = $idsettingsEmail;
		$this -> host = $host;
		$this -> port = $port;
		$this -> username = $username;
		$this -> password = $password;
		$this -> noReply = $noReply;
		$this -> fromname = $fromname;
		$this -> addCC = $addCC;
	}

	/**
	 * Modifica los campos en la BD
	 * @return Void
	 */
	function modificar_settingsEmail(){
		// Variable contiene la consulta SQL.
		$sql="UPDATE settingsEmail SET
		host = '".$this -> host."',
		port ='".$this -> port."',
		username = '".$this -> username."',
		password = '".$this -> password."',
		noReply = '".$this -> noReply."',
		fromname = '".$this -> fromname."',
		addCC = '".$this -> addCC."'
		WHERE idsettingsEmail = ".$this->idsettingsEmail.";";

		// Instancia de la clase conexion.
		$con = new conexion();

		// Metodo que ejecuta la sentencia SQL.
		$con -> ejecutar_sentencia($sql);
	}

	/**
	 * Obtiene todos los campos de la BD
	 * @return Void
	 */
	function obtener_settingsEmail(){
	  // Variable contiene la consulta SQL.
	  $sql = "select host, port, username, password, noReply, fromname, addCC from settingsEmail where idsettingsEmail = ".$this -> idsettingsEmail." ;";

	  // Instancia de la clase conexion.
	  $con = new conexion();

	  // Metodo que ejecuta la sentencia SQL y el resultado se almacena en la variable resultados.
	  $resultados = $con -> ejecutar_sentencia($sql);

	  // Recorre cada uno de las filas.
	  while($fila = mysqli_fetch_array($resultados)){
		$this -> host = $fila['host'];
		$this -> port = $fila['port'];
		$this -> username = $fila['username'];
		$this -> password = $fila['password'];
		$this -> noReply = $fila['noReply'];
		$this -> fromname = $fila['fromname'];
		$this -> addCC = $fila['addCC'];
	  }

	  //Limpia cache.
	  mysqli_free_result($resultados);
	}

}
?>
