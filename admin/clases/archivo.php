<?php
include_once ('imgconfig.php');
class Archivo
{
	var $ruta_temporal;
	var $ruta_final;
	var $ruta_temporalogo;
	var $ruta_finalogo;
	
	function Archivo($ruta_temp,$ruta_fin)
	{
		$this->ruta_temporal=$ruta_temp;
		$this->ruta_final=$ruta_fin;
	}
	
	function subir_archivo($ruta)
	{
		$config=new imgconfig();
		$config->obtenerimgconfig();
		
		$newheight=$config->altomaximo;
		if($newheight=="")
		{
			$newheight=1200;
		}
		$newwidth=$config->anchomaximo;
		if($newwidth=="")
		{
			$newwidth=1200;
		}
		$quality=$config->calidad;
		if($quality=="")
		{
			$quality=80;
		}
		$ext= strtolower($this->getExtension($ruta));
		
		$filename = $this->compressImage($ext,$this->ruta_temporal,$this->ruta_final,$ruta,$newwidth,$newheight,$quality);
		
		return $filename;
	}
	function subir_logo()
	{
		//echo $this->ruta_final;
		move_uploaded_file($this->ruta_temporalogo,$this->ruta_finalogo);
	}
	function borrar_logo()
	{
		if (is_file($this->ruta_finalogo))
		{
			unlink($this->ruta_finalogo);
		}
	}
	function borrar_archivo()
	{
		if (is_file($this->ruta_final))
		{
			unlink($this->ruta_final);
		}
	}
	
	function obtenerExtensionArchivo($str)
	{
		$longitud = 8; // Elegimos la longitud de la cadena
		// recortamos la cadena, conseguimos nueva pass
		$aleatorio = substr( md5(microtime()), 1, $longitud);
	 	$extension = explode(".", $str);
		$extensionFinal= end($extension);
		return $aleatorio.'.'.$extensionFinal;
	}
	
	function getExtension($str)
		{
		$i = strrpos($str,".");
		if (!$i)
		{
		return "";
		}
		$l = strlen($str) - $i;
		$ext = substr($str,$i+1,$l);
		return $ext;
		}

		function compressImage($ext,$uploadedfile,$path,$actual_image_name,$width,$height,$quality)
		{
		
		if($ext=="jpg" || $ext=="jpeg" )
		{
		$src = imagecreatefromjpeg($uploadedfile);
		}
		else if($ext=="png")
		{
		$src = imagecreatefrompng($uploadedfile);
		}
		else if($ext=="gif")
		{
		$src = imagecreatefromgif($uploadedfile);
		}
		else
		{
		$src = $uploadedfile;
		}
		
		list($width_orig, $height_orig)=getimagesize($uploadedfile);
		
		

		$ratio_orig = $width_orig/$height_orig;
		
        if ($width/$height > $ratio_orig) {
		   $width = $height*$ratio_orig;
		} else {
		   $height = $width/$ratio_orig;
		}
				
		
	
		$tmp=imagecreatetruecolor($width,$height);
		
		if($width_orig < $width and $height_orig < $height)
		{
		move_uploaded_file($uploadedfile,$path.$actual_image_name);
		}
		elseif($ext=="ico")
		{
		move_uploaded_file($uploadedfile,$path.$actual_image_name);
		}
		else{
		imagecopyresampled($tmp,$src,0, 0, 0, 0, $width, $height, $width_orig, $height_orig);
		$filename = $path.$actual_image_name; //PixelSize_TimeStamp.jpg
		imagejpeg($tmp,$filename,$quality);
		imagedestroy($tmp);
		}
		$filenameFinal = $actual_image_name; 
		return $filenameFinal;
		}

}
?>