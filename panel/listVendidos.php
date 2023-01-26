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

$temporal = new proyectosvendidos();
$listaTemporal = $temporal -> listVendido(1, false, '', '', 20, 'es', false);


$clave = 'p_add_vendido';
$clave2 = 'p_del_vendido';
$clave3 = 'p_acdc_vendido';
$clave4 = 'p_sort_vendido';
$clave5 = 'p_mod_vendido';
$sort = "vendido";
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
$opera_list = 'listarVendido';
$_lastPage = count($listaTemporal)-1;
$_de = $listaTemporal[$_lastPage]['orden'];
?>
<!DOCTYPE html>
<html lang="es">
	<head>
		<?php include 'head.php';?>
		<title>Lista | Vendidos</title>
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
	                        <p class="titulo">Vendidos</p>
	                    </div>
	                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">

	                    	<form action="formVendido.php" method="post">
	                    		<button type="button" <?php if($seguridad->valida_permiso_usuario($_SESSION['idusuario'],$clave)==0) echo ' disabled ';?> value="" class="buttonagregar">Agregar Nuevo</button>
	                    		<!--<button type="button" <?php if($seguridad->valida_permiso_usuario($_SESSION['idusuario'],$clave)==0) echo ' disabled ';?> value="" class="editmap" style="margin-right: 20px;">Editar Mapa</button>-->
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
		                                    <button type="submit" class="buttonaplicar" name="operaciones" value="operavendido">Aplicar</button>
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
			                                <th width="150px">Título</th>  
			                                <th>Subtitulo</th> 
			                                <th>Descripción</th> 			                                
			                                <th class="text-center">Destacado</th>		                                                    
			                                <th class="text-center">Mostrar</th>
			                              </tr>
			                            </thead>
			                            <tbody class="styled-tbody" id="sortable">
			                    <?php
									foreach($listaTemporal as $elementoTemporal){
										$temporal -> getVendidoEn($elementoTemporal['id_vendido'],'en');	
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
												$funcion='changeStatus('.$elementoTemporal['id_vendido'].',0,\'changeStatusVendido\')';
												$class = 'nover';
											}
											else{
										  		$img='img/invisible.png';
												$funcion='changeStatus('.$elementoTemporal['id_vendido'].',1,\'changeStatusVendido\')';
												$class = 'ver';
										   }
										}
										if($elementoTemporal['destacado'] != 0){
											$_fa = 'fa-toggle-on';
											$_funcion = 'changeDestacado('.$elementoTemporal['id_vendido'].',0,\'changeDestacadoVendido\')';
										}else{
											$_fa = 'fa-toggle-off';
											$_funcion = 'changeDestacado('.$elementoTemporal['id_vendido'].',1,\'changeDestacadoVendido\')';
										}
									?>	
											<tr>
				                              	<td>
				                                 	<input type="hidden" name="idorden" class="idorden" value="<?=$elementoTemporal['id_vendido']?>">
				                                	<input type="checkbox" id="<?=$elementoTemporal['id_vendido']?>" name="id_vendido[]" value="<?=$elementoTemporal['id_vendido']?>">
													<label for="<?=$elementoTemporal['id_vendido']?>"><span></span></label>
				                                </td>
				                               	<td>
				                                	<div class="edit manita" data-id="<?=$elementoTemporal['id_vendido']?>" data-titulo="<?=$elementoTemporal['titulo']?>" data-subtitulo="<?=$elementoTemporal['subtitulo']?>" data-descripcion="<?=$elementoTemporal['descripcion']?>" data-tituloen="<?=$temporal->_titulo?>" data-subtituloen="<?=$temporal->_subtitulo?>" data-descripcionen="<?=$temporal->_descripcion?>">
				                                		<?=$elementoTemporal['titulo']?>
				                                	<div>
				                                </td>     
				                                <td>
				                                	<div class="edit manita" data-id="<?=$elementoTemporal['id_vendido']?>" data-titulo="<?=$elementoTemporal['titulo']?>" data-subtitulo="<?=$elementoTemporal['subtitulo']?>" data-descripcion="<?=$elementoTemporal['descripcion']?>" data-tituloen="<?=$temporal->_titulo?>" data-subtituloen="<?=$temporal->_subtitulo?>" data-descripcionen="<?=$temporal->_descripcion?>">
				                                		<?=$elementoTemporal['subtitulo']?>
				                                	<div>
				                                </td>  
				                                <td><?=$elementoTemporal['descripcion']?></td>				                                
				                                <td class="text-center">
				                                	<span class="btn btn-default btn-xs"><i id="dest<?=$elementoTemporal['id_vendido']?>" class="fa <?=$_fa?>" onclick="<?=$_funcion?>"></i><span>
				                                </td>				                                             
				                                <td class="text-center">
				                                	<?=$handle?>				                                	
				                                	<img class="manita <?=$class?>" onclick="<?=$funcion?>" id="temp<?=$elementoTemporal['id_vendido']?>" src="<?=$img?>">
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
				                                <th width="150px">Título</th>  
				                               	<th>Subtitulo</th> 
				                                <th>Descripción</th>                             
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
		    				<div class="input-group espacios">
			                    <span class="input-group-addon">Título</span>
			                    <input type="text" id="tituloEs" name="titulo[es]" data-validate="false" class="form-control" placeholder="Ingresa el título..." value="">
			                    <span class="input-group-addon"> <i class="fa fa-globe"></i> ES</span>
			                </div>
			                <div class="input-group espacios">
			                    <span class="input-group-addon">Subtitulo</span>
			                    <input type="text" id="subtituloEs" name="subtitulo[es]" data-validate="false" class="form-control" placeholder="Ingresa el título..." value="">
			                    <span class="input-group-addon"> <i class="fa fa-globe"></i> EN</span>
			                </div>
			                <div class="input-group espacios">
			                    <span class="input-group-addon">Descripcion</span>
			                    <textarea type="text" id="descripcionEs" name="descripcion[es]" data-validate="false" class="form-control" placeholder="Ingresa la descripción..."></textarea>
			                    <span class="input-group-addon"> <i class="fa fa-globe"></i> ES</span>
			                </div>	
							<br><br>
			                <div class="input-group espacios">
			                    <span class="input-group-addon">Título</span>
			                    <input type="text" id="tituloEn" name="titulo[en]" data-validate="false" class="form-control" placeholder="Ingresa el título..." value="">
			                    <span class="input-group-addon"> <i class="fa fa-globe"></i> EN</span>
			                </div>   
			                <div class="input-group espacios">
			                    <span class="input-group-addon">Subtitulo</span>
			                    <input type="text" id="subtituloEn" name="subtitulo[en]" data-validate="false" class="form-control" placeholder="Ingresa el título..." value="">
			                    <span class="input-group-addon"> <i class="fa fa-globe"></i> EN</span>
			                </div>             
			                <div class="input-group espacios">
			                    <span class="input-group-addon">Descripción</span>
			                    <textarea type="text" id="descripcionEn" name="descripcion[en]" data-validate="false" class="form-control" placeholder="Ingresa el subtitulo..."></textarea>
			                    <span class="input-group-addon"> <i class="fa fa-globe"></i> EN</span>
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
		
	</body>
	<footer id="footer">
		<?php include 'footer.php';?>
		<script type="text/javascript">
			initSummernote('descripcionEs');
			initSummernote('descripcionEn');
		</script>
		<script src="js/functionsVendidos.js"></script>
	</footer>
</html>