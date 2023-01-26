<?php
include_once('conexion.php');
require_once('archivo.php');

class imgSeo extends Archivo
{
	var $idimgSeo;
	var $titulo;
	var $ruta;
	var $idseo;
	var $directorio = '../img/imgSeo/';
	var $orden;

	function __construct ($idimgSeo =0 , $idseo = 0, $rut = '', $tit = '', $temporal = ''){
		$this -> idimgSeo = $idimgSeo;
		$this -> idseo = $idseo;
		$this -> ruta = $rut;
		$this -> titulo = $tit;

		$this -> ruta_final = $this -> directorio.$rut;
		$this -> ruta_temporal = $temporal;
	}



	function insertaimgSeo(){
		$sql="insert into imgSeo(idseo, ruta, titulo) values (".$this -> idseo.", '".htmlspecialchars($this -> ruta, ENT_QUOTES)."', '".htmlspecialchars($this -> titulo, ENT_QUOTES)."');";
		$con = new conexion();
		$this -> idimgSeo = $con -> ejecutar_sentencia($sql);
		$this -> subir_archivo();
		$s = "update imgSeo set orden = ".$this->idimgSeo." where idimgSeo = ".$this->idimgSeo."";
		$con -> ejecutar_sentencia($s);
	}


	function modificaimgSeo(){

		if ($this -> ruta != ''){

			$titulo_temporal = $this -> titulo;
			$ruta_temporal = $this -> ruta;

			$this -> recuperaimgSeo();
			$this -> borrar_archivo();

			$this -> titulo = $titulo_temporal;
			$this -> ruta = $ruta_temporal;

			$this -> ruta_final = $this -> directorio.$ruta_temporal;
			$sql = ' ,ruta=\''.htmlspecialchars($this -> ruta, ENT_QUOTES).'\'';
		}
		else{
			$sql = '';
		}

		$sql = "update imgSeo set idseo = ".$this -> idseo." ".$sql." , titulo = '".htmlspecialchars($this -> titulo, ENT_QUOTES)."' where idimgSeo = ".$this -> idimgSeo.";";
		$con = new conexion();
		$con -> ejecutar_sentencia($sql);
		$this -> subir_archivo();
	}

	function ordenaImgNoticia($orden){
		$con = new conexion();
		$sql= "update imgSeo set orden ='".$orden."' where  idimgSeo=".$this -> idimgSeo." order by orden ASC;";
		$con -> ejecutar_sentencia($sql);
	}

	function eliminaimgSeo(){

		$this -> recuperaimgSeo();
		$this -> borrar_archivo();

		$sql = "delete from imgSeo where idimgSeo =".$this -> idimgSeo.";";
		$con = new conexion();
		$con -> ejecutar_sentencia($sql);
	}

	function obtenerimgSeo(){
		$sql = "select idimgSeo, idseo, ruta, titulo from imgSeo where idimgSeo =".$this -> idimgSeo;
		$con = new conexion();
		$con -> ejecutar_sentencia($sql);

		while ($fila = $con -> fetchRow())
		{
			$this -> idimgSeo = $fila['idimgSeo'];
			$this -> idseo = $fila['idseo'];
			$this -> ruta = $fila['ruta'];
			$this -> titulo = $fila['titulo'];
			$this -> ruta_final = $this -> directorio.$fila['ruta'];
		}
	}

	function obtenerimgSeofinal(){
		$sql = "select ruta from imgSeo where idseo =".$this -> idseo;
		$con = new conexion();
		$con -> ejecutar_sentencia($sql);

		while ($fila = $con -> fetchRow())
		{
			$this -> ruta = $fila['ruta'];
			$this -> ruta_final = $this -> directorio.$fila['ruta'];
		}
	}

	function recuperaimgSeo(){
		$sql = "select idimgSeo, idseo, ruta, titulo from imgSeo where idimgSeo=".$this->idimgSeo;
		$con = new conexion();
	 	$con -> ejecutar_sentencia($sql);

		while ($fila = $con -> fetchRow())
		{
			$this -> idimgSeo= $fila['idimgSeo'];
			$this -> idseo = $fila['idseo'];
			$this -> ruta = $fila['ruta'];
			$this -> titulo = $fila['titulo'];
			$this -> ruta_final = $this -> directorio.$fila['ruta'];

		}
	}

	function listarimgSeo(){
		$resultados = array();
		$sql = "select idimgSeo, idseo, ruta, titulo from imgSeo where idseo =".$this -> idseo."";
		$con = new conexion();
		$con -> ejecutar_sentencia($sql);
		while ($fila = $con -> fetchRow())
		{
			$registro = array();
			$registro['idimgSeo'] = $fila['idimgSeo'];
			$registro['idseo'] = $fila['idseo'];
			$registro['ruta'] = $fila['ruta'];
			$registro['titulo'] = $fila['titulo'];
			array_push($resultados, $registro);
		}
		return $resultados;
	}
}
?>
