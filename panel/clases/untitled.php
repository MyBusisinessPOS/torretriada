<?php
require_once('conexion.php');
require_once('archivo.php');
require_once('herramientas.php');

class sucursal extends Archivo{
	/* ========================================================
	 * 			VARIABLES DE LA ENTIDAD PORTAFOLIO
	 * ======================================================== */
	var $_idSucursal;
	var $_nombre;
	var $_descripcion;
	var $_descripcion2;
	var $_descripcion3;
	var $_link;
	var $_lang;
	var $_imgPortada;
	var $_imgMovil;
	/* ========================================================
	 * 	    VARIABLES DE UTILIDAD PARA LA ENTIDAD PORTAFOLIO
	 * ======================================================== */
	var $_status;
	var $_orden;
	var $_directorio = "../img/sucursal/";
	var $_registrosPorPagina;
	var $_totalRegistros;
	var $_herramientas;

	function __construct($_idSucursal = 0, $_imgPortada = '', $_tmp = ''){
		$this -> _idSucursal 	 = $_idSucursal;

		($_imgPortada != '') ? $this -> _imgPortada = $this -> obtenerExtensionArchivo($_imgPortada) : $this -> _imgPortada = '';

		$this -> ruta_final    = $this -> _directorio;
		$this -> ruta_temporal = $_tmp;
		$this -> _herramientas = new herramientas();
	}

	function addSucursal(){
		if($this -> subir_archivo_imagen($this -> _imgPortada)){
			$_MYSQL = new conexion();
			$_SQL = "INSERT INTO sucursal(imgPortada, status)VALUES('{$this -> _imgPortada}', 1)";
			$this -> _idSucursal = $_MYSQL -> ejecutar_sentencia($_SQL);
			if($this -> _idSucursal != 0){
				$_O = "UPDATE sucursal SET orden = {$this -> _idSucursal} WHERE idSucursal = {$this -> _idSucursal}";
				$_MYSQL -> ejecutar_sentencia($_O);
				$_success = 2;
			}else{
				$this -> _idSucursal = 0;
				$_success = 1;
			}
		}else{
			$_success = 0;
		}
		return $_success;
	}

