<?php
require_once('conexion.php');
require_once('herramientas.php');
require_once('portafolioxcategoria.php');
require_once('archivo.php');

class categoria extends Archivo{
	/* ========================================================
	 * 			VARIABLES DE LA ENTIDAD CATEGORIA
	 * ======================================================== */
	var $_idCategoria;
	var $_tituloEs;
	var $_tituloEn;
	var $_urlAmigableEs;
	var $_urlAmigableEn;
	var $_tipo;
	/* ========================================================
	 * 	    VARIABLES DE UTILIDAD PARA LA ENTIDAD CATEGORIA
	 * ======================================================== */
	var $_status;
	var $_orden;
	var $_registrosPorPagina;
	var $_totalRegistros;
	var $_herramientas;
	var $_directorio = "../img/categoria/";

	function __construct($_idCategoria = 0, $_tituloEs = '', $_tituloEn = '', $_tipo = 0){
		$this -> _idCategoria 	= $_idCategoria;
		$this -> _tituloEs 		= htmlspecialchars($_tituloEs, ENT_QUOTES);
		$this -> _tituloEn 		= htmlspecialchars($_tituloEn, ENT_QUOTES);
		$this -> _tipo 			= $_tipo;
		$this -> _herramientas 	= new herramientas();
	}

	function addCategoria(){
		$this -> _urlAmigableEs = $this -> _herramientas -> getUrlAmigable($this -> _tituloEs);
		$this -> _urlAmigableEn = $this -> _herramientas -> getUrlAmigable($this -> _tituloEn);
		$_MYSQL = new conexion();
		$_SQL 	= "INSERT INTO categoria(tituloEs, tituloEn, urlAmigableEs, urlAmigableEn, tipo, status)VALUES('{$this -> _tituloEs}', '{$this -> _tituloEn}', '{$this -> _urlAmigableEs}', '{$this -> _urlAmigableEn}', {$this -> _tipo}, 1)";
		$this -> _idCategoria = $_MYSQL -> ejecutar_sentencia($_SQL);
		$_O 	= "UPDATE categoria SET orden = {$this -> _idCategoria} WHERE idCategoria = {$this -> _idCategoria}";
		$_MYSQL -> ejecutar_sentencia($_O);

	}

	function updateCategoria(){
		$this -> _urlAmigableEs = $this -> _herramientas -> getUrlAmigable($this -> _tituloEs);
		$this -> _urlAmigableEn = $this -> _herramientas -> getUrlAmigable($this -> _tituloEn);
		$_MYSQL 	= new conexion();
		$_SQL 		= "UPDATE categoria SET tituloEs = '{$this -> _tituloEs}', tituloEn = '{$this -> _tituloEn}', urlAmigableEs = '{$this -> _urlAmigableEs}', urlAmigableEn = '{$this -> _urlAmigableEn}' WHERE idCategoria = {$this -> _idCategoria}";
		$_MYSQL -> ejecutar_sentencia($_SQL);
	}

	function updateIconoCategoria($ruta,$tmp,$tipo){
		($ruta != '') ? $this -> ruta = $this -> obtenerExtensionArchivo($ruta) : $this -> ruta = '';
		$this -> ruta_final = $this -> _directorio;
		$this -> ruta_temporal = $tmp;

		($tipo==1) ? $cons='rutaImg' : $cons='rutaImg2';

		if($this->subir_archivo_imagen($this->ruta)){
			$_MYSQL = new conexion();
			$_SQL = "UPDATE categoria SET {$cons} = '{$this->ruta}' WHERE idCategoria = {$this->_idCategoria}";
			$_MYSQL -> ejecutar_sentencia($_SQL);
		}

	}

	function deleteCategoria(){
		$this -> removerCategoriaxPortafolio();
		$_MYSQL = new conexion();
		$_SQL 	= "DELETE FROM categoria WHERE idCategoria = {$this -> _idCategoria}";
		$_MYSQL -> ejecutar_sentencia($_SQL);
	}

	function updateStatusCategoria($_status){
		$_MYSQL = new conexion();
		$_SQL 	= "UPDATE categoria SET status = {$_status} WHERE idCategoria = {$this -> _idCategoria}";
		$_MYSQL -> ejecutar_sentencia($_SQL);
	}

