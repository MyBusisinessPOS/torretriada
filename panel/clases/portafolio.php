<?php
require_once('conexion.php');
require_once('archivo.php');
require_once('herramientas.php');
require_once('galeria.php');
require_once('portafolioxcategoria.php');
require_once('categoria.php');

class portafolio extends Archivo{
	/* ========================================================
	 * 			VARIABLES DE LA ENTIDAD PORTAFOLIO
	 * ======================================================== */
	var $_idPortafolio;
	var $_titulo;
	var $_descripcion;
	var $_imgPortada;
	var $_fichaTecnicaEs;
	var $_fichaTecnicaEn;
	var $_fichaTecnica;
	var $_tipo;
	/* ========================================================
	 * 	    VARIABLES DE UTILIDAD PARA LA ENTIDAD PORTAFOLIO
	 * ======================================================== */
	var $_status;
	var $_orden;
	var $_directorio = "../img/portafolio/";
	var $_directorioFicha = '../documents/portafolio/';
	var $_urlAmigable;
	var $_registrosPorPagina;
	var $_totalRegistros;
	var $_herramientas;
	var $_galeria;
	var $_portafolioxcategoria;
	var $_datosPortafolio;

	function __construct($_idPortafolio = 0, $_tipo = 0, $_imgPortada = '', $_tmp = ''){
		$this -> _idPortafolio = $_idPortafolio;
		$this -> _tipo = $_tipo;
		($_imgPortada != '') ? $this -> _imgPortada = $this -> obtenerExtensionArchivo($_imgPortada) : $this -> _imgPortada = '';
		$this -> ruta_final = $this -> _directorio;
		$this -> ruta_temporal = $_tmp;
		$this -> _herramientas = new herramientas();
		$this -> _galeria = array();
	}

	function addPortafolio(){
		if($this -> subir_archivo_imagen($this -> _imgPortada)){
			$_MYSQL = new conexion();
			$_SQL = "INSERT INTO portafolio(tipo, imgPortada, status)VALUES({$this -> _tipo}, '{$this -> _imgPortada}', 1)";
			$this -> _idPortafolio = $_MYSQL -> ejecutar_sentencia($_SQL);
			$_O = "UPDATE portafolio SET orden = {$this -> _idPortafolio} WHERE idPortafolio = {$this -> _idPortafolio}";
			$_MYSQL -> ejecutar_sentencia($_O);
		}
	}

	function updatePortafolio(){
		$this -> _urlAmigable = $this -> _herramientas -> getUrlAmigable($this -> _titulo);
		$_MYSQL = new conexion();
		if($this -> _imgPortada != ''){
			$this -> getImgPortada();
			$this -> borrar_archivo();
			$this -> ruta_final = $this -> _directorio;
			if($this -> subir_archivo_imagen($this -> _imgPortada)){
				$_IMG = "UPDATE portafolio SET imgPortada = '{$this -> _imgPortada}' WHERE idPortafolio = {$this -> _idPortafolio}";
				$_MYSQL -> ejecutar_sentencia($_IMG);
			}
		}
	}
	function updateMiniatura($_ruta,$_tmp){
		if($_ruta != ''){
			$this -> ruta_final = $this -> _directorio;
			$this -> ruta_temporal = $_tmp;
			$_ruta = $this -> obtenerExtensionArchivo($_ruta);
			$this -> subir_archivo_imagen($_ruta);
			$_MYSQL = new conexion();
			$_SQL = "UPDATE portafolio SET imgMini = '{$_ruta}' WHERE idPortafolio = {$this -> _idPortafolio}";
			$_MYSQL -> ejecutar_sentencia($_SQL);
		}
	}

	function updateAnio($idAnio){
		$_MYSQL = new conexion();
		$_SQL = "UPDATE portafolio SET idAnio = {$idAnio} WHERE idPortafolio={$this->_idPortafolio}";
		$_MYSQL -> ejecutar_sentencia($_SQL);
	}

