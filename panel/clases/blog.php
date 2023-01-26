<?php
require_once('conexion.php');
require_once('archivo.php');
require_once('datos_blog.php');
require_once('contenido_blog.php');
require_once('herramientas.php');

class blog extends Archivo {
	var $_id_blog;
	var $_id_categoria;
	var $_ruta;
	var $_rutaR;
	var $_fecha_creacion;
	var $_fecha_creacion_unformated;
	var $_fecha_modificacion;
	var $_status;
    var $_orden;
    var $_directorio = '../../img/blog/';

    var $_contenido_blog;
	var $_datos_blog;
	var $_herramientas;
	var $_id_contenido_blog;

	var $_titulo_categoria;


	function __construct($_id_blog = 0, $_id_categoria = 0, $_ruta = '', $tmp = '', $_rutaR = '', $tmpR = '') {
		$this -> _id_blog      = $_id_blog;
		$this -> _id_categoria = $_id_categoria;
		($_ruta != '') ? $this -> _ruta = $this -> obtenerExtensionArchivo($_ruta) :  $this -> _ruta = '';
		($_rutaR != '') ? $this -> _rutaR = $this -> obtenerExtensionArchivo($_rutaR) :  $this -> _rutaR = '';
		$this -> _contenido_blog      = array();
		$this -> ruta_final          = $this -> _directorio;
		$this -> ruta_temporal       = $tmp;
		$this -> ruta_temporalR       = $tmpR;
		$this -> _herramientas       = new herramientas();

	}

	function add_blog(){
		if($this -> subir_archivo_imagen($this -> _ruta)){
			if($this->_rutaR != ""){
				$this -> ruta_temporal=$this -> ruta_temporalR;
				$this -> subir_archivo_imagen($this -> _rutaR);
			}
			$this -> _fecha_creacion = date('Y-m-d');
			$_MYSQL = new conexion();
			$_SQL = "INSERT INTO blog(id_categoria, fecha_creacion, ruta, status, rutaR)VALUES({$this -> _id_categoria}, '{$this -> _fecha_creacion}', '{$this -> _ruta}', 1, '{$this -> _rutaR}')";
			$this -> _id_blog = $_MYSQL -> ejecutar_sentencia($_SQL);
            $_O = "UPDATE blog SET orden = {$this -> _id_blog} WHERE id_blog = {$this -> _id_blog}";
            $_MYSQL -> ejecutar_sentencia($_O);
            return true;
		}else{
			return false;
		}
	}

	function update_blog(){
		$_MYSQL = new conexion();
		if($this -> _ruta != ''){
			$this -> get_img();
			$this -> borrar_archivo();
			$this -> ruta_final = $this -> _directorio;
			if($this -> subir_archivo_imagen($this -> _ruta)){
				$_IMG = "UPDATE blog SET ruta = '{$this -> _ruta}' WHERE id_blog = {$this -> _id_blog}";
				$_MYSQL -> ejecutar_sentencia($_IMG);
			}
		}
		if($this -> _rutaR != ''){
			$this -> get_imgR();
			$this -> borrar_archivo();
			$this -> ruta_final = $this -> _directorio;
			$this -> ruta_temporal=$this -> ruta_temporalR;
			if($this -> subir_archivo_imagen($this -> _rutaR)){
				$_IMGR = "UPDATE blog SET rutaR = '{$this -> _rutaR}' WHERE id_blog = {$this -> _id_blog}";
				$_MYSQL -> ejecutar_sentencia($_IMGR);
			}
		}
		$this -> _fecha_modificacion = date('Y-m-d');
		$_SQL = "UPDATE blog SET id_categoria = {$this -> _id_categoria}, fecha_modificacion = '{$this -> _fecha_modificacion}' WHERE id_blog = {$this -> _id_blog}";
		$_MYSQL -> ejecutar_sentencia($_SQL);
	}

