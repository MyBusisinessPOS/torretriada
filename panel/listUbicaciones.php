<?php
function __autoload($nombre_clase) {
    include 'clases/'.$nombre_clase .'.php';

}
$seguridad = new seguridad();
$seguridad->candado();
$alert = '';

if(isset($_REQUEST['success'])){
	$success = $_REQUEST['success'];
  	$herramientas = new herramientas();
  	$alert = $herramientas -> mensajesAlerta($success);
}

$temporal = new sucursal();
$listaTemporal = $temporal -> listSucursal(1, false, '', '', 20, 'es', false);

$temporal -> getImgMapa();
$clave = 'p_add_sucursal';
$clave2 = 'p_del_sucursal';
$clave3 = 'p_acdc_sucursal';
$clave4 = 'p_sort_sucursal';
$clave5 = 'p_mod_sucursal';
$sort = "sucursal";
$handle = "";
if($seguridad->valida_permiso_usuario($_SESSION['idusuario'],$clave4)==0){
  $handle ='';
  $permiso = "<input type='hidden' id='valorpermiso' name='permiso' value='0'>";
}else{
  $handle = '<span class="fa-stack fa-1x mover handle"><i class="fa fa-circle fa-stack-2x"></i><i class="fa fa-arrows fa-stack-1x fa-inverse"></i></span>';
  $permiso = "<input type='hidden' id='valorpermiso' name='permiso' value='1'>";
}
($seguridad->valida_permiso_usuario($_SESSION['idusuario'],$clave3)==0) ? $permisoAcDc = 0 : $permisoAcDc = 1;
//variable global para el paginador;
$opera_list = 'listarSucursal';
$_lastPage = count($listaTemporal)-1;
$_de = $listaTemporal[$_lastPage]['orden'];
?>
<!DOCTYPE html>
<html lang="es">
	<head>
		<?php include 'head.php';?>
		<title>Lista | Ubicaciones</title>
	</head>
	<body>
		<header>
			<?php include 'header.php';?>
		</header>
		<!--wrapper es el que contiene a toda la pagina-->
    	<div id="wrapper" class="wrapper-movil">
    		<?php include 'menu.php';?>
    		<!-- Page content Sección del contenido de la pagina-->
	        <div id="page-content-wrapper">
	        	<!-- Keep all page content within the page-content inset div! -->
            	<div class="page-content inset">
            		<div class="row rowedit">
            			<!--Seccion ALERTAS-->
            			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
	                		<?=$alert?>
	                		<div class='notifications bottom-right'></div>
	                	</div>
	                	<!--Seccion del titulo y el boton de agregar-->
	                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
	                        <p class="titulo">Ubicaciones</p>
	                    </div>
	                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">

	                    	<form action="formSucursal.php" method="post">
	                    		<button type="button" <?php if($seguridad->valida_permiso_usuario($_SESSION['idusuario'],$clave)==0) echo ' disabled ';?> value="" class="buttonagregar">Agregar Nuevo</button>
	                    		<button type="button" <?php if($seguridad->valida_permiso_usuario($_SESSION['idusuario'],$clave)==0) echo ' disabled ';?> value="" class="editmap" style="margin-right: 20px;">Editar Mapa</button>
	                        </form>   
	                    </div>
	                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
	                    	<hr class="hrmenu">
	                    </div>
	                    <div class="clearfix"></div>
	                    <!--Sección para realizar cambios Nota: el div con la clase styled-large es la que se visualiza con lg y md-->
                    	<form method="post" action="operaciones.php">
                    		<input type="hidden" id="permisoAcDc" value="<?=$permisoAcDc?>">
                    		<div class="">
                    			<div class="col-md-6 col-md-push-6 col-xs-12">
		                        	<div class="busqueda espacios"><input type="search" data-column="all" class="form-control search"/></div>
		                        </div>
		                        <div class="col-md-6 col-xs-12 col-md-pull-6">
		                            <ul class="ulfiltros">
		                                <li class="lifiltros">
		                                    <div class="styled-select">
		                                        <select name="operador">
		                                            <option value="Activar" class="styled" <?php if($seguridad->valida_permiso_usuario($_SESSION['idusuario'],$clave3)==0) echo ' disabled ';?>>Activar</option>
		                                            <option value="Desactivar" class="styled" <?php if($seguridad->valida_permiso_usuario($_SESSION['idusuario'],$clave3)==0) echo ' disabled ';?>>Desactivar</option>
		                                            <option value="Eliminar" class="styled" <?php if($seguridad->valida_permiso_usuario($_SESSION['idusuario'],$clave2)==0) echo ' disabled ';?>>Eliminar</option>
		                                       </select>
		                                    </div>
		                                </li>
		                                <li class="lifiltros">    
		                                    <button type="submit" class="buttonaplicar" name="operaciones" value="operasucursal">Aplicar</button>
		                                </li>	                                
		                            </ul>                     
		                        </div>
		                    </div>
		                    <div class="clearfix"></div>
		                    <!--Seccion de la tabla-->
		                    <div class="col-md-12 col-xs-12">
		                        <?php echo $permiso;?>
		                        <div class="table-responsive">
			                        <table id="table-short" class="table table-hover table-striped tablesorter">
			                            <thead class="styled-thead">
			                              <tr>
			                              	<th width="50">
			                                	<input type="checkbox" id="marcar" name="marcar" onclick="marcartodos(this);" value="marcar">
												<label for="marcar"><span></span></label>
			                                </th>
			                                <th width="150px">Imagen</th>  
			                                <th>Título</th> 
			                                <th>Descripción</th> 
			                                <th>Telefono</th>
			                                <th>Email</th>   
			                                <th class="text-center">Destacado</th>		                                                    
			                                <th class="text-center">Mostrar</th>
			                              </tr>
			                            </thead>
			                            <tbody class="styled-tbody" id="sortable">
			                    <?php
									foreach($listaTemporal as $elementoTemporal){
										$temporal -> getSucursalEn($elementoTemporal['idSucursal'],'en');	
										//print_r($temporal);
										if($seguridad->valida_permiso_usuario($_SESSION['idusuario'],$clave3)==0){
											if($elementoTemporal['status']!=0){
												$img='img/visible.png';
												$funcion='';
												$class = 'nover';
											}
											else{
										  		$img='img/invisible.png';
												$funcion='';
												$class = 'ver';
										   }	
										}
										else{
											if($elementoTemporal['status']!=0){
												$img='img/visible.png';
												$funcion='changeStatus('.$elementoTemporal['idSucursal'].',0,\'changeStatusSucursal\')';
												$class = 'nover';
											}
											else{
										  		$img='img/invisible.png';
												$funcion='changeStatus('.$elementoTemporal['idSucursal'].',1,\'changeStatusSucursal\')';
												$class = 'ver';
										   }
										}
										if($elementoTemporal['destacado'] != 0){
											$_fa = 'fa-toggle-on';
											$_funcion = 'changeDestacado('.$elementoTemporal['idSucursal'].',0,\'changeDestacadoSucursal\')';
										}else{
											$_fa = 'fa-toggle-off';
											$_funcion = 'changeDestacado('.$elementoTemporal['idSucursal'].',1,\'changeDestacadoSucursal\')';
										}
									?>	
											<tr>
				                              	<td>
				                                 	<input type="hidden" name="idorden" class="idorden" value="<?=$elementoTemporal['idSucursal']?>">
				                                	<input type="checkbox" id="<?=$elementoTemporal['idSucursal']?>" name="idSucursal[]" value="<?=$elementoTemporal['idSucursal']?>">
													<label for="<?=$elementoTemporal['idSucursal']?>"><span></span></label>
				                                </td>
				                               	<td>
				                                	<div class="edit manita" data-id="<?=$elementoTemporal['idSucursal']?>" data-nombre="<?=$elementoTemporal['nombre']?>" data-descripcion="<?=$elementoTemporal['descripcion']?>" data-nombre_en="<?=$temporal->_nombre?>" data-descripcion_en="<?=$temporal->_descripcion?>" data-ruta="<?=$elementoTemporal['imgPortada']?>" data-telefono="<?=$elementoTemporal['telefono']?>" data-telmovil="<?=$elementoTemporal['telMovil']?>" data-email="<?=$elementoTemporal['email']?>" data-ubicacion="<?=$elementoTemporal['ubicacion']?>">
				                                		<img src="../img/sucursal/<?=$elementoTemporal['imgPortada']?>" class="img-responsive">
				                                	<div>
				                                </td>     
				                                <td>
				                                	<div class="edit manita" data-id="<?=$elementoTemporal['idSucursal']?>" data-nombre="<?=$elementoTemporal['nombre']?>" data-descripcion="<?=$elementoTemporal['descripcion']?>" data-nombre_en="<?=$temporal->_nombre?>" data-descripcion_en="<?=$temporal->_descripcion?>" data-ruta="<?=$elementoTemporal['imgPortada']?>" data-telefono="<?=$elementoTemporal['telefono']?>" data-telmovil="<?=$elementoTemporal['telMovil']?>" data-email="<?=$elementoTemporal['email']?>" data-ubicacion="<?=$elementoTemporal['ubicacion']?>">
				                                		<?=$elementoTemporal['nombre']?>
				                                	<div>
				                                </td>  
				                                <td><?=$elementoTemporal['descripcion']?></td>
				                                <td><?=$elementoTemporal['telefono']?></td>
				                                <td><?=$elementoTemporal['email']?></td>
				                                <td class="text-center">
				                                	<span class="btn btn-default btn-xs"><i id="dest<?=$elementoTemporal['idSucursal']?>" class="fa <?=$_fa?>" onclick="<?=$_funcion?>"></i><span>
				                                </td>				                                             
				                                <td class="text-center">
				                                	<?=$handle?>				                                	
				                                	<img class="manita <?=$class?>" onclick="<?=$funcion?>" id="temp<?=$elementoTemporal['idSucursal']?>" src="<?=$img?>">
				                                </td>
				                            </tr>    
			                    <?php        
									}
			                    ?>
			                            </tbody>
			                            <tfoot class="styled-tfoot">
			                              	<tr>
			                              		<th>
			                                		<input type="checkbox" id="marcar2" name="marcar2" onclick="marcartodos(this);" value="marcar2">
													<label for="marcar2"><span></span></label>
			                                	</th>
				                                <th width="150px">Imagen</th>  
				                               	<th>Título</th> 
				                                <th>Descripción</th> 
				                                <th>Teléfono</th>
				                                <th>Email</th>
				                                <th>Destacado</th>   				                                                   
				                                <th class="text-center">Mostrar</th>
			                              	</tr>
			                            </tfoot>
			                        </table>
			                       	<!-- pager -->
		                            <div id="pager" class="pager">
		                               	<form>
			                                <img src="img/first.png" class="first"/>
			                                <img src="img/prev.png" class="prev"/>
			                                <span class="pagedisplay"></span> <!-- this can be any element, including an input -->
			                                <img src="img/next.png" class="next"/>
			                                <img src="img/last.png" class="last"/>
			                                <select class="pagesize">
			                                  	<option value="10">10</option>
			                                  	<option value="40">40</option>
			                                  	<option value="50">50</option>
			                                  	<option value="100">100</option>
			                                </select>
			                            </form>
		                            </div>
			                    </div>
		                	</div><!--Div de cierre de la clase table-responsive-->
                    	</form>
            		</div>
            	</div>
	        </div>
	    </div>
		<div class="modal fade" id="modal-edit-table">
	    	<div class="modal-dialog" role="document">
	    		<form id="form-validation" style="display: inline" name="form1" action="operaciones.php" method="post" enctype="multipart/form-data">
	    			<input type="hidden" id="id" name="id" value="">
                   	<input type="hidden" id="operaciones" name="operaciones" value="">
                   	<input type="hidden" id="MOD" value="">
		    		<div class="modal-content">
		    			<div class="modal-header">
		    				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
		    					<span aria-hidden="true">&times;</span>
		    					<span class="sr-only">Close</span>
		    				</button>
		    				<h4 class="modal-title"></h4>
		    			</div>
		    			<div class="modal-body">
		    				<center class="espacios">
								PREVISUALIZAR IMAGEN PRINCIPAL
								<div id="preview-sucursal" class="espacios">		
								</div>
								<input type="file" onchange="showMyImageWH('preview-sucursal', this, '', 1, 1600, 1275)" name="imagen" id="" class="filestyle" data-input="false" data-buttonText="Imagen Principal" data-iconName="fa fa-picture-o" data-badge="false" data-type-file="imagen" data-validate="true" data-text="Imagen Principal">
								<p class="help-block">Solo se aceptan imagenes con formato .JPG, .JPEG, .PNG; La imagen debe ser menor a 3 MB. <br> La resolución óptima para esta imagen es de 1600 x 1275px </p>
							</center>							
		    				<div class="input-group espacios">
			                    <span class="input-group-addon">Título</span>
			                    <input type="text" id="tituloEs" name="titulo[es]" data-validate="false" class="form-control" placeholder="Ingresa el título..." value="">
			                    <span class="input-group-addon"> <i class="fa fa-globe"></i> ES</span>
			                </div>
			                <div class="input-group espacios">
			                    <span class="input-group-addon">Descripcion</span>
			                    <input type="text" id="descripcionEs" name="descripcion[es]" data-validate="false" class="form-control" placeholder="Ingresa la descripción..." value="">
			                    <span class="input-group-addon"> <i class="fa fa-globe"></i> ES</span>
			                </div>			               	
			                <div class="input-group espacios">
			                    <span class="input-group-addon">Título</span>
			                    <input type="text" id="tituloEn" name="titulo[en]" data-validate="false" class="form-control" placeholder="Ingresa el título..." value="">
			                    <span class="input-group-addon"> <i class="fa fa-globe"></i> EN</span>
			                </div>
			                <div class="input-group espacios">
			                    <span class="input-group-addon">Descripción</span>
			                    <input type="text" id="descripcionEn" name="descripcion[en]" data-validate="false" class="form-control" placeholder="Ingresa el subtitulo..." value="">
			                    <span class="input-group-addon"> <i class="fa fa-globe"></i> EN</span>
			                </div>  
			                <div class="input-group espacios">
			                    <span class="input-group-addon">Teléfono</span>
			                    <input type="text" id="telefono" name="telefono" data-validate="false" class="form-control" placeholder="Ingresa el teléfono.." value="">			                    
			                </div>  
			                <div class="input-group espacios">
			                    <span class="input-group-addon">Teléfono Móvil</span>
			                    <input type="text" id="telMovil" name="telMovil" data-validate="false" class="form-control" placeholder="Ingresa el teléfono móvil..." value="">			                    
			                </div>   
			                <div class="input-group espacios">
			                    <span class="input-group-addon">Email</span>
			                    <input type="text" id="email" name="email" data-validate="false" class="form-control" placeholder="Ingresa el email..." value="">			                    
			                </div>        			
			                <div class="input-group espacios">
			                    <span class="input-group-addon">Ubicación</span>
			                    <input type="text" id="ubicacion" name="ubicacion" data-validate="false" class="form-control" placeholder="Ingresa la ubicación..." value="">			                    
			                </div>                 
		    			</div>
		    			<div class="modal-footer">
		    				<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
		    				<button type="button" class="buttonguardar btn-save"<?php if($seguridad->valida_permiso_usuario($_SESSION['idusuario'],$clave5)==0) echo ' disabled ';?> >Guardar y Publicar</button>
		    			</div>
		    		</div><!-- /.modal-content -->
	    		</form>	
	    	</div><!-- /.modal-dialog -->
	    </div><!-- /.modal -->
		<div class="modal fade" id="modal-edit-map">
	    	<div class="modal-dialog" role="document">
	    		<form id="form-validation2" style="display: inline" name="form2" action="operaciones.php" method="post" enctype="multipart/form-data">	    			
                   	<input type="hidden" id="operaciones" name="operaciones" value="modificarcontactomap">
                   	<input type="hidden" id="MOD" value="1">
		    		<div class="modal-content">
		    			<div class="modal-header">
		    				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
		    					<span aria-hidden="true">&times;</span>
		    					<span class="sr-only">Close</span>
		    				</button>
		    				<h4 class="modal-title">Imágen Mapa de Contacto</h4>
		    			</div>
		    			<div class="modal-body">
		    				<center class="espacios">
								PREVISUALIZAR MAPA DE CONTACTO
								<div id="preview-contacto" class="espacios">	
									<?=($temporal->rutaImgMapa != '') ? '<div style="background:url(../img/sucursal/'.$temporal->rutaImgMapa.') no-repeat; background-size:cover; height:250px;"></div>' : '<div class="preview-example"></div>'; ?>	
								</div>
								<input type="file" onchange="showMyImageWH('preview-contacto', this, '', 1, 1600, 1275)" name="imagenMap" id="" class="filestyle" data-input="false" data-buttonText="Imagen Principal" data-iconName="fa fa-picture-o" data-badge="false" data-type-file="imagen" data-validate="true" data-text="Imagen Mapa">
								<p class="help-block">Solo se aceptan imagenes con formato .JPG, .JPEG, .PNG; La imagen debe ser menor a 3 MB. <br> La resolución óptima para esta imagen es de 1600 x 1275px </p>
							</center>									    				               
		    			</div>
		    			<div class="modal-footer">
		    				<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
		    				<button type="button" data-idform="form-validation2" style="width:auto;" class="editmap btn-save submitform"<?php if($seguridad->valida_permiso_usuario($_SESSION['idusuario'],$clave5)==0) echo ' disabled ';?> >Guardar y Publicar</button>
		    			</div>
		    		</div><!-- /.modal-content -->
	    		</form>	
	    	</div><!-- /.modal-dialog -->
	    </div>
	</body>
	<footer id="footer">
		<?php include 'footer.php';?>
		<script src="js/functionsSucursal.js"></script>
	</footer>
</html>