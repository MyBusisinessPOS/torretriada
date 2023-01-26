<?php
	include_once('clases/usuario.php');
	include_once('clases/datosusuario.php');
	include_once('clases/tipousuario.php');
	include_once('clases/seguridad.php');
	$seguridad = new seguridad();
	$seguridad->candado();


	if(isset($_REQUEST['idusuario'])){
		$id = $_REQUEST['idusuario'];
		$operacion = 'modificarusuario';
		$palabra = 'Editar Usuario';
	}
	else{
		$id = 0;
		$operacion = 'agregarusuario';
		$palabra = 'Nuevo Usuario';
	}

	$temporal = new usuario($id);
	$temporal -> obten_usuario();
	$temporal ->obtener_datos();
	$tipousuario = new tipousuario();
	$listipousuario = $tipousuario -> listaTipousuarioActivas();
	if($temporal->idusuario != 0){
		$disabled=' disabled';
		$opciones = '	<span class="textHelper">Seleccione uno de las opciones:</span>
                        <br>
                        <div class="espacios">
                        	<input onclick="cambiar()" type="checkbox" id="nameuser" name="nameuser" value="nameuser">
							<label for="nameuser"><span></span>Cambiar el nombre de usuario</label>
							<input onclick="cambiar2()" type="checkbox" id="contraseña" name="contra" value="pass">
							<label for="contraseña"><span></span>Cambiar la contraseña</label>
							<input onclick="cambiar3()" type="checkbox" id="emailCh" name="emailControl" value="emailControl">
							<label for="emailCh"><span></span>Cambiar email</label>
						</div>';
	}
	else{
		$disabled='';
		$opciones = '';
	}
	$clave='ModUser';
	$claveSelect='SelecTipo';
?>
<!DOCTYPE html>
<html lang="es">
	<head>
        <?php include 'head.php';?>
        <title>Formulario | Usuario</title>
    </head>
    <body>
    	<header>
            <?php include 'header.php';?>
        </header>
        <!--wrapper es el que contiene a toda la pagina-->
        <div id="wrapper" class="wrapper-movil">
            <?php include 'menu.php';?>
            <!-- Page content Sección del contenido de la pagina-->
            <div id="page-content-wrapper">
                <!-- Keep all page content within the page-content inset div! -->
                <div class="page-content inset">
                    <div class="row rowedit">
                    	 <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
	                        <p class="titulo"><?php echo $palabra;?></p>
	                    </div>
	                    <form id="form-validation" action="operaciones.php" method="post" name="form1">
	                    	<input type="hidden" name="operaciones" value="<?=$operacion?>">
		                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
		                    	<input type="hidden" name="idusuario" value="<?php echo $temporal->idusuario; ?>"/>
	                    		<input type="hidden" name="status" value="<?php echo $temporal->status; ?>" />
	                    		<button type="button" <?php if($seguridad->valida_permiso_usuario($_SESSION['idusuario'],$clave)==0) echo ' disabled ';?>  class="buttonguardar">Guardar y Publicar</button>
		                    </div>
		                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		                    	<hr class="hrmenu">
		                    </div>
		                    <div class="col-lg-5 col-md-6 col-sm-12 col-xs-12">
		                    	<p class="subtitulo">Usuario y Contraseña:</p>
		                    	<div id="nomuser" class="form-group espacios">
		                        	<input id="checkuser" <?=$disabled?> name="nomuser" type="text" class="form-control" placeholder="Ingrese el nombre de usuario aquí..." value="<?php echo $temporal->nomusuario; ?>">
		                       	</div>
		                       	<div id="email" class="form-group espacios">
		                        	<input <?=$disabled?> name="email" id="emailC" type="text" class="form-control" placeholder="Ingrese el correo aquí..." value="<?php echo $temporal->datosusuario->email; ?>">
		                       	</div>
		                       	<div id="pass" class="form-group">
		                        	<input id="usepass" <?=$disabled?> name="pass" type="password" class="form-control" placeholder="Ingrese la contraseña aquí..." value="">
		                       	</div>
		                       	<div id="repass" class="form-group">
		                        	<input id="userepass" <?=$disabled?> name="repass" type="password" class="form-control" placeholder="Reingrese la contraseña aquí..." value="">
		                       	</div>

		                       	<div class="espacios" id="valuser"></div>
		        				<?=$opciones?>
		                    </div><!--Div de cierre col-lg-5-->
		                    <div class="col-lg-7 col-md-6 col-sm-12 col-xs-12">
		                    	<p class="subtitulo">Datos del usuario:</p>
		                    	<div id="nombre" class="form-group espacios">
		                        	<input name="nombre" type="text" class="form-control" placeholder="Ingrese el nombre completo aquí..." value="<?php echo $temporal->datosusuario->nombre; ?>">
		                       	</div>

		                       	<div id="telefono" class="form-group espacios">
		                        	<input name="telefono" type="text" class="form-control" placeholder="Ingrese el teléfono aquí..." value="<?php echo $temporal->datosusuario->telefono; ?>">
		                       	</div>
		                       	<div <?php if($seguridad->valida_permiso_usuario($_SESSION['idusuario'],$claveSelect)==0) echo ' style="display: none"';?>>
			                       	<span class="textHelper">Seleccione el tipo de usuario:</span>
									<br>
										<div class="styled-select-form">
				                        	<select id="typeuser" name="tipo">
				                        		<option value="0">Seleccione tipo de usuario</option>
				                        	<?php
				                        	foreach ($listipousuario as $elemento) {
												$bandera = '';
												if($elemento['idtipousuario'] == $temporal->tiposusuario->idtipousuario)
												$bandera = ' selected';
												echo '<option value="'.$elemento['idtipousuario'].'" '.$bandera.' >'.$elemento['nomtipousuario'].'</option>';
											}
				                        	?>
				                            </select>
				                        </div>
			                    </div>
		                    </div>
		                    <div class="clearfix"></div>
		                    <!--Este div contiene la barra inferior-->
		                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		                    	<hr class="hrmenu">
		                    </div>
		                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
	                    		<button type="button" <?php if($seguridad->valida_permiso_usuario($_SESSION['idusuario'],$clave)==0) echo ' disabled ';?>  class="buttonguardar">Guardar y Publicar</button>
	                    	</div>
		                </form>
                    </div>
                </div>
            </div>
        </div>
    </body>
    <footer id="footer">
        <?php include 'footer.php';?>
        <script src="js/functionsUsuario.js"></script>
    </footer>
</html>
