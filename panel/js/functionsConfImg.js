function validar_campos(){
	if(form1.altomaximo.value == ''){
		form1.altomaximo.focus();
		$('#altomaximo').removeClass("form-group").addClass("form-group has-error");
		$('.top-right').notify({
    		message: { text: 'El Campo del alto máximo está vacío, para poder continuar asigne un alto máximo' },
    		type:'blackgloss',
  		}).show();
		return false;
	}else{
		$('#altomaximo').removeClass("form-group has-error").addClass("form-group has-success");
	}
	if(form1.anchomaximo.value == ''){
		form1.anchomaximo.focus();
		$('#anchomaximo').removeClass("form-group").addClass("form-group has-error");
		$('.top-right').notify({
    		message: { text: 'El Campo del ancho máximo está vacío, para poder continuar asigne un ancho máximo' },
    		type:'blackgloss',
  		}).show();
		return false;
	}else{
		$('#anchomaximo').removeClass("form-group has-error").addClass("form-group has-success");
	}
}