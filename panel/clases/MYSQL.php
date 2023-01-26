<?php
class MYSQL {
    var $conexion;
    var $fechmode = PDO::FETCH_ASSOC;
    var $error_conexion = "";
	var $sql_query;

    function Connect(){
		try {
			$this->conexion = new PDO('mysql:host=localhost;dbname=u652527287_triada', 'u652527287_webmaster', 'Webmaster2021$');
			/**$this->conexion = new PDO('mysql:host=localhost;dbname=cosico', 'root', 'root');*/
		} catch (PDOException $e) {
			$this->error_conexion = $e->getMessage();
		}
        return $this->conexion;
    }
	function ErrorInfo(){
		return $this->error_conexion;
	}

	function SetFetchMode($tipo){
		//FETCH_ASSOC o 	FETCH_NUM
		$this->fechmode = $tipo;
	}
	function Execute($sql,$array){
		$consulta = $this->conexion->prepare($sql);
		$consulta->setFetchMode($this->fechmode);
		$consulta->execute($array);
		$this->sql_query = $consulta;

		return $this->sql_query;
	}

	function fetchrow(){
		return $this->sql_query->fetch($this->fechmode);
	}
	function numrows(){
		return  $this->sql_query->rowCount();
	}
	function GetArray(){
		return $this->sql_query;
	}
	function fetchobject(){
		return $this -> sql_query -> fetchObject();
	}

}

?>
