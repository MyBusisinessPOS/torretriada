<?php
require_once 'conexion.php';
require_once 'archivo.php';
require_once 'herramientas.php';

class galeria extends Archivo {
    var $_id_galeria;
    var $_id_contenido_blog;
    var $_id_atraccion;
    var $_img;
    var $_img_movil;
    var $_url_video;
    var $_tipo;
    var $_status;
    var $_orden;
    var $_herramientas;

    var $_directorio = '../../img/galeria/';


    function __construct($_id_galeria = 0, $_id_contenido_blog = 0, $_id_atraccion = 0, $_url_video = '', $_tipo = 0){
        $this -> _id_galeria = $_id_galeria;
        $this -> _id_contenido_blog = $_id_contenido_blog;
        $this -> _id_atraccion = $_id_atraccion;
        $this -> _url_video = $_url_video;
        $this -> _tipo = $_tipo;
        $this -> _herramientas = new herramientas();
    }

    function insert_galeria(){
        $_MYSQL = new conexion();
        $_SQL = "INSERT INTO galeria (id_contenido_blog, id_atraccion, url_video, tipo, status) VALUES ({$this -> _id_contenido_blog}, {$this -> _id_atraccion}, '{$this -> _url_video}', {$this -> _tipo}, 1)";
        $this -> _id_galeria = $_MYSQL -> ejecutar_sentencia($_SQL);
        if($this -> _id_galeria > 0){
            $_O = "UPDATE galeria SET orden = {$this -> _id_galeria} WHERE id_galeria = {$this -> _id_galeria}";
            $_MYSQL -> ejecutar_sentencia($_O);
            return true;
        }else{
            return false;
        }
    }

    function update_galeria(){
        $_MYSQL = new conexion();
        $_SQL = "UPDATE galeria SET url_video = '{$this -> _url_video}' WHERE id_galeria = {$this -> _id_galeria}";
        $_MYSQL -> ejecutar_sentencia($_SQL);
    }
    function add_datos_galeriaV($titulo='',$direccion='',$latitud='',$longitud='',$lang=''){
        $tit = htmlentities($titulo,ENT_QUOTES);
        $dir = htmlentities($direccion,ENT_QUOTES);
        $_MYSQL = new conexion();
        $_SQL = "INSERT datos_galeriaV SET titulo='{$tit}', direccion='{$dir}',latitud='{$latitud}', longitud='{$longitud}', lang='{$lang}', id_galeria = {$this -> _id_galeria}";
        $_MYSQL -> ejecutar_sentencia($_SQL);
    }
    function update_datos_galeriaV($titulo='',$direccion='',$latitud='',$longitud='',$lang=''){
        $tit = html_entities($titulo,ENT_QUOTES);
        $dir = html_entities($direccion,ENT_QUOTES);
        $_MYSQL = new conexion();
        $_SQL = "UPDATE datos_galeriaV SET titulo='{$tit}', direccion='{$dir}',latitud='{$latitud}', longitud='{$longitud}', lang='{$lang}' WHERE id_galeria = {$this -> _id_galeria} AND lang={$lang}";
        $_MYSQL -> ejecutar_sentencia($_SQL);
    }
    function getDatos($id_galeria=0,$lang='es'){
        $_MYSQL = new conexion();
        $_SQL = "SELECT * FROM datos_galeriaV WHERE id_galeria={$id_galeria} AND lang='{$lang}'";
        $_MYSQL -> ejecutar_sentencia($_SQL);
        $_OBJ = $_MYSQL -> fetchObject();
        $this -> titulo = html_entity_decode($_OBJ->titulo,ENT_QUOTES);
        $this -> direccion = html_entity_decode($_OBJ->direccion,ENT_QUOTES);
        $this -> latitud = $_OBJ -> latitud;
        $this -> longitud = $_OBJ ->longitud;

    }
    function update_orden_galeria($_orden = 0){
        $_MYSQL = new conexion();
        $_SQL = "UPDATE galeria SET orden = {$_orden} WHERE id_galeria = {$this -> _id_galeria}";
        $_MYSQL -> ejecutar_sentencia($_SQL);
    }
    function update_status_galeria($_status = 0){
        $_MYSQL = new conexion();
        $_SQL = "UPDATE galeria SET status = {$_status} WHERE id_galeria = {$this -> _id_galeria}";
        $_MYSQL -> ejecutar_sentencia($_SQL);
    }

    function delete_galeria(){
        $this -> get_img('img');
        $this -> borrar_archivo();
        $this -> get_img('img_movil');
        $this -> borrar_archivo();

        $_MYSQL = new conexion();
        $_SQL = "DELETE FROM galeria WHERE id_galeria = {$this -> _id_galeria}";
        $_MYSQL -> ejecutar_sentencia($_SQL);
    }

