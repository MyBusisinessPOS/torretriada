<?php
session_start();
function __autoload($nombre_clase) {
	//$nombre_clase = strtolower($nombre_clase);
    include 'clases/'.$nombre_clase .'.php';
}
//print_r($_REQUEST);
$operaciones=$_REQUEST['operaciones'];
switch($operaciones){
	///////////////////////////////////////////////
	///	ORDENAR ELEMENTOS
	///////////////////////////////////////////////
	case 'ordenar':
		if($_REQUEST['desde'] == 'portafolio'){
			$val = ($_REQUEST['idorden']);
			$val2 = array_reverse($val);
			$_initFor = $_REQUEST['initfor'];
			$_hastaFor = count($val2) + $_initFor - 1;
			$_index = 0;
			for($i = $_initFor; $i <= $_hastaFor; $i++)
			{
				$portafolio = new portafolio($val2[$_index]);
				$portafolio -> updateOrdenPortafolio($i);
				$_index++;
			}
		}
		if($_REQUEST['desde'] == 'slide'){
			$val = ($_REQUEST['idorden']);
			$val2 = array_reverse($val);
			$_initFor = $_REQUEST['initfor'];
			$_hastaFor = count($val2) + $_initFor - 1;
			$_index = 0;
			for($i = $_initFor; $i <= $_hastaFor; $i++)
			{
				$slide = new slide($val2[$_index]);
				$slide -> updateOrdenSlide($i);
				$_index++;
			}
		}
		if($_REQUEST['desde'] == 'manual'){
			$val = ($_REQUEST['idorden']);
			$val2 = array_reverse($val);
			$_initFor = $_REQUEST['initfor'];
			$_hastaFor = count($val2) + $_initFor - 1;
			$_index = 0;
			for($i = $_initFor; $i <= $_hastaFor; $i++)
			{
				$manual = new manual($val2[$_index]);
				$manual -> updateOrdenManual($i);
				$_index++;
			}
		}
		if($_REQUEST['desde'] == 'categoria'){
			$val = ($_REQUEST['idorden']);
			$val2 = array_reverse($val);
			$_initFor = $_REQUEST['initfor'];
			$_hastaFor = count($val2) + $_initFor - 1;
			$_index = 0;
			for($i = $_initFor; $i <= $_hastaFor; $i++)
			{
				$categoria = new categoria($val2[$_index]);
				$categoria -> updateOrdenCategoria($i);
				$_index++;
			}
		}
		if($_REQUEST['desde'] == 'equipo'){
			$val = ($_REQUEST['idorden']);
			$val2 = array_reverse($val);
			$_initFor = $_REQUEST['initfor'];
			$_hastaFor = count($val2) + $_initFor - 1;
			$_index = 0;
			for($i = $_initFor; $i <= $_hastaFor; $i++)
			{
				$equipo = new equipo($val2[$_index]);
				$equipo -> updateOrdenEquipo($i);
				$_index++;
			}
		}
		if($_REQUEST['desde'] == 'noticia'){
			$val = ($_REQUEST['idorden']);
			$val2 = array_reverse($val);
			for($i=0; $i < count($val2); $i++)
			{
				$noticia = new noticia($val2[$i]);
				$noticia -> ordenaNoticia($i);

			}
		}
		if($_REQUEST['desde'] == 'galeriaPortafolio'){
			$val = ($_REQUEST['idorden']);
			$val2 = array_reverse($val);
			for($i=0; $i < count($val2); $i++)
			{
				$portafolio = new portafolio();
				$portafolio -> modificarOrdenGaleria($val2[$i], $i);

			}
		}
		if($_REQUEST['desde'] == 'blog'){
			$val = ($_REQUEST['idorden']);
			$val2 = array_reverse($val);
			$_initFor = $_REQUEST['initfor'];
			$_hastaFor = count($val2) + $_initFor - 1;
			$_index = 0;
			for($i = $_initFor; $i <= $_hastaFor; $i++)
			{
				$blog = new blog($val2[$_index]);
				$blog -> updateOrdenBlog($i);
				$_index++;
			}
		}

		if($_REQUEST['desde'] == 'contenidoBlog'){
			$val = ($_REQUEST['idorden']);
			//$val2 = array_reverse($val);
			for($i=0; $i < count($val); $i++)
			{
				$blog = new blog();
				$blog -> modificarOrdenContenidoBlog($val[$i], $i);
			}
		}

		if($_REQUEST['desde'] == 'sucursal'){
			$val = ($_REQUEST['idorden']);
			$val2 = array_reverse($val);
			$_initFor = $_REQUEST['initfor'];
			$_hastaFor = count($val2) + $_initFor - 1;
			$_index = 0;
			for($i = $_initFor; $i <= $_hastaFor; $i++)
			{
				$sucursal = new sucursal($val2[$_index]);
				$sucursal -> updateOrdenSucursal($i);
				$_index++;
			}
		}
		if($_REQUEST['desde'] == 'vendido'){
			$val = ($_REQUEST['idorden']);
			$val2 = array_reverse($val);
			$_initFor = $_REQUEST['initfor'];
			$_hastaFor = count($val2) + $_initFor - 1;
			$_index = 0;
			for($i = $_initFor; $i <= $_hastaFor; $i++)
			{
				$vendido = new proyectosvendidos($val2[$_index]);
				$vendido -> updateOrdenVendido($i);
				$_index++;
			}
		}
	break;
/////////////////////////////////////////////////
/// CONROLADORES COMPRESION DE IMAGENES
/////////////////////////////////////////////////
 	case 'modificarconfigimg':
		$imgconfig = new imgConfig($_REQUEST['idconfiguracion'],$_REQUEST['altomaximo'],$_REQUEST['anchomaximo'],$_REQUEST['calidad'],$_REQUEST['prefijo']);
		$listimgconfig=$imgconfig->listarimgconfig();
		$contador=count($listimgconfig);
			 if($contador < 1){

				$imgconfig->insertarimgconfig();
			 }
			 else{
			 	$imgconfig->modificarimgconfig();
			 }

		header('location: formImgConfiguracion.php?success=2');
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
/* ============================
 * CRUD _BLOG
 * ============================ */
	case 'agregarblog':
		if($_FILES['archivo']['name'] != ''){
			$name = $_FILES['archivo']['name'];
			$tmp = $_FILES['archivo']['tmp_name'];
		}else{
			$name = '';
			$tmp = '';
		}

		$blog = new blog(0, $_REQUEST['idCategoria'], $name, $tmp);
		$blog -> addBlog();

		for($i = 0; $i < count($_REQUEST['sites']); $i++){
			$blog -> addBlogxPagina($_REQUEST['sites'][$i]);
		}

		for($i = 0; $i < count($_REQUEST['lang']); $i++){
			$_lang = $_REQUEST['lang'][$i];
			$_titulo = $_REQUEST['titulo'][$i];
			$_subtitulo = $_REQUEST['subtitulo'][$i];
			$_descripcion = $_REQUEST['descripcion'][$i];
			$_tags = $_REQUEST['tags'][$i];
			$blog ->  agregarDatosBlog($_titulo, $_subtitulo, $_descripcion, $_tags, $_lang);
		}

		if(isset($_REQUEST['temporal-id'])){
			for($i = 0; $i < count($_REQUEST['temporal-id']); $i++){
				$_temporalID = $_REQUEST['temporal-id'][$i];
				$_tipo = $_REQUEST['tipo-contenido'][$i];
				$_idContenidoBlog = $blog -> agregarContenidoBlog($_tipo);
				if($_tipo == 1){
					if($_REQUEST['descripcion-contenido-'.$_temporalID] != ''){
						$blog -> agregarTexto($_idContenidoBlog, $_REQUEST['descripcion-contenido-'.$_temporalID], $_REQUEST['descripcion-contenido-'.$_temporalID.'-en']);
					}
				}else if($_tipo == 2){
					if( $_FILES['img-contenido-'.$_temporalID]['name'] != ''){
						$blog -> agregarImagen($_idContenidoBlog, $_FILES['img-contenido-'.$_temporalID]['name'], $_FILES['img-contenido-'.$_temporalID]['tmp_name']);
					}
				}else if($_tipo == 3){
					if($_FILES['video-contenido-'.$_temporalID]['name'] != ''){
						$blog -> agregarVideo($_idContenidoBlog,$_REQUEST['url-contenido-'.$_temporalID],$_FILES['video-contenido-'.$_temporalID]['name'],$_FILES['video-contenido-'.$_temporalID]['tmp_name']);
					}

				}else if($_tipo == 4){
					if(isset($_FILES['galeria-contenido-'.$_temporalID])){
						for($t = 0; $t < count($_FILES['galeria-contenido-'.$_temporalID]); $t++){
							if($_FILES['galeria-contenido-'.$_temporalID]['name'][$t] != ''){
								$_name = $_FILES['galeria-contenido-'.$_temporalID]['name'][$t];
								$_tmp = $_FILES['galeria-contenido-'.$_temporalID]['tmp_name'][$t];
								$blog -> insertarGaleriaContenido($_idContenidoBlog, $_name, $_tmp);
							}
						}
					}
				}

			}
		}

		header('Location: listBlog.php?success=1');
	break;
	case 'modificarblog':
		if($_FILES['archivo']['name'] != ''){
			$name = $_FILES['archivo']['name'];
			$tmp = $_FILES['archivo']['tmp_name'];
		}else{
			$name = '';
			$tmp = '';
		}
		$blog = new blog($_REQUEST['idBlog'], $_REQUEST['idCategoria'], $name, $tmp);
		$blog -> updateBlog();

		$blog -> removeBlogxPagina();
		for($i = 0; $i < count($_REQUEST['sites']); $i++){
			$blog -> addBlogxPagina($_REQUEST['sites'][$i]);
		}

		for($i = 0; $i < count($_REQUEST['lang']); $i++){
			$_lang = $_REQUEST['lang'][$i];
			$_titulo = $_REQUEST['titulo'][$i];
			$_subtitulo = $_REQUEST['subtitulo'][$i];
			$_descripcion = $_REQUEST['descripcion'][$i];
			$_tags = $_REQUEST['tags'][$i];
			$blog ->  modificarDatosBlog($_titulo, $_subtitulo, $_descripcion, $_tags, $_lang);
		}

		if(isset($_REQUEST['temporal-id'])){
			for($i = 0; $i < count($_REQUEST['temporal-id']); $i++){
				$_temporalID = $_REQUEST['temporal-id'][$i];
				$_tipo = $_REQUEST['tipo-contenido'][$i];
				$_idContenidoBlog = $blog -> agregarContenidoBlog($_tipo);
				if($_tipo == 1){
					if($_REQUEST['descripcion-contenido-'.$_temporalID] != ''){
						$blog -> agregarTexto($_idContenidoBlog, $_REQUEST['descripcion-contenido-'.$_temporalID], $_REQUEST['descripcion-contenido-'.$_temporalID.'-en']);
					}
				}else if($_tipo == 2){
					if( $_FILES['img-contenido-'.$_temporalID]['name'] != ''){
						$blog -> agregarImagen($_idContenidoBlog, $_FILES['img-contenido-'.$_temporalID]['name'], $_FILES['img-contenido-'.$_temporalID]['tmp_name']);
					}
				}else if($_tipo == 3){
					if($_FILES['video-contenido-'.$_temporalID]['name'] != ''){
						$blog -> agregarVideo($_idContenidoBlog,$_REQUEST['url-contenido-'.$_temporalID],$_FILES['video-contenido-'.$_temporalID]['name'],$_FILES['video-contenido-'.$_temporalID]['tmp_name']);
					}

				}else if($_tipo == 4){
					if(isset($_FILES['galeria-contenido-'.$_temporalID])){
						for($t = 0; $t < count($_FILES['galeria-contenido-'.$_temporalID]); $t++){
							if($_FILES['galeria-contenido-'.$_temporalID]['name'][$t] != ''){
								$_name = $_FILES['galeria-contenido-'.$_temporalID]['name'][$t];
								$_tmp = $_FILES['galeria-contenido-'.$_temporalID]['tmp_name'][$t];
								$blog -> insertarGaleriaContenido($_idContenidoBlog, $_name, $_tmp);
							}
						}
					}
				}

			}
		}

		if(isset($_REQUEST['temporal-id-mod'])){
			for($i = 0; $i < count($_REQUEST['temporal-id-mod']); $i++){
				$_temporalID = $_REQUEST['temporal-id-mod'][$i];
				$_tipo = $_REQUEST['tipo-contenido-mod'][$i];
				//$_idContenidoBlog = $blog -> agregarContenidoBlog($_tipo);
				if($_tipo == 1){
					if($_REQUEST['descripcion-contenido-mod-'.$_temporalID] != ''){
						$blog -> agregarTexto($_temporalID, $_REQUEST['descripcion-contenido-mod-'.$_temporalID], $_REQUEST['descripcion-contenido-mod-'.$_temporalID.'-en']);
					}
				}else if($_tipo == 2){
					if( $_FILES['img-contenido-mod-'.$_temporalID]['name'] != ''){
						$blog -> agregarImagen($_temporalID, $_FILES['img-contenido-mod-'.$_temporalID]['name'], $_FILES['img-contenido-mod-'.$_temporalID]['tmp_name']);
					}
				}else if($_tipo == 3){
					if($_FILES['video-contenido-mod-'.$_temporalID]['name'] != ''){
						$blog -> agregarVideo($_temporalID,$_REQUEST['url-contenido-mod-'.$_temporalID],$_FILES['video-contenido-mod-'.$_temporalID]['name'],$_FILES['video-contenido-mod-'.$_temporalID]['tmp_name']);
					}else{
						$blog -> agregarVideo($_temporalID,$_REQUEST['url-contenido-mod-'.$_temporalID],'','');
					}

				}else if($_tipo == 4){
					if(isset($_FILES['galeria-contenido-mod-'.$_temporalID])){
						for($t = 0; $t < count($_FILES['galeria-contenido-mod-'.$_temporalID]); $t++){
							if($_FILES['galeria-contenido-mod-'.$_temporalID]['name'][$t] != ''){
								$_name = $_FILES['galeria-contenido-mod-'.$_temporalID]['name'][$t];
								$_tmp = $_FILES['galeria-contenido-mod-'.$_temporalID]['tmp_name'][$t];
								$blog -> insertarGaleriaContenido($_temporalID, $_name, $_tmp);
							}
						}
					}

					if(isset($_FILES['img-galeria-mod-'.$_temporalID])){
						for($c = 0; $c < count($_FILES['img-galeria-mod-'.$_temporalID]['name']); $c++){
							if($_FILES['img-galeria-mod-'.$_temporalID]['name'][$c] != ''){
								$_name = $_FILES['img-galeria-mod-'.$_temporalID]['name'][$c];
								$_tmp = $_FILES['img-galeria-mod-'.$_temporalID]['tmp_name'][$c];
								$_idGaleriaContenido = $_REQUEST['idGaleriaContenido-'.$_temporalID][$c];
								$blog -> modGaleriaContenido($_idGaleriaContenido, $_name, $_tmp);
							}
						}
					}
				}

			}
		}



		header('Location: listBlog.php?success=2');
	break;
	case 'operablog':
		if(isset($_REQUEST['idBlog'])){
			$select=$_REQUEST['operador'];
			if ($select == 'Eliminar'){
				foreach ($_REQUEST['idBlog'] as $elemento) {
					$blog = new blog($elemento);
					$blog -> listarContenidoBlog();
					foreach ($blog -> _contenidoBlog as $_g) {
						$_galeria = $blog -> listarGaleriaContenido($_g['idContenidoBlog']);
						if(count($_galeria) > 0){
							foreach ($_galeria as $_gal) {
								$blog -> delGaleriaContenido($_gal['idGaleriaContenido']);
							}
						}
						$blog -> eliminarContenidoBlog($_g['idContenidoBlog']);
					}
					$blog -> eliminarDatosBlog();
					$blog -> deleteBlog();
				}
				header('location: listBlog.php?success=3');
			}
			if ($select == 'Mostrar'){
				foreach ($_REQUEST['idBlog'] as $elemento) {
					$blog = new blog($elemento);
					$blog -> updateStatusBlog(1);
				}
				header('location: listBlog.php?success=4');
			}
			if ($select == 'No Mostrar'){
				foreach ($_REQUEST['idBlog'] as $elemento) {
					$blog = new blog($elemento);
					$blog -> updateStatusBlog(0);
				}
				header('location: listBlog.php?success=5');
			}
		}else {
			header('location: listBlog.php?success=0');
		}
	break;
	case 'listarBlog':
		$herramientas = new herramientas();
		$temporal = new blog();
		($_REQUEST['registrosPorPagina'] != '-1') ? $_rpp = $_REQUEST['registrosPorPagina'] : $_rpp = 20;
		//$_API = false, $_idSite = 0, $_pagina = 1, $_paginador = true, $_idCategoria = '', $_status = '', $_busqueda = '', $_tags = '', $_registrosPorPagina = 20, $_frontEnd = true, $_lang = 'ES'
		$listaTemporal = $temporal -> listBlog($_REQUEST['pagina'], true, 0, '',$_REQUEST['cadena']);
		($_REQUEST['permisoSortable'] != 0) ? $handle = '<span class="fa-stack fa-1x mover handle"><i class="fa fa-circle fa-stack-2x"></i><i class="fa fa-arrows fa-stack-1x fa-inverse"></i></span>' : $handle = '';
		foreach($listaTemporal as $elementoTemporal){
			if($_REQUEST['permisoAcDc'] == 0){
				if($elementoTemporal['status']!=0){
					$img='img/visible.png';
					$funcion='';
					$class = 'nover';
				}else{
					$img='img/invisible.png';
					$funcion='';
					$class = 'ver';
				}
			}else{
				if($elementoTemporal['status']!=0){
					$img='img/visible.png';
					$funcion='changeStatusBlog('.$elementoTemporal['id_blog'].',0,\'changeStatusBlog\')';
					$class = 'nover';
				}else{
					$img='img/invisible.png';
					$funcion='changeStatusBlog('.$elementoTemporal['id_blog'].',1,\'changeStatusBlog\')';
					$class = 'ver';
				}
			}
			$tabla .= ' <tr>
				            <td>
				                <input type="hidden" name="idorden" class="idorden" value="'.$elementoTemporal['id_blog'].'">
				                <input type="checkbox" id="'.$elementoTemporal['id_blog'].'" name="id_blog[]" value="'.$elementoTemporal['id_blog'].'">
								<label for="'.$elementoTemporal['id_blog'].'"><span></span></label>
				            </td>
				            <td>
				                <a href="formBlog.php?id_blog='.$elementoTemporal['id_blog'].'"><img class="img-responsive" src="../img/blog/'.$elementoTemporal['ruta'].'"></a>
				            </td>
				            <td>
				            	<a href="formBlog.php?id_blog='.$elementoTemporal['id_blog'].'">
				                	'.$elementoTemporal['titulo'].'
				            	</a>
				            </td>
				            <td>'.$elementoTemporal['fecha_creacion'].'</td>
				            <td class="text-center">
				                '.$handle.'
				                <img class="manita '.$class.'" onclick="'.$funcion.'" id="temp'.$elementoTemporal['id_blog'].'" src="'.$img.'">
				            </td>
				        </tr>';
		}
		$_lastPage = count($listaTemporal)-1;
		$_de = $listaTemporal[$_lastPage]['orden'];

		$htmlpaginador = $herramientas -> paginador($listaTemporal[0]['ultimapagina'], $listaTemporal[0]['pagina'], $listaTemporal[0]['paginaanterior'], $listaTemporal[0]['paginasiguiente'], 4);
		$htmlpaginador .= '<input type="hidden" id="initfor" value="'.$_de.'">';
		$arrayJson = Array (
			0 => Array ( "tabla" => $tabla, "paginador" => $htmlpaginador)
		);
		echo json_encode($arrayJson);
	break;
	case 'changeStatusBlog':
		$blog = new blog($_REQUEST['id']);
		$blog -> updateStatusBlog($_REQUEST['status']);
	break;
	case 'deleteContenidoBlog':
		$blog = new blog();
		$_galeria = $blog -> listarGaleriaContenido($_REQUEST['id']);
		if(count($_galeria)){
			foreach ($_galeria as $_gal) {
				$blog -> delGaleriaContenido($_gal['idGaleriaContenido']);
			}
		}
		$blog -> eliminarContenidoBlog($_REQUEST['id']);
	break;
	case 'deleteGaleriaContenido':
		$blog = new blog();
		$blog -> delGaleriaContenido($_REQUEST['id']);
	break;
/* ============================
 * CRUD _PORTAFOLIO
 * ============================ */
	case 'agregarportafolio':
		$portafolio = new portafolio($_REQUEST['idPortafolio'], $_REQUEST['tipo'], $_FILES['imagen']['name'], $_FILES['imagen']['tmp_name']);
		$portafolio -> addPortafolio();
		for($i = 0; $i < count($_REQUEST['titulo']); $i++){
			$portafolio -> agregarDatosPortafolio($_REQUEST['titulo'][$i], $_REQUEST['marca'][$i], $_REQUEST['descripcion'][$i], $_REQUEST['lang'][$i], $_REQUEST['descripcion2'][$i]);
		}

		if(isset($_FILES['fichaTecnicaEs']['name']) AND $_FILES['fichaTecnicaEs']['name'] != ''){
			$portafolio -> addFichaTecnica($_FILES['fichaTecnicaEs']['name'], $_FILES['fichaTecnicaEs']['tmp_name'],'es');
		}

		if(isset($_FILES['fichaTecnicaEn']['name']) AND $_FILES['fichaTecnicaEn']['name'] != ''){
			$portafolio -> addFichaTecnica($_FILES['fichaTecnicaEn']['name'], $_FILES['fichaTecnicaEn']['tmp_name'],'en');
		}

		if(isset($_FILES['archivoEs']['name']) AND $_FILES['archivoEs']['name'] != ''){
			$portafolio -> addArchivo($_FILES['archivoEs']['name'], $_FILES['archivoEs']['tmp_name'],'es');
		}
		if(isset($_FILES['archivoEn']['name']) AND $_FILES['archivoEn']['name'] != ''){
			$portafolio -> addArchivo($_FILES['archivoEn']['name'], $_FILES['archivoEn']['tmp_name'],'en');
		}

		if(isset($_FILES['galeria']['name'])){
			for($i = 0; $i < count($_FILES['galeria']['name']); $i++){
				if($_FILES['galeria']['name'][$i] != ''){
					$_name = $_FILES['galeria']['name'][$i];
					$_tmp = $_FILES['galeria']['tmp_name'][$i];
					$portafolio -> agregarGaleria($_name, 'galeria', $_tmp);
				}
			}
		}
		if(isset($_REQUEST['categorias'])){
			for($c = 0; $c < count($_REQUEST['categorias']);  $c++){
				if($_REQUEST['categorias'][$c] != ''){
					if($_REQUEST['tipo']==2){
						$portafolio -> updateAnio($_REQUEST['categorias'][$c]);
					}else{
						$portafolio -> agregarCategoriaxPortafolio($_REQUEST['categorias'][$c],2);
					}
				}
			}
		}

		if(isset($_REQUEST['categoriasC'])){
			for($c = 0; $c < count($_REQUEST['categoriasC']);  $c++){
				if($_REQUEST['categoriasC'][$c] != ''){
					$portafolio -> agregarCategoriaxPortafolio($_REQUEST['categoriasC'][$c],4);
				}
			}
		}
		if($_REQUEST['tipo']==1){
			if(isset($_REQUEST['selectfamilias'])){
				foreach ($_REQUEST['selectfamilias'] as $f) {
					$portafolioxcat = new portafolioxcategoria($portafolio -> _idPortafolio,$f);
					$portafolioxcat -> addPortafolioxCategoria(1);
				}
			}
			if(isset($_REQUEST['selectcategorias'])){
				foreach ($_REQUEST['selectcategorias'] as $c) {
					$portafolioxcat = new portafolioxcategoria($portafolio -> _idPortafolio,$c);
					$portafolioxcat -> addPortafolioxCategoria(5);
				}
			}
			if(isset($_REQUEST['selectsubcategorias'])){
				foreach ($_REQUEST['selectsubcategorias'] as $s) {
					$portafolioxcat = new portafolioxcategoria($portafolio -> _idPortafolio,$s);
					$portafolioxcat -> addPortafolioxCategoria(6);
				}
			}
		}
		header('Location: listPortafolio.php?success=1&tipo='.$_REQUEST['tipo']);
	break;
	case 'modificarportafolio':
		if($_FILES['imagen']['name'] != ''){
			$_name = $_FILES['imagen']['name'];
			$_tmp = $_FILES['imagen']['tmp_name'];
		}else{
			$_name = '';
			$_tmp = '';
		}
		$portafolio = new portafolio($_REQUEST['idPortafolio'], $_REQUEST['tipo'], $_name, $_tmp);

		$portafolio -> updatePortafolio();

		for($i = 0; $i < count($_REQUEST['titulo']); $i++){
			$portafolio -> modificarDatosPortafolio($_REQUEST['titulo'][$i], $_REQUEST['marca'][$i], $_REQUEST['descripcion'][$i], $_REQUEST['lang'][$i], $_REQUEST['descripcion2'][$i]);
		}

		if(isset($_FILES['fichaTecnicaEs']['name']) AND $_FILES['fichaTecnicaEs']['name'] != ''){
			$portafolio -> addFichaTecnica($_FILES['fichaTecnicaEs']['name'], $_FILES['fichaTecnicaEs']['tmp_name'],'es');
		}

		if(isset($_FILES['fichaTecnicaEn']['name']) AND $_FILES['fichaTecnicaEn']['name'] != ''){
			$portafolio -> addFichaTecnica($_FILES['fichaTecnicaEn']['name'], $_FILES['fichaTecnicaEn']['tmp_name'],'en');
		}

		if(isset($_FILES['archivoEs']['name']) AND $_FILES['archivoEs']['name'] != ''){
			$portafolio -> addArchivo($_FILES['archivoEs']['name'], $_FILES['archivoEs']['tmp_name'],'es');
		}
		if(isset($_FILES['archivoEn']['name']) AND $_FILES['archivoEn']['name'] != ''){
			$portafolio -> addArchivo($_FILES['archivoEn']['name'], $_FILES['archivoEn']['tmp_name'],'en');
		}

		if(isset($_FILES['galeria']['name'])){
			for($i = 0; $i < count($_FILES['galeria']['name']); $i++){
				if($_FILES['galeria']['name'][$i] != ''){
					$_name = $_FILES['galeria']['name'][$i];
					$_tmp = $_FILES['galeria']['tmp_name'][$i];
					$portafolio -> agregarGaleria($_name, 'galeria', $_tmp);
				}
			}
		}

		if(isset($_FILES['galeriaMod']['name'])){
			for($i = 0; $i < count($_FILES['galeriaMod']['name']); $i++){
				if($_FILES['galeriaMod']['name'][$i] != ''){
					$_name = $_FILES['galeriaMod']['name'][$i];
					$_tmp = $_FILES['galeriaMod']['tmp_name'][$i];
					$portafolio -> modificarGaleria($_REQUEST['idGaleria'][$i],$_name, $_tmp);
				}
			}
		}

		if(isset($_REQUEST['categorias'])){
			$portafolio -> removerCategoriaxPortafolio(2);
			for($c = 0; $c < count($_REQUEST['categorias']);  $c++){
				if($_REQUEST['tipo']==2){
						$portafolio -> updateAnio($_REQUEST['categorias'][$c]);
					}else{
						$portafolio -> agregarCategoriaxPortafolio($_REQUEST['categorias'][$c],2);
					}
			}
		}
		if(isset($_REQUEST['categoriasC'])){
			$portafolio -> removerCategoriaxPortafolio(4);
			for($c = 0; $c < count($_REQUEST['categoriasC']);  $c++){
				if($_REQUEST['categoriasC'][$c] != ''){
					$portafolio -> agregarCategoriaxPortafolio($_REQUEST['categoriasC'][$c],4);
				}
			}
		}
		if($_REQUEST['tipo']==1){
			$delCats = new portafolioxcategoria($_REQUEST['idPortafolio']);
			$delCats -> delCatxPortafolio();
			if(isset($_REQUEST['selectfamilias'])){
				foreach ($_REQUEST['selectfamilias'] as $f) {
					$portafolioxcat = new portafolioxcategoria($_REQUEST['idPortafolio'],0,$f);
					$portafolioxcat -> addPortafolioxCategoria(1);
				}
			}
			if(isset($_REQUEST['selectcategorias'])){
				foreach ($_REQUEST['selectcategorias'] as $c) {
					$idCat = explode('.',$c);
					$portafolioxcat = new portafolioxcategoria($_REQUEST['idPortafolio'],$idCat[1],$idCat[0]);
					$portafolioxcat -> addPortafolioxCategoria(5);
				}
			}
			if(isset($_REQUEST['selectsubcategorias'])){
				foreach ($_REQUEST['selectsubcategorias'] as $s) {
					$idSub = explode('.',$s);
					$portafolioxcat = new portafolioxcategoria($_REQUEST['idPortafolio'],$idSub[1],$idSub[0],$idSub[2]);
					$portafolioxcat -> addPortafolioxCategoria(6);
				}
			}
		}
		header('location: listPortafolio.php?success=2&tipo='.$_REQUEST['tipo']);
	break;
	case 'operaportafolio':
		if(isset($_REQUEST['idPortafolio'])){
			$select=$_REQUEST['operador'];
			if ($select == 'Eliminar'){
				foreach ($_REQUEST['idPortafolio'] as $elemento) {
					$portafolio = new portafolio($elemento);
					$portafolio -> deletePortafolio();
				}
				header('location: listPortafolio.php?success=3&tipo='.$_REQUEST['tipo']);
			}
			if ($select == 'Activar'){
				foreach ($_REQUEST['idPortafolio'] as $elemento) {
					$portafolio = new portafolio($elemento);
					$portafolio -> updateStatusPortafolio(1);
				}
				header('location: listPortafolio.php?success=4&tipo='.$_REQUEST['tipo']);
			}
			if ($select == 'Desactivar'){
				foreach ($_REQUEST['idPortafolio'] as $elemento) {
					$portafolio = new portafolio($elemento);
					$portafolio -> updateStatusPortafolio(0);
				}
				header('location: listPortafolio.php?success=5&tipo='.$_REQUEST['tipo']);
			}
		}else {
			header('location: listPortafolio.php?success=0&tipo='.$_REQUEST['tipo']);
		}
	break;
	case 'listarPortafolio':
		$herramientas = new herramientas();
		$temporal = new portafolio();
		($_REQUEST['registrosPorPagina'] != '-1') ? $_rpp = $_REQUEST['registrosPorPagina'] : $_rpp = 20;
		$listaTemporal = $temporal -> listPortafolio($_REQUEST['tipo'], $_REQUEST['pagina'], true, '', $_REQUEST['cadena'], $_rpp);
		($_REQUEST['permisoSortable'] != 0) ? $handle = '<span class="fa-stack fa-1x mover handle"><i class="fa fa-circle fa-stack-2x"></i><i class="fa fa-arrows fa-stack-1x fa-inverse"></i></span>' : $handle = '';
		foreach($listaTemporal as $elementoTemporal){
			if($_REQUEST['permisoAcDc'] == 0){
				if($elementoTemporal['status']!=0){
					$img='img/visible.png';
					$funcion='';
					$class = 'nover';
				}else{
					$img='img/invisible.png';
					$funcion='';
					$class = 'ver';
				}
			}else{
				if($elementoTemporal['status']!=0){
					$img='img/visible.png';
					$funcion='changeStatus('.$elementoTemporal['idPortafolio'].',0,\'changeStatusPortafolio\')';
					$class = 'nover';
				}else{
					$img='img/invisible.png';
					$funcion='changeStatus('.$elementoTemporal['idPortafolio'].',1,\'changeStatusPortafolio\')';
					$class = 'ver';
				}
			}

			if($elementoTemporal['destacado'] != 0){
				$_fa = 'fa-toggle-on';
				$_funcion = 'changeDestacado('.$elementoTemporal['idPortafolio'].',0,\'changeDestacadoPortafolio\')';
			}else{
				$_fa = 'fa-toggle-off';
				$_funcion = 'changeDestacado('.$elementoTemporal['idPortafolio'].',1,\'changeDestacadoPortafolio\')';
			}
			$tabla .= ' <tr>
				            <td>
				                <input type="hidden" name="idorden" class="idorden" value="'.$elementoTemporal['idPortafolio'].'">
				                <input type="checkbox" id="'.$elementoTemporal['idPortafolio'].'" name="idPortafolio[]" value="'.$elementoTemporal['idPortafolio'].'">
								<label for="'.$elementoTemporal['idPortafolio'].'"><span></span></label>
				            </td>
				            <td>
				                <a href="formPortafolio.php?idPortafolio='.$elementoTemporal['idPortafolio'].'&tipo='.$_REQUEST['tipo'].'">
				                	<img src="../img/portafolio/'.$elementoTemporal['imgPortada'].'" class="img-responsive">
				                </a>
				            </td>
				            <td>
				                <a href="formPortafolio.php?idPortafolio='.$elementoTemporal['idPortafolio'].'&tipo='.$_REQUEST['tipo'].'">
				                    '.$elementoTemporal['titulo'].'
				                </a>
				            </td>
				            <td class="text-center">
				            	'.$handle.'
				                <img class="manita '.$class.'" onclick="'.$funcion.'" id="temp'.$elementoTemporal['idPortafolio'].'" src="'.$img.'">
				            </td>
				        </tr>';
		}
		$_lastPage = count($listaTemporal)-1;
		$_de = $listaTemporal[$_lastPage]['orden'];

		$htmlpaginador = $herramientas -> paginador($listaTemporal[0]['ultimapagina'], $listaTemporal[0]['pagina'], $listaTemporal[0]['paginaanterior'], $listaTemporal[0]['paginasiguiente'], 4);
		$htmlpaginador .= '<input type="hidden" id="initfor" value="'.$_de.'">';
		$arrayJson = Array (
			0 => Array ( "tabla" => $tabla, "paginador" => $htmlpaginador)
		);
		echo json_encode($arrayJson);
	break;
	case 'changeStatusPortafolio':
	 	$portafolio = new portafolio($_REQUEST['id']);
		$portafolio -> updateStatusPortafolio($_REQUEST['status']);
	break;
	case 'changeDestacadoPortafolio':
	 	$portafolio = new portafolio($_REQUEST['id']);
		$portafolio -> updateDestacadoPortafolio($_REQUEST['status']);
		echo 1;
	break;
	case 'deleteGaleriaLB':
		$portafolio = new portafolio();
		$portafolio -> eliminarGaleria($_REQUEST['id']);
	break;
/* ============================
 * CRUD _CATEGORIA
 * ============================ */
	case 'agregarcategoria':
		$categoria = new categoria(0, $_REQUEST['tituloEs'], $_REQUEST['tituloEn'], $_REQUEST['tipo']);
		$categoria -> addCategoria();
		if($_REQUEST['tipo']==1 OR $_REQUEST['tipo']==5 OR $_REQUEST['tipo']==6){
			$categoria -> updateIconoCategoria($_FILES['imagen']['name'],$_FILES['imagen']['tmp_name'],1);
			if($_REQUEST['tipo']==5 OR $_REQUEST['tipo']==6){
				$categoria -> updateIconoCategoria($_FILES['imagen2']['name'],$_FILES['imagen2']['tmp_name'],2);
			}
		}
		if(isset($_REQUEST['categorias'])){
			if($_REQUEST['tipo']==1){
				$tipo=5;
			}else if($_REQUEST['tipo']==5){
				$tipo=6;
			}else{$tipo=0;}
			foreach ($_REQUEST['categorias'] as $c) {
				$categoria -> addCategoriasxCategoria($c,$tipo);
			}
		}
		header('Location: listCategoria.php?success=1&tipo='.$_REQUEST['tipo']);
	break;
	case 'modificarcategoria':

		$categoria = new categoria($_REQUEST['id'], $_REQUEST['tituloEs'], $_REQUEST['tituloEn']);
		$categoria -> updateCategoria();
		if($_REQUEST['tipo']==1 OR $_REQUEST['tipo']==5 OR $_REQUEST['tipo']==6){
			//echo '<pre>';
			//print_r($_FILES);
			//echo '</pre>';
			if($_FILES['imagen']['name']!=''){
				$categoria -> updateIconoCategoria($_FILES['imagen']['name'],$_FILES['imagen']['tmp_name'],1);
			}
			if($_FILES['imagen2']['name']!=''){
				$categoria -> updateIconoCategoria($_FILES['imagen2']['name'],$_FILES['imagen2']['tmp_name'],2);
			}
		}

		if($_REQUEST['categorias']){
			$categoria -> delCategoriasxCategoria();
			if($_REQUEST['tipo']==1){
				$tipo=5;
			}else if($_REQUEST['tipo']==5){
				$tipo=6;
			}else{$tipo=0;}
			foreach ($_REQUEST['categorias'] as $c){
				$categoria -> addCategoriasxCategoria($c,$tipo);
			}
		}else{
			$categoria -> delCategoriasxCategoria();
		}
		header('Location: listCategoria.php?success=2&tipo='.$_REQUEST['tipo']);
	break;
	case 'operacategoria':
		if(isset($_REQUEST['idCategoria'])){
			$select=$_REQUEST['operador'];
			if ($select == 'Eliminar'){
				foreach ($_REQUEST['idCategoria'] as $elemento) {
					$categoria = new categoria($elemento);
					$categoria -> deleteCategoria();
				}
				header('location: listCategoria.php?success=3&tipo='.$_REQUEST['tipo']);
			}
			if ($select == 'Activar'){
				foreach ($_REQUEST['idCategoria'] as $elemento) {
					$categoria = new categoria($elemento);
					$categoria -> updateStatusCategoria(1);
				}
				header('location: listCategoria.php?success=4&tipo='.$_REQUEST['tipo']);
			}
			if ($select == 'Desactivar'){
				foreach ($_REQUEST['idCategoria'] as $elemento) {
					$categoria = new categoria($elemento);
					$categoria -> updateStatusCategoria(0);
				}
				header('location: listCategoria.php?success=5&tipo='.$_REQUEST['tipo']);
			}
		}else {
			header('location: listCategoria.php?success=0&tipo='.$_REQUEST['tipo']);
		}
	break;
	case 'changeStatusCategoria':
		$categoria = new categoria($_REQUEST['id']);
		$categoria -> updateStatusCategoria($_REQUEST['status']);
	break;
	case 'modificarCatalogo':
		if($_FILES['catalogo']['name'] != ''){
			$_name = $_FILES['catalogo']['name'];
			$_tmp = $_FILES['catalogo']['tmp_name'];
		}else{
			$_name = '';
			$_tmp = '';
		}
		$_catalogo = new catalogo(1,$_name, $_tmp);
		//var_dump($_catalogo);
		$_catalogo -> updateCatalogo();
		header('location: listPortafolio.php?success=2&tipo=1');
	break;
/* ============================
 * CRUD _SLIDE
 * ============================ */
	case 'agregarslide':
		$slide = new slide(0, $_FILES['imagen']['name'], $_FILES['imagen']['tmp_name'], $_REQUEST['tipo']);
		$slide -> addSlide();
		if($_FILES['imagenMovil']['name'] != '')
			$slide -> updateImgMovil($_FILES['imagenMovil']['name'], $_FILES['imagenMovil']['tmp_name']);
		foreach ($_REQUEST['titulo'] as $_lang => $_titulo) {
			$slide -> addDatosSlide($_titulo, $_REQUEST['subtitulo'][$_lang],  $_REQUEST['subtitulo2'][$_lang],  $_REQUEST['subtitulo3'][$_lang],  $_REQUEST['link'][$_lang], $_REQUEST['linkVideo'][$_lang], $_lang);
		}
		header('location: listSlide.php?success=1&tipo='.$_REQUEST['tipo'].'');
	break;
	case 'modificarslide':
		if($_FILES['imagen']['name'] != ''){
			$_name = $_FILES['imagen']['name'];
			$_tmp = $_FILES['imagen']['tmp_name'];
		}else{
			$_name = '';
			$_tmp = '';
		}
		$slide = new slide($_REQUEST['id'], $_name, $_tmp);
		$slide -> updateSlide();
		if($_FILES['imagenMovil']['name'] != '')
			$slide -> updateImgMovil($_FILES['imagenMovil']['name'], $_FILES['imagenMovil']['tmp_name']);

		foreach ($_REQUEST['titulo'] as $_lang => $_titulo) {
			$slide -> updateDatosSlide($_titulo, $_REQUEST['subtitulo'][$_lang],  $_REQUEST['subtitulo2'][$_lang],  $_REQUEST['subtitulo3'][$_lang],  $_REQUEST['link'][$_lang], $_REQUEST['linkVideo'][$_lang], $_lang);
		}
		header('location: listSlide.php?success=2&tipo='.$_REQUEST['tipo'].'');
	break;
	case 'operaslide':
		if(isset($_REQUEST['idSlide'])){
			$select=$_REQUEST['operador'];
			if ($select == 'Eliminar'){
				foreach ($_REQUEST['idSlide'] as $elemento) {
					$slide = new slide($elemento);
					$slide -> deleteSlide();
				}
				header('location: listSlide.php?success=3&tipo='.$_REQUEST['tipo'].'');
			}
			if ($select == 'Activar'){
				foreach ($_REQUEST['idSlide'] as $elemento) {
					$slide = new slide($elemento);
					$slide -> updateStatusSlide(1);
				}
				header('location: listSlide.php?success=4&tipo='.$_REQUEST['tipo'].'');
			}
			if ($select == 'Desactivar'){
				foreach ($_REQUEST['idSlide'] as $elemento) {
					$slide = new slide($elemento);
					$slide -> updateStatusSlide(0);
				}
				header('location: listSlide.php?success=5&tipo='.$_REQUEST['tipo'].'');
			}
		}else {
			header('location: listSlide.php?success=0&tipo='.$_REQUEST['tipo'].'');
		}
	break;
	case 'changeStatusSlide':
		$slide = new slide($_REQUEST['id']);
		$slide -> updateStatusSlide($_REQUEST['status']);
	break;
/* ============================
 * CRUD _SLIDE
 * ============================ */
	case 'agregarmanual':
		$manual = new manual(0,$_REQUEST['idCategoria'], $_REQUEST['tipo'], $_FILES['imagen']['name'], $_FILES['imagen']['tmp_name']);
		$manual -> addManual();
		if($_FILES['manualEs']['name'] != '')
			$manual -> updateManualFile($_FILES['manualEs']['name'], $_FILES['manualEs']['tmp_name'], 'es');
		if($_FILES['manualEn']['name'] != '')
			$manual -> updateManualFile($_FILES['manualEn']['name'], $_FILES['manualEn']['tmp_name'], 'en');
		$_link = $_REQUEST['link'];
		foreach ($_REQUEST['titulo'] as $_lang => $_titulo) {
			$manual -> addDatosManual($_titulo, $_REQUEST['descripcion'][$_lang], $_link, $_lang);
		}
		header('location: listManual.php?success=1&tipo='.$_REQUEST['tipo']);
	break;
	case 'modificarmanual':
		//echo '<pre>';
		//print_r($_REQUEST);
		//echo '</pre>';
		if($_FILES['imagen']['name'] != ''){
			$_name = $_FILES['imagen']['name'];
			$_tmp = $_FILES['imagen']['tmp_name'];
		}else{
			$_name = '';
			$_tmp = '';
		}
		$manual = new manual($_REQUEST['id'],$_REQUEST['idCategoria'], $_REQUEST['tipo'], $_name, $_tmp);
		$manual -> updateManual();
		$manual -> updateCategoriaManual();
		if($_FILES['manualEs']['name'] != '')
			$manual -> updateManualFile($_FILES['manualEs']['name'], $_FILES['manualEs']['tmp_name'], 'es');
		if($_FILES['manualEn']['name'] != '')
			$manual -> updateManualFile($_FILES['manualEn']['name'], $_FILES['manualEn']['tmp_name'], 'en');
		foreach ($_REQUEST['titulo'] as $_lang => $_titulo) {
			$manual -> updateDatosManual($_titulo, $_REQUEST['descripcion'][$_lang], $_REQUEST['link'][$_lang], $_lang);
		}
		header('location: listManual.php?success=2&tipo='.$_REQUEST['tipo']);
	break;
	case 'operamanual':
		if(isset($_REQUEST['idManual'])){
			$select=$_REQUEST['operador'];
			if ($select == 'Eliminar'){
				foreach ($_REQUEST['idManual'] as $elemento) {
					$manual = new manual($elemento);
					$manual -> deleteManual();
				}
				header('location: listManual.php?success=3&tipo='.$_REQUEST['tipo']);
			}
			if ($select == 'Activar'){
				foreach ($_REQUEST['idManual'] as $elemento) {
					$manual = new manual($elemento);
					$manual -> updateStatusManual(1);
				}
				header('location: listManual.php?success=4&tipo='.$_REQUEST['tipo']);
			}
			if ($select == 'Desactivar'){
				foreach ($_REQUEST['idManual'] as $elemento) {
					$manual = new manual($elemento);
					$manual -> updateStatusManual(0);
				}
				header('location: listManual.php?success=5&tipo='.$_REQUEST['tipo']);
			}
		}else {
			header('location: listManual.php?success=0&tipo='.$_REQUEST['tipo']);
		}
	break;
	case 'changeStatusManual':
		$manual = new manual($_REQUEST['id']);
		$manual -> updateStatusManual($_REQUEST['status']);
	break;
/* ============================
 * CRUD _POSTULANTE
 * ============================ */
	case 'listarPostulante':
		$herramientas = new herramientas();
		$temporal = new postulante();
		$listaTemporal = $temporal -> listPostulante($_REQUEST['pagina'], true, '', $_REQUEST['cadena']);

		foreach($listaTemporal as $elementoTemporal){
			$tabla .= ' <tr>
							<td>
				                <input type="hidden" name="idorden" class="idorden" value="'.$elementoTemporal['idPostulante'].'">
				                <input type="checkbox" id="'.$elementoTemporal['idPostulante'].'" name="idPostulante[]" value="'.$elementoTemporal['idPostulante'].'">
								<label for="'.$elementoTemporal['idPostulante'].'"><span></span></label>
				            </td>
				            <td>'.$elementoTemporal['nombre'].' '.$elementoTemporal['apellido'].'</td>
				            <td>'.$elementoTemporal['correo'].'</td>
				            <td>'.$elementoTemporal['telefono'].'</td>
				            <td>'.$elementoTemporal['especialidad'].'</td>
				            <td>'.$elementoTemporal['ciudad'].', '.$elementoTemporal['estado'].'</td>
				            <td>'.$elementoTemporal['mensaje'].'</td>
				            <td><a href="../curriculums/'.$elementoTemporal['curriculum'].'" download="../curriculums/'.$elementoTemporal['curriculum'].'">DESCARGAR</a></td>
				        </tr>';
		}
		$_lastPage = count($listaTemporal)-1;
		$_de = $listaTemporal[$_lastPage]['orden'];
		$htmlpaginador = '<input type="hidden" id="initfor" value="'.$_de.'">';
		$htmlpaginador = $herramientas -> paginador($listaTemporal[0]['ultimapagina'], $listaTemporal[0]['pagina'], $listaTemporal[0]['paginaanterior'], $listaTemporal[0]['paginasiguiente'], 4);

		$arrayJson = Array (
			0 => Array ( "tabla" => $tabla, "paginador" => $htmlpaginador)
		);
		echo json_encode($arrayJson);
	break;
	case 'operapostulante':
		if(isset($_REQUEST['idPostulante'])){
			$select=$_REQUEST['operador'];
			if ($select == 'Eliminar'){
				foreach ($_REQUEST['idPostulante'] as $elemento) {
					$postulante = new postulante($elemento);
					$postulante -> deletePostulante();
				}
				header('location: listPostulantes.php?success=3');
			}
		}else {
			header('location: listPostulantes.php?success=0');
		}
	break;
	////////////////////////////////////
	///		OPERACIONES NEWSLETTER
	///////////////////////////////////

	case 'listarNewsletter':
		$herramientas = new herramientas();
		$temporal = new newsletter();
		$listaTemporal = $temporal -> listNewsletter($_REQUEST['pagina'],true,'', $_REQUEST['cadena']);
		foreach($listaTemporal as $elementoTemporal){
			if($_REQUEST['permisoAcDc'] == 0){
				if($elementoTemporal['status'] != 0){
					$img='img/visible.png';
					$funcion='';
					$class = 'nover';
				}else{
					$img='img/invisible.png';
					$funcion='';
					$class = 'ver';
				}
			}else{
				if($elementoTemporal['status'] != 0){
					$img='img/visible.png';
					$funcion='changeStatus('.$elementoTemporal['idNewsletter'].',0,\'changeStatusNewsletter\')';
					$class = 'nover';
				}else{
					$img='img/invisible.png';
					$funcion='changeStatus('.$elementoTemporal['idNewsletter'].',1,\'changeStatusNewsletter\')';
					$class = 'ver';
				}
			}
			$tabla .= '<tr>
							<td>
				                <input type="hidden" name="idorden" class="idorden" value="'.$elementoTemporal['idNewsletter'].'">
				                <input type="checkbox" id="'.$elementoTemporal['idNewsletter'].'" name="idNewsletter[]" value="'.$elementoTemporal['idNewsletter'].'">
								<label for="'.$elementoTemporal['idNewsletter'].'"><span></span></label>
				            </td>
				            <td>'.$elementoTemporal['correo'].'</td>
				            <td>'.$elementoTemporal['fecha'].'</td>
				            <td class="text-center">
				                <img class="manita '.$class.'" onclick="'.$funcion.'" id="temp'.$elementoTemporal['idNewsletter'].'" src="'.$img.'">
				            </td>
				        </tr> ';
		}
		$_lastPage = count($listaTemporal)-1;
		$_de = $listaTemporal[$_lastPage]['orden'];
		$htmlpaginador = '<input type="hidden" id="initfor" value="'.$_de.'">';
		$htmlpaginador = $herramientas -> paginador($listaTemporal[0]['ultimapagina'], $listaTemporal[0]['pagina'], $listaTemporal[0]['paginaanterior'], $listaTemporal[0]['paginasiguiente'], 4);

		$arrayJson = Array (
			0 => Array ( "tabla" => $tabla, "paginador" => $htmlpaginador)
		);
		echo json_encode($arrayJson);
	break;
	case 'changeStatusNewsletter':
	 	$newsletter = new newsletter($_REQUEST['id']);
		$newsletter -> updateStatusNewsletter($_REQUEST['status']);
	break;
	case 'operanewsletter':
		if(isset($_REQUEST['idNewsletter'])){
			$select=$_REQUEST['operador'];
			if ($select == 'Eliminar'){
				foreach ($_REQUEST['idNewsletter'] as $elemento) {
					$newsletter = new newsletter($elemento);
					$newsletter -> deleteNewsletter();
				}
				header('location: listNewsletter.php?success=3');
			}
			if ($select == 'Mostrar'){
				foreach ($_REQUEST['idNewsletter'] as $elemento) {
					$newsletter = new newsletter($elemento);
					$newsletter -> updateStatusNewsletter(1);
				}
				header('location: listNewsletter.php?success=4');
			}
			if ($select == 'No Mostrar'){
				foreach ($_REQUEST['idNewsletter'] as $elemento) {
					$newsletter = new newsletter($elemento);
					$newsletter -> updateStatusNewsletter(0);
				}
				header('location: listNewsletter.php?success=5');
			}
		}else {
			header('location: listNewsletter.php?success=0');
		}
	break;
	///////////////////////////////////////////////////////////////////
	///				OPERACIONES REDES
	///////////////////////////////////////////////////////////////////
	case 'modificarcontacto':
		$correo = $_REQUEST['correo'];
		$emisor = $_REQUEST['emisor'];
		$latitud = $_REQUEST['latitud'];
		$longitud = $_REQUEST['longitud'];

		$contacto = new contacto(1,$correo, $emisor, $latitud, $longitud);
		$contacto -> modificar_contacto();

		if(isset($_REQUEST['nombreRed'])){
			for($i = 0; $i < count($_REQUEST['nombreRed']); $i++){
				$_nombre = $_REQUEST['nombreRed'][$i];
				$_url = $_REQUEST['urlRed'][$i];
				$_icon = $_REQUEST['iconRed'][$i];
				if($_nombre != '' and $_url != '' and $_icon != '')
					$contacto -> addRedSocial($_nombre, $_url, $_icon);
			}
		}

		if(isset($_REQUEST['nombreRedMod'])){
			for($i = 0; $i < count($_REQUEST['nombreRedMod']); $i++){
				$_idRedSocial = $_REQUEST['idRedSocial'][$i];
				$_nombre = $_REQUEST['nombreRedMod'][$i];
				$_url = $_REQUEST['urlRedMod'][$i];
				$_icon = $_REQUEST['iconRedMod'][$i];
				if($_nombre != '' and $_url != '' and $_icon != '')
					$contacto -> updateRedSocial($_idRedSocial, $_nombre, $_url, $_icon);
			}
		}

		header('location: formcontacto.php?success=2');
	break;
	case 'deleteRedSocial':
		$contacto = new contacto();
		$contacto -> deleteRedSocial($_REQUEST['id']);
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
			$permiso = new permiso($_REQUEST['idpermiso'],$_REQUEST['titulo'],$_REQUEST['clave'],$_REQUEST['idSeccionPermiso'],$_REQUEST['status']);
			$permiso->insertar_permiso();
			header('Location: listpermisos.php');
	break;
	case 'modificarpermiso':
			$permiso = new permiso($_REQUEST['idpermiso'],$_REQUEST['titulo'],$_REQUEST['clave'], $_REQUEST['idSeccionPermiso'],$_REQUEST['status']);
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
				//session_start();
				$_SESSION['idusuario']=$user->idusuario;
				header('Location:listusuarios.php');
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
				$resp = 0;
				if($total > 0)
				{
					foreach($lista as $elementoCliente)
					{
						$idusuario = $elementoCliente['idusuario'];
						$correoRecu= new correoRecuperacion($idusuario);
						$correoRecu->enviar();
						$resp = 2;
					}
				}
				else
					$resp = 1;
			}
			else
				$resp = 0;
			echo $resp;
	break;
	case 'cerrarsesion':
			//session_start();
			if(isset($_SESSION['idusuario']));
			session_destroy();
			echo 1;
	break;


	/* ============================
 * CRUD _SUCURSALES
 * ============================ */
	case 'agregarsucursal':
		$sucursal = new sucursal(0,$_REQUEST['telefono'],$_REQUEST['telMovil'],$_REQUEST['email'],$_REQUEST['ubicacion'],$_FILES['imagen']['name'], $_FILES['imagen']['tmp_name']);
		$sucursal -> addSucursal();

		foreach ($_REQUEST['titulo'] as $_lang => $_titulo) {
			$sucursal -> addDatosSucursal($_titulo, $_REQUEST['descripcion'][$_lang], $_lang);
		}

		header('location: listUbicaciones.php?success=1');
	break;
	case 'modificarsucursal':
		if($_FILES['imagen']['name'] != ''){
			$_name = $_FILES['imagen']['name'];
			$_tmp = $_FILES['imagen']['tmp_name'];
		}else{
			$_name = '';
			$_tmp = '';
		}
		$sucursal = new sucursal($_REQUEST['id'],$_REQUEST['telefono'],$_REQUEST['telMovil'],$_REQUEST['email'],$_REQUEST['ubicacion'], $_name, $_tmp);
		$sucursal -> updateSucursal();

		foreach ($_REQUEST['titulo'] as $_lang => $_titulo) {
			$sucursal -> updateDatosSucursal($_titulo, $_REQUEST['descripcion'][$_lang],$_lang);
		}

		header('location: listUbicaciones.php?success=2');
	break;
	case 'operasucursal':
		if(isset($_REQUEST['idSucursal'])){
			$select=$_REQUEST['operador'];
			if ($select == 'Eliminar'){
				foreach ($_REQUEST['idSucursal'] as $elemento) {
					$sucursal = new sucursal($elemento);
					$sucursal -> deleteSucursal();
				}
				header('location: listUbicaciones.php?success=3');
			}
			if ($select == 'Activar'){
				foreach ($_REQUEST['idSucursal'] as $elemento) {
					$sucursal = new sucursal($elemento);
					$sucursal -> updateStatusSucursal(1);
				}
				header('location: listUbicaciones.php?success=4');
			}
			if ($select == 'Desactivar'){
				foreach ($_REQUEST['idSucursal'] as $elemento) {
					$sucursal = new sucursal($elemento);
					$sucursal -> updateStatusSucursal(0);
				}
				header('location: listUbicaciones.php?success=5');
			}
		}else {
			header('location: listUbicaciones.php?success=0');
		}
	break;
	case 'changeStatusSucursal':
		$sucursal = new sucursal($_REQUEST['id']);
		$sucursal -> updateStatusSucursal($_REQUEST['status']);
	break;
	case 'changeDestacadoSucursal':
		$sucursal = new sucursal($_REQUEST['id']);
		if($_REQUEST['status']==0){
	 		$sucursal-> updateDestacadoSucursal($_REQUEST['status']);
			echo 1;
	 	}else if($sucursal -> checkDestacado()){
			$sucursal -> updateDestacadoSucursal($_REQUEST['status']);
			$status = 1;
		}else{
			$status = 0;
		}

		echo $status;
	break;
	case 'modificarcontactomap':
		//echo '<pre>';
		//print_r($_FILES);
		//echo '</pre>';
		$sucursal = new sucursal();
		$sucursal -> updateImgMapa($_FILES['imagenMap']['name'],$_FILES['imagenMap']['tmp_name']);

		header('location: listUbicaciones.php?success=2');
	break;
	case 'getCategoriasProducto':
		$categoria = new categoria($_REQUEST['idFamilia']);
		$cats = $categoria -> listCategoriasSelects(5,$_REQUEST['idPortafolio']);
		echo json_encode($cats);
	break;
	case 'getSubcategoriasProducto':
		$categoria = new categoria($_REQUEST['idCategoria']);
		$cats = $categoria -> listCategoriasSelects(6,$_REQUEST['idPortafolio']);
		echo json_encode($cats);
	break;

	///////////////////////////////
	//////// AÑOS VENDIDOS ////////
	//////////////////////////////

	case 'agregarvendido':
		/*echo '<pre>';
		print_r($_REQUEST);
		echo '</pre>';*/
		$vendido = new proyectosvendidos();
		$vendido -> addVendido();
		foreach ($_REQUEST['titulo'] as $_lang => $_titulo) {
			$vendido -> addDatosVendido($_titulo,$_REQUEST['subtitulo'][$_lang],$_REQUEST['descripcion'][$_lang],$_lang);
		}

		header('location: listVendidos.php?success=1');
		//print_r('Finaliza');
	break;
	case 'modificarvendido':

		$vendido = new proyectosvendidos($_REQUEST['id']);
		foreach ($_REQUEST['titulo'] as $_lang => $_titulo) {
			$vendido -> updateDatosVendido($_titulo,$_REQUEST['subtitulo'][$_lang], $_REQUEST['descripcion'][$_lang],$_lang);
		}

		header('location: listVendidos.php?success=2');

	break;
	case 'operavendido':
		if(isset($_REQUEST['id_vendido'])){
			$select=$_REQUEST['operador'];
			if ($select == 'Eliminar'){
				foreach ($_REQUEST['id_vendido'] as $elemento) {
					$vendido = new proyectosvendidos($elemento);
					$vendido -> deleteVendido();
				}
				header('location: listVendidos.php?success=3');
			}
			if ($select == 'Activar'){
				foreach ($_REQUEST['id_vendido'] as $elemento) {
					$vendido = new proyectosvendidos($elemento);
					$vendido -> updateStatusVendido(1);
				}
				header('location: listVendidos.php?success=4');
			}
			if ($select == 'Desactivar'){
				foreach ($_REQUEST['id_vendido'] as $elemento) {
					$vendido = new proyectosvendidos($elemento);
					$vendido -> updateStatusVendido(0);
				}
				header('location: listVendidos.php?success=5');
			}
		}else {
			header('location: listVendidos.php?success=0');
		}
	break;
	case 'changeStatusVendido':
		$vendido = new proyectosvendidos($_REQUEST['id']);
		$vendido -> updateStatusVendido($_REQUEST['status']);
	break;
	case 'changeDestacadoVendido':
		$vendido = new proyectosvendidos($_REQUEST['id']);
		if($_REQUEST['status']==0){
	 		$vendido-> updateDestacadoVendido($_REQUEST['status']);
			echo 1;
	 	}else if($vendido -> checkDestacado()){
			$vendido -> updateDestacadoVendido($_REQUEST['status']);
			$status = 1;
		}else{
			$status = 0;
		}

		echo $status;
	break;





}
?>