	function updateSucursal(){
		$_MYSQL = new conexion();
		if($this -> _imgPortada != ''){
			$this -> getImgPortada();
			$this -> borrar_archivo();

			$this -> ruta_final = $this -> _directorio;
			if($this -> subir_archivo_imagen($this -> _imgPortada)){
				$_IMG = "UPDATE sucursal SET imgPortada = '{$this -> _imgPortada}' WHERE idSucursal = {$this -> _idSucursal}";
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
			$_SQL = "UPDATE sucursal SET imgMovil = '{$_ruta}' WHERE idSucursal = {$this -> _idSucursal}";
			$_MYSQL -> ejecutar_sentencia($_SQL);
		}
	}

	function deleteSucursal(){
		$this -> getImgPortada();
		$this -> borrar_archivo();
		$this -> getImgMovil();
		$this -> borrar_archivo();

		$_MYSQL = new conexion();
		$_SQL 	= "DELETE sucursal, datosSucursal FROM sucursal  INNER JOIN datosSucursal WHERE sucursal.idSucursal = datosSucursal.idSucursal and sucursal.idSucursal = {$this -> _idSucursal}";
		$_MYSQL -> ejecutar_sentencia($_SQL);
	}

	function getImgPortada(){
		$_MYSQL = new conexion();
		$_SQL 	= "SELECT imgPortada FROM sucursal WHERE idSucursal = {$this -> _idSucursal}";
		$_MYSQL -> ejecutar_sentencia($_SQL);
		$obj 	= $_MYSQL -> fetchObject();
		$this -> ruta_final = $this -> _directorio.$obj -> imgPortada;
	}

	function getImgMovil(){
		$_MYSQL = new conexion();
		$_SQL 	= "SELECT imgMovil FROM sucursal WHERE idSucursal = {$this -> _idSucursal}";
		$_MYSQL -> ejecutar_sentencia($_SQL);
		$obj 	= $_MYSQL -> fetchObject();
		$this -> ruta_final = $this -> _directorio.$obj -> imgMovil;
	}

	function updateStatusSucursal($_status){
		$_MYSQL = new conexion();
		$_SQL 	= "UPDATE sucursal SET status = {$_status} WHERE idSucursal = {$this -> _idSucursal}";
		$_MYSQL -> ejecutar_sentencia($_SQL);
	}

	function updateOrdenSucursal($_orden){
		$_MYSQL = new conexion();
		$_SQL 	= "UPDATE sucursal SET orden = {$_orden} WHERE idSucursal = {$this -> _idSucursal}";
		$_MYSQL -> ejecutar_sentencia($_SQL);
	}

	function getSucursal($_lang = 'es', $_res = true){
		$_MYSQL = new conexion();
		$_SQL 	= "SELECT sucursal.*, datosSucursal.* FROM sucursal, datosSucursal WHERE sucursal.idSucursal = datosSucursal.idSucursal AND sucursal.idSucursal = {$this -> _idSucursal} AND datosSucursal.lang = '{$_lang}'";
		$_MYSQL -> ejecutar_sentencia($_SQL);
		$obj 	= $_MYSQL -> fetchObject();
		if($_res){
			$this   -> _idSucursal 	= $obj -> idSucursal;
			$this   -> _titulo 		= htmlspecialchars_decode($obj -> titulo);
			$this 	-> _subtitulo  	= htmlspecialchars_decode($obj -> subtitulo);
			$this 	-> _subtitulo2  = htmlspecialchars_decode($obj -> subtitulo2);
			$this 	-> _subtitulo3  = htmlspecialchars_decode($obj -> subtitulo3);
			$this   -> _link 		= $obj -> link;
			$this   -> _imgPortada 	= $obj -> imgPortada;
			$this   -> _imgMovil 	= $obj -> imgMovil;
		}else{
			return $obj;
		}

	}

	function listSucursal($_pagina = 1, $_paginador = true, $_status = '', $_busqueda = '', $_registrosPorPagina = 20, $_lang = 'es', $_frontEnd = false){
		($_status != '') ? $_stat = " AND sucursal.status = ".$_status : $_stat = '';
		($_busqueda != '') ? $_bus = " AND (datosSucursal.titulo LIKE '%".$_busqueda."%')" : $_bus = '';

		$_MYSQL = new conexion();
		$_TOTAL = "SELECT sucursal.idSucursal FROM sucursal, datosSucursal WHERE sucursal.idSucursal = datosSucursal.idSucursal AND datosSucursal.lang = '{$_lang}' ".$_stat." ".$_bus." ORDER BY sucursal.orden DESC";
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

		$_SQL  = "SELECT sucursal.*, datosSucursal.* FROM sucursal, datosSucursal WHERE sucursal.idSucursal = datosSucursal.idSucursal AND datosSucursal.lang = '{$_lang}' ".$_stat.$_bus." ORDER BY sucursal.orden DESC ".$_paginacion;
		$_MYSQL -> ejecutar_sentencia($_SQL);
		$_resultados = array();
		while($_row = $_MYSQL -> fetchRow()){
			$_registro['idSucursal'] 		= $_row['idSucursal'];
			$_registro['titulo']		= htmlspecialchars_decode($_row['titulo']);
			$_registro['subtitulo']		= htmlspecialchars_decode($_row['subtitulo']);
			$_registro['subtitulo2']	= htmlspecialchars_decode($_row['subtitulo2']);
			$_registro['subtitulo3']	= htmlspecialchars_decode($_row['subtitulo3']);
			$_registro['link'] 			= $_row['link'];
			if($_frontEnd){
				$this -> _idSucursal = $_row['idSucursal'];
				$_en = $this -> getSucursal('en', false);
				$_registro['tituloEn']		= htmlspecialchars_decode($_en -> titulo);
				$_registro['subtituloEn']	= htmlspecialchars_decode($_en -> subtitulo);
				$_registro['subtitulo2En']	= htmlspecialchars_decode($_en -> subtitulo2);
				$_registro['subtitulo3En']	= htmlspecialchars_decode($_en -> subtitulo3);
				$_registro['linkEn'] 		= $_en -> link;
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

	function addDatosSucursal($_nombre = '', $_descripcion = '', $_descripcion2 = '', $_descripcion3 = '', $_link = '', $_lang = ''){
		$this -> _titulo 	 = htmlspecialchars($_nombre, ENT_QUOTES);
		$this -> _subtitulo  = htmlspecialchars($_descripcion, ENT_QUOTES);
		$this -> _subtitulo2 = htmlspecialchars($_descripcion2, ENT_QUOTES);
		$this -> _subtitulo3 = htmlspecialchars($_descripcion3, ENT_QUOTES);
		$this -> _link 		 = $_link;
		$this -> _lang 		 = $_lang;
		$_MYSQL	= new conexion();
		$_SQL   = "INSERT INTO datosSucursal(idSucursal, titulo, subtitulo, subtitulo2, subtitulo3, link, lang) VALUES ({$this -> _idSucursal}, '{$this -> _titulo}', '{$this -> _subtitulo}', '{$this -> _subtitulo2}', '{$this -> _subtitulo3}', '{$this -> _link}', '{$this -> _lang}')";
		$_MYSQL -> ejecutar_sentencia($_SQL);
	}

	function updateDatosSucursal($_nombre = '', $_descripcion = '', $_descripcion2 = '', $_descripcion3 = '', $_link = '', $_lang = ''){
		$this -> _titulo 	 = htmlspecialchars($_nombre, ENT_QUOTES);
		$this -> _subtitulo  = htmlspecialchars($_descripcion, ENT_QUOTES);
		$this -> _subtitulo2 = htmlspecialchars($_descripcion2, ENT_QUOTES);
		$this -> _subtitulo3 = htmlspecialchars($_descripcion3, ENT_QUOTES);
		$this -> _link 		 = $_link;
		$this -> _lang 		 = $_lang;
		$_MYSQL = new conexion();
		$_SQL   = "UPDATE datosSucursal SET titulo = '{$this -> _titulo}', subtitulo = '{$this -> _subtitulo}', subtitulo2 = '{$this -> _subtitulo2}', subtitulo3 = '{$this -> _subtitulo3}', link = '{$this -> _link}' WHERE idSucursal = {$this -> _idSucursal} AND lang = '{$this -> _lang}'";
		$_MYSQL -> ejecutar_sentencia($_SQL);
	}

}
?>
