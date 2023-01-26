<?php
    include_once('clases/contacto.php');
    include_once('clases/seguridad.php');
    $seguridad = new seguridad();
    $seguridad->candado();

    $operacion = 'modificarcontacto';
    $palabra = 'Editar Contacto';
    $temporal = new contacto();
    $temporal->obtener_contacto();
    $redes = $temporal -> listRedSocial();
    $clave='ModCo';
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <?php include 'head.php';?>
        <title>Formulario | Contacto</title>
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
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <input type="hidden" name="idcontacto" value="<?php echo $temporal->idcontacto ?>"/>
                                <input type="hidden" name="operaciones" value="<?=$operacion?>">
                                <button type="button" <?php if($seguridad->valida_permiso_usuario($_SESSION['idusuario'],$clave)==0) echo ' disabled ';?> class="buttonguardar">Guardar y Publicar</button>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <hr class="hrmenu">
                                <div class='notifications top-right'></div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="col-md-8 col-md-offset-2 col-xs-12">
                                <h4>CORREO</h4>
                                <div class="input-group espacios">
                                    <span class="input-group-addon"><i class="fa fa-envelope"></i> Contacto</span>
                                    <input name="correo" type="email" data-validate="true" class="form-control" placeholder="Correo Contacto" value="<?php echo $temporal -> correo ?>">
                                </div>
                                <div class="input-group espacios">
                                    <span class="input-group-addon"><i class="fa fa-envelope"></i> Remitente</span>
                                    <input name="emisor" type="email" data-validate="true" class="form-control" placeholder="Correo Remitente" value="<?php echo $temporal -> emisor ?>">
                                </div>
                                <h4 class="hidden">UBICACION</h4>
                                <div class="input-group espacios hidden">
                                    <span class="input-group-addon"><i class="fa fa-map-marker"></i> Latitud</span>
                                    <input name="latitud" type="text" data-validate="true" class="form-control" placeholder="Ej. 20.9977206" value="<?php echo $temporal -> latitud ?>">
                                </div>
                                <div class="input-group espacios hidden">
                                    <span class="input-group-addon"><i class="fa fa-map-marker"></i> Longitud</span>
                                    <input name="longitud" type="text" data-validate="true" class="form-control" placeholder="Ej. -89.6099386" value="<?php echo $temporal -> longitud ?>">
                                </div>
                                <h4 class="hidden">REDES SOCIALES</h4>
                                <button type="button" class="btn btn-panel hidden" id="addRedSocial">Añadir Red Social</button>
                                <div id="contentRedSocial hidden">
                        <?php
                            if(count($redes) > 0){
                                foreach ($redes as $_red) {
                        ?>
                                <div class="input-group espacios hidden" id="redSocialMod<?=$_red['idRedSocial']?>">
                                    <div class="fa fa-times absolute close" onclick="deleteElement(<?=$_red['idRedSocial']?>, 'redSocialMod', 'deleteRedSocial', 'true')"></div>
                                    <input type="hidden" name="idRedSocial[]" value="<?=$_red['idRedSocial']?>">
                                    <span class="input-group-addon">Nombre:</span>
                                    <input name="nombreRedMod[]" type="text" class="form-control" placeholder="Ej. Facebook" value="<?=$_red['titulo']?>">
                                    <span class="input-group-addon">Url:</span>
                                    <input name="urlRedMod[]" type="text" class="form-control" placeholder="https://www.facebook.com/logra.financiamientos" value="<?=$_red['url']?>">
                                    <select class="selectpicker" name="iconRedMod[]">
                                        <option value="">Icon</option>
                                        <optgroup label="Social Icons">
                                            <option <?=($_red['icono'] == 'fa-facebook') ? 'selected' : '';?> data-content="<i class='fa fa-facebook'></i>" value="fa-facebook"></option>
                                            <option <?=($_red['icono'] == 'fa-facebook-official') ? 'selected' : '';?> data-content="<i class='fa fa-facebook-official'></i>" value="fa-facebook-official"></option>
                                            <option <?=($_red['icono'] == 'fa-pinterest') ? 'selected' : '';?> data-content="<i class='fa fa-pinterest'></i>" value="fa-pinterest"></option>
                                            <option <?=($_red['icono'] == 'fa-pinterest-p') ? 'selected' : '';?> data-content="<i class='fa fa-pinterest-p'></i>" value="fa-pinterest-p"></option>
                                            <option <?=($_red['icono'] == 'fa-pinterest-square') ? 'selected' : '';?> data-content="<i class='fa fa-pinterest-square'></i>" value="fa-pinterest-square"></option>
                                            <option <?=($_red['icono'] == 'fa-twitter') ? 'selected' : '';?> data-content="<i class='fa fa-twitter'></i>" value="fa-twitter"></option>
                                            <option <?=($_red['icono'] == 'fa-twitter-square') ? 'selected' : '';?> data-content="<i class='fa fa-twitter-square'></i>" value="fa-twitter-square"></option>
                                            <option <?=($_red['icono'] == 'fa-linkedin') ? 'selected' : '';?> data-content="<i class='fa fa-linkedin'></i>" value="fa-linkedin"></option>
                                            <option <?=($_red['icono'] == 'fa-linkedin-square') ? 'selected' : '';?> data-content="<i class='fa fa-linkedin-square'></i>" value="fa-linkedin-square"></option>
                                            <option <?=($_red['icono'] == 'fa-google-plus') ? 'selected' : '';?> data-content="<i class='fa fa-google-plus'></i>" value="fa-google-plus"></option>
                                            <option <?=($_red['icono'] == 'fa-google-plus-square') ? 'selected' : '';?> data-content="<i class='fa fa-google-plus-square'></i>" value="fa-google-plus-square"></option>
                                            <option <?=($_red['icono'] == 'fa-behance') ? 'selected' : '';?> data-content="<i class='fa fa-behance'></i>" value="fa-behance"></option>
                                            <option <?=($_red['icono'] == 'fa-behance-square') ? 'selected' : '';?> data-content="<i class='fa fa-behance-square'></i>" value="fa-behance-square"></option>
                                            <option <?=($_red['icono'] == 'fa-instagram') ? 'selected' : '';?> data-content="<i class='fa fa-instagram'></i>" value="fa-instagram"></option>
                                            <option <?=($_red['icono'] == 'fa-skype') ? 'selected' : '';?> data-content="<i class='fa fa-skype'></i>" value="fa-skype"></option>
                                            <option <?=($_red['icono'] == 'fa-youtube') ? 'selected' : '';?> data-content="<i class='fa fa-youtube'></i>" value="fa-youtube"></option>
                                        </optgroup>
                                    </select>
                                </div>
                        <?php
                                }
                            }
                        ?>
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
                                <button type="button" <?php if($seguridad->valida_permiso_usuario($_SESSION['idusuario'],$clave)==0) echo ' disabled ';?> name="operaciones" value="<?php echo $operacion; ?>" class="buttonguardar">Guardar y Publicar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </body>
     <footer id="footer">
        <?php include 'footer.php';?>
        <script src="js/functionsConfEmail.js"></script>
    </footer>
</html>
