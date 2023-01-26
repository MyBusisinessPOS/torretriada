  <?php
  $self = $_SERVER['PHP_SELF'];
  if(strpos($self,"detalle-noticia")){
  function __autoload($nombre_clase) {
  		include 'panel/clases/'.$nombre_clase.'.php';
  }
  }
  $id = $_REQUEST['idBlog'];
  $_LANG="es";
  $blog = new blog($id);
  $blog -> obtener_datos_blog($_LANG);
  $blog -> get_blog($_LANG);
  $rc = $blog -> listRecentBlog($_LANG,$id);
  $prev = $blog -> listBlogPrev($_LANG,$id);
  $next = $blog -> listBlogNext($_LANG,$id);
  if($blog->_rutaR != ""){
    $imgBlog=$blog->_rutaR;
  }
  else{
    $imgBlog=$blog->_ruta;
  }

  include("include/header.php");
  ?>
  <?php

      $dia=substr($blog->_fecha_creacion_unformated,8,2);
      $mes1=substr($blog->_fecha_creacion_unformated,5,2);
      $ano=substr($blog->_fecha_creacion_unformated,0,4);
      if($mes1=='01'){
        $mes='Enero';}
      if($mes1=='02'){
        $mes='Febrero';}
      if($mes1=='03'){
        $mes='Marzo';}
      if($mes1=='04'){
        $mes='Abril';}
      if($mes1=='05'){
        $mes='Mayo';}
      if($mes1=='06'){
        $mes='Junio';}
      if($mes1=='07'){
        $mes='Julio';}
      if($mes1=='08'){
        $mes='Agosto';}
      if($mes1=='09'){
        $mes='Septiembre';}
      if($mes1=='10'){
        $mes='Octubre';}
      if($mes1=='11'){
        $mes='Noviembre';}
      if($mes1=='12'){
        $mes='Diciembre';}

      $fechaf=$dia.' '.$mes. ', '.$ano;
  ?>
  <div class="portada">
    <div class="titulo">
      NOTICIAS
    </div>
    <div class="container">
      <div class="row row-con-margen">
        <div class="col-xl-6 col-lg-6 col-md-6 col-6">
          <p>Torre Triada <span>></span> Noticias <span>></span> <?=$fechaf?></p>
        </div>
        <div class="col-xl-6 col-lg-6 col-md-6 col-6">
          <p class="dos"><a href="<?=PATH?>noticias">< Regresar</a></p>
        </div>
      </div>
    </div>
  </div>
  <div class="detalle-noticia container-fluid relative">
    <img src="<?=PATH?>img/shape-noticias.svg" alt="Torre Triada" class="shape-noticias">
    <div class="row row-con-margen">
      <div class="col-xl-10 col-lg-10 col-md-12 offset-xl-1 offset-lg-1 relativeZ2">
        <div class="imagen">
          <img src="<?=PATH?>img/blog/<?=$blog->_ruta?>" alt="w100Hauto" class="w100Hauto principal">
          <div class="fecha"><?=$fechaf?></div>
        </div>
        <div class="compartir">
          <span class="dos">Compartir en:</span>
          <div class="addthis_inline_share_toolbox_dj3k"></div>
        </div>
        <div class="h2"><?=$blog->_datos_blog->_titulo?></div>
        <?php
        if(count($blog->_contenido_blog)>0){
          foreach ($blog->_contenido_blog as $c) {
            if($c['tipo']==1){
        ?>
        <div class="p margin-30">
          <?=($_LANG=='es') ? $c['descripcion_es'] : $c['descripcion_en'];?>
        </div>
        <?php
            }
            else if($c['tipo']==2){
        ?>
        <img src="<?=PATH?>img/blog/contenido/<?=$c['imagen']?>" class="img-responsive w100Hauto img margin-30">
        <?php
            }
            else if($c['tipo']==3){
        ?>
        <div class="margin-30">
            <div class="master-slider ms-skin-default slider-video" id="Onlyvideo-">
                <div class="ms-slide">
                    <img src="<?=PATH?>js/masterslider/style/blank.gif" data-src="<?=PATH?>img/blog/contenido/<?=$c['imagen']?>" alt="<?=$blog -> _datos_blog -> _titulo?>"/>
                    <a href="<?=$c['iframe']?>" data-type="video">Noticia</a>
                </div>
            </div>
        </div>
        <?php
            }else if($c['tipo']==4){
              if(count($c['galeria'])>0){
        ?>
        <div class="margin-30">
            <div class="master-slider ms-skin-default slider-img" id="Gallery-9">
              <?php
                  foreach ($c['galeria'] as $g) {
              ?>
            <div class="ms-slide">
                <img src="<?=PATH?>js/masterslider/style/blank.gif" data-src="<?=PATH?>img/galeria/<?=$g['img']?>" alt="<?=$blog -> _datos_blog -> _titulo?>"/>
            </div>
        <?php
            }
        ?>
            </div>
        </div>
        <?php
              }
            }
          }
        }
        ?>
        <div class="row row-con-margen controles">
          <div class="col-xl-4 col-md-4 col-md-12">
            <?php
            if(count($prev)>0){
              foreach ($prev as $p) {
            ?>
            <a href="<?=PATH?>detalle-noticia/<?=$p['id_blog']?>-<?=$p['url_amigable']?>" class="anterior"><button type="button" class="boton">Anterior nota ></button></a>
            <?php } } ?>
          </div>
          <div class="col-xl-4 col-md-4 col-md-12">
            <div class="compartir dos text-center">
              <span class="dos">Compartir en:</span>
              <div class="addthis_inline_share_toolbox_dj3k"></div>
            </div>
          </div>
          <div class="col-xl-4 col-md-4 col-md-12 tres">
            <?php
            if(count($next)>0){
              foreach ($next as $n) {
            ?>
            <a href="<?=PATH?>detalle-noticia/<?=$n['id_blog']?>-<?=$n['url_amigable']?>" class="anterior"><button type="button" class="boton dos">Siguiente nota ></button></a>
            <?php } } ?>
          </div>
        </div>

      </div>
    </div>
  </div>
  <?php include("include/footer.php"); ?>
  <?php include 'include/scripts.php';?>
  <link rel="stylesheet" href="<?=PATH?>js/masterslider/style/masterslider.css" />
  <link href="<?=PATH?>js/masterslider/skins/default/style.css" rel='stylesheet' type='text/css'>
  <link href='<?=PATH?>js/masterslider/ms-fullscreen.css' rel='stylesheet' type='text/css'>
  <script src="<?=PATH?>js/masterslider/jquery.easing.min.js"></script>
  <script src="<?=PATH?>js/masterslider/masterslider.min.js"></script>
  <script type="text/javascript">
     window.onload = function() {
        $('.slider-video').masterslider({
            width: 880,
            height: 520,
            space:5,
            view:'fade',
            layout:'fillwidth',
            autoHeight:true,
        });

        $('.slider-img').masterslider({
            width: 800,
            height: 500,
            space:1,
            loop: true,
            start: 1,
            preload: 5,
            view:'fade',
            layout:'fillwidth',
            autoHeight:true,
            controls : {
                arrows : {autohide:false},
            }
        });
    }
  </script>
  <script type="text/javascript">
    $("header,.menu-mobile").addClass("dos");
    //$("#a-6").addClass("active");
  </script>
  <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5888fcb9c9c730fe"></script>
  </body>
</html>