	function delete_blog(){
		$this -> get_img();
		$this -> borrar_archivo();

		$this -> get_imgR();
		$this -> borrar_archivo();

		$_MYSQL = new conexion();
		$_SQL = "DELETE FROM blog WHERE id_blog = {$this -> _id_blog}";
		$_MYSQL -> ejecutar_sentencia($_SQL);
	}

	function update_status_blog($_status = 0){
		$_MYSQL = new conexion();
		$_SQL = "UPDATE blog SET status = {$_status} WHERE id_blog = {$this -> _id_blog}";
		$_MYSQL -> ejecutar_sentencia($_SQL);
	}

	function update_orden_blog($_orden = 0){
		$_MYSQL = new conexion();
		$_SQL = "UPDATE blog SET orden = {$_orden} WHERE id_blog = {$this -> _id_blog}";
        $_MYSQL -> ejecutar_sentencia($_SQL);
	}


	function get_img(){
		$_MYSQL = new conexion();
		$_SQL = "SELECT ruta FROM blog WHERE id_blog = {$this -> _id_blog}";
		$_MYSQL -> ejecutar_sentencia($_SQL);
		$obj = $_MYSQL -> fetchObject();
		$this -> ruta_final = $this -> _directorio.$obj -> ruta;
	}

	function get_imgR(){
		$_MYSQL = new conexion();
		$_SQL = "SELECT rutaR FROM blog WHERE id_blog = {$this -> _id_blog}";
		$_MYSQL -> ejecutar_sentencia($_SQL);
		$obj = $_MYSQL -> fetchObject();
		$this -> ruta_final = $this -> _directorio.$obj -> rutaR;
	}

	function get_blog($_lang = 'es'){
		$_MYSQL = new conexion();
		$_SQL = "SELECT * FROM blog WHERE id_blog = {$this -> _id_blog}";
		$_MYSQL -> ejecutar_sentencia($_SQL);
		$obj = $_MYSQL -> fetchObject();

		$this -> _id_blog          = $obj -> id_blog;
		$this -> _id_categoria     = $obj -> id_categoria;
		$this -> _titulo_categoria = $this -> getNameCategoria($obj -> id_categoria, $_lang);
		$this -> _ruta         = $obj -> ruta;
		$this -> _rutaR         = $obj -> rutaR;
		$this -> _fecha_creacion_unformated  = $obj -> fecha_creacion;
		$this -> _fecha_creacion   = $this -> _herramientas ->  getFormatedDate($obj -> fecha_creacion);
		$this -> listar_contenido_blog();
	}

