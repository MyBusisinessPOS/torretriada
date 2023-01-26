<?php
session_start();
include('../include/path.php');
function __autoload($nombre_clase) {
    include '../admin/clases/'.$nombre_clase .'.php';
}
$_operaciones = $_POST['operaciones'];

	switch ($_operaciones) {
        case 'lotetodos':
     			$lotes = new lote();
     			$lista = $lotes->listaLoteJson();
     			echo $lista;
     		break;
        case 'obtenerPrecio':
  			if($_REQUEST["precioBase"] != 0){
  				$precios = new lote();
  				$precios -> obtenerPrecio($_REQUEST["precioBase"],$_REQUEST["plazo"]);
  			}
  			else{
  				echo "0";
  			}
  			break;
		default:
			# code...
			break;
	}
?>
