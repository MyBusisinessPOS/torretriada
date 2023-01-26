<?php
require_once('conexion.php');
require_once('archivo.php');
require_once('herramientas.php');

class slide extends Archivo{
	/* ========================================================
	 * 			VARIABLES DE LA ENTIDAD PORTAFOLIO
	 * ======================================================== */
	var $_idSlide;
	var $_titulo;
	var $_subtitulo;
	var $_subtitulo2;
	var $_subtitulo3;
	var $_link;
	var $_lang;
	var $_imgPortada;
	var $_imgMovil;
	var $_tipo;
	/* ========================================================
	 * 	    VARIABLES DE UTILIDAD PARA LA ENTIDAD PORTAFOLIO
	 * ======================================================== */
	var $_status;
	var $_orden;
	var $_directorio = "../img/slide/";
	var $_registrosPorPagina;
	var $_totalRegistros;
	var $_herramientas;

	function __construct($_idSlide = 0, $_imgPortada = '', $_tmp = '', $_tipo=1){
		$this -> _idSlide 	 = $_idSlide;
		$this -> _tipo 		 = $_tipo;

		($_imgPortada != '') ? $this -> _imgPortada = $this -> obtenerExtensionArchivo($_imgPortada) : $this -> _imgPortada = '';

		$this -> ruta_final    = $this -> _directorio;
		$this -> ruta_temporal = $_tmp;
		$this -> _herramientas = new herramientas();
	}

	function addSlide(){
		if($this -> subir_archivo_imagen($this -> _imgPortada)){
			$_MYSQL = new conexion();
			$_SQL = "INSERT INTO slide(imgPortada, tipo, status)VALUES('{$this -> _imgPortada}','{$this->_tipo}', 1)";
			$this -> _idSlide = $_MYSQL -> ejecutar_sentencia($_SQL);
			if($this -> _idSlide != 0){
				$_O = "UPDATE slide SET orden = {$this -> _idSlide} WHERE idSlide = {$this -> _idSlide}";
				$_MYSQL -> ejecutar_sentencia($_O);
				$_success = 2;
			}else{
				$this -> _idSlide = 0;
				$_success = 1;
			}
		}else{
			$_success = 0;
		}
		return $_success;
	}

	function updateSlide(){
		$_MYSQL = new conexion();
		if($this -> _imgPortada != ''){
			$this -> getImgPortada();
			$this -> borrar_archivo();

			$this -> ruta_final = $this -> _directorio;
			if($this -> subir_archivo_imagen($this -> _imgPortada)){
				$_IMG = "UPDATE slide SET imgPortada = '{$this -> _imgPortada}' WHERE idSlide = {$this -> _idSlide}";
				$_MYSQL -> ejecutar_sentencia($_IMG);
			}
		}
	}

	function updateImgMovil($_ruta = '', $_tmp = ''){
		if($_ruta != ''){
			$this -> getImgMovil();
			$this -> borrar_archivo();

			$this -> ruta_final = $this -> _directorio;
			$this -> ruta_temporal = $_tmp;
			$_ruta = $this -> obtenerExtensionArchivo($_ruta);
			$this -> subir_archivo_imagen($_ruta);
			$_MYSQL = new conexion();
			$_SQL = "UPDATE slide SET imgMovil = '{$_ruta}' WHERE idSlide = {$this -> _idSlide}";
			$_MYSQL -> ejecutar_sentencia($_SQL);
		}
	}

	function deleteSlide(){
		$this -> getImgPortada();
		$this -> borrar_archivo();
		$this -> getImgMovil();
		$this -> borrar_archivo();

		$_MYSQL = new conexion();
		$_SQL 	= "DELETE slide, datosSlide FROM slide  INNER JOIN datosSlide WHERE slide.idSlide = datosSlide.idSlide and slide.idSlide = {$this -> _idSlide}";
		$_MYSQL -> ejecutar_sentencia($_SQL);
	}

	function getImgPortada(){
		$_MYSQL = new conexion();
		$_SQL 	= "SELECT imgPortada FROM slide WHERE idSlide = {$this -> _idSlide}";
		$_MYSQL -> ejecutar_sentencia($_SQL);
		$obj 	= $_MYSQL -> fetchObject();
		$this -> ruta_final = $this -> _directorio.$obj -> imgPortada;
	}