	function addFichaTecnica($_fichaTecnica, $_temporal, $_lang = 'es'){
		if($_fichaTecnica != ''){
			$this -> getFichaTecnica($_lang);
			$this -> borrar_archivo();

			$_fichaTecnica = $this -> obtenerExtensionArchivo($_fichaTecnica);
			$this -> ruta_final		= $this -> _directorioFicha.$_fichaTecnica;
			$this -> ruta_temporal 	= $_temporal;
			$this -> subir_archivo();
			$_MYSQL = new conexion();
			$_SQL = ($_lang == 'es') ? "UPDATE portafolio SET fichaTecnicaEs = '{$_fichaTecnica}' WHERE idPortafolio = {$this -> _idPortafolio}" : "UPDATE portafolio SET fichaTecnicaEn = '{$_fichaTecnica}' WHERE idPortafolio = {$this -> _idPortafolio}";
			$_MYSQL -> ejecutar_sentencia($_SQL);
		}
	}
	function addArchivo($_archivo, $_temporal, $_lang = 'es'){
		if($_archivo != ''){
			$this -> getArchivo($_lang);
			$this -> borrar_archivo();

			$_archivo = $this -> obtenerExtensionArchivo($_archivo);
			$this -> ruta_final		= $this -> _directorioFicha.$_archivo;
			$this -> ruta_temporal 	= $_temporal;
			$this -> subir_archivo();
			$_MYSQL = new conexion();
			$_SQL = ($_lang == 'es') ? "UPDATE portafolio SET archivoEs = '{$_archivo}' WHERE idPortafolio = {$this -> _idPortafolio}" : "UPDATE portafolio SET archivoEn = '{$_archivo}' WHERE idPortafolio = {$this -> _idPortafolio}";
			$_MYSQL -> ejecutar_sentencia($_SQL);
		}
	}

	function getFichaTecnica($_lang = 'es'){
		$_MYSQL = new conexion();
		$_SQL 	= ($_lang == 'es') ? "SELECT fichaTecnicaEs FROM portafolio WHERE idPortafolio = {$this -> _idPortafolio}" : "SELECT fichaTecnicaEn FROM portafolio WHERE idPortafolio = {$this -> _idPortafolio}";
		$_MYSQL -> ejecutar_sentencia($_SQL);
		$obj 	= $_MYSQL -> fetchObject();
		$this -> ruta_final = ($_lang == 'es') ? $this -> _directorio.$obj -> fichaTecnicaEs :  $this -> _directorio.$obj -> fichaTecnicaEn;
	}
	function getArchivo($_lang = 'es'){
		$_MYSQL = new conexion();
		$_SQL 	= ($_lang == 'es') ? "SELECT archivoEs FROM portafolio WHERE idPortafolio = {$this -> _idPortafolio}" : "SELECT archivoEn FROM portafolio WHERE idPortafolio = {$this -> _idPortafolio}";
		$_MYSQL -> ejecutar_sentencia($_SQL);
		$obj 	= $_MYSQL -> fetchObject();
		$this -> ruta_final = ($_lang == 'es') ? $this -> _directorio.$obj -> archivoEs :  $this -> _directorio.$obj -> archivoEn;
	}

	function deletePortafolio(){
		$this -> getImgPortada();
		$this -> borrar_archivo();
		$this -> eliminarDatosPortafolio();
		$this -> getFichaTecnica('es');
		$this -> borrar_archivo();
		$this -> getFichaTecnica('en');
		$this -> borrar_archivo();

		$_MYSQL = new conexion();
		$_SQL = "DELETE FROM portafolio WHERE idPortafolio = {$this -> _idPortafolio}";
		$_MYSQL -> ejecutar_sentencia($_SQL);
	}

	function getImgPortada(){
		$_MYSQL = new conexion();
		$_SQL = "SELECT imgPortada FROM portafolio WHERE idPortafolio = {$this -> _idPortafolio}";
		$_MYSQL -> ejecutar_sentencia($_SQL);
		$obj = $_MYSQL -> fetchObject();
		$this -> ruta_final = $this -> _directorio.$obj -> imgPortada;
	}

	function updateStatusPortafolio($_status){
		$_MYSQL = new conexion();
		$_SQL = "UPDATE portafolio SET status = {$_status} WHERE idPortafolio = {$this -> _idPortafolio}";
		$_MYSQL -> ejecutar_sentencia($_SQL);
	}
	function updateDestacadoPortafolio($_status){
		$_MYSQL = new conexion();
		$_SQL = "UPDATE portafolio SET destacado = {$_status} WHERE idPortafolio = {$this -> _idPortafolio}";
		$_MYSQL -> ejecutar_sentencia($_SQL);
	}