	function listBlog($_pagina = 1, $_paginador = true, $_id_categoria = '', $_status = '', $_busqueda = '', $_tags = '', $_rpp = 50, $_frontEnd = true, $_lang = 'es', $_recent = null){
		($_status != '') ? $_stat = " AND A.status = ".$_status : $_stat = '';
		($_busqueda != '') ? $_bus = " AND (B.titulo LIKE '%".$_busqueda."%' OR B.tags_amigables LIKE '%".$_busqueda."%' OR B.descripcion LIKE '%".$_busqueda."%')" : $_bus = '';
		($_id_categoria != '') ? $_cat = " AND A.id_categoria = ".$_id_categoria." " : $_cat = "";
		($_tags != '') ? $_tag = " AND (B.tags_amigables LIKE '%".$_tags."%' or B.tags LIKE '%".$_tags."%')" : $_tag = '';
        (isset($_recent)) ? $_rc = " ORDER BY A.fecha_creacion DESC" : $_rc = 'ORDER BY A.orden DESC';
        ($_lang=='es') ? $tit = 'tituloEs' : $tit='tituloEn';

		$_MYSQL = new conexion();
		$_SQL = "SELECT A.id_blog, A.id_categoria, (SELECT {$tit} FROM categoria WHERE idCategoria = A.id_categoria AND lang = '{$_lang}') AS titulo_categoria, A.ruta, A.fecha_creacion, A.fecha_modificacion, A.status, A.orden, B.titulo, B.subtitulo, B.descripcion, B.tags, B.tags_amigables, B.url_amigable
				   FROM blog A, datos_blog B
				   WHERE A.id_blog = B.id_blog AND B.lang = '{$_lang}' ".$_cat.$_bus.$_tag.$_stat." {$_rc}";
		$_MYSQL -> ejecutar_sentencia($_SQL);
		$_ultimaPagina = 0;
		if($_paginador){
			$_totalRegistros = $_MYSQL -> numRows();
			$_registrosPorPagina = $_rpp;
			$_ultimaPagina = ceil($_totalRegistros / $_registrosPorPagina);
			$_paginacion   = ' LIMIT '.($_pagina - 1) * $_registrosPorPagina.','.$_registrosPorPagina;
			$_SQL .= $_paginacion;
			$_MYSQL -> ejecutar_sentencia($_SQL);
		}
		$_resultados = array();
		while($_row = $_MYSQL -> fetchRow()){
			$_registro['id_blog']            = $_row['id_blog'];
			$_registro['id_categoria']       = $_row['id_categoria'];
			$_registro['tituloCategoria']    = $_row['titulo_categoria'];
			$_registro['url_amigableCat']    = $this ->_herramientas -> getUrlAmigable($_row['titulo_categoria']);
			$_registro['ruta']               = $_row['ruta'];
			$_registro['titulo']             = html_entity_decode($_row['titulo']);
			$_registro['subtitulo']          = html_entity_decode($_row['subtitulo']);
			$_registro['descripcion']        = $this -> _herramientas -> cortarTexto(html_entity_decode($_row['descripcion']), 360);
			$_registro['tags']               = $this -> _herramientas -> formatedTags(html_entity_decode($_row['tags']), $_frontEnd);
			$_registro['tags_amigables']     = $this -> _herramientas -> formatedTags($_row['tags_amigables'], $_frontEnd);
			$_registro['url_amigable']       = $_row['url_amigable'];
			$_registro['fechaOriginal']      = $_row['fecha_creacion'];
			$_registro['fecha_creacion']     = $this -> _herramientas -> getFormatedDate($_row['fecha_creacion']);
			$_registro['fecha_modificacion'] = $_row['fecha_modificacion'];
			$_registro['status']             = $_row['status'];
			$_registro['orden']              = $_row['orden'];
			if($_paginador){
				$_registro['ultimapagina']    = $_ultimaPagina;
				$_registro['paginaanterior']  = $_pagina - 1;
				$_registro['paginasiguiente'] = $_pagina + 1;
				$_registro['pagina']          = $_pagina;
			}
			array_push($_resultados, $_registro);
		}
		return $_resultados;
	}

