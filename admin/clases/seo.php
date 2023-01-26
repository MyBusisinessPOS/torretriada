<?php
include_once('conexion.php');
require_once('archivo.php');
include_once('imgSeo.php');

/**
 * @author Luis J. Caamal.
 * @copyright 2015 Luis J. Caamal.
 */
class seo extends Archivo
{
	/**
	 * Indentificador de la clase y BD
	 * @var Integer
	 */
	var $idseo;
/////////////////////////////////////////////////
/// VARIABLES SEO GENERALES
/////////////////////////////////////////////////
	/**
	 * Almacena la descripcion de la página.
	 * @var String
	*/
	var $metaDescription;

	/**
	 * Almacena las palabras clave de búsqueda.
	 * @var String
	 */
	var $metaKeywords;

	/**
	 * Almecena el nombre del autor de la página.
	 * @var String
	 */
	var $metaAuthor;

/////////////////////////////////////////////////
/// VARIABLES SEO FACEBOOK
/////////////////////////////////////////////////

	/**
	 * Almacena el titulo de la página.
	 * @var String
	 */
	var $metaOgTitle;

	/**
	 * Almacena la url de la página.
	 * @var String
	 */
	var $metaOgUrl;

	/**
	 * Almacena que el tipo.
	 * @var String
	 */
	var $metaOgType;

	/**
	 * Almacena la descripcion de la página.
	 * @var String
	 */
	var $metaOgDescription;

	/**
	 * Almecena el nombre de la imagen.
	 * @var String
	 */
	var $metaOgImage;

	/**
	 * Almacena la localización de la página.
	 * @var String
	 */
	var $metaOgLocale;

	/**
	 * Nombre del sitio.
	 * @var String
	 */
	var $metaOgSiteName;

	/**
	 * Almacena el id de google analitics.
	 * @var String
	 */
	var $idAnalitics;

	/**
	 * Almacena el nombre del sitio requerido en el google Analitics
	 * @var String
	 */
	var $sitenameAnalitics;

	/**
	 * Almacena Código de conversión facebook.
	 * @var String
	 */
	var $conversionFacebook;

	/**
	 * Almacena Código conversión Google
	 * @var String
	 */
	var $conversionGoogle;

	/**
	 * Metodo constructor de la clase
	 * @param  integer $idseo
	 * @param  string  $metaDescription
	 * @param  string  $metaKeywords
	 * @param  string  $metaAuthor
	 * @param  string  $metaOgTitle
	 * @param  string  $metaOgUrl
	 * @param  string  $metaOgType
	 * @param  string  $metaOgDescription
	 * @param  string  $metaOgLocale
	 * @param  string  $metaOgSiteName
	 * @return Void
	 */
	function seo($idseo = 1, $metaDescription = '', $metaKeywords = '', $metaAuthor = '', $metaOgTitle = '', $metaOgUrl = '', $metaOgType = '', $metaOgDescription = '', $metaOgLocale = '', $metaOgSiteName = '', $idAnalitics = '', $sitenameAnalitics = '', $conversionFacebook = '', $conversionGoogle = ''){
		$this -> idseo = $idseo;
		$this -> metaDescription = $metaDescription;
		$this -> metaKeywords = $metaKeywords;
		$this -> metaAuthor = $metaAuthor;
		$this -> metaOgTitle = $metaOgTitle;
		$this -> metaOgUrl = $metaOgUrl;
		$this -> metaOgType = $metaOgType;
		$this -> metaOgDescription = $metaOgDescription;
		$this -> metaOgLocale = $metaOgLocale;
		$this -> metaOgSiteName = $metaOgSiteName;
		$this -> idAnalitics = $idAnalitics;
		$this -> sitenameAnalitics = $sitenameAnalitics;
		$this -> conversionFacebook = $conversionFacebook;
		$this -> conversionGoogle = $conversionGoogle;
	}

