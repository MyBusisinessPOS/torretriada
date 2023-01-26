<?php
include_once('conexion.php');
include_once('tipousuario.php');
include_once('datosusuario.php');

class usuario
{
	var $idusuario;
	var $nomusuario;
	var $password;
	var $status;
	var $tiposusuario;
	var $datosusuario;
	
	function __construct($a = 0, $b = '', $c = '', $stat = 0, $idtipo = 0)
	{
		$this->idusuario=$a;
		$this->nomusuario=$b;
		$this->password=$c;
		$this->status=$stat;
		$this->tiposusuario= new tipousuario($idtipo,'','');
		$this->tiposusuario->idtipousuario=$idtipo;
		$this->datosusuario= new datosusuario($a,'','','','');
	}
	
	function obtener_tipo_usuario()
	{
		$this->tiposusuario->obtener_tipousuario();
	}
	
	function inserta_usuario()
	{
		$conexion= new conexion();
		$sql="insert into usuario (nomusuario,password,status,idtipousuario) values('".$this->nomusuario."',MD5('".$this->password."'),1,".$this->tiposusuario->idtipousuario.")";
		return $this->idusuario=$conexion->ejecutar_sentencia($sql);
	}
	
	function modifica_usuario()
	{
		$conexion= new conexion();
		$pedazo="";
		$pedazo2='';
		if($this->nomusuario != '')
			$pedazo2="nomusuario='".$this->nomusuario."',";
		if ($this->password!='')   
			$pedazo="password=MD5('".$this->password."'),";
		$sql="update usuario set ".$pedazo2." ".$pedazo."status='".$this->status."',idtipousuario=".$this->tiposusuario->idtipousuario." where idusuario=".$this->idusuario;
		return $conexion->ejecutar_sentencia($sql);
	}
	function modifica_usuario_pass()
	{
		$conexion= new conexion();
		$sql="update usuario set password=MD5('".$this->password."') where idusuario=".$this->idusuario;
		$conexion->ejecutar_sentencia($sql);
	}
	function elimina_usuario()
	{
		$conexion=new conexion();
		$sql="delete from usuario where idusuario=".$this->idusuario;
		return $conexion->ejecutar_sentencia($sql);
	}
	
	function DesactivaUsuario()
	{
		$con=new conexion();
		$sql="update usuario set status=0 where idusuario=".$this->idusuario;
		$con->ejecutar_sentencia($sql);	
	}
	
	function ActivaUsuario()
	{
		$con=new conexion();
		$sql="update usuario set status=1 where idusuario=".$this->idusuario;
		$con->ejecutar_sentencia($sql);	
	}
	
	function listaUsuarioActivas()
	{
		$conexion=new conexion();
		$sql="select idusuario,nomusuario,password,status,idtipousuario from usuario where status=1";
		$conexion->ejecutar_sentencia($sql);
		$resultados=array();
		while ($row=$conexion -> fetchRow())
		{
			$registro=array();
			$registro['idusuario']=$row['idusuario'];
			$registro['nomusuario']=$row['nomusuario'];
			$registro['password']=$row['password'];
			$registro['status']=$row['status'];
			$registro['idtipousuario']=$row['idtipousuario'];
			$tipusuariolist = new tipousuario($registro['idtipousuario']);
			$tipusuariolist->obtener_tipousuario();
			$registro['nomtipo']=$tipusuariolist->nomtipousuario;
			array_push($resultados,$registro);
		}
		return $resultados;
	}
	
	function listaUsuarioDesactivadas()
	{
		$conexion=new conexion();
		$sql="select idusuario,nomusuario,password,status,idtipousuario from usuario where status=0";
		$conexion->ejecutar_sentencia($sql);
		$resultados=array();
		while ($row=$conexion -> fetchRow())
		{
			$registro=array();
			$registro['idusuario']=$row['idusuario'];
			$registro['nomusuario']=$row['nomusuario'];
			$registro['password']=$row['password'];
			$registro['status']=$row['status'];
			$registro['idtipousuario']=$row['idtipousuario'];
			$tipusuariolist = new tipousuario($registro['idtipousuario']);
			$tipusuariolist->obtener_tipousuario();
			$registro['nomtipo']=$tipusuariolist->nomtipousuario;
			array_push($resultados,$registro);
		}
		return $resultados;
	}
	