	function listRecentBlog($_lang = 'es',$_id_blog=0,$_limit = 0){
		($_lang=='es') ? $tit = 'tituloEs' : $tit='tituloEn';
		($_id_blog!=0) ? $cons = "AND B.id_blog != {$_id_blog}" : $cons='';
		($_limit !=0)   ? $lim = $_limit : $lim = 3;
		 $_MYSQL = new conexion();
		$_SQL = "SELECT A.id_blog, A.id_categoria,(SELECT {$tit} FROM categoria WHERE idCategoria = A.id_categoria AND lang = '{$_lang}') AS titulo_categoria, A.ruta, A.fecha_creacion, A.fecha_modificacion, A.status, A.orden, B.titulo, B.subtitulo, B.descripcion, B.tags, B.tags_amigables, B.url_amigable
				  FROM blog A, datos_blog B
				  WHERE A.id_blog = B.id_blog {$cons} AND B.lang = '{$_lang}' AND A.status = 1 ORDER BY A.fecha_creacion DESC LIMIT 0, {$lim}";
		 $_MYSQL -> ejecutar_sentencia($_SQL);
		 $_resultados = array();
		 while($_row = $_MYSQL -> fetchRow()){
			 $_registro['id_blog']            = $_row['id_blog'];
			 $_registro['id_categoria']       = $_row['id_categoria'];
			 $_registro['tituloCategoria']    = $_row['titulo_categoria'];
			 $_registro['url_amigableCat']    = $this ->_herramientas -> getUrlAmigable($_row['titulo_categoria']);
			 $_registro['ruta']               = $_row['ruta'];
			 $_registro['titulo']             = html_entity_decode($_row['titulo']);
			 $_registro['subtitulo']          = html_entity_decode($_row['subtitulo']);
			 $_registro['descripcion']        = $this -> _herramientas -> cortarTexto(html_entity_decode($_row['descripcion']), 300);
			 $_registro['tags']               = $this -> _herramientas -> formatedTags(html_entity_decode($_row['tags']), true);
			 $_registro['tags_amigables']     = $this -> _herramientas -> formatedTags($_row['tags_amigables'], true);
			 $_registro['url_amigable']       = $_row['url_amigable'];
			 $_registro['fecha_creacion']     = $this -> _herramientas -> getFormatedDate($_row['fecha_creacion']);
			 $_registro['fecha_modificacion'] = $_row['fecha_modificacion'];
			 $_registro['fecha']              = $_row['fecha_creacion'];
			 $_registro['status']             = $_row['status'];
			 $_registro['orden']              = $_row['orden'];

			array_push($_resultados, $_registro);
		}
		return $_resultados;
	}

	function listBlogPrev($_lang = 'es',$_id_blog=0){
		($_lang=='es') ? $tit = 'tituloEs' : $tit='tituloEn';
		($_id_blog!=0) ? $cons = "AND A.id_blog < {$_id_blog}" : $cons='';
		 $_MYSQL = new conexion();
		$_SQL = "SELECT A.id_blog, A.id_categoria,(SELECT {$tit} FROM categoria WHERE idCategoria = A.id_categoria AND lang = '{$_lang}') AS titulo_categoria, A.ruta, A.fecha_creacion, A.fecha_modificacion, A.status, A.orden, B.titulo, B.subtitulo, B.descripcion, B.tags, B.tags_amigables, B.url_amigable
				  FROM blog A, datos_blog B
				  WHERE A.id_blog = B.id_blog {$cons} AND B.lang = '{$_lang}' AND A.status = 1 ORDER BY A.fecha_creacion DESC LIMIT 0, 1";
		 $_MYSQL -> ejecutar_sentencia($_SQL);
		 $_resultados = array();
		 while($_row = $_MYSQL -> fetchRow()){
			 $_registro['id_blog']            = $_row['id_blog'];
			 $_registro['id_categoria']       = $_row['id_categoria'];
			 $_registro['tituloCategoria']    = $_row['titulo_categoria'];
			 $_registro['url_amigableCat']    = $this ->_herramientas -> getUrlAmigable($_row['titulo_categoria']);
			 $_registro['ruta']               = $_row['ruta'];
			 $_registro['titulo']             = html_entity_decode($_row['titulo']);
			 $_registro['subtitulo']          = html_entity_decode($_row['subtitulo']);
			 $_registro['descripcion']        = $this -> _herramientas -> cortarTexto(html_entity_decode($_row['descripcion']), 300);
			 $_registro['tags']               = $this -> _herramientas -> formatedTags(html_entity_decode($_row['tags']), true);
			 $_registro['tags_amigables']     = $this -> _herramientas -> formatedTags($_row['tags_amigables'], true);
			 $_registro['url_amigable']       = $_row['url_amigable'];
			 $_registro['fecha_creacion']     = $this -> _herramientas -> getFormatedDate($_row['fecha_creacion']);
			 $_registro['fecha_modificacion'] = $_row['fecha_modificacion'];
			 $_registro['fecha']              = $_row['fecha_creacion'];
			 $_registro['status']             = $_row['status'];
			 $_registro['orden']              = $_row['orden'];

			array_push($_resultados, $_registro);
		}
		return $_resultados;
	}