	function updateOrdenCategoria($_orden){
		$_MYSQL = new conexion();
		$_SQL 	= "UPDATE categoria SET orden = {$_orden} WHERE idCategoria = {$this -> _idCategoria}";
		$_MYSQL -> ejecutar_sentencia($_SQL);
	}

	function getCategoria(){
		$_MYSQL = new conexion();
		$_SQL 	= "SELECT * FROM categoria WHERE idCategoria = {$this -> _idCategoria}";
		$_MYSQL -> ejecutar_sentencia($_SQL);
		$obj 	= $_MYSQL -> fetchObject();
		$this -> _idCategoria 	= $obj -> idCategoria;
		$this -> _tituloEs 		= $obj -> tituloEs;
		$this -> _tituloEn 		= $obj -> tituloEn;
		$this -> _rutaImg		= $obj -> rutaImg;
		$this -> _rutaImg2      = $obj -> rutaImg2;
		$this -> _urlAmigableEs = $obj -> urlAmigableEs;
		$this -> _urlAmigableEn = $obj -> urlAmigableEn;
	}

	function listCategoria($_tipo = 0, $_pagina = 1, $_paginador = true, $_status = '', $_busqueda = '', $_registrosPorPagina = 20, $_lang = 'es', $_frontEnd = false, $_exist=0){
		($_status != '') ? $_stat 	= " AND status = ".$_status : $_stat = '';
		($_busqueda != '') ? $_bus 	= " AND (tituloEs LIKE '%".$_busqueda."%')" : $_bus = '';

		$_MYSQL = new conexion();

		if($_paginador){
			if($_frontEnd){
				$_TOTAL = "SELECT * FROM categoria, portafolioxcategoria WHERE categoria.idCategoria = portafolioxcategoria.idCategoria AND categoria.tipo = {$_tipo} AND categoria.status = 1 '{$_bus}' GROUP BY categoria.idCategoria ORDER BY categoria.orden DESC ";
			}else{
				$_TOTAL = "SELECT idCategoria FROM categoria WHERE categoria.tipo = {$_tipo} ".$_stat." ".$_bus." ORDER BY orden DESC";
			}

			$_MYSQL -> ejecutar_sentencia($_TOTAL);
			$this -> _totalRegistros 	 	= $_MYSQL -> numRows();
			$this -> _registrosPorPagina 	= $_registrosPorPagina;
			$_ultimaPagina 					= ceil($this -> _totalRegistros / $this -> _registrosPorPagina);
			$_paginaActual 					= $_pagina;
			$_paginacion   					= ' LIMIT '.($_pagina - 1) * $this -> _registrosPorPagina.','.$this -> _registrosPorPagina;
		}else{
			$_paginacion = '';
		}
		if($_frontEnd){
			$_SQL = "SELECT * FROM categoria, portafolioxcategoria WHERE categoria.idCategoria = portafolioxcategoria.idCategoria AND categoria.tipo = {$_tipo} AND categoria.status = 1 GROUP BY categoria.idCategoria ORDER BY categoria.orden DESC ";
		}else{
			$_SQL = "SELECT * FROM categoria WHERE categoria.tipo = {$_tipo} ".$_stat.$_bus." ORDER BY orden DESC ".$_paginacion;
		}

		$_MYSQL -> ejecutar_sentencia($_SQL);
		$_resultados = array();
		while($_row = $_MYSQL -> fetchRow()){
			if($_exist==1){
				//verifica si están asignados
				if($this->categoriaAsignada($_row['idCategoria'])){
					$_registro['idCategoria'] 	= $_row['idCategoria'];
					$_registro['tituloEs'] 		= $_row['tituloEs'];
					$_registro['tituloEn'] 		= $_row['tituloEn'];
					$_registro['rutaImg']		= $_row['rutaImg'];
					$_registro['rutaImg2']		= $_row['rutaImg2'];
					$_registro['urlAmigable'] 	= ($_lang == 'es') ? $_row['urlAmigableEs'] :  $_row['urlAmigableEn'];
					$_registro['titulo'] 		= ($_lang == 'es') ? $_row['tituloEs'] 		:  $_row['tituloEn'];
					$_registro['tipo'] 			= $_row['tipo'];
					$_registro['status'] 		= $_row['status'];
					$_registro['orden'] 		= $_row['orden'];
					$_registro['categorias']	= $this -> listCategoriasxCategoria($_row['idCategoria']);
					$_registro['catAsig']		= $this -> listCategoriasAsig($_row['idCategoria']);
					if($_paginador){
						$_registro['ultimapagina'] 	  = $_ultimaPagina;
						$_registro['paginaanterior']  = $_pagina - 1;
						$_registro['paginasiguiente'] = $_pagina + 1;
						$_registro['pagina'] 	      = $_pagina;
					}
					array_push($_resultados, $_registro);
				}
			}else{
				$_registro['idCategoria'] 	= $_row['idCategoria'];
				$_registro['tituloEs'] 		= $_row['tituloEs'];
				$_registro['tituloEn'] 		= $_row['tituloEn'];
				$_registro['rutaImg']		= $_row['rutaImg'];
				$_registro['rutaImg2']		= $_row['rutaImg2'];
				$_registro['urlAmigable'] 	= ($_lang == 'es') ? $_row['urlAmigableEs'] :  $_row['urlAmigableEn'];
				$_registro['titulo'] 		= ($_lang == 'es') ? $_row['tituloEs'] 		:  $_row['tituloEn'];
				$_registro['tipo'] 			= $_row['tipo'];
				$_registro['status'] 		= $_row['status'];
				$_registro['orden'] 		= $_row['orden'];
				$_registro['categorias']	= $this -> listCategoriasxCategoria($_row['idCategoria']);
				$_registro['catAsig']		= $this -> listCategoriasAsig($_row['idCategoria']);
				if($_paginador){
					$_registro['ultimapagina'] 	  = $_ultimaPagina;
					$_registro['paginaanterior']  = $_pagina - 1;
					$_registro['paginasiguiente'] = $_pagina + 1;
					$_registro['pagina'] 	      = $_pagina;
				}
				array_push($_resultados, $_registro);

			}

		}
		return $_resultados;
	}
	/* ===================================
	 * N:N _PORTAFOLIOXCATEGORIA
	 * =================================== */
	function removerCategoriaxPortafolio(){
		$portafolioxcategoria = new portafolioxcategoria(0, $this -> _idCategoria);
		$portafolioxcategoria -> removeCategoriaxPortafolio();
	}

