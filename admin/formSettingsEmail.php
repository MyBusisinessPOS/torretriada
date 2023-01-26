<?php
function __autoload($nombre_clase) {
    //$nombre_clase = strtolower($nombre_clase);
    include 'clases/'.$nombre_clase .'.php';
}
	$seguridad = new seguridad();
	$seguridad->candado();

	$operacion = 'modificarsettingsEmail';
	$palabra = 'Configurar Email';
	$temporal = new settingsEmail();
	$temporal -> obtener_settingsEmail();
	$clave = 'ModSE';
?>
<?php
include('head.html');//Contiene los estilos y los metas.
?>
    <title>Formulario Email</title>
<?php
include('header.html');//contiene las barras de arriba y los menus.
include('menu.php');
?>
<style type="text/css">
    div.tagsinput {
        border: 1px solid #CCC;
        background: #FFF none repeat scroll 0% 0%;
        padding: 5px;
        width: 100% !important;
        height: 100px;
        overflow-y: auto;
    }
    div.tagsinput span.tag {
        border: 1px solid #DDD;
        display: block;
        float: left;
        padding: 5px;
        text-decoration: none;
        background: #F4F4F4 none repeat scroll 0% 0%;
        color: #555;
        margin-right: 5px;
        margin-bottom: 5px;
        font-family: helvetica;
        font-size: 13px;
    }
    div.tagsinput input {
        margin: 0px 5px 5px 0px;
        font-family: helvetica;
        font-size: 13px;
        border: 1px solid transparent;
        padding: 5px;
        background: transparent none repeat scroll 0% 0%;
        color: #000;
        outline: 0px none;
    }
</style>
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
                    	<form id="form-validation" action="operaciones.php" method="post" name="form1" onsubmit="">
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
                        <div class='notifications bottom-right'></div>
                    </div>
                    <div class="col-lg-8 col-lg-offset-2 col-md-8 col-md-offset-2 col-sm-12 col-xs-12">
                        <div id="msghost" class="input-group espacios">
                            <span class="input-group-addon es"><i class="fa fa-server"></i>Host</span>
                            <input type="text"  name="host" class="form-control" placeholder="Ingrese el host aquí" value="<?=$temporal->host?>">
                        </div>
                        <div id="msgport" class="input-group espacios">
                            <span class="input-group-addon es"><i class="fa fa-server"></i>Port</span>
                            <input type="text"  name="port" class="form-control" placeholder="Ingrese el puerto aquí" value="<?=$temporal->port?>">
                        </div>
                        <div id="msgusername" class="input-group espacios">
                            <span class="input-group-addon es"><i class="fa fa-server"></i>Usuario</span>
                            <input type="text"  name="username" class="form-control" placeholder="Ingrese el usuario aquí" value="<?=$temporal->username?>">
                        </div>
                        <div id="msgpassword" class="input-group espacios">
                            <span class="input-group-addon es"><i class="fa fa-server"></i>Contraseña</span>
                            <input type="password"  name="password" class="form-control" placeholder="Ingrese el password aquí" value="<?=$temporal->password?>">
                        </div>
                        <div id="msgnoReply" class="input-group espacios">
                            <span class="input-group-addon es"><i class="fa fa-server"></i>Correo No Reply</span>
                            <input type="text"  name="noReply" class="form-control" placeholder="Ingrese el correo aquí" value="<?=$temporal->noReply?>">
                        </div>
                        <div id="msgfromname" class="input-group espacios">
                            <span class="input-group-addon es"><i class="fa fa-server"></i>Nombre Emisor</span>
                            <input type="text"  name="fromname" class="form-control" placeholder="Ingrese el nombre aquí, ej: Empresa " value="<?=$temporal->fromname?>">
                        </div>
                        <div id="msgaddCC"  class="input-group espacios">
                            <span class="input-group-addon es"><i class="fa fa-server"></i>Copia a</span>
                            <input type="text" name="addCC" id="tags"  placeholder="Ingrese los correos aquí, separe con una ','" value="<?=$temporal->addCC?>">
                        </div>

                        <center>
                            <div  data-toggle="modal" data-target="#myModal" class="btn btn-warning">Test Correo</div>
                        </center>
                        </br>
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
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">PRUEBA CORREOS</h4>
      </div>
      <div class="modal-body">
        <div id="msgCorreoPrueba" class="input-group espacios">
            <span class="input-group-addon es"><i class="fa fa-server"></i>Correo Prueba</span>
            <input type="email" id="correoPrueba"  name="correoPrueba" class="form-control">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-success" id="sendCorreo">Enviar</button>
      </div>
    </div>
  </div>
</div>

<?php
include 'javascripts.html';
?>
<script type="text/javascript" src="js/tags/jquery.tagsinput.js"></script>
<script>
    $('#tags').tagsInput({
         'defaultText':'Añadir Email',
         'width':'500px'
    });
    $('#sendCorreo').click(function(event) {
        var correo = $('#correoPrueba').val();
        $.ajax({
            async:true,
            type: "POST",
            dataType: "html",
            contentType: "application/x-www-form-urlencoded",
            url:"operaciones.php",
            data:{"operaciones":"pruebaCorreo", "email":correo},
            success:function(data){
                console.log(data);
                if(data == 1){
                    $('.bottom-right').notify({
                        message: { text: 'Envio Correcto' },
                        type:'blackgloss',
                        fadeOut: { enabled: true, delay: 2000 }
                    }).show();
                }else{
                   $('.bottom-right').notify({
                        message: { text: 'Ocurrio un problema; Error:'+data},
                        type:'blackgloss',
                        fadeOut: { enabled: true, delay: 2000 }
                    }).show();
                }

            },
            cache:false
        });
    });
	</script>
</body>
</html>
