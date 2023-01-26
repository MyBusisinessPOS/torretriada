function validar_campos(){
	var val = $("#files").val();
	if(_MOD == 1){
		if(val != ""){
			if(!val.match(/(?:gif|jpg|png|jpeg|GIF|JPG|PNG|JPEG)$/)) {
	    		$("#imgprin").removeClass("btn-default").addClass("btn-danger"); 
				$(".top-right").notify({
	    			message: { text: "Seleccione una imagen para poder continuar y solo se aceptan imágenes con formato .jpg .png .gif .jpeg" },
	    			type:"blackgloss",
	    			delay: 10000,
	  			}).show(); 
				return false; 
			}
			else{
				$("#imgprin").removeClass("btn-danger").addClass("btn-success");
				$("#myModal").modal("show"); 
			}	
		}
	}else{
		if(!val.match(/(?:gif|jpg|png|jpeg|GIF|JPG|PNG|JPEG)$/)) {
    		$("#imgprin").removeClass("btn-default").addClass("btn-danger"); 
			$(".top-right").notify({
    			message: { text: "Seleccione una imagen para poder continuar y solo se aceptan imágenes con formato .jpg .png .gif .jpeg" },
    			type:"blackgloss",
    			delay: 10000,
  			}).show(); 
			return false; 
		}
		else{
			$("#imgprin").removeClass("btn-danger").addClass("btn-success"); 
			$("#myModal").modal("show");
		}
	}
}


	function activar(id,status){
		var data = new FormData();
		data.append('operaciones','changeStatusEntrenador');
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
    $('.valida-entrenadores').change(function(){

        /*$('#valuser').html('<div class="progress progress-striped active"><div class="progress-bar progress-bar-success"  role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100" style="width: 100%"><span class="sr-only">45% Complete</span></div></div>');*/

        var idEquipo = $(this).val();        
        var dataString = 'idEquipo='+idEquipo+'&operaciones=compruebaEntrenadores';

        $.ajax({
            type: "POST",
            url: "operaciones.php",
            data: dataString,
            success: function(data) {
            	if(data == 0){
            		var message = '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><i class="fa fa-exclamation-circle"></i> Se ha alcanzado el máximo de entrenadores por equipo.</div>';
            		$("#valuser").html(message);
					$('.valida-entrenadores').val("");
            	}
            	if(data == 1){
            		console.log("entrenador disponible");
					$("#valuser").html("");
            	}
                //$('#valuser').show("slow").html(data);
            }
        });
    });              
}); 