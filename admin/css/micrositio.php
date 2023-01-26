<?php
/*
 * @author: Carlos David Baas Santiago
 * @description: Clase donde se controlan todos los metodos de altas bajas y cambios de los micrositios.
 */
include_once ('conexion.php');
include_once ('ciudad.php');
include_once ('redes.php');
require_once ('archivo.php');
include_once ('imgmicrositio.php');
include_once ('herramientas.php');

class micrositio extends Archivo {
//	variables especificas de la clase
	var $idmicrositio;
	var $ruta;
	var $titulo;
	var $descripcion;
	var $link1;
	var $link2;
//	variables que guardan arreglos
	var $redes;
	var $imgmicrositio;
	var $ciudad;
	var $sucursal;
//	variables generales
	var $urlamigable;
	var $status;
	var $orden;
	var $directorio = '../imgmicrositios/';
	var $tools;

//	Variables para el paginador
	var $totalRegistros;
	var $registrosPorPagina;

	function micrositio($idmicrositio = 0, $rut = '', $tit = '', $descripcion = '', $link1 = '', $link2 = '', $temporal = '') {
		$this -> idmicrositio = $idmicrositio;
		if ($rut != '') {
			$this -> ruta = $this -> obtenerExtensionArchivo($rut);
		} else {
			$this -> ruta = '';
		}
		$this -> titulo = $tit;
		$this -> descripcion = $descripcion;
		$this -> link1 = $link1;
		$this -> link2 = $link2;
		$this -> status = $status;

		$this -> imgmicrositio = array();
		$this -> redes = array();
		$this -> ciudad = array();
		$this -> sucursal = array();

		$this -> ruta_final = $this -> directorio . $this -> ruta;
		$this -> ruta_temporal = $temporal;

		$this -> totalRegistros = 0;
		$this -> registrosPorPagina = 15;
		$this->tools = new herramientas();

	}
	function insertamicrositio() {
		$from = explode (',', "Á,Â,Ã,Ä,Å,Æ,Ç,È,É,Ê,Ë,Ì,Í,Î,Ï,Ð,Ñ,Ò,Ó,Ô,Õ,Ö,Ø,Ù,Ú,Û,Ü,Ý,ß,� ,á,â,ã,ä,å,æ,ç,è,é,ê,ë,ì,í,î,ï,ñ,ò,ó,ô,õ,ö,ø,ù,ú,û,ü,ý,ÿ,Ā,ā,Ă,ă,Ą,ą,Ć,ć,Ĉ,ĉ,Ċ,ċ,Č,č,Ď,ď,Đ,đ,Ē,ē,Ĕ,ĕ,Ė,ė,Ę,ę,Ě,ě,Ĝ,ĝ,Ğ,ğ,� ,ġ,Ģ,ģ,Ĥ,ĥ,Ħ,ħ,Ĩ,ĩ,Ī,ī,Ĭ,ĭ,Į,į,İ,ı,Ĳ,ĳ,Ĵ,ĵ,Ķ,ķ,Ĺ,ĺ,Ļ,ļ,Ľ,ľ,Ŀ,ŀ,Ł,ł,Ń,ń,Ņ,ņ,Ň,ň,ŉ,Ō,ō,Ŏ,ŏ,Ő,ő,Œ,œ,Ŕ,ŕ,Ŗ,ŗ,Ř,ř,Ś,ś,Ŝ,ŝ,Ş,ş,� ,š,Ţ,ţ,Ť,ť,Ŧ,ŧ,Ũ,ũ,Ū,ū,Ŭ,ŭ,Ů,ů,Ű,ű,Ų,ų,Ŵ,ŵ,Ŷ,ŷ,Ÿ,Ź,ź,Ż,ż,Ž,ž,ſ,ƒ,� ,ơ,Ư,ư,Ǎ,ǎ,Ǐ,ǐ,Ǒ,ǒ,Ǔ,ǔ,Ǖ,ǖ,Ǘ,ǘ,Ǚ,ǚ,Ǜ,ǜ,Ǻ,ǻ,Ǽ,ǽ,Ǿ,ǿ,(,),[,],'");
		$to = explode (',', 'A,A,A,A,A,AE,C,E,E,E,E,I,I,I,I,D,N,O,O,O,O,O,O,U,U,U,U,Y,s,a,a,a,a,a,a,ae,c,e,e,e,e,i,i,i,i,n,o,o,o,o,o,o,u,u,u,u,y,y,A,a,A,a,A,a,C,c,C,c,C,c,C,c,D,d,D,d,E,e,E,e,E,e,E,e,E,e,G,g,G,g,G,g,G,g,H,h,H,h,I,i,I,i,I,i,I,i,I,i,IJ,ij,J,j,K,k,L,l,L,l,L,l,L,l,l,l,N,n,N,n,N,n,n,O,o,O,o,O,o,OE,oe,R,r,R,r,R,r,S,s,S,s,S,s,S,s,T,t,T,t,T,t,U,u,U,u,U,u,U,u,U,u,U,u,W,w,Y,y,Y,Z,z,Z,z,Z,z,s,f,O,o,U,u,A,a,I,i,O,o,U,u,U,u,U,u,U,u,U,u,A,a,AE,ae,O,o,,,,,,');
		$s = preg_replace ('~[^\w\d]+~', '-', str_replace ($from, $to, trim ($this -> titulo)));
		$url = strtolower (preg_replace ('/^-/', '', preg_replace ('/-$/', '',$s)));
		$sql = "insert into micrositio (ruta, titulo, descripcion, link1, link2, urlamigable, status)
		values ('".$this -> ruta."',
		'".htmlspecialchars($this -> titulo, ENT_QUOTES)."',
		'".htmlspecialchars($this -> descripcion, ENT_QUOTES)."',
		'".htmlspecialchars($this -> link1, ENT_QUOTES)."',
		'".htmlspecialchars($this -> link2, ENT_QUOTES)."',
		'".$url."',
		1);";
		$con = new conexion();
		$this -> idmicrositio = $con -> ejecutar_sentencia($sql);
		$this -> subir_archivo();
		$s = "update micrositio set orden = ".$this -> idmicrositio." where idmicrositio = ".$this -> idmicrositio."";
		$con -> ejecutar_sentencia($s);
	}
	function modificamicrositio() {
		if ($this -> ruta != '') {
			$titulo_temporal = $this -> titulo;
			$ruta_temporal = $this -> ruta;
			$this -> recuperamicrositio();
			$this -> borrar_archivo();
			$this -> titulo = $titulo_temporal;
			$this -> ruta = $ruta_temporal;
			$this -> ruta_final = $this -> directorio . $ruta_temporal;
			$sql = ' ruta=\'' . $this -> ruta . '\',';
		} else {
			$sql = '';
		}
		$from = explode (',', "Á,Â,Ã,Ä,Å,Æ,Ç,È,É,Ê,Ë,Ì,Í,Î,Ï,Ð,Ñ,Ò,Ó,Ô,Õ,Ö,Ø,Ù,Ú,Û,Ü,Ý,ß,� ,á,â,ã,ä,å,æ,ç,è,é,ê,ë,ì,í,î,ï,ñ,ò,ó,ô,õ,ö,ø,ù,ú,û,ü,ý,ÿ,Ā,ā,Ă,ă,Ą,ą,Ć,ć,Ĉ,ĉ,Ċ,ċ,Č,č,Ď,ď,Đ,đ,Ē,ē,Ĕ,ĕ,Ė,ė,Ę,ę,Ě,ě,Ĝ,ĝ,Ğ,ğ,� ,ġ,Ģ,ģ,Ĥ,ĥ,Ħ,ħ,Ĩ,ĩ,Ī,ī,Ĭ,ĭ,Į,į,İ,ı,Ĳ,ĳ,Ĵ,ĵ,Ķ,ķ,Ĺ,ĺ,Ļ,ļ,Ľ,ľ,Ŀ,ŀ,Ł,ł,Ń,ń,Ņ,ņ,Ň,ň,ŉ,Ō,ō,Ŏ,ŏ,Ő,ő,Œ,œ,Ŕ,ŕ,Ŗ,ŗ,Ř,ř,Ś,ś,Ŝ,ŝ,Ş,ş,� ,š,Ţ,ţ,Ť,ť,Ŧ,ŧ,Ũ,ũ,Ū,ū,Ŭ,ŭ,Ů,ů,Ű,ű,Ų,ų,Ŵ,ŵ,Ŷ,ŷ,Ÿ,Ź,ź,Ż,ż,Ž,ž,ſ,ƒ,� ,ơ,Ư,ư,Ǎ,ǎ,Ǐ,ǐ,Ǒ,ǒ,Ǔ,ǔ,Ǖ,ǖ,Ǘ,ǘ,Ǚ,ǚ,Ǜ,ǜ,Ǻ,ǻ,Ǽ,ǽ,Ǿ,ǿ,(,),[,],'");
		$to = explode (',', 'A,A,A,A,A,AE,C,E,E,E,E,I,I,I,I,D,N,O,O,O,O,O,O,U,U,U,U,Y,s,a,a,a,a,a,a,ae,c,e,e,e,e,i,i,i,i,n,o,o,o,o,o,o,u,u,u,u,y,y,A,a,A,a,A,a,C,c,C,c,C,c,C,c,D,d,D,d,E,e,E,e,E,e,E,e,E,e,G,g,G,g,G,g,G,g,H,h,H,h,I,i,I,i,I,i,I,i,I,i,IJ,ij,J,j,K,k,L,l,L,l,L,l,L,l,l,l,N,n,N,n,N,n,n,O,o,O,o,O,o,OE,oe,R,r,R,r,R,r,S,s,S,s,S,s,S,s,T,t,T,t,T,t,U,u,U,u,U,u,U,u,U,u,U,u,W,w,Y,y,Y,Z,z,Z,z,Z,z,s,f,O,o,U,u,A,a,I,i,O,o,U,u,U,u,U,u,U,u,U,u,A,a,AE,ae,O,o,,,,,,');
		$s = preg_replace ('~[^\w\d]+~', '-', str_replace ($from, $to, trim ($this -> titulo)));
		$url = strtolower (preg_replace ('/^-/', '', preg_replace ('/-$/', '',$s)));

		$sql = "update micrositio set
		".$sql."
		titulo ='".htmlspecialchars($this -> titulo, ENT_QUOTES)."',
		descripcion = '".htmlspecialchars($this -> descripcion, ENT_QUOTES)."',
		link1 = '".$this -> link1."',
		link2 = '".$this -> link2."',
		urlamigable='".$url."',
		status ='".$this -> status."'
		where idmicrositio =".$this -> idmicrositio.";";
		$con = new conexion();
		$con -> ejecutar_sentencia($sql);
		$this -> subir_archivo();
	}

