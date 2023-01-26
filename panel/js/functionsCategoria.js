$(document).on('click', '.buttonagregar', function(){
	$('.modal-title').text('Agregar Categoria');
	$('#operaciones').val('agregarcategoria');
	$('#tituloEs').val('');
	$('#tituloEn').val('');
	$('#modal-edit-table').modal('show');
	$('#preview-categoria').html('<div class="preview-example"></div>');
	$('#preview-categoria2').html('<div class="preview-example"></div>');
	$('#MOD').val('0');
	$('#selectcategorias').empty();
	var categorias = $('#listCategorias').val();
	var categoriasAsig = $('#listCategoriasAsig').val();
	var cats = JSON.parse(categorias);
	var catsAsig = JSON.parse(categoriasAsig);
	console.log(cats);
	for(c in cats){
		$('#selectcategorias').append('<option value="'+cats[c].idCategoria+'" >'+cats[c].tituloEs+'</option>');
	}
	for(a in catsAsig){
		$('#selectcategorias').find('[value='+catsAsig[a].idCategoria+']').remove();
		//console.log($('#selectcategorias').find('[value='+a.idCategoria+']'));
	}	
	$('#selectcategorias').selectpicker('refresh');
})

$(document).on('click', '.edit', function(){
	$('#MOD').val('1');
	$('#selectcategorias').empty();
	//console.log($(this).attr('data-cat'));
	$('.modal-title').text('Modificar Categoria');
	$('#operaciones').val('modificarcategoria');
	$('#id').val($(this).attr('data-id'));
	$('#tituloEs').val($(this).attr('data-tituloEs'));
	$('#tituloEn').val($(this).attr('data-tituloEn'));
	$('#modal-edit-table').modal('show');
	$('#preview-categoria').html('<img width="auto" height="250px" src="../img/categoria/'+$(this).attr('data-ruta')+'">');
	$('#preview-categoria2').html('<img width="auto" height="250px" src="../img/categoria/'+$(this).attr('data-ruta2')+'">');
	

	var categorias = $('#listCategorias').val();
	var categoriasAsig = $('#listCategoriasAsig').val();
	var cats = JSON.parse(categorias);
	var catsAsig = JSON.parse(categoriasAsig);

	for(c in cats){
		$('#selectcategorias').append('<option value="'+cats[c].idCategoria+'" >'+cats[c].tituloEs+'</option>');
	}
	var cat = JSON.parse($(this).attr('data-cat'));	
	$('#selectcategorias').selectpicker('val',cat);
	
	if(cat.length>0){					
		$.each(cat,function(a,v){	
			for(a in catsAsig){			
				if(v==catsAsig[a].idCategoria){
					//console.log(v);
					//$('#selectcategorias').find('[value='+catsAsig[a].idCategoria+']').remove();
					catsAsig.splice(a,1);
				}
			}
			
		});
		for (r in catsAsig){
			console.log(catsAsig[r].idCategoria);
			$('#selectcategorias').find('[value='+catsAsig[r].idCategoria+']').remove();
		}
	}else{
		for(a in catsAsig){			
			$('#selectcategorias').find('[value='+catsAsig[a].idCategoria+']').remove();
		}
	}				
	$('#selectcategorias').selectpicker('refresh');
});

