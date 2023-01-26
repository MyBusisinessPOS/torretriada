<?php

require_once('conexion.php');
require_once('archivo.php');
require_once('herramientas.php');

class proyectosvendidos extends Archivo{
	/* ========================================================
	 * 			VARIABLES DE LA ENTIDAD PORTAFOLIO
	 * ======================================================== */
	var $_id_vendido;
	var $_titulo;
	var $_descripcion;

	
	var $_lang;
	
	/* ========================================================
	 * 	    VARIABLES DE UTILIDAD PARA LA ENTIDAD PORTAFOLIO
	 * ======================================================== */
	var $_status;
	var $_orden;
	var $_directorio = "../img/sucursal/";
	var $_registrosPorPagina;
	var $_totalRegistros;
	var $_herramientas;
	
	function __construct($_id_vendido = 0){
		$this -> _id_vendido	 = $_id_vendido;
		
	}

	function addVendido(){
		$_MYSQL = new conexion();
		$_SQL = "INSERT INTO vendido (status) VALUES (1)";
		$this -> _id_vendido = $_MYSQL -> ejecutar_sentencia($_SQL);
		if($this -> _id_vendido != 0){
			$_orden = "UPDATE vendido SET orden={$this->_id_vendido} WHERE id_vendido={$this->_id_vendido}";
			$_MYSQL -> ejecutar_sentencia($_orden);			
		}
	}

	function addDatosVendido($_titulo = '',$_subtitulo = '', $_descripcion = '', $_lang = 'es'){
		$this -> _titulo		 = htmlentities($_titulo,ENT_QUOTES);
		$this -> _subtitulo 	 = htmlentities($_subtitulo,ENT_QUOTES);
		$this -> _descripcion 	 = htmlentities($_descripcion,ENT_QUOTES);
		$this -> _lang 			 = $_lang;		
		$_MYSQL = new conexion();
		$_SQL = "INSERT INTO datos_vendido (id_vendido,titulo,subtitulo,descripcion,lang) VALUES ({$this->_id_vendido},'{$this->_titulo}','{$this->_subtitulo}','{$this->_descripcion}','{$this->_lang}')";
		$_MYSQL -> ejecutar_sentencia($_SQL);		
	}

	function updateDatosVendido($_titulo = '',$_subtitulo = '', $_descripcion = '', $_lang = 'es'){
		$this -> _titulo		 = htmlentities($_titulo,ENT_QUOTES);
		$this -> _subtitulo 	 = htmlentities($_subtitulo,ENT_QUOTES);
		$this -> _descripcion 	 = htmlentities($_descripcion,ENT_QUOTES);
		$this -> _lang 			 = $_lang;		
		$_MYSQL = new conexion();
		$_SQL = "UPDATE datos_vendido SET titulo='{$this->_titulo}', subtitulo = '{$this->_subtitulo}', descripcion = '{$this->_descripcion}' WHERE lang='{$this->_lang}' AND id_vendido = {$this->_id_vendido}";
		$_MYSQL -> ejecutar_sentencia($_SQL);
	}

	function deleteVendido(){
		$_MYSQL = new conexion();
		$_SQL 	= "DELETE FROM vendido WHERE id_vendido = {$this -> _id_vendido}";
		$_MYSQL -> ejecutar_sentencia($_SQL);
		$_SQL2 = "DELETE FROM datos_vendido WHERE id_vendido = {$this->_id_vendido}";
		$_MYSQL -> ejecutar_sentencia($_SQL2);
	}	

	function updateStatusVendido($_status){
		$_MYSQL = new conexion();
		$_SQL 	= "UPDATE vendido SET status = {$_status} WHERE id_vendido = {$this -> _id_vendido}";
		$_MYSQL -> ejecutar_sentencia($_SQL);
	}

