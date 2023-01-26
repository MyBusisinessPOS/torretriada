<?php
	include_once('clases/contacto.php');
	include_once('clases/seguridad.php');
	$seguridad = new seguridad();
	$seguridad->candado();

	$operacion = 'modificarcontacto';
	$palabra = 'Editar Contacto';
	$temporal = new contacto();
	$temporal->obtener_contacto();
	$clave='ModCo';
?>
<?php
include('head.html');//Contiene los estilos y los metas.
?>
	<title>Formulario Contacto</title>
<?php
include('header.html');//contiene las barras de arriba y los menus.
include('menu.php');
?>
        <!-- Page content Sección del contenido de la pagina-->
        <div id="page-content-wrapper">

            <!-- Keep all page content within the page-content inset div! -->
            <div class="page-content inset">
                <div class="row rowedit">
                	<!--Seccion del titulo y el boton de agregar-->
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <p class="titulo"><?php echo $palabra;?></p>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    	<form id="form-validation" action="operaciones.php" method="post" name="form1" onsubmit="return validar_campos()">
                    		<input type="hidden" name="idcontacto" value="<?php echo $temporal->idcontacto ?>"/>
                    		<button type="submit" <?php if($seguridad->valida_permiso_usuario($_SESSION['idusuario'],$clave)==0) echo ' disabled ';?> name="operaciones" value="<?php echo $operacion; ?>" class="buttonguardar">Guardar y Publicar</button>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    	<hr class="hrmenu">
                    </div>

                    <div class="clearfix"></div>
                    <!--Seccion de los forms
                    ---------------------------------------------------------------------------------
                    	En esta sección esta para editar el titulo y la descripcion
                    -------------------------------------------------------------------------------->
                     <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    	<div class='notifications top-right'></div>
                    </div>

                    <div class="col-lg-7 col-md-6 col-sm-12 col-xs-12 espacios">
                    	<span class="textHelper">Ingrese el correo para contacto aquí:</span>
                    	<br />
                    	<div id="correo" class="form-group">
                        	<input name="correo" type="text" class="form-control" placeholder="Ej. contacto@ejemplo.com" value="<?php echo $temporal->correo ?>">
                       	</div>
                        <br>
                    </div><!--Div de cierre col-lg-7-->
                    <div class="col-lg-5 col-md-6 col-sm-12 col-xs-12 espacios">
                    	<span class="textHelper">Ingrese el correo remitente de contacto aquí:</span>
                    	<br />
                    	<div id="emisor" class="form-group">
                        	<input name="emisor" type="text" class="form-control" placeholder="Ej. noreply@ejemplo.com" value="<?php echo $temporal->emisor ?>">
                       	</div>
                   	</div>
                    <div class="clearfix"></div>
                    <!--Este div contiene la barra inferior-->
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    	<hr class="hrmenu">
                    </div>
                    <!--Este div contiene al boton inferior-->
                    <div class="clearfix"></div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    		<button type="submit" <?php if($seguridad->valida_permiso_usuario($_SESSION['idusuario'],$clave)==0) echo ' disabled ';?> name="operaciones" value="<?php echo $operacion; ?>" class="buttonguardar">Guardar y Publicar</button>
                        </form>
                    </div>

                    <!--Sección del pie de pagina-->
                    <footer id="footer">
                    	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">
												Derechos Reservados a Slogan Publicidad.
												<br>
												webmaster@sloganpublicidad.com
												<br>
												sloganpublicidad.com
                    	</div>
                    </footer>
                </div><!--Div de cierre del row-->
            </div><!--Div de cierre de page-content inset-->
        </div><!--Div de cierre de page-content-wrapper-->
    </div><!--Div de cierre de id Wrapper-->

<?php
include 'javascripts.html';
?>
<script>
	function validar_campos(){
		var filter=/^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;

		if(!filter.test(form1.correo.value || form1.correo.value == '')){
			form1.correo.focus();
			$('#correo').removeClass("form-group").addClass("form-group has-error");
			$('.top-right').notify({
    			message: { text: 'Este no es correo valido o el campo esta vacío' },
    			type:'blackgloss',
  			}).show();
			return false;
			}
		else{
			$('#correo').removeClass("form-group has-error").addClass("form-group has-success");
		}
		if(!filter.test(form1.emisor.value) || form1.emisor.value == ''){
			form1.emisor.focus();
			$('#emisor').removeClass("form-group").addClass("form-group has-error");
			$('.top-right').notify({
    			message: { text: 'Este no es correo valido o el campo esta vacío' },
    			type:'blackgloss',
  			}).show();
			return false;
		}
		else{
			$('#emisor').removeClass("form-group has-error").addClass("form-group has-success");
		}
	}
	</script>
</body>
</html>
