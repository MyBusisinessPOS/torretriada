$('#tags').tagsInput({
    'defaultText':'Añadir Email',
    'width':'500px'
});

$('#sendCorreo').click(function(event) {
    var correo = $('#correoPrueba').val();
    $.ajax({
        async:true,
        type: "POST",
        dataType: "html",
       	contentType: "application/x-www-form-urlencoded",
       	url:"operaciones.php",
        data:{"operaciones":"pruebaCorreo", "email":correo},
        success:function(data){
            console.log(data);
           	if(data == 1){
                $('.bottom-right').notify({
                    message: { text: 'Envio Correcto' },
                    type:'blackgloss',
                    fadeOut: { enabled: true, delay: 2000 }
                }).show();
            }else{
                $('.bottom-right').notify({
                    message: { text: 'Ocurrio un problema; Error:'+data},
                    type:'blackgloss',
                    fadeOut: { enabled: true, delay: 2000 }
                }).show(); 
            }                
        },
        cache:false
    });
});

/*function validar_campos(){
    var filter=/^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    
    if(!filter.test(form1.correo.value || form1.correo.value == '')){
        form1.correo.focus();
        $('#correo').removeClass("form-group").addClass("form-group has-error");
        $('.top-right').notify({
            message: { text: 'Este no es correo valido o el campo esta vacío' },
            type:'blackgloss',
        }).show();
        return false;
    }
    else{
        $('#correo').removeClass("form-group has-error").addClass("form-group has-success");
    }   
    if(!filter.test(form1.emisor.value) || form1.emisor.value == ''){
        form1.emisor.focus();
        $('#emisor').removeClass("form-group").addClass("form-group has-error");
        $('.top-right').notify({
            message: { text: 'Este no es correo valido o el campo esta vacío' },
            type:'blackgloss',
        }).show();
        return false;   
    }
    else{
        $('#emisor').removeClass("form-group has-error").addClass("form-group has-success");
    }
}*/
/* ==========================================================
 * Añade las redes sociales dinamicamente
 * ========================================================== */
var _rd = 0;
function addRedSocial(){
    var _html = '<div class="input-group espacios" id="redSocial'+_rd+'">'+
                    '<div class="fa fa-times absolute close" onclick="deleteElement('+_rd+', \'redSocial\', \'\', \'false\')"></div>'+
                    '<span class="input-group-addon">Nombre:</span>'+
                    '<input name="nombreRed[]" type="text" class="form-control" placeholder="Ej. Facebook" value="">'+
                    '<span class="input-group-addon">Url:</span>'+
                    '<input name="urlRed[]" type="text" class="form-control" placeholder="https://www.facebook.com/logra.financiamientos" value="">'+
                    '<select class="selectpicker" name="iconRed[]">'+
                        '<option value="">Icon</option>'+
                        '<optgroup label="Social Icons">'+
                            '<option data-content="<i class=\'fa fa-facebook\'></i>" value="fa-facebook"></option>'+
                            '<option data-content="<i class=\'fa fa-facebook-official\'></i>" value="fa-facebook-official"></option>'+
                            '<option data-content="<i class=\'fa fa-pinterest\'></i>" value="fa-pinterest"></option>'+
                            '<option data-content="<i class=\'fa fa-pinterest-p\'></i>" value="fa-pinterest-p"></option>'+
                            '<option data-content="<i class=\'fa fa-pinterest-square\'></i>" value="fa-pinterest-square"></option>'+
                            '<option data-content="<i class=\'fa fa-twitter\'></i>" value="fa-twitter"></option>'+
                            '<option data-content="<i class=\'fa fa-twitter-square\'></i>" value="fa-twitter-square"></option>'+
                            '<option data-content="<i class=\'fa fa-linkedin\'></i>" value="fa-linkedin"></option>'+
                            '<option data-content="<i class=\'fa fa-linkedin-square\'></i>" value="fa-linkedin-square"></option>'+
                            '<option data-content="<i class=\'fa fa-google-plus\'></i>" value="fa-google-plus"></option>'+
                            '<option data-content="<i class=\'fa fa-google-plus-square\'></i>" value="fa-google-plus-square"></option>'+
                            '<option data-content="<i class=\'fa fa-behance\'></i>" value="fa-behance"></option>'+
                            '<option data-content="<i class=\'fa fa-behance-square\'></i>" value="fa-behance-square"></option>'+
                            '<option data-content="<i class=\'fa fa-instagram\'></i>" value="fa-instagram"></option>'+ 
                            '<option data-content="<i class=\'fa fa-skype\'></i>" value="fa-skype"></option>'+ 
                            '<option data-content="<i class=\'fa fa-youtube\'></i>" value="fa-youtube"></option>'+                                             
                        '</optgroup>'+
                    '</select>'+                            
                 '</div>';
    $('#contentRedSocial').append(_html);
    initSelectPicker();
    _rd ++;             
}

$('#addRedSocial').click(function() {
    addRedSocial();
}); 

function initSelectPicker(){
    $('.selectpicker').selectpicker();
}
