<?php

	include_once('clases/lote.php');

	include_once('clases/seguridad.php');

	$seguridad = new seguridad();

	$seguridad->candado();

	if(isset($_REQUEST['idlote'])){
		$id = $_REQUEST['idlote'];
		$operacion = 'modificarlotificacion';
		$palabra = 'Editar Lote';
		$temporal = new lote($id);
		$temporal -> obtenerLote();
		if($temporal->ruta != '')
		$img = '<img src="../img/imgLotes/'.$temporal->ruta.'" style="max-width:100%; max-height:221px" />';
		else
			$img='';
		if($temporal->ruta != ''){
			$validator='';
		}
		else{
			$validator='if (!val.match(/(?:gif|jpg|png|JPEG|JPG|jpeg)$/)) {
				$("#check").removeClass("form-group").addClass("form-group has-error");
				$(".top-right").notify({
					message: { text: "El tipo de archivo que intenta subir no es admitido, solo se aceptan imágenes con formato .jpg .jpeg .JPG .JPEG .png .gif" },
					type:"blackgloss",
					delay: 6000,
				}).show();
				return false;
			}';
		}

	}

	else{

		$id = 0;

		$operacion = 'agregarlote';

		$palabra = 'Nuevo Lote';

	}

	$clave = 'modlot';

?>

<?php

include('head.html');//Contiene los estilos y los metas.

?>

	<title>Formulario Lotificación</title>

<?php

include('header.html');//contiene las barras de arriba y los menus.

include('menu.php');

