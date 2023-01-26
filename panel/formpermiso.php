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
    $secciones = $temporal -> listarSecciones();
	$clave='ModPer';
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <?php include 'head.php';?>
        <title>Formulario | SEO</title>
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
                        <!--Seccion del titulo y el boton de agregar-->
                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <p class="titulo"><?php echo $palabra;?></p>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    	<form id="form-validation" action="operaciones.php" method="post" name="form1" onsubmit="return validar_campos()">
                    		<input type="hidden" name="idpermiso" value="<?php echo $temporal->idpermiso ?>"/>
                    		<input type="hidden" name="status" value="<?php echo $temporal->status; ?>" />
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
                    <div class="col-md-8 col-md-offset-2 col-sm-12 col-xs-12">                    	
                        <div id="msgtitulo" class="input-group espacios">
                            <span class="input-group-addon es">Nombre Permiso</span>
                            <input type="text"  name="titulo" class="form-control" placeholder="Ingresa el nombre aquí..." value="<?=$temporal->nompermiso?>">
                        </div>
                        <div id="msgclave" class="input-group espacios">
                            <span class="input-group-addon es">Clave Permiso</span>
                            <input type="text"  name="clave" class="form-control" placeholder="Ingresa la Clave aquí..." value="<?=$temporal->clavepermiso?>">
                        </div>
                        <div id="msgseccion" class="input-group espacios">
                            <span class="input-group-addon es">Seccion Permiso</span>
                            <select name="idSeccionPermiso" class="form-control">
                        <?php
                            foreach ($secciones as $seccion){
                                ($temporal -> idSeccionPermiso == $seccion['idSeccionPermiso']) ? $select = ' selected' : $select = '';
                        ?>
                                <option <?=$select?> value="<?=$seccion['idSeccionPermiso']?>"><?=$seccion['nombreSeccion']?></option>
                        <?php
                            }
                        ?>
                                
                            </select>
                        </div>
                    </div><!--Div de cierre col-lg-7-->               
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
                </div>
            </div>
        </div>
    </body>
    <footer id="footer">
        <?php include 'footer.php';?>
        <script type="text/javascript" src="js/tags/jquery.tagsinput.js"></script>
        <script src="js/functionsSEO.js"></script>
    </footer>
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
</html>
