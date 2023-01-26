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
$temporal = new blog();
$listaTemporal = $temporal -> listBlog();
$clave = 'p_add_blog';
$clave2 = 'p_del_blog';
$clave3 = 'p_acdc_blog';
$clave4 = 'p_sort_blog';
$sort = "blog";
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
$opera_list = 'listarBlog';
$_lastPage = count($listaTemporal)-1;
$_de = $listaTemporal[$_lastPage]['orden'];
?>
<!DOCTYPE html>
<html lang="es">
	<head>
		<?php include 'head.php';?>
		<title>Lista | Blog</title>
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
	                        <p class="titulo">Blog</p>
	                    </div>
	                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
	                    	<form action="formBlog.php" method="post">
	                    		<button <?php if($seguridad->valida_permiso_usuario($_SESSION['idusuario'],$clave)==0) echo ' disabled ';?> value="" class="buttonagregar">Agregar Nuevo</button>
	                        </form>
	                    </div>
	                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
	                    	<hr class="hrmenu">
	                    </div>
	                    <div class="clearfix"></div>
	                    <!--Sección para realizar cambios Nota: el div con la clase styled-large es la que se visualiza con lg y md-->
                    	<form method="post" action="operaciones/operaciones_blog.php">
                    		<input type="hidden" id="permisoAcDc" value="<?=$permisoAcDc?>">
                    		<div class="styled-large">
		                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		                            <ul class="ulfiltros">
		                                <li class="lifiltros">
		                                    <div class="styled-select">
		                                        <select name="operador">
		                                          <option class="styled" <?php if($seguridad->valida_permiso_usuario($_SESSION['idusuario'],$clave2)==0) echo ' disabled ';?>>Eliminar</option>
		                                          <option class="styled" <?php if($seguridad->valida_permiso_usuario($_SESSION['idusuario'],$clave3)==0) echo ' disabled ';?>>Mostrar</option>
		                                          <option class="styled" <?php if($seguridad->valida_permiso_usuario($_SESSION['idusuario'],$clave3)==0) echo ' disabled ';?>>No Mostrar</option>
		                                       </select>
		                                    </div>
		                                </li>
		                                <li class="lifiltros">
		                                    <button type="submit" class="buttonaplicar" name="operaciones" value="operablog">Aplicar</button>
		                                </li>
		                            </ul>
		                            <div class="busqueda espacios"><input type="text" onkeyup="buscar(this.value)" class="form-control search" placeholder="Buscar..."></div>
		                        </div>
		                    </div><!--Cierra el div class styled-large-->
		                    <div class="clearfix"></div>
		                    <!--Esta sección es para la version movil-->
		                    <div class="styled-small">
		                    	<div class="col-sm-12 col-xs-12">
		                        	<div class="busqueda"><input type="text" onkeyup="buscar(this.value)" class="form-control search" placeholder="Buscar..."></div>
		                        </div>
		                    	<div class="col-sm-12 col-xs-12">
		                            <ul class="ulfiltros">
		                                <li class="lifiltros">
		                                    <div class="styled-select">
		                                        <select>
		                                          <option class="styled" <?php if($seguridad->valida_permiso_usuario($_SESSION['idusuario'],$clave2)==0) echo ' disabled ';?>>Eliminar</option>
		                                          <option class="styled" <?php if($seguridad->valida_permiso_usuario($_SESSION['idusuario'],$clave3)==0) echo ' disabled ';?>>Mostrar</option>
		                                          <option class="styled" <?php if($seguridad->valida_permiso_usuario($_SESSION['idusuario'],$clave3)==0) echo ' disabled ';?>>No Mostrar</option>
		                                       </select>
		                                    </div>
		                                </li>
		                                <li class="lifiltros">
		                                    <button type="submit" class="buttonaplicar" name="operaciones" value="operablog">Aplicar</button>
		                                </li>
		                            </ul>
		                        </div>
		                    </div><!--Cierra el div class styled-small-->
		                    <div class="clearfix"></div>
		                    <!--Seccion de la tabla-->
		                    <div class="col-lg-12">
		                        <?php echo $permiso;?>
		                        <div class="table-responsive">
			                        <table id="table-long" class="table table-hover table-striped tablesorter">
			                            <thead class="styled-thead">
			                              <tr>
			                              	<th width="50">
			                                	<input type="checkbox" id="marcar" name="marcar" onclick="marcartodos(this);" value="marcar">
												<label for="marcar"><span></span></label>
			                                </th>
			                                <th width="100"></th>
			                                <th>Título</th>
			                                <th>Fecha Creación</th>
			                                <th class="text-center">Mostrar</th>
			                              </tr>
			                            </thead>
			                            <tbody class="styled-tbody" id="sortableBlog">
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
												$funcion='changeStatusBlog('.$elementoTemporal['id_blog'].',0,\'changeStatusBlog\')';
												$class = 'nover';
											}
											else{
										  		$img='img/invisible.png';
												$funcion='changeStatusBlog('.$elementoTemporal['id_blog'].',1,\'changeStatusBlog\')';
												$class = 'ver';
										   }
										}
									?>
											<tr>
				                              	<td>
				                                 	<input type="hidden" name="idorden" class="idorden" value="<?=$elementoTemporal['id_blog']?>">
				                                	<input type="checkbox" id="<?=$elementoTemporal['id_blog']?>" name="id_blog[]" value="<?=$elementoTemporal['id_blog']?>">
													<label for="<?=$elementoTemporal['id_blog']?>"><span></span></label>
				                                </td>
				                                <td>
				                                	<a href="formBlog.php?id_blog=<?=$elementoTemporal['id_blog']?>"><img class="img-responsive" src="../img/blog/<?=$elementoTemporal['ruta']?>"></a>
				                                </td>
				                                <td>
				                                	<a href="formBlog.php?id_blog=<?=$elementoTemporal['id_blog']?>">
				                                		<?=$elementoTemporal['titulo']?>
				                                	</a>
				                                </td>
				                                <td><?=$elementoTemporal['fecha_creacion']?></td>
				                                <td class="text-center">
				                                	<?=$handle?>
				                                	<img class="manita <?=$class?>" onclick="<?=$funcion?>" id="temp<?=$elementoTemporal['id_blog']?>" src="<?=$img?>">
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
			                               	 	<th></th>
				                                <th>Título</th>
				                                <th>Fecha Creación</th>
			                                	<th class="text-center">Mostrar</th>
			                              	</tr>
			                            </tfoot>
			                        </table>
			                       	<!-- pager -->
			                        <div id="paginador">
			                            <center>
			                            	<input type="hidden" id="initfor" value="<?=$_de?>">
			                              	<img src="img/first.png" class="first off"/>
			                              	<img src="img/prev.png" class="prev off"/>
			                              	<?php
			                              		if(!empty($listaTemporal)){
				                                	for ($i=1; $i <= 4; $i++) {
				                                  		if($listaTemporal[0]['pagina'] == $i){
				                                    		echo '<span class="pages actual" data-actual="'.$i.'" onclick="listar('.$i.')"> '.$i.' </span>';
				                                  		}else if($listaTemporal[0]['ultimapagina'] >= $i){
				                                    		echo '<span class="pages" onclick="listar('.$i.')"> '.$i.' </span>';
				                                  		}
				                                	}

				                                	if($listaTemporal[0]['ultimapagina'] == $listaTemporal[0]['pagina']){
				                                  		echo '<img src="img/next.png" class="next off"/>';
				                                  		echo '<img src="img/last.png" class="last off" data-last="'.$listaTemporal[0]['ultimapagina'].'"/>';
				                                	}else{
				                                  		echo '<img src="img/next.png" class="next" onclick="listar('.$listaTemporal[0]['paginasiguiente'].')"/>';
				                                  		echo '<img src="img/last.png" class="last" data-last="'.$listaTemporal[0]['ultimapagina'].'" onclick="listar('.$listaTemporal[0]['ultimapagina'].')"/>';
				                                	}
			                                	}
			                              ?>
			                            </center>
			                        </div>
			                    </div>
		                	</div><!--Div de cierre de la clase table-responsive-->
                    	</form>
            		</div>
            	</div>
	        </div>
	    </div>
	</body>
	<footer id="footer">
		<?php include 'footer.php';?>
	</footer>
</html>
