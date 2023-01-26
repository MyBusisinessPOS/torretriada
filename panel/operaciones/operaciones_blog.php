<?php
session_start();
function __autoload($nombre_clase) {
	include_once '../clases/'.$nombre_clase .'.php';
}
$_operaciones = $_REQUEST['operaciones'];
$_langs = ['es','en','fr'];
/*echo '<pre>';
print_r($_REQUEST);
echo '</pre>';*/
switch($_operaciones){
	case 'ordenar':
		if($_REQUEST['desde'] == 'blog'){
			$val = ($_REQUEST['idorden']);
			$val2 = array_reverse($val);
			$_initFor = $_REQUEST['initfor'];
			$_hastaFor = count($val2) + $_initFor - 1;
			$_index = 0;
			for($i = $_initFor; $i <= $_hastaFor; $i++)
			{
				$blog = new blog($val2[$_index]);
				$blog -> update_orden_blog($i);
				$_index++;
			}
		}

		if($_REQUEST['desde'] == 'contenidoBlog'){
			$val = ($_REQUEST['idorden']);
			//$val2 = array_reverse($val);
			for($i=0; $i < count($val); $i++)
			{
				$blog = new blog();
				$blog -> modificar_orden_contenido_blog($val[$i], $i);
			}
		}
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

		if($_FILES['archivoR']['name'] != ''){
			$nameR = $_FILES['archivoR']['name'];
			$tmpR = $_FILES['archivoR']['tmp_name'];
		}else{
			$nameR = '';
			$tmpR = '';
		}
		/*echo '<pre>';
		print_r($_REQUEST);
		echo '</pre>';*/
		$blog = new blog(0, $_REQUEST['idCategoria'], $name, $tmp, $nameR, $tmpR);
		$blog -> add_blog();
        foreach ($_langs as $_lang){
            $_titulo = $_REQUEST['titulo'][$_lang];
            $_subtitulo = $_REQUEST['subtitulo'][$_lang];
            $_descripcion = $_REQUEST['descripcion'][$_lang];
            $_tags = $_REQUEST['tags'][$_lang];
            $blog ->  agregar_datos_blog($_titulo, $_subtitulo, $_descripcion, $_tags, $_lang);
        }


		if(isset($_REQUEST['temporal-id'])){
			for($i = 0; $i < count($_REQUEST['temporal-id']); $i++){
				$_temporalID = $_REQUEST['temporal-id'][$i];
				$_tipo = $_REQUEST['tipo-contenido'][$i];
				$_idContenidoBlog = $blog -> agregar_contenido_blog($_tipo);
				if($_tipo == 1){
					if($_REQUEST['descripcion-contenido-es-'.$_temporalID] != ''){
						$blog -> agregarTexto($_idContenidoBlog, $_REQUEST['descripcion-contenido-es-'.$_temporalID], $_REQUEST['descripcion-contenido-en-'.$_temporalID], $_REQUEST['descripcion-contenido-fr-'.$_temporalID]);
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

		header('Location: ../listBlog.php?success=1');
	break;
	case 'modificarblog':
		if($_FILES['archivo']['name'] != ''){
			$name = $_FILES['archivo']['name'];
			$tmp = $_FILES['archivo']['tmp_name'];
		}else{
			$name = '';
			$tmp = '';
		}

		if($_FILES['archivoR']['name'] != ''){
			$nameR = $_FILES['archivoR']['name'];
			$tmpR = $_FILES['archivoR']['tmp_name'];
		}else{
			$nameR = '';
			$tmpR = '';
		}
		$blog = new blog($_REQUEST['id_blog'], $_REQUEST['idCategoria'], $name, $tmp, $nameR, $tmpR);
		$blog -> update_blog();
        foreach ($_langs as $_lang){
            $_titulo = $_REQUEST['titulo'][$_lang];
            $_subtitulo = $_REQUEST['subtitulo'][$_lang];
            $_descripcion = $_REQUEST['descripcion'][$_lang];
            $_tags = $_REQUEST['tags'][$_lang];
            $blog ->  modificar_datos_blog($_titulo, $_subtitulo, $_descripcion, $_tags, $_lang);
        }


        if(isset($_REQUEST['temporal-id'])){
            for($i = 0; $i < count($_REQUEST['temporal-id']); $i++){
                $_temporalID = $_REQUEST['temporal-id'][$i];
                $_tipo = $_REQUEST['tipo-contenido'][$i];
                $_idContenidoBlog = $blog -> agregar_contenido_blog($_tipo);
                if($_tipo == 1){
                    if($_REQUEST['descripcion-contenido-es-'.$_temporalID] != ''){
                        $blog -> agregarTexto($_idContenidoBlog, $_REQUEST['descripcion-contenido-es-'.$_temporalID], $_REQUEST['descripcion-contenido-en-'.$_temporalID], $_REQUEST['descripcion-contenido-fr-'.$_temporalID]);
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
					if($_REQUEST['descripcion-contenido-es-mod-'.$_temporalID] != ''){
						$blog -> agregarTexto($_temporalID, $_REQUEST['descripcion-contenido-es-mod-'.$_temporalID], $_REQUEST['descripcion-contenido-en-mod-'.$_temporalID], $_REQUEST['descripcion-contenido-fr-mod-'.$_temporalID]);
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
								$_id_galeria = $_REQUEST['id_galeria-'.$_temporalID][$c];
								$blog -> modGaleriaContenido($_id_galeria, $_name, $_tmp);
							}
						}
					}
				}

			}
		}



		header('Location: ../listBlog.php?success=2');
	break;
	case 'operablog':
		if(isset($_REQUEST['id_blog'])){
			$select=$_REQUEST['operador'];
			if ($select == 'Eliminar'){
				foreach ($_REQUEST['id_blog'] as $elemento) {
					$blog = new blog($elemento);
					$blog -> listar_contenido_blog();
					foreach ($blog -> _contenido_blog as $_g) {
						$_galeria = $blog -> listarGaleriaContenido($_g['id_contenido_blog']);
						if(count($_galeria) > 0){
							foreach ($_galeria as $_gal) {
								$blog -> delGaleriaContenido($_gal['id_galeria']);
							}
						}
						$blog -> eliminar_contenido_blog($_g['id_contenido_blog']);
					}
					$blog -> eliminar_datos_blog();
					$blog -> delete_blog();
				}
				header('location: ../listBlog.php?success=3');
			}
			if ($select == 'Mostrar'){
				foreach ($_REQUEST['id_blog'] as $elemento) {
					$blog = new blog($elemento);
					$blog -> update_status_blog(1);
				}
				header('location: ../listBlog.php?success=4');
			}
			if ($select == 'No Mostrar'){
				foreach ($_REQUEST['id_blog'] as $elemento) {
					$blog = new blog($elemento);
					$blog -> update_status_blog(0);
				}
				header('location: ../listBlog.php?success=5');
			}
		}else {
			header('location: ../listBlog.php?success=0');
		}
	break;
	case 'listarBlog':
		$herramientas = new herramientas();
		$temporal = new blog();
		($_REQUEST['registrosPorPagina'] != '-1') ? $_rpp = $_REQUEST['registrosPorPagina'] : $_rpp = 20;
		//$_pagina = 1, $_paginador = true, $_idCategoria = '', $_status = '', $_busqueda = '', $_tags = '', $_registrosPorPagina = 20, $_frontEnd = true, $_lang = 'ES'
		$listaTemporal = $temporal -> listBlog($_REQUEST['pagina'], true, '', '', $_REQUEST['cadena'], '', $_rpp);
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
					$funcion='changeStatus('.$elementoTemporal['id_blog'].',0,\'changeStatusBlog\')';
					$class = 'nover';
				}else{
					$img='img/invisible.png';
					$funcion='changeStatus('.$elementoTemporal['id_blog'].',1,\'changeStatusBlog\')';
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
		$blog -> update_status_blog($_REQUEST['status']);
	break;
	case 'deleteContenidoBlog':
		$blog = new blog();
		$_galeria = $blog -> listarGaleriaContenido($_REQUEST['id']);
		if(count($_galeria)){
			foreach ($_galeria as $_gal) {
				echo $_gal['idGaleriaContenido'];
				$blog -> delGaleriaContenido($_gal['id_galeria']);
			}
		}
		$blog -> eliminar_contenido_blog($_REQUEST['id']);
	break;
	case 'deleteGaleriaContenido':
		$blog = new blog();
		$blog -> delGaleriaContenido($_REQUEST['id']);
	break;
}
