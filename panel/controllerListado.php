<?php
function __autoload($nombre_clase) {
	//$nombre_clase = strtolower($nombre_clase);
    include 'clases/'.$nombre_clase .'.php';
}
$operaciones=$_REQUEST['operaciones'];
switch($operaciones){
	case 'listarSlide':
		$herramientas = new herramientas();
		$temporal = new slide();
		$listaTemporal = $temporal -> listSlide($_REQUEST['pagina']);
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
					$funcion='changeStatus('.$elementoTemporal['idSlide'].',0,\'changeStatusSlide\')';
					$class = 'nover';
				}else{
					$img='img/invisible.png';
					$funcion='changeStatus('.$elementoTemporal['idSlide'].',1,\'changeStatusSlide\')';
					$class = 'ver';
				}
			}
			$tabla .= ' <tr>
				            <td>
				                <input type="hidden" name="idorden" class="idorden" value="'.$elementoTemporal['idSlide'].'">
				                <input type="checkbox" id="'.$elementoTemporal['idSlide'].'" name="idSlide[]" value="'.$elementoTemporal['idSlide'].'">
								<label for="'.$elementoTemporal['idSlide'].'"><span></span></label>
				        	</td>
				            <td>
				                <a href="formSlide.php?idSlide='.$elementoTemporal['idSlide'].'">
				                    <img width="100" height="100" class="img-responsive" src="../img/slide/'.$elementoTemporal['ruta'].'"/>
				                </a>
				            </td>
				            <td valign="middle">'.$elementoTemporal['nuevo'].'</td>
				                <td class="text-center">
				                '.$handle.'
				            	<img class="manita '.$class.'" onclick="'.$funcion.'" id="temp'.$elementoTemporal['idSlide'].'" src="'.$img.'">
				            </td>
				        </tr>';
		}

		$htmlpaginador = $herramientas -> paginador($listaTemporal[0]['ultimapagina'], $listaTemporal[0]['pagina'], $listaTemporal[0]['paginaanterior'], $listaTemporal[0]['paginasiguiente'], 4);

		$arrayJson = Array (
			0 => Array ( "tabla" => $tabla, "paginador" => $htmlpaginador)
		);
		echo json_encode($arrayJson);
	break;
	case 'listarEquipo':
		$herramientas = new herramientas();
		$temporal = new equipo();
		$listaTemporal = $temporal -> listEquipo($_REQUEST['pagina'], false, false, $_REQUEST['idCategoria'], $_REQUEST['idRama'], $_REQUEST['cadena']);
		foreach($listaTemporal as $elementoTemporal){
			if($_REQUEST['permisoAcDc']){
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
					$funcion='changeStatus('.$elementoTemporal['idEquipo'].',0,\'changeStatusEquipo\')';
					$class = 'nover';
				}else{
					$img='img/invisible.png';
					$funcion='changeStatus('.$elementoTemporal['idEquipo'].',1,\'changeStatusEquipo\')';
					$class = 'ver';
				}
			}
			if($elementoTemporal['idRama']==1)
			{
				$rama='Varonil';
			}
			elseif($elementoTemporal['idRama']==2)
			{
				$rama='Femenil';
			}
			if($elementoTemporal['idCategoria']=='0403')
			{
				$categoria='´04 - ´03';
			}
			elseif($elementoTemporal['idCategoria']=='02')
			{
				$categoria='´02';
			}
			elseif($elementoTemporal['idCategoria']=='01')
			{
				$categoria='´01';
			}
			elseif($elementoTemporal['idCategoria']=='0099')
			{
				$categoria='´01 - ´99';
			}
			elseif($elementoTemporal['idCategoria']=='98')
			{
				$categoria='Copa RC ´98* en adelante.';
			}
			$tabla .= ' <tr>
				        	<td>
				                <input type="hidden" name="idorden" class="idorden" value="'.$elementoTemporal['idEquipo'].'">
				                <input type="checkbox" id="'.$elementoTemporal['idEquipo'].'" name="idEquipo[]" value="'.$elementoTemporal['idEquipo'].'">
								<label for="'.$elementoTemporal['idEquipo'].'"><span></span></label>
				            </td>
				            <td>
				                <a href="formEquipo.php?idEquipo='.$elementoTemporal['idEquipo'].'">
				                   '.$elementoTemporal['nombre'].'
				                </a>
				            </td>
				            <td>'.$categoria.'</td>
							<td>'.$rama.'</td>
							<td>'.$elementoTemporal['representante'].'</td>
				            <td class="text-center">
				                '.$handle.'
				                <img class="manita '.$class.'" onclick="'.$funcion.'" id="temp'.$elementoTemporal['idEquipo'].'" src="'.$img.'">
				            </td>
				        </tr>';
		}
		$htmlpaginador = $herramientas -> paginador($listaTemporal[0]['ultimapagina'], $listaTemporal[0]['pagina'], $listaTemporal[0]['paginaanterior'], $listaTemporal[0]['paginasiguiente'], 4);

		$arrayJson = Array (
			0 => Array ( "tabla" => $tabla, "paginador" => $htmlpaginador)
		);
		echo json_encode($arrayJson);
	break;
	case 'listarEntrenador':
		$herramientas = new herramientas();
		$temporal = new entrenador();
		$listaTemporal = $temporal -> listEntrenador($_REQUEST['pagina'], false, false, $_REQUEST['idCategoria'], $_REQUEST['idEquipo'], $_REQUEST['idDelegacion'], $_REQUEST['cadena']);
		foreach($listaTemporal as $elementoTemporal){
			if($_REQUEST['permisoAcDc']){
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
					$funcion='changeStatus('.$elementoTemporal['idEntrenador'].',0,\'changeStatusEntrenador\')';
					$class = 'nover';
				}else{
					$img='img/invisible.png';
					$funcion='changeStatus('.$elementoTemporal['idEntrenador'].',1,\'changeStatusEntrenador\')';
					$class = 'ver';
				}
			}
			if($elementoTemporal['idDelegacion']==1)
			{
				$delegacion='Aguascalientes';
			}
			elseif($elementoTemporal['idDelegacion']==2)
			{
				$delegacion='Campeche';
			}
			elseif($elementoTemporal['idDelegacion']==3)
			{
				$delegacion='Cancún';
			}
			elseif($elementoTemporal['idDelegacion']==4)
			{
				$delegacion='Ciudad de México';
			}
			elseif($elementoTemporal['idDelegacion']==5)
			{
				$delegacion='Conkal';
			}
			elseif($elementoTemporal['idDelegacion']==6)
			{
				$delegacion='Cozumel';
			}
			elseif($elementoTemporal['idDelegacion']==7)
			{
				$delegacion='El Salvador';
			}
			elseif($elementoTemporal['idDelegacion']==8)
			{
				$delegacion='Guadalajara';
			}
			elseif($elementoTemporal['idDelegacion']==9)
			{
				$delegacion='Mérida';
			}
			elseif($elementoTemporal['idDelegacion']==10)
			{
				$delegacion='Monterrey';
			}
			elseif($elementoTemporal['idDelegacion']==11)
			{
				$delegacion='Oaklawn Academy';
			}
			elseif($elementoTemporal['idDelegacion']==12)
			{
				$delegacion='San Luis Potosí';
			}
			elseif($elementoTemporal['idDelegacion']==13)
			{
				$delegacion='Tapachula';
			}
			elseif($elementoTemporal['idDelegacion']==14)
			{
				$delegacion='Tuxtla Gutiérrez';
			}
			elseif($elementoTemporal['idDelegacion']==15)
			{
				$delegacion='Villahermosa';
			}
			elseif($elementoTemporal['idDelegacion']==16)
			{
				$delegacion='Otro';
			}



			if($elementoTemporal['idCategoria']=='0403')
			{
				$categoria='´04 - ´03';
			}
			elseif($elementoTemporal['idCategoria']=='02')
			{
				$categoria='´02';
			}
			elseif($elementoTemporal['idCategoria']=='01')
			{
				$categoria='´01';
			}
			elseif($elementoTemporal['idCategoria']=='0099')
			{
				$categoria='´01 - ´99';
			}
			elseif($elementoTemporal['idCategoria']=='98')
			{
				$categoria='Copa RC ´98* en adelante.';
			}
			$equipo=new equipo($elementoTemporal['idEquipo']);
			$equipo->getEquipo();
			$tabla .= ' <tr>
				        	<td>
				                <input type="hidden" name="idorden" class="idorden" value="'.$elementoTemporal['idEntrenador'].'">
				                <input type="checkbox" id="'.$elementoTemporal['idEntrenador'].'" name="idEntrenador[]" value="'.$elementoTemporal['idEntrenador'].'">
								<label for="'.$elementoTemporal['idEntrenador'].'"><span></span></label>
				            </td>
				            <td>
				                <a href="formEntrenador.php?idEntrenador='.$elementoTemporal['idEntrenador'].'">
				                   '.$elementoTemporal['nombre'].' '.$elementoTemporal['apellidoPaterno'].' '.$elementoTemporal['apellidoMaterno'].'
				                </a>
				            </td>
				            <td>'.$categoria.'</td>
							<td>'.$equipo->nombre.'</td>
							<td>'.$delegacion.'</td>
				            <td class="text-center">
				                '.$handle.'
				                <img class="manita '.$class.'" onclick="'.$funcion.'" id="temp'.$elementoTemporal['idEntrenador'].'" src="'.$img.'">
				            </td>
				        </tr>';
		}
		$htmlpaginador = $herramientas -> paginador($listaTemporal[0]['ultimapagina'], $listaTemporal[0]['pagina'], $listaTemporal[0]['paginaanterior'], $listaTemporal[0]['paginasiguiente'], 4);

		$arrayJson = Array (
			0 => Array ( "tabla" => $tabla, "paginador" => $htmlpaginador)
		);
		echo json_encode($arrayJson);
	break;
	case 'listarJugador':
		$herramientas = new herramientas();
		$temporal = new jugador();
		$listaTemporal = $temporal -> listJugador($_REQUEST['pagina'], false, false, $_REQUEST['idCategoria'], $_REQUEST['idEquipo'], $_REQUEST['idDelegacion'], $_REQUEST['cadena']);
		foreach($listaTemporal as $elementoTemporal){
			if($_REQUEST['permisoAcDc']){
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
					$funcion='changeStatus('.$elementoTemporal['idJugador'].',0,\'changeStatusJugador\')';
					$class = 'nover';
				}else{
					$img='img/invisible.png';
					$funcion='changeStatus('.$elementoTemporal['idJugador'].',1,\'changeStatusJugador\')';
					$class = 'ver';
				}
			}
			if($elementoTemporal['idDelegacion']==1)
			{
				$delegacion='Aguascalientes';
			}
			elseif($elementoTemporal['idDelegacion']==2)
			{
				$delegacion='Campeche';
			}
			elseif($elementoTemporal['idDelegacion']==3)
			{
				$delegacion='Cancún';
			}
			elseif($elementoTemporal['idDelegacion']==4)
			{
				$delegacion='Ciudad de México';
			}
			elseif($elementoTemporal['idDelegacion']==5)
			{
				$delegacion='Conkal';
			}
			elseif($elementoTemporal['idDelegacion']==6)
			{
				$delegacion='Cozumel';
			}
			elseif($elementoTemporal['idDelegacion']==7)
			{
				$delegacion='El Salvador';
			}
			elseif($elementoTemporal['idDelegacion']==8)
			{
				$delegacion='Guadalajara';
			}
			elseif($elementoTemporal['idDelegacion']==9)
			{
				$delegacion='Mérida';
			}
			elseif($elementoTemporal['idDelegacion']==10)
			{
				$delegacion='Monterrey';
			}
			elseif($elementoTemporal['idDelegacion']==11)
			{
				$delegacion='Oaklawn Academy';
			}
			elseif($elementoTemporal['idDelegacion']==12)
			{
				$delegacion='San Luis Potosí';
			}
			elseif($elementoTemporal['idDelegacion']==13)
			{
				$delegacion='Tapachula';
			}
			elseif($elementoTemporal['idDelegacion']==14)
			{
				$delegacion='Tuxtla Gutiérrez';
			}
			elseif($elementoTemporal['idDelegacion']==15)
			{
				$delegacion='Villahermosa';
			}
			elseif($elementoTemporal['idDelegacion']==16)
			{
				$delegacion='Otro';
			}

			if($elementoTemporal['idCategoria']=='0403')
			{
				$categoria='´04 - ´03';
			}
			elseif($elementoTemporal['idCategoria']=='02')
			{
				$categoria='´02';
			}
			elseif($elementoTemporal['idCategoria']=='01')
			{
				$categoria='´01';
			}
			elseif($elementoTemporal['idCategoria']=='0099')
			{
				$categoria='´01 - ´99';
			}
			elseif($elementoTemporal['idCategoria']=='98')
			{
				$categoria='Copa RC ´98* en adelante.';
			}
			$equipo=new equipo($elementoTemporal['idEquipo']);
			$equipo->getEquipo();
			$tabla .= ' <tr>
				        	<td>
				                <input type="hidden" name="idorden" class="idorden" value="'.$elementoTemporal['idJugador'].'">
				                <input type="checkbox" id="'.$elementoTemporal['idJugador'].'" name="idJugador[]" value="'.$elementoTemporal['idJugador'].'">
								<label for="'.$elementoTemporal['idJugador'].'"><span></span></label>
				            </td>
				            <td>
				                <a href="formJugador.php?idJugador='.$elementoTemporal['idJugador'].'">
				                   '.$elementoTemporal['nombre'].' '.$elementoTemporal['apellidoPaterno'].' '.$elementoTemporal['apellidoMaterno'].'
				                </a>
				            </td>
				            <td>'.$categoria.'</td>
							<td>'.$elementoTemporal['codigoUnico'].'</td>
							<td>'.$equipo->nombre.'</td>
							<td>'.$delegacion.'</td>
				            <td class="text-center">
				                '.$handle.'
				                <img class="manita '.$class.'" onclick="'.$funcion.'" id="temp'.$elementoTemporal['idJugador'].'" src="'.$img.'">
				            </td>
				        </tr>';
		}
		$htmlpaginador = $herramientas -> paginador($listaTemporal[0]['ultimapagina'], $listaTemporal[0]['pagina'], $listaTemporal[0]['paginaanterior'], $listaTemporal[0]['paginasiguiente'], 4);

		$arrayJson = Array (
			0 => Array ( "tabla" => $tabla, "paginador" => $htmlpaginador)
		);
		echo json_encode($arrayJson);
	break;
}
?>