	function eliminamicrositio() {
		$this -> recuperamicrositio();
		$this -> borrar_archivo();
		$sql = "delete from micrositio where idmicrositio =" . $this -> idmicrositio . ";";
		$con = new conexion();
		$con -> ejecutar_sentencia($sql);
	}

	function ordenaNoticia($orden)
	{
		$con = new conexion();
		$sql= "update micrositio set orden ='".$orden."' where  idmicrositio=".$this -> idmicrositio." order by orden ASC;";
		$con -> ejecutar_sentencia($sql);
	}

	function Desactivamicrositio() {
		$con = new conexion();
		$sql = "update micrositio set status = 0 where idmicrositio =" . $this -> idmicrositio;
		$con -> ejecutar_sentencia($sql);
	}
	function activamicrositio() {
		$con = new conexion();
		$sql = "update micrositio set status = 1 where idmicrositio =" . $this -> idmicrositio;
		$con -> ejecutar_sentencia($sql);
	}

	function listarmicrositiodActivas() {
		$resultados = array();
		$sql = "select * from micrositio where status = 1 order by orden desc";
		$con = new conexion();
		$temporal = $con -> ejecutar_sentencia($sql);
		while ($fila = mysqli_fetch_array($temporal)) {
			$registro = array();
			$registro['idmicrositio'] = $fila['idmicrositio'];
			$registro['ruta'] = $fila['ruta'];
			$registro['titulo'] = htmlspecialchars_decode($fila['titulo']);
			$registro['status'] = $fila['status'];
			array_push($resultados, $registro);
		}
		mysqli_free_result($temporal);
		return $resultados;
	}
	function listarmicrositioDesactivadas() {
		$resultados = array();
		$sql = "select * from micrositio where status = 0";
		$con = new conexion();
		$temporal = $con -> ejecutar_sentencia($sql);
		while ($fila = mysqli_fetch_array($temporal)) {
			$registro = array();
			$registro['idmicrositio'] = $fila['idmicrositio'];
			$registro['ruta'] = $fila['ruta'];
			$registro['titulo'] = htmlspecialchars_decode($fila['titulo']);
			$registro['status'] = $fila['status'];
			array_push($resultados, $registro);
		}
		mysqli_free_result($temporal);
		return $resultados;
	}
	function obtenermicrositio() {
		$sql = "select * from micrositio where idmicrositio =".$this -> idmicrositio.";";
		$con = new conexion();
		$resultados = $con -> ejecutar_sentencia($sql);
		while ($fila = mysqli_fetch_array($resultados)) {
			$this -> idmicrositio = $fila['idmicrositio'];
			$this -> ruta = $fila['ruta'];
			$this -> titulo = $fila['titulo'];
			$this -> descripcion = $fila['descripcion'];
			$this -> urlamigable = $fila['urlamigable'];
			$this -> status = $fila['status'];
			$this -> link1 = $fila['link1'];
			$this -> link2 = $fila['link2'];
			$this -> ruta_final = $this -> directorio . $fila['ruta'];
		}
	}
	function obtenermicrositio2($id) {
		$sql = "select * from micrositio where idmicrositio =".$id.";";
		$con = new conexion();
		$resultados = $con -> ejecutar_sentencia($sql);
		while ($fila = mysqli_fetch_array($resultados)) {
			$this -> idmicrositio = $fila['idmicrositio'];
			$this -> ruta = $fila['ruta'];
			$this -> titulo = $fila['titulo'];
			$this -> urlamigable = $fila['urlamigable'];
			$this -> status = $fila['status'];
			$this -> fecha = $fila['fecha'];
			$this -> orden = $fila['orden'];
			$this -> ruta_final = $this -> directorio . $fila['ruta'];
		}
	}
	function recuperamicrositio() {
		$sql = "select idmicrositio, ruta,titulo from micrositio where idmicrositio =" . $this -> idmicrositio . ";";
		$con = new conexion();
		$resultados = $con -> ejecutar_sentencia($sql);
		while ($fila = mysqli_fetch_array($resultados)) {
			$this -> idmicrositio = $fila['idmicrositio'];
			$this -> ruta = $fila['ruta'];
			$this -> titulo = $fila['titulo'];
			$this -> ruta_final = $this -> directorio . $fila['ruta'];
		}
	}
	function listarmicrositio() {
		$resultados = array();
		$sql = "select * from micrositio order by orden desc";
		$con = new conexion();
		$temporal = $con -> ejecutar_sentencia($sql);

		$this -> totalRegistros = mysqli_num_rows($temporal);
		$ultimaPagina = ceil($this -> totalRegistros / $this -> registrosPorPagina);
		$pagina = 1;

		$sql .= ' LIMIT '.($pagina - 1) * $this->registrosPorPagina.','.$this->registrosPorPagina;
		$temporal2 = $con -> ejecutar_sentencia($sql);

		while ($fila = mysqli_fetch_array($temporal2)) {
			$registro = array();
			$registro['idmicrositio'] = $fila['idmicrositio'];
			$registro['ruta'] = $fila['ruta'];
			$registro['titulo'] = htmlspecialchars_decode($fila['titulo']);
			$registro['status'] = $fila['status'];

			$registro['ultimapagina']=$ultimaPagina;
			$registro['paginaanterior']=$pagina-1;
			$registro['paginasiguiente']=$pagina+1;
			$registro['pagina']=$pagina;

			array_push($resultados, $registro);
		}
		mysqli_free_result($temporal);
		return $resultados;
	}

