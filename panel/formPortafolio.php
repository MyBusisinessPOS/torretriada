<?php
function __autoload($ClassName){
    include('clases/'.$ClassName.".php");
}
$seguridad = new seguridad();
$seguridad->candado();
$_MOD = '';
$sort = '';

(isset($_REQUEST['tipo'])) ? $_tipo = $_REQUEST['tipo'] : $_tipo = 1;

if(isset($_REQUEST['idPortafolio'])){
	$id = $_REQUEST['idPortafolio'];
	$operacion = 'modificarportafolio';
	$palabra = 'Editar ';
	$_MOD = '1';
	$temporal = new portafolio($id);
	$temporal -> getPortafolio();
}
else{
	$id = 0;
	$operacion = 'agregarportafolio';
	$palabra = 'Nuevo ';
	$_MOD = '0';
	$img = '';
	$temporal = new portafolio($id);
}
if($_tipo == 1){
	$clave = 'p_mod_portafolio';
	$clave2 = 'p_sort_galeria_producto';
	$_title = 'Proyecto';
	$familias = new categoria();
	$lsFam = $familias -> listCategoria(1,1,false,1,'',20,'es',false);
}else{
	$clave = 'p_mod_proyecto';
	$clave2 = 'p_sort_galeria_proyecto';
	$_title = 'Proyecto';
}

$categoria = new categoria();
//$_tipo = 0, $_pagina = 1, $_paginador = true, $_status = '', $_busqueda = '', $_registrosPorPagina = 20, $_lang = 'es', $_frontEnd = false
$_categoriasAnos = $categoria -> listCategoria($_tipo, 1, false, 1, '', 20, 'es', false);

$_categorias = $categoria -> listCategoria(4,1,false,1,'',20,'es',false);

