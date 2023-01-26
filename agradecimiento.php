  <?php
  //header("Content-disposition: attachment; filename=TorreTriada_Folleto.pdf");
  //header("Content-type: application/pdf");
  //readfile("TorreTriada_Folleto.pdf");
  include("include/header.php");
  ?>
  <style media="screen">
    .regresar{
      font-family: 'HK Grotesk';
      font-style: normal;
      font-weight: bold;
      font-size: 17px;
      line-height: 22px;
      text-transform: uppercase;
      color: #202945;
      margin-left: 18px;
      margin-right: 18px;
      border:none;
      border-bottom: 3px solid #FF595A;
      background: none;
    }
  </style>
  <div class="inicio-6 noticias container privacidad">
    <div class="row row-con-margen">
      <div class="col-xl-12 col-lg-12 col-md-12 text-center">
        <br class="d-block d-lg-none" /><br class="d-block d-lg-none"/>
        <div class="titulo">¡Gracias por contactarnos!</div>
        <p class="text-center">
          En breve un asesor se pondrá en contacto contigo.
        </p>
        <a href="<?=PATH?>TorreTriada_Folleto.pdf" download="TorreTriada_Folleto"><img src="<?=PATH?>img/boton-descargar-brochure.svg" alt="Torre Triada" class="pointer"></a><br /><br /><br />
        <a href="<?=PATH?>"><button type="button" class="regresar">Regresar al inicio</button></a>
      </div>
    </div>
  </div>

  <?php include("include/footer.php"); ?>
  <?php include 'include/scripts.php';?>
  <script type="text/javascript">
    $("header,.menu-mobile").addClass("dos");
  </script>
  </body>
</html>
