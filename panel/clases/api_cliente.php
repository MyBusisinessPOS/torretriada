<?php

class api_cliente{
	
	var $url_base = "http://localhost/grupoinco/api/";
	var $response;
	var $data='<text>HELLO WORLD!</text>';

	function getBlog($_idBlog = 0, $_lang = 'ES'){
		$this -> url_base .= 'index.php/blog/'.$_idBlog.'/'.$_lang.'';
		$this -> enviar('GET');
	}



	function listBlog($_idSite = 0, $_pagina = 1, $_idCategoria = '', $_busqueda = '', $_tags = '', $_registrosPorPagina = 20, $_lang = 'ES'){
		$this -> data = array('idSite' => $_idSite, 'pagina' => $_pagina, 'idCategoria' => $_idCategoria, 'busqueda' => $_busqueda, 'tags' => $_tags, 'registrosPorPagina' => $_registrosPorPagina, 'lang' => $_lang);
		$this -> url_base .= 'index.php/blogs/';
		$this -> enviar('POST');
	}


	function enviar($criterio){
		/*$curl = curl_init();

		curl_setopt_array($curl, array(
		  //CURLOPT_PORT => "8000",
		  CURLOPT_URL => $this -> url_base,
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => "",
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 30,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => "GET",
		  CURLOPT_HTTPHEADER => array(
		    "Authorization: Bearer ZiCze5oROZggqWRHr0RynWVh7HrML9Gu"
		  ),
		));

		$this -> response = curl_exec($curl);
		$err = curl_error($curl);

		curl_close($curl);*/
		$ch = curl_init();
		$headers = array(
            "Authorization: Basic ZiCze5oROZggqWRHr0RynWVh7HrML9Gu"
        );
		curl_setopt($ch, CURLOPT_URL, $this -> url_base);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		if($criterio == 'GET'){
			curl_setopt($ch, CURLOPT_HTTPGET, true);
		}else{
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $this -> data);
		}
		$this -> response = curl_exec($ch);
		curl_close($ch);
	}
}
?>
