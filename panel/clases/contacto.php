<?php
include_once('conexion.php');

class contacto
{
	  var $idcontacto;
	  var $correo;
	  var $emisor;
	  var $latitud;
	  var $longitud;
	  var $redSocial;

	  function __construct($idc = 1, $correo = '', $emisor = '', $latitud = '', $longitud = '')
	  {
		  $this -> idcontacto = $idc;
		  $this -> correo = $correo;
		  $this -> emisor = $emisor;
		  $this -> latitud = $latitud;
		  $this -> longitud = $longitud;
	  }
	  
	  function insertar_contacto()
	  {
		  $sql = "insert into contacto(correo,emisor) values ('".$this->correo."','".$this->emisor."');";
		  $con = new conexion();
		  $con -> ejecutar_sentencia($sql);
		  //echo $sql;
	  }
	  
	  function modificar_contacto()
	  {
		 $sql = "update contacto set correo = '".$this->correo."', emisor = '".$this->emisor."', latitud = '".$this -> latitud."', longitud = '".$this -> longitud."' where idcontacto=".$this -> idcontacto.";";
		  $con = new conexion();
		  $con -> ejecutar_sentencia($sql);
	  }

	function obtener_contacto()
	{
	  $sql = "select * from contacto where idcontacto=".$this->idcontacto.";";
	  $con=new conexion();
	  $con->ejecutar_sentencia($sql);
	  while ($fila=$con -> fetchRow())
	  {
		$this -> idcontacto=$fila['idcontacto'];
		$this -> correo=$fila['correo'];
		$this -> emisor=$fila['emisor'];
		$this -> latitud = $fila['latitud'];
		$this -> longitud = $fila['longitud'];
	  }
	}

	function addRedSocial($titulo, $url, $icono){
		$sql = "INSERT into redSocial(titulo, url, icono) VALUES ('".htmlspecialchars($titulo, ENT_QUOTES)."', '".$url."', '".$icono."')";
		$conexion = new conexion();
		$conexion -> ejecutar_sentencia($sql);
	}

	function updateRedSocial($idRedSocial, $titulo, $url, $icono){
		$sql = "UPDATE redSocial SET titulo = '".htmlspecialchars($titulo, ENT_QUOTES)."', url = '".$url."', icono = '".$icono."' WHERE idRedSocial = ".$idRedSocial;
		$conexion = new conexion();
		$conexion -> ejecutar_sentencia($sql);
	}

	function deleteRedSocial($idRedSocial){
		$sql = "DELETE FROM redSocial WHERE idRedSocial = ".$idRedSocial;
		$conexion = new conexion();
		$conexion -> ejecutar_sentencia($sql);
	}

	function listRedSocial(){
		$sql = "SELECT * FROM redSocial";
		$conexion = new conexion();
		$conexion -> ejecutar_sentencia($sql);
		$resultados = array();
		while($row = $conexion -> fetchRow()){
			$registro['idRedSocial'] = $row['idRedSocial'];
			$registro['titulo'] = $row['titulo'];
			$registro['url'] = $row['url'];
			$registro['icono'] = $row['icono'];
			array_push($resultados, $registro);
		}
		return $resultados;
	}

}
?>