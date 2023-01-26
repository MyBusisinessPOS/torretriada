<?php
require_once('conexion.php');
include_once('herramientas.php');
include_once('archivo.php');
include_once('galeriaContenido.php');

class contenidoBlog extends Archivo{
	var $_idContenidoBlog;
	var $_idBlog;
	var $_descripcion;
	var $_descripcionEn;
	var $_directorio = '../img/blog/contenido/';
	var $_imagen;
	var $_url;
	var $_tipo;
	var $_orden;

	var $_galeriaContenido;
	var $_herramientas;

	function __construct($_idContenidoBlog = 0, $_idBlog = '', $_tipo = '') {
		$this -> _idContenidoBlog = $_idContenidoBlog;
		$this -> _idBlog = $_idBlog;
		$this -> _tipo = $_tipo;
		$this -> _herramientas = new herramientas();

	}

	function addContenidoBlog(){
		$_MYSQL = new conexion();
		$_SQL = "INSERT INTO contenidoBlog(idBlog, tipo)VALUES({$this -> _idBlog}, {$this -> _tipo})";
		$this -> _idContenidoBlog = $_MYSQL -> ejecutar_sentencia($_SQL);
		$_O = "UPDATE contenidoBlog SET orden = {$this -> _idContenidoBlog} WHERE idContenidoBlog = {$this -> _idContenidoBlog}";
		$_MYSQL -> ejecutar_sentencia($_O);
	}

	function addImg($_ruta = '', $_tmp = ''){
		$_MYSQL = new conexion();
		if($_ruta != ''){
			$this -> getImagen();
			$this -> borrar_archivo();

			$this -> ruta_final = $this -> _directorio;
			$this -> ruta_temporal = $_tmp;
			$_ruta = $this -> obtenerExtensionArchivo($_ruta);
			if($this -> subir_archivo_imagen($_ruta)){
				$_SQL = "UPDATE contenidoBlog SET imagen = '{$_ruta}' WHERE idContenidoBlog = {$this -> _idContenidoBlog}";
				$_MYSQL -> ejecutar_sentencia($_SQL);
			}
		}
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
				$_SQL = "UPDATE contenidoBlog SET imagen = '{$_ruta}' WHERE idContenidoBlog = {$this -> _idContenidoBlog}";
				$_MYSQL -> ejecutar_sentencia($_SQL);
			}
		}
		$_SQL = "UPDATE contenidoBlog SET url = '{$_url}' WHERE idContenidoBlog = {$this -> _idContenidoBlog}";
		$_MYSQL -> ejecutar_sentencia($_SQL);
	}

	function addTexto($_descripcion = '', $_descripcionEn = ''){
		$_descripcion = htmlspecialchars($_descripcion, ENT_QUOTES);
		$_descripcionEn = htmlspecialchars($_descripcionEn, ENT_QUOTES);
		$_MYSQL = new conexion();
		$_SQL = "UPDATE contenidoBlog SET descripcion = '{$_descripcion}', descripcionEn = '{$_descripcionEn}' WHERE idContenidoBlog = {$this -> _idContenidoBlog}";
		$_MYSQL -> ejecutar_sentencia($_SQL);
	}

	function updateOrdenContenidoBlog($_orden){
		$_MYSQL = new conexion();
		$_SQL = "UPDATE contenidoBlog SET orden = {$_orden} WHERE idContenidoBlog = '{$this -> _idContenidoBlog}'";
		$_MYSQL -> ejecutar_sentencia($_SQL);
	}

	function getImagen(){
		$_MYSQL = new conexion();
		$_SQL = "SELECT imagen FROM contenidoBlog WHERE idContenidoBlog = {$this -> _idContenidoBlog}";
		$_MYSQL -> ejecutar_sentencia($_SQL);
		$_obj = $_MYSQL -> fetchObject();
		$this -> ruta_final = $this -> _directorio.$_obj -> imagen;
	}

	function deleteContenidoBlog(){
		$this -> getImagen();
		$this -> borrar_archivo();

		$_MYSQL = new conexion();
		$_SQL = "DELETE FROM contenidoBlog WHERE idContenidoBlog = {$this -> _idContenidoBlog}";
		$_MYSQL -> ejecutar_sentencia($_SQL);
	}

	function listContenidoBlog(){
		$_MYSQL = new conexion();
		$_SQL = "SELECT * FROM contenidoBlog WHERE idBlog = {$this -> _idBlog} ORDER BY orden ASC";
		$_MYSQL -> ejecutar_sentencia($_SQL);
		$_resultados = array();
		while($_row = $_MYSQL -> fetchRow()){
			$_registro['idBlog'] = $_row['idBlog'];
			$_registro['idContenidoBlog'] = $_row['idContenidoBlog'];
			//$_registro['descripcionCorta'] = $this -> _herramientas -> cortarTexto(htmlspecialchars_decode($_row['descripcion']), 500);
			$_registro['descripcion'] = $_row['descripcion'];
			$_registro['descripcionEn'] = $_row['descripcionEn'];
			$_registro['imagen'] = $_row['imagen'];
			$_registro['tipo'] = $_row['tipo'];
			$_registro['url'] = $_row['url'];
			$this -> _idContenidoBlog = $_row['idContenidoBlog'];
			$this -> listarGaleriaContenido();
			$_registro['galeria'] = $this -> _galeriaContenido;

			array_push($_resultados, $_registro);
		}
		return $_resultados;
	}

/*==================================
 *	MAESTRO DE DETALLE GALERIA CONTENIDO
 *==================================*/
	function agregarGaleriaContenido($ruta, $tmp){
		$_galeriaContenido = new galeriaContenido(0,$this -> _idContenidoBlog, $ruta, $tmp);
		$_galeriaContenido -> addGaleriaContenido();
	}

	function modificarGaleriaContenido($idGaleriaContenido, $ruta, $tmp){
		$_galeriaContenido = new galeriaContenido($idGaleriaContenido, '', $ruta, $tmp);
		$_galeriaContenido -> updateGaleriaContenido();
	}

	function eliminarGaleriaContenido($idGaleriaContenido){
		$_galeriaContenido = new galeriaContenido($idGaleriaContenido);
		$_galeriaContenido -> deleteGaleriaContenido();
	}

	function modificarOrdenGaleriaContenido($idGaleriaContenido, $_orden){
		$_galeriaContenido = new galeriaContenido($idGaleriaContenido);
		$_galeriaContenido -> updateOrdenGaleriaContenido($_orden);
	}

	function listarGaleriaContenido(){
		$this -> _galeriaContenido = array();
		$_galeriaContenidoTemp = new galeriaContenido(0, $this -> _idContenidoBlog);
		$this -> _galeriaContenido = $_galeriaContenidoTemp -> listGaleriaContenido();
	}
}
?>
