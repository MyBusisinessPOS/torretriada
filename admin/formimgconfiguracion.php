<?php
	include_once('clases/imgconfig.php');
	include_once('clases/seguridad.php');
	$seguridad = new seguridad();
	$seguridad->candado();

	$operacion = 'modificarconfigimg';
	$palabra = 'Editar Configuración de Imágenes';
	$temporal = new imgconfig();
	$temporal->obtenerimgconfig();
	if(isset($_REQUEST['success'])){
	$success = $_REQUEST['success'];
	switch($success){
		case '0':
			$alert = '<div class="alert alert-danger alert-dismissable">
  						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
  						<strong>¡Error!</strong> Ha ocurrido un error vuelva a intentarlo.
					  </div>';
		break;
		case '1':
			$alert = '<div class="alert alert-success alert-dismissable">
  						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
  						<strong>¡Muy bien!</strong> Se ha creado correctamente este registro.
					  </div>';
		break;
		case '2':
			$alert = '<div class="alert alert-success alert-dismissable">
  						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
  						<strong>¡Muy bien!</strong> Se ha modificado correctamente este registro.
					  </div>';
		break;
		case '3':
			$alert = '<div class="alert alert-info alert-dismissable">
  						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
  						<strong>¡Muy bien!</strong> Se ha eliminado correctamente el(los) registro(s).
					  </div>';
		break;
		case '4':
			$alert = '<div class="alert alert-info alert-dismissable">
  						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
  						<strong>¡Muy bien!</strong> Se ha activado correctamente el(los) registro(s).
					  </div>';
		break;
		case '5':
			$alert = '<div class="alert alert-warning alert-dismissable">
  						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
  						<strong>¡Muy bien!</strong> Se ha desactivado correctamente el(los) registro(s).
					  </div>';
		break;
	}
}
else{
	$success = '';
	$alert = '';
}
?>
<?php
include('head.html');//Contiene los estilos y los metas.
?>
	<title>Formulario Configuración Img</title>
<?php
include('header.html');//contiene las barras de arriba y los menus.
include('menu.php');
?>
        <!-- Page content Sección del contenido de la pagina-->
        <div id="page-content-wrapper">

            <!-- Keep all page content within the page-content inset div! -->
            <div class="page-content inset">
                <div class="row rowedit">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                		<?=$alert?>
                	</div>
                	<!--Seccion del titulo y el boton de agregar-->
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <p class="titulo"><?php echo $palabra;?></p>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    	<form id="form-validation" action="operaciones.php" method="post" name="form1" onsubmit="return validar_campos()">
                    		<input type="hidden" name="idconfiguracion" value="<?php echo $temporal->idconfiguracion ?>"/>
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

                    <div class="col-lg-8 col-md-12 col-sm-12 col-xs-12 espacios">

                        <div id="altomaximo" class="input-group espacios" >
                            <span class="input-group-addon es"><i class="fa fa-image"></i> <i class="fa fa-arrows-v"></i> Ingrese el alto máximo de la imágen en pixeles</span>
                            <input name="altomaximo" type="number" class="form-control" placeholder="Ej: 800" value="<?php echo $temporal->altomaximo ?>">
                        </div>

                        <div id="anchomaximo" class="input-group espacios" >
                            <span class="input-group-addon es"><i class="fa fa-image"></i> <i class="fa fa-arrows-h"></i> Ingrese el ancho máximo de la imágen en pixeles</span>
                            <input name="anchomaximo" type="number" class="form-control" placeholder="Ej: 800" value="<?php echo $temporal->anchomaximo ?>">
                        </div>

                        <div id="calidad" class="input-group espacios" >
                            <span class="input-group-addon es"><i class="fa fa-line-chart"></i> Ingrese la calidad de la imagen (máx 100)</span>
                            <input name="calidad" type="number" class="form-control" min="1" max="100" placeholder="Ej: 90 (más alto es mejor)" value="<?php echo $temporal->calidad ?>">
                        </div>



                    </div><!--Div de cierre col-lg-7-->
                    <div class="col-lg-5 col-md-6 col-sm-12 col-xs-12 espacios">

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

		if(form1.altomaximo.value == ''){
			form1.altomaximo.focus();
			$('#altomaximo').removeClass("form-group").addClass("form-group has-error");
			$('.top-right').notify({
    			message: { text: 'El Campo del alto máximo está vacío, para poder continuar asigne un alto máximo' },
    			type:'blackgloss',
  			}).show();
			return false;
			}
		else{
			$('#altomaximo').removeClass("form-group has-error").addClass("form-group has-success");
		}
		if(form1.anchomaximo.value == ''){
			form1.anchomaximo.focus();
			$('#anchomaximo').removeClass("form-group").addClass("form-group has-error");
			$('.top-right').notify({
    			message: { text: 'El Campo del ancho máximo está vacío, para poder continuar asigne un ancho máximo' },
    			type:'blackgloss',
  			}).show();
			return false;
			}
		else{
			$('#anchomaximo').removeClass("form-group has-error").addClass("form-group has-success");
		}
	}
	</script>
</body>
</html>
