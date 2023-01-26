<?php
$menu_clave1 = "p_ver_slide";
$menu_clave2 = "p_ver_categoria";
$menu_clave3 = "p_ver_portafolio";
$menu_clave4 = "p_ver_proyecto";
$menu_clave5 = "p_ver_categoria_proyecto";
$menu_clave6 = "p_ver_manual";
$menu_clave7 = "p_ver_instalacion";
$menu_clave8 = "p_ver_blog";
$menu_clave9 = "p_ver_categoria_blog";
$menu_clave10 = "p_ver_sucursal";
$menu_clave11 = "p_ver_newsletter";
$menu_clave12 = "p_ver_proyectos_vendidos";
?>
        <div id="sidebar-wrapper">
            <ul class="sidebar-nav">
                <!--<div <?php if($seguridad->valida_permiso_usuario($_SESSION['idusuario'],$menu_clave1)==0){ echo 'style="display:none"'; }else{ echo '';}?> >
                    <li <?php if (strpos($page, "listSlide.php")){ echo "class='active'";} ?>><a href="listSlide.php?tipo=1">Slider</a>
                    </li>
                    <hr class="hrmenu">
                </div>-->
                <div <?php if($seguridad->valida_permiso_usuario($_SESSION['idusuario'],$menu_clave8)==0){ echo 'style="display:none"'; }else{ echo '';}?> >
                    <li <?php if ((strpos($page, "listBlog.php") or strpos($page, "formBlog.php"))){ echo "class='active'";} ?>><a href="listBlog.php">Blog</a>
                    </li>
                    <hr class="hrmenu">
                </div>
                <!--<div <?php if($seguridad->valida_permiso_usuario($_SESSION['idusuario'],$menu_clave1)==0){ echo 'style="display:none"'; }else{ echo '';}?> >
                    <li class="manita relative submenu-trigger" data-target-submenu="menu-slider">SLIDER
                        <ul class="submenu" id="menu-slider">
                            <div <?php if($seguridad->valida_permiso_usuario($_SESSION['idusuario'],$menu_clave1)==0){ echo 'style="display:none"'; }else{ echo '';}?> >
                                <li <?php if (strpos($page, "listSlide.php") AND $_REQUEST['tipo'] == 1){ echo "class='active'";} ?>><a href="listSlide.php?tipo=1">HOME</a>
                                </li>
                                <hr class="hrmenu">
                            </div>
                            <div <?php if($seguridad->valida_permiso_usuario($_SESSION['idusuario'],$menu_clave1)==0){ echo 'style="display:none"'; }else{ echo '';}?> >
                                <li <?php if (strpos($page, "listSlide.php") AND $_REQUEST['tipo'] == 2){ echo "class='active'";} ?>><a href="listSlide.php?tipo=2">NOSOTROS</a>
                                </li>
                                <hr class="hrmenu">
                            </div>
                            <div <?php if($seguridad->valida_permiso_usuario($_SESSION['idusuario'],$menu_clave1)==0){ echo 'style="display:none"'; }else{ echo '';}?> >
                                <li <?php if (strpos($page, "listSlide.php") AND $_REQUEST['tipo'] == 3){ echo "class='active'";} ?>><a href="listSlide.php?tipo=3">DIVISIONES</a>
                                </li>
                                <hr class="hrmenu">
                            </div>
                            <div <?php if($seguridad->valida_permiso_usuario($_SESSION['idusuario'],$menu_clave1)==0){ echo 'style="display:none"'; }else{ echo '';}?> >
                                <li <?php if (strpos($page, "listSlide.php") AND $_REQUEST['tipo'] == 4){ echo "class='active'";} ?>><a href="listSlide.php?tipo=4">PROYECTOS</a>
                                </li>
                                <hr class="hrmenu">
                            </div>
                            <div <?php if($seguridad->valida_permiso_usuario($_SESSION['idusuario'],$menu_clave1)==0){ echo 'style="display:none"'; }else{ echo '';}?> >
                                <li <?php if (strpos($page, "listSlide.php") AND $_REQUEST['tipo'] == 5){ echo "class='active'";} ?>><a href="listSlide.php?tipo=5">BLOG</a>
                                </li>
                                <hr class="hrmenu">
                            </div>
                            <div <?php if($seguridad->valida_permiso_usuario($_SESSION['idusuario'],$menu_clave1)==0){ echo 'style="display:none"'; }else{ echo '';}?> >
                                <li <?php if (strpos($page, "listSlide.php") AND $_REQUEST['tipo'] == 6){ echo "class='active'";} ?>><a href="listSlide.php?tipo=6">CONTACTO</a>
                                </li>
                                <hr class="hrmenu">
                            </div>
                        </ul>
                    </li>

                    <hr class="hrmenu">
                </div>-->

                <!--<div <?php if($seguridad->valida_permiso_usuario($_SESSION['idusuario'],$menu_clave4) == 0 AND $seguridad->valida_permiso_usuario($_SESSION['idusuario'],$menu_clave5) == 0){ echo 'style="display:none"'; }else{ echo '';}?> >
                    <li class="manita relative submenu-trigger" data-target-submenu="menu-proyecto">PROYECTO
                        <ul class="submenu" id="menu-proyecto">
                            <div <?php if($seguridad->valida_permiso_usuario($_SESSION['idusuario'],$menu_clave12)==0){ echo 'style="display:none"'; }else{ echo '';}?> >
                                <li <?php if (strpos($page, "listVendidos.php")){ echo "class='active'";} ?>><a href="listVendidos.php">Finalizados</a>
                                </li>
                                <hr class="hrmenu">
                            </div>
                            <div <?php if($seguridad->valida_permiso_usuario($_SESSION['idusuario'],$menu_clave5)==0){ echo 'style="display:none"'; }else{ echo '';}?> >
                                <li <?php if (strpos($page, "listCategoria.php") AND $_REQUEST['tipo'] == 4){ echo "class='active'";} ?>><a href="listCategoria.php?tipo=4">Categorías</a>
                                </li>
                                <hr class="hrmenu">
                            </div>
                            <div <?php if($seguridad->valida_permiso_usuario($_SESSION['idusuario'],$menu_clave5)==0){ echo 'style="display:none"'; }else{ echo '';}?> >
                                <li <?php if (strpos($page, "listCategoria.php") AND $_REQUEST['tipo'] == 2){ echo "class='active'";} ?>><a href="listCategoria.php?tipo=2">Años</a>
                                </li>
                                <hr class="hrmenu">
                            </div>
                            <div <?php if($seguridad->valida_permiso_usuario($_SESSION['idusuario'],$menu_clave4)==0){ echo 'style="display:none"'; }else{ echo '';}?> >
                                <li <?php if ((strpos($page, "listPortafolio.php") or strpos($page, "formPortafolio.php")) AND $_REQUEST['tipo'] == 2){ echo "class='active'";} ?>><a href="listPortafolio.php?tipo=2">Proyectos</a>
                                </li>
                                <hr class="hrmenu">
                            </div>
                        </ul>
                    </li>
                    <hr class="hrmenu">
                </div>-->

                <!--<div <?php if($seguridad->valida_permiso_usuario($_SESSION['idusuario'],$menu_clave8) == 0 AND $seguridad->valida_permiso_usuario($_SESSION['idusuario'],$menu_clave9) == 0){ echo 'style="display:none"'; }else{ echo '';}?> >
                    <li class="manita relative submenu-trigger" data-target-submenu="menu-blog">BLOG
                        <ul class="submenu" id="menu-blog">
                            <div <?php if($seguridad->valida_permiso_usuario($_SESSION['idusuario'],$menu_clave9)==0){ echo 'style="display:none"'; }else{ echo '';}?> >
                                <li <?php if (strpos($page, "listCategoria.php") AND $_REQUEST['tipo'] == 3){ echo "class='active'";} ?>><a href="listCategoria.php?tipo=3">Categoria Blog</a>
                                </li>
                                <hr class="hrmenu">
                            </div>
                            <div <?php if($seguridad->valida_permiso_usuario($_SESSION['idusuario'],$menu_clave8)==0){ echo 'style="display:none"'; }else{ echo '';}?> >
                                <li <?php if ((strpos($page, "listBlog.php") or strpos($page, "formBlog.php"))){ echo "class='active'";} ?>><a href="listBlog.php">Blog</a>
                                </li>
                                <hr class="hrmenu">
                            </div>
                        </ul>
                    </li>
                    <hr class="hrmenu">
                </div>-->
                <!--<div <?php if($seguridad->valida_permiso_usuario($_SESSION['idusuario'],$menu_clave10)==0){ echo 'style="display:none"'; }else{ echo '';}?> >
                    <li <?php if (strpos($page, "listUbicaciones.php")){ echo "class='active'";} ?>><a href="listUbicaciones.php">CONTACTO</a>
                    </li>
                    <hr class="hrmenu">
                </div>-->
                <!--<div <?php if($seguridad->valida_permiso_usuario($_SESSION['idusuario'],$menu_clave11)==0){ echo 'style="display:none"'; }else{ echo '';}?> >
                    <li <?php if (strpos($page, "listNewsletter.php")){ echo "class='active'";} ?>><a href="listNewsletter.php">NEWSLETTER</a>
                    </li>
                    <hr class="hrmenu">
                </div>-->
            </ul>
        </div>