	function addCategoriasxCategoria($idSubcategoria, $tipo){
		$_MYSQL = new conexion();
		$_SQL = "INSERT INTO categorias_x_categoria(idCategoria,idSubcategoria,tipo) VALUES ({$this->_idCategoria},{$idSubcategoria},{$tipo})";
		$_MYSQL -> ejecutar_sentencia($_SQL);
	}
	function delCategoriasxCategoria(){
		$_MYSQL = new conexion();
		$_SQL = "DELETE FROM categorias_x_categoria WHERE idCategoria = {$this->_idCategoria}";
		$_MYSQL -> ejecutar_sentencia($_SQL);
	}
	function listCategoriasxCategoria($idCategoria){
		$_MYSQL = new conexion();
		$_SQL = "SELECT * FROM categorias_x_categoria WHERE idCategoria = {$idCategoria}";
		$_MYSQL -> ejecutar_sentencia($_SQL);
		$_resultados = array();
		while($_row = $_MYSQL -> fetchRow()){
			array_push($_resultados, $_row['idSubcategoria']);
		}
		return json_encode($_resultados);

	}
	function listCategoriasAsig($idCategoria){
		$_MYSQL = new conexion();
		$_SQL = "SELECT * FROM categorias_x_categoria WHERE idCategoria != {$idCategoria}";
		$_MYSQL -> ejecutar_sentencia($_SQL);
		$_resultados = array();
		while($_row = $_MYSQL -> fetchRow()){
			array_push($_resultados, $_row['idSubcategoria']);
		}
		return json_encode($_resultados);

	}
	function existCategoriasxCategoria($idSubcategoria){
		$_MYSQL = new conexion();
		$_SQL = "SELECT * FROM categorias_x_categoria WHERE idCategoria = {$this->_idCategoria} AND idSubcategoria={$idSubcategoria}";
		$_MYSQL -> ejecutar_sentencia($_SQL);
		$exist = $_MYSQL -> numRows();
		if($exist>0){
			return true;
		}else{
			return false;
		}
	}
	function categoriaAsignada($idSubcategoria){
		$_MYSQL = new conexion();
		$_SQL = "SELECT * FROM categorias_x_categoria WHERE idSubcategoria={$idSubcategoria}";
		$_MYSQL -> ejecutar_sentencia($_SQL);
		$exist = $_MYSQL -> numRows();
		if($exist>0){
			return true;
		}else{
			return false;
		}
	}