	function updateOrdenPortafolio($_orden){
		$_MYSQL = new conexion();
		$_SQL = "UPDATE portafolio SET orden = {$_orden} WHERE idPortafolio = {$this -> _idPortafolio}";
		$_MYSQL -> ejecutar_sentencia($_SQL);
	}

	function getPortafolio($_lang = 'es'){
		$_MYSQL = new conexion();
		$_SQL = "SELECT * FROM portafolio WHERE idPortafolio = {$this -> _idPortafolio}";
		$_MYSQL -> ejecutar_sentencia($_SQL);
		$obj = $_MYSQL -> fetchObject();
		$this -> _idPortafolio = $obj -> idPortafolio;
		$this -> _idAnio	= $obj -> idAnio;
		$this -> _imgPortada = $obj -> imgPortada;
		$this -> _imgMini 	= $obj -> imgMini;
		$this -> _fichaTecnicaEs = $obj -> fichaTecnicaEs;
		$this -> _fichaTecnicaEn = $obj -> fichaTecnicaEn;
		$this -> _archivoEs    = $obj -> archivoEs;
		$this -> _archivoEn	   = $obj -> archivoEn;
		$this -> _fichaTecnica = ($_lang == 'es') ? $obj -> fichaTecnicaEs : $obj -> fichaTecnicaEn;
		//$this -> listarGaleria();
		//$this -> obtenerGaleria();
		$this -> obtenerDatosPortafolio($_lang);
	}

