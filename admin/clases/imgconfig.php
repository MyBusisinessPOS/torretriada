<?php
include_once('conexion.php');

class imgconfig
{
	  var $idconfiguracion;
	  var $alto;
	  var $ancho;
	  var $calidad;
	  
	  
	  function imgconfig($idc=1,$alto='',$ancho='',$calidad='')
	  {
		  $this->idconfiguracion=$idc;
		  $this->alto=$alto;
		  $this->ancho=$ancho;
		  $this->calidad=$calidad;
	  }
	  
	  function insertarimgconfig()
	  {
		  $sql="insert into imgconfig(alto,ancho,calidad) values ('".$this->alto."','".$this->ancho."','".$this->calidad."');";
		  $con=new conexion();
		  $con->ejecutar_sentencia($sql);
		  //echo $sql;
	  }
	  
	  function modificarimgconfig()
	  {
		  $sql="update imgconfig set alto='".$this->alto."',ancho='".$this->ancho."',calidad='".$this->calidad."' where idconfiguracion=".$this->idconfiguracion.";";
		  $con=new conexion();
		  $con->ejecutar_sentencia($sql);
	  }

	function obtenerimgconfig()
	{
	  $sql="select idconfiguracion, alto, ancho, calidad from imgconfig where idconfiguracion=".$this->idconfiguracion.";";
	  $con=new conexion();
	  $resultados=$con->ejecutar_sentencia($sql);
	  while ($fila=mysqli_fetch_array($resultados))
	  {
		$this->idconfiguracion=$fila['idconfiguracion'];
		$this->altomaximo=$fila['alto'];
		$this->anchomaximo=$fila['ancho'];
		$this->calidad=$fila['calidad'];
	  }
	  mysqli_free_result($resultados);
	}
	
	function listarimgconfig() {
		$resultados = array();
		$sql = "select * from imgconfig";
		$con = new conexion();
		$temporal = $con -> ejecutar_sentencia($sql);
		while ($fila = mysqli_fetch_array($temporal)) {
			$registro = array();
			$registro['idconfiguracion'] = $fila['idconfiguracion'];
			$registro['altomaximo'] = $fila['alto'];
			$registro['anchomaximo'] = $fila['ancho'];
			$registro['calidad'] = $fila['calidad'];
			array_push($resultados, $registro);
		}
		mysqli_free_result($temporal);
		return $resultados;
	}

}
?>