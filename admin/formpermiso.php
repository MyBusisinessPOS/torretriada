<?php
	include_once('clases/permiso.php');
	include_once('clases/seguridad.php');
	$seguridad = new seguridad();
	$seguridad->candado();


	if(isset($_REQUEST['idpermiso'])){
		$id = $_REQUEST['idpermiso'];
		$operacion = 'modificarpermiso';
		$palabra = 'Editar Permiso';
	}
	else{
		$id = 0;
		$operacion = 'agregarpermiso';
		$palabra = 'Nuevo Permiso';
	}

	$temporal = new permiso($id);
	$temporal -> obtener_permiso();
	$clave='ModPer';
?>
<?php
include('head.html');//Contiene los estilos y los metas.
?>
	<title>Formulario Permiso</title>
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
                    		<input type="hidden" name="idpermiso" value="<?php echo $temporal->idpermiso ?>"/>
                    		<input type="hidden" name="status" value="<?php echo $temporal->status; ?>" />
                    		<button type="submit" <?php if($seguridad->valida_permiso_usuario($_SESSION['idusuario'],$clave)==0) echo '  ';?> name="operaciones" value="<?php echo $operacion; ?>" class="buttonguardar">Guardar y Publicar</button>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    	<hr class="hrmenu">
                    </div>

                    <div class="clearfix"></div>
                    <!--Seccion de los forms
                    	En esta sección esta para editar el titulo y la descripcion
                    -------------------------------------------------------------------------------->
                     <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    	<div class='notifications top-right'></div>
                    </div>
                    <div class="col-lg-7 col-md-6 col-sm-12 col-xs-12">
                    	<div id="titulo" class="form-group">
                        	<input name="titulo" type="text" class="form-control" placeholder="Ingrese el titulo aquí..." value="<?php echo $temporal->nompermiso ?>">
                       	</div>
                        <br>
                    </div><!--Div de cierre col-lg-7-->
                    <div class="col-lg-5 col-md-6 col-sm-12 col-xs-12">
                    	<div id="clave" class="form-group">
                        	<input name="clave" type="text" class="form-control" placeholder="Ingrese la Clave Aquí" value="<?php echo $temporal->clavepermiso ?>">
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

		if (form1.titulo.value == ''){
			form1.titulo.focus();
			$('#titulo').removeClass("form-group").addClass("form-group has-error");
			$('.top-right').notify({
    			message: { text: 'El Campo del titulo esta vacío, para poder continuar asigne un titulo a la propiedad' },
    			type:'blackgloss',
  			}).show();
			return false;
			}
		else{
			$('#titulo').removeClass("form-group has-error").addClass("form-group has-success");
		}
		if(form1.prefijo.value == ''){
			form1.prefijo.focus();
			$('#prefijo').removeClass("form-group").addClass("form-group has-error");
			$('.top-right').notify({
    			message: { text: 'El campo del prefijo esta vacío, para poder continuar asigne un precio a la propiedad' },
    			type:'blackgloss',
  			}).show();
			return false;
		}
		else{
			$('#prefijo').removeClass("form-group has-error").addClass("form-group has-success");
		}
	}
	</script>
</body>
</html>
