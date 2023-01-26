<?php
function __autoload($nombre_clase) {
    include 'clases/'.$nombre_clase .'.php';
}
	$seguridad = new seguridad();
	$seguridad->candado();
	
	$operacion = 'modificarconfigimg';
	$palabra = 'Editar Configuración de Imágenes';
	$temporal = new imgConfig();
	$temporal->obtenerimgconfig();
	$clave='ModCo';
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <?php include 'head.php';?>
        <title>Formulario | Configuración Imagen</title>
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
                        <form id="form-validation" action="operaciones.php" method="post" name="form1">
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <input type="hidden" name="idconfiguracion" value="<?php echo $temporal->idconfiguracion ?>"/>
                                <input type="hidden" name="operaciones" value="<?=$operacion?>"/>
                                <button type="button" <?php if($seguridad->valida_permiso_usuario($_SESSION['idusuario'],$clave)==0) echo ' disabled ';?> class="buttonguardar">Guardar y Publicar</button>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <hr class="hrmenu">
                                <div class='notifications top-right'></div>
                            </div>                        
                            <div class="clearfix"></div>
                            <div class="col-lg-7 col-md-6 col-sm-12 col-xs-12 espacios">
                                <div id="altomaximo" class="input-group espacios" >
                                    <span class="input-group-addon es"><i class="fa fa-image"></i> <i class="fa fa-arrows-v"></i> Ingrese el alto máximo de la imágen en pixeles</span>
                                    <input name="altomaximo" type="number" class="form-control" placeholder="Ej: 800" value="<?php echo $temporal->altomaximo ?>">
                                </div>
                                <div id="anchomaximo" class="input-group espacios" >
                                    <span class="input-group-addon es"><i class="fa fa-image"></i> <i class="fa fa-arrows-h"></i> Ingrese el ancho máximo de la imágen en pixeles</span>
                                    <input name="anchomaximo" type="number" class="form-control" placeholder="Ej: 800" value="<?php echo $temporal->anchomaximo ?>">
                                </div>
                                <div id="calidad" class="input-group espacios" >
                                    <span class="input-group-addon es"><i class="fa fa-line-chart"></i> Ingrese la calidad de la imagen (máx 100)</span>
                                    <input name="calidad" type="number" class="form-control" min="1" max="100" placeholder="Ej: 90 (más alto es mejor)" value="<?php echo $temporal->calidad ?>">
                                </div>
                                <div id="prefijo" class="input-group espacios" >
                                    <span class="input-group-addon es"> Ingrese el prefijo de la imagen</span>
                                    <input name="prefijo" type="text" class="form-control" placeholder="Ej: LockerAgencia" value="<?php echo $temporal->prefijo ?>">
                                </div>
                            </div><!--Div de cierre col-lg-7-->
                            <div class="col-lg-5 col-md-6 col-sm-12 col-xs-12 espacios"></div> 
                            <div class="clearfix"></div>
                            <!--Este div contiene la barra inferior-->
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <hr class="hrmenu">
                            </div>
                            <!--Este div contiene al boton inferior-->
                            <div class="clearfix"></div>   
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <button type="button" <?php if($seguridad->valida_permiso_usuario($_SESSION['idusuario'],$clave)==0) echo ' disabled ';?> class="buttonguardar">Guardar y Publicar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>    
    </body>
    <footer id="footer">
        <?php include 'footer.php';?>
        <script src="js/functionsConfImg.js"></script>
    </footer>
</html>