$sort = 'galeriaPortafolio';
($seguridad->valida_permiso_usuario($_SESSION['idusuario'],$clave) != 0) ? $handle = '<i class="fa fa-arrows handle sortimg>"></i>' :  $handle = '';
?>
<!DOCTYPE html>
<html lang="es">
	<head>
		<?php include 'head.php';?>
		<title>Formulario | <?=$_title?></title>
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
	                        <p class="titulo"><?=$palabra.$_title?></p>
	                    </div>
	                    <form id="form-validation" style="display: inline" name="form1" action="operaciones.php" method="post" enctype="multipart/form-data">
	                    	<input type="hidden" name="tipo" value="<?=$_tipo?>">
                    		<input type="hidden" id="idPortafolio" name="idPortafolio" value="<?=$id?>">
                    		<input type="hidden" name="operaciones" value="<?=$operacion?>">
                    		<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    			<button type="button" <?php if($seguridad->valida_permiso_usuario($_SESSION['idusuario'],$clave)==0) echo ' disabled ';?>  class="buttonguardar">Guardar y Publicar</button>
                   			</div>
		                    <div class="clearfix"></div>
		                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		                    	<div class='notifications top-right'></div>
		                    	<div class='notifications bottom-right'></div>
		                    	<div role="tabpanel">
		                    		<!-- Nav tabs -->
		                    		<ul class="nav nav-tabs" role="tablist">
		                    			<li role="presentation" class="active">
		                    				<a href="#dpEs" aria-controls="home" role="tab" data-toggle="tab">Datos del proyecto</a>
		                    			</li>
		                    			<!--<li role="presentation">
		                    				<a href="#dpEn" aria-controls="tab" role="tab" data-toggle="tab">Datos Ingles</a>
		                    			</li>-->
		                    	<?php
		                    		if($_tipo == 1){
		                    	?>
		                    			<li role="presentation">
		                    				<a href="#uc" aria-controls="tab" role="tab" data-toggle="tab">Ficha Técnica y Archivos</a>
		                    			</li>
		                    			<li>
		                    				<a href="#categos" aria-controls="tab" rol="tab" data-toggle="tab">Categorías</a>
		                    			</li>
		                    	<?php
		                    		}
		                    	?>
		                    			<li role="presentation">
		                    				<a href="#pg" aria-controls="tab" role="tab" data-toggle="tab">Imagen</a>
		                    			</li>
		                    		</ul>

		                    		<!-- Tab panes -->
		                    		<div class="tab-content">
		                    			<div role="tabpanel" class="tab-pane active" id="dpEs">
		                    				<div class="col-lg-8 col-lg-offset-2 col-md-6 col-sm-12 col-xs-12">
		                    			<?php
		                    				$temporal -> obtenerDatosPortafolio('es');
		                    				if($_tipo == 2){
		                    			?>
		                    					<div class="input-group espacios" style="display:none">
		                    						<span class="input-group-addon">Categoría</span>
		                    					 	<select name="categoriasC[]" data-validate="false" data-text="Categoría" class="form-control selectpicker" multiple>
		                    					 		<option value="0">Selecciona una categoría</option>
		                    				<?php
												foreach ($_categorias as $_cat) {
											?>
														<option <?=($temporal -> existeCategoriaxPortafolio($_cat['idCategoria'])) ? ' selected' : '';?> value="<?=$_cat['idCategoria']?>"><?=$_cat['tituloEs']?></option>
											<?php
												}
											?>
		                    					 	</select>
		                    					</div>
		                    					<div class="input-group espacios" style="display:none">
		                    						<span class="input-group-addon">Año del Proyecto</span>
		                    					 	<select name="categorias[]" data-validate="false" data-text="Año" class="form-control selectpicker">
		                    					 		<option value="0">Selecciona un año</option>
		                    				<?php
												foreach ($_categoriasAnos as $_cata) {
											?>
														<option <?=($_cata['idCategoria']==$temporal->_idAnio) ? 'selected' : ''; ?> value="<?=$_cata['idCategoria']?>"><?=$_cata['tituloEs']?></option>
											<?php
												}
											?>
		                    					 	</select>
		                    					</div>
		                    			<?php
		                    				}
		                    			?>
		                    					<input type="hidden" name="lang[]" value="es">
		                    					<div class="input-group espacios">
						                        	<span class="input-group-addon">Título</span>
						                        	<input type="text" name="titulo[]" data-validate="true" class="form-control" placeholder="Ingresa el título del servicio..." value="<?=$temporal -> _datosPortafolio -> _titulo?>">
						                        </div>
						                        <div class="input-group espacios">
						                        	<span class="input-group-addon">Descripción</span>
						                        	<textarea data-summer="true" rows="5" class="form-control" data-validate="false" name="descripcion[]" id="descripcionEs"><?=$temporal -> _datosPortafolio -> _descripcion?></textarea>
						                        </div>
                                    <div class="input-group espacios">
						                        	<span class="input-group-addon">Detalles</span>
						                        	<textarea data-summer="true" rows="5" class="form-control" data-validate="false" name="descripcion2[]" id="descripcionEs2"><?=$temporal -> _datosPortafolio -> _descripcion2?></textarea>
						                        </div>

                                    <div class="input-group espacios">
						                        	<span class="input-group-addon">Link Google Maps</span>
						                        	<input type="text" name="marca[]" data-validate="false" class="form-control" placeholder="Ingresa el link de Google Maps..." value="<?=$temporal -> _datosPortafolio -> _marca?>">
						                        </div>
		                    				</div>
		                    			</div>
		                    			<div role="tabpanel" class="tab-pane" id="dpEn">
		                    				<div class="col-lg-8 col-lg-offset-2 col-md-6 col-sm-12 col-xs-12">
		                    			<?php
		                    				unset($temporal -> _datosPortafolio);
		                    				$temporal -> obtenerDatosPortafolio('en');
		                    			?>
		                    					<input type="hidden" name="lang[]" value="en">
		                    					<div class="input-group espacios">
						                        	<span class="input-group-addon">Título</span>
						                        	<input type="text" name="titulo[]" data-validate="false" class="form-control" placeholder="Ingresa el titulo del portafolio..." value="<?=$temporal -> _datosPortafolio -> _titulo?>">
						                        </div>
						                <?php
						                	if($_tipo != 2){
						                ?>
						                        <div class="input-group espacios">
						                        	<span class="input-group-addon">Subtitulo</span>
						                        	<input type="text" name="marca[]" data-validate="false" class="form-control" placeholder="Ingresa la marca del producto.." value="<?=$temporal -> _datosPortafolio -> _marca?>">
						                        </div>
						                <?php
						            	}
						            	?>

						                        <div class="input-group espacios">
						                        	<span class="input-group-addon">Descripción</span>
						                        	<textarea data-summer="true" rows="5" class="form-control" data-validate="false" name="descripcion[]" id="descripcionEn"><?=$temporal -> _datosPortafolio -> _descripcion?></textarea>
						                        </div>
                                    <div class="input-group espacios">
						                        	<span class="input-group-addon">Detalles</span>
						                        	<textarea data-summer="true" rows="5" class="form-control" data-validate="false" name="descripcion2[]" id="descripcionEn2"><?=$temporal -> _datosPortafolio -> _descripcion2?></textarea>
						                        </div>
		                    				</div>
		                    			</div>
		                    	<?php
		                    		if($_tipo == 1){
		                    	?>
		                    			<div role="tabpanel" class="tab-pane" id="uc">
		                    				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
		                    					<center class="espacios">
													FICHA TECNICA ESPAÑOL
													<div class="espacios">
														<?=($temporal -> _fichaTecnicaEs != '') ? '<iframe src="../documents/portafolio/'.$temporal -> _fichaTecnicaEs.'" width="100%" height="250px" frameborder="0"></iframe>' : '<div class="preview-example"></div>'?>
													</div>
													<input type="file" name="fichaTecnicaEs" id="" class="filestyle" data-input="false" data-buttonText="Ficha Técnica" data-iconName="fa fa-file-pdf-o" data-badge="false" data-type-file="pdf" data-validate="false" data-text="Ficha Técnica">
													<p class="help-block">Solo se aceptan imagenes con formato .pdf, debe ser menor a 5 MB.</p>
												</center>
												<center class="espacios">
													FICHA TECNICA INGLÉS
													<div class="espacios">
														<?=($temporal -> _fichaTecnicaEn != '') ? '<iframe src="../documents/portafolio/'.$temporal -> _fichaTecnicaEn.'" width="100%" height="250px" frameborder="0"></iframe>' : '<div class="preview-example"></div>'?>
													</div>
													<input type="file" name="fichaTecnicaEn" id="" class="filestyle" data-input="false" data-buttonText="Ficha Técnica" data-iconName="fa fa-file-pdf-o" data-badge="false" data-type-file="pdf" data-validate="false" data-text="Ficha Técnica">
													<p class="help-block">Solo se aceptan imagenes con formato .pdf, debe ser menor a 5 MB.</p>
												</center>
		                    				</div>


		                    				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
		                    					<center class="espacios">
													ARCHIVO EXTRA ESPAÑOL
													<div class="espacios">
														<?=($temporal -> _archivoEs != '') ? '<iframe src="../documents/portafolio/'.$temporal -> _archivoEs.'" width="100%" height="250px" frameborder="0"></iframe>' : '<div class="preview-example"></div>'?>
													</div>
													<input type="file" name="archivoEs" id="" class="filestyle" data-input="false" data-buttonText="ARCHIVO" data-iconName="fa fa-file-pdf-o" data-badge="false" data-type-file="pdf" data-validate="false" data-text="Archivo">
													<p class="help-block">Solo se aceptan imagenes con formato .pdf, debe ser menor a 5 MB.</p>
												</center>
												<center class="espacios">
													ARCHIVO EXTRA INGLÉS
													<div class="espacios">
														<?=($temporal -> _archivoEn != '') ? '<iframe src="../documents/portafolio/'.$temporal -> _archivoEn.'" width="100%" height="250px" frameborder="0"></iframe>' : '<div class="preview-example"></div>'?>
													</div>
													<input type="file" name="archivoEn" id="" class="filestyle" data-input="false" data-buttonText="ARCHIVO" data-iconName="fa fa-file-pdf-o" data-badge="false" data-type-file="pdf" data-validate="false" data-text="Archivo">
													<p class="help-block">Solo se aceptan imagenes con formato .pdf, debe ser menor a 5 MB.</p>
												</center>
		                    				</div>
		                    			</div>
		                    	<?php
		                    		}
		                    	?>
		                    	<?php
		                    		if($_tipo == 1){
		                    	?>
		                    			<div role="tabpanel" class="tab-pane" id="categos">
		                    				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-6 col-lg-offset-3">
		                    					<div class="input-group espacios">
						                        	<span class="input-group-addon" >Familias</span>
				                    				<select class="selectpicker" id="selectfamilias" name="selectfamilias[]" data-title="Selecciona una Familia" multiple data-live-search="true">
														<?php
														if(count($lsFam)>0){
															foreach ($lsFam as $c) {
														?>
															<option value="<?=$c['idCategoria']?>" <?=($temporal->existCatxPort($c['idCategoria'],1)) ? 'selected' : '' ; ?> data-name="<?=$c['tituloEs']?>"><?=$c['tituloEs']?></option>
														<?php
															}
														}
														?>
													</select>
												</div>
												<div class="input-group espacios">
						                        	<span class="input-group-addon">Categorías</span>
													<select class="selectpicker" name="selectcategorias[]" data-title="Selecciona una Categoría" id="selectcategorias" multiple>
												  		<!--<optgroup label="Condiments" data-max-options="2">
												    		<option>Mustard</option>
												    		<option>Ketchup</option>
												    		<option>Relish</option>
												  		</optgroup>-->

													</select>
												</div>
												<div class="input-group espacios">
						                        	<span class="input-group-addon">Subcategorías</span>
													<select class="selectpicker" name="selectsubcategorias[]" id="selectsubcategorias" data-title="Selecciona una Subcategoría" multiple >

													</select>
												</div>

		                    				</div>
		                    			</div>
		                    	<?php
		                    		}
		                    	?>
		                    			<div role="tabpanel" class="tab-pane" id="pg">
		                    				<div class="col-lg-8 col-lg-offset-2 col-md-6 col-sm-12 col-xs-12">
		                    					<center class="espacios">
													PREVISUALIZAR IMAGEN PROYECTO
													<div id="preview-proyecto" class="espacios">
														<?=($temporal -> _imgPortada != '') ? '<img class="img-responsive" style="height:150px;" src="../img/portafolio/'.$temporal -> _imgPortada.'">' : '<div class="preview-example"></div>'?>
													</div>
													<input type="file" onchange="showMyImageWH('preview-proyecto', this, '', 1, 1920, 1080)" name="imagen" id="" class="filestyle" data-input="false" data-buttonText="Imagen Principal" data-iconName="fa fa-picture-o" data-badge="false" data-type-file="imagen" data-validate="true" data-text="Imagen Principal">
													<p class="help-block">Solo se aceptan imágenes con formato .JPG, .JPEG, .PNG; La imagen debe ser menor a 3 MB. <br> La resolución óptima para esta imagen es de 1920 x 1080px </p>
												</center>
												<?php
												if($_tipo==1){ ?>
												<center class="espacios">
													PREVISUALIZAR IMAGEN MINIATURA
													<div id="preview-proyecto2" style="width: 50%;" class="espacios">
														<?=($temporal -> _imgMini != '') ? '<img class="img-responsive" style="height:250px;" src="../img/portafolio/'.$temporal -> _imgMini.'">' : '<div class="preview-example"></div>'?>
													</div>
													<input type="file" onchange="showMyImageWH('preview-proyecto2', this, '', 1, 450, 448)" name="imagenmini" id="" class="filestyle" data-input="false" data-buttonText="Imagen Miniatura" data-iconName="fa fa-picture-o" data-badge="false" data-type-file="imagen" data-validate="true" data-text="Imagen Principal">
													<p class="help-block">Solo se aceptan imagenes con formato .JPG, .JPEG, .PNG; La imagen debe ser menor a 3 MB. <br> La resolución óptima para esta imagen es de 450 x 448px </p>
												</center>
												<?php
												}
												?>

												<!--<div class="row">
													<div class="col-md-12 col-xs-12">
														<h2 class="text-center">GALERIA</h2>
														<center>
															<input type="file" multiple onchange="showMyImageWH('preview-proyecto-gal', this, '', 2, 1200, 0)" name="galeria[]" id="" class="filestyle" data-input="false" data-buttonText="Agregar Galeria" data-iconName="fa fa-picture-o" data-badge="true">
															<div data-toggle="modal" data-target="#myModal" class="btn btn-default inline-block"> <i class="fa fa-edit"></i> Editar Imagen </div>
															<p class="help-block">Solo se aceptan imagenes con formato .JPG, .JPEG, .PNG, la imagen debe ser menor a 3 MB. <br> La resolución óptima para esta imagen es de 1200</p>
														</center>
														<div id="carousel-id" class="carousel slide" data-ride="carousel">
											                    <ol class="carousel-indicators">
											            <?php
											                $_totalGal = count($temporal -> _galeria);
											                $_g = 0;
											                for($i = 0; $i < count($temporal -> _galeria); $i++){
											                    ($i == 0) ? $_classGal = ' active' : $_classGal = '';
											            ?>
											                        <li data-target="#carousel-id" data-slide-to="<?=$i?>" class="<?=$_classGal?>"></li>
											            <?php
											                }
											            ?>
											                    </ol>
											                    <div class="carousel-inner">
											            <?php
											                foreach ($temporal -> _galeria as $galeria) {
											                    ($_g == 0) ? $_classGalImg = ' active' : $_classGalImg = '';
											            ?>
											                        <div class="item <?=$_classGalImg?>">
											                            <center>
											                                <img data-src="../img/portafolio/galeria/<?=$galeria['ruta']?>" width="auto" height="200px" alt="First slide" src="../img/portafolio/galeria/<?=$galeria['ruta']?>">
											                            </center>
											                        </div>
											            <?php
											                    $_g++;
											            	}
											            	?>
											                   	</div>
											            </div>
											            <div class="espacios">&nbsp;</div>
													</div>
												</div>	-->
		                    				</div>
		                    			</div>
		                    		</div>
		                    	</div>
		                    </div>

		                    <div class="clearfix"></div>
		                    <!--Este div contiene la barra inferior-->
		                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		                    	<hr class="hrmenu">
		                    </div>
		                    <div class="clearfix"></div>
		                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		                    	<button type="button" <?php if($seguridad->valida_permiso_usuario($_SESSION['idusuario'],$clave)==0) echo ' disabled ';?> name="operaciones" value="<?=$operacion?>" class="buttonguardar">Guardar y Publicar</button>
		                    </div>
		                    <div class="modal fade" id="myModal">
								<div class="modal-dialog modal-lg">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
											<h4 class="modal-title">Editar Imagenes Galería</h4>
										</div>
										<div class="modal-body">
											<table class="table table-hover">
												<thead>
													<tr>
														<th class="text-center" width="50px">Imagen</th>
														<th class="text-center">Editar</th>
														<th class="text-center">Opciones</th>
													</tr>
												</thead>
												<tbody id="sortableImg">
										<?php
											foreach ($temporal -> _galeria as $galeria) {
										?>
													<tr id="img-content<?=$galeria['idGaleria']?>">
														<td class="text-center" id="imgedit<?=$galeria['idGaleria']?>">
															<img class="img-responsive" src="../img/portafolio/galeria/<?=$galeria['ruta']?>"/></td>
														<td class="text-center">
															<input type="hidden" name="idGaleria[]" value="<?=$galeria['idGaleria']?>"/>
														    <input type="hidden" class="idorden" name="idorden[]" value="<?=$galeria['idGaleria']?>"/>
															<input name="galeriaMod[]" type="file" onchange="showMyImage('imgedit<?=$galeria['idGaleria']?>',this)" class="filestyle" data-input="false" data-buttonText="Editar Imagen" data-iconName="fa fa-picture-o" data-badge="false"/>
														</td>
														<td class="text-center">
															<?=$handle?>
															<button type="button" rel="tooltip" title="Eliminar" class="btn btn-default" onclick="deleteElement(<?=$galeria['idGaleria']?>, 'img-content', 'deleteGaleriaLB', 'true')"> <i class="fa fa-trash"></i> </button>
														</td>
													</tr>
										<?php
											}
										?>
												</tbody>
											</table>
										</div>
										<div class="modal-footer">
											<button type="button" class="btn btn-default mar-top-5x" data-dismiss="modal">Close</button>
											<button type="submit" class="buttonguardar btn-modal">Guadar y Publicar</button>
										</div>
									</div>
								</div>
							</div>
                    	</form>
            		</div>
            	</div>
	        </div>
    	</div>

	</body>
	<footer id="footer">
		<?php include 'footer.php';?>
		<script src="js/functionsPortafolio.js"></script>
	</footer>
</html>