	function listarmicrositiosRecientes() {
		$resultados = array();
		$sql = "select * from micrositio where status = 1 order by orden DESC";
		$con = new conexion();
		$temporal = $con -> ejecutar_sentencia($sql);
		while ($fila = mysqli_fetch_array($temporal)) {
			$registro = array();
			$registro['idmicrositio'] = $fila['idmicrositio'];
			$registro['ruta'] = $fila['ruta'];
			$registro['titulo'] = htmlspecialchars_decode($fila['titulo']);
			$registro['status'] = $fila['status'];
			array_push($resultados, $registro);
		}
		mysqli_free_result($temporal);
		return $resultados;
	}

	function listarmicrositioBusquedaIndex($pedazo) {
		$resultados = array();
		$sql = "select * from micrositio where (titulo like '%" . $pedazo . "%')  group by idmicrositio";
		$con = new conexion();
		$temporal = $con -> ejecutar_sentencia($sql);
		while ($fila = mysqli_fetch_array($temporal)) {
			$registro = array();
			$registro['idmicrositio'] = $fila['idmicrositio'];
			$registro['ruta'] = $fila['ruta'];
			$registro['titulo'] = htmlspecialchars_decode($fila['titulo']);
			$registro['status'] = $fila['status'];
			array_push($resultados, $registro);
		}
		mysqli_free_result($temporal);
		return $resultados;
	}

