<?php
function __autoload($ClassName){
    include('clases/'.$ClassName.".php");
}
$seguridad = new seguridad();
$seguridad->candado();
$_MOD = '';
$sort = '';

if(isset($_REQUEST['idManual'])){
	$id = $_REQUEST['idManual'];
	$operacion = 'modificarmanual';
	$palabra = 'Editar Manual';
	$_MOD = '1';
	$temporal = new manual($id);
	$temporal -> getManual();
    $temporal -> getDatosEn();
}
else{
	$id = 0;
	$operacion = 'agregarmanual';
	$palabra = 'Nuevo Manual';
	$_MOD = '0';
	$img = '';
	$temporal = new manual($id);
}
$categorias = new categoria();
$lsCat = $categorias -> listCategoria(7,1, false);
$clave = 'p_mod_manual';
?>
<!DOCTYPE html>
<html lang="es">
	<head>
		<?php include 'head.php';?>
		<title>Formulario | Manual</title>
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
	                    <form id="form-validation" style="display: inline" name="form1" action="operaciones.php" method="post" enctype="multipart/form-data">
                    		<input type="hidden" name="MAX_FILE_SIZE" value="600000000"/>
                    		<input type="hidden" name="id" value="<?=$id?>">
                            <input type="hidden" name="status" value="<?=$temporal->status?>" id="status" />
                    		<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    			<button type="button" <?php if($seguridad->valida_permiso_usuario($_SESSION['idusuario'],$clave)==0) echo ' disabled ';?> name="operaciones" value="<?=$operacion?>" class="buttonguardar guardar-form">Guardar y Publicar</button>
                                <input type="hidden" name="operaciones" value="<?=$operacion?>" />
                   			</div>
		                    
		                    <div class="clearfix"></div>
		                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		                    	<div class='notifications top-right'></div>
                                <div id="valuser"></div>
                                <div role="tabpanel">
                                    <!-- Nav tabs -->
                                    <ul class="nav nav-tabs" role="tablist">
                                        <li role="presentation" class="active">
                                            <a href="#datos" aria-controls="home" role="tab" data-toggle="tab">Datos Manual</a>
                                        </li>
                                        <li role="presentation">
                                            <a href="#archivos" aria-controls="tab" role="tab" data-toggle="tab">Archivos</a>
                                        </li>
                                    </ul>
                                    <div class="tab-content">
                                        <div class="tab-pane active" id="datos">
                                            <div class="col-lg-6 col-lg-offset-3 col-md-6 col-md-offset-3 col-sm-12 col-xs-12">
                                                <br /><br />                                
                                                <center class="espacios">
                                                    PREVISUALIZAR IMAGEN PRINCIPAL
                                                    <div id="preview-manual" class="espacios">  
                                                        <?php
                                                        if($temporal -> _imgPortada!=''){ ?>
                                                            <img width="auto" height="250px" src="../img/manual/<?=$temporal->_imgPortada?>">
                                                        <?php
                                                        }
                                                        ?>    
                                                    </div>
                                                    <input type="file" onchange="showMyImageWH('preview-manual', this, '', 1, 1600, 1275)" name="imagen" id="" class="filestyle" data-input="false" data-buttonText="Imagen Principal" data-iconName="fa fa-picture-o" data-badge="false" data-type-file="imagen" data-validate="true" data-text="Imagen Principal">
                                                    <p class="help-block">Solo se aceptan imagenes con formato .JPG, .JPEG, .PNG; La imagen debe ser menor a 3 MB. <br> La resolución óptima para esta imagen es de 1600 x 1275px </p>
                                                </center>
                                                <div id="categoria" class="input-group espacios">
                                                    <span class="input-group-addon es">Categoría</span>
                                                    <select name="idCategoria" id="Categoria" class="form-control selectpicker" title="Categoría" data-validate="true" data-text="Categoría">
                                                    <?php
                                                    if(count($lsCat)>0){
                                                        foreach ($lsCat as $c) {
                                                    ?>
                                                    <option value="<?=$c['idCategoria']?>" <?=($c['idCategoria']==$temporal->_idCategoria) ? 'selected' : '';?>><?=$c['tituloEs']?></option>
                                                    <?php
                                                        }
                                                    }
                                                    ?>
                                                    </select>
                                                </div>
                                                <div class="input-group espacios">
                                                    <span class="input-group-addon">Título</span>
                                                    <input type="text" id="tituloEs" name="titulo[es]" data-validate="false" class="form-control" placeholder="Ingresa el título..." value="<?=$temporal->_titulo?>">
                                                    <span class="input-group-addon"> <i class="fa fa-globe"></i> ES</span>
                                                </div>
                                                <div class="input-group espacios">
                                                    <span class="input-group-addon">Título</span>
                                                    <input type="text" id="tituloEn" name="titulo[en]" data-validate="false" class="form-control" placeholder="Ingresa el título..." value="<?=$temporal->_tituloEn?>">
                                                    <span class="input-group-addon"> <i class="fa fa-globe"></i> EN</span>
                                                </div>
                                                <div class="input-group espacios">
                                                    <span class="input-group-addon">Link</span>
                                                    <input type="text" id="link" name="link[es]" data-validate="false" class="form-control" placeholder="Ingresa el link del Vídeo..." value="<?=$temporal->_link?>">
                                                    <span class="input-group-addon"> <i class="fa fa-globe"></i> ES</span>
                                                </div>
                                                <div class="input-group espacios">
                                                    <span class="input-group-addon">Link</span>
                                                    <input type="text" id="link" name="link[en]" data-validate="false" class="form-control" placeholder="Ingresa el link del Vídeo..." value="<?=$temporal->_linkEn?>">
                                                    <span class="input-group-addon"> <i class="fa fa-globe"></i> EN</span>
                                                </div>
                                                <br />
                                                <div class="input-group espacios">
                                                    <span class="input-group-addon">Descripción</span>
                                                    <textarea name="descripcion[es]" data-summer="true" id="descripcionEs" cols="30" rows="10">
                                                        <?=$temporal->_descripcion?>
                                                    </textarea>
                                                    <span class="input-group-addon"> <i class="fa fa-globe"></i> ES</span>
                                                </div>
                                                <div class="input-group espacios">
                                                    <span class="input-group-addon">Descripción</span>
                                                    <textarea name="descripcion[en]" data-summer="true" id="descripcionEn" cols="30" rows="10">
                                                        <?=$temporal->_descripcionEn?>
                                                    </textarea>
                                                    <span class="input-group-addon"> <i class="fa fa-globe"></i> EN</span>
                                                </div>
                                                
                                                <br />                               
                                            </div> 
                                        </div>
                                        <div class="tab-pane" id="archivos">
                                            <div class="col-xs-12 col-sm-12 col-md-6 col-md-offset-3 col-lg-6 col-lg-offset-3">
                                                <center class="espacios">
                                                    MANUAL ESPAÑOL
                                                    <div id="preview-manual-es" class="espacios">
                                                    <?php
                                                    if($temporal->_manualEs!=''){
                                                    ?>
                                                    <iframe src="../documents/manual/<?=$temporal->_manualEs?>" width="100%" height="250px" frameborder="0"></iframe>
                                                    <?php
                                                    }
                                                    ?>       
                                                    </div>
                                                    <input type="file"  name="manualEs" id="" class="filestyle" data-input="false" data-buttonText="Manual" data-iconName="fa fa-file-pdf-o" data-badge="true" data-type-file="pdf" data-validate="true" data-text="Manual">
                                                    <p class="help-block">Solo se aceptan archivos con formato .PDF y debe ser menor a 5 MB. </p>
                                                </center>
                                                <center class="espacios">
                                                    MANUAL INGLÉS
                                                    <div id="preview-manual-en" class="espacios"> 
                                                    <?php
                                                    if($temporal->_manualEn!=''){
                                                    ?>
                                                    <iframe src="../documents/manual/<?=$temporal->_manualEn?>" width="100%" height="250px" frameborder="0"></iframe>
                                                    <?php
                                                    }
                                                    ?>       
                                                    </div>
                                                    <input type="file"  name="manualEn" id="" class="filestyle" data-input="false" data-buttonText="Manual" data-iconName="fa fa-file-pdf-o" data-badge="true" data-type-file="pdf" data-validate="true" data-text="Manual">
                                                    <p class="help-block">Solo se aceptan archivos con formato .PDF y debe ser menor a 5 MB. </p>
                                                </center>
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
		                    	<button type="button" <?php if($seguridad->valida_permiso_usuario($_SESSION['idusuario'],$clave)==0) echo ' disabled ';?> name="operaciones" value="<?=$operacion?>" class="buttonguardar guardar-form">Guardar y Publicar</button>
		                    </div>
                    	</form>
            		</div>
            	</div>
	        </div>
    	</div>
	</body>
	<footer id="footer">
		<?php include 'footer.php';?>
		<!--<script src="js/functionsManual.js"></script>-->
	</footer>
</html>	