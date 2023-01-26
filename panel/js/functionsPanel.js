alertify.defaults.glossary.title = "¡ATENCION!";
alertify.defaults.transition = "slide";
alertify.defaults.theme.ok = "btn btn-primary";
alertify.defaults.theme.cancel = "btn btn-danger";
alertify.defaults.theme.input = "form-control";
$(document).ready(function() {
/* ==========================================================
 * 	AÑADE LOS TOOLTIPS A LOS INPUTS TYPE FILE
 * ========================================================== */
 	$('.apply-tooltip').each(function(){
		var _dataTitle = $(this).attr('data-original-title');
		$(this).siblings('.bootstrap-filestyle').attr('rel', 'tooltip');
	    $(this).siblings(".bootstrap-filestyle").attr("data-toggle", "tooltip");
	    $(this).siblings('.bootstrap-filestyle').attr('data-placement', 'top');
	    $(this).siblings(".bootstrap-filestyle").attr("data-original-title", _dataTitle);

	});
/* ==========================================================
 * 	INICIALIZA LOS TOOLTIPS
 * ========================================================== */
	$('[rel="tooltip"]').tooltip();
/* ==========================================================
 * 	BAJA EL FOOTER
 * ========================================================== */
	var docHeight = $(window).height();
   	var footerHeight = $('#footer').height();
   	var footerTop = $('#footer').position().top + footerHeight;
	if (footerTop < docHeight) {
    	$('#footer').css('margin-top', -75+ (docHeight - footerTop) + 'px');
   	}
});

$("#menu-toggle").click(function(e) {
    e.preventDefault();
    $("#wrapper").toggleClass("active");
});

$('.submenu-trigger').click(function() {
	$('.submenu').removeClass('activo');
	var _target = $(this).attr('data-target-submenu');
	var _targetContent = $('#'+_target);
	if(_targetContent.hasClass('activo')){
		_targetContent.removeClass('activo');
	}else{
		_targetContent.addClass('activo');
	}
});

/**
 * DESACTIVA EL SUBMIT CON EL BOTON ENTER
 */

$('#form-validation').on('keyup keypress', function(e) {
  var keyCode = e.keyCode || e.which;
  if (keyCode === 13) {
    e.preventDefault();
    return false;
  }
});

/* ==========================================================
 * 	Opciones e inicialización del datetimepicker
 * 	Solo ponerle al input la clase "apply-date"
 * 	Se debe crear un input hidden con el ID "fechaFinal"
 * 	para que este se guarde en la bd
 * ========================================================== */
var pickerOptsGeneral = {
	locale:  "es",
	format: 'LL',
	useCurrent: false
};
$('.apply-date').datetimepicker(pickerOptsGeneral);
$('.apply-date').on('dp.change', function(e){
	var formatted = moment(e.date, 'LL').format('YYYY-MM-DD');
	$('#fechaFinal').val(formatted);
})
/* ==========================================================
 * 	INICIALIZA EL PRICE FORMAT
 * 	Solo ponerle al input la clase "apply-priceFormat"
 * ========================================================== */
$('.apply-priceFormat').priceFormat({
	prefix: '',
	thousandsSeparator: '',
	limit: 10,
	centsLimit: 2
})
/* ==========================================================
 * 	Función para inicializar el price format con inputs
 * 	dinamicos
 * ========================================================== */
function initPriceFormat(){
	$('.apply-priceFormat').priceFormat({
	    prefix: '',
		thousandsSeparator: '',
		limit: 10,
		centsLimit: 2
	})
}
/* ==========================================================
 * 	INICIALIZA LOS TAGS EN EL INPUT
 * 	Solo ponerle al input la clase "apply-tags"
 * ========================================================== */
$('.apply-tags').tagsInput({
    'defaultText':'Añadir Tag',
    'width':'500px'
});
/* ==========================================================
 * Función que marca y desmarca todos los chekbox de los
 * listados.
 * ========================================================== */
function marcartodos(source){
	checkboxes = document.getElementsByTagName('input'); //obtenemos todos los controles del tipo Input
    for(i = 0; i < checkboxes.length; i++){ //recoremos todos los controles
        if(checkboxes[i].type == "checkbox"){ //solo si es un checkbox entramos
            checkboxes[i].checked = source.checked; //si es un checkbox le damos el valor del checkbox que lo llamó (Marcar/Desmarcar Todos)
        }
    }
}
/* ==========================================================
 * Función finaliza la sesion del panel
 * ========================================================== */
function cerrarsesion(id){
	$.post('operaciones.php', {'idusuario': id, 'operaciones' : 'cerrarsesion'}, function(data) {
		if(data == 1){
	        window.location.href='index.php';
	   	}
	});
}
/* ==========================================================
 * Inicializa los popovers del menu superior derecho
 * ========================================================== */
