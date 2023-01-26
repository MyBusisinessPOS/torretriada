<?php
include_once('conexion.php');

class permiso
{
	  var $idpermiso;
	  var $nompermiso;
	  var $clavepermiso;
	  var $status;
	  var $idSeccionPermiso;
	  
	  function __construct($idp = 0,$nomp = '',$clavep = '', $idSeccionPermiso = 0, $stat = 0)
	  {
		  $this -> idpermiso = $idp;
		  $this -> nompermiso = $nomp;
		  $this -> clavepermiso = $clavep;
		  $this -> idSeccionPermiso = $idSeccionPermiso;
		  $this -> status = $stat;
	  }
	  
	  function insertar_permiso()
	  {
		  $sql="insert into permiso(nompermiso,clavepermiso, idSeccionPermiso, status) values ('".$this->nompermiso."','".$this->clavepermiso."',".$this -> idSeccionPermiso.", 1);";
		  $con=new conexion();
		  $con->ejecutar_sentencia($sql);
		  //echo $sql;
	  }
	  
	  function modificar_permiso()
	  {
		  $sql = "update permiso set nompermiso = '".$this -> nompermiso."', clavepermiso = '".$this -> clavepermiso."', idSeccionPermiso = ".$this -> idSeccionPermiso.", status = ".$this -> status." where idpermiso = ".$this -> idpermiso.";";
		  $con = new conexion();
		  $con -> ejecutar_sentencia($sql);
	  }

	function eliminarPermiso(){
		$con = new conexion();
		$sql = "DELETE FROM permiso WHERE idpermiso = ".$this -> idpermiso;
		$con -> ejecutar_sentencia($sql);
	}
	function DesactivaPermiso()
	{
		$con=new conexion();
		$sql="update permiso set status=0 where idpermiso=".$this->idpermiso;
		$con->ejecutar_sentencia($sql);	
	}

	function ActivaPermiso()
	{
		$con=new conexion();
		$sql="update permiso set status=1 where idpermiso=".$this->idpermiso;
		$con->ejecutar_sentencia($sql);	
	}

	function listaPermisoActivas()
	{
		$conexion=new conexion();
		$sql="select idpermiso,nompermiso,clavepermiso,status from permiso where status=1";
		$conexion->ejecutar_sentencia($sql);
		$resultados=array();
		while ($row=$conexion -> fetchRow())
		{
			$registro=array();
			$registro['idpermiso']=$row['idpermiso'];
			$registro['nompermiso']=$row['nompermiso'];
			$registro['clavepermiso']=$row['clavepermiso'];
			$registro['status']=$row['status'];
			array_push($resultados,$registro);
		}
		return $resultados;
	}
	
	function listaPermisoDesactivadas()
	{
		$conexion=new conexion();
		$sql="select idpermiso,nompermiso,clavepermiso,status from permiso where status=0";
		$conexion->ejecutar_sentencia($sql);
		$resultados=array();
		while ($row=$conexion -> fetchRow())
		{
			$registro=array();
			$registro['idpermiso']=$row['idpermiso'];
			$registro['nompermiso']=$row['nompermiso'];
			$registro['clavepermiso']=$row['clavepermiso'];
			$registro['status']=$row['status'];
			array_push($resultados,$registro);
		}
		return $resultados;
	}
	
	function listaPermisoBusqueda($pedazo)
	{
		$conexion=new conexion();
		$sql="select idpermiso,nompermiso,clavepermiso,status from permiso where nompermiso like '%".$pedazo."%' order by status";
		$conexion->ejecutar_sentencia($sql);
		$resultados=array();
		while ($row=$conexion -> fetchRow())
		{
			$registro=array();
			$registro['idpermiso']=$row['idpermiso'];
			$registro['nompermiso']=$row['nompermiso'];
			$registro['clavepermiso']=$row['clavepermiso'];
			$registro['status']=$row['status'];
			array_push($resultados,$registro);
		}
		return $resultados;
	}
	
	function obtener_permiso()
	{
	  $sql="SELECT * FROM permiso WHERE idpermiso = ".$this->idpermiso.";";
	  $con=new conexion();
	  $con->ejecutar_sentencia($sql);
	  while ($fila=$con -> fetchRow())
	  {
		$this -> idpermiso = $fila['idpermiso'];
		$this -> nompermiso = $fila['nompermiso'];
		$this -> clavepermiso = $fila['clavepermiso'];
		$this -> idSeccionPermiso = $fila['idSeccionPermiso'];
		$this -> status = $fila['status'];
	  }
	}
	
	function obtener_permisoclave()
	{
	  $sql="select idpermiso from permiso where clavepermiso='".$this->clavepermiso."';";
	  $con= new conexion();
	  $con->ejecutar_sentencia($sql);
	  while ($fila=$con -> fetchRow())
	  {
		$this->idpermiso=$fila['idpermiso'];
	  }
	}
	
	function listado_permiso($idseccion = 0){
	  ($idseccion != 0) ? $pedazo = ' AND permiso.idSeccionPermiso = '.$idseccion : $pedazo = ' ORDER BY permiso.idSeccionPermiso';
	  $resultados=array();
	  $sql="SELECT permiso.*, seccionPermiso.nombreSeccion FROM permiso, seccionPermiso WHERE seccionPermiso.idSeccionPermiso = permiso.idSeccionPermiso  ".$pedazo."";
	  $con=new conexion();
	  $con->ejecutar_sentencia($sql);
	  while($fila=$con -> fetchRow())
	  {
		$registro=array();
		$registro['idpermiso']=$fila['idpermiso'];
		$registro['nompermiso']=$fila['nompermiso'];
		$registro['clavepermiso']=$fila['clavepermiso'];
		$registro['idSeccionPermiso'] = $fila['idSeccionPermiso'];
		$registro['nombreSeccion'] = $fila['nombreSeccion'];
		$registro['status']=$fila['status'];
		
		array_push($resultados, $registro);
	  }
	  return $resultados;
	}

	function listarSecciones(){
		
		$temporal = array();
		$con = new conexion();
		$sql = "SELECT * FROM seccionPermiso";
		$con -> ejecutar_sentencia($sql);
		while($row = $con -> fetchRow()){
			$registro['idSeccionPermiso'] = $row['idSeccionPermiso'];
			$registro['nombreSeccion'] = $row['nombreSeccion'];
			array_push($temporal, $registro);
		}
		return $temporal;
	}
	

}
?>