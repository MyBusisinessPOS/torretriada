  <?php
  include("include/header.php");
  $blog=new blog();
  $listaBlog=$blog->listRecentBlog('es');
  ?>
  <style media="screen">
    .g-recaptcha{display:inline-block;}
    .icon-play-video{
      font-size: 75px; color: #fff; cursor: pointer; z-index: 10
    }
    .ver-video-suite{
      position: relative;
      left: -10px;
      margin-top: 20px;
    }
    @media(max-width:767px){
      .ver-video-suite{
        left: inherit;
      }
    }

    .contacto iframe{
      width: 100%; height: 500px
    }
    @media(min-width:992px) and (max-width:1199px){
      .contacto iframe{
        width: 100%; height: 510px
      }
    }
    @media(min-width:768px) and (max-width:991px){
      .contacto iframe{
        width: 100%; height: 550px
      }
    }
    @media(max-width:767px){
      .contacto iframe{
        width: 100%; height: 520px
      }
    }
  </style>
  <div class="inicio-home" id="inicio">
    <!--<img src="<?=PATH?>img/05_BannerWeb.jpg" alt="Torre Triada" class="w100Hauto d-none d-lg-block">
    <img src="<?=PATH?>img/05_BannerWeb-Movil.jpg" alt="Torre Triada" class="w100Hauto d-block d-lg-none">-->
    <div class="master-slider ms-skin-default d-none d-lg-block" id="mastersliderImg">
        <div class="ms-slide">
            <img src="<?=PATH?>js/masterslider/style/blank.gif" data-src="<?=PATH?>img/05_BannerWeb.jpg" alt="Torre Triada"/>
        </div>
        <div class="ms-slide" onclick="Javascript:location.href='<?=PATH?>'">
            <img src="<?=PATH?>js/masterslider/style/blank.gif" data-src="<?=PATH?>img/junio/BANNER-WEB-COTIZADOR.jpg" alt="Torre Triada"/>
        </div>
    </div>
    <div class="master-slider ms-skin-default d-block d-lg-none" id="mastersliderImgM">
        <div class="ms-slide">
            <img src="<?=PATH?>js/masterslider/style/blank.gif" data-src="<?=PATH?>img/05_BannerWeb-Movil.jpg" alt="Torre Triada"/>
        </div>
        <div class="ms-slide" onclick="Javascript:location.href='<?=PATH?>'">
            <img src="<?=PATH?>js/masterslider/style/blank.gif" data-src="<?=PATH?>img/junio/BANNER-MOVIL-COTIZADOR.jpg" alt="Torre Triada"/>
        </div>
    </div>
    <!--<div class="master-slider ms-skin-default" id="mastersliderHome">
        <div class="ms-slide">
            <img src="<?=PATH?>js/masterslider/style/blank.gif" data-src="<?=PATH?>img/fondo-transparente.png" alt="Torre Triada"/>
            <div class="info">
              EL NUEVO ROSTRO<br />DE UNA GRAN CIUDAD
            </div>
        </div>
        <div class="ms-slide">
            <img src="<?=PATH?>js/masterslider/style/blank.gif" data-src="<?=PATH?>img/fondo-transparente.png" alt="Torre Triada"/>
            <div class="info">
              Vive, trabaja, disfruta
            </div>
        </div>
        <div class="ms-slide">
            <img src="<?=PATH?>js/masterslider/style/blank.gif" data-src="<?=PATH?>img/fondo-transparente.png" alt="Torre Triada"/>
            <div class="info">
              Cada día, una experiencia integral
            </div>
        </div>
    </div>-->
    <div class="acciones">
      <a href="https://wa.me/529999682008" class="float" target="_blank">
      	<i class="fab fa-whatsapp my-float"></i>
      </a>
    </div>
    <div class="contiene-brochure">
      <img src="<?=PATH?>img/boton-descargar-brochure.svg" alt="Torre Triada" class="pointer abre-modal">
    </div>
    <img src="<?=PATH?>img/shape-slider.svg" alt="Torre Triada" class="shape-slider">
    <!--<div class="master-slider ms-skin-default" id="mastersliderHomeVideo">
        <div class="ms-slide">
            <img src="<?=PATH?>js/masterslider/style/blank.gif" data-src="<?=PATH?>img/slider-1.jpg" alt="Torre Triada"/>
            <video data-autopause="false" data-mute="true" data-loop="true" data-fill-mode="fill" data-hide-on-mobile="false" playsinline>
               <source id="mp4" src="<?=PATH?>img/TT_Slide_VIdeo.mp4" type="video/mp4">
           </video>
        </div>
    </div>-->
  </div>
  <div class="inicio-2 relative">
    <a id="torre-triada" class="a-seccion"></a>
    <div class="container relativeZ1">
      <div class="row row-con-margen align-items-center">
        <div class="col-xl-7 col-lg-7 col-md-12">
          <div class="relative">
            <i class="far fa-play-circle centrado icon-play-video" data-fancybox="gallery" data-src="<?=PATH?>TRIADA_MASTERPLAN_PROMOCIONAL.mp4"></i>
            <img src="<?=PATH?>img/torre-triada-principal.svg" alt="Torre Triada" class="w100Hauto img" data-aos="fade-right" data-aos-duration="2000">
          </div>
        </div>
        <div class="col-xl-4 col-lg-5 col-md-12 offset-lg-0 offset-xl-1">
          <div class="info" data-aos="fade-up" data-aos-duration="2000">
            <img src="<?=PATH?>img/logo-blanco.svg" alt="Torre Triada" class="logo">
            <p>
              <b>Torre Triada</b> es un proyecto vertical de usos mixtos inédito en Mérida que surge para transformar el paisaje urbano de una de las zonas más emblemáticas de la ciudad y ofrecer, en un solo espacio, una innovadora propuesta de vida integral, en total sintonía con las nuevas tendencias y necesidades de la gente de hoy.
            </p>
          </div>
        </div>
      </div>
      <!--<div class="row row-con-margen recorrido">
        <div class="col-xl-10 col-lg-10 col-md-12 offset-xl-1 offset-lg-1">
          <div class="row row-con-margen titulos" data-aos="fade-up" data-aos-duration="2000">
            <div class="col-xl-5 col-lg-5 col-md-12">
              <div class="titulo">
                CONOCE TORRE TRIADA
              </div>
            </div>
            <div class="col-xl-2 col-lg-2 col-md-12">
              <div class="text-center d-none d-lg-block">
                <img src="<?=PATH?>img/arrow-recorrido.svg" alt="Torre Triada" class="arrow">
              </div>
            </div>
            <div class="col-xl-5 col-lg-5 col-md-12">
              <div class="subtitulo">
                Recorrido 360º
              </div>
              <div class="text-center d-block d-lg-none">
                <img src="<?=PATH?>img/arrow-recorrido.svg" alt="Torre Triada" class="arrow">
              </div>
            </div>
          </div>
          <iframe data-aos="fade-up" data-aos-duration="2000" width='100%' height='100%' src='https://roundme.com/embed/4NgD4Jc3j7QC1P8C16HC' frameborder='0' webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
        </div>
      </div>-->
    </div>
    <!--<div class="sobrepuesto">
    </div>-->
  </div>
  <div class="inicio-3 relative">
    <a id="ubicacion" class="a-seccion"></a>
    <div class="container">
      <div class="row row-con-margen">
        <div class="col-xl-6 col-lg-6 col-md-12">
          <div class="info">
            <div class="h2" data-aos="fade-up" data-aos-duration="2000">
              Ubicación
            </div>
            <div class="h1" data-aos="fade-up" data-aos-duration="2000">
              Ubicación privilegiada en Mérida
            </div>
            <p data-aos="fade-up" data-aos-duration="2000">
              <b>Torre Triada</b> se ubica sobre la Av. Líbano, la arteria principal de la tradicional colonia México y una plácida área residencial en el corazón de la capital yucateca. Todo lo que necesitas está aquí: Restaurantes, centros comerciales, educativos, servicios de primer nivel, así como una privilegiada conexión hacia las principales zonas del norte como el vibrante Montebello y la prolongación del famoso Paseo de Montejo.
            </p>
            <img src="<?=PATH?>img/Ubicacion.gif" alt="Torre Triada" class="img" data-aos="fade-up" data-aos-duration="2000">
          </div>
        </div>
        <div class="col-xl-6 col-lg-6 col-md-12 relative">
          <div class="text-center">
            <img src="<?=PATH?>img/mapa2022.svg" alt="Torre Triada" class="mapa w100Hauto" data-aos="zoom-in" data-aos-duration="1500">
          </div>
          <a href="https://goo.gl/maps/TGouhnWUTwwXN9UT6" target="_blank"><button type="button" class="ver-maps" data-aos="fade-left" data-aos-duration="2000">Ver en google maps ></button></a>
        </div>
      </div>
    </div>
  </div>
  <div class="espacios">
    <a id="espacios" class="a-seccion"></a>
    <div class="container-fluid">
      <div class="row row-con-margen align-items-center">
        <div class="col-xl-6 col-lg-6 col-md-12 sinpaddingleft sinpaddingright">
          <img src="<?=PATH?>img/Edificio.jpg" alt="Torre Triada" class="w100Hauto img" data-aos="fade-right" data-aos-duration="2000">
        </div>
        <div class="col-xl-5 col-lg-6 col-md-12 offset-xl-1 offset-lg-0">
          <div class="info" data-aos="fade-up" data-aos-duration="2000">
            <img src="<?=PATH?>img/isotipo-espacios.svg" alt="Torre Triada" class="isotipo">
            <div class="subtitulo">
              ESPACIOS
            </div>
            <div class="titulo">
              TORRE TRIADA.<br />
              UN DESARROLLO ALL IN ONE
            </div>
            <div class="p">
              A través de una vanguardista propuesta arquitectónica, Torre Triada brinda 4 distintas vocaciones que se fusionan entre sí para vivir cada día una experiencia integral.
              <br /><br />
              En Torre Triada encontrarás:
            </div>
            <ul>
              <li>
                <img src="<?=PATH?>img/shape-ul.svg" alt="Torre Triada">
                Locales comerciales
              </li>
              <li>
                <img src="<?=PATH?>img/shape-ul.svg" alt="Torre Triada">
                Oficinas
              </li>
              <li>
                <img src="<?=PATH?>img/shape-ul.svg" alt="Torre Triada">
                Departamentos
              </li>
              <li>
                <img src="<?=PATH?>img/shape-ul.svg" alt="Torre Triada">
                Suites hoteleras
              </li>
              <li>
                <img src="<?=PATH?>img/boton-amenidades.svg" alt="Torre Triada" class="ver-amenidades pointer" style="position:relative; left:-10px">
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="espacios-1">
    <a id="locales-comerciales" class="a-seccion"></a>
    <div class="container-fluid">
      <div class="row row-con-margen align-items-center">
        <div class="col-xl-6 col-lg-6 col-md-12 bg">
          <div class="info" data-aos="fade-up" data-aos-duration="2000">
            <div class="subtitulo">
              ESPACIOS
            </div>
            <div class="titulo">
              Locales comerciales
            </div>
            <p>
              La zona comercial de <b>Torre Triada</b> contará con 6 locales que albergarán atractivos giros y brindarán una cuidada selección de servicios orientados a satisfacer las necesidades de quien viva, trabaje o se hospede en las suites hoteleras del desarrollo.
            </p>
            <ul>
              <li>
                <img src="<?=PATH?>img/shape-ul.svg" alt="Torre Triada">
                Locales comerciales de entre 110 y 315 m2
              </li>
              <li>
                <img src="<?=PATH?>img/shape-ul.svg" alt="Torre Triada">
                Estacionamiento para clientes sobre avenida.
              </li>
              <li>
                <img src="<?=PATH?>img/shape-ul.svg" alt="Torre Triada">
                Cctv en áreas
              </li>
              <li>
                <img src="<?=PATH?>img/shape-ul.svg" alt="Torre Triada">
                Ideales para boutiques, concept stores, restaurantes, cafés, spas, decoración.
              </li>
            </ul>
          </div>
        </div>
        <div class="col-xl-6 col-lg-6 col-md-12 sinpaddingleft sinpaddingright">
          <div class="master-slider ms-skin-default" id="masterslider1" data-aos="fade-left" data-aos-duration="2000">
              <div class="ms-slide">
                  <img src="<?=PATH?>js/masterslider/style/blank.gif" data-src="<?=PATH?>img/galeria3/LC1.jpg" alt="Torre Triada"/>
                  <div class="infos">
                    <a href="#contacto"><img src="<?=PATH?>img/solicitar-informacion.svg" alt="Torre Triada" class="solicitar"></a>
                  </div>
              </div>
              <div class="ms-slide">
                  <img src="<?=PATH?>js/masterslider/style/blank.gif" data-src="<?=PATH?>img/galeria3/LC2.jpg" alt="Torre Triada"/>
                  <div class="infos">
                    <a href="#contacto"><img src="<?=PATH?>img/solicitar-informacion.svg" alt="Torre Triada" class="solicitar"></a>
                  </div>
              </div>
              <div class="ms-slide">
                  <img src="<?=PATH?>js/masterslider/style/blank.gif" data-src="<?=PATH?>img/galeria3/LC3.jpg" alt="Torre Triada"/>
                  <div class="infos">
                    <a href="#contacto"><img src="<?=PATH?>img/solicitar-informacion.svg" alt="Torre Triada" class="solicitar"></a>
                  </div>
              </div>
              <div class="ms-slide">
                  <img src="<?=PATH?>js/masterslider/style/blank.gif" data-src="<?=PATH?>img/galeria3/LC4.jpg" alt="Torre Triada"/>
                  <div class="infos">
                    <a href="#contacto"><img src="<?=PATH?>img/solicitar-informacion.svg" alt="Torre Triada" class="solicitar"></a>
                  </div>
              </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="espacios-2">
    <a id="oficinas" class="a-seccion"></a>
    <div class="container-fluid">
      <div class="row row-con-margen align-items-center flex-column-reverse flex-lg-row">
        <div class="col-xl-6 col-lg-6 col-md-12 sinpaddingleft sinpaddingright">
          <div class="master-slider ms-skin-default" id="masterslider2" data-aos="fade-right" data-aos-duration="2000">
              <div class="ms-slide">
                  <img src="<?=PATH?>js/masterslider/style/blank.gif" data-src="<?=PATH?>img/galeria3/O1.jpg" alt="Torre Triada"/>
                  <div class="infos">
                    <a href="#contacto"><img src="<?=PATH?>img/solicitar-informacion.svg" alt="Torre Triada" class="solicitar"></a>
                  </div>
              </div>
              <div class="ms-slide">
                  <img src="<?=PATH?>js/masterslider/style/blank.gif" data-src="<?=PATH?>img/galeria3/O2.jpg" alt="Torre Triada"/>
                  <div class="infos">
                    <a href="#contacto"><img src="<?=PATH?>img/solicitar-informacion.svg" alt="Torre Triada" class="solicitar"></a>
                  </div>
              </div>
              <div class="ms-slide">
                  <img src="<?=PATH?>js/masterslider/style/blank.gif" data-src="<?=PATH?>img/galeria3/O3.jpg" alt="Torre Triada"/>
                  <div class="infos">
                    <a href="#contacto"><img src="<?=PATH?>img/solicitar-informacion.svg" alt="Torre Triada" class="solicitar"></a>
                  </div>
              </div>
              <div class="ms-slide">
                  <img src="<?=PATH?>js/masterslider/style/blank.gif" data-src="<?=PATH?>img/galeria3/L01.jpg" alt="Torre Triada"/>
                  <div class="infos">
                    <a href="#contacto"><img src="<?=PATH?>img/solicitar-informacion.svg" alt="Torre Triada" class="solicitar"></a>
                  </div>
              </div>
              <div class="ms-slide">
                  <img src="<?=PATH?>js/masterslider/style/blank.gif" data-src="<?=PATH?>img/galeria3/L02.jpg" alt="Torre Triada"/>
                  <div class="infos">
                    <a href="#contacto"><img src="<?=PATH?>img/solicitar-informacion.svg" alt="Torre Triada" class="solicitar"></a>
                  </div>
              </div>
          </div>
        </div>
        <div class="col-xl-6 col-lg-6 col-md-12 bg">
          <div class="info" data-aos="fade-up" data-aos-duration="2000">
            <div class="subtitulo">
              ESPACIOS
            </div>
            <div class="titulo">
              OFICINAS
            </div>
            <p>
              Las nuevas medidas de confinamiento social, así como los modelos de trabajo remoto han redefinido toda una cultura laboral. Bajo una propuesta integral de diseño, en <b>Torre Triada</b> encontrarás espacios de trabajo innovadores, flexibles  y 100%  adaptados a los requerimientos de los profesionistas de hoy.
            </p>
            <ul>
              <li>
                <img src="<?=PATH?>img/shape-ul.svg" alt="Torre Triada">
                Oficinas desde 30 m2
              </li>
              <li>
                <img src="<?=PATH?>img/shape-ul.svg" alt="Torre Triada">
                Estacionamiento con acceso independiente
              </li>
              <li>
                <img src="<?=PATH?>img/shape-ul.svg" alt="Torre Triada">
                Acceso controlado al área de oficinas
              </li>
              <li>
                <img src="<?=PATH?>img/shape-ul.svg" alt="Torre Triada">
                Lobby con recepcionista
              </li>
              <li>
                <img src="<?=PATH?>img/shape-ul.svg" alt="Torre Triada">
                Salas de juntas
              </li>
              <li>
                <img src="<?=PATH?>img/shape-ul.svg" alt="Torre Triada">
                Coffee & snack station
              </li>
              <li>
                <img src="<?=PATH?>img/shape-ul.svg" alt="Torre Triada">
                Área de comedor para colaboradores
              </li>
              <li>
                <img src="<?=PATH?>img/shape-ul.svg" alt="Torre Triada">
                Terraza común con mobiliario y espectaculares vistas.
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="espacios-1">
    <a id="departamentos" class="a-seccion"></a>
    <div class="container-fluid">
      <div class="row row-con-margen align-items-center">
        <div class="col-xl-6 col-lg-6 col-md-12 bg">
          <div class="info deptos" data-aos="fade-up" data-aos-duration="2000">
            <div class="subtitulo">
              ESPACIOS
            </div>
            <div class="titulo">
              Departamentos
            </div>
            <p>
              Hoy, vivir en un departamento ofrece a  los jóvenes profesionales, adultos singles y parejas sin hijos, un estilo de vida “todo incluido”. En Torre Triada encuentra espacios departamentales únicos con un diseño inteligente, sofisticado y vanguardista; complementado con amenidades de primer nivel creadas justo para ti.
            </p>
            <ul>
              <li>
                <img src="<?=PATH?>img/shape-ul.svg" alt="Torre Triada">
                30 exclusivos departamentos.
              </li>
              <li>
                <img src="<?=PATH?>img/shape-ul.svg" alt="Torre Triada">
                En la mejor área residencial de Mérida.
              </li>
              <li>
                <img src="<?=PATH?>img/shape-ul.svg" alt="Torre Triada">
                Apacible zona de casas y familias.
              </li>
              <li>
                <img src="<?=PATH?>img/shape-ul.svg" alt="Torre Triada">
                2 recámaras.
              </li>
              <li>
                <img src="<?=PATH?>img/shape-ul.svg" alt="Torre Triada">
                Entre 90 y 110 m2
              </li>
              <li>
                <img src="<?=PATH?>img/shape-ul.svg" alt="Torre Triada">
                Acabados de lujo.
              </li>
              <li class="separador">
                Como residente de los departamentos tendrás a tu disposición:
              </li>
              <li>
                <img src="<?=PATH?>img/shape-ul.svg" alt="Torre Triada">
                Wellness Center
              </li>
              <li>
                <img src="<?=PATH?>img/shape-ul.svg" alt="Torre Triada">
                Alberca
              </li>
              <li>
                <img src="<?=PATH?>img/shape-ul.svg" alt="Torre Triada">
                Terraza Grill
              </li>
              <li>
                <img src="<?=PATH?>img/shape-ul.svg" alt="Torre Triada">
                Salón de usos múltiples
              </li>
            </ul>
            <img src="<?=PATH?>img/ver-recorrido.svg" alt="Torre Triada" class="ver-recorrido">
          </div>
        </div>
        <div class="col-xl-6 col-lg-6 col-md-12 sinpaddingleft sinpaddingright">
          <div class="master-slider ms-skin-default" id="masterslider3" data-aos="fade-left" data-aos-duration="2000">
              <div class="ms-slide">
                  <img src="<?=PATH?>js/masterslider/style/blank.gif" data-src="<?=PATH?>img/galeria3/D1_.jpg" alt="Torre Triada"/>
                  <div class="infos">
                    <a href="#contacto"><img src="<?=PATH?>img/solicitar-informacion.svg" alt="Torre Triada" class="solicitar"></a>
                  </div>
              </div>
              <div class="ms-slide">
                  <img src="<?=PATH?>js/masterslider/style/blank.gif" data-src="<?=PATH?>img/galeria3/D2_.jpg" alt="Torre Triada"/>
                  <div class="infos">
                    <a href="#contacto"><img src="<?=PATH?>img/solicitar-informacion.svg" alt="Torre Triada" class="solicitar"></a>
                  </div>
              </div>
              <div class="ms-slide">
                  <img src="<?=PATH?>js/masterslider/style/blank.gif" data-src="<?=PATH?>img/galeria3/D3_.jpg" alt="Torre Triada"/>
                  <div class="infos">
                    <a href="#contacto"><img src="<?=PATH?>img/solicitar-informacion.svg" alt="Torre Triada" class="solicitar"></a>
                  </div>
              </div>
              <div class="ms-slide">
                  <img src="<?=PATH?>js/masterslider/style/blank.gif" data-src="<?=PATH?>img/galeria3/D4_.jpg" alt="Torre Triada"/>
                  <div class="infos">
                    <a href="#contacto"><img src="<?=PATH?>img/solicitar-informacion.svg" alt="Torre Triada" class="solicitar"></a>
                  </div>
              </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="espacios-2">
    <a id="suites-hoteleras" class="a-seccion"></a>
    <div class="container-fluid">
      <div class="row row-con-margen align-items-center flex-column-reverse flex-lg-row">
        <div class="col-xl-6 col-lg-6 col-md-12 sinpaddingleft sinpaddingright">
          <div class="master-slider ms-skin-default" id="masterslider4" data-aos="fade-right" data-aos-duration="2000">
              <div class="ms-slide">
                  <img src="<?=PATH?>js/masterslider/style/blank.gif" data-src="<?=PATH?>img/galeria3/SH1.jpg" alt="Torre Triada"/>
                  <div class="infos">
                    <a href="#contacto"><img src="<?=PATH?>img/solicitar-informacion.svg" alt="Torre Triada" class="solicitar"></a>
                  </div>
              </div>
              <div class="ms-slide">
                  <img src="<?=PATH?>js/masterslider/style/blank.gif" data-src="<?=PATH?>img/galeria3/SH2.jpg" alt="Torre Triada"/>
                  <div class="infos">
                    <a href="#contacto"><img src="<?=PATH?>img/solicitar-informacion.svg" alt="Torre Triada" class="solicitar"></a>
                  </div>
              </div>
              <div class="ms-slide">
                  <img src="<?=PATH?>js/masterslider/style/blank.gif" data-src="<?=PATH?>img/galeria3/SH3.jpg" alt="Torre Triada"/>
                  <div class="infos">
                    <a href="#contacto"><img src="<?=PATH?>img/solicitar-informacion.svg" alt="Torre Triada" class="solicitar"></a>
                  </div>
              </div>
              <div class="ms-slide">
                  <img src="<?=PATH?>js/masterslider/style/blank.gif" data-src="<?=PATH?>img/galeria3/SH4.jpg" alt="Torre Triada"/>
                  <div class="infos">
                    <a href="#contacto"><img src="<?=PATH?>img/solicitar-informacion.svg" alt="Torre Triada" class="solicitar"></a>
                  </div>
              </div>
          </div>
        </div>
        <div class="col-xl-6 col-lg-6 col-md-12 bg">
          <div class="info" data-aos="fade-up" data-aos-duration="2000">
            <div class="subtitulo">
              ESPACIOS
            </div>
            <div class="titulo">
              suites hoteleras
            </div>
            <p>
              Para quien requiere una estancia corta en Mérida, busca una estratégica ubicación cerca de todo y con fácil acceso a las principales vías de la ciudad; Torre Triada ofrece su opción de suites hoteleras. Espacios de hospedaje totalmente equipados con todas las comodidades, servicios y operadas por un grupo con gran experiencia en el ramo hotelero.
            </p>
            <ul>
              <li>
                <img src="<?=PATH?>img/shape-ul.svg" alt="Torre Triada">
                30 suites de entre 45 y 50 m2.
              </li>
              <li>
                <img src="<?=PATH?>img/shape-ul.svg" alt="Torre Triada">
                Cocina integral
              </li>
              <li>
                <img src="<?=PATH?>img/shape-ul.svg" alt="Torre Triada">
                Baño
              </li>
              <li>
                <img src="<?=PATH?>img/shape-ul.svg" alt="Torre Triada">
                Clóset de madera
              </li>
              <li>
                <img src="<?=PATH?>img/shape-ul.svg" alt="Torre Triada">
                Acabados de lujo.
              </li>
              <li class="separador">Como huesped de las suites podrás acceder a:</li>
              <li>
                <img src="<?=PATH?>img/shape-ul.svg" alt="Torre Triada">
                Business center
              </li>
              <li>
                <img src="<?=PATH?>img/shape-ul.svg" alt="Torre Triada">
                Gimnasio y spa
              </li>
              <li>
                <img src="<?=PATH?>img/shape-ul.svg" alt="Torre Triada">
                Terraza Grill
              </li>
              <li>
                <img src="<?=PATH?>img/shape-ul.svg" alt="Torre Triada">
                Alberca
              </li>
            </ul>
            <img src="<?=PATH?>img/ver-video.svg" alt="Torre Triada" class="pointer ver-video-suite" data-fancybox="gallery2" data-src="<?=PATH?>VIDEO-SUITES-HOTELERAS.mp4">
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="noticias">
    <a id="noticias" class="a-seccion"></a>
    <div class="subtitulo" data-aos="fade-up" data-aos-duration="2000">
      NOTICIAS
    </div>
    <div class="titulo" data-aos="fade-up" data-aos-duration="2000">
      ÚLTIMAS NOTICIAS
    </div>
    <div class="container relativeZ1">
      <div class="row row-con-margen">
        <div class="col-xl-10 col-lg-10 col-md-12 offset-lg-1 offset-xl-1 relativeZ1">
          <div class="contiene-slick">
            <div class="center">
              <?php
              foreach($listaBlog as $elementoBlog){
                $dia=substr($elementoBlog['fecha'],8,2);
                $mes1=substr($elementoBlog['fecha'],5,2);
                $ano=substr($elementoBlog['fecha'],0,4);
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

                $fechaf=$dia.' / '.$mes. ' / '.$ano;
              ?>
              <div>
                  <div class="item">
                      <div class="contiene-img">
                        <img src="<?= PATH;?>img/blog/<?=$elementoBlog['ruta']?>" alt="<?=$elementoBlog['titulo']?>" class="w100Hauto img-blog">
                        <div class="info">
                          <!--<span class="fecha"><img src="<?=PATH?>img/calendario.svg" alt="Futurum" class="calendario" /><?=$fechaf?></span>-->
                          <div class="titulo-blog">
                            <?=$elementoBlog['titulo']?>
                          </div>
                          <div class="p">
                            <?=$elementoBlog['descripcion']?>
                          </div>
                          <div class="text-right">
                            <a href="<?=PATH?>detalle-noticia/<?=$elementoBlog['id_blog']?>-<?=$elementoBlog['url_amigable']?>" class="enlace"><img src="<?=PATH?>img/ver-mas-simple.svg" alt="Torre Triada" class="arrow-blog" /></a>
                          </div>
                        </div>
                      </div>
                  </div>
              </div>
              <?php } ?>
            </div>
          </div>
          <div class="ver-mas-notas" data-aos="fade-up" data-aos-duration="2000">
            <a href="<?=PATH?>noticias" class="relativeZ1"><img src="<?=PATH?>img/ver-todas-las-notas.svg" alt="Torre Triada" class="pointer" /></a>
            <span class="line"></span>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="desarrollador">
    <a id="desarrollador" class="a-seccion"></a>
    <div class="container">
      <div class="row row-con-margen">
        <div class="col-xl-10 col-lg-10 col-md-12 offset-xl-1 offset-lg-1">
          <div class="h2" data-aos="fade-up" data-aos-duration="2000">
            DESARROLLADOR
          </div>
          <div class="h1" data-aos="fade-up" data-aos-duration="2000">
            EXPERIENCIA QUE NOS RESPALDA
          </div>
          <p data-aos="fade-up" data-aos-duration="2000">
            <b>Desde hace más de 10 años creamos proyectos inmobiliarios, residenciales y comerciales que han definido un nuevo paisaje urbano contemporáneo en el sureste de México.</b>
            <br /><br />
            Con innovación, creatividad y una visión integral, desarrollamos diseños arquitectónicos funcionales y estéticos que aportan valor a las ciudades y sus habitantes, todo ello bajo una concepción constructiva respetuosa con las personas, su entorno y el medio ambiente.
            <br /><br />
            Entre nuestras obras más representativas están:
          </p>
          <ul data-aos="fade-up" data-aos-duration="2000">
            <li>
              Orion Business Hub
            </li>
            <li>
              Península Montejo
            </li>
            <li>
              Arborettos
            </li>
            <li>
              Plaza Odara
            </li>
            <li>
              Marola
            </li>
          </ul>
          <div class="alianza" data-aos="fade-up" data-aos-duration="2000">
            <img src="<?=PATH?>img/urbaz-yucatan_b.svg" alt="Torre Triada">
          </div>
        </div>
      </div>
    </div>
    <div class="texto-flotado d-none" data-aos="fade-left" data-aos-duration="2000">
      Orion Business Hub<br />
      Península Montejo<br />
      Arborettos<br />
      Plaza Odara<br />
      Marola
    </div>
  </div>
  <div class="contacto">
    <a id="contacto" class="a-seccion"></a>
    <div class="container">
      <div class="row row-con-margen">
        <div class="col-xl-6 col-lg-6 col-md-12 c-img">
          <img src="<?=PATH?>img/contacto.jpg" alt="Torre Triada" class="img w100Hauto" data-aos="zoom-in" data-aos-duration="2000">
        </div>
        <div class="col-xl-5 col-lg-6 offset-xl-1 offset-lg-0">
          <div class="h2" data-aos="fade-up" data-aos-duration="2000">
            CONTACTO
          </div>
          <div class="h1" data-aos="fade-up" data-aos-duration="2000">
            Déjanos un mensaje
          </div>
          <p data-aos="fade-up" data-aos-duration="2000">
            Proporciónanos tus datos y un asesor se comunicará contigo a la brevedad. ¡Gracias por tu interés!
          </p>
          <form id="formContact" method="post" action="<?=PATH?>send.php">
            <input type="text" name="nombre" value="" placeholder="Nombre" id="c-nombre" data-aos="fade-up" data-aos-duration="2000">
            <input type="text" name="asunto" value="" placeholder="Apellido" id="c-asunto" data-aos="fade-up" data-aos-duration="2000">
            <input type="text" name="telefono" value="" placeholder="Teléfono" id="c-telefono" data-aos="fade-up" data-aos-duration="2000">
            <input type="text" name="correo" value="" placeholder="Correo" id="c-email" data-aos="fade-up" data-aos-duration="2000">
            <textarea name="mensaje" placeholder="Mensaje" id="c-mensaje" data-aos="fade-up" data-aos-duration="2000"></textarea>
            <div class="row row-con-margen" data-aos="fade-up" data-aos-duration="2000">
              <div class="col-xl-7 col-lg-7 col-md-12">
                <div class="g-recaptcha" data-sitekey="6Lebh_kaAAAAAOz5ibHronXWwZzeSW8PFlXcDzlk"></div>
  							<h3 class="terminos-condiciones" style="position:relative">
  								<input type="checkbox" id="acepto" name="acepto" />
  								Acepto los <a href="<?=PATH?>politica-de-privacidad">Términos de Privacidad.</a>
  							</h3>
  							<h5 class="mensaje-de-error text-center" style="display:none">Asegúrate de llenar todos los campos.</h5>
  						</div>
  						<div class="col-xl-5 col-lg-5 col-md-12">
  							<div class="contiene-boton-enviar">
                  <img src="<?=PATH?>img/boton-enviar.svg" alt="Torre Triada" onclick="enviarMensaje();" class="pointer enviar-seguimiento"/>
  							</div>
  						</div>
            </div>
            <input type="hidden" name="campoProducto" value="Contacto">
          </form>
          <!--<iframe src="https://sale-u.com/contacto/Urbaz-360/VENTAS" style="border:none;" scrolling="no"></iframe>-->
        </div>
      </div>
    </div>
  </div>
  <div class="modal fade modal-estilo" id="modalContacto" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="contenido">
          <img src="<?=PATH?>img/cerrar.svg" alt="Cerrar" class="cerrar-modal" data-dismiss="modal" aria-hidden="true">
          <h1>Formulario para <br />descargar brochure</h1>
          <form id="formContact3" method="post" action="<?=PATH?>send.php">
            <div class="row row-con-margen">
              <div class="col-xl-12 col-lg-12 col-md-12">
                <input type="text" name="nombre" value="" placeholder="Nombre" id="c-nombre3">
              </div>
              <div class="col-xl-12 col-lg-12 col-md-12">
                <input type="text" name="asunto" value="" placeholder="Apellido" id="c-asunto3">
              </div>
              <div class="col-xl-12 col-lg-12 col-md-12">
                <input type="email" name="correo" value="" placeholder="Correo" id="c-email3">
              </div>
              <div class="col-xl-12 col-lg-12 col-md-12">
                <input type="text" name="telefono" value="" placeholder="Teléfono" id="c-telefono3">
              </div>
              <div class="clearfix">

              </div>
              <div class="row">
                <div class="col-xl-6 col-lg-6 col-md-6 col-xs-12 c-captcha">
                  <input type="hidden" name="mensaje" value="Nueva descarga del brochure">
                  <div class="g-recaptcha" data-sitekey="6Lebh_kaAAAAAOz5ibHronXWwZzeSW8PFlXcDzlk"></div>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-6 col-xs-12">
                  <h3>
                    <input type="checkbox" id="aceptoC3" name="acepto" />
                    <label for="aceptoC3"><span></span></label>
                    Acepto los <a href="<?=PATH?>politica-de-privacidad" class="pointer" target="_blank">Términos de Privacidad.</a>
                  </h3>
                  <div class="contiene-boton">
                    <img src="<?=PATH?>img/boton-enviar.svg" alt="Torre Triada" class="enviar pointer enviar-seguimiento" onclick="enviarMensaje3();">
                  </div>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-6">
                  <h5 class="mensaje-de-error mensaje-de-error-3" style="display:none; text-align:center;">Asegúrate de llenar todos los campos.</h5>
                  <div id="ocultosuccess3" style="display:none; color:#000; text-align:center; font-size:16px; top:inherit; margin-top:20px; margin-bottom:20px; text-align:center"></div>
                </div>
              </div>
            </div>
            <input type="hidden" name="campoProducto" value="Brochure">
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
  <div class="modal fade" id="modalPaseo" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <img src="<?=PATH?>img/cerrar.svg" alt="Cerrar" class="cerrar-modal" data-dismiss="modal" aria-hidden="true">
        <div class="modal-body">
          <iframe width='100%' height='480px' src='https://roundme.com/embed/8njhusLGgBOAJ05xFhkX' frameborder='0' webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
        </div>
      </div>
    </div>
  </div>
  <div class="modal fade" id="modalPaseo2" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <img src="<?=PATH?>img/cerrar.svg" alt="Cerrar" class="cerrar-modal" data-dismiss="modal" aria-hidden="true">
        <div class="modal-body">
          <iframe width='100%' height='480px' src='https://roundme.com/embed/14y1iDZnWzelgT37PlQk' frameborder='0' webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
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
		<script src="<?=PATH?>js/masterslider/masterslider.min.js?v=1.2"></script>
    <script type="text/javascript">

    //slider home
    var slider = new MasterSlider();

    slider.control('arrows' , {autohide:false} ,{insertTo:'#mastersliderHome'});
    slider.control('bullets' , {autohide:false  , dir:"h", align:"left"});
    slider.setup('mastersliderHome' , {
      width:1920,
      height:610,
      space:0,
      view:'fade',
      autoplay: true,
      layout:'fullscreen',
      loop:true,
      fullscreenMargin:0,
      speed:20,
      overPause: false
    });



    $(window).load(function(){

      var sliderImg = new MasterSlider();

      sliderImg.control('arrows' , {autohide:false} ,{insertTo:'#mastersliderImg'});
      sliderImg.control('bullets' , {autohide:false  , dir:"h", align:"left"});
      sliderImg.setup('mastersliderImg' , {
        width:1920,
        height:610,
        space:0,
        view:'fade',
        autoplay: true,
        layout:'fillwidth',
        autoHeight:true,
        loop:true,
        fullscreenMargin:0,
        speed:20,
        overPause: false
      });

      var sliderImgM = new MasterSlider();

      sliderImgM.control('arrows' , {autohide:false} ,{insertTo:'#mastersliderImgM'});
      sliderImgM.control('bullets' , {autohide:false  , dir:"h", align:"left"});
      sliderImgM.setup('mastersliderImgM' , {
        width:1920,
        height:610,
        space:0,
        view:'fade',
        autoplay: true,
        layout:'fillwidth',
        autoHeight:true,
        loop:true,
        fullscreenMargin:0,
        speed:20,
        overPause: false
      });

      //slider 1
      var slider1 = new MasterSlider();

      //slider1.control('arrows' , {autohide:false} ,{insertTo:'#mastersliderHome'});
      slider1.control('bullets' , {autohide:false  , dir:"h", align:"left"});
      slider1.setup('masterslider1' , {
        width:1920,
        height:610,
        space:0,
        view:'fade',
        autoplay: true,
        layout:'fillwidth',
        autoHeight:true,
        loop:true,
        fullscreenMargin:0,
        speed:20,
        overPause: false
      });

      //slider 2
      var slider2 = new MasterSlider();

      //slider2.control('arrows' , {autohide:false} ,{insertTo:'#mastersliderHome'});
      slider2.control('bullets' , {autohide:false  , dir:"h", align:"left"});
      slider2.setup('masterslider2' , {
        width:1920,
        height:610,
        space:0,
        view:'fade',
        autoplay: true,
        layout:'fillwidth',
        autoHeight:true,
        loop:true,
        fullscreenMargin:0,
        speed:20,
        overPause: false
      });

      //slider 3
      var slider3 = new MasterSlider();

      //slider3.control('arrows' , {autohide:false} ,{insertTo:'#mastersliderHome'});
      slider3.control('bullets' , {autohide:false  , dir:"h", align:"left"});
      slider3.setup('masterslider3' , {
        width:1920,
        height:610,
        space:0,
        view:'fade',
        autoplay: true,
        layout:'fillwidth',
        autoHeight:true,
        loop:true,
        fullscreenMargin:0,
        speed:20,
        overPause: false
      });

      //slider 4
      var slider4 = new MasterSlider();

      //slider4.control('arrows' , {autohide:false} ,{insertTo:'#mastersliderHome'});
      slider4.control('bullets' , {autohide:false  , dir:"h", align:"left"});
      slider4.setup('masterslider4' , {
        width:1920,
        height:610,
        space:0,
        view:'fade',
        autoplay: true,
        layout:'fillwidth',
        autoHeight:true,
        loop:true,
        fullscreenMargin:0,
        speed:20,
        overPause: false
      });

      //slider home video
      var sliderV = new MasterSlider();
      sliderV.setup('mastersliderHomeVideo' , {
        width:1920,
        height:610,
        space:0,
        view:'fade',
        autoplay: true,
        layout:'fullscreen',
        loop:true,
        fullscreenMargin:0,
        speed:20,
        overPause: false
      });

    });

    $(window).load(function(){
      if($(window).width() > 991){
        $('.center').slick({
          dots: true,
          infinite: true,
          speed: 300,
          slidesToShow: 2,
          centerMode: false,
          variableWidth: true,
          autoplay: true
        });
      }else{
        $('.center').slick({
          dots: true,
          infinite: true,
          speed: 300,
          slidesToShow: 1,
          centerMode: false,
          variableWidth: false,
          autoplay: true
        });
      }

    })

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

		</script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0/dist/fancybox.css"/>
    <script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0/dist/fancybox.umd.js"></script>
  </body>
</html>