$(function() {
	$('.settingss').popover({
		placement: 'bottom',
		trigger: 'click',
		html: 'true',
		title: 'Configuraciones',
		content: '<ul class="submenupopover">'+
					'<li><a  href="listusuarios.php" class="menupopover">Usuarios panel</a></li>'+
					'<li class="submenulinea"></li>'+
					'<li><a  href="listtipousuario.php" class="menupopover">Asignar permisos</a></li>'+
					'<li class="submenulinea"></li>'+
					'<li><a href="formcontacto.php" class="menupopover">contacto</a></li>'+
					'<li class="submenulinea"></li>'+
					'<li><a  href="formSettingsEmail.php" class="menupopover">Configurar Correo</a></li>'+
					'<li class="submenulinea"></li>'+
					'<li><a  href="formSeo.php" class="menupopover">Configurar Metas</a></li>'+
					'<li class="submenulinea"></li>'+
					'<li><a  href="formImgConfiguracion.php" class="menupopover">Configurar Valor Imagenes</a></li>'+
					'<li class="submenulinea"></li>'+
				'</ul>',
		container: 'body'
	});
	$('.userr').popover({
		placement: 'bottom',
		trigger: 'click',
		html: 'true',
		title: 'Configuraciones de la cuenta',
		content: '<ul class="submenupopover">'+
					'<li><a href="formusuario.php?idusuario='+_IDUSUARIO+'" class="menupopover">Editar mi usuario</a></li>'+
					'<li class="submenulinea"></li>'+
				'</ul>',
		container: 'body'
	});
/* ==========================================================
 * Funciones para el sortable de las tablas y el sortable
 * de las imagenes secundarias.
 * ========================================================== */
	$( "#sortable" ).sortable({
	    cursor: "move",
	    cursorAt: { right: 500 },
	    delay: 150,
	    distance: 5,
	    forceHelperSize: true,
	    handle: ".handle",
	    opacity: 0.5,
	    revert: true,
	    update : function(e, ui) {
	    	guardarOrden(_SORT);
	    }
	});
	$( "#sortableBlog" ).sortable({
	    cursor: "move",
	    cursorAt: { right: 500 },
	    delay: 150,
	    distance: 5,
	    forceHelperSize: true,
	    handle: ".handle",
	    opacity: 0.5,
	    revert: true,
	    update : function(e, ui) {
	    	guardarOrdenBlog(_SORT);
	    }
	});
	$( "#sortableImg" ).sortable({
	    cursor: "move",
	    delay: 150,
	    distance: 5,
	    forceHelperSize: true,
	    handle: ".handle",
	    opacity: 0.5,
	    revert: true,
	    update : function(e, ui) {
	    	guardarOrden(_SORT);
	    }
	});
/* ==========================================================
 * Inicializa los tooltips de los botones de las tablas
 * ========================================================== */
	$('.handle').tooltip({
		placement: "top",
        title: "Cambiar Orden"
	});
	$('.ver').tooltip({
		placement: "top",
        title: "Mostrar"
	});
	$('.nover').tooltip({
		placement: "top",
        title: "Ocultar"
	});
});
/* ==========================================================
 * Función que guarda el orden de las tablas y las imagenes
 * secundarias
 * ========================================================== */
