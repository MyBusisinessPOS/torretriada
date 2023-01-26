<?php
function __autoload($nombre_clase) {
    include 'clases/'.$nombre_clase .'.php';
}
$seguridad = new seguridad();
$seguridad->candado();

$usuario = new usuario();
$listaUsuario = $usuario ->lista_usuario();
$clave='AgrUser';
$clave2='ElimUser';
$clave3='AcDcUser';

?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <?php include 'head.php';?>
        <title>Lista | Usuarios Panel</title>
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
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                            <p class="titulo">Usuarios</p>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                            <form action="formusuario.php" method="post">
                                <button <?php if($seguridad->valida_permiso_usuario($_SESSION['idusuario'],$clave)==0) echo ' disabled ';?> value="" class="buttonagregar">Agregar Nuevo</button>
                            </form>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <hr class="hrmenu">
                        </div>
                        <div class="clearfix"></div>
                        <form method="post" action="operaciones.php">
                            <div class="styled-large">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class='notifications top-right'></div>
                                    <ul class="ulfiltros">
                                        <li class="lifiltros">
                                            <div class="styled-select">
                                                <select name="operador">
                                                  <option class="styled" <?php if($seguridad->valida_permiso_usuario($_SESSION['idusuario'],$clave2)==0) echo ' disabled ';?>>Eliminar</option>
                                                  <option class="styled" <?php if($seguridad->valida_permiso_usuario($_SESSION['idusuario'],$clave3)==0) echo ' disabled ';?>>Mostrar</option>
                                                  <option class="styled" <?php if($seguridad->valida_permiso_usuario($_SESSION['idusuario'],$clave3)==0) echo ' disabled ';?>>No Mostrar</option>
                                               </select>
                                            </div>
                                        </li>
                                        <li class="lifiltros">
                                            <button type="submit" class="buttonaplicar" name="operaciones" value="operausuario">Aplicar</button>
                                        </li>
                                        <li class="lifiltros" style="display: none">
                                            <div class="styled-select">
                                                <select>
                                                  <option class="styled" >Ver Por</option>
                                                  <option class="styled" >Por mes</option>
                                                  <option class="styled" >Por nombre</option>
                                               </select>
                                            </div>
                                        </li>
                                        <li class="lifiltros" style="display: none">
                                            <button class="buttonaplicar">Aplicar</button>
                                        </li>
                                    </ul>
                                    <div class="busqueda"><input type="search" data-column="all" class="form-control search" placeholder="Buscar..." id="searchUsuario"/></div>
                                </div>
                            </div><!--Cierra el div class styled-large-->
                            <div class="clearfix"></div>
                            <div class="styled-small">
                                <div class="col-sm-12 col-xs-12">
                                    <div class="busqueda"><input type="text" onkeyup="buscarPorPalabraUsuario(this.value)" class="form-control search" placeholder="Buscar..."></div>
                                </div>
                                <div class="col-sm-12 col-xs-12">
                                    <ul class="ulfiltros">
                                        <li class="lifiltros">
                                            <div class="styled-select">
                                                <select>
                                                  <option class="styled" >Eliminar</option>
                                                  <option class="styled" >Mostrar</option>
                                                  <option class="styled" >No Mostrar</option>
                                               </select>
                                            </div>
                                        </li>
                                        <li class="lifiltros">
                                            <button class="buttonaplicar">Aplicar</button>
                                        </li>
                                    </ul>
                                </div>
                            </div><!--Cierra el div class styled-small-->
                            <div class="clearfix"></div>
                            <div class="col-lg-12">
                                <div class="table-responsive">
                                    <table id="tableUsuario" class="table table-hover table-striped tablesorter">
                                        <thead class="styled-thead">
                                            <tr>
                                                <th width="50">
                                                    <input type="checkbox" id="marcar" name="marcar" onclick="marcartodos(this);" value="marcar">
                                                    <label for="marcar"><span></span></label>
                                                </th>
                                                <th width="100">Nombre <i class="fa fa-sort manita"></i></th>
                                                <th class="text-center">Tipo <i class="fa fa-sort manita"></i></th>
                                                <th class="text-center">Mostrar</th>
                                            </tr>
                                        </thead>
                                        <tbody class="styled-tbody">
                                    <?php
                                        foreach ($listaUsuario as $elemento) {
                                            if($elemento['status']!=0){
                                                $img='img/visible.png';
                                                $funcion='changeStatus('.$elemento['idusuario'].',0,\'changeStatusUsuario\')';
                                            }else{
                                                $img='img/invisible.png';
                                                $funcion='changeStatus('.$elemento['idusuario'].',1,\'changeStatusUsuario\')';
                                            }
                                    ?>
                                            <tr>
                                                <td>
                                                    <input type="checkbox" id="<?=$elemento['idusuario']?>" name="idusuario[]" value="<?=$elemento['idusuario']?>">
                                                    <label for="<?=$elemento['idusuario']?>"><span></span></label>
                                                </td>
                                                <td><a href="formusuario.php?idusuario=<?=$elemento['idusuario']?>"><?=$elemento['nomusuario']?></a></td>
                                                <td class="text-center"><?=$elemento['nomtipo']?></td>
                                                <td class="text-center"><img class="manita" onclick="<?=$funcion?>" id="temp<?=$elemento['idusuario']?>" src="<?=$img?>"></td>
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
                                                <th>Nombre <i class="fa fa-sort"></i></th>
                                                <th class="text-center">Tipo</th>
                                                <th class="text-center">Mostrar</th>
                                            </tr>
                                        </tfoot>
                                    </table>
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
    </footer>
</html>
