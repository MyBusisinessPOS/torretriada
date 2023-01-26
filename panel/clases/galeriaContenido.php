<?php
require_once 'conexion.php';
require_once 'herramientas.php';
require_once 'archivo.php';

class galeriaContenido extends Archivo{
	var $_idGaleriaContenido;
	var $_idContenidoBlog;
	var $_ruta;

	var $_directorio = '../img/blog/contenido/galeria/';
	var $_orden;

	var $_herramientas;

	function __construct($_idGaleriaContenido = 0, $_idContenidoBlog = '', $_ruta = '', $_tmp = ''){
		$this -> _idGaleriaContenido = $_idGaleriaContenido;
		$this -> _idContenidoBlog = $_idContenidoBlog;
		($_ruta != '') ? $this -> _ruta = $this -> obtenerExtensionArchivo($_ruta) : $this -> _ruta = '';

		$this -> ruta_final = $this -> _directorio;
		$this -> ruta_temporal = $_tmp;

		$this -> _herramientas = new herramientas();
	}

	function addGaleriaContenido(){
		if($this -> subir_archivo_imagen($this -> _ruta)){
			$_MYSQL = new conexion();
			$_SQL = "INSERT INTO galeriaContenido(idContenidoBlog, ruta) VALUES ({$this -> _idContenidoBlog}, '{$this -> _ruta}')";
			$this -> _idGaleriaContenido = $_MYSQL -> ejecutar_sentencia($_SQL);
			$_O = "UPDATE galeriaContenido SET orden = {$this -> _idGaleriaContenido} WHERE idGaleriaContenido = {$this -> _idGaleriaContenido}";
			$_MYSQL -> ejecutar_sentencia($_O);
		}
	}

	function updateGaleriaContenido(){
		$_MYSQL = new conexion();
		if($this -> _ruta != ''){
			$this -> getRutaArchivo();
			$this -> borrar_archivo();

			$this -> ruta_final = $this -> _directorio;
			if($this -> subir_archivo_imagen($this -> _ruta)){
				$_IMG = "UPDATE galeriaContenido SET ruta = '{$this -> _ruta}' WHERE idGaleriaContenido = {$this -> _idGaleriaContenido}";
				$_MYSQL -> ejecutar_sentencia($_IMG);
			}
		}
	}

	function deleteGaleriaContenido(){
		$this -> getRutaArchivo();
		$this -> borrar_archivo();
		$_MYSQL = new conexion();
		$_SQL = "DELETE FROM galeriaContenido WHERE idGaleriaContenido = {$this -> _idGaleriaContenido}";
		$_MYSQL -> ejecutar_sentencia($_SQL);
	}

	function updateOrdenGaleriaContenido($_orden){
		$_MYSQL = new conexion();
		$_SQL = "UPDATE galeriaContenido SET orden = {$_orden} WHERE idGaleriaContenido = {$this -> _idGaleriaContenido} AND tipo = 'galeriaContenido'";
		$_MYSQL -> ejecutar_sentencia($_SQL);
	}


	function getRutaArchivo(){
		$_MYSQL = new conexion();
		$_SQL = "SELECT ruta FROM galeriaContenido WHERE idGaleriaContenido = {$this -> _idGaleriaContenido}";
		$_MYSQL -> ejecutar_sentencia($_SQL);
		$obj = $_MYSQL -> fetchObject();
		$this -> ruta_final = $this -> _directorio.$obj -> ruta;
	}

	function getGaleriaContenido(){
		$_SQL = "SELECT * FROM galeriaContenido WHERE idContenidoBlog = {$this -> _idContenidoBlog} AND tipo = 'otro'";
		$_MYSQL = new conexion();
		$_MYSQL -> ejecutar_sentencia($_SQL);
		$obj = $_MYSQL -> fetchObject();
		return $obj;
	}

	function listGaleriaContenido(){
		$_MYSQL = new conexion();
		$_SQL = "SELECT * FROM galeriaContenido WHERE idContenidoBlog = {$this -> _idContenidoBlog} ORDER BY orden DESC";
		$_MYSQL -> ejecutar_sentencia($_SQL);
		$resultados = array();
		while($_row = $_MYSQL -> fetchRow()){
			$registro['idGaleriaContenido'] = $_row['idGaleriaContenido'];
			$registro['idContenidoBlog'] = $_row['idContenidoBlog'];
			$registro['ruta'] = $_row['ruta'];
			$registro['orden'] = $_row['orden'];
			array_push($resultados, $registro);
		}
		return $resultados;
	}

}
?>
