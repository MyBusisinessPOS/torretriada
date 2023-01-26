<?php
include_once ('imgConfig.php');
class Archivo
{
	var $ruta_temporal;
	var $ruta_final;

	function __construct($ruta_temp,$ruta_fin){
		$this -> ruta_temporal = $ruta_temp;
		$this -> ruta_final = $ruta_fin;
	}

	function subir_archivo(){
		//echo $this->ruta_final;
		if(move_uploaded_file($this -> ruta_temporal, $this -> ruta_final)){
			return $_success = true;
		}else{
			return $_success = false;
		}
	}

	function subir_archivo_imagen($ruta){
		$config = new imgConfig();
		$config -> obtenerimgconfig();

		$newheight = $config -> altomaximo;
		if($newheight == ""){
			$newheight = 800;
		}

		$newwidth = $config -> anchomaximo;
		if($newwidth == ""){
			$newwidth = 1200;
		}

		$quality = $config -> calidad;
		if($quality == ""){
			$quality = 100;
		}

		$ext = strtolower($this -> getExtension($ruta));
		if($ext != 'pdf' OR $ext != 'svg'){
			$_success = $this -> compressImage($ext, $this -> ruta_temporal, $this -> ruta_final, $ruta, $newwidth, $newheight, $quality);
		}else{
			$this -> ruta_final = $this -> ruta_final.$ruta;
			$_success = $this -> subir_archivo();
		}

		return $_success;
	}

	function borrar_archivo(){
		if (is_file($this->ruta_final))
		{
			unlink($this->ruta_final);
		}
	}

	function obtenerExtensionArchivo($str, $temporal = ''){
		$imgConfig = new imgConfig();
		$imgConfig -> obtenerimgconfig();
		($temporal == '') ? $pref = $imgConfig -> prefijo : $pref = $temporal;
		if($pref != ''){
			$from = explode (',', "Á,Â,Ã,Ä,Å,Æ,Ç,È,É,Ê,Ë,Ì,Í,Î,Ï,Ð,Ñ,Ò,Ó,Ô,Õ,Ö,Ø,Ù,Ú,Û,Ü,Ý,ß,� ,á,â,ã,ä,å,æ,ç,è,é,ê,ë,ì,í,î,ï,ñ,ò,ó,ô,õ,ö,ø,ù,ú,û,ü,ý,ÿ,Ā,ā,Ă,ă,Ą,ą,Ć,ć,Ĉ,ĉ,Ċ,ċ,Č,č,Ď,ď,Đ,đ,Ē,ē,Ĕ,ĕ,Ė,ė,Ę,ę,Ě,ě,Ĝ,ĝ,Ğ,ğ,� ,ġ,Ģ,ģ,Ĥ,ĥ,Ħ,ħ,Ĩ,ĩ,Ī,ī,Ĭ,ĭ,Į,į,İ,ı,Ĳ,ĳ,Ĵ,ĵ,Ķ,ķ,Ĺ,ĺ,Ļ,ļ,Ľ,ľ,Ŀ,ŀ,Ł,ł,Ń,ń,Ņ,ņ,Ň,ň,ŉ,Ō,ō,Ŏ,ŏ,Ő,ő,Œ,œ,Ŕ,ŕ,Ŗ,ŗ,Ř,ř,Ś,ś,Ŝ,ŝ,Ş,ş,� ,š,Ţ,ţ,Ť,ť,Ŧ,ŧ,Ũ,ũ,Ū,ū,Ŭ,ŭ,Ů,ů,Ű,ű,Ų,ų,Ŵ,ŵ,Ŷ,ŷ,Ÿ,Ź,ź,Ż,ż,Ž,ž,ſ,ƒ,� ,ơ,Ư,ư,Ǎ,ǎ,Ǐ,ǐ,Ǒ,ǒ,Ǔ,ǔ,Ǖ,ǖ,Ǘ,ǘ,Ǚ,ǚ,Ǜ,ǜ,Ǻ,ǻ,Ǽ,ǽ,Ǿ,ǿ,(,),[,],'");
			$to = explode (',', 'A,A,A,A,A,AE,C,E,E,E,E,I,I,I,I,D,N,O,O,O,O,O,O,U,U,U,U,Y,s,a,a,a,a,a,a,ae,c,e,e,e,e,i,i,i,i,n,o,o,o,o,o,o,u,u,u,u,y,y,A,a,A,a,A,a,C,c,C,c,C,c,C,c,D,d,D,d,E,e,E,e,E,e,E,e,E,e,G,g,G,g,G,g,G,g,H,h,H,h,I,i,I,i,I,i,I,i,I,i,IJ,ij,J,j,K,k,L,l,L,l,L,l,L,l,l,l,N,n,N,n,N,n,n,O,o,O,o,O,o,OE,oe,R,r,R,r,R,r,S,s,S,s,S,s,S,s,T,t,T,t,T,t,U,u,U,u,U,u,U,u,U,u,U,u,W,w,Y,y,Y,Z,z,Z,z,Z,z,s,f,O,o,U,u,A,a,I,i,O,o,U,u,U,u,U,u,U,u,U,u,A,a,AE,ae,O,o,,,,,,');
			$s = preg_replace ('~[^\w\d]+~', '-', str_replace ($from, $to, trim ($pref)));
			$prefijo = strtolower (preg_replace ('/^-/', '', preg_replace ('/-$/', '',$s)));
		}else{
			$prefijo = 'archivo';
		}
		$longitud = 8; // Elegimos la longitud de la cadena
		// recortamos la cadena, conseguimos nueva pass
		$aleatorio = substr( md5(microtime()), 1, $longitud);
	 	$extension = explode(".", $str);
		$extensionFinal= end($extension);
		return $prefijo.'-'.$aleatorio.'.'.$extensionFinal;
	}

