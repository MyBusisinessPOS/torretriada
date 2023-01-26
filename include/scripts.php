<!--Importando materialize o bootstrap, también van aquí todo los javascript que necesitara nuesta pagina-->
<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>

<script type="text/javascript" src="<?= PATH;?>js/bootstrap.min.js"></script>

<script src="<?=PATH?>js/modernizr.js"></script>

<script src="<?=PATH?>js/royalslider/jquery.royalslider.min.js"></script>

<script>
	var PATH='<?=PATH?>';
	//$("#modalMenu").modal("show");
</script>

<script>
$(document).ready(function(){
    $("body").scrollspy({
        target: "#myNavbar",
        offset: 70
    })
});
</script>

<!-- archivo javascript que incluye nuestras funciones de la pagina -->

<script src='https://www.google.com/recaptcha/api.js?hl=en'></script>

<script type="text/javascript" src="<?= PATH;?>js/funciones.js"></script>

<script src="<?=PATH?>js/jquery.matchHeight.js" type="text/javascript"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.11.2/js/bootstrap-select.min.js"></script>

<script src="https://kit.fontawesome.com/85c0d4886e.js" crossorigin="anonymous"></script>

<script src="https://unpkg.com/ionicons@4.2.4/dist/ionicons.js"></script>

<script type="text/javascript" src="<?=PATH?>js/slick/slick.min.js"></script>

<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

<script src="https://unpkg.com/scrollreveal"></script>

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

		//$("#modalStars").modal("show");

		//inicialización AOS
		$(window).load(function(){
			setTimeout(function(){
				$( ".loader" ).animate({
					top: "-100%",
					opacity:0
				}, 1000, function() {
					// Animation complete.
					AOS.init({
					  once: true, // whether animation should happen only once - while scrolling down
					  mirror: false
					});
				});
			}, 2000);
		});

		$(".ver-recorrido").click(function(){
			$("#modalPaseo").modal("show");
		});

		$(".ver-amenidades").click(function(){
			$("#modalPaseo2").modal("show");
		});

		$(window).on("scroll", function() {
		    var scrollHeight = $(document).height();
		    var scrollPosition = $(window).height() + $(window).scrollTop();
		    if ((scrollHeight - scrollPosition) / scrollHeight === 0) {
		        $(".acciones").addClass("bottom");
		    }else{
					$(".acciones").removeClass("bottom");
				}
		});