	/*********************************************************
	 * PAGINACION
	 **********************************************************/
	function listarNoticiaAjax($pagina){
		$resultados=array();
		$con = new conexion();
		//$sql = "select * from micrositio where status = 1 order by idmicrositio DESC";
		$sql = "select * from micrositio where status = 1 order by orden DESC";
		$temporal = $con -> ejecutar_sentencia($sql);

		$pagina_actual = $pagina;

		$this -> totalRegistros = mysqli_num_rows($temporal);
		$ultimaPagina = ceil($this -> totalRegistros / $this -> registrosPorPagina);

		$sql .= ' LIMIT '.($pagina - 1) * $this->registrosPorPagina.','.$this->registrosPorPagina;

		$temporal2 = $con -> ejecutar_sentencia($sql);

		while ($fila = mysqli_fetch_array($temporal2)) {
			$registro = array();
			$registro['idmicrositio'] = $fila['idmicrositio'];
			$registro['ruta'] = $fila['ruta'];
			$registro['titulo'] = htmlspecialchars_decode($fila['titulo']);
			$registro['status'] = $fila['status'];

			$registro['ultimapagina']=$ultimaPagina;
			$registro['paginaanterior']=$pagina-1;
			$registro['paginasiguiente']=$pagina+1;
			$registro['pagina']=$pagina;

			array_push($resultados, $registro);
		}

		echo json_encode($resultados);
	}

