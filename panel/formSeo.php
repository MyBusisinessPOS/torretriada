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
    $sort = '';
    $_MOD = '';
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <?php include 'head.php';?>
        <title>Formulario | SEO</title>
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
                        <!--Seccion del titulo y el boton de agregar-->
                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                            <p class="titulo"><?php echo $palabra;?></p>
                        </div>
                        <form id="form-validation" action="operaciones.php" method="post" name="form1" enctype="multipart/form-data">
                            <input type="hidden" name="operaciones" value="<?=$operacion?>">
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <button type="button" <?php if($seguridad->valida_permiso_usuario($_SESSION['idusuario'],$clave)==0) echo ' disabled ';?> class="buttonguardar">Guardar y Publicar</button>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <hr class="hrmenu">
                            </div>                    
                            <div class="clearfix"></div>                      
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class='notifications top-right'></div>
                                <div class='notifications bottom-right'></div>
                            </div>
                            <div class="col-lg-8 col-lg-offset-2 col-md-8 col-md-offset-2 col-sm-12 col-xs-12">
                                <p class="titulo">Metas Generales SEO</p>
                                <div class="clearfix"></div> 
                                <div id="msgMetaAuthor" class="input-group espacios">
                                    <span class="input-group-addon es"><i class="fa fa-user"></i>  Meta Autor</span>
                                    <input type="text"  name="metaAuthor" class="form-control" placeholder="Ingrese el autor aquí" value="<?=$temporal->metaAuthor?>">
                                </div>
                                <div id="msgMetaKeywords" class="input-group espacios">
                                    <span class="input-group-addon es"><i class="fa fa-tags"></i>  Meta Palabras clave</span>
                                    <textarea id="keywords"  name="metaKeywords" class="form-control"><?=$temporal->metaKeywords?></textarea>
                                </div>                        
                                <div id="msgMetaDescription" class="input-group espacios">
                                    <span class="input-group-addon es"><i class="fa fa-align-justify"></i>  Meta Descripción</span>
                                    <textarea rows="5" name="metaDescription" class="form-control"><?=$temporal->metaDescription?></textarea>
                                </div>
                        
                                <p class="titulo">Metas SEO Facebook</p>
                                <div class="clearfix"></div> 
                                <div id="msgMetasOgTitle" class="input-group espacios">
                                    <span class="input-group-addon es"><i class="fa fa-align-justify"></i>  Meta Título</span>
                                    <input type="text"  name="metaOgTitle" class="form-control" placeholder="Ingrese el título para Facebook" value="<?=$temporal->metaOgTitle?>">
                                </div>
                                <div id="msgMetaOgUrl" class="input-group espacios">
                                    <span class="input-group-addon es"><i class="fa fa-link"></i>  Meta URL</span>
                                    <input type="text"  name="metaOgUrl" class="form-control" placeholder="Ingrese la URL para Facebook" value="<?=$temporal->metaOgUrl?>">
                                </div>
                                <div id="msgMetaOgType" class="input-group espacios">
                                    <span class="input-group-addon es"><i class="fa fa-asterisk"></i>  Meta Tipo</span>
                                    <input type="text"  name="metaOgType" class="form-control" placeholder="Ingrese el tipo, ej: Sitio Web " value="<?=$temporal->metaOgType?>">
                                </div>
                                <div id="msgMetaOgLocale"  class="input-group espacios">
                                    <span class="input-group-addon es"><i class="fa fa-globe"></i>  Meta Localización</span> 
                                    <input type="text" name="metaOgLocale" placeholder="Ingrese su pais." value="<?=$temporal->metaOgLocale?>">                  
                                </div>
                                <div id="msgMetaOgSiteName"  class="input-group espacios">
                                    <span class="input-group-addon es"><i class="fa fa-globe"></i>  Meta Nombre del sitio web</span> 
                                    <input type="text" name="metaOgSiteName" placeholder="Ingrese Sitio Web." value="<?=$temporal->metaOgSiteName?>">                  
                                </div>
                                <div id="msgMetaOgDescription" class="input-group espacios">
                                    <span class="input-group-addon es"><i class="fa fa-align-justify"></i>  Meta Descripción Facebook</span>
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
                                <p class="titulo">Google Analytics y Códigos de conversión</p>
                                <div class="clearfix"></div> 
                                <div id="msgidAnalitics" class="input-group espacios">
                                    <span class="input-group-addon es"><i class="fa fa-align-justify"></i>  ID Analytics</span>
                                    <input type="text"  name="idAnalitics" class="form-control" placeholder="Ingrese el id de analytics, ej: UA-24233015-24" value="<?=$temporal->idAnalitics?>">
                                </div>
                                <div id="msgsitenameAnalitics" class="input-group espacios">
                                    <span class="input-group-addon es"><i class="fa fa-align-justify"></i>  Nombre del sitio</span>
                                    <input type="text"  name="sitenameAnalitics" class="form-control" placeholder="Ingrese el nombre del sitio, ej: empresa.com.mx" value="<?=$temporal->sitenameAnalitics?>">
                                </div>
                                <div id="msgConversionFacebook" class="input-group espacios">
                                    <span class="input-group-addon es"><i class="fa fa-terminal"></i>  Código conversión Facebook</span>
                                    <textarea rows="5" name="conversionFacebook" class="form-control"><?=$temporal->conversionFacebook?></textarea>
                                </div>
                                <div id="msgConversionGoogle" class="input-group espacios">
                                    <span class="input-group-addon es"><i class="fa fa-terminal"></i>  Código conversión Google</span>
                                    <textarea rows="5" name="conversionGoogle" class="form-control"><?=$temporal->conversionGoogle?></textarea>
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
        <script src="js/functionsSEO.js"></script>
    </footer>
</html> 
        
