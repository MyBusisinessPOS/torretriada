<?php
function __autoload($nombre_clase) {
    include 'clases/'.$nombre_clase .'.php';

}
$seguridad = new seguridad();
$seguridad->candado();
$alert = '';

if(isset($_REQUEST['success'])){
	$success = $_REQUEST['success'];
  	$herramientas = new herramientas();
  	$alert = $herramientas -> mensajesAlerta($success);
}

if(isset($_REQUEST['tipo'])){
	$tipo = $_REQUEST['tipo'];
}
if($tipo==1){$texto="Home";}else if($tipo==2){$texto="Nosotros";}else if($tipo==3){$texto="Divisiones";}else if($tipo==4){$texto="Proyectos";}
else if($tipo==5){$texto="Blog";}else if($tipo==6){$texto="Contacto";}

$temporal = new slide();
$listaTemporal = $temporal -> listSlide(1, false, '', '', 20, 'es', true, $tipo);
$clave = 'p_add_slide';
$clave2 = 'p_del_slide';
$clave3 = 'p_acdc_slide';
$clave4 = 'p_sort_slide';
$clave5 = 'p_mod_slide';
$sort = "slide";
$handle = "";
if($seguridad->valida_permiso_usuario($_SESSION['idusuario'],$clave4)==0){
  $handle = "";
  $permiso = "<input type='hidden' id='valorpermiso' name='permiso' value='0'>";
}else{
  $handle = '<span class="fa-stack fa-1x mover handle"><i class="fa fa-circle fa-stack-2x"></i><i class="fa fa-arrows fa-stack-1x fa-inverse"></i></span>';
  $permiso = "<input type='hidden' id='valorpermiso' name='permiso' value='1'>";
}
($seguridad->valida_permiso_usuario($_SESSION['idusuario'],$clave3)==0) ? $permisoAcDc = 0 : $permisoAcDc = 1;
//variable global para el paginador;
$opera_list = 'listarSlide';
$_lastPage = count($listaTemporal)-1;
$_de = $listaTemporal[$_lastPage]['orden'];
?>
<!DOCTYPE html>
<html lang="es">
	<head>
		<?php include 'head.php';?>
		<title>Lista | Slide <?=$texto?></title>
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
            			<!--Seccion ALERTAS-->
            			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
	                		<?=$alert?>
	                		<div class='notifications bottom-right'></div>
	                	</div>
	                	<!--Seccion del titulo y el boton de agregar-->
	                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
	                        <p class="titulo">Slide <?=$texto?></p>
	                    </div>
	                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
	                    	<form action="formSlide.php" method="post">
	                    		<button type="button" <?php if($seguridad->valida_permiso_usuario($_SESSION['idusuario'],$clave)==0) echo ' disabled ';?> value="" class="buttonagregar">Agregar Nuevo</button>
	                        </form>
	                    </div>
	                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
	                    	<hr class="hrmenu">
	                    </div>
	                    <div class="clearfix"></div>
	                    <!--Sección para realizar cambios Nota: el div con la clase styled-large es la que se visualiza con lg y md-->
                    	<form method="post" action="operaciones.php">
                    		<input type="hidden" id="permisoAcDc" value="<?=$permisoAcDc?>">
                    		<input type="hidden" id="tipo" name="tipo" value="<?=$tipo?>">
                    		<div class="">
                    			<div class="col-md-6 col-md-push-6 col-xs-12">
		                        	<div class="busqueda espacios"><input type="search" data-column="all" class="form-control search" placeholder="Buscar..."/></div>
		                        </div>
		                        <div class="col-md-6 col-xs-12 col-md-pull-6">
		                            <ul class="ulfiltros">
		                                <li class="lifiltros">
		                                    <div class="styled-select">
		                                        <select name="operador">
		                                            <option value="Activar" class="styled" <?php if($seguridad->valida_permiso_usuario($_SESSION['idusuario'],$clave3)==0) echo ' disabled ';?>>Activar</option>
		                                            <option value="Desactivar" class="styled" <?php if($seguridad->valida_permiso_usuario($_SESSION['idusuario'],$clave3)==0) echo ' disabled ';?>>Desactivar</option>
		                                            <option value="Eliminar" class="styled" <?php if($seguridad->valida_permiso_usuario($_SESSION['idusuario'],$clave2)==0) echo ' disabled ';?>>Eliminar</option>
		                                       </select>
		                                    </div>
		                                </li>
		                                <li class="lifiltros">
		                                    <button type="submit" class="buttonaplicar" name="operaciones" value="operaslide">Aplicar</button>
		                                </li>
		                            </ul>
		                        </div>
		                    </div>
		                    <div class="clearfix"></div>
		                    <!--Seccion de la tabla-->
		                    <div class="col-md-12 col-xs-12">
		                        <?php echo $permiso;?>
		                        <div class="table-responsive">
			                        <table id="table-short" class="table table-hover table-striped tablesorter">
			                            <thead class="styled-thead">
			                              <tr>
			                              	<th width="50">
			                                	<input type="checkbox" id="marcar" name="marcar" onclick="marcartodos(this);" value="marcar">
												<label for="marcar"><span></span></label>
			                                </th>
			                                <th width="150px">Imagen</th>
			                                <th>Título</th>
			                                <th class="text-center">Mostrar</th>
			                              </tr>
			                            </thead>
			                            <tbody class="styled-tbody" id="sortable">
			                    <?php
									foreach($listaTemporal as $elementoTemporal){
										if($seguridad->valida_permiso_usuario($_SESSION['idusuario'],$clave3)==0){
											if($elementoTemporal['status']!=0){
												$img='img/visible.png';
												$funcion='';
												$class = 'nover';
											}
											else{
										  		$img='img/invisible.png';
												$funcion='';
												$class = 'ver';
										   }
										}
										else{
											if($elementoTemporal['status']!=0){
												$img='img/visible.png';
												$funcion='changeStatus('.$elementoTemporal['idSlide'].',0,\'changeStatusSlide\')';
												$class = 'nover';
											}
											else{
										  		$img='img/invisible.png';
												$funcion='changeStatus('.$elementoTemporal['idSlide'].',1,\'changeStatusSlide\')';
												$class = 'ver';
										   }
										}
									?>
											<tr>
				                              	<td>
				                                 	<input type="hidden" name="idorden" class="idorden" value="<?=$elementoTemporal['idSlide']?>">
				                                	<input type="checkbox" id="<?=$elementoTemporal['idSlide']?>" name="idSlide[]" value="<?=$elementoTemporal['idSlide']?>">
													<label for="<?=$elementoTemporal['idSlide']?>"><span></span></label>
				                                </td>
				                               	<td>
				                                	<div class="edit manita" data-id="<?=$elementoTemporal['idSlide']?>" data-tituloes="<?=$elementoTemporal['titulo']?>" data-subtituloes="<?=$elementoTemporal['subtitulo']?>" data-subtitulo2es="<?=$elementoTemporal['subtitulo2']?>" data-subtitulo3es="<?=$elementoTemporal['subtitulo3']?>" data-linkes="<?=$elementoTemporal['link']?>" data-linkvideoes="<?=$elementoTemporal['linkVideo']?>" data-tituloen="<?=$elementoTemporal['tituloEn']?>" data-subtituloen="<?=$elementoTemporal['subtituloEn']?>" data-subtitulo2en="<?=$elementoTemporal['subtitulo2En']?>" data-subtitulo3en="<?=$elementoTemporal['subtitulo3En']?>" data-linken="<?=$elementoTemporal['linkEn']?>" data-linkvideoen ="<?=$elementoTemporal['linkVideoEn']?>" data-ruta="<?=$elementoTemporal['imgPortada']?>" data-rutamovil="<?=$elementoTemporal['imgMovil']?>">
				                                		<img src="../img/slide/<?=$elementoTemporal['imgPortada']?>" class="img-responsive">
				                                	<div>
				                                </td>
				                                <td>
				                                	<div class="edit manita" data-id="<?=$elementoTemporal['idSlide']?>" data-tituloes="<?=$elementoTemporal['titulo']?>" data-subtituloes="<?=$elementoTemporal['subtitulo']?>" data-subtitulo2es="<?=$elementoTemporal['subtitulo2']?>" data-subtitulo3es="<?=$elementoTemporal['subtitulo3']?>" data-linkes="<?=$elementoTemporal['link']?>" data-linkvideoes="<?=$elementoTemporal['linkVideo']?>" data-tituloen="<?=$elementoTemporal['tituloEn']?>" data-subtituloen="<?=$elementoTemporal['subtituloEn']?>" data-subtitulo2en="<?=$elementoTemporal['subtitulo2En']?>" data-subtitulo3en="<?=$elementoTemporal['subtitulo3En']?>" data-linken="<?=$elementoTemporal['linkEn']?>" data-linkvideoen ="<?=$elementoTemporal['linkVideoEn']?>" data-ruta="<?=$elementoTemporal['imgPortada']?>" data-rutamovil="<?=$elementoTemporal['imgMovil']?>">
				                                		<?=$elementoTemporal['titulo']?>
				                                	<div>
				                                </td>
				                                <td class="text-center">
				                                	<?=$handle?>
				                                	<img class="manita <?=$class?>" onclick="<?=$funcion?>" id="temp<?=$elementoTemporal['idSlide']?>" src="<?=$img?>">
				                                </td>
				                            </tr>
			                    <?php
									}
			                    ?>
			                            </tbody>
			                            <tfoot class="styled-tfoot">
			                              	<tr>
			                              		<th>
			                                		<input type="checkbox" id="marcar2" name="marcar2" onclick="marcartodos(this);" value="marcar2">
													<label for="marcar2"><span></span></label>
			                                	</th>
				                                <th width="150px">Imagen</th>
				                               	<th>Título</th>
				                                <th class="text-center">Mostrar</th>
			                              	</tr>
			                            </tfoot>
			                        </table>
			                       	<!-- pager -->
		                            <div id="pager" class="pager">
		                               	<form>
			                                <img src="img/first.png" class="first"/>
			                                <img src="img/prev.png" class="prev"/>
			                                <span class="pagedisplay"></span> <!-- this can be any element, including an input -->
			                                <img src="img/next.png" class="next"/>
			                                <img src="img/last.png" class="last"/>
			                                <select class="pagesize">
			                                  	<option value="10">10</option>
			                                  	<option value="40">40</option>
			                                  	<option value="50">50</option>
			                                  	<option value="100">100</option>
			                                </select>
			                            </form>
		                            </div>
			                    </div>
		                	</div><!--Div de cierre de la clase table-responsive-->
                    	</form>
            		</div>
            	</div>
	        </div>
	    </div>
		<div class="modal fade" id="modal-edit-table">
	    	<div class="modal-dialog" role="document">
	    		<form id="form-validation" style="display: inline" name="form1" action="operaciones.php" method="post" enctype="multipart/form-data">
	    			<input type="hidden" id="id" name="id" value="">
                   	<input type="hidden" id="operaciones" name="operaciones" value="">
                   	<input type="hidden" id="tipo" name="tipo" value="<?=$tipo?>">
                   	<input type="hidden" id="MOD" value="">
		    		<div class="modal-content">
		    			<div class="modal-header">
		    				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
		    					<span aria-hidden="true">&times;</span>
		    					<span class="sr-only">Close</span>
		    				</button>
		    				<h4 class="modal-title"></h4>
		    			</div>
		    			<div class="modal-body">
		    				<center class="espacios">
								PREVISUALIZAR IMAGEN PRINCIPAL
								<div id="preview-slide" class="espacios">
								</div>
								<input type="file" onchange="showMyImageWH('preview-slide', this, '', 1, 1920, 945)" name="imagen" id="" class="filestyle" data-input="false" data-buttonText="Imagen Principal" data-iconName="fa fa-picture-o" data-badge="false" data-type-file="imagen" data-validate="true" data-text="Imagen Principal">
								<p class="help-block">Solo se aceptan imágenes con formato .JPG, .JPEG, .PNG; La imagen debe ser menor a 3 MB. <br> La resolución óptima para esta imagen es de 1920 x 945px </p>
							</center>
							<center class="espacios" style="display:none">
								PREVISUALIZAR IMAGEN MOVIL
								<div id="preview-slide-movil" class="espacios">
								</div>
								<input type="file" onchange="showMyImageWH('preview-slide-movil', this, '', 1, 800, 800)" name="imagenMovil" id="" class="filestyle" data-input="false" data-buttonText="Imagen Movil" data-iconName="fa fa-picture-o" data-badge="false" data-type-file="imagen" data-validate="false" data-text="Imagen Movil">
								<p class="help-block">Solo se aceptan imagenes con formato .JPG, .JPEG, .PNG; La imagen debe ser menor a 3 MB. <br> La resolución óptima para esta imagen es de 800 x 800px </p>
							</center>
		    				<div class="input-group espacios">
			                    <span class="input-group-addon">Título</span>
			                    <input type="text" id="tituloEs" name="titulo[es]" data-validate="false" class="form-control" placeholder="Ingresa el título..." value="">
			                </div>
			                <div class="input-group espacios" style="display:none">
			                    <span class="input-group-addon">Subtítulo</span>
			                    <input type="text" id="subtituloEs" name="subtitulo[es]" data-validate="false" class="form-control" placeholder="Ingresa el subtitulo..." value="">
			                </div>
			               	<div class="input-group espacios" style="display:none">
			                    <span class="input-group-addon">Texto del botón</span>
			                    <input type="text" id="subtitulo2Es" name="subtitulo2[es]" data-validate="false" class="form-control" placeholder="Ingresa el texto del botón..." value="">
			                </div>
			                <!--<div class="input-group espacios">
			                    <span class="input-group-addon">Subtitulo3</span>
			                    <input type="text" id="subtitulo3Es" name="subtitulo3[es]" data-validate="false" class="form-control" placeholder="Ingresa el subtitulo..." value="">
			                    <span class="input-group-addon"> <i class="fa fa-globe"></i> ES</span>
			                </div>-->
			                <div class="input-group espacios" style="display:none">
			                    <span class="input-group-addon">Link del botón</span>
			                    <input type="text" id="linkEs" name="link[es]" data-validate="false" class="form-control" placeholder="Ingresa el link..." value="">
			                </div>
			                <div class="input-group espacios" style="display:none">
			                    <span class="input-group-addon">Link Video</span>
			                    <input type="text" id="linkVideoEs" name="linkVideo[es]" data-validate="false" class="form-control" placeholder="Ingresa el link de youtube..." value="">
			                    <span class="input-group-addon"> <i class="fa fa-globe"></i> ES</span>
			                </div>
			                <div class="input-group espacios" style="display:none">
			                    <span class="input-group-addon">Título</span>
			                    <input type="text" id="tituloEn" name="titulo[en]" data-validate="false" class="form-control" placeholder="Ingresa el título..." value="">
			                    <span class="input-group-addon"> <i class="fa fa-globe"></i> EN</span>
			                </div>
			                <div class="input-group espacios" style="display:none">
			                    <span class="input-group-addon">Subtitulo</span>
			                    <input type="text" id="subtituloEn" name="subtitulo[en]" data-validate="false" class="form-control" placeholder="Ingresa el subtitulo..." value="">
			                    <span class="input-group-addon"> <i class="fa fa-globe"></i> EN</span>
			                </div>

			                <!--<div class="input-group espacios">
			                    <span class="input-group-addon">Subtitulo2</span>
			                    <input type="text" id="subtitulo2En" name="subtitulo2[en]" data-validate="false" class="form-control" placeholder="Ingresa el subtitulo..." value="">
			                    <span class="input-group-addon"> <i class="fa fa-globe"></i> EN</span>
			                </div>
			                <div class="input-group espacios">
			                    <span class="input-group-addon">Subtitulo3</span>
			                    <input type="text" id="subtitulo3En" name="subtitulo3[en]" data-validate="false" class="form-control" placeholder="Ingresa el subtitulo..." value="">
			                    <span class="input-group-addon"> <i class="fa fa-globe"></i> EN</span>
			                </div>-->
			                <div class="input-group espacios" style="display:none">
			                    <span class="input-group-addon">Link</span>
			                    <input type="text" id="linkEn" name="link[en]" data-validate="false" class="form-control" placeholder="Ingresa el link..." value="">
			                    <span class="input-group-addon"> <i class="fa fa-globe"></i> EN</span>
			                </div>
			                <div class="input-group espacios" style="display:none">
			                    <span class="input-group-addon">Link Video</span>
			                    <input type="text" id="linkVideoEn" name="linkVideo[en]" data-validate="false" class="form-control" placeholder="Ingresa el link de youtube..." value="">
			                    <span class="input-group-addon"> <i class="fa fa-globe"></i> EN</span>
			                </div>
		    			</div>
		    			<div class="modal-footer">
		    				<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
		    				<button type="button" class="buttonguardar btn-save"<?php if($seguridad->valida_permiso_usuario($_SESSION['idusuario'],$clave5)==0) echo ' disabled ';?> >Guardar y Publicar</button>
		    			</div>
		    		</div><!-- /.modal-content -->
	    		</form>
	    	</div><!-- /.modal-dialog -->
	    </div><!-- /.modal -->
	</body>
	<footer id="footer">
		<?php include 'footer.php';?>
		<script src="js/functionsSlide.js"></script>
	</footer>
</html>
