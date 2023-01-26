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
    $permiso= new permiso();
    $secciones = $permiso -> listarSecciones();
    $clave='ModTipoUser';
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <?php include 'head.php';?>
        <title>Formulario | Tipo Usuario</title>
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
                        <form id="form-validation" action="operaciones.php" method="post" name="form1" onsubmit="return validar_campos_tipo()">
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <input type="hidden" name="idtipousuario" value="<?php echo $temporal->idtipousuario; ?>"/>
                                <input type="hidden" name="status" value="<?php echo $temporal->status; ?>" />
                                <input type="hidden" name="operaciones" value="<?=$operacion?>">
                                <button type="submit" <?php if($seguridad->valida_permiso_usuario($_SESSION['idusuario'],$clave)==0) echo ' disabled ';?> name="operaciones" value="<?php echo $operacion; ?>" class="buttonguardar">Guardar y Publicar</button>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <hr class="hrmenu">
                                <div class='notifications top-right'></div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div id="titulo" class="form-group espacios">
                                    <input type="text" name="titulo" class="form-control" placeholder="Ingrese el nombre del tipo de usuario aquí..." value="<?=$temporal->nomtipousuario?>"></input>
                                </div>
                                <p class="subitulo">Asigne los permisos para este tipo de usuario:</p>
                                <div class="row">
                                    <?php
                                    $cont = 1;
                                    foreach ($secciones as $seccion) {
                                        $permisoxseccion = $permiso -> listado_permiso($seccion['idSeccionPermiso']);
                                        $tipousuarioxpermiso = new tiposusuarioxpermiso(0,0);
                                        $tipousuarioxpermiso -> idtipousuario = $id;
                                        if($cont == 3){
                                            $clear = '<div class="clearfix"></div>';
                                            $cont = 0;
                                        }else{
                                            $clear = '';
                                        }
                                    ?>
                                        <div class="col-md-4 col-sm-12 col-xs-12">
                                            <div class="panel panel-default">
                                                <div class="panel-heading">
                                                    <h3 class="panel-title"><?=$seccion['nombreSeccion']?></h3>
                                                </div>
                                                <div class="panel-body">
                                                <?php
                                                foreach ($permisoxseccion as $perm) {
                                                    $tipousuarioxpermiso -> idpermiso = $perm['idpermiso'];
                                                    ($tipousuarioxpermiso->existe_rol_permiso()==1) ? $temp = ' checked' : $temp = '';
                                                ?>  <div>                                  
                                                        <input type="checkbox" id="<?=$perm['idpermiso']?>" name="idpermiso[]" <?=$temp?> value="<?=$perm['idpermiso']?>">
                                                        <label for="<?=$perm['idpermiso']?>"><span></span><?=$perm['nompermiso']?></label>
                                                    </div>                                    
                                                <?php
                                                }
                                                ?>
                                                </div>
                                            </div>
                                        </div>
                                        <?=$clear?>  
                                    <?php
                                    $cont ++;
                                    }
                                    ?>
                                        
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
        <script src="js/functionsUsuario.js"></script>
    </footer>
</html>
