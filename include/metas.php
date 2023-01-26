<?php
	include_once("include/path.php");
	$self = $_SERVER['PHP_SELF'];
	$temporal = new seo(1);
	$temporal -> obtener_seo();
  $img = $temporal -> listarImgSeo();
?>
<!-- Sección de los metas por default -->
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
<meta name="author" content="<?= $temporal->metaAuthor?>" />
<meta property="og:type" content="<?= $temporal->metaOgType;?>" />
<meta property="og:locale" content="<?= $temporal->metaOgLocale;?>" />
<meta property="og:site_name" content="<?= $temporal->metaOgTitle?>" />

<?php
	if(strpos($self,"detalle-noticia")){
?>
<meta name="description" content="<?=strip_tags(htmlspecialchars_decode($blog->_datos_blog->_descripcion))?>" />
<meta name="keywords" content="Torre Triada, Inversión, Lotes Comerciales, Oficinas, Suites Hoteleras" />
<meta property="og:title" content="<?=$blog->_datos_blog->_titulo?>" />
<meta property="og:url" content="<?=PATH?>detalle-noticia/<?=$id?>-<?=$blog->_datos_blog->_url_amigable?>" />
<meta property="og:description" content="<?=strip_tags(htmlspecialchars_decode($blog->_datos_blog->_descripcion))?>" />
<meta property="og:image" content="<?=PATH?>img/blog/<?=$imgBlog?>" />
<?php } ?>

<?php
	if(strpos($self,"politica-de-privacidad")){
?>
<meta name="description" content="Torre Triada es un proyecto vertical de usos mixtos inédito en Mérida que surge para transformar el paisaje urbano de una de las zonas más emblemáticas de Mérida y ofrecer, en un solo espacio, una innovadora propuesta de vida integral, en total sintonía con las nuevas tendencias y necesidades de la gente de hoy." />
<meta name="keywords" content="Torre Triada, Inversión, Lotes Comerciales, Oficinas, Suites Hoteleras" />
<meta property="og:title" content="Aviso de Privacidad" />
<meta property="og:url" content="<?= PATH?>politica-de-privacidad" />
<meta property="og:description" content="Torre Triada es un proyecto vertical de usos mixtos inédito en Mérida que surge para transformar el paisaje urbano de una de las zonas más emblemáticas de Mérida y ofrecer, en un solo espacio, una innovadora propuesta de vida integral, en total sintonía con las nuevas tendencias y necesidades de la gente de hoy." />
<meta property="og:image" content="<?= PATH.'img/imgSeo/'.$img[2]['ruta'];?>" />
<?php } ?>

<?php
	if(strpos($self,"index")){
?>
<meta name="description" content="Torre Triada es un proyecto vertical de usos mixtos inédito en Mérida que surge para transformar el paisaje urbano de una de las zonas más emblemáticas de Mérida y ofrecer, en un solo espacio, una innovadora propuesta de vida integral, en total sintonía con las nuevas tendencias y necesidades de la gente de hoy." />
<meta name="keywords" content="Torre Triada, Inversión, Lotes Comerciales, Oficinas, Suites Hoteleras" />
<meta property="og:title" content="Inicio" />
<meta property="og:url" content="<?= PATH?>" />
<meta property="og:description" content="Torre Triada es un proyecto vertical de usos mixtos inédito en Mérida que surge para transformar el paisaje urbano de una de las zonas más emblemáticas de Mérida y ofrecer, en un solo espacio, una innovadora propuesta de vida integral, en total sintonía con las nuevas tendencias y necesidades de la gente de hoy." />
<meta property="og:image" content="<?= PATH.'img/imgSeo/'.$img[2]['ruta'];?>" />
<?php } ?>

<?php
	if(strpos($self,"noticias")){
?>
<meta name="description" content="Torre Triada es un proyecto vertical de usos mixtos inédito en Mérida que surge para transformar el paisaje urbano de una de las zonas más emblemáticas de Mérida y ofrecer, en un solo espacio, una innovadora propuesta de vida integral, en total sintonía con las nuevas tendencias y necesidades de la gente de hoy." />
<meta name="keywords" content="Torre Triada, Inversión, Lotes Comerciales, Oficinas, Suites Hoteleras" />
<meta property="og:title" content="Noticias" />
<meta property="og:url" content="<?= PATH?>noticias" />
<meta property="og:description" content="Torre Triada es un proyecto vertical de usos mixtos inédito en Mérida que surge para transformar el paisaje urbano de una de las zonas más emblemáticas de Mérida y ofrecer, en un solo espacio, una innovadora propuesta de vida integral, en total sintonía con las nuevas tendencias y necesidades de la gente de hoy." />
<meta property="og:image" content="<?= PATH.'img/imgSeo/'.$img[2]['ruta'];?>" />
<?php } ?>

<link rel="apple-touch-icon" sizes="180x180" href="<?=PATH?>img/favicon/apple-touch-icon.png">
<link rel="icon" type="image/png" sizes="32x32" href="<?=PATH?>img/favicon/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="16x16" href="<?=PATH?>img/favicon/favicon-16x16.png">
<link rel="manifest" href="<?=PATH?>img/favicon/site.webmanifest">
<meta name="msapplication-TileColor" content="#da532c">
<meta name="theme-color" content="#ffffff">

<link rel='shortcut icon' href='<?=PATH;?>img/imgSeo/<?=$img[0]['ruta']?>'>

<!--Let browser know website is optimized for mobile-->
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<!--Importando bootstrap, también van aquí todo los estilos que necesitara nuesta pagina-->
<link type="text/css" rel="stylesheet" href="<?= PATH?>css/bootstrap.min.css" />

<!-- archivo que incluye nuestras funciones de la pagina -->
<link type="text/css" rel="stylesheet" type="text/css" href="<?= PATH?>css/style.css?v=1.88985">

<!-- Plugins -->

<link rel="stylesheet" type="text/css" href="<?= PATH?>css/outdatedBrowser.min.css" />

<link href="<?=PATH?>js/royalslider/royalslider.css" rel="stylesheet">

<link href="<?=PATH?>js/royalslider/skins/default/rs-default.css" rel="stylesheet">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.11.2/css/bootstrap-select.min.css">

<link rel="stylesheet" type="text/css" href="<?= PATH?>js/slick/slick.css"/>

<link rel="stylesheet" type="text/css" href="<?= PATH?>js/slick/slick-theme.css"/>

<link rel="stylesheet" href="<?= PATH?>js/rate/jquery.rateyo.min.css"/>

<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
