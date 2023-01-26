  <?php
  include("include/header.php");
  ?>
  <style media="screen">
  header,footer,.menu-mobile{display: none !important}
    .contact-video{
      height: 100vh; position: relative; background-image: url('<?=PATH?>img/video/fondo.jpg'); background-size: cover; -webkit-background-size: cover; -moz-background-size: cover; position: fixed; width: 100%
    }
    .contact-video form{
      width: 460px; max-width: 90%; position: absolute; left: 50%; top: 50%; transform: translate(-50%,-50%); -webkit-transform: translate(-50%,-50%); -moz-transform: translate(-50%,-50%);
    }
    .contact-video form .logo{
      margin-bottom: 50px
    }
    .contact-video form h1{
      font-style: normal;
      font-weight: 300;
      font-size: 24px;
      line-height: 32px;
      text-align: center;
      letter-spacing: 0.05em;
      color: #FF595A;
      margin-top: 0;
      margin-bottom: 40px
    }
    .contact-video form input[type=text],.contact-video form input[type=email]{
      font-style: normal;
      font-weight: normal;
      font-size: 14px;
      line-height: 17px;
      text-align: center;
      color: #FFFFFF;
      width: 100%;
      height: 35px;
      border:none;
      border-bottom: 1px solid #FFFFFF;
      margin-bottom: 10px;
      background: none
    }
    .contact-video form h3{
      font-style: normal;
      font-weight: normal;
      font-size: 8px;
      line-height: 10px;
      color: #FFFFFF;
      margin-top: 0;
      margin-bottom: 10px;
      text-align: right;
    }
    .contact-video form h3 input{vertical-align: sub;}
    .contact-video form h3 a, .contact-video form h3 a:hover, .contact-video form h3 a:focus{
      color: #FFFFFF; text-decoration: none
    }
    .contact-video form .g-recaptcha{
      transform: scale(0.77); transform-origin: 0 0
    }
    .contact-video .row-dos{margin-top: 20px}
    .contact-video .contiene-boton-enviar{text-align: right;}
    .contact-video *::-webkit-input-placeholder {
        /* Google Chrome y Safari */
        color: #fff !important;
    	opacity:1;
    }
    .contact-video *:-moz-placeholder {
        /* Firefox anterior a 19 */
        color: #fff !important;
    	opacity:1;
    }
    .contact-video *::-moz-placeholder {
        /* Firefox 19 y superior */
        color: #fff !important;
    	opacity:1;
    }
    .contact-video *:-ms-input-placeholder {
        /* Internet Explorer 10 y superior */
        color: #fff !important;
    	opacity:1;
    }
    .shape-left{
      position:absolute; left: 0; top: 0;
    }
    .shape-right{
      position:absolute; right: 0; bottom: 0;
    }
    .logo-urbaz{position:absolute; right: 0; bottom: 0; z-index: 1}
    .logo-premier{position:absolute; left: 50px; bottom: 20px; width: 143px}
    .contact-video .privacidad{
      font-style: normal;
      font-weight: normal;
      font-size: 12px;
      line-height: 14px;
      color: #FFFFFF;
      position: absolute;
      left: 0;
      right: 0;
      bottom: 20px;
      text-align: center;
      margin: auto;
    }
    .contact-video .privacidad a, .contact-video .privacidad a:hover, .contact-video .privacidad a:focus{
      color: #FFFFFF; text-decoration: none
    }
    @media(max-width:767px){
      .contact-video{height: auto; position: relative; min-height: 100vh}
      .contact-video form{position: relative; padding-top: 50px; transform: none; left: inherit; top: inherit; width: 100%; padding-left: 15px; padding-right: 15px; max-width: 100%}
      .contact-video form h1{font-size: 16px; line-height: normal; margin-bottom: 30px}
      .contact-video .c-captcha{text-align: center;}
      .contact-video .c-captcha .g-recaptcha{transform: none}
      .contact-video form h3{margin-top: 15px; text-align: center; margin-bottom: 10px}
      .contact-video .contiene-boton-enviar{text-align: center;}
      .logo-urbaz{width: 100px}
      .logo-premier {
          position: relative;
          left: inherit;
          bottom: inherit;
          margin-top: 30px;
          margin-bottom: 30px;
          margin-left: 30px
      }
      .contact-video .privacidad{position: relative; left: inherit; right: inherit; bottom: inherit; text-align: left; padding-left: 30px; width: 200px; padding-bottom: 30px; margin: inherit;}
    }
    @media (min-width:768px) and (max-width:991px)
    {
      .shape-left{
        width: 120px
      }
      .shape-right{
        width: 120px
      }
    }
    @media (min-width:992px) and (max-width:1199px)
    {
      .shape-left{
        width: 170px
      }
      .shape-right{
        width: 170px
      }
    }
  </style>
  <style media="screen">
    .g-recaptcha{display:inline-block;}
  </style>
  <div class="contact-video">
    <form id="formContact" method="post" action="<?=PATH?>sendV.php">
      <div class="c-logo text-center">
        <img src="<?=PATH?>img/logo-torre-triada.svg" alt="Torre Triada" class="logo">
      </div>
      <h1>
        Descubre aquí las ventajas de invertir<br />
        en nuestras <b>SUITES HOTELERAS.</b>
      </h1>
      <input type="text" name="nombre" value="" placeholder="Nombre" id="c-nombre">
      <input type="text" name="telefono" value="" placeholder="Teléfono" id="c-telefono">
      <input type="text" name="correo" value="" placeholder="Correo" id="c-email">
      <input type="hidden" value="Nueva descarga del video" name="asunto">
      <div class="row row-con-margen row-dos">
        <div class="col-xl-7 col-lg-7 col-md-7">
          <div class="c-captcha">
            <div class="g-recaptcha" data-theme="dark" data-sitekey="6Lebh_kaAAAAAOz5ibHronXWwZzeSW8PFlXcDzlk"></div>
          </div>
        </div>
        <div class="col-xl-5 col-lg-5 col-md-5">
          <h3 class="terminos-condiciones">
            <input type="checkbox" id="acepto" name="acepto" />
            Acepto los <a href="<?=PATH?>politica-de-privacidad">Términos de Privacidad.</a>
          </h3>
          <h5 class="mensaje-de-error text-center" style="display:none">Asegúrate de llenar todos los campos.</h5>
          <div class="contiene-boton-enviar">
            <img src="<?=PATH?>img/video/boton-descargar-video.png" width="143" alt="Torre Triada" onclick="enviarMensajeV();" class="pointer"/>
          </div>
        </div>
      </div>
    </form>
    <img src="<?=PATH?>img/video/shape-left.svg" alt="Torre Triada" class="shape-left d-none d-md-block">
    <img src="<?=PATH?>img/video/shape-right.svg" alt="Torre Triada" class="shape-right d-none d-md-block">
    <img src="<?=PATH?>img/video/shape-left-2.svg" alt="Torre Triada" class="shape-left d-block d-md-none">
    <img src="<?=PATH?>img/video/shape-right-2.svg" alt="Torre Triada" class="shape-right d-block d-md-none">
    <img src="<?=PATH?>img/video/logo-urbaz.svg" alt="Torre Triada" class="logo-urbaz">
    <img src="<?=PATH?>img/video/logo-premier.png" alt="Torre Triada" class="logo-premier">
    <div class="privacidad">
      © Torre Triada. Todos los derechos reservados  /  <a href="<?=PATH?>politica-de-privacidad" target="_blank">Aviso de privacidad</a>
    </div>
  </div>
  <div class="modal fade" id="modalSuccess" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">

          <h4 class="modal-title" id=""></h4>
        </div>
        <div class="modal-body text-center">
          ¡Gracias por dejar tus datos!<br /><br />
          <a href="<?=PATH?>img/video/TT_SuitesHoteleras.mp4" download="TT_SuitesHoteleras"><img src="<?=PATH?>img/video/boton-descargar-video.png" width="143" alt="Torre Triada" class="pointer"/></a>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        </div>
      </div>
    </div>
  </div>
  <?php include("include/footer.php"); ?>
  <?php include 'include/scripts.php';?>
  <script type="text/javascript">
  function enviarMensajeV(){

    //$("#btn-sends").attr("disabled", true);

    $("#c-nombre,#c-telefono,#c-email").removeClass("error-borde");
    $(".mensaje-de-error").hide();

    var filter=/^[A-Za-z0-9_.]*@[A-Za-z0-9_]+.[A-Za-z0-9_.]+[A-za-z]$/;
    var email = $('#c-email').val();
    var nombre = $('#c-nombre').val();
    var telefono = $('#c-telefono').val();
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
  <?php if($_REQUEST["success"]){ ?>
		$("#modalSuccess").modal("show");
	<?php } ?>
  </script>
  </body>
</html>
