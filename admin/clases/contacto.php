<?php
include_once('conexion.php');

class contacto
{
	  var $idcontacto;
	  var $correo;
	  var $emisor;
	  
	  function contacto($idc=1,$correo='',$emisor='')
	  {
		  $this->idcontacto=$idc;
		  $this->correo=$correo;
		  $this->emisor=$emisor;
	  }
	  
	  function insertar_contacto()
	  {
		  $sql="insert into contacto(correo,emisor) values ('".$this->correo."','".$this->emisor."');";
		  $con=new conexion();
		  $con->ejecutar_sentencia($sql);
		  //echo $sql;
	  }
	  
	  function modificar_contacto()
	  {
		  $sql="update contacto set correo='".$this->correo."',emisor='".$this->emisor."' where idcontacto=".$this->idcontacto.";";
		  $con=new conexion();
		  $con->ejecutar_sentencia($sql);
	  }

	function obtener_contacto()
	{
	  $sql="select idcontacto, correo, emisor from contacto where idcontacto=".$this->idcontacto.";";
	  $con=new conexion();
	  $resultados=$con->ejecutar_sentencia($sql);
	  while ($fila=mysqli_fetch_array($resultados))
	  {
		$this->idcontacto=$fila['idcontacto'];
		$this->correo=$fila['correo'];
		$this->emisor=$fila['emisor'];
	  }
	  mysqli_free_result($resultados);
	}

}
?>