	function listaUsuarioBusqueda($pedazo)
	{
		$conexion=new conexion();
		$sql="select idusuario,nomusuario,password,status,idtipousuario from usuario where nomusuario like '%".$pedazo."%' order by status";
		$conexion->ejecutar_sentencia($sql);
		$resultados=array();
		while ($row=$conexion -> fetchRow())
		{
			$registro=array();
			$registro['idusuario']=$row['idusuario'];
			$registro['nomusuario']=$row['nomusuario'];
			$registro['password']=$row['password'];
			$registro['status']=$row['status'];
			$registro['idtipousuario']=$row['idtipousuario'];
			$tipusuariolist = new tipousuario($registro['idtipousuario']);
			$tipusuariolist->obtener_tipousuario();
			$registro['nomtipo']=$tipusuariolist->nomtipousuario;
			array_push($resultados,$registro);
		}
		echo json_encode($resultados);
	}
	function lista_usuario_Ajax()
	{
		$conexion=new conexion();
		$sql="select idusuario,nomusuario,password,status,idtipousuario from usuario";
		$conexion->ejecutar_sentencia($sql);
		$resultados=array();
		while ($row=$con -> fetchRow())
		{
			$registro=array();
			$registro['idusuario']=$row['idusuario'];
			$registro['nomusuario']=$row['nomusuario'];
			$registro['password']=$row['password'];
			$registro['status']=$row['status'];
			$registro['idtipousuario']=$row['idtipousuario'];
			$tipusuariolist = new tipousuario($registro['idtipousuario']);
			$tipusuariolist->obtener_tipousuario();
			$registro['nomtipo']=$tipusuariolist->nomtipousuario;
			array_push($resultados,$registro);
		}
		echo json_encode($resultados);
	}
	function lista_usuario()
	{
		$conexion=new conexion();
		$sql="select idusuario,nomusuario,password,status,idtipousuario from usuario order by idusuario desc";
		$conexion->ejecutar_sentencia($sql);
		$resultados=array();
		while ($row=$conexion -> fetchRow())
		{
			$registro=array();
			$registro['idusuario']=$row['idusuario'];
			$registro['nomusuario']=$row['nomusuario'];
			$registro['password']=$row['password'];
			$registro['status']=$row['status'];
			$registro['idtipousuario']=$row['idtipousuario'];
			$tipusuariolist = new tipousuario($registro['idtipousuario']);
			$tipusuariolist->obtener_tipousuario();
			$registro['nomtipo']=$tipusuariolist->nomtipousuario;
			array_push($resultados,$registro);
		}
		return $resultados;
	}
	
	function obten_usuario()
	{
		$conexion=new conexion();
		$sql="select idusuario,nomusuario,password,status,idtipousuario from usuario where idusuario='".$this->idusuario."'";
		$conexion->ejecutar_sentencia($sql);
		while($row=$conexion -> fetchRow())
		{
			$this->idusuario=$row['idusuario'];
			$this->nomusuario=$row['nomusuario'];
			$this->password=$row['password'];
			$this->status=$row['status'];
			$this->tiposusuario->idtipousuario=$row['idtipousuario'];
		}
	}
	
	function VerficarDisponibilidadNomUsuario($nom)
	{
		$conexion=new conexion();
		$sql="SELECT nomusuario FROM usuario where nomusuario='".$nom."'";
		$conexion->ejecutar_sentencia($sql);
		$resultados=array();
		while ($row=$conexion -> fetchRow())
		{
			$registro=array();
			$registro['nomusuario']=$row['nomusuario'];
			array_push($resultados,$registro);
		}
		mysqli_free_result($result);
		return $resultados;
	}
	function VerficarPassword($idusuario)
	{
		$conexion=new conexion();
		$sql="SELECT password FROM usuario where idusuario='".$idusuario."'";
		$conexion->ejecutar_sentencia($sql);
		$resultados=array();
		while ($row=$conexion -> fetchRow())
		{
			$this->password=$row['password'];
		}
	}
	function disponibilidadCorreo($correo)
	{
		$conexion=new conexion();
		$sql="SELECT email FROM datosusuario where email = '".$correo."'";
		$conexion->ejecutar_sentencia($sql);
		$resultados = $conexion -> numRows();
		if ($resultados > 0){
			return false;
		}
		else{
			return true;
		}
	}
	function login()
	{
		$conexion=new conexion();
		$sql="select * from usuario where nomusuario='".$this->nomusuario."'and password = MD5('".$this->password."') and status=1";
		$conexion->ejecutar_sentencia($sql);
		while($fila = $conexion -> fetchRow())
		{
			$this->idusuario=$fila['idusuario'];
			$this->nomusuario=$fila['nomusuario'];
		}
	}
	function insertar_datos_usuario($nom,$correo,$tel)
	{
			$this->datosusuario= new datosusuario($this->idusuario,$nom,$correo,$tel);		
			$this->datosusuario->agregar_datos_usuario();
	}
		
	function modificar_datos_usuario($nom,$correo,$tel)
	{
			$this->datosusuario= new datosusuario($this->idusuario,$nom,$correo,$tel);	
			$this->datosusuario->modificar_datos_usuario();
	}
		
	function eliminar_datos_usuario()
	{
			$this->datosusuario->eliminar_datos_usuario();
	}
		
	function obtener_datos()
	{
			$this->datosusuario->obtener_datos_usuario();
	}
		
	function buscar_datos_email($email)
	{
			$this->datosusuario=new datosusuario(0,'',$email,'');
			$this->datosusuario->buscaremail();
	}
	
	function obtener_datos_usuarios($id)
	{
			 $con=new conexion();
			 $sql="SELECT usuario.idusuario,nomusuario, datosusuario.idusuario, nombre,email,telefono from usuario, datosusuario where usuario.idusuario=datosusuario.idusuario and usuario.idusuario=".$id;
			 $con->ejecutar_sentencia($sql);
			 //echo $sql;
			 
			 while($row = $conexion -> fetchRow())
			 {
				  $this->idusuario=$row['id_usuario'];
				  $this->nombre=$row['nombre'];				
				  $this->email=$row['email'];
				  $this->telefono=$row['telefono'];
			 }
	
	}
}
?>