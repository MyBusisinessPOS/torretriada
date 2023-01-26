$('#keywords').tagsInput({
    'defaultText':'plabra clave',
    'width':'500px'
});
    
$(".upload").filestyle({
    input: false,
    buttonText: "Seleccionar Archivo",
    iconName: "glyphicon-camera",
});

function validar_campos(){
    var favicon = $("#filesFavicon").val();
	var pin = $("#filesPinGoogle").val();
    var ogImagen = $("#filesOgImagen").val();

	if(favicon != ""){
        if(!validarImagenes(favicon, 1)){
            $(".top-right").notify({
                message: { text: "El tipo de archivo que intenta subir no es admitido, solo se aceptan imágenes con formato .ico" },
                type:"blackgloss",
                delay: 6000,
            }).show(); 
            return false;   
        }            
    }
    if(pin != ""){
        if(!validarImagenes(pin, 2)){
            $(".top-right").notify({
                message: { text: "El tipo de archivo que intenta subir no es admitido, solo se aceptan imágenes con formato .png" },
                type:"blackgloss",
                delay: 6000,
           	}).show(); 
         	return false;   
        }            
    }
    if(ogImagen != ""){
        if(!validarImagenes(ogImagen, 3)){
            $(".top-right").notify({
                message: { text: "El tipo de archivo que intenta subir no es admitido, solo se aceptan imágenes con formato .png, .gif, .jpg" },
                type:"blackgloss",
                delay: 6000,
            }).show(); 
            return false;   
        }            
    }
}

function validarImagenes(input, format){
	switch(format){
		case 1:
		if (!input.match(/(?:ico|ICO)$/)) {
			return false;
		}else{
			return true;
		}  
		break;
		case 2:
		if (!input.match(/(?:png|PNG)$/)) {
			return false;
		}else{
			return true;
		}  
		break;
		case 3:
		if (!input.match(/(?:gif|jpg|png|jpeg|GIF|JPG|PNG|JPEG)$/)) {
			return false;
		}else{
			return true;
		}  
		break;
	}
}