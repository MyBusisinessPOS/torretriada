<?php
	$meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
	if(isset($_REQUEST['verify']))
	$token = $_REQUEST['verify'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Panel Slogan Publicidad">
    <meta name="author" content="Carlos David Baas Santiago">

    <title>Recuperar Contraseña</title>

    <!-- Bootstrap core CSS -->
    <link href="../../css/bootstrap.css" rel="stylesheet">
    <link href="../../css/styles.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,300,700,700italic' rel='stylesheet' type='text/css'>

    <!-- Add custom CSS here -->
    <link href="../../css/simple-sidebar.css" rel="stylesheet">
    <link href="../../font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href="../../css/bootstrap-notify.css" rel="stylesheet">
	<link href="../../css/alert-bangtidy.css" rel="stylesheet">
	<link href="../../css/alert-blackgloss.css" rel="stylesheet">
    <!--<link href="js/summernote/summernote.css" rel="stylesheet">-->

</head>

<body>
	<!--Sección de la cabezera-->
	<header>
    	<!--Header que se muestra en las clases lg y md-->
    	<div class="styled-large">
            <div id="navBlack" class="jumbotron navbar-fixed-top">
                <div class="col-lg-4 col-md-4 col-sm-3 col-xs-3">
                    <img id="imgLogo" class="imgNavBlack" src="../../img/Slogan_logo.svg">
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
                	<img id="imgLogo" class="imgNavBlack" src="../../img/Slogan_logo.svg">
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
                    		<div class='notifications top-right'></div>
                        	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            	<p class="login">Recuperar Contraseña</p>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    			<hr class="hrmenu">
                    		</div>
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <form id="form-validation" action="recpass.php" method="post" name="form1" onsubmit="return validar_campos()">
                            	<input type="hidden" name="token" value="<?php echo $token; ?>"/>
                            	<div id="pass" class="form-group espacios">
                        			<input type="password" name="pass" class="form-control" placeholder="Ingrese Su Nueva contraseña aquí..." value="">
                        		</div>
                                <div id="repass" class="form-group espacios">
                        			<input type="password" name="repass" class="form-control" placeholder="Confirme Su Nueva contraseña aquí..." value="">
                        		</div>
                                <div class="text-center">
                                	<button type="submit"  name="operaciones" value="recuperar" class="buttonacceder">Recuperar</button>
                                </div>
                            </form>
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

    <!-- JavaScript -->
    <script src="../../js/jquery-1.10.2.js"></script>
    <script src="../../js/bootstrap.js"></script>
    <script src="../../js/bootstrap-notify.js"></script>

    <!-- Custom JavaScript for the Menu Toggle -->
    <script>
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("active");
    });
    </script>
    <script>
	function validar_campos(){
		var filter=/^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;

			if (form1.pass.value == "")
			{
				form1.pass.focus();
				$('#pass').removeClass("form-group").addClass("form-group has-error");
				$('.top-right').notify({
    			message: { text: 'El campo contraseña esta vacío, llene este campo para poder continuar' },
    			type:'blackgloss',
  			}).show();
			return false;
			}
			else{
				$('#pass').removeClass("form-group has-error").addClass("form-group has-success");
			}

			if (form1.repass.value == "")
			{
				form1.repass.focus();
				$('#repass').removeClass("form-group").addClass("form-group has-error");
				$('.top-right').notify({
	    			message: { text: 'El escriba de nuevo la contraseña para poder continuar' },
	    			type:'blackgloss',
	  			}).show();
				return false;
			}
			else{
				$('#repass').removeClass("form-group has-error").addClass("form-group has-success");
			}


			if (form1.pass.value != form1.repass.value)
			{
				form1.repass.focus();
				$('#repass').removeClass("form-group").addClass("form-group has-error");
				$('.top-right').notify({
	    			message: { text: 'Las contraseñas no coinciden, verifique que sea la misma para poder continuar' },
	    			type:'blackgloss',
	  			}).show();
				return false;
			}
			else{
				$('#repass').removeClass("form-group has-error").addClass("form-group has-success");
			}
	}
	</script>

</body>
</html>
