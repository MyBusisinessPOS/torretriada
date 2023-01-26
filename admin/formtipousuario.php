<?php
	include_once('clases/tipousuario.php');
	include_once('clases/permiso.php');
	include_once('clases/tiposusuarioxpermiso.php');
	include_once('clases/seguridad.php');
	$seguridad = new seguridad();
	$seguridad->candado();


	if(isset($_REQUEST['idtipousuario'])){
		$id = $_REQUEST['idtipousuario'];
		$operacion = 'modificartipousuario';
		$palabra = 'Editar Tipo de Usuario';
	}
	else{
		$id = 0;
		$operacion = 'agregartipousuario';
		$palabra = 'Nuevo Tipo de Usuario';
	}

	$temporal = new tipousuario($id);
	$temporal->obtener_tipousuario();
	$clave='ModTipoUser';
?>
<?php
include('head.html');//Contiene los estilos y los metas.
?>
	<title>Formulario Tipo Usuario</title>
<?php
include('header.html');//contiene las barras de arriba y los menus.
include('menu.php');
?>
        <!-- Page content Sección del contenido de la pagina-->
        <div id="page-content-wrapper">

            <!-- Keep all page content within the page-content inset div! -->
            <div class="page-content inset">
                <div class="row rowedit">
                	<!--Seccion del titulo y el boton de agregar-->
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <p class="titulo"><?php echo $palabra;?></p>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    	<form id="form-validation" action="operaciones.php" method="post" name="form1" onsubmit="return validar_campos()">
                    		<input type="hidden" name="idtipousuario" value="<?php echo $temporal->idtipousuario; ?>"/>
                    		<input type="hidden" name="status" value="<?php echo $temporal->status; ?>" />
                    		<button type="submit" <?php if($seguridad->valida_permiso_usuario($_SESSION['idusuario'],$clave)==0) echo ' disabled ';?> name="operaciones" value="<?php echo $operacion; ?>" class="buttonguardar">Guardar y Publicar</button>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    	<hr class="hrmenu">
                    </div>

                    <div class="clearfix"></div>
                    <!--Seccion de los forms
                    	En esta sección esta para editar el titulo y la descripcion
                    -------------------------------------------------------------------------------->
                     <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    	<div class='notifications top-right'></div>
                    </div>
                   	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                   		<div id="titulo" class="form-group espacios">
                   			<input type="text" name="titulo" class="form-control" placeholder="Ingrese el nombre del tipo de usuario aquí..." value="<?=$temporal->nomtipousuario?>"></input>
                   		</div>
                   	</div>
                   	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    	<p class="subitulo">Asigne los permisos para este tipo de usuario:</p>
                    </div>
                   		<?php

								$permiso= new permiso();
								$listapermisoactive= $permiso->listaPermisoActivas();
								$tipousuarioxpermiso= new tiposusuarioxpermiso(0,0);
								$tipousuarioxpermiso->idtipousuario=$id;
								foreach($listapermisoactive as $elementoPermiso)
								{
									$tipousuarioxpermiso->idpermiso=$elementoPermiso['idpermiso'];
									$temp='';
									if($tipousuarioxpermiso->existe_rol_permiso()==1)
										$temp='checked';
									echo '<div class="col-lg-3 col-md-3 col-sm-4 col-xs-6">
									<input type="checkbox" id="'.$elementoPermiso['idpermiso'].'" name="idpermiso[]" '.$temp.' value="'.$elementoPermiso['idpermiso'].'">
										  <label for="'.$elementoPermiso['idpermiso'].'"><span></span>'.$elementoPermiso['nompermiso'].'</label>
										  </div>';
								}

                   		?>
                    <div class="clearfix"></div>
                    <!--Este div contiene la barra inferior-->
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    	<hr class="hrmenu">
                    </div>
                    <!--Este div contiene al boton inferior-->
                    <div class="clearfix"></div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    		<button type="submit" <?php if($seguridad->valida_permiso_usuario($_SESSION['idusuario'],$clave)==0) echo ' disabled ';?> name="operaciones" value="<?php echo $operacion; ?>" class="buttonguardar">Guardar y Publicar</button>
                        </form>
                    </div>

                    <!--Sección del pie de pagina-->
                    <footer id="footer">
                    	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">
												Derechos Reservados a Slogan Publicidad.
												<br>
												webmaster@sloganpublicidad.com
												<br>
												sloganpublicidad.com
                    	</div>
                    </footer>
                </div><!--Div de cierre del row-->
            </div><!--Div de cierre de page-content inset-->
        </div><!--Div de cierre de page-content-wrapper-->
    </div><!--Div de cierre de id Wrapper-->

<?php
include 'javascripts.html';
?>
<script>
	function validar_campos(){

		if (form1.titulo.value == ''){
			form1.titulo.focus();
			$('#titulo').removeClass("form-group").addClass("form-group has-error");
			$('.top-right').notify({
    			message: { text: 'El campo del nombre del estado esta vacío, llene este campo para poder continuar' },
    			type:'blackgloss',
  			}).show();
			return false;
			}
		else{
			$('#titulo').removeClass("form-group has-error").addClass("form-group has-success");
		}
	}
	</script>
</body>
</html>
