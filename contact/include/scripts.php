<!--Importando materialize o bootstrap, también van aquí todo los javascript que necesitara nuesta pagina-->
<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>

<script type="text/javascript" src="<?= PATH;?>js/bootstrap.min.js"></script>

<script type='text/javascript' src="<?=PATH?>js/bootstrap-slider.js"></script>

<script src="<?=PATH?>js/modernizr.js"></script>

<script type="text/javascript" src="<?=PATH?>js/fullpage/fullpage.js"></script>

<script>
	var PATH='<?=PATH?>';
</script>

<!-- archivo javascript que incluye nuestras funciones de la pagina -->

<script src='https://www.google.com/recaptcha/api.js?hl=en'></script>

<script type="text/javascript" src="<?= PATH;?>js/funciones.js"></script>

<script src="<?=PATH?>js/jquery.matchHeight.js" type="text/javascript"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.11.2/js/bootstrap-select.min.js"></script>

<script defer src="https://use.fontawesome.com/releases/v5.0.9/js/all.js" integrity="sha384-8iPTk2s/jMVj81dnzb/iFR2sdA7u06vHJyyLlAd4snFpCl/SnyUjRrbdJsw1pGIl" crossorigin="anonymous"></script>

<script src="https://unpkg.com/ionicons@4.2.4/dist/ionicons.js"></script>

<!-- Navegadores des-actualizados -->
<script src="<?= PATH;?>js/outdatedBrowser.min.js"></script>
    <script>
	    function addLoadEvent(func) {
		    var oldonload = window.onload;
		    if (typeof window.onload != 'function') {
		        window.onload = func;
		    } else {
		        window.onload = function() {
		            oldonload();
		            func();
		        }
		    }
		}
		//call plugin function after DOM ready
		addLoadEvent(
		    outdatedBrowser({
		        bgColor: '#f25648',
		        color: '#ffffff',
		        lowerThan: 'transform'
		    })
		);

		//USING jQuery
		$( document ).ready(function() {
		    outdatedBrowser({
		        bgColor: '#f25648',
		        color: '#ffffff',
		        lowerThan: 'transform'
		    })
		})

		function irPage(id){
			fullpage_api.moveTo('page'+id+'', 1);
		}

		//$("#modalStars").modal("show");

</script>
<script type="text/javascript">
/* <![CDATA[ */
var google_conversion_id = 948667670;
var google_custom_params = window.google_tag_params;
var google_remarketing_only = true;
/* ]]> */
</script>
<script type="text/javascript" src="//www.googleadservices.com/pagead/conversion.js">
</script>
<noscript>
<div style="display:inline;">
<img height="1" width="1" style="border-style:none;" alt="" src="//googleads.g.doubleclick.net/pagead/viewthroughconversion/948667670/?guid=ON&amp;script=0"/>
</div>
</noscript>

<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-139141128-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-139141128-1');
</script>


<?php
if(strpos($self,"index")){
	echo '<script>
		$("#a-1").addClass("active");
	</script>';
}
?>