	function listBlogNext($_lang = 'es',$_id_blog=0){
		($_lang=='es') ? $tit = 'tituloEs' : $tit='tituloEn';
		($_id_blog!=0) ? $cons = "AND A.id_blog > {$_id_blog}" : $cons='';
		 $_MYSQL = new conexion();
		$_SQL = "SELECT A.id_blog, A.id_categoria,(SELECT {$tit} FROM categoria WHERE idCategoria = A.id_categoria AND lang = '{$_lang}') AS titulo_categoria, A.ruta, A.fecha_creacion, A.fecha_modificacion, A.status, A.orden, B.titulo, B.subtitulo, B.descripcion, B.tags, B.tags_amigables, B.url_amigable
				  FROM blog A, datos_blog B
				  WHERE A.id_blog = B.id_blog {$cons} AND B.lang = '{$_lang}' AND A.status = 1 ORDER BY A.fecha_creacion DESC LIMIT 0, 1";
		 $_MYSQL -> ejecutar_sentencia($_SQL);
		 $_resultados = array();
		 while($_row = $_MYSQL -> fetchRow()){
			 $_registro['id_blog']            = $_row['id_blog'];
			 $_registro['id_categoria']       = $_row['id_categoria'];
			 $_registro['tituloCategoria']    = $_row['titulo_categoria'];
			 $_registro['url_amigableCat']    = $this ->_herramientas -> getUrlAmigable($_row['titulo_categoria']);
			 $_registro['ruta']               = $_row['ruta'];
			 $_registro['titulo']             = html_entity_decode($_row['titulo']);
			 $_registro['subtitulo']          = html_entity_decode($_row['subtitulo']);
			 $_registro['descripcion']        = $this -> _herramientas -> cortarTexto(html_entity_decode($_row['descripcion']), 300);
			 $_registro['tags']               = $this -> _herramientas -> formatedTags(html_entity_decode($_row['tags']), true);
			 $_registro['tags_amigables']     = $this -> _herramientas -> formatedTags($_row['tags_amigables'], true);
			 $_registro['url_amigable']       = $_row['url_amigable'];
			 $_registro['fecha_creacion']     = $this -> _herramientas -> getFormatedDate($_row['fecha_creacion']);
			 $_registro['fecha_modificacion'] = $_row['fecha_modificacion'];
			 $_registro['fecha']              = $_row['fecha_creacion'];
			 $_registro['status']             = $_row['status'];
			 $_registro['orden']              = $_row['orden'];

			array_push($_resultados, $_registro);
		}
		return $_resultados;
	}

	function getNameCategoria($_id_categoria, $_lang){
		$_lang = strtolower($_lang);
		($_lang=='es') ? $tit = 'tituloEs' : $tit='tituloEn';
        $_MYSQL = new conexion();
        $_SQL = "SELECT {$tit} FROM categoria WHERE idCategoria = {$_id_categoria}";
        $_MYSQL -> ejecutar_sentencia($_SQL);
        $obj = $_MYSQL -> fetchObject();
        return $obj -> {$tit};
    }
	function allTags($_lang = 'es'){
		$_MYSQL = new conexion();
		$_SQL = "SELECT B.tags_amigables FROM blog A, datos_blog B WHERE A.id_blog = B.id_blog AND A.status = 1 AND B.lang = '{$_lang}' ORDER BY RAND() LIMIT 0,30" ;
		$_MYSQL -> ejecutar_sentencia($_SQL);
		$_tags = '';
		while($_row = $_MYSQL -> fetchRow()){
			$_tags .= $_row['tags_amigables'].'-';
		}
		$_tagsComparar = $this -> _herramientas -> separateTags($_tags, '-');
		$_finalTags = array();
		foreach ($_tagsComparar as $_t) {
			if(!in_array($_t, $_finalTags)){
				array_push($_finalTags, $_t);
			}
		}
		return $_finalTags;
	}

/*==================================
 *	MAESTRO DE DETALLE GALERIA
 *==================================*/
	function agregar_contenido_blog($_tipo = ''){
		$_contenido_blog = new contenido_blog(0,$this -> _id_blog, $_tipo);
		$_contenido_blog -> add_contenido_blog();
		return $_contenido_blog -> _id_contenido_blog;
	}

