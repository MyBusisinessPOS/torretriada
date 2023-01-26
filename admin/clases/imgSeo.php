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

	function imgSeo ($idimgSeo =0 , $idseo = 0, $rut = '', $tit = '', $temporal = ''){
		$this -> idimgSeo = $idimgSeo;
		$this -> idseo = $idseo;
		$this -> ruta = $rut;
		$this -> titulo = $tit;

		$this -> ruta_final = $this -> directorio;
		$this -> ruta_temporal = $temporal;
	}



	function insertaimgSeo(){
		$ruta=$this -> subir_archivo($this->ruta);
		$sql="insert into imgseo(idseo, ruta, titulo) values (".$this -> idseo.", '".htmlspecialchars($ruta, ENT_QUOTES)."', '".htmlspecialchars($this -> titulo, ENT_QUOTES)."');";
		$con = new conexion();
		$this -> idimgSeo = $con -> ejecutar_sentencia($sql);
		$s = "update imgseo set orden = ".$this->idimgSeo." where idimgSeo = ".$this->idimgSeo."";
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

			$this->ruta_final=$this->directorio;
			$ruta=$this -> subir_archivo($this->ruta);
			$sql = ' ,ruta=\''.htmlspecialchars($ruta, ENT_QUOTES).'\'';
		}
		else{
			$sql = '';
		}

		$sql = "update imgseo set idseo = ".$this -> idseo." ".$sql." , titulo = '".htmlspecialchars($this -> titulo, ENT_QUOTES)."' where idimgSeo = ".$this -> idimgSeo.";";
		$con = new conexion();
		$con -> ejecutar_sentencia($sql);
	}

	function ordenaImgNoticia($orden){
		$con = new conexion();
		$sql= "update imgseo set orden ='".$orden."' where  idimgSeo=".$this -> idimgSeo." order by orden ASC;";
		$con -> ejecutar_sentencia($sql);
	}

	function eliminaimgSeo(){

		$this -> recuperaimgSeo();
		$this -> borrar_archivo();

		$sql = "delete from imgseo where idimgSeo =".$this -> idimgSeo.";";
		$con = new conexion();
		$con -> ejecutar_sentencia($sql);
	}

	function obtenerimgSeo(){
		$sql = "select idimgSeo, idseo, ruta, titulo from imgseo where idimgSeo =".$this -> idimgSeo;
		$con = new conexion();
		$resultados = $con -> ejecutar_sentencia($sql);

		while ($fila = mysqli_fetch_array($resultados))
		{
			$this -> idimgSeo = $fila['idimgSeo'];
			$this -> idseo = $fila['idseo'];
			$this -> ruta = $fila['ruta'];
			$this -> titulo = $fila['titulo'];
			$this -> ruta_final = $this -> directorio.$fila['ruta'];
		}
	}

	function obtenerimgSeofinal(){
		$sql = "select ruta from imgseo where idseo =".$this -> idseo;
		$con = new conexion();
		$resultados = $con -> ejecutar_sentencia($sql);

		while ($fila = mysqli_fetch_array($resultados))
		{
			$this -> ruta = $fila['ruta'];
			$this -> ruta_final = $this -> directorio.$fila['ruta'];
		}
	}

	function recuperaimgSeo(){
		$sql = "select idimgSeo, idseo, ruta, titulo from imgseo where idimgSeo=".$this->idimgSeo;
		$con = new conexion();
		$resultados = $con -> ejecutar_sentencia($sql);

		while ($fila = mysqli_fetch_array($resultados))
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
		$sql = "select idimgSeo, idseo, ruta, titulo from imgseo where idseo =".$this -> idseo."";
		$con = new conexion();
		$temporal = $con -> ejecutar_sentencia($sql);
		while ($fila = mysqli_fetch_array($temporal))
		{
			$registro = array();
			$registro['idimgSeo'] = $fila['idimgSeo'];
			$registro['idseo'] = $fila['idseo'];
			$registro['ruta'] = $fila['ruta'];
			$registro['titulo'] = $fila['titulo'];
			array_push($resultados, $registro);
		}
		mysqli_free_result($temporal);
		return $resultados;
	}
}
?>
