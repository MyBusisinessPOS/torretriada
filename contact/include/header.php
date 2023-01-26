<?php
if(isset($_REQUEST["success"])){
  $success=$_REQUEST["success"];
}
else{
  $success="";
}
if($success=="ZS1aFTKNN7zh" || $success=="214"){
  header("Content-disposition: attachment; filename=TorreTriada_Folleto.pdf");
  header("Content-type: application/pdf");
  readfile("TorreTriada_Folleto.pdf");
}
$self = $_SERVER['PHP_SELF'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <?php include 'include/metas.php';?>
        <title>Torre Triada headx</title>
    </head>

	<body>
        <!-- Navegadores des-actualizados -->
        <div id="outdated">
            <h6>Tu Navegador esta desactualizado, para que el sitio</h6>
            <h6>funcione correctamente porfavor:</h6>
            <p> <a id="btnUpdateBrowser" href="http://www.updateyourbrowser.net/es">Actualiza tu navegador</a></p>
            <p class="last"><a href="#" id="btnCloseUpdateBrowser" title="Close">&times;</a></p>
        </div>
        <header>

        </header>
