<?php
function __autoload($nombre_clase) {
    //$nombre_clase = strtolower($nombre_clase);
    include 'clases/'.$nombre_clase .'.php';
}
	$seguridad = new seguridad();
	$seguridad->candado();

	$operacion = 'modificarSeo';
	$palabra = 'Configurar Metas';
	$temporal = new seo(1);
	$temporal -> obtener_seo();
    $img = $temporal -> listarImgSeo();
	$clave = 'ModSeo';
?>
<?php
include('head.html');//Contiene los estilos y los metas.
?>
    <title>Formulario SEO</title>
<?php
include('header.html');//contiene las barras de arriba y los menus.
include('menu.php');
?>
<style type="text/css">
    div.tagsinput {
        border: 1px solid #CCC;
        background: #FFF none repeat scroll 0% 0%;
        padding: 5px;
        width: 100% !important;
        height: 100px;
        overflow-y: auto;
    }
    div.tagsinput span.tag {
        border: 1px solid #DDD;
        display: block;
        float: left;
        padding: 5px;
        text-decoration: none;
        background: #F4F4F4 none repeat scroll 0% 0%;
        color: #555;
        margin-right: 5px;
        margin-bottom: 5px;
        font-family: helvetica;
        font-size: 13px;
    }
    div.tagsinput input {
        margin: 0px 5px 5px 0px;
        font-family: helvetica;
        font-size: 13px;
        border: 1px solid transparent;
        padding: 5px;
        background: transparent none repeat scroll 0% 0%;
        color: #000;
        outline: 0px none;
    }
