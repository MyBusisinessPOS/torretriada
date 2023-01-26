  <?php
  include("include/header.php");
  $_LANG="es";
  if(isset($_REQUEST['idCategoria']) and $_REQUEST['idCategoria'] != 0){
	    $idCategoria = $_REQUEST['idCategoria'];
	}else{
	    $idCategoria = 0;
	}

	if(isset($_REQUEST['busqueda']) and $_REQUEST['busqueda']!=''){
		$busqueda=$_REQUEST['busqueda'];
	}else{
		$busqueda='';
	}
  ?>
  <div class="portada">
    <div class="titulo">
      NOTICIAS
    </div>
    <div class="container">
      <div class="row row-con-margen">
        <div class="col-xl-6 col-lg-6 col-md-6 col-6">
          <p>Torre Triada <span>></span> Noticias</p>
        </div>
        <div class="col-xl-6 col-lg-6 col-md-6 col-6">
          <p class="dos"><a href="<?=PATH?>">< Regresar</a></p>
        </div>
      </div>
    </div>
  </div>
  <div class="relative">
    <img src="<?=PATH?>img/shape-noticias.svg" alt="Torre Triada" class="shape-noticias">
    <div class="inicio-6 noticias contenido-general container">
      <div class="container relativeZ2">
        <div class="row row-con-margen">
          <div class="col-xl-10 col-lg-10 col-md-10 offset-md-1 offset-lg-1 offset-xl-1" id="mastersliderBlog">
            <div class="row row-con-margen listaBlog">

            </div>
          </div>
        </div>
      </div>
      <div class="contiene-paginador">
        <div class="paginador">
          <ul>
            <li class="anterior"><ion-icon name="ios-arrow-back"></ion-icon></li>
            <li><a href="#" class="active">1</a></li>
            <li><a href="#">2</a></li>
            <li><a href="#">3</a></li>
            <li><a href="#">4</a></li>
            <li class="siguiente"><ion-icon name="ios-arrow-forward"></ion-icon></li>
          </ul>
        </div>
        <div class="linea">
        </div>
      </div>
    </div>
  </div>
  <?php include("include/footer.php"); ?>
  <?php include 'include/scripts.php';?>
  <script>
  var LANG ='es';
	var _PATH = '<?=PATH?>';
	var _LANG ='es';
	var order = '';
	var idCategoria ='<?=$idCategoria?>';
	var anos = 0;
	var busqueda ='<?=$busqueda?>';
  </script>
  <script src="<?=PATH?>js/functionsBlog.js"></script>
  <script type="text/javascript">
  //scroll top and bottom

    $(window).scroll(function(){
      var iCurScrollPos = $(this).scrollTop();
      iScrollPos = iCurScrollPos;
      if(iScrollPos == 0){
      if($( "header,.menu-mobile" ).hasClass("in")){
        $( "header,.menu-mobile" ).removeClass("in");
        $( "header,.menu-mobile" ).removeClass("dos");
      }
      else{

      }
      }
      if(iScrollPos > 50){
      if($( "header,.menu-mobile" ).hasClass("in")){
      }
      else{
        $( "header,.menu-mobile" ).addClass("in");
        $( "header,.menu-mobile" ).addClass("dos");
      }

      }

    });
    $("#a-6").addClass("active");
  </script>
  </body>
</html>
