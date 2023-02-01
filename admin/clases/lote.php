<?php
include_once('conexion.php');
include_once('herramientas.php');
require_once('archivo.php');

class lote extends Archivo
{
	var $idLote;
	var $lote;
	var $metrosCuadrados;
	var $precio;
	var $status;
	var $ruta;
	var $directorio='../img/imgLotes/';
	var $precioxm2;
	var $precioTotal;
	var $enganche;
	var $mensualidad;
	var $meses;

	//Eduardo Gonzalez Casasola
	var $interior;
	var $terrazas;
	var $cajones;


	function lote( $idLote = 0, $lote = '', $metrosCuadrados = '', $precio='', $status = '', $ruta='', $temporal='', $enganche='', $mensualidad='', $meses='', $interior='', $terrazas = '', $cajones ='')
	{
		$this -> idLote = $idLote;
		$this -> lote = $lote;
		$this -> metrosCuadrados = $metrosCuadrados;
		$this -> precio = $precio;
		$this -> status = $status;
		if ($ruta != '') {
			$this -> ruta = $this -> obtenerExtensionArchivo($ruta);
		} else {
			$this -> ruta = '';
		}
		$this->ruta_final=$this->directorio;
		$this->ruta_temporal=$temporal;
		$this->tools = new herramientas();
		$this->enganche = $enganche;
		$this->mensualidad = $mensualidad;
		$this->meses = $meses;

		//Eduardo Gonzalez
		$this->interior = $interior;
		$this->terrazas = $terrazas;
		$this->cajones = $cajones;
	}



	function modificaLote()
	{
		if ($this->ruta!='')
		{
			$titulo_temporal=$this->titulo;
			$ruta_temporal=$this->ruta;

			$this->recuperaimagen();
			$this->borrar_archivo();

			$this->titulo=$titulo_temporal;
			$this->ruta=$ruta_temporal;

			$this->ruta_final=$this->directorio;
			$ruta=$this -> subir_archivo($this->ruta);
			$sql=' ruta=\''.$ruta.'\',';
		}
		else
		{
			$sql='';
		}
		$con = new conexion();
		$sql = "update lote set ".$sql." lote = '".htmlspecialchars($this->lote,ENT_QUOTES)."',
		metrosCuadrados = '".htmlspecialchars($this -> metrosCuadrados,ENT_QUOTES)."',
		precio = '".$this -> precio."',
		enganche = '".$this -> enganche."',
		mensualidad = '".$this -> mensualidad."',
		meses = '".$this -> meses."',
		status = '".$this -> status."',
		interior = '".$this -> interior."',
		terrazas = '".$this -> terrazas."',
		cajones = '".$this -> cajones."'
		where idlote = ".$this->idLote.";";
		$con -> ejecutar_sentencia($sql);
	}


	function recuperaimagen()
	{
		$sql="select idlote, ruta, lote from lote where idlote=".$this->idLote.";";
		$con= new conexion();
		$resultados= $con->ejecutar_sentencia($sql);

		while ($fila=mysqli_fetch_array($resultados))
		{
			$this->idLote=$fila['idlote'];
			$this->ruta=$fila['ruta'];
			$this->titulo=$fila['lote'];
			$this->ruta_final=$this->directorio.$fila['ruta'];
		}
	}


	function updateStatusBatch($status){
		$sql = "UPDATE lote SET status = ".$status." WHERE idlote = ".$this -> idLote;
		$con = new conexion();
		$con -> ejecutar_sentencia($sql);
	}

	function updateImgLote($lote,$img){
		$sql = "UPDATE lote SET ruta = '".$img."' WHERE lote = ".$lote;
		$con = new conexion();
		$con -> ejecutar_sentencia($sql);
	}

	function listaLote()
	{
		$resultados = array();
		$con = new conexion();
		$sql = "select * from lote";
		$temporal = $con -> ejecutar_sentencia($sql);
		while($fila = mysqli_fetch_array($temporal))
		{
			$registro = array();
			$registro['idlote'] = $fila['idlote'];
			$registro['lote'] = $fila['lote'];
			$registro['metrosCuadrados'] = $fila['metrosCuadrados'];
			$registro['precio'] = $fila['precio'];
			$registro['status'] = $fila['status'];
			$registro['ruta'] = $fila['ruta'];
			$registro['meses'] = $fila['meses'];
			$registro['interior'] = $fila['interior'];
			$registro['terrazas'] = $fila['terrazas'];
			$registro['cajones'] = $fila['cajones'];
			array_push($resultados,$registro);
		}
		mysqli_free_result($temporal);
		return($resultados);
	}

	function listaLoteStatus($status){
		$resultados = array();
		$con = new conexion();
		$sql = "select * from lote where status = ".$status;
		$temporal = $con -> ejecutar_sentencia($sql);
		while($fila = mysqli_fetch_array($temporal)){
			$registro = array();
			$registro['idlote'] = $fila['idlote'];
			$registro['lote'] = $fila['lote'];
			$registro['metrosCuadrados'] = $fila['metrosCuadrados'];
			$registro['precio'] = $fila['precio'];
			$registro['status'] = $fila['status'];
			$registro['ruta'] = $fila['ruta'];			
			$registro['interior'] = $fila['interior'];
			$registro['terrazas'] = $fila['terrazas'];
			$registro['cajones'] = $fila['cajones'];
			array_push($resultados,$registro);
		}
		mysqli_free_result($temporal);
		//return($resultados);
		echo json_encode($resultados);
	}

