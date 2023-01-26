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
	var $_telefono;
	var $_telMovil;
	var $_email;
	var $_ubicacion;

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

	function __construct($_idSucursal = 0, $_telefono='', $_telMovil='', $_email='', $_ubicacion='',$_imgPortada = '', $_tmp = ''){
		$this -> _idSucursal 	 = $_idSucursal;
		$this -> _telefono		 = $_telefono;
		$this -> _telMovil		 = $_telMovil;
		$this -> _email 		 = $_email;
		$this -> _ubicacion		 = $_ubicacion;

		($_imgPortada != '') ? $this -> _imgPortada = $this -> obtenerExtensionArchivo($_imgPortada) : $this -> _imgPortada = '';

		$this -> ruta_final    = $this -> _directorio;
		$this -> ruta_temporal = $_tmp;
		$this -> _herramientas = new herramientas();
	}

	function addSucursal(){
		if($this -> subir_archivo_imagen($this -> _imgPortada)){
			$_MYSQL = new conexion();
			$_SQL = "INSERT INTO sucursal(imgPortada, telefono, telMovil, email, ubicacion, status)VALUES('{$this -> _imgPortada}','{$this -> _telefono}','{$this -> _telMovil}','{$this -> _email}','{$this -> _ubicacion}', 1)";
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
				$_IMG = "UPDATE sucursal SET imgPortada = '{$this -> _imgPortada}', telefono = '{$this->_telefono}', telMovil='{$this->_telMovil}', email = '{$this->_email}', ubicacion = '{$this->_ubicacion}' WHERE idSucursal = {$this -> _idSucursal}";
				$_MYSQL -> ejecutar_sentencia($_IMG);
			}
		}else{
			$_DATOS = "UPDATE sucursal SET telefono = '{$this->_telefono}', telMovil='{$this->_telMovil}', email = '{$this->_email}', ubicacion = '{$this->_ubicacion}' WHERE idSucursal = {$this -> _idSucursal}";
			$_MYSQL -> ejecutar_sentencia($_DATOS);
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
		//$this -> getImgMovil();
		//$this -> borrar_archivo();

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

	function updateDestacadoSucursal($_status){
		$_MYSQL = new conexion();
		$_SQL 	= "UPDATE sucursal SET destacado = {$_status} WHERE idSucursal = {$this -> _idSucursal}";
		$_MYSQL -> ejecutar_sentencia($_SQL);
	}
	function checkDestacado(){
		$_MYSQL = new conexion();
		$_SQL = "SELECT * FROM sucursal WHERE destacado=1";
		$_MYSQL -> ejecutar_sentencia($_SQL);
		$total = $_MYSQL -> numRows();
		if($total > 0){
			return false;
		}else{return true;}
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
			$this   -> _nombre 		= html_entity_decode($obj -> nombre,ENT_QUOTES);
			$this 	-> _descripcion = html_entity_decode($obj -> descripcion,ENT_QUOTES);
			$this 	-> _telefono	= $obj -> telefono;
			$this 	-> _telMovil	= $obj -> telMovil;
			$this 	-> _email		= $obj -> email;
			$this 	-> _ubicacion	= $obj -> ubicacion;
			$this   -> _imgPortada 	= $obj -> imgPortada;
		}else{
			return $obj;
		}

	}
	function getSucursalEn($_idSucursal = 0, $_lang = 'es'){
		$_MYSQL = new conexion();
		$_SQL 	= "SELECT sucursal.*, datosSucursal.* FROM sucursal, datosSucursal WHERE sucursal.idSucursal = datosSucursal.idSucursal AND sucursal.idSucursal = {$_idSucursal} AND datosSucursal.lang = '{$_lang}'";
		$_MYSQL -> ejecutar_sentencia($_SQL);
		$obj 	= $_MYSQL -> fetchObject();

			$this   -> _idSucursal 	= $obj -> idSucursal;
			$this   -> _nombre 		= html_entity_decode($obj -> nombre,ENT_QUOTES);
			$this 	-> _descripcion = html_entity_decode($obj -> descripcion,ENT_QUOTES);
			$this 	-> _telefono	= $obj -> telefono;
			$this 	-> _telMovil	= $obj -> telMovil;
			$this 	-> _email		= $obj -> email;
			$this 	-> _ubicacion	= $obj -> ubicacion;
			$this   -> _imgPortada 	= $obj -> imgPortada;


	}
	function getSucursalDestacado($_lang = 'es'){
		$_MYSQL = new conexion();
		$_SQL 	= "SELECT sucursal.*, datosSucursal.* FROM sucursal, datosSucursal WHERE sucursal.idSucursal = datosSucursal.idSucursal AND sucursal.destacado = 1 AND datosSucursal.lang = '{$_lang}'";
		$_MYSQL -> ejecutar_sentencia($_SQL);
		$obj 	= $_MYSQL -> fetchObject();
		$this   -> _idSucursal 	= $obj -> idSucursal;
		$this   -> _nombre 		= html_entity_decode($obj -> nombre,ENT_QUOTES);
		$this 	-> _descripcion = html_entity_decode($obj -> descripcion,ENT_QUOTES);
		$this 	-> _telefono	= $obj -> telefono;
		$this 	-> _telMovil	= $obj -> telMovil;
		$this 	-> _email		= $obj -> email;
		$this 	-> _ubicacion	= $obj -> ubicacion;
		$this   -> _imgPortada 	= $obj -> imgPortada;
	}

	function listSucursal($_pagina = 1, $_paginador = true, $_status = '', $_busqueda = '', $_registrosPorPagina = 20, $_lang = 'es', $_frontEnd = false){
		($_status != '') ? $_stat = " AND sucursal.status = ".$_status : $_stat = '';
		($_busqueda != '') ? $_bus = " AND (datosSucursal.titulo LIKE '%".$_busqueda."%')" : $_bus = '';
		($_frontEnd!=false) ? $_dest = " AND sucursal.destacado!=1 " : $_dest = '';

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

		$_SQL  = "SELECT sucursal.*, datosSucursal.* FROM sucursal, datosSucursal WHERE sucursal.idSucursal = datosSucursal.idSucursal AND datosSucursal.lang = '{$_lang}' ".$_dest.$_stat.$_bus." ORDER BY sucursal.orden DESC ".$_paginacion;
		$_MYSQL -> ejecutar_sentencia($_SQL);
		$_resultados = array();
		while($_row = $_MYSQL -> fetchRow()){
			$_registro['idSucursal'] 		= $_row['idSucursal'];
			$_registro['nombre']		= html_entity_decode($_row['nombre'],ENT_QUOTES);
			$_registro['descripcion']		= html_entity_decode($_row['descripcion'],ENT_QUOTES);
			$_registro['telefono']		= $_row['telefono'];
			$_registro['telMovil']		= $_row['telMovil'];
			$_registro['email']			= $_row['email'];
			$_registro['ubicacion']		= $_row['ubicacion'];

			if($_frontEnd){
				$this -> _idSucursal = $_row['idSucursal'];
				$_en = $this -> getSucursal('en', false);
				$_registro['nombre_en']		= html_entity_decode($_en -> nombre,ENT_QUOTES);
				$_registro['descripcion_en']		= html_entity_decode($_en -> descripcion,ENT_QUOTES);
			}

			$_registro['imgPortada'] 	= $_row['imgPortada'];
			$_registro['destacado']		= $_row['destacado'];
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

	function addDatosSucursal($_nombre = '', $_descripcion = '', $_lang = ''){
		$this -> _nombre 	 = htmlspecialchars($_nombre, ENT_QUOTES);
		$this -> _descripcion  = htmlspecialchars($_descripcion, ENT_QUOTES);
		$this -> _lang 		 = $_lang;
		$_MYSQL	= new conexion();
		$_SQL   = "INSERT INTO datosSucursal(idSucursal, nombre, descripcion,lang) VALUES ({$this -> _idSucursal}, '{$this -> _nombre}', '{$this -> _descripcion}','{$this -> _lang}')";
		$_MYSQL -> ejecutar_sentencia($_SQL);
	}

	function updateDatosSucursal($_nombre = '', $_descripcion = '', $_lang = ''){
		$this -> _nombre 	 = htmlspecialchars($_nombre, ENT_QUOTES);
		$this -> _descripcion  = htmlspecialchars($_descripcion, ENT_QUOTES);

		$this -> _lang 		 = $_lang;
		$_MYSQL = new conexion();
		$_SQL   = "UPDATE datosSucursal SET nombre = '{$this -> _nombre}', descripcion = '{$this -> _descripcion}' WHERE idSucursal = {$this -> _idSucursal} AND lang = '{$this -> _lang}'";
		$_MYSQL -> ejecutar_sentencia($_SQL);
	}

	function updateImgMapa($imgPortadaMapa,$tmpMapa){
		($imgPortadaMapa != '') ? $this -> _imgPortadaMapa = $this -> obtenerExtensionArchivo($imgPortadaMapa) : $this -> _imgPortadaMapa = '';
		$this -> _tmpMapa		 = $tmpMapa;

		if($this -> _imgPortadaMapa != ''){
			//echo $this->_imgPortadaMapa;
			//echo $this->_tmpMapa;
			$this -> getImgPortadaMapa();
			$this -> borrar_archivo();
			$this -> ruta_temporal = $this -> _tmpMapa;
			$this -> ruta_final = $this -> _directorio;
			if($this -> subir_archivo_imagen($this -> _imgPortadaMapa)){
				$_MYSQL = new conexion();
				$_SQL = "UPDATE sucursal SET imgPortada = '{$this->_imgPortadaMapa}' WHERE destacado = 5";
				$_MYSQL -> ejecutar_sentencia($_SQL);
			}
		}

	}
	function getImgPortadaMapa(){
		$_MYSQL = new conexion();
		$_SQL 	= "SELECT imgPortada FROM sucursal WHERE destacado = 5";
		$_MYSQL -> ejecutar_sentencia($_SQL);
		$obj 	= $_MYSQL -> fetchObject();
		$this -> ruta_final = $this -> _directorio.$obj -> imgPortada;
	}
	function getImgMapa(){
		$_MYSQL = new conexion();
		$_SQL   = "SELECT imgPortada FROM sucursal WHERE destacado=5";
		$_MYSQL -> ejecutar_sentencia($_SQL);
		$obj = $_MYSQL -> fetchObject();
		$this -> rutaImgMapa = $obj -> imgPortada;
	}

}
?>
