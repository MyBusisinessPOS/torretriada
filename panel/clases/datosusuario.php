<?php
include_once('conexion.php');
class datosusuario
{	
	var $idusuario;
	var $nombre;
	var $email;
	var $telefono;
	var $token;
		
	function __construct($id=0,$nom='',$mail='',$tel='')
	{
			$this->idusuario=$id;
			$this->nombre=$nom;			
			$this->email=$mail;
			$this->telefono=$tel;
	}
		
	function agregar_datos_usuario()
	{
		$con= new conexion();
		$sql="INSERT INTO datosusuario(idusuario,nombre,email,telefono,token) VALUES ('".$this->idusuario."','".$this->nombre."','".$this->email."','".$this->telefono."',MD5('".$this->email."'))";
		return $con->ejecutar_sentencia($sql);
	}
		
	function modificar_datos_usuario()
	{
		if($this->email != '')
			$pedazo = "email='".$this->email."', token = md5('".$this -> email."'), ";
		else
			$pedazo = '';
	  $con= new conexion();
	  $sql="UPDATE datosusuario  SET nombre='".$this->nombre."',".$pedazo."telefono='".$this->telefono."' WHERE idusuario='".$this->idusuario."';";
	  //echo $sql;
	  return $con->ejecutar_sentencia($sql);
	}
	
	function eliminar_datos_usuario()
	{
		$con= new conexion();
		$sql="DELETE FROM datosusuario WHERE idusuario='".$this->idusuario."';";
		return $con->ejecutar_sentencia($sql);
	}
	
	function obtener_datos_usuario()
	{
		$con = new conexion();
		$sql="SELECT * FROM datosusuario WHERE idusuario='".$this->idusuario."';";
		$con->ejecutar_sentencia($sql);
		while($fila = $con -> fetchRow())
		{
			$this->nombre=$fila['nombre'];				
			$this->email=$fila['email'];
			$this->telefono=$fila['telefono'];
			$this->token=$fila['token'];			
		}
	}
	function obtener_datos_usuario_token()
	{
		$con = new conexion();
		$sql="SELECT * FROM datosusuario WHERE token='".$this->token."';";
		$con->ejecutar_sentencia($sql);
		while($fila = $con -> fetchRow())
		{
			$this->idusuario=$fila['idusuario'];
			$this->nombre=$fila['nombre'];				
			$this->email=$fila['email'];
			$this->telefono=$fila['telefono'];			
		}
	}
	function buscaremail()
	{
		$conexion=new conexion();
		$sql="SELECT idusuario, nombre FROM datosusuario where email='".$this->email."'";
		$conexion->ejecutar_sentencia($sql);
		$resultados=array();
		while ($row=$conexion -> fetchRow())
		{
			$registro=array();
			$registro['idusuario']=$row['idusuario'];
			$registro['nombre']=$row['nombre'];
			array_push($resultados,$registro);
		}
		return $resultados;
	}
		
	}
?>