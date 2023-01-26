var _temporalID = 0;

function addContenido(_tipo){
	var _html = '',
		_content = $('#content-element-blog');
	switch(_tipo){
		case '1':
			/*_html = '<div class="col-lg-6 col-lg-offset-3 col-md-12 col-xs-12" id="contenido-blog-'+_temporalID+'">'+
					    '<div class="close" onclick="deleteElement('+_temporalID+', \'contenido-blog-\', \'\', \'false\')"> <i class="fa fa-times"></i> </div>'+
					    '<input type="hidden" name="temporal-id[]" value="'+_temporalID+'">'+
					    '<input type="hidden" name="tipo-contenido[]" value="'+_tipo+'">'+
					    '<div class="input-group espacios">'+
							'<span class="input-group-addon">Descripción</span>'+
							'<textarea rows="5" class="form-control" data-validate="false" name="descripcion-contenido-'+_temporalID+'" id="desc-cont-'+_temporalID+'"></textarea>'+
							'<span class="input-group-addon">ES</span>'+
						'</div>'+
						'<hr class="divisor-seccion">'+
					'</div>';*/

		    _html = '<!-- CONTENIDO TEXTO -->\n' +
                '                                                <div class="col-md-12" id="contenido-blog-'+_temporalID+'">\n' +
                '                                                    <div class="close" onclick="deleteElement('+_temporalID+',\'contenido-blog-\', \'\', \'false\')"> <i class="fa fa-times"></i> </div>\n' +
                '                                                    <input type="hidden" name="temporal-id[]" value="'+_temporalID+'">'+
                '                                                    <input type="hidden" name="tipo-contenido[]" value="'+_tipo+'">'+
                '                                                    <!-- TAB NAVIGATION -->\n' +
                '                                                    <ul class="nav nav-tabs" role="tablist">\n' +
                '                                                        <li class="active"><a href="#desc-es-'+_temporalID+'" role="tab" data-toggle="tab">Descripción (bloque de texto)</a>\n' +
                '                                                        </li>\n' +
                '                                                        <!--<li><a href="#desc-en-'+_temporalID+'" role="tab" data-toggle="tab">Descripción (EN)</a></li>-->\n' +
                '                                                        <!--<li><a href="#desc-fr-'+_temporalID+'" role="tab" data-toggle="tab">Descripción (FR)</a></li>-->\n' +
                '                                                    </ul>\n' +
                '                                                    <!-- TAB CONTENT -->\n' +
                '                                                    <div class="tab-content">\n' +
                '                                                        <div class="active tab-pane fade in" id="desc-es-'+_temporalID+'">\n' +
                '                                                            <div class="panel panel-default">\n' +
                '                                                                <div class="panel-heading">\n' +
                '                                                                    <h3 class="panel-title">Descripción</h3>\n' +
                '                                                                </div>\n' +
                '                                                                <div class="panel-body">\n' +
                '                                                                    <div class="input-group espacios">\n' +
                '                                                                        <span class="input-group-addon">Descripción</span>\n' +
                '                                                                        <textarea data-summer="true" rows="5" class="form-control apply-translate" data-validate="false" name="descripcion-contenido-es-'+_temporalID+'" data-idtarget="contenido-descripcion-'+_temporalID+'-" id="contenido-descripcion-'+_temporalID+'-es"></textarea>\n' +
                '                                                                    </div>\n' +
                '                                                                </div>\n' +
                '                                                            </div>\n' +
                '                                                        </div>\n' +
                '                                                        <div class="tab-pane fade" id="desc-en-'+_temporalID+'">\n' +
                '                                                            <div class="panel panel-default">\n' +
                '                                                                <div class="panel-heading">\n' +
                '                                                                    <h3 class="panel-title">Descripción</h3>\n' +
                '                                                                </div>\n' +
                '                                                                <div class="panel-body">\n' +
                '                                                                    <div class="input-group espacios">\n' +
                '                                                                        <span class="input-group-addon">Descripción</span>\n' +
                '                                                                        <textarea data-summer="true" rows="5" class="form-control" data-validate="false" name="descripcion-contenido-en-'+_temporalID+'" id="contenido-descripcion-'+_temporalID+'-en"></textarea>\n' +
                '                                                                    </div>\n' +
                '                                                                </div>\n' +
                '                                                            </div>\n' +
                '                                                        </div>\n' +
                '                                                        <!--<div class="tab-pane fade" id="desc-fr-'+_temporalID+'">\n' +
                '                                                            <div class="panel panel-default">\n' +
                '                                                                <div class="panel-heading">\n' +
                '                                                                    <h3 class="panel-title">Descripción</h3>\n' +
                '                                                                </div>\n' +
                '                                                                <div class="panel-body">\n' +
                '                                                                    <div class="input-group espacios">\n' +
                '                                                                        <span class="input-group-addon">Descripción</span>\n' +
                '                                                                        <textarea data-summer="true" rows="5" class="form-control" data-validate="false" name="descripcion-contenido-fr-'+_temporalID+'" id="contenido-descripcion-'+_temporalID+'-fr"></textarea>\n' +
                '                                                                    </div>\n' +
                '                                                                </div>\n' +
                '                                                            </div>\n' +
                '                                                        </div>-->\n' +
                '                                                    </div>\n' +
                '                                                </div>';
			_content.append(_html);
			setTimeout(function(){
				initSummernoteBlog(_temporalID);
				window.location.hash = '#contenido-blog-'+_temporalID;
				_temporalID ++;
			},100);
		break;
		case '2':
			/*_html = '<div class="col-lg-6 col-lg-offset-3 col-md-12 col-xs-12" id="contenido-blog-'+_temporalID+'">'+
					    '<div class="close" onclick="deleteElement('+_temporalID+', \'contenido-blog-\', \'\', \'false\')"> <i class="fa fa-times"></i> </div>'+
					    '<input type="hidden" name="temporal-id[]" value="'+_temporalID+'">'+
					    '<input type="hidden" name="tipo-contenido[]" value="'+_tipo+'">'+
					    '<center>'+
					        '<div id="preview-img-contenido-'+_temporalID+'" class="espacios"><div class="preview-example"></div></div>'+
							'<input type="file" data-validate="true" data-type-file="imagen" id="img-contenido-'+_temporalID+'" onchange="showMyImageWH(\'preview-img-contenido-'+_temporalID+'\', this, \'\', 1, 650, 300)" name="img-contenido-'+_temporalID+'" class="filestyle">'+
							'<p class="help-block">Solo se aceptan imagenes con formato .JPG, .JPEG, .PNG, la imagen debe ser menor a 3 MB.</p>'+
						'</center>'+
						'<hr class="divisor-seccion">'+
					'</div>';*/

			_html = ' <!-- CONTENIDO IMAGEN -->\n' +
                '                                                <div class="col-lg-10 col-lg-offset-1 col-md-12" id="contenido-blog-'+_temporalID+'">\n' +
                '                                                    <div class="close" onclick="deleteElement('+_temporalID+',\'contenido-blog-\', \'\', \'false\')"> <i class="fa fa-times"></i> </div>\n' +
                '                                                    <input type="hidden" name="temporal-id[]" value="'+_temporalID+'">'+
                '                                                    <input type="hidden" name="tipo-contenido[]" value="'+_tipo+'">'+
                '                                                    <div class="panel panel-default mar-top-30x">\n' +
                '                                                        <div class="panel-heading">\n' +
                '                                                            <h3 class="panel-title">Imagen</h3>\n' +
                '                                                        </div>\n' +
                '                                                        <div class="panel-body">\n' +
                '                                                            <center >\n' +
                '                                                                <div id="preview-img-contenido-'+_temporalID+'" class="espacios">\n' +
                '                                                                    <div class="preview-example"></div>\n' +
                '                                                                </div>\n' +
                '                                                                <input type="file" id="img-contenido-'+_temporalID+'" onchange="showMyImageWH(\'preview-img-contenido-'+_temporalID+'\', this, \'\', 1, 650, 300)" name="img-contenido-'+_temporalID+'" class="filestyle" data-input="false" data-buttonText="Imagen" data-iconName="fa fa-picture-o" data-badge="true">\n' +
                '                                                                <p class="help-block">Solo se aceptan imagenes con formato .JPG, .JPEG, .PNG, la imagen debe ser menor a 3 MB.</p>\n' +
                '                                                            </center>\n' +
                '                                                        </div>\n' +
                '                                                    </div>\n' +
                '                                                </div>';
			_content.append(_html);
			setTimeout(function(){
				initFileStyleImagenBlog(_temporalID);
				window.location.hash = '#contenido-blog-'+_temporalID;
				_temporalID ++;
			},100);
		break;
		case '3':
			/*_html = '<div class="col-lg-6 col-lg-offset-3 col-md-12 col-xs-12" id="contenido-blog-'+_temporalID+'">'+
					    '<div class="close" onclick="deleteElement('+_temporalID+', \'contenido-blog-\', \'\', \'false\')"> <i class="fa fa-times"></i> </div>'+
					    '<input type="hidden" name="temporal-id[]" value="'+_temporalID+'">'+
					    '<input type="hidden" name="tipo-contenido[]" value="'+_tipo+'">'+
					    '<center>'+
					        '<div id="preview-video-contenido-'+_temporalID+'" class="espacios"><div class="preview-example"></div></div>'+
							'<input type="file" data-validate="true" data-type-file="imagen" id="video-contenido-'+_temporalID+'" onchange="showMyImageWH(\'preview-video-contenido-'+_temporalID+'\', this, \'\', 1, 650, 300)" name="video-contenido-'+_temporalID+'" class="filestyle">'+
							'<p class="help-block">Solo se aceptan imagenes con formato .JPG, .JPEG, .PNG, la imagen debe ser menor a 3 MB.</p>'+
						'</center>'+
						'<div class="input-group espacios">'+
							'<span class="input-group-addon">Url</span>'+
							'<input type="text" name="url-contenido-'+_temporalID+'" data-validate="true" class="form-control" placeholder="Ingresa la url del video.." value="">'+
						'</div>'+
						'<hr class="divisor-seccion">'+
					'</div>';*/

			_html = '<!-- CONTENIDO VIDEO -->\n' +
                '                                                <div class="col-lg-10 col-lg-offset-1 col-md-12" id="contenido-blog-'+_temporalID+'">\n' +
                '                                                    <input type="hidden" name="temporal-id[]" value="'+_temporalID+'">'+
                '                                                    <input type="hidden" name="tipo-contenido[]" value="'+_tipo+'">'+
                '                                                    <div class="close" onclick="deleteElement('+_temporalID+',\'contenido-blog-\', \'\', \'false\')"> <i class="fa fa-times"></i> </div>\n' +
                '                                                    <div class="panel panel-default mar-top-30x">\n' +
                '                                                        <div class="panel-heading">\n' +
                '                                                            <h3 class="panel-title">Video</h3>\n' +
                '                                                        </div>\n' +
                '                                                        <div class="panel-body">\n' +
                '                                                            <center  >\n' +
                '                                                                <div id="preview-video-contenido-'+_temporalID+'" class="espacios">\n' +
                '                                                                    <div class="preview-example"></div>\n' +
                '                                                                </div>\n' +
                '                                                                <input type="file" id="video-contenido-'+_temporalID+'" onchange="showMyImageWH(\'preview-video-contenido-'+_temporalID+'\', this, \'\', 1, 650, 300)" name="video-contenido-'+_temporalID+'" class="filestyle" data-input="false" data-buttonText="Imagen Portada" data-iconName="fa fa-picture-o" data-badge="true">\n' +
                '                                                                <p class="help-block">Solo se aceptan imagenes con formato .JPG, .JPEG, .PNG, la imagen debe ser menor a 3 MB.</p>\n' +
                '                                                            </center>\n' +
                '                                                            <div class="input-group espacios">\n' +
                '                                                                <span class="input-group-addon">Url</span>\n' +
                '                                                                <input type="text" name="url-contenido-'+_temporalID+'" data-validate="true" class="form-control" placeholder="Ingresa la url del video.." value="">\n' +
                '                                                            </div>\n' +
                '                                                        </div>\n' +
                '                                                    </div>\n' +
                '                                                </div>';
			_content.append(_html);
			setTimeout(function(){
				initFileStyleVideoBlog(_temporalID);
				window.location.hash = '#contenido-blog-'+_temporalID;
				_temporalID ++;
			},100);
		break;
		case '4':
			/*_html = '<div class="col-lg-6 col-lg-offset-3 col-md-12 col-xs-12" id="contenido-blog-'+_temporalID+'">'+
					    '<div class="close" onclick="deleteElement('+_temporalID+', \'contenido-blog-\', \'\', \'false\')"> <i class="fa fa-times"></i> </div>'+
					    '<input type="hidden" name="temporal-id[]" value="'+_temporalID+'">'+
					    '<input type="hidden" name="tipo-contenido[]" value="'+_tipo+'">'+
					    '<center>'+
							'<input type="file" multiple id="galeria-contenido-'+_temporalID+'"  name="galeria-contenido-'+_temporalID+'[]" class="filestyle">'+
							'<p class="help-block">Solo se aceptan imagenes con formato .JPG, .JPEG, .PNG, la imagen debe ser menor a 3 MB.</p>'+
						'</center>'+
						'<div class="col-md-12 col-xs-12">'+
							'<div class="row" id="preview-galeria-contenido-'+_temporalID+'"></div>'+
						'</div>'+
						'<hr class="divisor-seccion">'+
					'</div>';*/

			_html = '<!-- CONTENIDO GALERIA -->\n' +
                '                                                <div class="col-lg-10 col-lg-offset-1 col-md-12" id="contenido-blog-'+_temporalID+'">\n' +
                '                                                    <div class="close" onclick="deleteElement('+_temporalID+',\'contenido-blog-\', \'\', \'false\')"> <i class="fa fa-times"></i> </div>\n' +
                '                                                    <input type="hidden" name="temporal-id[]" value="'+_temporalID+'">'+
                '                                                    <input type="hidden" name="tipo-contenido[]" value="'+_tipo+'">'+
                '                                                    <div class="panel panel-default mar-top-30x">\n' +
                '                                                        <div class="panel-heading">\n' +
                '                                                            <h3 class="panel-title">Galería</h3>\n' +
                '                                                        </div>\n' +
                '                                                        <div class="panel-body">\n' +
                '                                                            <center>\n' +
                '                                                                <input type="file" multiple id="galeria-contenido-'+_temporalID+'" name="galeria-contenido-'+_temporalID+'[]" class="filestyle" data-input="false" data-buttonText="Galeria" data-iconName="fa fa-picture-o" data-badge="true">\n' +
                '                                                                <p class="help-block">Solo se aceptan imagenes con formato .JPG, .JPEG, .PNG, la imagen debe ser menor a 3 MB.</p>\n' +
                '                                                            </center>\n' +
                '                                                        </div>\n' +
                '                                                    </div>\n' +
                '                                                </div>'
			_content.append(_html);
			setTimeout(function(){
				initFileStyleGaleriaBlog(_temporalID);
				window.location.hash = '#contenido-blog-'+_temporalID;
				_temporalID ++;
			},100);
		break;
	}

}

