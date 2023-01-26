<?php
include_once('conexion.php');
include_once('archivo.php');

class galeriaBlog extends Archivo{
	var $_idGaleriaBlog;
	var $_idBlog;
	var $_alt;
	var $_ruta;
	var $_url;
	var $_orden;
	var $_tipo;

	var $_directorio = '../img/blog/galeria/';

	function __construct($_idGaleriaBlog = 0, $_idBlog = '', $_alt = '', $_url = '', $_tipo = '', $_ruta = '', $tmp = ''){
		$this -> _idGaleriaBlog = $_idGaleriaBlog;
		$this -> _idBlog = $_idBlog;
		$this -> _alt = $_alt;
		$this -> _url = $_url;
		$this -> _tipo = $_tipo;
		($_ruta != '') ? $this -> _ruta = $this -> obtenerExtensionArchivo($_ruta) : $this -> _ruta = '';

		$this -> ruta_final = $this -> _directorio;
		$this -> ruta_temporal = $tmp;
	}

	function addGaleriaBlog(){
		if($this -> subir_archivo_imagen($this -> _ruta)){
			$_MYSQL = new MYSQL();
			$_SQL = "INSERT INTO galeriaBlog(idBlog, alt, url, ruta, tipo) VALUES (?,?,?,?,?)";
			//var_dump(array($this -> _idBlog, $this -> _alt, $this -> _url, $this -> _ruta, $this -> _tipo));
			$_CONECTADO = $_MYSQL -> Connect();
			if(!$_CONECTADO){
				echo 'Ocurrio un error, Por favor intentalo mas tarde.';
				exit();
			}
			if($_MYSQL -> Execute($_SQL, array($this -> _idBlog, $this -> _alt, $this -> _url, $this -> _ruta, $this -> _tipo))){
				$this -> _idGaleriaBlog = $_MYSQL -> conexion -> lastInsertId();
				$_O = "UPDATE galeriaBlog SET orden = ? WHERE idGaleriaBlog = ?";
				$_MYSQL -> Execute($_O, array($this -> _idGaleriaBlog, $this -> _idGaleriaBlog));
			}
		}
	}

	function updateGaleriaBlog(){
		$_MYSQL = new MYSQL();
		if($this -> _ruta != ''){
			$this -> getRutaGaleriaBlog();
			$this -> borrar_archivo();

			$this -> ruta_final = $this -> _directorio;
			if($this -> subir_archivo_imagen($this -> _ruta)){
				$_IMG = "UPDATE galeriaBlog SET ruta = ? WHERE idGaleriaBlog = ?";
				$_CONECTADO = $_MYSQL -> Connect();
				if(!$_CONECTADO){
					echo 'Ocurrio un error, Por favor intentalo mas tarde.';
					exit();
				}
				$_MYSQL -> Execute($_IMG, array($this -> _ruta, $this -> _idGaleriaBlog));
			}
		}
		$_SQL = "UPDATE galeriaBlog SET alt = ?, url = ? WHERE idGaleriaBlog = ?";
		$_CONECTADO = $_MYSQL -> Connect();
		if(!$_CONECTADO){
			echo 'Ocurrio un error, Por favor intentalo mas tarde.';
			exit();
		}
		$_MYSQL -> Execute($_SQL, array($this -> _alt, $this -> _url, $this -> _idGaleriaBlog));
	}

	function deleteGaleriaBlog(){
		$this -> getRutaGaleriaBlog();
		$this -> borrar_archivo();
		$_MYSQL = new MYSQL();
		$_SQL = "DELETE FROM galeriaBlog WHERE idGaleriaBlog = ?";
		$_CONECTADO = $_MYSQL -> Connect();
		if(!$_CONECTADO){
			echo 'Ocurrio un error, Por favor intentalo mas tarde.';
			exit();
		}
		$_MYSQL -> Execute($_SQL, array($this -> _idGaleriaBlog));
	}

	function updateOrdenGaleriaBlog($_orden){
		$_MYSQL = new MYSQL();
		$_SQL = "UPDATE galeriaBlog SET orden = ? WHERE idGaleriaBlog = ?";
		$_CONECTADO = $_MYSQL -> Connect();
		if(!$_CONECTADO){
			echo 'Ocurrio un error, Por favor intentalo mas tarde.';
			exit();
		}
		$_MYSQL -> Execute($_SQL, array($_orden, $this -> _idGaleriaBlog));
	}

	private function getRutaGaleriaBlog(){
		$_MYSQL = new MYSQL();
		$_SQL = "SELECT ruta FROM galeriaBlog WHERE idGaleriaBlog = ?";
		$_CONECTADO = $_MYSQL -> Connect();
		if(!$_CONECTADO){
			echo 'Ocurrio un error, Por favor intentalo mas tarde.';
			exit();
		}
		$_MYSQL -> Execute($_SQL, array($this -> _idGaleriaBlog));
		$obj = $_MYSQL -> fetchobject();
		$this -> ruta_final = $this -> _directorio.$obj -> ruta;
	}

	function getGaleriaBlog(){
		$sql = "SELECT * FROM galeriaBlog WHERE idGaleriaBlog = ".$this -> _idGaleriaBlog;
		$conexion = new conexion();
		$temporal = $conexion -> ejecutar_sentencia($sql);
		$obj = mysqli_fetch_object($temporal);
		$this -> _idGaleriaBlog = $obj -> _idGaleriaBlog;
		$this -> _idBlog = htmlspecialchars_decode($obj -> _idBlog);
		$this -> _alt = htmlspecialchars_decode($obj -> _alt);
		$this -> _url = $obj -> _url;
		$this -> _tipo = $obj -> _tipo;
		$this -> _ruta = $obj -> _ruta;
	}

	function listGaleriaBlog(){
		$_MYSQL = new MYSQL();
		$_SQL = "SELECT * FROM galeriaBlog WHERE idBlog = ? ORDER BY orden DESC";
		$_CONECTADO = $_MYSQL -> Connect();
		if(!$_CONECTADO){
			echo 'Ocurrio un error, Por favor intentalo mas tarde.';
			exit();
		}
		$_MYSQL -> Execute($_SQL, array($this -> _idBlog));
		$_resultados = array();
		while($_row = $_MYSQL -> fetchrow()){
			$_registro['idGaleriaBlog'] = $_row['idGaleriaBlog'];
			$_registro['idBlog'] = $_row['idBlog'];
			$_registro['url'] = $_row['url'];
			$_registro['alt'] = $_row['alt'];
			$_registro['tipo'] = $_row['tipo'];
			$_registro['ruta'] = $_row['ruta'];
			$_registro['orden'] = $_row['orden'];
			array_push($_resultados, $_registro);
		}
		return $_resultados;
	}

}
?>
