/* ========================================================================
 * LOCKER: correo.js v1.0.0
 * ========================================================================
 * Copyright 2014 Locker Agencia Creativa, S.A de C.V.
 *
 * Author:  Luis Caamal.
 * Description:
 * Scripts esclusivos para el modulo de correos.
 * Features:
 * Visualizacion de imágenes.
 * Editor de texto Plugin Summernote.
 * Botstrap V3.
 * Validaciones.
 * ======================================================================== */

/* ==========================================================================
 * PLANTILLA 1:
 * Visualizaciones.
 * Editor de texto
 * Multiselect.
 * Validaciones.
 * ========================================================================= */

 $('#my-select').multiSelect();

 jQuery(document).ready(function() {
 	jQuery('#summernote').summernote({
  		height: 100
  	});

 	jQuery('#summernote2').summernote({
  		height: 100
  	});

 	jQuery('#summernote3').summernote({
  		height: 100
  	});

  	$('#form-validation').on('submit', function (e) {
    	var content = $('textarea[name="desc1"]').html($('#summernote').code());
    });
 });

 
	 function handleFileSelect(evt) {
	 	var files = evt.target.files; // FileList object
		// Loop through the FileList and render image files as thumbnails.
		for (var i = 0, f; f = files[i]; i++) {
		 // Only process image files.
		 if (!f.type.match('image.*')) {
		 	continue;
		 }
		var reader = new FileReader();
		// Closure to capture the file information.
		reader.onload = (function(theFile) {
			return function(e) {
		// Render thumbnail.
				var span = document.createElement('span');
					span.innerHTML = ['<img width="100%" height="auto" src="', e.target.result,
									'" title="', escape(theFile.name), '"/>'].join('');
					$("#list").empty();
					document.getElementById('list').insertBefore(span, null);
			};
		})(f);
		// Read in the image file as a data URL.
	    reader.readAsDataURL(f);
		}
	 }
	 document.getElementById('files').addEventListener('change', handleFileSelect, false);	 


	 function handleFileSelectLogo(evt) {
	 	var files = evt.target.files; // FileList object
		// Loop through the FileList and render image files as thumbnails.
		for (var i = 0, f; f = files[i]; i++) {
		 // Only process image files.
		 if (!f.type.match('image.*')) {
		 	continue;
		 }
		var reader = new FileReader();
		// Closure to capture the file information.
		reader.onload = (function(theFile) {
			return function(e) {
		// Render thumbnail.
				var span = document.createElement('span');
					span.innerHTML = ['<img width="100%" height="auto" src="', e.target.result,
									'" title="', escape(theFile.name), '"/>'].join('');
					$("#list_logo").empty();
					document.getElementById('list_logo').insertBefore(span, null);
			};
		})(f);
		// Read in the image file as a data URL.
	    reader.readAsDataURL(f);
		}
	 }
	 document.getElementById('files_logo').addEventListener('change', handleFileSelectLogo, false);	 
	  
	  function handleFileSelect2(evt) {
		var files3 = evt.target.files; // FileList object
		$("#list2").empty();
		// Loop through the FileList and render image files as thumbnails.
		for (var i = 0, f; f = files3[i]; i++) {
	
		  // Only process image files.
		  if (!f.type.match('image.*')) {
			continue;
		  }
	
		  var reader = new FileReader();
	
		  // Closure to capture the file information.
		  reader.onload = (function(theFile) {
			return function(e) {
			  // Render thumbnail.
			  var span = document.createElement('div');
			  span.className = "col-lg-6 col-md-6 col-sm-6 col-xs-6";
			  span.innerHTML = ['<img style="margin: 0 0 20px 0" class="img-responsive" src="', e.target.result,
								'" title="', escape(theFile.name), '"/>'].join('');
			  document.getElementById('list2').insertBefore(span, null);
			};
		  })(f);
	
		  // Read in the image file as a data URL.
		  reader.readAsDataURL(f);
		}
	  }

	  function deleteCorreo1Img(idcorreoimg1,idcorreo1){
	  	console.log(idcorreoimg1+", "+idcorreo1)
	  	$.ajaxSetup({ cache: false });
		$.ajax({
			async:true,
			type: "POST",
			dataType: "html",
			contentType: "application/x-www-form-urlencoded",
			url:"operaciones.php",
			data:"idcorreoimg1="+idcorreoimg1+"&idcorreo1="+idcorreo1+"&operaciones=eliminarImagenSecundariaCorreo1",
			success:function(data){
				console.log(data);
				if(data == "true")
					$("#correo1img"+idcorreoimg1).fadeOut();
				else
					alert("Hubo un problema y no se eliminó la imagen.");
			},
			cache:false
		});		

	  }
	
	  document.getElementById('files3').addEventListener('change', handleFileSelect2, false);
	  
	  function handleFileSelect3(evt) {
		var files = evt.target.files; // FileList object
	
		// Loop through the FileList and render image files as thumbnails.
		for (var i = 0, f; f = files[i]; i++) {
	
		  // Only process image files.
		  if (!f.type.match('image.*')) {
			continue;
		  }
	
		  var reader = new FileReader();
	
		  // Closure to capture the file information.
		  reader.onload = (function(theFile) {
			return function(e) {
			  // Render thumbnail.
			  var span = document.createElement('span');
			  span.innerHTML = ['<img width="100%" height="auto" src="', e.target.result,
								'" title="', escape(theFile.name), '"/>'].join('');
			  $("#list3").html("");
			  document.getElementById('list3').insertBefore(span, null);
			};
		  })(f);
	
		  // Read in the image file as a data URL.
		  reader.readAsDataURL(f);
		}
	  }
	
	  document.getElementById('files4').addEventListener('change', handleFileSelect3, false);
	  
	function validar_campos(){
		var val = $("#files").val();
		var val2 = $("#files3").val();
		var val3 = $("#files4").val();
		
		if (form1.titulo.value == ''){
			form1.titulo.focus();
			$('#titulo').removeClass("form-group").addClass("form-group has-error");
			$('.top-right').notify({
    			message: { text: 'El Campo del titulo esta vacío, para poder continuar asigne un titulo a este correo' },
    			type:'blackgloss',
    			delay: 80000,
  			}).show();
			return false;
			}
		else{
			$('#titulo').removeClass("form-group has-error").addClass("form-group has-success");
		}	
		if (!val.match(/(?:gif|jpg|png)$/) && $("#list").html() == "" ) {
    		$("#imgprin").removeClass("btn-default").addClass("btn-danger"); 
			$(".top-right").notify({
    			message: { text: "Agregue la imagen superior para poder continuar y solo se aceptan imágenes con formato .jpg .png .gif" },
    			type:"blackgloss",
    			delay: 1000,
  			}).show(); 
			return false; 
		}
		else{
			$("#imgprin").removeClass("btn-danger").addClass("btn-success"); 
		}
		if (form1.subtitulo.value == ''){
			form1.subtitulo.focus();
			$('#subtitulo').removeClass("form-group").addClass("form-group has-error");
			$('.top-right').notify({
    			message: { text: 'El Campo del subtitulo esta vacío, para poder continuar asigne un subtitulo a este correo' },
    			type:'blackgloss',
  			}).show();
			return false;
			}
		else{
			$('#subtitulo').removeClass("form-group has-error").addClass("form-group has-success");
		}
		/*if (!val2.match(/(?:gif|jpg|png)$/)) {
    		$("#imgsecu").removeClass("btn-default").addClass("btn-danger"); 
			$(".top-right").notify({
    			message: { text: "Agregue las imágenes secundarioas para poder continuar y solo se aceptan imágenes con formato .jpg .png .gif" },
    			type:"blackgloss",
    			delay: 10000,
  			}).show(); 
			return false; 
		}
		else{
			$("#imgsecu").removeClass("btn-danger").addClass("btn-success"); 
		}*/
		if (!val3.match(/(?:gif|jpg|png)$/) && $("#list3").html() == "" ) {
    		$("#imgter").removeClass("btn-default").addClass("btn-danger");
			$(".top-right").notify({
    			message: { text: "Agregue la imagen inferior para poder continuar y solo se aceptan imágenes con formato .jpg .png .gif" },
    			type:"blackgloss",
    			delay: 10000,
  			}).show(); 
			return false; 
		}
		else{
			$("#imgter").removeClass("btn-danger").addClass("btn-success");
		}
		if($('#my-select').val() == 0){
			alert($('#my-select').val());
			$(".top-right").notify({
    			message: { text: "Es muy importante que seleccione a quien le desea enviar este correo" },
    			type:"blackgloss",
    			delay: 10000,
  			}).show(); 
			return false; 
		}	
	}
	
	$(function() {
	    $('#titulo').tooltip(
		{
			placement: "top",
	        title: "Ingrese el titulo del correo aquí. (CAMPO REQUERIDO)"
		});
		$('#subtitulo').tooltip(
		{
			placement: "top",
	        title: "Ingrese el subtitulo del correo aquí. (CAMPO REQUERIDO)"
		});
		$('.note-editable').tooltip(
		{
			placement: "top",
	        title: "Ingrese una descripcion del correo aquí.(CAMPO REQUERIDO)"
		});
		$('#imgprin').tooltip(
		{
			placement: "top",
	        title: "Seleccione una imagen, esta imagen es la que se mostrará en la parte superior del correo, solo se aceptan imagenes con formatos .jpg, .png y  .gif. (CAMPO REQUERIDO)"
		});
		$('#imgsecu').tooltip(
		{
			placement: "top",
	        title: "Seleccione el numero de imágenes que desee, solo se aceptan imágenes con formato .jpg, .png y .gif. (CAMPO REQUERIDO)"
		});
		$('#imgter').tooltip(
		{
			placement: "top",
	        title: "Seleccione una imagen, esta imagen es la que se mostrará en la parte inferior del correo, solo se aceptan imagenes con formatos .jpg, .png y  .gif. (CAMPO REQUERIDO)"
		});
		$('.ms-selection').tooltip(
		{
			placement: "top",
	        title: "Aquí se muestran todos los elementos que ha seleccionado, si desea retirar alguno solo le debe dar click sobre el"
		});
		$('.ms-selectable').tooltip(
		{
			placement: "top",
	        title: "Seleccion uno o varios elementos de esta lista. Para que se seleccionen debe hacer click sobre el."
		});
	});
	$(function() {
	    $('#plant1').popover(
		{
			placement: 'right',
			trigger: 'hover',
			html: 'true',
			title: 'Previsualizar',
			content: '<img src="img/plantillas-01.png" width="200" height="200" />',
			container: 'body'
		});
	});
	$(function() {
	    $('#plant2').popover(
		{
			placement: 'right',
			trigger: 'hover',
			html: 'true',
			title: 'Previsualizar',
			content: '<img src="img/plantillas-02.png" width="200" height="200" />',
			container: 'body'
		});
	});
	$(function() {
	    $('#plant3').popover(
		{
			placement: 'right',
			trigger: 'hover',
			html: 'true',
			title: 'Previsualizar',
			content: '<img src="img/plantillas-03.png" width="200" height="200" />',
			container: 'body'
		});
	});

	function validar_campo_prueba1(){
		var correoLleno = false;
		if($($('[name="correo_prueba[]"]')[0]).val() != "" || $($('[name="correo_prueba[]"]')[1]).val() != ""){
			$("#form-validation").find(":submit").click();
		}
		else{
			$($('[name="correo_prueba[]"]')[0]).focus();
			alert("Introduce un correo.");
		}
	}