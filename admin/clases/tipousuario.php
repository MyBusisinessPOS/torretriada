<?php
include_once('conexion.php');
class tipousuario
{
  var $idtipousuario;
  var $nomtipousuario;
  var $status;  
  
  function tipousuario($a=0,$b='',$stat=0)
  {
	  $this->idtipousuario=$a;
	  $this->nomtipousuario=$b; 
	  $this->status=$stat;
  }
  
  function insertar_tipousuario()
  {
	  $sql="insert into tiposusuario (nomtipousuario,status) values ('".$this->nomtipousuario."',1);";
	  $con=new conexion();
	  $this->idtipousuario=$con->ejecutar_sentencia($sql);
  }
  
  function modificar_tipousuario()
  {
	  $sql="update tiposusuario set nomtipousuario='".$this->nomtipousuario."', status=".$this->status."  where idtipousuario=".$this->idtipousuario.";";
	  $con=new conexion();
	  $con->ejecutar_sentencia($sql);
  //echo $sql;
  }
  
 function DesactivaTipousuario()
 {
	  $con=new conexion();
	  $sql="update tiposusuario set status=0 where idtipousuario=".$this->idtipousuario;
	  $con->ejecutar_sentencia($sql);	
 }
 
 function ActivaTipousuario()
 {
	  $con=new conexion();
	  $sql="update tiposusuario set status=1 where idtipousuario=".$this->idtipousuario;
	  $con->ejecutar_sentencia($sql);	
 }
 
 function elimina_Tipousuario()
 {
	  $conexion=new conexion();
	  $sql="delete from tiposusuario where idtipousuario=".$this->idtipousuario;
	  return $conexion->ejecutar_sentencia($sql);
 }
 
 function listaTipousuarioActivas()
  {
	  $resultados=array();
	  $sql="select idtipousuario, nomtipousuario, status from tiposusuario where status=1";
	  $con=new conexion();
	  $temporal=$con->ejecutar_sentencia($sql);
	  while($fila=mysqli_fetch_array($temporal))
	  {
		  $registro=array();
		  $registro['idtipousuario']=$fila['idtipousuario'];
		  $registro['nomtipousuario']=$fila['nomtipousuario'];
		  $registro['status']=$fila['status'];  
		  array_push($resultados, $registro);
	  }
	  return $resultados;
  }
  function listaTipousuarioDesactivadas()
  {
	  $resultados=array();
	  $sql="select idtipousuario, nomtipousuario, status from tiposusuario where status=0";
	  $con=new conexion();
	  $temporal=$con->ejecutar_sentencia($sql);
	  while($fila=mysqli_fetch_array($temporal))
	  {
		  $registro=array();
		  $registro['idtipousuario']=$fila['idtipousuario'];
		  $registro['nomtipousuario']=$fila['nomtipousuario'];
		  $registro['status']=$fila['status'];  
		  array_push($resultados, $registro);
	  }
	  return $resultados;
  }
  function listaTipousuarioBusqueda($pedazo)
  {
	  $resultados=array();
	  $sql="select idtipousuario, nomtipousuario, status from tiposusuario where nomtipousuario like '%".$pedazo."%' order by status";
	  $con=new conexion();
	  $temporal=$con->ejecutar_sentencia($sql);
	  while($fila=mysqli_fetch_array($temporal))
	  {
		  $registro=array();
		  $registro['idtipousuario']=$fila['idtipousuario'];
		  $registro['nomtipousuario']=$fila['nomtipousuario'];
		  $registro['status']=$fila['status'];  
		  array_push($resultados, $registro);
	  }
	  echo json_encode($resultados);  
  }
  function listado_tipousuarioAjax()
  {
	  $resultados=array();
	  $sql="select idtipousuario, nomtipousuario, status from tiposusuario";
	  $con=new conexion();
	  $temporal=$con->ejecutar_sentencia($sql);
	  while($fila=mysqli_fetch_array($temporal))
	  {
		  $registro=array();
		  $registro['idtipousuario']=$fila['idtipousuario'];
		  $registro['nomtipousuario']=$fila['nomtipousuario'];
		  $registro['status']=$fila['status'];  
		  array_push($resultados, $registro);
	  }
	  echo json_encode($resultados); 
  }
  function obtener_tipousuario()
  {
	  $sql="select idtipousuario, nomtipousuario, status from tiposusuario where idtipousuario='".$this->idtipousuario."'";
	  $con=new conexion();
	  $resultados=$con->ejecutar_sentencia($sql);
	  while ($fila=mysqli_fetch_array($resultados))
	  {
		  $this->idtipousuario=$fila['idtipousuario'];
		  $this->nomtipousuario=$fila['nomtipousuario'];
		  $this->status=$fila['status'];  
	  }
  }
  
  function listado_tipousuario()
  {
	  $resultados=array();
	  $sql="select idtipousuario, nomtipousuario, status from tiposusuario order by idtipousuario desc";
	  $con=new conexion();
	  $temporal=$con->ejecutar_sentencia($sql);
	  while($fila=mysqli_fetch_array($temporal))
	  {
		  $registro=array();
		  $registro['idtipousuario']=$fila['idtipousuario'];
		  $registro['nomtipousuario']=$fila['nomtipousuario'];
		  $registro['status']=$fila['status'];  
		  array_push($resultados, $registro);
	  }
	  return $resultados;
  }
}
?>