    /**
     * @param string $_name = FILES['name'] del archivo
     * @param string $_tmp_name = FILES['tmp_name'] del archivo
     * @param string $_tipo = img || img_movil
     */
    function add_imagen($_name = '', $_tmp_name = '', $_tipo = ''){
        $_MYSQL = new conexion();
        if($_name != ''){
            $this -> get_img($_tipo);
            $this -> borrar_archivo();

            $_file = $this -> obtenerExtensionArchivo($_name);
            $this -> ruta_temporal = $_tmp_name;
            $this -> ruta_final = $this -> _directorio;
            if($this -> subir_archivo_imagen($_file)){
                $_SQL = "UPDATE galeria SET {$_tipo} = '{$_file}' WHERE id_galeria = {$this -> _id_galeria}";
                $_MYSQL -> ejecutar_sentencia($_SQL);
            }
        }
    }

    /**
     * @param string $_tipo = img || img_movil
     */
    function get_img($_tipo = ''){
        $_MYSQL = new conexion();
        $_SQL = "SELECT {$_tipo} FROM galeria WHERE id_galeria = {$this -> _id_galeria}";
        $_MYSQL -> ejecutar_sentencia($_SQL);
        $_OBJ = $_MYSQL -> fetchObject();
        $this -> ruta_final = ($_tipo == 'img') ? $this -> _directorio.$_OBJ -> img : $this -> _directorio.$_OBJ -> img_movil;
    }

    function get_galeria(){
        $_MYSQL = new conexion();
        $_SQL = "SELECT * FROM galeria WHERE id_galeria = {$this -> _id_galeria}";
        $_MYSQL -> ejecutar_sentencia($_SQL);
        $_OBJ = $_MYSQL -> fetchObject();
        $this -> _id_galeria = $_OBJ -> id_galeria;
        $this -> _id_model = $_OBJ -> id_model;
        $this -> _img = $_OBJ -> img;
        $this -> _img_movil = $_OBJ -> img_movil;
        $this -> _url_video = $_OBJ -> url_video;
        $this -> _tipo = $_OBJ -> tipo;
    }