$('#add-texto').on('click', function(){
	addContenido('1');
})
$('#add-imagen').on('click', function(){
	addContenido('2');
})
$('#add-video').on('click', function(){
	addContenido('3');
})
$('#add-galeria').on('click', function(){
	addContenido('4');
})


function initSummernoteBlog(id){
	var _options = {
		height: 150,
		focus: false,
		toolbar: [
    		//[groupname, [button list]]
    		['style', ['bold', 'italic', 'underline', 'clear']],
  		],
  		onpaste: function(e) {
            var thisNote = $(this);
            var updatePastedText = function(someNote){
            	var original = someNote.code();
                var cleaned = CleanPastedHTML(original); //this is where to call whatever clean function you want. I have mine in a different file, called CleanPastedHTML.
                someNote.code('').html(cleaned); //this sets the displayed content editor to the cleaned pasted code.
            };
            setTimeout(function () {
                updatePastedText(thisNote);
            }, 10);
            var bufferText = ((e.originalEvent || e).clipboardData || window.clipboardData).getData('Text');
            e.preventDefault();
            document.execCommand('insertText', false, bufferText);
        }
	};

	$("#contenido-descripcion-"+id+"-es").summernote(_options);
    $("#contenido-descripcion-"+id+"-en").summernote(_options);
    $("#contenido-descripcion-"+id+"-fr").summernote(_options);
	//$("#desc-cont-"+id+"-en").summernote(_options);
}

