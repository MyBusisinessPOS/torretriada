<?php
function __autoload($nombre_clase) {
    include 'clases/'.$nombre_clase .'.php';
}
$seguridad = new seguridad();
$seguridad->candado();
if(isset($_REQUEST['success'])){
	$success = $_REQUEST['success'];
	switch($success){
		case '0':
			$alert = '<div class="alert alert-danger alert-dismissable">
  						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
  						<strong>¡Error!</strong> No selecciono ningún elemento.
					  </div>';
		break;
		case '2':
			$alert = '<div class="alert alert-success alert-dismissable">
  						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
  						<strong>¡Muy bien!</strong> Se ha modificado correctamente este lote.
					  </div>';
		break;

	}
}
else{
	$success = '';
	$alert = '';
}
$lote = new lote();
$listaLote = $lote -> listaLote();
?>
<?php
include('head.html');//Contiene los estilos y los metas.
?>
	<title>Lotificación</title>
    <style type="text/css">
        .styled-select {
            width: 150px;
            background-position: 130px;
        }
        .lifiltros p{line-height: 30px;margin: 0;}
    </style>
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
                	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                		<?=$alert?>
                	</div>
                    <div class='notifications bottom-right'></div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                        <p class="titulo">Lotificación</p>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                    	<!--<form action="formprecio.php" method="post">
                    		<button <?php if($seguridad->valida_permiso_usuario($_SESSION['idusuario'],$clave)==0) echo ' disabled ';?> value="" class="buttonagregar">Configurar Precio</button>
                      </form>-->
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    	<hr class="hrmenu">
                    </div>
                    <div class="clearfix"></div>
                    <!--Sección para realizar cambios Nota: el div con la clase styled-large es la que se visualiza con lg y md-->
                    <form method="post" action="operaciones.php">
                    <div class="styled-large">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="busqueda espacios">
                                <input type="search" data-column="all" class="form-control searchSlide" placeholder="Buscar..." id="searchSlide"/>
                            </div>
                        </div>
                    </div><!--Cierra el div class styled-large-->
     				<div class="clearfix"></div>
                    <!--Esta sección es para la version movil-->
                    <div class="styled-small">
                    	<div class="col-sm-12 col-xs-12">
                        	<div class="busqueda"><input type="search" data-column="all" class="form-control searchSlide" placeholder="Buscar..." id="searchSlide"/></div>
                        </div>
                    	<div class="col-sm-12 col-xs-12">
                            <ul class="ulfiltros">
                                <li class="lifiltros">
                                    <div class="styled-select">
                                        <select>
                                          <option class="styled" >Mostrar</option>
                                          <option class="styled" >No Mostrar</option>
                                       </select>
                                    </div>
                                </li>
                                <li class="lifiltros">
                                    <button class="buttonaplicar">Aplicar</button>
                                </li>
                            </ul>
                        </div>
                    </div><!--Cierra el div class styled-small-->
                    <div class="clearfix"></div>
                    <!--Seccion de la tabla-->
                    <div class="col-lg-12" >
                        <div class="table-responsive">
                          <table id="tableSlide" class="table table-hover table-striped tablesorter">
                            <thead class="styled-thead">
                              <tr>
                              	<!--<th width="50">
                                	<input type="checkbox" id="marcar" name="marcar" onclick="marcartodos(this);" value="marcar">
									<label for="marcar"><span></span></label>
                                </th>-->
                                <th>Lote <i class="fa fa-sort manita"></i></th>
                                <th>M<sup>2</sup> <i class="fa fa-sort manita"></i></th>
                                <th>Status</th>
                              </tr>
                            </thead>
                            <tbody class="styled-tbody listaLotes" id="sortable">
                                <?php
        						foreach($listaLote as $elementoLote)
        						{
        						if($elementoLote['status'] == 1){
        						  $s_opacity = '';
        						  $s_fa = 'fa-circle';
        						}else{
        						  $s_opacity = 'opacity';
        						  $s_fa = 'fa-circle-o';
        						}
        						if($elementoLote['status'] == 2){
        						  $w_opacity = '';
        						  $w_fa = 'fa-circle';
        						}else{
        						  $w_opacity = 'opacity';
        						  $w_fa = 'fa-circle-o';
        						}
        						if($elementoLote['status'] == 3){
        						  $d_opacity = '';
        						  $d_fa = 'fa-circle';
        						}else{
        						  $d_opacity = 'opacity';
        						  $d_fa = 'fa-circle-o';
        						}
        						 echo '<tr>
        								  <!--<td>
        									  <input type="checkbox" id="'.$elementoLote['idlote'].'" name="idlote[]" value="'.$elementoLote['idlote'].'">
        									  <label for="'.$elementoLote['idlote'].'"><span></span></label>
        								  </td>-->
        								  <td><a href="formlote.php?idlote='.$elementoLote['idlote'].'">Lote '.$elementoLote['lote'].'</a></td>
        								  <td>'.$elementoLote['metrosCuadrados'].'</td>
        								  <td>';
        								  ?>
        								   <button type="button" onclick="cambiarStatus(1, <?=$elementoLote['idlote']?>, this)" class="btn btn-success btn-xs b_<?=$elementoLote['idlote']?> <?=$s_opacity?>"><i class="fa <?=$s_fa?>"></i></button>
                                            <button type="button" onclick="cambiarStatus(2, <?=$elementoLote['idlote']?>, this)" class="btn btn-warning btn-xs b_<?=$elementoLote['idlote']?> <?=$w_opacity?>"><i class="fa <?=$w_fa?>"></i></button>
                                            <button type="button" onclick="cambiarStatus(3, <?=$elementoLote['idlote']?>, this)" class="btn btn-danger btn-xs b_<?=$elementoLote['idlote']?> <?=$d_opacity?>"><i class="fa <?=$d_fa?>"></i></button>
                                          <?php echo '
        								  </td>
                                      </tr>';
        						}
                                ?>
                        	</form>
                            </tbody>
                            <tfoot class="styled-tfoot">
                              <tr>
                              	<!--<th>
                                	<input type="checkbox" id="marcar2" name="marcar2" onclick="marcartodos(this);" value="marcar2">
									<label for="marcar2"><span></span></label>
                                </th>-->
                                <th>Lote <i class="fa fa-sort manita"></i></th>
                                <th>M<sup>2</sup> <i class="fa fa-sort manita"></i></th>
                                <th>Status</th>
                              </tr>
                            </tfoot>
                          </table>
                           <div>
                        	 <!-- pager -->
                            <div id="pager" class="pager">
                              <form>
                                <img src="img/first.png" class="first"/>
                                <img src="img/prev.png" class="prev"/>
                                <span class="pagedisplay"></span> <!-- this can be any element, including an input -->
                                <img src="img/next.png" class="next"/>
                                <img src="img/last.png" class="last"/>
                                <select class="pagesize">
                                  <option value="5">5</option>
                                  <option value="10">10</option>
                                  <option value="20">20</option>
                                  <option value="50">50</option>
                                </select>
                              </form>
                            </div>
                        </div>
                        </div><!--Div de cierre de la clase table-responsive-->

                    </div><!--Div de cierre que contiene las tablas-->
                    <!--Sección del pie de pagina-->
                    <footer id="footer">
                    	<div class="col-lg-12 text-center">
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
include('javascripts.html');
?>
<script>
function cambiarStatus(b_status,b_id,obj){
    $.ajax({
      async:true,
      type: "POST",
      dataType: "html",
      contentType: "application/x-www-form-urlencoded",
      url:"operaciones.php",
      data:"b_id="+b_id+"&b_status="+b_status+"&operaciones=cambiarStatusBatch",
      success:function(data){
          $('.b_'+b_id).addClass('opacity').html('<i class="fa fa-circle-o"></i>');
          $(obj).removeClass('opacity').html('<i class="fa fa-circle"></i>');
      },
      cache:false
    });
  }
</script>
</body>
</html>
