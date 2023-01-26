$(window).load(function(){
	if($('#multiselect').length > 0)
		$('#multiselect').multiSelect();
	/*var _heigthIzq = $('.izq').height();
	var _heigthDer = $('.der').height();
	console.log(_heigthIzq+'-'+_heigthDer);
	var _residuoHeight = _heigthDer - _heigthIzq;
	var _finalHeight = _heigthIzq - _residuoHeight
	//$('div.note-editable').css('height', _finalHeight+'px');*/
	var _ubicacion = $('input[name="ubicacion"]:checked').val();
	if(_ubicacion == 1){
		$('.content-coordenadas').show('fast');
	}else{
		$('.content-coordenadas').hide('fast');
	}
})


$('input[name="ubicacion"]').on('click', function(){
	var _value = $(this).val();
	if(_value == 1){
		$('.content-coordenadas').show('fast');
	}else{
		$('.content-coordenadas').hide('fast');
	}
})


$('#selectfamilias').on('change',function(){
	var idProducto = $('#idPortafolio').val();
	var idFamilias = $(this).val();

	getCategos(idFamilias,idProducto);
});

$('#selectcategorias').on('change',function(){
	var idProducto = $('#idPortafolio').val();
	var idCategorias = $(this).val();
	
	getSubCategos(idCategorias,idProducto);		
});

$(document).ready(function(){
	var idFamilias = $('#selectfamilias').val();
	var idProducto = $('#idPortafolio').val();
	getCategos(idFamilias,idProducto);
});

function getCategos(idFamilias,idProducto){
	$('#selectcategorias').empty();
	$.each(idFamilias,function(v,c){
		var name = $('#selectfamilias option[value="'+c+'"]').data('name');		
		//console.log(c);
		$.post( "operaciones.php", { operaciones: "getCategoriasProducto", idFamilia : c, idPortafolio: idProducto}, function( data ) {
		  	//console.log(data);
		  	if(data.length > 0){
		  		for(b in data){
		  			//console.log(c);
		  			if(c == data[b].idPadre){
		  				$('#selectcategorias').append('<optgroup label="'+name+'" id="optgroup-'+c+'" data-max-options="2"></optgroup>');
		  			}		  				  			
		  		}
		  		for(d in data){
		  			$('#optgroup-'+c).append('<option data-id="" '+data[d].selected+' value="'+data[d].idPadre+'.'+data[d].idCategoria+'" data-name="'+data[d].tituloEs+'">'+data[d].tituloEs+'</option>');		  			
		  			//console.log(data[d].tituloEs);
		  		}
		  		$('#selectcategorias').selectpicker('refresh');
		  	}
		}, "json");
	});
	setTimeout(function(){
		var idCategorias = $('#selectcategorias').val();
		console.log(idCategorias);
		getSubCategos(idCategorias,idProducto);
	},300);
}
function getSubCategos(idCategorias,idProducto){
	$('#selectsubcategorias').empty();
	$.each(idCategorias,function(v,c){
		//console.log(c);	
		var id = c.split(".");
		var name = $('#selectcategorias option[value="'+c+'"]').data('name');

		$.post( "operaciones.php", { operaciones: "getSubcategoriasProducto", idCategoria : id[1], idPortafolio: idProducto}, function( data ) {
		  	//console.log(data);
		  	if(data.length > 0){
		  		for(b in data){
		  			//console.log(c);
		  			if(id[1] == data[b].idPadre){
		  				$('#selectsubcategorias').append('<optgroup label="'+name+'" id="optgroup-cat-'+id[1]+'" data-max-options="2"></optgroup>');
		  			}		  				  			
		  		}
		  		for(d in data){
		  			$('#optgroup-cat-'+id[1]).append('<option '+data[d].selected+' value="'+id[0]+'.'+data[d].idPadre+'.'+data[d].idCategoria+'">'+data[d].tituloEs+'</option>');
		  			//console.log(data[d].tituloEs);
		  		}
		  		$('#selectsubcategorias').selectpicker('refresh');
		  	}
		}, "json");
	});	
}