	/**
	 * Modifica los campos en la BD
	 * @return Void
	 */
	function modificar_seo(){
		// Variable contiene la consulta SQL.
		$sql="UPDATE seo SET
		metaDescription = '".htmlspecialchars($this -> metaDescription, ENT_QUOTES)."',
		metaKeywords ='".htmlspecialchars($this -> metaKeywords, ENT_QUOTES)."',
		metaAuthor = '".htmlspecialchars($this -> metaAuthor, ENT_QUOTES)."',
		metaOgTitle = '".htmlspecialchars($this -> metaOgTitle, ENT_QUOTES)."',
		metaOgUrl = '".htmlspecialchars($this -> metaOgUrl, ENT_QUOTES)."',
		metaOgType = '".htmlspecialchars($this -> metaOgType, ENT_QUOTES)."',
		metaOgDescription = '".htmlspecialchars($this -> metaOgDescription, ENT_QUOTES)."',
		metaOgLocale = '".htmlspecialchars($this -> metaOgLocale, ENT_QUOTES)."',
		metaOgSiteName = '".htmlspecialchars($this -> metaOgSiteName, ENT_QUOTES)."',
		idAnalitics = '".$this -> idAnalitics."',
		sitenameAnalitics = '".$this -> sitenameAnalitics."',
		conversionFacebook = '".htmlspecialchars($this -> conversionFacebook, ENT_QUOTES)."',
		conversionGoogle = '".htmlspecialchars($this -> conversionGoogle, ENT_QUOTES)."'
		WHERE idseo = ".$this->idseo.";";

		// Instancia de la clase conexion.
		$con = new conexion();

		// Metodo que ejecuta la sentencia SQL.
		$con -> ejecutar_sentencia($sql);
	}

	/**
	 * Obtiene todos los campos de la BD
	 * @return Void
	 */
	function obtener_seo(){
	  // Variable contiene la consulta SQL.
	  $sql = "select * from seo where idseo = ".$this -> idseo." ;";

	  // Instancia de la clase conexion.
	  $con = new conexion();

	  // Metodo que ejecuta la sentencia SQL y el resultado se almacena en la variable resultados.
	  $resultados = $con -> ejecutar_sentencia($sql);

	  // Recorre cada uno de las filas.
	  while($fila = mysqli_fetch_array($resultados)){
		$this -> metaDescription = $fila['metaDescription'];
		$this -> metaKeywords = $fila['metaKeywords'];
		$this -> metaAuthor = $fila['metaAuthor'];
		$this -> metaOgTitle = $fila['metaOgTitle'];
		$this -> metaOgUrl = $fila['metaOgUrl'];
		$this -> metaOgType = $fila['metaOgType'];
		$this -> metaOgDescription = $fila['metaOgDescription'];
		$this -> metaOgLocale = $fila['metaOgLocale'];
		$this -> metaOgSiteName = $fila['metaOgSiteName'];
		$this -> idAnalitics = $fila['idAnalitics'];
		$this -> sitenameAnalitics = $fila['sitenameAnalitics'];
		$this -> conversionFacebook = htmlspecialchars_decode($fila['conversionFacebook']);
		$this -> conversionGoogle = htmlspecialchars_decode($fila['conversionGoogle']);
	  }

	  //Limpia cache.
	  mysqli_free_result($resultados);
	}

	function agregarImgSeo($idseo, $ruta, $tmp){
		$imgSeo = new imgSeo(0,$idseo,$ruta,$ruta,$tmp);
		$imgSeo -> insertaimgSeo();
	}

	function modificarImgSeo($idImgSeo, $ruta, $tmp){
		$imgSeo = new imgSeo($idImgSeo,$idseo,$ruta,$ruta,$tmp);
		$imgSeo -> modificaimgSeo();
	}

	function listarImgSeo(){
		$imgSeo = new imgSeo(0,1);
		$resultado = $imgSeo -> listarimgSeo();
		return $resultado;
	}

}
?>