	function next() {
		$resultados = array();
		$sql = "select * from micrositio where idmicrositio != ".$this->idmicrositio." and status = 1 and idmicrositio >= ".$this->idmicrositio." order by orden asc limit 1";
		$con = new conexion();
		$temporal = $con -> ejecutar_sentencia($sql);
		while ($fila = mysqli_fetch_array($temporal)) {
			$registro = array();
			$registro['idmicrositio'] = $fila['idmicrositio'];
			$registro['titulo'] = $fila['titulo'];
			$registro['urlamigable'] = $fila['urlamigable'];
			array_push($resultados, $registro);
		}
		mysqli_free_result($temporal);

		return $resultados;
	}

	function prev() {
		$resultados = array();
		$sql = "select * from micrositio where idmicrositio != ".$this->idmicrositio." and status = 1 and idmicrositio <= ".$this->idmicrositio." order by orden desc limit 1";
		$con = new conexion();
		$temporal = $con -> ejecutar_sentencia($sql);
		while ($fila = mysqli_fetch_array($temporal)) {
			$registro = array();
			$registro['idmicrositio'] = $fila['idmicrositio'];
			$registro['titulo'] = $fila['titulo'];
			$registro['urlamigable'] = $fila['urlamigable'];
			array_push($resultados, $registro);
		}
		mysqli_free_result($temporal);

		return $resultados;
	}

/*
 * @author:Rodrigo Salas
 * @description: Funciones para el FRONT-END de agronegocios
 */
 	function getLastNews() {
		$sql = "select * from micrositio where status = 1 order by orden DESC limit 1;";
		$con = new conexion();
		$resultados = $con -> ejecutar_sentencia($sql);
		while ($fila = mysqli_fetch_array($resultados)) {
			$this -> idmicrositio = $fila['idmicrositio'];
			$this -> ruta = $fila['ruta'];
			$this -> titulo = $fila['titulo'];
			$this -> urlamigable = $fila['urlamigable'];
			$this -> status = $fila['status'];
			$this -> fecha = $fila['fecha'];
		}
	}

