$(document).on('click', '.buttonagregar', function(){
	$('.modal-title').text('Agregar Manual');
	$('#operaciones').val('agregarmanual');
	$('#MOD').val('0');
	emptyInput();
	$('#preview-manual').html('<div class="preview-example"></div>');
	$('#preview-manual-es').html('<div class="preview-example"></div>');
	$('#preview-manual-en').html('<div class="preview-example"></div>');
	$('#modal-edit-table').modal('show');
});

$(document).on('click', '.edit', function(){
	$('.modal-title').text('Modificar Manual');
	$('#operaciones').val('modificarmanual');
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
	$('#descripcionEs').val('');
	$('#descripcionEn').val('');
}

function getData(_data){
	$('#id').val(_data.id);
	$('#preview-manual').html('<img width="auto" height="250px" src="../img/manual/'+_data.ruta+'">');
	$('#preview-manual-es').html('<iframe src="../documents/manual/'+_data.manuales+'" width="100%" height="250px" frameborder="0"></iframe>');
	$('#preview-manual-en').html('<iframe src="../documents/manual/'+_data.manualen+'" width="100%" height="250px" frameborder="0"></iframe>');
	$('#tituloEs').val(_data.tituloes);
	$('#descripcionEs').code($('#descripcionEs-'+_data.id).html());
	$('#tituloEn').val(_data.tituloen);
	$('#descripcionEn').code($('#descripcionEs-'+_data.id).html());
	$('#link').val(_data.link);
}