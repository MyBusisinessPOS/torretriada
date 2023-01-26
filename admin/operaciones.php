<?php
/*
 * @Author: Carlos David Baas Santiago.
 * @Description: Este script controla todas las operaciones del sistema.
*/
session_start();
function __autoload($nombre_clase) {
	//$nombre_clase = strtolower($nombre_clase);
    include 'clases/'.$nombre_clase .'.php';
}

$operaciones=$_REQUEST['operaciones'];
switch($operaciones){
	///////////////////////////////////////////////
	///	ORDENAR ELEMENTOS
	///////////////////////////////////////////////
	case 'ordenar':
		if($_REQUEST['desde'] == 'banner'){
			$val = ($_REQUEST['idorden']);
			$val2 = array_reverse($val);
			for($i=0; $i < count($val2); $i++)
			{
				$promocion = new banner($val2[$i]);
				$promocion -> ordenaBanner($i);

			}
		}
	break;
/////////////////////////////////////////////////
/// CONTROLADORES SETTINGS EMAIL
/////////////////////////////////////////////////
	case 'modificarsettingsEmail':
		$settingsEmail = new settingsEmail(1,$_REQUEST['host'], $_REQUEST['port'], $_REQUEST['username'], $_REQUEST['password'], $_REQUEST['noReply'], $_REQUEST['fromname'], $_REQUEST['addCC']);
		$settingsEmail -> modificar_settingsEmail();
		header('location: formSettingsEmail.php?success=1');
	break;
	case 'pruebaCorreo':
		$correo = new correo();
		$correo -> emailPrueba = $_REQUEST['email'];

		if($correo -> enviar()){
			echo 1;
		}else{
			echo 2;
		}
	break;

/////////////////////////////////////////////////
/// CONROLADORES SEO
/////////////////////////////////////////////////
	case 'modificarSeo':
		$seo = new seo(1,$_REQUEST['metaDescription'], $_REQUEST['metaKeywords'], $_REQUEST['metaAuthor'], $_REQUEST['metaOgTitle'], $_REQUEST['metaOgUrl'], $_REQUEST['metaOgType'], $_REQUEST['metaOgDescription'], $_REQUEST['metaOgLocale'], $_REQUEST['metaOgSiteName'], $_REQUEST['idAnalitics'], $_REQUEST['sitenameAnalitics'], $_REQUEST['conversionFacebook'], $_REQUEST['conversionGoogle']);
		$seo -> modificar_seo();

		if(isset($_FILES['archivoFavicon']['name'])){
			if($_FILES['archivoFavicon']['name'] != ''){
				$ruta = $seo -> obtenerExtensionArchivo($_FILES['archivoFavicon']['name']);
				$tmp = $_FILES['archivoFavicon']['tmp_name'];
				$seo -> modificarImgSeo(1, $ruta, $tmp);
			}
		}

		if(isset($_FILES['archivoPin']['name'])){
			if($_FILES['archivoPin']['name'] != ''){
				$ruta = $seo -> obtenerExtensionArchivo($_FILES['archivoPin']['name']);
				$tmp = $_FILES['archivoPin']['tmp_name'];
				$seo -> modificarImgSeo(2, $ruta, $tmp);
			}
		}

		if(isset($_FILES['archivoOgImagen']['name'])){
			if($_FILES['archivoOgImagen']['name'] != ''){
				$ruta = $seo -> obtenerExtensionArchivo($_FILES['archivoOgImagen']['name']);
				$tmp = $_FILES['archivoOgImagen']['tmp_name'];
				$seo -> modificarImgSeo(3, $ruta, $tmp);
			}
		}
		header('Location: formSeo.php');
	break;


	///////////////////////////////////////////////////////////////////
	///				OPERACIONES REDES
	///////////////////////////////////////////////////////////////////
	case 'modificarcontacto':
		$correo = $_REQUEST['correo'];
		$emisor = $_REQUEST['emisor'];
		$contacto = new contacto(1,$correo, $emisor);
		$contacto->modificar_contacto();
		header('location: formcontacto.php?success=2');
	break;
	case 'modificarredes':
		if(isset($_REQUEST['contacto']) or $_REQUEST['contacto'] != ''){
			$correo = $_REQUEST['contacto'];
			$contacto = new contacto(1,$correo,'');
			$contacto->modificar_contacto();
		}

		$redes  = new redes();

		if(isset($_REQUEST['nombre'])){
			$cont = count($_REQUEST['nombre']);
			for ($i=0; $i < $cont ; $i++) {
				if($_REQUEST['nombre'][$i] != ''){
					$redes->titulo = $_REQUEST['nombre'][$i];
					$redes->url = $_REQUEST['url'][$i];
					$redes->status = 1;
					$redes->insertaredes();
				}

			}
		}
		if(isset($_REQUEST['nombremod'])){
			$cont = count($_REQUEST['nombremod']);
			for ($i=0; $i < $cont ; $i++) {
				if($_REQUEST['nombremod'][$i] != ''){
					$redes->idredes = $_REQUEST['idredes'][$i];
					$redes->titulo = $_REQUEST['nombremod'][$i];
					$redes->url = $_REQUEST['urlmod'][$i];
					$redes->modificaredes();
				}

			}
		}
		header('location: formredes.php?success=1');
	break;
	case 'activared':
		$redes = new redes($_REQUEST['id']);
		$redes -> activarredes();
	break;
	case 'desactivared':
	 	$redes = new redes($_REQUEST['id']);
		$redes -> desactivarredes();
	break;
	case 'eliminared':
		$redes = new redes($_REQUEST['id']);
		$redes -> eliminaredes();
	break;
	/**********************************************************
	* Procesos de Usuarios
	**********************************************************/
	case 'agregarusuario':
			$usuario= new usuario($_REQUEST['idusuario'], $_REQUEST['nomuser'], $_REQUEST['pass'],$_REQUEST['status'],$_REQUEST['tipo']);
			$usuario->inserta_usuario();
			$usuario->insertar_datos_usuario($_REQUEST['nombre'], $_REQUEST['email'], $_REQUEST['telefono']);
			header('Location: listusuarios.php');
	break;
	case 'modificarusuario':
			if($_REQUEST['nameuser'] == 'nameuser'){
				$nameuser=$_REQUEST['nomuser'];
			}
			else{
				$nameuser='';
			}
			if($_REQUEST['contra'] == 'pass'){
				$pass = $_REQUEST['pass'];
			}
			else{
				$pass='';
			}
			if($_REQUEST['emailControl'] == 'emailControl'){
				$email = $_REQUEST['email'];
			}
			else{
				$email='';
			}
			$usuario= new usuario($_REQUEST['idusuario'], $nameuser, $pass, $_REQUEST['status'],$_REQUEST['tipo']);
			$usuario->modifica_usuario();
			$usuario->modificar_datos_usuario($_REQUEST['nombre'], $email, $_REQUEST['telefono']);
			header('Location: listusuarios.php');
	break;
	case 'operausuario':
			if(isset($_REQUEST['idusuario'])){
				$select=$_REQUEST['operador'];
				if ($select == 'Eliminar'){
					foreach ($_REQUEST['idusuario'] as $elementoUsuario) {
						$usuario = new usuario($elementoUsuario);
						$usuario ->eliminar_datos_usuario();
						$usuario->elimina_usuario();
					}
					header('location: listusuarios.php');
				}
				if ($select == 'Mostrar'){
					foreach ($_REQUEST['idusuario'] as $elementoUsuario) {
						$usuario = new usuario($elementoUsuario);
						$usuario -> ActivaUsuario();
					}
					header('location: listusuarios.php');
				}
				if ($select == 'No Mostrar'){
					foreach ($_REQUEST['idusuario'] as $elementoUsuario) {
						$usuario = new usuario($elementoUsuario);
						$usuario->DesactivaUsuario();
					}
					header('location: listusuarios.php');
				}
			}
			else {
				header('location: listusuarios.php');
			}
	break;
	case 'activausuario':
			$usuario= new usuario($_REQUEST['id']);
			$usuario->ActivaUsuario();
	break;
	case 'desactivausuario':
			$usuario= new usuario($_REQUEST['id']);
			$usuario->DesactivaUsuario();
	break;
	case 'buscarusuario':
			$usuario= new usuario();
			$usuario->listaUsuarioBusqueda($_REQUEST['cadena']);
	break;
	case 'listausuario':
			$usuario= new usuario();
			$usuario->lista_usuario_Ajax();
	break;
	case 'agregartipousuario':
			$tipousuario= new tipousuario($_REQUEST['idtipousuario'],$_REQUEST['titulo'],$_REQUEST['status']);
			$tipousuario->insertar_tipousuario();
			$idtipousuario=$tipousuario->idtipousuario;
			if(isset($_REQUEST['idpermiso']))
			{
				$tipousuarioxpermiso = new tiposusuarioxpermiso(0,0);
				$tipousuarioxpermiso->idtipousuario=$idtipousuario;
				$tipousuarioxpermiso->desasigna_permiso_rol();

				foreach($_REQUEST['idpermiso'] as $elementoPermiso)
				{
					$tipousuarioxpermiso->idpermiso=$elementoPermiso;
					$tipousuarioxpermiso->asigna_permiso_rol();
				}
			}
		header('location:listtipousuario.php');
	break;
	case 'modificartipousuario':
		$tipousuario=new tipousuario($_REQUEST['idtipousuario'],$_REQUEST['titulo'],$_REQUEST['status']);
		$tipousuario->modificar_tipousuario();
		if(isset($_REQUEST['idpermiso']))
		{
			$tipousuarioxpermiso = new tiposusuarioxpermiso(0,0);
			$tipousuarioxpermiso->idtipousuario=$_REQUEST['idtipousuario'];
			$tipousuarioxpermiso->desasigna_permiso_rol();

			foreach($_REQUEST['idpermiso'] as $elementoPermiso)
			{
				$tipousuarioxpermiso->idpermiso=$elementoPermiso;
				$tipousuarioxpermiso->asigna_permiso_rol();
			}
		}
		else
		{
			$tipousuarioxpermiso = new tiposusuarioxpermiso();
			$tipousuarioxpermiso->idtipousuario=$_REQUEST['idtipousuario'];
			$tipousuarioxpermiso->desasigna_permiso_rol();

			foreach($_REQUEST['idpermiso'] as $elementoPermiso)
			{
				$tipousuarioxpermiso->idpermiso=$elementoPermiso;
				$tipousuarioxpermiso->asigna_permiso_rol();
			}
		}
		header('location:listtipousuario.php');
	break;
	case 'operatipousuario':
			if(isset($_REQUEST['idtipousuario'])){
				$select=$_REQUEST['operador'];
				if ($select == 'Eliminar'){
					foreach ($_REQUEST['idtipousuario'] as $elementoUsuario) {
						$tipousuario = new tipousuario($elementoUsuario);
						$tipousuarioxpermiso = new tiposusuarioxpermiso($elementoUsuario);
						$tipousuarioxpermiso->desasigna_permiso_rol();
						$tipousuario->elimina_Tipousuario();
					}
					header('location: listtipousuario.php');
				}

				if ($select == 'Mostrar'){
					foreach ($_REQUEST['idtipousuario'] as $elementoUsuario) {
						$tipousuario = new tipousuario($elementoUsuario);
						$tipousuario->ActivaTipousuario();
					}
					header('location: listtipousuario.php');
				}
				if ($select == 'No Mostrar'){
					foreach ($_REQUEST['idtipousuario'] as $elementoUsuario) {
						$tipousuario = new tipousuario($elementoUsuario);
						$tipousuario -> DesactivaTipousuario();
					}
					header('location: listtipousuario.php');
				}
			}
			else {
				header('location: listtipousuario.php');
			}
	break;
	case 'activatipoU':
			$tipousuario= new tipousuario($_REQUEST['id']);
			$tipousuario->ActivaTipousuario();
	break;
	case 'desactivatipoU':
			$tipousuario= new tipousuario($_REQUEST['id']);
			$tipousuario->DesactivaTipousuario();
	break;
	case 'buscartipousuario':
			$tipousuario= new tipousuario();
			$tipousuario->listaTipousuarioBusqueda($_REQUEST['cadena']);
	break;
	case 'listatipousuario':
			$tipousuario= new tipousuario();
			$tipousuario->listado_tipousuarioAjax();
	break;
 	case 'agregarpermiso':
			$permiso = new permiso($_REQUEST['idpermiso'],$_REQUEST['titulo'],$_REQUEST['clave'],$_REQUEST['status']);
			$permiso->insertar_permiso();
			header('Location: listpermisos.php');
	break;
	case 'modificarpermiso':
			$permiso = new permiso($_REQUEST['idpermiso'],$_REQUEST['titulo'],$_REQUEST['clave'],$_REQUEST['status']);
			$permiso->modificar_permiso();
			header('Location: listpermisos.php');
	break;
	case 'operapermiso':
		if(isset($_REQUEST['idpermiso'])){
			$select=$_REQUEST['operador'];
			$imgp=0;
			if ($select == 'Eliminar'){
				foreach ($_REQUEST['idpermiso'] as $elemento) {
					$permiso = new permiso($elemento);
					$permiso->eliminarPermiso();
				}
				header('location: listpermisos.php?success=3');
			}
			if ($select == 'Mostrar'){
				foreach ($_REQUEST['idpermiso'] as $elemento) {
					$permiso = new permiso($elemento);
					$permiso->ActivaPermiso();
				}
				header('location: listpermisos.php?success=4');
			}
			if ($select == 'No Mostrar'){
				foreach ($_REQUEST['idpermiso'] as $elemento) {
					$permiso = new permiso($elemento);
					$permiso->DesactivaPermiso();
				}
				header('location: listpermisos.php?success=5');
			}
		}
		else {
			header('location: listpermisos.php');
		}
	break;
	case 'activapermiso':
		$permiso = new permiso($_REQUEST['id']);
		$permiso->ActivaPermiso();
	break;
	case 'desactivapermiso':
	 	$permiso = new permiso($_REQUEST['id']);
		$permiso->DesactivaPermiso();
	break;
	case 'verificarusuario':
			if($_REQUEST['username']!=''){
				$total=0;
				$username = $_REQUEST['username'];
				$usuario= new usuario(0,$username,'','','');
				$verificar=$usuario->VerficarDisponibilidadNomUsuario($username);
				$total=count($verificar);

				if($total != 0)
					echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><strong>Advertencia!</strong> Este usuario ya existe o es su actual nombre de usuario, para poder continuar intente con otro nombre.</div>';
				else
					echo '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><strong>Bien hecho!</strong> Nombre de usuario disponible.</div>';
			}
			else
				echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><strong>Advertencia!</strong> Se requiere de este campo para poder continuar.</div>';
	break;
	case 'ingresar':
			$user=new usuario(0,$_REQUEST['usuario'],$_REQUEST['pass'],0,0);
			$user->login();

			if($user->idusuario!=0){
				session_start();
				$_SESSION['idusuario']=$user->idusuario;
				header('Location:listlote.php');
			}

			else{
				session_start();
				if(isset($_SESSION['idusuario']));
				session_destroy();
				header('Location:index.php?success=0');
			}
	break;
	case 'verificarCorreo':
		$usuario = new usuario();
		if($usuario->disponibilidadCorreo($_POST['correo']))
			echo 1;
		else
			echo 0;
	break;
	case 'recuperapass':
			if($_REQUEST['email']!='')
			{
				$usuario = new usuario();
				$usuario->datosusuario->email=$_REQUEST['email'];
				$lista = $usuario->datosusuario->buscaremail();
				$total = count($lista);
				if($total > 0)
				{
					foreach($lista as $elementoCliente)
					{
						$idusuario = $elementoCliente['idusuario'];
						$correoRecu= new correoRecuperacion($idusuario);
						$correoRecu->enviar();
						echo 2;
					}
				}
				else
					echo 1;
			}
			else
				echo 0;
	break;
	case 'cerrarsesion':
			//session_start();
			if(isset($_SESSION['idusuario']));
			session_destroy();
			echo 1;
	break;

	//lotificación
	case 'modificarlotificacion':
		if(isset($_FILES['archivo']['name'][0])){
			if ($_FILES['archivo']['name'][0]!=''){
				$nameP=$_FILES['archivo']['name'];
				$tmpnameP=$_FILES['archivo']['tmp_name'];
			}
		}
		else{
			$nameP='';
			$tmpnameP='';
		}
		$categoria = new lote($_REQUEST['idlote'],$_REQUEST['lote'],$_REQUEST['metrosCuadrados'],$_REQUEST['precio'],$_REQUEST['status'],$nameP,$tmpnameP, $_REQUEST['enganche'], $_REQUEST['mensualidad'], $_REQUEST['meses'], $_REQUEST['interior'], $_REQUEST['terrazas'], $_REQUEST['cajones']);
		$categoria -> modificaLote();
		header('location: listlote.php?success=2');
	break;

    case 'cambiarStatusBatch':
	 	$batch = new lote($_REQUEST['b_id']);
	 	$batch -> updateStatusBatch($_REQUEST['b_status']);
	break;
	case 'listadoLotes':
		if($_REQUEST['lista'] == 'lotes'){
			$batch = new lote();
		}else{
			$batch = new lote2();
		}
		if($_REQUEST['status'] != ""){
			$batch->listaLoteStatus($_REQUEST['status']);
		}else{
			$resultados = $batch->listaLote();
			echo json_encode($resultados);
		}
	break;

	//img config
	case 'modificarconfigimg':
		$imgconfig = new imgconfig($_REQUEST['idconfiguracion'],$_REQUEST['altomaximo'],$_REQUEST['anchomaximo'],$_REQUEST['calidad']);
		$listimgconfig=$imgconfig->listarimgconfig();
		$contador=count($listimgconfig);
			 if($contador < 1){

				$imgconfig->insertarimgconfig();
			 }
			 else{
				$imgconfig->modificarimgconfig();
			 }

		header('location: formimgconfiguracion.php?success=2');
	 break;

}

?>