</style>
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
                    	<form id="form-validation" action="operaciones.php" method="post" name="form1" onsubmit="return validar_campos()" enctype="multipart/form-data">
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
                        <div class='notifications bottom-right'></div>
                    </div>
                    <div class="col-lg-8 col-lg-offset-2 col-md-8 col-md-offset-2 col-sm-12 col-xs-12">
                        <p class="titulo">Metas Generales SEO</p>
                        <div class="clearfix"></div>
                        <div id="msgMetaAuthor" class="input-group espacios">
                            <span class="input-group-addon es"><i class="fa fa-server"></i>Meta Autor</span>
                            <input type="text"  name="metaAuthor" class="form-control" placeholder="Ingrese el autor aquí" value="<?=$temporal->metaAuthor?>">
                        </div>
                        <div id="msgMetaKeywords" class="input-group espacios">
                            <span class="input-group-addon es"><i class="fa fa-server"></i>Meta Palabras clave</span>
                            <textarea id="keywords"  name="metaKeywords" class="form-control"><?=$temporal->metaKeywords?></textarea>
                        </div>
                        <div id="msgMetaDescription" class="input-group espacios">
                            <span class="input-group-addon es"><i class="fa fa-server"></i>Meta Descripción</span>
                            <textarea rows="5" name="metaDescription" class="form-control"><?=$temporal->metaDescription?></textarea>
                        </div>

                        <p class="titulo">Metas SEO Facebook</p>
                        <div class="clearfix"></div>
                        <div id="msgMetasOgTitle" class="input-group espacios">
                            <span class="input-group-addon es"><i class="fa fa-server"></i>Meta Título</span>
                            <input type="text"  name="metaOgTitle" class="form-control" placeholder="Ingrese el título para Facebook" value="<?=$temporal->metaOgTitle?>">
                        </div>
                        <div id="msgMetaOgUrl" class="input-group espacios">
                            <span class="input-group-addon es"><i class="fa fa-server"></i>Meta URL</span>
                            <input type="text"  name="metaOgUrl" class="form-control" placeholder="Ingrese la URL para Facebook" value="<?=$temporal->metaOgUrl?>">
                        </div>
                        <div id="msgMetaOgType" class="input-group espacios">
                            <span class="input-group-addon es"><i class="fa fa-server"></i>Meta Tipo</span>
                            <input type="text"  name="metaOgType" class="form-control" placeholder="Ingrese el tipo, ej: Sitio Web " value="<?=$temporal->metaOgType?>">
                        </div>
                        <div id="msgMetaOgLocale"  class="input-group espacios">
                            <span class="input-group-addon es"><i class="fa fa-server"></i>Meta Localización</span>
                            <input type="text" name="metaOgLocale" placeholder="Ingrese su pais." value="<?=$temporal->metaOgLocale?>">
                        </div>
                        <div id="msgMetaOgSiteName"  class="input-group espacios">
                            <span class="input-group-addon es"><i class="fa fa-server"></i>Meta Nombre del sitio web</span>
                            <input type="text" name="metaOgSiteName" placeholder="Ingrese Sitio Web." value="<?=$temporal->metaOgSiteName?>">
                        </div>
                        <div id="msgMetaOgDescription" class="input-group espacios">
                            <span class="input-group-addon es"><i class="fa fa-server"></i>Meta Descripción Facebook</span>
                            <textarea rows="5" name="metaOgDescription" class="form-control"><?=$temporal->metaOgDescription?></textarea>
                        </div>

                        <p class="titulo">Imagenes</p>
                        <div class="clearfix"></div>
                        <div class="row">
                            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                 <center>
                                    <span class="textHelper">Previsualizar Favicon:</span>
                                    <br>
                                    <input type="hidden" name="idfavicon" value="<?=$img[0]['idimgSeo']?>">
                                    <div id="favicon">
                                        <?php if($img[0]['ruta'] != ''){ ?>
                                            <img src="../img/imgSeo/<?=$img[0]['ruta']?>"/>
                                        <?php } ?>
                                    </div>
                                    <br>
                                    <center>
                                        <input id="filesFavicon" onchange="showMyImage('favicon',this)" name="archivoFavicon" type="file" class="upload"/>
                                    </center>
                                    <br>
                                    <div class="text-center textHelper">
                                        Tipo de archivos permitidos: .ico
                                    </div>
                                    <br>
                                </center>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                 <center>
                                    <span class="textHelper">Previsualizar Pin Google Maps:</span>
                                    <br>
                                    <input type="hidden" name="idPin" value="<?=$img[1]['idimgSeo']?>">
                                    <div id="pin">
                                        <?php if($img[1]['ruta'] != ''){ ?>
                                            <img src="../img/imgSeo/<?=$img[1]['ruta']?>"/>
                                        <?php } ?>
                                    </div>
                                    <br>
                                    <center>
                                        <input id="filesPinGoogle" onchange="showMyImage('pin',this)" name="archivoPin" type="file" class="upload"/>
                                    </center>
                                    <br>
                                    <div class="text-center textHelper">
                                        Tipo de archivos permitidos: .png
                                    </div>
                                    <br>
                                </center>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                <center>
                                    <span class="textHelper">Previsualizar Imagen Facebook:</span>
                                    <br>
                                    <input type="hidden" name="idOgImagen" value="<?=$img[2]['idimgSeo']?>">
                                    <div id="ogImagen">
                                        <?php if($img[2]['ruta'] != ''){ ?>
                                            <img width="100%" src="../img/imgSeo/<?=$img[2]['ruta']?>"/>
                                        <?php } ?>
                                    </div>
                                    <br>
                                    <center>
                                        <input id="filesOgImagen" onchange="showMyImage('ogImagen',this)" name="archivoOgImagen" type="file" class="upload"/>
                                    </center>
                                    <br>
                                    <div class="text-center textHelper">
                                        Tipo de archivos permitidos: .png, .jpg, .gif
                                    </div>
                                    <br>
                                </center>
                            </div>
                        </div>
                        <p class="titulo">Google Analytics</p>
                        <div class="clearfix"></div>
                        <div id="msgidAnalitics" class="input-group espacios">
                            <span class="input-group-addon es"><i class="fa fa-server"></i>ID Analytics</span>
                            <input type="text"  name="idAnalitics" class="form-control" placeholder="Ingrese el id de analytics, ej: UA-24233015-24" value="<?=$temporal->idAnalitics?>">
                        </div>
                        <div id="msgsitenameAnalitics" class="input-group espacios">
                            <span class="input-group-addon es"><i class="fa fa-server"></i>Nombre del sitio</span>
                            <input type="text"  name="sitenameAnalitics" class="form-control" placeholder="Ingrese el nombre del sitio, ej: empresa.com.mx" value="<?=$temporal->sitenameAnalitics?>">
                        </div>
                        <div id="msgConversionFacebook" class="input-group espacios" style="display:none">
                            <span class="input-group-addon es"><i class="fa fa-server"></i>Código conversión Facebook</span>
                            <textarea rows="5" name="conversionFacebook" class="form-control"><?=$temporal->conversionFacebook?></textarea>
                        </div>
                        <div id="msgConversionGoogle" class="input-group espacios" style="display:none">
                            <span class="input-group-addon es"><i class="fa fa-server"></i>Código conversión Google</span>
                            <textarea rows="5" name="conversionGoogle" class="form-control"><?=$temporal->conversionGoogle?></textarea>
                        </div>
                    </div>

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
<script type="text/javascript" src="js/tags/jquery.tagsinput.js"></script>
<script>
    $('#keywords').tagsInput({
         'defaultText':'plabra clave',
         'width':'500px'
    });

    $(".upload").filestyle({
        input: false,
        buttonText: "Seleccionar Archivo",
        iconName: "glyphicon-camera",
    });

    function showMyImage(id,fileInput){
        var files = fileInput.files;
        // Loop through the FileList and render image files as thumbnails.
        for (var x = 0, f; f = files[x]; x++) {
          // Only process image files.
          if (!f.type.match('image.*')) {
            continue;
          }
          var reader = new FileReader();
          // Closure to capture the file information.
          reader.onload = (function(theFile) {
            return function(e) {
              // Render thumbnail.
              var span = document.createElement('span');
              span.innerHTML = ['<img width="100%" height="221" src="', e.target.result,
                                '" title="', escape(theFile.name), '"/>'].join('');
              $("#"+id).empty();
              document.getElementById(id).insertBefore(span, null);
            };
          })(f);
          // Read in the image file as a data URL.
          reader.readAsDataURL(f);
        }
    }
	function validar_campos(){
        var favicon = $("#filesFavicon").val();
		var pin = $("#filesPinGoogle").val();
        var ogImagen = $("#filesOgImagen").val();

		if(favicon != ""){
            if(!validarImagenes(favicon, 1)){
                $(".top-right").notify({
                    message: { text: "El tipo de archivo que intenta subir no es admitido, solo se aceptan imágenes con formato .ico" },
                    type:"blackgloss",
                    delay: 6000,
                }).show();
                return false;
            }
        }
        if(pin != ""){
            if(!validarImagenes(pin, 2)){
                $(".top-right").notify({
                    message: { text: "El tipo de archivo que intenta subir no es admitido, solo se aceptan imágenes con formato .png" },
                    type:"blackgloss",
                    delay: 6000,
                }).show();
                return false;
            }
        }
        if(ogImagen != ""){
            if(!validarImagenes(ogImagen, 3)){
                $(".top-right").notify({
                    message: { text: "El tipo de archivo que intenta subir no es admitido, solo se aceptan imágenes con formato .png, .gif, .jpg" },
                    type:"blackgloss",
                    delay: 6000,
                }).show();
                return false;
            }
        }
	}

    function validarImagenes(input, format){
        switch(format){
            case 1:
              if (!input.match(/(?:ico|ICO)$/)) {
                    return false;
                }else{
                    return true;
                }
            break;
            case 2:
              if (!input.match(/(?:png|PNG)$/)) {
                    return false;
                }else{
                    return true;
                }
            break;
            case 3:
              if (!input.match(/(?:gif|jpg|png|jpeg|GIF|JPG|PNG|JPEG)$/)) {
                    return false;
                }else{
                    return true;
                }
            break;
        }

    }
	</script>
</body>
</html>
