<?php
require_once('conexion.php');
require_once('archivo.php');

class catalogo extends Archivo{
	/* ========================================================
	 * 			VARIABLES DE LA ENTIDAD PORTAFOLIO
	 * ======================================================== */
	var $_idCatalogo;
	var $_ruta;
	/* ========================================================
	 * 	    VARIABLES DE UTILIDAD PARA LA ENTIDAD PORTAFOLIO
	 * ======================================================== */
	var $_directorio = '../documents/catalogo/';

	function __construct($_idCatalogo = 0, $_ruta = '', $_tmp = ''){
		$this -> _idCatalogo 	= $_idCatalogo;
		($_ruta != '') ? $this -> _ruta = $this -> obtenerExtensionArchivo($_ruta) : $this -> _ruta = '';

		$this -> ruta_final    = $this -> _directorio.$this -> _ruta;
		$this -> ruta_temporal = $_tmp;
	}

	function updateCatalogo(){
		$_MYSQL = new conexion();
		if($this -> _ruta != ''){
			$this -> getRuta();
			$this -> borrar_archivo();

			$this -> ruta_final = $this -> _directorio.$this -> _ruta;
			if($this -> subir_archivo()){
				$_IMG = "UPDATE catalogo SET ruta = '{$this -> _ruta}' WHERE idCatalogo = {$this -> _idCatalogo}";
				$_MYSQL -> ejecutar_sentencia($_IMG);
			}
		}
	}

	function getRuta(){
		$_MYSQL = new conexion();
		$_SQL 	= "SELECT ruta FROM catalogo WHERE idCatalogo = {$this -> _idCatalogo}";
		$_MYSQL -> ejecutar_sentencia($_SQL);
		$obj 	= $_MYSQL -> fetchObject();
		$this -> ruta_final = $this -> _directorio.$obj -> ruta;
	}

	function getCatalogo(){
		$_MYSQL = new conexion();
		$_SQL 	= "SELECT * FROM catalogo WHERE idCatalogo = {$this -> _idCatalogo}";
		$_MYSQL -> ejecutar_sentencia($_SQL);
		$obj 	= $_MYSQL -> fetchObject();
		$this   -> _idCatalogo 	= $obj -> idCatalogo;
		$this   -> _ruta 		= $obj -> ruta;
	}


}
?>