</script>
<script>

	function enviarMensaje3(){

		//$("#btn-sends").attr("disabled", true);

		$("#c-nombre3,#c-telefono3,#c-email3,#c-mensaje3,#c-asunto3").removeClass("error-borde");
		$(".mensaje-de-error-3").hide();

		var filter=/^[A-Za-z0-9_.]*@[A-Za-z0-9_]+.[A-Za-z0-9_.]+[A-za-z]$/;
		var email = $('#c-email3').val();
		var nombre = $('#c-nombre3').val();
		var telefono = $('#c-telefono3').val();
		var mensaje = $('#c-mensaje3').val();
		var captcha =$('#formContact3 textarea[name="g-recaptcha-response"]').val();
		var asunto = $('#c-asunto3').val();

		if (filter.test(email)){
		sendMail = "true";
		} else{
		$('#c-email3').addClass("error-borde");
		$(".mensaje-de-error-3").show();
		 //aplicamos color de borde si el se encontro algun error en el envio
		sendMail = "false";
		}
		if (nombre.length == 0 ){
		$('#c-nombre3').addClass("error-borde");
		$(".mensaje-de-error-3").show();
		var sendMail = "false";
		}
		if (asunto.length == 0 ){
		$('#c-asunto3').addClass("error-borde");
		$(".mensaje-de-error").show();
		var sendMail = "false";
		}
		if (telefono.length == 0 ){
		$('#c-telefono3').addClass("error-borde");
		$(".mensaje-de-error-3").show();
		var sendMail = "false";
		}
		if (!$("#aceptoC3").prop("checked")){
		var sendMail = "false";
		}
		if (captcha == "" ){
		$(".mensaje-de-error-3").show();
		console.log("error captcha contact");
		//$('.g-recaptcha').after( "<span class='error-c'>Please check the captcha</span>" );

		var sendMail = "false";

		}

		//console.log($('input:radio[name=local]:checked').val());

		if(sendMail == "true"){
			$("#formContact3").submit();
			$("#formContact3")[0].reset();
		 /*var datos = {

				 "nombre" : $('#c-nombre3').val(),

					"telefono" : $('#c-telefono3').val(),

					 "correo" : $('#c-email3').val(),

					 "asunto" : "Descarga del brochure"

		 };

		 $.ajax({

				 data:  datos,
				 // hacemos referencia al archivo contacto.php
				 url:   ''+PATH+'send.php',

				 type:  'POST',

				 beforeSend: function () {
				 },

				 success:  function (response) {
					 console.log(response);
						if(response=="Z^S1a[FTKNN7z{{h" || response=="214"){
						 var texto= "¡Gracias por contactarnos, en breve un asesor se pondrá en contacto contigo!";
						}
						else{
						 var texto= "¡Algo salió mal, inténtelo más tarde!";
						}
						$("#ocultosuccess3").text(texto);
						$("#ocultosuccess3").fadeIn();
						$("#formContact3")[0].reset();

				 }

		 });*/

		} else{
		//$("#btn-sends").removeAttr("disabled");
		}

	}

	function enviarMensaje(){

		//$("#btn-sends").attr("disabled", true);

		$("#c-nombre,#c-telefono,#c-email,#c-mensaje,#c-asunto").removeClass("error-borde");
		$(".mensaje-de-error").hide();

		var filter=/^[A-Za-z0-9_.]*@[A-Za-z0-9_]+.[A-Za-z0-9_.]+[A-za-z]$/;
		var email = $('#c-email').val();
		var nombre = $('#c-nombre').val();
		var telefono = $('#c-telefono').val();
		var mensaje = $('#c-mensaje').val();
		var asunto = $('#c-asunto').val();
		var mensaje = $('#c-mensaje').val();
		var captcha =$('#formContact textarea[name="g-recaptcha-response"]').val();

		if (filter.test(email)){
		sendMail = "true";
		} else{
		$('#c-email').addClass("error-borde");
		$(".mensaje-de-error").show();
		 //aplicamos color de borde si el se encontro algun error en el envio
		sendMail = "false";
		}
		if (nombre.length == 0 ){
		$('#c-nombre').addClass("error-borde");
		$(".mensaje-de-error").show();
		var sendMail = "false";
		}
		if (telefono.length == 0 ){
		$('#c-telefono').addClass("error-borde");
		$(".mensaje-de-error").show();
		var sendMail = "false";
		}
		if (asunto.length == 0 ){
		$('#c-asunto').addClass("error-borde");
		$(".mensaje-de-error").show();
		var sendMail = "false";
		}
		if (mensaje.length == 0 ){
		$('#c-mensaje').addClass("error-borde");
		$(".mensaje-de-error").show();
		var sendMail = "false";
		}
		if (!$("#acepto").prop("checked")){
		var sendMail = "false";
		}
		if (captcha == "" ){
		$(".mensaje-de-error").show();
		console.log("error captcha contact");
		//$('.g-recaptcha').after( "<span class='error-c'>Please check the captcha</span>" );

		var sendMail = "false";

		}

		//console.log($('input:radio[name=local]:checked').val());

		if(sendMail == "true"){
			$("#formContact").submit();
			$("#formContact")[0].reset();
		 /*var datos = {

				 "nombre" : $('#c-nombre3').val(),

					"telefono" : $('#c-telefono3').val(),

					 "correo" : $('#c-email3').val(),

					 "asunto" : "Descarga del brochure"

		 };

		 $.ajax({

				 data:  datos,
				 // hacemos referencia al archivo contacto.php
				 url:   ''+PATH+'send.php',

				 type:  'POST',

				 beforeSend: function () {
				 },

				 success:  function (response) {
					 console.log(response);
						if(response=="Z^S1a[FTKNN7z{{h" || response=="214"){
						 var texto= "¡Gracias por contactarnos, en breve un asesor se pondrá en contacto contigo!";
						}
						else{
						 var texto= "¡Algo salió mal, inténtelo más tarde!";
						}
						$("#ocultosuccess3").text(texto);
						$("#ocultosuccess3").fadeIn();
						$("#formContact3")[0].reset();

				 }

		 });*/

		} else{
		//$("#btn-sends").removeAttr("disabled");
		}

	}


	function enviarMensajeFooter(){

		//$("#btn-sends").attr("disabled", true);

		$("#c-nombreF,#c-emailF").removeClass("error-borde");
		$(".mensaje-de-error-3").hide();

		var filter=/^[A-Za-z0-9_.]*@[A-Za-z0-9_]+.[A-Za-z0-9_.]+[A-za-z]$/;
		var email = $('#c-emailF').val();
		var nombre = $('#c-nombreF').val();

		if (filter.test(email)){
		sendMail = "true";
		} else{
		$('#c-emailF').addClass("error-borde");
		$(".mensaje-de-error-3").show();
		 //aplicamos color de borde si el se encontro algun error en el envio
		sendMail = "false";
		}
		if (nombre.length == 0 ){
		$('#c-nombreF').addClass("error-borde");
		$(".mensaje-de-error-3").show();
		var sendMail = "false";
		}


		//console.log($('input:radio[name=local]:checked').val());

		if(sendMail == "true"){
			$("#formContactFooter").submit();
			$("#formContactFooter")[0].reset();
		 /*var datos = {

				 "nombre" : $('#c-nombre3').val(),

					"telefono" : $('#c-telefono3').val(),

					 "correo" : $('#c-email3').val(),

					 "asunto" : "Descarga del brochure"

		 };

		 $.ajax({

				 data:  datos,
				 // hacemos referencia al archivo contacto.php
				 url:   ''+PATH+'send.php',

				 type:  'POST',

				 beforeSend: function () {
				 },

				 success:  function (response) {
					 console.log(response);
						if(response=="Z^S1a[FTKNN7z{{h" || response=="214"){
						 var texto= "¡Gracias por contactarnos, en breve un asesor se pondrá en contacto contigo!";
						}
						else{
						 var texto= "¡Algo salió mal, inténtelo más tarde!";
						}
						$("#ocultosuccess3").text(texto);
						$("#ocultosuccess3").fadeIn();
						$("#formContact3")[0].reset();

				 }

		 });*/

		} else{
		//$("#btn-sends").removeAttr("disabled");
		}

	}

	$(".abre-modal").click(function(){
		$("#modalContacto").modal("show");
	});
	//$("#modalAgenda").modal("show");

	<?php if($_REQUEST["success"]){ ?>
		$("#modalSuccess").modal("show");
	<?php } ?>


	$(".open-modal").click(function(){
		$("#modalRegistro").modal("show");
	});

	$(".openMasterPlan").click(function(){
		$("#modalPlanMaestro").modal("show");
	});

	</script>

	<!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-139141128-1"></script>
	<script>
	  window.dataLayer = window.dataLayer || [];
	  function gtag(){dataLayer.push(arguments);}
	  gtag('js', new Date());

	  gtag('config', 'UA-139141128-1');
	</script>

	<!-- Global site tag (gtag.js) - Google Analytics -->

	<script async src="https://www.googletagmanager.com/gtag/js?id=G-EX41CZJSJ0"></script>

	<script>
	window.dataLayer = window.dataLayer || [];
	function gtag(){dataLayer.push(arguments);}
	gtag('js', new Date());

	gtag('config', 'G-EX41CZJSJ0');
	</script>

	<!-- Facebook Pixel Code -->
	<script>
	!function(f,b,e,v,n,t,s)
	{if(f.fbq)return;n=f.fbq=function(){n.callMethod?
	n.callMethod.apply(n,arguments):n.queue.push(arguments)};
	if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
	n.queue=[];t=b.createElement(e);t.async=!0;
	t.src=v;s=b.getElementsByTagName(e)[0];
	s.parentNode.insertBefore(t,s)}(window, document,'script',
	'https://connect.facebook.net/en_US/fbevents.js');
	fbq('init', '575374470313219');
	fbq('track', 'PageView');
	</script>
	<noscript><img height="1" width="1" style="display:none"
	src="https://www.facebook.com/tr?id=575374470313219&ev=PageView&noscript=1"
	/></noscript>
	<!-- End Facebook Pixel Code -->


<?php
if(strpos($self,"master-plan")){
	echo '<script>
		$("#a-6").addClass("active");
	</script>';
}
if(strpos($self,"noticias") || strpos($self,"detalle-noticia")){
	echo '<script>
		$("#a-8").addClass("active");
	</script>';
}
?>