?>

        <!-- Page content Sección del contenido de la pagina-->

        <div id="page-content-wrapper">



            <!-- Keep all page content within the page-content inset div! -->

            <div class="page-content inset">

            	<form id="form-validation" action="operaciones.php"  method="post" name="form1" onsubmit="return validar_campos()" enctype="multipart/form-data">
				<input type="hidden" name="MAX_FILE_SIZE" value="600000000"/>
                <div class="row rowedit">

                	<!--Seccion del titulo y el boton de agregar-->

                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">

                        <p class="titulo"><?php echo $palabra;?></p>

                    </div>

                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">

                    		<input type="hidden" name="idlote" value="<?php echo $temporal->idLote; ?>"/>

                    		<button type="submit" <?php if($seguridad->valida_permiso_usuario($_SESSION['idusuario'],$clave)==0) echo ' disabled ';?> name="operaciones" value="<?php echo $operacion; ?>" class="buttonguardar">Guardar y Publicar</button>

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

                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

                    <div id="nombre" class="input-group espacios">

                        <span class="input-group-addon es">Lote</span>

                        <input type="text"  name="lote" class="form-control" value="<?=$temporal->lote?>" readonly>

                    </div>

                    <div id="metrosCuadrados" class="input-group espacios">

                        <span class="input-group-addon es">Metros Cuadrados</span>

                        <input type="text" name="metrosCuadrados" class="form-control" placeholder="Ingrese los metros cuadrados aquí..." value="<?=$temporal->metrosCuadrados?>" id="m2" onkeyup="calculaPrecio();">

                    </div>

					<!--Eduardo Gonzalez Casasola-->
					<!--Interior-->
						<div id="interior" class="input-group espacios">

							<span class="input-group-addon es">Interior m2</span>

							<input type="text" name="interior" class="form-control" placeholder="Ingrese los metros cuadrados del interior aquí..." value="<?=$temporal->interior?>" id="interior" >

						</div>

						<!--Terrazas-->
						<div id="terrazas" class="input-group espacios">

						<span class="input-group-addon es">Terrazas m2</span>

						<input type="text" name="terrazas" class="form-control" placeholder="Ingrese las terrazas..." value="<?=$temporal->terrazas?>" id="terrazas">

						</div>

						<!--Cajones-->
						<div id="cajones" class="input-group espacios">

						<span class="input-group-addon es">Cajones</span>

						<input type="text" name="cajones" class="form-control" placeholder="Ingrese los cajones cuadrados aquí..." value="<?=$temporal->cajones?>" id="cajones">

						</div>

				    <!--Fin actualizacion Eduardo Gonzalez Casasola-->	
					<!--solucionestpvpos.com-->	
				   	<!--desarrollo@solucionestpvpos.com-->									
					<!--26/01/2022-->			
	

                    <div id="precioC" class="input-group espacios">

                        <span class="input-group-addon es">Precio x m<sup>2</sup></span>

                        <input type="text" name="precio" class="form-control" placeholder="Ingrese el precio aquí..." value="<?=$temporal->precio?>" id="preciom2" onkeyup="calculaPrecio();">

                    </div>

					<div id="precioF" class="input-group espacios">

                        <span class="input-group-addon es">Precio total </span>

                        <input type="text" readonly class="form-control" value="<?=$temporal->precioTotal?>" id="precioRes">

                    </div>

                    <div id="engancheDiv" class="input-group espacios">

                        <span class="input-group-addon es">Enganche </span>

                        <input type="text" name="enganche" class="form-control" value="<?=$temporal->enganche?>" id="engancheCampo">

                    </div>

                    <div id="mensualidadDiv" class="input-group espacios">

                        <span class="input-group-addon es">Mensualidad </span>

                        <input type="text" name="mensualidad" class="form-control" value="<?=$temporal->mensualidad?>" id="mensualidadCampo">

                    </div>

                    <div id="mesesDiv" class="input-group espacios">

                        <span class="input-group-addon es">Meses </span>

                        <input type="text" name="meses" class="form-control" value="<?=$temporal->meses?>" id="mesesCampo">

                    </div>

                    <div id="statusL" class="input-group espacios">

                        	<span class="input-group-addon es">Status</span>

                        	<select name="status" class="form-control">

								<?php

                                         $d = '';

                                         $ap = '';

                                         $v = '';



                                         if($temporal->status == 1)

                                            $d = ' selected';

                                         if ($temporal->status == 2)

                                            $ap = ' selected';

                                         if ($temporal->status == 3)

                                            $v = ' selected';



                                        ?>



                                <option value="">---</option>

                                <option value="1" <?=$d?>>Disponible</option>

                                <option value="2" <?=$ap?>>Apartado</option>

                                <option value="3" <?=$v?>>Vendido</option>

                            </select>

                    </div>

					<div class="hidden">
											<div class="espacios">
	                    <span class="textHelper">Previsualizar Imagen Lote:</span>
	                    </div>

	                    <br>
	                    <output align="center" id="list"><?=$img?></output>
	                    <br>
	                    <center>
	                        <input id="files" name="archivo" type="file" class="upload"/>
	                    </center>
	                    <br>
	                    <div class="text-center textHelper">
	                        Tipo de archivos permitidos: jpg, jpeg, png, gif.
	                    </div>
	                    <br>
										</div>


                    </div><!--Div de cierre col-lg-12-->

					<div class="espacios">
						<center>
	                    <span class="text-center textHelper">Cargar Imagen</span>
						</center>
	                    </div>

	                    <br>
	                    <output align="center" id="list"><?=$img?></output>
	                    <br>
	                    <center>
	                        <input id="files" name="archivo" type="file" class="upload"/>
	                    </center>
	                    <br>
	                    <div class="text-center textHelper">
	                        Tipo de archivos permitidos: jpg, jpeg, png, gif.
	                    </div>
	                    <br>
					</div>


                    <div class="clearfix"></div>

                    <!--Este div contiene la barra inferior-->

                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="margin: 15px 0 0 0">

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

												Derechos Reservados a Asiete Agencia.
												<br>
												webmaster@asiete.mx
												<br>
												asiete.mx

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

		if (form1.metrosCuadrados.value == ''){

			$('#metrosCuadrados').removeClass("form-group").addClass("form-group has-error");

			$('.top-right').notify({

    			message: { text: 'El dato metros cuadrados está vacío, es requerido' },

    			type:'blackgloss',

  			}).show();

			return false;

			}

		else{

			$('#metrosCuadrados').removeClass("form-group has-error").addClass("form-group has-success");

		}

		<?=$validator?>

	}

	</script>
	<!--Script que permite previsualizar la imagen primaria-->
    <script>
	  function handleFileSelect(evt) {
		var files = evt.target.files; // FileList object

		// Loop through the FileList and render image files as thumbnails.
		for (var i = 0, f; f = files[i]; i++) {

		  // Only process image files.
		  if (!f.type.match('image.*')) {
			continue;
		  }

		  var reader = new FileReader();

		  // Closure to capture the file information.
		  reader.onload = (function(theFile) {
			return function(e) {
			  // Render thumbnail.
			  var span = document.createElement('span');
			  span.innerHTML = ['<img style="max-width:100%; max-height:221px" src="', e.target.result,
								'" title="', escape(theFile.name), '"/>'].join('');
			  $("#list").empty();
			  document.getElementById('list').insertBefore(span, null);
			};
		  })(f);

		  // Read in the image file as a data URL.
		  reader.readAsDataURL(f);
		}
	  }

	  document.getElementById('files').addEventListener('change', handleFileSelect, false);
	</script>
    <script language="javascript">
		function calculaPrecio(){

			var preciom2=$("#preciom2").val();
			var m2=$("#m2").val();

			var precioFinal=parseFloat(preciom2)*parseFloat(m2);
			$("#precioRes").val(precioFinal.toFixed(2));
		}
	</script>
</body>

</html>