	function listCategoriasSelects($tipo,$idPortafolio){
		$_MYSQL = new conexion();
		$_SQL = "SELECT b.tituloEs, b.idCategoria, a.tipo FROM categorias_x_categoria AS a, categoria AS b WHERE a.idSubcategoria = b.idCategoria AND  a.idCategoria={$this->_idCategoria} AND a.tipo={$tipo}";
		$_MYSQL -> ejecutar_sentencia($_SQL);
		$_resultados = array();
		while($_row = $_MYSQL -> fetchRow()){
			$_registro['tituloEs'] 	= $_row['tituloEs'];
			$_registro['idCategoria'] = $_row['idCategoria'];
			$_registro['idPadre']	= $this -> _idCategoria;
			$_registro['selected'] = ($this->checkCatxProducto($idPortafolio,$_row['idCategoria'],$tipo)) ? 'selected' : '';
			array_push($_resultados, $_registro);
		}
		return $_resultados;
	}

	function checkCatxProducto($idPortafolio,$idCategoria,$tipo){
		if($tipo==5){
			$cons = "AND idCategoria={$idCategoria}";
		}else if($tipo==6){
			$cons = "AND idSubcategoria={$idCategoria}";
		}else{
			$cons = "AND idPadre={$idCategoria}";
		}
		$_MYSQL = new conexion();
		$_SQL = "SELECT * FROM portafolioxcategoria WHERE idPortafolio = {$idPortafolio} {$cons} AND tipo={$tipo}";
		$_MYSQL -> ejecutar_sentencia($_SQL);
		$tot = $_MYSQL -> numRows();
		if($tot>0){
			return true;
		}else{
			return false;
		}
	}

	function checkAnioxProducto($idAnio){
		$_MYSQL = new conexion();
		$_SQL = "SELECT * FROM portafolio WHERE idAnio = {$idAnio}";
		$_MYSQL -> ejecutar_sentencia($_SQL);
		$tot = $_MYSQL -> numRows();
		if($tot>0){
			return true;
		}else{
			return false;
		}
	}

	function checkExistManualxCat($idCategoria){
		$_MYSQL = new conexion();
		$_SQL = "SELECT * FROM manual WHERE idCategoria = {$idCategoria}";
		$_MYSQL -> ejecutar_sentencia($_SQL);
		$tot = $_MYSQL -> numRows();
		if($tot>0){
			return true;
		}else{
			return false;
		}
	}

	function existCategoriaxPortafolio($idP=0,$idC=0,$tipo=0){
		if($tipo==1){
			$cons = " idPadre = {$idC} AND tipo = 1";
		}else if($tipo==5){
			$cons = " idCategoria = {$idC} AND idPadre ={$idP} AND tipo=5";
		}else if($tipo==6){
			$cons = " idSubcategoria = {$idC} AND idCategoria={$idP} AND tipo=6";
		}
		$_conexion = new conexion();
		$_SQL = "SELECT idCategoria FROM portafolioxcategoria WHERE {$cons} {$padre}";
		$_conexion -> ejecutar_sentencia($_SQL);
		if($_conexion -> numRows() > 0) return true; else return false;
	}

	function existCategoriaxBlog($idCat){
		$_MYSQL = new conexion();
		$_SQL = "SELECT * FROM blog WHERE id_categoria={$idCat}";
		$_MYSQL -> ejecutar_sentencia($_SQL);
		$total = $_MYSQL -> numRows();
		if($total>0){
			return true;
		}else{
			return false;
		}
	}

}
?>