	function updateDestacadoVendido($_status){
		$_MYSQL = new conexion();
		$_SQL 	= "UPDATE vendido SET destacado = {$_status} WHERE id_vendido = {$this -> _id_vendido}";
		$_MYSQL -> ejecutar_sentencia($_SQL);		
	}
	function checkDestacado(){
		$_MYSQL = new conexion();
		$_SQL = "SELECT * FROM vendido WHERE destacado = 1";
		$_MYSQL -> ejecutar_sentencia($_SQL);
		$total = $_MYSQL -> numRows();		
		if($total >= 6){
			return false;
		}else{return true;}		
	}

	function updateOrdenVendido($_orden){
		$_MYSQL = new conexion();
		$_SQL 	= "UPDATE vendido SET orden = {$_orden} WHERE id_vendido = {$this -> _id_vendido}";
		$_MYSQL -> ejecutar_sentencia($_SQL);
	}

	function getVendido($_lang = 'es', $_res = true){
		$_MYSQL = new conexion();
		$_SQL 	= "SELECT * FROM datos_vendido WHERE id_vendido={$this->_id_vendido} AND lang = '{$_lang}'";
		$_MYSQL -> ejecutar_sentencia($_SQL);
		$obj 	= $_MYSQL -> fetchObject();
		if($_res){
			$this   -> _id_vendido 	= $obj -> id_vendido;
			$this   -> _titulo 		= html_entity_decode($obj -> titulo,ENT_QUOTES);
			$this 	-> _subtitulo = html_entity_decode($obj -> subtitulo,ENT_QUOTES);
			$this 	-> _descripcion	= html_entity_decode($obj -> descripcion,ENT_QUOTES);					
		}else{
			return $obj;
		}
		
	}
	function getVendidoEn($_id_vendido = 0, $_lang = 'es'){
		$_MYSQL = new conexion();
		$_SQL 	= "SELECT vendido.*, datos_vendido.* FROM vendido, datos_vendido WHERE vendido.id_vendido = datos_vendido.id_vendido AND vendido.id_vendido = {$_id_vendido} AND datos_vendido.lang = '{$_lang}'";
		$_MYSQL -> ejecutar_sentencia($_SQL);
		$obj 	= $_MYSQL -> fetchObject();		
		$this   -> _id_vendido 	= $obj -> id_vendido;
		$this   -> _titulo 		= html_entity_decode($obj -> titulo,ENT_QUOTES);
		$this 	-> _subtitulo = html_entity_decode($obj -> subtitulo,ENT_QUOTES);
		$this 	-> _descripcion	= html_entity_decode($obj -> descripcion,ENT_QUOTES);						
	}
	function listVendido($_pagina = 1, $_paginador = true, $_status = '', $_busqueda = '', $_registrosPorPagina = 20, $_lang = 'es', $_frontEnd = false){
		($_status != '') ? $_stat = " AND vendido.status = ".$_status : $_stat = '';
		($_busqueda != '') ? $_bus = " AND (datos_vendido.titulo LIKE '%".$_busqueda."%')" : $_bus = '';
		($_frontEnd!=false) ? $_dest = " AND vendido.destacado=1 " : $_dest = '';
		
		$_MYSQL = new conexion();
		$_TOTAL = "SELECT vendido.id_vendido FROM vendido, datos_vendido WHERE vendido.id_vendido = datos_vendido.id_vendido AND datos_vendido.lang = '{$_lang}' ".$_stat." ".$_bus." ORDER BY vendido.orden DESC";
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
		
		$_SQL  = "SELECT vendido.*, datos_vendido.* FROM vendido, datos_vendido WHERE vendido.id_vendido = datos_vendido.id_vendido AND datos_vendido.lang = '{$_lang}' ".$_dest.$_stat.$_bus." ORDER BY vendido.orden DESC ".$_paginacion;
		$_MYSQL -> ejecutar_sentencia($_SQL);
		$_resultados = array();
		while($_row = $_MYSQL -> fetchRow()){
			$_registro['id_vendido'] 		= $_row['id_vendido'];
			$_registro['titulo']			= html_entity_decode($_row['titulo'],ENT_QUOTES);
			$_registro['subtitulo']			= html_entity_decode($_row['subtitulo'],ENT_QUOTES);
			$_registro['descripcion']		= html_entity_decode($_row['descripcion'],ENT_QUOTES);
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

}
?>