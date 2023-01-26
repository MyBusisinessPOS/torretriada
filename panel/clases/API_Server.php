<?php
/***********************
 * Inclusión de clases.
 **********************/
function __autoload($_class_name){
    include_once $_class_name.'.php';
}

class API_Server{

	var $_blog;

 	function API_Server(){
 		$this -> _blog = new blog();
 	}

 	function listBlog(){
 		$this -> _blog -> listBlog(true, $_POST['idSite'], $_POST['pagina'], true, $_POST['idCategoria'], 1, $_POST['busqueda'], $_POST['tags'], $_POST['registrosPorPagina'], true, $_POST['lang']);
 	}

 	function getBlog($_idBlog, $_lang){
 		$this -> _blog -> _idBlog = $_idBlog;
 		$this -> _blog -> getBlog($_lang, true);
 	}


}
?>
