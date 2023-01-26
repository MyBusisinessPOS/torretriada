$(document).on('click', '.buttonagregar', function(){
	$('.modal-title').text('Agregar Sucursal');
	$('#operaciones').val('agregarsucursal');
	$('#MOD').val('0');
	emptyInput();
	$('#preview-sucursal').html('<div class="preview-example"></div>');
	$('#preview-sucursal-movil').html('<div class="preview-example"></div>');
	$('#modal-edit-table').modal('show');
});

$(document).on('click', '.edit', function(){
	$('.modal-title').text('Modificar Sucursal');
	$('#operaciones').val('modificarsucursal');
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
	$('#preview-sucursal').html('<img width="auto" height="250px" src="../img/sucursal/'+_data.ruta+'">');	
	$('#tituloEs').val(_data.nombre);
	$('#descripcionEs').val(_data.descripcion);	
	$('#tituloEn').val(_data.nombre_en);
	$('#descripcionEn').val(_data.descripcion_en);
	$('#telefono').val(_data.telefono);
	$('#telMovil').val(_data.telmovil);
	$('#email').val(_data.email);
	$('#ubicacion').val(_data.ubicacion);
}

$(document).on('click', '.editmap', function(){		
	$('#modal-edit-map').modal('show');
});