<?php
function __autoload($nombre_clase) {
    include 'clases/'.$nombre_clase .'.php';
}
$lote = new lote();
$listaLote=$lote->listaLote();
foreach($listaLote as $elementoLote){
  //echo 'Lote: '.$elementoLote['lote'].' ';
  $img='Lote-'.$elementoLote['lote'].'.png';
  $updateLote=new lote();
  $updateLote->updateImgLote($elementoLote['lote'],$img);
}
?>