	function agregarTexto($_id_contenido_blog = 0, $_descripcion_es = '', $_descripcion_en = '', $_descripcion_fr = ''){
		$_contenido_blog = new contenido_blog($_id_contenido_blog);
		$_contenido_blog -> addTexto($_descripcion_es, $_descripcion_en, $_descripcion_fr);
	}

	function agregarImagen($_id_contenido_blog = 0, $_ruta = '', $_tmp = '', $_titulo_es = '', $_titulo_en = '', $_titulo_fr = ''){
		$_contenido_blog = new contenido_blog($_id_contenido_blog);
		$_contenido_blog -> addImg($_ruta, $_tmp, $_titulo_es, $_titulo_en, $_titulo_fr);
	}

	function agregarVideo($_id_contenido_blog = 0, $_url = '', $_ruta = '', $_tmp = ''){
		$_contenido_blog = new contenido_blog($_id_contenido_blog);
		$_contenido_blog -> addVideo($_url,$_ruta, $_tmp);
	}

	function insertarGaleriaContenido($_id_contenido_blog, $_name, $_tmp){
		$_contenido_blog = new contenido_blog($_id_contenido_blog);
		$_contenido_blog ->  agregar_galeria($_name, $_tmp);
	}

	function modGaleriaContenido($_idGaleriaContenido, $_name, $_tmp){
		$_contenido_blog = new contenido_blog();
		$_contenido_blog ->  modificar_galeria($_idGaleriaContenido, $_name, $_tmp);
	}

	function listarGaleriaContenido($_id_contenido_blog){
		$_contenido_blog = new contenido_blog($_id_contenido_blog);
		$_contenido_blog -> listar_galeria();
		return $_contenido_blog -> _galeria;
	}

	function delGaleriaContenido($_idGaleriaContenido){
		$_contenido_blog = new contenido_blog();
		$_contenido_blog -> eliminar_galeria($_idGaleriaContenido);
	}

	function eliminar_contenido_blog($id_contenido_blog){
		$_contenido_blog = new contenido_blog($id_contenido_blog);
		$_contenido_blog -> delete_contenido_blog();
	}

	function modificar_orden_contenido_blog($id_contenido_blog, $_orden){
		$_contenido_blog = new contenido_blog($id_contenido_blog);
		$_contenido_blog -> update_orden_contenido_blog($_orden);
	}

	function listar_contenido_blog(){
		$_contenido_blogTemp = new contenido_blog(0, $this -> _id_blog);
		$this -> _contenido_blog = $_contenido_blogTemp -> list_contenido_blog();
	}
/*==================================
 * 1:1 BLOG : DATOS BLOG
 *==================================*/
	function agregar_datos_blog($_titulo = '', $_subtitulo = '', $_descripcion = '', $_tags = '', $_lang = ''){
		$_datos_blog = new datos_blog($this -> _id_blog, $_titulo, $_subtitulo, $_descripcion, $_tags, $_lang);
		$_datos_blog -> add_datos_blog();
	}

	function modificar_datos_blog($_titulo = '', $_subtitulo = '', $_descripcion = '', $_tags = '', $_lang = ''){
		$_datos_blog = new datos_blog($this -> _id_blog, $_titulo, $_subtitulo, $_descripcion, $_tags, $_lang);
		$_datos_blog -> update_datos_blog();
	}

	function eliminar_datos_blog(){
		$_datos_blog = new datos_blog($this -> _id_blog);
		$_datos_blog -> delete_datos_blog();
	}

	function obtener_datos_blog($_lang){
		$this -> _datos_blog = new datos_blog($this -> _id_blog);
		$this -> _datos_blog -> _lang = $_lang;
		$this -> _datos_blog -> get_datos_blog();
	}


}