	function getImgMovil(){
		$_MYSQL = new conexion();
		$_SQL 	= "SELECT imgMovil FROM slide WHERE idSlide = {$this -> _idSlide}";
		$_MYSQL -> ejecutar_sentencia($_SQL);
		$obj 	= $_MYSQL -> fetchObject();
		$this -> ruta_final = $this -> _directorio.$obj -> imgMovil;
	}

	function updateStatusSlide($_status){
		$_MYSQL = new conexion();
		$_SQL 	= "UPDATE slide SET status = {$_status} WHERE idSlide = {$this -> _idSlide}";
		$_MYSQL -> ejecutar_sentencia($_SQL);
	}

	function updateOrdenSlide($_orden){
		$_MYSQL = new conexion();
		$_SQL 	= "UPDATE slide SET orden = {$_orden} WHERE idSlide = {$this -> _idSlide}";
		$_MYSQL -> ejecutar_sentencia($_SQL);
	}

	function getSlide($_lang = 'es', $_res = true){
		$_MYSQL = new conexion();
		$_SQL 	= "SELECT slide.*, datosSlide.* FROM slide, datosSlide WHERE slide.idSlide = datosSlide.idSlide AND slide.idSlide = {$this -> _idSlide} AND datosSlide.lang = '{$_lang}'";
		$_MYSQL -> ejecutar_sentencia($_SQL);
		$obj 	= $_MYSQL -> fetchObject();
		if($_res){
			$this   -> _idSlide 	= $obj -> idSlide;
			$this   -> _titulo 		= htmlspecialchars_decode($obj -> titulo);
			$this 	-> _subtitulo  	= htmlspecialchars_decode($obj -> subtitulo);
			$this 	-> _subtitulo2  = htmlspecialchars_decode($obj -> subtitulo2);
			$this 	-> _subtitulo3  = htmlspecialchars_decode($obj -> subtitulo3);
			$this   -> _link 		= $obj -> link;
			$this   -> _linkVideo 	= $obj -> linkVideo;
			$this   -> _imgPortada 	= $obj -> imgPortada;
			$this   -> _imgMovil 	= $obj -> imgMovil;
		}else{
			return $obj;
		}

	}

	function listSlide($_pagina = 1, $_paginador = true, $_status = '', $_busqueda = '', $_registrosPorPagina = 20, $_lang = 'es', $_frontEnd = false, $tipo=1){
		($_status != '') ? $_stat = " AND slide.status = ".$_status : $_stat = '';
		($_busqueda != '') ? $_bus = " AND (datosSlide.titulo LIKE '%".$_busqueda."%')" : $_bus = '';

		$_MYSQL = new conexion();
		$_TOTAL = "SELECT slide.idSlide FROM slide, datosSlide WHERE slide.idSlide = datosSlide.idSlide AND datosSlide.lang = '{$_lang}' ".$_stat." ".$_bus." AND tipo={$tipo} ORDER BY slide.orden DESC";
		if($_paginador){
			$_MYSQL -> ejecutar_sentencia($_TOTAL);
			$this -> _totalRegistros 		= $_MYSQL -> numRows();
			$this -> _registrosPorPagina 	= $_registrosPorPagina;
			$_ultimaPagina 					= ceil($this -> _totalRegistros / $this -> _registrosPorPagina);
			$_paginaActual 					= $_pagina;
			$_paginacion 					= ' LIMIT '.($_pagina - 1) * $this -> _registrosPorPagina.','.$this -> _registrosPorPagina;
		}else{
			$_paginacion = '';
		}

		$_SQL  = "SELECT slide.*, datosSlide.* FROM slide, datosSlide WHERE slide.idSlide = datosSlide.idSlide AND datosSlide.lang = '{$_lang}' ".$_stat.$_bus." AND tipo={$tipo} ORDER BY slide.orden DESC ".$_paginacion;
		$_MYSQL -> ejecutar_sentencia($_SQL);
		$_resultados = array();
		while($_row = $_MYSQL -> fetchRow()){
			$_registro['idSlide'] 		= $_row['idSlide'];
			$_registro['titulo']		= htmlspecialchars_decode($_row['titulo']);
			$_registro['subtitulo']		= htmlspecialchars_decode($_row['subtitulo']);
			$_registro['subtitulo2']	= htmlspecialchars_decode($_row['subtitulo2']);
			$_registro['subtitulo3']	= htmlspecialchars_decode($_row['subtitulo3']);
			$_registro['link'] 			= $_row['link'];
			$_registro['linkVideo']		= $_row['linkVideo'];
			if($_frontEnd){
				$this -> _idSlide = $_row['idSlide'];
				$_en = $this -> getSlide('en', false);
				$_registro['tituloEn']		= htmlspecialchars_decode($_en -> titulo);
				$_registro['subtituloEn']	= htmlspecialchars_decode($_en -> subtitulo);
				$_registro['subtitulo2En']	= htmlspecialchars_decode($_en -> subtitulo2);
				$_registro['subtitulo3En']	= htmlspecialchars_decode($_en -> subtitulo3);
				$_registro['linkEn'] 		= $_en -> link;
				$_registro['linkVideoEn']	= $_en -> linkVideo;
			}

			$_registro['imgPortada'] 	= $_row['imgPortada'];
			$_registro['imgMovil'] 		= $_row['imgMovil'];
			$_registro['status'] 		= $_row['status'];
			$_registro['orden'] 		= $_row['orden'];

			if($_paginador){
				$_registro['ultimapagina'] 		= $_ultimaPagina;
				$_registro['paginaanterior'] 	= $_pagina - 1;
				$_registro['paginasiguiente']	= $_pagina + 1;
				$_registro['pagina'] 			= $_pagina;
			}
			array_push($_resultados, $_registro);
		}
		return $_resultados;
	}

