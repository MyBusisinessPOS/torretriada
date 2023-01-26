$(document).on('click', '.buttonagregar', function(){
	$('.modal-title').text('Agregar Año');
	$('#operaciones').val('agregarvendido');
	$('#MOD').val('0');
	emptyInput();
	$('#preview-sucursal').html('<div class="preview-example"></div>');
	$('#preview-sucursal-movil').html('<div class="preview-example"></div>');
	$('#modal-edit-table').modal('show');	
});

$(document).on('click', '.edit', function(){
	$('.modal-title').text('Modificar Año');
	$('#operaciones').val('modificarvendido');
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
	$('#descripcionEs').eq(0).code('');
	$('#descripcionEn').eq(0).code('');

}

function getData(_data){
	$('#id').val(_data.id);
	$('#tituloEs').val(_data.titulo);
	$('#subtituloEs').val(_data.subtitulo);
	$('#descripcionEs').eq(0).code(_data.descripcion);
	$('#tituloEn').val(_data.tituloen);
	$('#subtituloEn').val(_data.subtituloen);
	$('#descripcionEn').eq(0).code(_data.descripcionen);
}

$(document).on('click', '.editmap', function(){		
	$('#modal-edit-map').modal('show');
});