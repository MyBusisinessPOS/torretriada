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

(isset($_REQUEST['tipo'])) ? $_tipo = $_REQUEST['tipo'] : $_tipo = 1;


$temporal = new categoria();
$listaTemporal = $temporal -> listCategoria($_tipo ,1, false);
//echo '<pre>';
//print_r($listaTemporal);
//echo '</pre>';
if($_tipo == 1 OR $_tipo == 5 OR $_tipo==6 OR $_tipo==7){
	$clave = 'p_add_categoria';
	$clave2 = 'p_del_categoria';
	$clave3 = 'p_acdc_categoria';
	$clave4 = 'p_sort_categoria';
	$clave5 = 'p_mod_categoria';
	if($_tipo==1){
		$title='Familias';		
		$lsCats = $temporal -> listCategoria(5 ,1, false,1,'',20,'es',false);
		$lsCatsAsig = $temporal -> listCategoria(5 ,1, false,1,'',20,'es',false,1);;
	}else if($_tipo==5){
		$title='Categorías';		
		$lsCats = $temporal -> listCategoria(6 ,1, false,1,'',20,'es',false);
		$lsCatsAsig = $temporal -> listCategoria(6 ,1, false,1,'',20,'es',false,1);;
	}else if($_tipo==6){
		$title='Subcategorías';
		$lsCats='';
	}else if($_tipo==7){
		$title='Categorías Manual';
		$lsCats='';
	}
}else if($_tipo == 2 OR $_tipo==4){
	$clave = 'p_add_categoria_proyecto';
	$clave2 = 'p_del_categoria_proyecto';
	$clave3 = 'p_acdc_categoria_proyecto';
	$clave4 = 'p_sort_categoria_proyecto';
	$clave5 = 'p_mod_categoria_proyecto';
	($_tipo==2) ? $title= 'Años' : $title='Categoría Proyecto';
}else if($_tipo == 3){
	$clave = 'p_add_categoria_blog';
	$clave2 = 'p_del_categoria_blog';
	$clave3 = 'p_acdc_categoria_blog';
	$clave4 = 'p_sort_categoria_blog';
	$clave5 = 'p_mod_categoria_blog';
	$title= 'Categoría Blog';
}
$sort = "categoria";
$handle = "";
if($seguridad->valida_permiso_usuario($_SESSION['idusuario'],$clave4)==0){
  $handle = "";
  $permiso = "<input type='hidden' id='valorpermiso' name='permiso' value='0'>";
}else{
  $handle = '<span class="fa-stack fa-1x mover handle"><i class="fa fa-circle fa-stack-2x"></i><i class="fa fa-arrows fa-stack-1x fa-inverse"></i></span>';
  $permiso = "<input type='hidden' id='valorpermiso' name='permiso' value='1'>";
}
($seguridad->valida_permiso_usuario($_SESSION['idusuario'],$clave3)==0) ? $permisoAcDc = 0 : $permisoAcDc = 1;
//variable global para el paginador;
$opera_list = 'listarCategoria';
$_lastPage = count($listaTemporal)-1;
$_de = $listaTemporal[$_lastPage]['orden'];
?>
<!DOCTYPE html>
<html lang="es">
	<head>
		<?php include 'head.php';?>
		<title>Lista | Categoría</title>
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
	                        <p class="titulo"><?=$title?></p>
	                    </div>
	                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
	                    	<form action="formCategoria.php" method="post">
	                    		<button type="button" <?php if($seguridad->valida_permiso_usuario($_SESSION['idusuario'],$clave)==0) echo ' disabled ';?> value="" class="buttonagregar">Agregar Nuevo</button>
	                        </form>   
	                    </div>
	                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
	                    	<hr class="hrmenu">
	                    </div>
	                    <div class="clearfix"></div>
	                    <!--Sección para realizar cambios Nota: el div con la clase styled-large es la que se visualiza con lg y md-->
                    	<form method="post" action="operaciones.php">
                    		<input type="hidden" id="permisoAcDc" value="<?=$permisoAcDc?>">
                    		<input type="hidden" name="tipo" value="<?=$_tipo?>">
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
		                                    <button type="submit" class="buttonaplicar" name="operaciones" value="operacategoria">Aplicar</button>
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
			                                <th>Titulo</th>                      
			                                <th class="text-center">Mostrar</th>
			                              </tr>
			                            </thead>
			                            <tbody class="styled-tbody" id="sortable">
			                            	
			                            	<input type="hidden" id="listCategorias" value='<?=json_encode($lsCats)?>'>
			                            	
			                            	
			                            	<input type="hidden" id="listCategoriasAsig" value='<?=json_encode($lsCatsAsig)?>'>
			                            	
			                            	
			                    <?php
									foreach($listaTemporal as $elementoTemporal){
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
												$funcion='changeStatus('.$elementoTemporal['idCategoria'].',0,\'changeStatusCategoria\')';
												$class = 'nover';
											}
											else{
										  		$img='img/invisible.png';
												$funcion='changeStatus('.$elementoTemporal['idCategoria'].',1,\'changeStatusCategoria\')';
												$class = 'ver';
										   }
										}
									?>	
											<tr>
				                              	<td>
				                                 	<input type="hidden" name="idorden" class="idorden" value="<?=$elementoTemporal['idCategoria']?>">
				                                	<input type="checkbox" id="<?=$elementoTemporal['idCategoria']?>" name="idCategoria[]" value="<?=$elementoTemporal['idCategoria']?>">
													<label for="<?=$elementoTemporal['idCategoria']?>"><span></span></label>
				                                </td>
				                               
				                                <td>
				                                	<div class="edit manita" data-id="<?=$elementoTemporal['idCategoria']?>" data-tituloEs="<?=$elementoTemporal['tituloEs']?>" data-tituloEn="<?=$elementoTemporal['tituloEn']?>" data-ruta="<?=$elementoTemporal['rutaImg']?>" data-ruta2 ="<?=$elementoTemporal['rutaImg2']?>" data-cat='<?=$elementoTemporal['categorias']?>' data-asig='<?=$elementoTemporal['catAsig']?>'>
				                                		<?=$elementoTemporal['tituloEs']?> - <?=$elementoTemporal['tituloEn']?>
				                                	<div>
				                                </td>                   
				                                <td class="text-center">

				                                	<?=$handle?>				                                	
				                                	<img class="manita <?=$class?>" onclick="<?=$funcion?>" id="temp<?=$elementoTemporal['idCategoria']?>" src="<?=$img?>">
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
				                                <th>Titulo</th>                        
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
	    			<input type="hidden" id="tipo" name="tipo" value="<?=$_tipo?>">
                   	<input type="hidden" id="operaciones" name="operaciones" value="">
                   	<input type="hidden" id="MOD" value="1">
		    		<div class="modal-content">
		    			<div class="modal-header">
		    				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
		    					<span aria-hidden="true">&times;</span>
		    					<span class="sr-only">Close</span>
		    				</button>
		    				<h4 class="modal-title"></h4>
		    			</div>
		    			<div class="modal-body">
		    				<?php
		    				if($_tipo==1 OR $_tipo == 5 OR $_tipo==6){
		    				?>
							<center>
		    					<div id="preview-categoria">		    								    						
		    					</div>
		    					<br>
		    					<input type="file" onchange="showMyImageWH('preview-categoria', this, '', 1, 1600, 1275)" name="imagen" id="" class="filestyle" data-input="false" data-buttonText="Imagen Categoría" data-iconName="fa fa-picture-o" data-badge="false" data-type-file="imagen" data-validate="true" data-text="Imagen Categoría" class="form-control">
								<p class="help-block">Solo se aceptan imagenes con formato .JPG, .JPEG, .PNG; La imagen debe ser menor a 3 MB. <br> La resolución óptima para esta imagen es de 1600 x 1275px </p>
		    				</center>
		    				<?php
		    				}
		    				if($_tipo==5 OR $_tipo==6){
		    				?>
		    				<center>
		    					<div id="preview-categoria2">		    								    						
		    					</div>
		    					<br>
		    					<input type="file" onchange="showMyImageWH('preview-categoria2', this, '', 1, 1600, 1275)" name="imagen2" id="" class="filestyle" data-input="false" data-buttonText="Imagen Categoría 2" data-iconName="fa fa-picture-o" data-badge="false" data-type-file="imagen" data-validate="true" data-text="Imagen Categoría" class="form-control">
								<p class="help-block">Solo se aceptan imagenes con formato .JPG, .JPEG, .PNG; La imagen debe ser menor a 3 MB. <br> La resolución óptima para esta imagen es de 1600 x 1275px </p>
		    				</center>
		    				<?php
		    				}
		    				?>		    				
		    				<div class="input-group espacios">
			                    <span class="input-group-addon">TituloEs</span>
			                    <input type="text" id="tituloEs" name="tituloEs" data-validate="true" class="form-control" placeholder="Ingresa el titulo en español de la categoria..." value="">
			                </div>
			                <div class="input-group espacios">
			                    <span class="input-group-addon">TituloEn</span>
			                    <input type="text" id="tituloEn" name="tituloEn" data-validate="true" class="form-control" placeholder="Ingresa el titulo en ingles de la categoria.." value="">
			                </div>
			                <?php
		    				if($_tipo==1 OR $_tipo == 5){
		    					if($_tipo==1){
		    						$opc = 'Categorías';
		    					}else if($_tipo==5){
		    						$opc = 'Subcategorías';
		    					}else{
		    						$opc='';
		    					}
		    				?>
		    				<div class="input-group espacios">
		    					<span class="input-group-addon">Categorías</span>
		    					<select name="categorias[]" id="selectcategorias" data-title="Selecciona las <?=$opc?>" class="selectpicker" multiple>		    						
			    					
			    				</select>
		    				</div>		    				
		    				<?php
		    				}
		    				?>
		    			</div>
		    			<div class="modal-footer">
		    				<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
		    				<button type="button" <?php if($seguridad->valida_permiso_usuario($_SESSION['idusuario'],$clave5)==0) echo ' disabled ';?> class="buttonguardar btn-save">Guardar y Publicar</button>
		    			</div>
		    		</div><!-- /.modal-content -->
	    		</form>	
	    	</div><!-- /.modal-dialog -->
	    </div><!-- /.modal -->	    
	</body>
	<footer id="footer">
		<?php include 'footer.php';?>
		<script src="js/functionsCategoria.js"></script>
	</footer>
</html>