	function listNewsRecientes() {
		$resultados = array();
		$sql = "select * from micrositio where idmicrositio != ".$this->idmicrositio." and status = 1 order by orden DESC limit 4";
		$con = new conexion();
		$temporal = $con -> ejecutar_sentencia($sql);
		while ($fila = mysqli_fetch_array($temporal)) {
			$registro = array();
			$registro['idmicrositio'] = $fila['idmicrositio'];
			$registro['titulo'] = $fila['titulo'];
			$registro['fecha'] = $fila['fecha'];
			$registro['ruta'] = $fila['ruta'];
			$registro['urlamigable'] = $fila['urlamigable'];
			array_push($resultados, $registro);
		}
		mysqli_free_result($temporal);
		return $resultados;
	}

	function listNewsRandom() {
		$resultados = array();
		$sql = "select * from micrositio where idmicrositio != ".$this->idmicrositio." order by RAND() limit 4";
		$con = new conexion();
		$temporal = $con -> ejecutar_sentencia($sql);
		while ($fila = mysqli_fetch_array($temporal)) {
			$registro = array();
			$registro['idmicrositio'] = $fila['idmicrositio'];
			$registro['ruta'] = $fila['ruta'];
			$registro['urlamigable'] = $fila['urlamigable'];
			$registro['titulo'] = $fila['titulo'];
			$registro['fechaCreacion'] = $fila['fecha'];
			array_push($resultados, $registro);
		}
		mysqli_free_result($temporal);
		return $resultados;
	}

	function getNewsAjax() {
		$resultados=array();
		$sql = "select * from micrositio where idmicrositio =".$this -> idmicrositio." order by orden DESC;";
		$con = new conexion();
		$temporal = $con -> ejecutar_sentencia($sql);
		while ($fila = mysqli_fetch_array($temporal)) {
			$registro = array();
			$registro['idmicrositio'] = $fila['idmicrositio'];
			$registro['ruta'] = $fila['ruta'];
			$registro['titulo'] = htmlspecialchars_decode($fila['titulo']);
			$registro['urlamigable'] = $fila['urlamigable'];
			$registro['fecha'] = $fila['fecha'];
			$registro['status'] = $fila['status'];
			array_push($resultados, $registro);
		}
		mysqli_free_result($temporal);

		echo json_encode($resultados);

	}

/*
 * terminan funciones realizadas por Rodrigo Salas
 */


