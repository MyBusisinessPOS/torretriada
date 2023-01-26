<?php
session_start();
include('../include/path.php');
function __autoload($nombre_clase) {
    include '../panel/clases/'.$nombre_clase .'.php';
}
$_operaciones = $_POST['operaciones'];

	switch ($_operaciones) {
    case 'addNewsletter':
            $newsletter = new newsletter(0,$_REQUEST['email']);
            if($newsletter -> validNewsletter($_REQUEST['email'])){
                $newsletter ->addNewsletter();
                $_response = Array(0=>Array("_status" => 1));
                echo json_encode($_response);
            }else{
                $_response = Array(0=>Array("_status" => 2));
                echo json_encode($_response);
            }
    break;
    case 'listarBlogs':

      (isset($_POST['pagina']) && $_POST['pagina']!=1) ? $pagina=$_POST['pagina'] : $pagina=1;
          (isset($_POST['idCategoria']) && $_POST['idCategoria']!=0) ? $idCat=$_POST['idCategoria'] : $idCat='';
          (isset($_POST['order']) && $_POST['order']!='') ? $order=$_POST['order'] : $order='';
          (isset($_POST['busqueda']) && $_POST['busqueda']!='') ? $bus=$_POST['busqueda'] : $bus='';
          (isset($_POST['lang']) && $_POST['lang']!='') ? $lang=$_POST['lang'] : $lang='es';

          $herramientas = new herramientas();
          $blog = new blog();
          $_blogs = $blog -> listBlog($pagina, true, $idCat, 1, $bus, '', 4, true, $lang);
          if(count($_blogs)>0){
            foreach($_blogs as $_b){
              $dia=substr($_b['fechaOriginal'],8,2);
              $mes1=substr($_b['fechaOriginal'],5,2);
              $ano=substr($_b['fechaOriginal'],0,4);
              if($mes1=='01'){
                $mes='Enero';}
              if($mes1=='02'){
                $mes='Febrero';}
              if($mes1=='03'){
                $mes='Marzo';}
              if($mes1=='04'){
                $mes='Abril';}
              if($mes1=='05'){
                $mes='Mayo';}
              if($mes1=='06'){
                $mes='Junio';}
              if($mes1=='07'){
                $mes='Julio';}
              if($mes1=='08'){
                $mes='Agosto';}
              if($mes1=='09'){
                $mes='Septiembre';}
              if($mes1=='10'){
                $mes='Octubre';}
              if($mes1=='11'){
                $mes='Noviembre';}
              if($mes1=='12'){
                $mes='Diciembre';}

              $fechaf=$dia.' '.$mes. ', '.$ano;

                $_html .= '
                <div class="col-xl-6 col-lg-6 col-md-12">
                    <div class="item">
                      <div class="contiene-img">
                        <img src="'.PATH.'img/blog/'.$_b['ruta'].'" alt="'.$_b['titulo'].'" class="w100Hauto img-blog">
                        <div class="info">
                          <div class="titulo-blog">
                            '.$_b['titulo'].'
                          </div>
                          <div class="p">
                            '.$_b['descripcion'].'
                          </div>
                          <div class="text-left">
                            <a href="'.PATH.'detalle-noticia/'.$_b['id_blog'].'-'.$_b['url_amigable'].'" class="enlace"><img src="'.PATH.'img/ver-mas-simple.svg" alt="Torre Triada" class="arrow-blog" /></a>
                          </div>
                        </div>
                      </div>
                    </div>
                </div>
                ';
            }
          }else{
            $_html .= '<h1>'.$texto.'</h1>';
          }

          $_paginador = $herramientas -> paginadorFrontEnd($_blogs[0]['ultimapagina'], $_blogs[0]['pagina'], $_blogs[0]['paginaanterior'], $_blogs[0]['paginasiguiente'], 4, 'listarBlog');
          $_response = Array (
              0 => Array ( "_html" => $_html, "_paginador" => $_paginador)
          );

          echo json_encode($_response);

      break;
		  default:
			# code...
			break;
	}
?>
