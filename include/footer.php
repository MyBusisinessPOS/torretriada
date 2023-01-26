<footer>
    <!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-5RXH3TQ"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
	<div class="container relativeZ2">
		<div class="row row-con-margen">
			<div class="col-xl-3 col-lg-3 col-md-12" data-aos="fade" data-aos-delay="500" data-aos-duration="500">
				<a href="<?=PATH?>"><img src="<?=PATH?>img/logo-footer.svg" class="logo" alt="Torre Triada" /></a>
				<!--<a href="<?=PATH?>"><img src="<?=PATH?>img/logo-footer-2.svg" class="logo-2" alt="Torre Triada" /></a>-->
			</div>
			<div class="col-xl-3 col-lg-3 col-md-12" data-aos="fade" data-aos-delay="1000" data-aos-duration="500">
				<div class="h2">
					Torre Triada
				</div>
				<ul>
					<li><a href="<?=PATH?>#inicio"><span>></span> Inicio</a></li>
					<li><a href="<?=PATH?>#torre-triada"><span>></span> Torre Triada</a></li>
					<li><a href="<?=PATH?>#ubicacion"><span>></span> Ubicación</a></li>
					<li><a href="<?=PATH?>#locales-comerciales"><span>></span> Espacios</a></li>
					<li><a href="<?=PATH?>#noticias"><span>></span> Noticias</a></li>
					<li><a href="<?=PATH?>#desarrollador"><span>></span> Desarrollador</a></li>
					<li><a href="<?=PATH?>#contacto"><span>></span> Contacto</a></li>
				</ul>
			</div>
			<div class="col-xl-3 col-lg-3 col-md-12" data-aos="fade" data-aos-delay="1500" data-aos-duration="500">
				<div class="h2">
					Datos de contacto
				</div>
				<p class="uno">
					<span>></span> Tel: <a href="tel:9999 441214">9999 441214</a><br />
					<span>></span> Correo: <a href="mailto:info@yucatanpremier.com">info@yucatanpremier.com</a><br />
					<span>></span> Showroom: Calle 20 con 1-G.<br />
					Colonia México, Mérida, Yucatán.<br />
					<span>></span> Síguenos en:
					<a href="https://www.facebook.com/UrbazMX" target="_blank"><i class="fab fa-facebook red"></i></a>
					<a href="https://www.instagram.com/urbaz.mx/" target="_blank"><i class="fab fa-instagram red dos"></i></a>
				</p>
			</div>
			<div class="col-xl-3 col-lg-3 col-md-12" data-aos="fade" data-aos-delay="2000" data-aos-duration="500">
				<div class="h2">
					Suscríbete
				</div>
				<form id="formContactFooter" method="post" action="<?=PATH?>sendFooter.php">
					<input type="text" name="nombre" value="" placeholder="Nombre" id="c-nombreF">
					<input type="email" name="correo" value="" placeholder="Correo electrónico" id="c-emailF">
					<div class="contiene-boton">
						<img src="<?=PATH?>img/boton-enviar.svg" alt="Torre Triada" onclick="enviarMensajeFooter();"/>
					</div>
					<div id="ocultosuccess3"></div>
				</form>
			</div>
		</div>
	</div>
	<div class="container relative">
		<img src="<?=PATH?>img/footer-comercializado.svg" alt="Torre Triada" class="footer-comercializado d-none d-lg-block">
		<div class="h3 d-none d-lg-block">
			© Torre Triada. Todos los derechos reservados  /  <a href="<?=PATH?>politica-de-privacidad">Aviso de privacidad</a>
		</div>
		<div class="h3 d-block d-lg-none">
			© Torre Triada.<br /> Todos los derechos reservados<br /> <a href="<?=PATH?>politica-de-privacidad">Aviso de privacidad</a>
		</div>
	</div>
	<img src="<?=PATH?>img/shape-footer.svg" alt="Torre Triada" class="shape">
	<img src="<?=PATH?>img/footer-urbaz.svg" alt="Torre Triada" class="footer-urbaz">
	<img src="<?=PATH?>img/footer-comercializado-m.svg" alt="Torre Triada" class="footer-comercializado d-block d-lg-none">
</footer>
