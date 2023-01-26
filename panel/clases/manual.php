<?php
require_once('conexion.php');
require_once('archivo.php');
require_once('herramientas.php');

class manual extends Archivo{
	/* ========================================================
	 * 			VARIABLES DE LA ENTIDAD PORTAFOLIO
	 * ======================================================== */
	var $_idManual;
	var $_idCategoria;
	var $_titulo;
	var $_descripcion;
	var $_manualEs;
	var $_manualEn;
	var $_link;
	var $_lang;
	var $_tipo;
	/* ========================================================
	 * 	    VARIABLES DE UTILIDAD PARA LA ENTIDAD PORTAFOLIO
	 * ======================================================== */
	var $_status;
	var $_orden;
	var $_directorio = '../img/manual/';
	var $_directorioManual = "../documents/manual/";
	var $_registrosPorPagina;
	var $_totalRegistros;
	var $_herramientas;

	function __construct($_idManual = 0, $_idCategoria=0, $_tipo = 0, $_imgPortada = '', $_tmp = ''){
		$this -> _idManual 	= $_idManual;
		$this -> _idCategoria = $_idCategoria;
		$this -> _tipo 		= $_tipo;
		($_imgPortada != '') ? $this -> _imgPortada = $this -> obtenerExtensionArchivo($_imgPortada) : $this -> _imgPortada = '';

		$this -> ruta_final    = $this -> _directorio;
		$this -> ruta_temporal = $_tmp;
		$this -> _herramientas = new herramientas();
	}

	function addManual(){
		if($this -> subir_archivo_imagen($this -> _imgPortada)){
			$_MYSQL = new conexion();
			$_SQL = "INSERT INTO manual(idCategoria, imgPortada, tipo, status)VALUES('{$this->_idCategoria}','{$this -> _imgPortada}', {$this -> _tipo}, 1)";
			$this -> _idManual = $_MYSQL -> ejecutar_sentencia($_SQL);
			if($this -> _idManual != 0){
				$_O = "UPDATE manual SET orden = {$this -> _idManual} WHERE idManual = {$this -> _idManual}";
				$_MYSQL -> ejecutar_sentencia($_O);
			}else{
				$this -> _idManual = 0;
			}
		}
	}

	function updateManual(){
		$_MYSQL = new conexion();
		if($this -> _imgPortada != ''){
			$this -> getImgPortada();
			$this -> borrar_archivo();

			$this -> ruta_final = $this -> _directorio;
			if($this -> subir_archivo_imagen($this -> _imgPortada)){
				$_IMG = "UPDATE manual SET imgPortada = '{$this -> _imgPortada}' WHERE idManual = {$this -> _idManual}";
				$_MYSQL -> ejecutar_sentencia($_IMG);
			}
		}
	}
	function updateCategoriaManual(){
		$_MYSQL = new conexion();
		$_SQL = "UPDATE manual SET idCategoria='{$this->_idCategoria}' WHERE idManual = {$this->_idManual}";
		$_MYSQL -> ejecutar_sentencia($_SQL);
	}

	function updateManualFile($_ruta = '', $_tmp = '', $_lang = 'es'){
		if($_ruta != ''){
			$this -> getManualFile($_lang);
			$this -> borrar_archivo();

			$_ruta = $this -> obtenerExtensionArchivo($_ruta);

			$this -> ruta_final = $this -> _directorioManual.$_ruta;
			$this -> ruta_temporal = $_tmp;

			$this -> subir_archivo();
			$_MYSQL = new conexion();
			$_SQL   = ($_lang == 'es') ? "UPDATE manual SET manualEs = '{$_ruta}' WHERE idManual = {$this -> _idManual}" : "UPDATE manual SET manualEn = '{$_ruta}' WHERE idManual = {$this -> _idManual}";
			$_MYSQL -> ejecutar_sentencia($_SQL);
		}
	}

