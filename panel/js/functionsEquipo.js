$(document).on('click', '.buttonagregar', function(){
	$('.modal-title').text('Agregar Equipo');
	$('#operaciones').val('agregarequipo');
	$('#MOD').val('0');
	$('#titulo').val('');
	$('#puestoEs').val('');
	$('#puestoEn').val('');
	$('#descripcion').val('');
	$('#modal-edit-table').modal('show');
})

$(document).on('click', '.edit', function(){
	$('.modal-title').text('Modificar Equipo');
	$('#operaciones').val('modificarequipo');
	$('#MOD').val('1');
	$('#id').val($(this).attr('data-id'));
	$('#titulo').val($(this).attr('data-titulo'));
	$('#puestoEs').val($(this).attr('data-puestoes'));
	$('#puestoEn').val($(this).attr('data-puestoen'));
	$('#descripcion').val($(this).attr('data-descripcion'));
	//$('#descripcion').val($('#desc-'+$(this).attr('data-id')).html());
	$('#modal-edit-table').modal('show');
})

$('#modal-edit-table').on('hidden.bs.modal', function (e) {
	//$('#descripcion').destroy();
})