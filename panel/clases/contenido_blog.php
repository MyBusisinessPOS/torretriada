<?php
require_once('conexion.php');
include_once('herramientas.php');
include_once('archivo.php');
include_once('galeria.php');

class contenido_blog extends Archivo{
	var $_id_contenido_blog;
	var $_id_blog;
	var $_descripcion_es;
	var $_descripcion_en;
	var $_descripcion_fr;
	var $_titulo_es;
	var $_titulo_en;
	var $_titulo_fr;

	var $_directorio = '../../img/blog/contenido/';
	var $_imagen;
	var $_url;
	var $_tipo;
	var $_orden;

	var $_galeria;
	var $_herramientas;

	function __construct($_id_contenido_blog = 0, $_id_blog = '', $_tipo = '') {
		$this -> _id_contenido_blog = $_id_contenido_blog;
		$this -> _id_blog = $_id_blog;
		$this -> _tipo = $_tipo;
		$this -> _herramientas = new herramientas();

	}

	function add_contenido_blog(){
		$_MYSQL = new conexion();
		$_SQL = "INSERT INTO contenido_blog(id_blog, tipo)VALUES({$this -> _id_blog}, {$this -> _tipo})";
        $this -> _id_contenido_blog = $_MYSQL -> ejecutar_sentencia($_SQL);

		$_O = "UPDATE contenido_blog SET orden = {$this -> _id_contenido_blog} WHERE id_contenido_blog = {$this -> _id_contenido_blog}";
        $_MYSQL -> ejecutar_sentencia($_O);
	}

	function addImg($_ruta = '', $_tmp = '', $_titulo_es = '', $_titulo_en = '', $_titulo_fr = ''){
		$_MYSQL = new conexion();
		if($_ruta != ''){
			$this -> getImagen();
			$this -> borrar_archivo();

			$this -> ruta_final = $this -> _directorio;
			$this -> ruta_temporal = $_tmp;
			$_ruta = $this -> obtenerExtensionArchivo($_ruta);
			if($this -> subir_archivo_imagen($_ruta)){
				$_SQL = "UPDATE contenido_blog SET imagen = '{$_ruta}' WHERE id_contenido_blog = {$this -> _id_contenido_blog}";
				$_MYSQL -> ejecutar_sentencia($_SQL);
			}
		}
		/*$_titulo_es = htmlentities($_titulo_es, ENT_QUOTES);
		$_titulo_en = htmlentities($_titulo_en, ENT_QUOTES);
		$_titulo_fr = htmlentities($_titulo_fr, ENT_QUOTES);

		$_SQL = "UPDATE contenido_blog SET titulo_es = '{$_titulo_es}', titulo_en = '{$_titulo_en}', titulo_fr = '{$_titulo_fr}' WHERE id_contenido_blog = {$this -> _id_contenido_blog}";
		$_MYSQL -> ejecutar_sentencia($_SQL);*/
	}

	function addVideo($_url = '', $_ruta = '', $_tmp = ''){
		$_MYSQL = new conexion();
		if($_ruta != ''){
			$this -> getImagen();
			$this -> borrar_archivo();

			$this -> ruta_final = $this -> _directorio;
			$this -> ruta_temporal = $_tmp;
			$_ruta = $this -> obtenerExtensionArchivo($_ruta);
			if($this -> subir_archivo_imagen($_ruta)){
                $_SQL = "UPDATE contenido_blog SET imagen = '{$_ruta}' WHERE id_contenido_blog = {$this -> _id_contenido_blog}";
                $_MYSQL -> ejecutar_sentencia($_SQL);
			}
		}
		$_SQL = "UPDATE contenido_blog SET url = '{$_url}' WHERE id_contenido_blog = {$this -> _id_contenido_blog}";
        $_MYSQL -> ejecutar_sentencia($_SQL);
	}

	function addTexto($_descripcion_es = '', $_descripcion_en = '', $_descripcion_fr = ''){
	    $_descripcion_es = htmlentities($_descripcion_es, ENT_QUOTES);
	    $_descripcion_en = htmlentities($_descripcion_en, ENT_QUOTES);
	    $_descripcion_fr = htmlentities($_descripcion_fr, ENT_QUOTES);
		$_MYSQL = new conexion();
		$_SQL = "UPDATE contenido_blog SET descripcion_es = '{$_descripcion_es}', descripcion_en = '{$_descripcion_en}', descripcion_fr = '{$_descripcion_fr}' WHERE id_contenido_blog = {$this -> _id_contenido_blog}";
        $_MYSQL -> ejecutar_sentencia($_SQL);
	}

	function update_orden_contenido_blog($_orden){
		$_MYSQL = new conexion();
		$_SQL = "UPDATE contenido_blog SET orden = {$_orden} WHERE id_contenido_blog = {$this -> _id_contenido_blog}";
        $_MYSQL -> ejecutar_sentencia($_SQL);
	}

	function getImagen(){
		$_MYSQL = new conexion();
		$_SQL = "SELECT imagen FROM contenido_blog WHERE id_contenido_blog = {$this -> _id_contenido_blog}";
		$_MYSQL -> ejecutar_sentencia($_SQL);
		$_obj = $_MYSQL -> fetchObject();
		$this -> ruta_final = $this -> _directorio.$_obj -> imagen;
	}