function initFileStyleImagenBlog(_id){
	 $('#img-contenido-'+_id).filestyle({
	 	input: false,
	   	buttonText: "Imagen",
	   	iconName: "fa fa-picture-o",
	 });
}

function initFileStyleVideoBlog(_id){
	 $('#video-contenido-'+_id).filestyle({
	 	input: false,
	   	buttonText: "Portada Video",
	   	iconName: "fa fa-picture-o",
	 });
}

function initFileStyleGaleriaBlog(_id){
	 $('#galeria-contenido-'+_id).filestyle({
	 	input: false,
	   	buttonText: "Subir Imagenes",
	   	iconName: "fa fa-picture-o",
	 });
}

$( "#content-element-blog" ).sortable({
	cursor: "move",
	delay: 150,
	distance: 5,
	forceHelperSize: true,
	handle: ".handle",
	opacity: 0.5,
	revert: true,
	update : function(e, ui) {
		guardarOrdenMovil('contenidoBlog');
	}
});
function guardarOrdenMovil(desde){
	var orden = new Array;
	$(".idorden").each(function(){
		orden.push($(this).val());
	});
	var _initFor = $('#initfor').val();
	if(typeof _initFor != 'undefined'){
		_initFor = _initFor
	}else{
		_initFor = 0;
	}

	$.ajax({
		async:true,
		type: "POST",
		dataType: "html",
		contentType: "application/x-www-form-urlencoded",
		url:"operaciones/operaciones_blog.php",
		data:{"idorden":orden,"operaciones":"ordenar","desde":desde, "initfor" : _initFor},
		success:function(data){
			console.log(data);
			$('.bottom-right').notify({
				message: { text: 'Orden guardado correctamente' },
				type:'blackgloss',
				fadeOut: { enabled: true, delay: 2000 }
			}).show();
		},
		cache:false
	});
}

$('.do-translate').on('click', function(){
	$(this).prop('disabled', true).html('<i class="fa fa-cog fa-spin fa-lg fa-fw"></i>');
    translateToAnyLang('form-validation');
    $(this).prop('disabled', false).html('<i class="fa fa-language"></i> Traducir textos');
});

var _html = ''
