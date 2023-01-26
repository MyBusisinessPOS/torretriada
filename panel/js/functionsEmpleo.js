var _l = 1;
var _html = '';
function addRequisito(){
	_html = '<div id="msgTituloRequisito'+_l+'" class="input-group espacios">'+
		        '<span class="input-group-addon">Titulo Requisito</span>'+
		        '<input type="text" name="tituloRequisito[]" class="form-control" placeholder="Ingresa el titulo del requisito..." value="">'+
		       	'<span class="input-group-btn">'+
        			'<button onclick="deleteRequisito('+_l+', 0)" class="btn btn-default" type="button"> <i class="fa fa-times"></i> </button>'+
      			'</span>'+
		   	'</div>';
	$('#new-requisito').append(_html);
	_l++;	   	
}

function deleteRequisito(_id, bd){
	if(bd == 0){
		$('#msgTituloRequisito'+_id).remove();
	}else{
		$.post('operaciones.php', {'operaciones' : 'eliminarRequisito', 'idRequisito' : _id}, function(data){
			$('#msgTituloRequisitoMod'+_id).fadeOut('fast', function() {
				$(this).remove();
			});
		})
	}
}