	function Buscarmicrositio($pedazo,$pagina) {
		$resultados = array();
		$sql = "select * from micrositio where (titulo like '%" . $pedazo . "%')  group by idmicrositio order by orden desc";
		$con = new conexion();
		$temporal = $con -> ejecutar_sentencia($sql);

		$pagina_actual  = $pagina;
		$this -> totalRegistros = mysqli_num_rows($temporal);
		$ultimaPagina = ceil($this -> totalRegistros / $this -> registrosPorPagina);

		$sql .= ' LIMIT '.($pagina - 1) * $this->registrosPorPagina.','.$this->registrosPorPagina;
		$temporal2 = $con -> ejecutar_sentencia($sql);


		while ($fila = mysqli_fetch_array($temporal2)) {
			$registro = array();
			$registro['idmicrositio'] = $fila['idmicrositio'];
			$registro['ruta'] = $fila['ruta'];
			$registro['titulo'] = htmlspecialchars_decode($fila['titulo']);
			$registro['status'] = $fila['status'];

			$registro['ultimapagina']=$ultimaPagina;
			$registro['paginaanterior']=$pagina-1;
			$registro['paginasiguiente']=$pagina+1;
			$registro['pagina']=$pagina;
			array_push($resultados, $registro);
		}
		echo json_encode($resultados);
	}

	function limitmicrositio($pagina) {
			$resultados = array();
			$sql = "select * from micrositio order by orden desc";
			$con = new conexion();
			$temporal = $con -> ejecutar_sentencia($sql);

			$pagina_actual = $pagina;

			$this -> totalRegistros = mysqli_num_rows($temporal);
			$ultimaPagina = ceil($this -> totalRegistros / $this -> registrosPorPagina);

			$sql .= ' LIMIT '.($pagina - 1) * $this->registrosPorPagina.','.$this->registrosPorPagina;
			$temporal2 = $con -> ejecutar_sentencia($sql);

			while ($fila = mysqli_fetch_array($temporal2)) {
				$registro = array();
				$registro['idmicrositio'] = $fila['idmicrositio'];
				$registro['ruta'] = $fila['ruta'];
				$registro['titulo'] = htmlspecialchars_decode($fila['titulo']);
				$registro['status'] = $fila['status'];

				$registro['ultimapagina']=$ultimaPagina;
				$registro['paginaanterior']=$pagina-1;
				$registro['paginasiguiente']=$pagina+1;
				$registro['pagina']=$pagina;

				array_push($resultados, $registro);
			}
			echo json_encode($resultados);
	}
	//=============MAESTRO DETALLE DE LAS IMAGENES SECUNDARIAS===============
	function ordenaIgmNoticia($orden,$id){
		$imgmicrositiotemp = new imgmicrositio($id);
		$imgmicrositiotemp -> ordenaImgNoticia($orden);
	}
	function listaImgmicrositio() {
		$imgmicrositiotemp = new imgmicrositio(0, $this -> idmicrositio, '', '', '');
		$this -> imgmicrositio = $imgmicrositiotemp -> listarimgmicrositio();
	}
	function listaImgmicrositio2($id) {
		$imgmicrositiotemp = new imgmicrositio(0, $id, '', '', '');
		$this -> imgmicrositio = $imgmicrositiotemp -> listarimgmicrositio();
	}
	//insertar_imagen($_REQUEST['titulo'],$_FILES['archivo']['name'],$_FILES['archivo']['tmp_name']);
	function insertarImgmicrositio($tit, $rut, $temporal) {
		$imgmicrositiotemp = new imgmicrositio(0, $this -> idmicrositio, $rut, $tit, $temporal);
		$imgmicrositiotemp -> insertaimgmicrositio();
	}	//$micrositio_temporal->modificar_imagen($_REQUEST['id_imagen'],$_REQUEST['titulo'],$_FILES['archivo']['name'],$_FILES['archivo']['tmp_name']);