function guardarOrden(desde){
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
		url:"operaciones.php",
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
function guardarOrdenBlog(desde){
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
/* ==========================================================
 * Inicializa el filestyle de los inputs
 * ========================================================== */
$("#files").filestyle({
   	input: false,
   	buttonText: "Seleccione una imagen",
   	iconName: "glyphicon-camera",
   	badges: false,
});
$("#files2").filestyle({
   	input: false,
   	buttonText: "Seleccione las imágenes",
   	iconName: "glyphicon-camera",
});
/* ==========================================================
 * Función que cambia los status de las tablas
 * ========================================================== */
function changeStatus(id,status,operaciones){
	$.ajax({
		async:true,
		type: "POST",
		dataType: "html",
		contentType: "application/x-www-form-urlencoded",
		url:"operaciones.php",
		data:"id="+id+"&operaciones="+operaciones+"&status="+status+"",
		success:function(data){
			if(status == 1){
				$("#temp"+id).attr("src", "img/visible.png");
				$("#temp"+id).attr("onclick", "changeStatus("+id+",0,'"+operaciones+"')");
				$("#temp"+id).tooltip('hide');
				$("#temp"+id).data('bs.tooltip').options.title = 'Ocultar';
				$("#temp"+id).tooltip('show');
			}else{
				$("#temp"+id).attr("src", "img/invisible.png");
				$("#temp"+id).attr("onclick", "changeStatus("+id+",1,'"+operaciones+"')");
				$("#temp"+id).tooltip('hide');
				$("#temp"+id).data('bs.tooltip').options.title = 'Mostrar';
				$("#temp"+id).tooltip('show');
			}
		},
		cache:false
	});
}
function changeStatusBlog(id,status,operaciones){
	$.ajax({
		async:true,
		type: "POST",
		dataType: "html",
		contentType: "application/x-www-form-urlencoded",
		url:"operaciones/operaciones_blog.php",
		data:"id="+id+"&operaciones="+operaciones+"&status="+status+"",
		success:function(data){
			if(status == 1){
				$("#temp"+id).attr("src", "img/visible.png");
				$("#temp"+id).attr("onclick", "changeStatusBlog("+id+",0,'"+operaciones+"')");
				$("#temp"+id).tooltip('hide');
				$("#temp"+id).data('bs.tooltip').options.title = 'Ocultar';
				$("#temp"+id).tooltip('show');
			}else{
				$("#temp"+id).attr("src", "img/invisible.png");
				$("#temp"+id).attr("onclick", "changeStatusBlog("+id+",1,'"+operaciones+"')");
				$("#temp"+id).tooltip('hide');
				$("#temp"+id).data('bs.tooltip').options.title = 'Mostrar';
				$("#temp"+id).tooltip('show');
			}
		},
		cache:false
	});
}
function changeDestacado(_id,_status,_operaciones){
	$.post('operaciones.php',{operaciones : _operaciones, id : _id, status : _status}, function(data){
		console.log(data);
		if(_status == 1){
			if(data == 1){
				$("#dest"+_id).removeClass('fa-toggle-off').addClass('fa-toggle-on');
				$("#dest"+_id).attr("onclick", "changeDestacado("+_id+",0,'"+_operaciones+"')");
			}else{
				alertify.alert('Se ha alcanzado el máximo de productos destacados. Desactive alguno y vuelva a intentarlo.')
			}
		}else{
			$("#dest"+_id).removeClass('fa-toggle-on').addClass('fa-toggle-off');
			$("#dest"+_id).attr("onclick", "changeDestacado("+_id+",1,'"+_operaciones+"')");
		}
	})
}
/* ==========================================================
 * Funciones para listar, paginar y filtrar las tablas
 * ========================================================== */
var _tablesorter = "";
var _busqueda = "";
var _permisoAcDc = $('#permisoAcDc').val();
var _permisoSortable = $("#valorpermiso").val();
var _registroPorPagina = $('#registrosPorPagina').val();
function listar(pagina) {
	_registroPorPagina = $('#registrosPorPagina').val();
	if(_busqueda != ""){
		_permisoSortable = 0;
	}
	if(typeof $('#filtroTipo').val() != 'undefined' && $('#filtroTipo').val() != '-1')
		tipo = $('#filtroTipo').val();
	else
		tipo = 0;

	( $('input[name="tipo"]').length > 0) ? _tipo_pro = $('input[name="tipo"]').val() :  _tipo_pro = 1;
	$.ajax({
		async : true,
		type : "POST",
		dataType : "html",
		contentType : "application/x-www-form-urlencoded",
		url : "operaciones.php",
		data : {
			"cadena" : _busqueda,
			"operaciones" : _OPERA_LIST,
			"pagina": pagina,
			"tipo": _tipo_pro,
			"permisoAcDc" : _permisoAcDc,
			"permisoSortable" : _permisoSortable,
			"registrosPorPagina" : _registroPorPagina
		},
		success : getInformation,
		beforeSend : SendInformation,
		cache : false
	});
}

function regPP(_value){
	$("#paginador").html('');
	( $('input[name="tipo"]').length > 0) ? _tipo_pro = $('input[name="tipo"]').val() :  _tipo_pro = 1;
	$.ajax({
		async : true,
		type : "POST",
		dataType : "html",
		contentType : "application/x-www-form-urlencoded",
		url : "operaciones.php",
		data : {
			"cadena" : _busqueda,
			"operaciones" : _OPERA_LIST,
			"pagina": 1,
			"tipo": _tipo_pro,
			"permisoAcDc" : _permisoAcDc,
			"permisoSortable" : _permisoSortable,
			"registrosPorPagina" : _value
		},
		success : getInformation,
		beforeSend : SendInformation,
		cache : false
	});
}

function filtrarRegistro(value){
	$("#paginador").html('');
	( $('input[name="tipo"]').length > 0) ? _tipo_pro = $('input[name="tipo"]').val() :  _tipo_pro = 1;
	if(value == "-1"){
		listar(1);
	}else{
		$.ajax({
			async : true,
			type : "POST",
			dataType : "html",
			contentType : "application/x-www-form-urlencoded",
			url : "operaciones.php",
			data : {
				"registrosPorPagina" : _registroPorPagina,
				"operaciones" : _OPERA_LIST,
				"pagina": 1,
				"tipo": _tipo_pro,
			},
			success : getInformation,
			beforeSend : SendInformation,
			cache : false
		});
	}
}
function buscar(cadena){
	if(cadena!=""){

		_busqueda = cadena;
		_tablesorter = "";
		if(typeof $('#filtroTipo').val() != 'undefined' && $('#filtroTipo').val() != '-1')
			tipo = $('#filtroTipo').val();
		else
			tipo = 0;
		_registroPorPagina = $('#registrosPorPagina').val();
		( $('input[name="tipo"]').length > 0) ? _tipo_pro = $('input[name="tipo"]').val() :  _tipo_pro = 1;
		$.ajax({
			async : true,
			type : "POST",
			dataType : "html",
			contentType : "application/x-www-form-urlencoded",
			url : "operaciones.php",
			data : {
				"cadena" : cadena,
				"tipo" : tipo,
				"operaciones" : _OPERA_LIST,
				"pagina": 1,
				"tipo": _tipo_pro,
				"permisoAcDc" : _permisoAcDc,
				"registrosPorPagina" : _registroPorPagina,
			},
			success : getInformation,
			beforeSend : SendInformation,
			cache : false
		});
	}else{
		_busqueda = "";
		listar(1);
	}
}
function getInformation(data) {
	//console.log(data);
	var resultado = JSON.parse(data);
	var htmlpaginador = "";
	$("tbody").empty();
	$("tbody").append(resultado[0].tabla).fadeIn(1000);
	$("#paginador").html(resultado[0].paginador);
	$("table").tablesorter();
    $("table").trigger("update");
    var sorting = [[0,0]];
}

function SendInformation() {
	$("tbody").html("<tr>" + "<td colspan='10'>" + "<center><i class='fa fa-spinner fa-pulse'></i></center>" + "</td>" + "</tr>");
}
/* ==========================================================
 * Función previzualiza las imagenes primarias y las
 * secundarias
 * ========================================================== */
function showMyImage(id,fileInput,secundarias) {
    if(secundarias == true){
        $("#"+id).empty();
        $("#tituloSecundarias").empty();
        var div = document.createElement('center');
        div.innerHTML = ['<p class="titulo">Imágenes Nuevas</p><br>'].join('');
        document.getElementById('tituloSecundarias').insertBefore(div, null);
    }
    var files = fileInput.files;
    // Loop through the FileList and render image files as thumbnails.
    for (var x = 0, f; f = files[x]; x++) {
        // Only process image files.
        if (!f.type.match('image.*')) {
           	continue;
        }
        var reader = new FileReader();
        // Closure to capture the file information.
        reader.onload = (function(theFile) {
        return function(e) {
        // Render thumbnail.
        if(secundarias == true){
            // Render thumbnail.
            var span = document.createElement('div');
            span.className = "col-lg-4 col-md-4 col-sm-6 col-xs-12";
            span.innerHTML = ['<center><img style="padding: 20px" width="100%" height="250px" src="', e.target.result,
                                        '" title="', escape(theFile.name), '"/></center>'].join('');
            document.getElementById(id).insertBefore(span, null);
        }else{var span = document.createElement('span');
            span.innerHTML = ['<img width="auto" height="221" style="max-width:100%" src="', e.target.result,
                                        '" title="', escape(theFile.name), '"/>'].join('');
            $("#"+id).empty();
            document.getElementById(id).insertBefore(span, null);}
        };
    })(f);
    // Read in the image file as a data URL.
    reader.readAsDataURL(f);
    }
}
/* ==========================================================
 * Función previzualiza las imagenes primarias y las
 * secundarias con un height y width
 * ========================================================== */
var _URL = window.URL || window.webkitURL;
function showMyImageWH(id,fileInput,height,tipo, _width, _height) {
	//var files = evt.target.files; // FileList object
    var files = fileInput.files;
	// Loop through the FileList and render image files as thumbnails
	if(tipo == 1){
		var imgerrors = false;
	    var msg = "";
	    var control = $(fileInput);

	    //for (var i = 0; i < fileInput.files.length; i++) {
		    if ((file = fileInput.files[0])) {
		        img = new Image();
		        img.onload = function() {
		        	var _img = this.src;
		        	if(this.width == _width && this.height == _height){
		        		imgerrors = true;
		        	}else{
		        		msg = _width+" x "+_height;
		        		imgerrors = false;
		        	}

		            if(imgerrors){
					    //$("#"+id).html('<img width="100%" height="'+_height+'" src="'+this.src+'" />');
					    $("#"+id).html('<img width="auto" height="250px" src="'+this.src+'" />');
		            }else{
		            	alertify.confirm('La resolución optima es de '+_width+'px X '+_height+' ¿Desea Continuar?', function(){
		            		//$("#"+id).html('<img width="100%" height="'+_height+'" src="'+_img+'" />');
		            		$("#"+id).html('<img width="auto" style="max-height:100%;max-width:100%;" height="auto" src="'+_img+'" />');
		            	}, function(){
		            		$("#"+id).html('<div class="preview-example"></div>');
							control.filestyle('clear');
		            	});
		            }
		        };
		        img.onerror = function() {
		            control.filestyle('clear');
		        };
		        img.src = _URL.createObjectURL(file);
		    }
		//}

	}else{
		var imgerrors = false;
	    var msg = "";
	    var control = $(fileInput);
		for (var i = 0; i < fileInput.files.length; i++) {
		    if ((file = fileInput.files[i])) {
		        img = new Image();
		        img.onload = function() {
		        	var _img = this.src;

		        	if(_height != 0){
		        		if(this.width == _width && this.height == _height){
			        		imgerrors = true;
			        	}else{
			        		msg = _width+" x "+_height;
			        		imgerrors = false;
			        	}
		        	}else{
		        		console.log(_height+'-'+this.height);
		        		if(this.width == _width){
			        		imgerrors = true;
			        	}else{
			        		msg = _width+" x "+_height;
			        		imgerrors = false;
			        	}
		        	}


		            if(imgerrors){
					    //$("#"+id).html('<img width="100%" height="'+_height+'" src="'+this.src+'" />');
					    $("#"+id).html('<img width="100%" height="auto" src="'+this.src+'" />');
		            }else{
		            	(_height != 0) ? _pedazo = 'X '+_height+'' : _pedazo = '';
		            	alertify.confirm('La resolución optima es de '+_width+'px '+_pedazo+' ¿Desea Continuar?', function(){
		            		//$("#"+id).html('<img width="100%" height="'+_height+'" src="'+_img+'" />');
		            		$("#"+id).html('<img width="100%" height="auto" src="'+_img+'" />');
		            	}, function(){
		            		$("#"+id).html('<div class="preview-example"></div>');
							control.filestyle('clear');
		            	});
		            }
		        };
		        img.onerror = function() {
		            control.filestyle('clear');
		        };
		        img.src = _URL.createObjectURL(file);
		    }
		}
	}

}
/* ==========================================================
 * Función para remover estilos del sumernote
 * ========================================================== */
function CleanPastedHTML(input) {
	// 1. remove line breaks / Mso classes
	var stringStripper = /(\n|\r| class=(")?Mso[a-zA-Z]+(")?)/g;
	var output = input.replace(stringStripper, ' ');
	// 2. strip Word generated HTML comments
	var commentSripper = new RegExp('<!--(.*?)-->','g');
	var output = output.replace(commentSripper, '');
	var tagStripper = new RegExp('<(/)*(meta|link|span|\\?xml:|st1:|o:|font)(.*?)>','gi');
	// 3. remove tags leave content if any
	output = output.replace(tagStripper, '');
	// 4. Remove everything in between and including tags '<style(.)style(.)>'
	var badTags = ['style', 'script','applet','embed','noframes','noscript'];
	for (var i=0; i< badTags.length; i++) {
		tagStripper = new RegExp('<'+badTags[i]+'.*?'+badTags[i]+'(.*?)>', 'gi');
		output = output.replace(tagStripper, '');
	}
	// 5. remove attributes ' style="..."'
	var badAttributes = ['style', 'start'];
	for (var i=0; i< badAttributes.length; i++) {
		var attributeStripper = new RegExp(' ' + badAttributes[i] + '="(.*?)"','gi');
		output = output.replace(attributeStripper, '');
	}
	return output;
}
/* ==========================================================
 * Función que inicializa el summernote con la funcionalidad
 * de contar caracteres.
 * [
 * 		Agregar los siguientes data e inputs
 *   	para su funcionamiento:
 *   	data-limit : limite de caracteres para este input
 *   	data-count : id donde se mostrará el conteo de
 *   				 caracteres.
 *   	Crear un etiqueta p con el id del data-count.
 * ]
 * ========================================================== */
function initSummernote(id){
	$("#"+id).summernote({
		height: 150,
		focus: false,
		toolbar: [
    		//[groupname, [button list]]
    		['style', ['bold', 'italic', 'underline', 'clear']],
  		],
  		onkeyup: function(e) {

            var _num = $("#"+id).code().replace(/(<([^>]+)>)/ig,"").length;
            var _limit = $("#"+id).attr('data-limit');
            var _countContent = $("#"+id).attr('data-count');
            console.log(_num);
            if (_num < _limit){
                $('#'+_countContent).html('Caracteres : '+_num+' de '+_limit).css('color', '');
            } else {
                $('#'+_countContent).html('Caracteres : '+_num+' de '+_limit).addClass('color', 'red');
            }
         },
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
	});
}

function initSummernoteLi(id){
	$("#"+id).summernote({
		height: 150,
		focus: false,
		toolbar: [
    		//[groupname, [button list]]
			['para',['ul']]
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
        }
	});
}

function initSummerPolitix(id) {
	$("#"+id).summernote({
		height: 200,
		minHeight: 200,
		maxHeight: 400,
		focus: false,
		toolbar: [
    		// [groupname, [button list]]
    		// ['style', ['bold', 'italic', 'underline', 'clear']]
    		['para', ['ul']]
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
	});
}
/* ==========================================================
 * Función que busca los textarea para inicializar el
 * sumernote
 * ========================================================== */
$('form').find('textarea').each(function(){
	var _textarea = $(this);
	var _textareaID = _textarea.attr('id');
	var _textareaData = _textarea.attr('data-summer');
  var _textareaDataLi = _textarea.attr('data-summer-li');
	var _textareaPolitix = _textarea.attr('data-politix');
	if(_textareaData == 'true' && typeof _textareaData !== 'undefined' ){
		initSummernote(_textareaID);
	}
  if(_textareaDataLi == 'true' && typeof _textareaDataLi !== 'undefined' ){
		initSummernoteLi(_textareaID);
	}
	else if (_textareaPolitix == 'true' && typeof _textareaPolitix !== 'undefined' ){
		initSummerPolitix(_textareaID);
	}
})
/* ==========================================================
 * Realiza el submit a los formularios pero antes los valida.
 * ========================================================== */
$('.buttonguardar').click(function() {
	if(validateAnyForm('form-validation')){
		$('#form-validation').submit();
	}else{
		//console.log('no enytre');
	}
});
$('.submitform').click(function(){
	var idform = $(this).data('idform');
	if(validateAnyForm(idform)){
		$('#'+idform).submit();
	}else{
		//console.log('no enytre');
	}
})
/* ==========================================================
 * Función para validar los formularios.
 * [
 * 		Agregar los siguientes datas a los inputs:
 * 		data-validate = true/false,
 * 		data-text(para los inputs type file)
 * 		data-type-file(para validar los formatos de los archivos pueden ser imagen || pdf)
 * ]
 * ========================================================== */
function validateAnyForm(_idForm){
	var _valid = true,
	_message = 'NO SE HA PODIDO ENVIAR LA INFORMACIÓN. <br>VERIFIQUE LOS SIGUIENTES ERRORES PARA PODER CONTINUAR <br><br>';

	$('#'+_idForm).find('select').each(function(){
		var _select = $(this);
		var _namebyid = _select.attr('data-text');
		var _data_valid = _select.attr('data-validate');
		var _valueSelect = _select.val();

		if((_valueSelect == "0" || _valueSelect == null) && _data_valid == 'true'){
			_valid = false;
			_select.addClass('error');
			_message += _namebyid+' no seleccionada(o). <br>';
		}
		else{
			_select.removeClass('error');
		}
	});


	$('#'+_idForm).find(':input').each(function(){
	var _input = $(this);
	var _type = _input.attr('type');
	var _name = _input.attr('name');
	var _value = _input.val();
	var _dataValid = _input.attr('data-validate');
	var _placeholder = _input.attr('placeholder');
	var _dataText = _input.attr('data-text');
	var _dataTypeFile = _input.attr('data-type-file');
	var _updateFile = '';
	if((_type == 'number' || _type == 'password') && _dataValid == 'true'){
		if(_value == null || _value.length == 0 || /^\s+$/.test(_value)){
			_valid = false;
			_input.addClass('error');
			(typeof _dataText === 'undefined' || typeof _dataText === null) ? _message += _placeholder+' vacío <br>' : _message += _dataText+' vacío <br>'
		}else{
			_input.removeClass('error');
		}
	}
	if(_type == 'text' && _dataValid == 'true'){
		if(_value == '' || /^\s+$/.test(_value)){
			_valid = false;
			_input.parent().addClass('has-error');
			_message += _placeholder+' <br>';
		}
		else{
			_input.parent().removeClass('has-error');
		}
	}

	(_MOD != '') ? _updateFile = _MOD : _updateFile = $('#MOD').val();

	if(_type == 'file' && _dataValid == 'true' && _updateFile == 0 && _dataTypeFile == 'imagen'){
		if(!_value.match(/(?:jpg|png|jpeg|JPG|PNG|JPEG|svg)$/)) {
			var _label = $("label[for='"+$(this).attr('id')+"']");
			_label.removeClass('btn-default').addClass('btn-danger');
			_valid = false;
			_message += _dataText+' esta vacío o el formato es inválido. Formatos Aceptados(.jpg, .png y .jpeg)<br>';
		}else{
			var _fileSize = _input[0].files[0].size;
			if(_fileSize > 3000000){
				var _label = $("label[for='"+$(this).attr('id')+"']");
				_label.removeClass('btn-default').addClass('btn-danger');
				_valid = false;
				_message += 'El archivo que intenta subir en '+_dataText+' es demasiado grande, intente con otro de menor tamaño para poder continuar. Tamaño Máximo 3 Mb<br>';
			}else{
				var _label = $("label[for='"+$(this).attr('id')+"']");
				_label.removeClass('btn-danger').addClass('btn-default');
			}
		}
	}else if(_type == 'file' && _dataValid == 'true' && _updateFile == 1 && _dataTypeFile == 'imagen'){
		if(_value != ''){
			if(!_value.match(/(?:jpg|png|jpeg|JPG|PNG|JPEG|svg)$/)) {
				var _label = $("label[for='"+$(this).attr('id')+"']");
				_label.removeClass('btn-default').addClass('btn-danger');
				_valid = false;
				_message += _dataText+' esta vacío o el formato es inválido. Formatos Aceptados(.jpg, .png y .jpeg)<br>';
			}else{
				var _fileSize = _input[0].files[0].size;
				if(_fileSize > 3000000){
					var _label = $("label[for='"+$(this).attr('id')+"']");
					_label.removeClass('btn-default').addClass('btn-danger');
					_valid = false;
					_message += 'El archivo que intenta subir en '+_dataText+' es demasiado grande, intente con otro de menor tamaño para poder continuar. Tamaño Máximo 3 Mb<br>';
				}else{
					var _label = $("label[for='"+$(this).attr('id')+"']");
					_label.removeClass('btn-danger').addClass('btn-default');
				}
			}
		}
	}
	if(_type == 'file' && _dataValid == 'true' && _updateFile == 0 && _dataTypeFile == 'pdf'){
		if(!_value.match(/(?:pdf|PDF)$/)) {
			var _label = $("label[for='"+$(this).attr('id')+"']");
			_label.removeClass('btn-default').addClass('btn-danger');
			_valid = false;
			_message += _dataText+' esta vacío o el formato es inválido. Formatos Aceptados(.pdf)<br>';
		}else{
			var _fileSize = _input[0].files[0].size;
			if(_fileSize > 3000000){
				var _label = $("label[for='"+$(this).attr('id')+"']");
				_label.removeClass('btn-default').addClass('btn-danger');
				_valid = false;
				_message += 'El archivo que intenta subir en '+_dataText+' es demasiado grande, intente con otro de menor tamaño para poder continuar. Tamaño Máximo 3 Mb<br>';
			}else{
				var _label = $("label[for='"+$(this).attr('id')+"']");
				_label.removeClass('btn-danger').addClass('btn-default');
			}
		}
	}else if(_type == 'file' && _dataValid == 'true' && _updateFile == 1 && _dataTypeFile == 'pdf'){
		if(_value != ''){
			if(!_value.match(/(?:pdf|PDF)$/)) {
				var _label = $("label[for='"+$(this).attr('id')+"']");
				_label.removeClass('btn-default').addClass('btn-danger');
				_valid = false;
				_message += _dataText+' esta vacío o el formato es inválido. Formatos Aceptados(.pdf)<br>';
			}else{
				var _fileSize = _input[0].files[0].size;
				if(_fileSize > 3000000){
					var _label = $("label[for='"+$(this).attr('id')+"']");
					_label.removeClass('btn-default').addClass('btn-danger');
					_valid = false;
					_message += 'El archivo que intenta subir en '+_dataText+' es demasiado grande, intente con otro de menor tamaño para poder continuar. Tamaño Máximo 3 Mb<br>';
				}else{
					var _label = $("label[for='"+$(this).attr('id')+"']");
					_label.removeClass('btn-danger').addClass('btn-default');
				}
			}
		}
	}
	if(_type == 'radio' && _dataValid == 'true'){
		var _radio = $('input[name='+_name+']:checked').val();
		if(typeof _radio === 'undefined'){
			_valid = false;
			_input.parent().addClass('error');
			_message += _name+' sin seleccionar <br>';
		}else{
			_input.parent().removeClass('error');
		}
	}
	if(_type == 'email' && _dataValid == 'true'){
		if(_value.length == 0 || /^\s+$/.test(_value)){
			_valid = false;
			_input.addClass('error');
			_message += _placeholder+' vacío <br>';
		}else if(!validarEmail(_value)){
			_valid = false;
			_input.addClass('error');
			_message += _placeholder+' inválido<br>';
		}else{
			_input.removeClass('error');
		}
	}
})
if(!_valid){
	alertify.alert(_message);
}
return _valid;
}
/* ==========================================================
 * Función que valida los email.
 * ========================================================== */
function validarEmail(_email) {
	_expr = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
	if(!_expr.test(_email) )
		return false;
	else
		return true;
}
/* ==========================================================
 * Función que valido alfanumericos.
 * ========================================================== */
function isAlphaNumeric(val) {
	if (val.match(/^[a-zA-ZÁÉÍÓÚáéíóuñÑ0-9\x20]+$/)){
		return true;
	}else{
		return false;
	}
}
/* ==========================================================
 * Función que elimina cualquier elemento del panel
 * @param  {int} _id [ID del elemento]
 * @param  {varchar} _content     [texto del ID del contenedor del elemento sin el ID ej: "content-image-"]
 * @param  {varchar} _operaciones [Nombre del caso en el operaciones.php ej: "deleteImgProducto"]
 * @param  {varchar} _bd          [Elimina el elemento del Dom{false} o del Dom y la BD{true}]
 * @return {void}
 * ========================================================== */
function deleteElement(_id, _content, _operaciones, _bd){
	if(_bd == 'true'){
		alertify.confirm( '¿Desea Continuar?', function (e) {
			if (e) {
				$.post('operaciones.php',{operaciones : _operaciones, id : _id}, function(data){
					$('#'+_content+_id).fadeOutAndRemove(800);
				});
			}
		})
	}else{
		$('#'+_content+_id).fadeOutAndRemove(800);
	}
}
function deleteElementBlog(_id, _content, _operaciones, _bd){
	if(_bd == 'true'){
		alertify.confirm( '¿Desea Continuar?', function (e) {
			if (e) {
				console.error('entre');
				$.post('operaciones/operaciones_'+_SORT+'.php',{operaciones : _operaciones, id : _id}, function(data){
					console.error(data);
					$('#'+_content+_id).fadeOutAndRemove(800);
				});
			}
		})
	}else{
		$('#'+_content+_id).fadeOutAndRemove(800);
	}
}
/* ==========================================================
 * Efecto de desvanecimiento al eliminar un elemento.
 * ========================================================== */
jQuery.fn.fadeOutAndRemove = function(speed){
    $(this).fadeOut(speed,function(){
        $(this).remove();
    })
}
/* ==========================================================
 * Funcion para añadir imagen con url de vimeo o youtube
 * ========================================================== */
var _v = 0;
function addVideo(_content){
	var _html = '<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12" id="deleteVideo'+_v+'">'+
					'<center class="relative">'+
						'<div class="close" onclick="deleteElement('+_v+', \'deleteVideo\', \'\', \'false\')"><i class="fa fa-times"></i></div>'+
					   	'<div class="espacios" id="preview-video-'+_v+'"></div>'+
					    '<input type="file" data-validate="true" onchange="showMyImage(\'preview-video-'+_v+'\', this)" name="galeriaVideo[]" id="imagen-video-'+_v+'" class="filestyle" data-input="false" data-buttonText="Imagen Video" data-iconName="fa fa-picture-o" data-badge="false">'+
					    '<p class="help-block">Solo se aceptan imagenes con formato .JPG, .JPEG, .PNG, la imagen debe ser menor a 3 MB.</p>'+
					    '<div class="input-group espacios">'+
							'<span class="input-group-addon">URL</span>'+
							'<input type="text" name="urlVideo[]" data-validate="true" class="form-control" placeholder="Ingresa la url" value="">'+
						'</div>'+
					'</center>'+
				'</div>';
	$('#'+_content).append(_html);
	setTimeout(function(){
		initFileStyleVideo(_v)
		_v ++;
	},200);

}
/* ==========================================================
 * Función para inicializar el filestyle del video
 * @param  {int} _id
 * @return {void}
 * ========================================================== */
function initFileStyleVideo(_id){
	 $('#imagen-video-'+_id).filestyle({
	 	input: false,
	   	buttonText: "Imagen Video",
	   	iconName: "fa fa-picture-o",
	 });
}
/* ==========================================================
 * Evento click para añadir el video
 * @param  {varchar} ) {_data_content
 *                     	[
 *                     	Contiene el ID
 *                      donde se añadiran los videos: ej:
 *                      'content-video-producto'
 *                      ]
 *                     }
 * @return {void}
 * ==========================================================*/
$('.addVideo').click(function() {
	var _data_content = $(this).attr('data-content-video');
	addVideo(_data_content);
});
/* ==========================================================
 * Función añadir datos de contacto dinamicamente
 * ========================================================== */
function addDatosContacto(){
	var _html = '<div class="input-group espacios" id="datoC'+_d+'">'+
					'<span class="input-group-addon">Título</span>'+
					'<input type="text" name="tituloListado[]" data-validate="true" class="form-control" placeholder="Ingresa el título" value="">'+
					'<span class="input-group-addon">Valor</span>'+
					'<input type="text" name="descripcionListado[]" data-validate="true" class="form-control" placeholder="Ingresa el valor del dato" value="">'+
					'<span class="input-group-btn">'+
						'<button onclick="deleteElement('+_d+',\'datoC\', \'\', 1)" class="btn btn-default  fa fa-times" type="button"></button>'+
					'</span>'+
				'</div>';
	$('#datos-contacto').append(_html);
	_d++;
}
$('.addDatosContacto').click(function() {
	addDatosContacto();
});
