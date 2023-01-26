<?php
require_once 'conexion.php';

class portafolioxcategoria{
	var $_idPortafolio;
	var $_idCategoria;
	var $_idPadre;
	var $_idSubcategoria;
	var $_portafolios;
	var $_categorias;

	function __construct($_idPortafolio = 0, $_idCategoria = 0,$_idPadre=0,$_idSubcategoria=0){
		$this -> _idPortafolio = $_idPortafolio;
		$this -> _idCategoria = $_idCategoria;
		$this -> _idPadre	  = $_idPadre;
		$this -> _idSubcategoria = $_idSubcategoria;
		$this -> _portafolios = array();
		$this -> _categorias = array();
	}

	function addPortafolioxCategoria($_tipo){
		$_SQL = "INSERT INTO portafolioxcategoria (idPortafolio, idCategoria, idPadre, idSubcategoria, tipo) VALUES({$this -> _idPortafolio}, {$this -> _idCategoria}, {$this -> _idPadre},{$this -> _idSubcategoria},{$_tipo})";
		$_conexion = new conexion();
		$_conexion -> ejecutar_sentencia($_SQL);
	}

	function existPortafolioxCategoria(){
		$_conexion = new conexion();
		$_SQL = "SELECT idCategoria FROM portafolioxcategoria WHERE idPortafolio = {$this -> _idPortafolio} AND idCategoria = {$this -> _idCategoria}";
		$_conexion -> ejecutar_sentencia($_SQL);
		if($_conexion -> numRows() > 0) return true; else return false;
	}

	function existCategoriaxPortafolio($idC,$tipo){
		if($tipo==1){
			$cons = " AND idPadre = {$idC} AND tipo = 1";
		}else if($tipo==5){
			$cons = " AND idCategoria = {$idC} AND tipo=5";
		}else if($tipo==6){
			$cons = " AND idSubcategoria = {$idC} AND tipo=6";
		}
		$_conexion = new conexion();
		$_SQL = "SELECT idCategoria FROM portafolioxcategoria WHERE idPortafolio = {$this -> _idPortafolio} {$cons}";
		$_conexion -> ejecutar_sentencia($_SQL);
		if($_conexion -> numRows() > 0) return true; else return false;
	}

	function removeCategoriaxPortafolio(){
		$_SQL = "DELETE FROM portafolioxcategoria WHERE idCategoria = {$this -> _idCategoria}";
		$_conexion = new conexion();
		$_conexion -> ejecutar_sentencia($_SQL);
	}

	function removePortafolioxCategoria($tipo=''){
		$_SQL = "DELETE FROM portafolioxcategoria WHERE idPortafolio = {$this -> _idPortafolio} AND tipo={$tipo}";
		$_conexion = new conexion();
		$_conexion -> ejecutar_sentencia($_SQL);
	}

	function delCatxPortafolio(){
		$_SQL = "DELETE FROM portafolioxcategoria WHERE idPortafolio={$this->_idPortafolio}";
		$_conexion = new conexion();
		$_conexion -> ejecutar_sentencia($_SQL);
	}

	function listPortafolioxCategoria(){
		$_SQL = "SELECT idPortafolio FROM portafolioxcategoria WHERE idCategoria = {$this -> _idCategoria}";
		$_conexion = new conexion();
		$_conexion -> ejecutar_sentencia($_SQL);
		while($_row = $_conexion -> fetchRow()){
			$_registro['idPortafolio'] = $_row['idPortafolio'];
			array_push($this -> _portafolios, $_registro);
		}
	}

	function listCategoriaxPortafolio(){
		$_SQL = "SELECT idCategoria FROM portafolioxcategoria WHERE idPortafolio = {$this -> _idPortafolio}";
		$_conexion = new conexion();
		$_conexion -> ejecutar_sentencia($_SQL);
		while($_row = $_conexion -> fetchRow()){
			$_registro['idCategoria'] = $_row['idCategoria'];
			array_push($this -> _categorias, $_registro);
		}
	}

	function listNombreCategoriaxPortafolio($tipo){
		$_SQL = "SELECT categoria.idCategoria, categoria.tituloEs, categoria.tituloEn, categoria.urlAmigableEs, categoria.urlAmigableEn FROM portafolioxcategoria, categoria WHERE portafolioxcategoria.idCategoria = categoria.idCategoria AND categoria.status = 1 AND idPortafolio = {$this -> _idPortafolio} AND portafolioxcategoria.tipo={$tipo}";
		$_conexion = new conexion();
		$_conexion -> ejecutar_sentencia($_SQL);
		while($_row = $_conexion -> fetchRow()){
			$_registro['idCategoria'] 	= $_row['idCategoria'];
			$_registro['tituloEs'] 		= $_row['tituloEs'];
			$_registro['tituloEn'] 		= $_row['tituloEn'];
			$_registro['urlAmigableEs'] = $_row['urlAmigableEs'];
			$_registro['urlAmigableEn'] = $_row['urlAmigableEn'];
			array_push($this -> _categorias, $_registro);
		}
	}
	function listFiltrosCategorias($tipo){
		if($tipo==1){
			$cons = "portafolioxcategoria.idPadre";
		}else if($tipo==5){
			$cons = "portafolioxcategoria.idCategoria";
		}else if($tipo==6){
			$cons = "portafolioxcategoria.idSubcategoria";
		}
		$_SQL = "SELECT categoria.idCategoria, categoria.tituloEs, categoria.tituloEn, categoria.urlAmigableEs, categoria.urlAmigableEn FROM portafolioxcategoria, categoria WHERE {$cons} = categoria.idCategoria AND categoria.status = 1 AND idPortafolio = {$this -> _idPortafolio} AND portafolioxcategoria.tipo={$tipo}";
		$_conexion = new conexion();
		$_conexion -> ejecutar_sentencia($_SQL);
		while($_row = $_conexion -> fetchRow()){
			$_registro['idCategoria'] 	= $_row['idCategoria'];
			$_registro['tituloEs'] 		= $_row['tituloEs'];
			$_registro['tituloEn'] 		= $_row['tituloEn'];
			$_registro['urlAmigableEs'] = $_row['urlAmigableEs'];
			$_registro['urlAmigableEn'] = $_row['urlAmigableEn'];
			array_push($this -> _categorias, $_registro);
		}
	}

	function countParticipantesxImagen($idPortafolio){
		$sql = "SELECT count(idCategoria) AS total FROM portafolioxcategoria WHERE idPortafolio = {$idPortafolio}";
		$conexion = new conexion();
		$conexion -> ejecutar_sentencia($sql);
		$obj = $_conexion -> fetchRow();
		return $obj -> total;
	}

}
?>