	function compressImage($ext,$uploadedfile,$path,$actual_image_name,$width,$height,$quality){
		if($ext=="jpg" || $ext=="jpeg" ){
			$src = imagecreatefromjpeg($uploadedfile);
		}else if($ext=="png"){
			$src = imagecreatefrompng($uploadedfile);
		}else if($ext=="gif"){
			$src = imagecreatefromgif($uploadedfile);
		}else{
			$src = imagecreatefrombmp($uploadedfile);
		}



		list($width_orig, $height_orig)=getimagesize($uploadedfile);

		$ratio_orig = $width_orig/$height_orig;

        if($width/$height > $ratio_orig){
		   $width = $height*$ratio_orig;
		}else{
		   $height = $width/$ratio_orig;
		}

		$tmp=imagecreatetruecolor($width,$height);

		if($width_orig < $width and $height_orig < $height){
			if(move_uploaded_file($uploadedfile,$path.$actual_image_name)){
				$_success = true;
			}else{
				$_success = false;
			}
		}else{
			if($ext == 'png'){
				imagealphablending($tmp, false);
				imagesavealpha($tmp,true);
				$transparent = imagecolorallocatealpha($tmp, 255, 255, 255, 127);
				imagefilledrectangle($tmp, 0, 0, $width, $height, $transparent);
				imagecopyresampled($tmp, $src, 0, 0, 0, 0, $width, $height,
				                      $width_orig, $height_orig);
				$filename = $path.$actual_image_name; //PixelSize_TimeStamp.jpg
				if(imagepng($tmp, $filename,9)){
					imagedestroy($tmp);
					$_success = true;
				}else{
					$_success = false;
				}

			}else{
				if(imagecopyresampled($tmp,$src,0, 0, 0, 0, $width, $height, $width_orig, $height_orig)){
					$filename = $path.$actual_image_name; //PixelSize_TimeStamp.jpg
					if(imagejpeg($tmp,$filename,$quality)){
						imagedestroy($tmp);
						$_success = true;
					}else{
						$_success = false;
					}

				}else{
					$_success = false;
				}
			}


		}
		return $_success;
	}

	function compressImageW($ext,$uploadedfile,$path,$actual_image_name,$newwidth,$calidad){
        if($ext=="jpg" || $ext=="jpeg" || $ext=="JPG" || $ext=="JPEG"){
            $src = imagecreatefromjpeg($uploadedfile);
        }else if($ext=="png" || $ext=="PNG"){
            $src = imagecreatefrompng($uploadedfile);
        }else if($ext=="gif"){
            $src = imagecreatefromgif($uploadedfile);
        }else{
            $src = imagecreatefrombmp($uploadedfile);
        }

        list($width,$height)=getimagesize($uploadedfile);

            $newheight=($height/$width)*$newwidth;
            $tmp=imagecreatetruecolor($newwidth,$newheight);


        imagecopyresampled($tmp,$src,0,0,0,0,$newwidth,$newheight,$width,$height);
        $filename = $path.$actual_image_name; //PixelSize_TimeStamp.jpg
        imagejpeg($tmp,$filename,$calidad);
        imagedestroy($tmp);
        $filenameFinal = $newwidth.'_'.$actual_image_name;
        return $filenameFinal;
    }

	function getExtension($str){
		$extension = explode(".", $str);
		$extensionFinal = end($extension);
		return $extensionFinal;
	}

}
?>
