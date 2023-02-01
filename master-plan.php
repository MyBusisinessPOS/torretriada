  <?php
  include("include/header.php");
  ?>
  <style media="screen">
    .masters{padding-right: 0; position: relative;}
    .masters .avlibano{position: absolute; height: 100%; width: auto; top: 0}
  </style>
  <div class="portada">
    <div class="titulo">
      COTIZADOR
    </div>
    <div class="container">
      <div class="row row-con-margen">
        <div class="col-xl-6 col-lg-6 col-md-6 col-6">
          <p>Torre Triada <span>></span> Cotizador</p>
        </div>
        <div class="col-xl-6 col-lg-6 col-md-6 col-6">
          <p class="dos"><a href="<?=PATH?>">< Regresar</a></p>
        </div>
      </div>
    </div>
  </div>
  <div class="seccion-master-plan">
    <div class="container">
      <div class="row row-con-margen">
        <div class="col-xl-4 col-lg-4 col-md-12">
          <h1>
            <span class="cotizador-tipo">TORRE TRIADA</span><br />
            <span class="cotizador-nivel">URBAN MIX</span>
          </h1>
          <div class="indicaciones">
            <img src="./img/Click.png" style="width:422px; height: 120px;" alt="">
          </div>
        </div>
        <div class="col-xl-8 col-lg-8 col-md-12">
          <ul>
            <li><img src="<?=PATH?>img/disponible.svg" alt="Torre Triada" /> Disponible</li>
            <li><img src="<?=PATH?>img/apartado.svg" alt="Torre Triada" /> Apartado</li>
            <li><img src="<?=PATH?>img/vendido.svg" alt="Torre Triada" /> Vendido</li>
          </ul>
        </div>
      </div>
      <div class="row row-con-margen">
        <div class="col-xl-4 col-lg-4 col-md-12">
          <div class="c-master-plan-torre">
            <?php include("svg/TORRE.php"); ?>
          </div>
        </div>
        <div class="col-xl-8 col-lg-8 col-md-12">
          <div class="c-master-plan-nivel-1 masters" style="display:none">
            <?php include("svg/PLANTA-BAJA.php"); ?>
            <img src="<?=PATH?>img/AvLibano.svg" alt="Torre Triada" class="avlibano">
          </div>
          <div class="c-master-plan-nivel-6 masters" style="display:none">
            <?php include("svg/NIVEL-6.php"); ?>
            <img src="<?=PATH?>img/AvLibano.svg" alt="Torre Triada" class="avlibano">
          </div>
          <div class="c-master-plan-nivel-9 masters" style="display:none">
            <?php include("svg/NIVEL-8-9.php"); ?>
            <img src="<?=PATH?>img/AvLibano.svg" alt="Torre Triada" class="avlibano">
          </div>
          <div class="c-master-plan-nivel-10 masters" style="display:none">
            <?php include("svg/NIVEL-10.php"); ?>
            <img src="<?=PATH?>img/AvLibano.svg" alt="Torre Triada" class="avlibano">
          </div>
          <div class="c-master-plan-nivel-11 masters" style="display:block">
            <?php include("svg/NIVEL-11.php"); ?>
            <img src="<?=PATH?>img/AvLibano.svg" alt="Torre Triada" class="avlibano">
          </div>
          <div class="c-master-plan-nivel-12 masters" style="display:none">
            <?php include("svg/NIVEL12_.php"); ?>
            <img src="<?=PATH?>img/AvLibano.svg" alt="Torre Triada" class="avlibano">
          </div>
          <div class="c-master-plan-nivel-14 masters" style="display:none">
            <?php include("svg/NIVEL-14_.php"); ?>
            <img src="<?=PATH?>img/AvLibano.svg" alt="Torre Triada" class="avlibano">
          </div>

        </div>
      </div>
    </div>
  </div>
  <div class="modal fade" tabindex="-1" role="dialog" id="modalCotizador">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <form id="formContact" method="post" action="<?=PATH?>sendLote.php">
        <div class="contenido">
          <div class="parte-1">
            <div class="row">
              <div class="col-xl-6 col-lg-6 col-md-6 bg">
                 <a data-dismiss="modal" class="cerrar-modal"><span><</span> Regresar</a>
                 <h2>Cotización</h2>
                 <div class="local" id="noLote">
                   LOCAL 55
                 </div>

                 <div class="texto-precio">
                    Interior  <b id="interior"></b>
                 </div>
                 <div class="texto-precio">
                    Terrazas  <b id="terrazas"></b>
                 </div>
                 <div class="texto-precio">
                    Cajones <b id="cajones"></b>
                 </div>

                 <div class="area-total">
                   Área total <b id="m2">500 m<sup>2</sup></b>
                 </div>
                 <div class="texto-precio">
                   <span>Precio (I.V.A. incluido)</span><br /> <b id="precio"></b>
                 </div>
                 <!--<div class="contiene-select">
                   <select class="apn" name="" id="plazo">
                     <option value="1">Plazo</option>
                     <option value="1">Contado</option>
                     <option value="12">12 meses</option>
                     <option value="18">18 meses</option>
                     <option value="24">24 meses</option>
                     <option value="36">36 meses</option>
                   </select>
                 </div>
                 <input type="text" name="descuento" value="" placeholder="Descuento" id="descuento" class="apn" readonly>-->
                 <div class="texto-precio">
                   <span>Enganche</span><br /> <b id="enganche"></b>
                 </div>
                 <div class="texto-precio">
                   <span><i id="plazo-mensualidades" style="font-style:normal">18</i> mensualidades de</span><br /> <b id="pago-mensual"></b>
                 </div>
                 <div class="texto-precio saldo_entrega">
                   <span>Saldo a la entrega</span><br /> <b id="saldo_entrega"></b>
                 </div>
                 <input type="hidden" value="" id="precioBase" name="precioTotal">
                 <input type="hidden" value="" id="precioPost" name="precioPost">
                 <div class="nota">
                   *Los precios están sujetos a cambios sin previo aviso.
                 </div>
              </div>
              <div class="col-xl-6 col-lg-6 col-md-6 bg2">
                <!--<div class="contiene-img">
                  <img src="<?=PATH?>img/chepina.png" />
                </div>-->
                <div class="parrafo">
                  Para mayor información llene el siguiente formulario y uno de nuestros asesores se pondrá en contacto a la brevedad posible. ¡Gracias!
                </div>
                <div class="row row-con-margen">
                  <div class="col-12">
                    <input type="text" placeholder="Nombre" id="c-nombre" name="nombre"/>
                  </div>
                  <div class="col-12">
                    <input type="email" placeholder="Correo" id="c-email" name="correo"/>
                  </div>
                  <div class="col-12">
                    <input type="text" placeholder="Teléfono" id="c-telefono" name="telefono"/>
                  </div>
                  <div class="col-12">
                    <textarea placeholder="Mensaje" id="c-mensaje" name="mensaje"></textarea>
                  </div>
                  <div class="col-12">
                    <input type="hidden" id="c-lote" name="lote" />
                    <h4 class="terminos-condiciones">
                      <input type="checkbox" id="aceptoC" name="acepto" />
                      Acepto los <a href="<?=PATH?>politica-de-privacidad">Términos de Privacidad.</a>
                    </h4>
                  </div>
                  <div class="col-12">
                    <div class="text-center">
                      <div class="g-recaptcha" data-sitekey="6Lebh_kaAAAAAOz5ibHronXWwZzeSW8PFlXcDzlk"></div><br />
                    </div>
                  </div>
                  <div class="col-12">
                    <div class="contiene-boton text-center">
                      <img src="<?=PATH?>img/boton-enviar.svg" alt="Torre Triada" onclick="enviarCotizador();" class="pointer">
                    </div>
                  </div>
                  <div class="col-12">
                    <div id="ocultosuccess" style="width: 100%; font-size: 16px; position: relative; margin-top: 20px; text-align:center; color: #000;"></div>
                  </div>
                </div>
              </div>
            </div>
          </div>

        </div>
        </form>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->

  <?php include("include/footer.php"); ?>
  <?php include 'include/scripts.php';?>
  <script type="text/javascript">
    $("header,.menu-mobile").addClass("dos");
    //$("#a-4").addClass("active");
    //$("#modalCotizador").modal("show");
  </script>
  <script src="<?=PATH?>js/funciones-cotizador.js?v=1.157"></script>
  <script>
  function enviarCotizador(){


    //$("#btn-sends").attr("disabled", true);

    $("#c-nombre,#c-telefono,#c-email,#c-asunto,#c-mensaje").removeClass("error-borde");

    var filter=/^[A-Za-z0-9_.]*@[A-Za-z0-9_]+.[A-Za-z0-9_.]+[A-za-z]$/;
    var email = $('#c-email').val();
    var nombre = $('#c-nombre').val();
    var telefono = $('#c-telefono').val();
    var mensaje = $('#c-mensaje').val();
    var captcha =$('#formContact textarea[name="g-recaptcha-response"]').val();

    if (filter.test(email)){
    sendMail = "true";
    } else{
    $('#c-email').addClass("error-borde");
     //aplicamos color de borde si el se encontro algun error en el envio
    sendMail = "false";
    }
    if (nombre.length == 0 ){
    $('#c-nombre').addClass("error-borde");
    var sendMail = "false";
    }
    if (telefono.length == 0 ){
    $('#c-telefono').addClass("error-borde");
    var sendMail = "false";
    }
    if (mensaje.length == 0 ){
    $('#c-mensaje').addClass("error-borde");
    var sendMail = "false";
    }
    if (!$("#aceptoC").prop("checked")){
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

         "nombre" : $('#c-nombre').val(),

          "telefono" : $('#c-telefono').val(),

           "correo" : $('#c-email').val(),

           "mensaje" : $('#c-mensaje').val(),

           "lote" : $('#c-lote').val(),

           "g-recaptcha-response" : captcha,

           "plazo" : $('#plazo').val(),

           "descuento" : $('#descuento').val(),

           "enganche" : $('#enganche').val(),

           "mensualidad" : $('#pago-mensual').val(),

           "precioTotal" : $('#precio').text()

     };

     $.ajax({

         data:  datos,
         // hacemos referencia al archivo contacto.php
         url:   ''+PATH+'sendLote.php',

         type:  'POST',

         beforeSend: function () {
         },

         success:  function (response) {
            $("#ocultosuccess").html(response);
            $("#ocultosuccess").fadeIn();
            $("#formContact")[0].reset();


         }

     });*/

    } else{
    //$("#btn-sends").removeAttr("disabled");
    }

  }

  $("#plazo").change(function(){
    console.log("has cambiado");
    obtenerPrecio();
  });

  function obtenerPrecio(){
          var precioBase=$("#precioBase").val();
          var plazo=$("#plazo").val();
          var data = new FormData();
          data.append("operaciones", "obtenerPrecio");
          data.append("precioBase", precioBase);
          data.append("plazo", plazo);
          $.ajax({
              async : false,
              type : "POST",
              dataType : "html",
              contentType : false,
              processData: false,
              url: ""+PATH+"controller/controllerLotes.php",
              data: data,
              success: function(data) {
                  //console.log(data);
                  if((data != "0")){
                      data = JSON.parse(data);
                      //console.log(data);
                      var descuento = data[0].descuento;
                      var precioTotal = data[0].precioTotal;
  					          var enganche = data[0].enganche;
                      var mensualidad = data[0].mensualidad;
                      $("#descuento").val("Descuento $"+data[0].descuento+"");
                      $("#enganche").val("Enganche $"+data[0].enganche+"");
                      $("#pago-mensual").val("Pago mensual $"+data[0].mensualidad+"");
                      $("#precio").text("$"+data[0].precioTotal+"");

                      console.log(data[0].descuento);
                      console.log(data[0].precioTotal);
                      console.log(data[0].enganche);
                      console.log(data[0].mensualidad);
                  }
                  else{
                      console.log("No se pudo obtener el precio, intentalo de nuevo.");
                  }
              }
          });
      }

      $("#TORRE_TRIADA polygon").click(function(){
        var id=$(this).attr("data-id");
        $(".masters").hide();
        $("#TORRE_TRIADA polygon").css("fill","transparent");
        $(".c-master-plan-nivel-"+id+"").show();
        $("#TORRE_TRIADA #nivel_"+id+"").css("fill","rgba(59, 64, 130, 0.55)");
      });


  </script>
  </body>
</html>
