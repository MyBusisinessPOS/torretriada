  <?php
  include("include/header.php");
  ?>
  <div class="inicio-1">
    <img src="<?=PATH?>img/shape-1.svg" alt="Torre Triada" class="shape-1">
    <img src="<?=PATH?>img/shape-2.svg" alt="Torre Triada" class="shape-2">
    <div class="info centrado">
      <img src="<?=PATH?>img/logo-torre-triada.svg" alt="Torre Triada" class="logo">
      <p>
        Conoce el proyecto de usos mixtos que transformará el norte<br class="hidden-xs" /> de Mérida ofreciendo el más rentable modelo de inversión.
      </p>
      <img src="<?=PATH?>img/boton-descargar-brochure.svg" alt="Torre Triada" class="boton pointer abre-modal">
    </div>
  </div>
  <div class="modal fade modal-estilo" id="modalContacto" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="contenido">
          <img src="<?=PATH?>img/close-modal.svg" alt="Cerrar" class="cerrar-modal" data-dismiss="modal" aria-hidden="true">
          <h1>Formulario para <br />descargar brochure</h1>
          <form id="formContact3" method="post" action="<?=PATH?>send.php">
            <div class="row row-con-margen">
              <div class="col-xs-12">
                <input type="text" name="nombre" value="" placeholder="Nombre" id="c-nombre3">
              </div>
              <div class="col-xs-12">
                <input type="email" name="correo" value="" placeholder="Correo" id="c-email3">
              </div>
              <div class="col-xs-12">
                <input type="text" name="telefono" value="" placeholder="Teléfono" id="c-telefono3">
              </div>
              <div class="clearfix">

              </div>
              <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 c-captcha">
                  <div class="g-recaptcha" data-sitekey="6Lebh_kaAAAAAOz5ibHronXWwZzeSW8PFlXcDzlk"></div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                  <h3>
                    <input type="checkbox" id="aceptoC3" name="acepto" />
                    <label for="aceptoC3"><span></span></label>
                    Acepto los <a href="<?=PATH?>politica-de-privacidad" class="pointer" target="_blank">Términos de Privacidad.</a>
                  </h3>
                  <div class="contiene-boton">
                    <img src="<?=PATH?>img/boton-enviar.svg" alt="Torre Triada" class="enviar" onclick="enviarMensaje3();">
                  </div>
                </div>
                <div class="col-xs-12">
                  <h5 class="mensaje-de-error mensaje-de-error-3" style="display:none">Asegúrate de llenar todos los campos.</h5>
                  <div id="ocultosuccess3" style="display:none; color:#000; text-align:center; font-size:16px; top:inherit; margin-top:20px; margin-bottom:20px"></div>
                </div>
              </div>
            </div>
          </form>
        </div>

      </div>
    </div>
  </div>
  <div class="modal fade" id="modalSuccess" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">

          <h4 class="modal-title" id=""></h4>
        </div>
        <div class="modal-body">
          ¡Gracias por contactarnos, en breve comenzará la descarga!
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        </div>
      </div>
    </div>
  </div>
  <?php include("include/footer.php"); ?>
  <?php include 'include/scripts.php';?>
  <script>

    function enviarMensaje3(){

      //$("#btn-sends").attr("disabled", true);

      $("#c-nombre3,#c-telefono3,#c-email3,#c-mensaje3").removeClass("error-borde");
      $(".mensaje-de-error-3").hide();

      var filter=/^[A-Za-z0-9_.]*@[A-Za-z0-9_]+.[A-Za-z0-9_.]+[A-za-z]$/;
      var email = $('#c-email3').val();
      var nombre = $('#c-nombre3').val();
      var telefono = $('#c-telefono3').val();
      var mensaje = $('#c-mensaje3').val();
      var captcha =$('#formContact3 textarea[name="g-recaptcha-response"]').val();

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

    $(".abre-modal").click(function(){
      $("#modalContacto").modal("show");
    });
    //$("#modalAgenda").modal("show");

    <?php if($_REQUEST["success"]){ ?>
      $("#modalSuccess").modal("show");
    <?php } ?>

    </script>
  </body>
</html>