	function deleteManual(){
		$this -> getImgPortada();
		$this -> borrar_archivo();
		$this -> getManualFile('es');
		$this -> borrar_archivo();
		$this -> getManualFile('en');
		$this -> borrar_archivo();

		$_MYSQL = new conexion();
		//echo $_SQL 	= "DELETE FROM manual, datosManual WHERE manual.idManual = datosManual.idManual AND manual.idManual = {$this -> _idManual}";
		$_SQL = "DELETE manual, datosManual  FROM manual  INNER JOIN datosManual WHERE manual.idManual = datosManual.idManual and manual.idManual = {$this -> _idManual}";
		$_MYSQL -> ejecutar_sentencia($_SQL);
	}

	function getImgPortada(){
		$_MYSQL = new conexion();
		$_SQL 	= "SELECT imgPortada FROM manual WHERE idManual = {$this -> _idManual}";
		$_MYSQL -> ejecutar_sentencia($_SQL);
		$obj 	= $_MYSQL -> fetchObject();
		$this -> ruta_final = $this -> _directorio.$obj -> imgPortada;
	}

	function getManualFile($_lang = 'es'){
		$_MYSQL = new conexion();
		$_SQL 	= ($_lang == 'es') ? "SELECT manualEs FROM manual WHERE idManual = {$this -> _idManual}" : "SELECT manualEn FROM manual WHERE idManual = {$this -> _idManual}";
		$_MYSQL -> ejecutar_sentencia($_SQL);
		$obj 	= $_MYSQL -> fetchObject();
		$this -> ruta_final = ($_lang == 'es') ? $this -> _directorio.$obj -> manualEs : $this -> _directorio.$obj -> manualEn;
	}

	function updateStatusManual($_status){
		$_MYSQL = new conexion();
		$_SQL 	= "UPDATE manual SET status = {$_status} WHERE idManual = {$this -> _idManual}";
		$_MYSQL -> ejecutar_sentencia($_SQL);
	}

	function updateOrdenManual($_orden){
		$_MYSQL = new conexion();
		$_SQL 	= "UPDATE manual SET orden = {$_orden} WHERE idManual = {$this -> _idManual}";
		$_MYSQL -> ejecutar_sentencia($_SQL);
	}

	function getManual($_lang = 'es', $_res = true){
		$_MYSQL = new conexion();
		$_SQL 	= "SELECT manual.*, datosManual.* FROM manual, datosManual WHERE manual.idManual = datosManual.idManual AND manual.idManual = {$this -> _idManual} AND datosManual.lang = '{$_lang}'";
		$_MYSQL -> ejecutar_sentencia($_SQL);
		$obj 	= $_MYSQL -> fetchObject();
		if($_res){
			$this   -> _idManual 	= $obj -> idManual;
			$this 	-> _idCategoria = $obj -> idCategoria;
			$this   -> _titulo 		= htmlspecialchars_decode($obj -> titulo);
			$this 	-> _descripcion = htmlspecialchars_decode($obj -> descripcion);
			$this   -> _link 		= $obj -> link;
			$this   -> _imgPortada 	= $obj -> imgPortada;
			$this   -> _manualEs 	= $obj -> manualEs;
			$this   -> _manualEn	= $obj -> manualEn;
		}else{
			return $obj;
		}

	}
	function getDatosEn(){
		$_MYSQL = new conexion();
		$_SQL 	= "SELECT manual.*, datosManual.* FROM manual, datosManual WHERE manual.idManual = datosManual.idManual AND manual.idManual = {$this -> _idManual} AND datosManual.lang = 'en'";
		$_MYSQL -> ejecutar_sentencia($_SQL);
		$obj 	= $_MYSQL -> fetchObject();
			$this   -> _tituloEn 		= htmlspecialchars_decode($obj -> titulo);
			$this 	-> _descripcionEn = htmlspecialchars_decode($obj -> descripcion);
			$this   -> _linkEn 		= $obj -> link;

	}

