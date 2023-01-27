<!--wrapper es el que contiene a toda la pagina-->
    <div id="wrapper" class="wrapper-movil">
        <!-- Sidebar Seccion del menu -->
        <div id="sidebar-wrapper">
            <ul class="sidebar-nav">
                <?php 
                if (!isset($menu_clave1) && empty($menu_clave1)) {
                    $menu_clave1 = null;
                }                
                ?>
                <div <?php if($seguridad->valida_permiso_usuario($_SESSION['idusuario'],$menu_clave1)==0){ echo 'style="display:none"'; }else{ echo '';}?> >             
                    <li <?php if (strpos($page, "listlote.php") or strpos($page, "formlote.php") or strpos($page, "formprecio.php")){ echo "class='active'";} ?>><a href="listlote.php">Lotificación</a>
                    </li>
                    <hr class="hrmenu">
                </div>
            </ul>
        </div>