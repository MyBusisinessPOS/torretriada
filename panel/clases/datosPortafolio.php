<?php
require_once('conexion.php');
require_once('herramientas.php');


class datosPortafolio{
	/* ========================================================
	 * 			VARIABLES DE LA ENTIDAD PORTAFOLIO
	 * ======================================================== */
	var $_idPortafolio;
	var $_titulo;
	var $_marca;
	var $_descripcion;
	var $_lang;
	var $_descripcion2;

	/* ========================================================
	 * 	    VARIABLES DE UTILIDAD PARA LA ENTIDAD PORTAFOLIO
	 * ======================================================== */

	var $_urlAmigable;
	var $_herramientas;

	function __construct($_idPortafolio = 0, $_titulo = '', $_marca='', $_descripcion = '', $_lang = '', $_descripcion2 = ''){
		$this -> _idPortafolio 	= $_idPortafolio;
		$this -> _titulo 		= htmlspecialchars($_titulo, ENT_QUOTES);
		$this -> _marca 		= htmlspecialchars($_marca, ENT_QUOTES);
		$this -> _descripcion 	= htmlspecialchars($_descripcion, ENT_QUOTES);
		$this -> _lang 			= $_lang;
		$this -> _descripcion2 	= htmlspecialchars($_descripcion2, ENT_QUOTES);
		$this -> _herramientas 	= new herramientas();
	}

	function addDatosPortafolio(){
		$this -> _urlAmigable 	= $this -> _herramientas -> getUrlAmigable($this -> _titulo);
		$_MYSQL 				= new conexion();
		$_SQL					= "INSERT INTO datosPortafolio(idPortafolio, titulo, marca, descripcion, urlAmigable, lang, descripcion2)VALUES({$this -> _idPortafolio}, '{$this -> _titulo}','{$this->_marca}', '{$this -> _descripcion}', '{$this -> _urlAmigable}', '{$this -> _lang}', '{$this -> _descripcion2}')";
		$_MYSQL -> ejecutar_sentencia($_SQL);
	}

	function updateDatosPortafolio(){
		$this -> _urlAmigable 	= $this -> _herramientas -> getUrlAmigable($this -> _titulo);
		$_MYSQL 				= new conexion();
		$_SQL 					= "UPDATE datosPortafolio SET titulo = '{$this -> _titulo}', marca='{$this -> _marca}', descripcion = '{$this -> _descripcion}', urlAmigable = '{$this -> _urlAmigable}', descripcion2 = '{$this -> _descripcion2}' WHERE idPortafolio = {$this -> _idPortafolio} AND lang = '{$this -> _lang}'";
		$_MYSQL -> ejecutar_sentencia($_SQL);
	}

	function deleteDatosPortafolio(){
		$_MYSQL = new conexion();
		$_SQL 	= "DELETE FROM datosPortafolio WHERE idPortafolio = {$this -> _idPortafolio}";
		$_MYSQL -> ejecutar_sentencia($_SQL);
	}

	function getDatosPortafolio($_lang = 'ES'){
		$_MYSQL = new conexion();
		$_SQL 	= "SELECT * FROM datosPortafolio WHERE idPortafolio = {$this -> _idPortafolio} AND lang = '{$_lang}'";
		$_MYSQL -> ejecutar_sentencia($_SQL);
		$obj 	= $_MYSQL -> fetchObject();
		$this -> _idPortafolio 	= $obj -> idPortafolio;
		$this -> _titulo 		= htmlspecialchars_decode($obj -> titulo);
		$this -> _marca 		= htmlspecialchars_decode($obj -> marca);
		$this -> _descripcion 	= htmlspecialchars_decode($obj -> descripcion);
		$this -> _descripcion2 	= htmlspecialchars_decode($obj -> descripcion2);
		$this -> _lang 			= $obj -> lang;
	}
}
?>