	function listManual($_tipo = 0, $_pagina = 1, $_paginador = true, $_status = '', $_busqueda = '', $_registrosPorPagina = 20, $_lang = 'es', $_frontEnd = false,$_idCat=0){
		($_status != '') ? $_stat = " AND manual.status = ".$_status : $_stat = '';
		($_busqueda != '') ? $_bus = " AND (datosManual.titulo LIKE '%".$_busqueda."%')" : $_bus = '';
		($_tipo!=0) ? $_tp = " AND manual.tipo = {$_tipo}" : $_tp = "";
		($_idCat!=0) ? $_cat = " AND manual.idCategoria={$_idCat} " : $_cat = "";

		$_MYSQL = new conexion();
		$_TOTAL = "SELECT manual.idManual FROM manual, datosManual WHERE manual.idManual = datosManual.idManual AND manual.tipo = {$_tipo} AND datosManual.lang = '{$_lang}' ".$_stat.$_cat." ".$_bus." ORDER BY manual.orden DESC";
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

		$_SQL  = "SELECT manual.*, datosManual.* FROM manual, datosManual WHERE manual.idManual = datosManual.idManual {$tp} AND datosManual.lang = '{$_lang}' ".$_stat.$_bus.$_cat." ORDER BY manual.orden DESC ".$_paginacion;
		$_MYSQL -> ejecutar_sentencia($_SQL);
		$_resultados = array();
		while($_row = $_MYSQL -> fetchRow()){
			$_registro['idManual'] 		= $_row['idManual'];
			$_registro['idCategoria']	= $_row['idCategoria'];
			$_registro['imgPortada'] 	= $_row['imgPortada'];
			$_registro['titulo']		= htmlspecialchars_decode($_row['titulo']);
			$_registro['descripcion']	= htmlspecialchars_decode($_row['descripcion']);
			if($_frontEnd){
				$this -> _idManual = $_row['idManual'];
				$_en = $this -> getManual('en', false);
				$_registro['tituloEn']		= htmlspecialchars_decode($_en -> titulo);
				$_registro['descripcionEn']	= htmlspecialchars_decode($_en -> descripcion);
			}
			$_registro['manualEs']		= $_row['manualEs'];
			$_registro['manualEn']		= $_row['manualEn'];
			$_registro['link'] 			= $_row['link'];
			$_registro['tipo'] 			= $_row['tipo'];
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

	function addDatosManual($_titulo = '', $_descripcion = '', $_link = '', $_lang = ''){
		$this -> _titulo 	  = htmlspecialchars($_titulo, ENT_QUOTES);
		$this -> _descripcion = htmlspecialchars($_descripcion, ENT_QUOTES);
		$this -> _link 		  = $_link;
		$this -> _lang 		  = $_lang;
		$_MYSQL	= new conexion();
		$_SQL   = "INSERT INTO datosManual(idManual, titulo, descripcion, link, lang) VALUES ({$this -> _idManual}, '{$this -> _titulo}', '{$this -> _descripcion}', '{$this -> _link}', '{$this -> _lang}')";
		$_MYSQL -> ejecutar_sentencia($_SQL);
	}

	function updateDatosManual($_titulo = '', $_descripcion = '', $_link = '', $_lang = ''){
		$this -> _titulo 	 = htmlspecialchars($_titulo, ENT_QUOTES);
		$this -> _descripcion  = htmlspecialchars($_descripcion, ENT_QUOTES);
		$this -> _link 		 = $_link;
		$this -> _lang 		 = $_lang;
		$_MYSQL = new conexion();
		$_SQL   = "UPDATE datosManual SET titulo = '{$this -> _titulo}', descripcion = '{$this -> _descripcion}', link = '{$this -> _link}' WHERE idManual = {$this -> _idManual} AND lang = '{$this -> _lang}'";
		$_MYSQL -> ejecutar_sentencia($_SQL);
	}

}
?>
