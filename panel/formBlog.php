<?php
function __autoload($ClassName){
    include('clases/'.$ClassName.".php");
}
$seguridad = new seguridad();
$seguridad->candado();
$_MOD = '';
$sort = '';

if(isset($_REQUEST['id_blog'])){
	$id = $_REQUEST['id_blog'];
	$operacion = 'modificarblog';
	$palabra = 'Editar Blog';
	$_MOD = '1';
	$temporal = new blog($id);
	$temporal -> get_blog();
}
else{
	$id = 0;
	$operacion = 'agregarblog';
	$palabra = 'Nuevo Blog';
	$_MOD = '0';
	$img = '';
	$temporal = new blog($id);
}
$clave = 'p_mod_blog';
$clave2 ='p_sort_galeria_blog';
$sort = 'blog';
$handle = 'handle sortimg';

$categoria = new categoria();
$categorias = $categoria  -> listCategoria(3, 1, false, 1, '', 20, 'es');
?>
<!DOCTYPE html>
<html lang="es">
	<head>
		<?php include 'head.php';?>
		<!--<style>
			.content-planes .plan .panel-heading{padding-bottom: 20px; padding-top: 20px;}
			.content-planes .plan .panel-heading .panel-title{font-size: 30px; font-weight: 100;}
			.content-planes .plan .panel-body h2{margin: 15px 0 20px 0; font-weight: 100;}
			.content-planes .plan .panel-body ul{padding-left: 20px; padding-right: 20px;}
			.content-planes .plan .panel-body ul li{font-weight: 100; font-size: 15px; border-bottom: 1px solid #e2e2e2; padding-bottom: 10px; margin-bottom: 10px;}
			.content-planes .plan .panel-body ul li span{font-weight: bold;}
			.content-planes .plan .panel{-webkit-box-shadow: 0px 0px 20px -9px rgba(0,0,0,1); -moz-box-shadow: 0px 0px 20px -9px rgba(0,0,0,1); box-shadow: 0px 0px 20px -9px rgba(0,0,0,1); border: 0px solid #e2e2e2}
			.popover-title{color: #000;}
			.popover {max-width: 600px !important; }
		</style>-->
		<title>Formulario | Blog</title>
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
	                        <p class="titulo"><?=$palabra?></p>
	                    </div>
	                    <form id="form-validation" style="display: inline" name="form1" action="operaciones/operaciones_blog.php" method="post" enctype="multipart/form-data">
                    		<input type="hidden" name="id_blog" value="<?=$id?>">
                    		<input type="hidden" name="operaciones" value="<?=$operacion?>">
                    		<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    			<button type="button" <?php if($seguridad->valida_permiso_usuario($_SESSION['idusuario'],$clave)==0) echo ' disabled ';?>  class="buttonguardar">Guardar y Publicar</button>
                   			</div>

		                    <div class="clearfix"></div>
		                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		                    	<div class='notifications top-right'></div>
		                    	<div class='notifications bottom-right'></div>
		                    </div>

							<div role="tabpanel" class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <!--<button type="button" class="btn btn-panel do-translate pull-right"><i class="fa fa-language"></i> Traducir textos</button>-->
								<!-- Nav tabs -->
								<ul class="nav nav-tabs" role="tablist">
									<li role="presentation" class="active">
										<a href="#blog-es" aria-controls="blog-es" role="tab" data-toggle="tab">BLOG</a>
									</li>
									<!--<li role="presentation">
										<a href="#blog-en" aria-controls="blog-en" role="tab" data-toggle="tab">BLOG EN</a>
									</li>-->
									<li role="presentation">
										<a href="#galeria" aria-controls="galeria" role="tab" data-toggle="tab">CONTENIDO</a>
									</li>
								</ul>

								<!-- Tab panes -->
								<div class="tab-content">
									<div role="tabpanel" class="tab-pane espacios active" id="blog-es">
                                        <div class="col-lg-12">
                                            <div class="row">
                                                <div class="col-lg-4 col-md-12">
                                                    <div class="panel panel-default">
                                                        <div class="panel-heading">
                                                            <h3 class="panel-title">Portada</h3>
                                                        </div>
                                                        <div class="panel-body">
                                                            <center>
                                                                PREVISUALIZAR IMAGEN PORTADA
                                                                <div id="preview-img-blog" class="espacios">
                                                                    <?=($temporal -> _ruta != '') ? '<div class="espacios img-background" style="background-image: url(../img/blog/'.$temporal -> _ruta.');     background-size: cover;"><img style="width:100%; visibility: hidden" src="../img/blog/'.$temporal -> _ruta.'" /></div>' : '<div class="preview-example"></div>';?>
                                                                </div>
                                                                <input type="file" data-validate="true" data-type-file="imagen" data-text="portada" onchange="showMyImage('preview-img-blog', this)" name="archivo" class="filestyle" data-input="false" data-buttonText="Imagen Portada" data-iconName="fa fa-picture-o" data-badge="false">
                                                                <p class="help-block">Solo se aceptan imagenes con formato .JPG, .JPEG, La imagen debe ser menor a 3 MB.</p>
                                                            </center>
                                                            <br /><br />
                                                            <center>
                                                                PREVISUALIZAR IMAGEN REDES
                                                                <div id="preview-img-redes" class="espacios">
                                                                    <?=($temporal -> _rutaR != '') ? '<div class="espacios img-background" style="background-image: url(../img/blog/'.$temporal -> _rutaR.');     background-size: cover;"><img style="width:100%; visibility: hidden" src="../img/blog/'.$temporal -> _rutaR.'" /></div>' : '<div class="preview-example"></div>';?>
                                                                </div>
                                                                <input type="file" data-validate="true" data-type-file="imagen" data-text="redes" onchange="showMyImage('preview-img-redes', this)" name="archivoR" class="filestyle" data-input="false" data-buttonText="Imagen Redes" data-iconName="fa fa-picture-o" data-badge="false">
                                                                <p class="help-block">Solo se aceptan imagenes con formato .JPG, .JPEG, La imagen debe ser menor a 3 MB.</p>
                                                            </center>
                                                            <div class="input-group espacios" style="display:none">
                                                                <span class="input-group-addon">Categoría</span>
                                                                <select name="idCategoria" data-validate="false" data-text="Categoria" class="selectpicker">
                                                                    <option value="0">Elige una categoría</option>
                                                                    <?php
                                                                    foreach($categorias as $_cat){
                                                                        ?>
                                                                        <option <?=($_cat['idCategoria'] == $temporal -> _id_categoria) ? 'selected' : '';?> value="<?=$_cat['idCategoria']?>"><?=$_cat['titulo']?></option>
                                                                        <?php
                                                                    }

                                                                    ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-8 col-md-12">
                                                    <!-- TAB NAVIGATION -->
                                                    <ul class="nav nav-tabs" role="tablist">
                                                        <li class="active"><a href="#datos-es" role="tab" data-toggle="tab">Datos generales</a>
                                                        </li>
                                                        <!--<li><a href="#datos-en" role="tab" data-toggle="tab">Datos (EN)</a></li>-->
                                                        <!--<li><a href="#datos-fr" role="tab" data-toggle="tab">Datos (FR)</a></li>-->
                                                    </ul>
                                                    <!-- TAB CONTENT -->
                                                    <div class="tab-content">
                                                        <div class="active tab-pane fade in" id="datos-es">
    <?php
        $temporal -> obtener_datos_blog('es');
    ?>
                                                            <div class="panel panel-default">
                                                                <div class="panel-heading">
                                                                    <h3 class="panel-title">Ingresa los datos generales del blog</h3>
                                                                </div>
                                                                <div class="panel-body">
                                                                    <div class="input-group espacios">
                                                                        <span class="input-group-addon">Título</span>
                                                                        <input type="text" name="titulo[es]" data-idtarget="titulo-" data-validate="true" class="form-control apply-translate" placeholder="Ingresa el titulo del blog..." value="<?=$temporal -> _datos_blog -> _titulo?>">
                                                                    </div>
                                                                    <div class="input-group espacios">
                                                                        <span class="input-group-addon">Autor</span>
                                                                        <input type="text" name="subtitulo[es]" data-idtarget="subtitulo-" data-validate="true" class="form-control apply-translate" placeholder="Ingresa el autor de la nota..." value="<?=$temporal -> _datos_blog -> _subtitulo?>">
                                                                    </div>
                                                                    <div class="input-group espacios">
                                                                        <span class="input-group-addon">Descripción corta</span>
                                                                        <textarea data-summer="true" rows="5" class="form-control apply-translate" data-validate="false" name="descripcion[es]" data-idtarget="descripcion-" id="descripcion-es"><?=$temporal -> _datos_blog -> _descripcion?></textarea>
                                                                    </div>
                                                                    <div class="input-group espacios">
                                                                        <span class="input-group-addon">Tags</span>
                                                                        <textarea name="tags[es]" class="apply-tags apply-translate" data-idtarget="tags-" id="" cols="30" rows="10"><?=$temporal -> _datos_blog -> _tags?></textarea>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="tab-pane fade" id="datos-en" style="display:none">
    <?php
        $temporal -> obtener_datos_blog('en');
    ?>
                                                            <div class="panel panel-default">
                                                                <div class="panel-heading">
                                                                    <h3 class="panel-title">Datos Blog (EN) </h3>
                                                                </div>
                                                                <div class="panel-body">
                                                                    <div class="input-group espacios">
                                                                        <span class="input-group-addon">Titulo</span>
                                                                        <input type="text" name="titulo[en]" id="titulo-en" data-validate="false" class="form-control" placeholder="Ingresa el titulo del blog..." value="<?=$temporal -> _datos_blog -> _titulo?>">
                                                                    </div>
                                                                    <div class="input-group espacios">
                                                                        <span class="input-group-addon">Fecha</span>
                                                                        <input type="text" name="subtitulo[en]" id="subtitulo-en" data-validate="false" class="form-control" placeholder="Ingresa el subtitulo del blog..." value="<?=$temporal -> _datos_blog -> _subtitulo?>">
                                                                    </div>
                                                                    <div class="input-group espacios">
                                                                        <span class="input-group-addon">Descripción</span>
                                                                        <textarea data-summer="true" rows="5" class="form-control" data-validate="false" name="descripcion[en]" id="descripcion-en"><?=$temporal -> _datos_blog -> _descripcion?></textarea>
                                                                    </div>
                                                                    <div class="input-group espacios">
                                                                        <span class="input-group-addon">Tags</span>
                                                                        <textarea name="tags[en]" class="apply-tags" id="tags-en" cols="30" rows="10"><?=$temporal -> _datos_blog -> _tags?></textarea>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="tab-pane fade" id="datos-fr">
<!--
    <?php
        $temporal -> obtener_datos_blog('fr');
    ?>
                                                            <div class="panel panel-default">
                                                                <div class="panel-heading">
                                                                    <h3 class="panel-title">Datos Blog (FR) </h3>
                                                                </div>
                                                                <div class="panel-body">
                                                                    <div class="input-group espacios">
                                                                        <span class="input-group-addon">Titulo</span>
                                                                        <input type="text" name="titulo[fr]" id="titulo-fr" data-validate="true" class="form-control" placeholder="Ingresa el titulo del blog..." value="<?=$temporal -> _datos_blog -> _titulo?>">
                                                                    </div>
                                                                    <div class="input-group espacios">
                                                                        <span class="input-group-addon">Subtitulo</span>
                                                                        <input type="text" name="subtitulo[fr]" id="subtitulo-fr" data-validate="true" class="form-control" placeholder="Ingresa el subtitulo del blog..." value="<?=$temporal -> _datos_blog -> _subtitulo?>">
                                                                    </div>
                                                                    <div class="input-group espacios">
                                                                        <span class="input-group-addon">Descripción</span>
                                                                        <textarea data-summer="true" rows="5" class="form-control" data-validate="false" name="descripcion[fr]" id="descripcion-fr"><?=$temporal -> _datos_blog -> _descripcion?></textarea>
                                                                    </div>
                                                                    <div class="input-group espacios">
                                                                        <span class="input-group-addon">Tags</span>
                                                                        <textarea name="tags[fr]" class="apply-tags" id="tags-fr" cols="30" rows="10"><?=$temporal -> _datos_blog -> _tags?></textarea>
                                                                    </div>
                                                                </div>
                                                            </div>-->
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

									</div>

									<div role="tabpanel" class="tab-pane espacios" id="galeria">
										<div class="col-md-8 col-md-offset-2 col-sm-12 col-xs-12">
											<div class="content-buttons-add">
												<div class="content-button">
													<div class="btn btn-panel" id="add-texto">Agregar Texto</div>
													<div class="btn btn-panel" id="add-imagen">Agregar Imagen</div>
													<div class="btn btn-panel" id="add-video">Agregar Video</div>
													<div class="btn btn-panel" id="add-galeria">Agregar Galería</div>
												</div>
											</div>
										</div>
                                        <p class="espacios mar-top-30x">&nbsp;</p>
                                        <div class="col-lg-10 col-lg-offset-1 col-md-12">
                                            <div class="row">
                                        <?php /*?>
                                                <!-- CONTENIDO TEXTO -->
                                                <div class="col-md-12" id="contenido-blog-1">
                                                    <div class="close" onclick="deleteElementBlog(1,'contenido-blog-', '', 'false')"> <i class="fa fa-times"></i> </div>
                                                    <!-- TAB NAVIGATION -->
                                                    <ul class="nav nav-tabs" role="tablist">
                                                        <li class="active"><a href="#desc-es-1" role="tab" data-toggle="tab">Descripción (ES)</a>
                                                        </li>
                                                        <li><a href="#desc-en-1" role="tab" data-toggle="tab">Descripción (EN)</a></li>
                                                        <li><a href="#desc-fr-1" role="tab" data-toggle="tab">Descripción (FR)</a></li>
                                                    </ul>
                                                    <!-- TAB CONTENT -->
                                                    <div class="tab-content">
                                                        <div class="active tab-pane fade in" id="desc-es-1">
                                                            <div class="panel panel-default">
                                                                <div class="panel-heading">
                                                                    <h3 class="panel-title">Descripción</h3>
                                                                </div>
                                                                <div class="panel-body">
                                                                    <div class="input-group espacios">
                                                                        <span class="input-group-addon">Descripción</span>
                                                                        <textarea data-summer="true" rows="5" class="form-control apply-translate" data-validate="false" name="contenido-descripcion-1[es]" data-idtarget="contenido-descripcion-1-" id="contenido-descripcion-1-es"></textarea>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="tab-pane fade" id="desc-en-1">
                                                            <div class="panel panel-default">
                                                                <div class="panel-heading">
                                                                    <h3 class="panel-title">Descripción</h3>
                                                                </div>
                                                                <div class="panel-body">
                                                                    <div class="input-group espacios">
                                                                        <span class="input-group-addon">Descripción</span>
                                                                        <textarea data-summer="true" rows="5" class="form-control" data-validate="false" name="contenido-descripcion-1[en]" id="contenido-descripcion-1-en"></textarea>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="tab-pane fade" id="desc-fr-1">
                                                            <div class="panel panel-default">
                                                                <div class="panel-heading">
                                                                    <h3 class="panel-title">Descripción</h3>
                                                                </div>
                                                                <div class="panel-body">
                                                                    <div class="input-group espacios">
                                                                        <span class="input-group-addon">Descripción</span>
                                                                        <textarea data-summer="true" rows="5" class="form-control" data-validate="false" name="contenido-descripcion-1[fr]" id="contenido-descripcion-1-fr"></textarea>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                        <?php */?>
                                        <?php /*?>
                                                <!-- CONTENIDO IMAGEN -->
                                                <div class="col-lg-10 col-lg-offset-1 col-md-12" id="contenido-blog-2">
                                                    <div class="close" onclick="deleteElementBlog(2,'contenido-blog-', '', 'false')"> <i class="fa fa-times"></i> </div>
                                                    <div class="panel panel-default mar-top-30x">
                                                        <div class="panel-heading">
                                                            <h3 class="panel-title">Imagen</h3>
                                                        </div>
                                                        <div class="panel-body">
                                                            <center>
                                                                <div id="preview-img-contenido-2?>" class="espacios">
                                                                    <img width="100%" height="250px" src="../img/blog/contenido/" />
                                                                </div>
                                                                <input type="file" onchange="showMyImageWH('preview-img-contenido-2', this, '', 1, 650, 300)" name="img-contenido-2" class="filestyle" data-input="false" data-buttonText="Imagen" data-iconName="fa fa-picture-o" data-badge="true">
                                                                <p class="help-block">Solo se aceptan imagenes con formato .JPG, .JPEG, .PNG, la imagen debe ser menor a 3 MB.</p>
                                                            </center>
                                                        </div>
                                                    </div>
                                                </div>
                                        <?php */?>
                                        <?php /*?>
                                                <!-- CONTENIDO VIDEO -->
                                                <div class="col-lg-10 col-lg-offset-1 col-md-12" id="contenido-blog-3">
                                                    <div class="close" onclick="deleteElementBlog(3,'contenido-blog-', '', 'false')"> <i class="fa fa-times"></i> </div>
                                                    <div class="panel panel-default mar-top-30x">
                                                        <div class="panel-heading">
                                                            <h3 class="panel-title">Video</h3>
                                                        </div>
                                                        <div class="panel-body">
                                                            <center>
                                                                <div id="preview-video-contenido-3?>" class="espacios">
                                                                    <img width="100%" height="250px" src="../img/blog/contenido/" />
                                                                </div>
                                                                <input type="file" onchange="showMyImageWH('preview-video-contenido-3', this, '', 1, 650, 300)" name="video-contenido-3" class="filestyle" data-input="false" data-buttonText="Imagen Portada" data-iconName="fa fa-picture-o" data-badge="true">
                                                                <p class="help-block">Solo se aceptan imagenes con formato .JPG, .JPEG, .PNG, la imagen debe ser menor a 3 MB.</p>
                                                            </center>
                                                            <div class="input-group espacios">
                                                                <span class="input-group-addon">Url</span>
                                                                <input type="text" name="url-contenido-3" data-validate="true" class="form-control" placeholder="Ingresa la url del video.." value="">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                        <?php */?>
                                        <?php /*?>
                                                <!-- CONTENIDO GALERIA -->
                                                <div class="col-lg-10 col-lg-offset-1 col-md-12" id="contenido-blog-4">
                                                    <div class="close" onclick="deleteElementBlog(4,'contenido-blog-', '', 'false')"> <i class="fa fa-times"></i> </div>
                                                    <div class="panel panel-default mar-top-30x">
                                                        <div class="panel-heading">
                                                            <h3 class="panel-title">Galería</h3>
                                                        </div>
                                                        <div class="panel-body">
                                                            <center>
                                                                <input type="file" multiple name="galeria-contenido-4[]" class="filestyle" data-input="false" data-buttonText="Galeria" data-iconName="fa fa-picture-o" data-badge="true">
                                                                <p class="help-block">Solo se aceptan imagenes con formato .JPG, .JPEG, .PNG, la imagen debe ser menor a 3 MB.</p>
                                                            </center>
                                                        </div>
                                                    </div>
                                                </div>
                                        <?php */?>
                                            </div>
                                        </div>
										<div class="col-md-8 col-md-offset-2 col-sm-12 col-xs-12 mar-top-100x">
					                    	<div class="row" id="content-element-blog">

					                <?php
					                	if(isset($temporal -> _contenido_blog)){
					                		foreach ($temporal -> _contenido_blog as $_content) {
												if($_content['tipo'] == 1){
									?>
												<!--<div class="col-lg-6 col-lg-offset-3 col-md-12 col-xs-12" id="contenido-blog-mod-<?/*=$_content['id_contenido_blog']*/?>">
					                    			<div class="close" onclick="deleteElementBlog(<?/*=$_content['id_contenido_blog']*/?>,'contenido-blog-mod-', 'deleteContenidoBlog', 'true')"> <i class="fa fa-times"></i> </div>
					                    			<i class="fa fa-arrows order-right <?/*=$handle*/?>"></i>
					                    			<input type="hidden" class="idorden" name="temporal-id-mod[]" value="<?/*=$_content['id_contenido_blog']*/?>">
					                    			<input type="hidden" name="tipo-contenido-mod[]" value="1">
					                    			<div class="input-group espacios">
							                        	<span class="input-group-addon">Descripción</span>
							                        	<textarea data-summer="true" rows="5" class="form-control" data-validate="false" name="descripcion-contenido-mod-<?/*=$_content['id_contenido_blog']*/?>" id="desc-cont-mod-<?/*=$_content['id_contenido_blog']*/?>"><?/*=$_content['descripcion_es']*/?></textarea>
							                        	<span class="input-group-addon">ES</span>
							                        </div>
							                        <hr class="divisor-seccion">
					                    		</div>-->
                                                <!-- CONTENIDO TEXTO -->
                                                <div class="col-md-12" id="contenido-blog-mod-<?=$_content['id_contenido_blog']?>">
                                                    <div class="close" onclick="deleteElementBlog(<?=$_content['id_contenido_blog']?>,'contenido-blog-mod-', 'deleteContenidoBlog', 'true')"> <i class="fa fa-times"></i> </div>
                                                    <i class="fa fa-arrows order-right <?=$handle?>"></i>
                                                    <input type="hidden" class="idorden" name="temporal-id-mod[]" value="<?=$_content['id_contenido_blog']?>">
                                                    <input type="hidden" name="tipo-contenido-mod[]" value="1">
                                                    <!-- TAB NAVIGATION -->
                                                    <ul class="nav nav-tabs" role="tablist">
                                                        <li class="active"><a href="#desc-es-mod-<?=$_content['id_contenido_blog']?>" role="tab" data-toggle="tab">Descripción (bloque de texto)</a>
                                                        </li>
                                                        <li style="display:none"><a href="#desc-en-mod-<?=$_content['id_contenido_blog']?>" role="tab" data-toggle="tab">Descripción (EN)</a></li>
                                                        <!--<li><a href="#desc-fr-mod-<?=$_content['id_contenido_blog']?>" role="tab" data-toggle="tab">Descripción (FR)</a></li>-->
                                                    </ul>
                                                    <!-- TAB CONTENT -->
                                                    <div class="tab-content">
                                                        <div class="active tab-pane fade in" id="desc-es-mod-<?=$_content['id_contenido_blog']?>">
                                                            <div class="panel panel-default">
                                                                <div class="panel-heading">
                                                                    <h3 class="panel-title">Descripción</h3>
                                                                </div>
                                                                <div class="panel-body">
                                                                    <div class="input-group espacios">
                                                                        <span class="input-group-addon">Descripción</span>
                                                                        <textarea data-summer="true" rows="5" class="form-control apply-translate" data-validate="false" name="descripcion-contenido-es-mod-<?=$_content['id_contenido_blog']?>" data-idtarget="contenido-descripcion-mod-<?=$_content['id_contenido_blog']?>-" id="contenido-descripcion-mod-<?=$_content['id_contenido_blog']?>-es"><?=$_content['descripcion_es']?></textarea>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="tab-pane fade" id="desc-en-mod-<?=$_content['id_contenido_blog']?>">
                                                            <div class="panel panel-default">
                                                                <div class="panel-heading">
                                                                    <h3 class="panel-title">Descripción</h3>
                                                                </div>
                                                                <div class="panel-body">
                                                                    <div class="input-group espacios">
                                                                        <span class="input-group-addon">Descripción</span>
                                                                        <textarea data-summer="true" rows="5" class="form-control" data-validate="false" name="descripcion-contenido-en-mod-<?=$_content['id_contenido_blog']?>" id="contenido-descripcion-mod-<?=$_content['id_contenido_blog']?>-en"><?=$_content['descripcion_en']?></textarea>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!--<div class="tab-pane fade" id="desc-fr-mod-<?=$_content['id_contenido_blog']?>">
                                                            <div class="panel panel-default">
                                                                <div class="panel-heading">
                                                                    <h3 class="panel-title">Descripción</h3>
                                                                </div>
                                                                <div class="panel-body">
                                                                    <div class="input-group espacios">
                                                                        <span class="input-group-addon">Descripción</span>
                                                                        <textarea data-summer="true" rows="5" class="form-control" data-validate="false" name="descripcion-contenido-fr-mod-<?=$_content['id_contenido_blog']?>" id="contenido-descripcion-mod-<?=$_content['id_contenido_blog']?>-fr"><?=$_content['descripcion_fr']?></textarea>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>-->
                                                    </div>
                                                </div>
									<?php
												}else if($_content['tipo'] == 2){
									?>
												<!--<div class="col-lg-6 col-lg-offset-3 col-md-12 col-xs-12" id="contenido-blog-mod-<?/*=$_content['id_contenido_blog']*/?>">
					                    			<div class="close" onclick="deleteElementBlog(<?/*=$_content['id_contenido_blog']*/?>,'contenido-blog-mod-', 'deleteContenidoBlog', 'true')"> <i class="fa fa-times"></i> </div>
					                    			<i class="fa fa-arrows order-right <?/*=$handle*/?>"></i>
					                    			<input type="hidden" class="idorden" name="temporal-id-mod[]" value="<?/*=$_content['id_contenido_blog']*/?>">
					                    			<input type="hidden" name="tipo-contenido-mod[]" value="2">
					                    			<center>
					                    				<div id="preview-img-contenido-mod-<?/*=$_content['id_contenido_blog']*/?>" class="espacios">
					                    					<img width="100%" class="img-responsive none" height="250px" src="../img/blog/contenido/<?/*=$_content['imagen']*/?>" />
					                    				</div>
														<input type="file" onchange="showMyImageWH('preview-img-contenido-mod-<?/*=$_content['id_contenido_blog']*/?>', this, '', 1, 650, 300)" name="img-contenido-mod-<?/*=$_content['id_contenido_blog']*/?>" class="filestyle" data-input="false" data-buttonText="Imagen" data-iconName="fa fa-picture-o" data-badge="true">
														<p class="help-block">Solo se aceptan imagenes con formato .JPG, .JPEG, .PNG, la imagen debe ser menor a 3 MB.</p>
													</center>
													<hr class="divisor-seccion">
					                    		</div>-->

                                                <!-- CONTENIDO IMAGEN -->
                                                <div class="col-lg-10 col-lg-offset-1 col-md-12" id="contenido-blog-mod-<?=$_content['id_contenido_blog']?>">
                                                    <div class="close" onclick="deleteElementBlog(<?=$_content['id_contenido_blog']?>,'contenido-blog-mod-', 'deleteContenidoBlog', 'true')"> <i class="fa fa-times"></i> </div>
                                                    <i class="fa fa-arrows order-right <?=$handle?>"></i>
                                                    <input type="hidden" class="idorden" name="temporal-id-mod[]" value="<?=$_content['id_contenido_blog']?>">
                                                    <input type="hidden" name="tipo-contenido-mod[]" value="2">
                                                    <div class="panel panel-default mar-top-30x">
                                                        <div class="panel-heading">
                                                            <h3 class="panel-title">Imagen</h3>
                                                        </div>
                                                        <div class="panel-body">
                                                            <center>
                                                                <div id="preview-img-contenido-mod-<?=$_content['id_contenido_blog']?>" class="espacios">
                                                                    <?=($_content['imagen'] != '') ? '<div class="espacios img-background" style="background-image: url(../img/blog/contenido/'.$_content['imagen'].');background-repeat:no-repeat;background-position:center;"><img style="max-width:100%; visibility: hidden" src="../img/blog/contenido/'.$_content['imagen'].'" /></div>' : '<div class="preview-example"></div>'?>
                                                                </div>
                                                                <input type="file" onchange="showMyImageWH('preview-img-contenido-mod-<?= $_content['id_contenido_blog']?>', this, '', 1, 650, 300)" name="img-contenido-mod-<?=$_content['id_contenido_blog']?>" class="filestyle" data-input="false" data-buttonText="Imagen" data-iconName="fa fa-picture-o" data-badge="true">
                                                                <p class="help-block">Solo se aceptan imagenes con formato .JPG, .JPEG, .PNG, la imagen debe ser menor a 3 MB.</p>
                                                            </center>
                                                        </div>
                                                    </div>
                                                </div>
									<?php
												}else if($_content['tipo'] == 3){
									?>
												<!--<div class="col-lg-6 col-lg-offset-3 col-md-12 col-xs-12" id="contenido-blog-mod-<?/*=$_content['id_contenido_blog']*/?>">
					                    			<div class="close" onclick="deleteElementBlog(<?/*=$_content['id_contenido_blog']*/?>,'contenido-blog-mod-', 'deleteContenidoBlog', 'true')"> <i class="fa fa-times"></i> </div>
					                    			<i class="fa fa-arrows order-right <?/*=$handle*/?>"></i>
					                    			<input type="hidden" class="idorden" name="temporal-id-mod[]" value="<?/*=$_content['id_contenido_blog']*/?>">
					                    			<input type="hidden" name="tipo-contenido-mod[]" value="3">
					                    			<center>
					                    				<div id="preview-video-contenido-mod-<?/*=$_content['id_contenido_blog']*/?>" class="espacios">
					                    					<img width="100%" class="img-responsive none" height="250px" src="../img/blog/contenido/<?/*=$_content['imagen']*/?>" />
					                    				</div>
														<input type="file" onchange="showMyImageWH('preview-video-contenido-mod-<?/*=$_content['id_contenido_blog']*/?>', this, '', 1, 650, 300)" name="video-contenido-mod-<?/*=$_content['id_contenido_blog']*/?>" class="filestyle" data-input="false" data-buttonText="Imagen Video" data-iconName="fa fa-picture-o" data-badge="true">
														<div class="input-group espacios">
								                        	<span class="input-group-addon">Url</span>
								                        	<input type="text" name="url-contenido-mod-<?/*=$_content['id_contenido_blog']*/?>" data-validate="true" class="form-control" placeholder="Ingresa la url del video.." value="<?/*=$_content['url']*/?>">
								                        </div>
														<p class="help-block">Solo se aceptan imagenes con formato .JPG, .JPEG, .PNG, la imagen debe ser menor a 3 MB.</p>
													</center>
													<hr class="divisor-seccion">
					                    		</div>-->

                                                <!-- CONTENIDO VIDEO -->
                                                <div class="col-lg-10 col-lg-offset-1 col-md-12" id="contenido-blog-mod-<?=$_content['id_contenido_blog']?>">
                                                    <div class="close" onclick="deleteElementBlog(<?=$_content['id_contenido_blog']?>,'contenido-blog-mod-', 'deleteContenidoBlog', 'true')"> <i class="fa fa-times"></i> </div>
                                                    <i class="fa fa-arrows order-right <?=$handle?>"></i>
                                                    <input type="hidden" class="idorden" name="temporal-id-mod[]" value="<?=$_content['id_contenido_blog']?>">
                                                    <input type="hidden" name="tipo-contenido-mod[]" value="3">
                                                    <div class="panel panel-default mar-top-30x">
                                                        <div class="panel-heading">
                                                            <h3 class="panel-title">Video</h3>
                                                        </div>
                                                        <div class="panel-body">
                                                            <center>
                                                                <div id="preview-video-contenido-mod-<?=$_content['id_contenido_blog']?>?>" class="espacios">
                                                                   <?=($_content['imagen'] != '') ? '<div class="espacios img-background" style="background-image: url(../img/blog/contenido/'.$_content['imagen'].');"><img style="width:100%; visibility: hidden" src="../img/blog/contenido/'.$_content['imagen'].'" /></div>' : '<div class="preview-example"></div>'?>
                                                                </div>
                                                                <input type="file" onchange="showMyImageWH('preview-video-contenido-mod-<?=$_content['id_contenido_blog']?>', this, '', 1, 650, 300)" name="video-contenido-mod-<?=$_content['id_contenido_blog']?>" class="filestyle" data-input="false" data-buttonText="Imagen Portada" data-iconName="fa fa-picture-o" data-badge="true">
                                                                <p class="help-block">Solo se aceptan imagenes con formato .JPG, .JPEG, .PNG, la imagen debe ser menor a 3 MB.</p>
                                                            </center>
                                                            <div class="input-group espacios">
                                                                <span class="input-group-addon">Url</span>
                                                                <input type="text" name="url-contenido-mod-<?=$_content['id_contenido_blog']?>" data-validate="true" class="form-control" placeholder="Ingresa la url del video.." value="<?=$_content['url']?>">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
									<?php
												}else if($_content['tipo'] == 4){
									?>
												<!--<div class="col-lg-6 col-lg-offset-3 col-md-12 col-xs-12" id="contenido-blog-mod-<?/*=$_content['id_contenido_blog']*/?>">
					                    			<div class="close" onclick="deleteElementBlog(<?/*=$_content['id_contenido_blog']*/?>,'contenido-blog-mod-', 'deleteContenidoBlog', 'true')"> <i class="fa fa-times"></i> </div>
					                    			<i class="fa fa-arrows order-right <?/*=$handle*/?>"></i>
					                    			<input type="hidden" class="idorden" name="temporal-id-mod[]" value="<?/*=$_content['id_contenido_blog']*/?>">
					                    			<input type="hidden" name="tipo-contenido-mod[]" value="4">
					                    			<center>
														<input type="file" multiple onchange="showMyImageWH('preview-galeria-contenido-mod-<?/*=$_content['id_contenido_blog']*/?>', this, '', 2, 650, 300)" name="galeria-contenido-mod-<?/*=$_content['id_contenido_blog']*/?>[]" class="filestyle" data-input="false" data-buttonText="Galeria" data-iconName="fa fa-picture-o" data-badge="true">
														<p class="help-block">Solo se aceptan imagenes con formato .JPG, .JPEG, .PNG, la imagen debe ser menor a 3 MB.</p>
													</center>
													<div class="col-md-12 col-xs-12">
														<div class="row" id="preview-galeria-contenido-mod-<?/*=$_content['id_contenido_blog']*/?>"></div>
														<div class="row">
											<?php
/*												if(isset($_content['galeria'])){
													foreach ($_content['galeria'] as $_galeria) {
											*/?>
															<div class="col-md-4 col-xs-12" id="content-galeria-<?/*=$_galeria['id_galeria']*/?>">
																<div class="close" onclick="deleteElementBlog(<?/*=$_galeria['id_galeria']*/?>,'content-galeria-', 'deleteGaleriaContenido', 'true')"> <i class="fa fa-times"></i> </div>
																<center>
								                    				<div id="preview-img-contenido-galeria-<?/*=$_galeria['id_galeria']*/?>" class="espacios">
								                    					<img width="100%" class="img-responsive none" height="250px" src="../img/blog/contenido/galeria/<?/*=$_galeria['ruta']*/?>" />
								                    				</div>
								                    				<input type="hidden" name="id_galeria-<?/*=$_content['id_contenido_blog']*/?>[]" value="<?/*=$_galeria['id_galeria']*/?>">
																	<input type="file" onchange="showMyImageWH('preview-img-contenido-galeria-<?/*=$_galeria['id_galeria']*/?>', this, '', 1, 650, 300)" name="img-galeria-mod-<?/*=$_content['id_contenido_blog']*/?>[]" class="filestyle" data-input="false" data-buttonText="Imagen" data-iconName="fa fa-picture-o" data-badge="true">
																	<p class="help-block">Solo se aceptan imagenes con formato .JPG, .JPEG, .PNG, la imagen debe ser menor a 3 MB.</p>
																</center>

															</div>
											<?php
/*													}
												}
											*/?>
														</div>
													</div>
													<hr class="divisor-seccion">
					                    		</div>-->
                                                <!-- CONTENIDO GALERIA -->
                                                <div class="col-lg-10 col-lg-offset-1 col-md-12" id="contenido-blog-mod-<?=$_content['id_contenido_blog']?>">
                                                    <div class="close" onclick="deleteElementBlog(<?=$_content['id_contenido_blog']?>,'contenido-blog-mod-', 'deleteContenidoBlog', 'true')"> <i class="fa fa-times"></i> </div>
                                                    <i class="fa fa-arrows order-right <?=$handle?>"></i>
                                                    <input type="hidden" class="idorden" name="temporal-id-mod[]" value="<?=$_content['id_contenido_blog']?>">
                                                    <input type="hidden" name="tipo-contenido-mod[]" value="4">
                                                    <div class="panel panel-default mar-top-30x">
                                                        <div class="panel-heading">
                                                            <h3 class="panel-title">Galería</h3>
                                                        </div>
                                                        <div class="panel-body">
                                                            <center>
                                                                <input type="file" multiple name="galeria-contenido-mod-<?=$_content['id_contenido_blog']?>[]" class="filestyle" data-input="false" data-buttonText="Galeria" data-iconName="fa fa-picture-o" data-badge="true">
                                                                <p class="help-block">Solo se aceptan imagenes con formato .JPG, .JPEG, .PNG, la imagen debe ser menor a 3 MB.</p>
                                                            </center>
                                                            <div class="row">
                                                        <?php
                                                        if(isset($_content['galeria'])){
                                                            foreach ($_content['galeria'] as $_galeria) {
                                                                ?>
                                                                <div class="col-md-4 col-xs-12" id="content-galeria-<?=$_galeria['id_galeria']?>">
                                                                    <div class="close" onclick="deleteElementBlog(<?=$_galeria['id_galeria']?>,'content-galeria-', 'deleteGaleriaContenido', 'true')"> <i class="fa fa-times"></i> </div>
                                                                    <center>
                                                                        <div id="preview-img-contenido-galeria-<?=$_galeria['id_galeria']?>" class="espacios">
                                                                            <?=($_galeria['img'] != '') ? '<div class="espacios img-background" style="background-image: url(../img/galeria/'.$_galeria['img'].'); background-position:center; background-size:cover;"><img style="width:100%; visibility: hidden" src="../img/galeria/'.$_galeria['img'].'" /></div>' : '<div class="preview-example"></div>'?>

                                                                        </div>
                                                                        <input type="hidden" name="id_galeria-<?=$_content['id_contenido_blog']?>[]" value="<?=$_galeria['id_galeria']?>">
                                                                        <input type="file" onchange="showMyImageWH('preview-img-contenido-galeria-<?=$_galeria['id_galeria']?>', this, '', 1, 650, 300)" name="img-galeria-mod-<?=$_content['id_contenido_blog']?>[]" class="filestyle" data-input="false" data-buttonText="Imagen" data-iconName="fa fa-picture-o" data-badge="true">
                                                                        <p class="help-block">Solo se aceptan imagenes con formato .JPG, .JPEG, .PNG, la imagen debe ser menor a 3 MB.</p>
                                                                    </center>

                                                                </div>
                                                                <?php
                                                            }
                                                        }
                                                        ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
									<?php
												}
					                		}
					                	}
					                ?>
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
                    	</form>
            		</div>
            	</div>
	        </div>
    	</div>
	</body>
	<footer id="footer">
		<?php include 'footer.php';?>
		<script type="text/javascript" src="js/functionsBlog.js"></script>
	</footer>
</html>