	function delete_contenido_blog(){
		$this -> getImagen();
		$this -> borrar_archivo();

		$_MYSQL = new conexion();
		$_SQL = "DELETE FROM contenido_blog WHERE id_contenido_blog = {$this -> _id_contenido_blog}";
        $_MYSQL -> ejecutar_sentencia($_SQL);
	}

	function list_contenido_blog(){
		$_MYSQL = new conexion();
		$_SQL = "SELECT * FROM contenido_blog WHERE id_blog = {$this -> _id_blog} ORDER BY orden ASC";
		$_MYSQL -> ejecutar_sentencia($_SQL);
		$_resultados = array();
		while($_row = $_MYSQL -> fetchRow()){
			$_registro['id_blog'] = $_row['id_blog'];
			$_registro['id_contenido_blog'] = $_row['id_contenido_blog'];
			$_registro['descripcionCorta'] = $this -> _herramientas -> cortarTexto(html_entity_decode($_row['descripcion']), 500);
			$_registro['descripcion_es'] = html_entity_decode($_row['descripcion_es']);
			$_registro['descripcion_en'] = html_entity_decode($_row['descripcion_en']);
			$_registro['descripcion_fr'] = html_entity_decode($_row['descripcion_fr']);
			$_registro['imagen'] = $_row['imagen'];
			$_registro['titulo_es'] = html_entity_decode($_row['titulo_es']);
			$_registro['titulo_en'] = html_entity_decode($_row['titulo_en']);
			$_registro['titulo_fr'] = html_entity_decode($_row['titulo_fr']);
			$_registro['tipo'] = $_row['tipo'];
			$_registro['url'] = $_row['url'];
            $_typeVideo = $this->_herramientas->videoType($_row['url']);
            if ($_typeVideo == 'youtube') {
                $url = urldecode(rawurldecode($_row['url']));
                preg_match("/^(?:http(?:s)?:\/\/)?(?:www\.)?(?:m\.)?(?:youtu\.be\/|youtube\.com\/(?:(?:watch)?\?(?:.*&)?v(?:i)?=|(?:embed|v|vi|user)\/))([^\?&\"'>]+)/", $url, $matches);
                $_registro['idVideo'] = $matches[1];
                $_registro['video'] = '<a href="http://www.youtube.com/embed/'.$matches[1].'?hd=1&wmode=opaque&controls=1&showinfo=0" data-type="video"></a>';
            } else if ($_typeVideo == 'vimeo') {
                $_idVideo = (int)substr(parse_url($_row['url'], PHP_URL_PATH), 1);
                $_registro['idVideo'] = $_idVideo;
                $_registro['video'] = '<a href="https://player.vimeo.com/video/'.$_idVideo.'?autoplay=1&color=E7E2DD&title=0&byline=0&portrait=0" data-type="video"></a>';
            }

						if($_typeVideo == 'youtube'){
							$url = urldecode(rawurldecode($_row['url']));
							preg_match("/^(?:http(?:s)?:\/\/)?(?:www\.)?(?:m\.)?(?:youtu\.be\/|youtube\.com\/(?:(?:watch)?\?(?:.*&)?v(?:i)?=|(?:embed|v|vi|user)\/))([^\?&\"'>]+)/", $url, $matches);
							//$registro['idVideo'] = $matches[1];
							$_registro['iframe']  = 'https://www.youtube.com/embed/'.$matches[1].'';
						}else if($_typeVideo == 'vimeo'){
							$_idVideo = (int) substr(parse_url($_row['url'], PHP_URL_PATH), 1);
							$_registro['iframe']  = 'https://player.vimeo.com/video/'.$_idVideo.'?color=696c6e&title=0&byline=0&portrait=0';
						}else{
							$_registro['iframe']  = '';
						}

			$this -> _id_contenido_blog = $_row['id_contenido_blog'];
			$this -> listar_galeria();
			$_registro['galeria'] = $this -> _galeria;

			array_push($_resultados, $_registro);
		}
		return $_resultados;
	}

/*==================================
 *	MAESTRO DE DETALLE GALERIA CONTENIDO
 *==================================*/
	function agregar_galeria($_name, $_tmp_name){
		$_galeria = new galeria(0, $this -> _id_contenido_blog, 0, '',3);
		$_galeria -> insert_galeria();
		$_galeria -> add_imagen($_name, $_tmp_name, 'img');
	}

	function modificar_galeria($id_galeria, $_name, $_tmp_name){
		$_galeria = new galeria($id_galeria,0,0,'',3);
		$_galeria ->  add_imagen($_name, $_tmp_name,'img');
	}

	function eliminar_galeria($id_galeria){
		$_galeria = new galeria($id_galeria);
		$_galeria -> delete_galeria();
	}

	function modificar_orden_galeria($id_galeria, $_orden){
		$_galeria = new galeria($id_galeria);
		$_galeria -> update_orden_galeria($_orden);
	}

	function listar_galeria(){
		$this -> _galeria = array();
		$_galeriaTemp = new galeria();
		$this -> _galeria = $_galeriaTemp -> list_galeria(3, $this -> _id_contenido_blog, 0, 1, '', false, 1, 50);
	}
}
?>