	function Logs($Linea, $FILE = "logs")
    {
        $file = fopen($FILE . ".txt", "a");
        fwrite($file, time() . '=>' . $Linea . PHP_EOL);
        fclose($file);
    }

	function listaLoteJson(){
		$sql = "select * from lote";
		$con = new conexion();
		$temporal = $con -> ejecutar_sentencia($sql);
		$resultados = array();

		while ($row = mysqli_fetch_array($temporal)) {
			$registro = array();
			$registro['idLote'] = $row['idlote'];
			$registro['lote'] = $row['lote'];
			$registro['metrosCuadrados'] = $row['metrosCuadrados'];
			$registro['status'] = $row['status'];
			$registro['ruta'] = $row['ruta'];
			$registro['precio'] = empty($row['precio']) ? 0 : $row['precio'];
			$descuento = $registro['precio'] * 0.12;
			$registro['enganche'] = $row['enganche'];
			$registro['precioFormato'] = empty($registro['precio']) ? 0 : number_format($registro['precio'], 2);
			$registro['m2Formato'] = empty($registro['metrosCuadrados']) ? 0 : number_format($registro['metrosCuadrados'], 2);
			$registro['engancheFormato'] = empty($registro['enganche']) ? 0 : number_format($registro['enganche'], 2);
			$registro['mensualidadFormato'] = empty($row['mensualidad']) ? 0 : number_format($row['mensualidad'], 2);
			$registro['saldoentregaFormato'] = empty($row['saldo_entrega']) ? 0 : number_format($row['saldo_entrega'], 2);
			$registro['tipo'] = $row['tipo'];
			$registro['nombre'] = $row['nombre'];
			$registro['meses'] = $row['meses'];

			//Eduardo Gonzalez
			$registro['interior'] = empty($row['interior']) ? 0 : number_format($row['interior'], 2);
			$registro['terrazas'] = empty($row['terrazas']) ? 0 : number_format($row['terrazas'], 2);
			$registro['cajones'] = $row['cajones'];
			array_push($resultados, $registro);
		}

		//echo $resultados;
		mysqli_free_result($temporal);
		echo json_encode($resultados);
	}

	function obtenerLote()
	{
		$con= new conexion();
		$sql="select * from lote where idlote=".$this->idLote;
		$temporal=$con->ejecutar_sentencia($sql);

		while ($fila = mysqli_fetch_array($temporal))
		{
			$this -> lote = $fila['lote'];
			$this -> idLote = $fila['idlote'];
			$this -> metrosCuadrados = $fila['metrosCuadrados'];
			$this -> precio = $fila['precio'];
			$this -> status = $fila['status'];
			$this -> ruta = $fila['ruta'];
			$this -> precioxm2 = $fila['precio']*$fila['metrosCuadrados'];
			$this -> precioTotal = number_format($fila['precio']*$fila['metrosCuadrados'], 2);
			$this -> enganche = $fila['enganche'];
			$this -> mensualidad = $fila['mensualidad'];
			$this -> meses = $fila['meses'];

			//Obtener datos
			$this -> interior = $fila['interior'];
			$this -> terrazas = $fila['terrazas'];
			$this -> cajones = $fila['cajones'];
		}

		mysqli_free_result($temporal);
	}

	function obtenerPrecio($precioBase=0,$plazo=0){
		$resultados=array();
		$registro=array();
		$registro['precioBase'] = $precioBase;
		if($plazo==1){
			$descuento=	$precioBase * 0.12;
			$precioTotal=$precioBase-$descuento;
			$enganche=0;
			$mensualidad = $precioTotal;
			$registro['descuento']=number_format($descuento,2);
			$registro['precioTotal']=	number_format($precioTotal,2);
			$registro['enganche']=	"No aplica";
			$registro['mensualidad']=	number_format($mensualidad,2);

		}else if($plazo==12){

			$descuento=	$precioBase * 0.06;
			$precioTotal=$precioBase-$descuento;
			$enganche=$precioTotal * 0.20;
			$mensualidad = ($precioTotal - $enganche) / 12;
			$registro['descuento']=number_format($descuento,2);
			$registro['precioTotal']=	number_format($precioTotal,2);
			$registro['enganche']=	number_format($enganche,2);
			$registro['mensualidad']=	number_format($mensualidad,2);

		}else if($plazo==24){

			$descuento=	$precioBase * 0.03;
			$precioTotal=$precioBase-$descuento;
			$enganche=$precioTotal * 0.20;
			$mensualidad = ($precioTotal - $enganche) / 24;
			$registro['descuento']=number_format($descuento,2);
			$registro['precioTotal']=	number_format($precioTotal,2);
			$registro['enganche']=	number_format($enganche,2);
			$registro['mensualidad']=	number_format($mensualidad,2);

		}else if($plazo==36){

			$precioTotal=$precioBase;
			$enganche=$precioTotal * 0.20;
			$mensualidad = ($precioTotal - $enganche) / 36;
			$registro['descuento']=number_format(0.00);
			$registro['precioTotal']=	number_format($precioTotal,2);
			$registro['enganche']=	number_format($enganche,2);
			$registro['mensualidad']=	number_format($mensualidad,2);

		}

		array_push($resultados, $registro);
		echo json_encode($resultados);
	}

}
?>
