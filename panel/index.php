<?php
	if(isset($_REQUEST['success'])){
		$success = $_REQUEST['success'];
		switch($success){
			case '0':
				$alert="<div class='alert alert-danger alert-dismissable'>
					<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
					<p><strong>!Advertencia!</strong> El nombre de usuario o la contraseña son incorrectas.</p>
				</div>";
			break;
			case '3':
				$alert="<div class='alert alert-success alert-dismissable'>
					<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
					<p><strong>MUY BIEN</strong> Usted ha recuperado su contraseña con éxito. Ingrese al sistema.</p>
				</div>";
			break;
		}
	}
	else
		$alert='';
	$meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Panel Slogan Publicidad">
    <meta name="author" content="Carlos David Baas Santiago">

    <title>Login</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/styles.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,300,700,700italic' rel='stylesheet' type='text/css'>

    <!-- Add custom CSS here -->
    <link href="css/simple-sidebar.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!--<link href="js/summernote/summernote.css" rel="stylesheet">-->

</head>

<body>
	<!--Sección de la cabezera-->
	<header>
    	<!--Header que se muestra en las clases lg y md-->
    	<div class="styled-large">
            <div id="navBlack" class="jumbotron navbar-fixed-top">
                <div class="col-lg-4 col-md-4 col-sm-3 col-xs-3">
                    <img id="imgLogo" class="imgNavBlack" src="img/Slogan_logo.svg">
                    <spam id="urlLocker">sloganpublicidad.com</spam>
                </div>
                <div class="col-lg-8 col-md-8 col-sm-9 col-xs-9">
                    <p id="fecha"><?php echo date('d')." ".$meses[date('n')-1]. " ".date('Y') ;?></p>
                </div>
            </div>
            <div id="navBlue" class="jumbotron navbar-fixed-top">
                <div class="col-lg-1 col-md-2">
                    <div id="barraazul">
                        <p id="panel">PANEL DE CONTROL</p>
                    </div>
                </div>
                <div class="col-lg-11 col-md-10">
                    <p class="urlweb">Bienvenido al panel de control</p>
                </div>
            </div>
        </div>
        <!--Header que se muestra en las clases sm y xs-->
        <div class="styled-small">
        	<div id="navBlack" class="jumbotron navbar-fixed-top">
                <div class="col-sm-12 col-xs-12">
                	<img id="imgLogo" class="imgNavBlack" src="img/Slogan_logo.svg">
                </div>
            </div>
            <div id="navBlueMovil" class="jumbotron navbar-fixed-top">
            	<p id="panel">PANEL DE CONTROL</p>
            </div>
            <div id="navBlueMovil2" class="jumbotron navbar-fixed-top">
            	 <p class="urlweb">Bienvenido al panel de control</p>
            </div>
        </div>
    </header>
    <!--Es el que contiene a toda la pagina-->
    <div id="wrapperlogin">
        <!-- Page content Sección del contenido de la pagina-->
        <div id="page-content-wrapper" class="wrapperlogin-movil">

            <!-- Keep all page content within the page-content inset div! -->
            <div class="page-content">
                <div class="row rowlogin">
                	<!--Seccion del form para agregar-->

                    <div class="col-lg-4 col-md-4 col-lg-offset-4 col-md-offset-4 col-sm-6 col-sm-offset-3 col-xs-12" id="positiondiv">
                    	<div class="row">
                        	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        		<?=$alert?>
                            	<p class="login">Login</p>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    			<hr class="hrmenu">
                    		</div>
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <form method="post" action="operaciones.php">
                            	<div id="titulo" class="form-group espacios">
                        			<input type="text" name="usuario" class="form-control" placeholder="Usuario" value="">
                        		</div>
                                <div id="pass" class="form-group espacios">
                        			<input type="password" name="pass" class="form-control" placeholder="Contraseña" value="">
                        		</div>
                                <div class="text-center">
                                	<button type="submit"  name="operaciones" value="ingresar" class="buttonacceder">Acceder</button>
                                </div>
                            </form>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            	<a href="#" data-toggle="modal" data-target="#myModal"><p class="letraslogin">Ha olvidado su contraseña.</p></a>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    			<hr class="hrmenu">
                    		</div>
                        </div>
                    </div>

                </div><!--Div de cierre del row-->
            </div><!--Div de cierre de page-content inset-->
        </div><!--Div de cierre de page-content-wrapper-->
    </div><!--Div de cierre de id Wrapper-->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Recuperar contraseña</h4>
      </div>
      <div class="modal-body">
      	<div class="row">
        	<div class="col-sm-12" id="Infopass3"></div>
            	<div id="email3" class="form-group">
                	<label class="control-label col-sm-2" for="inputSuccess3"><span style="font:'Open Sans'; font-size:14px;">Email:</span></label>
                	<div class="col-sm-9">
                    	<input name="Email3" id="inputSuccess3" class="jos3 form-control" type="text" placeholder="Introduzca su correo aquí"/>
                    </div>
                </div>
        </div>
      </div>
      <div class="modal-footer">
        	<!--<button type="submit" class="btn btn-primary" onClick="enviarCorreo()">Enviar</button>-->
            <a href="#" onClick="enviarCorreo()">Enviar</a>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
    <!-- JavaScript -->
    <script src="js/jquery-1.10.2.js"></script>
    <script src="js/bootstrap.js"></script>

    <!-- Custom JavaScript for the Menu Toggle -->
    <script>
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("active");
    });
    </script>
    <script>
	function enviarCorreo(){
		correo=$('#inputSuccess3').val();
		$.ajaxSetup({ cache: false });
			$.ajax({
				async:true,
				type: "POST",
				dataType: "html",
				contentType: "application/x-www-form-urlencoded",
				url:"operaciones.php",
				data:"email="+correo+"&operaciones=recuperapass",
				success:function(data){
                console.log(data);
					if(data==0)
					{
						$('#Infopass3').html("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><p><strong>!Advertencia!</strong> Este campo está vacío.</p></div>")
		//pintaBordeRojo($(form3.Email3));
						$('#inputSuccess3').focus();
						$('#email3').removeClass("jos").addClass("form-group has-error");
					}
					if(data==1)
					{
						$('#Infopass3').html("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><p><strong>!Advertencia!</strong> Este correo no existe, asegúrese de que es un correo válido o si es con el que se registró.</p></div>")
						$('#email3').removeClass("jos").addClass("form-group has-error");
					}
					if(data==2)
					{
						$('#Infopass3').html("<div class='alert alert-success alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><p><strong>¡Muy Bien!</strong> El correo ha sido enviado con éxito, verifique su email, si no puede ver el correo revise si no ha llegado en la carpeta de spam o correo no deseado.</p></div>")
						$('#email3').removeClass("form-group has-error").addClass("form-group has-success");
					}
				},
				cache:false
			});
	}
</script>
</body>
</html>
