<?php
	include_once('clases/usuario.php');
	include_once('clases/datosusuario.php');
	include_once('clases/seguridad.php');
	if(isset($_SESSION['idusuario']))
	$idusuario=$_SESSION['idusuario'];
	else
	$idusuario=0;

	$usuario=new usuario($idusuario,'','','',0);
	$usuario->obten_usuario();
	$usuario->datosusuario->obtener_datos_usuario();
	$seguridad = new seguridad();
	$conf='conf';
	$page = $_SERVER['SCRIPT_NAME'];
?>

<body>
	<!--Sección de la cabezera-->
	<header>
    	<!--Header que se muestra en las clases lg y md-->
    	<div class="styled-large">
            <div id="navBlack" class="jumbotron navbar-fixed-top">
                <div class="col-lg-4 col-md-4">
                    <img id="imgLogo" class="imgNavBlack" src="img/Slogan_logo.svg">
                    <span id="urlLocker">sloganpublicidad.com</span>
                </div>
                <div class="col-lg-8 col-md-8">
                    <p id="fecha">
                    	<?php
							$meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
 							echo date('d')." ".$meses[date('n')-1]. " ".date('Y') ;
						?>
                    </p>
                    <span id="username"><?php echo $usuario->datosusuario->nombre;?></span>
                </div>
            </div>
            <div id="navBlue" class="jumbotron navbar-fixed-top">
                <div class="col-lg-2">
                    <div id="barraazul">
                        <p id="panel">PANEL DE CONTROL</p>
                    </div>
                </div>
                <div class="col-lg-10">
                    <ul id="ulmenu">
                        <li onClick="cerrarsesion(<?=$idusuario?>)" id="li1"><img src="img/exit.png" width="15" height="17" class="imgresources"><span class="letras">Cerrar sesión</span></li>
                        <li style="display: none" class="limenu"><img src="img/msn.png" width="18" height="14" class="imgresources"><span class="letras">Mensajes</span></li>
                        <li id="user" class="limenu userr"><img src="img/user.png" width="19" height="19" class="imgresources"><span class="letras">Perfil</span></li>
                        <li <?php if($seguridad->valida_permiso_usuario($_SESSION['idusuario'],$conf)==0) echo ' style="display:none" ';?> id="settings" class="limenu settingss"><img src="img/tuerca.png" width="18" height="19" class="imgresources"><span class="letras">Configuración</span></li>
                        <li class="limenu"><img src="img/home2.png" width="18" height="14" class="imgresources"><span class="letras">Ir A La Página</span></li>
                    </ul>
                </div>
            </div>
        </div>
        <!--Header que se muestra en las clases sm y xs-->
        <div class="styled-small">
        	<div id="navBlack" class="jumbotron navbar-fixed-top">
                <div class="col-sm-2 col-xs-3">
                    <a id="menu-toggle" href="#"><img id="btnmenu" src="img/btnmenu.png"></a>
                </div>
                <div class="col-sm-6 col-xs-5">
                	<img id="imgLogo" class="imgNavBlack" src="img/logolocker.png">
                </div>
                <div class="col-sm-4 col-sm-4">
                	<span id="username"><?php echo $usuario->datosusuario->nombre;?></span>
                </div>
            </div>
            <div id="navBlueMovil" class="jumbotron navbar-fixed-top">
            	<p id="panel">PANEL DE CONTROL</p>
            </div>
            <div id="navBlueMovil2" class="jumbotron navbar-fixed-top">
            	<div align="center" class="col-sm-4 col-xs-4 settingss">
                	<img src="img/tuerca.png" class="imgresources">
                </div>
                <div align="center" class="col-sm-4 col-xs-4 userr">
                	<img src="img/user.png" class="imgresources">
                </div>
                <div align="center" class="col-sm-4 col-xs-4">
                	<img onClick="cerrarsesion(<?=$idusuario?>)" src="img/exit.png" class="imgresources">
                </div>
            </div>
        </div>
    </header>
