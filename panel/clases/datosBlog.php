<?php
require_once('conexion.php');
include_once('herramientas.php');

class datosBlog {
	var $_idBlog;

	var $_titulo;
	var $_subtitulo;
	var $_descripcion;
	var $_tags;
	var $_tagsAmigables;
	var $_tagsMostrar;
	var $_urlAmigable;
	var $_lang;

	var $_herramientas;

	function __construct($_idBlog = 0, $_titulo = '', $_subtitulo = '', $_descripcion = '', $_tags = '', $_lang = '') {
		$this -> _idBlog = $_idBlog;

		$this -> _titulo = htmlspecialchars($_titulo, ENT_QUOTES);
		$this -> _subtitulo = htmlspecialchars($_subtitulo, ENT_QUOTES);
		$this -> _descripcion = htmlspecialchars($_descripcion, ENT_QUOTES);
		$this -> _tags = htmlspecialchars($_tags, ENT_QUOTES);
		$this -> _lang = $_lang;

		$this -> _herramientas = new herramientas();

	}

	function addDatosBlog(){
		$this -> _urlAmigable = $this -> _herramientas -> getUrlAmigable($this -> _titulo);
		$this -> _tagsAmigables = $this -> _herramientas -> getUrlAmigable($this -> _tags);
		$_MYSQL = new conexion();
		$_SQL = "INSERT INTO datosBlog(idBlog, titulo, subtitulo, descripcion, tags, tagsAmigables, urlAmigable, lang)VALUES({$this -> _idBlog}, '{$this -> _titulo}', '{$this -> _subtitulo}', '{$this -> _descripcion}', '{$this -> _tags}', '{$this -> _tagsAmigables}', '{$this -> _urlAmigable}', '{$this -> _lang}')";
		//var_dump(array($this -> _idBlog, $this -> _titulo, $this -> _subtitulo, $this -> _descripcion, $this -> _tags, $this -> _tagsAmigables, $this -> _urlAmigable, $this -> lang));
		$_MYSQL -> ejecutar_sentencia($_SQL);
	}

	function updateDatosBlog(){
		$this -> _urlAmigable = $this -> _herramientas -> getUrlAmigable($this -> _titulo);
		$this -> _tagsAmigables = $this -> _herramientas -> getUrlAmigable($this -> _tags);
		$_MYSQL = new conexion();
		$_SQL = "UPDATE datosBlog SET titulo = '{$this -> _titulo}', subtitulo = '{$this -> _subtitulo}', descripcion = '{$this -> _descripcion}', tags = '{$this -> _tags}', tagsAmigables = '{$this -> _tagsAmigables}', urlAmigable = '{$this -> _urlAmigable}' WHERE idBlog = {$this -> _idBlog} AND lang = '{$this -> _lang}'";
		$_MYSQL -> ejecutar_sentencia($_SQL);
	}

	function deleteDatosBlog(){
		$_MYSQL = new conexion();
		$_SQL = "DELETE FROM datosBlog WHERE idBlog = {$this -> _idBlog}";
		$_MYSQL -> ejecutar_sentencia($_SQL);
	}

	function getDatosBlog(){
		$_MYSQL = new conexion();
		$_SQL = "SELECT * FROM datosBlog WHERE idBlog = {$this -> _idBlog} AND lang = '{$this -> _lang}'";
		$_MYSQL -> ejecutar_sentencia($_SQL);
		$obj = $_MYSQL -> fetchObject();
		$this -> _idBlog = $obj -> idBlog;
		$this -> _titulo = $obj -> titulo;
		$this -> _subtitulo = $obj -> subtitulo;
		$this -> _descripcion = $obj -> descripcion;
		$this -> _tags = $obj -> tags;
		$this -> _urlAmigable = $obj -> urlAmigable;
		$this -> _tagsMostrar = $this -> _herramientas -> formatedTags($obj -> tagsAmigables, true);
	}

}
?>
