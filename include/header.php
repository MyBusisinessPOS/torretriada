<?php
if(isset($_REQUEST["success"])){
  $success=$_REQUEST["success"];
}
else{
  $success="";
}
if($success=="ZS1aFTKNN7zh" || $success=="214"){
  header("Content-disposition: attachment; filename=TorreTriada_Folleto.pdf");
  header("Content-type: application/pdf");
  readfile("TorreTriada_Folleto.pdf");
}
$self = $_SERVER['PHP_SELF'];
if(!strpos($self,"detalle-noticia")){
function __autoload($nombre_clase) {
    include 'panel/clases/'.$nombre_clase.'.php';
}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <?php include 'include/metas.php';?>
        <?php
        	if(strpos($self,"detalle-noticia")){
        ?>
          <title><?=$blog->_datos_blog->_titulo?></title>
        <?php } ?>

        <?php
        	if(strpos($self,"noticias")){
        ?>
          <title>Noticias</title>
        <?php } ?>

        <?php
        	if(strpos($self,"politica-de-privacidad")){
        ?>
          <title>Aviso de Privacidad</title>
        <?php } ?>

        <?php
        	if(strpos($self,"index")){
        ?>
          <title>Inicio</title>
        <?php } ?>

      

        <meta name="facebook-domain-verification" content="h5og0zlcvvc1mztbmy1y6bnfb4fjiy" />

        <!-- Global site tag (gtag.js) - Google Ads: 10776880672 --> <script async src="https://www.googletagmanager.com/gtag/js?id=AW-10776880672"></script> <script> window.dataLayer = window.dataLayer || []; function gtag(){dataLayer.push(arguments);} gtag('js', new Date()); gtag('config', 'AW-10776880672'); </script>
        
<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-5RXH3TQ');</script>
<!-- End Google Tag Manager -->

        <?php
        	if(strpos($self,"agradecimiento")){
        ?>
        <!-- Event snippet for Enviar formulario para clientes potenciales conversion page --> <script> gtag('event', 'conversion', {'send_to': 'AW-10776880672/iEYnCLjYh_YCEKDM6JIo'}); </script>

        <?php } ?>

        <!-- Event snippet for Enviar formulario para clientes potenciales conversion page In your html page, add the snippet and call gtag_report_conversion when someone clicks on the chosen link or button. --> <script> function gtag_report_conversion(url) { var callback = function () { if (typeof(url) != 'undefined') { window.location = url; } }; gtag('event', 'conversion', { 'send_to': 'AW-10776880672/iEYnCLjYh_YCEKDM6JIo', 'event_callback': callback }); return false; } </script>

    </head>

	<body data-spy="scroll" data-target="#nav" data-offset="0">
        <div class="loader">
          <img src="<?=PATH?>img/logo.gif" alt="Torre Triada" class="centrado" width="250px">
        </div>
        <!-- Navegadores des-actualizados -->
        <div id="outdated">
            <h6>Tu Navegador esta desactualizado, para que el sitio</h6>
            <h6>funcione correctamente porfavor:</h6>
            <p> <a id="btnUpdateBrowser" href="http://www.updateyourbrowser.net/es">Actualiza tu navegador</a></p>
            <p class="last"><a href="#" id="btnCloseUpdateBrowser" title="Close">&times;</a></p>
        </div>
        <header id="myNavbar" data-aos="fade-down" data-aos-duration="2000">
          <nav id="nav" class="d-flex flex-column">
            <div class="row row-con-margen">
              <div class="col-lg-6 col-md-12 col-sm-12 col-izquierda">
                <ul class="nav nav-tabs nav-stacked nav-pills uno">
                  <?php
                  if(strpos($self,"index")){
                  ?>
                  <li><a href="#inicio" class="list-group-item">INICIO<br /><span class="marcador"></span></a></li>
                  <li><a href="#torre-triada" class="list-group-item">TORRE TRIADA<br /><span class="marcador"></span></a></li>
                  <li><a href="#ubicacion" class="list-group-item">UBICACIÓN<br /><span class="marcador"></span></a></li>
                  <li class="dropdown">
                    <a href="#espacios" class="list-group-item dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">ESPACIOS<br /><span class="marcador"></span></a>
                    <ul class="dropdown-menu">
                      <li><a href="<?=PATH?>#locales-comerciales">LOCALES COMERCIALES</a></li>
                      <li><a href="<?=PATH?>#oficinas">OFICINAS</a></li>
                      <li><a href="<?=PATH?>#departamentos">DEPARTAMENTOS</a></li>
                      <li><a href="<?=PATH?>#suites-hoteleras">SUITES HOTELERAS</a></li>
                    </ul>
                  </li>
                  
                  <?php } ?>
                </ul>
              </div>
              <div class="col-lg-6 col-md-12 col-sm-12 col-derecha">
                <ul class="nav nav-tabs nav-stacked nav-pills dos">
                  <?php
                  if(strpos($self,"index")){
                  ?>
                  <li><a href="#noticias" class="list-group-item">NOTICIAS<br /><span class="marcador"></span></a></li>
                  <li><a href="#desarrollador" class="list-group-item">DESARROLLADOR<br /><span class="marcador"></span></a></li>
                  <li><a href="#contacto" class="list-group-item">CONTACTO<br /><span class="marcador"></span></a></li>
                  <?php } else {?>
                    <li><a href="<?=PATH?>#noticias" id="a-8">NOTICIAS<br /><span class="marcador"></span></a></li>
                    <li><a href="<?=PATH?>#desarrollador">DESARROLLADOR<br /><span class="marcador"></span></a></li>
                    <li><a href="<?=PATH?>#contacto">CONTACTO<br /><span class="marcador"></span></a></li>
                  <?php } ?>
                  <li class="redes">
                    <a href="https://www.facebook.com/UrbazMX" target="_blank"><i class="fab fa-facebook red"></i></a>
                    <a href="https://www.instagram.com/urbaz.mx/" target="_blank"><i class="fab fa-instagram red dos"></i></a>
                  </li>
                </ul>
              </div>
            </div>
          </nav>
          <a href="<?=PATH?>"><img src="<?=PATH?>img/logo-torre-triada.svg" alt="Torre Triada" class="logo"></a>
          <img src="<?=PATH?>img/menu.svg" alt="Menú" class="d-block d-lg-none abre-menu icon-menu">
        </header>
        <div class="d-block d-lg-none menu-mobile">
          <div class="row">
            <div class="col">
              <a href="<?=PATH?>"><img src="<?=PATH?>img/logo-torre-triada.svg" class="logo" alt="Torre Triada" /></a>
            </div>
            <div class="col text-right dos">
              <img src="<?=PATH?>img/menu.svg" class="menu pointer abre-menu" alt="Torre Triada" />
            </div>
          </div>
        </div>
        <div class="modal" tabindex="-1" role="dialog" id="modalMenu">
          <div class="modal-dialog" role="document">
            <div class="modal-content align-items-center justify-content-center">
              <div class="row menu-m">
                <div class="col">
                  <a href="<?=PATH?>"><img src="<?=PATH?>img/logo-torre-triada.svg" class="logo" alt="Torre Triada" /></a>
                </div>
                <div class="col text-right dos">
                  <img src="<?=PATH?>img/cerrar.svg" class="cerrarMenu pointer cierra-menu" alt="Torre Triada" />
                </div>
              </div>
              <div class="punteado">
              </div>
              <ul>
                <?php
                if(strpos($self,"index")){
                ?>
                <li><a href="#inicio" class="directo">INICIO</a></li>
                <li><a href="#torre-triada" class="directo">TORRE TRIADA</a></li>
                <li><a href="#ubicacion" class="directo">UBICACIÓN</a></li>
                <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">ESPACIOS<span class="marcador"></span></a>
                  <ul class="dropdown-menu">
                    <li><a href="<?=PATH?>#locales-comerciales" class="directo">LOCALES COMERCIALES</a></li>
                    <li><a href="<?=PATH?>#oficinas" class="directo">OFICINAS</a></li>
                    <li><a href="<?=PATH?>#departamentos" class="directo">DEPARTAMENTOS</a></li>
                    <li><a href="<?=PATH?>#suites-hoteleras" class="directo">SUITES HOTELERAS</a></li>
                  </ul>
                </li>
                <li><a href="<?=PATH?>cotizador" class="directo">COTIZADOR</a></li>
                <li><a href="#noticias" class="directo">NOTICIAS</a></li>
                <li><a href="#desarrollador" class="directo">DESARROLLADOR</a></li>
                <li><a href="#contacto" class="directo">CONTACTO</a></li>
                <?php } else {?>
                  <li><a href="<?=PATH?>#inicio" class="directo">INICIO</a></li>
                  <li><a href="<?=PATH?>#torre-triada" class="directo">TORRE TRIADA</a></li>
                  <li><a href="<?=PATH?>#ubicacion" class="directo">UBICACIÓN</a></li>
                  <li class="dropdown">
                    <a href="#" class="list-group-item dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">ESPACIOS<span class="marcador"></span></a>
                    <ul class="dropdown-menu">
                      <li><a href="<?=PATH?>#locales-comerciales" class="directo">LOCALES COMERCIALES</a></li>
                      <li><a href="<?=PATH?>#oficinas" class="directo">OFICINAS</a></li>
                      <li><a href="<?=PATH?>#departamentos" class="directo">DEPARTAMENTOS</a></li>
                      <li><a href="<?=PATH?>#suites-hoteleras" class="directo">SUITES HOTELERAS</a></li>
                    </ul>
                  </li>
                  <li><a href="<?=PATH?>cotizador" class="directo">COTIZADOR</a></li>
                  <li><a href="<?=PATH?>#noticias" class="directo">NOTICIAS</a></li>
                  <li><a href="<?=PATH?>#desarrollador" class="directo">DESARROLLADOR</a></li>
                  <li><a href="<?=PATH?>#contacto" class="directo">CONTACTO</a></li>
                <?php } ?>
              </ul>
              <div class="redes">
                <a href="https://www.facebook.com/UrbazMX" target="_blank"><i class="fab fa-facebook red"></i></a>
                <a href="https://www.instagram.com/urbaz_/" target="_blank"><i class="fab fa-instagram red dos"></i></a>
              </div>
            </div>
          </div>
        </div>
