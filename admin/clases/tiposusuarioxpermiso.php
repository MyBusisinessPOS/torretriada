<?php
include_once('conexion.php');

class tiposusuarioxpermiso
{

var $tipousuario;
var $permiso;
var $idtipousuario;
var $idpermiso;

function tiposusuarioxpermiso($idtipousuario=0,$idpermiso=0)
{
$this->tipousuario=array();
$this->permiso=array();
$this->idtipousuario=$idtipousuario;
$this->idpermiso=$idpermiso;
}

function obten_tipousuario_permiso()
{
$con=new conexion();
$sql='select idtipousuario from tipousuarioxpermiso where idpermiso='.$this->idpermiso;
$resultados=$con->ejecutar_sentencia($sql);
$resultados_usuario=array();
while ($fila=mysqli_fetch_array($resultados))
{
array_push($this->usuario,$fila['idtipousuario']);
}
}

function obten_permiso_rol()
{
$con=new conexion();
$sql='select idpermiso from tipousuarioxpermiso where idtipousuario='.$usuario->idtipousuario;
$resultados=$con->ejecutar_sentencia($sql);
$resultados_permiso=array();
while ($fila=mysqli_fetch_array($resultados))
{
array_push($this->permiso,$fila['idpermiso']);
}
}


function existe_rol_permiso()
{
$bandera=0;
$con=new conexion();
$sql='select idpermiso,idtipousuario from tipousuarioxpermiso where idtipousuario="'.$this->idtipousuario.'" and idpermiso="'.$this->idpermiso.'"';
//echo $sql;0
$resultados=$con->ejecutar_sentencia($sql);
while ($fila=mysqli_fetch_array($resultados))
{
$bandera=1;
}
return $bandera;
}


function desasigna_permiso_rol()
{
$con=new conexion();
$sql='delete from tipousuarioxpermiso where idtipousuario='.$this->idtipousuario;
$con->ejecutar_sentencia($sql);
}

function desasigna_rol_permiso()
{
$con=new conexion();
$sql='delete from tipousuarioxpermiso where idpermiso='.$this->idpermiso;
$con->ejecutar_sentencia($sql);
}



function asigna_permiso_rol()
{
$con=new conexion();
$sql='insert into tipousuarioxpermiso (idtipousuario,idpermiso) values ('.$this->idtipousuario.','.$this->idpermiso.')';
$con->ejecutar_sentencia($sql);
//echo $sql;

}



}
?>