	function listPortafolio($_tipo = 0, $_pagina = 1, $_paginador = true, $_status = '', $_busqueda = '', $_registrosPorPagina = 20, $_cortar = true, $_idCategoria = 0, $_lang = 'es',$_anos=0,$_order='',$_destacado=0){
		($_status != '') ? $_stat = " AND status = ".$_status : $_stat = '';
		($_busqueda != '') ? $_bus = " AND (datosPortafolio.titulo LIKE '%".$_busqueda."%')" : $_bus = '';
		($_anos !=0) ? $_an = " AND portafolio.idAnio={$_anos}" : $_an = '';
		($_order!='') ? $_ord = $_order : $_ord = 'ORDER BY portafolio.orden DESC ';
		($_destacado!=0) ? $_dest = "AND portafolio.destacado=1" : $_dest = "";

		$_MYSQL = new conexion();
		if($_idCategoria != 0){
			$_TOTAL = "SELECT portafolio.idPortafolio, portafolioxcategoria.idCategoria FROM portafolio, portafolioxcategoria, datosPortafolio WHERE portafolio.idPortafolio = portafolioxcategoria.idPortafolio AND portafolio.idPortafolio = datosPortafolio.idPortafolio AND portafolio.tipo = {$_tipo} {$_dest}  AND  portafolioxcategoria.idCategoria = {$_idCategoria} AND datosPortafolio.lang = '{$_lang}' ".$_stat.$_bus;
		}else{
			$_TOTAL = "SELECT portafolio.idPortafolio FROM portafolio, datosPortafolio WHERE portafolio.idPortafolio = datosPortafolio.idPortafolio AND portafolio.tipo = {$_tipo}  {$_dest} AND   datosPortafolio.lang = '{$_lang}' ".$_stat." ".$_bus."";
		}
		if($_paginador){
			$_MYSQL -> ejecutar_sentencia($_TOTAL);
			$this -> _totalRegistros = $_MYSQL -> numRows();
			$this -> _registrosPorPagina = $_registrosPorPagina;
			$_ultimaPagina = ceil($this -> _totalRegistros / $this -> _registrosPorPagina);
			$_paginaActual = $_pagina;
			$_paginacion = ' LIMIT '.($_pagina - 1) * $this -> _registrosPorPagina.','.$this -> _registrosPorPagina;
		}else{
			$_paginacion = '';
		}

		if($_idCategoria != 0){
			$_SQL = "SELECT portafolio.*, datosPortafolio.titulo, datosPortafolio.urlAmigable, portafolioxcategoria.idCategoria FROM portafolio, datosPortafolio, portafolioxcategoria WHERE portafolio.idPortafolio = portafolioxcategoria.idPortafolio AND portafolio.idPortafolio = datosPortafolio.idPortafolio AND portafolio.tipo = {$_tipo} AND portafolioxcategoria.idCategoria = {$_idCategoria} AND datosPortafolio.lang = '{$_lang}' {$_dest} ".$_stat.$_bus.$_an." ".$_ord.$_paginacion;
		}else{
			$_SQL = "SELECT portafolio.*, datosPortafolio.titulo, datosPortafolio.descripcion, datosPortafolio.descripcion2, datosPortafolio.marca, datosPortafolio.urlAmigable FROM portafolio, datosPortafolio WHERE portafolio.idPortafolio = datosPortafolio.idPortafolio AND portafolio.tipo = {$_tipo} AND datosPortafolio.lang = '{$_lang}' {$_dest} ".$_stat.$_bus.$_an." ".$_ord.$_paginacion;
		}
		$_MYSQL -> ejecutar_sentencia($_SQL);
		$_resultados = array();
		while($_row = $_MYSQL -> fetchRow()){
			$categoria = new categoria($_row['idAnio']);
			$categoria -> getCategoria();
			$_registro['idPortafolio'] = $_row['idPortafolio'];
			$_registro['idAnio']	=	$_row['idAnio'];
			$_registro['titulo'] = htmlspecialchars_decode($_row['titulo']);
			$_registro['marca']		= htmlspecialchars_decode($_row['marca']);
			$_registro['descripcion'] = htmlspecialchars_decode($_row['descripcion']);
			$_registro['descripcion2'] = htmlspecialchars_decode($_row['descripcion2']);
			$_registro['imgPortada'] = $_row['imgPortada'];
			$_registro['imgMini'] = $_row['imgMini'];
			$_registro['urlAmigable'] = $_row['urlAmigable'];
			$_registro['tipo'] = $_row['tipo'];
			$_registro['destacado'] = $_row['destacado'];
			$_registro['fichaTecnicaEs'] = $_row['fichaTecnicaEs'];
			$_registro['fichaTecnicaEn'] = $_row['fichaTecnicaEn'];
			$_registro['archivoEs'] = $_row['archivoEs'];
			$_registro['archivoEn'] = $_row['archivoEn'];
			$_registro['status'] = $_row['status'];
			$_registro['orden'] = $_row['orden'];
			$_registro['categoriasAnosLabel'] = ($_lang=='es') ? '<span class="label label-primary">'.$categoria->_tituloEs.'</span>' : '<span class="label label-primary">'.$categoria->_tituloEn.'</span>';
			$_registro['categoriasLabel'] = $this -> listLabelCategorias($_row['idPortafolio'],4);
			$_registro['categoriasAno'] = ($_lang=='es') ? $categoria->_tituloEs : $categoria->_tituloEn;
			$_registro['categoria'] = $this -> listCatProyecto($_row['idPortafolio'],4);

			if($_paginador){
				$_registro['ultimapagina'] = $_ultimaPagina;
				$_registro['paginaanterior'] = $_pagina - 1;
				$_registro['paginasiguiente'] = $_pagina + 1;
				$_registro['pagina'] = $_pagina;
			}
			array_push($_resultados, $_registro);
		}
		return $_resultados;
	}
/* ===================================
 * MAESTRO DETALLE _GALERIA
 * =================================== */
	function agregarGaleria($_imagen, $_tipo, $_tmp){
		$galeria = new galeria(0, $this -> _idPortafolio, $_tipo, $_imagen, $_tmp);
		$galeria -> addGaleria();
	}

	function modificarGaleria($_idGaleria, $_imagen, $_tmp){
		$galeria = new galeria($_idGaleria, 0, '', $_imagen, $_tmp);
		$galeria -> updateGaleria();
	}

	function eliminarGaleria($_idGaleria){
		$galeria = new galeria($_idGaleria);
		$galeria -> deleteGaleria();
	}

	function modificarOrdenGaleria($_idGaleria, $_orden){
		$galeria = new galeria($_idGaleria);
		$galeria -> updateOrdenGaleria($_orden);
	}