    function list_galeria($_tipo = 0, $_id_contenido_blog = null, $_id_atraccion = null, $_status = null, $_busqueda = '', $_paginador = false, $_pagina = 1, $_rpp = 50, $_lang = null){
        $_id = (isset($_id_contenido_blog)) ? " AND A.id_contenido_blog = {$_id_contenido_blog}" : "";
        $_id_a= (isset($_id_atraccion)) ? " AND A.id_atraccion = {$_id_atraccion}" : "";
        $_st = (isset($_status)) ? " AND A.status = {$_status}" : "";
        $_fl = ($_busqueda != '') ? " AND B.titulo LIKE '%{$_busqueda}%'" : "";
        $_lg = (isset($_lang)) ? " AND B.lang = '{$_lang}' " : " AND B.lang = 'es'";
        $_MYSQL = new conexion();
        if($_tipo==1){
            $_SQL = "SELECT A.id_galeria, A.id_contenido_blog, A.id_atraccion, A.img, A.img_movil, A.url_video, A.tipo, A.status, A.orden, B.titulo, B.frase, B.link, B.lang
                 FROM galeria A, datos_galeria B
                 WHERE A.id_galeria = B.id_galeria AND A.tipo = {$_tipo} {$_lg} {$_id} {$_id_a} {$_st} {$_fl} ORDER BY A.orden DESC";
        }else if($_tipo==2){
            $_SQL = "SELECT A.id_galeria, A.id_contenido_blog, A.id_atraccion, A.img, A.img_movil, A.url_video, A.tipo, A.status, A.orden, B.titulo,B.direccion,B.latitud,B.longitud
                 FROM galeria A, datos_galeriaV B
                 WHERE  A.tipo = {$_tipo} AND A.id_galeria = B.id_galeria  {$_id} {$_lg} {$_id_a} {$_st} {$_fl} ORDER BY A.orden DESC";
        }else{
            $_SQL = "SELECT A.id_galeria, A.id_contenido_blog, A.id_atraccion, A.img, A.img_movil, A.url_video, A.tipo, A.status, A.orden
                 FROM galeria A
                 WHERE  A.tipo = {$_tipo}  {$_id} {$_id_a} {$_st} {$_fl} ORDER BY A.orden DESC";
        }

        $_MYSQL -> ejecutar_sentencia($_SQL);
        if($_paginador){
            $_totalRegistros 	 = $_MYSQL -> numRows();
            $_registrosPorPagina = $_rpp;
            $_ultimaPagina 		 = ceil($_totalRegistros / $_registrosPorPagina);
            $_paginacion 		 = ' LIMIT '.($_pagina - 1) * $_registrosPorPagina.','.$_registrosPorPagina;
            $_SQL .= $_paginacion;
            $_MYSQL -> ejecutar_sentencia($_SQL);
        }
        $_RES = Array();
        while($_row = $_MYSQL -> fetchRow()){
            $_reg['id_galeria'] = $_row['id_galeria'];
            $_reg['id_contenido_blog'] = $_row['id_contenido_blog'];
            $_reg['id_atraccion'] = $_row['id_atraccion'];
            $_reg['img'] = $_row['img'];
            $_reg['img_movil'] = $_row['img_movil'];
            $_reg['url_video'] = $_row['url_video'];
            if($_row['url_video'] != '') {
                $_typeVideo = $this->_herramientas->videoType($_row['url_video']);
                if ($_typeVideo == 'youtube') {
                    $url = urldecode(rawurldecode($_row['url_video']));
                    preg_match("/^(?:http(?:s)?:\/\/)?(?:www\.)?(?:m\.)?(?:youtu\.be\/|youtube\.com\/(?:(?:watch)?\?(?:.*&)?v(?:i)?=|(?:embed|v|vi|user)\/))([^\?&\"'>]+)/", $url, $matches);
                    $_reg['idVideo'] = $matches[1];
                    $_reg['video'] = '<a href="http://www.youtube.com/embed/'.$matches[1].'?hd=1&wmode=opaque&controls=1&showinfo=0" data-type="video"></a>';
                } else if ($_typeVideo == 'vimeo') {
                    $_idVideo = (int)substr(parse_url($_row['url_video'], PHP_URL_PATH), 1);
                    $_reg['idVideo'] = $_idVideo;
                    $_reg['video'] = '<a href="https://player.vimeo.com/video/'.$_idVideo.'?autoplay=1&color=D49000&title=0&byline=0&portrait=0" data-type="video"></a>';
                }
            }
            $_reg['tipo'] = $_row['tipo'];
            $_reg['status'] = $_row['status'];
            $_reg['orden'] = $_row['orden'];
            $_reg['titulo'] = html_entity_decode($_row['titulo']);
            $_reg['frase'] = html_entity_decode($_row['frase']);
            $_reg['link'] = $_row['link'];
            if($_tipo == 1){
                $_reg['datos_galeria'] = $this -> list_datos_galeria($_row['id_galeria']);
            }
            if($_tipo==2){
                $_reg['titulo'] = html_entity_decode($_row['titulo'],ENT_QUOTES);
                $_reg['direccion']=html_entity_decode($_row['direccion'],ENT_QUOTES);
                $_reg['latitud'] = $_row['latitud'];
                $_reg['longitud'] = $_row['longitud'];
            }
            if($_paginador){
                $_reg['ultimapagina'] 		= $_ultimaPagina;
                $_reg['paginaanterior'] 	= $_pagina - 1;
                $_reg['paginasiguiente']	= $_pagina + 1;
                $_reg['pagina'] 			= $_pagina;
            }
            array_push($_RES, $_reg);
        }
        return $_RES;
    }

    function list_datos_galeria($_id_galeria){
        $_MYSQL = new conexion();
        $_SQL = "SELECT titulo, frase, link, lang FROM datos_galeria WHERE id_galeria = {$_id_galeria}";
        $_MYSQL -> ejecutar_sentencia($_SQL);
        $_RES = Array();
        while($_row = $_MYSQL -> fetchRow()){
            if(isset($_RES[$_row['lang']])) {
                $_reg[$_row['lang']]['titulo'] = html_entity_decode($_row['titulo']);
                $_reg[$_row['lang']]['frase'] = html_entity_decode($_row['frase']);
                $_reg[$_row['lang']]['link'] = $_row['link'];
                array_push($_RES, $_reg);
            }else{
                $_RES[$_row['lang']] = Array('titulo' => html_entity_decode($_row['titulo']), 'frase' => html_entity_decode($_row['frase']), 'link' => $_row['link']);
            }
        }
        return $_RES;
    }
    function listaMapa($idioma = 'es')
    {
        $sql        = "SELECT B.* FROM datos_galeriaV B WHERE 1 = 1 AND B.lang LIKE '{$idioma}' ORDER BY id_galeria DESC";
        $conexion   = new conexion();
        $conexion -> ejecutar_sentencia($sql);
        $resultados = array();

        while ($row = $conexion -> fetchRow()) {
            array_push($resultados, array($row['id_galeria'], (float)$row['latitud'], (float)$row['longitud']));
        }

        echo json_encode($resultados);
    }

}
?>
