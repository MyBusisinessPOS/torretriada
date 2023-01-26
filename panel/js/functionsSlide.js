$(document).on('click', '.buttonagregar', function(){
	$('.modal-title').text('Agregar Slide');
	$('#operaciones').val('agregarslide');
	$('#MOD').val('0');
	emptyInput();
	$('#preview-slide').html('<div class="preview-example"></div>');
	$('#preview-slide-movil').html('<div class="preview-example"></div>');
	$('#modal-edit-table').modal('show');
});

$(document).on('click', '.edit', function(){
	$('.modal-title').text('Modificar Slide');
	$('#operaciones').val('modificarslide');
	$('#MOD').val('1');
	getData($(this).data());
	$('#modal-edit-table').modal('show');
});

function emptyInput(){
	$('.modal #form-validation').find('input').each(function(i, e){
		_input = e;
		_type = $(_input).attr('type');
		if(_type === 'text'){
			$(_input).val('');
		}
	});
}

function getData(_data){
	$('#id').val(_data.id);
	$('#preview-slide').html('<img width="auto" height="250px" style="max-width:100%;" src="../img/slide/'+_data.ruta+'">');
	$('#preview-slide-movil').html('<img width="auto" height="250px" style="max-width:100%;" src="../img/slide/'+_data.rutamovil+'">');
	$('#tituloEs').val(_data.tituloes);
	$('#subtituloEs').val(_data.subtituloes);
	$('#subtitulo2Es').val(_data.subtitulo2es);
	$('#subtitulo3Es').val(_data.subtitulo3es);
	$('#linkEs').val(_data.linkes);
	$('#linkVideoEs').val(_data.linkvideoes);
	$('#tituloEn').val(_data.tituloen);
	$('#subtituloEn').val(_data.subtituloen);
	$('#subtitulo2En').val(_data.subtitulo2en);
	$('#subtitulo3En').val(_data.subtitulo3en);
	$('#linkEn').val(_data.linken);
	$('#linkVideoEn').val(_data.linkvideoen);
}