	function addDatosSlide($_titulo = '', $_subtitulo = '', $_subtitulo2 = '', $_subtitulo3 = '', $_link = '',$_linkVideo='', $_lang = ''){
		$this -> _titulo 	 = htmlspecialchars($_titulo, ENT_QUOTES);
		$this -> _subtitulo  = htmlspecialchars($_subtitulo, ENT_QUOTES);
		$this -> _subtitulo2 = htmlspecialchars($_subtitulo2, ENT_QUOTES);
		$this -> _subtitulo3 = htmlspecialchars($_subtitulo3, ENT_QUOTES);
		$this -> _link 		 = $_link;
		$this -> _linkVideo	 = $_linkVideo;
		$this -> _lang 		 = $_lang;
		$_MYSQL	= new conexion();
		$_SQL   = "INSERT INTO datosSlide(idSlide, titulo, subtitulo, subtitulo2, subtitulo3, link,linkVideo, lang) VALUES ({$this -> _idSlide}, '{$this -> _titulo}', '{$this -> _subtitulo}', '{$this -> _subtitulo2}', '{$this -> _subtitulo3}', '{$this -> _link}', '{$this->_linkVideo}', '{$this -> _lang}')";
		$_MYSQL -> ejecutar_sentencia($_SQL);
	}

	function updateDatosSlide($_titulo = '', $_subtitulo = '', $_subtitulo2 = '', $_subtitulo3 = '', $_link = '',$_linkVideo='', $_lang = ''){
		$this -> _titulo 	 = htmlspecialchars($_titulo, ENT_QUOTES);
		$this -> _subtitulo  = htmlspecialchars($_subtitulo, ENT_QUOTES);
		$this -> _subtitulo2 = htmlspecialchars($_subtitulo2, ENT_QUOTES);
		$this -> _subtitulo3 = htmlspecialchars($_subtitulo3, ENT_QUOTES);
		$this -> _link 		 = $_link;
		$this -> _linkVideo	 = $_linkVideo;
		$this -> _lang 		 = $_lang;
		$_MYSQL = new conexion();
		$_SQL   = "UPDATE datosSlide SET titulo = '{$this -> _titulo}', subtitulo = '{$this -> _subtitulo}', subtitulo2 = '{$this -> _subtitulo2}', subtitulo3 = '{$this -> _subtitulo3}', link = '{$this -> _link}', linkVideo = '{$this->_linkVideo}' WHERE idSlide = {$this -> _idSlide} AND lang = '{$this -> _lang}'";
		$_MYSQL -> ejecutar_sentencia($_SQL);
	}

}
?>
