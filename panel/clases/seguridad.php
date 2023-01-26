<?php
include_once('conexion.php');
include_once('usuario.php');
include_once('permiso.php');
include_once('tiposusuarioxpermiso.php');

class seguridad
{
	var $usuario;
	var $permiso;
	var $tipousuarioxpermiso;
			
	function __construct()
	{
		$this->usuario= new usuario('','','','','');
		$this->permiso= new permiso('','','','');
		$this->tipousuarioxpermiso= new tiposusuarioxpermiso(0,0);
	}
	function valida_permiso_usuario($idusuario, $clavepermiso)
	{
		$this->usuario->idusuario=$idusuario; 
		$this->permiso->clavepermiso=$clavepermiso;
		
		$this->usuario->obten_usuario();
		$this->usuario->obtener_tipo_usuario();
		$this->permiso->obtener_permisoclave();
		
		$this->tipousuarioxpermiso->idtipousuario=$this->usuario->tiposusuario->idtipousuario;
		$this->tipousuarioxpermiso->idpermiso=$this->permiso->idpermiso;
		//return 1;
	return $this->tipousuarioxpermiso->existe_rol_permiso();
	}
	
	function candado()
	{
		session_start();
		if(!(isset($_SESSION['idusuario'])))
		{
			header('Location:index.php');
		}

	}
	function candado2()
	{
		session_start();
		if(!(isset($_SESSION['iduserend'])))
		{
			header('Location:http://clientes.locker.com.mx/plataforma/index.php?success=1');
		}

	}
	function logoutregistro(){
			session_destroy();
	}
}
?>