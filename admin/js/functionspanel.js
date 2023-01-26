var URL = window.location.pathname;
var newURL = URL.split("/");
var page = newURL[newURL.length - 1];
var Lotes = [];

if(page == "listlote.php"){
	opera = 'lotes';
}else if(page == "listlote2.php"){
	opera = 'lotes2';
}

$("select[name='filtrado']").change(function(){
	var filtro = $(this).val();
	var html = "";
	info = {operaciones:'listadoLotes', lista: opera, status: filtro};

	$.ajax({
		async:true,
	    type: "POST",
	    dataType: "html",
	    contentType: "application/x-www-form-urlencoded",
	    url:"operaciones.php",
	    data: info,
	    success:function(data){
	    	//console.log(data)
	    	Lotes = JSON.parse(data);
	    },
	    cache:false
	}).done(function(){
		$.each(Lotes, function(i, val){
			s_opacity = 'opacity';
        	s_fa = 'fa-circle-o';
        	w_opacity = 'opacity';
        	w_fa = 'fa-circle-o';
        	d_opacity = 'opacity';
        	d_fa = 'fa-circle-o';
        							
			if(val.status == 1){
				s_opacity = '';
        		s_fa = 'fa-circle';
			}
			if(val.status == 2){
        		w_opacity = '';
        		w_fa = 'fa-circle';
        	}
        	if(val.status == 3){
        		d_opacity = '';
        		d_fa = 'fa-circle';
        	}
        	html += '<tr>'+
        				'<td>'+
        					'<input type="checkbox" id="'+val.idlote+'" name="idlote[]" value="'+val.idlote+'">'+
        					'<label for="'+val.idlote+'"><span></span></label>'+
        				'</td>'+
        				'<td><a href="formlote.php?idlote='+val.idlote+'">Lote '+val.lote+'</a></td>'+
        				'<td>'+val.metrosCuadrados+'</td>'+
        				'<td>'+
        					'<button type="button" onclick="cambiarStatus(1, '+val.idlote+', this)" class="btn btn-success btn-xs b_'+val.idlote+' '+s_opacity+'"><i class="fa '+s_fa+'"></i></button> '+
                            '<button type="button" onclick="cambiarStatus(2, '+val.idlote+', this)" class="btn btn-warning btn-xs b_'+val.idlote+' '+w_opacity+'"><i class="fa '+w_fa+'"></i></button> '+
                            '<button type="button" onclick="cambiarStatus(3, '+val.idlote+', this)" class="btn btn-danger btn-xs b_'+val.idlote+' '+d_opacity+'"><i class="fa '+d_fa+'"></i></button> '+
                        '</td>'+
                    '</tr>';					
		});
		$(".listaLotes").html(html);
		$("table").tablesorter();
    	$("table").trigger("update");  
	});
});

