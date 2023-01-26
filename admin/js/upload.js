(function () {
	var input = document.getElementById("files"), 
		formdata = false;

	function showUploadedItem (source) {
  		var list = document.getElementById("image-list"),
	  		li   = document.createElement("li"),
	  		img  = document.createElement("img");
  		img.src = source;
  		li.appendChild(img);
		list.appendChild(li);
	}   

	if (window.FormData) {
  		formdata = new FormData();
  		document.getElementById("btn").style.display = "none";
	}
	
 	input.addEventListener("change", function (evt) {
 		document.getElementById("response").innerHTML = "Cargando...";
 		var i = 0, len = this.files.length, img, reader, file;
	
		for ( ; i < len; i++ ) {
			file = this.files[i];
	
			if (!!file.type.match(/image.*/)) {
				if ( window.FileReader ) {
					reader = new FileReader();
					reader.onloadend = function (e) { 
						showUploadedItem(e.target.result, file.fileName);
					};
					reader.readAsDataURL(file);
				}
				if (formdata) {
					formdata.append("archivo", file);
				}
			}	
		}
	
		if (formdata) {
			var cadena1 = $("#input1").val();
			var cadena2 = $("#input2").val();
			if (cadena1 == ''){
				$("#input1").focus();
				$('#titulo').removeClass("form-group").addClass("form-group has-error");
				$('.top-right').notify({
    			message: { text: 'El Campo del titulo esta vacío, para poder continuar asigne un titulo a la noticia' },
    			type:'blackgloss',
  				}).show();
				return false;
			}
			else{
				$('#titulo').removeClass("form-group has-error").addClass("form-group has-success");
				$.ajax({
				url: "operaciones.php?titulo="+cadena1+"&link="+cadena2+"&operaciones=agregarslide",
				type: "POST",
				data: formdata,
				processData: false,
				contentType: false,
				success: function (res) {
					document.getElementById("response").innerHTML = res; 
				}
			});
			}	
		
		}
	}, false);
}());
