<?php
include_once("../../clases/datosusuario.php");
include_once("../../clases/usuario.php");

$operaciones = $_REQUEST['operaciones'];
switch($operaciones)
{
	case 'recuperar':
		$datosusuario = new datosusuario(0,'','','');
		$datosusuario->token = $_REQUEST['token'];
		$datosusuario->obtener_datos_usuario_token();
		if($_REQUEST['pass'] == $_REQUEST['repass'])
		{
			$usuario = new usuario($datosusuario->idusuario,'',$_REQUEST['pass'],'','');
			$usuario->modifica_usuario_pass();
			$success=3;
			header('location:../../index.php?success='.$success);	
		}
		else
		{
			$success=1;
			header('location:recuperar.php?success='.$success);
		}	
	break;
}
?>