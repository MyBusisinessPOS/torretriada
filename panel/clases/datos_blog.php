<?php
require_once('conexion.php');
include_once('herramientas.php');

class datos_blog {
	var $_id_blog;
	var $_titulo;
	var $_subtitulo;
	var $_descripcion;
	var $_tags;
	var $_tags_amigables;
	var $_tagsMostrar;
	var $_url_amigable;
	var $_lang;

	var $_herramientas;

	function __construct($_id_blog = 0, $_titulo = '', $_subtitulo = '', $_descripcion = '', $_tags = '', $_lang = '') {
		$this -> _id_blog = $_id_blog;
		$this -> _titulo = htmlentities($_titulo, ENT_QUOTES);
		$this -> _subtitulo = htmlentities($_subtitulo, ENT_QUOTES);
		$this -> _descripcion = htmlentities($_descripcion, ENT_QUOTES);
		$this -> _tags = htmlentities($_tags, ENT_QUOTES);
		$this -> _lang = $_lang;
		$this -> _herramientas = new herramientas();
        $this -> _url_amigable   = $this -> _herramientas -> getUrlAmigable($_titulo);
        $this -> _tags_amigables = $this -> _herramientas -> getUrlAmigable($_tags);
	}

	function add_datos_blog(){
		$_MYSQL = new conexion();
		$_SQL = "INSERT INTO datos_blog(id_blog, titulo, subtitulo, descripcion, tags, tags_amigables, url_amigable, lang)VALUES({$this -> _id_blog}, '{$this -> _titulo}', '{$this -> _subtitulo}', '{$this -> _descripcion}', '{$this -> _tags}', '{$this -> _tags_amigables}', '{$this -> _url_amigable}','{$this -> _lang}')";
		$_MYSQL -> ejecutar_sentencia($_SQL);
	}

	function update_datos_blog(){
		$_MYSQL = new conexion();
		$_SQL = "UPDATE datos_blog SET titulo = '{$this -> _titulo}', subtitulo = '{$this -> _subtitulo}', descripcion = '{$this -> _descripcion}', tags = '{$this -> _tags}', tags_amigables = '{$this -> _tags_amigables}', url_amigable = '{$this -> _url_amigable}' WHERE id_blog = {$this -> _id_blog} AND lang = '{$this -> _lang}'";
        $_MYSQL -> ejecutar_sentencia($_SQL);
	}

	function delete_datos_blog(){
		$_MYSQL = new conexion();
		$_SQL = "DELETE FROM datos_blog WHERE id_blog = {$this -> _id_blog}";
        $_MYSQL -> ejecutar_sentencia($_SQL);
	}

	function get_datos_blog(){
		$_MYSQL = new conexion();
		$_SQL = "SELECT * FROM datos_blog WHERE id_blog = {$this -> _id_blog} AND lang = '{$this -> _lang}'";
        $_MYSQL -> ejecutar_sentencia($_SQL);
		$obj = $_MYSQL -> fetchObject();
		$this -> _id_blog = $obj -> id_blog;
		$this -> _titulo = html_entity_decode($obj -> titulo);
		$this -> _subtitulo = html_entity_decode($obj -> subtitulo);
		$this -> _descripcion = html_entity_decode($obj -> descripcion);
		$this -> _tags = html_entity_decode($obj -> tags);
		$this -> _url_amigable = $obj -> url_amigable;
		$this -> _tagsMostrar = $this -> _herramientas -> formatedTags($obj -> tags_amigables, true);
	}
}
?>
