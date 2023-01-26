<?php
require_once 'MYSQL.php';

class newsletter{
	var $idNewsletter;
	var $correo;

	var $orden;
	var $status;

	var $totalRegistros;
	var $registrosPorPagina;

	function __construct($idNewsletter = 0, $correo = 0){
		$this -> idNewsletter = $idNewsletter;
		$this -> correo = $correo;

		$this -> totalRegistros = 0;
		$this -> registrosPorPagina = 20;

	}

	function addNewsletter(){
		if($this -> validNewsletter($this -> correo)){
			$_currentDate = date('Y-m-d');
			$_MYSQL = new MYSQL();
			$_SQL = "INSERT INTO newsletter(correo, fechaCreacion, status) VALUES (?,?,?)";
			$_VALUES = array($this -> correo, $_currentDate, 1);
			$_CONECTADO = $_MYSQL -> Connect();
			if(!$_CONECTADO){
				echo 'Ocurrio un error, Por favor intentalo mas tarde.';
				exit();
			}
			$_MYSQL -> Execute($_SQL, $_VALUES);
			$this -> idNewsletter = $_MYSQL -> conexion -> lastInsertId();
			$_O = "UPDATE newsletter SET orden = ? WHERE idNewsletter = ?";
			$_MYSQL -> Execute($_O, array($this -> idNewsletter, $this -> idNewsletter));
			$_success = 1;
		}else{
			$_success = 0;
		}
		return $_success;
	}

	function updateNewsletter(){
		$_MYSQL = new MYSQL();
		$_SQL = "UPDATE newsletter SET correo = ? WHERE idNewsletter = ?";
		$_VALUES = array($this -> correo, $this -> idNewsletter);
		$_CONECTADO = $_MYSQL -> Connect();
		if(!$_CONECTADO){
			echo 'Ocurrio un error, Por favor intentalo mas tarde.';
			exit();
		}
		$_MYSQL -> Execute($_SQL, $_VALUES);
	}

	function deleteNewsletter(){
		$_MYSQL = new MYSQL();
		$_SQL = "DELETE FROM newsletter WHERE idNewsletter = ?";
		$_VALUES = array($this -> idNewsletter);
		$_CONECTADO = $_MYSQL -> Connect();
		if(!$_CONECTADO){
			echo 'Ocurrio un error, Por favor intentalo mas tarde.';
			exit();
		}
		$_MYSQL -> Execute($_SQL, $_VALUES);
	}

	function updateOrdenNewsletter($orden){
		$_MYSQL = new MYSQL();
		$_SQL = "UPDATE newsletter SET orden = ? WHERE idNewsletter = ?";
		$_VALUES = array($orden, $this -> idNewsletter);
		$_CONECTADO = $_MYSQL -> Connect();
		if(!$_CONECTADO){
			echo 'Ocurrio un error, Por favor intentalo mas tarde.';
			exit();
		}
		$_MYSQL -> Execute($_SQL, $_VALUES);
	}

	function updateStatusNewsletter($status){
		$_MYSQL = new MYSQL();
		$_SQL = "UPDATE newsletter SET status = ? WHERE idNewsletter = ?";
		$_VALUES = array($status, $this -> idNewsletter);
		$_CONECTADO = $_MYSQL -> Connect();
		if(!$_CONECTADO){
			echo 'Ocurrio un error, Por favor intentalo mas tarde.';
			exit();
		}
		$_MYSQL -> Execute($_SQL, $_VALUES);
	}

	function getNewsletter(){
		$_MYSQL = new MYSQL();
		$_SQL = "SELECT * FROM newsletter WHERE idNewsletter = ?";
		$_VALUES = array($this -> idNewsletter);
		$_CONECTADO = $_MYSQL -> Connect();
		if(!$_CONECTADO){
			echo 'Ocurrio un error, Por favor intentalo mas tarde.';
			exit();
		}
		$_MYSQL -> Execute($_SQL, $_VALUES);
		$_OBJ = $_MYSQL -> fetchobject();
		$this -> idNewsletter = $_OBJ -> idNewsletter;
		$this -> correo = $_OBJ -> correo;
	}

	function listNewsletter($_pagina = 1, $_paginador = true, $_status = '', $_busqueda = '', $_registrosPorPagina = 20, $_frontEnd = false){
		($_status != '') ? $_stat = " AND status = ".$_status : $_stat = '';
		($_busqueda != '') ? $_bus = " AND (correo LIKE '%".$_busqueda."%')" : $_bus = '';

		$_MYSQL = new MYSQL();

		if($_paginador){
			$_TOTAL = "SELECT idNewsletter, count(idNewsletter) as totalRegistros FROM newsletter WHERE 1 = 1 ".$_stat." ".$_bus." ORDER BY orden DESC";
			$_CONECTADO = $_MYSQL -> Connect();
			if(!$_CONECTADO){
				echo 'Ocurrio un error, Por favor intentalo mas tarde.';
				exit();
			}
			$_MYSQL -> Execute($_TOTAL, array());
			$obj = $_MYSQL -> fetchobject();
			$this -> _totalRegistros = $obj -> totalRegistros;
			$this -> _registrosPorPagina = $_registrosPorPagina;
			$_ultimaPagina = ceil($this -> _totalRegistros / $this -> _registrosPorPagina);
			$_paginaActual = $_pagina;
			$_paginacion = ' LIMIT '.($_pagina - 1) * $this -> _registrosPorPagina.','.$this -> _registrosPorPagina;
		}else{
			$_paginacion = '';
		}

		$_SQL = "SELECT * FROM newsletter WHERE 1 = 1 ".$_stat.$_bus." ORDER BY orden DESC ".$_paginacion;

		$_CONECTADO = $_MYSQL -> Connect();
		if(!$_CONECTADO){
			echo 'Ocurrio un error, Por favor intentalo mas tarde.';
			exit();
		}
		$_MYSQL -> Execute($_SQL, array());
		$_resultados = array();
		while($_row = $_MYSQL -> fetchrow()){
			$_registro['idNewsletter'] = $_row['idNewsletter'];
			$_registro['correo'] = $_row['correo'];
			$_registro['fecha'] = date('d-m-Y', strtotime($_row['fechaCreacion']));
			$_registro['status'] = $_row['status'];
			$_registro['orden'] = $_row['orden'];
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

	function validNewsletter($_correo = ''){
		$_MYSQL = new MYSQL();
		$_SQL = "SELECT idNewsletter FROM newsletter WHERE correo = ? ";
		$_VALUES = array($_correo);
		$_CONECTADO = $_MYSQL -> Connect();
		if(!$_CONECTADO){
			echo 'Ocurrio un error, Por favor intentalo mas tarde.';
			exit();
		}
		$_MYSQL -> Execute($_SQL, $_VALUES);
		$_total = $_MYSQL -> numrows();
		if($_total > 0) return false; else return true;
	}
}
?>