	function modificarImgmicrositio($id, $tit, $rut, $temporal) {
		$imgmicrositiotemp = new imgmicrositio($id, $this -> idmicrositio, $rut, $tit, $temporal);
		$imgmicrositiotemp -> modificaimgmicrositio();
	}
	function eliminarImgmicrositio($id) {
		$imgmicrositiotemp = new imgmicrositio($id, $this -> idmicrositio, '', '', '');
		$imgmicrositiotemp -> eliminaimgmicrositio();
	}

////////////////////// MAESTRO DETALLE CIUDAD /////////////////////////
	function agregarCiudad($titulo, $lada){
		$ciudadtemp = new ciudad(0, $this -> idmicrositio, $titulo, $lada);
		$ciudadtemp -> insertCiudad();
		return $ciudadtemp -> idciudad;
	}

	function modificarCiudad($idciudad, $titulo, $lada){
		$ciudadtemp = new ciudad($idciudad, 0, $titulo, $lada);
		$ciudadtemp -> updateCiudad();
	}

	function eliminarCiudad($idciudad){
		$ciudadtemp = new ciudad($idciudad);
		$ciudadtemp -> deleteCiudad();
	}

	function eliminarCiudadxMicrositio(){
		$ciudadtemp = new ciudad(0, $this -> idmicrositio);
		$ciudadtemp -> deleteCiudadxMicrositio();
	}

	function listarCiudad(){
		$ciudadtemp = new ciudad(0, $this -> idmicrositio);
		$this -> ciudad = $ciudadtemp -> listCiudad();
	}

	function activarCiudad($idciudad){
		$ciudadtemp = new ciudad($idciudad);
		$ciudadtemp -> activaCiudad();
	}

	function desactivarCiudad($idciudad){
		$ciudadtemp = new ciudad($idciudad);
		$ciudadtemp -> desactivaCiudad();
	}
	function activarPrincipalCiudad($idciudad){
		$ciudadtemp = new ciudad($idciudad);
		$ciudadtemp -> activarPrincipal();
	}
	function ordenarCiudad($idciudad,$orden){
		$ciudadtemp = new ciudad($idciudad);
		$ciudadtemp -> ordenaCiudad($orden);
	}
////////////////////////	MESTRO DETALLES CIUDAD X SUCURSAL 	///////////////////////
	function agregarSucursales($idciudad, $titulo, $telefono){
		$ciudadtemp = new ciudad($idciudad);
		$ciudadtemp -> insertarSucursal($titulo, $telefono);
	}

	function modificarSucursales($idsucursal,$titulo,$telefono){
		$ciudadtemp = new ciudad();
		$ciudadtemp -> modificarSucursal($idsucursal,$titulo,$telefono);
	}

	function eliminarSucursales($idsucursal){
		$ciudadtemp = new ciudad();
		$ciudadtemp -> eliminarSucursal($idsucursal);
	}

	function eliminarSucursalesxCiudad($idciudad){
		$ciudadtemp = new ciudad($idciudad);
		$ciudadtemp -> eliminarSucursalxCiudad();
	}

	function listarSucursales($idciudad){
		$ciudadtemp = new ciudad($idciudad);
		$this -> sucursal = $ciudadtemp -> listarSucursal();
	}

	function activarSucursales($idsucursal){
		$ciudadtemp = new ciudad();
		$ciudadtemp -> activarSucursal($idsucursal);
	}

	function desactivarSucursales($idsucursal){
		$ciudadtemp = new ciudad();
		$ciudadtemp -> desactivarSucursal($idsucursal);
	}

	function ordenarSucursales($idsucursal,$orden){
		$ciudadtemp = new ciudad();
		$ciudadtemp -> ordenarSucursal($idsucursal, $orden);
	}
////////////////////////	MESTRO DETALLE REDES	///////////////////////

	function agregarRed($url){
		$redestemp = new redes(0,$this -> idmicrositio, $url);
		$redestemp -> insertRedes();
	}

	function modificarRed($idred,$url){
		$redestemp = new redes($idred,0,$url);
		$redestemp -> updateRedes();
	}

	function listarRed(){
		$redestemp = new redes(0,$this -> idmicrositio, '');
		$this -> redes = $redestemp -> listRedes();
	}
}
?>