	function obtenerGaleria(){
		$galeria = new galeria(0, $this -> _idPortafolio);
		$this -> _imgUbicacion = $galeria -> getGaleria();
	}

	function listarGaleria(){
		$galeria = new galeria(0, $this -> _idPortafolio);
		$this -> _galeria = $galeria -> listGaleria();
	}
/* ===================================
 * N:N _PORTAFOLIOXCATEGORIA
 * =================================== */
	function listLabelCategorias($_idPortafolio,$tipo){
		$portafolioxcategoria = new portafolioxcategoria($_idPortafolio);
		$portafolioxcategoria -> listNombreCategoriaxPortafolio($tipo);
		$_label = '';
		foreach ($portafolioxcategoria -> _categorias as $_c) {
			$_label .= '<span class="label label-primary">'.$_c['tituloEs'].'</span>  ';
		}
		return $_label;
	}
	function listCatProyecto($_idPortafolio,$tipo){
		$portafolioxcategoria = new portafolioxcategoria($_idPortafolio);
		$portafolioxcategoria -> listNombreCategoriaxPortafolio($tipo);
		foreach ($portafolioxcategoria -> _categorias as $_c) {
			$categoria .= $_c['tituloEs'];
		}
		return $categoria;
	}
	function listCatFiltroProyecto($_idPortafolio,$tipo,$lang){
		$portafolioxcategoria = new portafolioxcategoria($_idPortafolio);
		$portafolioxcategoria -> listFiltrosCategorias($tipo);
		//echo '<pre>';
		//print_r($portafolioxcategoria);
		//echo '</pre>';
		foreach ($portafolioxcategoria -> _categorias as $_c) {
			$categoria .= ($lang=='es') ? ' '.$_c['urlAmigablePadreEs'].$_c['urlAmigableEs'].' ' : ' '.$_c['urlAmigablePadreEn'].$_c['urlAmigableEn'].' ' ;
		}
		return $categoria;
	}

	function agregarCategoriaxPortafolio($_idCategoria,$_tipo){
		$portafolioxcategoria = new portafolioxcategoria($this -> _idPortafolio, $_idCategoria);
		$portafolioxcategoria -> addPortafolioxCategoria($_tipo);
	}

	function removerCategoriaxPortafolio($tipo=''){
		$portafolioxcategoria = new portafolioxcategoria($this -> _idPortafolio);
		$portafolioxcategoria -> removePortafolioxCategoria($tipo);
	}

	function existeCategoriaxPortafolio($_idCategoria){
		$portafolioxcategoria = new portafolioxcategoria($this -> _idPortafolio, $_idCategoria);
		$_response = $portafolioxcategoria -> existPortafolioxCategoria();
		return $_response;
	}
	function existCatxPort($idc,$tipo){
		$portxcat = new portafolioxcategoria($this->_idPortafolio);
		$_response = $portxcat -> existCategoriaxPortafolio($idc,$tipo);
		return $_response;
	}

/* ===================================
 * 1:1 _DatosPortafolio
 * =================================== */

	function agregarDatosPortafolio($_titulo = '', $_marca='', $_descripcion = '', $_lang = '', $_descripcion2 = ''){
		$datosPortafolio = new datosPortafolio($this -> _idPortafolio, $_titulo, $_marca, $_descripcion, $_lang, $_descripcion2);
		$datosPortafolio -> addDatosPortafolio();
	}

	function modificarDatosPortafolio($_titulo = '', $_marca='', $_descripcion = '', $_lang = '', $_descripcion2 = ''){
		$datosPortafolio = new datosPortafolio($this -> _idPortafolio, $_titulo, $_marca, $_descripcion, $_lang, $_descripcion2);
		$datosPortafolio -> updateDatosPortafolio();
	}

	function eliminarDatosPortafolio(){
		$datosPortafolio = new datosPortafolio($this -> _idPortafolio);
		$datosPortafolio -> deleteDatosPortafolio();
	}

	function obtenerDatosPortafolio($_lang = 'es'){
		$this -> _datosPortafolio = new datosPortafolio($this -> _idPortafolio);
		$this -> _datosPortafolio -> getDatosPortafolio($_lang);
	}
}
?>
