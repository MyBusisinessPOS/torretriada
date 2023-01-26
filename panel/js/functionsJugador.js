$('#dia').change(function() {
	if($(this).val() != '' && $('#mes').val() != '' && $('#ano').val() != ''){
		calcularEdad();
	}
});
$('#mes').change(function() {
	if($(this).val() != '' && $('#dia').val() != '' && $('#ano').val() != ''){
		calcularEdad();
	}
});
$('#ano').change(function() {
	if($(this).val() != '' && $('#dia').val() != '' && $('#mes').val() != ''){
		calcularEdad();
	}
});
function calcularEdad(){
	var _dateCompare = $('#ano').val()+'-'+$('#mes').val()+'-'+$('#dia').val();
	$('#fechaNacimiento').val(_dateCompare);
	$.post('operaciones.php',{'operaciones':'calcularEdad', 'dateCompare' : _dateCompare}, function(data){
		if(data == 'true'){
			$('#cartaResponsiva').attr('data-validate','true');
			$('#tutorIFE').attr('data-validate','true');
			if(_MOD == 1){
				$('#cartaResponsiva').attr('data-mayorEdad', 0);
				$('#tutorIFE').attr('data-mayorEdad', 0);
			}
		}else{
			$('#cartaResponsiva').attr('data-validate','false');
			$('#tutorIFE').attr('data-validate','false');
			if(_MOD == 1){
				$('#cartaResponsiva').attr('data-mayorEdad', 1);
				$('#tutorIFE').attr('data-mayorEdad', 1);
			}
		}
	})
}

/*
function calcularEdadValid(){
	var _dateCompare = $('#ano').val()+'-'+$('#mes').val()+'-'+$('#dia').val();
	//$('#fechaNacimiento').val(_dateCompare);
	$.post('operaciones.php',{'operaciones':'calcularEdadValid', 'dateCompare' : _dateCompare}, function(data){
		console.log(data);
		$("#edadValid").val(data);
		if(data==11 || data==12 || data < 12)
		{
			var selects='<option value="">---</option><option value="0403">04 - 03</option><option value="02">02</option><option value="01">01</option><option value="0099">00 - 99</option><option value="98">Copa RC 98* en adelante.</option>';
			$("#Categoria").html(selects);
		}
		else if(data==13)
		{
			var selects='<option value="">---</option><option value="0403">04 - 03</option><option value="02">02</option><option value="01">01</option><option value="0099">00 - 99</option><option value="98">Copa RC 98* en adelante.</option>';
			$("#Categoria").html(selects);
		}
		else if(data==14)
		{
			var selects='<option value="">---</option><option value="02">02</option><option value="01">01</option><option value="0099">00 - 99</option><option value="98">Copa RC 98* en adelante.</option>';
			$("#Categoria").html(selects);
		}
		else if(data==15 || data==16)
		{
			var selects='<option value="">---</option><option value="01">01</option><option value="0099">00 - 99</option><option value="98">Copa RC 98* en adelante.</option>';
			$("#Categoria").html(selects);
		}
		else if(data==17 || data > 17)
		{
			var selects='<option value="">---</option><option value="0099">00 - 99</option><option value="98">Copa RC 98* en adelante.</option>';
			$("#Categoria").html(selects);
		}
	})
}

function calcularEdadValid2(){
	var _dateCompare = $('#ano').val()+'-'+$('#mes').val()+'-'+$('#dia').val();
	//$('#fechaNacimiento').val(_dateCompare);
	$.post('operaciones.php',{'operaciones':'calcularEdadValid', 'dateCompare' : _dateCompare}, function(data){
		console.log(data);
		$("#edadValid").val(data);
	})
}

*/

function validarEmail(_email) {
	_expr = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
	if(!_expr.test(_email) ) 
		return false;
	else 
		return true;
}

function activar(id,status){
	var data = new FormData();
	data.append('operaciones','changeStatusJugador');
	data.append('id',id);
	data.append('status',status);
	$.ajax({
		url:"operaciones.php",
		 type:'POST',
		 contentType:false,
		 async: false,
		 data:data,
		processData:false,
		cache:false,
		success : function(data){
			if(status==1)
			{
				$(".h2-activa b").html("<i class='fa fa-times fa-lg'></i> DESACTIVAR");
				$("#myModal2").modal("show");
				$("#status").val(1);
				$(".h2-activa b").attr("onClick","activar("+id+",0);");
			}
			if(status==0)
			{
				$(".h2-activa b").html("<i class='fa fa-check fa-lg'></i> ACTIVAR");
				$("#status").val(0);
				$(".h2-activa b").attr("onClick","activar("+id+",1);");
			}
		}
	});
}

$(document).ready(function() {    
    $('.valida-jugadores').change(function(){

        /*$('#valuser').html('<div class="progress progress-striped active"><div class="progress-bar progress-bar-success"  role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100" style="width: 100%"><span class="sr-only">45% Complete</span></div></div>');*/

        var idEquipo = $(this).val();        
        var dataString = 'idEquipo='+idEquipo+'&operaciones=compruebaJugadores';

        $.ajax({
            type: "POST",
            url: "operaciones.php",
            data: dataString,
            success: function(data) {
            	if(data == 0){
            		var message = '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><i class="fa fa-exclamation-circle"></i> Se ha alcanzado el máximo de jugadores por equipo.</div>';
            		$("#valuser").html(message);
					$('.valida-jugadores').val("");
            	}
            	if(data == 1){
            		console.log('jugador disponible');
					$("#valuser").html("");
            	}
                //$('#valuser').show("slow").html(data);
            }
        });
    });      
}); 




$('.valida-correos').change(function(){ 
    var _input = $(this);
    var correo = $("#correo").val();
	var idCategoria = $(this).val();        
    var dataString = 'correo='+correo+'&idCategoria='+idCategoria+'&operaciones=verificarCorreo';
	if(correo != "")
	{
    $.ajax({
        type: "POST",
       	url: "operaciones.php",
        data: dataString,
        success: function(data) {
        	console.log(data)
         	if(data == 0){
				  var message = '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><i class="fa fa-exclamation-circle"></i> Este correo ya ha sido registrado anteriormente para esta categoría, intenta con otra.</div>';
				  $("#valuser").html(message);
				  $('.valida-correos').val("");
            }
            if(data == 1){
            	console.log("correo para cat disponible");
				$("#valuser").html("");
            }
        }
    });
	}
});   

$('.correoTrigger').blur(function(){ 
	$(".valida-correos").trigger("change");
});  
